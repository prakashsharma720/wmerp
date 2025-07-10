<?php

//session_start(); //we need to start session in order to access it through CI

Class Gir_registers extends MY_Controller {

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
$this->load->library('encryption');

// Load database
//$this->load->model('gir_register_model');
$this->load->model('gir_register_model');
//$this->load->library('excel');
}

// Show login page
public function ApprovedPOlistForGIR() {
    $data = array();
    $data['title']='Pending Purchase Orders for GIR';
    $this->load->model('po_model');
    $po_details=$this->po_model->getListForGIR();
    //print_r($po_details);exit;
    $po_data=[];
    if(!empty($po_details)){
        foreach ($po_details as $key => $value) {
           if($value['po_for']!='Raw Material'){
            $po_data[$key]=$value;
            //print_r($data['po_data']);exit;
            }
            // else
            // {
            //     $po_data[$key]='';
            //     //print_r($data['po_data']);exit;
            // }
        }
        
    }
    //print_r($po_data);exit;
    $data['po_data']=$po_data;
    /*$data['employees']=$this->issue_slip_model->getEmployees();
    $data['items']=$this->issue_slip_model->getItems(); 
    //$data['departments'] = $this->issue_slip_model->getDepartments();
    $this->load->model('gir_register_model');
    $data['units'] = $this->gir_register_model->getUnits();*/
    $this->template->load('template','po_list_for_gir',$data);
}
public function ApprovedPOlistForRM_GIR() {
    $data = array();
    $data['title']='Pending RM Inward Challan for GIR';
    $this->load->model('po_model');
    $po_details=$this->po_model->getListForGIR();
    //print_r($po_data['0']['po_for']);exit;
    $po_data=[];
    if(!empty($po_details)){
        foreach ($po_details as $key => $value) {
           if($value['po_for']=='Raw Material'){
            $po_data[$key]=$value;
            //print_r($data['po_data']);exit;
            }
            // else
            // {
            //     $po_data[$key]='';
            //     //print_r($data['po_data']);exit;
            // }
        }
        
    }
    //print_r($po_data);exit;
    $data['po_data']=$po_data;
    
    /*$data['employees']=$this->issue_slip_model->getEmployees();
    $data['items']=$this->issue_slip_model->getItems(); 
    //$data['departments'] = $this->issue_slip_model->getDepartments();
    $this->load->model('gir_register_model');
    $data['units'] = $this->gir_register_model->getUnits();*/
    $this->template->load('template','po_list_for_rm_gir',$data);
}

