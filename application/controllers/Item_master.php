<?php

//session_start(); //we need to start session in order to access it through CI

Class Item_Master extends MY_Controller {

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
$this->load->model('item_master_model');
}

// Show login page	

	public function index() 
	{
		$data['title'] = ' Finish Goods List';
		$data['items'] = $this->item_master_model->itemsList();
		//$data['categories'] = $this->item_master_model->getCategories();
		//echo var_dump($data['students']);
		//print_r($data['item_name']);exit;
		$this->template->load('template','item_master_view',$data);
	}

	public function add() 
	{
		$data = array();
			

			$data['title'] = ' Add New Finish Good';
			$data['categories'] = $this->item_master_model->getCategories();
			$data['grades'] = $this->item_master_model->getGrades();
			$data['packing_types']= array('Liner' => 'Liner','Non-liner'=>'Non-liner');
			$data['packing_sizes']= array('25Kg' => '25Kg','50Kg'=>'50Kg','NA'=>'NA');
			//echo var_dump($data['students']);
			//print_r($data['item_name']);exit;
			$this->template->load('template','item_master',$data);
	}
	
	public function edit($id = NULL) 
	{
		$data = array();
			$result = $this->item_master_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['item_name']) && $result['item_name']) :
	            $data['item_name'] = $result['item_name'];
	       else:
	            $data['item_name'] = '';
	        endif;
	        if (isset($result['item_code']) && $result['item_code']) :
	            $data['item_code'] = $result['item_code'];
	       else:
	            $data['item_code'] = '';
	        endif;
	        if (isset($result['unit']) && $result['unit']) :
	            $data['unit'] = $result['unit'];
	       else:
	            $data['unit'] = '';
	        endif;
	      
	  
			if (isset($result['grade_id']) && $result['grade_id']) :
	            $data['grade_id'] = $result['grade_id'];
	       else:
	            $data['grade_id'] = '';
	        endif;
	       /* if (isset($result['batch_no']) && $result['batch_no']) :
	            $data['batch_no'] = $result['batch_no'];
	       else:
	            $data['batch_no'] = '';
	        endif;
	        if (isset($result['lot_no']) && $result['lot_no']) :
	            $data['lot_no'] = $result['lot_no'];
	       else:
	            $data['lot_no'] = '';
	        endif;*/
	       /* if (isset($result['used_category']) && $result['used_category']) :
	            $data['used_category'] = $result['used_category'];
	       else:
	            $data['used_category'] = '';
	        endif;*/
	        if (isset($result['item_description']) && $result['item_description']) :
	            $data['item_description'] = $result['item_description'];
	       else:
	            $data['item_description'] = '';
	        endif;

			$data['title'] = ' Update Finish Good';
			$data['categories'] = $this->item_master_model->getCategories();
			$data['packing_types']= array('Liner' => 'Liner','Non-liner'=>'Non-liner');
			$data['packing_sizes']= array('25Kg' => '25Kg','50Kg'=>'50Kg','NA'=>'NA');
		
			$this->template->load('template','item_master_edit',$data);
	}
	public function add_new_item() {
		
		$this->form_validation->set_rules('item_name', 'item Name', 'required');
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
			
			$data = array(
			'item_name' => $this->input->post('item_name'),
			'item_code' => $this->input->post('item_code'),
			'unit' => $this->input->post('unit'),
			//'grade_id' => $this->input->post('grade_id'),
			//'unit' => $this->input->post('unit'),
			//'minimum_quantity' => $this->input->post('minimum_quantity'),
			/*'lot_no' => $this->input->post('lot_no'),
			'batch_no' => $this->input->post('batch_no'),
			'grade' => $this->input->post('grade'),
			'used_category' => $this->input->post('used_category'),*/
			'item_description' => $this->input->post('item_description')
			/*
			'expiry_date' => date('Y-m-d',strtotime($this->input->post('expiry_date'))),*/
			);
			$result = $this->item_master_model->item_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Finished Good Added Successfully !');
			redirect('/Item_master/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists , Finished Good Not Inserted !');
			redirect('/Item_master/index', 'refresh');
			}
		} 
	}

	public function edititem($id) {
		$this->form_validation->set_rules('item_name', 'Product Name', 'required');
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
			$data = array(
			//'id' => $id,
			'item_name' => $this->input->post('item_name'),
			'item_code' => $this->input->post('item_code'),
			'category_id' => $this->input->post('category_id'),
			'grade_id' => $this->input->post('grade_id'),
			//'unit' => $this->input->post('unit'),
			'minimum_quantity' => $this->input->post('minimum_quantity'),
			/*'lot_no' => $this->input->post('lot_no'),
			'batch_no' => $this->input->post('batch_no'),
			'used_category' => $this->input->post('used_category'),
			'expiry_date' => date('Y-m-d',strtotime($this->input->post('expiry_date'))),
			*/
			'item_description' => $this->input->post('item_description'),
			'flag' => $this->input->post('flag')
			);
			$item_id=$this->input->post('old_item_id');
			//print_r($item_id);exit;
			$result = $this->item_master_model->item_update($data,$item_id);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Product Updated Successfully !');
			redirect('/Item_master/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Item!');
			redirect('/Item_master/index', 'refresh');
			}
		} 
	}
	public function deleteItem($id= null){
  	 		$id = $this->uri->segment('3');
  	 		$result =$this->item_master_model->deleteItem($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Product deleted Successfully !');
			redirect('/Item_master/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Item_master/index', 'refresh');
			}
  	 	}
  	public function getProductsByCategory($id=NULL){
    	$data = array();
    	$data['products']=$this->item_master_model->getProductsByCategory($id);
    	echo json_encode($this->load->view('productbycategory',$data));
    }

}

?>