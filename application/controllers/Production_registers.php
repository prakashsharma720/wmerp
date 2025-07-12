<?php

//session_start(); //we need to start session in order to access it through CI

Class Production_registers extends MY_Controller {

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
//$this->load->model('production_register_model');
$this->load->model('production_register_model');
//$this->load->library('excel');
}

// Show login page
public function OpeningStock() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->production_register_model->getSuppliers();
	
  
	$data['items']=$this->production_register_model->getFGmineralsList();
	$data['departments'] = $this->production_register_model->getDepartments();
	$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	//$data['grades']=$this->production_register_model->getGrades();
	//$data['states']=$this->production_register_model->getStates();
	$data['title']=' FG Opening Stock';
	$this->template->load('template','fg_opening_stock',$data);	
	//$this->load->view('footer');
	
	}

public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->production_register_model->getSuppliers();
	$data['pr_number'] = $this->production_register_model->getPRCode();
	$voucher_no= $data['pr_number'];
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
    $data['pr_number_view']=$rs_id_code;
	$data['items']=$this->production_register_model->getFGmineralsList();
	$data['departments'] = $this->production_register_model->getDepartments();
	$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	// print_r($data['equipments']);exit;
	//$data['grades']=$this->production_register_model->getGrades();
	//$data['states']=$this->production_register_model->getStates();
	$data['title']='Create Production Register';
	$this->template->load('template','production_reg_add',$data);	
	//$this->load->view('footer');
	
	}

