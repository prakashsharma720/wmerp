<?php

//session_start(); //we need to start session in order to access it through CI

Class Issue_slips extends MY_Controller {

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

//$this->load->library('encryption');

// Load session library
$this->load->library('session');


$this->load->library('template');

// Load database
//$this->load->model('issue_slip_model');
$this->load->model('issue_slip_model');
$this->load->model('notifications_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['title']='Pending Requisition Slips for Issue';
	$this->load->model('requisition_slip_model');
	$data['requisition_data']=$this->requisition_slip_model->getRSListForIssueSlip();
	/*$data['employees']=$this->issue_slip_model->getEmployees();
	$data['items']=$this->issue_slip_model->getItems();	
	//$data['departments'] = $this->issue_slip_model->getDepartments();
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();*/
	$this->template->load('layout/template','issue_add',$data);

	//$this->load->view('footer');
	
	}

	public function CreateIssueSlip($id=NULL) {
	$id=$this->uri->segment('3');	
	//print_r($id);exit;
	$data = array();
	$data['title']='Create Issue Slip';
	//$idd='41';
	//$qty = $this->issue_slip_model->getRequisitionQty($idd);
	//print_r($qty['pending_qty']);exit;
	$data['issue_slip_no'] = $this->issue_slip_model->getIssueSlipCode();
	$voucher_no= $data['issue_slip_no'];
    if($voucher_no<10){
    $rs_id_code='IS000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='IS00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='IS0'.$voucher_no;
    }
    else{
      $rs_id_code='IS'.$voucher_no;
    }
    $data['issueslip_code']=$rs_id_code;
	$this->load->model('requisition_slip_model');
	$result = $this->requisition_slip_model->getByIdForIssueSlip($id);
	//echo "<pre>";print_r($result);exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['req_id'] = $result[0]['id'];
    else:
        $data['req_id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['requisition_date'] = $result[0]['transaction_date'];
    else:
        $data['requisition_date'] = '';
    endif; 
    if (isset($result[0]['requisition_slip_no']) && $result[0]['requisition_slip_no']) :
        $data['requisition_slip_no'] = $result[0]['requisition_slip_no'];
		$voucher_no =$data['requisition_slip_no'];
	    if($voucher_no<10){
	    $rs_id_code='RS000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='RS00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='RS0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='RS'.$voucher_no;
	    }
	    $data['requisition_code']=$rs_id_code;
    else:
        $data['requisition_slip_no'] = '';
    endif;

    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
    if (isset($result[0]['rs_for']) && $result[0]['rs_for']) :
        $data['rs_for'] = $result[0]['rs_for'];
    else:
        $data['rs_for'] = '';
    endif;

     if (isset($result[0]['finish_good_id']) && $result[0]['finish_good_id']) :
        $data['finish_good_id'] = $result[0]['finish_good_id'];
    else:
        $data['finish_good_id'] = '';
    endif;

     if (isset($result[0]['batch_no']) && $result[0]['batch_no']) :
        $data['batch_no'] = $result[0]['batch_no'];
    else:
        $data['batch_no'] = '';
    endif;

     if (isset($result[0]['lot_no']) && $result[0]['lot_no']) :
        $data['lot_no'] = $result[0]['lot_no'];
    else:
        $data['lot_no'] = '';
    endif;
    if (isset($result[0]['equipment_name']) && $result[0]['equipment_name']) :
        $data['equipment_name'] = $result[0]['equipment_name'];
    else:
        $data['equipment_name'] = '';
    endif;
    if (isset($result[0]['purpose']) && $result[0]['purpose']) :
        $data['purpose'] = $result[0]['purpose'];
    else:
        $data['purpose'] = '';
    endif;
      if (isset($result[0]['created_by']) && $result[0]['created_by']) :
        $data['employee_id'] = $result[0]['created_by'];
    else:
        $data['employee_id'] = '';
    endif;

    if (isset($result[0]['pending_qty']) && $result[0]['pending_qty']) :
        $data['total_req_qty'] = $result[0]['pending_qty'];
    else:
        $data['total_req_qty'] = '';
    endif;
     if (isset($result[0]['department_id']) && $result[0]['department_id']) :
        $data['department_id'] = $result[0]['department_id'];
    else:
        $data['department_id'] = '';
    endif;
    
     if (isset($result[0]['requisition_details']) && $result[0]['requisition_details']) :
        $data['requisition_details'] = $result[0]['requisition_details'];
    else:
        $data['requisition_details'] = '';
    endif;

	$data['employees']=$this->issue_slip_model->getEmployees();
	$data['items']=$this->issue_slip_model->getItems();	
	$data['departments'] = $this->issue_slip_model->getDepartments();
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();
	$this->template->load('template','create_issue_slip',$data);

	//$this->load->view('footer');
	
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
	$result = $this->issue_slip_model->getById($id);
	//print_r();exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = '';
    endif; 
    if (isset($result[0]['issue_slip_no']) && $result[0]['issue_slip_no']) :
        $data['issue_slip_no'] = $result[0]['issue_slip_no'];
    else:
        $data['issue_slip_no'] = '';
    endif;
    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;

    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;
     if (isset($result[0]['employee_id']) && $result[0]['employee_id']) :
        $data['employee_id'] = $result[0]['employee_id'];
    else:
        $data['employee_id'] = '';
    endif;
    
     if (isset($result[0]['issue_details']) && $result[0]['issue_details']) :
        $data['issue_details'] = $result[0]['issue_details'];
    else:
        $data['issue_details'] = '';
    endif;


	$data['title']='Create Issue Slip';
	$data['employees']=$this->issue_slip_model->getEmployees();
	$data['items']=$this->issue_slip_model->getItems();
	//$data['grades']=$this->issue_slip_model->getGrades();
	//$data['states']=$this->issue_slip_model->getStates();
	$this->template->load('template','issue_edit',$data);
	//$this->load->view('footer');
	
	}

	public function index(){
			$data['title']=' Issue Slip List';
			//$data['suppliers']=$this->issue_slip_model->getSuppliers();
			//$data['Items']=$this->issue_slip_model->getItems();
			$data['issue_data']=$this->issue_slip_model->getList();
			//$data['states']=$this->issue_slip_model->getStates();
			$this->template->load('layout/template','issue_view',$data);
		}

	public function report() 
	{
		$data['title'] = 'Issue Slip Report';
		$data['suppliers'] = $this->issue_slip_model->supplier_list();
		//echo var_dump($data['students']);
		$this->template->load('template','supplier_report',$data);
	}

	public function add_new_issue() {
		$this->form_validation->set_rules('item_id[]', 'Product ', 'required');
	
		$total_pending_qty=$this->input->post('total_pending_qty');
        $requisition_id_old=$this->input->post('requisition_id_old');
       //print_r($total_pending_qty);exit;
        if($total_pending_qty=='0.00'){
            $this->issue_slip_model->updateIssueCompleted($requisition_id_old);
        }

		$voucher_no='0';
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
			
			$login_id=$this->session->userdata['logged_in']['id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'issue_slip_no' => $this->input->post('issue_slip_no'),
			'requisition_slip_id' => $this->input->post('requisition_id_old'),
			'employee_id' => $this->input->post('employee_id'),
			'department_id' => $this->input->post('department_id'),
			'total_req_qty' => $this->input->post('total_req_qty'),
			'total_issue_qty' => $this->input->post('total_issue_qty'),
			'total_pending_qty' => $this->input->post('total_pending_qty'),
			'comment' => $this->input->post('comment'),
			/*'issue_complete' => $issue_complete,*/
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->issue_slip_model->issue_insert($data);
			if ($result == TRUE) {
				$data1 = array(
				'type' => 'Issue Slip',
				'subject' => 'Issue Creation',
				'message' => 'created a issue slip for',
				'page_url' => 'Issue_slips/index',
				'status' => '0',
				'datetime' => date('Y-m-d h:i:s'),
				'created_by' => $login_id,
				);
			$result1 = $this->notifications_model->add_notification($data1);

			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Issue_slips/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Issue_slips/index', 'refresh');
			}
		}
	}

	public function edit_issue($id){
		$this->form_validation->set_rules('products[]', 'Product ', 'required');
		$products=$this->input->post('products');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
				$this->add($id);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_edit');
		} 
		else 
		{
			
			$login_id=$this->session->userdata['logged_in']['id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			//'issue_slip_no' => $voucher_no,
			'employee_id' => $this->input->post('employee_id'),
			'total_qty' => $this->input->post('total_qty'),
			'comment' => $this->input->post('comment'),
			'edited_by' => $login_id
			);
			$old_id = $this->input->post('issue_id_old'); 
			//print_r($data);exit;
			$result = $this->issue_slip_model->editissue($data,$old_id);
			if ($result == TRUE) {
				$data1 = array(
				'type' => 'Issue Slip',
				'subject' => 'Issue Creation',
				'message' => 'Updated a issue slip for',
				'page_url' => 'Issue_slips/index',
				'status' => '0',
				'datetime' => date('Y-m-d h:i:s'),
				'created_by' => $login_id,
				);
			$result1 = $this->notifications_model->add_notification($data1);
			

			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Issue_slips/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in issue Slip!');
			redirect('/Issue_slips/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}

	public function deleteissue($id= null)
	{
  	 		
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->issue_slip_model->deleteissue($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Issue Slips deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->issue_slip_model->deleteissue($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Issue Slip deleted Successfully !');
			redirect('/Issue_slips/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Issue_slips/index', 'refresh');
  	 		}
  	 	}
  	 
	}
	
	 public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->issue_slip_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Issue Slip Profile';
        $this->template->load('template','issue_print',$data);
    } 
}

?>