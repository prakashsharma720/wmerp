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
	    		<?php if(!empty($id)) { ?>
		    		<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/edit_ER/<?= $id ?>">
		    			<input type="hidden" name="gir_id_old" value="<?= $id?>">
		    			<?php } else { ?>
					<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/add_new_ER">
			    <?php } ?>
			    
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label">Name of Supplier <span class="required">*</span></label>
			            	 <?php  
			            		echo form_dropdown('supplier_id', $suppliers,$supplier_id)
			            	?>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label">Invoice/Challan No <span class="required">*</span></label>
			            	
			            	<input type="text"  placeholder=" Enter Invoice/Challan No" name="challan_no" class="form-control" value="<?= $challan_no?>" autofocus  >
			            </div>

		        	</div>
		        </div>
		        
		        <br></br>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #b0acb7;">
			        				<tr>
			        					<th> Sr.No.</th>
			        					<th> Product Name</th>
			        					<th> QTY</th>
			        					<th> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 
			        				if(!empty($er_details)){
			        					$i=1; foreach ($er_details as $key => $gir_detail) { 
			        						//print_r ($gir_detail);
			        						?>
			        						<tr class="main_tr1">
												<td style="width:10%"><?= $i; ?></td>
												<td style="width:60%"> 	
													<select name="products[]" class="form-control drop select2 " required >
										                <?php if ($items): ?> 
										                    <?php foreach ($items as $value) : ?>
										                        <?php if ($value['id'] == $gir_detail['item_id']): ?>
										                            <option value="<?= $value['id'] ?>" selected><?= $value['item_name'] ?></option>
										                        <?php else: ?>
										                            <option value="<?= $value['id'] ?>"><?= $value['item_name'] ?></option>
										                        <?php endif; ?>
										                    <?php endforeach; ?>
										                <?php else: ?>
										                    <option value="0">No result</option>
										                <?php endif; ?>
										            </select>

									   			</td>
												
												<td style="width:20%">
													<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  value="<?php echo $gir_detail['quantity']; ?>" autofocus >
												</td>
												<td style="width:10%">
													<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
													<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
												</td>
											</tr>

			        				<?php $i++; } } else { ?>
			        					<tr class="main_tr1">
											<td style="width:10%">1</td>
											<td style="width:60%"> 
											<select name="products[]" class="form-control select2 drop" required>
												<option value=""> Select Item</option>
								                <?php if ($items): ?> 
								                    <?php foreach ($items as $value) : ?>
								                            <option value="<?= $value['id'] ?>"><?= $value['item_name'] ?></option>
								                    <?php endforeach; ?>
								                <?php else: ?>
								                    <option value="0">No result</option>
								                <?php endif; ?>
								            </select>
						
								   			</td>
											
											<td style="width:20%">
												<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus required>
											</td>
											
											<td style="width:10%">
												<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
												<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
											</td>
										</tr>
									<?php } ?>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b>Total</b></td>
			        					<td colspan="2">
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
			           <!--  <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PO Number <span class="required">*</span></label>
			            	<input type="text"  placeholder=" Enter Invoice/Challan No" name="challan_no" class="form-control"  autofocus  value="<?= $challan_no?>" required="required">
			            </div>  -->
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> Material Received Through <span class="required">*</span></label>
			            	
			            	<input type="text" placeholder=" Enter Source" name="material_received_from" class="form-control" style="height:100%;padding-top: 0px;" value="<?= $material_received_from?>" />
			            	<!-- <input type="text"  placeholder=" Enter source here" name="material_received_from" class="form-control"  autofocus  value="<?= $material_received_from?>" required="required"> -->
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
			                <button type="submit" class="btn btn-primary btn-block"> Submits</button>
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
			<td style="width:10%">1</td>
			<td style="width:60%"> 
			<select name="products[]" class="form-control drop" required>
				<option value=""> Select Item</option>
                <?php if ($items): ?> 
                    <?php foreach ($items as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['item_name'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="0">No result</option>
                <?php endif; ?>
            </select>
				
   			</td>
			
			<td style="width:20%">
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus required>
			</td>
			
			<td style="width:10%">
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		var edit_id="<?php echo $id;?>";
		//alert(edit_id);
		/*if(edit_id=='')
		{
		 add_row();

		}*/
		
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
