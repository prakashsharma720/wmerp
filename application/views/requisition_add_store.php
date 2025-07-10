<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($requisitions);exit;
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/add_new_requisition">
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-3 col-sm-3 ">
			            	<label class="control-label">Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			             <div class="col-md-3 col-sm-3 ">
			            	<label  class="control-label"> Requisition No <span class="required">*</span></label>
			            	<input type="text"  placeholder=" Requisition Number" name="" class="form-control" value="<?= $requisition_code ?>" autocomplete="off" autofocus  readonly="readonly">
			            	<input type="hidden" name="requisition_slip_no" value="<?= $rs_code ?>">
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> Department</label>
				            	<select name="department_id" class="form-control select2 ">
									<option value=""> Select Department</option>
					                <?php
					                 if ($departments): ?> 
					                  <?php 
					                    foreach ($departments as $value) : ?>
					                        <?php 
												if ($value['id'] == $department_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['department_name'].' ('.$value['department_code'].')' ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['department_name'].' ('.$value['department_code'].')' ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </select>
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
			        					<th style="width: 30%;"> Material Description</th>
			        					<th style="width: 15%;"> QTY</th>
										<th style="width: 15%;"> Unit</th>
			        					<th style="width: 20%;"> Description</th>
			        					<th style="width: 15%;"> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 
			        				if(!empty($requisitions)){
			        					//echo 'hy';exit;
			        					$total_req_qty=0;
			        					 $i=1; foreach ($requisitions as $key => $po_detail) { 
			        						 foreach ($po_detail as $key1 => $po_data) { 
			        							$total_req_qty=$total_req_qty+$po_data['total'];
			        						//print_r ($po_data);
			        						//$total_rate_edit=$total_rate_edit+$po_detail['rate'];
			        						?>
			        						<tr class="main_tr1">
											<td ><?= $i; ?></td>
											<td> 	
												<select name="products[]" class="form-control drop select2 " required >
									                <?php if ($items): ?> 
									                    <?php foreach ($items as $value) : ?>
									                        <?php if ($value['id'] == $po_data['item_id']): ?>
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
											<td>
												<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  value="<?= $po_data['total'] ?>"  required='required'>
											</td>
											<td>
								        	 <select name="unit_id[]" class="form-control  units" required="required">
								        		 <option value="">Select</option>
									                <?php
									                 if ($units): ?> 
									                  <?php 
									                    foreach ($units as $value) : ?>
									                      	<?php if ($value['id'] == $po_data['unit_id']): ?>
										                            <option value="<?= $value['id'] ?>" selected ><?= $value['unit_name'] ?></option>
										                            <?php else: ?>
										                            	<option value="<?= $value['id'] ?>"  ><?= $value['unit_name'] ?></option>
										                           <?php endif; ?>

									                    <?php   endforeach;  ?>
									                <?php else: ?>
									                    <option value="">No result</option>
									                <?php endif; ?>
									            </select>
											</td>
											<td>
												<div class="form-group">
									                <textarea class="form-control description" rows="3" placeholder="Enter description" name="description[]" ></textarea>
									             </div>
											</td>
											<td >
												<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
												<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
											</td>
										</tr>
									<?php $i++; } } } else {  ?>
										<tr class="main_tr1">
											<td>1</td>
											<td> 
											<select name="products[]" class="form-control drop" required>
												<option value=""> Select Material </option>
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
												<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   required='required'>
											</td>
											<td>
								        	 <select name="unit_id[]" class="form-control  units" required="required">
								        		 <option value="">Select</option>
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
												<div class="form-group">
									                <textarea class="form-control description" rows="3" placeholder="Enter description" name="description[]" ></textarea>
									             </div>
											</td>
											<td >
												<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
												<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
											</td>
										</tr>
									</tbody>
									<tfoot>
									<tr>
								<?php } ?>
										
			        				</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b>Total</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Qty" name="total_qty" class="form-control total_qty"  readonly >
			        					</td>
			        					<td colspan="3" style="text-align: right;"></td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>
		        <div class="form-group">
			        <div class="row col-md-12">
		        		<label  class="control-label"> Comment</label>
			    		<textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="comment" ></textarea>
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
		    </form> 
		  </div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td>1</td>
			<td> 
			<select name="products[]" class="form-control drop" required>
				<option value=""> Select Material </option>
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
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   required='required'>
			</td>
			<td>
        	 <select name="unit_id[]" class="form-control  units" required="required">
        		 <option value="">Select</option>
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
				<div class="form-group">
	                <textarea class="form-control description" rows="3" placeholder="Enter description" name="description[]" ></textarea>
	             </div>
			</td>
			<td >
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="2" style="text-align: right;"><b>Total</b></td>
		<td colspan="2">
			<input type="text"  placeholder="Total Qty" name="total_qty" class="form-control total_qty"  readonly >
		</td>
	</tr>

	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		/*var acs='<?php echo $requisitions ?>'
		//alert(acs);
		if(acs==''){
			add_row();
		}	*/
		
	
		//$(this).find("td:nth-child(2) select.drop").select2();
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

		$("input[type='radio']").click(function(){
            var user_for = $("input[name='rs_for']:checked").val();
            //alert(user_for);
				if(user_for=='Consumable & Chemicals'){
					$(".for_chemicals").removeClass('hide');
					$(".for_raw_materials").addClass('hide');
					//$(".for_raw_materials").addClass('show');
					$('.purpose').attr('required', 'required');
					$('.equipment_name').attr('required', 'required');
					$('.product_name').removeAttr('required');
					$('.grade_name').removeAttr('required');
					$('.lot_no').removeAttr('required');
					$('.batch_no').removeAttr('required');
				}
				else if(user_for=='Packing Material'){
					$(".for_chemicals").addClass('hide');
					$(".for_raw_materials").addClass('show');
					$(".for_raw_materials").removeClass('hide');
					$('.product_name').attr('required', 'required');
					$('.grade_name').attr('required', 'required');
					$('.lot_no').attr('required', 'required');
					$('.batch_no').attr('required', 'required');
					$('.purpose').removeAttr('required');
					$('.equipment_name').removeAttr('required');
				}
				else {
					$(".for_chemicals").addClass('hide');
					$(".for_raw_materials").addClass('show');
					$(".for_raw_materials").removeClass('hide');
					$('.product_name').attr('required', 'required');
					$('.grade_name').attr('required', 'required');
					$('.lot_no').attr('required', 'required');
					$('.batch_no').attr('required', 'required');
					$('.purpose').removeAttr('required');
					$('.equipment_name').removeAttr('required');
				}
			});
	
	});
</script>
