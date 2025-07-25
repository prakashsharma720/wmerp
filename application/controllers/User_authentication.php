<?php
//session_start(); //we need to start session in order to access it through CI

Class User_authentication extends MY_Controller {

public function __construct() {
parent::__construct();



// Load form helper library
$this->load->helper('form');
$this->load->helper('url');
// new security feature
$this->load->helper('security');

// Load form validation library
$this->load->library('form_validation');

$this->load->library('encryption');

// Load session library
$this->load->library('session');

$this->load->library('template');

// Load database
$this->load->model('login_database');
$this->load->model('notifications_model');
$this->load->model('master_model');

// if(!$this->session->userdata('site_language')){
// 	$this->session->set_userdata('site_language', 'english');
// }
// // Load the selected language
// $this->lang->load('admin', $this->session->userdata('site_language'));

// $this->load->library('input');

}







// Show dashboard page



// public function dashboard() {
// 	//$this->template->load('template', 'login_form');
	
// 	$this->login_id=$this->session->userdata['logged_in']['id'];
// 	$this->department_id=$this->session->userdata['logged_in']['department_id'];
// 	$this->role_id=$this->session->userdata['logged_in']['role_id'];
// 	//print_r($this->login_id);exit;
// 	$data['title'] = 'Dashboard';
// 	$data['total_notifications'] = $this->notifications_model->totalCount();
// 	if($this->role_id=='1'){
// 		$data['allnotifications'] = $this->notifications_model->allnotification();
	
// 	}else{
// 		$data['allnotifications'] = $this->notifications_model->allnotification_emp($this->login_id);
	
// 	}
// 	$data['total_suupliers'] = $this->login_database->TotalSupliers();
// 	$data['TotalOrders'] = $this->login_database->TotalOrders();
// 	$data['TotalEmployees'] = $this->login_database->TotalEmployees();
// 	$data['TotalProducts'] = $this->login_database->TotalProducts();
// 	$this->template->load('template', 'dashboard',$data);
// 	//$this->load->view('dashboard',$data);
// 	}



function sendSMS($recipient_no='9664100138', $message='hello dear'){
    // Request parameters array
    $requestParams = array(
        'user' => 'codexworld',
        'apiKey' => '262142AbJ0kteypc5c5fbb5d',
        'senderID' => 'PRAKASH',
        'recipient_no' => $recipient_no,
		'unicode' => '1',
        'message' => $message
    );
    
    // Merge API url and parameters
    $apiUrl = "http://api.msg91.com/api/sendhttp.php?";
    foreach($requestParams as $key => $val){
        $apiUrl .= $key.'='.urlencode($val).'&';
    }
    $apiUrl = rtrim($apiUrl, "&");
    
    // API call
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Return curl response
    echo $response;
}

public function admin_dashboard() {
	// $this->session->set_userdata('logged_in', $session_data);
	//$this->template->load('template', 'login_form');
	$data['title'] = 'Admin Dashboard';
	$login_id=$this->session->userdata['logged_in']['id'];
	// echo $login_id;exit;
	$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$data['role_id']=$this->session->userdata['logged_in']['role_id'];
	$data['auth_id']=$this->session->userdata['logged_in']['auth_id'];
	$user_id = $this->session->userdata['logged_in']['id'];
	
	$this->load->model('Broadcast_model');
	$role_id = $this->session->userdata['logged_in']['role_id'];

	$data['broadcasts'] = $this->Broadcast_model->get_active_messages($user_id, $data['department_id']);

	// echo "<pre>";
	// print_r($data['broadcasts']);
	// exit;

	// $this->db->where(column:'reminders.reminder_date',now()->format(format:'Y-m-d'));
	$data['getReminder'] = $this->login_database->getReminder($login_id); 
	// $data['getReminders'] = $this->login_database->getReminderCode();
	// echo"<pre>";print_r($data['getReminder']);exit;
	$data['totalleaves'] = $this->login_database->totalLeave($login_id);
	// print_r($data['totalleaves']);exit;
	$data['totalleavesalloted'] = $this->login_database->totalLeaveAlloted($login_id);
	$data['thismonthleaves'] = $this->login_database->thisMonthLeaves($login_id);
	$data['totalleads'] = $this->login_database->totalLeads($login_id);
	$data['thismonthleads'] = $this->login_database->thisMonthLeads($login_id,$data['role_id']);
	$data['thismonthduplicate'] = $this->login_database->thisMonthDuplicate($login_id,$data['role_id']);
	$data['getAll'] = $this->login_database->getAll();
	$data['todayleads'] = $this->login_database->todayLeads($login_id,$data['role_id']);
	$data['duplicatelead'] = $this->login_database->duplicateLead($login_id,$data['role_id']);
	$data['isduplicateleads'] = $this->login_database->isduplicateLeads($login_id,$data['role_id']);
	$data['religousleaves'] = $this->login_database->religousLeave($login_id);
	$data['todaytarget'] = $this->login_database->todayTarget($login_id);
	$data['assignLeads'] = $this->login_database->assignLeads($login_id,$data['role_id']);
	$data['leadsFollowups'] = $this->login_database->totalLeadsfollowups($login_id,$data['role_id']);
	$data['inProcessLeads'] = $this->login_database->inProcessLeads($login_id);
	$data['ApprovedLeads'] = $this->login_database->ApprovedLeads($login_id);
	$data['RejectedLeads'] = $this->login_database->RejectedLeads($login_id);
	$data['pendingLeads'] = $this->login_database->pendingLeads($login_id);
	$data['yesterdayLeads'] = $this->login_database->yesterdayLeads($login_id,$data['role_id']);
	$data['yesterdayduplicateLeads'] = $this->login_database->yesterdayduplicateLeads($login_id,$data['role_id']);
	//MArketing Leads
	$data['NoactionmarketingLead'] = $this->login_database->NoActionLeads($login_id,$data['role_id']);
	$data['todayMarketingleads'] = $this->login_database->todayMarketingLeads($login_id);
	$data['inProgressMarketingLeads'] = $this->login_database->inProgressMarketingLeads($login_id,$data['role_id']);
	$data['LastupdateMarketingLeads'] = $this->login_database->LastupdateMarketingLeads($login_id);
	$data['DeclinedMarketingLeads'] = $this->login_database->DeclinedMarketingLeads($login_id,$data['role_id']);
	$data['ConvertedMarketingLeads'] = $this->login_database->ConvertedMarketingLeads($login_id,$data['role_id']);
	$data['yesterdayMarketingLeads'] = $this->login_database->yesterdayMarketingLeads($login_id);
	$data['yesterdayNoactionmarketingLead'] = $this->login_database->yesterdayNoactionmarketingLead($login_id,$data['role_id']);
	$data['inProgressYesterdayMarketingLeads'] = $this->login_database->inProgressYesterdayMarketingLeads($login_id,$data['role_id']);
	$data['DeclinedYesterdayMarketingLeads'] = $this->login_database->DeclinedYesterdayMarketingLeads($login_id,$data['role_id']);
	$data['ConvertedYesterdayMarketingLeads'] = $this->login_database->ConvertedYesterdayMarketingLeads($login_id,$data['role_id']);
	$data['thismonthMarketingleads'] = $this->login_database->thismonthMarketingleads($login_id);
	$data['thismonthNoActionMarketingLeads'] = $this->login_database->thismonthNoActionMarketingLeads($login_id,$data['role_id']);

	$data['thismonthinProgressMarketingLeads'] = $this->login_database->thismonthinProgressMarketingLeads($login_id,$data['role_id']);
	$data['thismonthinDeclinedMarketingLeads'] = $this->login_database->thismonthinDeclinedMarketingLeads($login_id,$data['role_id']);
	$data['thismonthConvertedMarketingLeads'] = $this->login_database->thismonthConvertedMarketingLeads($login_id,$data['role_id']);
	$data['datedifference']= $this->login_database->datedifference($login_id,$data['role_id']);

	
	//$data['thismonthleaves'] = $this->login_database->thisMonthLeave($login_id);

	$this->db->select('*');
	$this->db->from('employees');
	// if($data['role_id']=='1'||$data['role_id']=='2'||$data['role_id']=='6'){
	// 	$this->db->where(['employees.role_id'=>'3']);
	// }
	// else{
	// 	$this->db->where(['employees.role_id'=>'3','id'=>$login_id]);
	// }
	$this->db->order_by("employees.id", "desc");
	$query = $this->db->get();
	$data['target']=$query->result_array();
 
	// echo"<pre>";print_r($data['target']);exit;
	
	// $this->template->load('template', 'super_dashboard',$data);
	//   $this->load->view('layouts/darulux', $data);
		$this->template->load('layout/template', 'crm_dashboard', $data);
//$this->load->view('dashboard',$data);
}



public function index() {
//$this->template->load('template', 'login_form');

$this->load->view('login_form');
}

public function role_master($id = NULL){
	$data = array();
    $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
    $data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
      $result = $this->master_model->getByroleId($id);

      if (isset($result['id']) && $result['id']) :
              $data['id'] = $result['id'];
          else:
              $data['id'] = '';
          endif; 

      if (isset($result['role']) && $result['role']) :
              $data['role'] = $result['role'];
         else:
              $data['role'] = '';
          endif;
		  if (isset($result['auth_id']) && $result['auth_id']) :
			$data['auth_id'] = $result['auth_id'];
	   else:
			$data['auth_id'] = '';
		endif;

      $data['title'] = 'Role Master';
      $data['roles'] = $this->master_model->rolelist();
	//   print_r($data['roles']);exit;
	$this->template->load('template','role_master',$data);
}
// Show registration page

public function add_new_role() {
    
    $this->form_validation->set_rules('role', 'role Name', 'required');
    $this->form_validation->set_rules('auth_id', 'authority Nummber', 'required');
    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
      $this->index();
      //$this->template->load('template','category_master');
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    }
    else 
    {
      
      $data = array(
      'role' => $this->input->post('role'),
      'auth_id' => $this->input->post('auth_id'),
      );
      $result = $this->master_model->role_insert($data);
      if ($result == TRUE) {
      
      
        $this->session->set_flashdata('success', 'Role Added Successfully !');
        redirect('/User_authentication/role_master', 'refresh');
      } else {
      $this->session->set_flashdata('failed', 'Already exists, Sarvice Could not added !');
      redirect('/User_authentication/role_master', 'refresh');
      }
    } 
  }

  public function editrole($id) {
    $this->form_validation->set_rules('role', 'Role Name', 'required');
    $this->form_validation->set_rules('auth_id', 'authority Nummber', 'required');

    if ($this->form_validation->run() == FALSE) 
    {
      if(isset($this->session->userdata['logged_in'])){
        $this->index();
      //$this->template->load('template','category_master');
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
      'auth_id' => $this->input->post('auth_id'),
      'role' => $this->input->post('role'),
      'flag' => $this->input->post('flag')
      );
      $result = $this->master_model->role_update($data,$id);
      //echo $result;exit;
      if ($result == TRUE) {
      $this->session->set_flashdata('success', 'Role Updated Successfully !');
      redirect('/User_authentication/role_master', 'refresh');
      //$this->fetchSuppliers();
      }
      else {
      $this->session->set_flashdata('failed', 'No Changes in Role!');
      redirect('/User_authentication/role_master', 'refresh');
      }
    } 
  }

  public function deleteItem($id= null){
	$id = $this->uri->segment('3');
	$result =$this->master_model->deleteItem($id);
	if ($result == TRUE) {
	$this->session->set_flashdata('success', 'Role deleted Successfully !');
	redirect('/User_authentication/role_master', 'refresh');
	//$this->fetchSuppliers();
	} else {
	$this->session->set_flashdata('failed', 'Operation Failed!');
	redirect('/User_authentication/role_master', 'refresh');
	}
}

  public function user_registration_show() {
	$this->load->view('registration_form');
	}

