<?php

//session_start(); //we need to start session in order to access it through CI

Class Packing_materials extends MY_Controller {

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
		
			if (isset($result['name']) && $result['name']) :
	            $data['name'] = $result['name'];
	       else:
	            $data['name'] = '';
	        endif;
	      /*  if (isset($result['code']) && $result['code']) :
	            $data['code'] = $result['code'];
	       else:
	            $data['code'] = '';
	        endif; */
		if (isset($result['code']) && $result['code']) {
	            $pm_id_code = $result['code'];
	            /*$voucher_no= $data['pm_code'];
	            if($voucher_no<10){
	            $pm_id_code='PM000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $pm_id_code='PM00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $pm_id_code='PM0'.$voucher_no;
	            }
	            else{
	              $pm_id_code='PM'.$voucher_no;
	            }*/
			}
		 else{
			$category_id='2';
			$data['pm_code'] = $this->categories_model->getPackingMaterialCode($category_id);
			//print_r($data['pm_code']);exit;
            $voucher_no= $data['pm_code'];
            if($voucher_no<10){
            $pm_id_code='PM000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $pm_id_code='PM00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $pm_id_code='PM0'.$voucher_no;
            }
            else{
              $pm_id_code='PM'.$voucher_no;
            }
           //print_r($pm_id_code);exit;
			}
			$data['pm_code_view']=$pm_id_code;

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;
			
			
			if (isset($result['grade']) && $result['grade']) :
	            $data['grade'] = $result['grade'];
	       else:
	            $data['grade'] = '';
	        endif;	
			if (isset($result['company_name']) && $result['company_name']) :
	            $data['comany_name'] = $result['company_name'];
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
	            $data['categories_id'] = '2';
	        endif;
	         if (isset($result['bag_size']) && $result['bag_size']) :
	            $data['bag_size'] = $result['bag_size'];
	       else:
	            $data['bag_size'] = '';
	        endif;
			if (isset($result['minimum_inventory_qty']) && $result['minimum_inventory_qty']) :
	            $data['minimum_inventory_qty'] = $result['minimum_inventory_qty'];
	       else:
	            $data['minimum_inventory_qty'] = '';
	        endif;

	         if (isset($result['description']) && $result['description']) :
	            $data['description'] = $result['description'];
	       else:
	            $data['description'] = '';
	        endif;

	        if (isset($result['supplier_id']) && $result['supplier_id']) :
	            $data['supplier_id'] = $result['supplier_id'];
	       else:
	            $data['supplier_id'] = '';
	        endif;
	        if (isset($result['unit_name']) && $result['unit_name']) :
	            $data['unit_name'] = $result['unit_name'];
	       else:
	            $data['unit_name'] = '';
	        endif;
	        if (isset($result['opening_stock_qty']) && $result['opening_stock_qty']) :
	            $data['opening_stock_qty'] = $result['opening_stock_qty'];
	       else:
	            $data['opening_stock_qty'] = '';
	        endif;


			$data['title'] = 'Packing Material Master';
				//$data['raw_material']=$this->categories_model->getCategories();
	          //$data['categories']=$this->categories_model->getSupplierCategories();
	          $data['suppliers']=$this->categories_model->getSuppliers($data['categories_id']);
			  $data['packing_materials'] = $this->categories_model->packingmaterialsList($data['categories_id']);
			  $data['categories'] = $this->categories_model->getMasterCategories();
			  $data['units'] = $this->categories_model->getUnits();
			//echo var_dump($data['students']);
			//print_r($data['name']);exit;
			$this->template->load('layout/template','packing_material_view',$data);
		/*}
		else{
			redirect('User_authentication/dashboard');
		}*/
	}
	public function add_newPM() {
		
		$this->form_validation->set_rules('name', 'Material Name', 'required');
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
			'unit_name' => $this->input->post('unit_name'),
			'bag_packing' => $this->input->post('bag_packing'),
			'bag_size' => $this->input->post('bag_size'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'description' => $this->input->post('description')
			);
			$result = $this->categories_model->packing_material_insert($data);
			if ($result == TRUE) {
				/*$data1 = array(
				'item_id' => $this->input->post('categories_id'),
				'transaction_date' => date('Y-m-d'),
				'employee_id' => $login_id,
				'department_id' => $department_id,
				'created_by' => $login_id,
				'status' => 'In',
				'quantity'=> $this->input->post('minimum_inventory_qty')
				);
				$result1 = $this->categories_model->insertStockRegister($data1);*/
			$this->session->set_flashdata('success', 'Packing Material Added Successfully !');
			redirect('/Packing_materials/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists , Packing Material Not Inserted !');
			redirect('/Packing_materials/index', 'refresh');
			}
		} 
	}

	public function editPM($id) {
		$this->form_validation->set_rules('name', 'Material Name', 'required');
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
			'unit_name' => $this->input->post('unit_name'),
			'bag_packing' => $this->input->post('bag_packing'),
			'bag_size' => $this->input->post('bag_size'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'opening_stock_qty'=> $this->input->post('opening_stock_qty'),
			'description' => $this->input->post('description'),
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
					$this->session->set_flashdata('success', 'Packing Material Updated Successfully !');
					redirect('/Packing_materials/index', 'refresh');
					//$this->fetchSuppliers();
					} else {
						$this->session->set_flashdata('failed', 'No Changes in Packing Material!');
						redirect('/Packing_materials/index', 'refresh');
					}
			
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Packing Material!');
			redirect('/Packing_materials/index', 'refresh');
			}
		} 
	}

	  	public function getProductsByCategory($id=NULL){
    	$data = array();
    	$data['products']=$this->categories_model->getProductsByCategory($id);
    	echo json_encode($this->load->view('productbycategory',$data));
    }
	public function report() 
	{
		$data['title'] = 'Raw Material Report';
		//$data['suppliers'] = $this->login_database->supplier_list();
		$data['packingmaterials']=$this->categories_model->pmList('2');
		
		//echo var_dump($data['students']);
		$this->template->load('layout/template','packing_material_report',$data);
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
        $objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getTop()
		        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getBottom()
		        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getLeft()
		        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getDefaultStyle()
		    ->getBorders()
		    ->getRight()
        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Packing Material Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Bag Packing');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Minimum Inventory Quantity');
               
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['name'].$element['bag_size']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['bag_packing']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['minimum_inventory_qty']);
            

            $rowCount++;
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="PackingMaterialData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Raw_material/index', 'refresh');     
    }
}

?>