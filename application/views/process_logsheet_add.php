<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($packing_sizes);
?>
<!-- <link rel="stylesheet" href="<?php echo base_url()."assets/"; ?>plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url()."assets/"; ?>plugins/timepicker/bootstrap-timepicker.min.js"></script> -->

<style type="text/css">
	th,td{
		padding: 10px;
		white-space:nowrap;
		text-transform: uppercase;
	}
</style>
 
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
        <div class="pull-right error_msg">
			
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Process_logsheets/add_new_record">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date Of Process <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PSL Number <span class="required">*</span></label>
			            	
			            	<input type="text" class="form-control" value="<?= $pl_number_view ?>" autocomplete="off" autofocus readonly >
			            	<input type="hidden" name="pl_number" value="<?= $pl_number ?>">
			            </div>
			           <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Department</label>
				            	<select name="department_id" class="form-control select2 ">
									<option value=""> Select Department</option>
					                <?php
					                 if ($departments): ?> 
					                  <?php 
					                    foreach ($departments as $value) : ?>
					                        <?php 
												if ($value['id'] == $department_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['department_name'].' ('.$value['department_code'].')' ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['department_name'].' ('.$value['department_code'].')' ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0">No result</option>
					                <?php endif; ?>
					            </select>
			            </div>
		        	</div>
			        <div class="row col-md-12 ">
		            	<div class="col-md-6 col-sm-6">
		            		 <label  class="control-label"> Mill No <span class="required">*</span></label>
		            		<select name="mill_no" class="form-control" required="required">
								<option value=""> Select Mill No</option>
				                <?php
				                 if ($equipments): ?> 
				                  <?php 
				                    foreach ($equipments as $value) : ?>
				                        <?php 
											if ($value == $mill_no): ?>
					                            <option value="<?= $value ?>" selected><?= $value ?></option>
					                        <?php else: ?>
					                            <option value="<?= $value ?>"><?= $value ?></option>
					                        <?php endif;   ?>
				                    <?php   endforeach;  ?>
				                <?php else: ?>
				                    <option value="0">No result</option>
				                <?php endif; ?>
				            </select>
		            	</div>
		            	<div class="col-md-6 col-sm-6">
				            <label  class="control-label"> Remarks</label>
				    		<textarea class="form-control " rows="2" placeholder="Enter Remarks here" name="remarks" ></textarea>
			    		</div>
			        </div>
					<br>
				<div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table id="maintable">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th >#</th>
			        					<th > M/c Start Date-Time </th> 
			        					<th > Finsh Good </th>
			        					<th > Lot No.</th>
			        					<th > Batch No.</th>
										<th > Previous Bag No</th> 
										<th > Plate Weight</th> 
										<th > Grate Weight</th> 
										<th > Avg Temp Pulverizer</th> 
										<th > Avg Temp Pribbon</th> 
										<th > Avg Temp Hopper</th> 
										<th > Oversize Weight</th> 
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
									<tr class="main_tr1">
										<td >1</td>
										<td>
						                <div class="input-group">
						                  <div class="input-group-append">
						                  	<input type="date" class="form-control date1" name="date1[]"  value="" />
						                    <span class="input-group-text">
						                    	<!-- <input type="time" class="time1" data-theme="a" data-clear-btn="true" name="time1[]"  value=""> -->
						                    	<select name="hrs1[]" class="form-control" style="width:80px;">
						                    	<?php foreach ($hours as $value) : ?>
							                        <option value="<?= $value ?>"><?= $value ?></option>
							                	<?php endforeach; ?>
						                    	</select>
						                    	&nbsp;
						                    	<select name="min1[]" class="form-control" style="width:80px;">
						                    	<?php foreach ($minutes as $value) : ?>
							                        <option value="<?= $value ?>"><?= $value ?></option>
							                	<?php endforeach; ?>
						                    	</select>
						                    	
						                    </span>
						                  </div>
						               	</div> 
									</td>
									<td > 
									<select name="finish_good_id[]" class="form-control select2" style="width:350px !important;" required>
										<option value=""> Select Grade</option>
							            <?php if ($items): ?> 
							                <?php foreach ($items as $value) : ?>
							                       <!--  <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
							                        <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
							                <?php endforeach; ?>
							            <?php else: ?>
							                <option value="0">No result</option>
							            <?php endif; ?>
							        </select>
										
						   			</td>
						   			<td>
										<input type="text"  placeholder="Enter Lot No" name="lot_no[]" class="form-control"  style="width: 150px;" autofocus  >
									</td>
						   			<td>
										<input type="text"  placeholder="Enter Batch No" name="batch_no[]" class="form-control"  autofocus style="width: 150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Previous Bag No" name="previous_bag_no[]" class="form-control previous_bag_no"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									
									<td>
										<input type="text"  placeholder="Plate Weight" name="plate_weight[]" class="form-control plate_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Grate Weight" name="grate_weight[]" class="form-control grate_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Avg Temp" name="avg_temp_pulverizer[]" class="form-control avg_temp_pulverizer"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Avg Temp" name="avg_temp_pribbon[]" class="form-control avg_temp_pribbon"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Avg Temp" name="avg_temp_hopper[]" class="form-control avg_temp_hopper"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Oversize Weight" name="oversize_weight[]" class="form-control oversize_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
									</td>
									<td>
										<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
										<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
									</td>
								</tr>
			        			</tbody>
			        			
			        			<!-- <tfoot>
			        				<tr>
			        					<td colspan="5" style="text-align: right;"><b> Total </b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Bags" name="total_bags" class="form-control total_bags"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Propduction" name="total_production_in_mt" class="form-control total_production_in_mt"  value="" readonly >
			        					</td>
			        				</tr>
			        			</tfoot> -->
			        		</table>
			            </div>
		        	</div>
		        </div>
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> Grade</label>
			                <button type="submit" class="btn btn-primary btn-block"> Submit</button>
		        		</div>
		        	</div>
		    </form> <!-- /form -->
		</div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td >1</td>
			<td>
                <div class="input-group">
                  <div class="input-group-append">
                  	<input type="date" class="form-control date1" name="date1[]"  value="" />
                    <span class="input-group-text">
                    	<!-- <input type="time" class="time1" data-theme="a" data-clear-btn="true" name="time1[]"  value=""> -->
                    	<select name="hrs1[]" class="form-control" style="width:80px;">
                    	<?php foreach ($hours as $value) : ?>
	                        <option value="<?= $value ?>"><?= $value ?></option>
	                	<?php endforeach; ?>
                    	</select>
                    	&nbsp;
                    	<select name="min1[]" class="form-control" style="width:80px;">
                    	<?php foreach ($minutes as $value) : ?>
	                        <option value="<?= $value ?>"><?= $value ?></option>
	                	<?php endforeach; ?>
                    	</select>
                    	
                    </span>
                  </div>
               	</div> 
			</td>
			<td> 
			<select name="finish_good_id[]" class="form-control products" style="width:350px;" required>
				<option value=""> Select Grade</option>
	            <?php if ($items): ?> 
	                <?php foreach ($items as $value) : ?>
	                       <!--  <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
	                        <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
	                <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0">No result</option>
	            <?php endif; ?>
	        </select>
				
   			</td>
   			<td>
				<input type="text"  placeholder="Enter Lot No" name="lot_no[]" class="form-control"  style="width: 150px;" autofocus  >
			</td>
   			<td>
				<input type="text"  placeholder="Enter Batch No" name="batch_no[]" class="form-control"  autofocus style="width: 150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Previous Bag No" name="previous_bag_no[]" class="form-control previous_bag_no"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			
			<td>
				<input type="text"  placeholder="Plate Weight" name="plate_weight[]" class="form-control plate_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Grate Weight" name="grate_weight[]" class="form-control grate_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Avg Temp" name="avg_temp_pulverizer[]" class="form-control avg_temp_pulverizer"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Avg Temp" name="avg_temp_pribbon[]" class="form-control avg_temp_pribbon"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Avg Temp" name="avg_temp_hopper[]" class="form-control avg_temp_hopper"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Oversize Weight" name="oversize_weight[]" class="form-control oversize_weight"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>


<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
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
  $('.date1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate())).slice(-2));
  $('.time1').val('08:00');

});
</script>

<script type="text/javascript">
	$( document ).ready(function() {

		//add_row();
		$('body').on('click','.addrow',function(){
		
			var table=$(this).closest('table');
			add_row();
			 rename_rows();
			 calculate_total(table);
	    });
		

		function add_row(){ 
			var tr1=$("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}
		$('body').on('click','.deleterow',function(){
			
		var table=$(this).closest('table');
		var rowCount = $("#maintable tbody tr.main_tr1").length;
		if (rowCount>1){
			if (confirm("Are you sure to remove row ?") == true) {
				$(this).closest("tr").remove();
				rename_rows();
				calculate_total(table);
			} 
		}
		}); 

		function rename_rows(){
		var i=0;
		$("#maintable tbody tr.main_tr1").each(function(){ 
			$(this).find("td:nth-child(1)").html(++i);
			$(this).find("td:nth-child(3) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}	
	});
</script>
