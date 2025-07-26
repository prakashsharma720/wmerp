<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI

Class CustomerSupport_controller extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if(!$this->session->userdata['logged_in']['id']){
			redirect('User_authentication/index');
		}
		require_once APPPATH . "/third_party/PHPExcel.php";
		// $this->excel = new PHPExcel(); 
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
		$this->load->model('Leads_model');
		$this->load->model('CustomerSupport_model');
			$this->load->model('MO_leads');
	}

	public function index() 
	{
		$data['title'] = ' Customer Data';
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data['department_id']=$this->session->userdata['logged_in']['department_id'];
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$data['auth_id']=$this->session->userdata['logged_in']['auth_id'];
		$data['leads'] = $this->CustomerSupport_model->getList($data);
     
		//  echo "<pre>"; print_r($data['leads']);exit;

		$this->template->load('layout/template','CustomerSupport/customerview',$data);
	}




	public function followups($id = NULL) 
	{
		// echo $id;exit;
		$data=[];
		$data['id']=$this->uri->segment('3');
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		
		$data['customer_data'] = $this->CustomerSupport_model->getById($id);
		$data['followups'] = $this->CustomerSupport_model->getFollowUps($id);
		$data['ticket'] = $data['customer_data']['ticket'];
		//$data['categories'] = $this->CustomerSupport_model->getCategories();
		//echo var_dump($data['students']);
		// echo "<pre>";print_r($data['customer_data']);exit;
		$this->template->load('layout/template','CustomerSupport/customer_followup',$data);
	}



	public function tracking($id = NULL) 
	{
		$data=[];
		$data['id']=$this->uri->segment('3');
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		
		$data['customer_data'] = $this->CustomerSupport_model->getFollowupById($id);
		$data['followups'] = $this->CustomerSupport_model->getFollowUps($id);
		$data['lead_title'] = $data['customer_data']['order_id'];
		//$data['categories'] = $this->CustomerSupport_model->getCategories();
		//echo var_dump($data['students']);
		$this->template->load('layout/template','CustomerSupport/customer_tracking',$data);
	}

	
	public function add_followup() {
		
	
		
        $login_data = $this->session->userdata('logged_in');
        $is_admin = isset($login_data['role_id']) && $login_data['role_id'] == '1'; // or however you define admin
		// echo "<pre>";print_r($_POST);exit;


			$data = [];
        	if (!empty($_FILES['attachment']['name'])) {
            $config['upload_path']   = './uploads/user_media/';
            $config['allowed_types'] = '*';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('attachment')) {
                $this->session->set_flashdata('failed', $this->upload->display_errors());
                redirect('CustomerSupport_controller/followups/' . $this->input->post('ticket'), 'refresh');
            }

            		$file_name = $this->upload->data()['file_name'];
					} else {
						$file_name = null;
					}

				// echo "<pre>";print_r($_POST);exit;
					
					$data = [
						'ticket'     => $this->input->post('ticket'),
						'answer'     => $this->input->post('note'),
						'date'       => date('Y-m-d'),
						'file_path'  => $file_name,
						'followup_by'=>$this->input->post('followup_by'),
						'customer_id'=>$this->input->post('customer_id'),
					];

				
				
									// Save follow-up
							$result = $this->CustomerSupport_model->insertFollowup($data);
							if ($result) {
								$this->session->set_flashdata('success', 'Follow Up Added Successfully!');
							} else {
								$this->session->set_flashdata('failed', 'Follow Up Not Inserted!');
							}

							$redirect_ticket = $this->input->post('ticket');
							redirect('CustomerSupport_controller/tracking/' . $redirect_ticket, 'refresh');
		}
							

		public function deletefollowup($id= null){
  	 	$id = $this->uri->segment('3');
  	 	$customer_id=$this->input->post('customer_id');
  	 	$result =$this->CustomerSupport_model->deletefollowup($id);
  	 	if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Follow Up deleted Successfully !');
			redirect('CustomerSupport_controller/followups/103088'.$customer_id, 'refresh');
			//$this->fetchSuppliers();
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('CustomerSupport_controller/followups/103088'.$customer_id, 'refresh');
		}
  	}
	public function add($id=NULL) 
	{
		$data = array();
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];

		$data['page_title'] = ' Upload Lead File Here';
		$data['order'] = $this->CustomerSupport_model->getOrder();
		// $data['orders'] = $this->CustomerSupport_model->getOrders();
		$data['countrylist'] = $this->Leads_model->getCountry();
		// $data['target'] = $this->Leads_model->getTarget($login_id);
		// echo "<pre>"; print_r($data['country']);exit;
		// $data['countries'] = $this->Leads_model->getCountries();

		if(!empty($id))
		{
			$data['page_title'] = ' Update Lead';
			$result = $this->Leads_model->getById($id);

			if (isset($result['id'])) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['lead_title'])) :
	            $data['title'] = $result['lead_title'];
	        else:
	            $data['title'] = '';
	        endif;
	      
	     
	        if (isset($result['category_name'])) :
	            $data['category_name'] = $result['category_name'];
	        else:
	            $data['category_name'] = '';
	        endif;
			

	        if (isset($result['contact_person'])) :
	            $data['contact_person'] = $result['contact_person'];
	        else:
	            $data['contact_person'] = '';
	        endif;
			if (isset($result['country'])) :
	            $data['country'] = $result['country'];
	        else:
	            $data['country'] = '';
	        endif;
		

	        if (isset($result['mobile'])) :
	            $data['mobile'] = $result['mobile'];
	        else:
	            $data['mobile'] = '';
	        endif;
			if (isset($result['city'])) :
	            $data['city'] = $result['city'];
	        else:
	            $data['city'] = '';
	        endif;
	        if (isset($result['email'])) :
	            $data['email'] = $result['email'];
	        else:
	            $data['email'] = '';
	        endif;	        
			if (isset($result['lead_source'])) :
	            $data['lead_source'] = $result['lead_source'];
	        else:
	            $data['lead_source'] = '';
	        endif;
	         if (isset($result['date'])) :
	            $data['generation_date'] = $result['date'];
	        else:
	            $data['generation_date'] = '';
	        endif;
	       
	        if (isset($result['work_description'])) :
	            $data['description'] = $result['work_description'];
	        else:
	            $data['description'] = '';
	        endif;
	        if (isset($result['lead_code'])) :
	            $data['lead_code'] = $result['lead_code'];
	        else:
	            $data['lead_code'] = '';
	        endif;

	        if (isset($result['lead_status'])) :
	            $data['lead_status'] = $result['lead_status'];
	        else:
	            $data['lead_status'] = '';
	        endif;
			// echo"<pre>";print_r($result);exit;
	        $this->template->load('template','leads/lead_update',$data);

		} else {
			$data['page_title'] = ' Create New';
			$data['id'] = '';
			$data['title'] = '';
			$data['category_name'] = '';
			$data['contact_person'] = '';
			$data['country'] = '';
		
			$data['mobile'] = '';
			$data['city'] = '';
			$data['email'] = '';
			$data['lead_source'] = '';
			$data['generation_date'] = '';

			$data['description'] = '';
			$data['lead_status'] = '';
			$data['lead_count'] = $this->Leads_model->getLeadcsvCode();
		$data['countrylist'] = $this->Leads_model->getCountry();


			$voucher_no= $data['lead_count']+1;

		    if($voucher_no<10){
		    	$rs_id_code='MUSK000'.$voucher_no;
		    } else if(($voucher_no>=10) && ($voucher_no<=99)){
		      $rs_id_code='MUSK00'.$voucher_no;
		    } else if(($voucher_no>=100) && ($voucher_no<=999)){
		      $rs_id_code='MUSK0'.$voucher_no;
		    } else{
		      $rs_id_code='MUSK'.$voucher_no;
		    }

		    $data['lead_code']=$rs_id_code;

		    $this->template->load('template','CustomerSupport/customer_create',$data);
		}
	}
	

	public function update_satus(){
		// echo "<pre>"; print_r($_POST); exit;
			$id= $this->input->post('id');
			 $status = $this->input->post('status');
			$data = array(
			'status' => $status
			);
			// ✅ If status is 'Closed', do something extra
			if ($status == 'Closed') {
				$data['closed_date'] = date('Y-m-d H:i:s'); // Example: log close time
				// You can add more fields here if needed
			}
			if ($status == 'Resolved') {
				$data['resolved_date'] = date('Y-m-d H:i:s'); // Example: log close time
				// You can add more fields here if needed
			}
			$result = $this->CustomerSupport_model->update_status($id,$data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', ' Updated Successfully !');
			redirect('/CustomerSupport_controller/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Employee insertion failed!');
			redirect('/CustomerSuppport_controller/index', 'refresh');
			}
	}
		public function add_new_item() {
	
		// echo"<pre>";print_r($_FILES);exit;
		
			$data['login_id']=$this->session->userdata['logged_in']['id'];

			if (!empty($_FILES['photo']['name'])) {
            $config['upload_path']   = './uploads/user_media/';
            $config['allowed_types'] = '*';
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('photo')) {
                $this->session->set_flashdata('failed', $this->upload->display_errors());
                redirect('CustomerSupport_controller/add/' . $this->input->post('ticket'), 'refresh');
            }

            $file_name = $this->upload->data()['file_name'];
			} else {
				$file_name = null;
			}


    		$ticket_number = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);  // Ensures it always has 6 digits

			//echo "<pre>"; print_r($author_email); exit;
			$data = array(
			'date' => $this->input->post('generation_date'),
				'order_id' => ($this->input->post('category') == 'Billing/Order') ? $this->input->post('invoice_no') : null,
			'ticket' => $ticket_number,
			'category' => $this->input->post('category'),
			'c_name' => $this->input->post('cname'),
			'email'=>$this->input->post('email'),
			'phone'=>$this->input->post('mobile'),
		
			'city' => $this->input->post('city'),
			'status' => 'Open',
			'description' =>$this->input->post('description'),
			'photo' => $file_name,
			'auth_id' => $data['login_id'],
			
			);
			// echo print_r('department_id');exit;
			//print_r($data);exit;
			$result = $this->CustomerSupport_model->insert($data);
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', ' Added Successfully !');
			redirect('/CustomerSupport_controller/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Employee insertion failed!');
			redirect('/CustomerSuppport_controller/index', 'refresh');
			}

			
		
		}
	}

			

?>
