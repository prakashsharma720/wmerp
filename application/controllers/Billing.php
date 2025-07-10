<?php

//session_start(); //we need to start session in order to access it through CI

Class Billing extends MY_Controller {

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
//$this->load->model('Billing_model');
$this->load->model('Billing_model');
// $this->load->model('notifications_model');
//$this->load->library('excel');
}

// Show login page
public function create() {
	//echo date('Y-m-d H:i A');exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	$data['suppliers']=$this->Billing_model->getSuppliers();
	$data['invoice_code'] = $this->Billing_model->getRequisitionCode();
	//print_r($data['rs_code']);exit;
	$voucher_no= $data['invoice_code'];
    if($voucher_no<10){
    $rs_id_code='SN000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='SN00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='SN0'.$voucher_no;
    }
    else{
      $rs_id_code='SN'.$voucher_no;
    }
    $data['invoice_code_view']=$rs_id_code;
	$data['items']=$this->Billing_model->getItems();
	// $data['categories']=$this->Billing_model->getCategories();
	// $data['fg_minerals']=$this->Billing_model->getFGmineralsList();

	//$data['grades']=$this->Billing_model->getGrades();
	//$data['states']=$this->Billing_model->getStates();
	
		$data['title']='Create New Billing';
		$this->template->load('template','billing_create',$data);	

	//$this->load->view('footer');
	
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	//$role_id=$this->session->userdata['logged_in']['role_id'];
	//echo $role_id;exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	$result = $this->Billing_model->getById($id);
	//print_r($result);exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = date('d-m-Y',strtotime($result[0]['transaction_date']));
    else:
        $data['transaction_date'] = '';
    endif; 
    if (isset($result[0]['invoice_code'])) :
        $data['invoice_code'] = $result[0]['invoice_code'];
		$voucher_no =$data['invoice_code'];
	    if($voucher_no<10){
	    $rs_id_code='SN000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='SN00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='SN0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='SN'.$voucher_no;
	    }
	    $data['invoice_code_view']=$rs_id_code;

    else:
        $data['invoice_code_view'] = '';
    endif;

    if (isset($result[0]['comment'])) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
    if (isset($result[0]['supplier_id'])) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;

    if (isset($result[0]['total_qty'])) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;
     if (isset($result[0]['total_amount_footer'])) :
        $data['total_amount_footer'] = $result[0]['total_amount_footer'];
    else:
        $data['total_amount_footer'] = '';
    endif; 
    if (isset($result[0]['type_of_tax'])) :
        $data['type_of_tax'] = $result[0]['type_of_tax'];
    else:
        $data['type_of_tax'] = '';
    endif;
    if (isset($result[0]['texable_amount'])) :
        $data['texable_amount'] = $result[0]['texable_amount'];
    else:
        $data['texable_amount'] = '';
    endif;
    if (isset($result[0]['tax_per_igst'])) :
        $data['tax_per_igst'] = $result[0]['tax_per_igst'];
    else:
        $data['tax_per_igst'] = '';
    endif;
    if (isset($result[0]['igst_amount'])) :
        $data['igst_amount'] = $result[0]['igst_amount'];
    else:
        $data['igst_amount'] = '';
    endif;
    if (isset($result[0]['grand_total_after_igst'])) :
        $data['grand_total_after_igst'] = $result[0]['grand_total_after_igst'];
    else:
        $data['grand_total_after_igst'] = '';
    endif;
    if (isset($result[0]['cgst_per'])) :
        $data['cgst_per'] = $result[0]['cgst_per'];
    else:
        $data['cgst_per'] = '';
    endif;
      if (isset($result[0]['cgst_amount'])) :
        $data['cgst_amount'] = $result[0]['cgst_amount'];
    else:
        $data['cgst_amount'] = '';
    endif;
      if (isset($result[0]['amount_after_cgst'])) :
        $data['amount_after_cgst'] = $result[0]['amount_after_cgst'];
    else:
        $data['amount_after_cgst'] = '';
    endif;
    if (isset($result[0]['sgst_per'])) :
        $data['sgst_per'] = $result[0]['sgst_per'];
    else:
        $data['sgst_per'] = '';
    endif;
      if (isset($result[0]['sgst_amount'])) :
        $data['sgst_amount'] = $result[0]['sgst_amount'];
    else:
        $data['sgst_amount'] = '';
    endif;
    if (isset($result[0]['amount_after_sgst'])) :
        $data['amount_after_sgst'] = $result[0]['amount_after_sgst'];
    else:
        $data['amount_after_sgst'] = '';
    endif; 
    if (isset($result[0]['final_total_amount'])) :
        $data['final_total_amount'] = $result[0]['final_total_amount'];
    else:
        $data['final_total_amount'] = '';
    endif;
    if (isset($result[0]['round_off'])) :
        $data['round_off'] = $result[0]['round_off'];
    else:
        $data['round_off'] = '';
    endif;
    if (isset($result[0]['grand_total'])) :
        $data['grand_total'] = $result[0]['grand_total'];
    else:
        $data['grand_total'] = '';
    endif;
    if (isset($result[0]['comment'])) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
  
    
     if (isset($result[0]['billing_details'])) :
        $data['billing_details'] = $result[0]['billing_details'];
    else:
        $data['billing_details'] = '';
    endif;
	//$data['suppliers']=$this->Billing_model->getSuppliers();
	$data['items']=$this->Billing_model->getItems();
	$data['suppliers']=$this->Billing_model->getSuppliers();
	
	
	$data['title']='Edit Bill ';
	$this->template->load('template','billing_edit',$data);
	
	}

	public function index(){
			$data['title']=' Billing List';
			//$data['suppliers']=$this->Billing_model->getSuppliers();
			//$data['Items']=$this->Billing_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			//$department_id=$this->session->userdata['logged_in']['department_id'];
			if($this->input->get())
			{
			 	$conditions['supplier_id']=$this->input->get('supplier_id');
			 	$conditions['categories_id']=$this->input->get('categories_id');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;
	           $data['biilings'] = $this->Billing_model->list_by_filter($conditions);

			}

			$data['biilings']=$this->Billing_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->Billing_model->getStates();
			$this->template->load('template','billing_view',$data);
		}

	
	public function report() 
	{
		$data['title'] = 'Requisition Slip Report';
		if($this->input->get())
		{
		 	$conditions['employee_id']=$this->input->get('employee_id');
		 	$conditions['department_id']=$this->input->get('department_id');
		 	$conditions['approved_status']=$this->input->get('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
		 	//print_r($data['conditions']);exit;
           $data['requisition_data'] = $this->Billing_model->getAllReqList($conditions);

		}
		else{
			$data['requisition_data'] = $this->Billing_model->getAllReqList();
		}

		
		$data['employees'] = $this->Billing_model->getEmployees();
		$data['departments'] = $this->Billing_model->getDepartments();
		$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
		//echo var_dump($data['students']);
		$this->template->load('template','requisition_report',$data);
	}

	public function add_new_record() {
	/*	echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('products[]', 'Product ', 'required');
		$voucher_no='0';
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
			$voucher_no = $this->Billing_model->getRequisitionCode();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			if($role_id=='4'){
				$store_rs='1';
			}else{
				$store_rs='0';
			}
			// $department_id=$this->session->userdata['logged_in']['department_id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'invoice_code' => $this->input->post('invoice_code'),
			'supplier_id' => $this->input->post('supplier_id'),
			'total_qty' => $this->input->post('total_qty'),
			'total_amount_footer' => $this->input->post('total_amount_footer'),
			'texable_amount' => $this->input->post('texable_amount'),
			'type_of_tax' => $this->input->post('type_of_tax'),
			'tax_per_igst' => $this->input->post('tax_per_igst'),
			'igst_amount' => $this->input->post('igst_amount'),
			'grand_total_after_igst' => $this->input->post('grand_total_after_igst'),
			'cgst_per' => $this->input->post('tax_per_cgst'),
			'cgst_amount' => $this->input->post('cgst_amount'),
			'amount_after_cgst' => $this->input->post('grand_total_after_cgst'),
			'sgst_per' => $this->input->post('tax_per_sgst'),
			'sgst_amount' => $this->input->post('sgst_amount'),
			'amount_after_sgst' => $this->input->post('grand_total_after_sgst'),
			'final_total_amount' => $this->input->post('final_total_amount'),
			'round_off' => $this->input->post('round_off'),
			'grand_total' => $this->input->post('grand_total'),
			'comment' => $this->input->post('comment'),
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->Billing_model->data_insert($data);
			if ($result == TRUE) {
			// 	$data1 = array(
			// 	'type' => 'Requisition Slip',
			// 	'subject' => 'Requisition Creation',
			// 	'message' => 'created a requisition slip',
			// 	'page_url' => 'Requisition_slips/approval',
			// 	'status' => '0',
			// 	'datetime' => date('Y-m-d h:i:s'),
			// 	'created_by' => $login_id,
			// );
			// $result1 = $this->notifications_model->add_notification($data1);
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Billing/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Billing/index', 'refresh');
			}
		}
	}

	public function edit_record($id){

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
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			if($role_id=='4'){
				$store_rs='1';
			}else{
				$store_rs='0';
			}
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'invoice_code' => $this->input->post('invoice_code'),
			'supplier_id' => $this->input->post('supplier_id'),
			'total_qty' => $this->input->post('total_qty'),
			'total_amount_footer' => $this->input->post('total_amount_footer'),
			'texable_amount' => $this->input->post('texable_amount'),
			'type_of_tax' => $this->input->post('type_of_tax'),
			'tax_per_igst' => $this->input->post('tax_per_igst'),
			'igst_amount' => $this->input->post('igst_amount'),
			'grand_total_after_igst' => $this->input->post('grand_total_after_igst'),
			'cgst_per' => $this->input->post('tax_per_cgst'),
			'cgst_amount' => $this->input->post('cgst_amount'),
			'amount_after_cgst' => $this->input->post('grand_total_after_cgst'),
			'sgst_per' => $this->input->post('tax_per_sgst'),
			'sgst_amount' => $this->input->post('sgst_amount'),
			'amount_after_sgst' => $this->input->post('grand_total_after_sgst'),
			'final_total_amount' => $this->input->post('final_total_amount'),
			'round_off' => $this->input->post('round_off'),
			'grand_total' => $this->input->post('grand_total'),
			'comment' => $this->input->post('comment'),
			'edited_by' => $login_id
			);
			$old_id = $this->input->post('billing_id_old'); 
			//print_r($data);exit;
			$result = $this->Billing_model->editBilling($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Billing/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Bill !');
			redirect('/Billing/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}
	public function approval(){
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$data['title']=' Pending Requisition Slips for Action';
			$data['requisition_data']=$this->Billing_model->getRSListforApproval();
			if($role_id=='4'){
				$this->template->load('template','requisition_approval',$data);
			}else{
				$this->template->load('template','requisition_approval_admin',$data);
			}
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->Billing_model->getStates();
		}

	public function ActionRequisition()
	{
		$role_id=$this->session->userdata['logged_in']['role_id'];
		
		$login_id=$this->session->userdata['logged_in']['id'];
		$requisition_id=$this->input->post('requisition_id');
		$employee_id=$this->input->post('employee_id');
		$status=$this->input->post('status');
		if($status=='Rejected'){
			$data = array(
			'approved_status' => 'Rejected',
			//'rejected_date' =>$this->input->post('rejected_date'),
			'rejected_date' =>date('Y-m-d H:i:s'),
			'rejected_reason' => $this->input->post('rejected_reason'),
			'rejected_by' => $login_id
			);
			$result = $this->Billing_model->actionRequisition($data,$requisition_id);
			if ($result == TRUE) {

			$data1 = array(
			'type' => 'Requisition Slip',
			'subject' => 'Requisition Rejected',
			'employee_id' => $employee_id,
			'message' => ' rejected requisition slip of ',
			'page_url' => 'Requisition_slips/index',
			'status' => '0',
			'datetime' => date('Y-m-d h:i:s'),
			'created_by' => $login_id,
			);

			$result1 = $this->notifications_model->add_notification($data1);
			$this->session->set_flashdata('success', 'Requisition slip rejected successfully !');
			redirect('/Billing/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect('/Billing/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
		if($status=='Approved'){
			$data = array(
			'approved_status' => 'Approved',
			'approved_date' =>$this->input->post('approved_date'),
			'approved_on' =>date('Y-m-d H:i:s'),
			'approve_comment' => $this->input->post('approve_comment'),
			'approved_by' => $login_id
			);
			$result = $this->Billing_model->actionRequisition($data,$requisition_id);
			if ($result == TRUE) {
			$data1 = array(
			'type' => 'Requisition Slip',
			'subject' => 'Requisition Approved',
			'employee_id' => $employee_id,
			'message' => ' approved requisition slip of ',
			'page_url' => 'Requisition_slips/index',
			'status' => '0',
			'datetime' => date('Y-m-d h:i:s'),
			'created_by' => $login_id,
			);
			$result1 = $this->notifications_model->add_notification($data1);
			$this->session->set_flashdata('success', 'Requisition slip approved successfully !');
			redirect('/Billing/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect('/Billing/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
			
			/*else if($role_id=='1')
			{
				$login_id=$this->session->userdata['logged_in']['id'];
				$requisition_id=$this->input->post('requisition_id');
				$status=$this->input->post('status');
				if($status=='Rejected'){
					$data = array(
					'admin_approve_status' => 'Rejected',
					'admin_action_date' =>$this->input->post('rejected_date'),
					'admin_action_remark' => $this->input->post('rejected_reason'),
					'admin_id' => $login_id
					);
					$result = $this->Billing_model->actionRequisition($data,$requisition_id);
					if ($result == TRUE) {

					$this->session->set_flashdata('success', 'Requisition slip rejected successfully !');
					redirect('/Billing/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					} else {
					$this->session->set_flashdata('failed', 'Operation Failed !');
					redirect('/Billing/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					}
				}
				if($status=='Approved'){
					$data = array(
					'admin_approve_status' => 'Approved',
					'admin_action_date' =>$this->input->post('approved_date'),
					'admin_action_remark' => $this->input->post('approve_comment'),
					'admin_id' => $login_id
					);
					$result = $this->Billing_model->actionRequisition($data,$requisition_id);
					if ($result == TRUE) {

					$this->session->set_flashdata('success', 'Requisition slip approved successfully !');
					redirect('/Billing/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					} else {
					$this->session->set_flashdata('failed', 'Operation Failed !');
					redirect('/Billing/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					}
				}

			}*/
	}
	public function deleteRecord($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->Billing_model->deleteRecord($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Record deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->Billing_model->deleteRecord($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Record deleted Successfully !');
			redirect('/Billing/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Billing/index', 'refresh');
			}
  	 	}
  	 }
  // 	  public function print($id) { 
		
		// $id = $this->uri->segment('3');
		// //echo $id;exit;
		// $data['current'] = $this->Billing_model->getById($id);
		// //print_r($data['current']);exit;
	 //    $data['title']='Requisition Slip Print View';
  //       $this->template->load('template','requisition_print',$data);
  //   } 
     function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xlsx';
       	$fileName ='data-'.time().'.xlsx';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['employee_id']=$this->input->post('employee_id');
		 	$conditions['department_id']=$this->input->post('department_id');
		 	$conditions['approved_status']=$this->input->post('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->Billing_model->getAllReqList($conditions);
		}
		else
		{
			$reqSlipInfo = $this->Billing_model->getAllReqList();
		}
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Requisition No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Registration Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Employee Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Status');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Approved By');      
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Material Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Request Quantity');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Issue Quantity');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Unit');       
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
        	
        	foreach ($element['requisition_details'] as $element2) {
        		$voucher_no=$element['requisition_slip_no'];
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

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rs_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['requestor']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['approved_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['approver']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['material_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element2['issue_qty']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['unit']);	
            $rowCount++;
        	}
        }
       // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="requisitionData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Billing/report', 'refresh');     
    }
    function convert_number_to_words($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        100000             => 'lakh',
        10000000          => 'crore'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . $this->convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        case $number < 100000:
            $thousands   = ((int) ($number / 1000));
            $remainder = $number % 1000;

            $thousands = $this->convert_number_to_words($thousands);

            $string .= $thousands . ' ' . $dictionary[1000];
            if ($remainder) {
                $string .= $separator . $this->convert_number_to_words($remainder);
            }
            break;
        case $number < 10000000:
            $lakhs   = ((int) ($number / 100000));
            $remainder = $number % 100000;

            $lakhs = $this->convert_number_to_words($lakhs);

            $string = $lakhs . ' ' . $dictionary[100000];
            if ($remainder) {
                $string .= $separator . $this->convert_number_to_words($remainder);
            }
            break;
        case $number < 1000000000:
            $crores   = ((int) ($number / 10000000));
            $remainder = $number % 10000000;

            $crores = $this->convert_number_to_words($crores);

            $string = $crores . ' ' . $dictionary[10000000];
            if ($remainder) {
                $string .= $separator . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

    public function print($id){
    $this->load->library('dompdf');
    
    $data = array();
    $data['title']='TAX INVOICE';
    $data['invoice_data'] = $this->Billing_model->getById($id);
    //print_r();exit;
    $voucher_no=$data['invoice_data']['0']['invoice_code'];
    if($voucher_no<10){
    $invoice_code='SN000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $invoice_code='SN00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $invoice_code='SN0'.$voucher_no;
    }
    else{
      $invoice_code='SN'.$voucher_no;
    }
    $data['invoice_no']=$invoice_code;
  
    $grand_total=$data['invoice_data']['0']['grand_total'];
    $data['amount_in_words']=$this->convert_number_to_words(round($grand_total));   
    // //print_r($data['invoice_data']);exit;
	$html = $this->load->view('bill_print', $data, true);
    $this->dompdf->createPDF($html, 'mypdf', false);
    //$this->template->load('template','bill_print',$data);
    }



}

?>