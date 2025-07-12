<?php

//session_start(); //we need to start session in order to access it through CI

Class Evaluation_criteria extends MY_Controller {

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
$this->load->model('evaluation_criteria_model');
}

// Show login page
public function add() {
  $this->template->load('template','supplier_add');
  //$this->load->view('footer');
  }

  public function fetchEC(){
      $data['title'] = 'Product evaluation_criteria Master';
      $data['evaluation_criteria'] = $this->evaluation_criteria_model->ECList();
      //echo var_dump($data['students']);
      $this->template->load('template','evaluation_criteria_view',$data);
    }


  

  public function index($id = NULL) 
  {
    $data = array();
      $result = $this->evaluation_criteria_model->getById($id);

      if (isset($result['id']) && $result['id']) :
              $data['id'] = $result['id'];
          else:
              $data['id'] = '';
          endif; 
          if (isset($result['ec_type']) && $result['ec_type']) :
              $data['ec_type'] = $result['ec_type'];
          else:
              $data['ec_type'] = '';
          endif;

      if (isset($result['ec_name']) && $result['ec_name']) :
              $data['ec_name'] = $result['ec_name'];
         else:
              $data['ec_name'] = '';
          endif;

      $data['title'] = 'Evaluation Criteria Master';
      $data['evaluation_criteria'] = $this->evaluation_criteria_model->ECList();
      //echo var_dump($data['students']);
      //print_r($data['category_name']);exit;
      $this->template->load('template','evaluation_criteria_view',$data);
  }
  public function add_new_EC() {
    
    $this->form_validation->set_rules('ec_name', 'Evaluation Criteria Name', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
      $this->index();
      //$this->template->load('template','evaluation_criteria_view');
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    }
    else 
    {
      
      $data = array(
      'ec_type' => $this->input->post('ec_type'),
      'ec_name' => $this->input->post('ec_name'),
      );
      $result = $this->evaluation_criteria_model->EC_insert($data);
      if ($result == TRUE) {
      
      // Send otp to user via SMS
      /*  $recipient_no='9664100138';
      $rand_no='123456';
      //$senderID='YASHMM';
            $message = 'Dear User, OTP for mobile number verification is '.$rand_no.'. Thanks CodexWorld';
            $send = $this->sendSMS($recipient_no, $message);
            //print_r($send);exit;
            if($send){
                $this->session->set_flashdata('success', 'Category Added Successfully !');
        redirect('/Category/index', 'refresh');
            }else{
                $this->session->set_flashdata('failed', 'OTP Not sent !');
        redirect('/Category/index', 'refresh');
            }*/
      //$data['message_display'] = 'Category Added Successfully !';
      //$this->session->set_flashdata('success', 'Category Added Successfully !');
      //redirect('/Category/index', 'refresh');
      //$this->fetchSuppliers();
        $this->session->set_flashdata('success', 'Evaluation Criteria Added Successfully !');
        redirect('/Evaluation_criteria/index', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, Evaluation Criteria Could not added !');
      redirect('/Evaluation_criteria/index', 'refresh');
      }
    } 
  }

  public function editEC($id) {
    $this->form_validation->set_rules('ec_name', 'Evaluation Criteria Name', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
        $this->index();
      //$this->template->load('template','evaluation_criteria_view');
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
      'ec_name' => $this->input->post('ec_name'),
      'ec_type' => $this->input->post('ec_type'),
      'flag' => $this->input->post('flag')
      );
      $result = $this->evaluation_criteria_model->EC_update($data,$id);
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'Evaluation Criteria Updated Successfully !');
      redirect('/Evaluation_criteria/index', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in Evaluation Criteria!');
      redirect('/Evaluation_criteria/index', 'refresh');
      }
    } 
  }

}

?>