<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*print_r($packing_sizes);
foreach ($packing_sizes as $key => $value) {
	echo $value;exit;
	# code...
}*/
?>
<style type="text/css">
	th,td{
		padding: 10px;
	}
</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
        <div class="pull-right error_msg">
			Previous Invoice No : <b> <?= $last_invoice_no ?></b>
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Invoice/update/<?= $id?>" >
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Invoice Date <span class="required">*</span></label>
			                  <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($rows[0]['transaction_date']) { echo date('d-m-Y',strtotime($rows[0]['transaction_date'])); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Invoice Number <span class="required">*</span></label>
			            	
			            	<input type="text"  placeholder=" Enter Invoice Number" name="invoice_no" class="form-control invoice_no" value="<?= $invoice_no ?>" autocomplete="off" autofocus >

			            	<!-- <input type="hidden" name="invoice_code" value="<?= $invoice_no ?>"> -->
			            </div>
			            <div class="col-md-4 col-sm-4 vendor_code">
			            	<label  class="control-label">Vendor Code <span class="required">*</span></label>
			            	<?php echo form_dropdown('customer_id',$vendorcodes,$rows[0]['customer_id']);?>
			            	<!-- <select name="vendor_code" class="form-control select2 category" >
			            		 <option value="">Select Vendor</option>
					                <?php
					                 if ($customers): ?> 
					                  <?php 
					                    foreach ($customers as $value) : ?>
						                    <option value="<?= $value['id'] ?>"><?= $value['customer_code'] ?></option>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="">No result</option>
					                <?php endif; ?>
					            </select>  -->
					        </div>
		        	</div>
		        	
		        	<div class="row col-md-12 insert_div">
		        		<div class="col-md-4 col-sm-4 gst_no">
			          		<label  class="control-label">Vender Service Tax Number</label>
							<input type="text"  placeholder=" Vender Service Tax Number" name="vendor_service_tax_no" class="form-control clear_gst" value="<?=$rows[0]['vendor_service_tax_no']?>" autocomplete="off" autofocus readonly="readonly" >
			            </div>
			             <div class="col-md-4 col-sm-4 buyer_item_code">
				            <label  class="control-label">Buyer Item Code  </label>
				    		<textarea class="form-control buyer_item_code1" rows="2" placeholder="Enter buyer item code" value="<?=$rows[0]['buyer_item_code']?>" name="buyer_item_code" ><?=$rows[0]['buyer_item_code']?></textarea>
			    		</div> 
			    		<div class="col-md-4 col-sm-4 destination">
				            <label  class="control-label"> Destination</label>
				    		<textarea class="form-control destination" rows="2" placeholder="Enter destination here" name="destination" value="<?=$rows[0]['destination'] ?>" ><?=$rows[0]['destination'] ?></textarea>
				    	</div>
		            	
			        </div>
			         <div class="row col-md-12 ">
			    		<div class="col-md-4 col-sm-4 ">
		            		<label  class="control-label"> PO Number <span class="required">*</span></label>
		            		<input type="text" placeholder=" Enter PO Number" name="po_no" class="form-control" value="<?=$rows[0]['po_no']?>" required="required" />
		            	</div>
		            	<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> PO Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="po_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" 
			                 value="<?php if($rows[0]['po_date']) { echo date('d-m-Y',strtotime($rows[0]['po_date'])); } ?>" autofocus required >
			            </div>
		            	<div class="col-md-4 col-sm-4">
				            <label  class="control-label"> Remarks</label>
				    		<textarea class="form-control " rows="2" placeholder="Enter Remarks here" name="remarks" ><?=$rows[0]['remarks']?></textarea>
			    		</div>
			        </div>
					<br>
				<div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table id="maintable">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th >#</th>
			        					<th > Item Name</th>
										<th style="white-space: nowrap;"> Month Of Production</th>
			        					<th style="white-space: nowrap;"> Lot No.</th>
			        					<th style="white-space: nowrap;"> Batch No.</th>
										<th > Packing Size</th> 
										<th > No Of Bags</th> 
										<th > Quantity In MT</th>
										<th > Rate Per MT</th>
										<th > Total</th>
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
									<?php
									if(!empty($rows[0]['invoice_details'])){
										foreach($rows[0]['invoice_details'] as $key => $row){ ?>
											<tr class="main_tr1">
												<td ><?php echo $key+1; ?></td>
												<td> 
													<select name="finish_good_id[]" class="form-control products select2" style="width:350px;" required>
										                <?php if ($items): ?> 
										                    <?php foreach ($items as $value) : ?>
										                        <?php if ($value['id'] == $row['finish_good_id']): ?>
										                           <option value="<?= $value['id'] ?>" selected><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
										                        <?php else: ?>
										                           <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
										                        <?php endif; ?>
										                    <?php endforeach; ?>
										                <?php else: ?>
										                    <option value="0">No result</option>
										                <?php endif; ?>
										            </select>
													
									   			</td>
												<td >
													<input type="text"  placeholder="Enter Month" name="production_month[]" value="<?php echo $row['production_month'];?>" class="form-control"   autofocus  >
												</td> 
												<td >
													<input type="text"  placeholder="Enter Lot No" name="lot_no[]" value="<?=$row['lot_no']?>" class="form-control"  style="width: 150px;" autofocus  >
												</td>
									   			<td>
													<input type="text"  placeholder="Enter Batch No" name="batch_no[]" value="<?=$row['batch_no']?>" class="form-control"  autofocus style="width: 150px;" >
												</td>
												<td>
												<!-- <textarea name="description[]"  style="width:200px;" class="form-control description" type="textarea" placeholder="Enter description"></textarea> -->
												<select name="packing_size[]" class="form-control packing_size" required="required"  style="width:100px;" >
									                <?php
									                 if ($packing_sizes): ?> 
									                  <?php 
									                    foreach ($packing_sizes as $key => $value) : ?>
									                        <?php 

																if ($key == $row['packing_size']): ?>
										                            <option value="<?= $key?>" selected><?= $value ?></option>
										                        <?php else: ?>
										                            <option value="<?= $key ?>"><?= $value ?></option>
										                        <?php endif;   ?>
									                    <?php   endforeach;  ?>
									                <?php else: ?>
									                    <option value="0">No result</option>
									                <?php endif; ?>
								        		</select>
											</td> 
												<td>
												<input type="text"  placeholder="No of Bags" value="<?=$row['no_of_bags']?>" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
												</td>
											
											
												<td>
													<input type="text" value="<?=$row['quantity']?>" placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" readonly >
												</td>
												
												<td >
													<input type="text"  placeholder="Enter Rate" name="rate[]" value="<?=$row['rate']?>" class="form-control rate"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
												</td>
												<td >
													<input type="text" placeholder="Total Amount" name="amount[]" value="<?=$row['amount']?>" class="form-control amount"  autofocus style="width:150px;" readonly>
												</td>
												<td>
													<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
													<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
												</td>
											</tr>
										<?php }} ?>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> SELECT TAX </b></td>
			        					<td colspan="">
			        						<?php 
			        						$igst_checked='';
			        						$other_checked='';
			        						if(!empty($rows[0]['type_of_tax'])) {
			        							if($rows[0]['type_of_tax']=='IGST'){
			        								$igst_checked='checked';
			        							}else{
			        								$other_checked='checked';
			        							}

			        						}else{
			        							$other_checked='checked';
			        						}
			        						?>
			        						<input class="type_of_tax" type="radio" name="type_of_tax" value="IGST"  <?= $igst_checked ?>> IGST</input>
			        						&nbsp;&nbsp;&nbsp;&nbsp;
							                <input class="type_of_tax" type="radio" name="type_of_tax" value="Other"  <?= $other_checked ?> > Other</input>
			        					</td>
			        					<!-- <td colspan="">
			        						<input type="text"  placeholder="Total Rate" name="total_rate" class="form-control total_rate"  value="" readonly >
			        					</td>  -->
			        					<td colspan="2">
			        						<input type="text" placeholder="Taxable Amount" name="total_amount" class="form-control total_amount"  value="<?=$rows[0]['total_amount']?>" readonly >
			        					</td>
			        				</tr>
			        				<tr class="igst_row hide">
			        					<td colspan="6" style="text-align: right;"><b> IGST</b></td>
			        					<td colspan="">
			        						<input type="text" value="<?=$rows[0]['tax_per_igst']?>" placeholder=" Enter IGST %" name="tax_per_igst" class="form-control tax_per_igst"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" autofocus >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="IGST Amount" name="igst_amount" class="form-control igst_amount"  value="<?=$rows[0]['igst_amount']?>" readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_igst" class="form-control grand_total_after_igst"  value="<?=$rows[0]['grand_total_after_igst']?>" readonly >
			        					</td>
			        				</tr>
			        				<tr class="cgst_row">
			        					<td colspan="6" style="text-align: right;"><b> CGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter CGST %" value="<?=$rows[0]['tax_per_cgst']?>" name="tax_per_cgst" class="form-control tax_per_cgst" autofocus  >
			        					</td>
			        					<td colspan="">
			        						<input type="text" value="<?=$rows[0]['cgst_amount']?>" placeholder="CGST Amount" name="cgst_amount" class="form-control cgst_amount"  readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text" value="<?=$rows[0]['grand_total_after_cgst']?>" placeholder=" Amount with Tax" name="grand_total_after_cgst" class="form-control grand_total_after_cgst"  readonly  >
			        					</td>
			        				</tr>
			        				<tr class="sgst_row">
			        					<td colspan="6" style="text-align: right;"><b> SGST</b></td>
			        					<td colspan="">
			        						<input type="text" value="<?=$rows[0]['tax_per_sgst']?>" placeholder=" Enter SGST %" name="tax_per_sgst" class="form-control tax_per_sgst" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" autofocus >
			        					</td>
			        					<td colspan="">
			        						<input type="text" value="<?=$rows[0]['sgst_amount']?>" placeholder="SGST Amount" name="sgst_amount" class="form-control sgst_amount"  readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text" value="<?=$rows[0]['grand_total_after_sgst']?>" placeholder=" Amount with Tax" name="grand_total_after_sgst" class="form-control grand_total_after_sgst"  readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> TOTAL AMOUNT </b></td>
			        					<td colspan="3">
			        						<input type="text" value="<?=$rows[0]['total_amount_before_round_off']?>" placeholder=" Grand Total" name="final_total_amount" class="form-control final_total_amount"  autofocus readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> ROUND OFF  </b></td>
			        					<td colspan="3">
			        						<input type="text" value="<?=$rows[0]['round_off']?>" placeholder=" Round off" name="round_off" class="form-control round_off"  autofocus readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> GRAND TOTAL  </b></td>
			        					<td colspan="3">
			        						<input type="text" value="<?=$rows[0]['grand_total']?>" placeholder=" grand_total" name="grand_total" class="form-control grand_total"  autofocus readonly >
			        					</td>
			        				</tr>


			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>
		        </fieldset>
		        <fieldset>
		        	<legend> Transporter Details </legend>
		        	<div class="row col-md-12">
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Truck Number<span class="required">*</span></label>
			            	<input type="text" placeholder=" Enter Truck Number" name="truck_no" class="form-control" value="<?=$rows[0]['truck_no'] ?>" />
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Select Transporter Name</label>
			            	<?php 
			            		// echo form_dropdown('transporter_id',$transporters);

			            	?>
			            		<select name="transporter_id" class="form-control packing_size" required="required">
					                <?php
					                 if ($packing_sizes): ?> 
					                  <?php 
					                    foreach ($transporters as $key => $value) : ?>
					                        <?php 

												if ($key == $rows[0]['transporter_id']): ?>
						                            <option value="<?= $key?>" selected><?= $value ?></option>
						                        <?php else: ?>
						                            <option value="<?= $key ?>"><?= $value ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
			        		</select>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> E-Way Bill Number </label>
			            	<input type="text" placeholder=" Enter E-Way Bill Number" name="way_billno" class="form-control" value="<?=$rows[0]['way_billno'] ?>" />
			            </div>
					</div>
					<div class="row col-md-12">
						  <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> TP  Number </label>
			            	<input type="text" placeholder=" Enter TP number" name="tp_no" class="form-control" value="<?=$rows[0]['tp_no'] ?>" />
			            </div>
						   <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Freight Status </label>
		            		<div class="form-check">
			               		<input class="form-check-input" type="radio" name="frieght_status" value="Paid" > Paid</input>
			               		&nbsp;&nbsp;&nbsp;&nbsp;
			               		<input class="form-check-input" type="radio" name="frieght_status" value="To Pay" checked> To Pay</input>
		            		</div>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Freight Rate</label>
			            	<input type="text" placeholder=" Enter Freight Rate" name="frieght_rate" class="form-control" value="<?=$rows[0]['frieght_rate'] ?>" />
			            </div>
		        	</div>
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> GR No.</label>
			            	<input type="text" placeholder=" Enter GR No." name="gr_no" class="form-control"  value="<?=$rows[0]['gr_no'] ?>" />
			            </div>
			           
		        	</div>
		        </fieldset>
		        <fieldset>
			        	<legend> Driver Details </legend>
			        	<div class="row col-md-12">
							  <div class="col-md-6 col-sm-6 ">
				            	<label  class="control-label"> Driver Name (1)</label>
				            	<input type="text" placeholder=" Enter driver name" name="driver_name1" class="form-control" value="<?=$rows[0]['driver_name1'] ?>" />
				            </div>
				             <div class="col-md-6 col-sm-6 ">
				            	<label  class="control-label"> Mobile Number (1)</label>
				            	<input type="text" placeholder=" Enter mobile number" name="contact1" class="form-control mobile" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="10" minlength="10" value="<?=$rows[0]['contact1'] ?>" />
				            </div>
				        </div>
				        <div class="row col-md-12">
							  <div class="col-md-6 col-sm-6 ">
				            	<label  class="control-label"> Driver Name (2)</label>
				            	<input type="text" placeholder=" Enter driver name" name="driver_name2" class="form-control" value="<?=$rows[0]['driver_name2'] ?>" />
				            </div>
				             <div class="col-md-6 col-sm-6 ">
				            	<label  class="control-label"> Mobile Number (2)</label>
				            	<input type="text" placeholder=" Enter mobile number" name="contact2" class="form-control mobile" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="10" minlength="10" value="<?=$rows[0]['contact2'] ?>" />
				            </div>
				        </div>
				         <div class="row col-md-12">
							  <div class="col-md-6 col-sm-6 ">
				            	<label  class="control-label"> Owner Name</label>
				            	<input type="text" placeholder=" Enter Owner name" name="driver_name3" class="form-control" value="<?=$rows[0]['driver_name3'] ?>" />
				            </div>
				             <div class="col-md-6 col-sm-6 ">
				            	<label  class="control-label"> Mobile Number</label>
				            	<input type="text" placeholder=" Enter mobile number" name="contact3" class="form-control mobile" oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="10" minlength="10" value="<?=$rows[0]['contact3'] ?>" />
				            </div>
				        </div>
				    </fieldset>
		        <fieldset>
		        	<legend> Laboratory Test Details </legend>
		        	<div class="row col-md-12">
						  <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Latoratory Test Report No</label>
			            	<input type="text" placeholder=" Enter Test Report number" name="test_report_no" class="form-control" value="<?=$rows[0]['test_report_no'] ?>" />
			            </div>
						   <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Sending Status </label>
							
							<?php 
								$enclosed='';
								$post='';
								if(!empty($rows[0]['report_sending_status'])) {
									if($rows[0]['report_sending_status']=='Enclosed'){
										$enclosed='checked';
									}else{
										$post='checked';
									}

								}else{
									$enclosed='checked';
								}
								?>
											
		            		<div class="form-check">
			               		<input class="form-check-input" type="radio" name="report_sending_status" value="Enclosed" <?= $enclosed ?>> Enclosed</input>
			               		&nbsp;&nbsp;&nbsp;&nbsp;
			               		<input class="form-check-input" type="radio" name="report_sending_status" value="Being Send by Post" <?= $post ?>> Being Send by Post</input>
		            		</div>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Testing Date</label>
			            	 <input type="text" data-date-formate="dd-mm-yyyy" name="testing_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($rows[0]['testing_date']) { echo date('d-m-Y',strtotime($rows[0]['testing_date'])); } ?>" autofocus required >
			            </div>
		        	</div>
		        </fieldset>
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> Grade</label>
			                <button type="submit" class="btn btn-primary btn-block"> Submit</button>
		        		</div>
		        	</div>
		    </form> <!-- /form -->
		</div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td >1</td>
			<td> 
			<select name="finish_good_id[]" class="form-control products" style="width:350px;" required>
				<option value=""> Select Item</option>
	            <?php if ($items): ?> 
	                <?php foreach ($items as $value) : ?>
	                        <!-- <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
	                        <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
	                <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0">No result</option>
	            <?php endif; ?>
	        </select>
				
   			</td>
			<td >
				<input type="text"  placeholder="Enter Month" name="production_month[]" value="" class="form-control"   autofocus  >
			</td> 
												
   			<td>
				<input type="text"  placeholder="Enter Lot No" name="lot_no[]" value="" class="form-control"  style="width: 150px;" autofocus  >
			</td>
   			<td>
				<input type="text"  placeholder="Enter Batch No" value="" name="batch_no[]" class="form-control"  autofocus style="width: 150px;" >
			</td>
			<td>
				<!-- <textarea name="description[]"  style="width:200px;" class="form-control description" type="textarea" placeholder="Enter description"></textarea> -->
				<select name="packing_size[]" class="form-control packing_size" required="required"  style="width:100px;" >
	                <?php
	                 if ($packing_sizes): ?> 
	                  <?php 
	                    foreach ($packing_sizes as $key => $value) : ?>
	                        <?php 

								if ($value == $packing_size): ?>
		                            <option value="<?= $key?>" selected><?= $value ?></option>
		                        <?php else: ?>
		                            <option value="<?= $key ?>"><?= $value ?></option>
		                        <?php endif;   ?>
	                    <?php   endforeach;  ?>
	                <?php else: ?>
	                    <option value="0">No result</option>
	                <?php endif; ?>
        		</select>
			</td> 
				<td>
				<input type="text"  placeholder="No of Bags" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			
		
			<td>
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" readonly >
			</td>
			
			<td >
				<input type="text"  placeholder="Enter Rate" name="rate[]" class="form-control rate"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td >
				<input type="text" placeholder="Total Amount" name="amount[]" class="form-control amount"  autofocus style="width:150px;" readonly>
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>



<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<!-- <script type="text/javascript">
		$(document).ready(function() {
		    $('#maintable').DataTable( {
		        "scrollX": true
		    } );
		});
</script> -->
<script type="text/javascript">
	$( document ).ready(function() {

		//add_row();

		$('body').on('click','.addrow',function(){

			var table=$(this).closest('table');
			add_row();
			 rename_rows();
			 calculate_total(table);
	    });
		
		function add_row(){ 
			var tr1=$("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}
		$('body').on('click','.deleterow',function(){
			
		var table=$(this).closest('table');
		var rowCount = $("#maintable tbody tr.main_tr1").length;
		if (rowCount>1){
			if (confirm("Are you sure to remove row ?") == true) {
				$(this).closest("tr").remove();
				rename_rows();
				calculate_total(table);
			} 
		}
		}); 

		function rename_rows(){
		var i=0;
		$("#maintable tbody tr.main_tr1").each(function(){ 
			$(this).find("td:nth-child(1)").html(++i);
			$(this).find("td:nth-child(2) select.products").select2();
			$(this).find("td:nth-child(2) select.products").last().next().next().remove();
			//$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}

		//type_of_tax=$(this).find("input[name=type_of_tax]:checked").val();
		//alert(type_of_tax);


		$(document).on('keyup','.no_of_bags,.qty,.rate,.tax_per_sgst,.tax_per_cgst,.tax_per_igst',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });

	    $(document).on('change','.packing_size,.type_of_tax',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });


		function calculate_total(table)
		{
			var amount=0;
			var total_qty=0;
			var total_rate=0;
			var total_amount=0;
			var tax_per_igst=0;
			var igst_amount=0;
			var grand_total_after_igst=0;
			var tax_per_cgst=0;
			var cgst_amount=0;
			var grand_total_after_cgst=0;
			var tax_per_sgst=0;
			var sgst_amount=0;
			var grand_total_after_sgst=0;
			var final_total=0;
			var type_of_tax=0;

			table.find("tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
					/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				var packing_size = $(this).find('td:nth-child(6) select.packing_size option:selected').val();
				var no_of_bags=parseFloat($(this).find("td:nth-child(7) input.no_of_bags").val());
				//var qty=parseFloat($(this).find("td:nth-child(7) input.qty").val());
				var rate=parseFloat($(this).find("td:nth-child(9) input.rate").val());
				//alert(packing_size);
				//alert(no_of_bags);
				if(isNaN(packing_size))
				{
					packing_size =0;
				}
				if(isNaN(no_of_bags))
				{
					no_of_bags =0;
				}
				if(isNaN(qty))
				{
					qty =0;
				}
				if(isNaN(rate))
				{
					rate =0;
				}
				var quantity=packing_size*no_of_bags/1000;
				$(this).find("td:nth-child(8) input.qty").val(quantity.toFixed(2));
				var qty=parseFloat($(this).find("td:nth-child(8) input.qty").val());

				total_qty=total_qty+qty;
				total_rate=total_rate+rate;
				amount=qty*rate;
				total_amount=total_amount+amount;
				
				$(this).find("td:nth-child(10) input.amount").val(amount.toFixed(2));
			});

			//alert(total_qty);
			


			if(table.find("tfoot tr input[name=type_of_tax]").is(':checked'))
				{
					type_of_tax=table.find("tfoot tr input[name=type_of_tax]:checked").val();
					//alert(type_of_tax);
					if(type_of_tax=='IGST'){

						table.find("tfoot tr.igst_row").removeClass('hide');						
						table.find("tfoot tr.igst_row").addClass('show');
						table.find("tfoot tr.cgst_row").addClass('hide');							
						table.find("tfoot tr.sgst_row").addClass('hide');
						table.find("tfoot tr td input.tax_per_cgst").val('');							
						table.find("tfoot tr td input.tax_per_sgst").val('');
							/********************* IGST Calculation  *******************/ 
						tax_per_igst=table.find("tfoot tr input.tax_per_igst").val();
						if(!isNaN(tax_per_cgst))
						{
							if(isNaN(igst_amount))
							{
								igst_amount =0;
							}
							if(isNaN(total_amount))
							{
								total_amount =0;
							}

							igst_amount=(total_amount*tax_per_igst)/100;
							grand_total_after_igst=total_amount+igst_amount;			
							table.find("tfoot tr input.igst_amount").val(igst_amount.toFixed(2));
							table.find("tfoot tr input.grand_total_after_igst").val(grand_total_after_igst.toFixed(2));
							table.find("tfoot tr input.final_total_amount").val(grand_total_after_igst.toFixed(2));
							var round = Math.round(grand_total_after_igst);
							table.find("tfoot tr input.grand_total").val(round);
						}							
					}else{
						table.find("tfoot tr.cgst_row").removeClass('hide');						
						table.find("tfoot tr.sgst_row").removeClass('hide');						
						table.find("tfoot tr.cgst_row").addClass('show');		
						table.find("tfoot tr.sgst_row").addClass('show');		
						table.find("tfoot tr.igst_row").addClass('hide');
						table.find("tfoot tr td input.tax_per_igst").val('');	
						
						/********************* CGST Calculation  *******************/ 

						tax_per_cgst=table.find("tfoot tr input.tax_per_cgst").val();
						if(!isNaN(tax_per_cgst))
						{
							if(isNaN(cgst_amount))
							{
								cgst_amount =0;
							}
							if(isNaN(total_amount))
							{
								total_amount =0;
							}

							cgst_amount=(total_amount*tax_per_cgst)/100;
							grand_total_after_cgst=total_amount+cgst_amount;			
							table.find("tfoot tr input.cgst_amount").val(cgst_amount.toFixed(2));
							table.find("tfoot tr input.grand_total_after_cgst").val(grand_total_after_cgst.toFixed(2));
						}
						/********************* SGST Calculation  *******************/ 
						tax_per_sgst=table.find("tfoot tr input.tax_per_sgst").val();
						//alert(tax_per);
						if(!isNaN(tax_per_sgst))
						{
							if(isNaN(sgst_amount))
							{
								sgst_amount =0;
							}
							if(isNaN(total_amount))
							{
								total_amount =0;
							}
							if(isNaN(grand_total_after_sgst))
							{
								grand_total_after_sgst =0;
							}
							if(isNaN(grand_total_after_cgst))
							{
								grand_total_after_cgst =0;
							}

							

							sgst_amount=(total_amount*tax_per_sgst)/100;
							grand_total_after_sgst=grand_total_after_cgst+sgst_amount;			
							table.find("tfoot tr input.sgst_amount").val(sgst_amount.toFixed(2));
							table.find("tfoot tr input.grand_total_after_sgst").val(grand_total_after_sgst.toFixed(2));
							table.find("tfoot tr input.final_total_amount").val(grand_total_after_sgst.toFixed(2));
							var round = Math.round(grand_total_after_sgst);
							table.find("tfoot tr input.grand_total").val(round);
						}		
					}
				}
			var final_total_for_round_off=table.find("tfoot tr input.final_total_amount").val();
			var data=final_total_for_round_off.split('.');
			var err=data[1];

			table.find("tfoot tr input.round_off").val(err);

			table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));


		}
	
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change','.vendor_code',function(){
				var customer_id = $('.vendor_code').find('option:selected').val();
				//alert(customer_id);
				if(customer_id!=''){
					$.ajax({
		                type: "POST",
		                url:"<?php echo base_url('index.php/Customers/getcustomerById/') ?>"+customer_id,
		                //data: {id:role_id},
		                dataType: 'html',
		                success: function (response) {
		                	//alert(response);
		                    $(".insert_div").html(response);
		                    //$('.select2').select2();
		                }
	            	});
				}else{
					$(".clear_gst").val('');
					$(".buyer_item_code1").val('');
					$(".destination1").val('');
				}
			}); 
		$(document).on('blur','.invoice_no',function(){
				var invoice_no = encodeURIComponent($('.invoice_no').val());
				//var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+customer_code;
				//alert(invoice_no);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Invoice/CheckInvoiceNo/') ?>",

	                data: {invoice_no:invoice_no},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                   if(response==1){
	                   	alert('This Invoice Number is already taken');
	                   	$('.invoice_no').val('');
	                   }
	                }
            	});
			}); 

	});
</script> 
