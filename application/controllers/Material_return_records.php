<?php

//session_start(); //we need to start session in order to access it through CI

Class Material_return_records extends CI_Controller {

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
//$this->load->model('material_return_model');
$this->load->model('material_return_model');
//$this->load->library('excel');
}

// Show login page
/*public function Gir_list_for_return() {
    $data['title']=' GIR Register List For Return';
    if($this->input->get())
    {
        $conditions['supplier_id']=$this->input->get('supplier_id');
        $conditions['categories_id']=$this->input->get('categories_id');
        $conditions['gir_no']=$this->input->get('gir_no');
        $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
        //print_r($conditions);exit;
        $data['gir_data'] = $this->material_return_model->gir_list_by_filter($conditions);
        //print_r($data['gir_data']);exit;
    }
    else
    {
        $data['gir_data'] = $this->material_return_model->getListGeneral();
    }
    $data['all_suppliers']=$this->material_return_model->getAllSuppliers();
    $data['gir_nos']=$this->material_return_model->getGIRno();
    //$data['Items']=$this->material_return_model->getItems();
   //$data['gir_data']=$this->material_return_model->getListGeneral();
    $data['categories']=$this->material_return_model->getCategories();
    //$data['states']=$this->material_return_model->getStates();
    $this->template->load('template','material_return_gir_list',$data);
}
  */

