<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($packing_sizes);
?>

<style type="text/css">
	th,td{
		padding: 10px;
		white-space:nowrap;
		text-transform: uppercase;
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Daily_tailing_records/edit_dtr">
				<input type="hidden" name="gtr_id_old" value="<?= $id?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date Of Tailing <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> DTR Number <span class="required">*</span></label>
			            	
			            	<input type="text" class="form-control" value="<?= $dtr_code_view ?>" autocomplete="off" autofocus readonly >
			            	<input type="hidden" name="dtr_code" value="<?= $dtr_code ?>">
			            </div>
			           <div class="col-md-4 col-sm-4 ">
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
			        <div class="row col-md-12 ">
		            	<div class="col-md-6 col-sm-6">
		            		<label  class="control-label"> Mill No <span class="required">*</span></label>
		            		<select name="mill_no" class="form-control" required="required">
								<option value=""> Select Mill No</option>
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
				                    <option value="0">No result</option>
				                <?php endif; ?>
				            </select>
		            	</div>
		            	<div class="col-md-6 col-sm-6">
				            <label  class="control-label"> Remarks</label>
				    		<textarea class="form-control " rows="2" placeholder="Enter Remarks here" name="remarks" value="<?= $remarks ?>"><?= $remarks ?></textarea>
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
			        					<th > Tailing Of Grade</th>
			        					<th > Lot No.</th>
			        					<th > Batch No.</th>
										<th > No of Bags</th> 
										<th > Weight of Bag (Kgs)</th> 
										<th > Tailing QTY</th> 
										<th > Total Tailing Qty For Lot</th> 
										<th > Gride Name</th> 
										<th > Re-used Grade Name</th> 
										<th > Re-used Qty</th> 
										<th > Balance Qty</th> 
										<th > Color</th> 
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			<?php 
			        				if(!empty($dsr_details)){
			        					$i=1; foreach ($dsr_details as $key => $pr_detail) { 
			        						//print_r ($pr_detail);
			        			?>
			        			<tr class="main_tr1">
									<td > <?= $i?></td>
									<td> 
										<select name="finish_good_id[]" class="form-control items" style="width:250px;" required>
												<option value=""> Select Grade</option>
									            <?php if ($items): ?> 
									                <?php foreach ($items as $value) : ?>
									                	<?php if ($value['id'] == $pr_detail['finish_good_id']): ?>
									                     <option value="<?= $value['id'] ?>" selected ><?= $value['grade_name'].' ('.$value['mineral_name'].')' ?></option>
									                        <?php else: ?>
									                     <option value="<?= $value['id'] ?>"><?= $value['grade_name'].' ('.$value['mineral_name'].')' ?></option>
									                    <?php endif; ?>
									                <?php endforeach; ?>
									            <?php else: ?>
									                <option value="0">No result</option>
									            <?php endif; ?>
									    </select>
										
						   			</td>
						   			<td>
										<input type="text"  placeholder="Enter Lot No" name="lot_no[]" class="form-control location_of_storage"  style="width: 150px;" autofocus  value="<?= $pr_detail['lot_no']?>">
									</td>
						   			<td>
										<input type="text"  placeholder="Enter Batch No" name="batch_no[]" class="form-control" value="<?= $pr_detail['batch_no']?>" autofocus style="width: 150px;" >
									</td>
									<td>
										<input type="text"  placeholder="No Of Bags" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $pr_detail['no_of_bags']?>" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Bag Weight" name="bag_weight[]" class="form-control bag_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $pr_detail['bag_weight']?>" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Tailing In MT" name="tailing_qty_in_mt[]" class="form-control tailing_qty_in_mt"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" value="<?= $pr_detail['tailing_qty_in_mt']?>" readonly="readonly">
									</td>
									<td>
										<input type="text"  placeholder="Total For Lot" name="total_tailing_for_lot[]" class="form-control total_tailing_for_lot"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:210px;" value="<?= $pr_detail['total_tailing_for_lot']?>" >
									</td>
									<td>
										<input type="text"  placeholder="Gride Name" name="location_of_storage[]" class="form-control location_of_storage"  autofocus style="width:150px;" value="<?= $pr_detail['location_of_storage']?>">
									</td>
									<td>
										<select name="reused_grade_id[]" class="form-control products" style="width:250px;" required>
										<option value=""> Select Grade</option>
									            <?php if ($items): ?> 
									                <?php foreach ($items as $value) : ?>
									                	<?php if ($value['id'] == $pr_detail['reused_grade_id']): ?>
									                     <option value="<?= $value['id'] ?>" selected ><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
									                        <?php else: ?>
									                     <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
									                    <?php endif; ?>
									                <?php endforeach; ?>
									            <?php else: ?>
									                <option value="0">No result</option>
									         <?php endif; ?>
							        </select>
									</td>
									<td>
										<input type="text"  placeholder="Used Qty" name="used_qty[]" class="form-control used_qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" value="<?= $pr_detail['used_qty']?>">
									</td>+
									<td>
										<input type="text"  placeholder="Balance Qty" name="balance_qty[]" class="form-control balance_qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" readonly="readonly" value="<?= $pr_detail['balance_qty']?>">
									</td>
									<td>
										<input type="text"  placeholder="Color" name="color[]" class="form-control color"  autofocus style="width:150px;" value="<?= $pr_detail['color']?>">
									</td>
									<td>
										<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
										<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
									</td>
								</tr>
			        			<?php  $i++; }} ?>
			        			</tbody>
			        			
			        			<!-- <tfoot>
			        				<tr>
			        					<td colspan="5" style="text-align: right;"><b> Total </b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Bags" name="total_bags" class="form-control total_bags"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Propduction" name="total_production_in_mt" class="form-control total_production_in_mt"  value="" readonly >
			        					</td>
			        				</tr>
			        			</tfoot> -->
			        		</table>
			            </div>
		        	</div>
		        </div>
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
			<select name="finish_good_id[]" class="form-control products" style="width:250px;" required>
				<option value=""> Select Grade</option>
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
				<input type="text"  placeholder="Enter Lot No" name="lot_no[]" class="form-control location_of_storage"  style="width: 150px;" autofocus  >
			</td>
   			<td>
				<input type="text"  placeholder="Enter Batch No" name="batch_no[]" class="form-control"  autofocus style="width: 150px;" >
			</td>
			<td>
				<input type="text"  placeholder="No Of Bags" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Bag Weight" name="bag_weight[]" class="form-control bag_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Tailing In MT" name="tailing_qty_in_mt[]" class="form-control tailing_qty_in_mt"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" readonly="readonly">
			</td>
			<td>
				<input type="text"  placeholder="Total For Lot" name="total_tailing_for_lot[]" class="form-control total_tailing_for_lot"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:210px;" >
			</td>
			<td>
				<input type="text"  placeholder="Gride Name" name="location_of_storage[]" class="form-control location_of_storage"  autofocus style="width:150px;" >
			</td>
			<td>
				<select name="reused_grade_id[]" class="form-control products" style="width:250px;" required>
				<option value=""> Select Grade</option>
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
				<input type="text"  placeholder="Used Qty" name="used_qty[]" class="form-control used_qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>+
			<td>
				<input type="text"  placeholder="Balance Qty" name="balance_qty[]" class="form-control balance_qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" readonly="readonly">
			</td>
			<td>
				<input type="text"  placeholder="Color" name="color[]" class="form-control color"  autofocus style="width:150px;" >
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>


<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

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
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}	
		$(document).on('keyup','.no_of_bags,.bag_weight,.used_qty,.balance_qty',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
	    /*$(document).on('blur','.lot_no',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });*/
	    function calculate_total(table)
		{
			var bag_weight=0;
			var no_of_bags=0;
			var tailing_qty_in_mt=0;
			var used_qty=0;
			var lot_no=0;
			var balance_qty=0;
			var total_production_in_mt=0;
			var total_balance_qty=0;
		
			table.find("tbody tr.main_tr1").each(function()
			{
				//packing_size = $(this).find('td:nth-child(5) select.packing_size option:selected').val();
				no_of_bags=parseFloat($(this).find("td:nth-child(5) input.no_of_bags").val());
				bag_weight=parseFloat($(this).find("td:nth-child(6) input.bag_weight").val());
				used_qty=parseFloat($(this).find("td:nth-child(11) input.used_qty").val());
				//lot_no=parseFloat($(this).find("td:nth-child(3) input.lot_no").val());
				
				
				//alert(no_of_bags);
				if(isNaN(bag_weight))
				{
					bag_weight =0;
				}
				if(isNaN(no_of_bags))
				{
					no_of_bags =0;
				}
				if(isNaN(tailing_qty_in_mt))
				{
					tailing_qty_in_mt =0;
				}
				if(isNaN(used_qty))
				{
					used_qty =0;
				}
				
				if(isNaN(balance_qty))
				{
					balance_qty =0;
				}
				tailing_qty_in_mt=bag_weight*no_of_bags/1000;
				balance_qty=tailing_qty_in_mt-used_qty;
				total_production_in_mt=total_production_in_mt+tailing_qty_in_mt;
				total_balance_qty=total_balance_qty+balance_qty;
				
		/*		if(lot_no !=''){

					$.ajax({
	                type: "POST",
	                url:"<?php //echo base_url('index.php/Daily_tailing_records/getTotalQtyForLot/') ?>"+lot_no,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	alert(response);
	                	if(response !=''){
	                		var total_lot=response+tailing_qty_in_mt;
	                	}else{
	                		var total_lot=tailing_qty_in_mt;
	                	}
	                   $(this).find("td:nth-child(8) input.total_tailing_for_lot").val(total_lot.toFixed(2));
	                }
            		});
				}
		*/
				$(this).find("td:nth-child(7) input.tailing_qty_in_mt").val(tailing_qty_in_mt.toFixed(3));
				$(this).find("td:nth-child(12) input.balance_qty").val(balance_qty.toFixed(2));
				tailing_qty_in_mt=parseFloat($(this).find("td:nth-child(7) input.tailing_qty_in_mt").val());

				/*if((kwh_closing!='') && (kwh_opening!='')){
					
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
					$(this).find("td:nth-child(11) input.unit_per_mt").val(unit_per_mt.toFixed(2));
				}*/
			});
			//$('.total_production_in_mt').val(total_production_in_mt.toFixed(2));
			//alert(total_qty);
			/*table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));*/


		}
		

	});
</script>
