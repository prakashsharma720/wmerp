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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/add_new_requisition">
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('date')?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			             <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?=$this ->lang ->line('requistion_no')?> <span class="required">*</span></label>
			            	<input type="text"  placeholder=" <?=$this ->lang ->line('requistion_no')?>" name="" class="form-control" value="<?= $requisition_code ?>" autocomplete="off" autofocus  readonly="readonly">
			            	<input type="hidden" name="requisition_slip_no" value="<?= $rs_code ?>">
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?=$this ->lang ->line('department')?></label>
				            	<select name="department_id" class="form-control select2 ">
									<option value=""> <?=$this ->lang ->line('select_department')?></option>
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
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
			            </div>

		        	</div>
		        </div>
		        
		        <div class="form-group">
			        <div class="row col-md-12">
			        	<div class="col-md-3 col-sm-3 ">
					        <label  class="control-label"> <?=$this ->lang ->line('requistion_for')?> : </label>
					    </div>
				        <div class="col-md-9 col-sm-9 ">
				        	<select name="rs_for" class="form-control select2 rs_for" required="required">
								<option value=""> <?=$this ->lang ->line('select_option')?></option>
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                    	<?php 
												if ($value['category_name'] == 'Raw Material'): ?>
						                          <option value="<?= $value['category_name'] ?>" selected><?= $value['category_name'] ?></option>
						                         <?php else: ?>
						                           <option value="<?= $value['category_name'] ?>"><?= $value['category_name'] ?></option>
						                            <?php endif; ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>

		        			<!-- <div class="form-check">
			               	<input class="form-check-input user_for" type="radio" name="rs_for" value="Raw Material" checked> Raw Material</input>
			               		&nbsp;&nbsp;&nbsp;&nbsp;
			               		<input class="form-check-input user_for" type="radio" name="rs_for" value="Packing Material" > Packing Material</input>
			               		&nbsp;&nbsp;&nbsp;&nbsp;
			               	<input class="form-check-input user_for" type="radio" name="rs_for" value="Consumable & Chemicals"> For Consumable & Chemicals </input>
		            	</div> -->
					</div>
				</div>
				<br>
				<div class="form-group for_raw_materials">
			        <div class="row col-md-12">
			        	<div class="col-md-6 col-sm-6 ">
								<label  class="control-label"> <?=$this ->lang ->line('product')?> <span class="required">*</span></label>
								<select name="finish_good" class="form-control select2 product_name" required="required">
									<option value=""> <?=$this ->lang ->line('select_mineral_name')?></option>
					                <?php
					                 if ($fg_minerals): ?> 
					                  <?php 
					                    foreach ($fg_minerals as $value) : ?>
					                        <?php 
												if ($value['id'] == $current[0]->categories_id): ?>
						                           <!--  <option value="<?= $value['id'] ?>" selected>
						                            	<?= $value['mineral_name'].' ('.$value['grade_name'].')'.' ('.$value['fg_code'].')' ?>
						                            	</option> -->
						                            	<option value="<?= $value['id'] ?>" selected>
						                            	<?= $value['mineral_name'] ?>
						                            	</option>
						                        <?php else: ?>
						                            	 <option value="<?= $value['id'] ?>"><?= $value['mineral_name'] ?></option>
						                            </option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
							</div>
							<div class="col-md-6 col-sm-6 ">
								<label  class="control-label"> <?=$this ->lang ->line('grade')?> <span class="required">*</span></label>
								<select name="finish_good_id" class="form-control select2 grade_name" required="required">
									<option value=""> <?=$this ->lang ->line('select_finish_grade')?></option>
					                <?php
					                 if ($fg_grades): ?> 
					                  <?php 
					                    foreach ($fg_grades as $value) : ?>
					                        <?php 
												if ($value['id'] == $current[0]->categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['grade_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['grade_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
							</div>
			        </div>
			        <div class="row col-md-12">
			        	<div class="col-md-6 col-sm-6 ">
								<label  class="control-label"> <?=$this ->lang ->line('lot_no')?>. <span class="required">*</span></label>
								<input type="text" placeholder="Enter Lot no " name="lot_no" class="form-control lot_no" required="required" value="" autofocus>
							</div>
							<div class="col-md-6 col-sm-6 ">
								<label  class="control-label"> <?=$this ->lang ->line('batch_no')?> <span class="required">*</span></label>
								<input type="text" placeholder="Enter batch no " name="batch_no" class="form-control batch_no" required="required" value="" autofocus>
							</div>
			        </div>
			        <div class="row col-md-12 raw_mesg">
			        	<div class="col-md-12 col-sm-12 ">
			        	    <h4 style="color:red;"><?=$this ->lang ->line('quantity_note')?> .</h4>
			        	</div>
			        </div>
			    </div>

			    <div class="form-group for_chemicals hide">
			        <div class="row col-md-12">

							<div class="col-md-6 col-sm-6">
								<label  class="control-label"> <?=$this ->lang ->line('equipment_name')?> <span class="required">*</span></label>
								<select name="equipment_name" class="form-control select2 equipment_name">
									<option value=""> <?=$this ->lang ->line('select_equipment')?></option>
					                <?php
					                 if ($equipments): ?> 
					                  <?php 
					                    foreach ($equipments as $value) : ?>
						                    <option value="<?= $value ?>"><?= $value ?></option>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
							</div>
							<div class="col-md-6 col-sm-6">
			        	 		<label  class="control-label"> <?=$this ->lang ->line('purpose')?> <span class="required">*</span></label>
				            	<textarea class="form-control purpose" rows="2" placeholder="<?=$this ->lang ->line('enter_purpose_here')?>" name="purpose" ></textarea>
				            </div>
			        </div>
			    </div>

		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th style="width: 5%;">  <?=$this ->lang ->line('sr_no')?>.</th>
			        					<th style="width: 30%;"> <?=$this ->lang ->line('material_description')?>n</th>
			        					<th style="width: 15%;"> <?=$this ->lang ->line('qty')?></th>
										<th style="width: 15%;"> <?=$this ->lang ->line('unit')?></th>
			        					<th style="width: 20%;"> <?=$this ->lang ->line('description')?></th>
			        					<th style="width: 15%;"><?=$this ->lang ->line('action')?></th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<tr class="main_tr1">
										<td>1</td>
										<td> 
										<select name="products[]" class="form-control select2" required>
											<option value=""> <?=$this ->lang ->line('select_material')?> </option>
								            <?php if ($items): ?> 
								                <?php foreach ($items as $value) : ?>
								                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
								                <?php endforeach; ?>
								            <?php else: ?>
								                <option value="0"><?=$this ->lang ->line('no_result')?></option>
								            <?php endif; ?>
								        </select>

											</td>
										
										<td>
											<input type="text"  placeholder="<?=$this ->lang ->line('enter_qty')?>" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   required='required'>
										</td>
										<td>
							        	 <select name="unit_id[]" class="form-control  units" required="required">
							        		 <option value=""><?=$this ->lang ->line('select')?></option>
								                <?php
								                 if ($units): ?> 
								                  <?php 
								                    foreach ($units as $value) : ?>
								                      
									                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
								                    <?php   endforeach;  ?>
								                <?php else: ?>
								                    <option value=""><?=$this ->lang ->line('no_result')?></option>
								                <?php endif; ?>
								            </select>
										</td>
										<td>
											<div class="form-group">
								                <textarea class="form-control description" rows="3" placeholder="<?=$this ->lang ->line('enter_description')?>" name="description[]" ></textarea>
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
			        					<td colspan="2" style="text-align: right;"><b><?=$this ->lang ->line('total')?></b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="<?=$this ->lang ->line('total_qty')?>" name="total_qty" class="form-control total_qty"  readonly >
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
		        		<label  class="control-label"> <?=$this ->lang ->line('comment')?></label>
			    		<textarea class="form-control Comment" rows="2" placeholder="<?=$this ->lang ->line('enter_comment_here')?>" name="comment" ></textarea>
			    	</div>
			    </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"><?=$this ->lang ->line('grade')?></label>
			                <button type="submit" class="btn btn-primary btn-block"> <?=$this ->lang ->line('submit')?></button>
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
				<option value=""> <?=$this ->lang ->line('select_material')?> </option>
	            <?php if ($items): ?> 
	                <?php foreach ($items as $value) : ?>
	                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
	                <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0"><?=$this ->lang ->line('no_result')?></option>
	            <?php endif; ?>
	        </select>

				</td>
			
			<td>
				<input type="text"  placeholder="<?=$this ->lang ->line('enter_qty')?>" name="qty[]" class="form-control qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   required='required'>
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
	                    <option value=""><?=$this ->lang ->line('no_result')?></option>
	                <?php endif; ?>
	            </select>
			</td>
			<td>
				<div class="form-group">
	                <textarea class="form-control description" rows="3" placeholder="<?=$this ->lang ->line('enter_description')?>" name="description[]" ></textarea>
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
		<td colspan="2" style="text-align: right;"><b><?=$this ->lang ->line('total')?></b></td>
		<td colspan="2">
			<input type="text"  placeholder="<?=$this ->lang ->line('total_qty')?>" name="total_qty" class="form-control total_qty"  readonly >
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
		//var id=$(".rs_for option:selected").val();
		$(document).on('change','.rs_for',function(){
				var rs_for = $('.rs_for').find('option:selected').val();
				//alert(rs_for);
				if(rs_for=='Raw Material'){
					$(".for_chemicals").addClass('hide');
					$(".for_raw_materials").addClass('show');
					$(".raw_mesg").addClass('show');
					$(".raw_mesg").removeClass('hide');
					$(".for_raw_materials").removeClass('hide');
					$('.product_name').attr('required', 'required');
					$('.grade_name').attr('required', 'required');
					$('.lot_no').attr('required', 'required');
					$('.batch_no').attr('required', 'required');
					$('.purpose').removeAttr('required');
					$('.equipment_name').removeAttr('required');

				}
				else if(rs_for=='Packing Material'){
					$(".for_chemicals").addClass('hide');
					$(".raw_mesg").addClass('hide');
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
					$(".for_chemicals").removeClass('hide');
					$(".raw_mesg").addClass('hide');
					$(".for_raw_materials").addClass('hide');
					//$(".for_raw_materials").addClass('show');
					$('.purpose').attr('required', 'required');
					//$('.equipment_name').attr('required', 'required');
					$('.product_name').removeAttr('required');
					$('.grade_name').removeAttr('required');
					$('.lot_no').removeAttr('required');
					$('.batch_no').removeAttr('required');
				}
			});
		
		

		/*$("input[type='select']").click(function(){
            var user_for = $("input[name='rs_for']:option selected").val();
            //alert(user_for);
				if(user_for=='Consumable & Chemicals'){
					$(".for_chemicals").removeClass('hide');
					$(".raw_mesg").addClass('hide');
					$(".for_raw_materials").addClass('hide');
					//$(".for_raw_materials").addClass('show');
					$('.purpose').attr('required', 'required');
					//$('.equipment_name').attr('required', 'required');
					$('.product_name').removeAttr('required');
					$('.grade_name').removeAttr('required');
					$('.lot_no').removeAttr('required');
					$('.batch_no').removeAttr('required');
				}
				else if(user_for=='Packing Material'){
					$(".for_chemicals").addClass('hide');
					$(".raw_mesg").addClass('hide');
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
					$(".raw_mesg").addClass('show');
					$(".raw_mesg").removeClass('hide');
					$(".for_raw_materials").removeClass('hide');
					$('.product_name').attr('required', 'required');
					$('.grade_name').attr('required', 'required');
					$('.lot_no').attr('required', 'required');
					$('.batch_no').attr('required', 'required');
					$('.purpose').removeAttr('required');
					$('.equipment_name').removeAttr('required');
				}
			});*/
	
	});
</script>
