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
		padding: 10px;
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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Work_allotments/edit_work_alloted">
				 <input type="hidden" name="wa_id_old" value="<?= $id ?>">
				 <input type="hidden" name="wa_code" value="<?= $wa_code ?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date Of Work <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                  value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } ?>" autofocus required >
			            </div>

			            <!-- <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Work Allocation Number <span class="required">*</span></label>
			            	
			            	<input type="text" class="form-control" value="<?= $pr_number_view ?>" autocomplete="off" autofocus readonly >
			            	<input type="hidden" name="pr_number" value="<?= $pr_number ?>">
			            </div> -->
			          <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang->line('work_area')?></label>
				            	<select name="mill_no" class="form-control" required="required">
									<option value=""> <?=$this ->lang->line('select_mill')?></option>
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
					                    <option value="0"><?=$this ->lang->line('no_results')?></option>
					                <?php endif; ?>
				            </select>
			            </div>
			            <div class="col-md-4 col-sm-4">
				            <label  class="control-label"><?=$this ->lang->line('total_workers')?></label>
				    		<input type="text" class="form-control total_workers" name="total_workers" value="<?= $total_workers ?>" readonly="readonly">
			    		</div>
		        	</div>
			        <!-- <div class="row col-md-12 ">
		            	<div class="col-md-6 col-sm-6">
		            		 <label  class="control-label"> Select Mill No <span class="required">*</span></label>
		            		<select name="mill_no" class="form-control" required="required">
								<option value=""> Select Mill</option>
				                <?php
				                 if ($equipments): ?> 
				                  <?php 
				                    foreach ($equipments as $value) : ?>
				                        <?php 
											if ($value['id'] == $mill_no): ?>
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
		        		<h5>Work Allocation Detail</h5>
		        		<div class="table-responsive">
			        		<table id="maintable">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th >S.No.</th>
			        					<th style="white-space: nowrap;"> <?=$this ->lang->line('worker_name')?></th>
			        					<th style="white-space: nowrap;"> <?=$this ->lang->line('work_alloted')?></th>
										<th style="white-space: nowrap;"> <?=$this ->lang->line('attendance')?> (In Hours)</th> 
			        					<th style="white-space: nowrap;"><?=$this ->lang->line('action_button')?></th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			<?php 
			        				if(!empty($work_details)){
			        					$i=1; foreach ($work_details as $key => $pr_detail) { 
			        						//print_r ($pr_detail);
			        						?>
			        				<tr class="main_tr1">
										<td ><?= $i ?></td>
										<td> 
										<select name="worker_id[]" class="form-control products" style="width:350px;" required>
											<option value=""> <?=$this ->lang->line('select_worker')?></option>
								            <?php if ($workers): ?> 
								                <?php foreach ($workers as $value) : ?>
								                <?php 
							                    $voucher_no= $value['worker_code']; 
							                    if($voucher_no<10){
							                    $worker_id_code='WK000'.$voucher_no;
							                    }
							                    else if(($voucher_no>=10) && ($voucher_no<=99)){
							                      $worker_id_code='WK00'.$voucher_no;
							                    }
							                    else if(($voucher_no>=100) && ($voucher_no<=999)){
							                      $worker_id_code='WKP0'.$voucher_no;
							                    }
							                    else{
							                      $worker_id_code='WK'.$voucher_no;
							                    }
							               	 ?>
							               	 <?php if ($value['id'] == $pr_detail['worker_id']): ?>
								            	<option value="<?= $value['id'] ?>" selected> 
								            		<?= $value['name'].' ('.$worker_id_code.')' ?>
								            	</option>
								            	<?php else: ?>
								            		<option value="<?= $value['id'] ?>" > 
								            		<?= $value['name'].' ('.$worker_id_code.')' ?>
								            	</option>
								           	<?php endif; ?>
								            <?php endforeach; ?>
								            <?php else: ?>
								                <option value="0"><?=$this ->lang->line('no_result')?></option>
								            <?php endif; ?>
								        </select>
							   			</td>
										<td>
											<textarea type="text"  placeholder="Work Description" style="width:250px;" name="work_allotted[]" class="form-control " autofocus value="<?= $pr_detail['work_allotted']?>" ><?= $pr_detail['work_allotted']?></textarea>
										</td>
										<td>
											<input type="text"  placeholder="Hours.Minutes" name="attendance[]" class="form-control no_of_hours" maxlength="5" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" value="<?= $pr_detail['attendance']?>">
										</td>
										<td>
											<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
											<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
										</td>
									</tr>
									<?php $i++;}}?>
			        			</tbody>
			        			
			        		</table>
			        	
			            </div>
		        	</div>
		        </div>
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> <?=$this ->lang->line('grade')?></label>
			                <button type="submit" class="btn btn-primary btn-block"><?=$this ->lang->line('submit')?></button>
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
			<select name="worker_id[]" class="form-control products" style="width:350px;" required>
				<option value=""> <?=$this ->lang->line('select_worker')?></option>
	            <?php if ($workers): ?> 
	                <?php foreach ($workers as $value) : ?>
	                <?php 
                    $voucher_no= $value['worker_code']; 
                    if($voucher_no<10){
                    $worker_id_code='WK000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $worker_id_code='WK00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $worker_id_code='WKP0'.$voucher_no;
                    }
                    else{
                      $worker_id_code='WK'.$voucher_no;
                    }
                   
               	 ?>
	            <option value="<?= $value['id'] ?>"> 
	            	<?= $value['name'].' ('.$worker_id_code.')' ?></option>
	            <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0"><?=$this ->lang->line('no_result')?></option>
	            <?php endif; ?>
	        </select>
   			</td>
			<td>
				<textarea type="text"  placeholder="Work Description" style="width:250px;" name="work_allotted[]" class="form-control " autofocus ></textarea>
			</td>
			<td>
				<input type="text"  placeholder="Hours.Minutes" name="attendance[]" class="form-control no_of_hours" maxlength="5" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<!-- <script type="text/javascript">
		$(document).ready(function() {
		    $('#maintable').DataTable( {
		        "scrollX": true
		    } );
		});
