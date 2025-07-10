<?php

//session_start(); //we need to start session in order to access it through CI

Class Raw_material extends CI_Controller {

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


// Load session library
$this->load->library('session');


$this->load->library('template');

// Load database
$this->load->model('categories_model');
}

// Show login page	

	public function index($id = NULL) 
	{
		
		$data = array();
			$result = $this->categories_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;
				if (isset($result['supplier_id']) && $result['supplier_id']) :
	            $data['supplier_id'] = $result['supplier_id'];
	       else:
	            $data['supplier_id'] = '';
	        endif;
			if (isset($result['name']) && $result['name']) :
	            $data['name'] = $result['name'];
	       else:
	            $data['name'] = '';
	        endif;

	     if (isset($result['code']) && $result['code']) {
	            $pm_id_code = $result['code'];
	           /* $voucher_no= $data['rm_code'];
	            if($voucher_no<10){
	            $pm_id_code='RM000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $pm_id_code='RM00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $pm_id_code='RM0'.$voucher_no;
	            }
	            else{
	              $pm_id_code='RM'.$voucher_no;
	            }*/
			}
		 else{
		 	$category_id='1';
			$data['rm_code'] = $this->categories_model->getPackingMaterialCode($category_id);
			//print_r($data['pm_code']);exit;
            $voucher_no= $data['rm_code'];
            if($voucher_no<10){
            $pm_id_code='RM000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $pm_id_code='RM00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $pm_id_code='RM0'.$voucher_no;
            }
            else{
              $pm_id_code='RM'.$voucher_no;
            }
           //print_r($pm_id_code);exit;
			}
			$data['rm_code_view']=$pm_id_code;


			if (isset($result['grade_id']) && $result['grade_id']) :
	            $data['grade_id'] = $result['grade_id'];
	       else:
	            $data['grade_id'] = '';
	        endif;	
			if (isset($result['grade_name']) && $result['grade_name']) :
	            $data['grade_name'] = $result['grade_name'];
	       else:
	            $data['grade_name'] = '';
	        endif;
			if (isset($result['company_name']) && $result['company_name']) :
	            $data['company_name'] = $result['company_name'];
	       else:
	            $data['company_name'] = '';
	        endif;	
			if (isset($result['expiry_date']) && $result['expiry_date']) :
	            $data['expiry_date'] = $result['expiry_date'];
	       else:
	            $data['expiry_date'] = '';
	        endif;
			if (isset($result['mf_date']) && $result['mf_date']) :
	            $data['mf_date'] = $result['mf_date'];
	       else:
	            $data['mf_date'] = '';
	        endif;
			if (isset($result['type']) && $result['type']) :
	            $data['type'] = $result['type'];
	       else:
	            $data['type'] = '';
	        endif;	
		
	        if (isset($result['bag_packing']) && $result['bag_packing']) :
	            $data['bag_packing'] = $result['bag_packing'];
	       else:
	            $data['bag_packing'] = '';
	        endif;
	         if (isset($result['categories_id']) && $result['categories_id']) :
	            $data['categories_id'] = $result['categories_id'];
	       else:
	            $data['categories_id'] = '1';
	        endif;
	         if (isset($result['bag_size']) && $result['bag_size']) :
	            $data['bag_size'] = $result['bag_size'];
	       else:
	            $data['bag_size'] = '';
	        endif;
	         if (isset($result['unit_name']) && $result['unit_name']) :
	            $data['unit_name'] = $result['unit_name'];
	       else:
	            $data['unit_name'] = '';
	        endif;
			if (isset($result['minimum_inventory_qty']) && $result['minimum_inventory_qty']) :
	            $data['minimum_inventory_qty'] = $result['minimum_inventory_qty'];
	       else:
	            $data['minimum_inventory_qty'] = '';
	        endif;

	        if (isset($result['opening_stock_qty']) && $result['opening_stock_qty']) :
	            $data['opening_stock_qty'] = $result['opening_stock_qty'];
	       else:
	            $data['opening_stock_qty'] = '';
	        endif;

			$data['title'] = 'Raw Material Master';
			//$data['categories']=$this->categories_model->getSupplierCategories();
	        $data['suppliers']=$this->categories_model->getSuppliers($data['categories_id']);
			$data['raw_materials'] = $this->categories_model->packingmaterialsList($data['categories_id']);
			$data['categories'] = $this->categories_model->getMasterCategories();
			//for add grade
			$data['units'] = $this->categories_model->getUnits();
			$this->load->model('grades_model');
			$data['grades'] = $this->grades_model->getGradeByCategory($data['categories_id']);
			
			//echo var_dump($data['students']);
			//print_r($data['name']);exit;
			$this->template->load('template','raw_material_view',$data);
		/*}
		else{
			redirect('User_authentication/dashboard');
		}*/
	}
	public function report() 
	{
		$data['title'] = 'Raw Material Report';
		//$data['suppliers'] = $this->login_database->supplier_list();
		$data['rawmaterials']=$this->categories_model->rawmaterialsList('1');
		
		//echo var_dump($data['students']);
		$this->template->load('template','raw_material_report',$data);
	}
	public function minimum_inventory_levels() 
	{
		$data['title'] = 'Minimum Inventory Levels Report';
		//$data['suppliers'] = $this->login_database->supplier_list();
		$data['minimum_levels']=$this->categories_model->minimum_inventory_levels_list();
			
		//echo var_dump($data['students']);
		//print_r($data['minimum_levels']);exit;
		$this->template->load('template','minimum_inventory_report',$data);
	}
	public function add_newPM() {
		
		$this->form_validation->set_rules('name', ' Name', 'required');
		//$this->form_validation->set_rules('bag_packing', 'Packing', 'required');
		//$this->form_validation->set_rules('categories_id', 'Category', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->index();
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
			'categories_id' => $this->input->post('categories_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'grade_id' => $this->input->post('grade_id'),
			'unit_name' => $this->input->post('unit_name'),
			'grade_name' => $this->input->post('grade_name'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty')
			);
			$result = $this->categories_model->packing_material_insert($data);
			if ($result == TRUE) {

/*				$data1 = array(
				'item_id' => $this->input->post('categories_id'),
				'transaction_date' => date('Y-m-d'),
				'employee_id' => $login_id,
				'department_id' => $department_id,
				'created_by' => $login_id,
				'status' => 'In',
				'quantity'=> $this->input->post('minimum_inventory_qty')
				);*/
				//$result1 = $this->categories_model->insertStockRegister($data1);

				//if ($result1 == TRUE) {
					$this->session->set_flashdata('success', 'Raw Material Added Successfully !');
					redirect('/Raw_material/index', 'refresh');
					//}
				/*else {
					$this->session->set_flashdata('failed', 'Already Exists , Raw Material Not Inserted !');
					redirect('/Raw_material/index', 'refresh');
					}*/
			//$this->fetchSuppliers();
			} 
			else {
			$this->session->set_flashdata('failed', 'Already Exists , Raw Material Not Inserted !');
			redirect('/Raw_material/index', 'refresh');
			}
		} 
	}

	public function editPM($id) {
		$this->form_validation->set_rules('name', 'Material Name', 'required');
		//$this->form_validation->set_rules('bag_packing', 'Packing', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->index();
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
			'categories_id' => $this->input->post('categories_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'grade_id' => $this->input->post('grade_id'),
			'unit_name' => $this->input->post('unit_name'),
			'grade_name' => $this->input->post('grade_name'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'opening_stock_qty'=> $this->input->post('opening_stock_qty'),
			'flag' => $this->input->post('flag')
			);
			$result = $this->categories_model->packing_material_update($data,$id);
			//echo $result;exit;
			if ($result == TRUE) {
				$data1 = array(
				'item_id' => $id,
				'transaction_date' => date('Y-m-d'),
				'employee_id' => $login_id,
				'department_id' => $department_id,
				'created_by' => $login_id,
				'status' => 'In',
				'opening_stock' => 'Yes',
				'quantity'=> $this->input->post('opening_stock_qty')
				);
				$result1 = $this->categories_model->insertStockRegister($data1);
				if ($result1 == TRUE) {
					$this->session->set_flashdata('success', 'Raw Material Updated Successfully !');
					redirect('/Raw_material/index', 'refresh');
					//$this->fetchSuppliers();
					} else {
					$this->session->set_flashdata('failed', 'No Changes in Raw Material!');
					redirect('/Raw_material/index', 'refresh');
					}
				}
				else{
					$this->session->set_flashdata('failed', 'Updation Failed !');
					redirect('/Raw_material/index', 'refresh');
				} 
			}
		}
	   function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');
		if($this->input->post())
		{
		 	$categories_id=$this->input->post('categories_id');
            $empInfo = $this->categories_model->export_csv($categories_id);
		}
		/*else
		{
			 $empInfo = $this->categories_model->export_csv();
		}*/
       
		
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Supplier Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Classification');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Grade');       
   
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['supplier']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['grade']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['grade_name']);

            $rowCount++;
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RawMaterialData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Raw_material/index', 'refresh');     
    }
}

?>