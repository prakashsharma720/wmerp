<?php

//session_start(); //we need to start session in order to access it through CI

Class Area_cleaning_records extends MY_Controller {

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
// Load session library
$this->load->library('session');
$this->load->library('template');
// Load database
$this->load->model('area_cleaning_record_model');
}

// Show login page
public function index() {
			$data['title'] = 'Area Cleaning Records List';
			$data['area_cleaning_records'] = $this->area_cleaning_record_model->AreaCleaningList();
			//$data['roles'] = $this->area_cleaning_record_model->getRoles();
			//$data['departments'] = $this->area_cleaning_record_model->getDepartments();	
			//echo var_dump($data['students']);
			//print_r($data['area_cleaning_records']);exit;
			$this->template->load('template','area_cleaning_view',$data);
	}


	public function report() 
	{
		$data['title'] = 'Waste Material records Report';
		$data['areas'] = $this->area_cleaning_record_model->getAreas();
		// echo "<pre>"; print_r($data); die;
        $data['workers'] = $this->area_cleaning_record_model->getWorkers();
		if($this->input->get())
			{
			 	$conditions['area']=$this->input->get('area');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;

	           $data['area_cleaning_records'] = $this->area_cleaning_record_model->AreaCleaningList($conditions);

			}
			else{
				$data['area_cleaning_records'] = $this->area_cleaning_record_model->AreaCleaningList();
			}
			// echo "<pre>"; print_r($data['area_cleaning_records']); die;
			
		$this->template->load('template','area_cleaning_report',$data);
	}


	function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
			{
			 	$conditions['area']=$this->input->post('area');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
			 	$data['conditions']=$conditions;

	           $reqSlipInfo = $this->area_cleaning_record_model->AreaCleaningList($conditions);

			}
			else{
				$reqSlipInfo = $this->area_cleaning_record_model->AreaCleaningList();
			}

        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Of Cleaning');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Frequency');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Work Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Area Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Worker Name '); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Reported By '); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Remarks '); 
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $key=>$element) {

        	$voucher_no= $element['worker_code']; 
                    if($voucher_no<10){
                    $worker_id_code='WC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $worker_id_code='WC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $worker_id_code='WC0'.$voucher_no;
                    }
                    else{
                      $worker_id_code='WC'.$voucher_no;
                    }

                     $voucher_no= $element['emp_code']; 
                    if($voucher_no<10){
                    $employee_id_code='EC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $employee_id_code='EC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $employee_id_code='EC0'.$voucher_no;
                    }
                    else{
                      $employee_id_code='EC'.$voucher_no;
                    }

                     $emp_name = $element['emp_name'].' ('.$employee_id_code.')';

                    $worker_name = $element['worker_name'].' ('.$worker_id_code.')';
        	
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['date_of_cleaning']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['frequency']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['status_of_work']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['area_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $worker_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $emp_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['remark']);
            $rowCount++;
        	
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Area-Cleaning-Records.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Area_cleaning_records/report', 'refresh');     
    }

	
	

	public function add() 
	{
			$data = array();
			$data['title'] = 'Create New Area Cleaning Record';
			//$data['employees'] = $this->area_cleaning_record_model->employeesList();
			
			$data['acr_code'] = $this->area_cleaning_record_model->getACRCode();
			$voucher_no= $data['acr_code'];
            if($voucher_no<10){
            $acr_code_view='ACR000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $acr_code_view='ACR00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $acr_code_view='ACR0'.$voucher_no;
            }
            else{
              $acr_code_view='ACR'.$voucher_no;
            }
            //print_r($acr_code_view);exit;
            $data['acr_code_view']=$acr_code_view;
            $data['areas'] = $this->area_cleaning_record_model->getAreas();
            $data['workers'] = $this->area_cleaning_record_model->getWorkers();
			//print_r($data['departments']);exit;
			$this->template->load('template','area_cleaning_add',$data);
	}
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->area_cleaning_record_model->getById($id);
			//print_r($result[0]['voucher_code']);exit;
			if (isset($result[0]['id'])) :
	            $data['id'] = $result[0]['id'];
	        else:
	            $data['id'] = '';
	        endif;

	       if (isset($result[0]['voucher_code'])) {
				$data['acr_code_view']=$result[0]['voucher_code'];
            }else{
            	$data['acr_code_view']='';	
            }

	        if (isset($result[0]['transaction_date'])) :
	            $data['transaction_date'] = $result[0]['transaction_date'];
	       else:
	            $data['transaction_date'] = '';
	        endif;
	      
	         if (isset($result[0]['area_cleaning_details'])) :
	            $data['area_cleaning_details'] = $result[0]['area_cleaning_details'];
	       else:
	            $data['area_cleaning_details'] = '';
	        endif;
	     
			$data['title'] = 'Edit Area Cleaning Record';
			 $data['areas'] = $this->area_cleaning_record_model->getAreas();
            $data['workers'] = $this->area_cleaning_record_model->getWorkers();
			//print_r($data);exit;
			$this->template->load('template','area_cleaning_edit',$data);
	}
	public function add_new_record() {

		$this->form_validation->set_rules('transaction_date', 'Date Of Cleaning', 'required');
	
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			redirect('/Area_cleaning_records/add');
			}else{
			$this->load->view('login_form');
			}
		}
		else 
		{
	        $loginId=$this->session->userdata['logged_in']['id'];
	  		
			$data = array(
			'voucher_code' => $this->input->post('voucher_code'),
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'created_by' => $loginId,
			);

			$result = $this->area_cleaning_record_model->record_insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Area cleaning Record Created Successfully !');
			redirect('/Area_cleaning_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Area cleaning Record insertion failed!');
			redirect('/Area_cleaning_records/index', 'refresh');
			}
		} 
	}

	public function editrecord($id) {
		$this->form_validation->set_rules('transaction_date', 'Date Of Cleaning', 'required');
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
			$loginId=$this->session->userdata['logged_in']['id'];

			$data = array(
			'voucher_code' => $this->input->post('voucher_code'),
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'edited_by' => $loginId,
			);

			$result = $this->area_cleaning_record_model->record_update($data,$id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Area Cleaning Record Updated Successfully !');
			redirect('/Area_cleaning_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Area Cleaning Record !');
			redirect('/Area_cleaning_records/index', 'refresh');
			}
		} 
	}
	public function deleteRecord($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->area_cleaning_record_model->deleteRecord($id);
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'All Selected Area Cleaning Records deleted Successfully !');
			}else{
  	 		$id = $this->uri->segment('3');
  	 		$this->area_cleaning_record_model->deleteRecord($id);
  	 		$this->session->set_flashdata('success', 'Area Cleaning Record deleted Successfully !');
  	 		redirect('/Area_cleaning_records/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 		}

		}

	}

?>