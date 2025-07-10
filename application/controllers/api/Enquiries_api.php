<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI
require APPPATH . '/libraries/REST_Controller.php';
Class Enquiries_api extends Restserver\Libraries\REST_Controller  {

public function __construct($config = 'rest') {
parent::__construct($config);
// Set CORS headers
header('Access-Control-Allow-Origin: *'); // Allow all origins (or specify your frontend URL)
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();
}
    
$this->load->model('MO_leads');
}

// Show login page
/*public function index_post() {
    $data['categories'] = $this->master_model->categoriesList();
    $this->response($data);
    }*/
    public function index_post() {
        $this->data = array();

       $data['enquiries'] = $this->MO_leads->MOLeadList();
        if ($this->input->post('draw')):
            $draw = $this->input->post('draw');
        else:
            $draw = 10;
        endif;
        $result = array();
        foreach ($data['enquiries'] as $object) :
            $result[] = array(
                'id' => $object['id'],
                'category_id' => $object['category_id'],
                'category_name' => $object['category_name'],
                'date' => $object['date'],
                'name' => $object['name'],
                'email' => $object['email'],
                'subject' => $object['subject'],
                'message' => $object['message'],
                'graduation' => $object['graduation'],
                'lead_status' => $object['lead_status'],
                'created_on' => $object['created_on'],
            );
        endforeach;
        $this->data['draw'] = $draw;
        //$this->data['recordsTotal'] = $this->master_model->countAll();
        //$this->data['recordsFiltered'] = $this->master_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

    public function save_post() {
        $this->data = array();
        //$this->_validation();
        // echo "<pre>";print_r($_POST);exit;
        $json_input = json_decode(trim(file_get_contents("php://input")), true);
        $data = array(
            'date' => date('Y-m-d'),
            'name' => isset($json_input['name']) ? $json_input['name'] : '',
            'phone' => isset($json_input['mobile']) ? $json_input['mobile'] : '',
            'email' => isset($json_input['email']) ? $json_input['email'] : '',
            'subject' => isset($json_input['service']) ? $json_input['service'] : '',
            'graduation' => isset($json_input['graduation']) ? $json_input['graduation'] : '',
            'message' => isset($json_input['message']) ? $json_input['message'] : ''
        );

        // $data = array(
        //     'date' => date('Y-m-d'),
        //     'name' => $this->input->post('name'),
        //     'phone' => $this->input->post('phone'),
        //     'email' => $this->input->post('email'),
        //     'subject' => $this->input->post('service'),
        //     'message' => $this->input->post('message')
        // );

        // echo "<pre>";print_r($_POST);exit;
        $result = $this->MO_leads->save($data);
        if ($result):
            $this->data['status'] = TRUE;
            $this->data['message'] = 'enquiry successfully submitted';
            $this->data['result'] = $data;
        else:
            $this->data['status'] = FALSE;
            $this->data['message'] = 'update failed!';
            $this->data['result'] = array();
        endif;
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
    


   public function replies_get($id) {
        $this->data = array();

       $data['queries'] = $this->leads_model->getById($id);
       //print_r($data['queries']['query']);exit;
        // if ($this->input->post('draw')):
        //     $draw = $this->input->post('draw');
        // else:
        //     $draw = 10;
        // endif;
        $result = array();
        //foreach ($data['queries'] as $key => $object) :
            $result[] = array(
                'id' => $data['queries']['id'],
                'user_id' => $data['queries']['user_id'],
                'query' => $data['queries']['query'],
                'file_path' => $data['queries']['file_path'],
                'user_name' => $data['queries']['user_name'],
                'status' => $data['queries']['status'],
                'replies_details' => $data['queries']['replies_details'],
           );
       // endforeach;
        //$this->data['draw'] = $draw;
        //$this->data['recordsTotal'] = $this->master_model->countAll();
        //$this->data['recordsFiltered'] = $this->master_model->countFiltered();
        $this->data['data'] = $result;

        $this->response($this->data);
    }

}

?>