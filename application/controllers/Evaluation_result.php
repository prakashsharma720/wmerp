<?php

//session_start(); //we need to start session in order to access it through CI

Class Evaluation_result extends MY_Controller {

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

//$this->load->library('encryption');

// Load session library
$this->load->library('session');


$this->load->library('template');
$this->load->library('encryption');

// Load database
//$this->load->model('evaluation_result_model');
$this->load->model('evaluation_result_model');
//$this->load->library('excel');
}

// Show login page
public function ev_supplier_add() {
  //$id = decrypt_url($gir_id);
  //print_r($pid);exit;
  $data = array();
  
  $data['title']='Supplier Evaluation Panel';
  $data['suppliers']=$this->evaluation_result_model->getSuppliers();
  $data['items']=$this->evaluation_result_model->getItems();
  $this->load->model('rm_model');
  $data['categories']=$this->rm_model->getSupplierCategories();
  $this->load->model('evaluation_criteria_model');
  $data['criterias']=$this->evaluation_criteria_model->SupllierECList();
  //print_r($data['criterias']);exit;

  //$data['states']=$this->evaluation_result_model->getStates();
  $this->template->load('template','evaluation_result_sup_add',$data);

  //$this->load->view('footer');
  
  }

  public function ev_sprovider_add() {
  //$id = decrypt_url($gir_id);
  //print_r($pid);exit;
  $data = array();
  
  $data['title']='Service Provider Evaluation Panel';
  //$data['sproviders']=$this->evaluation_result_model->getSProviders();
  //$data['items']=$this->evaluation_result_model->getItems();
  $this->load->model('rm_model');
  $data['categories']=$this->rm_model->getSProviderCategories();
  $this->load->model('evaluation_criteria_model');
  $data['criterias']=$this->evaluation_criteria_model->SProviderECList();
  //print_r($data['criterias']);exit;

  //$data['states']=$this->evaluation_result_model->getStates();
  $this->template->load('template','evaluation_result_sprovider_add',$data);

  //$this->load->view('footer');
  
  }
  public function ev_supplier_edit($id=NULL) {
  $data = array();
  $result = $this->evaluation_result_model->getById($id);
  //print_r($result);exit;

  if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

  if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;
  if (isset($result[0]['total_marks']) && $result[0]['total_marks']) :
      $data['total_marks'] = $result[0]['total_marks'];
  else:
      $data['total_marks'] = '';
  endif;

  if (isset($result[0]['total_marks_obtained']) && $result[0]['total_marks_obtained']) :
      $data['total_marks_obtained'] = $result[0]['total_marks_obtained'];
  else:
      $data['total_marks_obtained'] = '';
  endif;

  if (isset($result[0]['percentage']) && $result[0]['percentage']) :
      $data['percentage'] = $result[0]['percentage'];
  else:
      $data['percentage'] = '';
  endif;

  if (isset($result[0]['approval_grade']) && $result[0]['approval_grade']) :
      $data['approval_grade'] = $result[0]['approval_grade'];
  else:
      $data['approval_grade'] = '';
  endif;

  if (isset($result[0]['date']) && $result[0]['date']) :
      $data['date'] = $result[0]['date'];
  else:
      $data['date'] = '';
  endif; 
  if (isset($result[0]['comments']) && $result[0]['comments']) :
      $data['comments'] = $result[0]['comments'];
  else:
      $data['comments'] = '';
  endif;
  if (isset($result[0]['supplier']) && $result[0]['supplier']) :
      $data['supplier'] = $result[0]['supplier'];
  else:
      $data['supplier'] = '';
  endif;   
  if (isset($result[0]['categories_id']) && $result[0]['categories_id']) :
      $data['categories_id'] = $result[0]['categories_id'];
  else:
      $data['categories_id'] = '';
  endif;  

  if (isset($result[0]['er_details']) && $result[0]['er_details']) :
      $data['er_details'] = $result[0]['er_details'];
  else:
      $data['er_details'] = '';
  endif;




  $data['title']='Edit Supplier Evaluation Panel';
  $data['suppliers']=$this->evaluation_result_model->getSuppliers($data['categories_id']);
  $data['items']=$this->evaluation_result_model->getItems();
  $this->load->model('rm_model');
  $data['categories']=$this->rm_model->getSupplierCategories();
  $this->load->model('evaluation_criteria_model');

  $data['criterias']=$this->evaluation_criteria_model->SupllierECList();

// For edit only //
  $this->load->model('login_database');
  $data['suppliers_data']=$this->login_database->getSupplierById($id);
  //print_r($data['criterias']);exit;

  //$data['states']=$this->evaluation_result_model->getStates();
  $this->template->load('template','evaluation_result_sup_edit',$data);

  //$this->load->view('footer');
  
  }
   public function ev_sprovider_edit($id=NULL) {
  $data = array();
  $result = $this->evaluation_result_model->getById($id);
  //print_r($result);exit;

  if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

  if (isset($result[0]['service_provider_id']) && $result[0]['service_provider_id']) :
        $data['service_provider_id'] = $result[0]['service_provider_id'];
    else:
        $data['service_provider_id'] = '';
    endif;
  if (isset($result[0]['total_marks']) && $result[0]['total_marks']) :
      $data['total_marks'] = $result[0]['total_marks'];
  else:
      $data['total_marks'] = '';
  endif;

  if (isset($result[0]['total_marks_obtained']) && $result[0]['total_marks_obtained']) :
      $data['total_marks_obtained'] = $result[0]['total_marks_obtained'];
  else:
      $data['total_marks_obtained'] = '';
  endif;

  if (isset($result[0]['percentage']) && $result[0]['percentage']) :
      $data['percentage'] = $result[0]['percentage'];
  else:
      $data['percentage'] = '';
  endif;

  if (isset($result[0]['approval_grade']) && $result[0]['approval_grade']) :
      $data['approval_grade'] = $result[0]['approval_grade'];
  else:
      $data['approval_grade'] = '';
  endif;

  if (isset($result[0]['date']) && $result[0]['date']) :
      $data['date'] = $result[0]['date'];
  else:
      $data['date'] = '';
  endif; 
  if (isset($result[0]['comments']) && $result[0]['comments']) :
      $data['comments'] = $result[0]['comments'];
  else:
      $data['comments'] = '';
  endif;
  if (isset($result[0]['sprovider']) && $result[0]['sprovider']) :
      $data['sprovider'] = $result[0]['sprovider'];
  else:
      $data['sprovider'] = '';
  endif;   
  if (isset($result[0]['categories_id']) && $result[0]['categories_id']) :
      $data['categories_id'] = $result[0]['categories_id'];
  else:
      $data['categories_id'] = '';
  endif;  

  if (isset($result[0]['er_details']) && $result[0]['er_details']) :
      $data['er_details'] = $result[0]['er_details'];
  else:
      $data['er_details'] = '';
  endif;




  $data['title']='Edit Service Provider Evaluation Panel';
  $data['sproviders']=$this->evaluation_result_model->getSProviders($data['categories_id']);
  $data['items']=$this->evaluation_result_model->getItems();
  $this->load->model('rm_model');
  $data['categories']=$this->rm_model->getSProviderCategories();
  $this->load->model('evaluation_criteria_model');
  $data['criterias']=$this->evaluation_criteria_model->SProviderECList();
  //print_r($data['sproviders']);exit;

  //$data['states']=$this->evaluation_result_model->getStates();
  // For edit only //
  $this->load->model('service_provider_model');
  $data['service_providers_data']=$this->service_provider_model->getSProviderById($id);
  $this->template->load('template','evaluation_result_sprovider_edit',$data);

  //$this->load->view('footer');
  
  }

  public function ev_sup_index(){
      //$vv=$this->encrypt->encode('hy');
      //print_r($vv);exit;
      $data['title']=' Supplier Evaluation Results';
      //$data['suppliers']=$this->evaluation_result_model->getSuppliers();
      if($this->input->get())
      {
        $conditions['supplier_id']=$this->input->get('supplier_id');
        $conditions['categories_id']=$this->input->get('categories_id');
        $conditions['category_of_approval']=$this->input->get('category_of_approval');
        $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
        //print_r($_GET);exit;
        //print_r($conditions['upto_date']);exit;
             $data['er_data'] = $this->evaluation_result_model->evaluations_list_by_filter($conditions);
             //print_r($data['er_data']);exit;
      }else{
      $data['er_data']=$this->evaluation_result_model->getEVList();
      }

      //$data['Items']=$this->evaluation_result_model->getItems();
      $this->load->model('login_database');
      $data['all_suppliers']=$this->login_database->getAllSuppliers();
      $data['categories']=$this->login_database->getCategories();
      //$data['states']=$this->evaluation_result_model->getStates();
      $this->template->load('template','ev_sup_index',$data);
    }

    public function ev_sprovider_index(){
      //$vv=$this->encrypt->encode('hy');
      //print_r($vv);exit;
      $data['title']=' Service Provider Evaluation Results';
      //$data['suppliers']=$this->evaluation_result_model->getSuppliers();
      $this->load->model('service_provider_model');
      $data['all_sproviders']=$this->service_provider_model->getAllSProviders();
      $data['categories']=$this->service_provider_model->getCategories();
      if($this->input->get())
      {
        $conditions['service_provider_id']=$this->input->get('service_provider_id');
        $conditions['categories_id']=$this->input->get('categories_id');
        $conditions['category_of_approval']=$this->input->get('category_of_approval');
             $data['er_data'] = $this->evaluation_result_model->Filter_bygetSPEVList($conditions);
             //print_r($data['er_data']);exit;
      }else{
      $data['er_data']=$this->evaluation_result_model->getSPEVList();
      }
      //print_r($data['er_data']);exit;
      //$data['Items']=$this->evaluation_result_model->getItems();
     
      //$data['states']=$this->evaluation_result_model->getStates();
      $this->template->load('template','ev_sprovider_index',$data);
    }

  public function add_new_ER() {
    //$this->form_validation->set_rules('transaction_date', 'Date', 'required');
    $this->form_validation->set_rules('total_marks_criteria', 'Total Marks', 'required');
    //$this->form_validation->set_rules('criteri[]', 'Product', 'required');
    //$this->form_validation->set_rules('challan_no', 'Challan No', 'required');
    //$products=[];
    //$products=$this->input->post('products');
    /*$grade=$this->input->post('grade');
    $qty=$this->input->post('qty');
    $rate=$this->input->post('rate');
    $total=$this->input->post('total');*/
    //print_r($products);exit;
    //$voucher_no='0';
    if ($this->form_validation->run() == FALSE) 
    {
      
      if(isset($this->session->userdata['logged_in']['id'])){
        $this->ev_supplier_add();
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    } 
    else 
    {
     /* $count_row = $this->evaluation_result_model->rowcount();
      $voucher_no=$count_row+1;*/

      $login_id=$this->session->userdata['logged_in']['id'];
      $data = array(
      'date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
      'categories_id' => $this->input->post('categories_id'),
      'supplier_id' => $this->input->post('supplier_id'),
      'service_provider_id' => $this->input->post('service_provider_id'),
      'transporter_id' => $this->input->post('transporter_id'),
      'total_marks' => $this->input->post('total_marks_criteria'),
      'total_marks_obtained' => $this->input->post('total_marks_obtained'),
      'percentage' => $this->input->post('percentage'),
      'approval_grade' => $this->input->post('approval_grade'),
      'comments' => $this->input->post('comments'),
      'created_by' => $login_id
      );
      //print_r($data);exit;
      $result = $this->evaluation_result_model->er_insert($data);
      if ($result == TRUE) {
            $service_provider_id=$this->input->post('service_provider_id');
            $transporter_id=$this->input->post('transporter_id');
            $supplier_id=$this->input->post('supplier_id');
            $data = array('category_of_approval' => $this->input->post('approval_grade'));
            if(!empty($supplier_id)){
                $result1 = $this->evaluation_result_model->updateSupplierGrade($data,$supplier_id);
                if ($result1 == TRUE) 
                {
                  $this->session->set_flashdata('success', 'Data inserted Successfully !');
                  redirect('/Evaluation_result/ev_sup_index', 'refresh');
                }
            }
            if(!empty($service_provider_id)){
                $result1 = $this->evaluation_result_model->updateSProviderGrade($data,$service_provider_id);
                if ($result1 == TRUE) 
                {
                  $this->session->set_flashdata('success', 'Data inserted Successfully !');
                  redirect('/Evaluation_result/ev_sprovider_index', 'refresh');
                }
            }
                  
      } 
      else {
      $this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
      redirect('/Evaluation_result/ev_sup_index', 'refresh');
      }
    }
  }

  public function edit_ER($id){
     $this->form_validation->set_rules('total_marks_criteria', 'Total Marks', 'required');
   if ($this->form_validation->run() == FALSE) 
    {
      
      if(isset($this->session->userdata['logged_in'])){
        $this->edit_ER($id);
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
         'date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
        'categories_id' => $this->input->post('categories_id'),
        'supplier_id' => $this->input->post('supplier_id'),
        'service_provider_id' => $this->input->post('service_provider_id'),
        'total_marks' => $this->input->post('total_marks_criteria'),
        'total_marks_obtained' => $this->input->post('total_marks_obtained'),
        'percentage' => $this->input->post('percentage'),
        'approval_grade' => $this->input->post('approval_grade'),
        'comments' => $this->input->post('comments'),
        'edited_by' => $login_id
        );
        //$old_id = $this->input->post('gir_id_old'); 
        //print_r($data);exit;
        $result = $this->evaluation_result_model->editER($data,$id);
         if ($result == TRUE) {
            $service_provider_id=$this->input->post('service_provider_id');
            $transporter_id=$this->input->post('transporter_id');
            $supplier_id=$this->input->post('supplier_id');
            $data = array('category_of_approval' => $this->input->post('approval_grade'));
            if(!empty($supplier_id)){
                $result1 = $this->evaluation_result_model->updateSupplierGrade($data,$supplier_id);
                if ($result1 == TRUE) 
                {
                  $this->session->set_flashdata('success', 'Data inserted Successfully !');
                  redirect('/Evaluation_result/ev_sup_index', 'refresh');
                }
            }
            if(!empty($service_provider_id)){
                $result1 = $this->evaluation_result_model->updateSProviderGrade($data,$service_provider_id);
                if ($result1 == TRUE) 
                {
                  $this->session->set_flashdata('success', 'Data inserted Successfully !');
                  redirect('/Evaluation_result/ev_sprovider_index', 'refresh');
                }
            }
      } 
      else {
        $this->session->set_flashdata('failed', 'No changes in gir details!');
        redirect('/Evaluation_result/ev_sup_index', 'refresh');
        //$this->template->load('template','supplier_view');
        }
    }
}

  public function deleteERS($id= null){
    $ids=$this->input->post('ids');
    if(!empty($ids)) 
    {
      $Datas=explode(',', $ids);
        foreach ($Datas as $key => $id) {
          $this->evaluation_result_model->deletegir($id);
        }
        echo $this->session->set_flashdata('success', 'Selected Evaluations deleted Successfully !');
    }
    else
    {
        $id = $this->uri->segment('3');
        $this->evaluation_result_model->deletegir($id);
        $this->session->set_flashdata('success', 'This Evaluation deleted Successfully !');
        redirect('/Evaluation_result/ev_sup_index', 'refresh');
        //$this->fetchSuppliers(); //render the refreshed list.
    }
  }
// For Transporter

public function ev_transporter_add() {
  //$id = decrypt_url($gir_id);
  //print_r($pid);exit;
  $data = array();
  
  $data['title']='Transporter Evaluation Panel';
  $data['transporters']=$this->evaluation_result_model->getTransporters();
  //$this->load->model('rm_model');
  //$data['categories']=$this->rm_model->getTransporterCategories();
  $this->load->model('evaluation_criteria_model');
  $data['criterias']=$this->evaluation_criteria_model->TransporterECList();
  //print_r($data['criterias']);exit;

  //$data['states']=$this->evaluation_result_model->getStates();
  $this->template->load('template','evaluation_result_tp_add',$data);

  //$this->load->view('footer');
  
  }
  
 public function ev_transporter_edit($id=NULL) {
  $data = array();
  $result = $this->evaluation_result_model->getById($id);
  //print_r($result);exit;

  if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

  if (isset($result[0]['transporter_id']) && $result[0]['transporter_id']) :
        $data['transporter_id'] = $result[0]['transporter_id'];
    else:
        $data['transporter_id'] = '';
    endif;
  if (isset($result[0]['total_marks']) && $result[0]['total_marks']) :
      $data['total_marks'] = $result[0]['total_marks'];
  else:
      $data['total_marks'] = '';
  endif;

  if (isset($result[0]['total_marks_obtained']) && $result[0]['total_marks_obtained']) :
      $data['total_marks_obtained'] = $result[0]['total_marks_obtained'];
  else:
      $data['total_marks_obtained'] = '';
  endif;

  if (isset($result[0]['percentage']) && $result[0]['percentage']) :
      $data['percentage'] = $result[0]['percentage'];
  else:
      $data['percentage'] = '';
  endif;

  if (isset($result[0]['approval_grade']) && $result[0]['approval_grade']) :
      $data['approval_grade'] = $result[0]['approval_grade'];
  else:
      $data['approval_grade'] = '';
  endif;

  if (isset($result[0]['date']) && $result[0]['date']) :
      $data['date'] = $result[0]['date'];
  else:
      $data['date'] = '';
  endif; 
  if (isset($result[0]['comments']) && $result[0]['comments']) :
      $data['comments'] = $result[0]['comments'];
  else:
      $data['comments'] = '';
  endif;
  if (isset($result[0]['transporter']) && $result[0]['transporter']) :
      $data['transporter'] = $result[0]['transporter'];
  else:
      $data['tranporter'] = '';
  endif;   
  if (isset($result[0]['categories_id']) && $result[0]['categories_id']) :
      $data['categories_id'] = $result[0]['categories_id'];
  else:
      $data['categories_id'] = '';
  endif;  

  if (isset($result[0]['er_details']) && $result[0]['er_details']) :
      $data['er_details'] = $result[0]['er_details'];
  else:
      $data['er_details'] = '';
  endif;




  $data['title']='Edit Transporter Evaluation Panel';
  $data['transporters']=$this->evaluation_result_model->getTransporters($data['categories_id']);
  $data['items']=$this->evaluation_result_model->getItems();
  //$this->load->model('rm_model');
  //$data['categories']=$this->rm_model->getTransporterCategories();
  $this->load->model('evaluation_criteria_model');
  $data['criterias']=$this->evaluation_criteria_model->TransporterECList();
  //print_r($data['criterias']);exit;
  $this->load->model('transporter_model');
$data['transporters_data']=$this->transporter_model->getTransporterById($id);
  //$data['states']=$this->evaluation_result_model->getStates();
  $this->template->load('template','evaluation_result_tp_edit',$data);

  //$this->load->view('footer');
  
  }
  public function ev_tp_index(){
      //$vv=$this->encrypt->encode('hy');
      //print_r($vv);exit;

      //$data['suppliers']=$this->evaluation_result_model->getSuppliers();
      //$data['Items']=$this->evaluation_result_model->getItems();
      //$data['er_data']=$this->evaluation_result_model->getTPEVList();
      //$data['states']=$this->evaluation_result_model->getStates();
     // $this->template->load('template','ev_tp_index',$data);
    
      //$data['suppliers']=$this->evaluation_result_model->getSuppliers();
      $data['title']=' Transporter Evaluation Results';
      if($this->input->get())
      {
        $conditions['transporter_id']=$this->input->get('transporter_id');
        //$conditions['categories_id']=$this->input->get('categories_id');
        $conditions['category_of_approval']=$this->input->get('category_of_approval');
        $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
        //print_r($_GET);exit;
        //print_r($conditions['upto_date']);exit;
             $data['er_data'] = $this->evaluation_result_model->evaluations_tplist_by_filter($conditions);
             //print_r($data['er_data']);exit;
      }else{
      $data['er_data']=$this->evaluation_result_model->getTPEVList();
      }

      //$data['Items']=$this->evaluation_result_model->getItems();
      $this->load->model('transporter_model');
      $data['all_transporters']=$this->transporter_model->getAlltransporters();
      //$data['categories']=$this->login_database->getCategories();
      //$data['states']=$this->evaluation_result_model->getStates();
      $this->template->load('template','ev_tp_index',$data);
    }
	
	
	public function add_new_ERT() {
    //$this->form_validation->set_rules('transaction_date', 'Date', 'required');
    $this->form_validation->set_rules('transporter_id', 'Transporter Name', 'required');
    //$this->form_validation->set_rules('criteri[]', 'Product', 'required');
    //$this->form_validation->set_rules('challan_no', 'Challan No', 'required');
    //$products=[];
    //$products=$this->input->post('products');
    /*$grade=$this->input->post('grade');
    $qty=$this->input->post('qty');
    $rate=$this->input->post('rate');
    $total=$this->input->post('total');*/
    //print_r($products);exit;
    //$voucher_no='0';
    if ($this->form_validation->run() == FALSE) 
    {
      
      if(isset($this->session->userdata['logged_in']['id'])){
        $this->ev_transporter_add();
      //$this->load->view('admin_page');
      }else{
      $this->load->view('login_form');
      }
      //$this->template->load('template','supplier_add');
    } 
    else 
    {
     /* $count_row = $this->evaluation_result_model->rowcount();
      $voucher_no=$count_row+1;*/

      $login_id=$this->session->userdata['logged_in']['id'];
      $data = array(
      'date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
      'transporter_id' => $this->input->post('transporter_id'),
      'total_marks' => $this->input->post('total_marks_criteria'),
      'total_marks_obtained' => $this->input->post('total_marks_obtained'),
      'percentage' => $this->input->post('percentage'),
      'approval_grade' => $this->input->post('approval_grade'),
      'comments' => $this->input->post('comments'),
      'created_by' => $login_id
      );
      //print_r($data);exit;
      $result = $this->evaluation_result_model->er_insert($data);
      if ($result == TRUE) {
        $transporter_id=$this->input->post('transporter_id');
            $data = array('category_of_approval' => $this->input->post('approval_grade'));
            $result1 = $this->evaluation_result_model->updateTransporterGrade($data,$transporter_id);
            if ($result1 == TRUE) 
            {
              $this->session->set_flashdata('success', 'Data inserted Successfully !');
              redirect('/Evaluation_result/ev_tp_index', 'refresh');
            }
      } else {
      $this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
      redirect('/Evaluation_result/ev_tp_index', 'refresh');
      }
    }
  }

  public function edit_ERT($id){
	  /* echo "<pre>";
	  print_r($_POST);
	  echo "</pre>";exit; */
    $this->form_validation->set_rules('transporter_id', 'Transporter Name', 'required');
   if ($this->form_validation->run() == FALSE) 
    {
      
      if(isset($this->session->userdata['logged_in'])){
        $this->edit_ERT($id);
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
         'date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
        'transporter_id' => $this->input->post('transporter_id'),
        'total_marks' => $this->input->post('total_marks_criteria'),
        'total_marks_obtained' => $this->input->post('total_marks_obtained'),
        'percentage' => $this->input->post('percentage'),
        'approval_grade' => $this->input->post('approval_grade'),
        'comments' => $this->input->post('comments'),
        'edited_by' => $login_id
        );
        //$old_id = $this->input->post('gir_id_old'); 
        //print_r($data);exit;
        $result = $this->evaluation_result_model->editER($data,$id);
        if ($result == TRUE) {
            $transporter_id=$this->input->post('transporter_id');
            $data = array('category_of_approval' => $this->input->post('approval_grade'));
            $result1 = $this->evaluation_result_model->updateTransporterGrade($data,$transporter_id);
            if ($result1 == TRUE) 
            {
              $this->session->set_flashdata('success', 'Data updated Successfully !');
              redirect('/Evaluation_result/ev_tp_index', 'refresh');
            }
       }   
        else {
        $this->session->set_flashdata('failed', 'No changes in gir details!');
        redirect('/Evaluation_result/ev_tp_index', 'refresh');
        //$this->template->load('template','supplier_view');
        }
    }
}

  public function deleteERT($id= null){
    $ids=$this->input->post('ids');
    if(!empty($ids)) 
    {
      $Datas=explode(',', $ids);
        foreach ($Datas as $key => $id) {
          $this->evaluation_result_model->deletegir($id);
        }
        echo $this->session->set_flashdata('success', 'Selected Evaluations deleted Successfully !');
    }
    else
    {
        $id = $this->uri->segment('3');
        $this->evaluation_result_model->deletegir($id);
        $this->session->set_flashdata('success', 'This Evaluation deleted Successfully !');
        redirect('/Evaluation_result/ev_tp_index', 'refresh');
        //$this->fetchSuppliers(); //render the refreshed list.
    }
  }
   public function deleteERSP($id= null){
    $ids=$this->input->post('ids');
    if(!empty($ids)) 
    {
      $Datas=explode(',', $ids);
        foreach ($Datas as $key => $id) {
          $this->evaluation_result_model->deletegir($id);
        }
        echo $this->session->set_flashdata('success', 'Selected Evaluations deleted Successfully !');
    }
    else
    {
        $id = $this->uri->segment('3');
        $this->evaluation_result_model->deletegir($id);
        $this->session->set_flashdata('success', 'This Evaluation deleted Successfully !');
        redirect('/Evaluation_result/ev_sprovider_index', 'refresh');
        //$this->fetchSuppliers(); //render the refreshed list.
    }
  }

  
  function pdfFile($id)
    {
        $this->data = array();
        $this->load->helper('pdf_helper');
        $data['result']= $this->evaluation_result_model->getById($id);
        //print_r($data['result']);exit;
        $this->load->view('evaluation_pdf', $data);
    }
	   public function print_sup($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->evaluation_result_model->getById($id);
		//print_r($data['current']);exit;
       
	        $data['title']='Supplier Evaluation Result Profile';
        $this->template->load('template','ev_sup_print',$data);
    } 

}

?>