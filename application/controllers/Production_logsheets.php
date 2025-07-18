<?php

//session_start(); //we need to start session in order to access it through CI

Class Production_logsheets extends MY_Controller {

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
//$this->load->model('production_logsheet_model');
$this->load->model('production_logsheet_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->production_logsheet_model->getSuppliers();
	$data['pl_number'] = $this->production_logsheet_model->getPLCode();
	$voucher_no= $data['pl_number'];
    if($voucher_no<10){
    $rs_id_code='PL000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='PL00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='PL0'.$voucher_no;
    }
    else{
      $rs_id_code='PL'.$voucher_no;
    }
    $data['pl_number_view']=$rs_id_code;
	$data['items']=$this->production_logsheet_model->getFGmineralsList();
	$data['departments'] = $this->production_logsheet_model->getDepartments();
	$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	$data['hours']= array('00' => '00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13',
		'14'=>'14',
		'15'=>'15',
		'16'=>'16',
		'17'=>'17',
		'18'=>'18',
		'19'=>'19',
		'20'=>'20',
		'21'=>'21',
		'22'=>'22',
		'23'=>'23',
	);
	$data['minutes']= array(
		'00' => '00',
		'01'=>'01',
		'02'=>'02',
		'03'=>'03',
		'04'=>'04',
		'05'=>'05',
		'06'=>'06',
		'07'=>'07',
		'08'=>'08',
		'09'=>'09',
		'10'=>'10',
		'11'=>'11',
		'12'=>'12',
		'13'=>'13',
		'14'=>'14',
		'15'=>'15',
		'16'=>'16',
		'17'=>'17',
		'18'=>'18',
		'19'=>'19',
		'20'=>'20',
		'21'=>'21',
		'22'=>'22',
		'23'=>'23',
		'24'=>'24',
		'25'=>'25',
		'26'=>'26',
		'27'=>'27',
		'28'=>'28',
		'29'=>'29',
		'30'=>'30',
		'31'=>'31',
		'32'=>'32',
		'33'=>'33',
		'34'=>'34',
		'35'=>'35',
		'36'=>'36',
		'37'=>'37',
		'38'=>'38',
		'39'=>'39',
		'40'=>'40',
		'41'=>'41',
		'42'=>'42',
		'43'=>'43',
		'44'=>'44',
		'45'=>'45',
		'46'=>'46',
		'47'=>'47',
		'48'=>'48',
		'49'=>'49',
		'50'=>'50',
		'51'=>'51',
		'52'=>'52',
		'53'=>'53',
		'54'=>'54',
		'55'=>'55',
		'56'=>'56',
		'57'=>'57',
		'58'=>'58',
		'59'=>'59',
	);
	//$data['grades']=$this->production_logsheet_model->getGrades();
	//$data['states']=$this->production_logsheet_model->getStates();
	$data['title']='Create Production Logsheet';
	$this->template->load('layout/template','production_logsheet_add',$data);	
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
	$result = $this->production_logsheet_model->getById($id);
	//print_r($result);exit;
	if (isset($result[0]['total_machine_total_time'])) :
        $data['total_machine_total_time'] = $result[0]['total_machine_total_time'];
    else:
        $data['total_machine_total_time'] = '';
    endif;
    if (isset($result[0]['total_machine_down_time'])) :
        $data['total_machine_down_time'] = $result[0]['total_machine_down_time'];
    else:
        $data['total_machine_down_time'] = '';
    endif;
    if (isset($result[0]['total_actual_time'])) :
        $data['total_actual_time'] = $result[0]['total_actual_time'];
    else:
        $data['total_actual_time'] = '';
    endif;

    
if (isset($result[0]['total_production'])) :
        $data['total_production'] = $result[0]['total_production'];
    else:
        $data['total_production'] = '';
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
    if (isset($result[0]['total_kwh_consumed'])) :
        $data['total_kwh_consumed'] = $result[0]['total_kwh_consumed'];
    else:
        $data['total_kwh_consumed'] = '';
    endif;


	if (isset($result[0]['id'])) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = '';
    endif; 
    if (isset($result[0]['voucher_code']) && $result[0]['voucher_code']) :
        $data['pl_number'] = $result[0]['voucher_code'];
		$voucher_no= $result[0]['voucher_code'];
	    if($voucher_no<10){
	    $rs_id_code='PL000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='PL00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='PL0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='PL'.$voucher_no;
	    }
	    $data['pl_number_view']=$rs_id_code;
	endif; 
  
    if (isset($result[0]['department_id']) && $result[0]['department_id']) :
        $data['department_id'] = $result[0]['department_id'];
    else:
        $data['department_id'] = '';
    endif; 
    if (isset($result[0]['mill_no'])) :
        $data['mill_no'] = $result[0]['mill_no'];
    else:
        $data['mill_no'] = '';
    endif;
     if (isset($result[0]['remarks'])) :
        $data['remarks'] = $result[0]['remarks'];
    else:
        $data['remarks'] = '';
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

   
     if (isset($result[0]['production_details'])):
        $data['production_details'] = $result[0]['production_details'];
    else:
        $data['production_details'] = '';
    endif;

	//$data['suppliers']=$this->production_logsheet_model->getSuppliers();
	$data['items']=$this->production_logsheet_model->getFGmineralsList();
	$data['departments'] = $this->production_logsheet_model->getDepartments();
	$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
	$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
	$data['hours']= array('00' => '00','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13',
		'14'=>'14',
		'15'=>'15',
		'16'=>'16',
		'17'=>'17',
		'18'=>'18',
		'19'=>'19',
		'20'=>'20',
		'21'=>'21',
		'22'=>'22',
		'23'=>'23',
	);
	$data['minutes']= array(
		'00' => '00',
		'01'=>'01',
		'02'=>'02',
		'03'=>'03',
		'04'=>'04',
		'05'=>'05',
		'06'=>'06',
		'07'=>'07',
		'08'=>'08',
		'09'=>'09',
		'10'=>'10',
		'11'=>'11',
		'12'=>'12',
		'13'=>'13',
		'14'=>'14',
		'15'=>'15',
		'16'=>'16',
		'17'=>'17',
		'18'=>'18',
		'19'=>'19',
		'20'=>'20',
		'21'=>'21',
		'22'=>'22',
		'23'=>'23',
		'24'=>'24',
		'25'=>'25',
		'26'=>'26',
		'27'=>'27',
		'28'=>'28',
		'29'=>'29',
		'30'=>'30',
		'31'=>'31',
		'32'=>'32',
		'33'=>'33',
		'34'=>'34',
		'35'=>'35',
		'36'=>'36',
		'37'=>'37',
		'38'=>'38',
		'39'=>'39',
		'40'=>'40',
		'41'=>'41',
		'42'=>'42',
		'43'=>'43',
		'44'=>'44',
		'45'=>'45',
		'46'=>'46',
		'47'=>'47',
		'48'=>'48',
		'49'=>'49',
		'50'=>'50',
		'51'=>'51',
		'52'=>'52',
		'53'=>'53',
		'54'=>'54',
		'55'=>'55',
		'56'=>'56',
		'57'=>'57',
		'58'=>'58',
		'59'=>'59',
	);
	$data['title']='Edit Production Logsheet';
	$this->template->load('template','production_logsheet_edit',$data);
	
	}

	public function index(){
			$data['title']='Production Logsheet Lists ';
			//$data['suppliers']=$this->production_logsheet_model->getSuppliers();
			//$data['Items']=$this->production_logsheet_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->production_logsheet_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->production_logsheet_model->getStates();
			$this->template->load('layout/template','production_logsheet_view',$data);
		}

	
	public function report() 
	{
		$this->load->model('production_register_model');
		$data['title'] = 'Production Logsheet Report';
		$data['months'] = $this->production_register_model->getMonths();
		$data['equipments']= array('CP1' => 'CP1','CP2'=>'CP2','CP3'=>'CP3','CP4'=>'CP4');
		$data['items']=$this->production_register_model->getFGmineralsList();
		//$data['departments'] = $this->production_register_model->getDepartments();
		$data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
		$data['pr_data'] = $this->production_logsheet_model->getList();
		
		
		if($this->input->get())
		{
		 	$conditions['mill_no']=$this->input->get('mill_no');
		 	$conditions['finish_good_id']=$this->input->get('finish_good_id');
		 	//$conditions['category_of_approval']=$this->input->get('category_of_approval');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
            $data['pr_data'] = $this->w->filter_by_getList($conditions);

		}else{
		$data['pr_data'] = $this->production_logsheet_model->getList();
		}

		//print_r($data['pr_data']);exit;
		$this->template->load('template','production_log_report',$data);
	}
	


	public function add_new_record() {
		/*echo"<pre>";
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
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'voucher_code' => $this->input->post('pl_number'),
			'department_id' => $this->input->post('department_id'),
			'mill_no' => $this->input->post('mill_no'),
			'total_machine_total_time' => $this->input->post('total_machine_total_time'),
			'total_machine_down_time' => $this->input->post('total_machine_down_time'),
			'total_actual_time' => $this->input->post('total_actual_time'),
			'total_production' => $this->input->post('total_production_in_mt'),
			'total_bags' => $this->input->post('total_bags'),
			'total_opening' => $this->input->post('total_opening'),
			'total_closing' => $this->input->post('total_closing'),
			'total_kwh_consumed' => $this->input->post('total_kwh_consumed'),
			'total_kwh_consumed' => $this->input->post('total_kwh_consumed'),
			'total_machin_time' => $this->input->post('total_time'),
			'total_tailing' => $this->input->post('total_tailing'),
			'total_rpm' => $this->input->post('total_rpm'),
			'total_mill_amp' => $this->input->post('total_mill_amp'),
			'total_hrz' => $this->input->post('total_hrz'),
			'total_blower_amp' => $this->input->post('total_blower_amp'),
			'total_screw' => $this->input->post('total_screw'),
			'total_air_rpm' => $this->input->post('total_air_rpm'),
			'remarks' => $this->input->post('remarks'),
			'created_by' => $login_id,
			);
			//print_r($data);exit;
			$result = $this->production_logsheet_model->pl_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Production_logsheets/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Production_logsheets/index', 'refresh');
			}
		}
	}

	public function edit_dsr($id){

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
			'voucher_code' => $this->input->post('pl_number'),
			'department_id' => $this->input->post('department_id'),
			'mill_no' => $this->input->post('mill_no'),
			'total_machine_total_time' => $this->input->post('total_machine_total_time'),
			'total_machine_down_time' => $this->input->post('total_machine_down_time'),
			'total_actual_time' => $this->input->post('total_actual_time'),
			'total_production' => $this->input->post('total_production_in_mt'),
			'total_bags' => $this->input->post('total_bags'),
			'total_opening' => $this->input->post('total_opening'),
			'total_closing' => $this->input->post('total_closing'),
			'total_kwh_consumed' => $this->input->post('total_kwh_consumed'),
			'total_kwh_consumed' => $this->input->post('total_kwh_consumed'),
			'total_machin_time' => $this->input->post('total_time'),
			'total_tailing' => $this->input->post('total_tailing'),
			'total_rpm' => $this->input->post('total_rpm'),
			'total_mill_amp' => $this->input->post('total_mill_amp'),
			'total_hrz' => $this->input->post('total_hrz'),
			'total_blower_amp' => $this->input->post('total_blower_amp'),
			'total_screw' => $this->input->post('total_screw'),
			'total_air_rpm' => $this->input->post('total_air_rpm'),
			'remarks' => $this->input->post('remarks'),
			'edited_by' => $login_id,
			);
			//print_r($data);exit;
			$result = $this->production_logsheet_model->editGSR($data,$id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Production_logsheets/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No changes in existing record');
			redirect('/Production_logsheets/index', 'refresh');
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
  	 			$result=$this->production_logsheet_model->deleteProduction($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Selected Record deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->production_logsheet_model->deleteProduction($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Record deleted Successfully !');
			redirect('/Production_logsheets/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Production_logsheets/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->production_logsheet_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Production Register Print View';
        $this->template->load('template','requisition_print',$data);
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
           	$pr_data = $this->production_logsheet_model->filter_by_getList($conditions);
		}
		else
		{
			$pr_data = $this->production_logsheet_model->getList();
		}
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
             
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'PR No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date Of Production');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Mill No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Grade Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Lot No');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Batch No');      
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'No Of Bags');      
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Total Production (MT)');      
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Total Time (Hrs)');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Down Time (Hrs)');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Down Reason');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Tailing Qty (Kg)');       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Tailing % ');       
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Production/Hour');       
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Unit/MT');       
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Production By');       
          
        // set Row
      
        $rowCount = 2;
        $no_of_bags=0;
        $total_production=0;
        $machine_total_time=0;
        $total_machine_down_time=0;
        $total_tailing=0;
        $total_tailing_per=0;
        $i=1;foreach($pr_data as $obj){ 
        if(!empty($obj['production_details'])){ 
         
         
          $j=1;foreach($obj['production_details'] as $po_detail){
            $no_of_bags=$no_of_bags+$po_detail['no_of_bags'];
            $total_production=$total_production+$po_detail['production_in_mt'];
            $machine_total_time=$machine_total_time+$po_detail['machine_total_time'];
            $total_machine_down_time=$total_machine_down_time+$po_detail['machine_down_time'];
            $total_tailing=$total_tailing+$po_detail['tailing_qty'];
            $total_tailing_per=$total_tailing_per+$po_detail['tailing_per'];
            $inv_number=$obj['voucher_code'];
          	if($inv_number<10){
            $inv_number1='PL000'.$inv_number;
            }
            else if(($inv_number>=10) && ($inv_number<=99)){
              $inv_number1='PL00'.$inv_number;
            }
            else if(($inv_number>=100) && ($inv_number<=999)){
              $inv_number1='PL0'.$inv_number;
            }
            else{
              $inv_number1='PL'.$inv_number;
            }
            $date_of_production=date('d-M-Y',strtotime($obj['transaction_date']));
            $grade_name= $po_detail['grade_name'].' ('.$po_detail['mineral_name'].', '.$po_detail['packing_size'].'Kg )';
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $inv_number1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $date_of_production);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $obj['mill_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $grade_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $po_detail['lot_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $po_detail['batch_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $po_detail['no_of_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $po_detail['production_in_mt']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $po_detail['machine_total_time']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $po_detail['machine_down_time']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $po_detail['down_reason']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $po_detail['tailing_qty']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $po_detail['tailing_per']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $po_detail['per_hour_production']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $po_detail['unit_per_mt']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $obj['employee']);	
            $rowCount++;
        		}
	        }
	    }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="production_logsheet_report.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Production_logsheets/report', 'refresh');     
    } 
}

?>