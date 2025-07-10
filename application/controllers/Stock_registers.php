<?php

//session_start(); //we need to start session in order to access it through CI

Class Stock_registers extends CI_Controller {

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
//$this->load->model('stock_registers_model');
$this->load->model('stock_registers_model');
//$this->load->library('excel');
}

// Show login page
public function materials() {
	$data = array();
	$data['title']=' Material Stock Register';
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];

	
	if($this->input->post())
	{
			$conditions['item_id']=$this->input->post('item_id');
	 	    //$conditions['categories_id']=$this->input->post('categories_id');
	 	    $conditions['employee_id']=$this->input->post('employee_id');
	 	    $conditions['department_id']=$this->input->post('department_id');


			if(!empty($this->input->post('status'))){
			$conditions['status']=$this->input->post('status');
			}
			//print_r($this->input->post('from_date'));exit;
			if(!empty($this->input->post('from_date'))){
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
			}
			if(!empty($this->input->post('upto_date'))){
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
			}
    	    
			//print_r($conditions);exit;
            $data['materialStock'] = $this->stock_registers_model->getMaterialsStock($conditions);
	}

	else {
				$conditions['item_id']='';
	 	    $conditions['employee_id']='';
	 	    $conditions['department_id']='';
	 	    $conditions['status']='';
	 	    $conditions['from_date']='';
	 	    $conditions['upto_date']='';
		$data['materialStock']=$this->stock_registers_model->getMaterialsStock();
	}

	$data['status']= array('Select Status'=>'Select Status','In' => 'In','Out'=>'Out');
	$data['items']=$this->stock_registers_model->getItems();
	$data['categories']=$this->stock_registers_model->getCategories();
	$data['departments'] = $this->stock_registers_model->getDepartments();
	//$this->load->model('gir_register_model');
	$data['employees'] = $this->stock_registers_model->getEmployees();
	//$data['grades']=$this->stock_registers_model->getGrades();
	//$data['states']=$this->stock_registers_model->getStates();
	$this->template->load('template','stock_register_materials',$data);
	
	}

	public function item_wise() {
	$data = array();
	$data['title']=' Item Wise Stock Register';
	$data['login_id']=$this->session->userdata['logged_in']['id'];
	$data['department_id']=$this->session->userdata['logged_in']['department_id'];
	$role_id=$this->session->userdata['logged_in']['role_id'];

	//$data['suppliers']=$this->stock_registers_model->getSuppliers();
	
	
	if($this->input->post())
	{
			$conditions['item_id']=$this->input->post('item_id');
	 	    //$conditions['categories_id']=$this->input->post('categories_id');
	 	    $conditions['employee_id']=$this->input->post('employee_id');
	 	    $conditions['department_id']=$this->input->post('department_id');
			$conditions['status']=$this->input->post('status');
			//print_r($this->input->post('from_date'));exit;
			if(!empty($this->input->post('from_date'))){
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
			}
			if(!empty($this->input->post('upto_date'))){
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
			}
    	    
			//print_r($conditions);exit;
            $data['materialStock'] = $this->stock_registers_model->getMaterialsStock($conditions);
	}
	else{
		$data['materialStock']=$this->stock_registers_model->getMaterialsStock();
	}

	$data['status']= array('Select Status'=>'Select Status','In' => 'In','Out'=>'Out');
	$data['items']=$this->stock_registers_model->getItems();
	$data['categories']=$this->stock_registers_model->getCategories();
	$data['departments'] = $this->stock_registers_model->getDepartments();
	//$this->load->model('gir_register_model');
	$data['employees'] = $this->stock_registers_model->getEmployees();
	//$data['grades']=$this->stock_registers_model->getGrades();
	//$data['states']=$this->stock_registers_model->getStates();
	$this->template->load('template','stock_register_materials',$data);
	
	//$this->load->view('footer');
	
	}


	public function current_Stocks(){
			$data['title']=' Stock Available';
			//$data['suppliers']=$this->stock_registers_model->getSuppliers();
			//$data['Items']=$this->stock_registers_model->getItems();
			$data['stocks']=$this->stock_registers_model->getCurrentStock();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->stock_registers_model->getStates();
			$this->template->load('template','current_stock',$data);
		}
	public function myStock(){
			$data['title']=' Stock Available';
			//$data['suppliers']=$this->stock_registers_model->getSuppliers();
			//$data['Items']=$this->stock_registers_model->getItems();
			$data['stocks']=$this->stock_registers_model->getMyStock();
			//print_r($data['requisition_data']);exit;
			//$data['states']=$this->stock_registers_model->getStates();
			$this->template->load('template','my_stock',$data);
		}

		// public function report() 
		// {
		// 	$data['title'] = 'Suppliers Report';
		// 	//$data['suppliers'] = $this->stock_registers_model->supplier_list();
		// 	//echo var_dump($data['students']);
		// 	$this->template->load('template','supplier_report',$data);
		// }



		public function report() 
		{
			$data['title'] = 'Current Stock Report';

			if($this->input->get())
            {
                
                $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
                $data['conditions']=$conditions;
                // print_r($conditions);exit;
               $data['stocks']=$this->stock_registers_model->getCurrentStock($conditions);
			
               
            }
            else
            {
                $data['stocks']=$this->stock_registers_model->getCurrentStock();
            }

			$this->template->load('template','current_stock_report',$data);
		}

		function createXLS() {
  	  
	        $fileName ='data-'.time().'.xls';  
	        // load excel library
	        $this->load->library('excel');

				// print_r($this->input->post()); die;

			if($this->input->post())
            {
                
                $conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
                // print_r($conditions);exit;
               $reqSlipInfo=$this->stock_registers_model->getCurrentStock($conditions);
			
               
            }
            else
            {
                $reqSlipInfo=$this->stock_registers_model->getCurrentStock();
            }


	         $objPHPExcel = new PHPExcel();  
	        $objPHPExcel->setActiveSheetIndex(0);

	    	

	        // set Header
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Material Description');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date');
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Total In Qty (Unit)');
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total Out Qty (Unit)'); 
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Available Qty (Unit)');   
	          
	        // set Row
	      
	        $rowCount = 2;
	        foreach ($reqSlipInfo as $key=>$element) {

	        	if($element['total_in']['total']!=''){
                  $total_in = $element['total_in']['total'].' '.$element['unit'];
                }else{
                  $total_in = '-';
                }
                if($element['total_out']['total']!=''){
                  $total_out =  $element['total_out']['total'].' '.$element['unit'];
                }else{
                  $total_out = '-';
                }

                $total_available= $element['total_in']['total']-$element['total_out']['total'];
                $available =  $total_available.' '.$element['unit'];

	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['item']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['transaction_date']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $total_in);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $total_out);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $available);
	            $rowCount++;
	            
	        }
	        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="Current_Stock_registers.xls"');
	        $objWriter->save('php://output');
	        //$objWriter->save($fileName);

	        
	        // download file

	        
	        redirect('/Stock_registers/report', 'refresh');     
    	}


  	  public function print($id) { 
		
		$id = $this->uri->segment('3');
		//echo $id;exit;
		$data['current'] = $this->stock_registers_model->getById($id);
		//print_r($data['current']);exit;
	    $data['title']='Stock registErs Profile';
        $this->template->load('template','requisition_print',$data);
    } 
    public function fg_stock_register() 
	{
		$data['title'] = 'FG Stock Report';
		$data['login_id']=$this->session->userdata['logged_in']['id'];
		$data['department_id']=$this->session->userdata['logged_in']['department_id'];
		$role_id=$this->session->userdata['logged_in']['role_id'];
		//$data['suppliers']=$this->stock_registers_model->getSuppliers();
		if($this->input->post())
		{
			// echo "<pre>";print_r($this->input->post());
			$conditions= [];
			if(!empty($this->input->post('finish_good_id'))){
				  $conditions['finish_good_id']=$this->input->post('finish_good_id');
			}
			if(!empty($this->input->post('employee_id'))){
				  $conditions['employee_id']=$this->input->post('employee_id');
			}
			if(!empty($this->input->post('department_id'))){
				  $conditions['department_id']=$this->input->post('department_id');
			}
			if(!empty($this->input->post('status'))){
				$conditions['status']=$this->input->post('status');
			}
			if(!empty($this->input->post('from_date'))){
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
			}
			if(!empty($this->input->post('upto_date'))){
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
			}
			//print_r($conditions);exit;
            $data['FGStockReport'] = $this->stock_registers_model->getFGStockReport($conditions);
			$data['conditions']=$conditions;
		}
		else{
			$data['FGStockReport'] = $this->stock_registers_model->getFGStockReport();
		}

		$data['status']= array('In' => 'In','Out'=>'Out');
		$data['items']=$this->stock_registers_model->getMaterialsList();
		$data['categories']=$this->stock_registers_model->getCategories();
		$data['departments'] = $this->stock_registers_model->getDepartments();
		//$this->load->model('gir_register_model');
		$data['employees'] = $this->stock_registers_model->getEmployees();
		//echo var_dump($data['students']);
		$this->template->load('template','fg_stock_report',$data);
	}
	public function fg_current_stock() 
	{
		$data['title'] = 'FG Stock Report';
		$data['FGStockReport'] = $this->stock_registers_model->getFGCurrentStock();
		
		//echo var_dump($data['students']);
		$this->template->load('template','fg_current_stock',$data);
	}


	public function FgCurrentStockReport() 
		{
			$data['title'] = 'FG Stock Report';

			if($this->input->get())
            {
                
                $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
                $data['conditions']=$conditions;
                // print_r($conditions);exit;
               $data['FGStockReport'] = $this->stock_registers_model->getFGCurrentStock($conditions);
			
               
            }
            else
            {
               $data['FGStockReport'] = $this->stock_registers_model->getFGCurrentStock();
            }


			$this->template->load('template','fg_currentStock_report',$data);
		}

		function FgCurrentStockCreateXLS() {
  	  
	        $fileName ='data-'.time().'.xls';  
	        // load excel library
	        $this->load->library('excel');

				// print_r($this->input->post()); die;

			if($this->input->post())
            {
                
                 $conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
                $conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
                $data['conditions']=$conditions;
                // print_r($conditions);exit;
                $reqSlipInfo=$this->stock_registers_model->getFGCurrentStock($conditions);
			
               
            }
            else
            {
                $reqSlipInfo=$this->stock_registers_model->getFGCurrentStock();
            }


	         $objPHPExcel = new PHPExcel();  
	        $objPHPExcel->setActiveSheetIndex(0);

	    	

	        // set Header
	         
	        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sr No');
	        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Finish Good');
	        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date');
	        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Total In Qty (Unit)');
	        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Total Out Qty (Unit)'); 
	        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Available Qty (Unit)');   
	          
	        // set Row
	      
	        $rowCount = 2;
	        foreach ($reqSlipInfo as $key=>$element) {

	        	if($element['total_in']['total']!=''){
                  $total_in = $element['total_in']['total'].' MT';
                }else{
                  $total_in = '-';
                }
                if($element['total_out']['total']!=''){
                  $total_out =  $element['total_out']['total'].' MT';
                }else{
                  $total_out = '-';
                }

                $total_available= $element['total_in']['total']-$element['total_out']['total'];
                $available =  $total_available.' MT';

	            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $key+1);
	            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['grade_name']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['transaction_date']);
	            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $total_in);
	            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $total_out);
	            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $available);
	            $rowCount++;
	            
	        }
	        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	      $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
	        header('Content-Type: application/vnd.ms-excel');
	        header('Content-Disposition: attachment;filename="MaterialStock_registers.xls"');
	        $objWriter->save('php://output');
	        //$objWriter->save($fileName);

	        
	        // download file

	        
	        redirect('/Fg Stock_registers/report', 'refresh');     
    	}

}

?>