</script> -->
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
			var rowCount1 = $("#maintable tbody tr.main_tr1").length;
			//alert(rowCount1);
			$('.total_workers').val(rowCount1);
			//$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}
		$(document).on('keyup','.no_of_hours',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
		/*$(document).on('change','.packing_size',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });*/

		function calculate_total(table)
		{
			var no_of_hours=0;
			var total_workers=0;
			var total_hours=0;
		
			table.find("tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
					/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				no_of_hours=parseFloat($(this).find("td:nth-child(4) input.no_of_hours").val());
				//var hours = parseInt($(".Time2").val().split(':')[0], 10)
				//var qty=parseFloat($(this).find("td:nth-child(7) input.qty").val());
				//alert(no_of_hours);
				/*if(isNaN(no_of_hours))
				{
					no_of_hours =0;
				}
				if(isNaN(total_workers))
				{
					total_workers =0;
				}
				if(isNaN(total_hours))
				{
					total_hours =0;
				}*/

				//total_hours=total_hours+no_of_hours;
				//alert(total_hours);
				/*total_hours='5.80';
				var aa = total_hours.split('.');
				var hr=aa[0];		
				var min=aa[1];	*/
				//alert(hr);
				//alert(min);	
				/*if(min>=60){
					var inc='1';
					new_hr=parseInt(hr)+parseInt(inc);
					var new_min=parseInt(min)-60;
					new_time=parseInt(new_hr)+parseInt(new_min);

					alert(new_time);
				}*/
				
				/*else{
					var new_time=hr+min;
				}
				*/

			});
			//alert(total_qty);
			//table.find("tfoot tr input.total_hours").val(total_hours.toFixed(2));
		}

	
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(document).on('change','.vendor_code',function(){
				var customer_id = $('.vendor_code').find('option:selected').val();
				//alert(customer_id);
				if(customer_id!=''){
					$.ajax({
		                type: "POST",
		                url:"<?php echo base_url('index.php/Customers/getcustomerById/') ?>"+customer_id,
		                //data: {id:role_id},
		                dataType: 'html',
		                success: function (response) {
		                	//alert(response);
		                    $(".gst_no").html(response);
		                    //$('.select2').select2();
		                }
	            	});
				}else{
					$(".clear_gst").val('');
				}
				

			}); 
	});
</script> 