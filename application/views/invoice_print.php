<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
setlocale(LC_MONETARY, 'en_IN');
//$amount = number_format($obj['grand_total'],2);
//echo $amount; 

?>
<style type="text/css">
.card {
    font-family: Arial, sans-serif;
}

th {
    white-space: nowrap;
}

th,
td {
    padding: 2px;
    border: 1px solid #000;
    font-size: 16px;
}

.table td,
.table th {
    padding: 2px;
}

hr {
    margin-top: 2px !important;
    margin-bottom: 2px !important;
}

thead {
    display: table-header-group;
}

tfoot {
    display: table-header-group;
}

@media print {
    .type {
        display: none;
    }
}
</style>
<div class="container-fluid">
    <div class="row type">
        <div class="col-10">
            <input type="checkbox" class="checkbox" data-label="ORIGINAL FOR BUYER"><b> (ORIGINAL FOR BUYER)</b>
            <input type="checkbox" class="checkbox" data-label="EXTRA COPY FOR BUYER"><b> (EXTRA COPY FOR BUYER)</b><br>
            <input type="checkbox" class="checkbox" data-label="DUPLICATE FOR TRANSPORTER"><b> (DUPLICATE FOR
                TRANSPORTER)</b>
            <input type="checkbox" class="checkbox" data-label="TRIPLICATE FOR CONSIGNOR"><b> (TRIPLICATE FOR
                CONSIGNOR)</b>
            <input type="checkbox" class="checkbox" data-label="EXTRA FOR CONSIGNOR"><b> (EXTRA FOR CONSIGNOR)</b>
        </div>
        <div class="col-2">
            <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
        </div>
    </div>
    <!-- /.col -->
