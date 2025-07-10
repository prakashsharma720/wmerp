<?php

//session_start(); //we need to start session in order to access it through CI
// require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
// Include the necessary files
// 
// require_once APPPATH . "/third_party/PHPExcel.php";
require_once APPPATH . 'third_party/phpqrcode/qrlib.php';
Class Invoice extends MY_Controller {

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
//$this->load->model('invoice_model');
$this->load->model('Invoice_model');
//$this->load->library('excel');
}

// Show login page
public function add() {
    //$id = decrypt_url($gir_id);
    //print_r($pid);exit;
    $data = array();

    $data['title']='Create Invoice';
    $data['last_invoice_no'] = $this->Invoice_model->getInvoiceCode();
   
    $data['items']=$this->Invoice_model->getFGmineralsList();
    $data['vendorcodes']=$this->Invoice_model->getCustomerCodes();
    $data['transporters']=$this->Invoice_model->getTransporters();
    $data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
    $data['tras_categories']= array(''=>'Select Option','B2B' => 'B2B','SEZWP'=>'SEZWP','SEZWOP'=>'SEZWOP','EXPWP' => 'EXPWP','EXPWOP' => 'EXPWOP','DEXP' => 'DEXP');
    
    $this->template->load('template','invoice_add',$data);  
    }

    public function print_invoice($id){
    $data = array();
    $data['title']='TAX INVOICE';
    $data['invoice_data'] = $this->Invoice_model->getById($id);
    //   echo "<pre>";print_r($data['invoice_data']);exit;
    $data['qrCodeImages'] = [];
       
    foreach ($data['invoice_data'] as $key => $invoice) {
        if (!empty($invoice['signqr'])) {
            // Generate QR code for the 'signqr' field
            $qrCodeFile = './uploads/' . $invoice['id'] . '.png'; // Adjust the path where you want to save the QR code image
            QRcode::png($invoice['signqr'], $qrCodeFile);

            // Store the QR code file path in the invoice data
            $data['invoice_data'][$key]['qrCodeImage'] = $qrCodeFile;
        } else {
            // If 'signqr' is empty, set the QR code image path to null
            $data['invoice_data'][$key]['qrCodeImage'] = null;
        }
    }
    $data['invoice_no']=$data['invoice_data']['0']['invoice_no'];
   
    $grand_total=$data['invoice_data']['0']['grand_total'];
    $data['amount_in_words']=$this->convert_number_to_words(round($grand_total));   
    // echo "<pre>";print_r($data['invoice_data']);exit;

    $this->template->load('template','invoice_print',$data);
    }

    public function send_mail($id){
    $data = array();
    $data['title']='TAX INVOICE';
    $data['invoice_data'] = $this->Invoice_model->getById($id);
    // echo "<pre>";print_r($data['invoice_data']);exit;
    $data['invoice_no']=$data['invoice_data']['0']['invoice_no'];
    // if($voucher_no<10){
    // $invoice_code='CNC/A/000'.$voucher_no;
    // }
    // else if(($voucher_no>=10) && ($voucher_no<=99)){
    //   $invoice_code='CNC/A/00'.$voucher_no;
    // }
    // else if(($voucher_no>=100) && ($voucher_no<=999)){
    //   $invoice_code='CNC/A/0'.$voucher_no;
    // }
    // else{
    //   $invoice_code='CNC/A/'.$voucher_no;
    // }
    // $data['invoice_no']=$invoice_code;
    // Order Number //
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
    $data['amount_in_words']=$this->convert_number_to_words(round($grand_total));   
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
    //$this->email->attach($html);
    if($this->email->send())
    {
        //echo 'Invoice has been sent on customer registered email.';
        $this->session->set_flashdata('success', 'Invoice is sent to customer on registered mail id');
        redirect('Invoice/index');
    }
    else
    {
        //$data['error_message']=$this->email->print_debugger();
        //show_error($this->email->print_debugger());
         $this->session->set_flashdata('failed', $this->email->print_debugger());
        redirect('Invoice/index');
    }
    }
    public function preview($id){
        $data = array();
        $data['title']='Invoice Preview';
        $data['invoice_data'] = $this->Invoice_model->getByIdPreview($id);
        $data['invoice_no']=$data['invoice_data']['0']['invoice_no'];
         // echo "<pre>";print_r($data['invoice_data']);exit;
        $data['qrCodeImages'] = [];
        
        foreach ($data['invoice_data'] as $key => $invoice) {
            if (!empty($invoice['signqr'])) {
                // Generate QR code for the 'signqr' field
                $qrCodeFile = './uploads/' . $invoice['id'] . '.png'; // Adjust the path where you want to save the QR code image
                QRcode::png($invoice['signqr'], $qrCodeFile);

                // Store the QR code file path in the invoice data
                $data['invoice_data'][$key]['qrCodeImage'] = $qrCodeFile;
            } else {
                // If 'signqr' is empty, set the QR code image path to null
                $data['invoice_data'][$key]['qrCodeImage'] = null;
            }
        }
        $grand_total=$data['invoice_data']['0']['grand_total'];
        $data['amount_in_words']=$this->convert_number_to_words(round($grand_total));  

        $this->template->load('template','invoice_preview',$data);
    }
    public function importdata()
    {
        if ($this->input->post('submit')) 
        {
            $path = './uploads/';
            $config['upload_path'] = $path;
            $config['allowed_types'] = '*';
            $config['remove_spaces'] = TRUE;
    
            $this->load->library('upload', $config);
            $this->upload->initialize($config);            
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
    
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
					//echo "<pre>";print_r($allDataInSheet);
                    //$allDataInSheet = $worksheet->toArray(null, true, true, true);
    
                    $flag = true;
                    $i=0;
                    $duplicateCount = 0;
                    $inserdata = array(); // Initialize the array here
    
                    foreach ($allDataInSheet as $value) 
                    {
                        if($flag){
                            $flag =false;
                            continue;
                        }
						//echo "<pre>";print_r($value);exit;
                        if(!empty($value['E'])){
                            $existing_item = $this->Invoice_model->getByIRN($value['E']); // Assuming D is the column for doc_no
                            if(!$existing_item){
                                // Check if the doc_no exists in the invoices table
                                $invoice_exists = $this->Invoice_model->checkInvoiceExists($value['E']);
                                if($invoice_exists){
                                    $inserdata[$i]['irn'] = $value['B'];
                                    $inserdata[$i]['ack_no'] = $value['C'];
                                    $inserdata[$i]['ack_date'] = $value['D'];
                                    $inserdata[$i]['doc_no'] = $value['E'];
                                    $inserdata[$i]['doc_typ'] = $value['F'];
                                    $inserdata[$i]['doc_date'] = $value['G'];
                                    $inserdata[$i]['inv_value'] = $value['H'];
                                    $inserdata[$i]['recipient'] = $value['I'];
                                    $inserdata[$i]['status'] = $value['J'];
                                    $inserdata[$i]['signqr'] = $value['K'];
                                    $inserdata[$i]['ewbno'] = $value['L'];
                                    $i++; // Increment $i only for non-duplicate records
                                } else {
                                    $duplicateCount++;
                                    // echo "Item with doc_no {$value['E']} already exists.";
                                    $this->session->set_flashdata('failed', "Item with doc_no {$value['E']} does not exist in invoices table!");
                                }
                            } else {
                                $duplicateCount++;
                                // echo "Item with doc_no {$value['E']} already exists.";
                                $this->session->set_flashdata('failed', "Item with doc_no {$value['E']} already exists in!");
                            }
                        }
                    }
    
                    // Save all the records, even if there are duplicates
                    $result = $this->Invoice_model->saverecords($inserdata); 
                    // echo $result;exit;
                    if ($result == TRUE)
    
                    {
                        if($duplicateCount > 0){
                            $this->session->set_flashdata('success', 'Imported successfully, but ' . $duplicateCount . ' records were duplicates or did not exist in invoices table.');
                        } else {
                            $this->session->set_flashdata('success', 'Imported successfully!');
                        }
                        redirect('/Invoice/index/', 'refresh');
                    } else {
                        $this->session->set_flashdata('failed', 'Import Failed !');
                        redirect('/Invoice/index/', 'refresh');
                    }             
                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .$e->getMessage());
                }
            } else {
                echo $error['error'];
            }
        }
        $this->template->load('template','invoice_view',$data);
    }
    public function generate_json($id= null) {
        // echo $id;exit;  
        
        $ids=$this->input->post('ids');
        if(!empty($ids)) 
        {
            $id_array =explode(',', $ids);
            $mergedArray = [];
            foreach ($id_array as $id)
            {
                $invoice_data = $this->Invoice_model->getById($id);

                if (!empty($invoice_data['0']['transport_id']) && $invoice_data['0']['transport_id'] !== "NA") {
                    $transport_id = $invoice_data['0']['transport_id'];
                }
            
                elseif($invoice_data['0']['transport_id'] === "NA") {
                    $transport_id = null;
                }
    
                if (!empty($invoice_data['0']['customer_details']['gst_no']) && $invoice_data['0']['customer_details']['gst_no'] !== "NA") {
                    $buyer_gst_no = $invoice_data['0']['customer_details']['gst_no'];
                }else{
                    $buyer_gst_no = null;
                }
               if ($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){
                 if (!empty($invoice_data['0']['customer_details']['shipping_gst_no']) && $invoice_data['0']['customer_details']['shipping_gst_no'] !== "NA") {
                    $shipping_gst_no = $invoice_data['0']['customer_details']['shipping_gst_no'];
                }else{
                    $shipping_gst_no = null;
                }
             }
        //    echo "ship gst : ".$shipping_gst_no;exit;
                
            $formattedDate = date('d/m/Y', strtotime($invoice_data['0']['transaction_date']));
             if(!empty($invoice_data['0']['customer_details']['shipping_address'])){
            $cleanBillingAddress1 = isset($invoice_data['0']['customer_details']['shipping_address']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['shipping_address']) : '';
            $maxLength = 80;
            $cust_billing_add1 = substr($cleanBillingAddress1, 0, $maxLength);
            }else{
                $cust_billing_add1 = null; 
            }
            if(!empty($invoice_data['0']['customer_details']['billing_address'])){
                $cleanBillingAddress2 = isset($invoice_data['0']['customer_details']['billing_address']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['billing_address']) : '';
                $maxLength = 80;
                $cust_billing_add2 = substr($cleanBillingAddress2, 0, $maxLength);
            }else{
                $cust_billing_add2 = null;
            }
            if ($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){
                   $cleanShippingAddress1 = isset($invoice_data['0']['customer_details']['saddress1']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['saddress1']) : '';
                    $maxLength = 80;
                    $cust_shipping_add1 = substr($cleanShippingAddress1, 0, $maxLength);


                if(!empty($invoice_data['0']['customer_details']['saddress2'])){
                    $cleanShippingAddress2 = isset($invoice_data['0']['customer_details']['saddress2']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['saddress2']) : '';
                    $maxLength = 80;
                    $cust_shipping_add2 = substr($cleanShippingAddress2, 0, $maxLength);
                }
            }

          

            // echo $cust_shipping_add1.'and'.$cust_shipping_add2;exit;
         

            $cgstTotal = 0;
            $sgstTotal = 0;
            $igstAmount =0;
          
            foreach ($invoice_data['0']['invoice_details'] as $item) {
                if ($item['tax_type'] == 'Other') {
                    
                    // Calculate total tax amount for tax_type other than 'total_tax'
                    $totalTaxAmount = $invoice_data['0']['total_tax'];
                    
                    // Divide total tax amount into CGST and SGST
                    $cgstTotal = $totalTaxAmount / 2;
                    $sgstTotal = $totalTaxAmount / 2;

                   
                }
                else if($item['tax_type'] == 'IGST'){
                    $totalTaxAmount = $invoice_data['0']['total_tax'];

                }
            }

            // Define your data
            $data = [
                    "Version" => "1.01",
                    "TranDtls" => array(
                        "TaxSch" => "GST",
                        "SupTyp" => $invoice_data['0']['transaction_category'],
                        "IgstOnIntra" => "N",
                        "RegRev" => "N",
                        "EcmGstin" => null
                    ),
                    "DocDtls" => array(
                        "Typ" => "INV",
                        "No" => $invoice_data['0']['invoice_no'],
                        "Dt" => $formattedDate
                    ),
                    "SellerDtls" => array(
                        "Gstin" => "08AABFC2155P1ZA",
                        "LglNm" => "CHOUDHARY & COMPANY",
                        "Addr1" => "B-133, M.I.A., MADRI",
                        "Addr2" => "B-133, M.I.A., MADRI",
                        "Loc" => "B-133, M.I.A., MADRI, UDAIPUR",
                        "Pin" => 313003,
                        "Stcd" => "08",
                        "Ph" => null,
                        "Em" => "accounts@cnco.co.in"
                    ),
                    "BuyerDtls" => array(
                        "Gstin" => $buyer_gst_no,
                        "LglNm" => $invoice_data['0']['customer_details']['customer_name'],
                        "Addr1" => $cust_billing_add1,
                        "Addr2" => $cust_billing_add2,
                        "Loc" => $invoice_data['0']['customer_details']['destination'],
                        "Pin" => (int)$invoice_data['0']['customer_details']['billing_pincode'],
                        "Pos" => $invoice_data['0']['customer_details']['state_code'],
                        "Stcd" => $invoice_data['0']['customer_details']['state_code'],
                        "Ph" => null,
                        "Em" => null
                    ),
                    "ValDtls" => array(
                        "AssVal" => (float) $invoice_data['0']['total_rate'],
                        // "TotalTax" => (float) $invoice_data['0']['total_tax'],
                        "IgstVal" => $item['tax_type'] == 'IGST' ? (float) $totalTaxAmount : 0,
                        "CgstVal" => $item['tax_type'] == 'Other' ? (float) $cgstTotal : 0,
                        "SgstVal" => $item['tax_type'] == 'Other' ? (float) $sgstTotal : 0,
                        "CesVal" => 0,
                        "StCesVal" => 0,
                        "Discount" => 0,
                        "OthChrg" => 0,
                        "RndOffAmt" => (float) $invoice_data['0']['round_off'],
                        "TotInvVal" => (float) $invoice_data['0']['grand_total']
                    ),
                    "RefDtls" => array(
                        "InvRm" => "NICGEPP2.0"
                    )
                ];

                
                $ItemList = [];
                $toalcgstAmt=0;
                $toalsgstAmt=0;
                $toaligstAmt=0;
                // Iterate over invoice_details
                $totalamt=0;
                $slno =0;

                // Iterate over invoice_details
                foreach ($invoice_data['0']['invoice_details'] as $index => $detail) {
                    $slno = $index + 1;
                    $totalamt= $detail['quantity'] *$detail['rate'];
                    if ($detail['tax_type'] == 'Other') {
                        $toalcgstAmt=$detail['tax_amount'] / 2;
                        $toalsgstAmt=$detail['tax_amount'] / 2;
                    }
                    else if($detail['tax_type'] == 'IGST'){
                        $toaligstAmt=$detail['tax_amount'];
                    }
                    $ItemList[] = [
                        "SlNo" =>strval($slno), // Assuming SlNo starts from 1
                        "PrdDesc" => strtoupper($detail['mineral_name']), // Convert to uppercase
                        "IsServc" => "N",
                        "HsnCd" => (string)$detail['hsn_code'], // Convert to string
                        "Qty" => (float) $detail['quantity'], // Assuming quantity is in MTS
                        "FreeQty" => 0,
                        "Unit" => "MTS",
                        "UnitPrice" => (float)$detail['rate'], // Convert to float if not already
                        "TotAmt" => round($totalamt,2), // Convert to float if not already
                        "Discount" => 0,
                        "PreTaxVal" => 0,
                        "AssAmt" => (float)$detail['taxable_amount'], 
                        "GstRt" => (float)$detail['tax_per'],
                        "IgstAmt" => $detail['tax_type'] == 'IGST' ? (float) $toaligstAmt : 0,
                        "CgstAmt" =>$detail['tax_type'] == 'Other' ? (float) $toalcgstAmt : 0,
                        "SgstAmt" =>$detail['tax_type'] == 'Other' ? (float) $toalsgstAmt : 0,
                        "CesRt" => 0,
                        "CesAmt" => 0,
                        "CesNonAdvlAmt" => 0,
                        "StateCesRt" => 0,
                        "StateCesAmt" => 0,
                        "StateCesNonAdvlAmt" => 0,
                        "OthChrg" => 0,
                        "TotItemVal" => (float)$detail['amount'] // Assuming same as TotAmt
                    ];
            }
            foreach ($invoice_data['0']['invoice_details'] as $item) {
                if ($item['tax_type'] == 'Other') {
                    // Calculate total tax amount for tax_type other than 'total_tax'
                    $totalTaxAmount = $invoice_data['0']['total_delivr_tax_per'];
                    // Divide total tax amount into CGST and SGST
                    $cgstTotal = $totalTaxAmount / 2;
                    $sgstTotal = $totalTaxAmount / 2;
                }
                else if($item['tax_type'] == 'IGST'){
                    $igstAmount = $invoice_data['0']['total_delivr_tax_per'];

                }
            }
           if($invoice_data['0']['delivr_rate'] >0){
                $ItemList[]=[
                    "SlNo" =>strval($slno+1), // Assuming SlNo starts from 1
                    "PrdDesc" => "Transport", // Convert to uppercase
                    "IsServc" => "Y",
                    "HsnCd" => "996781", // Convert to string
                    "Qty" => (float) $invoice_data['0']['total_quantity'], // Assuming quantity is in MTS
                    "FreeQty" => 0,
                    "Unit" => "MTS",
                    "UnitPrice" => (float)$invoice_data['0']['delivr_rate'], // Convert to float if not already
                    "TotAmt" => round($invoice_data['0']['total_deliver_amt'],2), // Convert to float if not already
                    "Discount" => 0,
                    "PreTaxVal" => 0,
                    "AssAmt" => (float)$invoice_data['0']['total_deliver_amt'], 
                    "GstRt" => (float)$invoice_data['0']['delivr_tax_per'],
                    "IgstAmt" => (float)$igstAmount,
                    "CgstAmt" =>(float)$cgstTotal,
                    "SgstAmt" =>(float)$sgstTotal,
                    "CesRt" => 0,
                    "CesAmt" => 0,
                    "CesNonAdvlAmt" => 0,
                    "StateCesRt" => 0,
                    "StateCesAmt" => 0,
                    "StateCesNonAdvlAmt" => 0,
                    "OthChrg" => 0,
                    "TotItemVal" => (float)$invoice_data['0']['total_taxable_value'] 
                ];
            }
            if($invoice_data['0']['ewaybillstatus'] == 'Yes'){
            $eWayBill= [
                    "EwbDtls" => array(
                        "TransId" =>$transport_id,
                        "TransName" => $invoice_data['0']['transporter_name'],
                        "TransMode" => "1",
                        "Distance" => (int)$invoice_data['0']['customer_details']['ship_destination'],
                        "TransDocNo" => $invoice_data['0']['gr_no'],
                        "TransDocDt" => $formattedDate,
                        "VehNo" => $invoice_data['0']['truck_no'],
                        "VehType" => "R"
                    )
                ];
            }else{
                $eWayBill ='';
            }
             if ($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){
                $shipDetailsArr= [
                    "ShipDtls" => array(
                            "Gstin" => $shipping_gst_no,
                            "LglNm" => $invoice_data['0']['customer_details']['shipping_legal_name'],
                            "Addr1" => $cust_shipping_add1,
                            "Addr2" => $cust_shipping_add2,
                            "Loc" => $invoice_data['0']['customer_details']['loc'],
                            "Pin" => (int)$invoice_data['0']['customer_details']['ship_pincode'],
                            "Stcd" => $invoice_data['0']['customer_details']['ship_state_code'],
                        )
                    ];
                }else{
                     $shipDetailsArr ='';
                }


                // echo "<pre>";print_r($eWayBill);exit;
                $json_data = json_encode($data);
                $dataArray = json_decode($json_data, true);
                $itemListArray = ["ItemList" => $ItemList];
                $finalMerge = $dataArray;
                // Conditionally merge eWayBill if available
                if (!empty($eWayBill)) {
                    $eWayBill_json = json_encode($eWayBill);
                    $eWayArray = json_decode($eWayBill_json, true);
                    $finalMerge = array_merge($finalMerge, $eWayArray);
                }

                // Conditionally merge shipDetailsArr if shipping is "Yes"
                if (!empty($shipDetailsArr)) {
                    $shipDetails_json = json_encode($shipDetailsArr);
                    $shipDetailsArray = json_decode($shipDetails_json, true);
                    $finalMerge = array_merge($finalMerge, $shipDetailsArray);
                }
                // Always merge ItemList
                $finalMerge = array_merge($finalMerge, $itemListArray);
                // Add to final array
                $mergedArray[] = $finalMerge;
        
            }
            // var_dump($mergedArray);
            $mergedJson = json_encode($mergedArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            // echo "<pre>";print_r($mergedJson);exit;
            $file_name = 'CNC' . date('Ymd_His') . '.json';

            $file_path = BASEPATH . 'json_files/' . $file_name;

            if (file_put_contents($file_path, $mergedJson) !== false) {
                echo $file_name; // Return the file name for download
            } else {
                echo "Failed to generate JSON file.";
            }
       
        } else
        {
            $id = $this->uri->segment('3');  
            // echo $id;exit;
            $invoice_data = $this->Invoice_model->getById($id);
            // echo "<pre>";print_r($invoice_data);exit;
            if (!empty($invoice_data['0']['transport_id']) && $invoice_data['0']['transport_id'] !== "NA") {
                $transport_id = $invoice_data['0']['transport_id'];
            }
        
            elseif($invoice_data['0']['transport_id'] === "NA") {
                $transport_id = null;
            }

            if (!empty($invoice_data['0']['customer_details']['gst_no']) && $invoice_data['0']['customer_details']['gst_no'] !== "NA") {
                $buyer_gst_no = $invoice_data['0']['customer_details']['gst_no'];
            }else{
                $buyer_gst_no = null;
            }
            if ($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){
                 if (!empty($invoice_data['0']['customer_details']['shipping_gst_no']) && $invoice_data['0']['customer_details']['shipping_gst_no'] !== "NA") {
                    $shipping_gst_no = $invoice_data['0']['customer_details']['shipping_gst_no'];
                }else{
                    $shipping_gst_no = null;
                }
             }
        //    echo "ship gst : ".$shipping_gst_no;exit;
                
            $formattedDate = date('d/m/Y', strtotime($invoice_data['0']['transaction_date']));
             if(!empty($invoice_data['0']['customer_details']['shipping_address'])){
            $cleanBillingAddress1 = isset($invoice_data['0']['customer_details']['shipping_address']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['shipping_address']) : '';
            $maxLength = 80;
            $cust_billing_add1 = substr($cleanBillingAddress1, 0, $maxLength);
            }else{
                $cust_billing_add1 = null; 
            }
            if(!empty($invoice_data['0']['customer_details']['billing_address'])){
                $cleanBillingAddress2 = isset($invoice_data['0']['customer_details']['billing_address']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['billing_address']) : '';
                $maxLength = 80;
                $cust_billing_add2 = substr($cleanBillingAddress2, 0, $maxLength);
            }else{
                $cust_billing_add2 = null;
            }
            if ($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){
                   $cleanShippingAddress1 = isset($invoice_data['0']['customer_details']['saddress1']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['saddress1']) : '';
                    $maxLength = 80;
                    $cust_shipping_add1 = substr($cleanShippingAddress1, 0, $maxLength);


                if(!empty($invoice_data['0']['customer_details']['saddress2'])){
                    $cleanShippingAddress2 = isset($invoice_data['0']['customer_details']['saddress2']) ? str_replace(array("\r", "\n"), ' ', $invoice_data['0']['customer_details']['saddress2']) : '';
                    $maxLength = 80;
                    $cust_shipping_add2 = substr($cleanShippingAddress2, 0, $maxLength);
                }
            }

          

            // echo $cust_shipping_add1.'and'.$cust_shipping_add2;exit;
         

            $cgstTotal = 0;
            $sgstTotal = 0;
            $igstAmount =0;
          
            foreach ($invoice_data['0']['invoice_details'] as $item) {
                if ($item['tax_type'] == 'Other') {
                    
                    // Calculate total tax amount for tax_type other than 'total_tax'
                    $totalTaxAmount = $invoice_data['0']['total_tax'];
                    
                    // Divide total tax amount into CGST and SGST
                    $cgstTotal = $totalTaxAmount / 2;
                    $sgstTotal = $totalTaxAmount / 2;

                   
                }
                else if($item['tax_type'] == 'IGST'){
                    $totalTaxAmount = $invoice_data['0']['total_tax'];

                }
            }

            // Define your data
            $data = [
                    "Version" => "1.01",
                    "TranDtls" => array(
                        "TaxSch" => "GST",
                        "SupTyp" => $invoice_data['0']['transaction_category'],
                        "IgstOnIntra" => "N",
                        "RegRev" => "N",
                        "EcmGstin" => null
                    ),
                    "DocDtls" => array(
                        "Typ" => "INV",
                        "No" => $invoice_data['0']['invoice_no'],
                        "Dt" => $formattedDate
                    ),
                    "SellerDtls" => array(
                        "Gstin" => "08AABFC2155P1ZA",
                        "LglNm" => "CHOUDHARY & COMPANY",
                        "Addr1" => "B-133, M.I.A., MADRI",
                        "Addr2" => "B-133, M.I.A., MADRI",
                        "Loc" => "B-133, M.I.A., MADRI, UDAIPUR",
                        "Pin" => 313003,
                        "Stcd" => "08",
                        "Ph" => null,
                        "Em" => "accounts@cnco.co.in"
                    ),
                    "BuyerDtls" => array(
                        "Gstin" => $buyer_gst_no,
                        "LglNm" => $invoice_data['0']['customer_details']['customer_name'],
                        "Addr1" => $cust_billing_add1,
                        "Addr2" => $cust_billing_add2,
                        "Loc" => $invoice_data['0']['customer_details']['destination'],
                        "Pin" => (int)$invoice_data['0']['customer_details']['billing_pincode'],
                        "Pos" => $invoice_data['0']['customer_details']['state_code'],
                        "Stcd" => $invoice_data['0']['customer_details']['state_code'],
                        "Ph" => null,
                        "Em" => null
                    ),
                    "ValDtls" => array(
                        "AssVal" => (float) $invoice_data['0']['total_rate'],
                        // "TotalTax" => (float) $invoice_data['0']['total_tax'],
                        "IgstVal" => $item['tax_type'] == 'IGST' ? (float) $totalTaxAmount : 0,
                        "CgstVal" => $item['tax_type'] == 'Other' ? (float) $cgstTotal : 0,
                        "SgstVal" => $item['tax_type'] == 'Other' ? (float) $sgstTotal : 0,
                        "CesVal" => 0,
                        "StCesVal" => 0,
                        "Discount" => 0,
                        "OthChrg" => 0,
                        "RndOffAmt" => (float) $invoice_data['0']['round_off'],
                        "TotInvVal" => (float) $invoice_data['0']['grand_total']
                    ),
                    "RefDtls" => array(
                        "InvRm" => "NICGEPP2.0"
                    )
                ];

                
                $ItemList = [];
                $toalcgstAmt=0;
                $toalsgstAmt=0;
                $toaligstAmt=0;
                // Iterate over invoice_details
                $totalamt=0;
                $slno =0;

                // Iterate over invoice_details
                foreach ($invoice_data['0']['invoice_details'] as $index => $detail) {
                    $slno = $index + 1;
                    $totalamt= $detail['quantity'] *$detail['rate'];
                    if ($detail['tax_type'] == 'Other') {
                        $toalcgstAmt=$detail['tax_amount'] / 2;
                        $toalsgstAmt=$detail['tax_amount'] / 2;
                    }
                    else if($detail['tax_type'] == 'IGST'){
                        $toaligstAmt=$detail['tax_amount'];
                    }
                    $ItemList[] = [
                        "SlNo" =>strval($slno), // Assuming SlNo starts from 1
                        "PrdDesc" => strtoupper($detail['mineral_name']), // Convert to uppercase
                        "IsServc" => "N",
                        "HsnCd" => (string)$detail['hsn_code'], // Convert to string
                        "Qty" => (float) $detail['quantity'], // Assuming quantity is in MTS
                        "FreeQty" => 0,
                        "Unit" => "MTS",
                        "UnitPrice" => (float)$detail['rate'], // Convert to float if not already
                        "TotAmt" => round($totalamt,2), // Convert to float if not already
                        "Discount" => 0,
                        "PreTaxVal" => 0,
                        "AssAmt" => (float)$detail['taxable_amount'], 
                        "GstRt" => (float)$detail['tax_per'],
                        "IgstAmt" => $detail['tax_type'] == 'IGST' ? (float) $toaligstAmt : 0,
                        "CgstAmt" =>$detail['tax_type'] == 'Other' ? (float) $toalcgstAmt : 0,
                        "SgstAmt" =>$detail['tax_type'] == 'Other' ? (float) $toalsgstAmt : 0,
                        "CesRt" => 0,
                        "CesAmt" => 0,
                        "CesNonAdvlAmt" => 0,
                        "StateCesRt" => 0,
                        "StateCesAmt" => 0,
                        "StateCesNonAdvlAmt" => 0,
                        "OthChrg" => 0,
                        "TotItemVal" => (float)$detail['amount'] // Assuming same as TotAmt
                    ];
            }
            foreach ($invoice_data['0']['invoice_details'] as $item) {
                if ($item['tax_type'] == 'Other') {
                    // Calculate total tax amount for tax_type other than 'total_tax'
                    $totalTaxAmount = $invoice_data['0']['total_delivr_tax_per'];
                    // Divide total tax amount into CGST and SGST
                    $cgstTotal = $totalTaxAmount / 2;
                    $sgstTotal = $totalTaxAmount / 2;
                }
                else if($item['tax_type'] == 'IGST'){
                    $igstAmount = $invoice_data['0']['total_delivr_tax_per'];

                }
            }
           if($invoice_data['0']['delivr_rate'] >0){
                $ItemList[]=[
                    "SlNo" =>strval($slno+1), // Assuming SlNo starts from 1
                    "PrdDesc" => "Transport", // Convert to uppercase
                    "IsServc" => "Y",
                    "HsnCd" => "996781", // Convert to string
                    "Qty" => (float) $invoice_data['0']['total_quantity'], // Assuming quantity is in MTS
                    "FreeQty" => 0,
                    "Unit" => "MTS",
                    "UnitPrice" => (float)$invoice_data['0']['delivr_rate'], // Convert to float if not already
                    "TotAmt" => round($invoice_data['0']['total_deliver_amt'],2), // Convert to float if not already
                    "Discount" => 0,
                    "PreTaxVal" => 0,
                    "AssAmt" => (float)$invoice_data['0']['total_deliver_amt'], 
                    "GstRt" => (float)$invoice_data['0']['delivr_tax_per'],
                    "IgstAmt" => (float)$igstAmount,
                    "CgstAmt" =>(float)$cgstTotal,
                    "SgstAmt" =>(float)$sgstTotal,
                    "CesRt" => 0,
                    "CesAmt" => 0,
                    "CesNonAdvlAmt" => 0,
                    "StateCesRt" => 0,
                    "StateCesAmt" => 0,
                    "StateCesNonAdvlAmt" => 0,
                    "OthChrg" => 0,
                    "TotItemVal" => (float)$invoice_data['0']['total_taxable_value'] 
                ];
            }
            if($invoice_data['0']['ewaybillstatus'] == 'Yes'){
            $eWayBill= [
                    "EwbDtls" => array(
                        "TransId" =>$transport_id,
                        "TransName" => $invoice_data['0']['transporter_name'],
                        "TransMode" => "1",
                        "Distance" => (int)$invoice_data['0']['customer_details']['ship_destination'],
                        "TransDocNo" => $invoice_data['0']['gr_no'],
                        "TransDocDt" => $formattedDate,
                        "VehNo" => $invoice_data['0']['truck_no'],
                        "VehType" => "R"
                    )
                ];
            }else{
                $eWayBill ='';
            }
             if ($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){
                $shipDetailsArr= [
                    "ShipDtls" => array(
                            "Gstin" => $shipping_gst_no,
                            "LglNm" => $invoice_data['0']['customer_details']['shipping_legal_name'],
                            "Addr1" => $cust_shipping_add1,
                            "Addr2" => $cust_shipping_add2,
                            "Loc" => $invoice_data['0']['customer_details']['loc'],
                            "Pin" => (int)$invoice_data['0']['customer_details']['ship_pincode'],
                            "Stcd" => $invoice_data['0']['customer_details']['ship_state_code'],
                        )
                    ];
                }else{
                     $shipDetailsArr ='';
                }


           // Convert data to JSON format
             // Convert data to JSON format
            $json_data = json_encode($data);
            $dataArray = json_decode($json_data, true);
            $itemListArray = ["ItemList" => $ItemList];
            $finalMerge = $dataArray;
            // Conditionally merge eWayBill if available
            if (!empty($eWayBill)) {
                $eWayBill_json = json_encode($eWayBill);
                $eWayArray = json_decode($eWayBill_json, true);
                $finalMerge = array_merge($finalMerge, $eWayArray);
            }

            // Conditionally merge shipDetailsArr if shipping is "Yes"
            if (!empty($shipDetailsArr)) {
                $shipDetails_json = json_encode($shipDetailsArr);
                $shipDetailsArray = json_decode($shipDetails_json, true);
                $finalMerge = array_merge($finalMerge, $shipDetailsArray);
            }
            // Always merge ItemList
            $finalMerge = array_merge($finalMerge, $itemListArray);
            // Add to final array
            $mergedArray[] = $finalMerge;
            $mergedJson = json_encode($mergedArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            // echo "<pre>";print_r($mergedJson);exit;
            // $json_data = json_encode($data, JSON_UNESCAPED_SLASHES);
            $file_name = 'CNC' . date('Ymd_His') . '.json';

            // Save JSON data to a file
            $file_path = BASEPATH . 'json_files/'.$file_name;
            // echo $file_path;exit;
            // Save JSON data to a file
            if (file_put_contents($file_path, $mergedJson) !== false) {
                // Send headers to force download
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename="' . $file_name . '"');
                header('Content-Length: ' . filesize($file_path));
                readfile($file_path);
                exit;
                // Open the generated JSON file in a new tab for download
                //  echo '<script>window.open("' . base_url() . 'index.php/Invoice/download_json/' . $file_name . '");</script>';
            } else {
                echo "Failed to generate JSON file.";
            }

            // file_put_contents($file_path, $json_data);
            echo "JSON file generated successfully!";
        }
    }
    public function download_json($file_name) {
        $file_path = BASEPATH . 'json_files/' . $file_name;
    
        if (file_exists($file_path)) {
            header('Content-Type: application/json');
            header('Content-Disposition: attachment; filename="' . $file_name . '"');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
        } else {
            echo "File not found.";
        }
    }
    function convert_number_to_words($number) {
        $hyphen      = ' ';
        $conjunction = ' and ';
        $separator   = ' ';
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
                    $hundreds  = intval($number / 100); // Convert result to integer
                    $remainder = (int)$number % 100;
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
    public function previewEdit($id=NULL) {
    //$id = decrypt_url($gir_id);
    // print_r($id);exit;
    $data = array();
    // print_r($result);exit;
    $data['last_invoice_no'] = $this->Invoice_model->getInvoiceCode();

    $result['rows']=$this->Invoice_model->getByIdPreview($id);
    //print_r($data['rows'][0]['invoice_no']);exit;
    if (isset($data['rows'][0]['id'])) :
        $data['id'] = $result['rows'][0]['id'];
    else:
        $data['id'] = '';
    endif;

    if (isset($result[0]['customer_id']) && $result[0]['customer_id']) :
        $data['customer_id'] = $result[0]['customer_id'];
    else:
        $data['customer_id'] = '';
    endif;

    if (isset($data['rows'][0]['invoice_no'])) :
        $data['invoice_no'] = $data['rows'][0]['invoice_no'];
        else:
            $data['invoice_no'] = '';
    endif;

    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;
     if (isset($result[0]['vendor_service_tax_no']) && $result[0]['vendor_service_tax_no']) :
        $data['vendor_service_tax_no'] = $result[0]['vendor_service_tax_no'];
    else:
        $data['vendor_service_tax_no'] = '';
    endif;
    if (isset($result[0]['payment_status']) && $result[0]['payment_status']) :
        $data['payment_status'] = $result[0]['payment_status'];
    else:
        $data['payment_status'] = '';
    endif;
    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = date('d-m-Y');
    endif; 
     if (isset($result[0]['total_qty'])) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif; 

     if (isset($result[0]['total_rate'])) :
        $data['total_rate'] = $result[0]['total_rate'];
    else:
        $data['total_rate'] = '';
    endif; 
 if (isset($result[0]['total_amount'])) :
        $data['total_amount'] = $result[0]['total_amount'];
    else:
        $data['total_amount'] = '';
    endif; 
    if (isset($result[0]['tax_per_cgst'])) :
        $data['total_rate'] = $result[0]['total_rate'];
    else:
        $data['total_rate'] = '';
    endif; 
    
 if (isset($result[0]['total_amount_before_round_off'])) :
        $data['total_amount_before_round_off'] = $result[0]['total_amount_before_round_off'];
    else:
        $data['total_amount_before_round_off'] = '';
    endif; 


     if (isset($result[0]['gir_details']) && $result[0]['gir_details']) :
        $data['gir_details'] = $result[0]['gir_details'];
    else:
        $data['gir_details'] = '';
    endif;
    $data['title']=' Edit Invoice';
    $data['items']=$this->Invoice_model->getFGmineralsList();
    
    $data['vendorcodes']=$this->Invoice_model->getCustomerCodes();
    $data['transporters']=$this->Invoice_model->getTransporters();
   
    $data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
    // echo "<pre>"; print_r($data['packing_sizes']); die;
    $this->template->load('template','invoice_edit',$data);
    //$this->load->view('footer');    
    } 
    public function edit($id=NULL) {
    //$id = decrypt_url($gir_id);
    // print_r($id);exit;
    $data = array();
    $result = $this->Invoice_model->getById($id);
    // print_r($result);exit;

    if (isset($result[0]['id']) && $result[0]['id']) :
        $data['id'] = $result[0]['id'];
    else:
        $data['id'] = '';
    endif;

    if (isset($result[0]['customer_id']) && $result[0]['customer_id']) :
        $data['customer_id'] = $result[0]['customer_id'];
    else:
        $data['customer_id'] = '';
    endif;
        if (isset($result[0]['invoice_no']) && $result[0]['invoice_no']) :
        $data['invoice_no'] = $result[0]['invoice_no'];
        // $voucher_no= $data['invoice_no'];
        // if($voucher_no<10){
        // $invoice_code='INV000'.$voucher_no;
        // }
        // else if(($voucher_no>=10) && ($voucher_no<=99)){
        //   $invoice_code='INV00'.$voucher_no;
        // }
        // else if(($voucher_no>=100) && ($voucher_no<=999)){
        //   $invoice_code='CNC/A/'.$voucher_no;
        // }
        // else{
        //   $invoice_code='CNC/A/'.$voucher_no;
        // }
        // $data['invoice_code_show']=$invoice_code;
        else:
             $data['invoice_no'] = '';
        endif;

    if (isset($result[0]['supplier_id']) && $result[0]['supplier_id']) :
        $data['supplier_id'] = $result[0]['supplier_id'];
    else:
        $data['supplier_id'] = '';
    endif;
     if (isset($result[0]['vendor_service_tax_no']) && $result[0]['vendor_service_tax_no']) :
        $data['vendor_service_tax_no'] = $result[0]['vendor_service_tax_no'];
    else:
        $data['vendor_service_tax_no'] = '';
    endif;
    if (isset($result[0]['payment_status']) && $result[0]['payment_status']) :
        $data['payment_status'] = $result[0]['payment_status'];
    else:
        $data['payment_status'] = '';
    endif;
    if (isset($result[0]['comment']) && $result[0]['comment']) :
        $data['comment'] = $result[0]['comment'];
    else:
        $data['comment'] = '';
    endif;
     if (isset($result[0]['transaction_date']) && $result[0]['transaction_date']) :
        $data['transaction_date'] = $result[0]['transaction_date'];
    else:
        $data['transaction_date'] = date('d-m-Y');
    endif; 
     if (isset($result[0]['total_qty'])) :
        $data['total_qty'] = $result[0]['total_qty'];
    else:
        $data['total_qty'] = '';
    endif; 

     if (isset($result[0]['total_rate'])) :
        $data['total_rate'] = $result[0]['total_rate'];
    else:
        $data['total_rate'] = '';
    endif; 
 if (isset($result[0]['total_amount'])) :
        $data['total_amount'] = $result[0]['total_amount'];
    else:
        $data['total_amount'] = '';
    endif; 
    if (isset($result[0]['tax_per_cgst'])) :
        $data['total_rate'] = $result[0]['total_rate'];
    else:
        $data['total_rate'] = '';
    endif; 
    
 if (isset($result[0]['total_amount_before_round_off'])) :
        $data['total_amount_before_round_off'] = $result[0]['total_amount_before_round_off'];
    else:
        $data['total_amount_before_round_off'] = '';
    endif; 


     if (isset($result[0]['gir_details']) && $result[0]['gir_details']) :
        $data['gir_details'] = $result[0]['gir_details'];
    else:
        $data['gir_details'] = '';
    endif;
    $data['title']=' Edit Invoice';
    $data['items']=$this->Invoice_model->getFGmineralsList();
    
    $data['vendorcodes']=$this->Invoice_model->getCustomerCodes();
    $data['transporters']=$this->Invoice_model->getTransporters();
    $data['rows']=$this->Invoice_model->getById($id);
    $data['packing_sizes']= array('25' => '25Kg','50'=>'50Kg');
    // echo "<pre>"; print_r($data['packing_sizes']); die;
    $this->template->load('template','invoice_edit',$data);
    //$this->load->view('footer');
    
    }
    public function index(){
            $data['title']=' Invoice List';
			if($this->input->get())
			{
				$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
				$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
				$conditions['limit'] = '';
				$data['conditions']=$conditions;
				//print_r($data['conditions']);exit;
			   $data['invoice_data'] = $this->Invoice_model->getInvoicesList($conditions);
			   $data['conditions'] = $conditions;

			}
			else{
				$conditions['from_date'] = '';
				$conditions['upto_date'] = '';
				$conditions['limit'] = '20';
				$data['invoice_data'] = $this->Invoice_model->getInvoicesList($conditions);
				$data['conditions'] = $conditions;
			}


            //$data['suppliers']=$this->invoice_model->getSuppliers();
            //$data['invoice_data']=$this->Invoice_model->getInvoicesList();
            // echo "<pre>";print_r($data['invoice_data']);exit;
            $this->template->load('template','invoice_view',$data);
        }
    public function rm_gir_index(){
            //$vv=$this->encrypt->encode('hy');
            //print_r($vv);exit;
            $data['title']=' RM GIR Register List';
            //$data['suppliers']=$this->invoice_model->getSuppliers();
            //$data['Items']=$this->invoice_model->getItems();
            $data['gir_data']=$this->invoice_model->getListRMgir();
            //$data['states']=$this->invoice_model->getStates();
            $this->template->load('template','gir_rm_register_view',$data);
        }
    public function add_new_invoice() {

        // echo"<pre>";
        // print_r($_POST);exit;
        // print_r($this->input->post('transaction_date'));
        // echo"</pre>";exit;
        $this->form_validation->set_rules('finish_good_id[]', 'Product Name', 'required');
        if($this->input->post('type_of_tax') =='IGST'){
            $tax_per_igst = $this->input->post('tax_per_igst');
            $igst_amount =$this->input->post('igst_amount');
            $grand_total_after_igst =$this->input->post('grand_total_after_igst');
            $tax_per_cgst=0.00;
            $cgst_amount=0.00;
            $grand_total_after_cgst=0.00;
            $tax_per_sgst=0.00;
            $sgst_amount=0.00;
            $grand_total_after_sgst=0.00;
        }
        else
        {
            $tax_per_cgst = $this->input->post('tax_per_cgst');
            $cgst_amount =$this->input->post('cgst_amount');
            $grand_total_after_cgst =$this->input->post('grand_total_after_cgst');
            $tax_per_sgst = $this->input->post('tax_per_sgst');
            $sgst_amount =$this->input->post('sgst_amount');
            $grand_total_after_sgst =$this->input->post('grand_total_after_sgst');
            $tax_per_igst=0.00;
            $igst_amount=0.00;
            $grand_total_after_igst=0.00;
        }     
        //$voucher_no='0';
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
            if($this->input->post('isshipping')== 'Yes'){
                $a = $this->input->post('shipping_gst_status');
                $b = $this->input->post('shipping_gst_no');
                $c = $this->input->post('shipping_legal_name');
                $d = $this->input->post('address1');
                $e = $this->input->post('address2');
                $f = $this->input->post('loc');
                $g = $this->input->post('ship_pincode');
                $h = $this->input->post('ship_state_code');
            }else if($this->input->post('isshipping')== 'No'){
                $a=null;$b=null;$c=null;$d=null;$e=null;$f=null;$g=null;$h=null;
            };
            $login_id=$this->session->userdata['logged_in']['id'];
            $data = array(
                
            'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
            //'gir_no' => $voucher_no,
            'invoice_no' => $this->input->post('invoice_no'),
            'transaction_category' => $this->input->post('transaction_category'),
            //'vendor_code' => $this->input->post('vendor_code'),
            'customer_id' => $this->input->post('customer_id'),
            'vendor_service_tax_no' => $this->input->post('vendor_service_tax_no'),
            'po_no' => $this->input->post('po_no'),
            'po_date' => $this->input->post('po_date'),
            'buyer_item_code' => $this->input->post('buyer_item_code'),
            'remarks' => $this->input->post('remarks'),
            'payment_status' => $this->input->post('payment_status'),
            'total_amount' => $this->input->post('total_amount'),
            'total_rate' => $this->input->post('total_taxable_amount'),
            'frieght_status' => $this->input->post('frieght_status'),
            'total_tax' => $this->input->post('total_tax'),
            'hsncode' => $this->input->post('hsncode'),
            'total_bags' => $this->input->post('total_bags'),
            'total_quantity' => $this->input->post('total_quantity'),
            'delivr_rate' => $this->input->post('delivr_rate'),
            'delivr_tax_per' => $this->input->post('delivr_tax_per'),
            'total_delivr_tax_per' => $this->input->post('total_delivr_tax_per'),
            'total_deliver_amt' => $this->input->post('total_deliver_amt'),
            'total_taxable_value' => $this->input->post('total_taxable_value'),
            'round_off' => $this->input->post('round_off'), 
            'grand_total' => $this->input->post('grand_total'),
            'truck_no' => $this->input->post('truck_no'),
            'transporter_id' => $this->input->post('transporter_id'),
            'ewaybillstatus' => $this->input->post('ewaybillstatus'),
            'tp_no' => $this->input->post('tp_no'),
            'transport_id' => $this->input->post('transport_id'),
            'destination' => $this->input->post('destination'),
            'driver_name1' => $this->input->post('driver_name1'),
            'contact1' => $this->input->post('contact1'),
            'driver_name2' => $this->input->post('driver_name2'),
            'contact2' => $this->input->post('contact2'),
            'driver_name3' => $this->input->post('driver_name3'),
            'contact3' => $this->input->post('contact3'),
            'gr_no' => $this->input->post('gr_no'), 
            'distance' => $this->input->post('distance'), 
            'test_report_no' => $this->input->post('test_report_no'), 
            'report_sending_status' => $this->input->post('report_sending_status'), 
            'testing_date' =>  date('Y-m-d',strtotime($this->input->post('testing_date'))),
            'created_by' => $login_id
            );
            
            // print_r($data);exit;

            $result = $this->Invoice_model->invoice_insert_preview($data);
            
            if ($result != false)
            {
                //$categories_id=$this->input->post('categories_id');
                    // $this->session->set_flashdata('success', 'Data inserted Successfully !');
                    redirect('/Invoice/preview/'.$result, 'refresh');
                
            //$this->fetchSuppliers();
            } 
        }
    }
    public function form_submit($id){

        $data['invoice_data'] = $this->Invoice_model->getByIdPreview($id);
		// echo "<pre>";print_r($data['invoice_data']) ;exit;
         /* echo "<pre>";
        print_r($data['invoice_data'][0]['invoice_details']);*/
        $data['invoice_details']=$data['invoice_data'][0]['invoice_details'];
        
        //$voucher_no=$data['invoice_data']['0']['invoice_no'];
         $login_id=$this->session->userdata['logged_in']['id'];
            $invoice = array(
            'transaction_date' => $data['invoice_data']['0']['transaction_date'],
            'invoice_no' => $data['invoice_data']['0']['invoice_no'],
            'transaction_category' => $data['invoice_data']['0']['transaction_category'],
            'customer_id' => $data['invoice_data']['0']['customer_id'],
            'vendor_service_tax_no' => $data['invoice_data']['0']['vendor_service_tax_no'],
            'po_no' => $data['invoice_data']['0']['po_no'],
            'po_date' =>  $data['invoice_data']['0']['po_date'],
            'buyer_item_code' =>$data['invoice_data']['0']['buyer_item_code'],
            'remarks' => $data['invoice_data']['0']['remarks'],
            'payment_status' => $data['invoice_data']['0']['payment_status'],
            'total_amount' => $data['invoice_data']['0']['total_amount'],
            'total_rate' => $data['invoice_data']['0']['total_rate'],
            'total_tax' =>$data['invoice_data']['0']['total_tax'],
            'hsncode' => $data['invoice_data']['0']['hsncode'],
            'total_bags' =>$data['invoice_data']['0']['total_bags'],
            'total_quantity' => $data['invoice_data']['0']['total_quantity'],
            'delivr_rate' => $data['invoice_data']['0']['delivr_rate'],
            'delivr_tax_per' => $data['invoice_data']['0']['delivr_tax_per'],
            'total_delivr_tax_per' => $data['invoice_data']['0']['total_delivr_tax_per'],
            'total_deliver_amt' => $data['invoice_data']['0']['total_deliver_amt'],
            'total_taxable_value' => $data['invoice_data']['0']['total_taxable_value'],
            'round_off' => $data['invoice_data']['0']['round_off'], 
            'grand_total' => $data['invoice_data']['0']['grand_total'],
            'truck_no' => $data['invoice_data']['0']['truck_no'],
            'transporter_id' =>$data['invoice_data']['0']['transporter_id'],
            'ewaybillstatus' =>$data['invoice_data']['0']['ewaybillstatus'],
            'tp_no' => $data['invoice_data']['0']['tp_no'],
            'frieght_status' => $data['invoice_data']['0']['frieght_status'],
            'transport_id' => $data['invoice_data']['0']['transport_id'],
            'destination' => $data['invoice_data']['0']['destination'],
            'driver_name1' => $data['invoice_data']['0']['driver_name1'],
            'contact1' => $data['invoice_data']['0']['contact1'],
            'driver_name2' => $data['invoice_data']['0']['driver_name2'],
            'contact2' => $data['invoice_data']['0']['contact2'],
            'driver_name3' => $data['invoice_data']['0']['driver_name3'],
            'contact3' => $data['invoice_data']['0']['contact3'],
            'gr_no' => $data['invoice_data']['0']['gr_no'], 
            'distance' => $data['invoice_data']['0']['distance'], 
            'test_report_no' => $data['invoice_data']['0']['test_report_no'], 
            'report_sending_status' => $data['invoice_data']['0']['report_sending_status'], 
            'testing_date' =>  $data['invoice_data']['0']['testing_date'],
            'created_by' => $login_id
            );
            foreach ($data['invoice_data'][0]['invoice_details'] as $key => $value) {
        //   echo "<pre>";print_r($value);exit;
            $showing = array(
                'invoice_id' => $value['invoice_id'],
                'finish_good_id' => $value['finish_good_id'],
				'production_month' => $value['production_month'],
                'lot_no' => $value['lot_no'],
                'batch_no' => $value['batch_no'],
                'no_of_bags' => $value['no_of_bags'],
                'packing_size' => $value['packing_size'],
                'qty' => $value['quantity'],
                'rate' => $value['rate'],
                'tax_type' => $value['tax_type'],
                'tax_per' => $value['tax_per'],
                'tax_amount' => $value['tax_amount'],
                'taxable_amount' => $value['taxable_amount'],
               'amount' => $value['amount'],
                );
                $invoice_datass['details'][$key]=$showing;
            }
            // echo "<pre>";
            // print_r($invoice);
            // print_r($invoice_datass);exit;
            //$invoice_detta=array_merge($invoice,$invoice_datass);
            $result = $this->Invoice_model->invoice_insert($invoice,$invoice_datass);
            
            if ($result != false)
            {
               
                //$categories_id=$this->input->post('categories_id');
                    $this->session->set_flashdata('success', 'Data inserted Successfully !');
                    redirect('/Invoice/index/','refresh');
                
            //$this->fetchSuppliers();
            } 

            //print_r($invoice_detta);exit;
            $this->session->set_flashdata('success', 'Data inserted Successfully !');
            redirect('/Invoice/index', 'refresh');
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
            'challan_no' => $this->input->post('challan_no'),
            'categories_id' => $this->input->post('categories_id'),
            'supplier_id' => $this->input->post('supplier_id'),
            'transporter_id' => $this->input->post('transporter_id'),
            'weight_slip_no' => $this->input->post('weight_slip_no'),
            'actual_weight' => $this->input->post('actual_weight'),
            'doc_weight' => $this->input->post('doc_weight'),
            'weight' => $this->input->post('weight'),
            'truck_no' => $this->input->post('truck_no'),
            'sample_tested' => $this->input->post('sample_tested'),
            'payment' => $this->input->post('payment'),
            'material_received_from' => $this->input->post('material_received_from'),
            'total_qty' => $this->input->post('total_qty'),
            'comments' => $this->input->post('comments'),
            'edited_by' => $login_id
            );
            $old_id = $this->input->post('gir_id_old'); 
            //print_r($this->input->post('products[]'));exit;
            $result = $this->invoice_model->editGIR($data,$old_id);
            if ($result == TRUE) 
            {
                $categories_id=$this->input->post('categories_id');
                if($categories_id =='1'){
                    $this->session->set_flashdata('success', 'Data inserted Successfully !');
                    redirect('/Invoice/rm_gir_index', 'refresh');
                }
                else{
                    $this->session->set_flashdata('success', 'Data inserted Successfully !');
                    redirect('/Invoice/index', 'refresh');
                }
        
            } else {
                $categories_id=$this->input->post('categories_id');
                if($categories_id =='1'){
                    $this->session->set_flashdata('failed', 'No changes in gir details!');
                    redirect('/Invoice/rm_gir_index', 'refresh');
                }
                else{
                    $this->session->set_flashdata('failed', 'No changes in gir details!');
                    redirect('/Invoice/index', 'refresh');
                }
            //$this->template->load('template','supplier_view');
            }
        }
    }
    public function update($id){

           // echo"<pre>";
        // print_r($_POST);
        // print_r($this->input->post('transaction_date'));
        // echo"</pre>";exit;
        $this->form_validation->set_rules('finish_good_id[]', 'Product Name', 'required');
        if($this->input->post('type_of_tax') =='IGST'){
            $tax_per_igst = $this->input->post('tax_per_igst');
            $igst_amount =$this->input->post('igst_amount');
            $grand_total_after_igst =$this->input->post('grand_total_after_igst');
            $tax_per_cgst=0.00;
            $cgst_amount=0.00;
            $grand_total_after_cgst=0.00;
            $tax_per_sgst=0.00;
            $sgst_amount=0.00;
            $grand_total_after_sgst=0.00;
        }
        else
        {
            $tax_per_cgst = $this->input->post('tax_per_cgst');
            $cgst_amount =$this->input->post('cgst_amount');
            $grand_total_after_cgst =$this->input->post('grand_total_after_cgst');
            $tax_per_sgst = $this->input->post('tax_per_sgst');
            $sgst_amount =$this->input->post('sgst_amount');
            $grand_total_after_sgst =$this->input->post('grand_total_after_sgst');
            $tax_per_igst=0.00;
            $igst_amount=0.00;
            $grand_total_after_igst=0.00;
        }     
        //$voucher_no='0';
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
    
            $login_id=$this->session->userdata['logged_in']['id'];
            $data = array(
                
            'transaction_date' => date('Y-m-d',strtotime($this->input->post('transaction_date'))),
            //'gir_no' => $voucher_no,
            'invoice_no' => $this->input->post('invoice_no'),
            'transaction_category' => $this->input->post('transaction_category'),
            //'vendor_code' => $this->input->post('vendor_code'),
            'customer_id' => $this->input->post('customer_id'),
            'vendor_service_tax_no' => $this->input->post('vendor_service_tax_no'),
            'po_no' => $this->input->post('po_no'),
            'po_date' => $this->input->post('po_date'),
            'buyer_item_code' => $this->input->post('buyer_item_code'),
            'remarks' => $this->input->post('remarks'),
            'payment_status' => $this->input->post('payment_status'),
            'total_amount' => $this->input->post('total_amount'),
            'total_rate' => $this->input->post('total_rate'),
            'type_of_tax' => $this->input->post('type_of_tax'),
            'tax_per_igst' => $tax_per_igst,
            'igst_amount' => $igst_amount,
            'grand_total_after_igst' => $grand_total_after_igst,
            'tax_per_cgst' => $tax_per_cgst,
            'cgst_amount' => $cgst_amount,
            'grand_total_after_cgst' => $grand_total_after_cgst,
            'tax_per_sgst' => $tax_per_sgst,
            'sgst_amount' => $sgst_amount,
            'grand_total_after_sgst' => $grand_total_after_sgst,
            //'comment' => $this->input->post('comment'),
            'total_amount_before_round_off' => $this->input->post('final_total_amount'),
            'round_off' => $this->input->post('round_off'), 
            'grand_total' => $this->input->post('grand_total'),
            'truck_no' => $this->input->post('truck_no'),
            'transporter_id' => $this->input->post('transporter_id'),
            // 'way_billno' => $this->input->post('way_billno'),
            'tp_no' => $this->input->post('tp_no'),
            'frieght_status' => $this->input->post('frieght_status'),
            'transport_id' => $this->input->post('transport_id'),
            'destination' => $this->input->post('destination'),
            'driver_name1' => $this->input->post('driver_name1'),
            'contact1' => $this->input->post('contact1'),
            'driver_name2' => $this->input->post('driver_name2'),
            'contact2' => $this->input->post('contact2'),
            'driver_name3' => $this->input->post('driver_name3'),
            'contact3' => $this->input->post('contact3'),
            'gr_no' => $this->input->post('gr_no'), 
            'test_report_no' => $this->input->post('test_report_no'), 
            'report_sending_status' => $this->input->post('report_sending_status'), 
            'testing_date' =>  date('Y-m-d',strtotime($this->input->post('testing_date'))),
            'edited_by' => $login_id
            );
            
            // echo "<pre>"; print_r($data);exit;

            $result = $this->Invoice_model->editInvoicePreview($data,$id);

            if ($result != false)
            {
               
                //$this->session->set_flashdata('success', 'Data Update Successfully !');
                redirect('/Invoice/preview/'.$result, 'refresh');
                
            
            } 
        }
    }
    public function deleteInvoice($id= null){
        // echo "hello";exit;
        $ids=$this->input->post('ids');
        if(!empty($ids)) 
        {
            $Datas=explode(',', $ids);
            foreach ($Datas as $key => $id) {
                $this->Invoice_model->deleteInvoice($id);
            }
                echo $this->session->set_flashdata('success', 'Selected Invoices deleted Successfully !');
        }
        else
        {
            $id = $this->uri->segment('3');
            $this->Invoice_model->deleteInvoice($id);
            $this->session->set_flashdata('success', 'Invoice deleted Successfully !');
            redirect('/Invoice/index', 'refresh');
                //$this->fetchSuppliers(); //render the refreshed list.
        }
     }
	 public function report() 
	{
		$data['title'] = 'Invoice Slip Report';
		if($this->input->get())
		{
		 	//$conditions['employee_id']=$this->input->get('employee_id');
		 	//$conditions['department_id']=$this->input->get('department_id');
		 	//$conditions['approved_status']=$this->input->get('approved_status');
		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->get('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->get('upto_date')));
		 	$data['conditions']=$conditions;
		 	//print_r($data['conditions']);exit;
           $data['invoice_data'] = $this->Invoice_model->getInvoicesList($conditions);

		}
		else{
			$data['invoice_data'] = $this->Invoice_model->getInvoicesList();
		}

		
		//$data['employees'] = $this->Invoice_model->getEmployees();
		//$data['departments'] = $this->Invoice_model->getDepartments();
		//$data['req_status']= array('All'=>'All','Pending' => 'Pending','Approved'=>'Approved','Rejected'=>'Rejected');
		//echo var_dump($data['students']);
		$this->template->load('template','invoice_report',$data);
	}
	 function createXLS() {
  	  	
		// create file name
		//$name='C:/Users/Jarvis/Downloads/myexcel.xls';
       	$fileName ='data-'.time().'.xls';  
		// load excel library
       	$this->load->library('excel');

		if($this->input->post())
		{

		 	$conditions['from_date']=date('Y-m-d',strtotime($this->input->post('from_date')));
        	$conditions['upto_date']=date('Y-m-d',strtotime($this->input->post('upto_date')));
           	$reqSlipInfo = $this->Invoice_model->getInvoicesList($conditions);
		}else
		{
			$reqSlipInfo = $this->Invoice_model->getInvoicesList();
		}
		//print_r($reqSlipInfo);exit;	
        $objPHPExcel = new PHPExcel();	 
        $objPHPExcel->setActiveSheetIndex(0);

   	
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Invoice No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Invoice Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Vendor Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Mineral Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Lot No');      
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Batch No');      
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Packing Size');       
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'No Of Bags');       
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Quantity In MT');       
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Price');    
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Total');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Grand Total');		
          
        // set Row
      
        $rowCount = 2;
        foreach ($reqSlipInfo as $element) {
        	
        	foreach ($element['invoice_details'] as $element2) {
        		$invoice_code=$element['invoice_no'];
                //if($voucher_no<10){
				// $invoice_code='CNC/A/000'.$voucher_no;
				// }
				// else if(($voucher_no>=10) && ($voucher_no<=99)){
				//   $invoice_code='CNC/A/00'.$voucher_no;
				// }
				// else if(($voucher_no>=100) && ($voucher_no<=999)){
				//   $invoice_code='CNC/A/0'.$voucher_no;
				// }
				// else{
				//   $invoice_code='CNC/A/'.$voucher_no;
				// }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $invoice_code);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['transaction_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['vendor_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element2['mineral_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element2['lot_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element2['batch_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element2['packing_size']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element2['no_of_bags']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element2['quantity']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element2['rate']);	
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element2['amount']);	
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element['total_amount']);	
            $rowCount++;
        	}
        }
        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
       $objWriter= PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="invoiceData.xls"');
        $objWriter->save('php://output');
       	//$objWriter->save($fileName);

		
		// download file

		
       	redirect('/Invoice/report', 'refresh');     
    }
    public function CheckInvoiceNo()
   {
        $invoice_no=$this->input->post('invoice_no');
        $invoice_no1=str_replace('%2F','/', $invoice_no);
        //echo $invoice_no1;exit;
        $isExist = $this->Invoice_model->CheckInvoiceNo($invoice_no1);
         if(!empty($isExist)){
            echo json_encode($isExist); 
        }
     
   }  
}

?>