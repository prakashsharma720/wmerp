<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
//$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
       <div class="card-header no-print">
        <h3 class="card-title"><?= $title?></h3>
          <div class="pull-right no-print" style="margin-top:-40px !important;">
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
                              <th colspan="6"> <h4 style="text-align: center"> Material Return Register</h4></th>
                          </tr>
                            
							<tr>
                  <th colspan="1"> Gir Register Category : </th>
                  <td colspan="1"> <?= $current['0']['category']?> </td>
                   <th colspan="1"> Supplier Name : </th>
                  <td colspan="2"> <?= $current['0']['supplier']?> </td>
  							   <td colspan=""></td>
              </tr>
            <tr>
						    <th>Register Number</th>
						   <td><?= $current['0']['voucher_code']?></td>
                            <th>Date </th>
                            <td> <?= $current['0']['transaction_date']?> </td>
							 <th>Gate Pass Number </th>
							  <td> <?= $current['0']['gate_pass_no']?> </td>
            </tr>
						<tr>
                            <th colspan="1"> Gir Register Category : </th>
                            <td colspan="1"> <?= $current['0']['category']?> </td>
                             <th colspan="1"> Supplier Name : </th>
                            <td colspan="2"> <?= $current['0']['supplier']?> </td>
						
            </tr>
              <tr>
                 <th>Tentative Return Date </th>
                  <td> <?= $current['0']['return_date']?> </td>
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
