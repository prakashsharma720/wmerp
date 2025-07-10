<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//session_start(); //we need to start session in order to access it through CI

Class Cronjob extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if(!$this->session->userdata['logged_in']['id']){
        redirect('User_authentication/admin_dashboard');
    }

    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('session');


    $this->load->library('template');
    $this->load->model('login_database');
    // $this->load->model('Review_model');
  }

  public function generating(){
    
$html = $this->getPreview();

$this->data = array();
    $status = TRUE;
    $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.muskowl.com',
        'smtp_port' =>587,
        'smtp_user' => 'erp@muskowl.com', // change it to yours
        'smtp_pass' => '#ERP@muskowl2022#', // change it to yours
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
      );
      $this->load->helper('string');
    //   $code= random_string('numeric', 6);
      
      
      $this->load->library('email_lib', $config);
      $this->email->set_newline("\r\n");
      $this->email->from('erp@muskowl.com'); // change it to yours
      
      $this->email->to('vikasv.muskowl@gmail.com');// change it to yours
      $this->email->cc('vilesh.muskowl@gmail.com');// change it to yours
      $this->email->subject('Lead Summary of '.date('Y-m-d'));

      $this->email->message($html);
      // echo"<pre>";print_r($this->email->send());exit;
     

      if($this->email->send())
      {
        $this->session->set_flashdata('success', 'Lead Report Successfully  Sent!');
				// redirect('/Cronjob/generating', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'Lead Report not sent ! Please Try again.');
				// redirect('/Cronjob/generating', 'refresh');
			}

      $this->data = array();
   
      $this->db->select('lead_count.*,employees.name as person_name,employees.target as target');
      $this->db->from('lead_count');
      $this->db->where(['lead_count.date'=>date('Y-m-d')]);
  
      $this->db->join('employees','lead_count.employee_id=employees.id','left');
   
      $data['query'] = $this->db->get()->result_array();
      // $data['status']='hello';

      // $this->session->set_flashdata('success', 'Role Added Successfully !');
      //   redirect('/User_authentication/role_master', 'refresh');
      // } else {
      // $this->session->set_flashdata('failed', 'Already exists, Sarvice Could not added !');
      // redirect('/User_authentication/role_master', 'refresh');
      // }
      $this->template->load('template', 'cron/cron_view');
  }

  public function getPreview() {
    $this->data = array();
   
      $this->db->select('lead_count.*,employees.name as person_name,employees.target as target');
      $this->db->from('lead_count');
      $this->db->where(['lead_count.date'=>date('Y-m-d')]);
  
      $this->db->join('employees','lead_count.employee_id=employees.id','left');
   
      $data['query'] = $this->db->get()->result_array();
    // echo"<pre>";print_r(	$data['query'] );exit;

   $html = $this->load->view('lead_mail', $data,TRUE);

   

    return $html;
}
}