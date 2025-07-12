<?php

//session_start(); //we need to start session in order to access it through CI
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//print_r(BASEPATH);exit;
Class Customers extends MY_Controller {

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

$this->load->library('encryption');

// Load session library
$this->load->library('session');


$this->load->library('template');

// Load database
$this->load->model('customer_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	//$data['categories']=$this->customer_model->getCategories();
	//$data['states']=$this->customer_model->getStates();
	//$state_code=$this->FindStateodeById('5');
	//print_r($state_code['state_code']);exit;
	
	$data['title']='Add New customer';
    $data['categories']=$this->customer_model->getCategories();
    $data['countries']=$this->customer_model->getCountries();
    $data['states']=$this->customer_model->getStates();
    $data['cities']=$this->customer_model->getCities();
    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
	$this->template->load('template','customer_add',$data);

	//$this->load->view('footer');
	
	}

	public function index() 
	{
		$data['title'] = 'Customers List';
		
		$data['all_customers']=$this->customer_model->getAllcustomers();
		$data['categories']=$this->customer_model->getCategories();
		$data['states']=$this->customer_model->getStates();
		
		if($this->input->get())
		{
		 	$conditions['customer_id']=$this->input->get('customer_id');
		 	//$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
			$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
           $data['customers'] = $this->customer_model->customer_list_by_filter($conditions);

		}else{
		$data['customers'] = $this->customer_model->customer_list();
		
		}
		// echo "<pre>";print_r($data['customers']);exit;
		$this->template->load('template','customer_view',$data);
	}
	public function report() 
	{
		$data['title'] = 'customers Report';
		//$data['customers'] = $this->customer_model->customer_list();
		$data['categories']=$this->customer_model->getCategories();
		$data['all_customers']=$this->customer_model->getAllcustomers();
		if($this->input->get())
		{
		 	$conditions['customer_id']=$this->input->get('customer_id');
		 	//$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
           $data['customers'] = $this->customer_model->customer_list_by_filter($conditions);

		}else{
		$data['customers'] = $this->customer_model->customer_list();
		}
		//echo var_dump($data['students']);
		$this->template->load('template','customer_report',$data);
	}

	public function add_new_customer() {
		// echo "<pre>";print_r($_POST);exit;
		$this->form_validation->set_rules('customer_name', 'customer Name', 'required');
		//$this->form_validation->set_rules('customer_code', 'Customer Code', 'required');
		/*$this->form_validation->set_rules('contact_person', 'Contact Person', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
		$this->form_validation->set_rules('website', 'Website Person', 'required');
		$this->form_validation->set_rules('categories_id', ' customer Category', 'required');
		$this->form_validation->set_rules('category_of_approval', 'Approval Category', 'required');
		$this->form_validation->set_rules('gst_no', 'GST No', 'required');
		$this->form_validation->set_rules('pan_no', 'PAN No', 'required');
		$this->form_validation->set_rules('tds', 'TDS', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'required');
		$this->form_validation->set_rules('date_of_approval', 'Approval Date', 'required');
		$this->form_validation->set_rules('date_of_evalution', 'Evalution Date', 'required');*/
		/*if(!empty($this->input->post('products'))){
			$products=implode(',',$this->input->post('products'));
			//print_r($products);exit;
		}
      */
		$state_id=$this->input->post('state_id');
		$state_data=$this->FindStateCodeById($state_id);
		$state_code=$state_data['state_code'];

		if ($this->form_validation->run() == FALSE) 
		{
			//echo "hy";exit;
			if(isset($this->session->userdata['logged_in'])){
			$data['categories']=$this->customer_model->getCategories();
			$this->template->load('template','customer_add',$data);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','customer_add');
		} 
		else 
		{
			$data = array(
			'prefix' => $this->input->post('prefix'),
			'customer_name' => $this->input->post('customer_name'),
			'customer_code' => $this->input->post('customer_code'),
			'vendor_code' => $this->input->post('vendor_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'customer_type' => $this->input->post('customer_type'),
			'website' => $this->input->post('website'),
			'gst_status' => $this->input->post('gst_status'),
			'gst_no' => $this->input->post('gst_no'),
			'pan_no' => $this->input->post('pan_no'),
			/*'tds' => $this->input->post('tds'),*/
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'state_code' => $state_code,
			'city_id' => $this->input->post('city_id'),
			/*'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('branch_name'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'account_no' => $this->input->post('account_no'),*/
			'shipping_address' => $this->input->post('shipping_address'),
			'billing_address' => $this->input->post('billing_address'),
			'billing_pincode' => $this->input->post('bpin'),
			'buyer_item_code' => $this->input->post('buyer_item_code'),
			'payment_terms' => $this->input->post('payment_terms'),
			'destination' => $this->input->post('destination'),
			'created_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => date('Y-m-d',strtotime($this->input->post('reg_date'))),	
			'isshipping' => $this->input->post('isshipping'),

			'shipping_gst_status' => $this->input->post('shipping_gst_status'),
			'shipping_gst_no' => $this->input->post('shipping_gst_no'),
			'shipping_legal_name' => $this->input->post('shipping_legal_name'),
			'saddress1' => $this->input->post('saddress1'),
			'saddress2' => $this->input->post('saddress2'),
			'loc' => $this->input->post('loc'),
			'ship_pincode' => $this->input->post('ship_pincode'),
			'ship_state_code' => $this->input->post('ship_state_code'),
			'ship_destination' => $this->input->post('ship_destination'),
			
			


			);
			//print_r($data);exit;
			$result = $this->customer_model->customer_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Customer Added Successfully  !');	
			redirect('/Customers/index', 'refresh');
			//$this->fetchcustomers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed, Customer Already exists !');
			redirect('/Customers/index', 'refresh');
			}
		}
	}

	public function edit_customer_view($id) { 
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$query = $this->db->get_where("customers",array("id"=>$id));
        $data['current'] = $query->result();
       	// echo "<pre>";print_r($data['current']);exit;
	
        $data['old_id'] = $id; 
        $data['categories']=$this->customer_model->getCategories();
        $data['countries']=$this->customer_model->getCountries();
	    $data['states']=$this->customer_model->getStates();
	    $data['cities']=$this->customer_model->getCities();
	    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
        $this->template->load('template','customer_edit',$data);
	
	}

	public function editcustomer($id){

		$this->form_validation->set_rules('customer_name', 'customer Name', 'required');
        //$this->form_validation->set_rules('customer_code', 'Customer Code', 'required');
		/*$this->form_validation->set_rules('contact_person', 'Contact Person', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'required');
		$this->form_validation->set_rules('website', 'Website Person', 'required');
		$this->form_validation->set_rules('categories_id', ' customer Category', 'required');
		$this->form_validation->set_rules('category_of_approval', 'Approval Category', 'required');
		$this->form_validation->set_rules('gst_no', 'GST No', 'required');
		$this->form_validation->set_rules('pan_no', 'PAN No', 'required');
		$this->form_validation->set_rules('tds', 'TDS', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
		$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
		$this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'required');
		$this->form_validation->set_rules('account_no', 'Account Number', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('date_of_approval', 'Approval Date', 'required');
		$this->form_validation->set_rules('date_of_evalution', 'Evalution Date', 'required');*/
		$state_id=$this->input->post('state_id');
		$state_data=$this->FindStateCodeById($state_id);
		$state_code=$state_data['state_code'];
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->edit_customer_view($id);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','customer_edit');
		} 
		else 
		{
			$login_id=$this->session->userdata['logged_in']['id'];
			$data = array(
			'prefix' => $this->input->post('prefix'),
			'customer_name' => $this->input->post('customer_name'),
			'customer_code' => $this->input->post('customer_code'),
			'vendor_code' => $this->input->post('vendor_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'customer_type' => $this->input->post('customer_type'),
			'website' => $this->input->post('website'),
			'gst_status' => $this->input->post('gst_status'),
			'gst_no' => $this->input->post('gst_no'),
			'pan_no' => $this->input->post('pan_no'),
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'state_code' => $state_code,
			'city_id' => $this->input->post('city_id'),
			/*'tds' => $this->input->post('tds'),
			'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('branch_name'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'account_no' => $this->input->post('account_no'),*/
			'shipping_address' => $this->input->post('shipping_address'),
			'billing_address' => $this->input->post('billing_address'),
			'billing_pincode' => $this->input->post('bpin'),

			'payment_terms' => $this->input->post('payment_terms'),
			'buyer_item_code' => $this->input->post('buyer_item_code'),
			'destination' => $this->input->post('destination'),
			'edited_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => date('Y-m-d',strtotime($this->input->post('reg_date'))),
			'isshipping' => $this->input->post('isshipping'),
			'shipping_gst_status' => $this->input->post('shipping_gst_status'),
			'shipping_gst_no' => $this->input->post('shipping_gst_no'),
			'shipping_legal_name' => $this->input->post('shipping_legal_name'),
			'saddress1' => $this->input->post('saddress1'),
			'saddress2' => $this->input->post('saddress2'),
			'loc' => $this->input->post('loc'),
			'ship_pincode' => $this->input->post('ship_pincode'),
			'ship_state_code' => $this->input->post('ship_state_code'),
			'ship_destination' => $this->input->post('ship_destination'),
			
			);
			$old_id = $this->input->post('id'); 
			//print_r($data);exit;
			$result = $this->customer_model->editcustomer($data,$old_id);
			//echo $result;exit;
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'Customer Updated Successfully !');
			redirect('/Customers/index','refresh');
			//$this->template->load('template','customer_view');
			} else {
			$this->session->set_flashdata('failed', 'Updation Failed !');
			redirect('/Customers/index','refresh');
			//$this->template->load('template','customer_view');
			}
		}
	}
	 public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->customer_model->getById($id);
		//print_r($data['current']['prefix'] );exit;
        if (isset ($data['current']['customer_code']) && $data['current']['customer_code']) :
	            $data['c_code'] = $data['current']['customer_code'];
	            $voucher_no= $data['c_code'];
	            if($voucher_no<10){
	            $customer_id_code='CUS000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $customer_id_code='CUS00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $customer_id_code='CUS0'.$voucher_no;
	            }
	            else{
	              $customer_id_code='CUS'.$voucher_no;
	            }
	            //print_r($employee_id_code);exit;
	            $data['customer_code']=$customer_id_code;
	        else:
	            $data['customer_code'] = '';
	        endif;
	        $data['title']='Customer Profile';
        $this->template->load('template','print_customer',$data);
    } 
	
	public function deletecustomer($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->customer_model->deletecustomer($id);

	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Customer deleted Successfully !');
			}else{

  	 		$id = $this->uri->segment('3');
  	 		$this->customer_model->deletecustomer($id);
  	 		$this->session->set_flashdata('success', 'Customer deleted Successfully !');
  	 		redirect('/Customers/index', 'refresh');
  	 		//$this->fetchcustomers(); //render the refreshed list.
  	 	}
  	 }
	   function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xlsx';
       	$fileName ='data-'.time().'.xlsx';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['customer_id']=$this->input->post('customer_id');
		 	//$conditions['categories_id']=$this->input->post('categories_id');
		 	$conditions['category_of_approval']=$this->input->post('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$empInfo = $this->customer_model->customer_list_by_filter($conditions);
		}
		else
		{
			$empInfo = $this->customer_model->export_csv();
		}
		//echo "<pre>";print_r($empInfo);exit;		
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);
     /*   $objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getTop()
		        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getBottom()
		        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getLeft()
		        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getRight()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);*/
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Registration Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'GSTIN');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Address 1');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Address 2');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Destination');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'City');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'State');  
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Country'); 
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Buyer Item Code'); 		
          
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['customer_name'].'('.$element['customer_code'].')');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['reg_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['gst_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['shipping_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['billing_address']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['destination']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['city']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['state']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['country']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['buyer_item_code']);
            $rowCount++;
        }
       // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="customerData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Customers/index', 'refresh');     
    }
    public function FindStateCodeById($id){
    	$data = array();
    	$data['state_code']=$this->customer_model->FindStateCodeById($id);
    	return $data['state_code'];

    }
    public function getcustomerById($id){
    	$data = array();
    	$data['customers_data']=$this->customer_model->getcustomerById($id);
    	// print_r($data['customers_data']);exit;
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

    public function CheckcustomerCode($customer_code)
   {
   	 $isExist = $this->customer_model->CheckCustomerCode($customer_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   } 

}

?>