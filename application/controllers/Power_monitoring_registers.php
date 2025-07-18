<?php

//session_start(); //we need to start session in order to access it through CI

Class Power_monitoring_registers extends MY_Controller {

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
//$this->load->model('power_monitoring_model');
$this->load->model('power_monitoring_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->power_monitoring_model->getSuppliers();
	$data['pl_number'] = $this->power_monitoring_model->getPLCode();
	$voucher_no= $data['pl_number'];
    if($voucher_no<10){
    $rs_id_code='PMR000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='PMR00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='PMR0'.$voucher_no;
    }
    else{
      $rs_id_code='PMR'.$voucher_no;
    }
    $data['pl_number_view']=$rs_id_code;
	$data['meters']=$this->power_monitoring_model->getMeterList();
	//$data['departments'] = $this->power_monitoring_model->getDepartments();
	//$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	//$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	//$data['grades']=$this->power_monitoring_model->getGrades();
	//$data['states']=$this->power_monitoring_model->getStates();
	$data['title']='Create Power Monitoring Register';
	$this->template->load('layout/template','power_monitoring_add',$data);	
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
	$result = $this->power_monitoring_model->getById($id);
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
    if (isset($result[0]['voucher_code'])) :
        $data['pl_number'] = $result[0]['voucher_code'];
        $voucher_no = $result[0]['voucher_code'];
		if($voucher_no<10){
	    $rs_id_code='PMR000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='PMR00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='PMR0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='PMR'.$voucher_no;
	    }
	    $data['pl_number_view']=$rs_id_code;
	endif; 
 
     if (isset($result[0]['remarks'])) :
        $data['remarks'] = $result[0]['remarks'];
    else:
        $data['remarks'] = '';
    endif; 
     if (isset($result[0]['total_opening'])) :
        $data['total_opening'] = $result[0]['total_opening'];
    else:
        $data['total_opening'] = '';
    endif; 
     if (isset($result[0]['total_closing'])) :
        $data['total_closing'] = $result[0]['total_closing'];
    else:
        $data['total_closing'] = '';
    endif;

     if (isset($result[0]['rseb_opening'])) :
        $data['rseb_opening'] = $result[0]['rseb_opening'];
    else:
        $data['rseb_opening'] = '';
    endif; 

     if (isset($result[0]['rseb_closing'])) :
        $data['rseb_closing'] = $result[0]['rseb_closing'];
    else:
        $data['rseb_closing'] = '';
    endif; 


     if (isset($result[0]['unit_consumed'])) :
        $data['total_unit_consumed'] = $result[0]['unit_consumed'];
    else:
        $data['total_unit_consumed'] = '';
    endif;
      if (isset($result[0]['total_production_in_mt'])) :
        $data['total_production_in_mt'] = $result[0]['total_production_in_mt'];
    else:
        $data['total_production_in_mt'] = '';
    endif;
    if (isset($result[0]['rseb_meter_units'])) :
        $data['rseb_meter_units'] = $result[0]['rseb_meter_units'];
    else:
        $data['rseb_meter_units'] = '';
    endif; 
    if (isset($result[0]['difference_units'])) :
        $data['difference_units'] = $result[0]['difference_units'];
    else:
        $data['difference_units'] = '';
    endif; 
   
     if (isset($result[0]['process_details'])) :
        $data['process_details'] = $result[0]['process_details'];
    else:
        $data['process_details'] = '';
    endif;

	$data['meters']=$this->power_monitoring_model->getMeterList();
	$data['title']='Edit Power Monitoring Register';
	$this->template->load('template','power_monitoring_edit',$data);
	
	}

	public function index(){
			$data['title']='Power Monitoring Registers List ';
			//$data['suppliers']=$this->power_monitoring_model->getSuppliers();
			//$data['Items']=$this->power_monitoring_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->power_monitoring_model->getList();
			//print_r($data['pr_data']);exit;
			//$data['states']=$this->power_monitoring_model->getStates();
			$this->template->load('layout/template','power_monitoring_view',$data);
		}

	
		public function report() 
		{
			$data['title'] = 'Power Monitoring Records';
			if($this->input->get())
			{
				 $conditions['meter_id']=$this->input->get('meter_id');
				//  $conditions['department_id']=$this->input->get('department_id');
				//  $conditions['approved_status']=$this->input->get('approved_status');
				 $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				 $data['conditions']=$conditions;
				 //print_r($data['conditions']);exit;
			   $data['requisition_data'] = $this->power_monitoring_model->getAllReqList($conditions);
	
			}
			else{
				$data['requisition_data'] = $this->power_monitoring_model->getAllReqList();
			}
	
			
			$data['workers'] = $this->power_monitoring_model->getWorkers();
			$data['departments'] = $this->power_monitoring_model->getDepartments();
			$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
			//echo var_dump($data);
			$this->template->load('template','power_monitoring_report',$data);
		}
		


	public function add_new_record() {
		/*echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('meter_id[]', 'Meter Name ', 'required');
		
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
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];

			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'voucher_code' => $this->input->post('pl_number'),
			'total_opening' => $this->input->post('total_opening'),
			'total_closing' => $this->input->post('total_closing'),
			'unit_consumed' => $this->input->post('total_unit_consumed'),
			'total_production_in_mt' => $this->input->post('total_production_in_mt'),
			'rseb_opening' => $this->input->post('rseb_opening'),
			'rseb_closing' => $this->input->post('rseb_closing'),
			'rseb_meter_units' => $this->input->post('rseb_meter_units'),
			'difference_units' => $this->input->post('difference_units'),
			'remarks' => $this->input->post('remarks'),
			'created_by' => $login_id,
			);
			//print_r($data);exit;
			$result = $this->power_monitoring_model->pl_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Power_monitoring_registers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Power_monitoring_registers/index', 'refresh');
			}
		}
	}

	public function edit_record(){

		$this->form_validation->set_rules('meter_id[]', 'Meter Name ', 'required');
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
			
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'voucher_code' => $this->input->post('pl_number'),
			'total_opening' => $this->input->post('total_opening'),
			'total_closing' => $this->input->post('total_closing'),
			'unit_consumed' => $this->input->post('total_unit_consumed'),
			'total_production_in_mt' => $this->input->post('total_production_in_mt'),
			'rseb_opening' => $this->input->post('rseb_opening'),
			'rseb_closing' => $this->input->post('rseb_closing'),
			'rseb_meter_units' => $this->input->post('rseb_meter_units'),
			'difference_units' => $this->input->post('difference_units'),
			'remarks' => $this->input->post('remarks'),
			'edited_by' => $login_id,
			);
			$old_id = $this->input->post('pm_id_old'); 
			//print_r($data);exit;
			$result = $this->power_monitoring_model->editPMR($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Power_monitoring_registers/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Daily Stitching Record!');
			redirect('/Power_monitoring_registers/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}


	public function deleteRecord($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->power_monitoring_model->deleteGSR($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Power Monitoring Records deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->power_monitoring_model->deleteGSR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Power Monitoring Record deleted Successfully !');
			redirect('/Power_monitoring_registers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Power_monitoring_registers/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->power_monitoring_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Production Register Print View';
        $this->template->load('template','requisition_print',$data);
	} 
	
	function createXLS() {
			
		//echo "hello"; die;
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['meter_id']=$this->input->post('meter_id');
		 	//$conditions['department_id']=$this->input->post('department_id');
		 	$conditions['approved_status']=$this->input->post('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->power_monitoring_model->getAllReqList($conditions);
		}
		// else
		// {
		// 	$reqSlipInfo = $this->work_allotment_model->getAllReqList();
		// }
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Registration No ')->getStyle('A1:M1')->getFont(true);
			
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date')->getStyle('A1:M1')->getFont(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Incharge Name')->getStyle('A1:M1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'RSEB Meter Units')->getStyle('A1:M1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Meter Name ')->getStyle('A1:M1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Opening Reading')->getStyle('A1:M1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Closing Reading')->getStyle('A1:M1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Production')->getStyle('A1:M1')->getFont()->setBold(true);      
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'RSEB Meter Opening')->getStyle('A1:M1')->getFont()->setBold(true);       
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'RSEB Meter Closing')->getStyle('A1:M1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Total Consumed Units')->getStyle('A1:M1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Unit Variation')->getStyle('A1:M1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Total Production (MT)')->getStyle('A1:K1')->getFont()->setBold(true);       

        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
			//$element->setAutoSize(true);
			
        	foreach ($element['process_details'] as $element2) {
				//$element2->setAutoSize(true);
        		$voucher_no=$element2['power_monitoring_register_id'];
        		if($voucher_no<10){
			    $rs_id_code='PMR000'.$voucher_no;
			    }
			    else if(($voucher_no>=10) && ($voucher_no<=99)){
			      $rs_id_code='PMR00'.$voucher_no;
			    }
			    else if(($voucher_no>=100) && ($voucher_no<=999)){
			      $rs_id_code='PMR0'.$voucher_no;
			    }
			    else{
			      $rs_id_code='PMR'.$voucher_no;
			    }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rs_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['rseb_meter_units']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element2['meter_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element2['opening_reading']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['closing_reading']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['production_in_mt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['rseb_opening']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['rseb_closing']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['unit_consumed']);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['difference_units']);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['total_production_in_mt']);
						
            $rowCount++;
        	}
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="powerMonitoringData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Power_monitoring_registers/report', 'refresh');     
    }
}

?>