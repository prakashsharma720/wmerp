<?php

Class Leave_model extends MY_Model {

	private $table = 'leaves';
    private $lead_followups = 'leave_details';

  public function __construct() {
        parent::__construct();
         }
	function saverecords($inserdata)
	{
		
		foreach ($inserdata as $key => $value) {

			$data['lead_code'] = $this->getLeadcsvCode();
			$voucher_no= $data['lead_code']+1;
		    if($voucher_no<10){
		    $rs_id_code='MUSK000'.$voucher_no;
		    }
		    else if(($voucher_no>=10) && ($voucher_no<=99)){
		      $rs_id_code='MUSK00'.$voucher_no;
		    }
		    else if(($voucher_no>=100) && ($voucher_no<=999)){
		      $rs_id_code='MUSK0'.$voucher_no;
		    }
		    else{
		      $rs_id_code='MUSK'.$voucher_no;
		    }

			$data12['lead_code'] = $rs_id_code;
			$data12['date'] = date('Y-m-d');
			$data12['category_name'] = $value['category_name'];
			$data12['work_description'] = $value['work_description'];
			$data12['contact_person'] = $value['contact_person'];
			$data12['mobile'] = $value['mobile'];
			$data12['email'] = $value['email'];
			$data12['website'] = $value['website'];
			$data12['lead_source'] = $value['lead_source'];
			$data12['company_name'] = $value['company_name'];
			$data12['country'] = $value['country'];
			$data12['lead_status'] = $value['lead_status'];			
			$data12['created_by'] = $value['created_by'];
			$this->db->insert('leaves', $data12);
		}
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}

	// Insert registration data in database
	public function insert($data) 
	{
		$this->db->insert('leaves', $data);
		$id = $this->db->insert_id();
		
		if ($this->db->affected_rows() > 0) {
			if($this->sendMail($id) == true){
				return true;
			}
		} 
		else { 
			return false;
		}
	}

	  // public function getUserLeaveAuthorities($id) {
   //      $this->db->from('user_leave_authorities');
   //      $this->db->where('user_id', $id);
   //      $this->db->order_by('priority', 'asc');
   //      $query = $this->db->get();
   //      return $query->result_array();
   //  }
    function getEmpDetailsByID($emp_id) {
		$this->db->select('designation_id,author_email');
		$this->db->where('id', $emp_id);
		$this->db->from('employees');
		$query=$this->db->get()->row_array();
		return $query;
	}

    public function getPreview($id) {
        $this->data = array();
        $html = '';
        $data = $this->getById($id);
        if ($data):

            $this->data['subject'] = 'Leave Application';
            // $this->data['text'] = $data['text'];
            $this->data['user_name'] = $data['username'];
            $this->data['leave_reason'] = $data['leave_reason'];
            $this->data['leave_type'] = $data['leave_type'];
            $this->data['leave_status'] = $data['leave_status'];
            $this->data['leave_category'] = $data['leave_category'];
            $this->data['from_date'] ='';
            $this->data['to_date'] ='';
            $this->data['halfday_date'] ='';
            $this->data['halfday_type'] ='';
            $this->data['halfday_type'] ='';
            $this->data['halfday_type'] ='';
            if ($data['leave_category'] == 'full'):
                $this->data['from_date'] = date('d-m-Y', strtotime($data['from_date']));
                $this->data['to_date'] = date('d-m-Y', strtotime($data['upto_date']));
            else:
                $this->data['halfday_date'] = date('d-m-Y', strtotime($data['halfday_date']));
                $this->data['halfday_type'] = $data['halfday_type'];
            endif;

            $html = $this->load->view('leave_mail', $this->data, TRUE);

        endif;

        return $html;
    }

    public function sendMail($id) {
        $this->data = array();
        $status = TRUE;

        $data = $this->getById($id);
         if ($data):
         	$user_leave_authorities = $this->getEmpDetailsByID($data['employee_id']);
            $toEmail = '';
            $cc = array();

            if ($user_leave_authorities):
                    if ($user_leave_authorities['designation_id'] == 8){
            			$toEmail = $user_leave_authorities['author_email'];
            			$cc = ['hussain@muskowl.com','vilesh@muskowl.com','arushi@muskowl.com'];
            		}
            		else if ($user_leave_authorities['designation_id'] == 4){
            			$toEmail = $user_leave_authorities['author_email'];
            			$cc = ['arushi@muskowl.com'];
            		}
            		else if ($user_leave_authorities['designation_id'] == 2){
            			$toEmail = $user_leave_authorities['author_email'];
            			$cc = ['hussain@muskowl.com'];
					}else{
						$toEmail = $user_leave_authorities['author_email'];
            			$cc = ['hussain@muskowl.com','vilesh@muskowl.com','arushi@muskowl.com'];
					}
                // foreach ($user_leave_authorities as $key => $user_leave_authority) :
                //     if ($key == 0):
                //         $toEmail = $user_leave_authority['author_email'];
                //     else:
                //         $cc[] = $user_leave_authority['author_email'];
                //     endif;
                // endforeach;
            endif;

            $html = $this->getPreview($id);
         

        $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'khushaboo.muskowl@gmail.com', // change it to yours
		  'smtp_pass' => 'hellokhushi329', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		$this->load->helper('string');
		$code= random_string('numeric', 6);

        $this->load->library('email', $config);
	    $this->email->set_newline("\r\n");
	    $this->email->from($data['email']); // change it to yours
	    $this->email->to($toEmail);// change it to yours
	    $this->email->cc($cc);// change it to yours
	    $this->email->subject($this->data['subject']);
	    $this->email->message($html);
	    if($this->email->send())
		{
	        return $status = TRUE;
	    }
	    else
	    {
	        return $status = FALSE;
		}
		endif;
		return $status = FALSE;
    }

	// Leave Update Send Mail
	public function Send_Mail_Leave_Action($leave_id) {

		$this->data = array();
        $status = TRUE;

        $data = $this->getById($leave_id);

		$username     = $data['username'];
		$useremail 	  = $data['email'];
		$leave_status = $data['leave_status'];

		$config = Array(
		    // 'protocol' => 'mail',
			// 'smtp_host' => 'mail.muskowl.com',
			// 'smtp_port' => 587,
			// 'smtp_user' => 'hemendra@muskowl.com', // change it to yours
			// 'smtp_pass' => '#hemendra@2021#', // change it to yours
			
		    'protocol' => 'smtp',
    		'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'hemendra.muskowl@gmail.com', // change it to yours
			'smtp_pass' => 'hss4u@mo', // change it to yours

			'mailtype' => 'html',
			'charset' => 'iso-8859-1',	
			'wordwrap' => TRUE
		);

		$message = 
		'
		<html>
			<head>
				<title>
					Leave Application Status Updated
				</title>
			</head>
			<body>
				<p>
					Dear '.$username.' your leave has been <b>  : '.$leave_status.'</b>
				</p>
			</body>
		</html>
		';

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('hemendra.muskowl@gmail.com'); // change it to yours
		$this->email->to($useremail);// change it to yours
		$this->email->subject('Leave Application Status Updated');
		$this->email->message($message);

		if($this->email->send()) {
			return true;
		} else {
			show_error($this->email->print_debugger());
		}
	}

	function add_notification($data1){
		$this->db->insert('notifications', $data1);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	
	}

	public function lead_update($data,$lead_id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $lead_id);
		$this->db->update('leaves', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}

	public function leave_update($data,$leave_id) 
	{
		$this->db->where('id', $leave_id);
		$this->db->update('leaves', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else { 
			return false;
		}
	}


	// public function LeadList() 
	// {
		
	// 	$this->db->select('leads.*,categories.category_name as category_name');
	// 	$this->db->from('leads');
	// 	$this->db->join('categories','leads.category_id=categories.id','left');
	// 	//$this->db->join('grades','leads.grade_id=grades.id');


	// 	$this->db->where('leads.flag','0');
	// 	$this->db->order_by("leads.id", "desc");
	// 	$query = $this->db->get();
	// 	return $query->result_array();

	// }
	
	public function categoriesList() 
	{
		
		$this->db->select('*');
		$this->db->from('holidays');
		$this->db->where('flag','0');
		$this->db->order_by("title", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}
	public function typesList() 
	{
		
		$this->db->select('*');
		$this->db->from('leave_types');
		$this->db->where('flag','0');
		$this->db->order_by("leave_type", "asc");
		$query = $this->db->get();
		return $query->result_array();

	}

	public function getEmployeeDropdown() { 
		$result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        // $productname = array(); 
        // $productname[''] = 'Select Employee...'; 
        // foreach($result as $r) { 
        //     $productname[$r['id']] = $r['name']; 
        // }
        return $result; 
    }

	public function getEmployee() { 
		$result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        $productname = array(); 
        $productname[''] = 'Select Employee...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['name']; 
        }
        return $productname; 
    }

	public function BalanceList() 
	{
		// $this->db->select('leave_taken.*, employees.name as employee, leave_types.leave_type as leave_type');
		// $this->db->from('leave_taken');
		// $this->db->join('employees','leave_taken.employee_id=employees.id','left');
		// $this->db->join('leave_types','leave_taken.leave_type_id=leave_types.id','left');
		// //$this->db->where('flag','0');
		// $this->db->group_by("employees.id");
		// $query = $this->db->get()->result_array();

		$this->db->select('*');
        $this->db->from('employees');
        $this->db->where('flag','0');
        $query = $this->db->get()->result_array();

        
		$i=0;
        foreach ($query as $i => $value) {
            $this->db->select('SUM(leave_count)');
            $this->db->from('leave_taken');
            $this->db->where(['leave_taken.employee_id'=>$value['id'], 'leave_type_id'=>1]);
            $details1 = $this->db->get()->row_array();
            $query[$i]['paid_leaves'] = $details1['SUM(leave_count)'];
        }
        
		$j=0;
        foreach ($query as $j => $values) {
            $this->db->select('SUM(leave_count)');
            $this->db->from('leave_taken');
            $this->db->where(['leave_taken.employee_id'=>$values['id'], 'leave_type_id'=>2]);
            $details2 = $this->db->get()->row_array();
            $query[$j]['religius_leave'] = $details2['SUM(leave_count)'];
        }

        $k=0;
        foreach ($query as $k => $values) {
            $this->db->select('SUM(leave_count)');
            $this->db->from('leave_allotment');
            $this->db->where(['leave_allotment.emp_id'=>$values['id'], 'leave_year'=>Date('Y')]);
            $details3 = $this->db->get()->row_array();
            $query[$k]['total_alloted'] = $details3['SUM(leave_count)'];
        }

		//echo "<pre>"; print_r($query); exit;

		return $query;
	}


	public function BalanceListByEmployee ($login_id) 
	{
		// $this->db->select('leave_taken.*, employees.name as employee, leave_types.leave_type as leave_type');
		// $this->db->from('leave_taken');
		// $this->db->join('employees','leave_taken.employee_id=employees.id','left');
		// $this->db->join('leave_types','leave_taken.leave_type_id=leave_types.id','left');
		// //$this->db->where('flag','0');
		// $this->db->group_by("employees.id");
		// $query = $this->db->get()->result_array();

		$this->db->select('*');
        $this->db->from('employees');
        $this->db->where('id',$login_id);
        $query = $this->db->get()->result_array();

        
		$i=0;
        foreach ($query as $i => $value) {
            $this->db->select('SUM(leave_count)');
            $this->db->from('leave_taken');
            $this->db->where(['leave_taken.employee_id'=>$value['id'], 'leave_type_id'=>1]);
            $details1 = $this->db->get()->row_array();
            $query[$i]['paid_leaves'] = $details1['SUM(leave_count)'];
        }
        
		$j=0;
        foreach ($query as $j => $values) {
            $this->db->select('SUM(leave_count)');
            $this->db->from('leave_taken');
            $this->db->where(['leave_taken.employee_id'=>$values['id'], 'leave_type_id'=>2]);
            $details2 = $this->db->get()->row_array();
            $query[$j]['religius_leave'] = $details2['SUM(leave_count)'];
        }

        $k=0;
        foreach ($query as $k => $values) {
            $this->db->select('SUM(leave_count)');
            $this->db->from('leave_allotment');
            $this->db->where(['leave_allotment.emp_id'=>$values['id'], 'leave_year'=>Date('Y')]);
            $details3 = $this->db->get()->row_array();
            $query[$k]['total_alloted'] = $details3['SUM(leave_count)'];
        }

		//echo "<pre>"; print_r($query); exit;

		return $query;
	}



	


	public function LeaveListCSV($conditions = null) 
	{
		//echo "<pre>"; print_r($conditions);
		$this->db->select('leaves.*,employees.name as employee,leave_types.leave_type as leave_type');
		$this->db->from('leaves');
		$this->db->join('employees','leaves.employee_id=employees.id','left');
		$this->db->join('leave_types','leaves.leave_type_id=leave_types.id','left');
		if(!empty($conditions)){
       	if(!empty($conditions['employee_id'])){
            $this->db->where('leaves.employee_id',$conditions['employee_id'],'both');
        }
        if(!empty($conditions['category_name'])){
            $this->db->where('leaves.leave_category',$conditions['category_name'],'both');
        }
        if(!empty($conditions['leave_status'])){
            $this->db->where('leaves.leave_status',$conditions['leave_status'],'both');
        }
        if(!empty($conditions['from_date'])){
            $this->db->where('leaves.apply_date >=',$conditions['from_date'],'both');
        }
        if(!empty($conditions['upto_date'])){
            $this->db->where('leaves.apply_date <=',$conditions['upto_date'],'both');
        }
		
		}
		if(!empty($conditions['login_id'])){
            $this->db->where('leaves.employee_id',$conditions['login_id'],'both');
        }
		// echo $login_id;exit;
		// if(!empty($login_id)){
		// $this->db->where('employee_id',$login_id);
		// }
		// $query = $this->db->get()->result_array();
		// echo "<pre>"; print_r($this->db->last_query()); exit;
		
		$this->db->order_by('leaves.id', 'desc');
		return $query = $this->db->get()->result_array();
	}
	


	public function getById($id) {
       $this->db->select('leaves.*,employees.name as username,employees.email as email,leave_types.leave_type as leave_type');
		$this->db->from('leaves');
		$this->db->join('employees','leaves.employee_id=employees.id','left');
		$this->db->join('leave_types','leaves.leave_type_id=leave_types.id','left');
        $this->db->where('leaves.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

public function getByIdHoliday($id) {
       	$this->db->select('*');
		$this->db->from('holidays');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }
public function getByIdBalance($id) {
	 $this->db->select('*');
	 $this->db->from('leave_taken');
	 $this->db->where('id', $id);
	 $query = $this->db->get();
	 return $query->row_array();
 }
public function getByIdLavetype($id) {
		$this->db->select('*');
	 $this->db->from('leave_types');
	 $this->db->where('id', $id);
	 $query = $this->db->get();
	 return $query->row_array();
 }

    public function leave_taken($data) 
	{
		$this->db->insert('leave_taken', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		 else { 
			return false;
		}
	}
	public function insertFollowup($data) 
	{
		$this->db->insert('lead_followups', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}


    public function getFollowUps($id) {
       	$this->db->select('lead_followups.*,employees.name as giver,leaves.work_description as title');
		$this->db->from('lead_followups');
	 	$this->db->join('leaves', 'lead_followups.lead_id = leaves.id','left'); 
		$this->db->join('employees', 'lead_followups.followup_by = employees.id','left'); 
	 	$this->db->where('lead_followups.lead_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }


    function getLeadCode(){
    $count=0;
    $this->db->select_max('lead_code');
    $this->db->from($this->table);
    //$this->db->where(['flag'=>'0']);
    $query=$this->db->get()->row_array();
    //print_r($query['requisition_slip_no']);exit;
    $count=$query['lead_code']+1;
    //print_r($count);exit;
    return $count;
   
    }

    public function getLeadcsvCode(){

    $query=$this->db->query('SELECT * FROM leaves');
   
    $count=$query->num_rows();

    //print_r($count);exit;
    return $count;
   
    }
	public function holiday_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('holidays', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	
	public function Leavetype_update($data,$id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $id);
		$this->db->update('leave_types', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else { 
			return false;
		}
	}

    function getLeaveStatus() { 
		$result = $this->db->select('id, leave_type')->from('')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');        
    	return $result;		
    }

	function getAllotedLeaves() { 
		$this->db->select('leave_allotment.*, months.month_name as leave_month, employees.name as emp_name');
		$this->db->join('months','leave_allotment.leave_month=months.id','left');
		$this->db->join('employees','leave_allotment.emp_id=employees.id','left');
		$this->db->from('leave_allotment');
		// $this->db->group_by('leave_allotment.emp_id');
		$result = $this->db->get()->result_array(); 
		return $result;
    }

	function getMonths() { 
		$result = $this->db->select('id, month_name')->from('months')->where('flag','0')->get()->result_array(); 
		$productname = array(); 
        $productname[''] = 'Select leave month...'; 
        foreach($result as $r) { 

      //   	$this->db->select('id');
		    // $this->db->from('leave_allotment');
		    // $this->db->where(['leave_month'=> $r['id'],'leave_year'=>date('Y')]);
		   	// $query=$this->db->get();
		    // $total=$query->num_rows();
		    // if($total == 0){
            $productname[$r['id']] = $r['month_name']; 
        	// }
        } 
		return $productname;
      
    }

	function getEmployeesList() { 
		$result = $this->db->select('id, name')->from('employees')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
		 return $result;
      
    }
	function getleavetype() { 
		$result = $this->db->select('id, leave_type')->from('leave_types')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select leave Type...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['leave_type']; 
        } 
        
        return $productname; 
    }

    // function getLeadsCategories() { 
	// 	$result = $this->db->select('id, category_name')->from('leaves')->group_by('category_name')->get()->result_array(); 
    //     $result = $this->db->select('id, category_name')->get('categories')->result_array(); 
 	// 	order_by('category_name', 'asc');
    //     $productname = array(); 
    //     $productname[''] = 'Select Category...'; 
    //     foreach($result as $r) { 
    //         $productname[$r['category_name']] = $r['category_name']; 
    //     } 
        
    //     return $result; 
    // }


    function getCountries() { 
		$result = $this->db->select('id,phone_code,country_code,country_name')->from('countries')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Country...'; 
        foreach($result as $r) { 
            $productname[$r['country_name']] = '(+'.$r['phone_code'].') '.$r['country_name']; 
        } 
        
        return $productname; 
    }

     function getGrades() { 
		$result = $this->db->select('id, grade')->from('grades')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Grade...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['grade']; 
        } 
        
        return $productname; 
    } 

 	 function deleteItem($id)
		{
			if($this->db->delete('leaves', "id = ".$id)) return true;
			// $data=array('flag'=>'1');
			// $this->db->set('flag','flag',false);
			// $this->db->where('id',$id);
			// if($this->db->update('leads', $data)){
			// 	return true;
			// }else{
			// 	return false;
			// }
		}


		public function holiday_insert($data) 
	{

		// Query to check whether username already exist or not

		$this->db->insert('holidays', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	  public function Leaveallotement_insert($data) {
	    	// Query to check whether username already exist or not
			$condition = "name =" . "'" . $data['name'] . "'";

			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			//print_r($data);exit;
			if ($query->num_rows() == 0) {
			// Query to insert data in database
			$this->db->insert($this->table, $data);
			if ($this->db->affected_rows() > 0) {
			return true;
			}
			} else { 
			return false;
			}
	    }

	public function Leavetype_insert($data) 
	{

		// Query to check whether username already exist or not

		$this->db->insert('leave_types', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}


		 function deletefollowup($id)
		{
			if($this->db->delete('lead_followups', "id = ".$id)) return true;
			// $data=array('flag'=>'1');
			// $this->db->set('flag','flag',false);
			// $this->db->where('id',$id);
			// if($this->db->update('leads', $data)){
			// 	return true;
			// }else{
			// 	return false;
			// }
		}

	public function getProductsByCategory($id) { 
       $result = $this->db->select('id, name')->from('packing_materials')->where(['flag'=>'0','categories_id'=>$id])->get()->result_array(); 
        
        return $result; 
    }


}
?>