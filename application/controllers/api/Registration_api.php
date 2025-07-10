<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
require APPPATH . '/libraries/REST_Controller.php';
Class Registration_api extends Restserver\Libraries\REST_Controller  {

public function __construct($config = 'rest') {
parent::__construct($config);
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$this->load->model('MO_leads');
}

// Show login page
/*public function index_post() {
    $data['categories'] = $this->master_model->categoriesList();
    $this->response($data);
    }*/
    public function index_post() {
        $this->data = array();

       $data['enquiries'] = $this->MO_leads->MOworkshopList();
       
        $result = array();
        foreach ($data['enquiries'] as $object) :
            $result[] = array(
                'id' => $object['id'],
                'reference_id' => $object['reference_id'],
                 'your_name' => $object['your_name'],
                 'price' => $object['price'],
                'your_email' => $object['your_email'],
                'your_number' => $object['your_number'],
                'workshop_name' => $object['workshop_name'],
                'your_reference' => $object['your_reference'],
                'your_screenshot' => $object['your_screenshot'],
              
            );
        endforeach;
        // $this->data['draw'] = $draw;
        //$this->data['recordsTotal'] = $this->master_model->countAll();
        //$this->data['recordsFiltered'] = $this->master_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

   public function save_post() {
    $this->data = array();

    // Set a default value for $file_name
    $file_name = '';

    $uploadPath = './uploads/workshop/';
    $config['upload_path'] = $uploadPath;
    $config['allowed_types'] = '*';

    // Load and initialize upload library
    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if ($this->upload->do_upload('your_screenshot')) {
        // If the file is successfully uploaded, get the file name
        $file_data = $this->upload->data();
        $file_name = 'uploads/workshop/' . $file_data['file_name'];
    }

    $data = array(
        
        'your_name' => $this->input->post('your_name'),
        'your_email' => $this->input->post('your_email'),
        'your_number' => $this->input->post('your_number'),
         'price' => $this->input->post('price'),
         'workshop_name' => $this->input->post('workshop_name'),

        'your_reference' => $this->input->post('your_reference'),
        'your_screenshot' => $file_name, // This will be an empty string if the upload fails
         'booking_status' => 'pending',
    );

    $result = $this->MO_leads->savemuskowlleads($data);
    
      if ($result) {
                //   $encrypted_reference_id = $this->encryption->encrypt($result['reference_id']);

        $this->data['status'] = TRUE;
        $this->data['message'] = 'Enquiry successfully submitted';
        $this->data['reference_id'] =  $result['reference_id']; 
        $this->data['result'] = $result['data']; // Send last inserted data in response
    } else {
        $this->data['status'] = FALSE;
        $this->data['message'] = 'Update failed!';
        $this->data['result'] = array();
    }



    $this->response($this->data);
}

    public function insert_post() {
        $this->data = array();
        //$this->_validation();
        
        $data = array(
            'date' => date('Y-m-d'),
            'storecode' => $this->input->post('storecode'),
            'title' => 'Muskowl Lead Form',
            'customer_name' => $this->input->post('customer_name'),
            'phone' => $this->input->post('phone'),
            'email_id' => $this->input->post('email_id'),
            
            'additional_requirement' => $this->input->post('additional_requirement'),
            'location' => $this->input->post('location'),
            
        );

        // echo "<pre>";print_r($_POST);exit;
        $result = $this->MO_leads->insert($data);
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'enquiry successfully submitted';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }

     public function add_reply_post() {
        $this->data = array();
        //$this->_validation();
        $ask_query_id= $this->input->post('ask_query_id');
        $this->load->library('upload');
        $this->upload->do_upload('photo');
        $data = array(
            'ask_query_id' => $ask_query_id,
            'answer' => $this->input->post('answer'),
            'file_path' => $this->upload->data()['file_name'],
            'giver_id' => $this->input->post('giver_id'),
            'user_id' => $this->input->post('user_id')
        );
        $result = $this->leads_model->add_reply($data,$ask_query_id);
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'Your Feedback has been successfully submitted';
            $this->data['result'] = $result;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
        $this->response($this->data);
    }
    


 // Example URL: /api/Registration_api/workshop_get_post/123
    public function workshop_get_post() {
        $this->data = array();
        
        $access_token = $this->input->post('access_token');
        
        $data['enquiries'] = $this->MO_leads->getWorkshopById($access_token);
        
        $base_url='https://moerp.modevcloud.com/';
          $result = array();
       
            $result[] = array(
               
                'id' => $data['enquiries']['id'],
                'reference_id' =>   $data['enquiries']['reference_id'],
                'your_name' =>$data['enquiries']['your_name'],
                'your_email' =>$data['enquiries']['your_email'],
                'your_number' =>$data['enquiries']['your_number'],
                    'price' =>$data['enquiries']['price'],
                'workshop_name' => $data['enquiries']['workshop_name'],
                'your_reference' => $data['enquiries']['your_reference'],
                'your_screenshot' => $base_url.$data['enquiries']['your_screenshot'],
                 'booking_status' => $data['enquiries']['booking_status'],
              
            );
       
        // $this->data['draw'] = $draw;
        //$this->data['recordsTotal'] = $this->master_model->countAll();
        //$this->data['recordsFiltered'] = $this->master_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
       

}
}

?>