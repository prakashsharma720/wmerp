<?php

Class Invoice_model extends MY_Model {
    private $table = 'invoices';
    private $detailTable = 'invoice_rows';
     private $previewtable = 'invoices_preview';
    private $previewdetailTable = 'invoice_preview_rows';


 public function __construct() {
        parent::__construct();
       
    }
    // Insert invoice preview data in database

    public function invoice_insert_preview($data) {

    $this->db->insert($this->previewtable, $data);
    $id = $this->db->insert_id();
    $this->invoiceDetailsPreview($id);
    if ($this->db->affected_rows() > 0) {
    return $id;
    }
    else { 
    return false;
    }
}
public function saverecords($inserdata) {
    foreach ($inserdata as $key => $value) {
        $data12['irn'] = $value['irn'];
			$data12['ack_no'] = $value['ack_no'];
			$data12['ack_date'] = date('Y-m-d H:i:s',strtotime($value['ack_date']));
			$data12['doc_no'] = $value['doc_no'];
			$data12['doc_typ'] = $value['doc_typ'];
			// Convert date format from '31/10/2022' to '2022-10-31'
             $dateParts = explode('/', $value['doc_date']);
            $date = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
            $data12['doc_date'] = $date;
			$data12['inv_value'] = $value['inv_value'];
			$data12['recipient'] = $value['recipient'];
			$data12['status'] = $value['status'];
			$data12['signqr'] = $value['signqr'];
			$data12['ewbno'] = $value['ewbno'];
            // print_r($data12);exit;
            $this->db->insert('imporinvoice', $data12);
            $id = $this->db->insert_id();
			// print_r($data12);exit;
            if ($this->db->affected_rows() <= 0) {
                return false; // If any row fails to insert, return false
            }
        }
        return true; 
}
public function checkInvoiceExists($doc_no) {
    $this->db->where('invoice_no', $doc_no);
    $query = $this->db->get('invoices');
    return $query->num_rows() > 0;
}
public function getByIRN($value){
   
    
    $this->db->where(['imporinvoice.doc_no'=>$value]);
    $query = $this->db->get('imporinvoice');
    
    return $query->num_rows() > 0;
}
/************** Invoice Details Insertion  Preview ******************/

 public function invoiceDetailsPreview($id) {
        $this->db->where('invoice_id', $id);
        $this->db->delete($this->previewdetailTable);   
        if ($this->input->post('finish_good_id')):
            foreach ($this->input->post('finish_good_id') as $key => $value) :
                $this->db->set('invoice_id', $id);
                $this->db->set('finish_good_id', $value);
                $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                $this->db->set('production_month', $this->input->post('production_month')[$key]);
                $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                $this->db->set('packing_size', $this->input->post('packing_size')[$key]);
                $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                $this->db->set('quantity', $this->input->post('qty')[$key]);
                $this->db->set('rate', $this->input->post('rate')[$key]);
                $this->db->set('tax_type', $this->input->post('tax_type')[$key]);
                $this->db->set('tax_per', $this->input->post('tax_per')[$key]);
                $this->db->set('tax_amount', $this->input->post('tax_amount')[$key]);
                $this->db->set('taxable_amount', $this->input->post('taxable_amount')[$key]);
                $this->db->set('amount', $this->input->post('amount')[$key]);
                $this->db->insert($this->previewdetailTable);
            endforeach;
        endif;                  

    }

     public function getByIdPreview($id){
        $this->db->select('invoices_preview.*, imporinvoice.signqr as signqr, imporinvoice.irn as irn, imporinvoice.ack_no as ack_no, imporinvoice.ack_date as ack_date, imporinvoice.ewbno as ewbno,customers.customer_name as c_name,customers.payment_terms as payment_terms,customers.prefix as prefix,customers.customer_code as vendor_code,customers.gst_no as c_gst_no,customers.pan_no as c_pan,customers.shipping_address as shipping_address,customers.billing_address as billing_address,customers.state_code as state_code,transporters.transporter_name as transporter_name,emp1.name as creater');
        $this->db->from('invoices_preview');
        $this->db->join('employees as emp1', 'invoices_preview.created_by = emp1.id','left'); 
        $this->db->join('customers', 'invoices_preview.customer_id = customers.id','left'); 
        $this->db->join('imporinvoice', 'invoices_preview.invoice_no = imporinvoice.doc_no','left'); 
        $this->db->join('transporters', 'invoices_preview.transporter_id = transporters.id','left'); 
        $this->db->where(['invoices_preview.flag'=>'0','invoices_preview.id'=>$id]);
        $this->db->order_by('invoices_preview.id','ASC');
        $query =  $this->db->get()->result_array();
        //echo"<pre>"; print_r($query);
  
        foreach($query as $i=>$inv_data) {

            $this->db->select('invoice_preview_rows.*,finish_goods.mineral_name as mineral_name,finish_goods.hsn_code as hsn_code,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'invoice_preview_rows.finish_good_id = finish_goods.id'); 
        // $this->db->from('invoices_rows');
            $this->db->where('invoice_preview_rows.invoice_id', $inv_data['id']);
            $inv_query = $this->db->get($this->previewdetailTable)->result_array();

        // Add the images array to the array entry for this product
        $query[$i]['invoice_details'] = $inv_query;
        $customer_id = $inv_data['customer_id'];

        $this->db->select('customers.*, states.state_name'); // Select the desired columns from both tables
        $this->db->from('customers');
        $this->db->join('states', 'customers.state_id = states.id', 'left'); // Join state table based on state_id
        $this->db->where('customers.id', $customer_id); // Filter by customer_id
        $customer_data = $this->db->get()->row_array();
        $query[$i]['customer_details'] = $customer_data;
        }
        //print_r($query);exit;
        return $query;
    }


// Insert registration data in database
public function invoice_insert($invoice,$invoice_datass) {

    $this->db->insert($this->table, $invoice);
    $id = $this->db->insert_id();
    $this->invoiceDetails($id,$invoice_datass);
    if ($this->db->affected_rows() > 0) {
        //$this->send_mail($id);
        return true;
    }
    else { 
    return false;
    }
}

public function send_mail($id) {
     $data = array();
    $data['title']='TAX INVOICE';
    $data['invoice_data'] = $this->Invoice_model->getById($id);
    // echo "<pre>";print_r($data['invoice_data']);exit;
    $data['invoice_no']=$data['invoice_data']['0']['invoice_no'];
  
    $order_no=$data['invoice_data']['0']['invoice_no'];
    $c_email=$data['invoice_data']['0']['c_email'];
    if($order_no<10){
    $order_number='ORD000'.$order_no;
    }
    else if(($order_no>=10) && ($order_no<=99)){
      $order_number='ORD00'.$order_no;
    }
    else if(($order_no>=100) && ($order_no<=999)){
      $order_number='ORD'.$order_no;
    }
    else{
      $order_number='ORD'.$order_no;
    }
    $data['order_number']=$order_number;
    $grand_total=$data['invoice_data']['0']['grand_total'];
    // $data['amount_in_words']=$this->convert_number_to_words(round($grand_total));   
    //print_r($data['invoice_data']);exit;

    $data['subject']='Order Invoice || Choudhary & Company';
    $data['heading']='Dispatch Details || Choudhary & Company';
   
    $data['text']="Dear Sir,<br>
    Please find mentioned below dispatch details of your order supplied to M/s <u> "
    .$data['invoice_data']['0']['c_name']."</u>, Udaipur against your PO No. ".$data['invoice_data']['0']['po_no']." dated ".date('d-m-Y',strtotime($data['invoice_data']['0']['po_date']))." as follows:<br>
    ";
    $data['invoice_info']="
    <ol type='1'>
        <li>Date of Dispatch : <b> ".date('d-m-Y',strtotime($data['invoice_data']['0']['transaction_date'])).
    " </b> </li>
    <li> Invoice No : <b> ".$data['invoice_no']." </b>  </li>
    <li> Name of the Transporter: ".$data['invoice_data']['0']['transporter_name']." </li>
    <li> Lorry No: ".$data['invoice_data']['0']['truck_no']." </li>
    <li> GR No: ".$data['invoice_data']['0']['gr_no']."</li>
    <li>Certificate of Analysis No: ".$data['invoice_data']['0']['test_report_no']."</li>
    <li>Report Sending Status: ".$data['invoice_data']['0']['report_sending_status']."</li>
    <li> Driver's No. and Name: ".$data['invoice_data']['0']['contact1']." (".$data['invoice_data']['0']['driver_name1'].")</li>

     <br>
    </ol>    
    ";

    $data['footer']='
    <p class="MsoNormal" >B-133, MEWAR INDUSTRIAL AREA, MADRI<br>
    UDAIPUR - 313003, RAJASTHAN, INDIA<br>
    TEL: +91-294-2491320, 2490506 <br>
    FAX: +91-294-2490112<br>
    HP: +91-9829041154<br>
    Email: admin@cnco.co.in; siddharth@cnco.co.in <p>
    ';
    $html = $this->load->view('invoice_mail', $data, TRUE);

    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'cncoemail@gmail.com', // change it to yours
      'smtp_pass' => 'cnco@2021', // change it to yours
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );
    // echo "<pre>";print_r($config);exit;
    // $this->load->helper('string');
    $this->load->library('email',$config);
    $this->email->set_newline("\r\n");
    $this->email->from('cncoemail@gmail.com'); // change it to yours
    //$this->email->to($emp_email);// change it to yours
    $this->email->to($c_email);// change it to yours
    //$this->email->bcc('prakashsharma720@gmail.com');// change it to yours
    $this->email->subject('Order Invoice || Choudhary & Company');
    // $this->email->attach("http://localhost/cnco/uploads/logo.jpg", "my-attach", "logo.jpg");
    $this->email->message($html);
    $this->email->send();
}
public function invoiceDetails($id,$invoice_datass) {
        $this->db->where('invoice_id', $id);
        $this->db->delete($this->detailTable);   
        if ($invoice_datass['details']):
            foreach ($invoice_datass['details'] as $key => $value) :
                $this->db->set('invoice_id', $id);
                $this->db->set('finish_good_id', $value['finish_good_id']);
				$this->db->set('production_month', $value['production_month']);
                $this->db->set('lot_no', $value['lot_no']);
                $this->db->set('batch_no', $value['batch_no']);
                $this->db->set('packing_size', $value['packing_size']);
                $this->db->set('no_of_bags', $value['no_of_bags']);
                $this->db->set('quantity', $value['qty']);
                $this->db->set('rate', $value['rate']);
                $this->db->set('tax_type', $value['tax_type']);
                $this->db->set('tax_per', $value['tax_per']);
                $this->db->set('tax_amount', $value['tax_amount']);
                $this->db->set('taxable_amount', $value['taxable_amount']);
                $this->db->set('amount', $value['amount']);
               
               /* $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                $this->db->set('packing_size', $this->input->post('packing_size')[$key]);
                $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                $this->db->set('quantity', $this->input->post('qty')[$key]);
                $this->db->set('rate', $this->input->post('rate')[$key]);
                $this->db->set('amount', $this->input->post('amount')[$key]);*/
                $this->db->insert($this->detailTable);
                $invoice_row_id = $this->db->insert_id();
                $finish_good_id=$value['finish_good_id'];
                $lot_no=$value['lot_no'];
                $batch_no=$value['batch_no'];
                $packing_size=$value['packing_size'];
                $no_of_bags=$value['no_of_bags'];
                $issue_qty=$value['qty'];
                $transaction_date=date('Y-m-d');
                $this->insertStockRegister($id,$invoice_row_id,$this->login_id,$this->department_id,$transaction_date,$finish_good_id,$lot_no,$batch_no,$packing_size,$no_of_bags,$issue_qty);
            endforeach;
        endif;                  

    }
      

/******************* edit rmcode ********************/

public function editInvoice($data,$old_id){
   
    $this->db->select('*');
    $this->db->from('invoices');
    $this->db->where(['id'=>$old_id]);
    $this->db->update($this->table, $data);
    $this->EditMultipaleRow($old_id);
   if ($this->db->affected_rows() > 0) {
        return true;
    }
    else { 
        return false;
    }
}
public function editInvoicePreview($data,$old_id){
   
    $this->db->select('*');
    $this->db->from('invoices');
    $this->db->where(['id'=>$old_id]);
    $this->db->update($this->previewtable, $data);
    $this->EditMultipaleRow($old_id);
   if ($this->db->affected_rows() > 0) {
        return $old_id;
    }
    else { 
        return false;
    }
}

public function EditMultipaleRow($id) {
        $this->db->where('invoice_id', $id);
        $this->db->delete($this->previewdetailTable);  
         //$this->db->where('invoice_id', $id); 
        //$this->db->delete('fg_stock_registers');   
        if ($this->input->post('finish_good_id')):
            foreach ($this->input->post('finish_good_id') as $key => $value) :
                $this->db->set('invoice_id', $id);
                $this->db->set('finish_good_id', $value);
				$this->db->set('production_month', $this->input->post('production_month')[$key]);
                $this->db->set('lot_no', $this->input->post('lot_no')[$key]);
                $this->db->set('batch_no', $this->input->post('batch_no')[$key]);
                $this->db->set('packing_size', $this->input->post('packing_size')[$key]);
                $this->db->set('no_of_bags', $this->input->post('no_of_bags')[$key]);
                $this->db->set('quantity', $this->input->post('qty')[$key]);
                $this->db->set('rate', $this->input->post('rate')[$key]);
                $this->db->set('amount', $this->input->post('amount')[$key]);
                $this->db->insert($this->previewdetailTable);
                /*$invoice_row_id = $this->db->insert_id();
                $lot_no=$this->input->post('lot_no')[$key];
                $batch_no=$this->input->post('batch_no')[$key];
                $packing_size=$this->input->post('packing_size')[$key];
                $no_of_bags=$this->input->post('no_of_bags')[$key];
                $issue_qty=$this->input->post('qty')[$key];
                $transaction_date=date('Y-m-d');
                $this->insertStockRegister($id,$invoice_row_id,$this->login_id,$this->department_id,$transaction_date,$value,$lot_no,$batch_no,$packing_size,$no_of_bags,$issue_qty);*/
            endforeach;
        endif;                  

    }
/************** GIR Details Insertion ******************/

 

/************** Inser/Update StockRegisters ******************/
    function insertStockRegister($id,$invoice_row_id,$employee_id,$department_id,$transaction_date,$finish_good_id,$lot_no,$batch_no,$packing_size,$no_of_bags,$issue_qty){
                $data=array('invoice_id'=>$id,'invoice_row_id'=>$invoice_row_id,'transaction_date'=>$transaction_date,'employee_id'=>$employee_id,
                'department_id'=>$department_id,
                'finish_good_id'=>$finish_good_id,'lot_no'=>$lot_no,'batch_no'=>$batch_no,'no_of_bags'=>$no_of_bags,'packing_size'=>$packing_size,'production_in_mt'=>$issue_qty,'status'=>'Out',
                'created_by'=>$employee_id);
                $this->db->insert('fg_stock_registers', $data);
                //$this->db->set('description', $this->input->post('description')[$key]);
                    
    }
    
/******************* Row Count for Voucher Number ********************/

 function rowcount(){
    $count=0;
    $this->db->select_max('gir_no');
    $this->db->from($this->table);
    $query=$this->db->get()->result_array();
    //$query->result_array();
    $count=$query[0]['gir_no'];
    //print_r($count);exit;
    return $count;
   
}


function getUnits() { 
        $result = $this->db->select('id,unit_name')->from('unit')->where('flag','0')->get()->result_array(); 
        //$result = $this->db->select('id, category_name')->get('categories')->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        /*$productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } */
        
        return $result; 
    } 
// Read data from database to show data in admin page

   public function getInvoicesList($conditions = null){
	   //print_r($conditions);exit;
        $this->db->select('invoices.*,imporinvoice.doc_no,customers.customer_name as c_name,customers.customer_code as vendor_code,transporters.transporter_name as transporter_name,imporinvoice.signqr as signqr');
        $this->db->from('invoices');
        $this->db->join('customers', 'invoices.customer_id = customers.id','left'); 
        $this->db->join('imporinvoice', 'invoices.invoice_no = imporinvoice.doc_no','left'); 
        $this->db->join('transporters', 'invoices.transporter_id = transporters.id','left'); 
        // $this->db->join('imporinvoice', 'invoices.invoice_no = imporinvoice.doc_no', 'left'); 
        $this->db->where(['invoices.flag'=>'0']);
		
		 if(!empty($conditions)){
            
            if($conditions['from_date'])
                $this->db->where('invoices.transaction_date >=',$conditions['from_date']); 

             if($conditions['upto_date'])
               $this->db->where('invoices.transaction_date <=',$conditions['upto_date']); 
        }
		
        $this->db->order_by('invoices.id','DESC');
		 if (!empty($conditions['limit'])) {
			$this->db->limit($conditions['limit']);
		}
        $query =  $this->db->get()->result_array();
       
        //print_r($query);exit; //troubleshooting somehting.
        
        //$query->result_array();
        foreach($query as $i=>$inv_data) {

            $this->db->select('invoice_rows.*,finish_goods.mineral_name as mineral_name,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'invoice_rows.finish_good_id = finish_goods.id'); 
           // $this->db->from('invoices_rows');
            $this->db->where('invoice_rows.invoice_id', $inv_data['id']);
            $inv_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['invoice_details'] = $inv_query;

        }
        //print_r($query);exit;
        return $query;
    }
      
    
    
    

    function deleteInvoice($id){
        //$data=array('flag'=>'1');
        //$this->db->set('flag','flag',false);
        $this->db->where('id',$id);
        if($this->db->delete($this->table)){
            $this->db->where('invoice_id', $id);
            $this->db->delete($this->detailTable);
            $this->db->where('invoice_id', $id);
            $this->db->delete('fg_stock_registers');
            return true;
        }
    }

    function getSuppliers($categories_id)
    { 
       // $result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
        $result = $this->db->select('id, supplier_name')->from('suppliers')->where(['flag'=>'0','categories_id'=>$categories_id])->get()->result_array(); 
        return $result; 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /*  $suppliername = array(); 
        $suppliername[''] = 'Select Supplier...'; 
        foreach($result as $r) { 
            $suppliername[$r['id']] = $r['supplier_name'].'('.$r['vendor_code'].')'; 
        }  */
       // return $result; 
    }
    function getCustomerCodes()
    { 
 
        $result = $this->db->select('id,customer_code,gst_no')->from('customers')->where(['flag'=>'0'])->get()->result_array(); 
        $vendorcodes = array(); 
        $vendorcodes[''] = 'Select Vendor Code'; 
        foreach($result as $r) { 
            $vendorcodes[$r['id']] =$voucher_no=$r['customer_code'];
        }
        return $vendorcodes;
    }
    function getTransporters()
    { 
       // $result = $this->db->select('id, supplier_name,vendor_code')->get('suppliers')->result_array(); 
        $result = $this->db->select('id, transporter_name')->from('transporters')->where('flag','0')->get()->result_array(); 
       // return $result; 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
        $transportername = array(); 
        $transportername[''] = 'Select Transporter'; 
        foreach($result as $r) { 
            $transportername[$r['id']] = $r['transporter_name']; 
        }   
       return $transportername; 
    }
    function getCategories() { 
       $result = $this->db->select('id, category_name')->from('categories')->where(['flag'=>'0','show_flag'=>'0'])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /*  $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname[$r['id']] = $r['category_name']; 
        } 
         */
        return $result; 
    }
    // function getInvoiceCode(){
    //   $count=0;
    //   $this->db->select_max('invoice_no');
    //   $this->db->from('invoices');
    //   $query=$this->db->get()->row_array();
    //   //print_r($query['vendor_code']);exit;
    //   $count=$query['invoice_no']+1;
    //   return $count;
    // }
     function getInvoiceCode(){
        $query = $this->db->query("SELECT `invoice_no` FROM `invoices` WHERE `flag`='0' ORDER BY `id` DESC LIMIT 1");
        $result = $query->row_array();
        return $result['invoice_no'];
    }
  /*  function getItems() { 
       $result = $this->db->select('id, mineral_name,grade_name')->from('finish_goods')->where('flag','0')->get()->result_array(); 
    
        $productname = array(); 
        foreach($result as $r) { 
            $productname['id'] = $r['id']; 
            $productname['item_name'] = $r['item_name']; 
        } 
        
        return $result; 
    }*/
    public function getFGmineralsList() { 
       $result = $this->db->select('id, mineral_name,grade_name,fg_code,packing_type,hsn_code')->from('finish_goods')->where(['flag'=>'0'])->get()->result_array(); 

            foreach ($result as $key => $value) {
                    //print_r($value['item_id']);exit;
                    $item_id=$value['id'];
                    $this->db->select('SUM(fg_stock_registers.production_in_mt) as total');
                    $this->db->where(['fg_stock_registers.finish_good_id'=>$item_id,'fg_stock_registers.status'=>'In']);
                    $total_in=$this->db->get('fg_stock_registers')->row_array();
                    //print_r($total_in);

                    $item_id=$value['id'];
                    $this->db->select('SUM(fg_stock_registers.production_in_mt) as total');
                    $this->db->where(['fg_stock_registers.finish_good_id'=>$item_id,'fg_stock_registers.status'=>'Out']);
                    $total_out=$this->db->get('fg_stock_registers')->row_array();
                    //print_r($total_out['total']);exit;

                    $stock_in= $total_in['total']-$total_out['total'];
                    //print_r($stock_in);exit;
                    $result[$key]['stock_in'] = $stock_in;
                    //$images_query=$stock_in ;
                    # code...
                }

        return $result; 
    }

    function getRMItems() { 
       $result = $this->db->select('id, item_name')->from('item_masters')->where(['flag'=>'0','category_id'=>'1'])->get()->result_array(); 
        //print_r($result);exit;
        //order_by('category_name', 'asc');
       /* $productname = array(); 
       // $productname[''] = 'Select Category...'; 
        foreach($result as $r) { 
            $productname['id'] = $r['id']; 
            $productname['item_name'] = $r['item_name']; 
        } */
        
        return $result; 
    }
  /*  public function getById($id) {
         $this->db->select('gir_registers.*,invoices_rows.*');
        $this->db->from('gir_registers');
        //$this->db->join('suppliers', 'gir_registers.supplier_id = suppliers.id', 'left'); 
        $this->db->join('invoices_rows', 'gir_registers.id = invoices_rows.id', 'left'); 
        $this->db->where('gir_registers.id',$id);
        $query = $this->db->get();
        return $query->result_array();

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    } */ 

       public function getById($id){
        $this->db->select('invoices.*, transporters.transporter_name as transporter_name, imporinvoice.signqr as signqr, imporinvoice.irn as irn, imporinvoice.ack_no as ack_no, imporinvoice.ack_date as ack_date, imporinvoice.ewbno as ewbno, emp1.name as creater');
        $this->db->from('invoices');
        $this->db->join('employees as emp1', 'invoices.created_by = emp1.id','left'); 
        $this->db->join('customers', 'invoices.customer_id = customers.id','left'); 
        $this->db->join('transporters', 'invoices.transporter_id = transporters.id','left'); 
        $this->db->join('imporinvoice', 'invoices.invoice_no = imporinvoice.doc_no','left'); 
        $this->db->where(['invoices.flag'=>'0','invoices.id'=>$id]);
        $this->db->order_by('invoices.id','ASC');
        $query =  $this->db->get()->result_array();
        //print_r($query);exit;
  
        foreach($query as $i=>$inv_data) {

            $this->db->select('invoice_rows.*,finish_goods.mineral_name as mineral_name,finish_goods.hsn_code as hsn_code,finish_goods.grade_name as grade_name');
            $this->db->join('finish_goods', 'invoice_rows.finish_good_id = finish_goods.id'); 
           // $this->db->from('invoices_rows');
            $this->db->where('invoice_rows.invoice_id', $inv_data['id']);
            $inv_query = $this->db->get($this->detailTable)->result_array();

           // Add the images array to the array entry for this product
           $query[$i]['invoice_details'] = $inv_query;
           $customer_id = $inv_data['customer_id'];

           $this->db->select('customers.*, states.state_name'); // Select the desired columns from both tables
           $this->db->from('customers');
           $this->db->join('states', 'customers.state_id = states.id', 'left'); // Join state table based on state_id
           $this->db->where('customers.id', $customer_id); // Filter by customer_id
           $customer_data = $this->db->get()->row_array();
           $query[$i]['customer_details'] = $customer_data;
        }
       // print_r($query);exit;
        return $query;
    }

    public function getByIdJSonExport($id){
        $this->db->select('invoices.*,customers.billing_pincode as pincode ,customers.email as c_email,customers.customer_name as c_name,customers.prefix as prefix,customers.vendor_code as vendor_code,
		customers.gst_no as c_gst_no,customers.payment_terms as payment_terms,customers.pan_no as c_pan,customers.shipping_address as shipping_address,
		customers.billing_address as billing_address,customers.state_code as state_code,transporters.transporter_name as transporter_name,transporters.gst_no as gst_no,
		emp1.name as creater,customers.ship_destination as ship_destination,customers.shipping_gst_status,customers.shipping_gst_no,customers.shipping_legal_name,customers.saddress1,customers.saddress2,customers.loc,customers.ship_pincode,customers.ship_state_code');
        $this->db->from('invoices');
        $this->db->join('employees as emp1', 'invoices.created_by = emp1.id','left'); 
        $this->db->join('customers', 'invoices.customer_id = customers.id','left'); 
        $this->db->join('transporters', 'invoices.transporter_id = transporters.id','left'); 
        $this->db->where(['invoices.flag'=>'0','invoices.id'=>$id]);
        $this->db->order_by('invoices.id','ASC');
        $query =  $this->db->get()->row_array();
        //  echo "<pre>";print_r($query);exit;
  
        $this->db->select('invoice_rows.*,finish_goods.mineral_name as mineral_name,finish_goods.hsn_code as hsn_code,finish_goods.grade_name as grade_name');
        $this->db->join('finish_goods', 'invoice_rows.finish_good_id = finish_goods.id'); 
        // $this->db->from('invoices_rows');
        $this->db->where('invoice_rows.invoice_id', $query['id']);
        $inv_query = $this->db->get($this->detailTable)->result_array();

        // Add the images array to the array entry for this product
        $query['invoice_details'] = $inv_query;

       
    //    echo "<pre>";print_r($query);exit;
        return $query;
    }

    public function CheckInvoiceNo($invoice_no)
        {
            $this->db->select('invoice_no');
            $this->db->from('invoices');
            $this->db->where(['invoice_no'=>$invoice_no]);
            $query=$this->db->get()->num_rows();    
            return $query;
           
        }


    }

?>