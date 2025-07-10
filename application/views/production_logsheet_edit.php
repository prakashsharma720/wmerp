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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Production_logsheets/edit_dsr/<?= $id?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date Of Production <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PL Number <span class="required">*</span></label>
			            	
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
				    		<textarea class="form-control " rows="2" placeholder="Enter Remarks here" name="remarks" value="<?= $remarks ?>" ><?= $remarks ?></textarea>
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
			        					<th > M/C Star Time </th>
										<th > M/C Stop Time </th>
										<th > Total Time (Hrs) </th>
										<th > Down Time (Hrs)</th>
										<th > Down Reason </th>
										<th > Actual Time (Hrs)</th>
			        					<th > Finsh Good </th>
			        					<th > Lot No.</th>
			        					<th > Batch No.</th>
										<th > Packing Size</th> 
										<th > No Of Bags</th> 
										<th > Production In MT</th>
										<th > KWH Opening </th>
										<th > KWH Closing </th>
										<th > KWH Consumed </th>
										<th > Unit Per MT </th>
										<th > Per Hour Production </th>
										<th > Tailing Qty (Kg) </th>
										<th > Tailing PER(%) </th>
										<th > Mill (RPM) </th>
										<th > Mill (AMP) </th>
										<th > BLOWER (Hz) </th>
										<th > BLOWER (AMP) </th>
										<th > SCREW (RPM) </th>
										<th > AIR WASHER (RPM) </th>
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			<?php 
			        				if(!empty($production_details)){
			        				$i=1; foreach ($production_details as $key => $po_detail) { 
			        						//print_r ($gir_detail);
			        			?>
			        			<tr class="main_tr1">
									<td > <?= $i?></td>
									<td>
									 	<div class="input-group">
						                  <div class="input-group-append">
						                  	<input type="date" class="form-control date1" name="date1[]"  value="<?= $po_detail['machine_start_date'] ?>" />
						                    <span class="input-group-text">
						                    	<select name="hrs1[]" class="form-control" style="width:80px;">
						                    	<?php foreach ($hours as $value) : ?>
												 <?php if ($value == $po_detail['hrs1']): ?>
							                           <option value="<?= $value ?>" selected ><?= $value ?></option>
							                        <?php else: ?>
							                             <option value="<?= $value ?>"><?= $value ?></option>
							                        <?php endif;   ?>
							                	<?php endforeach; ?>
						                    	</select>
						                    	&nbsp;
						                    	<select name="min1[]" class="form-control" style="width:80px;">
						                    	<?php foreach ($minutes as $value) : ?>
							                       <?php if ($value == $po_detail['min1']): ?>
							                           <option value="<?= $value ?>" selected ><?= $value ?></option>
							                        <?php else: ?>
							                             <option value="<?= $value ?>"><?= $value ?></option>
							                        <?php endif;   ?>
							                	<?php endforeach; ?>
						                    	</select>
						                    	
						                    </span>
						                  </div>
						               	</div> 
									</td>
									<td>
										<div class="input-group">
						                  <div class="input-group-append">
						                  	<input type="date" class="form-control date2" name="date2[]"  value="<?= $po_detail['machine_stop_date'] ?>" />
						                    <span class="input-group-text">
						                    <select name="hrs2[]" class="form-control" style="width:80px;">
						                    	<?php foreach ($hours as $value) : ?>
												 <?php if ($value == $po_detail['hrs2']): ?>
							                           <option value="<?= $value ?>" selected ><?= $value ?></option>
							                        <?php else: ?>
							                             <option value="<?= $value ?>"><?= $value ?></option>
							                        <?php endif;   ?>
							                	<?php endforeach; ?>
						                    	</select>
						                    	&nbsp;
						                    	<select name="min2[]" class="form-control" style="width:80px;">
						                    	<?php foreach ($minutes as $value) : ?>
							                       <?php if ($value == $po_detail['min2']): ?>
							                           <option value="<?= $value ?>" selected ><?= $value ?></option>
							                        <?php else: ?>
							                             <option value="<?= $value ?>"><?= $value ?></option>
							                        <?php endif;   ?>
							                	<?php endforeach; ?>
						                    	</select>
						                    </span>
						                  </div>
						               	</div> 
									</td>
									<td>
										 <input type="text"  placeholder="HH.MM" name="machine_total_time[]" class="form-control machine_total_time"  value="<?= $po_detail['machine_total_time'] ?>" autofocus style="width:150px;"  >
									</td>
									<td>
										 <input type="text"  placeholder="HH.MM" name="machine_down_time[]" class="form-control machine_down_time"  autofocus style="width:150px;"  value="<?= $po_detail['machine_down_time'] ?>">
									</td>
									<td>
										<textarea class="form-control " rows="2" placeholder="Enter down reason" name="down_reason[]" style="width:150px;" value="<?= $po_detail['down_reason'] ?>"><?= $po_detail['down_reason'] ?></textarea>
									</td>
									<td>
										 <input type="text" placeholder="HH.MM" name="machine_actual_time[]" class="form-control machine_actual_time"  value="<?= $po_detail['machine_actual_time'] ?>" autofocus style="width:120px;"  >
									</td>
									<td> 
										<select name="finish_good_id[]" class="form-control products" style="width:350px;" required>
										<option value=""> Select Grade</option>
								        <?php if ($items): ?> 
								            <?php foreach ($items as $value) : ?>
											        <?php if ($value['id'] == $po_detail['finish_good_id']): ?>
							                           <option value="<?= $value['id'] ?>" selected ><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
							                        <?php else: ?>
							                            <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
							                        <?php endif;   ?>
										        <?php endforeach; ?>
								            <?php else: ?>
								                <option value="0">No result</option>
								            <?php endif; ?>
										</select>
						   			</td>
						   			<td>
										<input type="text"  placeholder="Enter Lot No" name="lot_no[]" class="form-control"  style="width: 150px;"  value="<?= $po_detail['lot_no']?>" autofocus  >
									</td>
						   			<td>
										<input type="text"  placeholder="Enter Batch No" name="batch_no[]" class="form-control"  value="<?= $po_detail['batch_no']?>" autofocus style="width: 150px;" >
									</td>
									<td>
										<select name="packing_size[]" class="form-control packing_size" required="required"  style="width:100px;" >
							                <?php
							                 if ($packing_sizes): ?> 
							                  <?php 
							                    foreach ($packing_sizes as $key => $value) : ?>
							                        <?php 
														if ($value == $po_detail['packing_size']): ?>
								                            <option value="<?= $key?>" selected><?= $value ?></option>
								                        <?php else: ?>
								                            <option value="<?= $key ?>"><?= $value ?></option>
								                        <?php endif;   ?>
							                    <?php   endforeach;  ?>
							                <?php else: ?>
							                    <option value="0">No result</option>
							                <?php endif; ?>
						        		</select>
									</td> 
									<td>
										<input type="text"  placeholder="No of Bags" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;"  value="<?= $po_detail['no_of_bags']?>" >
									</td>
									
									<td>
										<input type="text"  placeholder="Production In MT" name="production_in_mt[]" class="form-control production_in_mt"  autofocus  style="width:150px;"  value="<?= $po_detail['production_in_mt']?>" readonly >
									</td>
									<td >
										<input type="text"  placeholder="KWH Opening" name="kwh_opening[]" class="form-control kwh_opening"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  value="<?= $po_detail['kwh_opening']?>" style="width:150px;" >
									</td>
									<td >
										<input type="text"  placeholder="KWH Closing" name="kwh_closing[]" class="form-control kwh_closing"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  value="<?= $po_detail['kwh_closing']?>" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Total KWH" name="kwh_consumed[]" class="form-control kwh_consumed"  value="<?= $po_detail['kwh_consumed']?>" autofocus style="width:150px;" readonly >
									</td>
									<td>
										<input type="text"  placeholder="Unit/MT" name="unit_per_mt[]" class="form-control unit_per_mt"   value="<?= $po_detail['unit_per_mt']?>" autofocus style="width:150px;" readonly >
									</td>
									<td>
										<input type="text"  placeholder="Production / Hr" name="per_hour_production[]" class="form-control per_hour_production"  autofocus style="width:150px;" value="<?= $po_detail['per_hour_production']?>" readonly >
									</td>
									<td>
										<input type="text"  placeholder="Tailing Qty" name="tailing_qty[]" class="form-control tailing_qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $po_detail['tailing_qty']?>" style="width:150px;" >
									</td>
									<td>
										<input type="text"  placeholder="Tailing %" name="tailing_per[]" class="form-control tailing_per"  value="<?= $po_detail['tailing_per']?>" autofocus readonly="readonly" >
									</td>
									<td>
										<input type="text"  placeholder="Mill RPM" name="mill_rpm[]" class="form-control mill_rpm"  value="<?= $po_detail['mill_rpm']?>" autofocus style="width:150px;"  >
									</td>
									<td>
										<input type="text"  placeholder="Mill AMP" name="mill_amp[]" class="form-control mill_amp"  value="<?= $po_detail['mill_amp']?>" autofocus style="width:150px;"  >
									</td>
									<td>
										<input type="text"  placeholder="Blower HRZ" name="blower_in_hrz[]" class="form-control blower_in_hrz" value="<?= $po_detail['blower_in_hrz']?>"  autofocus style="width:150px;"  >
									</td>
									<td>
										<input type="text"  placeholder="Blower AMP" name="blower_amp[]" class="form-control blower_amp" value="<?= $po_detail['blower_amp']?>" autofocus style="width:150px;"  >
									</td>
									<td>
										<input type="text"  placeholder="Screw RPW" name="screw_rpw[]" class="form-control screw_rpw" value="<?= $po_detail['screw_rpw']?>" autofocus style="width:150px;"  >
									</td>
									<td>
										<input type="text"  placeholder="Air Washer RPM" name="air_washer_rpm[]" class="form-control air_washer_rpm"  autofocus style="width:150px;" value="<?= $po_detail['air_washer_rpm']?>" >
									</td>
									<td>
										<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
										<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
									</td>
								</tr>
			        			<?php $i++; } } ?>
			        			</tbody>
			        			
			        			<tfoot>
			        				<tr>
			        					<td colspan="3" style="text-align: right;"><b> Total </b></td>
			        					
			        					<td colspan="">
			        						<input type="text"  placeholder="HH.MM" name="total_machine_total_time" class="form-control total_machine_total_time"  value="<?php echo $total_machine_total_time; ?>" required >
			        					</td>
			        					<td colspan="2">
			        						<input type="text" placeholder="HH.MM" name="total_machine_down_time" class="form-control total_machine_down_time"  value="<?php echo $total_machine_down_time; ?>"  required>
			        					</td>
			        					<td >
			        						<input type="text"  placeholder="HH.MM" name="total_actual_time" class="form-control total_actual_time "  value="<?php echo $total_actual_time; ?>" required >
			        					</td>
			        					<td colspan="4" >
			        						<input type="text"  placeholder="Finish Good Details"  class="form-control"readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Bags" name="total_bags" class="form-control total_bags"  value="<?= $total_bags ?>" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Propduction" name="total_production_in_mt" class="form-control total_production_in_mt"  value="<?= $total_production ?>" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Opening" name="total_opening" class="form-control total_opening"  value="<?= $total_opening ?>" readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Closing" name="total_closing" class="form-control total_closing"  value="<?= $total_closing ?>" readonly >
			        					</td>
			        					<td >
			        						<input type="text"  placeholder="Total KWH" name="total_kwh_consumed" class="form-control total_kwh"  value="<?= $total_kwh_consumed	 ?>" readonly >
			        					</td>
			        					
			        					<!-- <td colspan="">
			        						<input type="text"  placeholder="Total" name="total1" class="form-control "  value="" readonly >
			        					</td> -->
			        				<!-- 	<td colspan="">
			        						<input type="text"  placeholder="Total Tailing" name="total_tailing" class="form-control total_tailing"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="total2" class="form-control "  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total RPM" name="total_rpm" class="form-control total_rpm"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total AMP" name="total_mill_amp" class="form-control total_mill_amp"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total HZ" name="total_hrz" class="form-control total_hrz"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total AMP" name="total_blower_amp" class="form-control total_blower_amp"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Screw(RPM)" name="total_screw" class="form-control total_screw"  value="" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Air(RPM)" name="total_air_rpm" class="form-control total_air_rpm"  value="" readonly >
			        					</td> -->
			        				</tr>
			        			</tfoot>
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
				<div class="input-group">
                  <div class="input-group-append">
                  	<input type="date" class="form-control date2" name="date2[]"  value="" />
                    <span class="input-group-text">
                    	<!-- <input type="time" class="time2" data-theme="a" data-clear-btn="true" name="time2[]"  value=""> -->
                    	<select name="hrs2[]" class="form-control" style="width:80px;">
                    	<?php foreach ($hours as $value) : ?>
	                        <option value="<?= $value ?>"><?= $value ?></option>
	                	<?php endforeach; ?>
                    	</select>&nbsp;
                    	<select name="min2[]" class="form-control" style="width:80px;">
                    	<?php foreach ($minutes as $value) : ?>
	                        <option value="<?= $value ?>"><?= $value ?></option>
	                	<?php endforeach; ?>
                    	</select>
                    </span>
                  </div>
               	</div> 
			</td>
			<td>
				<!-- <div  id="diff"> </div> -->
				 <input type="text"  placeholder="HH.MM" name="machine_total_time[]" class="form-control machine_total_time"  autofocus style="width:150px;"  >
			</td>
			<td>
				<!-- <div  id="diff"> </div> -->
				 <input type="text"  placeholder="HH.MM" name="machine_down_time[]" class="form-control machine_down_time"  autofocus style="width:150px;"  >
			</td>
			<td>
				<textarea class="form-control " rows="2" placeholder="Enter down reason" name="down_reason[]" style="width:150px;"></textarea>
			</td>
			<td>
				 <input type="text" placeholder="HH.MM" name="machine_actual_time[]" class="form-control machine_actual_time"  autofocus style="width:120px;"  >
			</td>
			<td> 
			<select name="finish_good_id[]" class="form-control products" style="width:250px;" required>
				<option value=""> Select Item</option>
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
				<select name="packing_size[]" class="form-control packing_size" required="required"  style="width:100px;" >
	                <?php
	                 if ($packing_sizes): ?> 
	                  <?php 
	                    foreach ($packing_sizes as $key => $value) : ?>
	                        <?php 

								if ($value == $packing_size): ?>
		                            <option value="<?= $key?>" selected><?= $value ?></option>
		                        <?php else: ?>
		                            <option value="<?= $key ?>"><?= $value ?></option>
		                        <?php endif;   ?>
	                    <?php   endforeach;  ?>
	                <?php else: ?>
	                    <option value="0">No result</option>
	                <?php endif; ?>
        		</select>
			</td> 
			<td>
				<input type="text"  placeholder="No of Bags" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			
			<td>
				<input type="text"  placeholder="Production In MT" name="production_in_mt[]" class="form-control production_in_mt"  autofocus  style="width:150px;" readonly >
			</td>
			<td >
				<input type="text"  placeholder="KWH Opening" name="kwh_opening[]" class="form-control kwh_opening"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td >
				<input type="text"  placeholder="KWH Closing" name="kwh_closing[]" class="form-control kwh_closing"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Total KWH" name="kwh_consumed[]" class="form-control kwh_consumed"  autofocus style="width:150px;" readonly >
			</td>
			<td>
				<input type="text"  placeholder="Unit/MT" name="unit_per_mt[]" class="form-control unit_per_mt"  autofocus style="width:150px;" readonly >
			</td>
			
			<td>
				<input type="text"  placeholder="Production / Hr" name="per_hour_production[]" class="form-control per_hour_production"  autofocus style="width:150px;" readonly >
			</td>
			<td>
				<input type="text"  placeholder="Tailing Qty" name="tailing_qty[]" class="form-control tailing_qty"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Tailing %" name="tailing_per[]" class="form-control tailing_per"  autofocus readonly="readonly" >
			</td>
			<td>
				<input type="text"  placeholder="Mill RPM" name="mill_rpm[]" class="form-control mill_rpm"  autofocus style="width:150px;"  >
			</td>
			<td>
				<input type="text"  placeholder="Mill AMP" name="mill_amp[]" class="form-control mill_amp"  autofocus style="width:150px;"  >
			</td>
			<td>
				<input type="text"  placeholder="Blower HRZ" name="blower_in_hrz[]" class="form-control blower_in_hrz"  autofocus style="width:150px;"  >
			</td>
			<td>
				<input type="text"  placeholder="Blower AMP" name="blower_amp[]" class="form-control blower_amp"  autofocus style="width:150px;"  >
			</td>
			<td>
				<input type="text"  placeholder="Screw RPW" name="screw_rpw[]" class="form-control screw_rpw"  autofocus style="width:150px;"  >
			</td>
			<td>
				<input type="text"  placeholder="Air Washer RPM" name="air_washer_rpm[]" class="form-control air_washer_rpm"  autofocus style="width:150px;"  >
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
/*function append(dl, dtTxt, ddTxt) {
  var dt = document.createElement("dt");
  var dd = document.createElement("dd");
  dt.textContent = dtTxt;
  dd.textContent = ddTxt;
  dl.appendChild(dt);
  dl.appendChild(dd);
}

$(document).ready(function() {

  var today = new Date();
  $('.date1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate() + 1)).slice(-2));
  $('.date2').val($('.date1').val());
  $('.time1').val('00:00');
  $('.time2').val('00:00');
  

});*/

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
			//$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}
		$(document).on('keyup','.no_of_bags,.production_in_mt,.tailing_qty,.mill_rpm,.mill_amp,.blower_in_hrz,.blower_amp,.screw_rpw,.air_washer_rpm',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
		$(document).on('change','.packing_size,.date1,.date2,.time1,.time2',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
		

	    $(document).on('blur','.kwh_opening,.kwh_closing',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });


		function calculate_total(table)
		{
			var packing_size=0;
			var tailing_qty=0;
			var no_of_bags=0;
			var total_bags=0;
			var production_in_mt=0;
			var per_hr_production=0;
			var kwh_opening=0;
			var kwh_closing=0;
			var kwh_consumed=0;
			var unit_per_mt=0;
			var total_production_in_mt=0;
			var grand_actual_total_time=0;
			var grand_total_hrs=0;
			
			var actual_total_mins=0;
			var total_opening=0;
			var total_closing=0;
			var total_kwh=0;
			var total_kwh=0;
			var total_tailing=0;
			var total_rpm=0;
			var total_mill_amp=0;
			var total_hrz=0;
			var total_blower_amp=0;
			var total_screw=0;
			var total_air_rpm=0;
			var machine_total_time=0;
			var machine_actual_time=0;

			table.find("tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
					/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				//machine_total_time=parseFloat($(this).find("td:nth-child(4) input.machine_total_time").val());
				//machine_actual_time=parseFloat($(this).find("td:nth-child(5) input.machine_actual_time").val());
				packing_size = $(this).find('td:nth-child(11) select.packing_size option:selected').val();
				no_of_bags=parseFloat($(this).find("td:nth-child(12) input.no_of_bags").val());
				kwh_opening=parseFloat($(this).find("td:nth-child(14) input.kwh_opening").val());
				kwh_closing=parseFloat($(this).find("td:nth-child(15) input.kwh_closing").val());
				tailing_qty=parseFloat($(this).find("td:nth-child(19) input.tailing_qty").val())/1000;
				var mill_rpm=parseFloat($(this).find("td:nth-child(21) input.mill_rpm").val());
				var mill_amp=parseFloat($(this).find("td:nth-child(22) input.mill_amp").val());
				var blower_in_hrz=parseFloat($(this).find("td:nth-child(23) input.blower_in_hrz").val());
				var blower_amp=parseFloat($(this).find("td:nth-child(24) input.blower_amp").val());
				var screw_rpw=parseFloat($(this).find("td:nth-child(25) input.screw_rpw").val());
				var air_washer_rpm=parseFloat($(this).find("td:nth-child(26) input.air_washer_rpm").val());
				if(isNaN(mill_rpm)){mill_rpm =0;}
				if(isNaN(grand_actual_total_time)){grand_actual_total_time =0.00;}
				if(isNaN(mill_amp)){mill_amp =0;}
				if(isNaN(blower_in_hrz)){blower_in_hrz =0;}
				if(isNaN(blower_amp)){blower_amp =0;}
				if(isNaN(screw_rpw)){screw_rpw =0;}
				if(isNaN(air_washer_rpm)){air_washer_rpm =0;}
				if(isNaN(tailing_qty)){tailing_qty =0;}
				if(isNaN(per_hr_production)){per_hr_production =0;}
				//var qty=parseFloat($(this).find("td:nth-child(7) input.qty").val());
				//alert(no_of_bags);
			    //var dl = document.getElementById("diff");
			   /* var date1 = new Date($(this).find('td:nth-child(2) input.date1').val() + " " + $(this).find('td:nth-child(2) input.time1').val()).getTime();
			   	var date2 = new Date($(this).find('td:nth-child(3) input.date2').val() + " " + $(this).find('td:nth-child(3) input.time2').val()).getTime();

			    var msec = date2 - date1;
			    var mins = Math.floor(msec / 60000);
			    var hrs = Math.floor(mins / 60);
			    mins = mins % 60;*/
			    //alert(hrs);
			    //alert(mins);
			   	//var time=hrs;
			  	//var time=mins;
			    //append(dl, "In hours: ", hrs + " hours, " + mins + " minutes");
			    /*var time=parseInt(hrs)+'.'+parseInt(mins);*/
			    //var total_time=time.split(' ');
			    //var total_hrs=total_time[0];
			   /* var total_hrs1 = time.split('.');
			    var total_hrs11 = total_hrs1[0];
			    var total_mins12 = total_hrs1[1];
			    grand_total_hrs=grand_total_hrs+parseInt(total_hrs11);
			    grand_total_mins=grand_total_mins+parseInt(total_mins12);
			    if(grand_total_mins >59){
			    	grand_total_hrs=grand_total_hrs+1;
			    	grand_total_mins=grand_total_mins-60;
			    	grand_total_time=parseInt(grand_total_hrs)+'.'+grand_total_mins;
			    }else{
			    	grand_total_time=parseInt(grand_total_hrs)+'.'+grand_total_mins;
			    }*/
			    //alert(total_hrs);
			   // $(this).find("td:nth-child(4) input.machine_total_time").val(time);
			   
			   /*	var machine_down_time=$(this).find("td:nth-child(5) input.machine_down_time").val();
			   	var down_time = machine_down_time.split('.');
			    var down_time_hrs = down_time[0];
			    var down_time_mins = down_time[1];*/
			    //var act_hrs=total_hrs11-down_time_hrs;
			    /*if(total_mins12==0 && down_time_mins==0){
			    	var act_mins='0';
			    } 
			    if(total_mins12==0 && down_time_mins>=0){
			    	var act_mins=60-down_time_mins;
			    }
			    if(total_mins12>=0 && down_time_mins==0){
			    	var act_mins=60-total_mins12;
			    }

			    if(total_mins12 > down_time_mins){
			    	var act_mins=total_mins12-down_time_mins;
				}else{
					var act_mins=down_time_mins-total_mins12;
				}
				if(total_hrs11 > down_time_hrs){
			    	var act_hrs=total_hrs11-down_time_hrs;
				}else{
					var act_hrs=down_time_hrs-total_hrs11;
				}*/

			    //actual_total_hrs=grand_total_hrs+parseInt(total_hrs111);
			   	//actual_total_mins=grand_total_mins+parseInt(total_mins112);
			    /*if(act_mins >59){
			    	 	actual_total_hrs=act_hrs+1;
			    		actual_total_mins=act_mins-60;
			    	grand_actual_total_time=parseInt(actual_total_hrs)+'.'+actual_total_mins;
			    }else{
			    	grand_actual_total_time=parseInt(act_hrs)+'.'+act_mins;
			    }*/

			   //var machine_actual_time=time-machine_down_time;
			 /*  	var grand_total_hrs=0;
				var grand_total_mins=0;
				var grand_total_time=0;
				var machine_total_time=$(this).find("td:nth-child(4) input.machine_total_time").val();
				var machine_down_time=$(this).find("td:nth-child(5) input.machine_down_time").val();
				var machine_total_time_data=machine_total_time.split('.');
			    var total_hrs=machine_total_time_data[0];
			    var total_mins=machine_total_time_data[1];
			    var machine_down_time_data = machine_down_time.split('.');
			    var down_hrs = machine_down_time_data[0];
			    var down_mins = machine_down_time_data[1];
			    var total_act_hrs=parseInt(total_hrs)-parseInt(down_hrs);
			    var total_act_mins=parseInt(down_mins)+parseInt(total_mins);
			    if(total_act_mins >59){
			    	grand_total_hrs=total_act_hrs-1;
			    	grand_total_mins=total_act_mins-60;
			    	if(grand_total_mins!='0'){
			    		var asd=60-grand_total_mins;
			    	 	grand_total_hrs=total_act_hrs-1;
			    	}
			    	 
			    	grand_total_time=parseInt(grand_total_hrs)+'.'+asd;
			    }else{
			    	grand_total_time=parseInt(total_act_hrs)+'.'+total_act_mins;
			    }*/
			    //alert(grand_total_time);
				/*$(this).find("td:nth-child(7) input.machine_actual_time").val(grand_total_time.toFixed(2));*/
				machine_actual_time=$(this).find("td:nth-child(7) input.machine_actual_time").val();

				if(isNaN(packing_size))
				{
					packing_size =0;
				}
				if(isNaN(no_of_bags))
				{
					no_of_bags =0;
				}
				if(isNaN(production_in_mt))
				{
					production_in_mt =0;
				}
				if(isNaN(kwh_consumed))
				{
					kwh_consumed =0;
				}
				if(isNaN(unit_per_mt))
				{
					unit_per_mt =0;
				}
				if(isNaN(kwh_opening))
				{
					kwh_opening =0;
				}
				if(isNaN(kwh_closing))
				{
					kwh_closing =0;
				}
				total_bags=total_bags+no_of_bags;
				production_in_mt=packing_size*no_of_bags/1000;
				per_hr_production=parseInt(no_of_bags)/parseFloat(machine_actual_time);
				var tailing_per=parseFloat(tailing_qty)/parseFloat(production_in_mt)*100;
				total_opening=total_opening+kwh_opening;
				total_closing=total_closing+kwh_closing;
				total_tailing=total_tailing+tailing_qty*1000;
				total_rpm=total_rpm+mill_rpm;
				total_mill_amp=total_mill_amp+mill_amp;
				total_hrz=total_hrz+blower_in_hrz;
				total_blower_amp=total_blower_amp+blower_amp;
				total_screw=total_screw+screw_rpw;
				total_air_rpm=total_air_rpm+air_washer_rpm;

				total_production_in_mt=total_production_in_mt+production_in_mt;
				$(this).find("td:nth-child(13) input.production_in_mt").val(production_in_mt.toFixed(2));
				$(this).find("td:nth-child(18) input.per_hour_production").val(per_hr_production.toFixed(2));
				$(this).find("td:nth-child(20) input.tailing_per").val(tailing_per.toFixed(2));

				production_in_mt=parseFloat($(this).find("td:nth-child(13) input.production_in_mt").val());

				if((kwh_closing!='') && (kwh_opening!='')){
					
					if(kwh_closing>=kwh_opening){
						kwh_consumed=kwh_closing-kwh_opening;
					}
					else
					{
						alert('You can not enter KWH Closing Value less than KWH Opening');
						$(this).find("td:nth-child(15) input.kwh_closing").val('');
					}
					unit_per_mt=kwh_consumed/production_in_mt;
					$(this).find("td:nth-child(16) input.kwh_consumed").val(kwh_consumed.toFixed(2));
					$(this).find("td:nth-child(17) input.unit_per_mt").val(unit_per_mt.toFixed(2));
					
				}
				total_kwh=total_kwh+kwh_consumed;
			});
			//$('.total_time').val(grand_total_time.toFixed(2));
			//alert(total_qty);
			
			table.find("tfoot tr input.total_bags").val(total_bags);
			table.find("tfoot tr input.total_production_in_mt").val(total_production_in_mt);
			table.find("tfoot tr input.total_opening").val(total_opening);
			table.find("tfoot tr input.total_closing").val(total_closing);
			table.find("tfoot tr input.total_kwh").val(total_kwh);
			table.find("tfoot tr input.total_time").val(grand_total_time);
			table.find("tfoot tr input.total_tailing").val(total_tailing);
			table.find("tfoot tr input.total_rpm").val(total_rpm);
			table.find("tfoot tr input.total_mill_amp").val(total_mill_amp);
			table.find("tfoot tr input.total_hrz").val(total_hrz);
			table.find("tfoot tr input.total_blower_amp").val(total_blower_amp);
			table.find("tfoot tr input.total_screw").val(total_screw);
			table.find("tfoot tr input.total_air_rpm").val(total_air_rpm);
			//table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			//table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));


		}
		
	});
</script>
