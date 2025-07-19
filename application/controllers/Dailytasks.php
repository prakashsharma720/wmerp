
<?php

//session_start(); //we need to start session in order to access it through CI

Class Dailytasks extends MY_Controller {

  public function __construct() {
  parent::__construct();
  if(!$this->session->userdata['logged_in']['id']){
      redirect('user_authentication/index');
  }
/*require_once APPPATH.'third_party/PHPExcel.php';
$this->excel = new PHPExcel(); */

// Load form helper library
$this->load->helper('form');
$this->load->helper('security');

$this->load->helper('url');
// new security feature

// Load form validation library
$this->load->library('form_validation');


// Load session library
$this->load->library('session');

$this->load->library('template');

// Load database
$this->load->model('task_model');
$this->load->model('Leave_model');
}

// Show login page
public function add() {
  $this->template->load('layout/template','supplier_add');
  //$this->load->view('footer');
  }

  // public function fetchCategories(){
  //     $data['title'] = 'Lead Category Master';
  //     $data['categories'] = $this->master_model->categoriesList();
  //     //echo var_dump($data['students']);
  //     $this->template->load('template','category_master',$data);
  //   }
    public function projects($id = NULL) 
    {
      $data = array();
      $data['page_title'] = ' Daily Task Master';
      $result = $this->task_model->getByIdTask($id);
    
      if (isset($result['id']) && $result['id']) :
          $data['id'] = $result['id'];
        else:
          $data['id'] = '';
        endif; 
    
      if (isset($result['project_name'])) :
          $data['project_name'] = $result['project_name'];
         else:
          $data['project_name'] = '';
        endif;
  
        if (isset($result['start_date'])) :
          $data['start_date'] = $result['start_date'];
         else:
          $data['start_date'] = '';
        endif;
        if (isset($result['end_date'])) :
          $data['end_date'] = $result['end_date'];
         else:
          $data['end_date'] = '';
        endif;
        if (isset($result['status'])) :
          $data['project_status'] = $result['status'];
         else:
          $data['project_status'] = '';
        endif;
        if (isset($result['department_id'])) :
          $data['department_id'] = $result['department_id'];
         else:
          $data['department_id'] = '';
        endif;

        if (isset($result['description'])) :
          $data['description'] = $result['description'];
         else:
          $data['description'] = '';
        endif;
         if (isset($result['technology'])) :
          $data['technology'] = $result['technology'];
         else:
          $data['technology'] = '';
        endif;
  
      if (isset($result['flag'])) :
          $data['flag'] = $result['flag'];
         else:
          $data['flag'] = '';
        endif;
  
        $data['departments'] = $this->task_model->getDepartments();
      $data['projects'] = $this->task_model->projectList();
      // echo "<pre>"; print_r($data); exit;
      $this->template->load('layout/template','project_view',$data);
    }


    

   public function add_new_task() {
    
    $this->form_validation->set_rules('project_id', 'project Name', 'required');
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
      $data['login_id']=$this->session->userdata['logged_in']['id'];
      $data = array(
      'project_id' => $this->input->post('project_id'),
      'task_name' => $this->input->post('task_title'),
      'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
      'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
      'priority' => $this->input->post('priority'),
      'status' => $this->input->post('task_status'),
      'Assign_to' => $this->input->post('assignto'),
      'Assign_by' => $data['login_id']);


      $result = $this->task_model->insert('daily_tasks',$data);
        
      if ($result == TRUE) {
          
    
          $this->session->set_flashdata('success', 'Task Added Successfully !');
          redirect('/Dailytasks/tasks', 'refresh');
          } else {
          $this->session->set_flashdata('failed', 'Already exists project Could not added !');
          redirect('/Dailytasks/tasks', 'refresh');
          }
        } 
        }

        public function add_new_project() {
    
          $this->form_validation->set_rules('project_name', 'project Name', 'required');
          if ($this->form_validation->run() == FALSE) 
          {
            if(isset($this->session->userdata['logged_in'])){
            $this->projects();
            //$this->template->load('template','category_master');
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
            'project_name' => $this->input->post('project_name'),
            
            'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
            'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
            
            'status' => $this->input->post('project_status'),
            'department_id' => $this->input->post('department_id'),
            
            'description' => $this->input->post('description'),
            'technology' => $this->input->post('technology'));

            
      
            
            $result = $this->task_model->insert('projects',$data);
              
            if ($result == TRUE) {
                
          
                $this->session->set_flashdata('success', 'Project Added Successfully !');
                redirect('/Dailytasks/projects', 'refresh');
                } else {
                $this->session->set_flashdata('failed', 'Already exists project Could not added !');
                redirect('/Dailytasks/projects', 'refresh');
                }
              } 
              }
        

         public function editTask($id) {
          $this->form_validation->set_rules('project_id', 'Project Master', 'required');
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
            
            $login_id=$this->session->userdata['logged_in']['id'];
            
           
            $data = array(
            //'id' => $id,
            'project_id' => $this->input->post('project_id'),
            'task_name' => $this->input->post('task_title'),
            'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
            'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
            'priority' => $this->input->post('priority'),
            'status' => $this->input->post('status'),
            'Assign_to' => $this->input->post('Assign_to'),
            'Assign_by' =>$login_id);
            
            // echo "<pre>";print_r($_POST);exit;
            //'year' => date('Y',strtotime($this->input->post('holiday_date'))),
           
           
            $data1 = array(
              //'id' => $id,
              'project_id' => $this->input->post('project_id'),
              'task_name' => $this->input->post('task_title'),
              'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
              'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
              'priority' => $this->input->post('priority'),
              'status' => $this->input->post('status'),
              'assign_to_emp' => $this->input->post('assigntoemp'),
              'assign_by_tl' => $login_id);
              // echo "<pre>";print_r($_POST);exit;
              $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
              $data['department_id']=$this->session->userdata['logged_in']['department_id'];
              if($data['designation_id'] == '4'){

                $result = $this->task_model->task_edit($data,$id);

              }
              else{
                $result = $this->task_model->task_edit($data1,$id);
              }
            
           
            //echo $result;exit;

            if ($result == TRUE) {
            $this->session->set_flashdata('success', 'Task Updated Successfully !');
            redirect('/Dailytasks/tasks', 'refresh');
            //$this->fetchSuppliers();
            }
            else {
            $this->session->set_flashdata('failed', 'No Changes in Holiday !');
            redirect('/Dailytasks/tasks', 'refresh');
            }
          } 
        
          }
          
          

         public function editprojects($id) {
          $this->form_validation->set_rules('project_name', 'Project Name', 'required');
          if ($this->form_validation->run() == FALSE) 
          {
            if(isset($this->session->userdata['logged_in'])){
            $this->projects();
            //$this->template->load('template','category_master');
            //$this->load->view('admin_page');
            }else{
            $this->load->view('login_form');
            }
            //$this->template->load('template','supplier_add');
          }
          else 
          {  
            
            $login_id=$this->session->userdata['logged_in']['id'];
            
           
            $data = array(
            //'id' => $id,
            'project_name' => $this->input->post('project_name'),
            
            'start_date' => date('Y-m-d',strtotime($this->input->post('start_date'))),
            'end_date' => date('Y-m-d',strtotime($this->input->post('end_date'))),
            'status' => $this->input->post('project_status'),
            'department_id' => $this->input->post('department_id'),
            'description' => $this->input->post('description'),
            'technology' => $this->input->post('technology'),
            
            
            );
            

              $result = $this->task_model->project_edit($data,$id);

           
         
          //echo $result;exit;

          if ($result == TRUE) {
          $this->session->set_flashdata('success', 'project Updated Successfully !');
          redirect('/Dailytasks/projects', 'refresh');
          //$this->fetchSuppliers();
          }
          else {
          $this->session->set_flashdata('failed', 'No Changes in projects !');
          redirect('/Dailytasks/projects', 'refresh');
          }
        } 
      
        }
        
          
          
          
          
          public function tasks() 
          {
            $data['title'] = 'Task History';
            $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
            $login_id=$this->session->userdata['logged_in']['id'];
            $conditions=[];
             if($this->input->get()) {
              
                $conditions['employee_id']  = $this->input->get('employee_id');
                $conditions['project_id'] = $this->input->get('project_id');
                $conditions['task_status'] = $this->input->get('task_status');
                
                if(!empty($this->input->get('upto_date'))) {
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
              } 
              else {
                $conditions['upto_date']= "";
              }
              if(!empty($this->input->get('from_date'))) {
                $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
              }
              else {
                $conditions['from_date']= "";
              }
             
              $data['daily_tasks']			= $this->task_model->TaskListCSV($conditions);
			        $data['filtered_value'] = $conditions;
			     //   echo "<pre>";print_r($data['filtered_value']);exit;
        } else {
         
          if($data['designation_id']==1){
            $data['daily_tasks']=$this->task_model->taskList(); 
          }
          else{
          
           $data['daily_tasks']=$this->task_model->taskListByEmployee($login_id);
          }

         
         $data['filtered_value'] =$conditions;
          
       }
       
       $data['projects'] = $this->task_model->getproject_id();
             
             
             $data['name'] = $this->task_model->getempname_id();
            // $data['employees'] = $this->task_model->getEmployeeDropdown();
           
//   echo "<pre>";print_r($data['name']);exit;
            $this->template->load('layout/template','task_view',$data);
          }
      
    
          public function task_add() 
          {
            $data = array();
            $data['page_title'] = 'Create Task';
        
             //$data['categories'] = $this->Leave_model->getCategories();
             $data['leave_types'] = $this->Leave_model->getleavetype();
             //$data['projects'] = $this->Leave_model->getCountries();
             $data['project_id'] = $this->task_model->getproject_id();
		       
		        
        
            
            	
		$data['id'] = '';
		$data['title'] = '';
		$data['project'] = '';
		$data['task_title'] = '';
		$data['start_date'] = '';
		$data['end_date'] = '';
		//$data[''] = '';
		$data['priority'] = '';
		//$data['country'] = '';
		//$data['description'] = '';
		$data['task_status'] = '';
    $data['Assign_to']='';
    $data['assignby']='';
    $data['assigntoemp']='';
    //'assignby' -> $data['login_id']
	
            
            $data['total_count'] = $this->task_model->getdailytask();
            $voucher_no= $data['total_count']+1;
              if($voucher_no<10){
              $rs_id_code='MUSK000'.$voucher_no;
              }
              else if(($voucher_no>=10) && ($voucher_no<=99)){
                $rs_id_code='MUSK00'.$voucher_no;
              }
              else if(($voucher_no>=100) && ($voucher_no<=999)){
                $rs_id_code='MUSK0'.$voucher_no;
              }
              else{
                $rs_id_code='MUSK'.$voucher_no;
              }
              $data['lead_code']=$rs_id_code;
              
              $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
              $data['department_id']=$this->session->userdata['logged_in']['department_id'];
              if($data['designation_id'] == '4'){
                $data['assignto'] = $this->task_model->getTList();
              }else if($data['designation_id'] == '8'){
                $data['assignto'] = $this->task_model->getemployeeList($data['department_id']);
              }else{
                $data['assignto'] = $this->task_model->getemployeeList();
              }
              
              $this->template->load('template','taske_add',$data);
          }


          
	// public function taske_add() 
	// {
	// 	$data = array();
	// 	$data['page_title'] = ' Create Task';
	// 	$data['login_id']=$this->session->userdata['logged_in']['id'];
	// 	$data['role_id']=$this->session->userdata['logged_in']['role_id'];
  
	// 	 // $data['employees'] = $this->Leave_model->getEmployees();
	// 	 $data['project_id'] = $this->task_model->getproject_id();
	// 	 $data['assignto'] = $this->task_model->getassignto();
	// 	// $data['assign_by'] = $this->task_model->getassign_by();
	// 	 //$data['categories'] = $this->Leave_model->getCategories();

		
	// 	$data['id'] = '';
	// 	$data['title'] = '';
	// 	$data['project'] = '';
	// 	$data['task_title'] = '';
	// 	$data['start_date'] = '';
	// 	$data['end_date'] = '';
	// 	//$data[''] = '';
	// 	$data['priority'] = '';
	// 	//$data['country'] = '';
	// 	//$data['description'] = '';
	// 	$data['leave_status'] = '';
  //   $data['assign_to']='';
  //   $data['assign_by']='';
	// 	$data['total_count'] = $this->Leave_model->getLeadcsvCode();
	// 	$voucher_no= $data['total_count']+1;
	//     if($voucher_no<10){
	//     $rs_id_code='MUSK000'.$voucher_no;
	//     }
	//     else if(($voucher_no>=10) && ($voucher_no<=99)){
	//       $rs_id_code='MUSK00'.$voucher_no;
	//     }
	//     else if(($voucher_no>=100) && ($voucher_no<=999)){
	//       $rs_id_code='MUSK0'.$voucher_no;
	//     }
	//     else{
	//       $rs_id_code='MUSK'.$voucher_no;
	//     }
	//     $data['lead_code']=$rs_id_code;

	//     $this->template->load('template','taske_add',$data);
	// }
		
  public function edit($id = NULL) 
	{   
      $data['assigntoemp']='';
			$data = array();
      
			$result = $this->task_model->getById($id);

			if (isset($result['id']) && $result['id']) :
	            $data['id'] = $result['id'];
	        else:
	            $data['id'] = '';
	        endif;

			if (isset($result['task_name']) && $result['task_name']) :
	            $data['task_name'] = $result['task_name'];
	       else:
	            $data['task_name'] = '';
	        endif;
	      
	     
	       
          if (isset($result['start_date']) && $result['start_date']) :
            $data['start_date'] = $result['start_date'];
       else:
            $data['start_date'] = '';
        endif;

        if (isset($result['end_date']) && $result['end_date']) :
          $data['end_date'] = $result['end_date'];
     else:
          $data['end_date'] = '';
      endif;

      if (isset($result['priority']) && $result['priority']) :
        $data['priority'] = $result['priority'];
   else:

        $data['priority'] = '';
    endif;
     if (isset($result['status']) && $result['status']) :
        $data['status'] = $result['status'];
   else:
        $data['status'] = '';
    endif;

     if (isset($result['Assign_to']) && $result['Assign_to']) :
        $data['Assign_to'] = $result['Assign_to'];
   else:
        $data['Assign_to'] = '';
    endif;

    if (isset($result['assign_to_emp'])  && $result['assign_to_emp']) :
      $data['assigntoemp'] = $result['assign_to_emp'];
 else:
      $data['assigntoemp'] = '';
  endif;

    if (isset($result['project_id']) && $result['project_id']) :
      $data['project_id'] = $result['project_id'];
 else:
      $data['project_id'] = '';
  endif;
    

			$data['page_title'] = ' Update task';
			
			//$data['leave_types'] = $this->task_model->getleavetype();
			$data['projects'] = $this->task_model->getproject_id();
			// $data['employee'] = $this->task_model->getassignto();

      $data['designation_id']=$this->session->userdata['logged_in']['designation_id'];
      $data['department_id']=$this->session->userdata['logged_in']['department_id'];
      if($data['designation_id'] == '4'){
        $data['assignto'] = $this->task_model->getTList();
      }else if($data['designation_id'] == '8'){
        $data['assignto'] = $this->task_model->getemployeeList($data['department_id']);
      }else{
        $data['assignto'] = $this->task_model->getemployeeList();
      }
		 
		
			$this->template->load('template','taske_edit',$data);
	}


