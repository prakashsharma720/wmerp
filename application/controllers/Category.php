
<?php

//session_start(); //we need to start session in order to access it through CI

class Category extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->session->userdata['logged_in']['id']) {
      redirect('user_authentication/index');
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
    $this->load->model('master_model');
  }

  // Show login page
  public function add()
  {
    $this->template->load('template', 'supplier_add');
    //$this->load->view('footer');
  }

  public function fetchCategories()
  {
    $data['title'] = 'Lead Category Master';
    $data['categories'] = $this->master_model->categoriesList();
    //echo var_dump($data['students']);
    $this->template->load('template', 'category_master', $data);
  }




  public function index($id = NULL)
  {
    $data = array();
    $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
    $data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
      $result = $this->master_model->getById($id);

      if (isset($result['id']) && $result['id']) :
              $data['id'] = $result['id'];
          else:
              $data['id'] = '';
          endif; 

      if (isset($result['category_name']) && $result['category_name']) :
              $data['category_name'] = $result['category_name'];
         else:
              $data['category_name'] = '';
          endif;

      $data['title'] = 'Lead Services Master';
      $data['categories'] = $this->master_model->categoriesList();
      //echo var_dump($data['students']);
      //print_r($data['category_name']);exit;
      $this->template->load('layout/template','category_master',$data);
  }
  public function add_new_category()
  {

    $this->form_validation->set_rules('category_name', 'Category Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
        //$this->template->load('template','category_master');
        //$this->load->view('admin_page');
      } else {
        $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    } else {

      $data = array(
        'category_name' => $this->input->post('category_name')
      );
      $result = $this->master_model->category_insert($data);
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
        redirect('/category/index', 'refresh');
            }else{
                $this->session->set_flashdata('failed', 'OTP Not sent !');
        redirect('/category/index', 'refresh');
            }*/
        //$data['message_display'] = 'Category Added Successfully !';
        //$this->session->set_flashdata('success', 'Category Added Successfully !');
        //redirect('/category/index', 'refresh');
        //$this->fetchSuppliers();
        $this->session->set_flashdata('success', 'Service Added Successfully !');
        redirect('/Category/index', 'refresh');
      } else {
        $this->session->set_flashdata('failed', 'Already exists, Sarvice Could not added !');
        redirect('/Category/index', 'refresh');
      }
    }
  }

  public function editCategory($id)
  {
    $this->form_validation->set_rules('category_name', 'Category Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->index();
        //$this->template->load('template','category_master');
        //$this->load->view('admin_page');
      } else {
        $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    } else {
      $data = array(
        //'id' => $id,
        'category_name' => $this->input->post('category_name'),
        'flag' => $this->input->post('flag')
      );
      $result = $this->master_model->category_update($data, $id);
      //echo $result;exit;
      if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Sarvice Updated Successfully !');
        redirect('/Category/index', 'refresh');
        //$this->fetchSuppliers();
      } else {
        $this->session->set_flashdata('failed', 'No Changes in Sarvice!');
        redirect('/Category/index', 'refresh');
      }
    }
  }
}

?>