<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    use Restserver\Libraries\REST_Controller;
    require APPPATH . 'libraries/REST_Controller.php';
Class Authentication extends Restserver\Libraries\REST_Controller {
    public function __construct() { 
        parent::__construct();
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        
        $this->load->model('user');
        $this->load->library('form_validation');
    }
    public function index_get(){
        echo "hello ! there is someting wrong !!!";
    }
    
    public function login_post() {
        // Get the post data
        $email = $this->post('email');
        $password = $this->post('password');
        
        // Validate the post data
        if(!empty($email) && !empty($password)){
            
            // Check if any user exists with the given credentials
            $con['returnType'] = 'single';
            $con['conditions'] = array(
                'email' => $email,
                'password' => md5($password),
                'status' => 1
            );
            $user = $this->user->getRows($con);
            
            if($user){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'User login successful.',
                    'data' => $user
                ], Rest_Controller::HTTP_OK);
            } else {
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response("Wrong email or password.", Rest_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response("Provide email and password.", Rest_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function registration_post() {
        // Get the post data
        $first_name = strip_tags($this->input->post('first_name'));
        $last_name = strip_tags($this->input->post('last_name'));
        $email = strip_tags($this->input->post('email'));
        $password = $this->input->post('password');
        $phone = strip_tags($this->input->post('phone'));
        // Validate the post data
        if(!empty($email) && !empty($password)) {
            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'email' => $email,
            );
            $userCount = $this->user->getRows($con);
            if($userCount > 0) {
                // Set the response and exit
                $this->response("The given email already exists.", Rest_Controller::HTTP_BAD_REQUEST);
            } else {
                // Insert user data
                $userData = array(
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => md5($password),
                    'phone' => $phone
                );
                $insert = $this->user->insert($userData);
                // Check if the user data is inserted
                if($insert) {
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'The user has been added successfully.',
                        'data' => $insert
                    ], Rest_Controller::HTTP_OK);
                } else {
                    // Set the response and exit
                    $this->response("Some problems occurred, please try again.", Rest_Controller::HTTP_BAD_REQUEST);
                }
            }
        } else {
            // Set the response and exit
            $this->response("Provide complete user info to add.", Rest_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function user_get($id = 0) {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $con = $id?array('id' => $id):'';
        $users = $this->user->getRows($con);
        
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $this->response($users, Rest_Controller::HTTP_OK);
        }else{
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], Rest_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function userUpdate_post() {
        $id = $this->input->post('id');
        // Get the post data
        $first_name = strip_tags($this->input->post('first_name'));
        $last_name = strip_tags($this->input->post('last_name'));
        $email = strip_tags($this->input->post('email'));
        $password = $this->input->post('password');
        $phone = strip_tags($this->input->post('phone'));
        // Validate the post data
        if(!empty($id)){
            // Update user's account data
            $userData = array();
            if(!empty($first_name)){
                $userData['first_name'] = $first_name;
            }
            if(!empty($last_name)){
                $userData['last_name'] = $last_name;
            }
            if(!empty($email)){
                $userData['email'] = $email;
            }
            if(!empty($password)){
                $userData['password'] = md5($password);
            }
            if(!empty($phone)){
                $userData['phone'] = $phone;
            }
            $update = $this->user->update($userData, $id);
            
            // Check if the user data is updated
            if($update) {
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'The user info has been updated successfully.',
                    'result' => $userData
                ], Rest_Controller::HTTP_OK);
            } else {
                // Set the response and exit
                $this->response("Some problems occurred, please try again.", Rest_Controller::HTTP_BAD_REQUEST);
            }
        } else {
            // Set the response and exit
            $this->response("Provide at least one user info to update.", Rest_Controller::HTTP_BAD_REQUEST);
        }
    }

}