//   public function deleteItem($id= null){
//     $id = $this->uri->segment('3');
//     $result =$this->task_model->deleteItem($id);
//     if ($result == TRUE) {
//    $this->session->set_flashdata('success', 'Item deleted Successfully !');
//    redirect('/Dailytasks/tasks', 'refresh');
//    //$this->fetchSuppliers();
//  } else {
//    $this->session->set_flashdata('failed', 'Operation Failed!');
//    redirect('/Dailytasks/tasks', 'refresh');
//  }
//  }



//Delete Record to Database
public function deleteItem($id= null) {
  $ids=$this->input->post('ids');
  // print_r($ids);exit;
 if(!empty($ids)) {
      $Datas=explode(',', $ids);
      foreach ($Datas as $key => $id) {
          $this->task_model->deleteItem($id);
      }
      echo $this->session->set_flashdata('success', 'Task Deleted Successfully!');
  }else{
      $id = $this->uri->segment('3');
      $this->task_model->deleteItem($id);
      $this->session->set_flashdata('success', 'Task Deleted Successfully!');
      redirect('/Driver_panel/index', 'refresh');
  }
}


public function task_history($id = NULL) 
	{
		$data=[];
		$data['id']=$this->uri->segment('3');
		$data['title'] = ' Task Followups';
		$data['followups'] = $this->task_model->getFollowUps($id);
		//$data['categories'] = $this->Leads_model->getCategories();
		//echo var_dump($data['students']);
		//print_r($data['followups']);exit;
		$this->template->load('template','task_followups',$data);
	}


  public function add_task_history() {
		$this->form_validation->set_rules('task_id', 'task_id', 'required');
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

			$config['upload_path']          = './uploads/task_follow_up/';
			$config['allowed_types']        = '*';
			$config['max_size']             ='';
			$config['max_width']            ='';
			$config['max_height']           = '';
			$config['overwrite']            = TRUE;
			$this->load->library('upload', $config);

			$this->upload->do_upload('photo'); 
      //   $task_id      = $this->input->post('task_id');
			// 	$this->session->set_flashdata('failed', 'Document upload error!');
        
			// 	redirect('/Dailytasks/task_history/'.$task_id, 'refresh');
			// } 
      
				$task_id           = $this->input->post('task_id');
				$data = array(
          'task_id'       => $this->input->post('task_id'),
					'answer'       => $this->input->post('answer'),
          'reference' =>$this->input->post('reference'),
          'time_taken'=>$this->input->post('time_taken'),
					'file_path'    => $this->upload->data()['file_name'],
					'followup_by'  => $data['login_id'] 
        );
        // print_r($data);exit();
				$result = $this->task_model->insertFollowup($data);
				if ($result == TRUE) {
					$this->session->set_flashdata('success', 'Follow Up Added Successfully !');
					redirect('/Dailytasks/task_history/'.$task_id ,'refresh');
					//$this->fetchSuppliers();
				} else {
					$this->session->set_flashdata('failed', 'Already Exists , Follow Up Not Inserted !');
					redirect('/Dailytasks/tasks/'.$task_id, 'refresh');
				}
			}
		} 
	



  public function deletetaskhistory($id= null){
    // print_r($_POST);exit;
    $id = $this->uri->segment('3');
    $task_id=$this->input->post('task_id');
    $result =$this->task_model->deletefollowup($id);
    if ($result == TRUE) {
   $this->session->set_flashdata('success', 'Task history deleted Successfully !');
   redirect('/Dailytasks/task_history/'.$task_id ,'refresh');
   //$this->fetchSuppliers();
 } else {
   $this->session->set_flashdata('failed', 'Operation Failed!');
   redirect('/Dailytasks/tasks/'.$task_id, 'refresh');
 }
 }



}

?>