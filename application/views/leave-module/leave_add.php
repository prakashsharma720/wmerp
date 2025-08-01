
<style>
    .control-label {
margin: 0.7rem
}
</style>
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/Leave/create'); ?>"><?= $this->lang->line('leave_module') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('apply_for_leave') ?>
                </li>
            </ul>
        </div>
		<div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
               <div class="pull-right">
				<label> <?= $this->lang->line('leave_application') ?> : </label><b style="color:#37b5fe;"> <?= $lead_code?></b>
			</div>
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
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/add_new_item">
						<!-- <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>"> -->
						<?php 
							if(!empty($generation_date)) 
							{ 
								$date= date('d-m-Y', strtotime($generation_date)); 
							} else
							{ 
								$date=date('d-m-Y');
							}
						?>
						<div class="form-group"> 

							<div class="row">

								<div class="col-md-4">
									<label class="control-label"><?= $this->lang->line('todays_date') ?> </label> <span class="required">*</span>
									<!-- <input type="date" class="form-control" data-date-formate="d-m-Y" name="apply_date" value="<?php echo $date; ?>" > -->
									<input type="text"  readonly="readonly"  data-date-formate="d-m-Y" name="apply_date" class="form-control date-picker" value="<?php echo $date; ?>" style="pointer-events:none;">
								</div>

								<div class="col-md-4">
									<label class="control-label"> <?= $this->lang->line('leave_reason') ?></label><span class="required">*</span>
									<input type="text"  placeholder="<?= $this->lang->line('enter_reason') ?>" name="leave_reason" class="form-control" value="" required >
								</div>

								<div class="col-md-4">
									<label class="control-label"><?= $this->lang->line('leave_type') ?></label><span class="required">*</span>
									<?php echo form_dropdown('leave_type', $leave_types, '', 'required="required"'); ?>
								</div>
								
								<div class="col-md-4">
    <label class="control-label"><?= $this->lang->line('leave_category') ?></label>
    <div class="d-flex">
		
        <div class="form-check me-4">
            <input class="form-check-input" type="radio" name="leave_category" id="leave_full" value="full" checked>
            <label class="form-check-label" for="leave_full"><?= $this->lang->line('full') ?></label>
        </div>

        <div class="form-check me-4">
            <input class="form-check-input" type="radio" name="leave_category" id="leave_half" value="half">
            <label class="form-check-label" for="leave_half"><?= $this->lang->line('half') ?></label>
        </div>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="leave_category" id="leave_gatepass" value="gatepass">
            <label class="form-check-label" for="leave_gatepass"><?= $this->lang->line('gatepass') ?></label>
        </div>
    </div>
