<?php

//session_start(); //we need to start session in order to access it through CI

Class Grades extends MY_Controller {

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
$this->load->model('grades_model');
}

// Show login page
public function add() {
  $this->template->load('template','supplier_add');
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
      $result = $this->grades_model->getById($id);

      if (isset($result['id']) && $result['id']) :
              $data['id'] = $result['id'];
          else:
              $data['id'] = '';
          endif;
 if (isset($result['categories_id']) && $result['categories_id']) :
              $data['categories_id'] = $result['categories_id'];
         else:
              $data['categories_id'] = '';
          endif;
      if (isset($result['grade']) && $result['grade']) :
              $data['grade'] = $result['grade'];
         else:
              $data['grade'] = '';
          endif;

      $data['title'] = 'Grades Master';
      $data['grades'] = $this->grades_model->gradeList();
	  $data['categories'] = $this->grades_model->getCategories();
      //echo var_dump($data['students']);
      //print_r($data['grid_name']);exit;
      $this->template->load('template','grades_master',$data);
  }
  public function add_new_grade() {
    
    $this->form_validation->set_rules('grade', 'grade', 'required');
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
	  'categories_id'=>$this->input->post('categories_id'),
      'grade' => $this->input->post('grade')
      );
      $result = $this->grades_model->grade_insert($data);
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
        $this->session->set_flashdata('success', 'grade Added Successfully !');
        redirect('/Grades/index', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, grade Could not added !');
      redirect('/Grades/index', 'refresh');
      }
    } 
  }

  public function editgrade($id) {
    $this->form_validation->set_rules('grade', 'Grade Name', 'required');
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
	   'categories_id'=>$this->input->post('categories_id'),
      'grade' => $this->input->post('grade'),
      'flag' => $this->input->post('flag')
      );
	  //print_r($data);exit;
      $result = $this->grades_model->grade_update($data,$id);
     
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'grade Updated Successfully !');
      redirect('/Grades/index', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in grade!');
      redirect('/Grades/index', 'refresh');
      }
    } 
    } 
  public function getGradeByCategory($category_id)
  {
	  $data=array();
	   $data['grades'] = $this->grades_model->getGradeByCategory($category_id);
		$this->load->view('grade_by_category',$data);
		
  }
  

}

?>