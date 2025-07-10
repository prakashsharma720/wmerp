<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>
		
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
		    		<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Gir_registers/edit_gir/<?= $id ?>">
		    			<input type="hidden" name="gir_id_old" value="<?= $id?>">
			    
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> GIR No <span class="required">*</span></label>
			             <input type="text"  name="g_no" class="form-control" value="<?= $gir_no?>"  autofocus readonly="readonly">
		                 <input type="hidden" name="gir_no" value="<?php echo $g_no;?>">
			            </div>

			            <div class="col-md-4 col-sm-4">
			            	<label  class="control-label"> Royalty Challan No <span class="required">*</span></label>
			            	<input type="text"  placeholder=" Enter Invoice/Challan No" name="challan_no" class="form-control" value="<?= $challan_no?>" autofocus  >
			            </div>

		        	</div>
		        	<div class="row col-md-12">
		            	<!--<div class="col-md-4 col-sm-4 ">
						   	<input type="hidden" value="1" name="categories_id"/>
			            	 <label  class="control-label">Name of Transporter <span class="required">*</span></label>
				            <select name="transporter_id" class="form-control select2 suppliers" required="required">
						        <?php
						         if ($transporters): ?> 
						          <?php 
						            foreach ($transporters as $value) : ?>
						                <?php 
											if ($value['id'] == $transporter_id): ?>
						                        <option value="<?= $value['id'] ?>" selected><?= $value['transporter_name'] ?></option>
						                    <?php else: ?>
						                        <option value="<?= $value['id'] ?>"><?= $value['transporter_name'] ?></option>
						                    <?php endif;   ?>
						            <?php   endforeach;  ?>
						        <?php else: ?>
						            <option value="0">No result</option>
						        <?php endif; ?>
						    </select>
						</div>-->
					<div class="col-md-4 col-sm-4 ">
					<input type="hidden" value="1" name="categories_id"/>
			            	 <label  class="control-label">Name of supplier <span class="required">*</span></label>
			            	<select name="supplier_id" class="form-control select2 suppliers" required="required">
						        <?php
						         if ($suppliers): ?> 
						          <?php 
						            foreach ($suppliers as $value) : ?>
						                <?php 
											if ($value['id'] == $supplier_id): ?>
						                        <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] ?></option>
						                    <?php else: ?>
						                        <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
						                    <?php endif;   ?>
						            <?php   endforeach;  ?>
						        <?php else: ?>
						            <option value="0">No result</option>
						        <?php endif; ?>
						    </select>
						</div>
						
						<div class="col-md-4 col-sm-4 ">
							<label  class="control-label">Weight Slip Number <span class="required">*</span></label>
							<input type="text" placeholder="Enter weight slip no." name="weight_slip_no" class="form-control" value="<?= $weight_slip_no?>" autofocus>
						</div>
						<div class="col-md-4 col-sm-4 ">
							<label  class="control-label">Truck No.<span class="required">*</span></label>
							<input type="text" placeholder="Enter Truck No. " name="truck_no" class="form-control" value="<?= $truck_no?>" autofocus>
						</div>
					</div>
						
					<div class="row col-md-12">
						<div class="col-md-4 col-sm-4 ">
							<label  class="control-label">Actual Weight<span class="required">*</span></label>
							<input type="text" placeholder="Enter Actual Weight" name="actual_weight" class="form-control actual_weight" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $actual_weight?>" autofocus>
						</div>
						<div class="col-md-4 col-sm-4 ">
							<label  class="control-label">Documented Weight<span class="required">*</span></label>
							<input type="text" placeholder="Enter weight " name="doc_weight" class="form-control doc_weight" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $doc_weight?>" autofocus>
						</div>
						<div class="col-md-4 col-sm-4 ">
							<label  class="control-label">Diffrence Weight<span class="required">*</span></label>
							<input type="text" placeholder="diffrence weight " name="weight" class="form-control diff_weight" value="<?= $weight?>" readonly="readonly">
						</div>
					</div>
					<div class="row col-md-12">
				<!--		<div class="col-md-4 col-sm-4 ">
							<?php 
        						$yes='';
								$no='';
								
        						
        						if(!empty($sample_tested)) {
        							if($sample_tested=='Yes'){
        								$yes='checked';
        							}
									else{
										$no='checked';
									}
        						}

        						?>
						        <div class="col-md-12 col-sm-12 ">
						        	<label  class="control-label">Sample Checked<span class="required">*</span></label>
				        			<div class="form-check">
					               		<input class="form-check-input" type="radio" name="sample_tested" value="Yes" <?php echo $yes; ?>> Yes</input>
					               		&nbsp;&nbsp;&nbsp;&nbsp;
					               		<input class="form-check-input" type="radio" name="sample_tested" value="No" <?php echo $no; ?> > No</input>
				            		</div>
				            	</div>
							</div>-->
						<div class="col-md-4 col-sm-4 ">
							<?php 
        						$paid='';
								$to_pay='';
								
        						
        						if(!empty($payment)) {
        							if($payment=='Paid'){
        								$paid='checked';
        							}
									else
									{
										$to_pay='checked';
									}
        						}
        						?>
						        <div class="col-md-12 col-sm-12 ">
						        	<label  class="control-label">Payment<span class="required">*</span></label>
					        			<div class="form-check">
						               		<input class="form-check-input" type="radio" name="payment" value="Paid" <?php echo $paid; ?>> Paid</input>
						               		&nbsp;&nbsp;&nbsp;&nbsp;
						               		<input class="form-check-input" type="radio" name="payment" value="To Pay" <?php echo $to_pay; ?> > To Pay</input>
					            		</div>
					            	</div>
								</div>
					        </div>
				        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th style="width: 5%;">  Sr.No.</th>
			        					<th style="width: 30%;"> Product Name</th>
			        					<th style="width: 15%;"> QTY</th>
										<th style="width: 15%;"> Unit</th>
			        					<th style="width: 20%;"> Description</th>
			        					<th style="width: 10%;"> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 
			        				if(!empty($gir_details)){
			        					$i=1; foreach ($gir_details as $key => $gir_detail) { 
			        						//print_r ($gir_detail);
			        						?>
			        						<tr class="main_tr1">
												<td ><?= $i; ?></td>
												<td> 	
													<select name="products[]" class="form-control drop select2 " required >
										                <?php if ($items): ?> 
										                    <?php foreach ($items as $value) : ?>
										                        <?php if ($value['id'] == $gir_detail['item_id']): ?>
										                            <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
										                        <?php else: ?>
										                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
										                        <?php endif; ?>
										                    <?php endforeach; ?>
										                <?php else: ?>
										                    <option value="0">No result</option>
										                <?php endif; ?>
										            </select>

									   			</td>
												
												<td >
													<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty" 
													value="<?php echo $gir_detail['quantity']; ?>" autofocus >
												</td>
												<td >
													<select name="unit_id[]" class="form-control select2 units" required="required">
														 <option value="">Select Unit</option>
															<?php
															 if ($units): ?> 
															  <?php 
																foreach ($units as $value) : ?>
																   <?php if ($value['id'] == $gir_detail['unit_id']): ?>
																			<option value="<?= $value['id'] ?>"selected><?= $value['unit_name'] ?></option>
																 <?php else: ?>
										                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
										                        <?php endif; ?>
																<?php   endforeach;  ?>
															<?php else: ?>
																<option value="">No result</option>
															<?php endif; ?>
														</select>
												</td>
												<td >
													<textarea name="description[]" class="form-control description" type="textarea" placeholder="Enter description"  value="<?php echo $gir_detail['description']; ?>"><?php echo $gir_detail['description']; ?></textarea>
												</td>
												<td style="width:13%">
													<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
													<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
												</td>
											</tr>

			        				<?php $i++; } } ?>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b>Total</b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder="Total Qty" name="total_qty" class="form-control total_qty"  value="<?= $total_qty?>" readonly >
			        					</td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>

		         <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> Material Received Through <span class="required">*</span></label>
			            	
			            	<input type="text" placeholder=" Enter Source" name="material_received_from" class="form-control" style="height:100%;padding-top: 0px;" value="<?= $material_received_from?>" />
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> Comment</label>
			            	<input type="text" placeholder=" Enter comment" name="comments" class="form-control" style="height:100%;padding-top: 0px;" value="<?= $comments?>" />
			            </div>

		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> Grade</label>
			                <button type="submit" class="btn btn-primary btn-block"> Submit</button>
		        		</div>
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
			<td > 
				<select name="products[]" class="form-control drop" required>
					<option value=""> Select Item</option>
	                <?php if ($items): ?> 
	                    <?php foreach ($items as $value) : ?>
	                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
	                    <?php endforeach; ?>
	                <?php else: ?>
	                    <option value="0">No result</option>
	                <?php endif; ?>
	            </select>
   			</td>
   			<td>
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
			</td>
			<td >
        	 	<select name="unit_id[]" class="form-control units" required="required">
        		 <option value="">Select </option>
	                <?php
	                 if ($units): ?> 
	                  <?php 
	                    foreach ($units as $value) : ?>
	                      
		                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
	                    <?php   endforeach;  ?>
	                <?php else: ?>
	                    <option value="">No result</option>
	                <?php endif; ?>
	            </select>
			</td>
			<td>
				<textarea name="description[]" class="form-control description" type="textarea" placeholder="Enter description"></textarea>
			</td>
			<td style="width:13%">
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {

		$(document).on('keyup','.actual_weight,.doc_weight',function(){
			var actual_weight = $('.actual_weight').val();
			var doc_weight = $('.doc_weight').val();
			if(actual_weight>doc_weight){
				var diff_weight=actual_weight-doc_weight;
			}else{
				var diff_weight=doc_weight-actual_weight;
			}

			$('.diff_weight').val(diff_weight.toFixed(2));
			
	    });


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
			$(this).find("td:nth-child(2) select.drop").select2();

			//$(this).find("td:nth-child(3) select.select2").select2();
			/*$(this).find("td:nth-child(2).code").attr({name:"labour_rows["+i+"][code_description]", id:"labour_rows-"+i+"-code_description"});*/
			
		});
	}
		$(document).on('keyup','.qty',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
	   $(document).on('change','.discount_type',function(){
			var table=$(this).closest('table');
			calculate_total(table);
		}); 
		
	
		function calculate_total(table)
		{
			var total_qty=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				var qty=parseFloat($(this).find("td:nth-child(3) input.qty").val());
				//alert();
				if(isNaN(qty))
				{
					qty =0;
				}
				total_qty=total_qty+qty;
				/*$(this).find("td:nth-child(6) input.total").val(amount.toFixed(2));*/
				//alert(total_qty);
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
		}

	
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('change','.category',function(){
				var category_id = $('.category').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(category_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>"+category_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".suppliers").html(response);
	                    $('.select2').select2();
	                }
            	});
			}); 
	});
</script> 
