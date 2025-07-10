<?php

//session_start(); //we need to start session in order to access it through CI

Class Services extends MY_Controller {

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
	      /*  if (isset($result['code']) && $result['code']) :
	            $data['code'] = $result['code'];
	       else:
	            $data['code'] = '';
	        endif; */	
		
			
			if (isset($result['type']) && $result['type']) :
	            $data['type'] = $result['type'];
	       else:
	            $data['type'] = '';
	        endif;	
		
	       
	         if (isset($result['categories_id']) && $result['categories_id']) :
	            $data['categories_id'] = $result['categories_id'];
	       else:
	            $data['categories_id'] = '4';
	        endif;
	        
	         if (isset($result['description']) && $result['description']) :
	            $data['description'] = $result['description'];
	       else:
	            $data['description'] = '';
	        endif;

	        if (isset($result['code']) && $result['code']) :
	            $service_code = $result['code'];
	       else:
	        $category_id='4';
			$data['service_code'] = $this->categories_model->getPackingMaterialCode($category_id);
			//print_r($data['pt_code']);exit;
            $voucher_no= $data['service_code'];
            if($voucher_no<10){
            $service_code='SER000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $service_code='SER00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $service_code='SER0'.$voucher_no;
            }
            else{
              $service_code='SER'.$voucher_no;
            }
	        endif;
			$data['service_code_view']=$service_code;



			$data['title'] = 'Services Master';
			$data['services'] = $this->categories_model->packingmaterialsList( $data['categories_id']);
			$data['categories'] = $this->categories_model->getMasterCategories();
			//echo var_dump($data['students']);
			//print_r($data['name']);exit;
			$this->template->load('template','services_view',$data);
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
			'type' => $this->input->post('type'),
			
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
			$data = array(
			'categories_id' => $this->input->post('categories_id'),
			'name' => $this->input->post('name'),
			'code' => $this->input->post('code'),
			'type' => $this->input->post('type'),
			'description' => $this->input->post('description'),
			'flag' => $this->input->post('flag')
			);
			$result = $this->categories_model->packing_material_update($data,$id);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Services Updated Successfully !');
			redirect('/Services/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Services and machine!');
			redirect('/Services/index', 'refresh');
			}
		} 
	}

}

?>