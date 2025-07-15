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
			
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Production_registers/add_new_production">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> <?=$this ->lang ->line('date_of_production')?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_production" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?=$this ->lang ->line('pr_number')?> <span class="required">*</span></label>
			            	
			            	<input type="text" class="form-control" value="<?= $pr_number_view ?>" autocomplete="off" autofocus readonly >
			            	<input type="hidden" name="pr_number" value="<?= $pr_number ?>">
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
			        <div class="row col-md-12 ">
		            	<div class="col-md-6 col-sm-6">
		            		 <label  class="control-label"> <?=$this ->lang ->line('select_mill_no')?> <span class="required">*</span></label>
		            		<select name="mill_no" class="form-control" required="required">
								<option value=""> <?=$this ->lang ->line('select_mill')?></option>
				                <?php
				                 if ($equipments): ?> 
				                  <?php 
				                    foreach ($equipments as $value) : ?>
				                        <?php 
											if ($value == $mill_no): ?>
					                            <option value="<?= $value ?>" selected><?= $value ?></option>
					                        <?php else: ?>
					                            <option value="<?= $value ?>"><?= $value ?></option>
					                        <?php endif;   ?>
				                    <?php   endforeach;  ?>
				                <?php else: ?>
				                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
				                <?php endif; ?>
				            </select>
		            	</div>
		            	<div class="col-md-6 col-sm-6">
				            <label  class="control-label"> <?=$this ->lang ->line('remarks')?></label>
				    		<textarea class="form-control " rows="2" placeholder="<?=$this ->lang ->line('enter_remarks_here')?>" name="remarks" ></textarea>
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
			        					<th > <?=$this ->lang ->line('finish_good')?> </th>
			        					<th style="white-space: nowrap;"> <?=$this ->lang ->line('lot_no')?>.</th>
			        					<th style="white-space: nowrap;"> <?=$this ->lang ->line('batch_no')?>.</th>
										<th > <?=$this ->lang ->line('packing_size')?></th> 
										<th > <?=$this ->lang ->line('no_of_bags')?></th> 
										<th > <?=$this ->lang ->line('production_in_mt')?></th>
										<th > <?=$this ->lang ->line('kwh_opening')?> </th>
										<th > <?=$this ->lang ->line('kwh_closing')?>g </th>
										<th > <?=$this ->lang ->line('kwh_consumed')?> </th>
										<th > <?=$this ->lang ->line('unit_per_mt')?> </th>
			        					<th style="white-space: nowrap;"> <?=$this ->lang ->line('action_button')?></th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			
			        			</tbody>
			        			
			        			<!-- <tfoot>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> SELECT TAX </b></td>
			        					<td colspan="">
			        						<?php 
			        						$igst_checked='';
			        						$other_checked='';
			        						if(!empty($type_of_tax)) {
			        							if($discount_type=='IGST'){
			        								$igst_checked='checked';
			        							}else{
			        								$other_checked='checked';
			        							}

			        						}else{
			        							$other_checked='checked';
			        						}
			        						?>
			        						<input class="type_of_tax" type="radio" name="type_of_tax" value="IGST"  > IGST</input>
			        						&nbsp;&nbsp;&nbsp;&nbsp;
							                <input class="type_of_tax" type="radio" name="type_of_tax" value="Other"  <?= $other_checked ?> > Other</input>
			        					</td>
			        					 <td colspan="">
			        						<input type="text"  placeholder="Total Rate" name="total_rate" class="form-control total_rate"  value="" readonly >
			        					</td>  
			        					<td colspan="2">
			        						<input type="text"  placeholder="Taxable Amount" name="total_amount" class="form-control total_amount"  value="" readonly >
			        					</td>
			        				</tr>
			        				<tr class="igst_row hide">
			        					<td colspan="6" style="text-align: right;"><b> IGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter IGST %" name="tax_per_igst" class="form-control tax_per_igst"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" autofocus >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="IGST Amount" name="igst_amount" class="form-control igst_amount"  readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_igst" class="form-control grand_total_after_igst"  readonly >
			        					</td>
			        				</tr>
			        				<tr class="cgst_row">
			        					<td colspan="6" style="text-align: right;"><b> CGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter CGST %" name="tax_per_cgst" class="form-control tax_per_cgst"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" autofocus >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="CGST Amount" name="cgst_amount" class="form-control cgst_amount"  readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_cgst" class="form-control grand_total_after_cgst"  readonly >
			        					</td>
			        				</tr>
			        				<tr class="sgst_row">
			        					<td colspan="6" style="text-align: right;"><b> SGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter SGST %" name="tax_per_sgst" class="form-control tax_per_sgst" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" autofocus >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="SGST Amount" name="sgst_amount" class="form-control sgst_amount"  readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_sgst" class="form-control grand_total_after_sgst"  readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> GRAND TOTAL </b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder=" Grand Total" name="final_total_amount" class="form-control final_total_amount"  autofocus readonly >
			        					</td>
			        				</tr>

			        			</tfoot> -->
			        		</table>
			        		<input type="hidden" class="total_production_in_mt" name="total_production_in_mt" value="">
			            </div>
		        	</div>
		        </div>
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label>
			                <button type="submit" class="btn btn-primary btn-block"> <?=$this ->lang ->line('submit')?></button>
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
	                       <!--  <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
	                        <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
	                <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0">No result</option>
	            <?php endif; ?>
	        </select>
				
   			</td>
   			<td>
				<input type="text"  placeholder="Enter Lot No" name="lot_no[]" class="form-control"  style="width: 150px;" autofocus  >
			</td>
   			<td>
				<input type="text"  placeholder="Enter Batch No" name="batch_no[]" class="form-control"  autofocus style="width: 150px;" >
			</td>
			<<td>
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
				<input type="text"  placeholder="Production In MT" name="production_in_mt[]" class="form-control production_in_mt"  autofocus  style="width:150px;" readonly >
			</td>
			<td >
				<input type="text"  placeholder="KWH Opening" name="kwh_opening[]" class="form-control kwh_opening"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td >
				<input type="text"  placeholder="KWH Closing" name="kwh_closing[]" class="form-control kwh_closing"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Total KWH" name="kwh_consumed[]" class="form-control kwh_consumed"  autofocus style="width:150px;" readonly >
			</td>
			<td>
				<input type="text"  placeholder="Unit/MT" name="unit_per_mt[]" class="form-control unit_per_mt"  autofocus style="width:150px;" readonly >
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
		add_row();
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
			//$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}
		$(document).on('keyup','.no_of_bags,.production_in_mt',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
		$(document).on('change','.packing_size',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });

	    $(document).on('blur','.kwh_opening,.kwh_closing',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });


		function calculate_total(table)
		{
			var packing_size=0;
			var no_of_bags=0;
			var production_in_mt=0;
			var kwh_opening=0;
			var kwh_closing=0;
			var kwh_consumed=0;
			var unit_per_mt=0;
			var total_production_in_mt=0;
		
			table.find("tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
					/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				packing_size = $(this).find('td:nth-child(5) select.packing_size option:selected').val();
				no_of_bags=parseFloat($(this).find("td:nth-child(6) input.no_of_bags").val());
				kwh_opening=parseFloat($(this).find("td:nth-child(8) input.kwh_opening").val());
				kwh_closing=parseFloat($(this).find("td:nth-child(9) input.kwh_closing").val());
				//var qty=parseFloat($(this).find("td:nth-child(7) input.qty").val());
				//alert(no_of_bags);
				if(isNaN(packing_size))
				{
					packing_size =0;
				}
				if(isNaN(no_of_bags))
				{
					no_of_bags =0;
				}
				if(isNaN(production_in_mt))
				{
					production_in_mt =0;
				}
				if(isNaN(kwh_consumed))
				{
					kwh_consumed =0;
				}
				if(isNaN(unit_per_mt))
				{
					unit_per_mt =0;
				}
				if(isNaN(kwh_opening))
				{
					kwh_opening =0;
				}
				if(isNaN(kwh_closing))
				{
					kwh_closing =0;
				}
				production_in_mt=packing_size*no_of_bags/1000;
				total_production_in_mt=total_production_in_mt+production_in_mt;
				$(this).find("td:nth-child(7) input.production_in_mt").val(production_in_mt.toFixed(4));
				production_in_mt=parseFloat($(this).find("td:nth-child(7) input.production_in_mt").val());

				if((kwh_closing!='') && (kwh_opening!='')){
					
					if(kwh_closing>=kwh_opening){
						kwh_consumed=kwh_closing-kwh_opening;
					}
					else
					{
						alert('You can not enter KWH Closing Value less than KWH Opening');
						$(this).find("td:nth-child(9) input.kwh_closing").val('');
					}
					unit_per_mt=kwh_consumed/production_in_mt;
					$(this).find("td:nth-child(10) input.kwh_consumed").val(kwh_consumed.toFixed(2));
					$(this).find("td:nth-child(11) input.unit_per_mt").val(unit_per_mt.toFixed(4));
				}
			});
			$('.total_production_in_mt').val(total_production_in_mt.toFixed(4));
			//alert(total_qty);
			/*table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));*/


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
		                    $(".gst_no").html(response);
		                    //$('.select2').select2();
		                }
	            	});
				}else{
					$(".clear_gst").val('');
				}
				

			}); 
	});
</script> 