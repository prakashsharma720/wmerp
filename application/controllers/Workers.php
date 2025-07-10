<?php

//session_start(); //we need to start session in order to access it through CI

Class Workers extends MY_Controller {

public function __construct() {
parent::__construct();
if(!$this->session->userdata['logged_in']['id']){
    redirect('User_authentication/index');
}
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('url');
// new security feature
$this->load->helper('security');
// Load form validation library
$this->load->library('form_validation');


// Load session library
$this->load->library('session');


$this->load->library('template');

// Load database
$this->load->model('worker');
}

// Show login page
public function index() {
			$data['title'] = 'Workers List';
			$data['workers'] = $this->worker->workersList();
			$data['roles'] = $this->worker->getRoles();
			$data['departments'] = $this->worker->getDepartments();	
			//echo var_dump($data['students']);
			//print_r($roles);exit;
			$this->template->load('template','worker_view',$data);
	}

	
	

	public function add() 
	{
			$data = array();
			$data['title'] = 'Add New Worker';
			//$data['workers'] = $this->worker->workersList();
			$data['roles'] = $this->worker->getRoles();
			// $data['wc_code'] = $this->worker->getworkerCode();
			// //print_r($data['wc_code']);exit;
			// $voucher_no= $data['wc_code'];
   //          if($voucher_no<10){
   //          $worker_id_code='WC000'.$voucher_no;
   //          }
   //          else if(($voucher_no>=10) && ($voucher_no<=99)){
   //            $worker_id_code='WC00'.$voucher_no;
   //          }
   //          else if(($voucher_no>=100) && ($voucher_no<=999)){
   //            $worker_id_code='WC0'.$voucher_no;
   //          }
   //          else{
   //            $worker_id_code='WC'.$voucher_no;
   //          }
   //          //print_r($worker_id_code);exit;
   //          $data['worker_code']=$worker_id_code;
			$data['departments'] = $this->worker->getDepartments();
			//print_r($data['departments']);exit;
			$this->template->load('template','workers',$data);
	}
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->worker->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['name']) && $result['name']) :
	            $data['name'] = $result['name'];
	       else:
	            $data['name'] = '';
	        endif;
				//print_r($result['worker_code']);exit;
	        if (isset($result['worker_code']) && $result['worker_code']) :
	            $data['wc_code'] = $result['worker_code'];
				
	            $voucher_no= $data['wc_code'];
	            if($voucher_no<10){
	            $worker_id_code='WC000'.$voucher_no;
	            }
	            else if(($voucher_no>=10) && ($voucher_no<=99)){
	              $worker_id_code='WC00'.$voucher_no;
	            }
	            else if(($voucher_no>=100) && ($voucher_no<=999)){
	              $worker_id_code='WC0'.$voucher_no;
	            }
	            else{
	              $worker_id_code='WC'.$voucher_no;
	            }
	            //print_r($worker_id_code);exit;
	            $data['worker_code']=$worker_id_code;
	        else:
	            $data['worker_code'] = '';
	        endif;
			/*
	        if (isset($result['email']) && $result['email']) :
	            $data['email'] = $result['email'];
	       else:
	            $data['email'] = '';
	        endif;*/
	         
	        if (isset($result['mobile_no']) && $result['mobile_no']) :
	            $data['mobile_no'] = $result['mobile_no'];
	       else:
	        $data['mobile_no'] = '';
	        endif;

	      /*  if (isset($result['designation']) && $result['designation']) :
	            $data['designation'] = $result['designation'];
	       else:
	            $data['designation'] = '';
	        endif;*/

	      /*  if (isset($result['role_id']) && $result['role_id']) :
	            $data['role_id'] = $result['role_id'];
	       else:
	            $data['role_id'] = '';
	        endif;*/

	        if (isset($result['department_id']) && $result['department_id']) :
	            $data['department_id'] = $result['department_id'];
	       else:
	            $data['department_id'] = '';
	        endif; 
	        if (isset($result['pan_no']) && $result['pan_no']) :
	            $data['pan_no'] = $result['pan_no'];
	       else:
	            $data['pan_no'] = '';
	        endif; 
	        if (isset($result['aadhaar_no']) && $result['aadhaar_no']) :
	            $data['aadhaar_no'] = $result['aadhaar_no'];
	       else:
	            $data['aadhaar_no'] = '';
	        endif; 
	        if (isset($result['gender']) && $result['gender']) :
	            $data['gender'] = $result['gender'];
	       else:
	            $data['gender'] = '';
	        endif; 
	        if (isset($result['address']) && $result['address']) :
	            $data['address'] = $result['address'];
	       else:
	            $data['address'] = '';
	        endif;
	        if (isset($result['dob']) && $result['dob']) :
	            $data['dob'] = $result['dob'];
	       else:
	            $data['dob'] = '';
	        endif;

	        if (isset($result['photo']) && $result['photo']) :
	            $data['photo'] = $result['photo'];
	       else:
	            $data['photo'] = '';
	        endif;

	        if (isset($result['medical_status'])) :
	            $data['medical_status'] = $result['medical_status'];
	       else:
	            $data['medical_status'] = '';
	        endif; 

	        if (isset($result['report_no'])) :
	            $data['report_no'] = $result['report_no'];
	       else:
	            $data['report_no'] = '';
	        endif;

	        if (isset($result['id']) && $result['id']) :
				$data['title'] = 'Edit worker';
			else:
				$data['title'] = 'Add New worker';
			 endif;	
			//$data['workers'] = $this->worker->workersList();
			$data['roles'] = $this->worker->getRoles();
			
			$data['departments'] = $this->worker->getDepartments();
			//print_r($data['departments']);exit;
			$this->template->load('template','worker_edit',$data);
	}
	public function add_new_worker() {
		$this->form_validation->set_rules('name', 'name ', 'required');
		$this->form_validation->set_rules('department_id', 'Department', 'required');
		//$this->form_validation->set_rules('mobile_no', 'Mobile Number ', 'required||matches[repassword]|max_length[10]|min_length[10]|xss_clean|callback_isphoneExist');
		/*
		$this->form_validation->set_rules('department_id', 'Department', 'required');*/
		
		
        //$photo=$this->upload->data('file_name'); 
		//print_r($photo);exit;
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			redirect('/Workers/add');
			//$this->template->load('template','workers',$data);
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			     	
        /*if ( ! $this->upload->do_upload('userfile'))
        {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('upload_form', $error);
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());

                $this->load->view('upload_success', $data);
        }*/
	        $loginId=$this->session->userdata['logged_in']['id'];
	        /*$config['upload_path']          = '../uploads/workers/';
	        $config['allowed_types']        = 'jpg|png';
	        $config['max_size']             = 100;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
	        $this->load->library('upload');
	        $this->upload->do_upload('photo');

			$data = array(
			'name' => $this->input->post('name'),
			'worker_code' => $this->input->post('wc_code'),
			'photo' => $this->upload->data()['file_name'],
			'gender' => $this->input->post('gender'),
			'mobile_no' => $this->input->post('mobile_no'),
			'pan_no' => $this->input->post('pan_no'),
			'medical_status' => $this->input->post('medical_status'),
			'report_no' => $this->input->post('report_no'),
			'aadhaar_no' => $this->input->post('aadhaar_no'),
			'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
			'address' => $this->input->post('address'),
			//'role_id' => $this->input->post('role_id'),
			'department_id' => $this->input->post('department_id'),
			'created_by' => $loginId,
			);

			$result = $this->worker->worker_insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Worker Added Successfully !');
			redirect('/Workers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Worker insertion failed!');
			redirect('/Workers/index', 'refresh');
			}
		} 
	}

	public function editworker($id) {
		$this->form_validation->set_rules('name', 'Role ', 'required');
		$this->form_validation->set_rules('department_id', 'Department', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->add($id);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			$loginId=$this->session->userdata['logged_in']['id'];

			if($this->input->post('flag')==1){
				$status='1';
			}else{
				$status='0';
			}
			//print_r($this->input->post('old_image'));exit;
			
			/*$config['upload_path']          = './uploads/workers/';
	       	$config['allowed_types'] 		= 'gif|jpg|jpeg|png';
	        $config['overwrite'] 			= TRUE;
	        $config['max_size']             = 2048000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;*/
	        $this->load->library('upload');
	       // $photo=$this->upload->data('file_name');
	       // print_r($photo);exit;
	       // $result=$this->upload->do_upload('photo');
	        //$this->upload->do_upload('photo');
	        $this->upload->do_upload('photo');
	       

	      	//print_r($this->upload->data()['file_name']);exit;
	      	if(!empty($this->upload->data()['file_name'])){
	      		$file_name=$this->upload->data()['file_name'];
	      		
	      	}else{
	      		$file_name=$this->input->post('old_image');
	      	}
			$data = array(
			'name' => $this->input->post('name'),
			'worker_code' => $this->input->post('wc_code'),
			//'photo' => $this->upload->data('file_name'),
			'photo' => $file_name,
			'gender' => $this->input->post('gender'),
			'mobile_no' => $this->input->post('mobile_no'),
			'medical_status' => $this->input->post('medical_status'),
			'report_no' => $this->input->post('report_no'),
			'pan_no' => $this->input->post('pan_no'),
			'aadhaar_no' => $this->input->post('aadhaar_no'),
			'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
			'address' => $this->input->post('address'),
			//'role_id' => $this->input->post('role_id'),
			'department_id' => $this->input->post('department_id'),
			'status' => $status,
			'flag'=>$this->input->post('flag'),
			'edited_by'=>$loginId,
			);
			
			$result = $this->worker->worker_update($data,$id);
			if ($result == TRUE) {
				if(!empty($this->upload->data()['file_name'])){
					$old_image=$this->input->post('old_image');
					unlink("uploads/".$old_image);
				}
			$this->session->set_flashdata('success', 'Worker Updated Successfully !');
			redirect('/Workers/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Worker details !');
			redirect('/Workers/index', 'refresh');
			}
		} 
	}
	public function deleteworker($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->worker->deleteworker($id);
	  	 			$result=$this->worker->getById($id);
		  	 		if (isset($result['photo']) && $result['photo']) :
			            $user_image = $result['photo'];
			            unlink("uploads/".$user_image);
			        endif;
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Workers deleted Successfully !');
			}else{
  	 		$id = $this->uri->segment('3');
  	 		$this->worker->deleteworker($id);
  	 		$result=$this->worker->getById($id);
  	 		if (isset($result['photo']) && $result['photo']) :
	            $user_image = $result['photo'];
	            unlink("uploads/".$user_image);
	        endif;

  	 		$this->session->set_flashdata('success', 'Worker deleted Successfully !');
  	 		redirect('/Workers/index', 'refresh');
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 		}

		}
		public function MyProfile($id= null){
		$data['title']='My Profile Details';
		$data['result']=$this->worker->getById($id);
		$this->template->load('template','myprofile',$data);
	}


	}

?>