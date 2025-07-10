<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title pull-left"><?= $page_title ?></h3>
        <div class="pull-right ">
        	<label> Leave Application : </label><b style="color:#37b5fe;"> <?= $lead_code?></b>

		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      	
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/add_new_item">

				    			<!-- <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>"> -->
				    			<?php 
				    			if(!empty($generation_date)) 
				    			{ 
				    				$date= date('d-m-Y',strtotime($generation_date)); 
				    			} else
				    			{ 
				    				 $date=date('d-m-Y');
				    			} ;?>
				    		<div class="form-group"> 
					        <div class="row ">
											<div class="col-md-4 col-sm-4">
						            	<label class="control-label">Today's Date </label> <span class="required">*</span>
						                <input type="text" data-date-formate="dd-mm-yyyy" name="apply_date" class="form-control date-picker" value="<?php echo $date;?>" placeholder="dd-mm-yyyy"  required>
			            			</div>

					        	<!-- <div class="col-md-4 category_name">
					            	<label class="control-label"> Employee</label> <span class="required">*</span>
						            	<?php  
						               		echo form_dropdown('employee_id', $employees ,'required="required"') 
						               ?>
						        </div> -->
					        	 <div class="col-md-4">
						            	<label class="control-label"> Leave Reason</label><span class="required">*</span>
						                <input type="text"  placeholder="Enter reason" name="leave_reason" class="form-control" value="" required >
						        </div>
								<div class="col-md-4">
						            	<label class="control-label"> leave Type</label><span class="required">*</span>
										<?php  
						               		echo form_dropdown('leave_type', $leave_types,'required="required"') 
						               ?>
						        </div>
			
										<div class="col-md-4 col-sm-4 ">
			        				<label class="control-label"> Leave category </label>
					        			<div class="form-check">
						               		<input class="form-check-input medical_status" type="radio" name="leave_category" value="full" checked="checked" /> Full
						               		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						               		<input class="form-check-input medical_status" type="radio" name="leave_category" value="half" /> Half
			            				</div>
	            				</div>
            					<div class="col-md-8 col-sm-8 ">
					            	<label class="control-label"> Message <span class="required"> *</span></label>
					               <textarea class="form-control message" rows="3" placeholder="Enter Message" name="message" value="" requireds></textarea>
					            </div>
								</div>
							</div>
						      
								 	<div class="form-group"> 
							      	<div class="row col-md-124">
												<div class="col-md-4 col-sm-4 full_div">
										    <label class="control-label"> From Date    </label>
							                <!-- <input type="text" data-date-formate="dd/mm/yyyy" name="from_date" class="form-control date-picker date1" value="<?php echo date('d/m/yy',strtotime($date));?>" placeholder="mm/dd/yyyy"  required> -->
							                <input type="date" class="form-control date1" name="from_date" value="">
							            </div>
													<div class="col-md-4 col-sm-4 full_div">
							            	<label class="control-label"> Date </label>
							                <!-- <input type="text" data-date-formate="dd/mm/yyyy" name="upto_date" class="form-control date-picker date2" value="<?php echo date('d/m/yy',strtotime('+1 Days'.$date));?>" placeholder="mm/dd/yyyy"  required> -->
							                 <input type="date" class="form-control date2" name="upto_date">
							            </div>
												<div class="col-md-4 full_div">	
													<label for="">Total Days</label>
													<br>
													<input type="text" name="leave_count"  class="form-control days full_div" class="form-control" style="visibility: visible;" readonly>
												</div>
												<div class="col-md-4 col-sm-4 half_div">
							            	<label class="control-label"> Select Date   </label>
							                <input type="text" data-date-formate="dd-mm-yyyy" name="halfday_date" class="form-control date-picker" value="<?php echo $date;?>" placeholder="dd-mm-yyyy"  required>
							            </div>
												<div class="col-md-4 col-sm-4 half_div ">
													<label class="control-label">Half Day Type</label>
													<select class="form-control" name="halfday_type">
														<option value="9.30AM To 1.45PM" > First Half </option>
														<option value="1.45PM To 6PM" > Second Half </option>
														
													</select>
												</div>
							        </div>
							    </div>
						    </div>
					        <span class="help-block"></span>
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