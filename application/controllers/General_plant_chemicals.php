<?php

//session_start(); //we need to start session in order to access it through CI

Class General_plant_chemicals extends CI_Controller {

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

			if (isset($result['name']) && $result['name']) :
	            $data['name'] = $result['name'];
	       else:
	            $data['name'] = '';
	        endif;
	     
	      if (isset($result['code']) && $result['code']) {
	            $pm_id_code = $result['code'];
			}
		 else{
		 	$category_id='12';
			$data['rm_code'] = $this->categories_model->getPackingMaterialCode($category_id);
			//print_r($data['pm_code']);exit;
            $voucher_no= $data['rm_code'];
            if($voucher_no<10){
            $pm_id_code='GPC000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $pm_id_code='GPC00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $pm_id_code='GPC0'.$voucher_no;
            }
            else{
              $pm_id_code='GPC'.$voucher_no;
            }
           //print_r($pm_id_code);exit;
			}
			$data['bm_code_view']=$pm_id_code;

			 if (isset($result['opening_stock_qty']) && $result['opening_stock_qty']) :
	            $data['opening_stock_qty'] = $result['opening_stock_qty'];
	       else:
	            $data['opening_stock_qty'] = '';
	        endif;
			if (isset($result['company_name']) && $result['company_name']) :
	            $data['company_name'] = $result['company_name'];
	       else:
	            $data['company_name'] = '';
	        endif;	
		   if (isset($result['unit_name']) && $result['unit_name']) :
	            $data['unit_name'] = $result['unit_name'];
	       else:
	            $data['unit_name'] = '';
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
	            $data['categories_id'] = '12';
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

	        /*if (isset($result['description']) && $result['description']) :
	            $data['description'] = $result['description'];
	       else:
	            $data['description'] = '';
	        endif;*/


			$data['title'] = 'General Plant Chemical Master';
			$data['general_plant_chemicals'] = $this->categories_model->packingmaterialsList( $data['categories_id']);
			$data['categories'] = $this->categories_model->getMasterCategories();
			$data['units'] = $this->categories_model->getUnits();	
			//echo var_dump($data['students']);
			//print_r($data['name']);exit;
			$this->template->load('template','general_plant_chemical_view',$data);
		/*}
		else{
			redirect('User_authentication/dashboard');
		}*/
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
			
			$data = array(
			'categories_id' => $this->input->post('categories_id'),
			'name' => $this->input->post('name'),
			'unit_name' => $this->input->post('unit_name'),
			'company_name' => $this->input->post('company_name'),
			'code' => $this->input->post('code'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'description' => $this->input->post('description')
			);
			$result = $this->categories_model->packing_material_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'General Plant Chemicals Added Successfully !');
			redirect('/General_plant_chemicals/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists ,General Plant Chemicals Not Inserted !');
			redirect('/General_plant_chemicals/index', 'refresh');
			}
		} 
	}

	public function editPM($id) {
		$this->form_validation->set_rules('name', 'General Plant Chemicals Name', 'required');
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
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'unit_name' => $this->input->post('unit_name'),
			'company_name' => $this->input->post('company_name'),
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
					$this->session->set_flashdata('success', 'General Plant Chemicals Updated Successfully !');
					redirect('/General_plant_chemicals/index', 'refresh');
					//$this->fetchSuppliers();
					} else {
					$this->session->set_flashdata('failed', 'No Changes in General Plant Chemicals!');
					redirect('/General_plant_chemicals/index', 'refresh');
					}
			
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in General Plant Chemicals!');
			redirect('/General_plant_chemicals/index', 'refresh');
			}
		} 
	}

}

?>