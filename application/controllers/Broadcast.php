<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//session_start(); //we need to start session in order to access it through CI

Class Broadcast extends MY_Controller {

  public function __construct() {
    parent::__construct();
    if(!$this->session->userdata['logged_in']['id']){
        redirect('Broadcast/index');
    }

    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->library('session');


    $this->load->library('template');
    $this->load->model('Broadcast_model');
  }

public function index($id = NULL) {
  $data = array();
  $data['title'] = 'Broadcast';  
  $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
  $data['department_id']=$this->session->userdata['logged_in']['department_id'];
  $role_id=$this->session->userdata['logged_in']['role_id'];
if(!empty($id)){
  $result = $this->Broadcast_model->getById($id);

   if (isset($result['id'])) :
    $data['id'] = $result['id'];
else:
  $data['id'] = '';
endif;

  if (isset($result['department_id'])) :
    $data['department_id'] = $result['department_id'];
else:
  $data['department_id'] = '';
endif;
}
if (isset($result['message']) && $result['message']) :
  $data['message'] = $result['message'];
else:
  $data['message'] = '';
endif;


    $conditions=[];

    if(($role_id !='5')&&($role_id !='4')) {
       $data['broadcast'] = $this->Broadcast_model->broadcastList();
			}
    
    else{

      $conditions['department_id'] 	= $data['department_id'];
      $data['broadcast']			= $this->Broadcast_model->broadcastList($conditions);
			$data['filtered_value'] = "";
    }
   

      $data['departments'] = $this->Broadcast_model->getDepartments();

    
    // $data['broadcast'] = $this->Broadcast_model->broadcastList($conditions);
    // echo "<pre>";print_r($data['broadcast']);exit;

 
  $this->template->load('template','broadcast',$data);
}

  public function mark_as_read()
  {
    $broadcast_id = $this->input->post('broadcast_id');
    $user_id = $this->input->post('user_id');
    if ($broadcast_id && $user_id) {
      // Insert into the broadcast_read_status table
      $data = [
        'broadcast_id' => $broadcast_id,
        'user_id' => $user_id,
      ];

      $this->db->insert('broadcast_read_status', $data);

      if ($this->db->affected_rows() > 0) {
        echo "success";
      } else {
        echo "error";
      }
    } else {
      echo "invalid";
    }
  }
public function add_broadcast() {
  // echo "<pre>"; print_r($_POST); exit;
  $data['departments'] = $this->Broadcast_model->getDepartments();
 
  
  $login_id=$this->session->userdata['logged_in']['id'];
   
		// $leave_year = date('Y');

    
		 	$data = array(
        'message'	=> $this->input->post('message'),
        'department_id'=>$this->input->post('department_id'),
      );
       $result = $this->Broadcast_model->data_insert($data);
       if ($result == TRUE) {
         
       $this->session->set_flashdata('success', 'Broadcast Added Successfully !');
       redirect('/Broadcast/index', 'refresh');
       //$this->fetchSuppliers();
       } else {
       $this->session->set_flashdata('failed', '  Broadcast insertion failed!');
       redirect('/Broadcast/index', 'refresh');
       
      }
     
     } 
     public function editBroadcast($id = NULL) {
    
        $data = array(
        'message'	=> $this->input->post('message'),
        'department_id'=>$this->input->post('department_id'),
        );
       
        $result = $this->Broadcast_model->broadcast_update($data,$id);
        // echo $result;exit;
        if ($result == TRUE) {
        $this->session->set_flashdata('success', 'Broadcast Message Updated Successfully !');
        redirect('/Broadcast/index', 'refresh');
        //$this->fetchSuppliers();
        }
        else {
        $this->session->set_flashdata('failed', 'No Changes in Category!');
        redirect('/Broadcast/index', 'refresh');
       
      } 
    }
   }
   
?>