<?php

//session_start(); //we need to start session in order to access it through CI

Class Requisition_slips extends CI_Controller {

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
//$this->load->model('requisition_slip_model');
$this->load->model('requisition_slip_model');
$this->load->model('notifications_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	//echo date('Y-m-d H:i A');exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->requisition_slip_model->getSuppliers();
	$data['rs_code'] = $this->requisition_slip_model->getRequisitionCode();
	//print_r($data['rs_code']);exit;
	$voucher_no= $data['rs_code'];
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
	$data['items']=$this->requisition_slip_model->getItems();
	$data['categories']=$this->requisition_slip_model->getCategories();
	$data['fg_minerals']=$this->requisition_slip_model->getFGmineralsList();
	$data['fg_grades']=$this->requisition_slip_model->getFGgradesList();
	$data['departments'] = $this->requisition_slip_model->getDepartments();
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4','General Item'=>'General Item');
	
	//$data['grades']=$this->requisition_slip_model->getGrades();
	//$data['states']=$this->requisition_slip_model->getStates();
	if($role_id=='4'){
		$data['title']=' Create Store Requisition Slip';
		//$data['requisitions']=$this->requisition_slip_model->getStoreApprovedRequisitions();
		//print_r($data['requisitions']);exit;
		$this->template->load('template','requisition_add_store',$data);
	}else{
		$data['title']='Create Requisition Slip';
		$this->template->load('template','requisition_add',$data);
	}
	

	//$this->load->view('footer');
	
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	//$role_id=$this->session->userdata['logged_in']['role_id'];
	//echo $role_id;exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	$result = $this->requisition_slip_model->getById($id);
	//print_r($result);exit;

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

    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
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


	//$data['suppliers']=$this->requisition_slip_model->getSuppliers();
	$data['items']=$this->requisition_slip_model->getItems();
	$data['categories']=$this->requisition_slip_model->getCategories();
	$data['fg_minerals']=$this->requisition_slip_model->getFGmineralsList();
	$data['fg_grades']=$this->requisition_slip_model->getFGgradesList();
	$data['departments'] = $this->requisition_slip_model->getDepartments();
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4','General Item'=>'General Item');
	//$data['grades']=$this->requisition_slip_model->getGrades();
	//$data['states']=$this->requisition_slip_model->getStates();
	if($role_id=='4'){
		$data['title']=' Edit Store Requisition Slip';
		$this->template->load('template','requisition_edit_store',$data);
	}else{
		$data['title']='Edit Requisition Slip';
		$this->template->load('template','requisition_edit',$data);
	}

	

	//$this->load->view('footer');
	
	}

	public function index(){
			$data['title']=' Requisition Slip List';
			//$data['suppliers']=$this->requisition_slip_model->getSuppliers();
			//$data['Items']=$this->requisition_slip_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			if($this->input->get())
			{
			 	$conditions['customer_id']=$this->input->get('customer_id');
			 	$conditions['categories_id']=$this->input->get('categories_id');
			 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;
	           $data['customers'] = $this->requisition_slip_model->requisition_list_by_filter($conditions);

			}

			$data['requisition_data']=$this->requisition_slip_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->requisition_slip_model->getStates();
			$this->template->load('template','requisition_view',$data);
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
           $data['requisition_data'] = $this->requisition_slip_model->getAllReqList($conditions);

		}
		else{
			$data['requisition_data'] = $this->requisition_slip_model->getAllReqList();
		}

		
		$data['employees'] = $this->requisition_slip_model->getEmployees();
		$data['departments'] = $this->requisition_slip_model->getDepartments();
		$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
		//echo var_dump($data['students']);
		$this->template->load('template','requisition_report',$data);
	}

	public function add_new_requisition() {
	/*	echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('products[]', 'Product ', 'required');
		/*$this->form_validation->set_rules('quotation_no', 'Quatation No', 'required');
		$this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
		$this->form_validation->set_rules('products[]', 'Product', 'required');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('rm_code', 'RM Code', 'required');*/
		//$products=[];
		//$products=$this->input->post('products');
		/*$grade=$this->input->post('grade');
		$qty=$this->input->post('qty');
		$rate=$this->input->post('rate');
		$total=$this->input->post('total');*/
		//print_r($products);exit;
		/*$rs_for=$this->input->post('rs_for');
		if($rs_for=='Raw Material'){

		}else if($rs_for=='Packing Material'){

		}else{

		}*/
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
			$voucher_no = $this->requisition_slip_model->getRequisitionCode();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			if($role_id=='4'){
				$store_rs='1';
			}else{
				$store_rs='0';
			}
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'requisition_slip_no' => $this->input->post('requisition_slip_no'),
			'total_qty' => $this->input->post('total_qty'),
			'rs_for' => $this->input->post('rs_for'),
			'finish_good_id' => $this->input->post('finish_good_id'),
			//'grade_id' => $this->input->post('grade_id'),
			'lot_no' => $this->input->post('lot_no'),
			'batch_no' => $this->input->post('batch_no'),
			'department_id' => $department_id,
			'equipment_name' => $this->input->post('equipment_name'),	
			'purpose' => $this->input->post('purpose'),	
			'comment' => $this->input->post('comment'),
			'store_rs' => $store_rs,
			'created_by' => $login_id,
			'employee_id' => $login_id
			);
			//print_r($data);exit;
			$result = $this->requisition_slip_model->requisition_insert($data);
			if ($result == TRUE) {
				$data1 = array(
				'type' => 'Requisition Slip',
				'subject' => 'Requisition Creation',
				'message' => 'created a requisition slip',
				'page_url' => 'Requisition_slips/approval',
				'status' => '0',
				'datetime' => date('Y-m-d h:i:s'),
				'created_by' => $login_id,
			);
			$result1 = $this->notifications_model->add_notification($data1);
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Requisition_slips/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Requisition_slips/index', 'refresh');
			}
		}
	}

	public function edit_requisition($id){

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
			'requisition_slip_no' => $this->input->post('requisition_slip_no'),
			'total_qty' => $this->input->post('total_qty'),
			'rs_for' => $this->input->post('rs_for'),
			'finish_good_id' => $this->input->post('finish_good_id'),
			//'grade_id' => $this->input->post('grade_id'),
			'lot_no' => $this->input->post('lot_no'),
			'batch_no' => $this->input->post('batch_no'),
			'department_id' => $department_id,
			'equipment_name' => $this->input->post('equipment_name'),	
			'purpose' => $this->input->post('purpose'),	
			'comment' => $this->input->post('comment'),
			'store_rs' => $store_rs,
			'edited_by' => $login_id,
			'employee_id' => $login_id
			);
			$old_id = $this->input->post('requisition_id_old'); 
			//print_r($data);exit;
			$result = $this->requisition_slip_model->editRequisition($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Requisition_slips/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Requisition Slip!');
			redirect('/Requisition_slips/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}
	public function approval(){
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$data['title']=' Pending Requisition Slips for Action';
			$data['requisition_data']=$this->requisition_slip_model->getRSListforApproval();
			if($role_id=='4'){
				$this->template->load('template','requisition_approval',$data);
			}else{
				$this->template->load('template','requisition_approval_admin',$data);
			}
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->requisition_slip_model->getStates();
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
			$result = $this->requisition_slip_model->actionRequisition($data,$requisition_id);
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
			redirect('/Requisition_slips/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect('/Requisition_slips/approval', 'refresh');
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
			$result = $this->requisition_slip_model->actionRequisition($data,$requisition_id);
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
			redirect('/Requisition_slips/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect('/Requisition_slips/approval', 'refresh');
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
					$result = $this->requisition_slip_model->actionRequisition($data,$requisition_id);
					if ($result == TRUE) {

					$this->session->set_flashdata('success', 'Requisition slip rejected successfully !');
					redirect('/Requisition_slips/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					} else {
					$this->session->set_flashdata('failed', 'Operation Failed !');
					redirect('/Requisition_slips/approval', 'refresh');
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
					$result = $this->requisition_slip_model->actionRequisition($data,$requisition_id);
					if ($result == TRUE) {

					$this->session->set_flashdata('success', 'Requisition slip approved successfully !');
					redirect('/Requisition_slips/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					} else {
					$this->session->set_flashdata('failed', 'Operation Failed !');
					redirect('/Requisition_slips/approval', 'refresh');
					//$this->template->load('template','supplier_view');
					}
				}

			}*/
	}
	public function deleteRequisition($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->requisition_slip_model->deleteRequisition($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'RM Codes deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->requisition_slip_model->deleteRequisition($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Requisition Slip deleted Successfully !');
			redirect('/Requisition_slips/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Requisition_slips/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->requisition_slip_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Requisition Slip Print View';
        $this->template->load('template','requisition_print',$data);
    } 
     function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['employee_id']=$this->input->post('employee_id');
		 	$conditions['department_id']=$this->input->post('department_id');
		 	$conditions['approved_status']=$this->input->post('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->requisition_slip_model->getAllReqList($conditions);
		}
		else
		{
			$reqSlipInfo = $this->requisition_slip_model->getAllReqList();
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
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       	$objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="requisitionData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Requisition_slips/report', 'refresh');     
    }

}

?>