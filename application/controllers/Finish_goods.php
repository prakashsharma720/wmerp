<?php

//session_start(); //we need to start session in order to access it through CI

Class Finish_goods extends CI_Controller {

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
$this->load->model('finish_goods_model');
}

// Show login page	

	public function index() 
	{
		$data['title'] = ' Finish Goods List';
		$data['items'] = $this->finish_goods_model->fgList();
		//$data['categories'] = $this->finish_goods_model->getCategories();
		//echo var_dump($data['students']);
		//print_r($data['items']);exit;
		$this->template->load('template','finish_goods_view',$data);
	}

	public function add() 
	{
			$data = array();
			$data['title'] = ' Add New Finish Good';
			//$data['categories'] = $this->finish_goods_model->getCategories();
			//$data['grades'] = $this->finish_goods_model->getGrades();
			$data['fg_code'] = $this->finish_goods_model->getFGCode();
			$voucher_no= $data['fg_code'];
            if($voucher_no<10){
            $fg_code='FG000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $fg_code='FG00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $fg_code='FG0'.$voucher_no;
            }
            else{
              $fg_code='FG'.$voucher_no;
            }
            //print_r($employee_id_code);exit;
            $data['finish_good_code']=$fg_code;
			$data['HSNs']=$this->finish_goods_model->getHSN();
			$data['packing_types']= array('Liner' => 'Liner','Non-liner'=>'Non-liner');
			$data['packing_sizes']= array('25Kg' => '25Kg','50Kg'=>'50Kg','NA'=>'NA');
			//echo var_dump($data['students']);
			//print_r($data['mineral_name']);exit;
			$this->template->load('template','finish_goods_add',$data);
	}
	
	public function edit($id = NULL) 
	{
		$data = array();
		$result = $this->finish_goods_model->getById($id);

		if (isset($result['id']) && $result['id']) :
            $data['id'] = $result['id'];
        else:
            $data['id'] = '';
        endif;

		if (isset($result['mineral_name']) && $result['mineral_name']) :
            $data['mineral_name'] = $result['mineral_name'];
       else:
            $data['mineral_name'] = '';
        endif;
		if (isset($result['hsn_code']) && $result['hsn_code']) :
            $data['hsn_code'] = $result['hsn_code'];
       else:
            $data['hsn_code'] = '';
        endif;
        if (isset($result['grade_name']) && $result['grade_name']) :
            $data['grade_name'] = $result['grade_name'];
       else:
            $data['grade_name'] = '';
        endif;
        if (isset($result['packing_type']) && $result['packing_type']) :
            $data['packing_type'] = $result['packing_type'];
       else:
            $data['packing_type'] = '';
        endif;
  
		if (isset($result['fg_code']) && $result['fg_code']) :
            $data['fg_code'] = $result['fg_code'];
			$voucher_no= $data['fg_code'];
            if($voucher_no<10){
            $fg_code='FG000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $fg_code='FG00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $fg_code='FG0'.$voucher_no;
            }
            else{
              $fg_code='FG'.$voucher_no;
            }	
            //print_r($employee_id_code);exit;
            $data['finish_good_code']=$fg_code;
	       else:
	            $data['fg_code'] = '';
	        endif;	

       	if (isset($result['packing_size']) && $result['packing_size']) :
            $data['packing_size'] = $result['packing_size'];
       else:
            $data['packing_size'] = '';
        endif;

		$data['title'] = ' Update Finish Good';
		$data['categories'] = $this->finish_goods_model->getCategories();
		$data['HSNs']=$this->finish_goods_model->getHSN();
		$data['packing_types']= array('Liner' => 'Liner','Non-liner'=>'Non-liner');
		$data['packing_sizes']= array('25Kg' => '25Kg','50Kg'=>'50Kg','NA'=>'NA');
	
		$this->template->load('template','finish_goods_edit',$data);
	}
	public function add_new_fg() {
		
		$this->form_validation->set_rules('mineral_name', 'Mineral Name', 'required');
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
			$data = array(
			'mineral_name' => $this->input->post('mineral_name'),
			'hsn_code' => $this->input->post('hsn_code'),
			'grade_name' => $this->input->post('grade_name'),
			'packing_type' => $this->input->post('packing_type'),
			'fg_code' => $this->input->post('fg_code'),
			'created_by' => $login_id,
			//'minimum_quantity' => $this->input->post('minimum_quantity'),
			/*'lot_no' => $this->input->post('lot_no'),
			'batch_no' => $this->input->post('batch_no'),
			'grade' => $this->input->post('grade'),
			'used_category' => $this->input->post('used_category'),*/
			'packing_size' => $this->input->post('packing_size')
			/*
			'expiry_date' => date('Y-m-d',strtotime($this->input->post('expiry_date'))),*/
			);
			$result = $this->finish_goods_model->fg_insert($data);
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Finished Good Added Successfully !');
			redirect('/Finish_goods/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Already Exists , Finished Good Not Inserted !');
			redirect('/Finish_goods/index', 'refresh');
			}
		} 
	}

	public function editFG($id) {
		$this->form_validation->set_rules('mineral_name', 'Finish Good Name', 'required');
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
			$data = array(
			'mineral_name' => $this->input->post('mineral_name'),
			'hsn_code' => $this->input->post('hsn_code'),
			'grade_name' => $this->input->post('grade_name'),
			'packing_type' => $this->input->post('packing_type'),
			'fg_code' => $this->input->post('fg_code'),
			'edited_by' => $login_id,
			//'minimum_quantity' => $this->input->post('minimum_quantity'),
			/*'lot_no' => $this->input->post('lot_no'),
			'batch_no' => $this->input->post('batch_no'),
			'grade' => $this->input->post('grade'),
			'used_category' => $this->input->post('used_category'),*/
			'packing_size' => $this->input->post('packing_size')
			/*
			'expiry_date' => date('Y-m-d',strtotime($this->input->post('expiry_date'))),*/
			);
			$old_fg_id=$this->input->post('old_fg_id');
			//print_r($old_fg_id);exit;
			$result = $this->finish_goods_model->fg_update($data,$old_fg_id);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Finish Good Updated Successfully !');
			redirect('/Finish_goods/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Item!');
			redirect('/Finish_goods/index', 'refresh');
			}
		} 
	}
	public function deleteFG($id= null){
  	 		$id = $this->uri->segment('3');
  	 		$result =$this->finish_goods_model->deleteFG($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Finish Good deleted Successfully !');
			redirect('/Finish_goods/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Finish_goods/index', 'refresh');
			}
  	 	}
  	public function getFinishGoodsByCategory($id=NULL){
    	$data = array();
    	$data['Finish Goods']=$this->finish_goods_model->getFinishGoodsByCategory($id);
    	echo json_encode($this->load->view('Finish Goodbycategory',$data));
    }

}

?>