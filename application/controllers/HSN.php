<?php

//session_start(); //we need to start session in order to access it through CI

Class HSN extends MY_Controller {

  public function __construct() {
  parent::__construct();
  if(!$this->session->userdata['logged_in']['id']){
      redirect('User_authentication/index');
  }
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('security');

$this->load->helper('url');
// new security feature

// Load form validation library
$this->load->library('form_validation');


// Load session library
$this->load->library('session');

$this->load->library('template');

// Load database
$this->load->model('HSN_model');
}

// Show login page
public function add() {
  $this->template->load('layout/template','supplier_add');
  //$this->load->view('footer');
  }

 /*  public function fetchgrids(){
      $data['title'] = 'Product grid Master';
      $data['grid'] = $this->grid_model->gridList();
      //echo var_dump($data['students']);
      $this->template->load('template','grid_model',$data);
    }
 */

  

  public function index($id = NULL) 
  {
    $data = array();
      $result = $this->HSN_model->getById($id);

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

      $data['title'] = 'HSN Master';
      $data['HSNs'] = $this->HSN_model->HSNList();
	  //$data['categories'] = $this->HSN_model->getCategories();
      //echo var_dump($data['students']);
      //print_r($data['grid_name']);exit;
      $this->template->load('layout/template','HSN_master',$data);
  }
  public function add_new_HSN() {
    
    $this->form_validation->set_rules('hsn_code', 'hsn_code', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
      $this->index();
      //$this->template->load('template','grid_model');
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    }
    else 
    {
      
      $data = array(
	  'mineral_name'=>$this->input->post('mineral_name'),
      'hsn_code' => $this->input->post('hsn_code')
      );
      $result = $this->HSN_model->HSN_insert($data);
      if ($result == TRUE) {
      
      // Send otp to user via SMS
      /*  $recipient_no='9664100138';
      $rand_no='123456';
      //$senderID='YASHMM';
            $message = 'Dear User, OTP for mobile number verification is '.$rand_no.'. Thanks CodexWorld';
            $send = $this->sendSMS($recipient_no, $message);
            //print_r($send);exit;
            if($send){
                $this->session->set_flashdata('success', 'grid Added Successfully !');
        redirect('/Grid/index', 'refresh');
            }else{
                $this->session->set_flashdata('failed', 'OTP Not sent !');
        redirect('/Grid/index', 'refresh');
            }*/
      //$data['message_display'] = 'grid Added Successfully !';
      //$this->session->set_flashdata('success', 'grid Added Successfully !');
      //redirect('/Grid/index', 'refresh');
      //$this->fetchSuppliers();
        $this->session->set_flashdata('success', 'HSN Added Successfully !');
        redirect('/HSN/index', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, HSN Could not added !');
      redirect('/HSN/index', 'refresh');
      }
    } 
  }

  public function editHSN($id) {
    $this->form_validation->set_rules('hsn_code', 'HSN Code', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
        $this->index();
      //$this->template->load('template','grid_model');
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
	   'mineral_name'=>$this->input->post('mineral_name'),
      'hsn_code' => $this->input->post('hsn_code'),
      'flag' => $this->input->post('flag')
      );
	  //print_r($data);exit;
      $result = $this->HSN_model->HSN_update($data,$id);
     
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'HSN Updated Successfully !');
      redirect('/HSN/index', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in HSN!');
      redirect('/HSN/index', 'refresh');
      }
    } 
  } 
  public function getHSNByCategory($category_id)
  {
	  $data=array();
	   $data['HSN'] = $this->HSN_model->getHSNByCategory($category_id);
		$this->load->view('HSN_by_category',$data);
		
  }
     public function getmineralById($id){
      $mineral=str_replace('%20',' ', $id);
      //echo $mineral;exit;
    	$data = array();
    	$data['HSN_data']=$this->HSN_model->getmineralById($mineral);
    	//print_r($data['customers_data']);exit;
    	echo json_encode($this->load->view('mineralbyHSN',$data));
    }

}

?>