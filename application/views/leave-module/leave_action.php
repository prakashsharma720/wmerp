
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
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('leave_module') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_action_page') ?>
                </li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
                   	<label>  <?= $this->lang->line('leave_application') ?> </label>


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
                    <div class="row">
                    <div class="col-lg-12">
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/leave_action/<?= $id?>">

				    			<input type="hidden" name="leave_type_id" value="<?php echo $leave_type_id;?>">
				    			<input type="hidden" name="leave_count" value="<?php echo $total_count;?>">
				    			<input type="hidden" name="employee_id" value="<?php echo $employee_id;?>">
				    		
								 	<div class="form-group"> 
							      	
											     <?php if(!empty($id)) {
												 $pending ='';
												 $approved ='';
												 $inprocess ='';
												 $rejected ='';
												 $Cancelled='';
												 if($leave_status == 'Pending'){
										    $pending='selected';

											}else if($leave_status == 'Approved'){
												$approved='selected';

											}else if($leave_status == 'On Hold'){
												$inprocess='selected';
                                            }

											else if($leave_status == 'Rejected'){
												$rejected='selected';

											}
											else if($leave_status == 'Cancelled'){
												$Cancelled='selected';

											}

													?>
											<div class="row col-md-12">
													<div class="col-md-12 col-sm-12 ">
														<label class="control-label"> <?= $this->lang->line('leave_status_info') ?></label>
													<select class="form-control" name="leave_status">
															<option value="Pending" <?= $pending ?>> <?= $this->lang->line('pending') ?> </option>
															<option value="Approved" <?= $approved ?>> <?= $this->lang->line('approved') ?> </option>
															<option value="On Hold" <?= $inprocess ?>> <?= $this->lang->line('on_hold') ?></option>
															<option value="Rejected" <?= $rejected ?>> <?= $this->lang->line('rejected') ?></option>
															<?php if($leave_status =="Approved") { ?>
															<option value="Cancelled" <?= $Cancelled ?>> <?= $this->lang->line('cancel') ?></option>
														<?php } ?>
													</select>
													
													</div>
													
												</div>
												
											<?php } ?>
												</div>
												
							        </div>
									
							    </div>
								<span class="help-block"></span>
				           <div class="row col-md-12">
					            	<label class="control-label" style="visibility: hidden;"> Name</label><br>
					            	<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
					            </div>
						    </div>
					        
				        </div>
			        </form>    
				                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">

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
</script> 
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {


		$(".date-picker").datepicker({
			format: "mm/dd/yyyy",
			
			autoclose: true
   		 });

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


	});
</script>
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
		var leave_category = $("input[name='leave_category']:checked").val();
				if(leave_category=='half'){
					$(".half_div").css('display', 'initial');
					$(".report_no").attr('required', 'required');
					$(".full_div").css('display', 'none');
				}
				else {
					$(".half_div").css('display', 'none');
					$(".full_div").css('display', 'initial');
					$(".report_no").removeAttr('required');
				}
		$("input[type='radio']").click(function(){
            var leave_category = $("input[name='leave_category']:checked").val();
				if(leave_category=='half'){
					$(".half_div").css('display', 'initial');
					$(".report_no").attr('required', 'required');
					$(".full_div").css('display', 'none');
				}
				else {
					$(".half_div").css('display', 'none');
					$(".full_div").css('display', 'initial');
					$(".report_no").removeAttr('required');
				}
			});
	});
</script>
<script>
	  $(document).ready(function () {
        $('.date1,.date2').on('change', function () {
            var startDate = $('.date1').val();
            var endDate = $('.date2').val();
			
            var start = new Date(startDate);	
            var end = new Date(endDate);
            if(start < end){
            	var diffDate = (end - start) / (1000 * 60 * 60 * 24);
	            var days = Math.round(diffDate);
							$(".days").val(days);
            }else{
            	alert("End date must be greater than start date");
            	$('.date2').val(' ');
            	$(".days").val(' ');

            }
        });
       //   $('.date1').on('change', function () {
       //      var startDate = $('.date1').val();
       //      var endDate = $('.date2').val();
			
       //      var start = new Date(startDate);
       //      var end = new Date(endDate);
       //      if(start < end){
       //      	var diffDate = (end - start) / (1000 * 60 * 60 * 24);
	      //       var days = Math.round(diffDate);
							// $(".days").val(days);
       //      }else{
       //      	alert("End date must be greater than start date");
       //      	$('.date2').val('');
       //      	$(".days").val('');
       //      }
       //  });
    });
</script>