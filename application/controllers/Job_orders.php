<?php

//session_start(); //we need to start session in order to access it through CI

Class Job_orders extends MY_Controller {

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
$this->load->model('job_order_model');
}

// Show login page
public function index() {
			$data['title'] = 'Job Order List';
			$data['job_orders'] = $this->job_order_model->JobOrderList();
			//$data['roles'] = $this->job_order_model->getRoles();
			//$data['departments'] = $this->job_order_model->getDepartments();	
			//echo var_dump($data['students']);
			//print_r($data['job_orders']);exit;
			$this->template->load('template','job_order_view',$data);
	}

	
	

	public function add() 
	{
			$data = array();
			$data['title'] = 'Create New Job Order';
			//$data['employees'] = $this->job_order_model->employeesList();
			
			$data['joborder_code'] = $this->job_order_model->getJobORderCode();
			$voucher_no= $data['joborder_code'];
            if($voucher_no<10){
            $job_order_code_view='C/JO/000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $job_order_code_view='C/JO/00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $job_order_code_view='C/JO/0'.$voucher_no;
            }
            else{
              $job_order_code_view='C/JO/'.$voucher_no;
            }
            //print_r($job_order_code_view);exit;
            $data['job_order_code_view']=$job_order_code_view;
            $data['plants'] = $this->job_order_model->getPlants();
            $data['workers'] = $this->job_order_model->getWorkers();
			//print_r($data['departments']);exit;
			$this->template->load('template','job_order_add',$data);
	}
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->job_order_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

	        if (isset($result['voucher_code']) && $result['voucher_code']) :
	            $data['joborder_code'] = $result['voucher_code'];
	        else:
	            $data['joborder_code'] = '';
	        endif;
			if (isset($result['job_order_no'])) :
	            $data['job_order_code_view'] = $result['job_order_no'];
	        else:
	            $data['job_order_code_view'] = '';
	        endif;

	        if (isset($result['transaction_date']) && $result['transaction_date']) :
	            $data['transaction_date'] = $result['transaction_date'];
	       else:
	            $data['transaction_date'] = '';
	        endif;
	       
	       if (isset($result['location'])) :
	            $data['location'] = $result['location'];
	       else:
	            $data['location'] = '';
	        endif;
	        if (isset($result['work_description'])) :
	            $data['work_description'] = $result['work_description'];
	       else:
	            $data['work_description'] = '';
	        endif;
	        if (isset($result['assigned_to'])) :
	            $data['assigned_to'] = $result['assigned_to'];
	       else:
	            $data['assigned_to'] = '';
	        endif;
	         if (isset($result['job_order_status'])) :
	            $data['job_order_status'] = $result['job_order_status'];
	       else:
	            $data['job_order_status'] = '';
	        endif;
	        if (isset($result['completion_date'])) :
	        	if($result['completion_date']=='0000-00-00'){
	        		$data['completion_date'] = date('Y-m-d');
	        	}else{
	        		$data['completion_date'] = $result['completion_date'];
	        	}
	        endif;  
			$data['title'] = 'Edit Job Order';
			 $data['plants'] = $this->job_order_model->getPlants();
			$data['workers'] = $this->job_order_model->getWorkers();
			//print_r($data['departments']);exit;
			$this->template->load('template','job_order_edit',$data);
	}


	public function report() 
		{
			$data['title'] = 'Job Order Records';
			if($this->input->get())
			{
				 $conditions['job_order_no']=$this->input->get('job_order_no');
				 //$conditions['department_id']=$this->input->get('department_id');
				//  $conditions['approved_status']=$this->input->get('approved_status');
				 $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				 $data['conditions']=$conditions;
				 //print_r($data['conditions']);exit;
			   $data['requisition_data'] = $this->job_order_model->getAllReqList($conditions);
	
			}
			else{
				$data['requisition_data'] = $this->job_order_model->getAllReqList();
			}
	
			
			$data['workers'] = $this->job_order_model->getWorkers();
			$data['departments'] = $this->job_order_model->getDepartments();
			$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
			//echo var_dump($data);
			$this->template->load('template','job_order_report',$data);
		}
	
	public function add_new_record() {

		$this->form_validation->set_rules('job_order_no', 'job_order_no', 'required');
	
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			redirect('/Job_orders/add');
			}else{
			$this->load->view('login_form');
			}
		}
		else 
		{
	        $loginId=$this->session->userdata['logged_in']['id'];
	  		
			$data = array(
			'job_order_no' => $this->input->post('job_order_no'),
			'voucher_code' => $this->input->post('voucher_code'),
			'location' => $this->input->post('location'),
			'work_description' => $this->input->post('work_description'),
			'assigned_to' => $this->input->post('assigned_to'),
			'job_order_status' => 'Pending',
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'reported_by' => $loginId,
			'created_by' => $loginId,
			);

			$result = $this->job_order_model->jobcard_insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Job Card Created Successfully !');
			redirect('/Job_orders/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Job Card insertion failed!');
			redirect('/Job_orders/index', 'refresh');
			}
		} 
	}

	public function editrecord($id) {
		$this->form_validation->set_rules('job_order_no', 'job_order_no ', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->add();
			}else{
			$this->load->view('login_form');
			}
		}
		else 
		{
			$loginId=$this->session->userdata['logged_in']['id'];

			$data = array(
			'job_order_no' => $this->input->post('job_order_no'),
			'voucher_code' => $this->input->post('voucher_code'),
			'location' => $this->input->post('location'),
			'work_description' => $this->input->post('work_description'),
			'assigned_to' => $this->input->post('assigned_to'),
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'completion_date' => date('Y-m-d',strtotime($this->input->post('completion_date'))),
			'job_order_status' => $this->input->post('job_order_status'),
			'reported_by' => $loginId,
			'edited_by' => $loginId,
			);
			$result = $this->job_order_model->job_order_update($data,$id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Job Order Updated Successfully !');
			redirect('/Job_orders/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Job Order details !');
			redirect('/Job_orders/index', 'refresh');
			}
		} 
	}
	public function deleteRecord($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->job_order_model->deleteRecord($id);
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'All Selected Job Orders deleted Successfully !');
			}else{
  	 		$id = $this->uri->segment('3');
  	 		$this->job_order_model->deleteRecord($id);
  	 		$this->session->set_flashdata('success', 'Job Order deleted Successfully !');
  	 		redirect('/Job_orders/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 		}

		}

	}

?>