public function add() {
    $data = array();
    $code = $this->material_return_model->getMReturnCode();
    //print_r($result);exit;
    if (isset($code)) {
        $data['voucher_code']= $code;
        $voucher_no= $code;
        if($voucher_no<10){
        $gir_id_code='MR000'.$voucher_no;
        }
        else if(($voucher_no>=10) && ($voucher_no<=99)){
          $gir_id_code='MR00'.$voucher_no;
        }
        else if(($voucher_no>=100) && ($voucher_no<=999)){
          $gir_id_code='MR0'.$voucher_no;
        }
        else{
          $gir_id_code='MR'.$voucher_no;
        }
    }
    //print_r($employee_id_code);exit;
    $data['voucher_code_view']=$gir_id_code;
    $data['title']='Material Out Return Register';
    $data['suppliers']=$this->material_return_model->getSuppliers();
    $data['items']=$this->material_return_model->getMaterials();
    $data['units'] = $this->material_return_model->getUnits();
    //$this->load->model('login_database');
    $data['categories'] = $this->material_return_model->getCategories();
    //$data['states']=$this->material_return_model->getStates();
    //print_r($data['items']);exit;
    $this->template->load('template','material_return_add',$data);
}

	public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
	$result = $this->material_return_model->getById($id);
	//print_r($result);exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;
	//print_r($result['0']['gir_no']);exit;
	if (isset($result[0]['gir_no']) && $result[0]['gir_no']) :
	
		$data['g_no'] = $result[0]['gir_no'];
		$voucher_no= $data['g_no'];
		if($voucher_no<10){
		$gir_id_code='GIR000'.$voucher_no;
		}
		else if(($voucher_no>=10) && ($voucher_no<=99)){
		  $gir_id_code='GIR00'.$voucher_no;
		}
		else if(($voucher_no>=100) && ($voucher_no<=999)){
		  $gir_id_code='GIR0'.$voucher_no;
		}
		else{
		  $gir_id_code='GIR'.$voucher_no;
		}
		//print_r($employee_id_code);exit;
		$data['gir_no']=$gir_id_code;
	else:
		$data['gir_no'] = '';
	endif;
			
	if (isset($result[0]['challan_no']) && $result[0]['challan_no']) :
        $data['challan_no'] = $result[0]['challan_no'];
    else:
        $data['challan_no'] = '';
    endif;
    	/* if (isset($result[0]['gir_no']) && $result[0]['gir_no']) :
        $data['gir_no'] = $result[0]['gir_no'];
    else:
        $data['gir_no'] = '';
    endif; */
	
    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;
     if (isset($result[0]['categories_id']) && $result[0]['categories_id']) :
        $data['categories_id'] = $result[0]['categories_id'];
    else:
        $data['categories_id'] = '';
    endif;
    if (isset($result[0]['category']) && $result[0]['category']) :
        $data['category'] = $result[0]['category'];
    else:
        $data['category'] = '';
    endif;
    if (isset($result[0]['supplier']) && $result[0]['supplier']) :
        $data['supplier'] = $result[0]['supplier'];
    else:
        $data['supplier'] = '';
    endif;
	 if (isset($result[0]['weight_slip_no']) && $result[0]['weight_slip_no']) :
        $data['weight_slip_no'] = $result[0]['weight_slip_no'];
    else:
        $data['weight_slip_no'] = '';
    endif;
	    if (isset($result[0]['actual_weight']) && $result[0]['actual_weight']) :
        $data['actual_weight'] = $result[0]['actual_weight'];
    else:
        $data['actual_weight'] = '';
    endif;
	    if (isset($result[0]['doc_weight']) && $result[0]['doc_weight']) :
        $data['doc_weight'] = $result[0]['doc_weight'];
    else:
        $data['doc_weight'] = '';
    endif;
	    if (isset($result[0]['weight']) && $result[0]['weight']) :
        $data['weight'] = $result[0]['weight'];
    else:
        $data['weight'] = '';
    endif;
	    if (isset($result[0]['truck_no']) && $result[0]['truck_no']) :
        $data['truck_no'] = $result[0]['truck_no'];
    else:
        $data['truck_no'] = '';
    endif;
	    /*if (isset($result[0]['sample_tested']) && $result[0]['sample_tested']) :
        $data['sample_tested'] = $result[0]['sample_tested'];
    else:
        $data['sample_tested'] = '';
    endif;*/
	    if (isset($result[0]['payment']) && $result[0]['payment']) :
        $data['payment'] = $result[0]['payment'];
    else:
        $data['payment'] = '';
    endif;
     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = date('d-m-Y');
    endif; 
    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;
	 if (isset($result[0]['material_received_from']) && $result[0]['material_received_from']) :
        $data['material_received_from'] = $result[0]['material_received_from'];
    else:
        $data['material_received_from'] = '';
    endif;

    if (isset($result[0]['comments']) && $result[0]['comments']) :
        $data['comments'] = $result[0]['comments'];
    else:
        $data['comments'] = '';
    endif;


     if (isset($result[0]['gir_details']) && $result[0]['gir_details']) :
        $data['gir_details'] = $result[0]['gir_details'];
    else:
        $data['gir_details'] = '';
    endif;

	$data['title']='Edit GIR Register';
	$data['suppliers']=$this->material_return_model->getSuppliers($data['categories_id']);
	$this->load->model('categories_model');
	$data['items']=$this->categories_model->getProductsByCategory($data['categories_id']);
    $data['units'] = $this->material_return_model->getUnits();
	$this->load->model('login_database');
    $data['categories'] = $this->material_return_model->getCategories();
	//$data['states']=$this->material_return_model->getStates();
	$this->template->load('template','gir_register_edit',$data);

	//$this->load->view('footer');
	
	}
	
	public function index(){
			//$vv=$this->encrypt->encode('hy');
			//print_r($vv);exit;
			$data['title']=' GIR Register List';
			if($this->input->get())
			{
		 	    $conditions['supplier_id']=$this->input->get('supplier_id');
		 	    $conditions['categories_id']=$this->input->get('categories_id');
				$conditions['voucher_code']=$this->input->get('voucher_code');
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	    $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				//print_r($conditions);exit;
                $data['gir_data'] = $this->material_return_model->gir_list_by_filter($conditions);
				//print_r($data['gir_data']);exit;
			}
            else
            {
			    $data['gir_data'] = $this->material_return_model->getListGeneral();
			}
			$data['all_suppliers']=$this->material_return_model->getAllSuppliers();
			$data['gir_nos']=$this->material_return_model->getGIRno();
			//$data['Items']=$this->material_return_model->getItems();
           //$data['gir_data']=$this->material_return_model->getListGeneral();
			$data['categories']=$this->material_return_model->getCategories();
			//$data['states']=$this->material_return_model->getStates();
			$this->template->load('template','material_return_view',$data);
		}



	public function add_new_gir() {
		$this->form_validation->set_rules('gate_pass_no', 'Gate Pass No', 'required');
		//$products=[];
	
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
			/*$count_row = $this->material_return_model->rowcount();
			$voucher_no=$count_row+1;*/

			$login_id=$this->session->userdata['logged_in']['id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
            'return_date' => date('Y-m-d',strtotime($this->input->post('return_date'))),
			//'gir_no' => $voucher_no,
			'voucher_code' => $this->input->post('gir_no'),
            'gate_pass_no' => $this->input->post('gate_pass_no'),
			'categories_id' => $this->input->post('categories_id'),
			'transporter_id' => $this->input->post('transporter_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'comments' => $this->input->post('comments'),
			'total_qty' => $this->input->post('total_qty'),
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->material_return_model->gir_insert($data);
			if ($result == TRUE)
			{
				$this->session->set_flashdata('success', 'Data inserted Successfully !');
				redirect('/Material_return_records/index', 'refresh');
			}
			//$this->fetchSuppliers();
		  else {
	
				$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
				redirect('/Material_return_records/index', 'refresh');
			}
			
		}
	}

	public function edit_gir($id){
		$this->form_validation->set_rules('products[]', 'Product', 'required');
		$this->form_validation->set_rules('challan_no', 'Challan No', 'required');
		

		if ($this->form_validation->run() == FALSE) 
		{
			
			if(isset($this->session->userdata['logged_in'])){
				$this->edit($id);
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
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			//'gir_no' => $voucher_no,
			'gir_no' => $this->input->post('gir_no'),
            'purchase_order_id' => $this->input->post('po_id'),
			'challan_no' => $this->input->post('challan_no'),
			'categories_id' => $this->input->post('categories_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'transporter_id' => $this->input->post('transporter_id'),
			'weight_slip_no' => $this->input->post('weight_slip_no'),
			'actual_weight' => $this->input->post('actual_weight'),
			'doc_weight' => $this->input->post('doc_weight'),
			'weight' => $this->input->post('weight'),
			'truck_no' => $this->input->post('truck_no'),
			/*'sample_tested' => $this->input->post('sample_tested'),*/
			'payment' => $this->input->post('payment'),
			'material_received_from' => $this->input->post('material_received_from'),
			'total_qty' => $this->input->post('total_qty'),
			'comments' => $this->input->post('comments'),
			'edited_by' => $login_id
			);
			$old_id = $this->input->post('gir_id_old'); 
			//print_r($this->input->post('products[]'));exit;
			$result = $this->material_return_model->editGIR($data,$old_id);
			if ($result == TRUE) 
			{
				$categories_id=$this->input->post('categories_id');
				if($categories_id =='1'){
					$this->session->set_flashdata('success', 'Data inserted Successfully !');
					redirect('/Material_return_records/rm_gir_index', 'refresh');
				}
				else{
					$this->session->set_flashdata('success', 'Data inserted Successfully !');
					redirect('/Material_return_records/index', 'refresh');
				}
		
			} else {
				$categories_id=$this->input->post('categories_id');
				if($categories_id =='1'){
					$this->session->set_flashdata('failed', 'No changes in gir details!');
					redirect('/Material_return_records/rm_gir_index', 'refresh');
				}
				else{
					$this->session->set_flashdata('failed', 'No changes in gir details!');
					redirect('/Material_return_records/index', 'refresh');
				}
			//$this->template->load('template','supplier_view');
			}
		}
	}

	public function deletegirGEN($id= null){
  	 	$ids=$this->input->post('ids');
		if(!empty($ids)) 
		{
			$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$this->material_return_model->deletegir($id);
  	 		}
	 			echo $this->session->set_flashdata('success', 'GIR Registers deleted Successfully !');
		}
		else
		{
  	 		$id = $this->uri->segment('3');
  	 		$this->material_return_model->deletegir($id);
  	 		$this->session->set_flashdata('success', 'GIR Register deleted Successfully !');
  	 		redirect('/Material_return_records/index', 'refresh');
	 			//$this->fetchSuppliers(); //render the refreshed list.
	 	}
  	 }
	 public function report() 
	{
		$data['title'] = 'GIR Register Report';
		$data['gir_data'] = $this->material_return_model->getListGeneral();
		
		$this->template->load('template','gir_register_report',$data);
	}
 function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');
        $empInfo = $this->material_return_model->export_csv();
		
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'GIR Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Invoice Number/ Challan Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Category');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Supplier');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Material Received Through');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Comment');       
        /*$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Approval Category');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Bank Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Account No');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Service State');       
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Date of Approval');       
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Date of Evalution ');  */     
        // set Row
        $rowCount = 2;
        foreach ($empInfo as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['gir_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['challan_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['category_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['supplier_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['material_received_from']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['comments']);
            /*$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element['category_of_approval']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element['bank_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element['account_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element['state']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['date_of_approval']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $element['date_of_evalution']);*/
            $rowCount++;
        }
       // //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="GIRRegisterData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Material_return_records/index', 'refresh');     
    }
	 public function CheckGirCode($supplier_code)
   {
   	 $isExist = $this->material_return_model->CheckGirCode($supplier_code);
   	 if(!empty($isExist)){
   	 	echo json_encode($isExist);	
   	 }
   	 
   } 
    public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->material_return_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Material Return Record  Profile';
        $this->template->load('template','material_return_print',$data);
    } 
}

?>

