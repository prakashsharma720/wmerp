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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Printing_logsheet/add_new_record">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date  <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y'); ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PML Number <span class="required">*</span></label>
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
			    		<div class="col-md-12 col-sm-12">
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
			        					<th > Finish Good </th>
			        					<th > Year Of Production </th>
			        					<th > Month Of Production </th>
			        					<th > Lot No.</th>
			        					<th > Batch No.</th>
										<th > No Of Bags</th> 
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			
			        			</tbody>
			        			 <tfoot>
			        				<tr>
			        					<td colspan="5" style="text-align: right;"><b> Total </b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Bags" name="total_bags" class="form-control total_bags"  value="" readonly >
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
				<select name="finish_good_id[]" class="form-control products" style="width:300px;" required>
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
				<input type="text"  name="production_year[]" class="form-control production_year"  style="width: 150px;" autofocus value="<?= date('Y')?>" readonly>
			</td>
			<td>
				<select name="production_month_id[]" class="form-control production_month_id"  required>
		    		<option value=""> Select Month</option>
		            <?php if ($months): ?> 
		                <?php foreach ($months as $value) : ?>
		                        <option value="<?= $value['id'] ?>"><?= $value['month_name'] ?></option>
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
				<input type="text"  placeholder="No of Bags" name="no_of_bags[]" class="form-control no_of_bags"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, '');" style="width:150px;" >
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
  $('.date1').val(today.getFullYear() + "-" + ('0' + (today.getMonth() + 1)).slice(-2) + "-" + ('0' + (today.getDate() + 1)).slice(-2));
  $('.time1').val('08:00');

});
</script>

<script type="text/javascript">
	$( document ).ready(function() {

		add_row();
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
			$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});

		}	
		$(document).on('keyup','.no_of_bags',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });

	   function calculate_total(table)
		{
			var total_qty=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				var qty=parseFloat($(this).find("td:nth-child(7) input.no_of_bags").val());
				//alert();
				if(isNaN(qty))
				{
					qty =0;
				}
				total_qty=total_qty+qty;
				/*$(this).find("td:nth-child(6) input.total").val(amount.toFixed(2));*/
				//alert(total_qty);
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_bags").val(total_qty.toFixed(2));
		}

	});
</script>
