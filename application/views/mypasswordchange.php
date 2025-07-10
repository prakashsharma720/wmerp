<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
	.select2{
		height:45px !important;
		width: 100% !important;
	}
 

</style>
<?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Success!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
       		<div class="button-group float-right">
		        
	      </div>
	    </div> 
		<!-- /.card-body -->
      	<div class="card-body">
      		<div class="row">
	      		<div class="col-md-12 ">
	      			<center>
	      				<form action="<?php echo base_url() ;?>index.php/User_authentication/UserPasswordChange" method="post" >
					    	<input type="hidden" name="emp_id" value="<?= $this->session->userdata['logged_in']['id']; ?>">
               <?php
                if($designation_id=='1'||$designation_id=='2'||$designation_id=='4' )
                { ?>
                <div class="col-md-6 col-sm-4 ">
						            	<label  class="control-label">Select Employee  <span class="required">*</span></label>
						               <?php  
						            		echo form_dropdown('emp_id', $employees,'','class="form-control" required="required"')
						            	?>
						            </div>
                        <?php }?>
               
                <div class="col-md-6 col-6 input-group mb-2">
                  
					            <div class="input-group-prepend">
					              <span class="input-group-text"><i class="fa fa-lock"></i></span>
					            </div>

					            <input type="password" class="form-control password" placeholder="Enter New Password" name="password" autocomplete="off" required>
					        </div>
					         <div class="col-md-6 col-6 input-group mb-3">
					            <div class="input-group-prepend">
					              <span class="input-group-text"><i class="fa fa-lock"></i></span>
					            </div>
					            <input type="password" class="form-control cpassword" placeholder="Confirm Password" name="confirm_password" required autocomplete="off">
					        </div>
                 
					         <div class=" mb-3">
					          <div class="col-6">
					            <button type="submit" class="btn  btn-block btn-flat" style="background-color: #dc7629;color:#fff;"> Submit</button>
					          </div>
					        </div>
				    	</form>
					</center>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		
	$('#close').on('click', function(e) { 
  	 $(this).parent('.error_mesg').remove(); 
 	});
    $(document).on('blur','.cpassword', function (){
        var cpassword = $('.cpassword').val();
        var password = $('.password').val();
        //var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if(password!='')
        {
          if (password != cpassword) {
              alert("Passwords do not match.");
              //$(this).val();
              $('.cpassword').val('');
          }
        }
    });

     $(document).on('blur','.password', function (){
        var cpassword = $('.cpassword').val();
        var password = $('.password').val();
        //var confirmPassword = document.getElementById("txtConfirmPassword").value;
        if(cpassword!='')
        {
          if (password != cpassword) {
              alert("Passwords do not match.");
              //$(this).val();
              $('.password').val('');
          }
        }
    });
	});
</script>