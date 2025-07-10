<?php

//session_start(); //we need to start session in order to access it through CI

Class Work_allotments extends MY_Controller {

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
//$this->load->model('work_allotment_model');
$this->load->model('work_allotment_model');

//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->work_allotment_model->getSuppliers();
	$data['wa_code'] = $this->work_allotment_model->getWorkAllotCode();
	$voucher_no= $data['wa_code'];
    if($voucher_no<10){
    $rs_id_code='F01/000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='F01/00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='F010'.$voucher_no;
    }
    else{
      $rs_id_code='F01/'.$voucher_no;
    }
    $data['wa_code_view']=$rs_id_code;
	$data['workers']=$this->work_allotment_model->getWorkers();
	$data['departments'] = $this->work_allotment_model->getDepartments();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4','OP5'=>'OP5','Maintenance'=>'Maintenance','House Keeping'=>'House Keeping','Civil'=>'Civil','Other'=>'Other');
	// print_r($data['equipments']);exit;

	$data['title']='Create Work Allotment Register';
	$this->template->load('template','work_alloted_add',$data);	
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
	$result = $this->work_allotment_model->getById($id);
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
    if (isset($result[0]['wa_code']) && $result[0]['wa_code']) :
        $data['wa_code'] = $result[0]['wa_code'];
		$voucher_no= $data['wa_code'];
	    if($voucher_no<10){
	    $rs_id_code='F01/000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='F01/00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='F010'.$voucher_no;
	    }
	    else{
	      $rs_id_code='F01/'.$voucher_no;
	    }
    	$data['wa_code_view']=$rs_id_code;
	endif; 	

    if (isset($result[0]['total_workers']) && $result[0]['total_workers']) :
        $data['total_workers'] = $result[0]['total_workers'];
    else:
        $data['total_workers'] = '';
    endif;
   
    if (isset($result[0]['department_id']) && $result[0]['department_id']) :
        $data['department_id'] = $result[0]['department_id'];
    else:
        $data['department_id'] = '';
    endif;

    if (isset($result[0]['employee_id']) && $result[0]['employee_id']) :
        $data['employee_id'] = $result[0]['employee_id'];
    else:
        $data['employee_id'] = '';
    endif;

     if (isset($result[0]['mill_no'])) :
        $data['mill_no'] = $result[0]['mill_no'];
    else:
        $data['mill_no'] = '';
    endif;

     if (isset($result[0]['work_details']) && $result[0]['work_details']) :
        $data['work_details'] = $result[0]['work_details'];
    else:
        $data['work_details'] = '';
    endif;

	//$data['suppliers']=$this->work_allotment_model->getSuppliers();
	$data['workers']=$this->work_allotment_model->getWorkers();
	$data['departments'] = $this->work_allotment_model->getDepartments();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4','OP5'=>'OP5','Maintenance'=>'Maintenance','House Keeping'=>'House Keeping','Civil'=>'Civil','Other'=>'Other');
	$data['title']='Edit Work Allotment Register';
	$this->template->load('template','work_alloted_edit',$data);
	
	}

	public function index(){
			$data['title']=' Work Allocation Register List';
			//$data['suppliers']=$this->work_allotment_model->getSuppliers();
			//$data['Items']=$this->work_allotment_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4','OP5'=>'OP5','Maintenance'=>'Maintenance','House Keeping'=>'House Keeping','Civil'=>'Civil','Other'=>'Other');
			$data['pr_data']=$this->work_allotment_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->work_allotment_model->getStates();
			$this->template->load('template','work_alloted_view',$data);
		}

		public function report() 
	{
		$data['title'] = 'Work Allotment Report';
		if($this->input->get())
		{
		 	$conditions['worker_id']=$this->input->get('worker_id');
		 	$conditions['department_id']=$this->input->get('department_id');
		 	$conditions['approved_status']=$this->input->get('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
		 	//print_r($data);exit;
           $data['requisition_data'] = $this->work_allotment_model->getAllReqList($conditions);

		}
		// else{
		// 	$data['requisition_data'] = $this->work_allotment_model->getAllReqList();
		// }
		
		//$this->load->model('work_allotment_model');
		$data['workers'] = $this->work_allotment_model->getWorkers();
		$data['departments'] = $this->work_allotment_model->getDepartments();
		$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
		//echo var_dump($data['data']); die;
		$this->template->load('template','work_allot_report',$data);
	}

	

	


	public function add_new_work() {
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
			'wa_code' => $this->input->post('wa_code'),
			'mill_no' => $this->input->post('mill_no'),
			'department_id' => $department_id,
			'total_workers' => $this->input->post('total_workers'),
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->work_allotment_model->wa_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Work_allotments/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Work_allotments/index', 'refresh');
			}
		}
	}

	public function edit_work_alloted(){

		$this->form_validation->set_rules('worker_id[]', 'Worker Name ', 'required');
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
			'wa_code' => $this->input->post('wa_code'),
			'mill_no' => $this->input->post('mill_no'),
			'department_id' => $department_id,
			'total_workers' => $this->input->post('total_workers'),
			'edited_by' => $login_id
			);
			$old_id = $this->input->post('wa_id_old'); 
			//print_r($data);exit;
			$result = $this->work_allotment_model->editWork_alloted($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Work_allotments/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Work Allotment !');
			redirect('/Work_allotments/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}


	public function deleteWork_alloted($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->work_allotment_model->deleteWork_alloted($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Work Allotment deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->work_allotment_model->deleteWork_alloted($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Work Allotment deleted Successfully !');
			redirect('/Work_allotments/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Work_allotments/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->work_allotment_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Work Allotment Records View';
        $this->template->load('template','work_alloted_print',$data);
	} 
	
	function createXLS() {
  	  	
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
           	$reqSlipInfo = $this->work_allotment_model->getAllReqList($conditions);
		}
		// else
		// {
		// 	$reqSlipInfo = $this->work_allotment_model->getAllReqList();
		// }
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Registration No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Incharge Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Worker Name');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Work Allotted');      
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Attendance');       
        // $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Request Quantity');       
        // $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Issue Quantity');       
        // $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Unit');       
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
        	
        	foreach ($element['work_alloted_details'] as $element2) {
        		$voucher_no=$element2['work_allotment_register_id'];
        		if($voucher_no<10){
			    $rs_id_code='WA000'.$voucher_no;
			    }
			    else if(($voucher_no>=10) && ($voucher_no<=99)){
			      $rs_id_code='WA00'.$voucher_no;
			    }
			    else if(($voucher_no>=100) && ($voucher_no<=999)){
			      $rs_id_code='WA0'.$voucher_no;
			    }
			    else{
			      $rs_id_code='WA'.$voucher_no;
			    }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rs_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element2['worker_name']);
           // $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['approver']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element2['work_allotted']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['attendance']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element2['issue_qty']);
            // $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['unit']);	
            $rowCount++;
        	}
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="requisitionData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Work_allotments/report', 'refresh');     
    }

}

?>