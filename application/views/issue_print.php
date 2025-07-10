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
              <!-- title row -->
              <div class="row ">
                <div class="col-sm-4">
                  <img src="<?= base_url()?>/uploads/logo.png" height="120" width="300"/>
                </div>
               <div class="col-sm-4 ">
                <h4 style="padding-top: 20px;"> Choudhary & Company </h4>
                </div>
                <div class="col-sm-4 ">
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
                            <th colspan="6"> <h4 style="text-align: center">Issue Slip </h4></th>
                          </tr>
                          <tr>
            							<th colspan="1">Requisition Date :</th>
                          <td colspan="2"> <?= $current['0']['date']?> </td>		
            						  <th colspan="1">Issue Date :</th>
                          <td colspan="2"> <?= $current['0']['transaction_date']?> </td>
	       					<td colspan=""></td>
                          </tr>
                       	  <tr>
							               <th colspan="1"> Issue Slip No : </th>
                            <td colspan="2">
                              <?php 
                                  $inv_number=$current['0']['issue_slip_no'];
                                  if($inv_number<10){
                                    $inv_number1='IS000'.$inv_number;
                                  }
                                  else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='IS00'.$inv_number;
                                  }
                                  else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='IS0'.$inv_number;
                                  }
                                  else{
                                    $inv_number1='IS'.$inv_number;
                                  }
                                  echo $inv_number1; ?>     
                                </td>
                								<th colspan="1">Employee Name :</th>
                							  <td colspan="2"> <?= $current['0']['ename']?> </td>
                							</tr>
                							<tr>
                							 <th colspan="1">Department </th>
                                <td colspan="2"> <?= $current['0']['dept']?> </td>
                						    <th colspan="1"> Requisition Number : </th>
                                <td colspan="2"> 
                                  <?php 
                                  $inv_number=$current['0']['requisition_no'];
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
                                  echo $inv_number1; ?>    
                                </td>
                					      <th> </th>
                                <td></td>
                							</tr>

              <div class="row col-md-12 ">
                <div class="table-responsive">
                  <table class="table table-bordered " id="maintable" >
                    <thead style="background-color: #e8e8e8;">
                    <tr>
                      <th> S.No.</th>
                      <th> Material Description</th>
                      <th>Unit</th>
                      <th>Requisition Quantity</th>
                      <th>Issue Quantity</th>
                      <th>Pending Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i=1;foreach($current['0']['issue_details'] as $issue_details) { ?>
	                    <tr>
						
	                      <td><?= $i ?></td>
	                      <td><?= $issue_details['item']?> </td>
                        <td><?=$issue_details['unit'] ?></td>
	                      <td><?= $issue_details['req_qty']?> </td>
	                      <td><?= $issue_details['quantity']?> </td>
	                      <td><?= $issue_details['req_qty']-$issue_details['quantity']?> </td>
		                 </tr>
	                <?php $i++;} ?>
							<tr>
								<td colspan="3" style="text-align: right;"><b>Total</b></td>
					             <td> <?= $current['0']['total_req_qty']?></td>

					             <td> <?= $current['0']['total_issue_qty']?></td>
			        			
					             <td> <?= $current['0']['total_pending_qty']?></td>
								 
							</tr>
							</tbody>
							</table>
				       
                 <div class="row ">
                <div class="col-sm-4 ">
                  <b> Declaration : </b> We declare that this copy shows the actual information of this supplier and that all particulars are true and correct to the best of our knowledge.
                </div>
               <div class="col-sm-4 ">
               <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
                </div>
                <div class="col-sm-4 ">
                <strong><u>For Choudhary & Company :</u></strong>
                <br></br><br></br>

                   <b>( Authorised Signatory)</b>
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
