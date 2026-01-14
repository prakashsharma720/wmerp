<?php
Class Machinary_equipments extends MY_Controller {

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

		// Load session library
		$this->load->library('session');
		$this->load->library('template');

		// Load database
		$this->load->model('machinary_equipments_model');
		$this->load->model('daily_stacking_model');
		$this->load->model('categories_model');
	}

	// Show login page
	public function add() {
		$data = array();
		$data['login_id']				= $this->session->userdata['logged_in']['id'];
		$data['department_id']  		= $this->session->userdata['logged_in']['department_id'];
		$role_id 						= $this->session->userdata['logged_in']['role_id'];
		$data['pme_code'] 				= $this->machinary_equipments_model->getGSRCode();
		$data['departments'] 			= $this->daily_stacking_model->getDepartments();
		$data['plant_machinary_list'] 	= $this->categories_model->packingmaterialsList(6);
		$data['title'] 					= 'Plant Machinary & Equipment';
		$this->template->load('layout/template','machinary_equipments_add',$data);
	}

	public function edit($id=NULL)
	{
		
		$data 					= array();
		$data['login_id'] 		= $this->session->userdata['logged_in']['id'];
		$data['department_id'] 	= $this->session->userdata['logged_in']['department_id'];
		$role_id 				= $this->session->userdata['logged_in']['role_id'];
		$result					= $this->machinary_equipments_model->getById($id);
		// echo "<pre>"; print_r($result);exit;

		if (isset($result[0]['pme_code']) && $result[0]['pme_code']) :
	        $data['pme_code'] = $result[0]['pme_code'];
			$voucher_no= $data['pme_code'];
		    if($voucher_no<10){
		    $rs_id_code='PME000'.$voucher_no;
		    }
		    else if(($voucher_no>=10) && ($voucher_no<=99)){
		      $rs_id_code='PME00'.$voucher_no;
		    }
		    else if(($voucher_no>=100) && ($voucher_no<=999)){
		      $rs_id_code='PME0'.$voucher_no;
		    }
		    else{
		      $rs_id_code='PME'.$voucher_no;
		    }
		    $data['pme_code']=$rs_id_code;
		endif;

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
	
		if (isset($result[0]['department_id']) && $result[0]['department_id']) :
			$data['department_id'] = $result[0]['department_id'];
		else:
			$data['department_id'] = '';
		endif;

		$data['plant_machinary_list'] 	= $this->categories_model->packingmaterialsList(6);
		$data['departments'] 			= $this->daily_stacking_model->getDepartments();
		$data['title'] 					= ' Edit Machinary Equipment ';
		$data['pme_data'] 				= $result[0]; 
		// echo "<pre>"; print_r($data);exit();

		$this->template->load('template','machinary_equipments_edit',$data);
	}

	public function index()
	{
		$data['title'] 		= ' Machinary Equipment ';
		$login_id 			= $this->session->userdata['logged_in']['id'];
		$role_id 			= $this->session->userdata['logged_in']['role_id'];
		$department_id 		= $this->session->userdata['logged_in']['department_id'];
		$data['pr_data'] 	= $this->machinary_equipments_model->getList();

		$this->template->load('layout/template','machinary_equipments_view',$data);
	}
	
	public function report() 
	{
		$data['title'] = 'Machinary Equipments Report';
		
		$data['areas']  = $this->daily_stacking_model->getDepartments();

			if($this->input->get())
			{
			 	$conditions['area']=$this->input->get('area');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;

	           $data['pr_data'] 	= $this->machinary_equipments_model->getList($conditions);

			}
			else{
				$data['pr_data'] 	= $this->machinary_equipments_model->getList();
			}
		

		// echo "<pre>"; print_r($data['departments']); die;
		$this->template->load('template','machinary_equipments_report',$data);
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

	           $reqSlipInfo 	= $this->machinary_equipments_model->getList($conditions);

			}
			else{
				$reqSlipInfo 	= $this->machinary_equipments_model->getList();
			}

        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'PME No');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Created By');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Equipment Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Equipment ID '); 
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Model / Type '); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Sr No ');  
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Make ');  
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Year of Installation '); 
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $key=>$element) {	

                     $inv_number=$element['pme_code'];
                          if($inv_number<10){
                            $inv_number1='PME000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='PME00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='PME0'.$inv_number;
                            }
                            else{
                              $inv_number1='PME'.$inv_number;
                            }

                   
        	
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $inv_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['equip_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['equipment_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['model_type']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['sr_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['make']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['year_of_install']);
            $rowCount++;
        	
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Machinary Equipments Records.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Machinary_equipments/report', 'refresh');     
    }
	
	public function add_new_record()
	{
		$this->form_validation->set_rules('equipment_name[]', 'Equipment Name ', 'required');
		
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
			$login_id 		= $this->session->userdata['logged_in']['id'];
			$role_id 		= $this->session->userdata['logged_in']['role_id'];
			$department_id 	= $this->session->userdata['logged_in']['department_id'];

			$data = array(
				'transaction_date' 		=> date('Y-m-d',strtotime($this->input->post('transaction_date'))),
				'pme_code' 				=> $this->input->post('pme_code'),
				'department_id' 		=> $this->input->post('department_id'),
				'equipment_name' 		=> $this->input->post('equipment_name'),
				'equipment_id' 			=> $this->input->post('equipment_id'),
				'model_type' 			=> $this->input->post('model_type'),
				'sr_no' 				=> $this->input->post('sr_no'),
				'make' 					=> $this->input->post('equipment_make'),
				'year_of_install' 		=> $this->input->post('year_of_install'),
				'created_by' 			=> $login_id,
			);
			
			$result = $this->machinary_equipments_model->pme_insert($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Data inserted Successfully !');
				redirect('/Machinary_equipments/index', 'refresh');
				//$this->fetchSuppliers();
			}
			else
			{
				$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
				redirect('/Machinary_equipments/index', 'refresh');
			}
		}
	}

	public function edit_pme()
	{
		// echo "in edit Record, posted data is:---><pre>";print_r($this->input->post());exit();
		$this->form_validation->set_rules('equipment_name', 'Equipment Name ', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in']))
			{
				$this->add($id);
			}
			else
			{
				$this->load->view('login_form');
			}
		} 
		else 
		{
			$login_id 		= $this->session->userdata['logged_in']['id'];
			$role_id 		= $this->session->userdata['logged_in']['role_id'];
			$department_id 	= $this->session->userdata['logged_in']['department_id'];
			
			// $data = array(
			// 	'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			// 	'dsr_code' => $this->input->post('dsr_code'),
			// 	'department_id' => $this->input->post('department_id'),
			// 	'total_bags' => $this->input->post('total_bags'),
			// 	'total_workers' => $this->input->post('total_workers'),
			// 	'total_rates' => $this->input->post('total_rate'),
			// 	'grand_total' => $this->input->post('total_amount'),
			// 	'edited_by' => $login_id,
			// );

			$data = array(
				'transaction_date' 		=> date('Y-m-d',strtotime($this->input->post('transaction_date'))),
				// 'pme_code' 				=> $this->input->post('pme_code'),
				'department_id' 		=> $this->input->post('department_id'),
				'equipment_name' 		=> $this->input->post('equipment_name'),
				'equipment_id' 			=> $this->input->post('equipment_id'),
				'model_type' 			=> $this->input->post('model_type'),
				'sr_no' 				=> $this->input->post('sr_no'),
				'make' 					=> $this->input->post('equipment_make'),
				'year_of_install' 		=> $this->input->post('year_of_install'),
				'edited_by' 			=> $login_id,
			);


			$old_id = $this->input->post('gsr_id_old'); 
			//print_r($data);exit;
			$result = $this->machinary_equipments_model->editGSR($data,$old_id);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Data Updated Successfully !');
				redirect('/Machinary_equipments/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'No changes in Machinary Equipments Record!');
				redirect('/Machinary_equipments/index', 'refresh');
			}
		}
	}


	public function deleteGSR($id= null)
	{
		echo 'in delete, id is:--->'.$id;exit();

		$ids = $this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->machinary_equipments_model->deleteGSR($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Machinary Equipment Record deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->machinary_equipments_model->deleteGSR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Machinary Equipments Record deleted Successfully !');
			redirect('/Machinary_equipments/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Machinary_equipments/index', 'refresh');
			}
  	 	}
  	}

  	public function print($id)
  	{
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->machinary_equipments_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Production Register Print View';
        $this->template->load('template','requisition_print',$data);
    } 
}

?>