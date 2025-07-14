<?php

//session_start(); //we need to start session in order to access it through CI
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//print_r(BASEPATH);exit;
Class Service_providers extends MY_Controller {

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
$this->load->model('service_provider_model');
//$this->load->library('excel');
}

// Show login page
public function add($id = NULL) {
	//$data['categories']=$this->service_provider_model->getCategories();
	//$data['states']=$this->service_provider_model->getStates();
	
	//echo $id;exit;
	$data['title']='Add New Service Provider';
		$data['sp_code'] = $this->service_provider_model->getServiceProviderCode();
			$voucher_no= $data['sp_code'];
            if($voucher_no<10){
            $sp_id_code='SP000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $sp_id_code='SP00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $sp_id_code='SP0'.$voucher_no;
            }
            else{
              $sp_id_code='SP'.$voucher_no;
            }
            //print_r($employee_id_code);exit;
            $data['service_provider_code']=$sp_id_code;
    $data['categories']=$this->service_provider_model->getCategories();
    $data['countries']=$this->service_provider_model->getCountries();
    $data['states']=$this->service_provider_model->getStates();
    $data['cities']=$this->service_provider_model->getCities();
    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
	$this->template->load('template','service_provider_add',$data);

	//$this->load->view('footer');
	
	}

	public function fetchService_providers(){
			$data['title'] = 'Service Providers List';
			//$this->load->model('service_provider_model');
			$data['service_providers'] = $this->service_provider_model->service_provider_list();
			$data['categories']=$this->service_provider_model->getCategories();
			$data['states']=$this->service_provider_model->getStates();
			//print_r($data['suppliers']);exit;
		/*	$cat=[];
			foreach ($data['suppliers'] as $key => $supplier) {
				$cat[$supplier['id']]=$supplier['products'];
				$ids=explode(',', $supplier['products']);
				$catnameaa=[];
				foreach ($ids as $key => $id) {
					$catnameaa['catname']=$this->service_provider_model->fetchcatName($id);
				}
				
			}
			print_r($catnameaa['catname']);
			exit;*/

			$this->template->load('template','service_provider_view',$data);
		}

	public function index() 
	{
		//$this->fetchService_providers();
        $data['title'] = 'Service Provider List';
		
		//$data['states']=$this->service_provider_model->getStates();

		if($this->input->get())
		{
		 	$conditions['service_provider_id']=$this->input->get('service_provider_id');
		 	$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
           $data['service_providers'] = $this->service_provider_model->sp_list_by_filter($conditions);

		}else{
		$data['service_providers'] = $this->service_provider_model->service_provider_list();
		}
		$data['all_service_providers']=$this->service_provider_model->getAllSProviders();
		$data['categories']=$this->service_provider_model->getCategories();
		$this->template->load('template','service_provider_view',$data);
	
	}
	
   public function report() 
	{
		$data['title'] = 'Service Provider Report';
		//$data['suppliers'] = $this->service_provider_model->supplier_list();
		$data['categories']=$this->service_provider_model->getCategories();
		$data['all_sps']=$this->service_provider_model->getAllSPs();
		if($this->input->get())
		{
		 	$conditions['service_provider_id']=$this->input->get('service_provider_id');
		 	$conditions['categories_id']=$this->input->get('categories_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
           $data['service_providers'] = $this->service_provider_model->sp_list_by_filter($conditions);

		}else{
		$data['service_providers'] = $this->service_provider_model->service_provider_list();
		}
		//echo var_dump($data['students']);
		$this->template->load('template','service_provider_report',$data);
	}
	function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['service_provider_id']=$this->input->post('service_provider_id');
		 	$conditions['categories_id']=$this->input->post('categories_id');
		 	$conditions['category_of_approval']=$this->input->post('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$empInfo = $this->service_provider_model->sp_list_by_filter($conditions);
		}
		else
		{
			$empInfo = $this->service_provider_model->export_csv();
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
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['service_provider_name'].'('.$element['service_provider_code'].')');
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
        header('Content-Disposition: attachment;filename="ServiceProviderData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Service_providers/index', 'refresh');     
    }
	public function add_new_service_provider() {
		$this->form_validation->set_rules('service_provider_name', 'Service Provider Name', 'required');
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
			//echo "hy";exit;
			if(isset($this->session->userdata['logged_in'])){
			$data['categories']=$this->service_provider_model->getCategories();
			$this->template->load('template','service_provider_add',$data);
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
			'service_provider_name' => $this->input->post('service_provider_name'),
			'service_provider_code' => $this->input->post('service_provider_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'service_provider_type' => $this->input->post('service_provider_type'),
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
			$result = $this->service_provider_model->service_provider_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Service Provider Added Successfully  !');	
			redirect('/Service_providers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed, Service Provider Already exists !');
			redirect('/Service_providers/index', 'refresh');
			}
		}
	}

	public function edit_service_provider_view($id) { 
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$query = $this->db->get_where("service_providers",array("id"=>$id));
        $data['current'] = $query->result();
		if (isset ($data['current'][0]->service_provider_code) && $data['current'][0]->service_provider_code) :
	            $data['sp_code'] = $data['current'][0]->service_provider_code;
	            $voucher_no= $data['sp_code'];
	            if($voucher_no<10){
	            $sp_id_code='SP000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $sp_id_code='SP00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $sp_id_code='SP0'.$voucher_no;
	            }
	            else{
	              $sp_id_code='SP'.$voucher_no;
	            }
	            //print_r($employee_id_code);exit;
	            $data['service_provider_code']=$sp_id_code;
	        else:
	            $data['service_provider_code'] = '';
	        endif;
       	//print_r($data['current']);exit;
        $data['old_id'] = $id; 
        $data['categories']=$this->service_provider_model->getCategories();
        $data['countries']=$this->service_provider_model->getCountries();
	    $data['states']=$this->service_provider_model->getStates();
	    $data['cities']=$this->service_provider_model->getCities();
	    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
        $this->template->load('template','service_provider_edit',$data);

	}

	public function editService_provider($id){

		$this->form_validation->set_rules('service_provider_name', 'Service Provider Name', 'required');
		//print_r($this->input->post('date_of_evalution'));exit;

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
			$this->edit_service_provider_view($id);
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
			'service_provider_name' => $this->input->post('service_provider_name'),
			'service_provider_code' => $this->input->post('service_provider_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'service_provider_type' => $this->input->post('service_provider_type'),
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
			'edited_by' => $this->session->userdata['logged_in']['id'],
			'reg_date' => $reg_date,
			'date_of_approval' => $date_of_approval,
			'date_of_evalution' => $date_of_evalution

			);
			$old_id = $this->input->post('id'); 
			//print_r($data);exit;
			$result = $this->service_provider_model->editService_provider($data,$old_id);
			//echo $result;exit;
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'Service Provider Updated Successfully !');
			redirect('/Service_providers/index','refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Updation Failed !');
			redirect('/Service_providers/index','refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}
	public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->service_provider_model->getById($id);
		//print_r($data['current']['prefix'] );exit;
        if (isset ($data['current']['service_provider_code']) && $data['current']['service_provider_code']) :
	            $data['sp_code'] = $data['current']['service_provider_code'];
	            $voucher_no= $data['sp_code'];
	            if($voucher_no<10){
	            $sp_id_code='SP000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $sp_id_code='SP00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $sp_id_code='SP0'.$voucher_no;
	            }
	            else{
	              $sp_id_code='SP'.$voucher_no;
	            }
	            //print_r($employee_id_code);exit;
	            $data['service_provider_code']=$sp_id_code;
	        else:
	            $data['service_provider_code'] = '';
	        endif;
	        $data['title']='Service Provider Profile';
        $this->template->load('template','print_service_provider',$data);
    }
	public function deleteService_provider($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->service_provider_model->deleteService_provider($id);

	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Service Provider deleted Successfully !');
			}else{

  	 		$id = $this->uri->segment('3');
  	 		$this->service_provider_model->deleteService_provider($id);
  	 		$this->session->set_flashdata('success', 'Service Provider deleted Successfully !');
  	 		redirect('/Service_providers/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 	}
  	 }


    public function getSProviderByCategory($id=NULL){
    	$data = array();
    	$data['service_providers']=$this->service_provider_model->getSProviderByCategory($id);
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

    public function CheckServiceProviderCode($service_provider_code)
   {
   	 $isExist = $this->service_provider_model->CheckServiceProviderCode($service_provider_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   } 

    public function getSProviderById($id=NULL){
    	$data = array();
    	$data['service_providers_data']=$this->service_provider_model->getSProviderById($id);
    	//print_r($data['suppliers_data']);exit;
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

}

?>