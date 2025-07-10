<?php

//session_start(); //we need to start session in order to access it through CI

Class Computer_peripherals extends CI_Controller {

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
	   		
	   		if (isset($result['code']) && $result['code']) :
	            $service_code = $result['code'];
	       else:
		        $category_id='7';
				$data['service_code'] = $this->categories_model->getPackingMaterialCode($category_id);
				//print_r($data['pt_code']);exit;
	            $voucher_no= $data['service_code'];
	            if($voucher_no<10){
	            $service_code='CMP000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $service_code='CMP00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $service_code='CMP0'.$voucher_no;
	            }
	            else{
	              $service_code='CMP'.$voucher_no;
	            }
	        endif;

			$data['service_code_view']=$service_code;

	      
	         if (isset($result['categories_id']) && $result['categories_id']) :
	            $data['categories_id'] = $result['categories_id'];
	       else:
	            $data['categories_id'] = '7';
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

	        if (isset($result['opening_stock_qty']) && $result['opening_stock_qty']) :
	            $data['opening_stock_qty'] = $result['opening_stock_qty'];
	       else:
	            $data['opening_stock_qty'] = '';
	        endif;

	         if (isset($result['unit_name']) && $result['unit_name']) :
	            $data['unit_name'] = $result['unit_name'];
	       else:
	            $data['unit_name'] = '';
	        endif;

			$data['title'] = 'Computer peripherals Master';
			$data['computer_peripherals'] = $this->categories_model->packingmaterialsList( $data['categories_id']);
			$data['categories'] = $this->categories_model->getMasterCategories();
			//echo var_dump($data['students']);
			//print_r($data['name']);exit;
			$data['units'] = $this->categories_model->getUnits();
			$this->template->load('template','computer_peripherals_view',$data);
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
			'unit_name' => $this->input->post('unit_name'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
			'description' => $this->input->post('description')
			);
			$result = $this->categories_model->packing_material_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Services Added Successfully !');
			redirect('/Services/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists , Services Not Inserted !');
			redirect('/Services/index', 'refresh');
			}
		} 
	}

	public function editPM($id) {
		$this->form_validation->set_rules('name', 'Computer peripherals Name', 'required');
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
			'opening_stock_qty'=> $this->input->post('opening_stock_qty'),
			'minimum_inventory_qty'=> $this->input->post('minimum_inventory_qty'),
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
						$this->session->set_flashdata('success', 'Computer peripherals Updated Successfully !');
						redirect('/Computer_peripherals/index', 'refresh');
					//$this->fetchSuppliers();
					} else {
						$this->session->set_flashdata('failed', 'No Changes in Computer peripherals and machine!');
						redirect('/Computer_peripherals/index', 'refresh');
					}
			
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Computer peripherals and machine!');
			redirect('/Computer_peripherals/index', 'refresh');
			}
		} 
	}

}

?>