</div>


								<!-- Full Day Divs -->
								<div class="col-md-3 full_div">
									<label class="control-label"> <?= $this->lang->line('from_date') ?> </label>
									<input type="text" class="form-control date1" id="startDate" name="from_date">

									<!-- <input type="date" class="form-control date1 fullday"  id="date_picker" name="from_date" value="" data-date-formate="dd-mm-yyyy"> -->
								</div>
								<div class="col-md-3 full_div">
									<label class="control-label"> <?= $this->lang->line('upto_date') ?> </label>
									<input type="text" class="form-control date2" id="dueDate" name="upto_date">

									<!-- <input type="date" class="form-control date2 fullday" id="date_picker_to" name="upto_date" data-date-formate="dd-mm-yyyy"> -->
								</div>
								<div class="col-md-2 full_div">	<br>
									<label for=""><?= $this->lang->line('total_days') ?></label>
									<br>
									<input type="text" name="leave_count"  class="form-control days full_div" class="form-control fullday" style="visibility: visible;" readonly>
								</div>
								<!-- Full Day Divs -->

								<!-- Half Day Divs -->
								<div class="col-md-4 half_div">
									<label class="control-label"> Select Date   </label>
									<input type="date"  name="halfday_date" id="half_date" class="form-control halfday">
								</div>

								<div class="col-md-4 half_div">
									<label class="control-label"> <?= $this->lang->line('half_day_type') ?></label>
									<select class="form-control halfday" name="halfday_type">
										<option value="9.30AM To 1.45PM" > <?= $this->lang->line('first_half') ?> </option>
										<option value="1.45PM To 6PM" > <?= $this->lang->line('second_half') ?> </option>
									</select>
								</div>
								<!-- / Half Day Divs -->

								<!-- Gatepass Divs -->
								<div class="col-md-4 gatepass_div">
									<label class="control-label"> Select Date </label>
									<input type="date" class="form-control gatepass" id="gatepass_date" name="gate_date" value="">
									<!-- <input type="text" data-date-formate="dd-mm-yyyy" name="gate_date" class="form-control date-picker gatepass" value="<?php echo $date;?>"> -->
								</div>

								<div class="col-md-2 gatepass_div">
									<label class="control-label"> <?= $this->lang->line('from_time') ?></label>
									<input type="time" id="gate_time_from" name="gate_time_from" min="10`:00" max="18:00" class="form-control">
								</div>

								<div class="col-md-2 gatepass_div">
									<label class="control-label"> <?= $this->lang->line('to_time') ?></label>
									<input type="time" id="gate_time_to" name="gate_time_to"  class="form-control" value="" readonly>
								</div>
								<!-- / Gatepass Divs -->

								<div class="col-md-12">
									<label class="control-label"> <?= $this->lang->line('messgae') ?> <span class="required"><?= $this->lang->line('message') ?>*</span></label>
									<textarea class="form-control message" rows="3" placeholder="<?= $this->lang->line('enter_message') ?>" name="message" value="" requireds></textarea>
								</div>

								<span class="help-block">
									<!-- help block -->
								</span>

								<div class="col-md-12">
									<label class="control-label" style="visibility: hidden;"> Name</label><br>
									<button type="submit" class="btn btn-primary btn-block"> <?= $this->lang->line('apply') ?>
									</button>
								</div>

							</div>
							<!-- / Row -->
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
		
		var leave_category = $("input[name='leave_category']:checked").val();
		if(leave_category=='half') {
			$(".half_div").css('display', 'initial');
			$(".full_div").css('display', 'none');
			$(".gatepass_div").css('display', 'none');
			
			$(".halfday").attr('required', 'required');
			$(".fullday").removeAttr('required');
			$(".gatepass").removeAttr('required');
			$(".gatepass").val('');
		} 
		if(leave_category=='full') {
			$(".full_div").css('display', 'initial');
			$(".gatepass_div").css('display', 'none');
			$(".half_div").css('display', 'none');
			
			$(".fullday").attr('required', 'required');
			$(".halfday").removeAttr('required');
			$(".halfday").val('');
			$(".gatepass").removeAttr('required');
			$(".gatepass").val('');
		} 
		if(leave_category=='gatepass') {
			$(".gatepass_div").css('display', 'initial');
			$(".half_div").css('display', 'none');
			$(".full_div").css('display', 'none');
			
			$(".gatepass").attr('required', 'required');
			$(".fullday").removeAttr('required');
			$(".halfday").removeAttr('required');
			$(".halfday").val('');
		}

		$("input[type='radio']").click(function(){
            var leave_category = $("input[name='leave_category']:checked").val();
			if(leave_category=='half') {
				$(".half_div").css('display', 'initial');
				$(".full_div").css('display', 'none');
				$(".gatepass_div").css('display', 'none');
			
				$(".halfday").attr('required', 'required');
				$(".fullday").removeAttr('required');
				$(".gatepass").removeAttr('required');
			} 
			if(leave_category=='full') {
				$(".full_div").css('display', 'initial');
				$(".half_div").css('display', 'none');
				$(".gatepass_div").css('display', 'none');
			
				$(".fullday").attr('required', 'required');
				$(".halfday").removeAttr('required');
				$(".gatepass").removeAttr('required');
			} 
			if(leave_category=='gatepass') {
				$(".gatepass_div").css('display', 'initial');
				$(".half_div").css('display', 'none');
				$(".full_div").css('display', 'none');
			
				$(".gatepass").attr('required', 'required');
				$(".fullday").removeAttr('required');
				$(".halfday").removeAttr('required');
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
            if(start < end) {
            	var diffDate = (end - start) / (1000 * 60 * 60 * 24);
	            var days = Math.round(diffDate);
				$(".days").val(days);
            } else {
            	alert("End date must be greater than start date");
            	$('.date2').val(' ');
            	$(".days").val(' ');
            }
        });
    });
</script>

<script>
	$(document).on('change','#gate_time_from',function(){
		var start_time  =  $('#gate_time_from').val();
		var start_hours =  $('#gate_time_from').val().substr(0, 2);
		var start_minuts=  start_time.substr(start_time.length - 2);
		var end_hours   =  parseInt(start_hours)+2;
		var end_time	= end_hours.toString().concat(":", start_minuts.toString());
		$( "#gate_time_to" ).val(end_time.toString());
	});
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.2.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fromInput = document.getElementById("date_picker");
    const toInput = document.getElementById("date_picker_to");

    // Convert PHP holidays array into JS array
    const holidays = <?php echo json_encode($holidays); ?>;

    // Format date to yyyy-mm-dd
    function formatDate(dateObj) {
        const yyyy = dateObj.getFullYear();
        const mm = String(dateObj.getMonth() + 1).padStart(2, '0');
        const dd = String(dateObj.getDate()).padStart(2, '0');
        return `${yyyy}-${mm}-${dd}`;
    }

    // Set today's date
    const today = new Date();
    const todayStr = formatDate(today);
    fromInput.value = todayStr;
    fromInput.min = todayStr;

    // Set tomorrow as default for "to" date
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const tomorrowStr = formatDate(tomorrow);
    toInput.value = tomorrowStr;
    toInput.min = todayStr;

    // Auto-update toInput when fromInput changes
    fromInput.addEventListener("change", function () {
        const fromDate = new Date(this.value);
        const nextDay = new Date(fromDate);
        nextDay.setDate(fromDate.getDate() + 1);
        toInput.value = formatDate(nextDay);
        toInput.min = this.value;
    });

    // Block holiday selection
    function blockHoliday(input) {
        input.addEventListener("input", function () {
            if (holidays.includes(this.value)) {
                alert("Selected date is a holiday. Please choose another date.");
                this.value = "";
            }
        });
    }

    blockHoliday(fromInput);
    blockHoliday(toInput);
});

</script>	