public function edit($id=NULL) {

	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	$result = $this->production_register_model->getById($id);
	//print_r($result);exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

     if (isset($result[0]['date_of_production']) && $result[0]['date_of_production']) :
        $data['date_of_production'] = $result[0]['date_of_production'];
    else:
        $data['date_of_production'] = '';
    endif; 
    if (isset($result[0]['pr_number']) && $result[0]['pr_number']) :
        $data['pr_number'] = $result[0]['pr_number'];
		$voucher_no= $data['pr_number'];
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
	     $data['pr_number_view']=$rs_id_code;
	else:
		$data['pr_number'] = '';
		$data['pr_number_view'] = '';
	endif; 
    if (isset($result[0]['remarks']) && $result[0]['remarks']) :
        $data['remarks'] = $result[0]['remarks'];
    else:
        $data['remarks'] = '';
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

     if (isset($result[0]['mill_no']) && $result[0]['mill_no']) :
        $data['mill_no'] = $result[0]['mill_no'];
    else:
        $data['mill_no'] = '';
    endif; 

    if (isset($result[0]['total_production_in_mt']) && $result[0]['total_production_in_mt']) :
        $data['total_production_in_mt'] = $result[0]['total_production_in_mt'];
    else:
        $data['total_production_in_mt'] = '';
    endif;
    
     if (isset($result[0]['production_details']) && $result[0]['production_details']) :
        $data['production_details'] = $result[0]['production_details'];
    else:
        $data['production_details'] = '';
    endif;
//  echo $data['pr_number_view'];exit;
	//$data['suppliers']=$this->production_register_model->getSuppliers();
	$data['items']=$this->production_register_model->getFGmineralsList();
	$data['departments'] = $this->production_register_model->getDepartments();
	$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	$this->load->model('gir_register_model');
	$data['units'] = $this->gir_register_model->getUnits();
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	$data['title']='Edit Production Register';
	$this->template->load('template','production_reg_edit',$data);
	
	}

	public function index(){
			$data['title']=' Production Register List';
			//$data['suppliers']=$this->production_register_model->getSuppliers();
			//$data['Items']=$this->production_register_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->production_register_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->production_register_model->getStates();
			$this->template->load('template','production_reg_view',$data);
		}

	
	public function report() 
	{
		$data['title'] = 'Production Register Report';
		$data['months'] = $this->production_register_model->getMonths();
		$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
		$data['items']=$this->production_register_model->getFGmineralsList();
		//$data['departments'] = $this->production_register_model->getDepartments();
		$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
		//$data['pr_data'] = $this->production_register_model->getList();
		//$this->load->model('production_logsheet_model');
		
		if($this->input->get())
		{
		 	$conditions['mill_no']=$this->input->get('mill_no');
		 	$conditions['finish_good_id']=$this->input->get('finish_good_id');
		 	//$conditions['category_of_approval']=$this->input->get('category_of_approval');
		 	if(!empty($this->input->post('from_date'))){
		 		$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
		 	}
		 	if(!empty($this->input->post('upto_date'))){
		 		$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	}
		 	
		 	$data['conditions']=$conditions;
            $data['pr_data'] = $this->production_register_model->filter_by_getList($conditions);
        }
		// }else{
		// $data['pr_data'] = $this->production_register_model->getList();
		// }

		//print_r($data['pr_data']);exit;
		//echo var_dump($data['students']);
		$this->template->load('template','production_reg_report',$data);
	}
	
	  function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{

			$conditions['mill_no']=$this->input->post('mill_no');
		 	$conditions['finish_good_id']=$this->input->post('finish_good_id');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$prod_Report = $this->production_register_model->filter_by_getList($conditions);
		}
		else
		{
			$prod_Report = $this->production_register_model->getList();
		}
		//print_r($prod_Report);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PR No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Of Production');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mill No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Total Production (MT)');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total MenPower');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Production By');      
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Grade Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'No of Bags');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Packing Size');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Prodution (MT)');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'KWH Consumed');       
          
        // set Row
      
        $rowCount = 2;
        foreach ($prod_Report as $element) {
        	
        	foreach ($element['production_details'] as $element2) {
        		$voucher_no=$element['pr_number'];
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

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rs_id_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['date_of_production']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['mill_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['total_production_in_mt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['total_workers']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['grade_name'].' ('.$element2['fg_code'].')');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['no_of_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element2['packing_size']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['production_in_mt']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element2['kwh_consumed']);	
            $rowCount++;
        	}
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="ProductionReport.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Production_registers/report', 'refresh');     
    }


	public function add_new_production() {
	/*	echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('finish_good_id[]', 'Finish Good ', 'required');
		
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
			'date_of_production' => date('Y-m-d',strtotime($this->input->post('date_of_production'))),
			'pr_number' => $this->input->post('pr_number'),
			'department_id' => $department_id,
			'mill_no' => $this->input->post('mill_no'),
			'total_production_in_mt' => $this->input->post('total_production_in_mt'),
			'remarks' => $this->input->post('remarks'),
			'created_by' => $login_id,
			'employee_id' => $login_id
			);
			//print_r($data);exit;
			$result = $this->production_register_model->pr_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Production_registers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Production_registers/index', 'refresh');
			}
		}
	}
	public function add_new_opening() {
	/*	echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('finish_good_id[]', 'Finish Good ', 'required');
		
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
			'date_of_production' => date('Y-m-d',strtotime($this->input->post('date_of_production'))),
			'remarks' => 'Opening Stock Entries',
			'created_by' => $login_id,
			'employee_id' => $login_id
			);
			//print_r($data);exit;
			$result = $this->production_register_model->insert_opening_stock($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Production_registers/OpeningStock', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Production_registers/OpeningStock', 'refresh');
			}
		}
	}

	public function edit_production(){

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
			'date_of_production' => date('Y-m-d',strtotime($this->input->post('date_of_production'))),
			'pr_number' => $this->input->post('pr_number'),
			'department_id' => $department_id,
			'mill_no' => $this->input->post('mill_no'),
			'total_production_in_mt' => $this->input->post('total_production_in_mt'),
			'remarks' => $this->input->post('remarks'),
			'edited_by' => $login_id,
			'employee_id' => $login_id
			);
			$old_id = $this->input->post('pr_id_old'); 
			//print_r($data);exit;
			$result = $this->production_register_model->editProduction($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Production_registers/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Production Register!');
			redirect('/Production_registers/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}


	public function deleteProduction($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->production_register_model->deleteProduction($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Production Register deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->production_register_model->deleteProduction($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Production Register deleted Successfully !');
			redirect('/Production_registers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Production_registers/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->production_register_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Production REgister Print View';
        $this->template->load('template','requisition_print',$data);
    } 
}

?>