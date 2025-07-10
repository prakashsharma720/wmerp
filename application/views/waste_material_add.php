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

      </div> 
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Waste_material_records/add_new_work">
				<input type="hidden" name="wm_code" value="<?= $wm_code?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date <span class="required">*</span></label>
			                <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
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
			            <div class="col-md-4 col-sm-4">
				            <label  class="control-label"> Total Waste Materials</label>
				    		<input type="text" class="form-control total_workers" name="total_waste_materials" value="1" readonly="readonly">
			    		</div>
		        	</div>
					<br>
				<div class="form-group">
		        	<div class="row col-md-12">
		        		<h5>Waste Material Detail</h5>
		        		<div class="table-responsive">
			        		<table id="maintable">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th >S.No.</th>
			        					<th style="white-space: nowrap;"> Material Description</th>
			        					<th style="white-space: nowrap;"> Party Name</th> 
			        					<th style="white-space: nowrap;"> Quantity</th>
			        					<th style="white-space: nowrap;"> Unit</th>
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			
			        			</tbody>
			        		<!--	<tfoot>
			        				<tr>
			        					<td colspan="3" style="text-align: right;"><b> Total Quantity </b></td>
			        					 <td colspan="">
			        						<input type="text"  placeholder="Total Quantity" name="total_qty" class="form-control total_qty"  value="" readonly >
			        					</td>  
			        				</tr>
			        			</tfoot>-->
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
				<input type="text"  placeholder="Waste Material Name" name="waste_material_name[]" class="form-control" style="width:450px;" />
				
				<!--<select name="waste_material_id[]" class="form-control products" style="width:320px;" required>
					<option value=""> Select Material</option>
		            <?php if ($materials): ?> 
		                <?php foreach ($materials as $value) : ?>
		            	<option value="<?= $value['id'] ?>"> 
		            	<?= $value['name'].' ('.$value['code'].')' ?></option>
			            <?php endforeach; ?>
			            <?php else: ?>
			                <option value="0">No result</option>
			            <?php endif; ?>
	        		</select>-->
   			</td>
   			<td> 
				<select name="service_provider_id[]" class="form-control suppliers" style="width:320px;" required>
					<option value=""> Select Service Provider</option>
		            <?php if ($suppliers): ?> 
		                <?php foreach ($suppliers as $value) : ?>
		            	<option value="<?= $value['id'] ?>"> 
		            	<?= $value['service_provider_name'] ?></option>
			            <?php endforeach; ?>
			            <?php else: ?>
			                <option value="0">No result</option>
			            <?php endif; ?>
	        		</select>
   			</td>
			<td>
				<input type="text"  placeholder="Quantity" name="quantity[]" class="form-control quantity" maxlength="5" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:180px;" >
			</td>
			<td>
			    <select name="unit[]" class="form-control " required="required" style="width:150px;">
	        		 <option value="">Select</option>
		                <?php
		                 if ($units): ?> 
		                  <?php 
		                    foreach ($units as $value) : ?>
		                      	<?php if ($value['unit_name'] == $po_data['unit_name']): ?>
			                            <option value="<?= $value['unit_name'] ?>" selected ><?= $value['unit_name'] ?></option>
			                            <?php else: ?>
			                            	<option value="<?= $value['unit_name'] ?>"  ><?= $value['unit_name'] ?></option>
			                           <?php endif; ?>

		                    <?php   endforeach;  ?>
		                <?php else: ?>
		                    <option value="">No result</option>
		                <?php endif; ?>
		            </select>
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
			var rowCount1 = $("#maintable tbody tr.main_tr1").length;
			//alert(rowCount1);
			$('.total_workers').val(rowCount1);
			//$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}
		/*$(document).on('keyup','.quantity',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
	

		function calculate_total(table)
		{
			var quantity=0;
			var total_quantity=0;
		
			table.find("tbody tr.main_tr1").each(function()
			{
				quantity=parseFloat($(this).find("td:nth-child(4) input.quantity").val());
				
				total_quantity=total_quantity+quantity;

				
			});
			table.find("tfoot tr input.total_qty").val(total_quantity.toFixed(2));
		}*/

	
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