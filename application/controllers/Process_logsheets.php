<?php

//session_start(); //we need to start session in order to access it through CI

Class Process_logsheets extends MY_Controller {

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
//$this->load->model('process_logsheet_model');
$this->load->model('process_logsheet_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->process_logsheet_model->getSuppliers();
	$data['pl_number'] = $this->process_logsheet_model->getPLCode();
	$voucher_no= $data['pl_number'];
    if($voucher_no<10){
    $rs_id_code='PSL000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='PSL00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='PSL0'.$voucher_no;
    }
    else{
      $rs_id_code='PSL'.$voucher_no;
    }
    $data['pl_number_view']=$rs_id_code;
	$data['items']=$this->process_logsheet_model->getFGmineralsList();
	$data['departments'] = $this->process_logsheet_model->getDepartments();
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
	//$data['grades']=$this->process_logsheet_model->getGrades();
	//$data['states']=$this->process_logsheet_model->getStates();
	$data['title']='Create Process Logsheet';
	$this->template->load('layout/template','process_logsheet_add',$data);	
	//$this->load->view('footer');	
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	//$role_id=$this->session->userdata['logged_in']['role_id'];
	//echo $role_id;exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	$result = $this->process_logsheet_model->getById($id);
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
		$voucher_no= $result[0]['voucher_code'];
	    if($voucher_no<10){
	    $rs_id_code='PSL000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='PSL00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='PSL0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='PSL'.$voucher_no;
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
    if (isset($result[0]['process_details'])) :
        $data['process_details'] = $result[0]['process_details'];
    else:
        $data['process_details'] = '';
    endif;

	//$data['suppliers']=$this->process_logsheet_model->getSuppliers();
	$data['items']=$this->process_logsheet_model->getFGmineralsList();
	$data['departments'] = $this->process_logsheet_model->getDepartments();
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
	$data['title']='Edit Process Logsheet';
	$this->template->load('template','process_logsheet_edit',$data);
	
	}

	public function index(){
			$data['title']='Process Logsheet Lists ';
			//$data['suppliers']=$this->process_logsheet_model->getSuppliers();
			//$data['Items']=$this->process_logsheet_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->process_logsheet_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->process_logsheet_model->getStates();
			$this->template->load('layout/template','process_logsheet_view',$data);
		}

	
	public function report() 
	{
		$data['title'] = 'Suppliers Report';
		$data['suppliers'] = $this->process_logsheet_model->supplier_list();

		//echo var_dump($data['students']);
		$this->template->load('template','supplier_report',$data);
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
			'remarks' => $this->input->post('remarks'),
			'created_by' => $login_id,
			);
			//print_r($data);exit;
			$result = $this->process_logsheet_model->pl_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Process_logsheets/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Process_logsheets/index', 'refresh');
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
			'voucher_code' => $this->input->post('pl_number'),
			'department_id' => $this->input->post('department_id'),
			'mill_no' => $this->input->post('mill_no'),
			'remarks' => $this->input->post('remarks'),
			'edited_by' => $login_id,
			);
			$old_id = $this->input->post('edit_id'); 
			//print_r($data);exit;
			$result = $this->process_logsheet_model->editGSR($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Process_logsheets/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Daily Stitching Record!');
			redirect('/Process_logsheets/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
	}


	public function deleteProcess($id= null)
	{
		$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->process_logsheet_model->deleteGSR($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Selected Process Logsheets deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->process_logsheet_model->deleteGSR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'DProcess Logsheetdeleted Successfully !');
			redirect('/Process_logsheets/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Process_logsheets/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->process_logsheet_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Production Register Print View';
        $this->template->load('template','requisition_print',$data);
    } 
}

?>