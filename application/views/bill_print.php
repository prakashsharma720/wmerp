<?php
defined('BASEPATH') OR exit('No direct script access allowed');
print_r($data);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
setlocale(LC_MONETARY, 'en_IN');
//$amount = number_format($obj['grand_total'],2);
//echo $amount; 

?>
<style type="text/css">
	th,td{
		padding: 2px;
    border:1px solid #000;
	}
  hr{
    margin-top:2px !important;
    margin-bottom:2px !important;
  }
  thead {display: table-header-group;}
  tfoot {display: table-header-group;}
</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
          <div class="pull-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
          </div>
      </div> <!-- /.card-body -->
      <div class="card-body">
			  <div class="">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <b>  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/> (ORIGINAL FOR BUYER)</b>
                 <b>  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/> (EXTRA COPY FOR BUYER)</b><br>
                 <b>  <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/> (DUPLICATE FOR TRANSPORTER</b>
                 <b> <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/>  (TRIPLICATE FOR CONSIGNOR)</b>
                <!--  <b> <img src="<?= base_url()?>/uploads/square_box.png" height="25" width="25"/>  (EXTRA COPY-CONSIGNOR)</b>-->
                </div>
                <!-- /.col -->
              </div>

              <div class="row">
                <div class="col-12">
                   <h3 style="text-align:center;margin-top: 5px;"><u><?= $title?></u></h3>

                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-6 invoice-col">
                  <strong><u>Consignor Details:</u></strong><br>
                  <b>GSTIN : 08AABFC2155P1ZA </b><br>
                  <b>PAN : </b> AABFC2155P<br>
                  <b>State : </b> Rajasthan <b>State Code :</b> 08<br>
                  <b> INVOICE No : <?= $invoice_no?> </b> <stong class="float-right"> <b>Date: <?= date('d-m-Y',strtotime($invoice_data['0']['transaction_date'])) ?></b>
                </div>
               <div class="col-sm-8 invoice-col">
                </div>
              
              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" style="width: 100%;margin-bottom: 0px;">
                    <thead>
                    <tr>
                      <th style="width:1%;border:1px solid #000;">SI.NO.</th>
                      <th style="width:44%;border:1px solid #000;">DESCRIPTION</th>
                      <th style="width:10%;border:1px solid #000;white-space: nowrap;">HSN CODE</th>
                      <th style="width:10%;border:1px solid #000;white-space: nowrap;">No. of Bags</th>
                      <th style="width:8%;border:1px solid #000;">QTY(MT)</th>
                      <th style="width:10%;border:1px solid #000;">RATE/MT</th>
                      <th style="width:16%;border:1px solid #000;text-align: right;">AMOUNT</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1;foreach($invoice_data['0']['invoice_details'] as $invoice_details) { ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td>
                          <b> <?= $invoice_details['mineral_name']?></b><br>
                           Grade: <?= $invoice_details['grade_name']?> <br>
                          Lot no: <?= $invoice_details['lot_no']?> &nbsp;&nbsp;
                          Batch No : <?= $invoice_details['batch_no']?><br>
              <?php if(!empty($invoice_details['production_month'])){ ?>
              Production: <?= $invoice_details['production_month']?>                
              <?php }?>
                        </td>
                        <td><?= $invoice_details['hsn_code']?></td>
                        <td><?= $invoice_details['no_of_bags']?></td>
                        <td><?= $invoice_details['quantity']?></td>
                        <td><?php echo number_format($invoice_details['rate'],2);?></td>
                        <td style="text-align:right;">
                          <?php echo number_format($invoice_details['amount'],2);?>
                          </td>
                      </tr>
                  <?php $i++;} ?>
                   </tbody>
                   <tfoot>
                      <tr>
                       <!--  <td colspan="2">
                        <b> Remarks : </b><?= $invoice_data['0']['remarks'] ?>
                        </td> -->
                        <td colspan="4">
                        <b> Way Bill No :</b> <?= $invoice_data['0']['way_billno'] ?>
                        </td>
                        <td colspan="2"><b>Taxable Value </b> </td>
                        <td style="text-align:right;"> <?php echo number_format($invoice_data['0']['total_amount'],2);?></td>
                      </tr>
                    <?php  if($invoice_data['0']['type_of_tax']=='Other') { ?>
                      <tr>
                        <td colspan="4">
                        </td>
                        <td colspan="2">
                         <b>Add Tax </b><span style="font-weight: 400">(CGST  <?= $invoice_data['0']['tax_per_cgst']?> %) </span></td>
                        <td colspan="2" style="text-align:right;">
                        <?php echo number_format($invoice_data['0']['cgst_amount'],2);?>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="4">
                          
                        </td>
                        <td colspan="2">
                        <b> Add Tax</b> <span style="font-weight: 400">(SGST  <?= $invoice_data['0']['tax_per_sgst']?> %) </span></td>
                        <td colspan="2" style="text-align:right;"> 
                          <?php echo number_format($invoice_data['0']['sgst_amount'],2);?>                
                        </td>
                      </tr>
                       <tr>
                          <td colspan="4">
                          <b> Laboratory Test Report No: </b> <?= $invoice_data['0']['test_report_no'] ?> &nbsp;
                          <b> Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['testing_date'])) ?>&nbsp;
                         
                        </td>
                         <td colspan="2"><b>Total Tax</b></td>
                        <td colspan="2" style="text-align:right;">
                          <?php 
                            $total_tax=$invoice_data['0']['cgst_amount']+$invoice_data['0']['sgst_amount'];
                            echo number_format($total_tax,2);?>
                        </td>
                      </tr> 
                    <?php } else { ?>
                       <tr>
                        <td colspan="4">
                         </td>
                        <td colspan="2">
                         <b>Add Tax </b><span style="font-weight: 400">(IGST <?= $invoice_data['0']['tax_per_igst']?>%) </span></td>
                        <td colspan="2" style="text-align:right;">
                        <?php echo number_format($invoice_data['0']['igst_amount'],2);?>
                        </td>
                      </tr>
                       <tr>
                        <td colspan="4">
                          <b> Laboratory Test Report No: </b> <?= $invoice_data['0']['test_report_no'] ?> &nbsp;
                          <b> Date : </b> <?= date('d-m-Y',strtotime($invoice_data['0']['testing_date'])) ?>&nbsp; &nbsp;  <b>Report : </b><?= $invoice_data['0']['report_sending_status'] ?>
                        </td>
                        <td colspan="2">
                          <b>Total Tax</b>
                        </td>
                        <td colspan="2" style="text-align:right;">
                          <?php echo number_format($invoice_data['0']['igst_amount'],2);?>
                        </td>
                      </tr>
                    <?php } ?>
                      <tr>
                        <td colspan="4">
                           <b> Amount in words : <span style="text-transform: capitalize;"> Rupees <?= $amount_in_words?> Only </span></b>
                          </td>
                         <td colspan="2"><b> GRAND TOTAL</b></td>
                        <td colspan="2" style="text-align:right;">
                          <b><?php echo number_format(round($invoice_data['0']['grand_total']),2);?></b>
                        </td>
                      </tr>
                    <!--   <tr>
                        <td colspan="7">
                        <b> Amount in words : <span style="text-transform: capitalize;"> Rupees <?= $amount_in_words?> Only </span></b></td>
                      </tr> -->
                     
                   </tfoot>
                  </table>
                  <table class="table" style="width: 100%;">
                    <tbody>
                       <tr>
                        <td colspan="2" style="padding-bottom: 40px;border-top: none;"> <b> <u>Prepared By : </u></b></td>
                        <td colspan="2" style="border-top: none;"> <b> <u>Checked By : </u></b></td>
                        <td colspan="4" style="border-top: none;"> 
                          <!-- <img src="<?= base_url()?>/uploads/sign.png" width="200px" height="50px;"/><br> -->
                          <b><u>Approved By: </u></b>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                   <b> Please refer backside of this invoice for Terms & Conditions.</b> 
                </div>
                <!-- /.col -->
              </div>
            </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    moneyFormat(x){
      //var x=3300000.00;
      x=x.toString();
      var lastThree = x.substring(x.length-3);
      var otherNumbers = x.substring(0,x.length-3);
      if(otherNumbers != '')
          lastThree = ',' + lastThree;
      var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
     // alert(res);
    }
    
  });
</script>