public function add($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
    $data['g_no'] = $this->gir_register_model->getGirCode();
	$voucher_no= $data['g_no'];
    if($voucher_no<10){
    $gir_id_code='GIR000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $gir_id_code='GIR00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $gir_id_code='GIR0'.$voucher_no;
    }
    else{
      $gir_id_code='GIR'.$voucher_no;
    }
    //print_r($employee_id_code);exit;
    $data['gir_no']=$gir_id_code;

    $this->load->model('po_model');
    $result = $this->po_model->getById($id);

    if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['po_date'] = $result[0]['transaction_date'];
    else:
        $data['po_date'] = '';
    endif; 
     if (isset($result[0]['quotation_date']) && $result[0]['quotation_date']) :
        $data['quotation_date'] = $result[0]['quotation_date'];
    else:
        $data['quotation_date'] = '';
    endif; 

    if (isset($result[0]['po_number']) && $result[0]['po_number']) :
        $data['po_number'] = $result[0]['po_number'];
    else:
        $data['po_number'] = '';
    endif;

    $voucher_no= $data['po_number'];
    if($voucher_no<10){
    $po_code='CNC/A/000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $po_code='CNC/A/00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $po_code='CNC/A/0'.$voucher_no;
    }
    else{
      $po_code='CNC/A/'.$voucher_no;
    }
    //print_r($employee_id_code);exit;
    $data['po_code_view']=$po_code;

    if (isset($result[0]['quotation_no']) && $result[0]['quotation_no']) :
        $data['quotation_no'] = $result[0]['quotation_no'];
    else:
        $data['quotation_no'] = '';
    endif;

    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;

    if (isset($result[0]['total_amount']) && $result[0]['total_amount']) :
        $data['total_amount'] = $result[0]['total_amount'];
    else:
        $data['total_amount'] = '';
    endif; 
    if (isset($result[0]['discount_type']) && $result[0]['discount_type']) :
        $data['discount_type'] = $result[0]['discount_type'];
    else:
        $data['discount_type'] = '';
    endif; 
    if (isset($result[0]['discount']) && $result[0]['discount']) :
        $data['discount'] = $result[0]['discount'];
    else:
        $data['discount'] = '';
    endif; 
    if (isset($result[0]['discount_amount']) && $result[0]['discount_amount']) :
        $data['discount_amount'] = $result[0]['discount_amount'];
    else:
        $data['discount_amount'] = '';
    endif; 
    if (isset($result[0]['grand_total']) && $result[0]['grand_total']) :
        $data['grand_total'] = $result[0]['grand_total'];
    else:
        $data['grand_total'] = '';
    endif; 
    if (isset($result[0]['gst_amount']) && $result[0]['gst_amount']) :
        $data['gst_amount'] = $result[0]['gst_amount'];
    else:
        $data['gst_amount'] = '';
    endif;
     if (isset($result[0]['gst_per']) && $result[0]['gst_per']) :
        $data['gst_per'] = $result[0]['gst_per'];
    else:
        $data['gst_per'] = '';
    endif;
    if (isset($result[0]['delivery_period']) && $result[0]['delivery_period']) :
        $data['delivery_period'] = $result[0]['delivery_period'];
    else:
        $data['delivery_period'] = '';
    endif;
    if (isset($result[0]['payment_term']) && $result[0]['payment_term']) :
        $data['payment_term'] = $result[0]['payment_term'];
    else:
        $data['payment_term'] = '';
    endif; 
    if (isset($result[0]['reference_by']) && $result[0]['reference_by']) :
        $data['reference_by'] = $result[0]['reference_by'];
    else:
        $data['reference_by'] = '';
    endif;  
    if (isset($result[0]['freight_status']) && $result[0]['freight_status']) :
        $data['freight_status'] = $result[0]['freight_status'];
    else:
        $data['freight_status'] = '';
    endif; 

    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
     if (isset($result[0]['po_details']) && $result[0]['po_details']) :
        $data['po_details'] = $result[0]['po_details'];
    else:
        $data['po_details'] = '';
    endif;
   // print_r($data['po_details']);exit;
	$data['title']='Create GIR Register';
	$data['suppliers']=$this->gir_register_model->getSuppliers();
	$data['items']=$this->gir_register_model->getItems();
	//$this->load->model('login_database');
    $data['categories'] = $this->gir_register_model->getCategories();
	$data['units'] = $this->gir_register_model->getUnits();
	//$data['states']=$this->gir_register_model->getStates();
	$this->template->load('template','gir_register_add',$data);

	//$this->load->view('footer');
	
	}