// Validate and store registration data in database
public function new_user_registration() {

	// Check validation for user input in SignUp form
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('email_value', 'Email', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');
	$new_pass=md5($this->input->post('password'));
	//echo $new_pass;exit;
	if ($this->form_validation->run() == FALSE) {
	$this->load->view('registration_form');
	} else {
	$data = array(
	'username' => $this->input->post('username'),
	'email' => $this->input->post('email_value'),
	'password' => $new_pass
	);
	//print_r($data);exit;
	
	$result = $this->login_database->registration_insert($data);
	if ($result == TRUE) {
	$data['message_display'] = 'Registration Successfully !';
	$this->load->view('login_form', $data);
	} else {
	$data['message_display'] = 'Username already exist!';
	$this->load->view('registration_form', $data);
	}
	}
	}
	
	// Check for user login process
	public function user_login_process() {
	
	$this->form_validation->set_rules('username', 'Username', 'required');
	$this->form_validation->set_rules('password', 'Password', 'required');
	$new_password=md5($this->input->post('password'));
	// echo $this->input->post('username');
	// echo $new_password;exit;
	if ($this->form_validation->run() == FALSE) {
	if(isset($this->session->userdata['logged_in'])){
		// echo "no session ";exit;
		$this->index();
	//$this->load->view('admin_page');
	}else{
	$this->load->view('login_form');
	}
	} else {
	$data = array(
	'username' => $this->input->post('username'),
	'password' => $new_password
	//$this->input->post('password')
	);
	
	$result = $this->login_database->login($data);
	if ($result == 'Inactive') {
		$this->session->set_flashdata('failed', 'User is In Active !');
		redirect('User_authentication/index','refresh');
	}
	else if ($result == 'active') {
	// echo "hy";exit;
	$username = $this->input->post('username');
	$result = $this->login_database->read_user_information($username);
	// echo "<pre>"; print_r($result);exit;
	
	if ($result != false) {
	$session_data = array(
	'id' => $result[0]->id,
	'username' => $result[0]->username,
	'email' => $result[0]->email,
	'name' => $result[0]->name,
	'employee_code' => $result[0]->employee_code,
	'mobile_no' => $result[0]->mobile_no,
	'role_id' => $result[0]->role_id,
	'auth_id' => $result[0]->auth_id,
	'role' => $result[0]->role,
	'department_id' => $result[0]->department_id,
	'designation_id' => $result[0]->designation_id,	
	'designation' => $result[0]->designation,
	'password' => $result[0]->password,
	'photo' => $result[0]->photo,
	'author_id' => $result[0]->author_id,
	);
	// Add user data in session
	$this->session->set_userdata('logged_in', $session_data);
	$role_id=$this->session->userdata['logged_in']['role_id'];
	// echo '<pre>';
	// 	print_r($this->session->userdata('logged_in'));
	// exit;
	$this->session->set_flashdata('login_success', 1);
	redirect('User_authentication/admin_dashboard');
	// $this->load->view('login_form');
	
	}
	}
	 else {
	
		$this->session->set_flashdata('failed', 'Invalid Username or Password !');
		//$this->load->view('login_form', $data);
		redirect('User_authentication/index','refresh');
	
		}
	}
	}

// Logout from admin page
public function logout() {

// Removing session data
$sess_array = array(
'username' => '',
'password' => '',
'role_id' => '',
'employee_code' => ''
);
$this->session->unset_userdata('logged_in', $sess_array);
//$data['message_display'] = 'User Successfully Logout';
$this->session->set_flashdata('success', 'User Successfully Logout !');
//$this->load->view('login_form', $data);
$this->session->sess_destroy();
redirect('User_authentication/index','refresh');
}
public function ForgotPassword() {
//$this->template->load('template', 'login_form');
$this->load->view('forgot_password');
}
public function EmailVerify() {
	$data =[];
	$data['error_message']='';
	$data['success_mesg']='';

	$this->form_validation->set_rules('email', 'Email', 'required');
	// $email=$this->input->post('email');
	$email=$this->input->post('email');
	$result=$this->login_database->verify_email($email);
	//print_r($result[0]->email);exit;
	if(!empty($result)){

		$emp_email=$result[0]->email;
		$emp_mobile=$result[0]->mobile_no;
		$id=$result[0]->id;

		//$data['success_mesg']='Email is verified.';
		$config = Array(
		  'protocol' => 'mail',
		  'smtp_host' => 'smtp.gmail.com',
		  'smtp_port' => 587,
		  'smtp_user' => '', // change it to yours
		  'smtp_pass' => '', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);
		$this->load->helper('string');
		$code= random_string('numeric', 6);

		//$code='123456';
        $message = 'Your one time password is : '.$code;
        $this->load->library('email', $config);
	    $this->email->set_newline("\r\n");
	    $this->email->from('prakashsharma720@gmail.com'); // change it to yours
	    $this->email->to($emp_email);// change it to yours
	    $this->email->subject('Forgot Password ');
	    $this->email->message($message);
	    if($this->email->send())
	    {
	    	$data = array(
			'forgot_code' => $code
			);
	    	$this->login_database->updateOtp($data,$id);
	    	$data['email']=$emp_email;
	    	$data['id']=$id;
	    	//$this->session->set_flashdata('success', 'OTP is sent to your registered mail id');
	    	// $data['success_mesg']=' OTP is sent to your registered mail id .';
	    	$this->session->set_flashdata('success', 'OTP is sent to your registered mail id ');
	     	$this->load->view('otp_verify',$data);
	    }
	   	else
	    {
	    	$this->session->set_flashdata('failed', 'Email sending failed');
	    	redirect('User_authentication/ForgotPassword','refresh');
	     // $data['error_message']=$this->email->print_debugger();
	    }


	}
	else{
		$this->session->set_flashdata('failed', 'Email is not registered with us,please try with another registered email');
		redirect('User_authentication/ForgotPassword','refresh');
	}
	
	}

	public function otpVerify() {

		$this->form_validation->set_rules('otp', 'OTP', 'required');
		$email=$this->input->post('email');
		$otp=$this->input->post('otp');
		$result=$this->login_database->verify_email($email);
		//print_r($result);exit;
		if($result[0]->forgot_code==$otp){
			$data['email']=$result[0]->email;
			$this->session->set_flashdata('success', 'OTP is verified Succesfully');
			// $data['success_mesg']='OTP is verified Succesfully';
			$this->load->view('change_password',$data);
		}else{
			$data['email']=$result[0]->email;
			$this->session->set_flashdata('failed', 'OTP does not match');
			// $data['error_message']='OTP does not match ';

			$this->load->view('otp_verify',$data);
		}
		
	}

	public function ChangePassword() {
	//$this->form_validation->set_rules('password', 'Password', 'required');
	//$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
	$password=$this->input->post('password');
	$cpassword=$this->input->post('confirm_password');
	$email=$this->input->post('email');

	$data = array('password' => md5($password));
		$result=$this->login_database->updatePassword($email,$data);
		if($result==true){
			$this->session->set_flashdata('success', 'Password Changed Succesfully');
			redirect('User_authentication/index','refresh');
			
		}
	else{
			$this->session->set_flashdata('failed', 'Operation Failed');
			redirect('User_authentication/ChangePassword','refresh');

		}
		
	}
	public function MyPasswordChangeView() {
		$data = array();
		$this->load->model('employee');
		$loginId=$this->session->userdata['logged_in']['id'];
		$result = $this->employee->getById($loginId);
		// echo "<pre>"; print_r($result); exit;

		if (isset($result['id']) && $result['id']) :
			$data['id'] = $result['id'];
		else:
			$data['id'] = '';
		endif;
		if (isset($result['designation']) && $result['designation']) :
			$data['designation'] = $result['designation'];
		else:
			$data['designation'] = '';
		endif;

		if (isset($result['name']) && $result['name']) :
			$data['name'] = $result['name'];
		else:
			$data['name'] = '';
		endif;	
		if (isset($result['blood_group']) && $result['blood_group']) :
			$data['blood_group'] = $result['blood_group'];
		else:
			$data['blood_group'] = '';
		endif;

		if (isset($result['employee_code']) && $result['employee_code']) :
			$data['emp_code'] = $result['employee_code'];
			$voucher_no= $data['emp_code'];
			if($voucher_no<10){
			$employee_id_code='EC000'.$voucher_no;
			}
			else if(($voucher_no>=10) && ($voucher_no<=99)){
				$employee_id_code='EC00'.$voucher_no;
			}
			else if(($voucher_no>=100) && ($voucher_no<=999)){
				$employee_id_code='EC0'.$voucher_no;
			}
			else{
				$employee_id_code='EC'.$voucher_no;
			}
			//print_r($employee_id_code);exit;
			$data['employee_code']=$employee_id_code;
			else:
			$data['employee_code'] = '';
		endif;

		if (isset($result['email']) && $result['email']) :
			$data['email'] = $result['email'];
			else:
			$data['email'] = '';
		endif;
		if (isset($result['salary']) && $result['salary']) :
			$data['salary'] = $result['salary'];
		else:
			$data['salary'] = '';
		endif;

		if (isset($result['account_holder_name']) && $result['account_holder_name']) :
			$data['account_holder_name'] = $result['account_holder_name'];
		else:
			$data['account_holder_name'] = '';
		endif;

		if (isset($result['bank_name']) && $result['bank_name']) :
			$data['bank_name'] = $result['bank_name'];
		else:
			$data['bank_name'] = '';
		endif;

		if (isset($result['account_number']) && $result['account_number']) :
			$data['account_number'] = $result['account_number'];
		else:
			$data['account_number'] = '';
		endif;

		if (isset($result['ifsc_code']) && $result['ifsc_code']) :
			$data['ifsc_code'] = $result['ifsc_code'];
		else:
			$data['ifsc_code'] = '';
		endif;

		if (isset($result['branch_name']) && $result['branch_name']) :
			$data['branch_name'] = $result['branch_name'];
		else:
			$data['branch_name'] = '';
		endif;

		if (isset($result['account_type']) && $result['account_type']) :
			$data['account_type'] = $result['account_type'];
		else:
			$data['account_type'] = '';
		endif;

		if (isset($result['upi_id']) && $result['upi_id']) :
			$data['upi_id'] = $result['upi_id'];
		else:
			$data['upi_id'] = '';
		endif;

		if (isset($result['hra']) && $result['hra']) :
			$data['hra'] = $result['hra'];
		else:
			$data['hra'] = '';
		endif;

		if (isset($result['c_allowance']) && $result['c_allowance']) :
			$data['c_allowance'] = $result['c_allowance'];
		else:
			$data['c_allowance'] = '';
		endif;
		
		if (isset($result['m_allowance']) && $result['m_allowance']) :
			$data['m_allowance'] = $result['m_allowance'];
		else:
			$data['m_allowance'] = '';
		endif;

		if (isset($result['o_allowance']) && $result['o_allowance']) :
			$data['o_allowance'] = $result['o_allowance'];
		else:
			$data['o_allowance'] = '';
		endif;

		if (isset($result['uan']) && $result['uan']) :
			$data['uan'] = $result['uan'];
		else:
			$data['uan'] = '';
		endif;

		if (isset($result['pf']) && $result['pf']) :
			$data['pf'] = $result['pf'];
		else:
			$data['pf'] = '';
		endif;

		if (isset($result['esi']) && $result['esi']) :
			$data['esi'] = $result['esi'];
		else:
			$data['esi'] = '';
		endif;


		if (isset($result['mobile_no']) && $result['mobile_no']) :
			$data['mobile_no'] = $result['mobile_no'];
		else:
		$data['mobile_no'] = '';
		endif;
			if (isset($result['emobile_no']) && $result['emobile_no']) :
			$data['emobile_no'] = $result['emobile_no'];
		else:
		$data['emobile_no'] = '';
		endif;
		if (isset($result['ename']) && $result['ename']) :
			$data['ename'] = $result['ename'];
		else:
		$data['ename'] = '';
		endif;

		

		if (isset($result['username']) && $result['username']) :
			$data['username'] = $result['username'];
		else:
			$data['username'] = '';
		endif;

	

		if (isset($result['role_id']) && $result['role_id']) :
			$data['role_id'] = $result['role_id'];
		else:
			$data['role_id'] = '';
		endif;

		if (isset($result['department_id']) && $result['department_id']) :
			$data['department_id'] = $result['department_id'];
		else:
			$data['department_id'] = '';
		endif; 
		if (isset($result['designation_id']) && $result['designation_id']) :
			$data['designation_id'] = $result['designation_id'];
		else:
			$data['designation_id'] = '';
		endif; 
		if (isset($result['target']) && $result['target']) :
			$data['target'] = $result['target'];
		else:
			$data['target'] = '';
		endif; 
		if (isset($result['date_of_joining']) && $result['date_of_joining']) :

			$data['date_of_joining'] = date('d-m-Y',strtotime($result['date_of_joining']));
		else:
			$data['date_of_joining'] = '';
		endif; 

		if (isset($result['author_id']) && $result['author_id']) :
			$data['author_id'] = $result['author_id'];
		else:
			$data['author_id'] = '';
		endif;
		if (isset($result['total_net_salary']) && $result['total_net_salary']) :
			$data['total_net_salary'] = $result['total_net_salary'];
		else:
			$data['total_net_salary'] = '';
		endif;
		
		
		
		
		if (isset($result['employee_code']) && $result['employee_code']) :
			$data['employee_code'] = $result['employee_code'];
		else:
			$data['employee_code'] = '';
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
			$data['dob'] =date('d-m-Y',strtotime($result['dob']));
		else:
			$data['dob'] = '';
		endif;

		if (isset($result['photo']) && $result['photo']) :
			$data['photo'] = $result['photo'];
		else:
			$data['photo'] = '';
		endif; 
		
		if (isset($result['id']) && $result['id']) :
			$data['title'] = 'Edit Employee';
		else:
			$data['title'] = 'Add New Employee';
			endif;	
		//$data['employees'] = $this->employee->employeesList();
		$data['roles'] = $this->employee->getRoles();
		$data['departments'] = $this->employee->getDepartments();
		$data['designations'] = $this->employee->getDesignation();
		$data['employees'] = $this->employee->getEmployees();
		$data['title'] = ' Change Password';
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
		$data['employees'] = $this->login_database->getEmployees();
		$this->template->load('layout/template', 'new-password',$data);	
	}


	public function UserPasswordChange(){
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
		$password=md5($this->input->post('password'));
		$cpassword=md5($this->input->post('confirm_password'));
		
		// print_r($password);
		// echo"<br>";
		// print_r($cpassword);
		//exit;
		
		$login_id=$this->session->userdata['logged_in']['id'];
		if($password==$cpassword){
			$data = array('password' => $password);
			if(!empty($this->input->post('emp_id'))){
				$emp_id=$this->input->post('emp_id');
			}else{
				$emp_id=$login_id;
			}
			
			//print_r($data);exit;
		
			$result=$this->login_database->myPasswordChange($emp_id,$data);
			//print_r($result);exit;
			if($result==true){
				$this->session->set_flashdata('success', 'Password Changed Succesfully');
				redirect('User_authentication/MyPasswordChangeView','refresh');
				
			}

			else{
				$this->session->set_flashdata('failed', 'Operation Failed');
				redirect('User_authentication/MyPasswordChangeView','refresh');

			}	
		}else{
				$this->session->set_flashdata('failed', 'Password and Confirm Password are different.');
				redirect('User_authentication/MyPasswordChangeView','refresh');
		}
		
	}
	public function sendMail() {
		//$this->template->load('template', 'login_form');
		$data['title'] = 'Welcome to Send Email Page ';
		$data['total_candidate'] = $this->login_database->TotalCandidates();
		$this->template->load('template', 'mailer',$data);
		//$this->load->view('dashboard',$data);
		}
	
	public function SendEmailtoAllUsers() {

	$result=$this->login_database->FetchallEmails();
	//print_r($result);exit;
	
	if(!empty($result)){
		foreach ($result as $key => $data) {
		 	$sent_to=$data['email'];
		 	//print_r($sent_to);exit;
			//$data['success_mesg']='Email is verified.';
			$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'ssl://smtp.googlemail.com',
			  'smtp_port' => 465,
			  //'smtp_user' => 'prakash1.muskowl@gmail.com', // change it to yours
			  //'smtp_user' => 'isnu.admissions@nirmauni.ac.in', // change it to yours
			  'smtp_user' => 'ipnu.admission@nirmauni.ac.in', // change it to yours
			  //'smtp_pass' => 'ymdc@6789', // change it to yours
			  'smtp_pass' => 'Digital@NirmaPharma', // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE
			);
			$this->load->helper('string');

		//$code='123456';
        $message = " Hello! 
        		<br><br>
					In reference to our previous email, we would like to inform you that 'LAST DATE FOR REGISTRATION IS 27TH JUNE 2019 '. Hurry up and register yourself for becoming a part of one of the best University. Hurry up! limited seats. Follow the registration link below and get yourself registered..<br><br>

					For registering with us, follow the link: http://admissions.nirmauni.ac.in/CampusLynxNU/onindex.html <br>
					NOTE: Ignore if you have already applied.<br><br>

					Feel free to contact us on the numbers and e-mail address mentioned below.<br>
					1.     Phone: (079)30642715,(02717)241900-04 <br>
					2.     Email: admission.ip@nirmauni.ac.in
					<br><br>
					Regards, <br>
					Institute of Pharmacy, Nirma University <br>
					Website: http://www.nirmauni.ac.in/IPNU <br>
					Address: Sarkhej-Gandhinagar Highway, Post Chandlodia, <br>
					Via Gota, Ahmedabad – 382481. Gujarat, India <br><br>
					
					";
        $this->load->library('email', $config);
	    $this->email->set_newline("\r\n");
	    //$this->email->from('isnu.admissions@nirmauni.ac.in'); // change it to yours
	    $this->email->from('ipnu.admission@nirmauni.ac.in'); // change it to yours
	    //$this->email->to($emp_email);// change it to yours
	    $this->email->to($sent_to);// change it to yours
	    //$this->email->to('prakashsharma720@gmail.com');// change it to yours
	    $this->email->subject('LAST DATE FOR REGISTRATION IS 27TH JUNE 2019! Institute of Pharmacy, Nirma University');
	    $this->email->message($message);
	    $this->email->send();
	    
	}
}
		else{
			$this->session->set_flashdata('failed', 'Email is not registered with us,please try with another registered email');
			redirect('User_authentication/sendMail','refresh');
		}
    }

	public function newTemplateTest(){
		$data['getAll'] = $this->login_database->getAll();
		$this->template->load('layout/template', 'super_dashboard',$data);
	}
}




?>