<?php

Class Leads_marketing_model extends MY_Model {

	private $table = 'leads';
    private $lead_followups = 'lead_followups';

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
			
			$data12['date'] =date('Y-m-d',strtotime($value['date']));
			$data12['category_name'] = $value['category_name'];
			$data12['lead_title'] = $value['lead_title'];
			$data12['contact_person'] = $value['contact_person'];
			$data12['email'] = $value['email'];
			$data12['country'] = $value['country'];
			$data12['mobile'] = $value['mobile'];
			$data12['city'] = $value['city'];
			$data12['lead_source'] = $value['lead_source'];
			$data12['work_description'] = $value['work_description'];
			$data12['lead_status'] = "Pending";
			
			
			// $data12['email'] = $value['email'];
			// $data12['website'] = $value['website'];
			// $data12['lead_source'] = $value['lead_source'];
			// $data12['company_name'] = $value['company_name'];
			// $data12['country'] = $value['country'];
			// $data12['lead_status'] = $value['lead_status'];			
			$data12['created_by'] = $this->session->userdata['logged_in']['id'];

			// Query to check whether username already exist or not
		$condition = "mobile =" . "'" . $data12['mobile'] . "'";
		$condition = "email =" . "'" . $data12['email'] . "'";
		// $condition = "lead_title =" . "'" . $data['title'] . "'";
	
		
		$this->db->from('lead_csv');
		$this->db->where($condition);
		$this->db->like('lead_title',$data12['lead_title']);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

				$this->db->insert('lead_csv', $data12);
				$id = $this->db->insert_id();
				// $login_id=$this->session->userdata['logged_in']['id'];
				$lead_data = $this->getemployee($id);
				$date = $lead_data['date'];
				$created_by =  $lead_data['created_by'];
				// $date=date('Y-m-d');
				$count = $this->checkRecors($created_by,$date);
					
				
				if($count == 0){
						$target = $this->getTarget($created_by);
						// echo print_r($target);exit;
			
					$data = array(
						'employee_id'=>$created_by,
						'date' =>$date,
						'month' =>date('m',strtotime($date)),
						'target' => $target,
						'lead_count' =>1,

					);
					$this->db->insert('lead_count', $data);
						// if ($this->db->affected_rows() > 0) {
						// 	return true;
						// }else{
						// 	return false;
						// }
					}
				else{
						$old_count = $this->getLeadsTotalCount($created_by,$date);
						$data = array(
							'lead_count '=>$old_count+1
						);
						$this->db->where(['employee_id'=>$created_by,'date'=>$date]);
						$this->db->update('lead_count', $data);
						// if ($this->db->affected_rows() > 0) {
						// 	return true;
						// }else{
						// 	return false;
						// }
					}
				}
			else{
				// without duplicate insert code 
				$data1 = array(
					'is_duplicate '=>1,
				);
				$data2=array_merge($data12,$data1);
				$this->db->insert('lead_csv', $data2);
			}

		}	
}


	public function checkRecors($created_by,$date){
		$this->db->select('id');
		$this->db->from('lead_count');
		$this->db->where(['employee_id'=>$created_by,'date'=>$date]);
		$count=$this->db->get()->num_rows();
		return $count;
	}
	public function getLeadsTotalCount($created_by,$date){
		$this->db->select('lead_count');
		$this->db->from('lead_count');
		$this->db->where(['employee_id'=>$created_by,'date'=>$date]);
		$count=$this->db->get()->row_array();
		return $count['lead_count'];
	}

	

	// Insert registration data in database
		 public function insert($data) 
	{
		// Query to check whether username already exist or not
		$condition1 = "mobile =" . "'" . $data['mobile'] . "'";
		$condition2 = "email =" . "'" . $data['email'] . "'";
		// $condition = "lead_title =" . "'" . $data['title'] . "'";
	
		
		$this->db->from('lead_csv');
		$this->db->where($condition1);
		$this->db->or_where($condition2);
		$this->db->like('lead_title',$data['lead_title']);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->insert('lead_csv', $data);
			if ($this->db->affected_rows() > 0) {
				// echo print_r($_POST);exit;
				return true;
			}
		} 
		else if ($query->num_rows() == 1) {
			$data1 = array(
				'is_duplicate '=>1,
			);
			$data2=array_merge($data,$data1);
			$this->db->insert('lead_csv', $data2);
			if ($this->db->affected_rows() > 0) {
				return true;
			}
		
	}
	   else{
		return false;
	}
}
	public function insertLeadCount($data1){
		$this->db->insert('lead_count', $data1);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	
	} 

	public function insertLeadHistory($leadhistory){
		$this->db->insert('lead_history', $leadhistory);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}
	public function getTarget($login_id){
		$this->db->select('target');
		$this->db->from('employees');
		$this->db->where(['id'=>$login_id]);
		$count=$this->db->get()->row_array();		//print_r($count);exit;
		return $count['target'];
	}

	public function getemployee($lead_id){
		$this->db->select('date,created_by');
		$this->db->from('lead_csv');
		$this->db->where(['id'=>$lead_id]);
		$count=$this->db->get()->row_array();		//print_r($count);exit;
		return $count;
	}
	 public function lead_update($data,$lead_id) 
	{
		/*print_r($id);
		print_r($data);
		exit;
		*/
		$this->db->where('id', $lead_id);
		$this->db->update('lead_marketing', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function LeadList() 
	{
		
		$this->db->select('leads.*,categories.category_name as category_name');
		$this->db->from('leads');
		$this->db->join('categories','leads.category_id=categories.id','left');
		//$this->db->join('grades','leads.grade_id=grades.id');


		$this->db->where('leads.flag','0');
		$this->db->order_by("leads.id", "desc");
		$query = $this->db->get();
		return $query->result_array();

	}
   
   
	public function reminderinsert($data) 
	{
		$this->db->insert('lead_reminder', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		 else { 
		return false;
		}
	}
	public function nofollowuplist($login_id){
	
		$this->db->select('lead_marketing.*,emp1.name as person_name,emp2.name as assign_name');
		$this->db->from('lead_marketing');
		if($this->role_id=='1'|| $this->role_id=='2'){
		$this->db->where(['lead_marketing.lead_status'=>'Approve but no action']);
		}else
		{
			$this->db->where(['lead_marketing.assign_to'=>$this->login_id,'lead_marketing.lead_status'=>'Approve but no action']);
		}
		$this->db->join('employees as emp1','emp1.id=lead_marketing.assign_to','left');
		$this->db->join('employees as emp2','emp2.id=lead_marketing.assign_by','left');


	
		$this->db->order_by("lead_marketing.id", "desc");
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function LeadListCSV($conditions = null) 
	{
		if($this->role_id=='1'|| $this->role_id=='2'){
		$this->db->select('lead_marketing.*,emp1.name as person_name,emp2.name as assign_name');
		$this->db->from('lead_marketing');
		$this->db->where(['lead_marketing.assign_to !='=>0]);
		// $this->db->where("date BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW()");
		$this->db->join('employees as emp1','emp1.id=lead_marketing.assign_to','left');
		$this->db->join('employees as emp2','emp2.id=lead_marketing.assign_by','left');
		//$this->db->join('grades','leads.grade_id=grades.id');
		if(!empty($conditions)){
			
			if(!empty($conditions['category_name'])){
				$this->db->where('lead_marketing.category_name',$conditions['category_name'],'both');
			}
			if(!empty($conditions['lead_code'])){
				$this->db->where('lead_marketing.lead_code',$conditions['lead_code'],'both');
			}
			if(!empty($conditions['lead_status'])){
				$this->db->where('lead_marketing.lead_status',$conditions['lead_status'],'both');
			}
			if(!empty($conditions['employee_id'])){
				$this->db->where('lead_marketing.assign_to',$conditions['employee_id'],'both');
			}
			if(!empty($conditions['from_date'])){
				$this->db->where('lead_marketing.date >=',$conditions['from_date'],'both');
			}

			if(!empty($conditions['upto_date'])){
				$this->db->where('lead_marketing.date <=',$conditions['upto_date'],'both');
			}
		}// $this->db->where('lead_csv.flag','0');
		$this->db->order_by("lead_marketing.id", "desc");
		$query = $this->db->get();
	}
// 		print_r($this->db->last_query());exit;

		else{

			$this->db->select('lead_marketing.*,emp1.name as person_name,emp2.name as assign_name');
		$this->db->from('lead_marketing');
		$this->db->where(['assign_to'=>$this->login_id]);
		// $this->db->where("date BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW()");
		$this->db->join('employees as emp1','lead_marketing.assign_to=emp1.id','left');
		$this->db->join('employees as emp2','emp2.id=lead_marketing.assign_by','left');
		//$this->db->join('grades','leads.grade_id=grades.id');
		if(!empty($conditions)){
			
			if(!empty($conditions['category_name'])){
				$this->db->where('lead_marketing.category_name',$conditions['category_name'],'both');
			}
			if(!empty($conditions['lead_code'])){
				$this->db->where('lead_marketing.lead_code',$conditions['lead_code'],'both');
			}
			if(!empty($conditions['lead_status'])){
				$this->db->where('lead_marketing.lead_status',$conditions['lead_status'],'both');
			}
			if(!empty($conditions['employee_id'])){
				$this->db->where('lead_marketing.assign_to',$conditions['employee_id'],'both');
			}
			if(!empty($conditions['from_date'])){
				$this->db->where('lead_marketing.date >=',$conditions['from_date'],'both');
			}

			if(!empty($conditions['upto_date'])){
				$this->db->where('lead_marketing.date <=',$conditions['upto_date'],'both');
			}
		}// $this->db->where('lead_csv.flag','0');
		$this->db->order_by("lead_marketing.id", "desc");
		$query = $this->db->get();
		}
		return $query->result_array();

	}
	public function getfollowup($lead_id){
		$this->db->select('date');
		$this->db->from('lead_followups');
        $this->db->where('lead_id', $lead_id);
        $query = $this->db->get();
        return $query->row_array();
	}
	public function getById($id) {
       	$this->db->select('*');
		$this->db->from('lead_marketing');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
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
       	$this->db->select('lead_followups.*,employees.name as giver,lead_marketing.lead_title as title');
		$this->db->from('lead_followups');
	 	$this->db->join('lead_marketing', 'lead_followups.lead_id = lead_marketing.id','left'); 
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

     function getLeadcsvCode(){

    $query=$this->db->query('SELECT * FROM lead_marketing');
   
    $count=$query->num_rows();
    //print_r($count);exit;
    return $count;
   
    }


    function getCategories() { 
		$result = $this->db->select('id, category_name')->from('categories')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Services...'; 
        foreach($result as $r) { 
            $productname[$r['category_name']] = $r['category_name']; 
        } 
        
        return $productname; 
    }

	
    function getCountry() { 
		// echo "<pre>"; print_r($_POST);exit;

		$result = $this->db->select('id,iso,name,phonecode')->from('country')->get()->result_array(); 
        // $result = $this->db->select('id,name,iso,phonecode')->get('country')->result_array(); 
    
 		//order_by('category_name', 'asc');
        $productname = array(); 
        $productname[''] = 'Select Country...';
		// print_r(  $productname['']);exit; 
        foreach($result as $r) { 
            $productname['+'.$r['phonecode']." ".$r['name']] = "+".$r['phonecode']." ".$r['name']; 
	
        } 
		// echo "<pre>";print_r($productname);exit;
        
        return $productname; 
    }
	public function getEmployeeDropdown($department_id = null,$login_id = null) { 
		$this->db->select('id, name');
		$this->db->from('employees');
		if((!empty($department_id)))
		{
			$this->db->where(['department_id'=>$department_id,'flag'=>'0']);
		}
		if((!empty($login_id)))
		{	
			$this->db->where(['id !='=>$login_id,'flag'=>'0']);
		}
		// else {
		// 	$this->db->where('flag','0');
		// }
		$query = $this->db->get();
		return $query->result_array();
    }



    function getLeadsCategories() { 
		$result = $this->db->select('id, category_name')->from('lead_csv')->group_by('category_name')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
 		//order_by('category_name', 'asc');
        // $productname = array(); 
        // $productname[''] = 'Select Category...'; 
        // foreach($result as $r) { 
        //     $productname[$r['category_name']] = $r['category_name']; 
        // } 
        
        return $result; 
    }


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
			if($this->db->delete('lead_csv', "id = ".$id)) return true;
			// $data=array('flag'=>'1');
			// $this->db->set('flag','flag',false);
			// $this->db->where('id',$id);
			// if($this->db->update('leads', $data)){
			// 	return true;
			// }else{
			// 	return false;
			// }
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

    public function mo_enquiry($data) 
	{

	
		// Query to insert data in database
		$this->db->insert('mo_website_leads', $data);
		if ($this->db->affected_rows() > 0) {
		return true;
		}
		else { 
		return false;
		}
	}

	public function MOLeadList() 
	{
		
		$this->db->select('mo_website_leads.*');
		$this->db->from('mo_website_leads');
		// $this->db->join('categories','mo_website_leads.category_id=categories.id','left');
		//$this->db->join('grades','leads.grade_id=grades.id');
		// $this->db->where('mo_website_leads.flag','0');
		$this->db->order_by("mo_website_leads.id", "desc");
		$query = $this->db->get();
		return $query->result_array();

	}




}
?>
