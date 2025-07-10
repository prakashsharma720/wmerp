<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
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
                <h3 style="padding-top: 20px;"> Choudhary & Company </h3>
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
                           <tr>
                            <th colspan="6"> <h4 style="text-align: center">General GIR Register : </h4></th>
                          </tr>
                            
							<tr>
						<?php if($current['0']['categories_id']!='1'){?>
                            <th colspan="1"> Gir Register Category : </th>
                            <td colspan="1"> <?= $current['0']['category']?> </td>
                             <th colspan="1"> Supplier Name : </th>
                            <td colspan="2"> <?= $current['0']['supplier']?> </td>
							<td colspan=""></td>
                          </tr>
                       	  <tr>
						    <th>GIR Number</th>
						   <td><?= $current['0']['gir_no']?></td>
                            <th>Date </th>
                            <td> <?= $current['0']['transaction_date']?> </td>
							 <th>Challan Number </th>
							  <td> <?= $current['0']['challan_no']?> </td>

						<?php } ?>
                          </tr>
						<tr>
						<?php if($current['0']['categories_id']=='1'){?>
                            <th colspan="1"> Gir Register Category : </th>
                            <td colspan="1"> <?= $current['0']['category']?> </td>
                             <th colspan="1"> Supplier Name : </th>
                            <td colspan="2"> <?= $current['0']['supplier']?> </td>
							<th>GIR Number</th>
						   <td><?= $current['0']['gir_no']?></td>
                          </tr>
                       	  <tr>
                            <th>Date </th>
                            <td> <?= $current['0']['transaction_date']?> </td>
							<th>Challan Number </th>
							  <td> <?= $current['0']['challan_no']?> </td>
							 <th>Weight Slip Number </th>
                            <td><?= $current['0']['weight_slip_no']?></td>
							</tr>
							<tr>
							<th>Actual Weight </th>
                            <td> <?= $current['0']['actual_weight']?> </td>
							<th>Documented Weight</th>
							  <td> <?= $current['0']['doc_weight']?> </td>
							 <th>Weight</th>
                            <td><?= $current['0']['weight']?></td>
							</tr>
							 <tr>
                            <th>Truck Number</th>
                           <td> <?= $current['0']['truck_no']?> </td>
							
							 <th>Payment </th>
                            <td><?= $current['0']['payment']?></td>
							<th></th>
							<td></td>
							</tr>
						<?php } ?>
                          </tr>
						   <tr>
                      <th>Material Received From</th>
                      <td> <?= $current['0']['material_received_from']?> </td>
        							<th></th>
        							<td></td>
                      <th></th>
        							<td></td>
							</tr>
							
						  <tr>
						  <th> S.No.</th>
						<th colspan=""><label> Product Name</label><br></th>
						<th>Quantity</th>
						<th><label>Unit</label><br></th>
						<th><label>Description</label><br></th></tr>
                  <?php $i=1;foreach($current['0']['gir_details'] as $gir_details) { ?>
	                    <tr>
						
	                      <td colspan="1"><?= $i ?></td>
	                      <td><?= $gir_details['item']?> </td>
							<td>
								<?=$gir_details['quantity']
								 ?>
							</td>
							<td >
								<?=$gir_details['unit']
								 ?>
							</td>
							<td>

								<?=$gir_details['description']
								 ?>
							</td>
	                    </tr>
	                <?php $i++;} ?>
					
					
							<tr>
			        			<td colspan="2" style="text-align: right;"><b>Total</b></td>
							
							                 <td> <?= $current['0']['total_qty']?></td>
							</tr>
			        		</tbody>
							</table>
				       
                 <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <b> Declaration : </b> We declare that this copy shows the actual information of this supplier and that all particulars are true and correct to the best of our knowledge.
                </div>
               <div class="col-sm-4 invoice-col">
               <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
                </div>
                <div class="col-sm-4 invoice-col">
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
