<?php

//session_start(); //we need to start session in order to access it through CI

Class Enquiries extends MY_Controller {

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
$this->load->model('enquiries_model');
}

// Show login page
public function index() {
			$data['title'] = 'Loan List';
			$data['enquiries'] = $this->enquiries_model->getList();
			//$data['roles'] = $this->enquiries_model->getRoles();
			//$data['departments'] = $this->enquiries_model->getDepartments();	
			//echo var_dump($data['students']);
			//print_r($roles);exit;
			$this->template->load('template','enquiry_view',$data);
	}

	
	

	public function add() 
	{
			$data = array();
			$data['title'] = 'Create New Loan';
			
			//$this->load->model('master_model');
			//$data['categories'] = $this->master_model->categoriesListByType($type='Issue');
			
			//$data['departments'] = $this->enquiries_model->getDepartments();
			//print_r($data['departments']);exit;
			$this->template->load('template','enquiry_add',$data);
	}


	


	public function edit($id = NULL) 
	{
			$data = array();

			$result = $this->issues_model->getById($id);
			//print_r($result);exit;
			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['category_id']) && $result['category_id']) :
	            $data['category_id'] = $result['category_id'];
	       else:
	            $data['category_id'] = '';
	        endif;	

	        if (isset($result['status']) && $result['status']) :
	            $data['status'] = $result['status'];
	       else:
	            $data['status'] = '';
	        endif;	
	       
	        if (isset($result['is_female_only'])) :
	            $data['is_female_only'] = $result['is_female_only'];
	       else:
	            $data['is_female_only'] = '';
	        endif; 

	         if (isset($result['description'])) :
	            $data['description'] = $result['description'];
	       else:
	            $data['description'] = '';
	        endif; 
	          if (isset($result['issue_files'])) :
	            $data['issue_files'] = $result['issue_files'];
	       else:
	            $data['issue_files'] = '';
	        endif; 

	       
	        if (isset($result['id']) && $result['id']) :
				$data['title'] = 'Edit Issue';
			else:
				$data['title'] = 'Add New Issue';
			 endif;	
			//$data['employees'] = $this->employee->employeesList();
			//$data['roles'] = $this->employee->getRoles();
			
			//$data['departments'] = $this->employee->getDepartments();
			//print_r($data['departments']);exit;
			$this->load->model('master_model');
			$data['categories'] = $this->master_model->categoriesListByType($type='Issue');
			$this->template->load('template','issue_edit',$data);
	}
	public function add_new_record() {

		// $this->form_validation->set_rules('category_id', 'category ', 'required');
		// $this->form_validation->set_rules('description', 'description ', 'required');
		
  //       //$photo=$this->upload->data('file_name'); 
		// //print_r($photo);exit;
		// if ($this->form_validation->run() == FALSE) 
		// {
		// 	if(isset($this->session->userdata['logged_in'])){
		// 	redirect('/Enquiries/add');
		// 	//$this->template->load('template','employees',$data);
		// 	}else{
		// 	$this->load->view('login_form');
		// 	}
		// 	//$this->template->load('template','supplier_add');
		// }
		// else 
		// {
			     	
	               
	        $loginId=$this->session->userdata['logged_in']['id'];
	  		
			$data = array(
			'loan_date' => date('Y-m-d',strtotime($this->input->post('loan_date'))),	
			'customer_name' => $this->input->post('customer_name'),
			'mobile_no' => $this->input->post('mobile_no'),
			'address' => $this->input->post('address'),
			'product_description' => $this->input->post('product_description'),
			'loan_amount' => $this->input->post('loan_amount'),
			'file_charge' => $this->input->post('file_charge'),
			'total_amount_given' => $this->input->post('total_amount'),
			'no_of_installment' => $this->input->post('no_of_installment'),
			'installment_amount' => $this->input->post('installment_amount'),
			'first_installment_date' => date('Y-m-d',strtotime($this->input->post('first_installment_date'))),	
			'created_by' => $loginId,
			//'status' => 'Pending'
			);

			$result = $this->enquiries_model->record_insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Loan Submitted Successfully !');
			redirect('/Enquiries/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Loan  Submission failed!');
			redirect('/Enquiries/index', 'refresh');
			}
		//} 
	}

	public function edit_record($id) {
		$this->form_validation->set_rules('category_id', 'category ', 'required');
		$this->form_validation->set_rules('description', 'description ', 'required');
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

			
			/*$config['upload_path']          = './uploads/';
	       	$config['allowed_types'] 		= 'gif|jpg|jpeg|png';
	        $config['overwrite'] 			= TRUE;
	        $config['max_size']             = 2048000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
	        $this->load->library('upload');
	       // $photo=$this->upload->data('file_name');
	       // print_r($photo);exit;
	       // $result=$this->upload->do_upload('photo');
	        //$this->upload->do_upload('photo');
	        $this->upload->do_upload('photo');
	       

	      	//print_r($this->upload->data()['file_name']);exit;
	      	if(!empty($this->upload->data()['file_name'])){
	      		$file_name=$this->upload->data()['file_name'];
	      		
	      	}else{
	      		$file_name=$this->input->post('old_image');
	      	}

	      	$data = array(
			'category_id' => $this->input->post('category_id'),
			'is_female_only' => $this->input->post('is_female_only'),
			'description' => $this->input->post('description'),
			'edited_by' => $loginId,
			'status' => $this->input->post('status')
			);

			$result = $this->issues_model->record_update($data,$id);
			if ($result == TRUE) {
				if(!empty($this->upload->data()['file_name'])){
					$old_image=$this->input->post('old_image');
					unlink($old_image);
			}
			$this->session->set_flashdata('success', 'Issue Updated Successfully !');
			redirect('/Enquiries/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Issue !');
			redirect('/Enquiries/index', 'refresh');
			}
		} 
	}
	public function deleteRecord($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->enquiries_model->delete_record($id);
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'All Enquiries deleted Successfully !');
			}else{
  	 		$id = $this->uri->segment('3');
  	 		$this->enquiries_model->delete_record($id);
  	 		$result=$this->enquiries_model->getById($id);
  	 		$this->session->set_flashdata('success', 'Enquiry deleted Successfully !');
  	 		redirect('/Enquiries/index', 'refresh');
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