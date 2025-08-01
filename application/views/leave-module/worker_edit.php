<style>
    .control-label {
margin: 0.7rem
}
</style>

	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/Workers/index'); ?>"><?= $this->lang->line('workers') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('edit_worker') ?>
                </li>
            </ul>
        </div>
<div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>
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
</div>
	 <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Workers/editworker/<?= $id ?>" enctype="multipart/form-data">
				    		<input type="hidden" name="workers_id" value="<?= $id?>">
					        <div class="form-group">
					        	<div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> <?=$this ->lang->line('name')?> *</label>
						                <input type="text"  placeholder=" <?=$this ->lang->line('name')?>" name="name" class="form-control" value="<?= $name?>"  autofocus>
						            </div>
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"><?=$this ->lang->line('code')?> *</label>
						                <input type="text"  name="wc_code" class="form-control" value="<?= $worker_code ?>"  autofocus required>
						                <!-- <input type="hidden" name="worker_code" value="<?php echo $wc_code;?>"> -->
						            </div>
						            <!-- <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Role</label>
						               <?php  
						            		echo form_dropdown('role_id', $roles,$role_id)
						            	?>
						            </div>-->
						            
				        		</div>
				        	</div>
					        <div class="form-group"> 
						        <div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"><?=$this ->lang->line('mobile_no')?> </label>
						               	<input type="text" placeholder="<?=$this ->lang->line('enter_mobile_no')?>" name="mobile_no" class="form-control mobile" minlenght="10" maxlength="10" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="<?= $mobile_no?>" autofocus>
						            </div>
						            
						            <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"><?=$this ->lang->line('department')?></label>
						               <?php  
						            		echo form_dropdown('department_id', $departments,$department_id,'','required="required"')
						            	?>
						            </div>
						            <?php 
			        						$male='';
			        						$female='';
			        						if(!empty($gender)) {
			        							if($gender=='Male'){
			        								$male='checked';
			        							}else{
			        								$female='checked';
			        							}

			        						}else{
			        							$male='checked';
			        						}
			        						?>
						        	<div class="col-md-4 col-sm-4 ">
						        		<label class="control-label"> <?=$this->lang->line('gender')?> </label>
										<div class="form-check d-flex align-items-center">
											<label class="form-check-label me-4">
												<input class="form-check-input" type="radio" name="gender" value="Male" <?= $male; ?>>
												<?=$this->lang->line('male')?>
											</label>

											<label class="form-check-label">
												<input class="form-check-input" type="radio" name="gender" value="Female" <?= $female; ?>>
												<?=$this->lang->line('female')?>
											</label>
										</div>

						            	</div>
						        </div>
						     </div>
						    <div class="form-group"> 
						        <div class="row col-md-12">
						        	<!-- <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> PAN No </label>
						               	<input type="text" placeholder="Enter PAN No" name="pan_no" class="form-control pan_no"  
			                			 value="<?= $pan_no?>" autofocus>
						            </div> -->
						            <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> <?=$this ->lang->line('aadhaar_no')?> </label>
						               	<input type="text" placeholder="<?=$this ->lang->line('enter_aadhaar_no')?>" name="aadhaar_no" class="form-control aadhaar_no" minlenght="12" maxlength="12" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="<?= $aadhaar_no?>" autofocus>
						            </div>
						        	<div class="col-md-4 col-sm-4">
						            	<label class="control-label"> <?=$this ->lang->line('date_of_birth')?></label>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="dob" class="form-control date-picker" id="startDate" value="<?php if($dob) { echo date('d-m-Y',strtotime($dob)); } ?>" placeholder="<?=$this ->lang->line('dd_mm_yyyy')?>" autofocus>
			            			</div>
			            			<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"><?=$this ->lang->line('upload_photo')?> </label>
						                <input type="file"  name="photo" class="form-control upload"  autofocus>
						               
						            </div>
			            		</div>
			            	</div>
			            	<div class="form-group"> 
							        <div class="row col-md-12">
							        	<?php 
				    						$new='';
				    						$existing='';
				    						if(!empty($medical_status)) {
				    							if($medical_status=='Yes'){
				    								$new='checked';
				    							}else{
				    								$existing='checked';
				    							}

				    						}
				        				?>
							         <div class="col-md-4 col-sm-4 ">
				        				<label class="control-label"><?=$this ->lang->line('medical_test')?> </label><br>
										<div class="form-check form-check-inline">
											<input class="form-check-input medical_status" type="radio" name="medical_status" value="Yes" checked="checked" <?= $new; ?>>
											<label class="form-check-label"><?= $this->lang->line('yes') ?></label>
										</div>

										<div class="form-check form-check-inline">
											<input class="form-check-input medical_status" type="radio" name="medical_status" value="No" <?= $existing; ?>>
											<label class="form-check-label"><?= $this->lang->line('no') ?></label>
										</div>

			            				</div>
			            				<div class="col-md-8 col-sm-8 report_div">
							            	<label class="control-label"><?=$this ->lang->line('report_no')?></label>
							                <input type="text" id="firstName" placeholder="<?=$this ->lang->line('enter_report_no')?>" name="report_no" class="form-control report_no" value="<?php echo $report_no; ?>" autofocus autocomplete="off"  required="required"  >
							            </div>
							        </div>
							    </div>

						 
					        <div class="form-group"> 
						        <div class="row col-md-12">
					        		<div class="col-md-8 col-sm-8 ">
						            	<label class="control-label"><?=$this ->lang->line('address')?> </label>
						        		<textarea class="form-control address" rows="3" placeholder="<?=$this ->lang->line('enter_address')?>" name="address" value="<?= $address ?>" ><?= $address ?></textarea>
						            </div>
						             <div class="col-md-4">
						            	<label class="control-label" style="visibility: hidden;"><?=$this ->lang->line('photo_view')?></label>
						            	<div>
						            	  <?php if(!empty($photo)) { ?>
						                	<img id="blah" src="<?php echo base_url().'/uploads/'.$photo; ?>" alt="your image"   width="100px" height="100px" />
						                	<input type="hidden" name="old_image" value="<?= $photo ?>">
						                <?php } else { ?>
						                <img id="blah" src="#" alt="your image"  class="hide" width="100px" height="100px" />
						                <?php } ?>	
						            	</div>
						            </div>
						           
					        	
						        </div>
					        </div>
					        <div class="form-group"> 
						        <div class="row col-md-12">
									<?php if(!empty($id)) { ?>
						        		<div class="col-md-6 col-sm-6 ">
							            	<label class="control-label"><?=$this ->lang->line('status')?></label>
							               <select class="form-control" name="flag">
							               		<option value="0"> <?=$this ->lang->line('active')?></option>
							               		<option value="1"> <?=$this ->lang->line('de_active')?></option>
							               </select>
							            </div>
							        <?php } ?>
							    </div>
							</div>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"><?=$this ->lang->line('name')?></label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('save')?></button>
					            </div>
					        </div>
					        </form>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		function readURL(input) {

		  if (input.files && input.files[0]) {
		    var reader = new FileReader();

		    reader.onload = function(e) {
		    	$('#blah').removeClass('hide');
		    	$('#blah').addClass('show');
		      $('#blah').attr('src', e.target.result);
		    }

		    reader.readAsDataURL(input.files[0]);
		  }
		}
		$(".upload").change(function() {
			var file = this.files[0];
			var fileType = file["type"];
			var size = parseInt(file["size"]/1024);
			//alert(size);
			var validImageTypes = ["image/jpeg", "image/png"];
			if ($.inArray(fileType, validImageTypes) < 0) 
			{
			    alert('Invalid file type , please select jpg/png file only !');
			    $(this).val(''); 
			}
			if (size > 5000) 
			{
			    alert('Image size exceed , please select < 5 MB file only !');
			    $(this).val(''); 
			}

		  readURL(this);
		});
		var medical_status = $("input[name='medical_status']:checked").val();
			if(medical_status=='Yes'){
				$(".report_div").css('visibility', 'visible');
				$(".report_no").attr('required', 'required');
			}
			else {
				$(".report_div").css('visibility', 'hidden');
				$(".report_no").removeAttr('required');
			}

		$("input[type='radio']").click(function(){
            var medical_status = $("input[name='medical_status']:checked").val();
				if(medical_status=='Yes'){
					$(".report_div").css('visibility', 'visible');
					$(".report_no").attr('required', 'required');
				}
				else {
					$(".report_div").css('visibility', 'hidden');
					$(".report_no").removeAttr('required');
				}
			});
		
	});
</script>