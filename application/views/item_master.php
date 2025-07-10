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
		      			<?php  //echo $title; exit; ?>
		      			<?php if(!empty($id)) { ?>
				    		<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Item_master/edititem/<?= $id ?>">
				    			<input type="hidden" name="old_item_id" value="<?= $id?>">
				    			<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Item_master/add_new_item">
				    			<?php } ?>
				       <!-- <div class="form-group">
				        	<div class="row col-md-12">
					        	<div class="col-md-6 category_id">
					            	<label class="control-label"> Category</label>
						            	<?php  
						               		echo form_dropdown('category_id', $categories) 
						               ?>
						        </div>
						        <div class="col-md-6 ">
					            	<label class="control-label">Grade</label>
						            	<select name="grade_id" class="form-control select2 grades" required="required">
											<option value=""> Select Grade</option>
											
										</select>
										<?php  
						               		//echo form_dropdown('grade', $grades,$grade) 
						               ?>
						        </div>
						       
						     </div>-->
					        <span class="help-block"></span>
					        <div class="row col-md-12">
					        	 <div class="col-md-6">
						            	<label class="control-label"> Mineral Name</label>
						                <input type="text"  placeholder="Enter mineral name" name="item_name" class="form-control" value="" required autofocus>
						        </div>
						        <div class="col-md-6">
						            	<label class="control-label"> Grade Name</label>
						                <input type="text"  placeholder="Enter grade name" name="item_code" class="form-control" value="" required autofocus>
						        </div>
						        
						     </div>
					       <!--  <span class="help-block"></span>
					         <div class="row col-md-12">
					        	 <div class="col-md-6">
						            	<label class="control-label"> Lot No</label>
						                <input type="text"  placeholder="Enter Lot Number" name="lot_no" class="form-control" value="<?= $lot_no?>" required autofocus>
						        </div>
						        <div class="col-md-6">
						            	<label class="control-label"> Batch No</label>
						                <input type="text"  placeholder="Enter Batch No" name="batch_no" class="form-control" value="<?= $batch_no?>" required autofocus>
						        </div>
						     </div> -->
					        <span class="help-block"></span>
					       <!--  <div class="row col-md-12">
					         	<div class="col-md-6">
						            	<label class="control-label"> Unit</label>
						                <input type="text"  placeholder="Enter measurement unit" name="unit" class="form-control" value="<?= $unit?>" required autofocus>
						        </div>
						         <div class="col-md-6">
						            	<label class="control-label"> Expiry Date</label>
						                 <input type="text" data-date-formate="dd-mm-yyyy" name="expiry_date" class="form-control date-picker" value="<?php echo date('d-m-Y',strtotime($expiry_date)); ?> " placeholder="dd-mm-yyyy" autofocus>
						        </div>
						    
					        </div> -->
					        <span class="help-block"></span>
					        <div class="row col-md-12">
					         	<!--  <div class="col-md-6">
						            	<label class="control-label"> Unit</label>
						                <input type="text"  placeholder="Enter measurement unit" name="unit" class="form-control" value="" required autofocus>
						        </div> -->
						         <div class="col-md-6">
						            	<label class="control-label"> Packing </label>
						            	<select class="form-control " name="unit">
						            	    <option value=""> Select Packing</option>
						            	    <option value="25kg"> 25 Kg</option>
						            	    <option value="50kg"> 50 Kg</option>
						            	    <option value="NA"> NA</option>
						            	</select>
						                
						        </div>
						         <div class="col-md-6">
						            	<label class="control-label"> Packing Type </label>
						            	<select class="form-control " name="item_description">
						            	    <option value=""> Select Packing Type </option>
						            	    <option value="liner"> Liner</option>
						            	    <option value="without liner"> Without Liner</option>				</select>
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
	});
</script> 