</div>
<div class="card">
    <div class="card-body" style="margin-top:60px;">
        <!-- title row -->
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col" style="text-align:left !important;margin-top:0px;">
                <!-- <p>e-invoice</p> -->
                <div style="width:100% !important; text-align:left !important;margin-top:-30px;">
                    <div class="selected-checkboxes"></div>

                    <?php if (!empty($invoice_data['0']['qrCodeImage'])): ?>
                    <img src="<?php echo base_url($invoice_data['0']['qrCodeImage']); ?>" alt="QR Code"
                        style="width:54%;" />
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-4 invoice-col ">
                <!-- <strong><u>Consignor Details:</u></strong><br> -->
                <b>GSTIN </b>: 08AABFC2155P1ZA <br>
                <b>PAN</b> : AABFC2155P<br>
                <h3 style="margin-top: 10px;margin-bottom: 10px;"><u><?= $title?></u></h3>
                <h5> INVOICE No : <b><?= $invoice_no?> &nbsp;&nbsp; <br>Date:
                        <?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?> </b></h5>
                <!-- <p>Date:<?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?></p> -->
            </div>
            <div class="col-sm-4 invoice-col" style="padding-top:45px;">
                <b>ACK No. : </b><?= $invoice_data['0']['ack_no']?><br>
                <b>ACK Date. :
                </b><?php  if($invoice_data['0']['ack_date']) echo date('d-m-Y',strtotime($invoice_data['0']['ack_date']))?><br>
                <b style="white-space:nowrap;">IRN : </b><?= $invoice_data['0']['irn']?><br>
                <b> E-Way Bill No :</b> <?= $invoice_data['0']['ewbno'] ?>
            </div>
        </div>
        <!-- /.row -->
        <table style="width:100%;margin-top:5px;">
            <tr>
                <td style="width:45%;border-bottom: #fff;padding: 5px;">
                    <b>Shipping Address / Consignee:</b><br>
                    <!-- <b>Name </b>:   -->
                    <?php if($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){ ?>
                    <?= $invoice_data['0']['customer_details']['shipping_legal_name']?> <br>
                    <!-- <b>Address </b>:   -->
                    <?= $invoice_data['0']['customer_details']['saddress1'].','.$invoice_data['0']['customer_details']['saddress2'].','.$invoice_data['0']['customer_details']['loc'].'-'.$invoice_data['0']['customer_details']['ship_pincode'].','.$invoice_data['0']['customer_details']['state_name']?><br>
                    <b>GSTIN : <?php
                            if($invoice_data['0']['customer_details']['shipping_gst_status'] == 'Yes')
                            {
                             echo $invoice_data['0']['customer_details']['shipping_gst_no'];
                            }
                            else{
                                echo 'NA';
                            }?>
                    </b>
                    <b>State Code : </b>
                    <?php if(!empty($invoice_data['0']['customer_details']['ship_state_code'])){
                             echo  $invoice_data['0']['customer_details']['ship_state_code'];} ?>
                    <?php }else{ ?>
                    <?= $invoice_data['0']['customer_details']['customer_name']?> <br>
                    <!-- <b>Address </b>:   -->
                    <?= $invoice_data['0']['customer_details']['shipping_address'].', '.$invoice_data['0']['customer_details']['billing_address'].','.$invoice_data['0']['customer_details']['destination'].'-'.$invoice_data['0']['customer_details']['billing_pincode'].','.$invoice_data['0']['customer_details']['state_name']?><br>
                    <b>GSTIN : <?= $invoice_data['0']['customer_details']['gst_no']?></b>
                    <b>State Code : </b>
                    <?php if(!empty($invoice_data['0']['customer_details']['state_code'])){
                             echo  $invoice_data['0']['customer_details']['state_code'];} ?>
                    <?php } ?>
                    <hr>
                    <hr>
                    <b>Billing Address / Buyer:</b> <br>
                    <!-- <b>Name </b>:  -->
                    <?= $invoice_data['0']['customer_details']['customer_name']?><br>
                    <!-- <b>Address </b>:  -->
                    <?= $invoice_data['0']['customer_details']['shipping_address'].', '.$invoice_data['0']['customer_details']['billing_address'].','.$invoice_data['0']['customer_details']['destination'].'-'.$invoice_data['0']['customer_details']['billing_pincode'].','.$invoice_data['0']['customer_details']['state_name']?><br>
                    <b>GSTIN : <?= $invoice_data['0']['customer_details']['gst_no']?></b>
                    <br>
                    <b>Buyer's PAN :</b> <?= $invoice_data['0']['customer_details']['pan_no']?>
                </td>
                <td style="width:55%;border-bottom: #fff;padding: 5px;">
                    <b>Document Through : </b> &nbsp;&nbsp;&nbsp; <b>Freight : </b>
                    <?= $invoice_data['0']['frieght_status']?>
                    <!--   <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"> To Pay 
                            <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"> Paid  --><br>
                    <b> Transporter : </b> <?= $invoice_data['0']['transporter_name']?><br>
                    <b> G.R. No:</b> <?= $invoice_data['0']['gr_no']?>
                    <b>Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?> &nbsp;
                    &nbsp;
                    <b>Truck No : </b> <?= $invoice_data['0']['truck_no']?><br>
					<?php if($invoice_data['0']['customer_details']['isshipping'] == 'Yes'){ ?>
                    <b>Destination : </b> <?= $invoice_data['0']['customer_details']['loc']?><br>
					 <?php }else if($invoice_data['0']['customer_details']['isshipping'] == 'No') {?>
					<b>Destination : </b> <?= $invoice_data['0']['customer_details']['destination']?><br>
					<?php }; ?>
                    <hr>
                    <b>Vendor Code No : </b><?= $invoice_data['0']['customer_details']['vendor_code']?>
                    <hr>
                    <b>Your Order No :</b> <?= $invoice_data['0']['po_no']?><br>
                    <b> Date : </b> <?= $invoice_data['0']['po_date'] ?>
                    <hr>
                    <b>Buyer Item Code No :</b> <?= $invoice_data['0']['buyer_item_code']?>
                    <hr>
                    <medium>Packing in new PP Woven bags of 50/25 kgs,capacity each
                        Weight of empty bag <100 gms Laminated/Non-laminated /Liner. </medium>
                </td>
            </tr>
        </table>

        <!-- Table row -->
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped" style="width: 100%;margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th
                                style="width:10px;border:1px solid #000;padding:0px;margin:0px;text-align:center;vertical-align: middle;">
                                S.<br>No.</th>
                            <th colspan="2" style="width:40%;border:1px solid #000;text-align:center;">Description</th>
                            <!-- <th style="width:6%;border:1px spx;olid #000;">HSN Code</th> -->
                            <?php if($invoice_data['0']['frieght_status'] =='Paid'){?>
                            <th style="width:10%;border:1px solid #000;">Delivered Rate in Rs/PMT</th>
                            <?php }else { ?>
                            <th style="width:10%;border:1px solid #000;">Ex. Our Work Rate in Rs/PMT</th>
                            <?php } ?>

                            <th style="width:10%;border:1px solid #000;">Quantity in MT</th>
                            <th style="width:5%;border:1px solid #000;">No. of Bags</th>
                            <th style="width:10%;border:1px solid #000">Taxable Value in Rs.</th>
                            <?php if($invoice_data['0']['invoice_details']['0']['tax_type'] =='IGST') {?>
                            <th style="width:10%;border:1px solid #000;">IGST@5%</th>
                            <th style="width:10%;border:1px solid #000;">IGST@18%</th>
                            <?php }else{ ?>
                            <th style="width:10%;border:1px solid #000;">
                                CGST@2.5% <br>SGST@2.5%</th>
                            <th style="width:10%;border:1px solid #000;"> CGST@9% <br>SGST@9%</th>
                            <?php } ?>
                            <th style="width:10%;border:1px solid #000;">Amount <br>(In Rupees)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                                $total_bags = 0;
                                $total_qty = 0.000;
                                $cgstTotal = 0;
                                $sgstTotal = 0;
                                $cgstTotalTax = 0;
                                $sgstTotalTax = 0;
                                $i = 1;
                                $previous_mineral_name = '';
                                $previous_grade_name = '';
                                foreach($invoice_data['0']['invoice_details'] as $invoice_details) { 
                                    if ($invoice_details['tax_type'] == 'Other') {
                                        // Calculate total tax amount for tax_type other than 'total_tax'
                                        $totalTaxper = $invoice_details['tax_per'];
                                        $totalTaxperamount = $invoice_details['tax_amount'];
                                        
                                        // Divide total tax amount into CGST and SGST
                                        $cgstTotal = $totalTaxper / 2;
                                        $sgstTotal = $totalTaxper / 2;
                                        $cgstTotalTax = $totalTaxperamount / 2;
                                        $sgstTotalTax = $totalTaxperamount / 2;
                                    }
                                    else if($invoice_details['tax_type'] == 'IGST'){
                                        $totalTaxper = $invoice_details['tax_per'];
                                        $totalTaxperamount = $invoice_details['tax_amount'];
                                    }
                                    $total_bags += $invoice_details['no_of_bags'];
                                    $total_qty += $invoice_details['quantity'];
                                ?>

                        <tr>
                            <td style="width:10px;padding:0px;margin:0px;text-align:center;vertical-align: middle;">
                                <b><?= $i;?></b></td>
                            <td colspan="2" style="padding: 3px;">
                                <?php 
                                        if ($invoice_details['mineral_name'] != $previous_mineral_name || $invoice_details['grade_name'] != $previous_grade_name || $invoice_details['hsn_code'] != $previous_hsn_code) { 
                                            echo '<b>' . $invoice_details['mineral_name'] . '</b><br>';
                                            echo '<b>HSN Code: ' . $invoice_details['hsn_code'] . '</b><br>';
                                            echo '<b>Grade: ' . $invoice_details['grade_name'] . '</b><br>';
                                            $previous_mineral_name = $invoice_details['mineral_name'];
                                            $previous_grade_name = $invoice_details['grade_name'];
                                            $previous_hsn_code = $invoice_details['hsn_code'];
                                        } 
                                        ?>
                                Lot No: <?= $invoice_details['lot_no']?> &nbsp;&nbsp;
                                Batch No : <?= $invoice_details['batch_no']?><br>
                                <?php if(!empty($invoice_details['production_month'])){ ?>
                                Production: <?= $invoice_details['production_month'].'<br>'?>
                                <?php }?>
                            </td>
                            <td><?php echo number_format($invoice_details['rate'],2);?></td>
                            <td><?= $invoice_details['quantity']?></td>
                            <td><?= $invoice_details['no_of_bags']?></td>
                            <td><?php echo number_format($invoice_details['taxable_amount'],2);?></td>
                            <td style="white-space:nowrap;">
                                <?php 
                                        $total_tax = 0;
                                        if($totalTaxper == 5){
                                            if($invoice_details['tax_type'] == 'Other'){
                                                echo $cgstTotalTax;
                                                echo "</br>";
                                                echo $sgstTotalTax;
                                            }
                                            else if($invoice_details['tax_type'] == 'IGST'){
                                                echo $totalTaxperamount;
                                            }
                                        }else{
                                            echo '----';
                                        }
                                        ?>
                            </td>
                            <td style="white-space:nowrap;">
                                <?php 
                                        $total_tax = 0;
                                        if($totalTaxper == 18){
                                            if($invoice_details['tax_type'] == 'Other'){
                                                echo $cgstTotalTax;
                                                echo "</br>";
                                                echo $sgstTotalTax;
                                            }
                                            else if($invoice_details['tax_type'] == 'IGST'){
                                                echo $totalTaxperamount;
                                            }
                                        }else{
                                            echo '----';
                                        }
                                        ?>
                            </td>
                            <td><?= $invoice_details['amount']?></td>
                        </tr>

                        <?php $i++; } ?>

                    </tbody>
                    <tfoot>
                        <?php if($invoice_data['0']['frieght_status'] =='Paid' && $invoice_data['0']['delivr_rate'] !='0.00') {?>
                        <tr>
                            <td><?= $i;?></td>
                            <td colspan="2">
                                <b>Transportation</b><br>
                                <b>HSN Code : 996791</b><br>
                            </td>
                            <!-- <td>
                                        <?= $invoice_data['0']['hsncode']?>
                                    </td> -->
                            <td>
                                <?= $invoice_data['0']['delivr_rate']?>
                            </td>
                            <td>
                                <?= $invoice_data['0']['total_quantity']?>
                            </td>
                            <td>
                                <?= $invoice_data['0']['total_bags']?>
                            </td>
                            <td>
                                <?= $invoice_data['0']['total_deliver_amt']?>
                            </td>
                            <td>
                                <?php if($invoice_data['0']['delivr_tax_per'] =='5') { 
                                            if($invoice_data['0']['invoice_details']['0']['tax_type']=='Other'){
                                        $cgstdelivertaxper=$invoice_data['0']['delivr_tax_per']/2;
                                        $sgstdelivertaxper=$invoice_data['0']['delivr_tax_per']/2;
                                        $cgstamt1=$invoice_data['0']['total_delivr_tax_per']/2;
                                        $sgstamt1=$invoice_data['0']['total_delivr_tax_per']/2;
                                        $sgstamt= sprintf("%.2f", floor($sgstamt1 * 100) / 100);
                                        $cgstamt= sprintf("%.2f", floor($cgstamt1 * 100) / 100);
                                        echo $cgstamt;
                                        echo "</br>";
                                        echo $sgstamt;
                                    }
                                    else if($invoice_data['0']['invoice_details']['0']['tax_type']=='IGST'){
                                    echo $invoice_data['0']['total_delivr_tax_per']; }?>

                                <?php } else { 
                                            echo '----';
                                        }
                                        ?>
                            </td>
                            <td>
                                <?php if($invoice_data['0']['delivr_tax_per'] =='18') { 
                                            if($invoice_data['0']['invoice_details']['0']['tax_type']=='Other'){
                                            $cgstdelivertaxper=$invoice_data['0']['delivr_tax_per']/2;
                                            $sgstdelivertaxper=$invoice_data['0']['delivr_tax_per']/2;
                                            $cgstamt1=$invoice_data['0']['total_delivr_tax_per']/2;
                                            $sgstamt1=$invoice_data['0']['total_delivr_tax_per']/2;
                                            $sgstamt= sprintf("%.2f", floor($sgstamt1 * 100) / 100);
                                            $cgstamt= sprintf("%.2f", floor($cgstamt1 * 100) / 100);
                                            echo $cgstamt;
                                            echo "</br>";
                                            echo $sgstamt;
                                        }
                                        else if($invoice_data['0']['invoice_details']['0']['tax_type']=='IGST'){
                                        echo $invoice_data['0']['total_delivr_tax_per']; }?>

                                <?php } else { 
                                                echo '----';
                                            }
                                        ?>
                            </td>
                            <td><?= $invoice_data['0']['total_taxable_value'] ?></td>
                        </tr>
                        <?php }?>
                        <?php  if($invoice_data['0']['invoice_details']['0']['tax_per'] =='0') {?>
                        <tr>
                            <td colspan="6"><b> <?php echo $invoice_data['0']['remarks']?> </b></td>
                            <td colspan="2"> <b> Add Tax : </b>IGST@ 0.0% <br><b> (Supply to SEZ Unit Under LUT) </b>
                            </td>
                            <td colspan="2">0.00</td>
                        </tr>
                        <?php }else if(!empty($invoice_data['0']['remarks'])){ ?>
                        <tr>
                            <td colspan="10">
                                <label>Remarks : &nbsp;</label><?php echo $invoice_data['0']['remarks'] ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="3" style="text-align:left;font-size:13px;padding:3px;"><b>MSME Udyam Reg. No:
                                    UDYAM-RJ-33-0000673 </b></td>
                            <td style="text-align:right;"><b> Total </b></td>
                            <td style="text-align:left;"><b><?= $invoice_data['0']['total_quantity']?></b></td>
                            <td style="text-align:left;"><b><?= $invoice_data['0']['total_bags']?></b></td>
                            <td style="text-align: left;"> <b>
                                    <?php echo number_format($invoice_data['0']['total_rate'],2);?>
                            </td>
                            <td colspan="2" style="text-align: center;"> <b>
                                    <?php echo number_format($invoice_data['0']['total_tax'],2);?> </b>
                            </td>
                            <td style="text-align: left;">
                                <b> <?= $invoice_data['0']['total_amount']?></b>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <b> Amount in words : <span style="text-transform: capitalize;"> Rupees
                                        <?= $amount_in_words?> Only </span></b>
                            </td>
                            <td colspan="2" style="text-align:right;">
                                <!-- <hr style="border-top:1px solid black;"> -->
                                <b> GRAND TOTAL (Rounded Off)</b>
                            </td>
                            <td colspan="2" style="text-align:right;">
                                <!-- <hr style="border-top:1px solid black;">-->
                                <b> <?php echo '&#x20B9; '.round($invoice_data['0']['grand_total']);?>
                                </b>
                            </td>
                        </tr>
                        <?php if(!empty($invoice_data['0']['test_report_no'])){?>
                        <tr>
                            <td colspan="10">
                                <b> Certificate of Analysis No: </b> <?= $invoice_data['0']['test_report_no'] ?>
                                &nbsp;
                                <b> Dated : </b>
                                <?= date('d-m-Y',strtotime($invoice_data['0']['testing_date'])) ?>&nbsp; &nbsp;
                                <b>Report : </b><?= $invoice_data['0']['report_sending_status'] ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <!--  <tr>
                                    <td colspan="7">
                                    <b> Amount in words : <span style="text-transform: capitalize;"> Rupees <?= $amount_in_words?> Only </span></b></td>
                                </tr> -->

                    </tfoot>
                </table>
                <table class="table" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td colspan="3"
                                style="width:33%;padding-bottom: 40px;border-top: none;padding-top:0px;padding-bottom:0px;">
                                <b> <u>Prepared By :</u></b></td>
                            <td colspan="3" style="width:26%;border-top: none;padding-top:0px;padding-bottom:0px;"> <b>
                                    <u>Checked By : </u></b></td>
                            <td colspan="3" style="width:40%;border-top: none;padding-top:0px;padding-bottom:0px;">
                                <!-- <img src="<?= base_url()?>/uploads/sign.png" width="200px" height="50px;"/><br> -->
                                <b><u> For CHOUDHARY & COMPANY </u></b><br><br>
                                <span>Authorised Signatory</span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="width:33%;padding-bottom: 0px;border-top: none;"> <b>
                                    <u>Declaration : </u></b><span style="font-size:13px;"> We declare that this invoice
                                    shows the actual price of the goods described and that all particulars are true and
                                    correct to the best of our knowledge.</li><br>
                                    <!-- <li><span style="font-size:13px;" > We are a SSI unit in MSME Act 2006 having Reg. No. <b>080261200256 </b> & udyam registration no <b>UDYAM-RJ-33-0000673.</b></span></li> -->
                                    <b>Please Turn Over For Terms & Conditions of Supply.</b>
                            </td>
                            <td colspan="4" style="width:33%;border-top: none;">
                                <br>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <!-- /.col -->
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    moneyFormat(x) {
        //var x=3300000.00;
        x = x.toString();
        var lastThree = x.substring(x.length - 3);
        var otherNumbers = x.substring(0, x.length - 3);
        if (otherNumbers != '')
            lastThree = ',' + lastThree;
        var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
        // alert(res);
    }
});
</script>
<script>
$(document).ready(function() {
    $('.checkbox').change(function() {
        var selectedCheckboxes = $('.checkbox:checked').map(function() {
            return '<img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25" /> <b>' +
                $(this).data('label') + '</b>';
        }).get();

        $('.selected-checkboxes').html(selectedCheckboxes.join('<br>'));
    });
});
</script>