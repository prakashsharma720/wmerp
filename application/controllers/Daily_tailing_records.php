<?php

//session_start(); //we need to start session in order to access it through CI

Class Daily_tailing_records extends MY_Controller {

public function __construct(){

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
	//$this->load->model('daily_tailing_model');
	$this->load->model('daily_tailing_model');
	//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']		= $this->session->userdata['logged_in']['id'];
	$data['department_id']  = $this->session->userdata['logged_in']['department_id'];
	$role_id 				= $this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->daily_tailing_model->getSuppliers();
	$data['dtr_code'] = $this->daily_tailing_model->getGSRCode();
	$voucher_no= $data['dtr_code'];
    if($voucher_no<10){
    $rs_id_code='DTR000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='DTR00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='DTR0'.$voucher_no;
    }
    else{
      $rs_id_code='DTR'.$voucher_no;
    }
    $data['dtr_code_view']=$rs_id_code;
    $data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	$data['items'] 			= $this->daily_tailing_model->getFGmineralsList();
	$data['workers'] 		= $this->daily_tailing_model->getWorkers();
	$data['departments'] 	= $this->daily_tailing_model->getDepartments();
	$data['packing_sizes'] 	= array('25' => '25Kg','50'=>'50Kg');
	$data['stackingtype']	= array('up' => 'UP','down'=>'DOWN');
	$data['title'] 			= 'Create Daily Tailing Record';

	$this->template->load('layout/template','daily_tailing_add',$data);	
	//$this->load->view('footer');	
	}
	

public function getTotalQtyForLot($lot_no=NULL) {
	$total = $this->daily_tailing_model->getTotalQtyForLot($lot_no);
   	 if(!empty($total)){
   	 	echo json_encode($total);	
   	 }
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	//$role_id=$this->session->userdata['logged_in']['role_id'];
	//echo $role_id;exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	///$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	$result = $this->daily_tailing_model->getById($id);
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
    if (isset($result[0]['dtr_code']) && $result[0]['dtr_code']) :
        $data['dtr_code'] = $result[0]['dtr_code'];
		$voucher_no= $data['dtr_code'];
	    if($voucher_no<10){
	    $rs_id_code='DTR000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='DTR00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='DTR0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='DTR'.$voucher_no;
	    }
	endif; 
   	$data['dtr_code_view']=$rs_id_code;
    if (isset($result[0]['department_id']) && $result[0]['department_id']) :
        $data['department_id'] = $result[0]['department_id'];
    else:
        $data['department_id'] = '';
    endif;

     if (isset($result[0]['total_bags']) && $result[0]['total_bags']) :
        $data['total_bags'] = $result[0]['total_bags'];
    else:
        $data['total_bags'] = '';
    endif; 
     if (isset($result[0]['mill_no'])) :
        $data['mill_no'] = $result[0]['mill_no'];
    else:
        $data['mill_no'] = '';
    endif; 
     if (isset($result[0]['total_rates']) && $result[0]['total_rates']) :
        $data['total_rates'] = $result[0]['total_rates'];
    else:
        $data['total_rates'] = '';
    endif; 

     if (isset($result[0]['remarks'])) :
        $data['remarks'] = $result[0]['remarks'];
    else:
        $data['remarks'] = '';
    endif; 

   
     if (isset($result[0]['dsr_details']) && $result[0]['dsr_details']) :
        $data['dsr_details'] = $result[0]['dsr_details'];
    else:
        $data['dsr_details'] = '';
    endif;

	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	$data['items'] 			= $this->daily_tailing_model->getFGmineralsList();
	$data['workers'] 		= $this->daily_tailing_model->getWorkers();
	$data['departments'] 	= $this->daily_tailing_model->getDepartments();
	$data['packing_sizes'] 	= array('25' => '25Kg','50'=>'50Kg');
	$data['stackingtype']	= array('up' => 'UP','down'=>'DOWN');
	$data['title'] 			= 'Edit Daily Tailing Record';
	$this->template->load('template','daily_tailing_edit',$data);
	
	}

	public function index(){
			$data['title']=' Daily Tailing Records ';
			//$data['suppliers']=$this->daily_tailing_model->getSuppliers();
			//$data['Items']=$this->daily_tailing_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->daily_tailing_model->getList();
			//print_r($data['pr_data']);exit;
			//$data['states']=$this->daily_tailing_model->getStates();
			$this->template->load('layout/template','daily_tailing_view',$data);
		}
	
		public function report() 
		{
			$data['title'] = 'Daily Tailing Records';
			if($this->input->get())
			{
				 $conditions['finish_good_id']=$this->input->get('finish_good_id');
				 $conditions['department_id']=$this->input->get('department_id');
				//  $conditions['approved_status']=$this->input->get('approved_status');
				 $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				 $data['conditions']=$conditions;
				 //print_r($data['conditions']);exit;
			   $data['requisition_data'] = $this->daily_tailing_model->getAllReqList($conditions);
	
			}
			else{
				$data['requisition_data'] = $this->daily_tailing_model->getAllReqList();
			}
	
			
			$data['workers'] = $this->daily_tailing_model->getWorkers();
			$data['departments'] = $this->daily_tailing_model->getDepartments();
			$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
			//echo var_dump($data);
			$this->template->load('template','daily_tailing_report',$data);
		}
	

	public function add_new_record() {
		// echo"<pre>";
		// print_r($_POST);
		// echo"</pre>";exit;


		$this->form_validation->set_rules('finish_good_id[]', 'Grade Name ', 'required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			
			if(isset($this->session->userdata['logged_in'])){
				$this->add();
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
			'dtr_code' => $this->input->post('dtr_code'),
			'department_id' => $this->input->post('department_id'),
			//'total_bags' => $this->input->post('total_bags'),
			'mill_no' => $this->input->post('mill_no'),
			'remarks' => $this->input->post('remarks'),
			'created_by' => $login_id,
			);
			
			$result = $this->daily_tailing_model->dsr_insert($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Data inserted Successfully !');
				redirect('/Daily_tailing_records/index', 'refresh');
				//$this->fetchSuppliers();
			}
			else
			{
				$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
				redirect('/Daily_tailing_records/index', 'refresh');
			}
		}
	}

	public function edit_dtr(){

		$this->form_validation->set_rules('finish_good_id[]', 'Finish Good ', 'required');
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
			'dtr_code' => $this->input->post('dtr_code'),
			'department_id' => $this->input->post('department_id'),
			//'total_bags' => $this->input->post('total_bags'),
			'mill_no' => $this->input->post('mill_no'),
			'remarks' => $this->input->post('remarks'),
			'edited_by' => $login_id,
			);
			$old_id = $this->input->post('gtr_id_old'); 
			//print_r($data);exit;
			$result = $this->daily_tailing_model->editDTR($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Daily_tailing_records/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Daily Stitching Record!');
			redirect('/Daily_tailing_records/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}


	public function deleteDTR($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->daily_tailing_model->deleteDTR($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Daily Tailing Record deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->daily_tailing_model->deleteDTR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Daily Tailing Record deleted Successfully !');
			redirect('/Daily_tailing_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Daily_tailing_records/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->daily_tailing_model->getById($id);
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
           	$reqSlipInfo = $this->daily_tailing_model->getAllReqList($conditions);
		}
		// else
		// {
		// 	$reqSlipInfo = $this->work_allotment_model->getAllReqList();
		// }
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'DTR No ')->getStyle('A1:Q1')->getFont(true);
			
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Transaction Date')->getStyle('A1:Q1')->getFont(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Department')->getStyle('A1:Q1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Incharge Name')->getStyle('A1:Q1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Mill No')->getStyle('A1:Q1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Total bags')->getStyle('A1:Q1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Lot No  ')->getStyle('A1:Q1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Mineral Name')->getStyle('A1:Q1')->getFont()->setBold(true);      
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'No Of Bags  ')->getStyle('A1:Q1')->getFont()->setBold(true);       
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Bag Weight')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Tailing In MT')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Total Tailing For Lot')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Gride Name')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Color')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Re-Used In')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Re-Used Qty')->getStyle('A1:Q1')->getFont()->setBold(true);       
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Balance Qty')->getStyle('A1:Q1')->getFont()->setBold(true);       
        	
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
			//$element->setAutoSize(true);
			
        	foreach ($element['dsr_details'] as $element2) {
				//$element2->setAutoSize(true);
        		$voucher_no=$element2['daily_tailing_record_id'];
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
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['mill_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['total_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['lot_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['mineral_name'].'('.$element2['grade_name'].')');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element2['no_of_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['bag_weight']);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element2['tailing_qty_in_mt']);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element2['total_tailing_for_lot']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element2['location_of_storage']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $element2['color']);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $element2['used_mineral_name'].'('.$element2['used_grade_name'].')');
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $element2['used_qty']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $element2['balance_qty']);

						
            $rowCount++;
        	}
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="DailyTailingData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Daily_tailing_records/report', 'refresh');     
    }
}

?>