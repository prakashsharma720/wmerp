<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('edit_gir_register') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
?>


        <div class="pull-right error_msg">
      <?php $this->load->view('layout/alerts'); ?>

			<?php echo validation_errors();?>
		
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body bg-white" style="position: relative;">
		    		<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Gir_registers/edit_gir/<?= $id ?>">
		    			<input type="hidden" name="gir_id_old" value="<?= $id?>">
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?= $this->lang->line('date') ?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?= $this->lang->line('gir_no') ?> <span class="required">*</span></label>
			            	
			             <input type="text"  name="g_no" class="form-control" value="<?= $gir_no?>"  autofocus readonly="readonly">
		                 <input type="hidden" name="gir_no" value="<?php echo $g_no;?>">			            
			            </div>

			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?= $this->lang->line('invoice_no') ?> <span class="required">*</span></label>
			            	<input type="text"  placeholder=" <?= $this->lang->line('enter_invoice_no') ?>" name="challan_no" class="form-control" value="<?= $challan_no?>" autofocus  >
			            </div>

		        	</div>
		        	<div class="row col-md-12">
		        	 	<div class="col-md-4 col-sm-4 ">
			            	
			            	<div>
			            		<!-- <input type="hidden" name="categories_id" value="<?= $categories_id ?>">
			            		<span><?= $category ?></span> -->
			            	</div>
							<label class="control-label"> <?= $this->lang->line('category') ?></label>
			            	 <select name="categories_id" class="form-control select2 category" required="required">

					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
												if ($value['id'] == $categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value=""><?= $this->lang->line('no_result') ?></option>
					                <?php endif; ?>
					            </select> 
								
			            	
			            </div>
			            	 <div class="col-md-4 col-sm-4 ">
			            	 <label  class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
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
						            <option value="0"><?= $this->lang->line('no_result') ?></option>
						        <?php endif; ?>
						    </select>
						</div>
						
												
						</div>
			        </div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: white;">
			        				<tr>
			        					<th style="width: 5%;">  <?= $this->lang->line('sr_no') ?>.</th>
			        					<th style="width: 30%;"> <?= $this->lang->line('product_name') ?></th>
			        					<th style="width: 15%;"> <?= $this->lang->line('qty') ?></th>
										<th style="width: 15%;"> <?= $this->lang->line('unit') ?></th>
			        					<th style="width: 20%;"> <?= $this->lang->line('description') ?></th>
			        					<th style="width: 10%;"> <?= $this->lang->line('action') ?></th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 
			        				if(!empty($gir_details))
			        				{
			        					$i=1; foreach ($gir_details as $key => $gir_detail) { 
			        						//print_r ($gir_detail);
			        						?>
			        						<tr class="main_tr1">
												<td><?= $i; ?></td>
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
										                    <option value="0"><?= $this->lang->line('no_result') ?></option>
										                <?php endif; ?>
										            </select>

									   			</td>
												
												<td>
													<input type="text"  placeholder="<?= $this->lang->line('enter_qty') ?>" name="qty[]" class="form-control qty" 
													value="<?php echo $gir_detail['quantity']; ?>" autofocus >
												</td>
												<td>
												<select name="unit_id[]" class="form-control select2 units" required="required">
														 <option value=""><?= $this->lang->line('select_unit') ?></option>
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
																<option value=""><?= $this->lang->line('no_result') ?></option>
															<?php endif; ?>
														</select>
												</td>
												<td>
													<textarea name="description[]" class="form-control description" type="textarea" placeholder="<?= $this->lang->line('enter_description') ?>"  value="<?php echo $gir_detail['description']; ?>"><?php echo $gir_detail['description']; ?></textarea>
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
			        					<td colspan="2" style="text-align: right;"><b><?= $this->lang->line('total') ?></b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder="<?= $this->lang->line('total_qty') ?>" name="total_qty" class="form-control total_qty"  value="<?= $total_qty?>" readonly >
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
			            	<label  class="control-label"> <?=$this ->lang->line('material_received_throught')?> <span class="required">*</span></label>
			            	
			            	<input type="text" placeholder=" <?=$this ->lang->line('enter_source')?>" name="material_received_from" class="form-control" style="height:100%;padding-top: 0px;" value="<?= $material_received_from?>" />
			            	<!-- <input type="text"  placeholder=" Enter source here" name="material_received_from" class="form-control"  autofocus  value="<?= $material_received_from?>" required="required"> -->
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> <?=$this ->lang->line('comment')?></label>
			            	<input type="text" placeholder=" <?=$this ->lang->line('enter_comment')?>" name="comments" class="form-control" style="height:100%;padding-top: 0px;" value="<?= $comments?>" />
			            </div>

		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"><?=$this ->lang->line('grade')?></label>
			                <button type="submit" class="btn btn-primary btn-block"> <?=$this ->lang->line('submit')?></button>
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
			<td> 
			<select name="products[]" class="form-control drop" required>
				<option value=""> <?=$this ->lang->line('select_item')?></option>
                <?php if ($items): ?> 
                    <?php foreach ($items as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="0"><?=$this ->lang->line('no_result')?></option>
                <?php endif; ?>
            </select>
				
   			</td>
   			<td >
				<input type="text"  placeholder="<?=$this ->lang->line('enter_qty')?>" name="qty[]" class="form-control qty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
			</td>
			<td>
        	 <select name="unit_id[]" class="form-control  units" required="required">
        		 <option value=""><?=$this ->lang->line('select_unit')?></option>
	                <?php
	                 if ($units): ?> 
	                  <?php 
	                    foreach ($units as $value) : ?>
	                      
		                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
	                    <?php   endforeach;  ?>
	                <?php else: ?>
	                    <option value=""><?=$this ->lang->line('no_result')?></option>
	                <?php endif; ?>
	            </select>
			</td>
			<td>
				<textarea name="description[]" class="form-control description" type="textarea" placeholder="<?=$this ->lang->line('enter_description')?>"></textarea>
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
			$(this).find("td:nth-child(4) select.units").select2();

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
