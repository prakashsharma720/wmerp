


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

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('create_new_material_code') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?> -->
				</li>
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
	<div class="main-content">
		<div class="card card-primary card-outline">
			<div class="card-body">
				
		        <div class="form-group">
		        	<div class="row col-md-12">
			           <div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('grid_number')?> <span class="required">*</span></label>
			            	<?php echo form_dropdown('grid_number',$grids);?>
			                <!--<input type="text"  placeholder="Enter Grid Number" name="grid_number" class="form-control"  required autofocus>-->
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang ->line('supplier_category')?><span class="required">*</span></label>
			            	<select name="categories_id" class="form-control select2 category" >
			            		 <option value="0"><?=$this ->lang ->line('select_category')?></option>
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
												if ($value['id'] == $current[0]->categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
			            </div>
			        <div class="col-md-4 col-sm-4 ">
			          <label  class="control-label"><?=$this ->lang ->line('name_of_supplier')?> <span class="required">*</span></label>
							<select name="supplier_id" class="form-control select2 suppliers" required="required">

						    </select>
			            	
			            </div>
			   <div class="row col-md-12">
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?=$this ->lang ->line('raw_material')?><span class="required">*</span></label>	
			            	<?php echo form_dropdown('rm_name',$raw_materials);?>
			            	<!--<input type="text"  placeholder="Enter raw material name" name="rm_name" class="form-control"  required autofocus>-->
			            </div>
			         <div class="col-md-4 col-sm-4 ">
				            <label class="control-label"> <?=$this ->lang ->line('grade')?></label>
			                	<?php  $grades = array(
			            		 'No' => 'Select Option',
				                  'Food' => 'Food (F)',
				                  'NonFood' => 'Non-Food (NF)'
				                  );
			            		echo form_dropdown('grade', $grades)
			            		?>
				        </div>
				          <div class="col-md-4 col-sm-4  " style="position: relative; left:13px">
			            	<label  class="control-label"><?=$this ->lang ->line('code')?> <span class="required">*</span></label>	
			            	<input type="text"  placeholder="<?=$this ->lang ->line('enter_code')?>" name="rm_code" class="form-control"  required autofocus>
			            </div>
						        
		        	</div>
		        </div>
		         <div class="form-group">
		        	<div class="row col-md-12">			   
			            	<label  class="control-label" style="visibility: hidden;"><?=$this ->lang ->line('grade')?></label>
			                <button type="submit" class="btn btn-primary btn-block"><?=$this ->lang ->line('save')?></button>
		        	</div>
		        </div>
		        
		        
		    </form> <!-- /form -->
		</div>
	</div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

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






