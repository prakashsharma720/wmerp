<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?> </h3> 
        <div class="pull-right" style="margin-top: -30px;">
        	<span style="background-color: #d45c5c;margin-top: -20px;"> &nbsp;&nbsp;&nbsp;&nbsp;</span> Stock Un-Available
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
		    	<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Issue_slips/add_new_issue">
		    <input type="hidden" name="requisition_id_old" value="<?= $req_id?>">
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Requisition Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="requisition_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?php if($requisition_date) { echo date('d-m-Y',strtotime($requisition_date)); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Issue Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y');  ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Issue Slip No <span class="required">*</span></label>
			            	<input type="text"  name="" class="form-control" value="<?= $issueslip_code ?>" autocomplete="off" autofocus  readonly="readonly">
			            	<input type="hidden" name="issue_slip_no" value="<?= $issue_slip_no ?>">
			            </div>
			             <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Issue To (Employee Name) </label>
				            	<?php echo form_dropdown('employee_id',$employees,$employee_id)?>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Employee Department</label>
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
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Requisition Slip No <span class="required">*</span></label>
			            	<input type="text"  name="" class="form-control" value="<?= $requisition_code ?>" autocomplete="off" autofocus  readonly="readonly">
			            <input type="hidden" name="requisition_slip_no" value="<?= $requisition_slip_no ?>">
				            </div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #dc7629;">
			        				<tr>
			        					<th style="width: 5%;">  Sr.No.</th>
			        					<th style="width: 30%;"> Material Description</th>
			        					<th style="width: 15%;white-space: nowrap;">Stock Available</th>
			        					<th style="width: 15%;white-space: nowrap;"> Required QTY</th>
			        					<th style="width: 15%;"> Issue QTY</th>
			        					<th style="width: 15%;"> Pending QTY</th>
			        					<!-- <th style="width: 20%;"> Description</th> -->
			        					<th style="width: 15%;"> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 
			        				$total_req_qty=0;
			        				if(!empty($requisition_details)){
			        					$i=1; foreach ($requisition_details as $key => $gir_detail) { 
			        						//print_r ($gir_detail);
			        						$total_req_qty=$total_req_qty+$gir_detail['pending_qty'];
			        						?>

			        						<?php if($gir_detail['stock_in']<=0) { ?>
			        							<tr class="main_tr1" style="background-color: #d45c5c;color:#fff;">
			        						<?php } else { ?>
			        							<tr class="main_tr1">
			        						<?php } ?>

												<td ><?= $i; ?></td>
												<td > 	
										            <span> <?= $gir_detail['item'].' ('.$gir_detail['item_code'].')'?></span>
										            <input type="hidden" name="item_id[]" value="<?= $gir_detail['item_id']?>">
										 			<input type="hidden" name="requisition_row_id[]" value="<?= $gir_detail['id']?>">
									   			</td>
									   			<td>
													<div class="input-group ">
				                  						<div class="input-group-prepend">
															<input class="form-control in_stock" type="text" name="instock[]" value="<?= $gir_detail['stock_in']?>" readonly>&nbsp;
															<span ><?= $gir_detail['unit']?></span>
														</div>
													</div>
												</td>
												<td>
													<div class="input-group ">
				                  						<div class="input-group-prepend">
															<input type="text"  name="required_qty[]" class="form-control required_qty"  value="<?php echo $gir_detail['pending_qty']; ?>"  autofocus readonly>&nbsp;
															<span ><?= $gir_detail['unit']?></span>
														</div>
													</div>
													
												</td>
												<td>
													<input type="text"  placeholder="Issue Qty" name="issue_qty[]" class="form-control qty"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" required autofocus >
												</td>
												<td >
													<input type="text"  placeholder="Pending" name="pending_qty[]" class="form-control pending_qty"  value="" autofocus required readonly>
												</td>
												<!-- <td>
										        	<select name="unit_id[]" class="form-control  units" required="required">
										        		 <option value="">Select</option>
											              <?php if ($units): ?> 
										                    <?php foreach ($units as $value) : ?>
										                        <?php if ($value['id'] == $gir_detail['unit_id']): ?>
										                            <option value="<?= $value['id'] ?>" selected><?= $value['unit_name'] ?></option>
										                        <?php else: ?>
										                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
										                        <?php endif; ?>
										                    <?php endforeach; ?>
										                <?php else: ?>
										                    <option value="0">No result</option>
										                <?php endif; ?>
											            </select>
													</td> -->	
												<!-- <td>
													<div class="form-group">
									                <textarea class="form-control description" rows="3" placeholder="Enter description" name="description[]" value=""></textarea>
									                 </div>
												</td> -->
												<td>
													<!-- <button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button>  -->
													<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
												</td>
											</tr>

			        				<?php $i++; } } ?>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="3" style="text-align: right;"><b>Total</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Qty" name="total_req_qty" class="form-control total_req_qty"  value="<?= $total_req_qty ?>" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Qty" name="total_issue_qty" class="form-control total_issue_qty"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Qty" name="total_pending_qty" class="form-control total_pending_qty"  value="" readonly >
			        					</td>
			        					<td colspan="2" style="text-align: right;"></td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>
		         <div class="form-group">
			        <div class="row col-md-12">
		        		<label  class="control-label"> Comment</label>
			    		<textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="comment" value=""></textarea>
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
			<td>1</td>
			<td> 
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
				<input type="text"  name="required_qty[]" class="form-control required_qty"  value="<?php echo $gir_detail['quantity']; ?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" autofocus >
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
			<!-- <td>
				<div class="form-group">
	                <textarea class="form-control description" rows="3" placeholder="Enter description" name="description[]" ></textarea>
	             </div>
			</td> -->
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
		//add_row();
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
			var pending_qty=0;
			var issue_qty=0;
			var in_stock=0;
			var required_qty=0;
			var total_qty=0;
			var req_total_qty=0;
			var total_pending_qty=0;
			table.find("tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				in_stock=parseFloat($(this).find("td:nth-child(3) input.in_stock").val());
				required_qty=parseFloat($(this).find("td:nth-child(4) input.required_qty").val());
				issue_qty=parseFloat($(this).find("td:nth-child(5) input.qty").val());
				//var pending_qty=parseFloat($(this).find("td:nth-child(5) input.pending_qty").val());
				//alert(in_stock);
				//alert(required_qty);
				//alert(issue_qty);
				if(isNaN(required_qty))
				{
					required_qty =0;
				}
				if(isNaN(issue_qty))
				{
					issue_qty =0;
				}
				if(isNaN(in_stock))
				{
					in_stock =0;
				}
				if(isNaN(pending_qty))
				{
					pending_qty =0;
				}
				req_total_qty=req_total_qty+required_qty;
				/* if(issue_qty == '0'){
						$(this).find("td:nth-child(5) input.qty").val('');
				    }
				    else
				    {*/

				    	if(issue_qty<=required_qty)
						{
							if(issue_qty<=in_stock){
								total_qty=total_qty+issue_qty;
								pending_qty=required_qty-issue_qty;
								total_pending_qty=total_pending_qty+pending_qty;
							$(this).find("td:nth-child(6) input.pending_qty").val(pending_qty.toFixed(2));
							}else{
								alert('You can not enter quantity greater than Stock Available');
								$(this).find("td:nth-child(5) input.qty").val('');
								//$(this).find("td:nth-child(5) input.pending_qty").val('');
								calculate_total(table);
							}
							
						}
						else 
						{
						alert('You can not enter quantity greater than requisition slip');
						$(this).find("td:nth-child(5) input.qty").val('');
						//$(this).find("td:nth-child(5) input.pending_qty").val('');
						calculate_total(table);
						}
				    //}
			
				
				/*}
				else
				{
					alert('Please enter value greater than 0');
					$(this).find("td:nth-child(5) input.qty").val('');
					//$(this).find("td:nth-child(5) input.pending_qty").val('');
					calculate_total(table);
				}*/
				
				
				/*$(this).find("td:nth-child(6) input.total").val(amount.toFixed(2));*/
				//alert(total_qty);
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_issue_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.total_req_qty").val(req_total_qty.toFixed(2));
			table.find("tfoot tr input.total_pending_qty").val(total_pending_qty.toFixed(2));
		}
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

		$("input[type='radio']").click(function(){
            var user_for = $("input[name='rs_for']:checked").val();
           // alert(user_for);
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
