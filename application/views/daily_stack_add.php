<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*print_r($packing_sizes);
foreach ($packing_sizes as $key => $value) {
	echo $value;exit;
	# code...
}*/
?>
<style type="text/css">
	th,td{
		padding: 20px;
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Daily_stacking_records/add_new_record">
				 <input type="hidden" name="dsr_code" value="<?= $dsr_code ?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('date')?> <span class="">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			           
			           <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> <?=$this ->lang ->line('department')?></label>
				            	<select name="department_id" class="form-control select2 " >
									<option value=""> <?=$this ->lang ->line('select_department')?></option>
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
					                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
					                <?php endif; ?>
					            </select>
			            </div>
			             <div class="col-md-2 col-sm-12">
				            <label  class="control-label"> <?=$this ->lang ->line('total_workers')?></label>
				    		<input type="text" class="form-control total_workers" name="total_workers" value="1" readonly="readonly">
			    		</div>
		        	</div>
			       <!--  <div class="row col-md-12 ">
		            	<div class="col-md-6 col-sm-6">
		            		 <label  class="control-label"> Select Mill No <span class="">*</span></label>
		            		<select name="mill_no" class="form-control" ="">
								<option value=""> Select Mill</option>
				                <?php
				                 if ($equipments): ?> 
				                  <?php 
				                    foreach ($equipments as $value) : ?>
				                        <?php 
											if ($value['id'] == @$mill_no): ?>
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
			        </div> -->
					<br>
				<div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table id="maintable">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th>#</th>
			        					<th style="white-space: nowrap;"><?=$this ->lang ->line('work_location')?></th>
			        					<th style="white-space: nowrap;width: 30%;"> <?=$this ->lang ->line('select_worker_name')?> (Name can be multiple) </th>
			        					<th> <?=$this ->lang ->line('grade_name')?> </th>
			        					<!-- <th> Bag Weight </th> -->
			        					<th colspan="4"> <?=$this ->lang ->line('stacking_up')?> </th>
			        					<th colspan="4"> <?=$this ->lang ->line('stacking_down')?> </th>
										<th> <?=$this ->lang ->line('no_of_bags')?> </th> 
										<!-- <th> Rate Per Bag</th> -->
										<th> <?=$this ->lang ->line('total_amount')?></th>
			        					<th style="white-space: nowrap;"> <?=$this ->lang ->line('action_button')?></th>
			        				</tr>
			        				<tr>
			        					<th colspan="4"></th>
			        					<th> <?=$this ->lang ->line('bag_weight')?> </th>
			        					<th> <?=$this ->lang ->line('no_of_bag')?> </th>
			        					<th> <?=$this ->lang ->line('rate')?> </th>
			        					<th> <?=$this ->lang ->line('total')?> </th>
			        					<th> <?=$this ->lang ->line('bag_weight')?> </th>
			        					<th> <?=$this ->lang ->line('no_of_bag')?> </th>
			        					<th> <?=$this ->lang ->line('rate')?> </th>
			        					<th> <?=$this ->lang ->line('total')?> </th>
										<th colspan="4"></th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			 	<tr class="main_tr1">
							<td >1</td>
							<td >
								<select name="work_location[]" class="form-control locations" style="width:200px;" >
									<option value=""> <?=$this ->lang ->line('select_location')?></option>
						            <?php if ($locations): ?> 
						                <?php foreach ($locations as $value) : ?>
						                        <option value="<?= $value ?>"><?= $value ?></option>
						                <?php endforeach; ?>
						            <?php else: ?>
						                <option value="0"><?=$this ->lang ->line('no_result')?></option>
						            <?php endif; ?>
						        </select>
						    </td>
							<td style="width: 30%;">
				                  <select class="form-control select2 worders" multiple="multiple" data-placeholder="Select Workers" style="width: 350px !important;" name="worker_ids[]" >
				                  
				                  	<option value=""> <?=$this ->lang ->line('select_workers')?></option>
				                    <!-- <option value=""> Select Worker</option> -->
						            <?php if ($workers): ?> 
						                <?php foreach ($workers as $value) : ?>
						               <!--  <?php 
					                    $voucher_no= $value['worker_code']; 
					                    if($voucher_no<10){
					                    $worker_id_code='WC000'.$voucher_no;
					                    }
					                    else if(($voucher_no>=10) && ($voucher_no<=99)){
					                      $worker_id_code='WC00'.$voucher_no;
					                    }
					                    else if(($voucher_no>=100) && ($voucher_no<=999)){
					                      $worker_id_code='WCP0'.$voucher_no;
					                    }
					                    else{
					                      $worker_id_code='WC'.$voucher_no;
					                    }
					               	 ?> -->
						            	<option value="<?= $value['name'] ?>" > <?= $value['name'] ?>
						            	</option>
						            <?php endforeach; ?>
						            <?php else: ?>
						                <option value="0"><?=$this ->lang ->line('no_result')?></option>
						            <?php endif; ?>
				                  </select>
				               
							
							</td>
							<td> 
								<select name="finish_good_id[]" class="form-control items" style="width:250px;" >
									<option value=""> <?=$this ->lang ->line('select_grade')?></option>
						            <?php if ($items): ?> 
						                <?php foreach ($items as $value) : ?>
						                        <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
						                <?php endforeach; ?>
						            <?php else: ?>
						                <option value="0"><?=$this ->lang ->line('no_result')?></option>
						            <?php endif; ?>
						        </select>
				   			</td>
				   			
							<td>
								<select name="bag_weight_stack_up[]" class="form-control bag_weight_stack_up"  style="width: 200px;">
									<option value=""><?=$this ->lang ->line('select_bag_weight')?></option>
									<?php if($packing_sizes):
											foreach($packing_sizes as $k=>$v):
									?>
											<option value="<?php echo $k;?>"><?php echo $v;?></option>
									<?php 	endforeach; ?>
									<?php else: ?>
										<option value="0"><?=$this ->lang ->line('no_result')?></option>
									<?php endif;?>
								</select>
							</td>
							<td>
								<input type="text" placeholder="<?=$this ->lang ->line('no_of_bag')?>" name="no_of_bags_stack_up[]" class="form-control no_of_bags_stack_up"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;" >
							</td>
							<td>
								<input type="text"  placeholder="<?=$this ->lang ->line('rate')?>" name="rate_stack_up[]" class="form-control rate_stack_up"  autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  readonly>
							</td>
							<td>
								<input type="text"  placeholder="<?=$this ->lang ->line('total')?>" name="total_stack_up[]" class="form-control total_stack_up"  autofocus style="width: 150px;" readonly >
							</td>
				   					
   			
										<td>
											<select name="bag_weight_stack_down[]" class="form-control bag_weight_stack_down"  style="width: 200px;">
												<option value=""><?=$this ->lang ->line('select_bag_weight')?></option>
												<?php if($packing_sizes):
														foreach($packing_sizes as $k=>$v):
												?>
														<option value="<?php echo $k;?>"><?php echo $v;?></option>
												<?php 	endforeach; ?>
												<?php else: ?>
													<option value="0"><?=$this ->lang ->line('no_result')?></option>
												<?php endif;?>
											</select>
										</td>
										<td>
											<input type="text" placeholder="<?=$this ->lang ->line('no_of_bag')?>" name="no_of_bags_stack_down[]" class="form-control no_of_bags_stack_down"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;" >
										</td>
										<td>
											<input type="text"  placeholder="<?=$this ->lang ->line('rate')?>" name="rate_stack_down[]" class="form-control rate_stack_down"  autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  readonly>
										</td>
										<td>
											<input type="text"  placeholder="<?=$this ->lang ->line('total')?>" name="total_stack_down[]" class="form-control total_stack_down"  autofocus style="width: 150px;" readonly >
										</td>
							   					
							   			<td>
											<input type="text" placeholder="<?=$this ->lang ->line('no_of_bag')?>" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;"  readonly>
										</td>
							   			<!-- <td>
											<input type="text"  placeholder="Enter Rate" name="rate[]" class="form-control rate"  autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
										</td> -->
							   			<td>
											<input type="text"  placeholder="<?=$this ->lang ->line('total')?>" name="total[]" class="form-control total"  autofocus style="width: 150px;" readonly >
										</td>
										
										<td>
											<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
											<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
										</td>
									</tr>
			        			</tbody>
			        			
			        			 <tfoot>
			        				<tr>
			        					<td colspan="12" style="text-align: right;"><b> <?=$this ->lang ->line('total')?> </b></td>
			        					<td>
			        						<input type="text"  placeholder="<?=$this ->lang ->line('total_bags')?>" name="total_bags" class="form-control total_bags"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" readonly autofocus >
			        					</td>
			        					<!-- <td> -->
			        						<input type="hidden"  placeholder="<?=$this ->lang ->line('total_rate')?>" name="total_rate" class="form-control total_rate"  readonly  >
			        					<!-- </td> -->
			        					<td >
			        						<input type="text"  placeholder=" <?=$this ->lang ->line('total_amount')?>" name="total_amount" class="form-control total_amount"  readonly >
			        					</td>
			        				</tr>
			        			</tfoot> 
			        		</table>
			        		
			            </div>
		        	</div>
		        </div>
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label>
			                <button type="submit" class="btn btn-primary btn-block"> <?=$this ->lang ->line('submit')?></button>
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
			<td >
				<select name="work_location[]" class="form-control locations" style="width:200px;" >
					<option value=""> <?=$this ->lang ->line('select_location')?></option>
		            <?php if ($locations): ?> 
		                <?php foreach ($locations as $value) : ?>
		                        <option value="<?= $value ?>"><?= $value ?></option>
		                <?php endforeach; ?>
		            <?php else: ?>
		                <option value="0"><?=$this ->lang ->line('no_result')?></option>
		            <?php endif; ?>
		        </select>
		    </td>
			<td style="width: 30%;">
                  <select class="form-control  worders" data-placeholder="Select Workers" style="width: 350px !important;" name="worker_ids[]" >

                  		<option value=""> <?=$this ->lang ->line('select_workers')?></option>
                    <!-- <option value=""> Select Worker</option> -->
		            <?php if ($workers): ?> 
		                <?php foreach ($workers as $value) : ?>
		               <!--  <?php 
	                    $voucher_no= $value['worker_code']; 
	                    if($voucher_no<10){
	                    $worker_id_code='WC000'.$voucher_no;
	                    }
	                    else if(($voucher_no>=10) && ($voucher_no<=99)){
	                      $worker_id_code='WC00'.$voucher_no;
	                    }
	                    else if(($voucher_no>=100) && ($voucher_no<=999)){
	                      $worker_id_code='WCP0'.$voucher_no;
	                    }
	                    else{
	                      $worker_id_code='WC'.$voucher_no;
	                    }
	               	 ?> -->
		            	<option value="<?= $value['name'] ?>" > <?= $value['name'] ?>
		            	</option>
		            <?php endforeach; ?>
		            <?php else: ?>
		                <option value="0"><?=$this ->lang ->line('no_result')?></option>
		            <?php endif; ?>
                  </select>
               
			
			</td>
			<td> 
				<select name="finish_good_id[]" class="form-control items" style="width:250px;" >
					<option value=""> <?=$this ->lang ->line('select_grade')?></option>
		            <?php if ($items): ?> 
		                <?php foreach ($items as $value) : ?>
		                        <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].')' ?></option>
		                <?php endforeach; ?>
		            <?php else: ?>
		                <option value="0"><?=$this ->lang ->line('no_result')?></option>
		            <?php endif; ?>
		        </select>
   			</td>
   			
			<td>
				<select name="bag_weight_stack_up[]" class="form-control bag_weight_stack_up"  style="width: 200px;">
					<option value=""><?=$this ->lang ->line('select_bag_weight')?></option>
					<?php if($packing_sizes):
							foreach($packing_sizes as $k=>$v):
					?>
							<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php 	endforeach; ?>
					<?php else: ?>
						<option value="0"><?=$this ->lang ->line('no_result')?></option>
					<?php endif;?>
				</select>
			</td>
			<td>
				<input type="text" placeholder="<?=$this ->lang ->line('no_of_bag')?>" name="no_of_bags_stack_up[]" class="form-control no_of_bags_stack_up"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;" >
			</td>
			<td>
				<input type="text"  placeholder="<?=$this ->lang ->line('rate')?>" name="rate_stack_up[]" class="form-control rate_stack_up"  autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  readonly>
			</td>
			<td>
				<input type="text"  placeholder="<?=$this ->lang ->line('total')?>" name="total_stack_up[]" class="form-control total_stack_up"  autofocus style="width: 150px;" readonly >
			</td>
   					
   			
			<td>
				<select name="bag_weight_stack_down[]" class="form-control bag_weight_stack_down"  style="width: 200px;">
					<option value=""><?=$this ->lang ->line('select_bag_weight')?></option>
					<?php if($packing_sizes):
							foreach($packing_sizes as $k=>$v):
					?>
							<option value="<?php echo $k;?>"><?php echo $v;?></option>
					<?php 	endforeach; ?>
					<?php else: ?>
						<option value="0"><?=$this ->lang ->line('no_result')?></option>
					<?php endif;?>
				</select>
			</td>
			<td>
				<input type="text" placeholder="<?=$this ->lang ->line('no_of_bag')?>" name="no_of_bags_stack_down[]" class="form-control no_of_bags_stack_down"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;" >
			</td>
			<td>
				<input type="text"  placeholder="<?=$this ->lang ->line('rate')?>" name="rate_stack_down[]" class="form-control rate_stack_down"  autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  readonly>
			</td>
			<td>
				<input type="text"  placeholder="<?=$this ->lang ->line('total')?>" name="total_stack_down[]" class="form-control total_stack_down"  autofocus style="width: 150px;" readonly >
			</td>
   					
   			<td>
				<input type="text" placeholder="<?=$this ->lang ->line('no_of_bag')?>" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;"  readonly>
			</td>
   			<!-- <td>
				<input type="text"  placeholder="Enter Rate" name="rate[]" class="form-control rate"  autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
			</td> -->
   			<td>
				<input type="text"  placeholder="<?=$this ->lang ->line('total')?>" name="total[]" class="form-control total"  autofocus style="width: 150px;" readonly >
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
	

	$( document ).ready(function() {
		// add_row();
		
		// rename_rows();
		$('body').on('click','.addrow',function(){
			var table = $(this).closest('table');
			add_row();
			//rename_rows();
			
			calculate_total(table);
	    });
		
		function add_row(){ 
			var tr1 = $("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
			rename_rows();
		}

		$('body').on('click','.deleterow',function(){
			
			var table = $(this).closest('table');
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
				$(this).find("td:nth-child(3) select.worders").select2({
			    multiple: true,
				});
				//$(this).find("td:nth-child(4) select.items").select2();
				$(this).find("td:nth-child(3) select.worders").attr({name:"worker_ids["+i+"]"});
				$(this).find("td:nth-child(4) select.items").attr({class:"form-control select2"});
				var rowCount1 = $("#maintable tbody tr.main_tr1").length;
				$('.total_workers').val(rowCount1);
			});
			i++;
		}

		$(document).on('keyup','.no_of_bags_stack_up, .no_of_bags_stack_down',function(){
			var table = $(this).closest('table');
			calculate_total(table);
	    });


		$(document).on('change','.bag_weight_stack_up, .bag_weight_stack_down',function(){
			var table = $(this).closest('table');
			calculate_total(table);
	    });

	
		function calculate_total(table)
		{
			var no_of_bags_stack_up 	= 0;
			var no_of_bags_stack_down 	= 0;
			var rate_stack_up 			= 0;
			var rate_stack_down 		= 0;
			var total_stack_up 			= 0;
			var total_stack_down		= 0;
			var no_of_bags 				= 0;
			var total 					= 0;
			var total_bags 				= 0;
			var total_rate 				= 0;
			var total_amount 			= 0;
		
			table.find("tbody tr.main_tr1").each(function()
			{

				bag_weight_stack_up = $(this).find("td:nth-child(5) select.bag_weight_stack_up").val();
				bag_weight_stack_down = $(this).find("td:nth-child(9) select.bag_weight_stack_down").val();

				// console.log(bag_weight_stack_up+'=='+bag_weight_stack_down);

				if(bag_weight_stack_up == '25')
				{
					$(this).find("td:nth-child(7) input.rate_stack_up").val('1.25');
				}
				else if(bag_weight_stack_up == '50')
				{
					$(this).find("td:nth-child(7) input.rate_stack_up").val('2');
				}

				if(bag_weight_stack_down == '25')
				{
					$(this).find("td:nth-child(11) input.rate_stack_down").val('0.75')
				}
				else if(bag_weight_stack_down == '50')
				{
					$(this).find("td:nth-child(11) input.rate_stack_down").val('1.50')
				}

				no_of_bags_stack_up = parseFloat($(this).find("td:nth-child(6) input.no_of_bags_stack_up").val());
				no_of_bags_stack_down = parseFloat($(this).find("td:nth-child(10) input.no_of_bags_stack_down").val());

				rate_stack_up = parseFloat($(this).find("td:nth-child(7) input.rate_stack_up").val());
				rate_stack_down = parseFloat($(this).find("td:nth-child(11) input.rate_stack_down").val());
				
				if(isNaN(rate_stack_up))
				{
					rate_stack_up = 0;
				}

				if(isNaN(rate_stack_down))
				{
					rate_stack_down = 0;
				}


				if(isNaN(no_of_bags_stack_up))
				{
					no_of_bags_stack_up = 0;
				}

				if(isNaN(no_of_bags_stack_down))
				{
					no_of_bags_stack_down = 0;
				}

				if(isNaN(total_bags))
				{
					total_bags = 0;	
				}
			
				total_stack_up 		= rate_stack_up * no_of_bags_stack_up;
				total_stack_down	= rate_stack_down * no_of_bags_stack_down;
				total 				= total_stack_up + total_stack_down;

				total_bags 			= total_bags + no_of_bags_stack_up + no_of_bags_stack_down;
				total_rate 			= total_rate + rate_stack_up + rate_stack_down;
				total_amount 		= total_amount + total;

				no_of_bags 			= no_of_bags_stack_up + no_of_bags_stack_down;

				$(this).find("td:nth-child(8) input.total_stack_up").val(total_stack_up.toFixed(2));
				$(this).find("td:nth-child(12) input.total_stack_down").val(total_stack_down.toFixed(2));
				$(this).find("td:nth-child(13) input.no_of_bags").val(no_of_bags.toFixed(2));
				$(this).find("td:nth-child(14) input.total").val(total.toFixed(2));
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_bags").val(total_bags.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));
		}
	});
</script>
