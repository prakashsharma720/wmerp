<?php
Class Maintenance_history_records extends MY_Controller {

	public function __construct(){

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
		$this->load->model('maintenance_history_model');
		//var_dump($this->load->maintenance_history_model);
		$this->load->model('daily_stacking_model');
		$this->load->model('categories_model');
	}

	// Show login page
	public function add() {
		$data = array();
		$data['m_code'] = $this->maintenance_history_model->getGSRCode();
			$voucher_no= $data['m_code'];
            if($voucher_no<10){
            $maintenance_id_code='MAI000'.$voucher_no;
            }
            else if(($voucher_no>=10) && ($voucher_no<=99)){
              $maintenance_id_code='MAI00'.$voucher_no;
            }
            else if(($voucher_no>=100) && ($voucher_no<=999)){
              $maintenance_id_code='MAI0'.$voucher_no;
            }
            else{
              $maintenance_id_code='MAI'.$voucher_no;
            }
             //print_r($data['m_code']);exit;
		
		$data['login_id']				= $this->session->userdata['logged_in']['id'];
		$data['department_id']  		= $this->session->userdata['logged_in']['department_id'];
		$role_id 						= $this->session->userdata['logged_in']['role_id'];
		$data['pme_code'] 				= $maintenance_id_code;
		$data['departments'] 			= $this->daily_stacking_model->getDepartments();
		$data['plant_machinary_list'] 	= $this->categories_model->packingmaterialsList(6);
		$data['title'] 					= 'Add New Maintenance History Record';
		$this->template->load('template','maintenance_history_add',$data);
	}

	public function edit($id=NULL)
	{
		
		$data 					= array();
		$data['login_id'] 		= $this->session->userdata['logged_in']['id'];
		$data['department_id'] 	= $this->session->userdata['logged_in']['department_id'];
		$role_id 				= $this->session->userdata['logged_in']['role_id'];
		$result					= $this->maintenance_history_model->getById($id);
		// echo "<pre>"; print_r($result);exit;

		if (isset($result[0]['pme_code']) && $result[0]['pme_code']) :
	        $data['pme_code'] = $result[0]['pme_code'];
			$voucher_no= $data['pme_code'];
		    if($voucher_no<10){
		    $rs_id_code='ME000'.$voucher_no;
		    }
		    else if(($voucher_no>=10) && ($voucher_no<=99)){
		      $rs_id_code='ME00'.$voucher_no;
		    }
		    else if(($voucher_no>=100) && ($voucher_no<=999)){
		      $rs_id_code='ME0'.$voucher_no;
		    }
		    else{
		      $rs_id_code='ME'.$voucher_no;
		    }
		    $data['pme_code']=$rs_id_code;
		endif;

		if (isset($result[0]['id']) && $result[0]['id']) :
			$data['id'] = $result[0]['id'];
		else:
			$data['id'] = '';
		endif;

		if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
			$data['transaction_date'] = $result[0]['transaction_date'];
		else:
			$data['transaction_date'] = '';
		endif; 
	
		if (isset($result[0]['department_id']) && $result[0]['department_id']) :
			$data['department_id'] = $result[0]['department_id'];
		else:
			$data['department_id'] = '';
		endif;

		$data['plant_machinary_list'] 	= $this->categories_model->packingmaterialsList(6);
		$data['departments'] 			= $this->daily_stacking_model->getDepartments();
		$data['title'] 					= ' Edit maintenance history ';
		$data['pme_data'] 				= $result[0]; 
			  //echo "<pre>"; print_r($data );exit();
			  //redirect(base_url().'maintenance_history_edit');
		$this->template->load('template','maintenance_history_edit',$data);
	}

	public function index()
	{
		$data['title'] 		= ' Machinary Equipment ';
		$login_id 			= $this->session->userdata['logged_in']['id'];
		$role_id 			= $this->session->userdata['logged_in']['role_id'];
		$department_id 		= $this->session->userdata['logged_in']['department_id'];
		$data['pr_data'] 	= $this->maintenance_history_model->getList();

		$this->template->load('template','maintenance_history_view',$data);
	}
	
	public function report() 
	{
		$data['title'] = 'Suppliers Report';
		$data['suppliers'] = $this->maintenance_history_model->supplier_list();

		//echo var_dump($data['students']);
		$this->template->load('template','supplier_report',$data);
	}
	
	public function add_new_record()
	{
		$this->form_validation->set_rules('equipment_name[]', 'Equipment Name ', 'required');
		
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
				$this->add();
			}else{
				$this->load->view('login_form');
			}
		} 
		else 
		{
			$login_id 		= $this->session->userdata['logged_in']['id'];
			$role_id 		= $this->session->userdata['logged_in']['role_id'];
			$department_id 	= $this->session->userdata['logged_in']['department_id'];

			$data = array(
				'transaction_date' 		=> date('Y-m-d',strtotime($this->input->post('transaction_date'))),
				'pme_code' 				=> $this->input->post('pme_code'),
				'department_id' 		=> $this->input->post('department_id'),
				'equipment_name' 		=> $this->input->post('equipment_name')[0],
				'equipment_id' 			=> $this->input->post('equipment_id'),
				'machine_start_date'    => date('Y-m-d',strtotime($this->input->post('machine_start_date'))),
				'machin_start_time'     => $this->input->post('machin_start_time'),
				'machine_stop_date'     => date('Y-m-d',strtotime($this->input->post('machine_stop_date'))),
				'machin_stop_time'      => $this->input->post('machin_stop_time'),
				'machine_total_time'    => $this->input->post('machine_total_time')[0],
				'type_maintance' 		=> $this->input->post('type_maintance')[0],
				'details_maintance' 	=> $this->input->post('details_maintance')[0],
				'parts_replaced' 		=> $this->input->post('parts_replaced')[0],
				'created_by' 			=> $login_id,
			);
			// echo "<pre>";print_r($data); die;
			
			$result = $this->maintenance_history_model->pme_insert($data);
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Data inserted Successfully !');
				redirect('/Maintenance_history_records/index', 'refresh');
				//$this->fetchSuppliers();
			}
			else
			{
				$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
				redirect('/Maintenance_history_records/index', 'refresh');
			}
		}
	}

	public function edit_pme($id=NULL)
	{
		
		
		// echo "in edit Record, posted data is:---><pre>"; die;
		$this->form_validation->set_rules('equipment_name', 'Equipment Name ', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in']))
			{
				$this->add($id);
			}
			else
			{
				$this->load->view('login_form');
			}
		} 
		else 
		{
			$login_id 		= $this->session->userdata['logged_in']['id'];
			$role_id 		= $this->session->userdata['logged_in']['role_id'];
			$department_id 	= $this->session->userdata['logged_in']['department_id'];
			
			// $data = array(
			// 	'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			// 	'dsr_code' => $this->input->post('dsr_code'),
			// 	'department_id' => $this->input->post('department_id'),
			// 	'total_bags' => $this->input->post('total_bags'),
			// 	'total_workers' => $this->input->post('total_workers'),
			// 	'total_rates' => $this->input->post('total_rate'),
			// 	'grand_total' => $this->input->post('total_amount'),
			// 	'edited_by' => $login_id,
			// );

			$data = array(
				'transaction_date' 		=> date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			// 'pme_code' 				=> $this->input->post('pme_code'),
				'department_id' 		=> $this->input->post('department_id'),
				'equipment_name' 		=> $this->input->post('equipment_name'),
				'equipment_id' 			=> $this->input->post('equipment_id'),
				'machine_start_date' 	=> date('Y-m-d',strtotime($this->input->post('machine_start_date'))),
				'machin_start_time' 	=> $this->input->post('machin_start_time'),
				'machine_stop_date' 	=> date('Y-m-d',strtotime($this->input->post('machine_stop_date'))),
				'machine_total_time' 	=> $this->input->post('machine_total_time'),
				'type_maintance' 		=> $this->input->post('type_maintance'),
				'details_maintance' 	=> $this->input->post('details_maintance'),
				'parts_replaced' 		=> $this->input->post('parts_replaced'),
				'edited_by' 			=> $login_id,
			);

			
			 $old_id = $this->input->post('gsr_id_old'); 
			//echo "<pre>";print_r($data);exit;
			$result = $this->maintenance_history_model->editGSR($data,$id);
			
			if ($result == TRUE) {
				$this->session->set_flashdata('success', 'Data Updated Successfully !');
				redirect('/Maintenance_history_records/index', 'refresh');
			} else {
				$this->session->set_flashdata('failed', 'No changes in Machinary Equipments Record!');
				redirect('/Maintenance_history_records/index', 'refresh');
			}
		}
	}


	public function deleteGSR($id= null)
	{
		
		// echo 'in delete, id is:--->'.$id;exit();

		$ids = $this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$result=$this->maintenance_history_model->deleteGSR($id);
  	 		}
  	 		if ($result == TRUE) {
	 			echo $this->session->set_flashdata('success', 'Machinary Equipment Record deleted Successfully !');
	 		}else{
	 			echo $this->session->set_flashdata('failed', 'Operation Failed!');
	 		}
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$result=$this->maintenance_history_model->deleteGSR($id);
  	 		if ($result == TRUE) {
			$this->session->set_flashdata('success', 'Machinary Equipments Record deleted Successfully !');
			redirect('/Maintenance_history_records/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed!');
			redirect('/Maintenance_history_records/index', 'refresh');
			}
  	 	}
  	}

  	public function print($id)
  	{
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->maintenance_history_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Production Register Print View';
        $this->template->load('template','requisition_print',$data);
    } 
}

?>
