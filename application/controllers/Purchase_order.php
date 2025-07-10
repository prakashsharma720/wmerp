<?php

//session_start(); //we need to start session in order to access it through CI

Class Purchase_order extends CI_Controller {

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

// Load database
//$this->load->model('po_model');
$this->load->model('po_model');
$this->load->model('notifications_model');
//$this->load->library('excel');
}

// Show login page
public function ApprovedReqListForPO() {
		$data = array();
		$data['title']='Pending Requisition Slips for Purchase Order';
		$data['requisition_data']=$this->po_model->getApprovedRequisitions();
		//print_r($data['requisition_data']);exit;
		/*$data['employees']=$this->issue_slip_model->getEmployees();
		$data['items']=$this->issue_slip_model->getItems();	
		//$data['departments'] = $this->issue_slip_model->getDepartments();
		$this->load->model('gir_register_model');
		$data['units'] = $this->gir_register_model->getUnits();*/
		$this->template->load('template','req_list_for_po',$data);
	}
public function add($id=Null) {
	$data = array();
	
	$data['title']='Create Purchase Order';
	$data['po_no'] = $this->po_model->getPOCode();
	$voucher_no= $data['po_no'];
    if($voucher_no<10){
    $po_number='CNC/PO/000'.$voucher_no;
    }
    else if(($voucher_no>=10) && ($voucher_no<=99)){
      $po_number='CNC/PO/00'.$voucher_no;
    }
    else if(($voucher_no>=100) && ($voucher_no<=999)){
      $po_number='CNC/PO/0'.$voucher_no;
    }
    else{
      $po_number='CNC/PO/'.$voucher_no;
    }
    $data['po_code_view']=$po_number;
    
	$data['suppliers']=$this->po_model->getSuppliers();
	$this->load->model('requisition_slip_model');
	$data['items']=$this->requisition_slip_model->getItems();
	$data['requisitions']=$this->po_model->getApprovedRequisitionsPO($id=Null);
	// echo "<pre>";print_r($data['requisitions']);exit;
	$data['grades']=$this->po_model->getGrades();
	//$data['states']=$this->po_model->getStates();
	$this->template->load('template','po_add',$data);
	//$this->load->view('footer');
	
	}
	
