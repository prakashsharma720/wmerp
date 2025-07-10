<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//echo $grid_number;exit;
?>


  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>		
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
	    		<?php if(!empty($id)) { ?>
		    		<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Rm_code/edit_rmcode/<?= $id ?>">
		    			<input type="hidden" name="rm_id_old" value="<?= $id?>">

			    <?php } ?>
			    
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Grid Number <span class="required">*</span></label>
			            	<?php echo form_dropdown('grid_number',$grids,$grid_number);?>
			                <!--<input type="text"  placeholder="Enter Grid Number" name="grid_number" class="form-control" value="<?= $grid_number?>" required autofocus>-->
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label">Supplier Category <span class="required">*</span></label>
			            	<select name="categories_id" class="form-control select2 category" >
			            		<option value="0">Select Category</option>
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
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </select>
			            </div>
			          						<div class="col-md-4 col-sm-4 ">
			            	 <label  class="control-label">Name of supplier <span class="required">*</span></label>
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
						            <option value="0">No result</option>
						        <?php endif; ?>
						    </select>
						</div>
		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Raw Material <span class="required">*</span></label>	
			            	<?php echo form_dropdown('rm_name',$raw_materials,$rm_name);?>
			            	<!--<input type="text"  placeholder="Enter raw material name" name="rm_name" class="form-control" value="<?= $rm_name?>" required autofocus>-->
			            </div>
			   
			         <div class="col-md-4 col-sm-4 ">
				            <label class="control-label"> Grade</label>
			                	<?php  $grades = array(
			            		 'No' => 'Select Option',
				                  'Food' => 'Food (F)',
				                  'NonFood' => 'Non-Food (NF)'
				                  );
			            		echo form_dropdown('grade', $grades,$grade)
			            		?>
				        </div>
				          <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Code <span class="required">*</span></label>	
			            	<input type="text"  placeholder="Enter code" name="rm_code" class="form-control" value="<?= $rm_code?>" required autofocus>
			            </div>
						        
		        	</div>
		        </div>
		         <div class="form-group">
		        	<div class="row col-md-12">			   
			            	<label  class="control-label" style="visibility: hidden;"> Grade</label>
			                <button type="submit" class="btn btn-primary btn-block"> Save</button>
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