<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
	}
 

</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

			<?php if (isset($message_display)) {
			echo $message_display;
			} ?>
			<?php if (isset($error)) {
			echo $error;
			} ?>	
			<?php if (isset($success)) {
			echo $success;
			} ?>			
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      			<?php  //echo $title; exit; ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Workers/add_new_worker" enctype="multipart/form-data">
				    		
					        <div class="form-group">
					        	<div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Name *</label>
						                <input type="text"  placeholder="Enter Workers Name" name="name" class="form-control"  required autofocus>
						            </div>
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Code *</label>
						                <input type="text"  name="wc_code" class="form-control" value="" placeholder="Enter Worker Code"  autofocus required="required">
						                <!-- <input type="hidden" name="worker_code" value="<?php //echo $wc_code;?>"> -->
						            </div>
						            <!-- <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Role</label>
						               <?php  
						            		echo form_dropdown('role_id', $roles)
						            	?>
						            </div>-->
						            
				        		</div>
				        	</div>
					        <div class="form-group"> 
						        <div class="row col-md-12">
					        		<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Mobile No </label>
						               	<input type="text" placeholder="Enter mobile" name="mobile_no" class="form-control mobile" minlenght="10" maxlength="10" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" autofocus>
						            </div>
						            
						            <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Department</label>
						               <?php  
						            		echo form_dropdown('department_id', $departments,'','required="required"')
						            	?>
						            </div>
						            <div class="col-md-4 col-sm-4 ">
						        		<label class="control-label"> Gender </label>
						        			<div class="form-check">
							               		<input class="form-check-input" type="radio" name="gender" value="Male" checked> Male</input>
							               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							               		<input class="form-check-input" type="radio" name="gender" value="Female" > Female</input>
						            		</div>
						            	</div>
						        </div>
						     </div>
						    <div class="form-group"> 
						        <div class="row col-md-12">
						        	<!-- <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> PAN No </label>
						               	<input type="text" placeholder="Enter PAN No" name="pan_no" class="form-control pan_no"  
			                			 value="" autofocus>
						            </div> -->
						            <div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Aadhaar No </label>
						               	<input type="text" placeholder="Enter Aadhaar No" name="aadhaar_no" class="form-control aadhaar_no" minlenght="12" maxlength="12" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="" autofocus required="required">
						            </div>
						        	<div class="col-md-4 col-sm-4">
						            	<label class="control-label"> Date of Birth</label>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="dob" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus>
			            			</div>
			            			<div class="col-md-4 col-sm-4 ">
						            	<label class="control-label"> Upload Photo </label>
						                <input type="file"  name="photo" class="form-control upload"  autofocus>
						            </div>
			            		</div>
			            	</div>
					       <div class="form-group"> 
							        <div class="row col-md-12">
							         <div class="col-md-4 col-sm-4 ">
				        				<label class="control-label"> Medical Test </label>
						        			<div class="form-check">
							               		<input class="form-check-input medical_status" type="radio" name="medical_status" value="Yes" checked="checked" /> Yes
							               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							               		<input class="form-check-input medical_status" type="radio" name="medical_status" value="No" /> No
				            				</div>
			            				</div>
			            				<div class="col-md-8 col-sm-8 report_div">
							            	<label class="control-label"> Report Number </label>
							                <input type="text" id="firstName" placeholder="Enter Report Number" name="report_no" class="form-control report_no" value="" autofocus autocomplete="off"  required="required"  >
							            </div>
							        </div>
							    </div>
					        <div class="form-group"> 
						        <div class="row col-md-12">
					        		<div class="col-md-8 col-sm-8 ">
						            	<label class="control-label"> Address </label>
						               <textarea class="form-control address" rows="3" placeholder="Enter Address" name="address" value="" ></textarea>
						            </div>
						            <div class="col-md-4">
						            	<label class="control-label" style="visibility: hidden;"> Photo View </label>
						            	<div>
						            	 <img id="blah" src="#" alt="your image"  class="hide"  width="100px" height="100px" />
						            	</div>
						            </div>
					        		
						        </div>
					        </div>
				           <div class="row col-md-12">
					            <div class="col-md-12 col-sm-12 ">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block">Save</button>
					            </div>
					        </div>
					        </form>
				        </div>
				 <!-- /form -->
				
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
			    alert('Image size exceed , please select < 5MB file only !');
			    $(this).val(''); 
			}

		  readURL(this);
		});
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