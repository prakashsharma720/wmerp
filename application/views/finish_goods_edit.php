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
				<h5 class="m-b-10"><?= $this->lang->line('update_finish_good') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?>
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
	




  
	      	<div class="card-body p-3">
		      	<div class="row">
		      		<div class="col-md-12">
				    	<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Finish_goods/editFG/<?= $id ?>">
				    	<input type="hidden" name="old_fg_id" value="<?= $id?>">
							
				  			<div class="row col-md-12">
					         	  	<div class="col-md-6">
						            	<label class="control-label"> <?=$this ->lang->line('finish_good_code')?></label>
						                <input type="text"  name="finishgood_code" class="form-control" value="<?= $finish_good_code?>"  autofocus readonly="readonly">
						                <input type="hidden" name="fg_code" value="<?php echo $fg_code;?>">
						        	</div>
									<div class="col-md-6">
						            	<label class="control-label"> <?=$this ->lang->line('grade_name')?></label>
						                <input type="text"  placeholder="<?=$this ->lang->line('enter_grade_name')?>" name="grade_name" class="form-control" value="<?= $grade_name ?>" required autofocus>
						        </div>
						        
						       	</div>
					        <div class="row col-md-12">
					        	 <div class="col-md-6">
						            	<label class="control-label"> <?=$this ->lang->line('mineral_name')?></label>
									<select name="mineral_name" class="form-control select2 mineral_name" >
										<?php
					                 if ($HSNs): ?> 
					                  <?php 
					                    foreach ($HSNs as $value) : ?>
					                        <?php 
												if ($value['mineral_name'] == $mineral_name): ?>
						                            <option value="<?= $value['mineral_name'] ?>" selected><?= $value['mineral_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['mineral_name'] ?>"><?= $value['mineral_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?=$this ->lang->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
								</div>
						        <div class="col-md-6 hsn_code">
									<label class="control-label"><?=$this ->lang->line('hsn_code')?></label>
									<input type="text"  placeholder="" name="hsn_code" class="form-control clear_hsn" value="<?= $hsn_code ?>" autocomplete="off" autofocus readonly="readonly" >
								</div>
						        
						     </div>
					        <span class="help-block"></span>
					        <div class="row col-md-12">
						         <div class="col-md-6">
						            	<label class="control-label"> <?=$this ->lang->line('packing')?> </label>
						            	<select name="packing_size" class="form-control" required="required">
							                <?php
							                 if ($packing_sizes): ?> 
							                  <?php 
							                    foreach ($packing_sizes as $value) : ?>
							                        <?php 
														if ($value == $packing_size): ?>
								                            <option value="<?= $value?>" selected><?= $value ?></option>
								                        <?php else: ?>
								                            <option value="<?= $value ?>"><?= $value ?></option>
								                        <?php endif;   ?>
							                    <?php   endforeach;  ?>
							                <?php else: ?>
							                    <option value="0"><?=$this ->lang->line('no_result')?></option>
							                <?php endif; ?>
					            		</select>
						                
						        </div>
						         <div class="col-md-6">
						            	<label class="control-label"> <?=$this ->lang->line('packing_type')?></label>
						            	<select class="form-control" name="packing_type"  required="required">
							                <?php
							                 if ($packing_types): ?> 
							                  <?php 
							                    foreach ($packing_types as $value) : ?>
							                        <?php 
														if ($value == $packing_type): ?>
								                            <option value="<?= $value?>" selected><?= $value ?></option>
								                        <?php else: ?>
								                            <option value="<?= $value ?>"><?= $value ?></option>
								                        <?php endif;   ?>
							                    <?php   endforeach;  ?>
							                <?php else: ?>
							                    <option value="0"><?=$this ->lang->line('no_result')?></option>
							                <?php endif; ?>
					            		</select>
						        </div>
						        <div class="col-md-6">
					            	<label class="control-label"> <?=$this ->lang->line('opening_stock_qty_mt')?> </label>
					                <input type="text"  name="finishgood_code" class="form-control" value="<?= $finish_good_code?>"  autofocus readonly="readonly">
					                <input type="hidden" name="fg_code" value="<?php echo $fg_code;?>">
						        	</div>
					        </div>
				        	<br>
				           <div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"> <?=$this ->lang->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('save')?></button>
					            </div>
				        </div>
			        </form>
				</div>
			</div>
		</div>
	</div>
</div>


<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('change','.category_id',function(){
				var category_id = $('.category_id').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(category_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Grades/getGradeByCategory/') ?>"+category_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".grades").html(response);
	                    $('.select2').select2();
	                }
            	});
			});
            $(document).on('change','.mineral_name',function(){
				var hsn_id = $('.mineral_name').find('option:selected').val();
				//alert(hsn_id);
				if(hsn_id!=''){
					$.ajax({
		                type: "POST",
		                url:"<?php echo base_url('index.php/HSN/getmineralById/') ?>"+hsn_id,
		                //data: {id:role_id},
		                dataType: 'html',
		                success: function (response) {
		                		
		                    $(".hsn_code").html(response);
							//$('.select2').select2();
						}
	            	});
				}else{
					$(".clear_hsn").val('');
				}
				

			}); 			
	});
</script> 

