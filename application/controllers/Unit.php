<?php

//session_start(); //we need to start session in order to access it through CI

Class Unit extends MY_Controller {

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
$this->load->model('unit_model');
}

// Show login page
public function add() {
  $this->template->load('template','supplier_add');
  //$this->load->view('footer');
  }

 /*  public function fetchunits(){
      $data['title'] = 'Product unit Master';
      $data['unit'] = $this->unit_model->unitList();
      //echo var_dump($data['students']);
      $this->template->load('template','unit_model',$data);
    }
 */

  

  public function index($id = NULL) 
  {
    $data = array();
      $result = $this->unit_model->getById($id);

      if (isset($result['id']) && $result['id']) :
              $data['id'] = $result['id'];
          else:
              $data['id'] = '';
          endif;

      if (isset($result['unit_name']) && $result['unit_name']) :
              $data['unit_name'] = $result['unit_name'];
         else:
              $data['unit_name'] = '';
          endif;

      $data['title'] = 'Product unit Master';
      $data['units'] = $this->unit_model->unitList();
      //echo var_dump($data['students']);
      //print_r($data['unit_name']);exit;
      $this->template->load('layout/template','unit_master',$data);
  }
  public function add_new_unit() {
    
    $this->form_validation->set_rules('unit_name', 'unit Name', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
      $this->index();
      //$this->template->load('template','unit_model');
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    }
    else 
    {
      
      $data = array(
      'unit_name' => $this->input->post('unit_name')
      );
      $result = $this->unit_model->unit_insert($data);
      if ($result == TRUE) {
      
      // Send otp to user via SMS
      /*  $recipient_no='9664100138';
      $rand_no='123456';
      //$senderID='YASHMM';
            $message = 'Dear User, OTP for mobile number verification is '.$rand_no.'. Thanks CodexWorld';
            $send = $this->sendSMS($recipient_no, $message);
            //print_r($send);exit;
            if($send){
                $this->session->set_flashdata('success', 'unit Added Successfully !');
        redirect('/unit/index', 'refresh');
            }else{
                $this->session->set_flashdata('failed', 'OTP Not sent !');
        redirect('/unit/index', 'refresh');
            }*/
      //$data['message_display'] = 'unit Added Successfully !';
      //$this->session->set_flashdata('success', 'unit Added Successfully !');
      //redirect('/unit/index', 'refresh');
      //$this->fetchSuppliers();
        $this->session->set_flashdata('success', 'unit Added Successfully !');
        redirect('/Unit/index', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, unit Could not added !');
      redirect('/Unit/index', 'refresh');
      }
    } 
  }

  public function editunit($id) {
    $this->form_validation->set_rules('unit_name', 'unit Name', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
        $this->index();
      //$this->template->load('template','unit_model');
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
      'unit_name' => $this->input->post('unit_name'),
      'flag' => $this->input->post('flag')
      );
      $result = $this->unit_model->unit_update($data,$id);
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'unit Updated Successfully !');
      redirect('/Unit/index', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in unit!');
      redirect('/Unit/index', 'refresh');
      }
    } 
  }

}

?>