public function raw_add($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
    $data['g_no'] = $this->gir_register_model->getGirCode();
	$voucher_no= $data['g_no'];
    if($voucher_no<10){
    $gir_id_code='GIR000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $gir_id_code='GIR00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $gir_id_code='GIR0'.$voucher_no;
    }
    else{
      $gir_id_code='GIR'.$voucher_no;
    }
    //print_r($employee_id_code);exit;
    $data['gir_no']=$gir_id_code;

    $this->load->model('po_model');
    $result = $this->po_model->getById($id);
    //print_r($result);exit;
     if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['po_date'] = $result[0]['transaction_date'];
    else:
        $data['po_date'] = '';
    endif; 
     if (isset($result[0]['quotation_date']) && $result[0]['quotation_date']) :
        $data['quotation_date'] = $result[0]['quotation_date'];
    else:
        $data['quotation_date'] = '';
    endif; 

    if (isset($result[0]['po_number']) && $result[0]['po_number']) :
        $data['po_number'] = $result[0]['po_number'];
    else:
        $data['po_number'] = '';
    endif;

    $voucher_no= $data['po_number'];
    if($voucher_no<10){
    $po_code='CNC/A/000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $po_code='CNC/A/00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $po_code='CNC/A/0'.$voucher_no;
    }
    else{
      $po_code='CNC/A/'.$voucher_no;
    }
    //print_r($employee_id_code);exit;
    $data['po_code_view']=$po_code;

    if (isset($result[0]['quotation_no']) && $result[0]['quotation_no']) :
        $data['quotation_no'] = $result[0]['quotation_no'];
    else:
        $data['quotation_no'] = '';
    endif;

    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;

    if (isset($result[0]['total_amount']) && $result[0]['total_amount']) :
        $data['total_amount'] = $result[0]['total_amount'];
    else:
        $data['total_amount'] = '';
    endif; 
    if (isset($result[0]['discount_type']) && $result[0]['discount_type']) :
        $data['discount_type'] = $result[0]['discount_type'];
    else:
        $data['discount_type'] = '';
    endif; 
    if (isset($result[0]['discount']) && $result[0]['discount']) :
        $data['discount'] = $result[0]['discount'];
    else:
        $data['discount'] = '';
    endif; 
    if (isset($result[0]['discount_amount']) && $result[0]['discount_amount']) :
        $data['discount_amount'] = $result[0]['discount_amount'];
    else:
        $data['discount_amount'] = '';
    endif; 
    if (isset($result[0]['grand_total']) && $result[0]['grand_total']) :
        $data['grand_total'] = $result[0]['grand_total'];
    else:
        $data['grand_total'] = '';
    endif; 
    if (isset($result[0]['gst_amount']) && $result[0]['gst_amount']) :
        $data['gst_amount'] = $result[0]['gst_amount'];
    else:
        $data['gst_amount'] = '';
    endif;
     if (isset($result[0]['gst_per']) && $result[0]['gst_per']) :
        $data['gst_per'] = $result[0]['gst_per'];
    else:
        $data['gst_per'] = '';
    endif;
    if (isset($result[0]['delivery_period']) && $result[0]['delivery_period']) :
        $data['delivery_period'] = $result[0]['delivery_period'];
    else:
        $data['delivery_period'] = '';
    endif;
    if (isset($result[0]['payment_term']) && $result[0]['payment_term']) :
        $data['payment_term'] = $result[0]['payment_term'];
    else:
        $data['payment_term'] = '';
    endif; 
    if (isset($result[0]['reference_by']) && $result[0]['reference_by']) :
        $data['reference_by'] = $result[0]['reference_by'];
    else:
        $data['reference_by'] = '';
    endif;  
    if (isset($result[0]['freight_status']) && $result[0]['freight_status']) :
        $data['freight_status'] = $result[0]['freight_status'];
    else:
        $data['freight_status'] = '';
    endif; 

    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
     if (isset($result[0]['po_details']) && $result[0]['po_details']) :
        $data['po_details'] = $result[0]['po_details'];
    else:
        $data['po_details'] = '';
    endif;
	$data['title']='Create RM Inward Challan';
	//$this->load->model('login_database');
	$data['suppliers']=$this->gir_register_model->getAllRMSuppliers();
	$data['items']=$this->gir_register_model->getRMItems();
	//$this->load->model('login_database');
    $data['categories'] = $this->gir_register_model->getCategories();
	$data['units'] = $this->gir_register_model->getUnits();
	//$data['states']=$this->gir_register_model->getStates();
	$this->template->load('template','raw_material_gir_add',$data);

	//$this->load->view('footer');
	
	}
	public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
	$result = $this->gir_register_model->getById($id);
	//print_r($result);exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;
	//print_r($result['0']['gir_no']);exit;
	if (isset($result[0]['gir_no']) && $result[0]['gir_no']) :
	
		$data['g_no'] = $result[0]['gir_no'];
		$voucher_no= $data['g_no'];
		if($voucher_no<10){
		$gir_id_code='GIR000'.$voucher_no;
		}
		else if(($voucher_no>=10) && ($voucher_no<=99)){
		  $gir_id_code='GIR00'.$voucher_no;
		}
		else if(($voucher_no>=100) && ($voucher_no<=999)){
		  $gir_id_code='GIR0'.$voucher_no;
		}
		else{
		  $gir_id_code='GIR'.$voucher_no;
		}
		//print_r($employee_id_code);exit;
		$data['gir_no']=$gir_id_code;
	else:
		$data['gir_no'] = '';
	endif;
			
	if (isset($result[0]['challan_no']) && $result[0]['challan_no']) :
        $data['challan_no'] = $result[0]['challan_no'];
    else:
        $data['challan_no'] = '';
    endif;
    	/* if (isset($result[0]['gir_no']) && $result[0]['gir_no']) :
        $data['gir_no'] = $result[0]['gir_no'];
    else:
        $data['gir_no'] = '';
    endif; */
	
    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;
     if (isset($result[0]['categories_id']) && $result[0]['categories_id']) :
        $data['categories_id'] = $result[0]['categories_id'];
    else:
        $data['categories_id'] = '';
    endif;
    if (isset($result[0]['category']) && $result[0]['category']) :
        $data['category'] = $result[0]['category'];
    else:
        $data['category'] = '';
    endif;
    if (isset($result[0]['supplier']) && $result[0]['supplier']) :
        $data['supplier'] = $result[0]['supplier'];
    else:
        $data['supplier'] = '';
    endif;
	 if (isset($result[0]['weight_slip_no']) && $result[0]['weight_slip_no']) :
        $data['weight_slip_no'] = $result[0]['weight_slip_no'];
    else:
        $data['weight_slip_no'] = '';
    endif;
	    if (isset($result[0]['actual_weight']) && $result[0]['actual_weight']) :
        $data['actual_weight'] = $result[0]['actual_weight'];
    else:
        $data['actual_weight'] = '';
    endif;
	    if (isset($result[0]['doc_weight']) && $result[0]['doc_weight']) :
        $data['doc_weight'] = $result[0]['doc_weight'];
    else:
        $data['doc_weight'] = '';
    endif;
	    if (isset($result[0]['weight']) && $result[0]['weight']) :
        $data['weight'] = $result[0]['weight'];
    else:
        $data['weight'] = '';
    endif;
	    if (isset($result[0]['truck_no']) && $result[0]['truck_no']) :
        $data['truck_no'] = $result[0]['truck_no'];
    else:
        $data['truck_no'] = '';
    endif;
	    /*if (isset($result[0]['sample_tested']) && $result[0]['sample_tested']) :
        $data['sample_tested'] = $result[0]['sample_tested'];
    else:
        $data['sample_tested'] = '';
    endif;*/
	    if (isset($result[0]['payment']) && $result[0]['payment']) :
        $data['payment'] = $result[0]['payment'];
    else:
        $data['payment'] = '';
    endif;
     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = date('d-m-Y');
    endif; 
    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;
	 if (isset($result[0]['material_received_from']) && $result[0]['material_received_from']) :
        $data['material_received_from'] = $result[0]['material_received_from'];
    else:
        $data['material_received_from'] = '';
    endif;

    if (isset($result[0]['comments']) && $result[0]['comments']) :
        $data['comments'] = $result[0]['comments'];
    else:
        $data['comments'] = '';
    endif;


     if (isset($result[0]['gir_details']) && $result[0]['gir_details']) :
        $data['gir_details'] = $result[0]['gir_details'];
    else:
        $data['gir_details'] = '';
    endif;

	$data['title']='Edit GIR Register';
	$data['suppliers']=$this->gir_register_model->getSuppliers($data['categories_id']);
	$this->load->model('categories_model');
	$data['items']=$this->categories_model->getProductsByCategory($data['categories_id']);
    $data['units'] = $this->gir_register_model->getUnits();
	$this->load->model('login_database');
    $data['categories'] = $this->gir_register_model->getCategories();
	//$data['states']=$this->gir_register_model->getStates();
	$this->template->load('template','gir_register_edit',$data);

	//$this->load->view('footer');
	
	}
	public function raw_edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
	$result = $this->gir_register_model->getById($id);
	//print_r($result);exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;
	if (isset($result[0]['gir_no']) && $result[0]['gir_no']) :
	
		$data['g_no'] = $result[0]['gir_no'];
		$voucher_no= $data['g_no'];
		if($voucher_no<10){
		$gir_id_code='GIR000'.$voucher_no;
		}
		else if(($voucher_no>=10) && ($voucher_no<=99)){
		  $gir_id_code='GIR00'.$voucher_no;
		}
		else if(($voucher_no>=100) && ($voucher_no<=999)){
		  $gir_id_code='GIR0'.$voucher_no;
		}
		else{
		  $gir_id_code='GIR'.$voucher_no;
		}
		//print_r($employee_id_code);exit;
		$data['gir_no']=$gir_id_code;
	else:
		$data['gir_no'] = '';
	endif;
	if (isset($result[0]['challan_no']) && $result[0]['challan_no']) :
        $data['challan_no'] = $result[0]['challan_no'];
    else:
        $data['challan_no'] = '';
    endif;
    	if (isset($result[0]['gir_no']) && $result[0]['gir_no']) :
        $data['gir_no'] = $result[0]['gir_no'];
    else:
        $data['gir_no'] = '';
    endif;

    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;
     if (isset($result[0]['categories_id']) && $result[0]['categories_id']) :
        $data['categories_id'] = $result[0]['categories_id'];
    else:
        $data['categories_id'] = '';
    endif;
    if (isset($result[0]['category']) && $result[0]['category']) :
        $data['category'] = $result[0]['category'];
    else:
        $data['category'] = '';
    endif;
    if (isset($result[0]['transporter']) && $result[0]['transporter']) :
        $data['transporter'] = $result[0]['transporter'];
    else:
        $data['transporter'] = '';
    endif;
	    if (isset($result[0]['weight_slip_no']) && $result[0]['weight_slip_no']) :
        $data['weight_slip_no'] = $result[0]['weight_slip_no'];
    else:
        $data['weight_slip_no'] = '';
    endif;
	    if (isset($result[0]['actual_weight']) && $result[0]['actual_weight']) :
        $data['actual_weight'] = $result[0]['actual_weight'];
    else:
        $data['actual_weight'] = '';
    endif;
	    if (isset($result[0]['doc_weight']) && $result[0]['doc_weight']) :
        $data['doc_weight'] = $result[0]['doc_weight'];
    else:
        $data['doc_weight'] = '';
    endif;
	    if (isset($result[0]['weight']) && $result[0]['weight']) :
        $data['weight'] = $result[0]['weight'];
    else:
        $data['weight'] = '';
    endif;
	    if (isset($result[0]['truck_no']) && $result[0]['truck_no']) :
        $data['truck_no'] = $result[0]['truck_no'];
    else:
        $data['truck_no'] = '';
    endif;
	   /* if (isset($result[0]['sample_tested']) && $result[0]['sample_tested']) :
        $data['sample_tested'] = $result[0]['sample_tested'];
    else:
        $data['sample_tested'] = '';
    endif;*/
	    if (isset($result[0]['payment']) && $result[0]['payment']) :
        $data['payment'] = $result[0]['payment'];
    else:
        $data['payment'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = date('d-m-Y');
    endif; 
    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;
	 if (isset($result[0]['unit_id']) && $result[0]['unit_id']) :
        $data['unit_id'] = $result[0]['unit_id'];
    else:
        $data['unit_id'] = '';
    endif;
    if (isset($result[0]['material_received_from']) && $result[0]['material_received_from']) :
        $data['material_received_from'] = $result[0]['material_received_from'];
    else:
        $data['material_received_from'] = '';
    endif;

    if (isset($result[0]['comments']) && $result[0]['comments']) :
        $data['comments'] = $result[0]['comments'];
    else:
        $data['comments'] = '';
    endif;


     if (isset($result[0]['gir_details']) && $result[0]['gir_details']) :
        $data['gir_details'] = $result[0]['gir_details'];
    else:
        $data['gir_details'] = '';
    endif;

	$data['title']='Edit RM Inward Challan';
	
	$data['transporters']=$this->gir_register_model->getTransporters();
	$data['suppliers']=$this->gir_register_model->getSuppliers($data['categories_id']);
	$this->load->model('item_master_model');
	$data['items']=$this->item_master_model->getProductsByCategory($data['categories_id']);
    $data['units'] = $this->gir_register_model->getUnits();
	$this->load->model('login_database');
    $data['categories'] = $this->login_database->getCategories();
	//$data['states']=$this->gir_register_model->getStates();
	$this->template->load('template','raw_material_gir_edit',$data);

	//$this->load->view('footer');
	
	}

	public function index(){
			//$vv=$this->encrypt->encode('hy');
			//print_r($vv);exit;
			$data['title']=' GIR Register List';
			if($this->input->get())
			{
		 	    $conditions['supplier_id']=$this->input->get('supplier_id');
		 	    $conditions['categories_id']=$this->input->get('categories_id');
				$conditions['gir_no']=$this->input->get('gir_no');
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	    $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				//print_r($conditions);exit;
                $data['gir_data'] = $this->gir_register_model->gir_list_by_filter($conditions);
				//print_r($data['gir_data']);exit;
			}
            else
            {
			    $data['gir_data'] = $this->gir_register_model->getListGeneral();
			}
			$data['all_suppliers']=$this->gir_register_model->getAllSuppliers();
			$data['gir_nos']=$this->gir_register_model->getGIRno();
			//$data['Items']=$this->gir_register_model->getItems();
           //$data['gir_data']=$this->gir_register_model->getListGeneral();
			$data['categories']=$this->gir_register_model->getCategories();
			//$data['states']=$this->gir_register_model->getStates();
			$this->template->load('template','gir_register_view',$data);
		}

	public function rm_gir_index(){
			//$vv=$this->encrypt->encode('hy');
			//print_r($vv);exit;
			$data['title']='RM Inward Challan List';
			//$data['suppliers']=$this->gir_register_model->getSuppliers();
			//$data['Items']=$this->gir_register_model->getItems();
			$data['gir_data']=$this->gir_register_model->getListRMgir();
			
			//$data['states']=$this->gir_register_model->getStates();
			$this->template->load('template','gir_rm_register_view',$data);
		}

	

	public function add_new_gir() {
		//$this->form_validation->set_rules('transaction_date', 'Date', 'required');
		//$this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
		$this->form_validation->set_rules('item_id[]', 'Materai Name', 'required');
		$this->form_validation->set_rules('challan_no', 'Challan No', 'required');
		//$products=[];
		$total_pending_qty=$this->input->post('total_pending_qty');
        $po_id=$this->input->post('po_id');
       //print_r($total_pending_qty);exit;
        if($total_pending_qty=='0.00'){
            $this->gir_register_model->updatePurchaseCompleted($po_id);
        }
		/*$grade=$this->input->post('grade');
		$qty=$this->input->post('qty');
		$rate=$this->input->post('rate');
		$total=$this->input->post('total');*/
		//print_r($products);exit;
		//$voucher_no='0';
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
			/*$count_row = $this->gir_register_model->rowcount();
			$voucher_no=$count_row+1;*/

			$login_id=$this->session->userdata['logged_in']['id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			//'gir_no' => $voucher_no,
			'gir_no' => $this->input->post('gir_no'),
            'purchase_order_id' => $this->input->post('po_id'),
			'challan_no' => $this->input->post('challan_no'),
			'categories_id' => $this->input->post('categories_id'),
			'transporter_id' => $this->input->post('transporter_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'weight_slip_no' => $this->input->post('weight_slip_no'),
			'actual_weight' => $this->input->post('actual_weight'),
			'doc_weight' => $this->input->post('doc_weight'),
			'weight' => $this->input->post('weight'),
			'truck_no' => $this->input->post('truck_no'),
			/*'sample_tested' => $this->input->post('sample_tested'),*/
			'payment' => $this->input->post('payment'),
			'material_received_from' => $this->input->post('material_received_from'),
			'comments' => $this->input->post('comments'),
			'total_qty' => $this->input->post('total_qty'),
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->gir_register_model->gir_insert($data);
			if ($result == TRUE)
			{
				$categories_id=$this->input->post('categories_id');
				if($categories_id =='1'){
					$this->session->set_flashdata('success', 'Data inserted Successfully !');
					redirect('/Gir_registers/rm_gir_index', 'refresh');
				}
				else{
					$this->session->set_flashdata('success', 'Data inserted Successfully !');
					redirect('/Gir_registers/index', 'refresh');
				}
			//$this->fetchSuppliers();
			} else {

				if($categories_id =='1'){
				$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
				redirect('/Gir_registers/rm_gir_index', 'refresh');
				}
				else{
					$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
					redirect('/Gir_registers/index', 'refresh');
				}
			}
		}
	}

	public function edit_gir($id){
		$this->form_validation->set_rules('products[]', 'Product', 'required');
		$this->form_validation->set_rules('challan_no', 'Challan No', 'required');
		

		if ($this->form_validation->run() == FALSE) 
		{
			
			if(isset($this->session->userdata['logged_in'])){
				$this->edit($id);
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
			//'gir_no' => $voucher_no,
			'gir_no' => $this->input->post('gir_no'),
            'purchase_order_id' => $this->input->post('po_id'),
			'challan_no' => $this->input->post('challan_no'),
			'categories_id' => $this->input->post('categories_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'transporter_id' => $this->input->post('transporter_id'),
			'weight_slip_no' => $this->input->post('weight_slip_no'),
			'actual_weight' => $this->input->post('actual_weight'),
			'doc_weight' => $this->input->post('doc_weight'),
			'weight' => $this->input->post('weight'),
			'truck_no' => $this->input->post('truck_no'),
			/*'sample_tested' => $this->input->post('sample_tested'),*/
			'payment' => $this->input->post('payment'),
			'material_received_from' => $this->input->post('material_received_from'),
			'total_qty' => $this->input->post('total_qty'),
			'comments' => $this->input->post('comments'),
			'edited_by' => $login_id
			);
			$old_id = $this->input->post('gir_id_old'); 
			//print_r($this->input->post('products[]'));exit;
			$result = $this->gir_register_model->editGIR($data,$old_id);
			if ($result == TRUE) 
			{
				$categories_id=$this->input->post('categories_id');
				if($categories_id =='1'){
					$this->session->set_flashdata('success', 'Data inserted Successfully !');
					redirect('/Gir_registers/rm_gir_index', 'refresh');
				}
				else{
					$this->session->set_flashdata('success', 'Data inserted Successfully !');
					redirect('/Gir_registers/index', 'refresh');
				}
		
			} else {
				$categories_id=$this->input->post('categories_id');
				if($categories_id =='1'){
					$this->session->set_flashdata('failed', 'No changes in gir details!');
					redirect('/Gir_registers/rm_gir_index', 'refresh');
				}
				else{
					$this->session->set_flashdata('failed', 'No changes in gir details!');
					redirect('/Gir_registers/index', 'refresh');
				}
			//$this->template->load('template','supplier_view');
			}
		}
	}

	public function deletegirGEN($id= null){
  	 	$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$this->gir_register_model->deletegir($id);
  	 		}
	 			echo $this->session->set_flashdata('success', 'GIR Registers deleted Successfully !');
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$this->gir_register_model->deletegir($id);
  	 		$this->session->set_flashdata('success', 'GIR Register deleted Successfully !');
  	 		redirect('/Gir_registers/index', 'refresh');
	 			//$this->fetchSuppliers(); //render the refreshed list.
	 	}
  	 }
  	 	public function deletegirRM($id= null){
  	 	$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$this->gir_register_model->deletegir($id);
  	 		}
	 			echo $this->session->set_flashdata('success', 'GIR Registers deleted Successfully !');
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$this->gir_register_model->deletegir($id);
  	 		$this->session->set_flashdata('success', 'GIR Register deleted Successfully !');
  	 		redirect('/Gir_registers/rm_gir_index', 'refresh');
	 			//$this->fetchSuppliers(); //render the refreshed list.
	 	}
  	 }
	 public function report() 
	{
		$data['title'] = 'GIR Register Report';

		if($this->input->get())
            {
                $conditions['supplier_id']=$this->input->get('supplier_id');
                $conditions['categories_id']=$this->input->get('categories_id');
                $conditions['gir_no']=$this->input->get('gir_no');
                $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
                //print_r($conditions);exit;
                $data['gir_data'] = $this->gir_register_model->gir_list_by_filter($conditions);
                //print_r($data['gir_data']);exit;
            }
            else
            {
                $data['gir_data'] = $this->gir_register_model->getListGeneral();
            }
            $data['all_suppliers']=$this->gir_register_model->getAllSuppliers();
            $data['gir_nos']=$this->gir_register_model->getGIRno();
            //$data['Items']=$this->gir_register_model->getItems();
           //$data['gir_data']=$this->gir_register_model->getListGeneral();
            $data['categories']=$this->gir_register_model->getCategories();
		
		$this->template->load('template','gir_register_report',$data);
	}
 

    function createXLS() {
  	  	
        $fileName ='data-'.time().'.xls';  
        // load excel library
        $this->load->library('excel');

		if($this->input->post())
            {
                $conditions['supplier_id']=$this->input->post('supplier_id');
                $conditions['categories_id']=$this->input->post('categories_id');
                $conditions['gir_no']=$this->input->post('gir_no');
                $conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
                //print_r($conditions);exit;
                $reqSlipInfo = $this->gir_register_model->gir_list_by_filter($conditions);
                //print_r($data['gir_data']);exit;
            }
            else
            {
                $reqSlipInfo = $this->gir_register_model->getListGeneral();
            }  


         $objPHPExcel = new PHPExcel();  
        $objPHPExcel->setActiveSheetIndex(0);

    
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'GIR No');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Invoice/Challan No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Supplier Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Total Qty');   
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $key=>$element) {
            
                $voucher_no= $element['gir_no']; 
                    if($voucher_no<10){
                    $gir_id_code='GIR000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $gir_id_code='GIR00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $gir_id_code='GIR0'.$voucher_no;
                    }
                    else{
                      $gir_id_code='GIR'.$voucher_no;
                    }



           
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $gir_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['challan_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['supplier']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['total_qty']);
            $rowCount++;
            
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="gir_report.xls"');
        $objWriter->save('php://output');
        //$objWriter->save($fileName);

        
        // download file

        
        redirect('/GirRegisters/report', 'refresh');     
    }



	 public function CheckGirCode($supplier_code)
   {
   	 $isExist = $this->gir_register_model->CheckGirCode($supplier_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   } 
    public function print_gen($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->gir_register_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='GIR Register Profile';
        $this->template->load('template','gir_register_print',$data);
    } 
}

?>