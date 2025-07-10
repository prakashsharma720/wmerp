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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Work_allotments/add_new_work">
				 <input type="hidden" name="wa_code" value="<?= $wa_code ?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date Of Work <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>

			         
			           <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Work Area</label>
				            	<select name="mill_no" class="form-control" required="required">
									<option value=""> Select Mill</option>
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
			            <div class="col-md-4 col-sm-4">
				            <label  class="control-label"> Total Workers</label>
				    		<input type="text" class="form-control total_workers" name="total_workers" value="1" readonly="readonly">
			    		</div>
		        	</div>
			      
					<br>
				<div class="form-group">
		        	<div class="row col-md-12">
		        		<h5>Work Allocation Detail</h5>
		        		<div class="table-responsive">
			        		<table id="maintable" class="table table-bordered table-striped">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th >S.No.</th>
			        					<th style="white-space: nowrap;"> Worker Name</th>
			        					<th style="white-space: nowrap;"> Work Alloted</th>
										<th style="white-space: nowrap;"> Attendance (In Hours)</th> 
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<tr class="main_tr1">
										<td >1</td>
										<td> 
										<select name="worker_id[]" class="form-control select2 "  style="width:350px !important;" required>
											<option value=""> Select Worker</option>
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
								                <option value="0">No result</option>
								            <?php endif; ?>
								        </select>
							   			</td>
										<td>
											<textarea type="text"  placeholder="Work Description" style="width:250px;" name="work_allotted[]" class="form-control " autofocus ></textarea>
										</td>
										<td>
											<input type="text"  placeholder="HH.MM" name="attendance[]" class="form-control no_of_hours" maxlength="5" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
										</td>
										<td>
											<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
											<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
										</td>
									</tr>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="3" style="text-align: right;"><b> Total Hours </b></td>
			        					 <td colspan="">
			        						<input type="text"  placeholder="Total Hours" name="total_hours" class="form-control total_hours"  value="" readonly >
			        					</td>  
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
			<select name="worker_id[]" class="form-control  products"  style="width:350px;" required>
				<option value=""> Select Worker</option>
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
	                <option value="0">No result</option>
	            <?php endif; ?>
	        </select>
   			</td>
			<td>
				<textarea type="text"  placeholder="Work Description" style="width:250px;" name="work_allotted[]" class="form-control " autofocus ></textarea>
			</td>
			<td>
				<input type="text"  placeholder="HH.MM" name="attendance[]" class="form-control no_of_hours" maxlength="5" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
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
			$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});
	}
	/*	$(document).on('keyup','.no_of_hours',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });*/
		/*$(document).on('change','.packing_size',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });*/

		/*function calculate_total(table)
		{
			var no_of_hours=0;
			var total_workers=0;
			var total_hours=0;
			var total_hrs=0;
			var total_mins=0;
		
			table.find("tbody tr.main_tr1").each(function()
			{
				no_of_hours=parseFloat($(this).find("td:nth-child(4) input.no_of_hours").val());
				var data=no_of_hours.split('.');
				hrs=data[0];
				mins=data[1];
				total_hrs=total_hrs+parseInt(hrs);
				total_mins=total_mins+parseInt(mins);

				if(total_mins>59){
					total_hrs=total_hrs+1;
					total_mins=total_mins-60;
					total_hours=total_hrs+'.'+total_mins+' Hrs';
				}else{
					total_hours=total_hrs+'.'+total_mins+' Hrs';
				}

			});
			table.find("tfoot tr input.total_hours").val(total_hours.toFixed(2));
		}*/

	
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