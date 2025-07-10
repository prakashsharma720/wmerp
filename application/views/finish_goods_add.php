<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-right ">
			<?php echo validation_errors();?>			
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Finish_goods/add_new_fg">
				    			<div class="row col-md-12">
					         	  	<div class="col-md-6">
						            	<!-- <label class="control-label"> Finish Good Code</label> -->
						            	<label class="control-label"> <?= $this->lang->line('finish_good_code') ?></label>
						                <input type="text"  name="finishgood_code" class="form-control" value="<?= $finish_good_code?>"  autofocus readonly="readonly">
						                <input type="hidden" name="fg_code" value="<?php echo $fg_code;?>">
						        	</div>
									 <div class="col-md-6">
						            	<!-- <label class="control-label"> Grade Name</label> -->
						            	<label class="control-label"> <?= $this->lang->line('grade_name') ?></label>
						                <input type="text"  placeholder="Enter grade name" name="grade_name" class="form-control" value="" required autofocus>
						        </div>
						       	</div>
					        <div class="row col-md-12">
					        	 <div class="col-md-6">
						            	<label class="control-label"> <?= $this->lang->line('mineral_name') ?></label>
									<select name="mineral_name" class="form-control select2 mineral_name" >
										<option value="0"> Select Mineral</option>
										<?php
					                 if ($HSNs): ?> 
					                  <?php 
					                    foreach ($HSNs as $value) : ?>
					                        <?php 
												if ($value['mineral_name'] == $categories_id): ?>
						                            <option value="<?= $value['mineral_name'] ?>" selected><?= $value['mineral_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['mineral_name'] ?>"><?= $value['mineral_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </select>
								</div>
						        <div class="col-md-6 hsn_code">
									<label class="control-label"><?= $this->lang->line('hsn_code') ?></label>
									<input type="text"  placeholder="" name="hsn_code" class="form-control clear_hsn" value="" autocomplete="off" autofocus readonly="readonly" >
								</div>
						        
						     </div>
					        <span class="help-block"></span>
					        <div class="row col-md-12">
						         <div class="col-md-6">
						            	<label class="control-label"><?= $this->lang->line('packing') ?> </label>
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
							                    <option value="0">No result</option>
							                <?php endif; ?>
					            		</select>
						                
						        </div>
						         <div class="col-md-6">
						            	<label class="control-label"><?= $this->lang->line('packing_type') ?> </label>
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
							                    <option value="0">No result</option>
							                <?php endif; ?>
					            		</select>
						        </div>
						    
					        </div>
					        <span class="help-block"></span>
				        	<br>
				           <div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
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
				if(hsn_id!=' '){
					$.ajax({
		                type: "POST",
		                url:"<?php echo base_url('index.php/HSN/getmineralById/') ?>"+hsn_id,
		                data: {hsn_id:hsn_id},
		                dataType: 'html',
		                
		                success: function (response) {
		                	//alert(response);
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
