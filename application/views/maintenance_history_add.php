<!-- Add custom CSS here -->

<link href="http://demos.codexworld.com/bootstrap-datetimepicker-add-date-time-picker-input-field/css/bootstrap-datetimepicker.css" rel="stylesheet">
<!-- Add custom CSS here -->

<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


<style type="text/css">
	th,
	td {
		padding: 10px;
	}
</style>

<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title"><?= $title ?></h3>
			<div class="pull-right error_msg"></div>
		</div> <!-- /.card-body -->
		<div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/maintenance_history_records/add_new_record">
				<!-- <input type="hidden" name="pme_code" value="<?= $pme_code ?>"> -->
				<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> Date <span class="required">*</span></label>
						<input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y'); ?>" autofocus required>
					</div>
				</div>
				<br>
				<div class="row col-md-12">
					
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> Department</label>
						<select name="department_id" class="form-control select2 ">
							<option value=""> Select Department</option>
							<?php
							if ($departments) : ?>
								<?php
									foreach ($departments as $value) : ?>
									<?php
											if ($value['id'] == $department_id) : ?>
										<option value="<?= $value['id'] ?>" selected><?= $value['department_name'] . ' (' . $value['department_code'] . ')' ?></option>
									<?php else : ?>
										<option value="<?= $value['id'] ?>"><?= $value['department_name'] . ' (' . $value['department_code'] . ')' ?></option>
									<?php endif;   ?>
								<?php endforeach;  ?>
							<?php else : ?>
								<option value="0">No result</option>
							<?php endif; ?>
						</select>
					</div>
					
					<div class="col-md-4 col-sm-4 ">
					    <label class="control-label"> Register No. <span class="required">*</span></label>
						<input type="text"  name="m_code" class="form-control" value="<?= $pme_code ?> "  autofocus readonly="readonly">
						<input type="hidden" name="pme_code" value="<?php echo $m_code;?>">
						 
						
					</div>
					<div class="col-md-4 col-sm-4 ">
					      <label class="control-label"> Equipment Name</label>
						  <select name="equipment_name[]" class="form-control equipment_name select2"  required>
								<option value=""> Select Name</option>
								<?php if ($plant_machinary_list) : ?>
									<?php foreach ($plant_machinary_list as $k=>$value) : ?>
											<option value="<?php echo $value['id']; ?>"><?php echo $value['name'];?></option>
									<?php endforeach; ?>
								<?php else : ?>
									<option value="0">No result</option>
								<?php endif; ?>
						   </select>
					</div>
				</div>
				<br>
				<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> Maintance Start Date & Time</label>
						<div class="input-group">
							<div class="input-group-append">
								<input type="date" class="form-control date1" name="machine_start_date"  value="" style="width:158px;" />
								<span class="input-group-text">
									<input type="text" id="time1" class="time1" data-theme="a" data-clear-btn="true" name="machin_start_time"  value="" style="width:100px;">
								</span>
							</div>
						
							<!-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
							<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
							<script>
								$(document).ready(function() {
										$('#txtDate').datepicker('setDate', 'today()');
									});
						    </script> -->
							
                		</div>    
					</div>

					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> Maintance Stop Date & Time</label>
						<div class="input-group">
							<div class="input-group-append">
								<input type="date"  class="form-control date2" name="machine_stop_date"  value="" style="width:158px;" />
								<span class="input-group-text">
									<input type="text" id="time2" class="time2" data-theme="a" data-clear-btn="true" name="machin_stop_time"  value="" style="width:100px;">
								</span>
							</div>
                		</div>	

					</div>

					<div class="col-md-4 col-sm-4 ">
					 	<label class="control-label">Machine Down Time (Hrs.) </label>
						  <input type="text"  placeholder="Total Time" name="machine_total_time[]" class="form-control machine_total_time"  autofocus style="width:150px;" readonly >

					</div>
				</div>
				<br>
				<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> Type of Maintenance </label>
						<textarea placeholder=" Maintanance" name="type_maintance[]" class="form-control" style="width:275px;"  autofocus></textarea>

					</div>

					<div class="col-md-4 col-sm-4 ">
					   <label class="control-label"> Details of Maintenance </label>
					   <textarea placeholder=" Maintanance" name="details_maintance[]" class="form-control" style="width:275px;" autofocus></textarea>

					</div>

					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> Parts Replace </label>
						<textarea placeholder="Parts Replaced" name="parts_replaced[]" class="form-control" style="width:275px;" autofocus></textarea>
					</div>
				</div>
				<div class="row col-md-12">
					<div class="col-md-12 col-sm-12 ">
						<label class="control-label" style="visibility: hidden;"> Grade</label>
						<button type="submit" class="btn btn-primary btn-block"> Submit</button>
					</div>
				</div>

				<br>
				
			</form> <!-- /form -->
		</div>
	</div>
