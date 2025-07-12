<?php

//session_start(); //we need to start session in order to access it through CI

Class Waste_material_records extends MY_Controller {

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
//$this->load->model('waste_material_model');
$this->load->model('waste_material_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	//print_r($role_id);exit;
	
	//$data['suppliers']=$this->waste_material_model->getservice_providers();
	$data['voucher_code'] = $this->waste_material_model->getVoucherCode();
	$data['wm_code']= $data['voucher_code'];
	$voucher_no= $data['voucher_code'];
    if($voucher_no<10){
    $rs_id_code='WM000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $rs_id_code='WM00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $rs_id_code='WM010'.$voucher_no;
    }
    else{
      $rs_id_code='WM01/'.$voucher_no;
    }
    $data['wm_code_view']=$rs_id_code;
	$data['materials']=$this->waste_material_model->getMaterialsList();
	$data['departments'] = $this->waste_material_model->getDepartments();
	$data['suppliers'] = $this->waste_material_model->getservice_providers();
	$data['units'] = $this->waste_material_model->getUnits();
	$data['title']='Create Waste Material Record';
	$this->template->load('template','waste_material_add',$data);	
	//$this->load->view('footer');
	}

public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	//$role_id=$this->session->userdata['logged_in']['role_id'];
	//echo $role_id;exit;
	$data = array();
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	//$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];
	$result = $this->waste_material_model->getById($id);
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
        $data['wm_code'] = $result[0]['voucher_code'];
		$voucher_no= $data['wm_code'];
	    if($voucher_no<10){
	    $rs_id_code='WM/000'.$voucher_no;
	    }
	    else if(($voucher_no>=10) && ($voucher_no<=99)){
	      $rs_id_code='WM/00'.$voucher_no;
	    }
	    else if(($voucher_no>=100) && ($voucher_no<=999)){
	      $rs_id_code='WM0'.$voucher_no;
	    }
	    else{
	      $rs_id_code='WM/'.$voucher_no;
	    }
    	$data['wm_code_view']=$rs_id_code;
	endif; 	

    if (isset($result[0]['total_waste_materials'])) :
        $data['total_waste_materials'] = $result[0]['total_waste_materials'];
    else:
        $data['total_waste_materials'] = '';
    endif; 
    if (isset($result[0]['total_qty'])) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
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

     if (isset($result[0]['waste_details']) && $result[0]['waste_details']) :
        $data['waste_details'] = $result[0]['waste_details'];
    else:
        $data['waste_details'] = '';
    endif;

	//$data['suppliers']=$this->waste_material_model->getservice_providers();
    $data['materials']=$this->waste_material_model->getMaterialsList();
	$data['departments'] = $this->waste_material_model->getDepartments();
	$data['suppliers'] = $this->waste_material_model->getservice_providers();
	$data['units'] = $this->waste_material_model->getUnits();
	$data['title']='Edit Waste Material Record';
	$this->template->load('template','waste_material_edit',$data);
	
	}

	public function index(){
			$data['title']=' Waste Material List';
			//$data['suppliers']=$this->waste_material_model->getservice_providers();
			//$data['Items']=$this->waste_material_model->getItems();
			$login_id=$this->session->userdata['logged_in']['id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data['pr_data']=$this->waste_material_model->getList();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->waste_material_model->getStates();
			$this->template->load('template','waste_material_view',$data);
		}

	
	public function report() 
	{
		$data['title'] = 'Waste Material records Report';
		$data['departments'] = $this->waste_material_model->getDepartments();
		
		if($this->input->get())
			{
			 	$conditions['department_id']=$this->input->get('department_id');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;

	           $data['pr_data']=$this->waste_material_model->getList($conditions);

			}
			else{
				$data['pr_data']=$this->waste_material_model->getList();
			}
			
		$this->template->load('template','waste_material_report',$data);
	}


	function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
			{
			 	$conditions['department_id']=$this->input->post('department_id');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
			 	$data['conditions']=$conditions;

	           $reqSlipInfo=$this->waste_material_model->getList($conditions);

			}
			else{
				$reqSlipInfo=$this->waste_material_model->getList();
			}

        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Register No');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total Waste Material');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Incharge Name '); 
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $key=>$element) {
        	
    		
    		$inv_number=$element['voucher_code'];
                 
                  if($inv_number<10){
                    $inv_number1='WM000'.$inv_number;
                    }
                    else if(($inv_number>=10) && ($inv_number<=99)){
                      $inv_number1='WM00'.$inv_number;
                    }
                    else if(($inv_number>=100) && ($inv_number<=999)){
                      $inv_number1='WM0'.$inv_number;
                    }
                    else{
                      $inv_number1='WM'.$inv_number;
                    }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $inv_number1);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['total_waste_materials']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['employee']);
            $rowCount++;
        	
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Waste Material Records.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Waste_material_records/report', 'refresh');     
    }
	
	


	public function add_new_work() {
	/*	echo"<pre>";
		print_r($_POST);
		echo"</pre>";exit;*/
		$this->form_validation->set_rules('waste_material_name[]', 'Waste Material Name ', 'required');
		
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
			'voucher_code' => $this->input->post('wm_code'),
			'department_id' => $this->input->post('department_id'),
			'employee_id' => $login_id,
			'total_waste_materials' => $this->input->post('total_waste_materials'),
			/*'total_qty' => $this->input->post('total_qty'),*/
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->waste_material_model->wa_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Waste_material_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Waste_material_records/index', 'refresh');
			}
		}
	}

	public function edit_record(){

		$this->form_validation->set_rules('waste_material_name[]', 'Waste Material Name ', 'required');
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
			'voucher_code' => $this->input->post('wm_code'),
			'department_id' => $this->input->post('department_id'),
			'employee_id' => $login_id,
			'total_waste_materials' => $this->input->post('total_waste_materials'),
		/*	'total_qty' => $this->input->post('total_qty'),*/
			'edited_by' => $login_id
			);
			$old_id = $this->input->post('wa_id_old'); 
			//print_r($data);exit;
			$result = $this->waste_material_model->editWaste_material($data,$old_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Waste_material_records/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in Work Allotment !');
			redirect('/Waste_material_records/index', 'refresh');
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
  	 			$result=$this->waste_material_model->deleteRecord($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Waste Material deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->waste_material_model->deleteRecord($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Waste Material deleted Successfully !');
			redirect('/Waste_material_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Waste_material_records/index', 'refresh');
			}
  	 	}
  	 }
  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->waste_material_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Work Allotment Records View';
        $this->template->load('template','work_alloted_print',$data);
    } 
}

?>