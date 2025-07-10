<?php

//session_start(); //we need to start session in order to access it through CI
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//print_r(BASEPATH);exit;
Class Transporters extends MY_Controller {

public function __construct() {
parent::__construct();
if(!$this->session->userdata['logged_in']['id']){
    redirect('user_authentication/index');
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
$this->load->model('transporter_model');
$this->load->model('customer_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	//$data['categories']=$this->transporter_model->getCategories();
	//$data['states']=$this->transporter_model->getStates();
	$id = $this->uri->segment('3');
	
			$data['tp_code'] = $this->transporter_model->getTransporterCode();
			$voucher_no= $data['tp_code'];
            if($voucher_no<10){
            $transporter_id_code='TP000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $transporter_id_code='TP00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $transporter_id_code='TP0'.$voucher_no;
            }
            else{
              $transporter_id_code='TP'.$voucher_no;
            }
            //print_r($employee_id_code);exit;
            $data['vendor_code']=$transporter_id_code;
		if(!empty($id)){
			$data['title']='Edit Transporter';
			$query = $this->db->get_where("transporters",array("id"=>$id));
		    $data['current'] = $query->result();
		    //var_dump($data['records']);
		    $data['id'] = $id; 
		}
		else {
			$data['title']='Add New transporter';
			//$data['current']='';
			//$data['id'] = ''; 
		}
	
	//echo $id;exit;
	    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
    $data['categories']=$this->transporter_model->getCategories();
    $data['states']=$this->transporter_model->getStates();

	$this->template->load('template','transporter_add',$data);

	//$this->load->view('footer');
	
	}
	public function getTransporterdetailsById($id){
		// echo $id;exit;
    	$data = array();
    	$data['transport_data']=$this->transporter_model->getIDById($id);
    	// $data['customers']=$this->customer_model->getcustomerById($id);
    	// print_r($data['transport_data']);exit;
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

	public function fetchtransporters(){
			$data['title'] = 'Transporters List';
		if($this->input->get())
		   {
		 	$conditions['transporter_id']=$this->input->get('transporter_id');
		 	$conditions['category_of_approval']=$this->input->get('category_of_approval');
	       	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			
           $data['transporters'] = $this->transporter_model->transporter_list_by_filter($conditions);

		}else{
		$data['transporters'] = $this->transporter_model->transporter_list();
		}
			$data['all_transporters']=$this->transporter_model->getAlltransporters();
		    $data['categories']=$this->transporter_model->getCategories();
		    //$data['states']=$this->transporter_model->getStates();
			//$this->load->model('transporter_model');
			
			$data['categories']=$this->transporter_model->getCategories();
			//$data['states']=$this->transporter_model->getStates();
			//print_r($data['transporters']);exit;
		
			$this->template->load('template','transporter_view',$data);
		}

	public function index() 
	{
		$this->fetchtransporters();
	}
	public function report() 
	{
		$data['title'] = 'transporters Report';
		$data['transporters'] = $this->transporter_model->transporter_list();
		//echo var_dump($data['students']);
		$this->template->load('template','transporter_report',$data);
	}

	public function add_new_transporter() {
		$this->form_validation->set_rules('transporter_name', 'transporter Name', 'required');
		
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

		if(!empty($this->input->post('states'))){
					if($this->input->post('states')!='All'){
		                $states=implode(',',$this->input->post('states'));
					}else{
						$states=$this->input->post('states');
					}	
                }
                else{
                	$states=$this->input->post('states');
                }
		
		if ($this->form_validation->run() == FALSE) 
		{
			//echo "hy";exit;
			if(isset($this->session->userdata['logged_in'])){
			$data['categories']=$this->transporter_model->getCategories();
			$this->template->load('template','transporter_add',$data);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','transporter_add');
		} 
		else 
		{
			$data = array(
			'transporter_name' => $this->input->post('transporter_name'),
			'transporter_type' => $this->input->post('transporter_type'),
			'vendor_code' => $this->input->post('vendor_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'alternate_no' => $this->input->post('alternate_no'),
			'website' => $this->input->post('website'),
			//'products' => $products,
			//'category_of_approval' => $this->input->post('category_of_approval'),
			'gst_status' => $this->input->post('gst_status'),
			'gst_no' => $gst_number,
			'pan_no' => $this->input->post('pan_no'),
			'tds' => $this->input->post('tds'),
			'tds_declaration' => $this->input->post('tds_declaration'),
			'states' =>$states,
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
			$result = $this->transporter_model->transporter_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'transporter Added Successfully  !');	
			redirect('/Transporters/index', 'refresh');
			//$this->fetchtransporters();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed, transporter Already exists !');
			redirect('/Transporters/index', 'refresh');
			}
		}
	}

	public function edit_transporter_view($id) { 
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$query = $this->db->get_where("transporters",array("id"=>$id));
        $data['current'] = $query->result();
		if (isset ($data['current'][0]->vendor_code) && $data['current'][0]->vendor_code) :
	            $data['tp_code'] = $data['current'][0]->vendor_code;
	            $voucher_no= $data['tp_code'];
	            if($voucher_no<10){
	            $transporter_id_code='TP000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $transporter_id_code='TP00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $transporter_id_code='TP0'.$voucher_no;
	            }
	            else{
	              $transporter_id_code='TP'.$voucher_no;
	            }
	            //print_r($employee_id_code);exit;
	            $data['vendor_code']=$transporter_id_code;
	        else:
	            $data['vendor_code'] = '';
	        endif;
       	//print_r($data['current']);exit;
        $data['old_id'] = $id; 
       // $data['categories']=$this->transporter_model->getCategoriesEditPage();
	    $data['prefix']= array('Mr.' => 'Mr.','Miss.'=>'Miss.','Ms.'=>'Ms.');
        $data['states']=$this->transporter_model->getStates();
        $this->template->load('template','transporter_edit',$data);

	}

	public function edittransporter($id){

		$this->form_validation->set_rules('transporter_name', 'transporter Name', 'required');
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
		
		$gst_number='';
		if($this->input->post('gst_status')=='Yes'){
			$gst_number=$this->input->post('gst_no');
		}else{
			$gst_number='NA';
		}
		//print_r($this->input->post('states'));exit;
		if(!empty($this->input->post('states'))){
					if($this->input->post('states')!='All'){
		                $states=implode(',',$this->input->post('states'));
					}else{
						$states=$this->input->post('states');
					}	
                }
                else{
                	$states=$this->input->post('states');
                }

		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->edit_transporter_view($id);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','transporter_edit');
		} 
		else 
		{
			$login_id=$this->session->userdata['logged_in']['id'];
			$data = array(
			'transporter_name' => $this->input->post('transporter_name'),
			'transporter_type' => $this->input->post('transporter_type'),

			'vendor_code' => $this->input->post('vendor_code'),
			'contact_person' => $this->input->post('contact_person'),
			'email' => $this->input->post('email'),
			'mobile_no' => $this->input->post('mobile_no'),
			'alternate_no' => $this->input->post('alternate_no'),
			'website' => $this->input->post('website'),
			//'products' => $products,
			'category_of_approval' => $this->input->post('category_of_approval'),
			'gst_status' => $this->input->post('gst_status'),
			'gst_no' => $gst_number,
			'pan_no' => $this->input->post('pan_no'),
			'tds' => $this->input->post('tds'),
			'tds_declaration' => $this->input->post('tds_declaration'),
			'states' => $states,
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
			$result = $this->transporter_model->edittransporter($data,$old_id);
			//echo $result;exit;
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'transporter Updated Successfully !');
			redirect('/Transporters/index','refresh');
			//$this->template->load('template','transporter_view');
			} else {
			$this->session->set_flashdata('failed', 'Updation Failed !');
			redirect('/Transporters/index','refresh');
			//$this->template->load('template','transporter_view');
			}
		}
	}

	public function deletetransporter($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->transporter_model->deletetransporter($id);

	  	 		}
  	 			echo $this->session->set_flashdata('success', 'transporter deleted Successfully !');
			}else{

  	 		$id = $this->uri->segment('3');
  	 		$this->transporter_model->deletetransporter($id);
  	 		$this->session->set_flashdata('success', 'transporter deleted Successfully !');
  	 		redirect('/Transporters/index', 'refresh');
  	 		//$this->fetchtransporters(); //render the refreshed list.
  	 	}
  	 }
  	  function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');
        $empInfo = $this->transporter_model->export_csv();
		
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Contact Person');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mobile No');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Website');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Approval Category');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Bank Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Account No');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Service State');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Date of Approval');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Date of Evalution ');       
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['transporter_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['vendor_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['contact_person']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['email']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['website']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['category_of_approval']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['bank_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['account_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['state']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['date_of_approval']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['date_of_evalution']);
            $rowCount++;
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="transporterData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/transporters/index', 'refresh');     
    }
 public function CheckTransporterCode($transporter_code)
   {
   	 $isExist = $this->transporter__model->CheckTransporterCode($transporter_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   }
     public function getTransporterByCategory($id=NULL){
    	$data = array();
    	$data['transporters']=$this->transporter_model->getTransporterByCategory($id);
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }

    public function getTransporterById($id=NULL){
    	$data = array();
    	$data['transporters_data']=$this->transporter_model->getTransporterById($id);
    	//print_r($data['transporters_data']);exit;
    	echo json_encode($this->load->view('supplierbycategory',$data));
    }
}

?>