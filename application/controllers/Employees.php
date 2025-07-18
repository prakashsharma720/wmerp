<?php

//session_start(); //we need to start session in order to access it through CI

Class Employees extends MY_Controller {

public function __construct() {
parent::__construct();
if(!$this->session->userdata['logged_in']['id']){
    redirect('User_authentication/index');
}
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('url');
// new security feature
$this->load->helper('security');
// Load form validation library
$this->load->library('form_validation');
// Load session library
$this->load->library('session');
$this->load->library('template');
// Load database
$this->load->model('employee');
}

// Show login page
public function index() {
			$data['title'] = 'Employees List';
			$loginId=$this->session->userdata['logged_in']['id'];
			$data['employees'] = $this->employee->employeesList($loginId);
			$data['roles'] = $this->employee->getRoles();
			$data['departments'] = $this->employee->getDepartments();	
			//echo var_dump($data['students']);
			// print_r($data['employees'] );exit;
			$this->template->load('layout/template','employee_view',$data);
	}
	public function events()
	{
		$data['title'] = 'Office Events';
		$data['birthdays'] = $this->employee->upcomingBirthdays(30);
		$data['work_anniversary'] = $this->employee->upcomingWorkAnniversary(30);
		$this->template->load('layout/template', 'events_view', $data);
	}

	
	

	public function add() 
	{
			$data = array();
			$data['title'] = 'Add New Employee';
			//$data['employees'] = $this->employee->employeesList();
			$data['roles'] = $this->employee->getRoles();
			$data['emp_code'] = $this->employee->getEmployeeCode();
			$voucher_no= $data['emp_code'];
            if($voucher_no<10){
            $employee_id_code='EC000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $employee_id_code='EC00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $employee_id_code='EC0'.$voucher_no;
            }
            else{
              $employee_id_code='EC'.$voucher_no;
            }
            //print_r($employee_id_code);exit;
            $data['employee_code']=$employee_id_code;
			$data['departments'] = $this->employee->getDepartments();
			$data['designations'] = $this->employee->getDesignation();
			$data['employees'] = $this->employee->getEmployees();
			//print_r($data['departments']);exit;
			$this->template->load('layout/template','employees',$data);
	}
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->employee->getById($id);
			// echo "<pre>"; print_r($result); exit;

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;
			if (isset($result['designation']) && $result['designation']) :
	            $data['designation'] = $result['designation'];
	        else:
	            $data['designation'] = '';
	        endif;

			if (isset($result['name']) && $result['name']) :
	            $data['name'] = $result['name'];
	       else:
	            $data['name'] = '';
	        endif;	
	        if (isset($result['blood_group']) && $result['blood_group']) :
	            $data['blood_group'] = $result['blood_group'];
	       else:
	            $data['blood_group'] = '';
	        endif;

	        if (isset($result['employee_code']) && $result['employee_code']) :
	            $data['emp_code'] = $result['employee_code'];
	            $voucher_no= $data['emp_code'];
	            if($voucher_no<10){
	            $employee_id_code='EC000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $employee_id_code='EC00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $employee_id_code='EC0'.$voucher_no;
	            }
	            else{
	              $employee_id_code='EC'.$voucher_no;
	            }
	            //print_r($employee_id_code);exit;
	            $data['employee_code']=$employee_id_code;
	        	else:
	            $data['employee_code'] = '';
	        endif;

	        if (isset($result['email']) && $result['email']) :
	            $data['email'] = $result['email'];
	      	 else:
	            $data['email'] = '';
	        endif;
			if (isset($result['salary']) && $result['salary']) :
	            $data['salary'] = $result['salary'];
	       	else:
	            $data['salary'] = '';
	        endif;

			if (isset($result['account_holder_name']) && $result['account_holder_name']) :
	            $data['account_holder_name'] = $result['account_holder_name'];
	       	else:
	            $data['account_holder_name'] = '';
	        endif;

			if (isset($result['bank_name']) && $result['bank_name']) :
	            $data['bank_name'] = $result['bank_name'];
	       	else:
	            $data['bank_name'] = '';
	        endif;

			if (isset($result['account_number']) && $result['account_number']) :
	            $data['account_number'] = $result['account_number'];
	       	else:
	            $data['account_number'] = '';
	        endif;

			if (isset($result['ifsc_code']) && $result['ifsc_code']) :
	            $data['ifsc_code'] = $result['ifsc_code'];
	       	else:
	            $data['ifsc_code'] = '';
	        endif;

			if (isset($result['branch_name']) && $result['branch_name']) :
	            $data['branch_name'] = $result['branch_name'];
	       	else:
	            $data['branch_name'] = '';
	        endif;

			if (isset($result['account_type']) && $result['account_type']) :
	            $data['account_type'] = $result['account_type'];
	       	else:
	            $data['account_type'] = '';
	        endif;

			if (isset($result['upi_id']) && $result['upi_id']) :
	            $data['upi_id'] = $result['upi_id'];
	       	else:
	            $data['upi_id'] = '';
	        endif;

			if (isset($result['hra']) && $result['hra']) :
	            $data['hra'] = $result['hra'];
	       	else:
	            $data['hra'] = '';
	        endif;

			if (isset($result['c_allowance']) && $result['c_allowance']) :
	            $data['c_allowance'] = $result['c_allowance'];
	       	else:
	            $data['c_allowance'] = '';
	        endif;
			
			if (isset($result['m_allowance']) && $result['m_allowance']) :
	            $data['m_allowance'] = $result['m_allowance'];
	       	else:
	            $data['m_allowance'] = '';
	        endif;

			if (isset($result['o_allowance']) && $result['o_allowance']) :
	            $data['o_allowance'] = $result['o_allowance'];
	       	else:
	            $data['o_allowance'] = '';
	        endif;

			if (isset($result['uan']) && $result['uan']) :
	            $data['uan'] = $result['uan'];
	       	else:
	            $data['uan'] = '';
	        endif;

			if (isset($result['pf']) && $result['pf']) :
	            $data['pf'] = $result['pf'];
	       	else:
	            $data['pf'] = '';
	        endif;

			if (isset($result['esi']) && $result['esi']) :
	            $data['esi'] = $result['esi'];
	       	else:
	            $data['esi'] = '';
	        endif;


	        if (isset($result['mobile_no']) && $result['mobile_no']) :
	            $data['mobile_no'] = $result['mobile_no'];
	       else:
	        $data['mobile_no'] = '';
	        endif;
			 if (isset($result['emobile_no']) && $result['emobile_no']) :
	            $data['emobile_no'] = $result['emobile_no'];
	       else:
	        $data['emobile_no'] = '';
	        endif;
			if (isset($result['ename']) && $result['ename']) :
	            $data['ename'] = $result['ename'];
	       else:
	        $data['ename'] = '';
	        endif;

	      

	        if (isset($result['username']) && $result['username']) :
	            $data['username'] = $result['username'];
	       else:
	            $data['username'] = '';
	        endif;

 		

	        if (isset($result['role_id']) && $result['role_id']) :
	            $data['role_id'] = $result['role_id'];
	       else:
	            $data['role_id'] = '';
	        endif;

			if (isset($result['department_id']) && $result['department_id']) :
	            $data['department_id'] = $result['department_id'];
	       else:
	            $data['department_id'] = '';
			endif; 
			if (isset($result['designation_id']) && $result['designation_id']) :
	            $data['designation_id'] = $result['designation_id'];
	       else:
	            $data['designation_id'] = '';
			endif; 
			if (isset($result['target']) && $result['target']) :
	            $data['target'] = $result['target'];
	       else:
	            $data['target'] = '';
			endif; 
			if (isset($result['date_of_joining']) && $result['date_of_joining']) :

	            $data['date_of_joining'] = date('d-m-Y',strtotime($result['date_of_joining']));
	       else:
	            $data['date_of_joining'] = '';
			endif; 

			if (isset($result['author_id']) && $result['author_id']) :
	            $data['author_id'] = $result['author_id'];
	       else:
	            $data['author_id'] = '';
	        endif;
			if (isset($result['total_net_salary']) && $result['total_net_salary']) :
	            $data['total_net_salary'] = $result['total_net_salary'];
	       else:
	            $data['total_net_salary'] = '';
	        endif;
			
	       
			
			
			if (isset($result['employee_code']) && $result['employee_code']) :
				$data['employee_code'] = $result['employee_code'];
			else:
				$data['employee_code'] = '';
			endif;

	        if (isset($result['pan_no']) && $result['pan_no']) :
	            $data['pan_no'] = $result['pan_no'];
	       else:
	            $data['pan_no'] = '';
	        endif; 
	        if (isset($result['aadhaar_no']) && $result['aadhaar_no']) :
	            $data['aadhaar_no'] = $result['aadhaar_no'];
	       else:
	            $data['aadhaar_no'] = '';
	        endif; 
	        if (isset($result['gender']) && $result['gender']) :
	            $data['gender'] = $result['gender'];
	       else:
	            $data['gender'] = '';
	        endif; 
	        if (isset($result['address']) && $result['address']) :
	            $data['address'] = $result['address'];
	       else:
	            $data['address'] = '';
	        endif;
			
	        if (isset($result['dob']) && $result['dob']) :
	            $data['dob'] =date('d-m-Y',strtotime($result['dob']));
	       else:
	            $data['dob'] = '';
	        endif;

	        if (isset($result['photo']) && $result['photo']) :
	            $data['photo'] = $result['photo'];
	       else:
	            $data['photo'] = '';
	        endif; 
	       
	        if (isset($result['id']) && $result['id']) :
				$data['title'] = 'Edit Employee';
			else:
				$data['title'] = 'Add New Employee';
			 endif;	
			//$data['employees'] = $this->employee->employeesList();
			$data['roles'] = $this->employee->getRoles();
			$data['departments'] = $this->employee->getDepartments();
			$data['designations'] = $this->employee->getDesignation();
			$data['employees'] = $this->employee->getEmployees();
			
			//print_r($data['departments']);exit;
			$this->template->load('template','employee_edit',$data);
			
    }
	public function add_new_employee() {

		$this->form_validation->set_rules('mobile_no', 'Mobile Number ', 'required');
		$this->form_validation->set_rules('role_id', 'Role ', 'required');
		$this->form_validation->set_rules('department_id', 'Department', 'required');		
		
        //$photo=$this->upload->data('file_name'); 
		//print_r($photo);exit;
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			redirect('/Employees/add');
			//$this->template->load('template','employees',$data);
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			     	
	               
	        $loginId=$this->session->userdata['logged_in']['id'];
	  		/*$config['upload_path']          = './uploads/';
	        $config['allowed_types']        = 'jpg|png';
	        $config['max_size']             = 100;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
	        //$this->load->library('upload');
	        

	        // File upload configuration
	        $uploadPath = './uploads/user_media/';
	        $config['upload_path'] = $uploadPath;
	        $config['allowed_types'] = '*';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('photo');
            	if(!empty($this->upload->data()['file_name'])){
	      		$file_name='uploads/user_media/'.$this->upload->data()['file_name'];
	      		
	      	}else{
	      		$file_name=$this->input->post('old_image');
	      	}

			$author_email = $this->employee->get_author_email($this->input->post('author_id'));

			//echo "<pre>"; print_r($author_email); exit;
			$data = array(
			'name' => $this->input->post('name'),
			'employee_code' => $this->input->post('employee_code'),
			'email' => $this->input->post('email'),
			'role_id' => $this->input->post('role_id'),
			'mobile_no' => $this->input->post('mobile_no'),
			'department_id'=>$this->input->post('department_id'),
			'designation_id'=>$this->input->post('designation_id'),
			'date_of_joining'=>date('Y-m-d',strtotime($this->input->post('doj'))),
			'dob'=>date('Y-m-d',strtotime($this->input->post('dob'))),
			'username' => $this->input->post('username'),
			'author_id' =>$this->input->post('author_id'),
			'photo' => $file_name,
			'password' => md5($this->input->post('password')),
			'gender' =>$this->input->post('gender'),
			'address' => $this->input->post('address'),
			'aadhaar_no'=>$this->input->post('aadhaar_no'),
			'pan_no'=>$this->input->post('pan_no'),		
			'account_holder_name'=>$this->input->post('account_holder_name'),
			'bank_name'=>$this->input->post('bank_name'),
			'account_number'=>$this->input->post('account_number'),
			'ifsc_code'=>$this->input->post('ifsc_code'),
			'branch_name'=>$this->input->post('branch_name'),
			'account_type'=>$this->input->post('account_type'),
			'upi_id'=>$this->input->post('upi_id'),
			'salary'=>$this->input->post('salary'),
			'hra'=>$this->input->post('hra'),
			'c_allowance'=>$this->input->post('c_allowance'),
			'm_allowance'=>$this->input->post('m_allowance'),
			'o_allowance'=>$this->input->post('o_allowance'),
			'total_net_salary'=>$this->input->post('total_net_salary'),
			'emobile_no' => $this->input->post('emobile_no'),
			'ename' => $this->input->post('ename'),
			'uan' => $this->input->post('uan'),
			'pf' => $this->input->post('pf'),
			'esi' => $this->input->post('esi'),		
			'created_by' => $loginId,
			'author_email' =>$author_email
			);
			// echo print_r('department_id');exit;
			//print_r($data);exit;
			$result = $this->employee->employee_insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Employee Added Successfully !');
			redirect('/Employees/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Employee insertion failed!');
			redirect('/Employees/index', 'refresh');
			}
		} 
	}

	public function editemployee($id) {
		//  echo"<pre>";print_r($_POST);exit;
		$this->form_validation->set_rules('name', 'Name ', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->add();
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			$loginId=$this->session->userdata['logged_in']['id'];

			//print_r($this->input->post('old_image'));exit;
			
			$uploadPath = './uploads/user_media/';
	        $config['upload_path'] = $uploadPath;
	        $config['allowed_types'] = '*';

            // Load and initialize upload library
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('photo');


	      	//print_r($this->upload->data()['file_name']);exit;
	      	if(!empty($this->upload->data()['file_name'])){
	      		$file_name='uploads/user_media/'.$this->upload->data()['file_name'];
	      		
	      	}else{
	      		$file_name=$this->input->post('old_image');
	      	}
	    	$author_email = $this->employee->get_author_email($this->input->post('author_id'));

			$data = array(
	// 			'photo' => $this->upload->data()['file_name'],
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'role_id' => $this->input->post('role_id'),
				'mobile_no' => $this->input->post('mobile_no'),
				'designation_id'=>$this->input->post('designation_id'),
				'designation_id'=>$this->input->post('designation_id'),
				'date_of_joining'=>date('Y-m-d',strtotime($this->input->post('doj'))),
				'dob'=>date('Y-m-d',strtotime($this->input->post('dob'))),
				'username' => $this->input->post('username'),
				'author_id' =>$this->input->post('author_id'),
				'photo' => $file_name,
				'address' => $this->input->post('address'),
				'aadhaar_no'=>$this->input->post('aadhaar_no'),
				'pan_no'=>$this->input->post('pan_no'),
				'account_holder_name'=>$this->input->post('account_holder_name'),
				'bank_name'=>$this->input->post('bank_name'),
				'account_number'=>$this->input->post('account_number'),
				'ifsc_code'=>$this->input->post('ifsc_code'),
				'branch_name'=>$this->input->post('branch_name'),
				'account_type'=>$this->input->post('account_type'),
				'upi_id'=>$this->input->post('upi_id'),				
				'salary'=>$this->input->post('salary'),
				'hra'=>$this->input->post('hra'),
				'c_allowance'=>$this->input->post('c_allowance'),
				'm_allowance'=>$this->input->post('m_allowance'),
				'o_allowance'=>$this->input->post('o_allowance'),
				'total_net_salary'=>$this->input->post('total_net_salary'),				
				'emobile_no' => $this->input->post('emobile_no'),
				'ename' => $this->input->post('ename'),
				'uan' => $this->input->post('uan'),
				'pf' => $this->input->post('pf'),
				'esi' => $this->input->post('esi'),
				'ename' => $this->input->post('ename'),
				'target'=>$this->input->post('target'),
				'created_by' => $loginId,
				'author_email' => $author_email,
			);

			$result = $this->employee->employee_update($data,$id);
			if ($result == TRUE) {
				if(!empty($this->upload->data()['file_name'])){
					$old_image=$this->input->post('old_image');
					unlink($old_image);
				}
			$this->session->set_flashdata('success', 'User Profile Updated Successfully !');
			redirect('/Employees/edit/'.$id, 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in User details !');
			redirect('/Employees/edit/'.$id, 'refresh');
			}
		} 
	}
	public function deleteEmployee($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->employee->deleteemployee($id);
	  	 			$result=$this->employee->getById($id);
		  	 		if (isset($result['photo']) && $result['photo']) :
			            $user_image = $result['photo'];
			            unlink("uploads/".$user_image);
			        endif;
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Employees deleted Successfully !');
			}else{
  	 		$id = $this->uri->segment('3');
  	 		$this->employee->deleteemployee($id);
  	 		$result=$this->employee->getById($id);
  	 		if (isset($result['photo']) && $result['photo']) :
	            $user_image = $result['photo'];
	            unlink("uploads/".$user_image);
	        endif;

  	 		$this->session->set_flashdata('success', 'Employee deleted Successfully !');
  	 		redirect('/Employees/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 		}

		}
		public function MyProfile($id= null){
		$data['title']='My Profile Details';
		$data['result']=$this->employee->getById($id);
		$this->template->load('template','myprofile',$data);
	}


	}

?>