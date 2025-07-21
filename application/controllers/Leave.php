<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Class Leave extends MY_Controller {

public function __construct() {
parent::__construct();
if(!$this->session->userdata['logged_in']['id']){
    redirect('User_authentication/index');
}
require_once APPPATH . "/third_party/PHPExcel.php";

// $this->excel = new PHPExcel(); 

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
$this->load->model('Leave_model');
$this->load->model('master_model');
$this->load->model('notifications_model');
}

// Show login page	

	public function index() 
	{
		$data = array();
		$data['title'] 			='Leave History';
		$data['designation_id']	=$this->session->userdata['logged_in']['designation_id'];
		$data['login_id']		=$this->session->userdata['logged_in']['id'];
		$login_id				=$this->session->userdata['logged_in']['id'];
		
		$conditions=[];

		if($this->input->get()) {

		 	$conditions['category_name'] = $this->input->get('category_name');
            $conditions['employee_id'] 	 = $this->input->get('employee_id');
            $conditions['leave_status']  = $this->input->get('leave_status');

            if(!empty($this->input->get('upto_date'))) {
				$conditions['upto_date'] = date('Y-m-d',strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date'] = "";
			}
			if(!empty($this->input->get('from_date'))) {
				$conditions['from_date'] = date('Y-m-d',strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date'] = "";
			}

			$conditions['login_id'] = $login_id;
			$data['filtered_value'] = $conditions;
			
			$data['leaves']= $this->Leave_model->LeaveListCSV($conditions);
		}
		else
		{
			$conditions['login_id'] = $login_id;
			$conditions['category_name']="";
			$conditions['employee_id'] 	= "";
			$conditions['leave_status'] = "";
			$conditions['upto_date'] 	= "";
			$conditions['from_date'] 	= "";
			$data['filtered_value'] = $conditions; 
			$data['leaves']			= $this->Leave_model->LeaveListCSV($conditions);
			$data['filtered_value'] = "";
		}
	
		$data['employees'] = $this->Leave_model->getEmployeeDropdown();
		// $this->Leave_model->sendMail('42') ;
		// echo "<pre>"; print_r($data['filtered_value']); exit;
		$this->template->load('layout/template', 'leave-module/leave_view', $data);
		// $this->template->load('template','leave_view',$data);
	}

	
	public function Approval() 
	{
		$data = array();
		$data['title'] 			='Leave History';
		$data['designation_id']	=$this->session->userdata['logged_in']['designation_id'];
		$data['department_id']	=$this->session->userdata['logged_in']['department_id'];
		$data['role_id']	=$this->session->userdata['logged_in']['role_id'];
		$data['login_id']		=$this->session->userdata['logged_in']['id'];
		$login_id				=$this->session->userdata['logged_in']['id'];
		
		$conditions=[];

		if($this->input->get()) {

		 	$conditions['category_name'] = $this->input->get('category_name');
            $conditions['employee_id'] 	 = $this->input->get('employee_id');
            $conditions['leave_status']  = $this->input->get('leave_status');

            if(!empty($this->input->get('upto_date'))) {
				$conditions['upto_date'] = date('Y-m-d',strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date'] = "";
			}
			if(!empty($this->input->get('from_date'))) {
				$conditions['from_date'] = date('Y-m-d',strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date'] = "";
			}

			$conditions['login_id'] = $login_id;
			
			$data['leaves']			= $this->Leave_model->LeaveApprovalList($conditions);
			
			$data['filtered_value'] = $conditions;
		}
		else
		{
			// $conditions['login_id'] 	= $login_id;
			// $conditions['employee_id'] 	= "";
			// $conditions['leave_status'] = "";
			// $conditions['upto_date'] 	= "";
			// $conditions['from_date'] 	= "";
			$data['leaves']			= $this->Leave_model->LeaveApprovalList();
			// echo "<pre>";print_r($data['leaves']);exit;
			$data['filtered_value'] = "";
		}
		if(($data['role_id'] == 4) || ($data['role_id'] == 3))
		{
			$data['employees'] = $this->Leave_model->getEmployeeDropdown($data['department_id'],$login_id);
		}else{
			$data['employees'] = $this->Leave_model->getEmployeeDropdown('',$login_id);
			// echo "<pre>";print_r($data['employees']);exit;
		}

		// $this->Leave_model->sendMail('42') ;
		//echo "<pre>"; print_r($data); exit;
		$this->template->load('layout/template','leave-module/leave_approval',$data);
	}
	


	// Leave Allotment
	public function leave_allotment() {
		$data['title'] = 'Leave Allotment';
		$data['leaves'] 	= $this->Leave_model->getAllotedLeaves();
		$data['months'] 	= $this->Leave_model->getMonths();
		$data['employees']  = $this->Leave_model->getEmployeesList();
		$this->template->load('layout/template','leave-module/leave_allotment',$data);
	}

	public function add_leave_allotment() {
		$leave_year = date('Y');

		foreach ( $this->input->post('emp_id') as $key=>$emp_id) {
			$data = array(
				'emp_id' 		=> $emp_id,	
				'leave_count'	=> $this->input->post('leave_count')[$key],
				'leave_month' 	=> $this->input->post('month_id'),
				'leave_year' 	=> $leave_year,
			);
			$this->db->insert('leave_allotment', $data);
		}
		$this->session->set_flashdata('success', 'Leave allotement succes!');	
		redirect('/Leave/leave_allotment', 'refresh');
	}


	public function createXLS() {
		$fileName = 'leaves-'.date('d-m-Y').'.xlsx';
		$conditions=[];
		if($this->input->post()) {
		 	$conditions['category_name'] = $this->input->post('category_name');
            $conditions['employee_id'] 	 = $this->input->post('employee_id');
            $conditions['leave_status']  = $this->input->post('leave_status');
            if(!empty($this->input->post('upto_date'))) {
				$conditions['upto_date'] = date('Y-m-d',strtotime($this->input->post('upto_date')));
			} else {
				$conditions['upto_date'] = "";
			}
			if(!empty($this->input->post('from_date'))) {
				$conditions['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
			} else {
				$conditions['from_date'] = "";
			}
			$leaves = $this->Leave_model->LeaveListCSV($conditions);
		} else {
		 	$leaves = $this->Leave_model->LeaveListCSV();
		}
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'Employee');
        $sheet->setCellValue('B1', 'Status');
        $sheet->setCellValue('C1', 'Leave Type');
        $sheet->setCellValue('D1', 'Leave Reason');    
        $rows = 2;
        foreach ($leaves as $val){
            $sheet->setCellValue('A' . $rows, $val['employee']);
            $sheet->setCellValue('B' . $rows, $val['leave_status']);
            $sheet->setCellValue('C' . $rows, $val['leave_type']);
            $sheet->setCellValue('D' . $rows, $val['leave_reason']);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
		//echo "<pre>"; print_r($sheet); exit;
		$writer->save("uploads/Leaves/".$fileName);
		//header("Content-Type: application/vnd.ms-excel");
		$this->session->set_flashdata('success', 'Excel file added in leaves folder in uploads!');	
		redirect('/Leave/index', 'refresh');
    }

    // Create Excel Sheet : Leaves
    function createXLS_1() {
		//echo "<pre>"; print_r($_POST);
		
		$conditions=[];
		if($this->input->post()) {
		 	$conditions['category_name'] = $this->input->post('category_name');
            $conditions['employee_id'] 	 = $this->input->post('employee_id');
            $conditions['leave_status']  = $this->input->post('leave_status');
            if(!empty($this->input->post('upto_date'))) {
				$conditions['upto_date'] = date('Y-m-d',strtotime($this->input->post('upto_date')));
			} else {
				$conditions['upto_date'] = "";
			}
			if(!empty($this->input->post('from_date'))) {
				$conditions['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
			} else {
				$conditions['from_date'] = "";
			}
			$leaves = $this->Leave_model->LeaveListCSV($conditions);
		} else {
		 	$leaves = $this->Leave_model->LeaveListCSV();
		}
		
		//echo "<pre>"; print_r($leaves); exit;

        // create file name
        $fileName ='leaves-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
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
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Employee');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Leave Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Leave Reason');
        // set Row
        $rowCount = 2;
        foreach ($leaves as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['leave_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['leave_type']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['leave_reason']);
            $rowCount++;
        }
        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Customer_Report.xls"');
        $objWriter->save('php://output');
        redirect('/Leave/index', 'refresh');
    }

	public function History() 
	{
		$data['title'] = ' Leave Report History';
		
		$conditions=[];
		if($this->input->get()) {
		 	$conditions['name']  = $this->input->get('name');
            $conditions['leave_type'] = $this->input->get('leave_type');
            $conditions['leave_status'] = $this->input->get('leave_status');
            if(!empty($this->input->get('upto_date'))) {
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date']= "";
			}
			if(!empty($this->input->get('from_date'))) {
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date']= "";
			}
			// echo "<pre>";
			// print_r($_GET);

			$data['leads'] = $this->Leave_model->LeadListCSV($conditions);
			$data['filtered_value']=$conditions;
		} else {
		 	$data['leads'] = $this->Leave_model->LeaveListCSV();
		}
		//echo var_dump($data['students']);
		//print_r($data['item_name']);exit;
		
		//$data['categories'] = $this->Leave_model->getLeadsCategories();
		$data['employees'] = $this->Leave_model->getEmployeesList();
		$data['leave_types'] = $this->Leave_model->getLeaveStatus();
		$this->template->load('template','leave_report_view',$data);
	}
	public function holidays($id = NULL) 
	{
		
		$data = array();
		$data['page_title'] = ' Holidays Master';
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
		$data['role_id']	=$this->session->userdata['logged_in']['role_id'];
		$result = $this->Leave_model->getByIdHoliday($id);
  
		if (isset($result['id']) && $result['id']) :
				$data['id'] = $result['id'];
			else:
				$data['id'] = '';
			endif; 
  
		if (isset($result['title'])) :
				$data['title'] = $result['title'];
		   else:
				$data['title'] = '';
			endif;

			if (isset($result['date'])) :
				$data['date'] = $result['date'];
		   else:
				$data['date'] = '';
			endif;

		if (isset($result['flag'])) :
				$data['flag'] = $result['flag'];
		   else:
				$data['flag'] = '';
			endif;

  
		$data['categories'] = $this->Leave_model->categoriesList();
		$this->template->load('layout/template','leave-module/holiday_view',$data);
	}
	public function balance($id = NULL) 
	{
		$data = array();
		$data['page_title'] = 'Leave Balance List';
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
            $login_id=$this->session->userdata['logged_in']['id'];
		$result = $this->Leave_model->getByIdBalance($id);
  
		if (isset($result['id']) && $result['id']) :
				$data['id'] = $result['id'];
			else:
				$data['id'] = '';
			endif; 
  
		if (isset($result['leave_id'])) :
				$data['leave_id'] = $result['leave_id'];
		   else:
				$data['leave_id'] = '';
			endif;

			if (isset($result['employee_id'])) :
				$data['employee_id'] = $result['employee_id'];
		   else:
				$data['employee_id'] = '';
			endif;

			if (isset($result['leave_type_id'])) :
				$data['leave_type_id'] = $result['leave_type_id'];
		   else:
				$data['leave_type_id'] = '';
			endif;

			if (isset($result['leave_count'])) :
				$data['leave_count'] = $result['leave_count'];
		   else:
				$data['leave_count'] = '';
			endif;
			if($data['designation_id']==1||['designation_id']==2||['designation_id']==4){
			   $data['leave_taken'] = $this->Leave_model->BalanceList();
		 }
		 else{ 
		 
		  $data['leave_taken']=$this->Leave_model->BalanceListByEmployee($login_id);
		 }

		
		// echo "<pre>"; print_r($data);exit;
		$this->template->load('layout/template','leave_balance_view',$data);
	}
	public function types($id = NULL) 
	{
		$data = array();
		$data['page_title'] = ' Leave Master';
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
		$result = $this->Leave_model->getByIdLavetype($id);
  
		if (isset($result['id']) && $result['id']) :
				$data['id'] = $result['id'];
			else:
				$data['id'] = '';
			endif; 
  
		if (isset($result['leave_type'])) :
				$data['leave_type'] = $result['leave_type'];
		   else:
				$data['leave_type'] = '';
			endif;

			if (isset($result['leave_balance'])) :
				$data['leave_balance'] = $result['leave_balance'];
		   else:
				$data['leave_balance'] = '';
			endif;

		if (isset($result['flag'])) :
				$data['flag'] = $result['flag'];
		   else:
				$data['flag'] = '';
			endif;

  
		$data['types'] = $this->Leave_model->typesList();
		$this->template->load('layout/template','leave-module/leavetype_view',$data);
	}

	public function add_new_leavetype() {
    
		$this->form_validation->set_rules('leave_type', 'Title ', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
		  if(isset($this->session->userdata['logged_in'])){
		  $this->index();
		  //$this->template->load('template','category_master');
		  //$this->load->view('admin_page');
		  }else{
		  $this->load->view('login_form');
		  }
		  //$this->template->load('template','supplier_add');
		}
		else 
		{
		  
		  $data = array(
		  'leave_type' => $this->input->post('leave_type'),
		  'leave_balance' => $this->input->post('leave_balance'),
		  
		  );
		  $result = $this->Leave_model->Leavetype_insert($data);
		  if ($result == TRUE) {
		  

			$this->session->set_flashdata('success', 'Leave Type Added Successfully !');
			redirect('/Leave/types', 'refresh');
		  } else {
		  $this->session->set_flashdata('failed', 'Already exists, Leave Type Could not added !');
		  redirect('/Leave/types', 'refresh');
		  }
		} 
	  }
	  public function editLeavetype($id) {
		$this->form_validation->set_rules('leave_type', 'Leave Master', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
		  if(isset($this->session->userdata['logged_in'])){
			$this->index();
		  //$this->template->load('template','category_master');
		  //$this->load->view('admin_page');
		  }else{
		  $this->load->view('login_form');
		  }
		  //$this->template->load('template','supplier_add');
		}
		else 
		{
		  $data = array(
		  //'id' => $id,
		  'leave_type' => $this->input->post('leave_type'),
		  'flag' => $this->input->post('flag')
		  );
		  $result = $this->Leave_model->Leavetype_update($data,$id);
		  //echo $result;exit;
		  if ($result == TRUE) {
		  $this->session->set_flashdata('success', 'Leave Type Updated Successfully !');
		  redirect('/Leave/types', 'refresh');
		  //$this->fetchSuppliers();
		  }
		  else {
		  $this->session->set_flashdata('failed', 'No Changes in Leave Type !');
		  redirect('/Leave/types', 'refresh');
		  }
		} 
	  }


	public function add_new_leave() {
    
		$this->form_validation->set_rules('title', 'Title ', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
		  if(isset($this->session->userdata['logged_in'])){
		  $this->index();
		  //$this->template->load('template','category_master');
		  //$this->load->view('admin_page');
		  }else{
		  $this->load->view('login_form');
		  }
		  //$this->template->load('template','supplier_add');
		}
		else 
		{
		  
		  $data = array(
		  'title' => $this->input->post('title'),
		  'date' => date('Y-m-d',strtotime($this->input->post('holiday_date'))),
		  'year' => date('Y',strtotime($this->input->post('holiday_date')))
		  );
		  $result = $this->Leave_model->holiday_insert($data);
		  if ($result == TRUE) {
		  

			$this->session->set_flashdata('success', 'holiday Added Successfully !');
			redirect('/Leave/holidays', 'refresh');
		  } else {
		  $this->session->set_flashdata('failed', 'Already exists, holiday Could not added !');
		  redirect('/Leave/holidays', 'refresh');
		  }
		} 
	  }

	  
	public function followups($id = NULL) 
	{
		$data=[];
		$data['id']=$this->uri->segment('3');
		$data['title'] = ' Lead Follow Ups';
		$data['followups'] = $this->Leave_model->getFollowUps($id);
		//$data['categories'] = $this->Leave_model->getCategories();
		//echo var_dump($data['students']);
		//print_r($data['followups']);exit;
		$this->template->load('template','lead_followups',$data);
	}
	public function importdata()
	{	

		if ($this->input->post('submit')) 
		{
			$login_id=$this->session->userdata['logged_in']['id'];
				// echo "<pre>";
				// print_r($_FILES);
				$path = './uploads/';
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = TRUE;

				//print_r($config);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);            
				if (!$this->upload->do_upload('uploadFile')) {
					$error = array('error' => $this->upload->display_errors());
					//($error);exit;
				} else {
					$data = array('upload_data' => $this->upload->data());
					//print_r($data);exit;
				}
			//echo "hy";exit;
			if(empty($error))
			{
				if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
				} else {
				$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				//sizeof($allDataInSheet);exit;

				
				

				$flag = true;
				$i=0;
				foreach ($allDataInSheet as $value) 
				{
					if($flag){
					$flag =false;
					continue;
					}
					
					
				    //$data['lead_code_view']=$rs_id_code;

					
					if(!empty($value['B'])){

						$inserdata[$i]['date'] = $value['A'];
						$inserdata[$i]['category_name'] = $value['B'];
						$inserdata[$i]['work_description'] = $value['C'];
						$inserdata[$i]['contact_person'] = $value['D'];
						$inserdata[$i]['mobile'] = $value['E'];
						$inserdata[$i]['email'] = $value['F'];
						$inserdata[$i]['website'] = $value['G'];
						$inserdata[$i]['lead_source'] = $value['H'];
						$inserdata[$i]['company_name'] = $value['I'];
						$inserdata[$i]['country'] = $value['J'];
						$inserdata[$i]['lead_status'] = $value['K'];
						$inserdata[$i]['created_by'] = $login_id;
						$i++;
					}

					
				}    
				// echo "<pre>";
				// print_r($inserdata);exit;           
				$result = $this->Leave_model->saverecords($inserdata);   
				if($result)
				{
					// echo "Imported successfully";
					$this->session->set_flashdata('success', 'Imported successfully !');
					redirect('/Leave/index/', 'refresh');
				}else{
					$this->session->set_flashdata('success', 'Import Failed !');
					redirect('/Leave/index/', 'refresh');
				}             
				} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
				}
			}
				else{
					echo $error['error'];
				}
		}
		$this->template->load('template','leads_view',$data);
}

	// public function importdata(){
	// 	if(isset($_POST["submit"]))
	// 	{
	// 		$file = $_FILES['file']['tmp_name'];
	// 		// print_r($file);exit;
	// 		$handle = fopen($file, "r");
	// 		//print_r($handle);exit;
	// 		$c = 0;//
	// 		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	// 		{	
	// 			 print_r($filesop);exit;

	// 			$date = $filesop[0];
	// 			$name = $filesop[1];
	// 			$work_description = $filesop[2];
	// 			$company_name = $filesop[3];
	// 			$mobile = $filesop[4];
	// 			$email = $filesop[5];
	// 			$website = $filesop[6];
	// 			if($c<>0){		

	// 			$data['login_id']=$this->session->userdata['logged_in']['id'];
	// 			$data = array(
	// 			'date' => date('Y-m-d',strtotime($date)),	
	// 			'name' => $name,
	// 			'work_description' => $work_description,
	// 			'company_name' => $company_name,
	// 			'mobile' => $mobile,
	// 			'email' => $email,
	// 			'website' => $website,
	// 			'created_by' => $data['login_id'],
	// 			'action' =>'',				
	// 			'status' =>'',				
	// 			);
	// 				$result = $this->Leave_model->saverecords($data);


	// 				// 		/* SKIP THE FIRST ROW */
	// 				// $this->Leave_model->saverecords($fname,$lname);
	// 			}
	// 			$c = $c + 1;
	// 		}
	// 		echo "sucessfully import data !";
				
	// 	}
				
	// }
	
	public function add_followup() {
		
		$this->form_validation->set_rules('leave_id', 'lead_id', 'required');
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
			$lead_id=$this->input->post('lead_id');
			$data['login_id']=$this->session->userdata['logged_in']['id'];
			$data = array(
			'lead_id' => $this->input->post('lead_id'),	
			'answer' => $this->input->post('answer'),
			'followup_by' => $data['login_id']				
			);
			$result = $this->Leave_model->insertFollowup($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Follow Up Added Successfully !');
			redirect('/Leave/followups/'.$lead_id, 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists , Follow Up Not Inserted !');
			redirect('/Leave/followups/'.$lead_id, 'refresh');
			}
		} 
	}

	public function create() 
	{		
		$data = array();
		$data['page_title'] 	= 'Apply For Leave';
		$data['login_id']		= $this->session->userdata['logged_in']['id'];
		$data['role_id']		= $this->session->userdata['logged_in']['role_id'];
		$data['leave_types'] 	= $this->Leave_model->getleavetype();
		// $data['categories'] 	= $this->Leave_model->getCategories();
		// $data['employees'] 	= $this->Leave_model->getEmployees();

		$data['id']				= '';
		$data['title'] 			= '';
		$data['employee_id'] 	= '';
		$data['from_date'] 		= '';
		$data['reason'] 		= '';
		$data['halfday_date'] 	= '';
		$data['apply_date'] 	= '';
		//$data['country'] 		= '';
		//$data['description'] 	= '';
		$data['leave_status'] 	= '';
		$data['total_count'] 	= $this->Leave_model->getLeadcsvCode();
		$voucher_no= $data['total_count']+1;
	    if($voucher_no<10){
	    	$rs_id_code='MUSK000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	    	$rs_id_code		= 'MUSK00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      	$rs_id_code		= 'MUSK0'.$voucher_no;
	    }
	    else{
	      	$rs_id_code		= 'MUSK'.$voucher_no;
	    }
	    $data['lead_code']	= $rs_id_code;
		// get holidays
    	$data['holidays'] = $this->Leave_model->get_all_holiday_dates();

	    $this->template->load('layout/template','leave-module/leave_add',$data);
	}
			
	
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->Leave_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['leave_status'])) :
	            $data['leave_status'] = $result['leave_status'];
	       else:
	            $data['leave_status'] = '';
	        endif;

			if (isset($result['leave_type_id'])) :
	            $data['leave_type_id'] = $result['leave_type_id'];
	       else:
	            $data['leave_type_id'] = '';
	        endif;

			if (isset($result['total_count'])) :
	            $data['total_count'] = $result['total_count'];
	       else:
	            $data['total_count'] = '';
	        endif;

			if (isset($result['employee_id'])) :
	            $data['employee_id'] = $result['employee_id'];
	       else:
	            $data['employee_id'] = '';
	        endif;
			
			$data['page_title'] = ' Leave Action Page';
			
			$data['leave_types'] = $this->Leave_model->getleavetype();
			// $data['categories'] = $this->Leave_model->getCategories();
		 
		
			$this->template->load('layout/template','leave-module/leave_action',$data);
	}
	
	public function add_new_item() {

		//echo "<pre>";print_r($_POST);

		$this->form_validation->set_rules('apply_date', 'Apply Date', 'required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
				$this->add();
				//$this->load->view('admin_page');
			} else {
				$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			$from_date		='0000-00-00';
			$upto_date		='0000-00-00';
			$halfday_date	='0000-00-00';
			$halfday_type	='';
			$gate_date		='0000-00-00';
			$gate_time_from	='';
			$gate_time_to	='';

			if($this->input->post('leave_category') =='full'){
				$from_date 		= date('Y-m-d',strtotime($this->input->post('from_date')));
				$upto_date 		= date('Y-m-d',strtotime($this->input->post('upto_date')));
				$leave_count	= $this->input->post('leave_count');
			}
			
			if($this->input->post('leave_category') =='half'){
				$halfday_date = date('Y-m-d',strtotime($this->input->post('halfday_date')));
				$halfday_type = $this->input->post('halfday_type');
				$leave_count  = 0.5;
			}
			
			if($this->input->post('leave_category') =='gatepass'){
				$gate_date		= date('Y-m-d',strtotime($this->input->post('gate_date')));
				$gate_time_from = $this->input->post('gate_time_from');
				$gate_time_to 	= $this->input->post('gate_time_to');
				$leave_count	= 0;
			}

			$data['login_id']=$this->session->userdata['logged_in']['id'];

			$data = array(
				'apply_date' 		=> date('Y-m-d',strtotime($this->input->post('apply_date'))),
				'employee_id' 		=> $data['login_id'],
				'leave_category' 	=> $this->input->post('leave_category'),
				'leave_type_id' 	=> $this->input->post('leave_type'),
				'from_date' 		=> $from_date,
				'upto_date' 		=> $upto_date,
				'total_count' 		=> $leave_count,
				'halfday_type' 		=> $halfday_type,
				'halfday_date' 		=> $halfday_date,
				'gate_date' 		=> $gate_date,
				'gate_time_from'	=> $gate_time_from,
				'gate_time_to' 		=> $gate_time_to,
				'leave_status' 		=> 'Pending',
				'leave_reason' 		=> $this->input->post('leave_reason'),
				'message' 			=> $this->input->post('message'),
				'created_by' 		=> $data['login_id']
			);

			// echo "<pre>";print_r($data);exit;

			$result = $this->Leave_model->insert($data);
			$data['author_id']		= $this->session->userdata['logged_in']['author_id'];
			$login_id=$this->session->userdata['logged_in']['id'];
			// echo"<pre>";print_r($result);exit;
			if ($result) {
				// echo"<pre>";print_r($result);exit;
				
				$data1 = array(
					'type' => ' leave-apply',
					'subject' => 'Apply For Leave ',
					'message' => 'Applied for  new Leave',
					'page_url' => 'Leave/index',
					'employee_id' =>$data['author_id'],
					'status' => '0',
					'leave_id' => $result,
					'datetime' => date('Y-m-d h:i:s'),
					'created_by' => $login_id,
			);
			$result1 = $this->notifications_model->add_notification($data1);
			// echo"<pre>";print_r($result1);exit;
				$this->session->set_flashdata('success', 'Leave Applied Successfully !');
				redirect('/Leave/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'Already Exists , Leave Not Inserted !');
				redirect('/Leave/index', 'refresh');
			}
		} 
	}
    public function editHoliday($id) {
		$this->form_validation->set_rules('title', 'Holiday Master', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
		  if(isset($this->session->userdata['logged_in'])){
			$this->index();
		  //$this->template->load('template','category_master');
		  //$this->load->view('admin_page');
		  }else{
		  $this->load->view('login_form');
		  }
		  //$this->template->load('template','supplier_add');
		}
		else 
		{
		  $data = array(
		  //'id' => $id,
		  'title' => $this->input->post('title'),
		  'date' => date('Y-m-d',strtotime($this->input->post('holiday_date'))),
		  'year' => date('Y',strtotime($this->input->post('holiday_date'))),
		  'flag' => $this->input->post('flag')
		  );
		  $result = $this->Leave_model->holiday_update($data,$id);
		  //echo $result;exit;
		  if ($result == TRUE) {
		  $this->session->set_flashdata('success', 'Holiday Updated Successfully !');
		  redirect('/Leave/holidays', 'refresh');
		  //$this->fetchSuppliers();
		  }
		  else {
		  $this->session->set_flashdata('failed', 'No Changes in Holiday !');
		  redirect('/Leave/holidays', 'refresh');
		  }
		} 
	  }

	public function leave_action($id) {
		$data['author_id']		= $this->session->userdata['logged_in']['author_id'];
		$leave_status=$this->input->post('leave_status');
		$employee_id=$this->input->post('employee_id');
		$login_id=$this->session->userdata['logged_in']['id'];
			$data_arr = array(
			'leave_status' => $this->input->post('leave_status')
			);

		$result = $this->Leave_model->leave_update($data_arr, $id);

		//echo $result;exit;
		if($result == TRUE) {
			$data1 = array(
			'type' => 'leave-action',
			'employee_id' => $employee_id,
			'subject' => 'Leave Aprroved',
			'message' => $leave_status.' Leave',
			'status' => '0',
			'leave_id' => $id,
			'page_url' => 'Leave/index',
			'datetime' => date('Y-m-d h:i:s'),
			'created_by' => $login_id,
			'created_on'=>date('Y-m-d h:i:s'),
			);

			$this->notifications_model->add_notification($data1);
			if($this->input->post('leave_status') == 'Approved'){
				if($this->input->post('leave_type_id') != 3){
					$data_taken = array(
					//'id' => $id,
					'leave_id' => $id,
					'employee_id' => $this->input->post('employee_id'),
					'leave_type_id' => $this->input->post('leave_type_id'),
					'leave_count' => $this->input->post('leave_count'),
					);
					$this->Leave_model->leave_taken($data_taken);
				}
			}
			if($this->input->post('leave_status')=='Cancelled')
			{
				// print_r($this->input->post('leave_status'));
				// print_r($id);exit;	
				$this->Leave_model->deleteleave($id);
			}

			$this->Leave_model->SendReplyEmail($id);

			$this->session->set_flashdata('success', 'leave Updated Successfully !');
			redirect('/Leave/Approval', 'refresh');
		  	//$this->fetchSuppliers();
		}
		else {
			$this->session->set_flashdata('failed', 'No Changes in leave !');
			redirect('/Leave/Approval', 'refresh');
		}
	}

	public function edititem($id) {
		$this->form_validation->set_rules('title', 'title Name', 'required');
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
			$data['login_id']=$this->session->userdata['logged_in']['id'];
			$data = array(
			'category_name' => $this->input->post('category_name'),	
			'lead_code' => $this->input->post('lead_code'),
			'work_description' => $this->input->post('title'),
			//'contact_person' => $this->input->post('contact_person'),
			//'mobile' => $this->input->post('mobile'),	
			//'email' => $this->input->post('email'),	
			// 'company_name' => $this->input->post('company_name'),	
			'date' => date('Y-m-d',strtotime($this->input->post('generation_date'))),			
			'lead_source' => $this->input->post('lead_source'),			
			'website' => $this->input->post('website'),			
			'country' => $this->input->post('country'),
			'leave_status' => $this->input->post('leave_status'),	
			'edited_by' => $data['login_id']			
			);
			$lead=$this->input->post('old_lead_id');
			//print_r($item_id);exit;
			$result = $this->Leave_model->lead_update($data,$lead);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Lead Updated Successfully !');
			redirect('/Leave/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Lead !');
			redirect('/Leave/index', 'refresh');
			}
		} 
	}

	public function deleteItem($id= null){
		$id = $this->uri->segment('3');
		$result =$this->Leave_model->deleteItem($id);
		if ($result == TRUE) {
		$this->session->set_flashdata('success', 'Leave deleted Successfully !');
		redirect('/Leave/index', 'refresh');
		//$this->fetchSuppliers();
		} else {
		$this->session->set_flashdata('failed', 'Operation Failed!');
		redirect('/Leave/index', 'refresh');
		}
	}

	public function deletefollowup($id= null){
		$id = $this->uri->segment('3');
		$lead_id=$this->input->post('lead_id');
		$result =$this->Leave_model->deletefollowup($id);
		if ($result == TRUE) {
		$this->session->set_flashdata('success', 'Follow Up deleted Successfully !');
		redirect('/Leave/followups/'.$lead_id, 'refresh');
		//$this->fetchSuppliers();
		} else {
		$this->session->set_flashdata('failed', 'Operation Failed!');
		redirect('/Leave/index/'.$lead_id, 'refresh');
		}
	}

  	public function getProductsByCategory($id=NULL){
    	$data = array();
    	$data['products']=$this->Leave_model->getProductsByCategory($id);
    	echo json_encode($this->load->view('productbycategory',$data));
    }

}

?>