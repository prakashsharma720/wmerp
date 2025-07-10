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
		    <form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Material_return_records/add_new_gir/">
		        <div class="form-group">
		        	<div class="row ">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"	value="" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Material Return Code <span class="required">*</span></label>
			             	<input type="text"  name="g_no" class="form-control" value="<?= $voucher_code_view?>"  autofocus readonly="readonly">
		                 	<input type="hidden" name="gir_no" value="<?php echo $voucher_code;?>">
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label">Gate Pass No <span class="required">*</span></label>
			            	<input type="text"  placeholder=" Enter Gate Pass No" name="gate_pass_no" class="form-control" value=""  required="required">
			            </div>
		        	</div>
		        	<div class="row ">
		        	 	<div class="col-md-4 col-sm-4 ">
							<label class="control-label"> Category</label>
			            	 <select name="categories_id" class="form-control select2 category" required="required">
			            	 	<option value=""> Select Category</option>
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
												if ($value['id'] == @$categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="">No result</option>
					                <?php endif; ?>
					            </select> 
			            </div>
			           	<div class="col-md-4 col-sm-4 ">
			            	 <label  class="control-label">Name of supplier <span class="required">*</span></label>
			            	<select name="supplier_id" class="form-control select2 suppliers" required="required">
			            		<option value=""> Select Supplier</option>
						        <?php
						         if ($suppliers): ?> 
						          <?php 
						            foreach ($suppliers as $value) : ?>
						                <?php 
											if ($value['id'] == @$supplier_id): ?>
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
			            	<label class="control-label"> Tentative Date Of Return <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="return_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"	value="" autofocus required >
			            </div>
						
					</div>
					
		        	<div class="row ">
		        		<div class="col-md-12 ">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th style="width: 5%;">  Sr.No.</th>
			        					<th style="width: 30%;"> Material Description</th>
			        					<th style="width: 15%;"> Unit </th>
			        					<th style="width: 15%;"> Out QTY</th>
			        					<th style="width: 20%;"> Description</th>
			        					<th style="width: 10%;"> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<tr class="main_tr1">
										<td >1</td>
										<td> 
											<select name="item_id[]" class="form-control select2" required>
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
								        	<select name="unit_id[]" class="form-control select2 units" required="required">
							        		 	<option value="">Select Unit</option>
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
							   			<td >
											<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>

												<input type="hidden" name="status[]" value="Out">
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
			        			<tfoot>
			        				<tr>
			        					<td colspan="3" style="text-align: right;"><b>Total</b></td>
			        					
			        					<td>
			        						<input type="text"  placeholder="Total Qty" name="total_qty" class="form-control total_qty"  value="" readonly >
			        					</td>
			        					<td colspan="2"></td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>
		        <div class="row ">
		        		<div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label"> Purpose</label>
			            	<input type="text" placeholder=" Enter Purpose" name="comments" class="form-control" style="height:100%;padding-top: 0px;" value="" />
			        	</div>
		        	</div>
		    </div>
	        <div class="form-group">
	        	<div class="row ">
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
			<td >2</td>
			<td> 
				<select name="item_id[]" class="form-control drop" required>
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
	        	<select name="unit_id[]" class="form-control  units" required="required">
        		 	<option value="">Select Unit</option>
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
   			<td >
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
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
			//rename_rows();
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
			$(this).find("td:nth-child(3) select.units").select2();

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
			var qty=0;
			var total_qty=0;
			var total_gir_qty=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				qty=parseFloat($(this).find("td:nth-child(4) input.qty").val());
				//alert();
				if(isNaN(qty))
				{
					qty =0;
				}
				total_qty=total_qty+qty;
				$(this).find("td:nth-child(5) input.qty").val(total_qty.toFixed(2));
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
