<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
    <?php echo $this->session->flashdata('success'); ?>
  </div>
  <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>

<!-- Page Header -->
<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('material_return_register') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
        <!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?></li> -->

      </ul>

    </div>

    
		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">

			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>









		
      <div class="card-body p-3">
		    <form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Material_return_records/add_new_gir/">
		        <div class="form-group">
		        	<div class="row ">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('date')?>  <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"	value="" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?=$this ->lang ->line('material_return_record')?>  <span class="required">*</span></label>
			             	<input type="text"  name="g_no" class="form-control" value="<?= $voucher_code_view?>"  autofocus readonly="readonly">
		                 	<input type="hidden" name="gir_no" value="<?php echo $voucher_code;?>">
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang ->line('gate_pass_no')?>  <span class="required">*</span></label>
			            	<input type="text"  placeholder=" <?=$this ->lang ->line('enter_gate_pass_no')?>" name="gate_pass_no" class="form-control" value=""  required="required">
			            </div>
		        	</div>
		        	<div class="row ">
		        	 	<div class="col-md-4 col-sm-4 ">
							<label class="control-label"> <?=$this ->lang ->line('category')?> </label>
			            	 <select name="categories_id" class="form-control select2 category" required="required">
			            	 	<option value=""> <?=$this ->lang ->line('select_category')?> </option>
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
					                    <option value=""><?=$this ->lang ->line('no_result')?> </option>
					                <?php endif; ?>
					            </select> 
			            </div>
			           	<div class="col-md-4 col-sm-4 ">
			            	 <label  class="control-label"><?=$this ->lang ->line('name_of_supplier')?>  <span class="required">*</span></label>
			            	<select name="supplier_id" class="form-control select2 suppliers" required="required">
			            		<option value=""> <?=$this ->lang ->line('select_supplier')?> </option>
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
						            <option value="0"><?=$this ->lang ->line('no_result')?> </option>
						        <?php endif; ?>
						    </select>
						</div>
						<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> <?=$this ->lang ->line('tentative_date_of_return')?>  <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="return_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"	value="" autofocus required >
			            </div>
						
					</div>
					
		        	<div class="row ">
		        		<div class="col-md-12 ">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th style="width: 5%;">  <?=$this ->lang ->line('sr_no')?> </th>
			        					<th style="width: 30%;"> <?=$this ->lang ->line('material_description')?> </th>
			        					<th style="width: 15%;"> <?=$this ->lang ->line('unit')?>  </th>
			        					<th style="width: 15%;"> <?=$this ->lang ->line('out_qty')?> </th>
			        					<th style="width: 20%;"> <?=$this ->lang ->line('description')?> </th>
			        					<th style="width: 10%;"> <?=$this ->lang ->line('action')?> </th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<tr class="main_tr1">
										<td >1</td>
										<td> 
											<select name="item_id[]" class="form-control select2" required>
												<option value=""> <?=$this ->lang ->line('select_item')?> </option>
								                <?php if ($items): ?> 
								                    <?php foreach ($items as $value) : ?>
								                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
								                    <?php endforeach; ?>
								                <?php else: ?>
								                    <option value="0"><?=$this ->lang ->line('no_result')?> </option>
								                <?php endif; ?>
								            </select>
							   			</td>
							   			<td>
								        	<select name="unit_id[]" class="form-control select2 units" required="required">
							        		 	<option value=""><?=$this ->lang ->line('select_unit')?> </option>
								                <?php
								                 if ($units): ?> 
								                  <?php 
								                    foreach ($units as $value) : ?>
								                      
									                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
								                    <?php   endforeach;  ?>
									                <?php else: ?>
									                    <option value=""><?=$this ->lang ->line('no_result')?> </option>
									                <?php endif; ?>
									        </select>
										</td>
							   			<td >
											<input type="text"  placeholder="<?=$this ->lang ->line('enter_qty')?>" name="qty[]" class="form-control qty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>

												<input type="hidden" name="status[]" value="Out">
										</td>
										
										<td>
											<textarea name="description[]" class="form-control description" type="textarea" placeholder=" <?=$this ->lang ->line('enter_description')?>"></textarea>
										</td>
										
										<td style="width:13%">
  <!-- Add Row Button -->
  <button type="button" class="btn btn-xs border addrow" role="button" title="Add Row">
    <i class="fa fa-plus text-dark"></i>
  </button>

  <!-- Delete Row Button -->
  <button type="button" class="btn btn-xs border deleterow" role="button" title="Delete Row">
    <i class="fa fa-minus text-dark"></i>
  </button>
</td>

									</tr>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="3" style="text-align: right;"><b><?=$this ->lang ->line('total')?> </b></td>
			        					
			        					<td>
			        						<input type="text"  placeholder="<?=$this ->lang ->line('total_qty')?> " name="total_qty" class="form-control total_qty"  value="" readonly >
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
			            	<label  class="control-label"> <?=$this ->lang ->line('purpose')?> </label>
			            	<input type="text" placeholder=" <?=$this ->lang ->line('enter_purpose')?> " name="comments" class="form-control" style="height:100%;padding-top: 0px;" value="" />
			        	</div>
		        	</div>
		    </div>
	        <div class="form-group">
	        	<div class="row ">
		            <div class="col-md-12 col-sm-12 ">
		            	<label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?> </label>
		                <button type="submit" class="btn btn-primary btn-block"> <?=$this ->lang ->line('submit')?> </button>
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
					<option value=""> <?=$this ->lang ->line('select_item')?> </option>
	                <?php if ($items): ?> 
	                    <?php foreach ($items as $value) : ?>
	                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
	                    <?php endforeach; ?>
	                <?php else: ?>
	                    <option value="0"><?=$this ->lang ->line('no_result')?> </option>
	                <?php endif; ?>
	            </select>
   			</td>
   			<td>
	        	<select name="unit_id[]" class="form-control  units" required="required">
        		 	<option value=""><?=$this ->lang ->line('select_unit')?> </option>
	                <?php
	                 if ($units): ?> 
	                  <?php 
	                    foreach ($units as $value) : ?>
	                      
		                            <option value="<?= $value['id'] ?>"><?= $value['unit_name'] ?></option>
	                    <?php   endforeach;  ?>
		                <?php else: ?>
		                    <option value=""><?=$this ->lang ->line('no_result')?> </option>
		                <?php endif; ?>
		        </select>
			</td>
   			<td >
				<input type="text"  placeholder="<?=$this ->lang ->line('enter_qty')?> " name="qty[]" class="form-control qty" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
			</td>
			
			<td>
				<textarea name="description[]" class="form-control description" type="textarea" placeholder="<?=$this ->lang ->line('enter_description')?> "></textarea>
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
