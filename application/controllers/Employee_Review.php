
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//session_start(); //we need to start session in order to access it through CI

Class Employee_Review extends MY_Controller {

  public function __construct() {
    parent::__construct();
    if(!$this->session->userdata['logged_in']['id']){
        redirect('Employee_Review/index');
    }

    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('session');


    $this->load->library('template');
    $this->load->model('Review_model');
  }

public function index($id = "") {
  $data['title'] = 'Employee Review';
  $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
            $login_id=$this->session->userdata['logged_in']['id'];

  $records = 

 
  $data['months'] 	= $this->Review_model->getMonths();
	if($data['designation_id']==1||['designation_id']==2||['designation_id']==4){

  $data['review'] 	= $this->Review_model->getAllotedReview();
  }
  else{
    $data['review'] 	= $this->Review_model->getAllotedReviewByEmployee($login_id);
  }
//  echo "<pre>"; print_r(  $data['review'] );exit();
  $this->template->load('template','employee_review',$data);
}

public function add_review() {
  // echo "<pre>"; print_r($_POST); exit;
  $data['employees'] = $this->Review_model->getEmployees();
  
  $login_id=$this->session->userdata['logged_in']['id'];
   
		// $leave_year = date('Y');

    
		 	$data = array(
		// 		'id' 		=> $id,	
    
		 		'review_date' 	=> date('Y-m-d'),
        
         'employee_id' => $login_id,
         'year'=>date('Y'),
        'review_month'	=> $this->input->post('month_name'),
        'review_period'=>$this->input->post('period_type'),
        'total_marks'=>$this->input->post('total_marks'),
        'marks_given_self'=>$this->input->post('marks_obtain'),
        'marks_given_author'=>$this->input->post('marks_obtain_author'),

      );
      // print_r($data);exit();
       $result = $this->Review_model->data_insert($data);
       
    
       if ($result == TRUE) {
         
       $this->session->set_flashdata('success', 'Employee Review Added Successfully !');
       redirect('/Employee_Review/index', 'refresh');
       //$this->fetchSuppliers();
       } else {
       $this->session->set_flashdata('failed', 'Employee  Review insertion failed!');
       redirect('/Employee_Review/index', 'refresh');
       }
     } 
   }
   
?>