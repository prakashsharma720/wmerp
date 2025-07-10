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
                            <th colspan="6"> <h4 style="text-align: center">Supplier's Evaluation Result : </h4></th>
                          </tr>
                            <tr>
						<?php if($current['0']['supplier_id']!=null){?>
						
                            <th> Supplier Category : </th>
                            <td> <?= $current['0']['category']?> </td>
                             <th> Supplier Name : </th>
                            <td> <?= $current['0']['supplier']?> </td>
                          </tr>
                          <tr>
                            <th> Contact Person : </th>
                            <td> <?= $current['0']['contact_person1']?> </td>
							 <th> Supplier Type </th>
                            <td> <?= $current['0']['supplier_type']?> </td>
                          </tr>
						  <tr>
                            <th>Evaluation Date </th>
                            <td> <?= $current['0']['date']?> </td>
							 <th> </th>
                            <td>  </td>
                          </tr>
						     <tr>
                            <th colspan=""> Address : </th>
                            <td colspan="4"> <?= $current['0']['address1']?>  </td>
						<?php } ?>
                          </tr>
						   <tr>
						<?php if($current['0']['service_provider_id']!=null){?>
                            <th> Service Provider Category : </th>
                            <td> <?= $current['0']['category']?> </td>
                             <th> Service Provider Name : </th>
                            <td> <?= $current['0']['sprovider']?> </td>
                          </tr>
                          <tr>
                            <th> Contact Person : </th>
                            <td> <?= $current['0']['contact_person3']?> </td>
							 <th> Service Provider Type </th>
                            <td> <?= $current['0']['service_provider_type']?> </td>
                          </tr>
						  <tr>
                            <th>Evaluation Date </th>
                            <td> <?= $current['0']['date']?> </td>
							 <th> </th>
                            <td>  </td>
                          </tr>
						     <tr>
                            <th colspan=""> Address : </th>
                            <td colspan="4"> <?= $current['0']['address3']?>  </td>
						<?php } ?>
                          </tr>
						<tr>
						<?php if($current['0']['transporter_id']!=null){?>
                            
                             <th> Transporter Name : </th>
                            <td> <?= $current['0']['transporter']?> </td>
                          </tr>
                          <tr>
                            <th> Contact Person : </th>
                            <td> <?= $current['0']['contact_person2']?> </td>
							<th>Transporter Type </th>
                            <td> <?= $current['0']['transporter_type']?> </td>
                          </tr>
						  <tr>
                            <th>Evaluation Date </th>
                            <td> <?= $current['0']['date']?> </td>
							 <th> </th>
                            <td>  </td>
                          </tr>
						  <tr>
                            <th colspan=""> Address : </th>
                            <td colspan="4"> <?= $current['0']['address2']?>  </td>
						    <?php } ?>
                          </tr>

						  <tr>
						  <th> S.No.</th>
						<th colspan=""><label> Evaluation Criteria</label><br></th>
						<th colspan="4" style="text-align: right;"> Marks Obtained</th></tr>
                  <?php $i=1;foreach($current['0']['er_details'] as $er_details) { ?>
	                    <tr>
						
	                      <td colspan="1"><?= $i ?></td>
	                      <td colspan="4" ><?= $er_details['criteria']?> </td>
							<td >
								<?php 
								if($er_details['marks_obtained']==10.00){
										echo 'Good'.' ('.$er_details['marks_obtained'].')';
								} else if($er_details['marks_obtained']==7.00) {
									echo 'Average'.' ('.$er_details['marks_obtained'].')';
								}else {
								echo 'Below Average'.' ('.$er_details['marks_obtained'].')';
								 } ?>
							</td>
	                     
	                    </tr>
	                <?php $i++;} ?>
					
					
							<tr>
			        			<td colspan="4" style="text-align: right;"><b>Total</b></td>
								<td colspan="2">	
			        				<?= $current['0']['total_marks_obtained']?>
	         					</td>			        				
							</tr>
			        	    <tr>
			        		    <td colspan="4" style="text-align: right;"><b>Total Percentage (%)</b></td>
			        			<td colspan="2">
			        						<?= $current['0']['percentage']?>
			        			</td>
			        		</tr>
			        		<tr>
			        		    <td colspan="4" style="text-align: right;"><b> Category of Approval</b></td>
			        			<td colspan="2">
			        			<?= $current['0']['approval_grade']?>
			        		    </td>
						    </tr>
						<tr><div class="row col-md-12">
		        	<div class="col-md-6 col-sm-6 ">
		        		<table class="table">
	            			<thead>
	            				<tr>
	            					<th> Percentage Criteria </th>
	            					<th> Grade </th>
	            				</tr>
	            			</thead>
	            			<tbody>
	            				<tr>
	            					<td> Above Average (80% & Above) </td>
	            					<td> A</td>
	            				</tr>
	            				<tr>
	            					<td> Average (60-79%)  </td>
	            					<td> B</td>
	            				</tr>
	            				<tr>
	            					<td> Below Average (40-59%) </td>
	            					<td> C</td>
	            				</tr>
	            			</tbody>
	            		</table>
		        	</div>
		        	 <div class="col-md-6 col-sm-6 ">
		        	 	<label  class="control-label"> Marking Criteria</label><br>
		          		<label> Good</label> : 10  <br>
	            		<label> Average</label> : 7 <br> 
	            		<label> Below Average</label> : 5 
		            </div>
		        </div></tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                <div class="row col-md-12 invoice-info">
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
