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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Production_registers/add_new_opening">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date Of Production <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_production" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			        </div>
					<br>
				<div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table id="maintable">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th> S.No.</th>
			        					<th style="white-space: nowrap;"> Finsh Good </th>
			        					<th style="white-space: nowrap;"> Lot No.</th>
			        					<th style="white-space: nowrap;"> Batch No.</th>
										<th > Packing Size</th> 
										<th > No Of Bags</th> 
										<th > Production In MT</th>
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
									<tr class="main_tr1">
										<td>1</td> 											
										<td> 											
										<select name="finish_good_id[]" class="form-control products" style="width:350px;" required>
										<option value=""> Select Item</option>
								            <?php if ($items): ?> 
								                <?php foreach ($items as $value) : ?>
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
											<input type="text"  placeholder="Production In MT" name="production_in_mt[]" class="form-control production_in_mt"  autofocus  style="width:150px;" readonly >
										</td>
										
										<td>
											<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
											<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
										</td>	
									</tr>
									 
			        			</tbody>
			     
			        		</table>
			        		<input type="hidden" class="total_production_in_mt" name="total_production_in_mt" value="">
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
			
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow1" href="#" role='button'><i class="fa fa-minus"></i></button>
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
			//alert();
		var table=$(this).closest('table');
		var rowCount = $("#maintable tbody tr.main_tr1").length;
		if (rowCount>1){
			if (confirm("Are you sure to remove row ?") == true) {
				$(this).closest("tr").remove();
				rename_rows();
				//calculate_total(table);
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
				
				if(isNaN(unit_per_mt))
				{
					unit_per_mt =0;
				}
				
				production_in_mt=packing_size*no_of_bags/1000;
				total_production_in_mt=total_production_in_mt+production_in_mt;
				$(this).find("td:nth-child(7) input.production_in_mt").val(production_in_mt.toFixed(4));
				production_in_mt=parseFloat($(this).find("td:nth-child(7) input.production_in_mt").val());

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