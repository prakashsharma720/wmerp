<?php

//session_start(); //we need to start session in order to access it through CI
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//print_r(BASEPATH);exit;
Class Customers extends CI_Controller {

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
$this->load->model('order_module');
//$this->load->library('excel');
}

// Show login page
public function add() {
	//$data['categories']=$this->order_module->getCategories();
	//$data['states']=$this->order_module->getStates();
	//$state_code=$this->FindStateodeById('5');
	//print_r($state_code['state_code']);exit;
	
	$data['title']='Create New Order';
		$data['c_code'] = $this->order_module->getcustomerCode();
			$voucher_no= $data['c_code'];
            if($voucher_no<10){
            $customer_id_code='ORD000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $customer_id_code='ORD00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $customer_id_code='ORD0'.$voucher_no;
            }
            else{
              $customer_id_code='ORD'.$voucher_no;
            }
            //print_r($employee_id_code);exit;
            $data['customer_code']=$customer_id_code;
    $data['categories']=$this->order_module->getCategories();
    $data['countries']=$this->order_module->getCountries();
    $data['states']=$this->order_module->getStates();
    $data['cities']=$this->order_module->getCities();
    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
	$this->template->load('template','order_add',$data);

	//$this->load->view('footer');
	
	}

	public function index() 
	{
		$data['title'] = 'Orders List';
		
		$data['all_orders']=$this->order_module->getAllorders();
		$data['categories']=$this->order_module->getCategories();
		$data['states']=$this->order_module->getStates();
		
		if($this->input->get())
		{
		 	$conditions['customer_id']=$this->input->get('customer_id');
		 	$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
			$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
           $data['orders'] = $this->order_model->order_list_by_filter($conditions);

		}else{
		$data['orders'] = $this->order_module->order_list();
		}

		$this->template->load('template','order_view',$data);
	}
	public function report() 
	{
		$data['title'] = 'Orders Report';
		//$data['customers'] = $this->order_module->order_list();
		$data['categories']=$this->order_module->getCategories();
		$data['all_orders']=$this->order_module->getAllorders();
		if($this->input->get())
		{
		 	$conditions['customer_id']=$this->input->get('customer_id');
		 	$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
           $data['orders'] = $this->order_module->order_list_by_filter($conditions);

		}else{
		$data['orders'] = $this->order_module->order_list();
		}
		//echo var_dump($data['students']);
		$this->template->load('template','order_report',$data);
	}

	public function add_new_customer() {
		$this->form_validation->set_rules('customer_name', 'Order Name', 'required');
		
		$state_id=$this->input->post('state_id');
		$state_data=$this->FindStateCodeById($state_id);
		$state_code=$state_data['state_code'];

		if ($this->form_validation->run() == FALSE) 
		{
			//echo "hy";exit;
			if(isset($this->session->userdata['logged_in'])){
			$data['categories']=$this->order_module->getCategories();
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
			'categories_id' => $this->input->post('categories_id'),
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
			'created_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => date('Y-m-d',strtotime($this->input->post('reg_date')))			
			);
			//print_r($data);exit;
			$result = $this->order_module->customer_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Order Added Successfully  !');	
			redirect('/Orders/index', 'refresh');
			//$this->fetchcustomers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed, Order Already exists !');
			redirect('/Orders/index', 'refresh');
			}
		}
	}

	public function edit_customer_view($id) { 
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$query = $this->db->get_where("customers",array("id"=>$id));
        $data['current'] = $query->result();
       	//print_r($data['current'][0]->vendor_code);exit;
		if (isset ($data['current'][0]->customer_code) && $data['current'][0]->customer_code) :
	            $data['c_code'] = $data['current'][0]->customer_code;
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
        $data['old_id'] = $id; 
        $data['categories']=$this->order_module->getCategories();
        $data['countries']=$this->order_module->getCountries();
	    $data['states']=$this->order_module->getStates();
	    $data['cities']=$this->order_module->getCities();
	    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
        $this->template->load('template','order_edit',$data);
	
	}

	public function editcustomer($id){

		$this->form_validation->set_rules('customer_name', 'Order Name', 'required');
    
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
			'categories_id' => $this->input->post('categories_id'),
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
			'edited_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => date('Y-m-d',strtotime($this->input->post('reg_date'))),
			
			);
			$old_id = $this->input->post('id'); 
			//print_r($data);exit;
			$result = $this->order_module->editcustomer($data,$old_id);
			//echo $result;exit;
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'Order Updated Successfully !');
			redirect('/Orders/index','refresh');
			//$this->template->load('template','customer_view');
			} else {
			$this->session->set_flashdata('failed', 'Updation Failed !');
			redirect('/Orders/index','refresh');
			//$this->template->load('template','customer_view');
			}
		}
	}
	 public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->order_module->getById($id);
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
	        $data['title']='Order Profile';
        $this->template->load('template','print_order',$data);
    } 
	
	public function deleteorder($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->order_module->deleteorder($id);

	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Order deleted Successfully !');
			}else{

  	 		$id = $this->uri->segment('3');
  	 		$this->order_module->deleteorder($id);
  	 		$this->session->set_flashdata('success', 'Order deleted Successfully !');
  	 		redirect('/Orders/index', 'refresh');
  	 		//$this->fetchcustomers(); //render the refreshed list.
  	 	}
  	 }
  	  function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['customer_id']=$this->input->post('customer_id');
		 	$conditions['categories_id']=$this->input->post('categories_id');
		 	$conditions['category_of_approval']=$this->input->post('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$empInfo = $this->order_module->order_list_by_filter($conditions);
		}
		else
		{
			$empInfo = $this->order_module->export_csv();
		}	
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
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Contact Person');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile No');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Website');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Category');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Bank Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Account No');       
          
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['customer_name'].'('.$element['customer_code'].')');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['reg_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['contact_person']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['website']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['category']);
            
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['bank_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['account_no']);

            $rowCount++;
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="orderData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Orders/index', 'refresh');     
    }
    public function FindStateCodeById($id){
    	$data = array();
    	$data['state_code']=$this->order_module->FindStateCodeById($id);
    	return $data['state_code'];

    }
    public function getcustomerById($id){
    	$data = array();
    	$data['customers_data']=$this->order_module->getcustomerById($id);
    	//print_r($data['customers_data']);exit;
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

    public function CheckcustomerCode($customer_code)
   {
   	 $isExist = $this->order_module->CheckCustomerCode($customer_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   } 

}

?>