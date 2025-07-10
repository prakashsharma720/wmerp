<?php

//session_start(); //we need to start session in order to access it through CI

Class Printing_logsheet extends CI_Controller {

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
//$this->load->model('printing_logsheet_model');
$this->load->model('printing_logsheet_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->printing_logsheet_model->getSuppliers();
	$data['pl_number'] = $this->printing_logsheet_model->getPLCode();
	$voucher_no= $data['pl_number'];
    if($voucher_no<10){
    $rs_id_code='PML000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='PML00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='PML0'.$voucher_no;
    }
    else{
      $rs_id_code='PML'.$voucher_no;
    }
    $data['pl_number_view']=$rs_id_code;
    $data['departments'] = $this->printing_logsheet_model->getDepartments();
	$data['months']=$this->printing_logsheet_model->getMonthList();
	$data['items'] = $this->printing_logsheet_model->getFGgradesList();
	//$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	//$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	//$data['grades']=$this->printing_logsheet_model->getGrades();
	//$data['states']=$this->printing_logsheet_model->getStates();
	$data['title']='Create Printing Machine Logsheet';
	$this->template->load('template','printing_logsheet_add',$data);	
	//$this->load->view('footer');	
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	//$role_id=$this->session->userdata['logged_in']['role_id'];
	//echo $role_id;exit;
	$data = array();
	
	$result = $this->printing_logsheet_model->getById($id);
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
       $voucher_no= $data['pl_number'];
	    if($voucher_no<10){
	    $rs_id_code='PML000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='PML00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='PML0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='PML'.$voucher_no;
	    }
	    $data['pl_number_view']=$rs_id_code;
	endif; 
 
     if (isset($result[0]['remarks'])) :
        $data['remarks'] = $result[0]['remarks'];
    else:
        $data['remarks'] = '';
    endif; 
     if (isset($result[0]['department_id'])) :
        $data['department_id'] = $result[0]['department_id'];
    else:
        $data['department_id'] = '';
    endif; 
     if (isset($result[0]['total_bags'])) :
        $data['total_bags'] = $result[0]['total_bags'];
    else:
        $data['total_bags'] = '';
    endif; 
     if (isset($result[0]['production_month_id'])) :
        $data['production_month_id'] = $result[0]['production_month_id'];
    else:
        $data['production_month_id'] = '';
    endif;
    
    if (isset($result[0]['process_details'])) :
        $data['process_details'] = $result[0]['process_details'];
    else:
        $data['process_details'] = '';
    endif;
    $data['departments'] = $this->printing_logsheet_model->getDepartments();
	$data['months']=$this->printing_logsheet_model->getMonthList();
	$data['items'] = $this->printing_logsheet_model->getFGgradesList();
	$data['title']='Edit Printing Machine Logsheet ';
	$this->template->load('template','printing_logsheet_edit',$data);
	
	}

	public function index(){
			$data['title']='Printing Machine Logsheet List ';
			//$data['suppliers']=$this->printing_logsheet_model->getSuppliers();
			//$data['Items']=$this->printing_logsheet_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->printing_logsheet_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->printing_logsheet_model->getStates();
			$this->template->load('template','printing_logsheet_view',$data);
		}

	
	
		public function report() 
		{
			$data['title'] = 'Printing Logsheet Records';
			if($this->input->get())
			{
				 $conditions['finish_good_id']=$this->input->get('finish_good_id');
				 $conditions['department_id']=$this->input->get('department_id');
				//  $conditions['approved_status']=$this->input->get('approved_status');
				 $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				 $data['conditions']=$conditions;
				 //print_r($data['conditions']);exit;
			   $data['requisition_data'] = $this->printing_logsheet_model->getAllReqList($conditions);
	
			}
			else{
				$data['requisition_data'] = $this->printing_logsheet_model->getAllReqList();
			}
	
			
			$data['workers'] = $this->printing_logsheet_model->getWorkers();
			$data['departments'] = $this->printing_logsheet_model->getDepartments();
			$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
			//echo var_dump($data);
			$this->template->load('template','printing_logsheet_report',$data);
		}
	
	
	


	public function add_new_record() {
		/*echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('finish_good_id[]', 'Grade Name ', 'required');
		
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
			'department_id' => $this->input->post('department_id'),
			'total_bags' => $this->input->post('total_bags'),
			'remarks' => $this->input->post('remarks'),
			'created_by' => $login_id,
			);
			//print_r($data);exit;
			$result = $this->printing_logsheet_model->pl_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Printing_logsheet/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Printing_logsheet/index', 'refresh');
			}
		}
	}

	public function edit_record(){

		$this->form_validation->set_rules('finish_good_id[]', 'Grade Name ', 'required');
		
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
			'department_id' => $this->input->post('department_id'),
			'total_bags' => $this->input->post('total_bags'),
			'remarks' => $this->input->post('remarks'),
			'edited_by' => $login_id,
			);
			$old_id = $this->input->post('pm_id_old'); 
			//print_r($data);exit;
			$result = $this->printing_logsheet_model->editPMR($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Printing_logsheet/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Daily Stitching Record!');
			redirect('/Printing_logsheet/index', 'refresh');
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
  	 			$result=$this->printing_logsheet_model->deleteGSR($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Daily Stitching Record deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->printing_logsheet_model->deleteGSR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Daily Stitching Record deleted Successfully !');
			redirect('/Printing_logsheet/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Printing_logsheet/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->printing_logsheet_model->getById($id);
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
			$conditions['finish_good_id']=$this->input->post('finish_good_id');
		 	$conditions['department_id']=$this->input->post('department_id');
		 	// $conditions['approved_status']=$this->input->post('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->printing_logsheet_model->getAllReqList($conditions);
		}
		// else
		// {
		// 	$reqSlipInfo = $this->work_allotment_model->getAllReqList();
		// }
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PML No ')->getStyle('A1:M1')->getFont(true);
			
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Transaction Date')->getStyle('A1:M1')->getFont(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Department')->getStyle('A1:M1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Incharge Name')->getStyle('A1:M1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total bags ')->getStyle('A1:M1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Grade Name')->getStyle('A1:M1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Lot No  ')->getStyle('A1:M1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Batch No')->getStyle('A1:M1')->getFont()->setBold(true);      
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'No Of Bags  ')->getStyle('A1:M1')->getFont()->setBold(true);       
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Month Of Production')->getStyle('A1:M1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Year Of Production')->getStyle('A1:M1')->getFont()->setBold(true);       
			
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
			//$element->setAutoSize(true);
			
        	foreach ($element['process_details'] as $element2) {
				//$element2->setAutoSize(true);
        		$voucher_no=$element2['printing_machine_logsheet_id'];
        		if($voucher_no<10){
			    $rs_id_code='PML000'.$voucher_no;
			    }
			    else if(($voucher_no>=10) && ($voucher_no<=99)){
			      $rs_id_code='PML00'.$voucher_no;
			    }
			    else if(($voucher_no>=100) && ($voucher_no<=999)){
			      $rs_id_code='PML0'.$voucher_no;
			    }
			    else{
			      $rs_id_code='PML'.$voucher_no;
			    }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rs_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['total_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element2['grade_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['lot_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['batch_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element2['no_of_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['month_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element2['production_year']);
						
            $rowCount++;
        	}
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PrintingLogsheetData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Printing_logsheet/report', 'refresh');     
    }
}

?>