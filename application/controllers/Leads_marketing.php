<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to start session in order to access it through CI

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Class Leads_marketing extends CI_Controller {

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
		$this->load->model('Leads_marketing_model');
	}

	public function index() 
	{
		$data['title'] = ' Lead Marketing Data';
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data['department_id']=$this->session->userdata['logged_in']['department_id'];
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		
	
		$conditions=[];
		if($this->input->get()) {
					
		 	$conditions['category_name']  = $this->input->get('category_name');
            $conditions['lead_code'] = $this->input->get('lead_code');
            $conditions['lead_status'] = $this->input->get('lead_status');
			$conditions['employee_id'] 	 = $this->input->get('employee_id');
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
			
			
			$data['filtered_value']=$conditions;
			$data['leads'] = $this->Leads_marketing_model->LeadListCSV($conditions);
			// $data['leads_id'] = $this->Leads_marketing_model->duplicate();
			// echo"<pre>";print_r($data['filtered_value']);exit;
		}  else {
			$data['login_id']=$this->session->userdata['logged_in']['id'];
			// $data['filtered_value']='';
			$conditions['category_name']='';
			$conditions['lead_code']='';
			$conditions['lead_status']='';
			$conditions['upto_date']='';
			$conditions['from_date']='';
			$conditions['employee_id'] 	= "";
		
			$data['filtered_value']=$conditions;
			
			
		 	$data['leads'] = $this->Leads_marketing_model->LeadListCSV($data['login_id']);
			//  echo "<pre>";print_r($data['login_id']);exit;
		}

		// //echo var_dump($data['students']);
		// echo "<pre>";print_r($data['leads']);exit;
		$data['employees'] = $this->Leads_marketing_model->getEmployeeDropdown();
		$data['categories'] = $this->Leads_marketing_model->getLeadsCategories();
		$this->template->load('template','lead_marketing/marketing_view',$data);
	}

	public function Nofollowupsview(){
		$data['title'] = ' No Followup Data';
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data['department_id']=$this->session->userdata['logged_in']['department_id'];
		$data['role_id']=$this->session->userdata['logged_in']['role_id'];
		
		$data['leads'] = $this->Leads_marketing_model->nofollowuplist($data['login_id']);
		$this->template->load('template','lead_marketing/nofollowup_view',$data);
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
		
		$data['categories'] = $this->Leads_marketing_model->getLeadsCategories();
		$this->template->load('template','leads/mo_lead_view',$data);
	}

	public function followups($id = NULL) 
	{
		$data=[];
		$data['id']=$this->uri->segment('3');
		
		$data['leads_data'] = $this->Leads_marketing_model->getById($id);
		$data['followups'] = $this->Leads_marketing_model->getFollowUps($id);
		$data['lead_title'] = $data['leads_data']['lead_title'];
		//$data['categories'] = $this->Leads_model->getCategories();
		//echo var_dump($data['students']);
		// print_r($data['leads_data']['lead_title']);exit;
		if(!empty($id))
		{
			
			$result = $this->Leads_marketing_model->getById($id);

			
	        if (isset($result['lead_status'])) :
	            $data['lead_status'] = $result['lead_status'];
	        else:
	            $data['lead_status'] = '';
	        endif;
	      

		} 
		$this->template->load('template','lead_marketing/marketing_followups',$data);
	}
	public function reminder($id){
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data = array(
			'lead_id'=>$this->input->post('lead_id'),
			'reminder_title'=>$this->input->post('reminder_title'),
			'reminder_date' => date('Y-m-d',strtotime($this->input->post('reminder_date'))),
				
			'reminder_time' => $this->input->post('reminder_time'),
			'employee_id'=>	$data['login_id']
				
			);
			// $lead=$this->input->post('lead_id');
			// echo "<pre>";print_r($data);exit;
			$result = $this->Leads_marketing_model->reminderinsert($data);
			
			// echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'reminder set Successfully !');
			redirect('/lead_marketing/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'reminder is not change !');
			redirect('/lead_marketing/index', 'refresh');
			}
		
		}
	public function importdata()
	{	

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
					//print_r($data);exit;
				}
			//echo "hy";exit;
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
				//sizeof($allDataInSheet);exit;

				
				

				$flag = true;
				$i=0;
				foreach ($allDataInSheet as $value) 
				{
					if($flag){
					$flag =false;
					continue;
					}
					
					
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

					
				}    
				// echo "<pre>";
				// print_r($inserdata);exit;           
				$result = $this->Leads_marketing_model->saverecords($inserdata);   
				if($result)
				{
					// echo "Imported successfully";
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
		// print_r($_POST);exit;
		$data['login_id']  = $this->session->userdata['logged_in']['id'];
		$login_id = $this->session->userdata['logged_in']['id'];
		$lead_status=$this->input->post('lead_status');
		$old_lead_status=$this->input->post('old_lead_status');
		// print_r($lead_status);exit;
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
						'followup_by'  => $data['login_id'],
						'followup_time'=>date('Y-m-d h:i:s'),
						'date'=>date('Y-m-d h:i:s'),
					);	
					$result = $this->Leads_marketing_model->insertFollowup($data);
					$getresult= $this->Leads_marketing_model->getfollowup($lead_id);
					// print_r($getresult);exit;
					$todaydate= date('Y-m-d');
					$followdate=$getresult['date'];
					
					$diff=abs(strtotime($todaydate)-strtotime($followdate));
						// echo "<pre>";print_r($followdate);exit;
						// $day=$diff->format("%d");

					if ($result == TRUE) {

						
						$larray= array(
						'lead_status'=>$lead_status,
						'reject_reason'=>$this->input->post('reject_reason'),
						'rejected_reason_datetime'=>date('Y-m-d H:i:s'),
							);
							
						$this->db->where(['id'=>$this->input->post('lead_id')]);
						$this->db->update('lead_marketing', $larray);
						
						$leadhsistory= array(
							'lead_id'=>$this->input->post('lead_id'),
							'date'=> date('Y-m-d'),
							'lead_status'=>'followup_add',
							'created_on'=>date('Y-m-d h:i:s'),
							'emp_id'=> $login_id,
			
							);
						// 	print_r($leadhsistory);exit;	
						$this->db->insert('lead_history', $leadhsistory);	
					
					
						$ldate=array(
							'last_update'=>date('y-m-d H:i:s'),
						);
						// echo print_r($ldate);exit;
						$this->db->where(['id'=>$this->input->post('lead_id')]);
						$this->db->update('lead_marketing', $ldate);
							
						
						$this->session->set_flashdata('success', 'Follow Up Added Successfully !');
						redirect('/Leads_marketing/index/'.$lead_id, 'refresh');
						//$this->fetchSuppliers();
					} else {
						$this->session->set_flashdata('failed', 'Already Exists , Follow Up Not Inserted !');
						redirect('/Leads_marketing/followups/'.$lead_id, 'refresh');
					}
					// $this->session->set_flashdata('failed', 'Document upload error!');
					// redirect('/Leads/followups/'.$lead_id, 'refresh');
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
		$data['categories'] = $this->Leads_marketing_model->getCategories();
		// $data['countrylist'] = $this->Leads_marketing_model->getCountry();
		// $data['target'] = $this->Leads_model->getTarget($login_id);
		// echo "<pre>"; print_r($data['country']);exit;
		// $data['countries'] = $this->Leads_model->getCountries();

		if(!empty($id))
		{
			$data['page_title'] = ' Update Lead';
			$result = $this->Leads_marketing_model->getById($id);

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
	        $this->template->load('template','lead_marketing/marketing_update',$data);

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
			$data['lead_count'] = $this->Leads_marketing_model->getLeadcsvCode();
			$data['countrylist'] = $this->Leads_marketing_model->getCountry();


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

		    $this->template->load('template','lead_marketing/marketing_create',$data);
		}
	}
	
	public function edititem($id) {
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
			'country'        => $this->input->post('country'),
			
			'mobile' => $this->input->post('mobile'),	
			'city'        	 => $this->input->post('city'),
			'email' => $this->input->post('email'),	
			// 'company_name' => $this->input->post('company_name'),	
			'date' => date('Y-m-d',strtotime($this->input->post('generation_date'))),			
			'lead_source' => $this->input->post('lead_source'),			
					
			'country' => $this->input->post('country'),
			'lead_status' => $this->input->post('lead_status'),
			'edited_by' => $data['login_id'],		
			);
			$lead=$this->input->post('old_lead_id');
			//print_r($item_id);exit;
			$result = $this->Leads_model->lead_update($data,$lead);
			//echo $result;exit;

			
			if ($result == TRUE) {
				
			$this->session->set_flashdata('success', 'Lead Updated Successfully !');
			redirect('/Leads_marketing/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Lead !');
			redirect('/Leads_marketing/index', 'refresh');
			}
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
			$data['categories'] = $this->Leads_marketing_model->getCategories();
		// $data['countrylist'] = $this->Leads_marketing_model->getCountry();

		
		
			$this->template->load('template','item_master',$data);
	}

	// public function add_new_item() {
	// 	$login_id=$this->session->userdata['logged_in']['id'];
	// 	$this->form_validation->set_rules('title', 'title Name', 'required');
		
			
	// 		if($result == true){
			
			

	// 			$login_id=$this->session->userdata['logged_in']['id'];
	// 			$target = $this->Leads_marketing_model->getTarget($login_id);
	// 			$date = date('Y-m-d',strtotime($this->input->post('generation_date')));
	// 			$count = $this->Leads_marketing_model->checkRecors($login_id,$date);	
	// 			if($count == 0){
	// 					$target = $this->Leads_marketing_model->getTarget($login_id);
	// 					// echo print_r($target);exit;
	// 					$data1 = array(
	// 						'employee_id'=>$login_id,
	// 						'date' =>date('Y-m-d',strtotime($this->input->post('generation_date'))),
	// 						'month' =>date('m'),
	// 						'target' => $target,
	// 						'lead_count' =>1,

	// 					);
	// 					$this->db->insert('lead_count', $data1);
	// 				}
	// 			else{
	// 				$date1= date('Y-m-d',strtotime($this->input->post('generation_date')));
	// 					$old_count = $this->Leads_marketing_model->getLeadsTotalCount($login_id,$date1);
	// 					$data1 = array(
	// 						'lead_count '=>$old_count+1
	// 					);
	// 					$this->db->where(['employee_id'=>$login_id,'date'=>$date1]);
	// 					$this->db->update('lead_count', $data1);
	// 				}
	// 				$this->session->set_flashdata('success', 'Lead Added Successfully !');
	// 				redirect('/Leads/index', 'refresh');

	// 		}
	// 	 else { 
	// 		$this->session->set_flashdata('failed', 'Already Exists , Lead Not Inserted !');
	// 		redirect('/Leads/index', 'refresh');
	// 	}
	// }
			
			// $result1 = $this->Leads_model->insertLeadCount($data1);
		// 		$this->session->set_flashdata('success', 'Lead Added Successfully !');
		// 		redirect('/Leads/index', 'refresh');
		// 		//$this->fetchSuppliers();
		// 	} else {
		// 		$this->session->set_flashdata('failed', 'Already Exists , Lead Not Inserted !');
		// 		redirect('/Leads/index', 'refresh');
		// 	}
		// } 
	
	public function assignto($id){
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data = array(
			'assign_to' => $this->input->post('employee_id'),	
				
			'assign_by' => $data['login_id'],	
			
			'assign_date' => date('Y-m-d h:i:s'),	
				
			'assign_by' => $data['login_id']			
			);
			$lead=$this->input->post('lead_id');
			//print_r($item_id);exit;
			$result = $this->Leads_marketing_model->lead_update($data,$lead);
			//echo $result;exit;
			if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Lead Assign Successfully !');
			redirect('/Leads/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Lead !');
			redirect('/Leads/index', 'refresh');
			}
		
		}
	

	public function changestatus($id) {
		// print_r($_POST);exit;
		$login_id=$this->session->userdata['logged_in']['id'];
			$data['login_id']=$this->session->userdata['logged_in']['id'];
			$data = array(
			'lead_status' => $this->input->post('lead_status')
			);
			$lead=$this->input->post('old_lead_id');
		
			
			$result = $this->Leads_marketing_model->lead_update($data,$lead);
			//echo $result;exit;
			if ($result == TRUE) {
				if( $this->input->post('lead_status')=='Approved'){
					$approve= array(
						'approve_date'=>date('Y-m-d'),
					
							);
						$this->db->where(['id'=>$lead]);
						$this->db->update('lead_marketing', $approve);
				}
				else if( $this->input->post('lead_status')=='Rejected'){
					$approve= array(
						'reject_date'=>date('Y-m-d'),
							);
						$this->db->where(['id'=>$lead]);
						$this->db->update('lead_marketing', $approve);
				}
				$leadhsistory= array(
					'lead_id'=>$lead,
					'date'=> date('Y-m-d'),
					'lead_status'=>$this->input->post('lead_status'),
					'created_on'=>date('Y-m-d h:i:s'),
					'emp_id'=> $login_id,
	
					);
					// echo"<pre>";print_r($leadhsistory);exit;
				$this->db->insert('lead_history', $leadhsistory);	
			
			$this->session->set_flashdata('success', 'Lead Updated Successfully !');
			redirect('/Leads_marketing/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'No Changes in Lead !');
			redirect('/Leads_marketing/index', 'refresh');
			}
		
	}

	public function deleteItem($id= null){
  	 	$id = $this->uri->segment('3');
  	 	$result =$this->Leads_marketing_model->deleteItem($id);
  	 	if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Item deleted Successfully !');
			redirect('/Leads/index', 'refresh');
			//$this->fetchSuppliers();
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Leads/index', 'refresh');
		}
  	}

  	public function deletefollowup($id= null){
  	 	$id = $this->uri->segment('3');
  	 	$lead_id=$this->input->post('lead_id');
  	 	$result =$this->Leads_marketing_model->deletefollowup($id);
  	 	if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Follow Up deleted Successfully !');
			redirect('/Leads_marketing/followups/'.$lead_id, 'refresh');
			//$this->fetchSuppliers();
		} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Leads_marketing/index/'.$lead_id, 'refresh');
		}
  	}

  	public function getProductsByCategory($id=NULL){
    	$data = array();
    	$data['products']=$this->Leads_marketing_model->getProductsByCategory($id);
    	echo json_encode($this->load->view('productbycategory',$data));
    }

	

	public function createXLS($id) {
		$fileName = 'marketing-'.date('d-m-Y').'.xlsx';
		// $conditions=[];
		// if($this->input->post()) {
		//  	$conditions['category_name'] = $this->input->post('category_name');
        //     $conditions['employee_id'] 	 = $this->input->post('employee_id');
        //     $conditions['leave_status']  = $this->input->post('leave_status');
            // if(!empty($this->input->post('upto_date'))) {
			// 	$conditions['upto_date'] = date('Y-m-d',strtotime($this->input->post('upto_date')));
			// } else {
			// 	$conditions['upto_date'] = "";
			// }
			// if(!empty($this->input->post('from_date'))) {
			// 	$conditions['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
			// } else {
			// 	$conditions['from_date'] = "";
			// }
			// $leaves = $this->Leave_model->LeaveListCSV($conditions);
		// } else {
		 	
		$leads_data = $this->Leads_marketing_model->getById($id);
		$followups = $this->Leads_marketing_model->getFollowUps($id);
		// }
		$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
       	$sheet->setCellValue('A1', 'Lead ID');
        $sheet->setCellValue('B1', 'Follow Up');
        $sheet->setCellValue('C1', 'Document');
        $sheet->setCellValue('D1', 'Follwup by');    
        $rows = 2;
        foreach ($followups as $val){
            $sheet->setCellValue('A' . $rows, $val['lead_id']);
            $sheet->setCellValue('B' . $rows, $val['answer']);
            $sheet->setCellValue('C' . $rows, $val['file_path']);
            $sheet->setCellValue('D' . $rows, $val['followup_by']);
            $rows++;
        }
        $writer = new Xlsx($spreadsheet);
		//echo "<pre>"; print_r($sheet); exit;
		$writer->save("uploads/Leaves/".$fileName);
		//header("Content-Type: application/vnd.ms-excel");
		$this->session->set_flashdata('success', 'Excel file added in leaves folder in uploads!');	
		redirect('/Leave/index', 'refresh');
    }

    // Create Excel Sheet : Leaves
    function createXLS_1() {
		//echo "<pre>"; print_r($_POST);
		
		$conditions=[];
		if($this->input->post()) {
		 	$conditions['category_name'] = $this->input->post('category_name');
            $conditions['employee_id'] 	 = $this->input->post('employee_id');
            $conditions['leave_status']  = $this->input->post('leave_status');
            if(!empty($this->input->post('upto_date'))) {
				$conditions['upto_date'] = date('Y-m-d',strtotime($this->input->post('upto_date')));
			} else {
				$conditions['upto_date'] = "";
			}
			if(!empty($this->input->post('from_date'))) {
				$conditions['from_date'] = date('Y-m-d',strtotime($this->input->post('from_date')));
			} else {
				$conditions['from_date'] = "";
			}
			$leaves = $this->Leave_model->LeaveListCSV($conditions);
		} else {
		 	$leaves = $this->Leave_model->LeaveListCSV();
		}
		
		//echo "<pre>"; print_r($leaves); exit;

        // create file name
        $fileName ='leaves-'.time().'.xlsx';  
        // load excel library
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();   
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getDefaultStyle()
            ->getBorders()
            ->getTop()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getDefaultStyle()
            ->getBorders()
            ->getBottom()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getDefaultStyle()
            ->getBorders()
            ->getLeft()
            ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getDefaultStyle()
            ->getBorders()
            ->getRight()
        	->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Employee');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Leave Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Leave Reason');
        // set Row
        $rowCount = 2;
        foreach ($leaves as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['employee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['leave_status']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['leave_type']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['leave_reason']);
            $rowCount++;
        }
        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Customer_Report.xls"');
        $objWriter->save('php://output');
        redirect('/Leave/index', 'refresh');
    }

}

?>
