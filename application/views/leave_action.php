<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title pull-left"><?= $page_title ?></h3>
        <div class="pull-right ">
        	<label> Leave Application : </label>
			<b style="color:#37b5fe;"> </b>
		</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row">
		      		<div class="col-md-12">
		      	
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
														<label class="control-label">Leave Status</label><span> (Take any action on lead)</span>
													<select class="form-control" name="leave_status">
															<option value="Pending" <?= $pending ?>> Pending </option>
															<option value="Approved" <?= $approved ?>> Approved </option>
															<option value="On Hold" <?= $inprocess ?>> On Hold</option>
															<option value="Rejected" <?= $rejected ?>> Rejected</option>
															<?php if($leave_status =="Approved") { ?>
															<option value="Cancelled" <?= $Cancelled ?>> Cancel</option>
														<?php } ?>
													</select>
													</div>
												</div>
											<?php } ?>
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