</div>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<!-- Custom JavaScript -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://demos.codexworld.com/includes/js/bootstrap.js"></script>
<script src="http://demos.codexworld.com/bootstrap-datetimepicker-add-date-time-picker-input-field/js/bootstrap-datetimepicker.min.js"></script>
<!-- Custom JavaScript -->


<script>

$('#time1').datetimepicker({
    format: 'hh:ii',
    weekStart: 1,
    todayBtn:  true,
    autoclose: true,
    todayHighlight: true,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });

	$('#time2').datetimepicker({
    format: 'hh:ii',
    weekStart: 1,
    todayBtn:  true,
    autoclose: true,
    todayHighlight: true,
    startView: 1,
    minView: 0,
    maxView: 1,
    forceParse: 0
    });


	
</script>

<script type="text/javascript">
	function append(dl, dtTxt, ddTxt) {
  var dt = document.createElement("dt");
  var dd = document.createElement("dd");
  dt.textContent = dtTxt;
  dd.textContent = ddTxt;
  dl.appendChild(dt);
  dl.appendChild(dd);
}

$(document).ready(function() {

  var today = new Date();
  //alert(today);
  $('.date1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate() + 1)).slice(-2));
  $('.date2').val($('.date1').val());
  $('.time1').val('08:00');
  $('.time2').val('08:00');

});



</script>

<script type="text/javascript">
	$(document).ready(function() {
		add_row();
		$('body').on('click', '.addrow', function() {

			var table = $(this).closest('table');
			add_row();
			rename_rows();
			calculate_total(table);
		});

		function add_row() {
			var tr1 = $("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}
		$('body').on('click', '.deleterow', function() {

			var table = $(this).closest('table');
			var rowCount = $("#maintable tbody tr.main_tr1").length;
			if (rowCount > 1) {
				if (confirm("Are you sure to remove row ?") == true) {
					$(this).closest("tr").remove();
					rename_rows();
					calculate_total(table);
				}
			}
		});

		function rename_rows() {
			var i = 0;
			$("#maintable tbody tr.main_tr1").each(function() {
				$(this).find("td:nth-child(1)").html(++i);
				$(this).find("td:nth-child(2) select.worders").select2();
				$(this).find("td:nth-child(3) select.items").select2();
				var rowCount1 = $("#maintable tbody tr.main_tr1").length;
				$('.total_workers').val(rowCount1);

			});
		}
	
        $(document).on('change','.date1,.date2,.time1,.time2',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });

		$(document).ready(function(){
			$(".card-body,.machine_total_time").hover(function(){
				var table=$(this).closest('table');
				calculate_total(table);
			});
			});

			


		function calculate_total(table) {
			
			var total_amount = 0;
            var grand_total_time=0;
			var grand_total_hrs=0;
			var grand_total_mins=0;

			
				//var qty,rate,total=0;
				/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				
				
			
                var start_actual_time  =  $('.date1').val() + " " + $('.time1').val();

				var end_actual_time    =  $('.date2').val() + " " + $('.time2').val();

				start_actual_time = new Date(start_actual_time);
				end_actual_time = new Date(end_actual_time);

				var diff = end_actual_time - start_actual_time;

				var diffSeconds = diff/1000;
				var HH = Math.floor(diffSeconds/3600);
				var MM = Math.floor(diffSeconds%3600)/60;

				var formatted = ((HH < 10)?("0" + HH):HH) + ":" + ((MM < 10)?("0" + MM):MM)
				var output = $('.machine_total_time').val(formatted); 
				// alert(formatted);

		}
	});
</script>

