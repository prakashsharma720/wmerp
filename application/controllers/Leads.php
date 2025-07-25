<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI

Class Leads extends MY_Controller {

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
			$this->load->model('MO_leads');
	}

	public function index() 
	{
		$data['title'] = ' Lead Data';
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data['department_id']=$this->session->userdata['logged_in']['department_id'];
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$data['auth_id']=$this->session->userdata['logged_in']['auth_id'];
	
		$conditions=[];
		if($this->input->get()) {
			// print_r($conditions);exit;				
		 	$conditions['category_name']  = $this->input->get('category_name');
            $conditions['lead_code'] = $this->input->get('lead_code');
            $conditions['lead_status'] = $this->input->get('lead_status');
			$conditions['employee_id'] 	 = $this->input->get('employee_id');
            $conditions['mobile'] = $this->input->get('mobile');
            $conditions['email'] = $this->input->get('email');
            $conditions['lead_title'] = $this->input->get('lead_title');


            if(!empty($this->input->get('upto_date'))) {
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date']= "";
			}

			if(!empty($this->input->get('from_date'))) {
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date']= "";
			}
			

			// echo "<pre>";
			// print_r($_GET);
			
			$data['filtered_value']=$conditions;
			$data['leads'] = $this->Leads_model->LeadListCSV($conditions);
		
			$data['leads_id'] = $this->Leads_model->duplicate();
			
		} else {
			
			// $data['filtered_value']='';
			$conditions['category_name']='';
			$conditions['lead_code']='';
			$conditions['lead_status']='';
			$conditions['upto_date']='';
			$conditions['from_date']='';
			$conditions['employee_id'] 	= "";
		
			$data['filtered_value']=$conditions;
			$conditions['mobile'] = $this->input->get('mobile');
            $conditions['email'] = $this->input->get('email');
            $conditions['lead_title'] = $this->input->get('lead_title');
		 	$data['leads'] = $this->Leads_model->LeadListCSV($data);
			 $data['leads_id'] = $this->Leads_model->duplicate($conditions);
		}
        // 	echo"<pre>";print_r($data['leads']);exit;
		//echo var_dump($data['students']);
		// echo "<pre>";print_r($data['leads']);exit;
		$data['employees'] = $this->Leads_model->getEmployeeDropdown();
		$data['categories'] = $this->Leads_model->getLeadsCategories();
		// print_r($data['auth_id']);exit;

		$this->template->load('layout/template','Lead Module/Lead Generation/index',$data);
	}

	public function reports() 
	{
		$data['title'] = ' Lead Data';
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data['department_id']=$this->session->userdata['logged_in']['department_id'];
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		
	
		$conditions=[];
		if($this->input->get()) {			
		 	$conditions['category_name']  = $this->input->get('category_name');
            $conditions['lead_code'] = $this->input->get('lead_code');
            $conditions['lead_status'] = $this->input->get('lead_status');
			$conditions['employee_id'] 	 = $this->input->get('employee_id');
            $conditions['mobile'] = $this->input->get('mobile');
            $conditions['email'] = $this->input->get('email');
            $conditions['lead_title'] = $this->input->get('lead_title');


            if(!empty($this->input->get('upto_date'))) {
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date']= "";
			}

			if(!empty($this->input->get('from_date'))) {
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date']= "";
			}
			

			// echo "<pre>";
			// print_r($_GET);
			$data['filtered_value']=$conditions;
			$data['leads'] = $this->Leads_model->LeadListCSV($conditions);
			$data['leads_id'] = $this->Leads_model->duplicate();
			
		} else {
			
			// $data['filtered_value']='';
			$conditions['category_name']='';
			$conditions['lead_code']='';
			$conditions['lead_status']='';
			$conditions['upto_date']='';
			$conditions['from_date']='';
			$conditions['employee_id'] 	= "";
		
			$data['filtered_value']=$conditions;
			$conditions['mobile'] = $this->input->get('mobile');
            $conditions['email'] = $this->input->get('email');
            $conditions['lead_title'] = $this->input->get('lead_title');
		 	$data['leads'] = $this->Leads_model->LeadListCSV($data);
			 $data['leads_id'] = $this->Leads_model->duplicate($conditions);
		}

		//echo var_dump($data['students']);
		// echo "<pre>";print_r($data['leads']);exit;
		$data['employees'] = $this->Leads_model->getEmployeeDropdown();
		$data['categories'] = $this->Leads_model->getLeadsCategories();
		$this->template->load('template','leads/leads_report',$data);
	}

	public function mo_leads() 
	{
		$data['title'] = ' MO Website Leads Data';
		$this->load->model('MO_leads');
		$conditions=[];
		 if($this->input->get()) {
		 	$conditions['category_name']  = $this->input->get('category_name');
            $conditions['lead_code'] = $this->input->get('lead_code');
            $conditions['lead_status'] = $this->input->get('lead_status');
            if(!empty($this->input->get('upto_date'))) {
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			} else {
				$conditions['upto_date']= "";
			}
			if(!empty($this->input->get('from_date'))) {
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
			} else {
				$conditions['from_date']= "";
			}
			// echo "<pre>";
			// print_r($_GET);

			$data['leads'] = $this->MO_leads->MOLeadList($conditions);
			$data['filtered_value']=$conditions;
		 }else{
		 	$data['leads'] = $this->MO_leads->MOLeadList();
		 }
		//echo var_dump($data['students']);
		//print_r($data['item_name']);exit;
		
		$data['categories'] = $this->Leads_model->getLeadsCategories();
		$this->template->load('layout/template','leads/mo_lead_view',$data);
	}
	public function worshop_leads() 
{
    $data['title'] = 'Complaints Data';
    
    $this->load->model('MO_leads');
    $conditions = [];
    
    if($this->input->get()) {
        $conditions['workshop_name'] = $this->input->get('workshop_name');
        $conditions['booking_status'] = $this->input->get('booking_status');
    }
    
    $data['filtered_value'] = $conditions;
    $data['leads'] = $this->MO_leads->MOWorkshopList($conditions);
    $data['workshopnames'] = $this->MO_leads->getWorkshop();

    $this->template->load('layout/template', 'leads/workshop_view', $data);
}

   public function mailtoAll($id=NULL)
    {
    $ids = $this->input->post('ids');
    // echo $ids;exit;
    if (!empty($ids)) {
        $selectedIds = explode(',', $ids);
        foreach ($selectedIds as $id) {
            $this->MO_leads->sendMail($id);
        }
        $this->session->set_flashdata('success', 'Emails have been sent successfully to all selected users!');
    } else {
        $id = $this->uri->segment(3);
        $this->MO_leads->sendMail($id);
        $this->session->set_flashdata('success', 'Email has been sent successfully!');
    }
    redirect('/User_authentication/dashboard', 'refresh');
}

	public function followups($id = NULL) 
	{
		$data=[];
		$data['id']=$this->uri->segment('3');
		
		$data['leads_data'] = $this->Leads_model->getById($id);
		$data['followups'] = $this->Leads_model->getFollowUps($id);
		$data['lead_title'] = $data['leads_data']['lead_title'];
		//$data['categories'] = $this->Leads_model->getCategories();
		//echo var_dump($data['students']);
		// print_r($data['leads_data']['lead_title']);exit;
		$this->template->load('template','leads/lead_followups',$data);
	}

	public function importdata()
	{	

		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$data['auth_id']=$this->session->userdata['logged_in']['auth_id'];
		if ($this->input->post('submit')) 
		{
			$login_id=$this->session->userdata['logged_in']['id'];
				// echo "<pre>";
				// print_r($_FILES);
				$path = './uploads/';
				$config['upload_path'] = $path;
				$config['allowed_types'] = '*';
				$config['remove_spaces'] = TRUE;

				//print_r($config);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);            
				if (!$this->upload->do_upload('uploadFile')) {
					$error = array('error' => $this->upload->display_errors());
					//($error);exit;
				} else {
					$data = array('upload_data' => $this->upload->data());
					// echo"<pre>";print_r($data);exit;
				}
			// echo "hy";exit;
			if(empty($error))
			{
				if (!empty($data['upload_data']['file_name'])) {
				$import_xls_file = $data['upload_data']['file_name'];
				} else {
				$import_xls_file = 0;
				}
				$inputFileName = $path . $import_xls_file;
				try {
				$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
				$objReader = PHPExcel_IOFactory::createReader($inputFileType);
				$objPHPExcel = $objReader->load($inputFileName);
				$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
				// sizeof($allDataInSheet);exit;

				
				

				$flag = true;
				$i=0;
				foreach ($allDataInSheet as $value) 
				{
					if($flag){
					$flag =false;
					continue;
					}
					
					// echo"<pre>";print_r($value);exit;
				    //$data['lead_code_view']=$rs_id_code;

					
					if(!empty($value['B'])){
						
						$inserdata[$i]['date'] = $value['A'];
						$inserdata[$i]['category_name'] = $value['B'];
						$inserdata[$i]['lead_title'] = $value['C'];
						$inserdata[$i]['contact_person'] = $value['D'];
						$inserdata[$i]['email'] = $value['E'];
						$inserdata[$i]['country'] = $value['F'];
						$inserdata[$i]['mobile'] = $value['G'];
						$inserdata[$i]['city'] = $value['H'];
						$inserdata[$i]['lead_source'] = $value['I'];
						$inserdata[$i]['work_description'] = $value['J'];
						
						$i++;
					}
								//MSg API
									// Account details
						// $username = 'Arushi Goyal';
						// $apiKey = '8210F-832FC';
						// $apiRequest = 'Text';
						// // Message details
						// $numbers = $value['G']; // Multiple numbers separated by comma
						// $sender = 'NIRMAD';
						// $message = 'Your Lead is Generated';
						// $templateid = "1207162399760459990";
						// // Route details
						// $apiRoute = 'TRANS';
						// $format='JSON';


						
						// // Prepare data for POST request
						// $dataapi = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&sender='.$sender."&TemplateID=".$templateid."&message=".$message."&format".$format;
						// // print_r($dataapi);exit;
						// // Send the GET request with cURL
						// $url = "http://123.108.46.13/sms-panel/api/http/index.php?".$dataapi;
						// $url = preg_replace("/ /", "%20", $url);
						// $response = file_get_contents($url);
						// // Process your response here
						// // print_r($response);exit;
						// echo $response;

					
				}    
			         
				$result = $this->Leads_model->saverecords($inserdata); 
			
				if ($result == TRUE)
				{
					
					$this->session->set_flashdata('success', 'Imported successfully !');
					redirect('/Leads/index/', 'refresh');
				}else{
					
					$this->session->set_flashdata('failed', 'Import Failed !');
					redirect('/Leads/index/', 'refresh');
				}             
				} catch (Exception $e) {
				die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				. '": ' .$e->getMessage());
				}
			}
				else{
					echo $error['error'];
				}
		}
		$data['title'] = ' MO Website Leads Data';
		$this->template->load('template','/leads/leads_view',$data);
	}

	// public function importdata(){
	// 	if(isset($_POST["submit"]))
	// 	{
	// 		$file = $_FILES['file']['tmp_name'];
	// 		// print_r($file);exit;
	// 		$handle = fopen($file, "r");
	// 		//print_r($handle);exit;
	// 		$c = 0;//
	// 		while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
	// 		{	
	// 			 print_r($filesop);exit;

	// 			$date = $filesop[0];
	// 			$name = $filesop[1];
	// 			$work_description = $filesop[2];
	// 			$company_name = $filesop[3];
	// 			$mobile = $filesop[4];
	// 			$email = $filesop[5];
	// 			$website = $filesop[6];
	// 			if($c<>0){		

	// 			$data['login_id']=$this->session->userdata['logged_in']['id'];
	// 			$data = array(
	// 			'date' => date('Y-m-d',strtotime($date)),	
	// 			'name' => $name,
	// 			'work_description' => $work_description,
	// 			'company_name' => $company_name,
	// 			'mobile' => $mobile,
	// 			'email' => $email,
	// 			'website' => $website,
	// 			'created_by' => $data['login_id'],
	// 			'action' =>'',				
	// 			'status' =>'',				
	// 			);
	// 				$result = $this->Leads_model->saverecords($data);


	// 				// 		/* SKIP THE FIRST ROW */
	// 				// $this->Leads_model->saverecords($fname,$lname);
	// 			}
	// 			$c = $c + 1;
	// 		}
	// 		echo "sucessfully import data !";
				
	// 	}
				
	// }
	
	public function add_followup() {
		$this->form_validation->set_rules('lead_id', 'lead_id', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
				$this->add();
			} else {
				$this->load->view('login_form');
			}
		}
		else 
		{			
			$data['login_id']  = $this->session->userdata['logged_in']['id'];
			$lead_id = $this->input->post('lead_id');
			// print_r($_FILES['photo']['name']);exit;
			if(!empty($_FILES['photo']['name'])){
				$config['upload_path']          = './uploads/lead_follow_up/';
				$config['allowed_types']        = '*';
				$config['max_size']             = '';
				$config['max_width']            = '';
				$config['max_height']           = '';
				$config['overwrite']            = TRUE;
				$this->load->library('upload', $config);
				// $resulttt = $this->upload->do_upload('photo');
				// print_r($resulttt);exit;
				if($this->upload->do_upload('photo') == 1) {
						$data = array(
						'lead_id'      => $this->input->post('lead_id'),
						'answer'       => $this->input->post('answer'),
						'file_path'    => $this->upload->data()['file_name'],
						'followup_by'  => $data['login_id']
					);	
					$result = $this->Leads_model->insertFollowup($data);
					if ($result == TRUE) {
						$this->session->set_flashdata('success', 'Follow Up Added Successfully !');
						redirect('/Leads/followups/'.$lead_id, 'refresh');
						//$this->fetchSuppliers();
					} else {
						$this->session->set_flashdata('failed', 'Already Exists , Follow Up Not Inserted !');
						redirect('/Leads/followups/'.$lead_id, 'refresh');
					}
					// $this->session->set_flashdata('failed', 'Document upload error!');
					// redirect('/Leads/followups/'.$lead_id, 'refresh');
					}
				} 
			else {

				$data = array(
						'lead_id'      => $this->input->post('lead_id'),
						'answer'       => $this->input->post('answer'),
						'file_path'    => '',
						'followup_by'  => $data['login_id']
					);	

				
				$result = $this->Leads_model->insertFollowup($data);
				if ($result == TRUE) {
					$this->session->set_flashdata('success', 'Follow Up Added Successfully !');
					redirect('/Leads/followups/'.$lead_id, 'refresh');
					//$this->fetchSuppliers();
				} else {
					$this->session->set_flashdata('failed', 'Already Exists , Follow Up Not Inserted !');
					redirect('/Leads/followups/'.$lead_id, 'refresh');
				}
			}
		} 
	}

	public function add($id=NULL) 
	{
		$data = array();
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];

		$data['page_title'] = ' Upload Lead File Here';
		$data['categories'] = $this->Leads_model->getCategories();
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
	        $this->template->load('layout/template','Lead Module/Lead Generation/lead-create-edit',$data);

		} else {
			$data['page_title'] = ' Create New Lead';
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

		    $this->template->load('layout/template','Lead Module/Lead Generation/lead-create-edit',$data);
		}
	}
	
	public function edit($id = NULL) 
	{
			$data = array();
			$result = $this->Leads_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['item_name']) && $result['item_name']) :
	            $data['item_name'] = $result['item_name'];
	       else:
	            $data['item_name'] = '';
	        endif;
	      
	     
	        if (isset($result['category_name']) && $result['category_name']) :
	            $data['category_name'] = $result['category_name'];
	       else:
	            $data['category_name'] = '';
	        endif;
	      

			$data['title'] = ' Update Lead';
			$data['categories'] = $this->Leads_model->getCategories();
		$data['countrylist'] = $this->Leads_model->getCountry();

		
		
			$this->template->load('template','item_master',$data);
	}
	public function edit_worshop($id = NULL) 
	{
				$data = array(
					'booking_status'=>$this->input->post('booking_status'),
					);
  	 
  	 	$result =$this->Leads_model->EditWorkshopStatus($id,$data);
  	 	if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Workshop Status Updated Successfully !');
// 			echo"$result";exit;
			redirect('/Leads/worshop_leads/'.$lead_id, 'refresh');
			//$this->fetchSuppliers();
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Leads/worshop_leads/', 'refresh');
		}
	}
	public function add_new_item() {
		
		$this->form_validation->set_rules('title', 'title Name', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
				$this->add();
			//$this->load->view('admin_page');
			} else {
				$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			$data['login_id']=$this->session->userdata['logged_in']['id'];
			$number=$this->input->post('mobile');
			// // print_r($number);exit;
			// $data = array(
			// 	'category_name'         => $this->input->post('category_name'),
			// 	'lead_code'             => $this->input->post('lead_code'),
			// 	'lead_title'      => $this->input->post('title'),
			// 	'work_description'      => $this->input->post('description'),
			// 	'contact_person'        => $this->input->post('contact_person'),
			// 	'country'        		=> $this->input->post('country'),
			// 	'mobile'                => $this->input->post('mobile'),
			// 	'city'        			=> $this->input->post('city'),
			// 	'email'                 => $this->input->post('email'),
			// 	// 'company_name'       => $this->input->post('company_name'),
			// 	'date'                  => date('Y-m-d',strtotime($this->input->post('generation_date'))),
			// 	'lead_source'           => $this->input->post('lead_source'),
			// 	// 'website'               => $this->input->post('website'),
			// 	'country'               => $this->input->post('country'),
			// 	'lead_status'           => 'Pending',
			// 	'created_by'            => $data['login_id']
			// );
			$i=0;
			
			$inserdata[$i]['date'] = date('Y-m-d',strtotime($this->input->post('generation_date')));
			$inserdata[$i]['category_name'] = $this->input->post('category_name');
			$inserdata[$i]['lead_title'] =  $this->input->post('title');
			$inserdata[$i]['contact_person'] =$this->input->post('contact_person');
			$inserdata[$i]['email'] = $this->input->post('email');
			$inserdata[$i]['country'] =  $this->input->post('country');
			$inserdata[$i]['mobile'] = $this->input->post('mobile');
			$inserdata[$i]['city'] =$this->input->post('city');
			$inserdata[$i]['lead_source'] = $this->input->post('lead_source');
			$inserdata[$i]['work_description'] = $this->input->post('description');

		       
			$result = $this->Leads_model->saverecords($inserdata); 
			
			if ($result == TRUE)
			{
				
				$this->session->set_flashdata('success', 'Lead created successfully !');
				redirect('/Leads/index/', 'refresh');
			}else{
				
				$this->session->set_flashdata('failed', 'operation Failed !');
				redirect('/Leads/index/', 'refresh');
			}    
			// //MSg API
			// 			// Account details
			// $username = 'Arushi Goyal';
			// $apiKey = '8210F-832FC';
			// $apiRequest = 'Text';
			// // Message details
			// $numbers = $number; // Multiple numbers separated by comma
			// $sender = 'NIRMAD';
			// $message = 'Your Lead is Generated';
			// $templateid = "1207162399760459990";
			// // Route details
			// $apiRoute = 'TRANS';
			// $format='JSON';


			
			// // Prepare data for POST request
			// $dataapi = 'username='.$username.'&apikey='.$apiKey.'&apirequest='.$apiRequest.'&route='.$apiRoute.'&mobile='.$numbers.'&sender='.$sender."&TemplateID=".$templateid."&message=".$message."&format".$format;
			// // print_r($dataapi);exit;
			// // Send the GET request with cURL
			// $url = "http://123.108.46.13/sms-panel/api/http/index.php?".$dataapi;
			// $url = preg_replace("/ /", "%20", $url);
			// $response = file_get_contents($url);
			// // Process your response here
			// // print_r($response);exit;
			// echo $response;


	}
			
		
		}
	public function assignto(){
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$ids=$this->input->post('all_selected_ids');
		if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $lead_id) {
	  	 			$data['login_id']=$this->session->userdata['logged_in']['id'];
	  	 			$data = array(
								'assign_to' => $this->input->post('employee_id'),
								'assign_date' => date('Y-m-d H:i:s'),	
								'assign_by' => $data['login_id']			
								);
	  	 			$result = $this->Leads_model->lead_update($data,$lead_id);
					$getbyid=$this->Leads_model->getassignleadByID($lead_id);
					// $followup_date=$getbyid['followupdate'];
					$data1=array(
						'lead_id'=>$getbyid['id'],
						'lead_code'=>$getbyid['lead_code'],
						'category_name'=>$getbyid['category_name'],
						'date'=>date('Y-m-d'),
						'lead_title'=>$getbyid['lead_title'],
						'work_description'=>$getbyid['work_description'],
						'contact_person'=>$getbyid['contact_person'],
						'country'=>$getbyid['country'],
						'mobile'=>$getbyid['mobile'],
						'city'=>$getbyid['city'],
						'email'=>$getbyid['email'],
						'assign_to'=>$getbyid['assign_to'],
						'assign_by'=>$getbyid['assign_by'],
						'assign_date'=>$getbyid['assign_date'],
						'lead_status'=>'Approve but no action',
						'created_by'=>$getbyid['created_by'],
						
					);
					$marketing=$this->Leads_model->marketing_insert($data1);
	  	 		}
			
  	 			$this->session->set_flashdata('success', 'All Leads Assign Successfully!');
  	 			redirect('/Leads/Assignleadview', 'refresh');
		}	
		else{
				$data['login_id']=$this->session->userdata['logged_in']['id'];
				$data = array(
				'assign_to' => $this->input->post('employee_id'),	
				'assign_date' => date('Y-m-d H:i:s'),	
				'assign_by' => $data['login_id']			
				);
				$lead=$this->input->post('lead_id');
				// print_r($data);exit;
				$result = $this->Leads_model->lead_update($data,$lead);
				// echo $result;exit;
				if ($result == TRUE) {
					$getbyid=$this->Leads_model->getassignleadByID($data['login_id']);
					// $followup_date=$getbyid['followupdate'];
					$data1=array(
						'lead_id'=>$getbyid['id'],
						'lead_code'=>$getbyid['lead_code'],
						'category_name'=>$getbyid['category_name'],
						'date'=>date('Y-m-d'),
						'lead_title'=>$getbyid['lead_title'],
						'work_description'=>$getbyid['work_description'],
						'contact_person'=>$getbyid['contact_person'],
						'country'=>$getbyid['country'],
						'mobile'=>$getbyid['mobile'],
						'city'=>$getbyid['city'],
						'email'=>$getbyid['email'],
						'assign_to'=>$getbyid['assign_to'],
						'assign_by'=>$getbyid['assign_by'],
						'assign_date'=>$getbyid['assign_date'],
						'lead_status'=>'Approve but no action',
						'created_by'=>$getbyid['created_by'],
						
					);
					// print_r($data1);exit;
					$marketing=$this->Leads_model->marketing_insert($data1);
				$this->session->set_flashdata('success', 'Lead Assign Successfully !');
				redirect('/Leads/Assignleadview', 'refresh');
				//$this->fetchSuppliers();
				} else {
				$this->session->set_flashdata('failed', 'No Changes in Lead !');
				redirect('/Leads/Assignleadview', 'refresh');
				}
		
			}
		}
		public function approveall(){
			if($this->input->get()){
				$bulk_action = $this->input->get('approveaction');
				$sub_chk = $this->input->get('sub_chk');
				// print_r($bulk_action);
				// print_r($sub_chk);exit;
				$data=[];
				if($bulk_action == 'Approved'){
					foreach($sub_chk as $id){
						$this->db->set('lead_status','Approved');
						$this->db->where('id', $id);
						$this->db->update('lead_csv', $data);
					}
					$this->session->set_flashdata('success', 'Lead send to Approve Successfully');
					redirect('/Leads/index', 'refresh');
				}
				 else if($bulk_action == 'Rejected'){
					foreach($sub_chk as $id){
						$this->db->set('lead_status','Rejected');
						$this->db->where('id', $id);
						$this->db->update('lead_csv', $data);
					}
					$this->session->set_flashdata('success', 'Lead Rejected Successfully');
					redirect('/Leads/index', 'refresh');
				}
				else if($bulk_action == 'delete_all'){
					// print_r($sub_chk);exit;
					foreach($sub_chk as $id){
						$this->db->where('id', $id);
						$this->db->delete('lead_csv');
						
			
					}
					$this->session->set_flashdata('success','lead Deleted Successfully');
						redirect('/Leads/index', 'refresh');
			}
		}
	}
		public function Assignleadview(){
			$data['role_id']=$this->session->userdata['logged_in']['role_id'];
			$data['title']=' All Assign Lead';
			$data['leads'] = $this->Leads_model->assignleadlist();
			$data['employees'] = $this->Leads_model->getEmployeeDropdown();
			$data['categories'] = $this->Leads_model->getLeadsCategories();
			//  echo "<pre>";print_r($data['leads']);exit;
			$this->template->load('layout/template','Lead Module/Lead Generation/assignLead',$data);
		}
		// public function reminder($id){
		// 	$data['login_id']=$this->session->userdata['logged_in']['id'];
		// 	$data = array(
		// 		'lead_id'=>$this->input->post('lead_id'),
		// 		'reminder_title'=>$this->input->post('reminder_title'),
		// 		'reminder_date' => date('Y-m-d',strtotime($this->input->post('reminder_date'))),
					
		// 		'reminder_time' => $this->input->post('reminder_time'),
		// 		'employee_id'=>	$data['login_id']
					
		// 		);
		// 		// $lead=$this->input->post('lead_id');
		// 		//print_r($item_id);exit;
		// 		$result = $this->Leads_model->reminderinsert($data);
				
		// 		//echo $result;exit;
		// 		if ($result == TRUE) {
		// 		$this->session->set_flashdata('success', 'reminder set Successfully !');
		// 		redirect('/Leads/index', 'refresh');
		// 		//$this->fetchSuppliers();
		// 		} else {
		// 		$this->session->set_flashdata('failed', 'reminder is not change !');
		// 		redirect('/Leads/index', 'refresh');
		// 		}
			
		// 	}

			public function reminderedit($id){
				$data['login_id']=$this->session->userdata['logged_in']['id'];
				$data = array(
					'lead_id'=>$this->input->post('lead_id'),
				
					'reminder_date' => date('Y-m-d',strtotime($this->input->post('reminder_date'))),
						
					'reminder_time' => $this->input->post('reminder_time'),
					
						
					);

					// $lead=$this->input->post('lead_id');
					//print_r($item_id);exit;
					$lead_id=$this->input->post('lead_id');
					$result = $this->Leads_model->reminder_update($data,$lead_id);
					
					//echo $result;exit;
					if ($result == TRUE) {
					$this->session->set_flashdata('success', 'reminder edit Successfully !');
					redirect('/User_authentication/admin_dashboard', 'refresh');
					//$this->fetchSuppliers();
					} else {
					$this->session->set_flashdata('failed', 'reminder is not change !');
					redirect('/User_authentication/admin_dashboard', 'refresh');
					}
				
				}
	public function complete($id){
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		// echo"<pre>";print_r($_POST);exit;
		$data = array(
			'status' =>'Completed',
		);
		
		// echo"<pre>";print_r($lead);exit;

		$result = $this->Leads_model->reminder_update($data,$id);
		
		
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Reminder Completed Successfully !');
			redirect('User_authentication/admin_dashboard','refresh');

			
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Reminder !');
			redirect('User_authentication/admin_dashboard','refresh');

			}
	}		


	public function close($id){
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		// echo"<pre>";print_r($_POST);exit;
		$data = array(
			'status' =>'Closed',
		);
		
		// echo"<pre>";print_r($lead);exit;

		$result = $this->Leads_model->reminder_update($data,$id);
		
		
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Reminder CLosed Successfully !');
			redirect('User_authentication/admin_dashboard','refresh');

			
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Reminder !');
			redirect('User_authentication/admin_dashboard','refresh');

			}
	}		
		

	public function edititem($id) {
		// echo"<pre>";print_r($_POST);exit;
		$this->form_validation->set_rules('title', 'title Name', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
			$this->add();
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_add');
		}
		else 
		{
			$data['login_id']=$this->session->userdata['logged_in']['id'];
			$data = array(
			'category_name' => $this->input->post('category_name'),	
			'lead_code' => $this->input->post('lead_code'),
			'lead_title' => $this->input->post('title'),
			'work_description' => $this->input->post('description'),
			'contact_person' => $this->input->post('contact_person'),
			
			
			'mobile' => $this->input->post('mobile'),	
			'city'        	 => $this->input->post('city'),
			'email' => $this->input->post('email'),	
			// 'company_name' => $this->input->post('company_name'),	
			'date' => date('Y-m-d',strtotime($this->input->post('generation_date'))),			
			'lead_source' => $this->input->post('lead_source'),			
					
		
			'lead_status' => $this->input->post('lead_status'),	
			'edited_by' => $data['login_id']			
			);
			$lead=$this->input->post('old_lead_id');
			// echo"<pre>";print_r($data);exit;
			$result = $this->Leads_model->lead_update($data,$lead);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Lead Updated Successfully !');
			redirect('/Leads/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Lead !');
			redirect('/Leads/index', 'refresh');
			}
		} 
	}

	// public function deleteItem($id= null){
  	//  	$id = $this->uri->segment('3');
  	//  	$result =$this->Leads_model->deleteItem($id);
  	//  	if ($result == TRUE) {
	// 		$this->session->set_flashdata('success', 'Item deleted Successfully !');
	// 		redirect('/Leads/index', 'refresh');
	// 		//$this->fetchSuppliers();
	// 	} else {
	// 		$this->session->set_flashdata('failed', 'Operation Failed!');
	// 		redirect('/Leads/index', 'refresh');
	// 	}
  	// }
	  public function deleteItem($ids=null){
		
		$ids=$this->input->post('all_selected_ids');
		// print_r($ids);exit;
		if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $lead_id) {
	  	 		
	  	 			
	  	 			$result = $this->Leads_model->deleteItem($lead_id);
					
				}
				if ($result == TRUE) {
  	 			$this->session->set_flashdata('success', ' Leads deleted Successfully!');
  	 			redirect('/Leads/index', 'refresh');
		}	
		else{
				
				$lead=$this->input->post('lead_id');
				// print_r($data);exit;
				$result = $this->Leads_model->deleteIteme($lead);
				// echo $result;exit;
				if ($result == TRUE) {
					
				$this->session->set_flashdata('success', 'Lead Assign Successfully !');
				redirect('/Leads/index', 'refresh');
				//$this->fetchSuppliers();
				} else {
				$this->session->set_flashdata('failed', 'No Changes in Lead !');
				redirect('/Leads/index', 'refresh');
				}
		
			}
		}
	}
  	public function deletefollowup($id= null){
  	 	$id = $this->uri->segment('3');
  	 	$lead_id=$this->input->post('lead_id');
  	 	$result =$this->Leads_model->deletefollowup($id);
  	 	if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Follow Up deleted Successfully !');
			redirect('/Leads/followups/'.$lead_id, 'refresh');
			//$this->fetchSuppliers();
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Leads/index/'.$lead_id, 'refresh');
		}
  	}

  	public function getProductsByCategory($id=NULL){
    	$data = array();
    	$data['products']=$this->Leads_model->getProductsByCategory($id);
    	echo json_encode($this->load->view('productbycategory',$data));
    }

	public function view($lead_code=NULL){
		
		$data = array();
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
		$data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
		$data['page_title'] = ' Lead Details ';
		$data['Sourcedetails']=$this->Leads_model->getCodedetails($lead_code);
		// echo"<pre>";print_r(	$data['Sourcedetails']);exit;
		$this->template->load('template','leads/lead_codeview',$data);
	}
}

?>
