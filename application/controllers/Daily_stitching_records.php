<?php

//session_start(); //we need to start session in order to access it through CI

Class Daily_stitching_records extends MY_Controller {

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
//$this->load->model('daily_stitching_model');
$this->load->model('daily_stitching_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->daily_stitching_model->getSuppliers();
	$data['dsr_code'] = $this->daily_stitching_model->getGSRCode();
	/*$voucher_no= $data['dsr_code'];
    if($voucher_no<10){
    $rs_id_code='DS000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='DS00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='DS0'.$voucher_no;
    }
    else{
      $rs_id_code='DS'.$voucher_no;
    }
    $data['pr_number_view']=$rs_id_code;*/
	$data['items']=$this->daily_stitching_model->getFGmineralsList();
	$data['workers']=$this->daily_stitching_model->getWorkers();
	$data['departments'] = $this->daily_stitching_model->getDepartments();
	$data['title']='Create Daily Stitching Record';
	$this->template->load('layout/template','daily_stitching_add',$data);	
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
	$result = $this->daily_stitching_model->getById($id);
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
    if (isset($result[0]['dsr_code']) && $result[0]['dsr_code']) :
        $data['dsr_code'] = $result[0]['dsr_code'];
		/*$voucher_no= $data['pr_number'];
	    if($voucher_no<10){
	    $rs_id_code='PR000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='PR00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='PR0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='PR'.$voucher_no;
	    }
	    $data['pr_number_view']=$rs_id_code;*/
	endif; 
  
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
     if (isset($result[0]['total_workers']) && $result[0]['total_workers']) :
        $data['total_workers'] = $result[0]['total_workers'];
    else:
        $data['total_workers'] = '';
    endif; 
     if (isset($result[0]['total_rates']) && $result[0]['total_rates']) :
        $data['total_rates'] = $result[0]['total_rates'];
    else:
        $data['total_rates'] = '';
    endif; 

     if (isset($result[0]['grand_total']) && $result[0]['grand_total']) :
        $data['grand_total'] = $result[0]['grand_total'];
    else:
        $data['grand_total'] = '';
    endif; 

   
     if (isset($result[0]['dsr_details']) && $result[0]['dsr_details']) :
        $data['dsr_details'] = $result[0]['dsr_details'];
    else:
        $data['dsr_details'] = '';
    endif;

	//$data['suppliers']=$this->daily_stitching_model->getSuppliers();
	$data['items']=$this->daily_stitching_model->getFGmineralsList();
	$data['workers']=$this->daily_stitching_model->getWorkers();
	$data['departments'] = $this->daily_stitching_model->getDepartments();
	$data['title']='Edit Daily Stitching Record';
	$this->template->load('template','daily_stitching_edit',$data);
	
	}

	public function index(){
			$data['title']=' Daily Stitching Records ';
			//$data['suppliers']=$this->daily_stitching_model->getSuppliers();
			//$data['Items']=$this->daily_stitching_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->daily_stitching_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->daily_stitching_model->getStates();
			$this->template->load('layout/template','daily_stitching_view',$data);
		}

	
	
	public function reports() 
	{
		$data['title'] = 'Daily Stitching Records';
		if($this->input->get())
		{
		 	$conditions['worker_id']=$this->input->get('worker_id');
		 	$conditions['department_id']=$this->input->get('department_id');
		 	$conditions['approved_status']=$this->input->get('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
		 	//print_r($data['conditions']);exit;
           $data['requisition_data'] = $this->daily_stitching_model->getAllReqList($conditions);

		}
		// else{
		// 	$data['requisition_data'] = $this->daily_stitching_model->getAllReqList();
		// }

		
		$data['workers'] = $this->daily_stitching_model->getWorkers();
		$data['departments'] = $this->daily_stitching_model->getDepartments();
		$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
		//echo var_dump($data);
		$this->template->load('template','daily_stitching_report',$data);
	}
	


	public function add_new_record() {
	/*	echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('worker_id[]', 'Worker Name ', 'required');
		
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
			'dsr_code' => $this->input->post('dsr_code'),
			'department_id' => $this->input->post('department_id'),
			'total_bags' => $this->input->post('total_bags'),
			'total_workers' => $this->input->post('total_workers'),
			'total_rates' => $this->input->post('total_rate'),
			'grand_total' => $this->input->post('total_amount'),
			'created_by' => $login_id,
			);
			//print_r($data);exit;
			$result = $this->daily_stitching_model->dsr_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Daily_stitching_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Daily_stitching_records/index', 'refresh');
			}
		}
	}

	public function edit_dsr(){

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
			'dsr_code' => $this->input->post('dsr_code'),
			'department_id' => $this->input->post('department_id'),
			'total_bags' => $this->input->post('total_bags'),
			'total_workers' => $this->input->post('total_workers'),
			'total_rates' => $this->input->post('total_rate'),
			'grand_total' => $this->input->post('total_amount'),
			'edited_by' => $login_id,
			);
			$old_id = $this->input->post('gsr_id_old'); 
			//print_r($data);exit;
			$result = $this->daily_stitching_model->editGSR($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Daily_stitching_records/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Daily Stitching Record!');
			redirect('/Daily_stitching_records/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}


	public function deleteGSR($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->daily_stitching_model->deleteGSR($id);
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
  	 		$result=$this->daily_stitching_model->deleteGSR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Daily Stitching Record deleted Successfully !');
			redirect('/Daily_stitching_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Daily_stitching_records/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->daily_stitching_model->getById($id);
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
			$conditions['worker_id']=$this->input->post('worker_id');
		 	$conditions['department_id']=$this->input->post('department_id');
		 	$conditions['approved_status']=$this->input->post('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->daily_stitching_model->getAllReqList($conditions);
		}
		// else
		// {
		// 	$reqSlipInfo = $this->work_allotment_model->getAllReqList();
		// }
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Register No ')->getStyle('A1:K1')->applyFromArray(
			array(
				'fill' => array(
					'type' => PHPExcel_Style_Fill::FILL_SOLID,
					'color' => array('rgb' => '178161199')
				)
			)
		);
			
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date')->getStyle('A1:K1')->getFont(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Incharge Name')->getStyle('A1:K1')->getFont()->setBold(true);
        // $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Department')->getStyle('A1:K1')->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Worker Name')->getStyle('A1:K1')->getFont()->setBold(true); 
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Grade Name ')->getStyle('A1:K1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'No of Bags')->getStyle('A1:K1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Rate / Bag')->getStyle('A1:K1')->getFont()->setBold(true);      
		// $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Total Worker')->getStyle('A1:K1')->getFont()->setBold(true);      
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Total Bags')->getStyle('A1:K1')->getFont()->setBold(true);      
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Total Amount')->getStyle('A1:K1')->getFont()->setBold(true);       
       
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
			//$element->setAutoSize(true);
			
        	foreach ($element['dsr_details'] as $element2) {
				//$element2->setAutoSize(true);
        		$voucher_no=$element2['daily_stiching_record_id'];
        		if($voucher_no<10){
			    $rs_id_code='DSR000'.$voucher_no;
			    }
			    else if(($voucher_no>=10) && ($voucher_no<=99)){
			      $rs_id_code='DSR00'.$voucher_no;
			    }
			    else if(($voucher_no>=100) && ($voucher_no<=999)){
			      $rs_id_code='DSR0'.$voucher_no;
			    }
			    else{
			      $rs_id_code='DSR'.$voucher_no;
			    }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rs_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['worker_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element2['grade_name']);
        //    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount,"--")->getStyle('F')->applyFromArray(
		// 	array(
		// 		'fill' => array(
		// 			'type' => PHPExcel_Style_Fill::FILL_SOLID,
		// 			'color' => array('rgb' => '178161199')
		// 		)
		// 	)
		// );
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element2['no_of_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['rate']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['total_bags']);
			// $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element2['unit']);	
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['total_amount']);
						
            $rowCount++;
        	}
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="dailyStitchingData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Daily_stitching_records/report', 'refresh');     
    }
	
}

?>