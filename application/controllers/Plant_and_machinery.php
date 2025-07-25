w<?php

//session_start(); //we need to start session in order to access it through CI

Class Plant_and_machinery extends MY_Controller {

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
	            $lc_id_code = $result['code'];
	           /* $voucher_no= $data['pt_code'];
	            if($voucher_no<10){
	            $lc_id_code='PLM000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $lc_id_code='PLM00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $lc_id_code='PLM0'.$voucher_no;
	            }
	            else{
	              $lc_id_code='PLM'.$voucher_no;
	            }*/
			}
		 else{
			$category_id='6';
			$data['pt_code'] = $this->categories_model->getPackingMaterialCode($category_id);
			//print_r($data['pt_code']);exit;
            $voucher_no= $data['pt_code'];
            if($voucher_no<10){
            $lc_id_code='PLM000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $lc_id_code='PLM00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $lc_id_code='PLM0'.$voucher_no;
            }
            else{
              $lc_id_code='PLM'.$voucher_no;
            }
           //print_r($pm_id_code);exit;
			}
			$data['pt_code_view']=$lc_id_code;

			if (isset($result['grade']) && $result['grade']) :
	            $data['grade'] = $result['grade'];
	       else:
	            $data['grade'] = '';
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
	            $data['categories_id'] = '6';
	        endif;
	         if (isset($result['bag_size']) && $result['bag_size']) :
	            $data['bag_size'] = $result['bag_size'];
	       else:
	            $data['bag_size'] = '';
	        endif;
	         if (isset($result['description']) && $result['description']) :
	            $data['description'] = $result['description'];
	       else:
	            $data['description'] = '';
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


			$data['title'] = 'plant and machinery Master';
			$data['plant_and_machineries'] = $this->categories_model->packingmaterialsList( $data['categories_id']);
			$data['categories'] = $this->categories_model->getMasterCategories();
			$data['units'] = $this->categories_model->getUnits();
			//echo var_dump($data['students']);
			//print_r($data['name']);exit;
			$this->template->load('layout/template','plant_and_machinery_view',$data);
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
			'code' => $this->input->post('code'),
			'bag_size' => $this->input->post('bag_size'),
			'type' => $this->input->post('type'),
			'unit_name'=> $this->input->post('unit_name'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'description' => $this->input->post('description')
			);
			$result = $this->categories_model->packing_material_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Plant and machinery Added Successfully !');
			redirect('/Plant_and_machinery/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists ,Plant and machinery Not Inserted !');
			redirect('/Plant_and_machinery/index', 'refresh');
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
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'bag_size' => $this->input->post('bag_size'),
			'type' => $this->input->post('type'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'unit_name'=> $this->input->post('unit_name'),
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
					$this->session->set_flashdata('success', 'Plant and machinery Updated Successfully !');
					redirect('/Plant_and_machinery/index', 'refresh');
					//$this->fetchSuppliers();
					} else {
						$this->session->set_flashdata('failed', 'No Changes in Plant and machinery!');
						redirect('/Plant_and_machinery/index', 'refresh');
					}

			
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Plant and machinery!');
			redirect('/Plant_and_machinery/index', 'refresh');
			}
		} 
	}

}

?>