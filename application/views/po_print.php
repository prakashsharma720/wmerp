<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
        <span class="card-title"><?php  echo $title; ?>
        </span>
          <div class="pull-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
          </div>
      </div> <!-- /.card-body -->
      <div class="card-body">
			  <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <img src="<?= base_url()?>/uploads/logo.png" height="120" width="300"/>
                </div>
               <div class="col-sm-4 invoice-col">
                <!--<h6 style="padding-top: 20px;"> STANDARD OPERATING PROCEDURE </h6>-->
                <h4 style="padding-top: 20px;"> PURCHASE ORDER</h4>
                </div>
                <div class="col-sm-4 invoice-col">
                <strong><u>Company Details:</u></strong><br>
                  <b>GSTIN : </b>08AABFC2155P1ZA<br>
                  <b>PAN : </b> AABFC2155P<br>
                  <!-- <b>State : </b> Rajasthan <b>State Code :</b> 08<br> -->
                  <b> Address : </b> B-133, Mewar Industrial Area (MIA), Madri, Transport Nagar, Udaipur, Rajasthan 313003.
                </div>
              </div>
              <br>
              <!-- Table row -->
                <div class="row">
                    <div class="col-12">
                      <table class="table">
                        <tbody>
                           <!--<tr>
                            <th colspan="6"> <h4 style="text-align: center">PURCHASE ORDER</h4></th>
                          </tr>-->
                          <tr>
                            <th rowspan="3" > To:  </th>
                            <td rowspan="3" colspan="2"> <?= $current['0']['supplier']?>,<br> <?= $current['0']['address']?> </td>
                            <th colspan="2"> PO Number : </th>
                            <td colspan="2"> 
                                  <?php 
                                  $inv_number=$current['0']['po_number'];
                                  if($inv_number<10){
                                  $inv_number1='CNC/A/000'.$inv_number;
                                  }
                                  else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='CNC/A/00'.$inv_number;
                                  }
                                  else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='CNC/A/0'.$inv_number;
                                  }
                                  else{
                                    $inv_number1='CNC/A/'.$inv_number;
                                  }
                                  echo $inv_number1; ?>
                                </td>
						              </tr>
                       	  <tr>
                            <th colspan="2">Dated :  </th>
                            <td> <?= $current['0']['transaction_date']?> </td>
              						</tr>
                           <tr>
                             <th colspan="2">Vendor Code : </th>
                            <td> 
                                <?php 
                                    $inv_number=$current['0']['vendor_code'];
                                    if($inv_number<10){
                                      $inv_number1='SUP000'.$inv_number;
                                      }
                                      else if(($inv_number>=10) && ($inv_number<=99)){
                                        $inv_number1='SUP00'.$inv_number;
                                      }
                                      else if(($inv_number>=100) && ($inv_number<=999)){
                                        $inv_number1='SUP0'.$inv_number;
                                      }
                                      else{
                                        $inv_number1='SUP'.$inv_number;
                                      }
                                      echo $inv_number1; 
                                  ?>     
                           </td>
                          </tr>
                          <tr>
                            <th> Contact Person : </th>
                            <td colspan="6"> <?= $current['0']['prefix'].' '.$current['0']['c_person']?>  </td>
                          </tr>
                           <tr>
                            <th> Contact No : </th>
                            <td colspan="6"> <?= $current['0']['mobile_no']?> </td>
                          </tr>
                          <tr>
                            <th> Email Id : </th>
                            <td colspan="6"> <?= $current['0']['email']?> </td>
                          </tr>
                           <tr>
                            <th> Reference: </th>
                            <td colspan="6"> <?= $current['0']['reference_by']?> </td>
                          </tr>
                           <tr>
                           <td colspan="6">
                             Please supply following items as per our Telecom/ Previous Supply/ Your Ref. At the earliest:
                           </td>
                         </tr>
                  		  <tr>
                         
            						  <th> S.No.</th>
            						  <th colspan="2"><label> Material Description </label></th>
                          <!--<th>Requisition Quantity</th>-->
            						  <th><label> Quantity</label></th>
              						<th>Item Price</th>
              						<th>Total Amount</th>
						            </tr>
                  <?php $i=1;foreach($current['0']['po_details'] as $po_details) { ?>
	                    <tr>
						
	                      <td colspan="1"><?= $i ?></td>
	                      <td colspan="2"><?= $po_details['item'].' ('.$po_details['code'].')' ?> </td>
            							<td>
            								<?=$po_details['quantity'].' '.$po_details['unit'] ?>
            							</td>
            							<td>
            								<?=$po_details['rate']
            								 ?> &#8377;
            							</td>
            							<td>
            								<?=$po_details['amount'] ?> &#8377;
            							</td>
	                    </tr>
	                <?php $i++;} ?>
							<tr>
			        		<td colspan="3" style="text-align: right;"><b>Total</b></td>
					             <td> <?= $current['0']['total_qty']?></td>
								  
								   <td> <?= $current['0']['total_amount']?> &#8377;</td>
							</tr>
            <tr>
                <td colspan="3" style="text-align: right;"><b> Less Discount</b></td>
                   <?php if($current['0']['discount_amount']!='0.00'){ ?>
                      <td>-</td>
                      <td>-</td>
                      <td> <?= $current['0']['discount_amount']?> &#8377;</td>
                 <?php  } else { ?>
                      <td>-</td>
                      <td>-</td>
                      <td>-</td>
                 <?php } ?>
              </tr>
					         <tr>
			        			<td colspan="3" style="text-align: right;"><b>GST</b></td>
					             <td> <?= $current['0']['gst_per']?> % </td>
								  <td> <?= $current['0']['gst_amount']?> &#8377;</td>
								   <td> <?= $current['0']['grand_total']?> &#8377;</td>
							</tr>
							  <tr>
              <th> Amount In Words</th>
              <td colspan="3"> <?php echo $amount_in_words; ?></td>
              <th>Grand Total</th>
              <td> <?= round($current['0']['grand_total'])?> &#8377;</td>
              </tr>
			        		</tbody>
							</table>
               <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                  <b> Terms and Conditions : </b>
                   <ul>
                     <li> Payment Terms</li>
                     <li> Delivery Schedule</li>
                     <li> Billing Should be raised in the name of M/S CHOUDHARY & COMPANY.</li>
                     <li> Please Indicate PO Number on the Challan & Invoice.</li>
                   </ul>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b> Prepared By :</b>
                  <br></br>
                  <br></br>
                  <b> Purchase Dept.</b>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b> Checked By :</b>
                  <br></br>
                  <br></br>
                  <b> Accounts Dept.</b>
                </div>
                <div class="col-sm-4 invoice-col">
                  <b> Approved By :</b>
                  <br></br>
                  <br></br>
                  <b>  Director </b>
                </div>
              </div>
                <!-- /.col -->
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
