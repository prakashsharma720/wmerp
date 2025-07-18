<?php

//session_start(); //we need to start session in order to access it through CI
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//print_r(BASEPATH);exit;
Class Suppliers extends MY_Controller {

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
$this->load->model('login_database');
//$this->load->library('excel');
}

// Show login page
public function add() {
	//$data['categories']=$this->login_database->getCategories();
	//$data['states']=$this->login_database->getStates();
	
	$data['title']='Add New Supplier';
		$data['s_code'] = $this->login_database->getSupplierCode();
			$voucher_no= $data['s_code'];
            if($voucher_no<10){
            $supplier_id_code='SUP000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $supplier_id_code='SUP00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $supplier_id_code='SUP0'.$voucher_no;
            }
            else{
              $supplier_id_code='SUP'.$voucher_no;
            }
            //print_r($employee_id_code);exit;
    $data['vendor_code']=$supplier_id_code;
    $data['categories']=$this->login_database->getCategories();
    $data['countries']=$this->login_database->getCountries();
    $data['states']=$this->login_database->getStates();
    $data['cities']=$this->login_database->getCities();
    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
	$this->template->load('layout/template','supplier_add',$data);

	//$this->load->view('footer');
	
	}

	public function index() 
	{
		$data['title'] = 'Suppliers List';
		
		if($this->input->get())
		{
		 	$conditions['supplier_id']=$this->input->get('supplier_id');
		 	$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
			//$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	//$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
           $data['suppliers'] = $this->login_database->supplier_list_by_filter($conditions);

		}else{
		$data['suppliers'] = $this->login_database->supplier_list();
		}

		$data['all_suppliers']=$this->login_database->getAllSuppliers();
		$data['categories']=$this->login_database->getCategories();
		$data['states']=$this->login_database->getStates();
		$this->template->load('layout/template','supplier_view',$data);
	}
	public function report() 
	{
		$data['title'] = 'Suppliers Report';
		//$data['suppliers'] = $this->login_database->supplier_list();
		$data['categories']=$this->login_database->getCategories();
		$data['all_suppliers']=$this->login_database->getAllSuppliers();
		if($this->input->get())
		{
		 	$conditions['supplier_id']=$this->input->get('supplier_id');
		 	$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
           $data['suppliers'] = $this->login_database->supplier_list_by_filter($conditions);

		}else{
		$data['suppliers'] = $this->login_database->supplier_list();
		}
		//echo var_dump($data['students']);
		$this->template->load('layout/template','supplier_report',$data);
	}

	public function add_new_supplier() {
		$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
		$this->form_validation->set_rules('vendor_code', 'Vendor Code', 'required');
		if(!empty($this->input->post('date_of_approval')))
		{
			$date_of_approval=date('Y-m-d',strtotime($this->input->post('date_of_approval')));
		}else{
			$date_of_approval='0000-00-00';
		}

		if(!empty($this->input->post('date_of_evalution')))
		{
			$date_of_evalution=date('Y-m-d',strtotime($this->input->post('date_of_evalution')));
		}else{
			$date_of_evalution='0000-00-00';
		}

		if(!empty($this->input->post('reg_date')))
		{
			$reg_date=date('Y-m-d',strtotime($this->input->post('reg_date')));
		}else{
			$reg_date='0000-00-00';
		}

		//$gst_number='NA';
		if($this->input->post('gst_status')=='Yes'){
			$gst_number=$this->input->post('gst_status');
		}else{
			$gst_number='NA';
		}
		if ($this->form_validation->run() == FALSE) 
		{
			//echo "hy";exit;
			if(isset($this->session->userdata['logged_in'])){
			$data['categories']=$this->login_database->getCategories();
			$this->template->load('template','supplier_add',$data);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		} 
		else 
		{
			$data = array(
			'prefix' => $this->input->post('prefix'),
			'supplier_name' => $this->input->post('supplier_name'),
			'vendor_code' => $this->input->post('vendor_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'supplier_type' => $this->input->post('supplier_type'),
			'website' => $this->input->post('website'),
			'categories_id' => $this->input->post('categories_id'),
			'category_of_approval' => $this->input->post('category_of_approval'),
			'gst_status' => $this->input->post('gst_status'),
			'gst_no' => $gst_number,
			'pan_no' => $this->input->post('pan_no'),
			'tds' => $this->input->post('tds'),
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'city_id' => $this->input->post('city_id'),
			'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('branch_name'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'account_no' => $this->input->post('account_no'),
			'address' => $this->input->post('address'),
			'created_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => $reg_date,
			'date_of_approval' => $date_of_approval,
			'date_of_evalution' => $date_of_evalution
			
			);
			//print_r($data);exit;
			$result = $this->login_database->supplier_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Supplier Added Successfully  !');	
			redirect('/Suppliers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed, Supplier Already exists !');
			redirect('/Suppliers/index', 'refresh');
			}
		}
	}


	public function edit_supplier_view($id) { 
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$query = $this->db->get_where("suppliers",array("id"=>$id));
        $data['current'] = $query->result();
       	//print_r($data['current']);exit;
		if (isset ($data['current'][0]->vendor_code) && $data['current'][0]->vendor_code) :
	           $data['s_code'] = $data['current'][0]->vendor_code;
	           $voucher_no= $data['s_code'];
	           if($voucher_no<10){
	           $supplier_id_code='SUP000'.$voucher_no;
	           }
	           else if(($voucher_no>=10) && ($voucher_no<=99)){
	             $supplier_id_code='SUP00'.$voucher_no;
	           }
	           else if(($voucher_no>=100) && ($voucher_no<=999)){
	             $supplier_id_code='SUP0'.$voucher_no;
	           }
	           else{
	             $supplier_id_code='SUP'.$voucher_no;
	           }
	           //print_r($employee_id_code);exit;
	           $data['vendor_code']=$supplier_id_code;
	       else:
	           $data['vendor_code'] = '';
	        endif;
        $data['old_id'] = $id; 
        $data['categories']=$this->login_database->getCategories();
        $data['countries']=$this->login_database->getCountries();
	    $data['states']=$this->login_database->getStates();
	    $data['cities']=$this->login_database->getCities();
	    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
        $this->template->load('template','supplier_edit',$data);
	
	}

	public function editSupplier($id){

		$this->form_validation->set_rules('supplier_name', 'Supplier Name', 'required');
		$this->form_validation->set_rules('vendor_code', 'Vendor Code', 'required');
		if(!empty($this->input->post('date_of_approval')))
		{
			$date_of_approval=date('Y-m-d',strtotime($this->input->post('date_of_approval')));
		}else{
			$date_of_approval='0000-00-00';
		}

		if(!empty($this->input->post('date_of_evalution')))
		{
			$date_of_evalution=date('Y-m-d',strtotime($this->input->post('date_of_evalution')));
		}else{
			$date_of_evalution='0000-00-00';
		}

		if(!empty($this->input->post('reg_date')))
		{
			$reg_date=date('Y-m-d',strtotime($this->input->post('reg_date')));
		}else{
			$reg_date='0000-00-00';
		}
		
		if($this->input->post('gst_status')=='Yes'){
			$gst_number=$this->input->post('gst_no');
		}else{
			$gst_number='NA';
		}


		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->edit_supplier_view($id);
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
			'prefix' => $this->input->post('prefix'),
			'supplier_name' => $this->input->post('supplier_name'),
			'vendor_code' => $this->input->post('vendor_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'supplier_type' => $this->input->post('supplier_type'),
			'website' => $this->input->post('website'),
			'categories_id' => $this->input->post('categories_id'),
			'category_of_approval' => $this->input->post('category_of_approval'),
			'gst_status' => $this->input->post('gst_status'),
			'gst_no' => $this->input->post('gst_no'),
			'pan_no' => $this->input->post('pan_no'),
			'tds' => $this->input->post('tds'),
			'country_id' => $this->input->post('country_id'),
			'state_id' => $this->input->post('state_id'),
			'city_id' => $this->input->post('city_id'),
			'bank_name' => $this->input->post('bank_name'),
			'branch_name' => $this->input->post('branch_name'),
			'ifsc_code' => $this->input->post('ifsc_code'),
			'account_no' => $this->input->post('account_no'),
			'address' => $this->input->post('address'),
			'edited_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => $reg_date,
			'date_of_approval' => $date_of_approval,
			'date_of_evalution' => $date_of_evalution
			);
			$old_id = $this->input->post('id'); 
			//print_r($data);exit;
			$result = $this->login_database->editSupplier($data,$old_id);
			//echo $result;exit;
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'Supplier Updated Successfully !');
			redirect('/Suppliers/index','refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Updation Failed !');
			redirect('/Suppliers/index','refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}

	public function deleteSupplier($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->login_database->deleteSupplier($id);

	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Supplier deleted Successfully !');
			}else{

  	 		$id = $this->uri->segment('3');
  	 		$this->login_database->deleteSupplier($id);
  	 		$this->session->set_flashdata('success', 'Supplier deleted Successfully !');
  	 		redirect('/Suppliers/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
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
			$conditions['supplier_id']=$this->input->post('supplier_id');
		 	$conditions['categories_id']=$this->input->post('categories_id');
		 	$conditions['category_of_approval']=$this->input->post('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$empInfo = $this->login_database->supplier_list_by_filter($conditions);
		}
		else
		{
			$empInfo = $this->login_database->export_csv();
		}	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getDefaultStyle()
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
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Registration Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Contact Person');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile No');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Website');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Category');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Approval Category');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Bank Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Account No');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Service State');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Date of Approval');       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Date of Evalution ');       
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['supplier_name'].'('.$element['vendor_code'].')');
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['reg_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['contact_person']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['website']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['category']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['category_of_approval']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['bank_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['account_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['state']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['date_of_approval']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['date_of_evalution']);
            $rowCount++;
        }
       	//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="SupplierData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);
		
		// Second option for code
   //      //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
   //      $objWriter->save($fileName);
 		// // download file
   //      header("Content-Type: application/vnd.ms-excel");
   //      redirect(base_url().$fileName); 
		
		

		
       	redirect('/Suppliers/index', 'refresh');     
    }

    public function getSupplierByCategory($id){
    	$data = array();
    	$data['suppliers']=$this->login_database->getSupplierByCategory($id);
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

    public function getSupplierById($id=NULL){
    	$data = array();
    	$data['suppliers_data']=$this->login_database->getSupplierById($id);
    	//print_r($data['suppliers_data']);exit;
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }


    public function CheckSupplierCode($supplier_code)
   {
   	 $isExist = $this->login_database->CheckSupplierCode($supplier_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   }
   public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->login_database->getById($id);
		//print_r($data['current']['prefix'] );exit;
        if (isset ($data['current']['vendor_code']) && $data['current']['vendor_code']) :
	            $data['vendor_code'] = $data['current']['vendor_code'];
	            
	        endif;
	        $data['title']='Supplier Profile';
        $this->template->load('template','printprofile',$data);
    } 

}

?>