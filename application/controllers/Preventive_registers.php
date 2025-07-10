<?php

//session_start(); //we need to start session in order to access it through CI

Class Preventive_registers extends CI_Controller {

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
$this->load->model('preventive_register_model');
}

// Show login page
public function index() {
			$data['title'] = 'Preventive Maintenance Register List';
			$data['preventive_registers'] = $this->preventive_register_model->getList();
			//$data['roles'] = $this->preventive_register_model->getRoles();
			//$data['departments'] = $this->preventive_register_model->getDepartments();	
			//echo var_dump($data['students']);
			//print_r($data['job_orders']);exit;
			$this->template->load('template','preventive_reg_view',$data);
	}

		public function report() 
	{
		$data['title'] = 'Preventive Maintenance Register Report';
		$data['areas'] = $this->preventive_register_model->getAreas();
		if($this->input->get())
			{
			 	$conditions['area']=$this->input->get('area');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;

	           $data['preventive_registers'] = $this->preventive_register_model->getList($conditions);

			}
			else{
				$data['preventive_registers'] = $this->preventive_register_model->getList();
			}
			// echo "<pre>"; print_r($data['area_cleaning_records']); die;
			
		$this->template->load('template','preventive_reg_report',$data);
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

	           $reqSlipInfo = $data['preventive_registers'] = $this->preventive_register_model->getList($conditions);

			}
			else{
				$reqSlipInfo = $data['preventive_registers'] = $this->preventive_register_model->getList();
			}

        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Plant');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Frequency');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Date Of Maintenance');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Date Of Next Maintenance');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Remark '); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Status '); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Reported By '); 
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $key=>$element) {	

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

                   
        	
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['plant_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['frequency']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['date_of_maintenance']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['next_maintenance_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['remark']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['status_of_work']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $emp_name);
            $rowCount++;
        	
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Area Cleaning Records.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Area_cleaning_records/report', 'refresh');     
    }



	public function add() 
	{
			$data = array();
			$data['title'] = 'Create New Preventive Maintenance Record';
			//$data['employees'] = $this->preventive_register_model->employeesList();
			
		/*	$data['joborder_code'] = $this->preventive_register_model->getJobORderCode();
			$voucher_no= $data['joborder_code'];
            if($voucher_no<10){
            $job_order_code_view='C/JO/000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $job_order_code_view='C/JO/00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $job_order_code_view='C/JO/0'.$voucher_no;
            }
            else{
              $job_order_code_view='C/JO/'.$voucher_no;
            }
            //print_r($job_order_code_view);exit;
            $data['job_order_code_view']=$job_order_code_view;*/
            $data['areas'] = $this->preventive_register_model->getAreas();
            $data['workers'] = $this->preventive_register_model->getWorkers();
			//print_r($data['departments']);exit;
			$this->template->load('template','preventive_reg_add',$data);
	}
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->preventive_register_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

	       /* if (isset($result['voucher_code']) && $result['voucher_code']) :
	            $data['joborder_code'] = $result['voucher_code'];
	        else:
	            $data['joborder_code'] = '';
	        endif;
			if (isset($result['job_order_no'])) :
	            $data['job_order_code_view'] = $result['job_order_no'];
	        else:
	            $data['job_order_code_view'] = '';
	        endif;*/

	        if (isset($result['transaction_date']) && $result['transaction_date']) :
	            $data['transaction_date'] = $result['transaction_date'];
	       else:
	            $data['transaction_date'] = '';
	        endif;
	       
	       if (isset($result['plant_id'])) :
	            $data['plant_id'] = $result['plant_id'];
	       else:
	            $data['plant_id'] = '';
	        endif;

	         if (isset($result['frequency'])) :
	            $data['frequency'] = $result['frequency'];
	       else:
	            $data['frequency'] = '';
	        endif;
	         if (isset($result['status_of_work'])) :
	            $data['status_of_work'] = $result['status_of_work'];
	       else:
	            $data['status_of_work'] = '';
	        endif; 
	        if (isset($result['remark'])) :
	            $data['remark'] = $result['remark'];
	       else:
	            $data['remark'] = '';
	        endif;
	         if (isset($result['worker_id'])) :
	            $data['worker_id'] = $result['worker_id'];
	       else:
	            $data['worker_id'] = '';
	        endif;
	       	 if (isset($result['next_maintenance_date'])) :
	        	if($result['next_maintenance_date']=='0000-00-00'){
	        		$data['next_maintenance_date'] = date('Y-m-d');
	        	}else{
	        		$data['next_maintenance_date'] = $result['next_maintenance_date'];
	        	}
	        endif; 
	        
	        if (isset($result['date_of_maintenance'])) :
	        	if($result['date_of_maintenance']=='0000-00-00'){
	        		$data['date_of_maintenance'] = date('Y-m-d');
	        	}else{
	        		$data['date_of_maintenance'] = $result['date_of_maintenance'];
	        	}
	        endif; 

			$data['title'] = 'Edit Preventive Maintenance Record';
			 $data['areas'] = $this->preventive_register_model->getAreas();
            $data['workers'] = $this->preventive_register_model->getWorkers();
			//print_r($data['departments']);exit;
			$this->template->load('template','preventive_reg_edit',$data);
	}
	public function add_new_record() {

		$this->form_validation->set_rules('plant_id', 'Plant Name', 'required');
	
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			redirect('/Preventive_registers/add');
			}else{
			$this->load->view('login_form');
			}
		}
		else 
		{
	        $loginId=$this->session->userdata['logged_in']['id'];
	  		
			$data = array(
			'plant_id' => $this->input->post('plant_id'),
			'frequency' => $this->input->post('frequency'),
			'status_of_work' => $this->input->post('status_of_work'),
			'remark' => $this->input->post('remark'),
			//'worker_id' => $this->input->post('worker_id'),
			'date_of_maintenance' => date('Y-m-d',strtotime($this->input->post('date_of_maintenance'))),
			'next_maintenance_date' => date('Y-m-d',strtotime($this->input->post('next_maintenance_date'))),
			'created_by' => $loginId,
			);

			$result = $this->preventive_register_model->record_insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Record Added Successfully !');
			redirect('/Preventive_registers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', ' Record insertion failed!');
			redirect('/Preventive_registers/index', 'refresh');
			}
		} 
	}

	public function editrecord($id) {
		$this->form_validation->set_rules('plant_id', 'Plant Name', 'required');
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
			'plant_id' => $this->input->post('plant_id'),
			'frequency' => $this->input->post('frequency'),
			'status_of_work' => $this->input->post('status_of_work'),
			'remark' => $this->input->post('remark'),
			//'worker_id' => $this->input->post('worker_id'),
			'date_of_maintenance' => date('Y-m-d',strtotime($this->input->post('date_of_maintenance'))),
			'next_maintenance_date' => date('Y-m-d',strtotime($this->input->post('next_maintenance_date'))),
			'edited_by' => $loginId,
			);

			$result = $this->preventive_register_model->record_update($data,$id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', ' Record Updated Successfully !');
			redirect('/Preventive_registers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in  Record !');
			redirect('/Preventive_registers/index', 'refresh');
			}
		} 
	}
	public function deleteRecord($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->preventive_register_model->deleteRecord($id);
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'All Selected Preventive Maintenance Register deleted Successfully !');
			}else{
  	 		$id = $this->uri->segment('3');
  	 		$this->preventive_register_model->deleteRecord($id);
  	 		$this->session->set_flashdata('success', 'Preventive Maintenance Register deleted Successfully !');
  	 		redirect('/Preventive_registers/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 		}

		}

	}

?>