public function edit($id=NULL) {
	//$id = decrypt_url($gir_id);
	//print_r($pid);exit;
	$data = array();
	$result = $this->po_model->getById($id);
	//print_r();exit;

	if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

    if (isset($result[0]['id']) && $result[0]['id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;

     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = '';
    endif; 
     if (isset($result[0]['quotation_date']) && $result[0]['quotation_date']) :
        $data['quotation_date'] = $result[0]['quotation_date'];
    else:
        $data['quotation_date'] = '';
    endif; 
    if (isset($result[0]['po_number']) && $result[0]['po_number']) :
        $data['po_number'] = $result[0]['po_number'];
    else:
        $data['po_number'] = '';
    endif;
    if (isset($result[0]['quotation_no']) && $result[0]['quotation_no']) :
        $data['quotation_no'] = $result[0]['quotation_no'];
    else:
        $data['quotation_no'] = '';
    endif;

    if (isset($result[0]['total_qty']) && $result[0]['total_qty']) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif;

    if (isset($result[0]['total_amount']) && $result[0]['total_amount']) :
        $data['total_amount'] = $result[0]['total_amount'];
    else:
        $data['total_amount'] = '';
    endif; 
    if (isset($result[0]['discount_type']) && $result[0]['discount_type']) :
        $data['discount_type'] = $result[0]['discount_type'];
    else:
        $data['discount_type'] = '';
    endif; 
    if (isset($result[0]['discount']) && $result[0]['discount']) :
        $data['discount'] = $result[0]['discount'];
    else:
        $data['discount'] = '';
    endif; 
    if (isset($result[0]['discount_amount']) && $result[0]['discount_amount']) :
        $data['discount_amount'] = $result[0]['discount_amount'];
    else:
        $data['discount_amount'] = '';
    endif; 
    if (isset($result[0]['grand_total']) && $result[0]['grand_total']) :
        $data['grand_total'] = $result[0]['grand_total'];
    else:
        $data['grand_total'] = '';
    endif; 
    if (isset($result[0]['gst_amount']) && $result[0]['gst_amount']) :
        $data['gst_amount'] = $result[0]['gst_amount'];
    else:
        $data['gst_amount'] = '';
    endif;
     if (isset($result[0]['gst_per']) && $result[0]['gst_per']) :
        $data['gst_per'] = $result[0]['gst_per'];
    else:
        $data['gst_per'] = '';
    endif;
    if (isset($result[0]['delivery_period']) && $result[0]['delivery_period']) :
        $data['delivery_period'] = $result[0]['delivery_period'];
    else:
        $data['delivery_period'] = '';
    endif;
    if (isset($result[0]['payment_term']) && $result[0]['payment_term']) :
        $data['payment_term'] = $result[0]['payment_term'];
    else:
        $data['payment_term'] = '';
    endif; 
    if (isset($result[0]['reference_by']) && $result[0]['reference_by']) :
        $data['reference_by'] = $result[0]['reference_by'];
    else:
        $data['reference_by'] = '';
    endif;  
    if (isset($result[0]['freight_status']) && $result[0]['freight_status']) :
        $data['freight_status'] = $result[0]['freight_status'];
    else:
        $data['freight_status'] = '';
    endif; 

    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
     if (isset($result[0]['po_details']) && $result[0]['po_details']) :
        $data['po_details'] = $result[0]['po_details'];
    else:
        $data['po_details'] = '';
    endif;
    //print_r($data['po_details']);exit;
	$data['title']='Create Purchase Order';
	$data['suppliers']=$this->po_model->getSuppliers();
	$this->load->model('requisition_slip_model');
	$data['items']=$this->requisition_slip_model->getItems();
	//print_r($data['items']);exit;
	$data['grades']=$this->po_model->getGrades();
	//$data['states']=$this->po_model->getStates();
	$this->template->load('template','po_edit',$data);


	//$this->load->view('footer');
	
	}

	public function index(){
			$data['title']=' Purchase Order List';
			//$data['suppliers']=$this->po_model->getSuppliers();
			//$data['Items']=$this->po_model->getItems();
			$data['po_data']=$this->po_model->getList();
			//$data['states']=$this->po_model->getStates();
			$this->template->load('template','po_view',$data);
		}

		public function report() 
		{
			$data['title'] = 'Purchase Orders Report';
			if($this->input->get())
			{
			 	$conditions['supplier_id']=$this->input->get('supplier_id');
			 	$conditions['department_id']=$this->input->get('department_id');
			 	$conditions['admin_approval']=$this->input->get('admin_approval');
			 	$conditions['purchase_indent']=$this->input->get('purchase_indent');
			 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
	        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
			 	$data['conditions']=$conditions;
			 	//print_r($data['conditions']);exit;
	           $data['po_data'] = $this->po_model->getList($conditions);

			}
			/*else{
				$data['po_data'] = $this->po_model->getList();
			}
			*/
			$data['employees'] = $this->po_model->getEmployees();
			$data['departments'] = $this->po_model->getDepartments();
			$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
			//echo var_dump($data['students']);
			$this->template->load('template','po_report',$data);
		}

	public function add_new_po() {
		$this->form_validation->set_rules('quotation_no', 'Quatation No', 'required');
		$this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
		$total_pending_qty=$this->input->post('pending_total_qty');
		$final_total_amount=$this->input->post('final_total_amount');
        $req_id=$this->input->post('req_id');
       //print_r($total_pending_qty);exit;
        if($total_pending_qty=='0.00'){
            $this->po_model->updateRequisitionPOCompleted($req_id);
        }

        if(round($final_total_amount) <='5000'){
            $purchase_indent='1';
        }else{
        	$purchase_indent='0';
        }

		/*$this->form_validation->set_rules('products[]', 'Product', 'required');
		$this->form_validation->set_rules('grade', 'Grade', 'required');
		$this->form_validation->set_rules('rm_code', 'RM Code', 'required');*/
		//$products=[];
		//$products=$this->input->post('products');
		/*$grade=$this->input->post('grade');
		$qty=$this->input->post('qty');
		$rate=$this->input->post('rate');
		$total=$this->input->post('total');*/
		//print_r($products);exit;
		//$voucher_no='0';
		/*if ($this->form_validation->run() == FALSE) 
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
		{*/
		/*	$count_row = $this->po_model->rowcount();
			$voucher_no=$count_row+1;*/

			$login_id=$this->session->userdata['logged_in']['id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'quotation_date' => date('Y-m-d',strtotime($this->input->post('quotation_date'))),
			'voucher_no' => $this->input->post('po_number'),
			'po_number' => $this->input->post('po_number'),
			'department_id' => $department_id,
			'requisition_slip_id' => $this->input->post('req_id'),
			'supplier_id' => $this->input->post('supplier_id'),
			'quotation_no' => $this->input->post('quotation_no'),
			'total_qty' => $this->input->post('total_qty'),
			'total_amount' => $this->input->post('total_amount'),
			'discount_type' => $this->input->post('discount_type'),
			'discount' => $this->input->post('discount'),
			'discount_amount' => $this->input->post('discount_amount'),
			'gst_per' => $this->input->post('tax_per'),
			'gst_amount' => $this->input->post('gst_amount'),
			'grand_total' => $this->input->post('final_total_amount'),
			'reference_by' => $this->input->post('reference_by'),
			'delivery_period' => $this->input->post('delivery_period'),
			'payment_term' => $this->input->post('payment_term'),
			'freight_status' => $this->input->post('freight_status'),
			'purchase_indent' => $purchase_indent,
			'comment' => $this->input->post('comment'),
			'created_by' => $login_id
			);
			//print_r($data);exit;
			$result = $this->po_model->po_insert($data);
			if ($result == TRUE) {
			$data1 = array(
				'type' => 'Purchase Order',
				'subject' => 'Purchase Order Creation',
				'message' => 'Created a Purchase Order for',
				'page_url' => 'Purchase_order/index',
				'status' => '0',
				'datetime' => date('Y-m-d h:i:s'),
				'created_by' => $login_id,
				);
			$result1 = $this->notifications_model->add_notification($data1);	
				
			$this->session->set_flashdata('success', 'Data inserted Successfully !');
			redirect('/Purchase_order/index', 'refresh');
			//$this->fetchSuppliers();
			} else {
			$this->session->set_flashdata('failed', 'Insertion Failed ! Data already exists');
			redirect('/Purchase_order/index', 'refresh');
			}
		//}
	}

	public function edit_po($id){
		$this->form_validation->set_rules('quotation_no', 'Quatation No', 'required');
		$this->form_validation->set_rules('supplier_id', 'Supplier Name', 'required');
		/*if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session->userdata['logged_in'])){
				$this->add($id);
			//$this->load->view('admin_page');
			}else{
			$this->load->view('login_form');
			}
			//$this->template->load('template','supplier_edit');
		} 
		else 
		{*/
			
			$login_id=$this->session->userdata['logged_in']['id'];
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$data = array(
			'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
			'voucher_no' => $this->input->post('po_number'),
			'po_number' => $this->input->post('po_number'),
			'supplier_id' => $this->input->post('supplier_id'),
			'quotation_no' => $this->input->post('quotation_no'),
			'department_id' => $department_id,
			'requisition_slip_id' => $this->input->post('req_id'),
			'quotation_date' => date('Y-m-d',strtotime($this->input->post('quotation_date'))),
			'total_qty' => $this->input->post('total_qty'),
			'total_amount' => $this->input->post('total_amount'),
			'discount_type' => $this->input->post('discount_type'),
			'discount' => $this->input->post('discount'),
			'discount_amount' => $this->input->post('discount_amount'),
			'gst_per' => $this->input->post('tax_per'),
			'gst_amount' => $this->input->post('gst_amount'),
			'grand_total' => $this->input->post('final_total_amount'),
			'reference_by' => $this->input->post('reference_by'),
			'delivery_period' => $this->input->post('delivery_period'),
			'payment_term' => $this->input->post('payment_term'),
			'freight_status' => $this->input->post('freight_status'),
			'comment' => $this->input->post('comment'),
			'created_by' => $login_id
			);
			$old_id = $this->input->post('po_id_old'); 
			//print_r($data);exit;
			$result = $this->po_model->editPO($data,$old_id);
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'Data Updated Successfully !');
			redirect('/Purchase_order/index', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'No changes in PO details!');
			redirect('/Purchase_order/index', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		//}
	}
		public function deletePO($id= null){
			$ids=$this->input->post('ids');
			if(!empty($ids)) {
				$Datas=explode(',', $ids);
	  	 		foreach ($Datas as $key => $id) {
	  	 			$this->po_model->deletePO($id);
	  	 		}
  	 			echo $this->session->set_flashdata('success', 'Purchase Order deleted Successfully !');
			}
			else{
  	 		$id = $this->uri->segment('3');
  	 		$this->po_model->deletePO($id);
  	 		$this->session->set_flashdata('success', 'Purchase Order deleted Successfully !');
  	 		redirect('/Purchase_order/index', 'refresh');
  	 		}
  	 		//$this->fetchSuppliers(); //render the refreshed list.
  	 	}
  	 	/*public function deletePOBulk($id= null){
  	 		$ids=$this->input->post('ids');
  	 		$Datas=explode(',', $ids);
  	 		foreach ($Datas as $key => $id) {
  	 			$this->po_model->deletePO($id);

  	 		}
  	 		echo $this->session->set_flashdata('success', 'Purchase Order deleted Successfully !');
  	 	}*/
  	 public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->po_model->getById($id);
		$grand_total=$data['current']['0']['grand_total'];
    	$data['amount_in_words']=$this->convert_number_to_words(round($grand_total)); 
		//print_r($data['current']);exit;
		if($data['current']['0']['purchase_indent']=='1'){
			$data['title']='Purchase Indent ';
	    	$this->template->load('template','po_print_indent',$data);
		}else{
			$data['title']='Purchase Order ';
	    	$this->template->load('template','po_print',$data);
		}


    } 
    function convert_number_to_words($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        100000             => 'lakh',
        10000000          => 'crore'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . $this->convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . $this->convert_number_to_words($remainder);
            }
            break;
        case $number < 100000:
            $thousands   = ((int) ($number / 1000));
            $remainder = $number % 1000;

            $thousands = $this->convert_number_to_words($thousands);

            $string .= $thousands . ' ' . $dictionary[1000];
            if ($remainder) {
                $string .= $separator . $this->convert_number_to_words($remainder);
            }
            break;
        case $number < 10000000:
            $lakhs   = ((int) ($number / 100000));
            $remainder = $number % 100000;

            $lakhs = $this->convert_number_to_words($lakhs);

            $string = $lakhs . ' ' . $dictionary[100000];
            if ($remainder) {
                $string .= $separator . $this->convert_number_to_words($remainder);
            }
            break;
        case $number < 1000000000:
            $crores   = ((int) ($number / 10000000));
            $remainder = $number % 10000000;

            $crores = $this->convert_number_to_words($crores);

            $string = $crores . ' ' . $dictionary[10000000];
            if ($remainder) {
                $string .= $separator . $this->convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= $this->convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}


    public function approval(){
			$department_id=$this->session->userdata['logged_in']['department_id'];
			$role_id=$this->session->userdata['logged_in']['role_id'];
			$data['title']=' Pending Purchase Order for Approval';
			$data['po_data']=$this->po_model->getPOListforApproval();
			//print_r($data['po_data']);exit;
			$this->template->load('template','po_approval',$data);
			
			//$data['states']=$this->requisition_slip_model->getStates();
		}

	public function ActionPO()
	{
		$role_id=$this->session->userdata['logged_in']['role_id'];
		$login_id=$this->session->userdata['logged_in']['id'];
		$po_id=$this->input->post('po_id');
		$status=$this->input->post('status');
		if($status=='Rejected'){
			$data = array(
			'admin_approval' => 'Rejected',
			'approved_on' =>$this->input->post('rejected_date'),
			'action_comment' => $this->input->post('rejected_reason'),
			'approved_by' => $login_id
			);
			$result = $this->po_model->actionPO($data,$po_id);
			if ($result == TRUE) {
			$this->session->set_flashdata('failed', 'Purchase Order rejected successfully !');
			redirect('/Purchase_order/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect('/Purchase_order/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}
		if($status=='Approved'){
			$data = array(
			'admin_approval' => 'Approved',
			'approved_on' =>$this->input->post('approved_date'),
			'action_comment' => $this->input->post('approve_comment'),
			'approved_by' => $login_id
			);
			$result = $this->po_model->actionPO($data,$po_id);
			if ($result == TRUE) {

			$this->session->set_flashdata('success', 'Purchase Order approved successfully !');
			redirect('/Purchase_order/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			} else {
			$this->session->set_flashdata('failed', 'Operation Failed !');
			redirect('/Purchase_order/approval', 'refresh');
			//$this->template->load('template','supplier_view');
			}
		}

	}
	 function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{
			$conditions['supplier_id']=$this->input->post('supplier_id');
		 	$conditions['department_id']=$this->input->post('department_id');
		 	$conditions['admin_approval']=$this->input->post('admin_approval');
		 	$conditions['purchase_indent']=$this->input->post('purchase_indent');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->po_model->getList($conditions);
		}
		/*else
		{
			$reqSlipInfo = $this->po_model->getList();
		}*/
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Po No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Order Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Supplier');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Purchase Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Department');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Quatation No');      
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Grand Total');      
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Material Name');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Quantity');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Price');       
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Total');       
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
        	
    	foreach ($element['po_details'] as $element2) {
    		$voucher_no=$element['po_number'];
    		if($voucher_no<10){
		    $po_number='CNC/A/000'.$voucher_no;
		    }
		    else if(($voucher_no>=10) && ($voucher_no<=99)){
		      $po_number='CNC/A/00'.$voucher_no;
		    }
		    else if(($voucher_no>=100) && ($voucher_no<=999)){
		      $po_number='CNC/A/0'.$voucher_no;
		    }
		    else{
		      $po_number='CNC/A/'.$voucher_no;
		    }

		    if($element['purchase_indent']=='1') {
                  $order_type='Purchase Indent';
                }else{
                  $order_type='Purchase Order';
                }
            $quantity=$element2['quantity'].' '.$element2['unit'];

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $po_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $order_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['supplier']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['department']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['quotation_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['grand_total']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['material_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $quantity);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['rate']);	
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element2['amount']);	
            $rowCount++;
        	}
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="purchase_order_report.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Purchase_order/report', 'refresh');     
    }

}

?>