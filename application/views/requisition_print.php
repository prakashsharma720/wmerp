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
          <div class="button-group float-right no-print">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> Print</button>
          </div>
      </div> <!-- /.card-body -->
      <div class="card-body" >
              <!-- title row -->
              <div class="row " >
                <div class="col-sm-4 " >
                  <img src="<?= base_url()?>/uploads/logo.png" height="120" width="300"/>
                </div>
               <div class="col-sm-4" >
                <h4 style="padding-top: 20px;"> Choudhary & Company </h4>
                </div>
                <div class="col-sm-4" >
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
                           <tr>
                            <th colspan="6"> <h4 style="text-align: center">Material Requisition Slip </h4></th>
                          </tr>
                          <tr>
                            <th> Requisition No </th>
                            <td> 
                              <?php 
                                  $inv_number=$current['0']['requisition_slip_no'];
                                  if($inv_number<10){
                                  $inv_number1='RS000'.$inv_number;
                                  }
                                  else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='RS00'.$inv_number;
                                  }
                                  else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='RS0'.$inv_number;
                                  }
                                  else{
                                    $inv_number1='RS'.$inv_number;
                                  } 
                              ?>
                              <?= $inv_number1?>  </td>
                               <th>Date </th>
                            <td> <?= $current['0']['transaction_date']?> </td>
                          </tr>
                              <tr>
                                <th > Requisition For: </th>
                                <td > <?= $current['0']['rs_for']?> </td>
                                <th>Department </th>
                                <td> <?= $current['0']['dept']?> </td>
                              </tr>
                            <?php if($current['0']['rs_for']!='Consumable & Chemicals'){?>
                               <tr>
                                <th>Product</th>
                                <td> <?= $current['0']['mineral']?> </td>
                                <th> Grade </th>
                                <td> <?= $current['0']['grade']?> </td>
                              </tr>
                              <tr>
                                <th>Lot Number </th>
                                <td><?= $current['0']['lot_no']?> </td>
                                <th>Batch Number</th>
                                <td><?= $current['0']['batch_no']?> </td>
                              </tr>
          							<?php }else{ ?>
                            <tr>
                               <th>Equipment Name</th>
                               <td> <?= $current['0']['equipment_name']?> </td>
                               <th> Purpose </th>
                               <td><?= $current['0']['purpose']?> </td>
                            </tr>
                        <?php } ?>
                          <tr>
                               <th> Total Qty</th>
                               <td><?= $current['0']['total_qty']?> </td>
                               <th>Employee Name</th>
                               <td> <?= $current['0']['ename']?> </td>
                            </tr>
                       </tbody>
                </table>
              </div>
            </div>
              <div class="row col-md-12 ">
                <div class="table-responsive">
                  <table class="table table-bordered " id="maintable" >
                    <thead style="background-color: #e8e8e8;">
                    <tr>
                    <th> S.No.</th>
                    <th> Material Description</th>
                    <!--<th>Requisition Quantity</th>-->
                    <th>Unit</th>
                    <th>Required Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                   <?php $i=1;foreach($current['0']['requisition_details'] as $requisition_details) { ?>
                  <tr>
                      <td><?= $i ?></td>
                      <td><?= $requisition_details['item']?> </td>
                      <td>
                      <?=$requisition_details['unit'] ?>
                      </td>
                      <td>
                      <?=$requisition_details['quantity'] ?>
                      </td>
                    </tr>
                      <?php $i++;} ?>
                    <tr>
                        <td colspan="3" style="text-align: right;"><b>Total</b></td>
                        <td> <?= $current['0']['total_qty']?></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2">
                        <?= $current['0']['ename']?> 
                         <br></br><br></br>
                         <b> User (Name & Sign)</b>
                      </td>
                      <td colspan="2">
                       <br></br><br></br>
                       <b> Store Incharge (Name & Sign)</b>
                      </td>

                    </tr>
                     <tr>
                      <td colspan="2">
                        Request to Indent for purchase
                         <br></br><br></br>
                         <b> Store Dept. (Sign & Date)</b>
                      </td>
                      <td colspan="">
                       
                       <br></br><br></br>
                       <b> Purchase Dept. (Sign & Date)</b>
                      </td>
                      <td colspan="">
                       
                       <br></br><br></br>
                       <b> Authorized By (Sign & Date)</b>
                      </td>
                    </tr>
                  </tfoot>
            </table>
          </div>
        </div><!-- /.col -->
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
