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
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Power_monitoring_registers/edit_record">
				<input type="hidden" name="pm_id_old" value="<?= $id?>">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Date  <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } ?>" autofocus required >
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PMR Number <span class="required">*</span></label>
			            	
			            	<input type="text" class="form-control" value="<?= $pl_number_view ?>" autocomplete="off" autofocus readonly >
			            	<input type="hidden" name="pl_number" value="<?= $pl_number ?>">
			            </div>
			       		<div class="col-md-4 col-sm-4">
				            <label  class="control-label"> Remarks</label>
				    		<textarea class="form-control " rows="2" placeholder="Enter Remarks here" name="remarks" ><?= $remarks ?></textarea>
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
			        					<th > Meter Name </th>
			        					<th > Opening Reading</th>
			        					<th > Closing Reading</th>
			        					<th > Units Consumed</th>
										<th > Production (MT)</th> 
										<th > Units / MT </th> 
			        					<th style="white-space: nowrap;"> Action Button</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			<?php 
			        				if(!empty($process_details)){
			        					$i=1; foreach ($process_details as $key => $pm_detail) { 
			        						//print_r ($gir_detail);
			        						?>
			        						<tr class="main_tr1">
												<td ><?= $i; ?></td>
												<td> 
												<select name="meter_id[]" class="form-control products" style="width:350px;" required>
													<option value=""> Select Meter</option>
										            <?php if ($meters): ?> 
										                <?php foreach ($meters as $value) : ?>
										                	<?php if ($value['id'] == $pm_detail['meter_id']): ?>
										                        <option selected value="<?= $value['id'] ?>"><?= $value['meter_name'] ?></option>
										                        <?php else: ?>
										                        <option value="<?= $value['id'] ?>"><?= $value['meter_name'] ?></option>
										                       <?php endif; ?>
										                <?php endforeach; ?>
										            <?php else: ?>
										                <option value="0">No result</option>
										            <?php endif; ?>
										        </select>
													
									   			</td>
												<td>
													<input type="text"  placeholder="Enter Value" name="opening_reading[]" class="form-control opening_reading"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" value="<?= $pm_detail['opening_reading']?>" >
												</td>
												<td>
													<input type="text"  placeholder="Enter Value" name="closing_reading[]" class="form-control closing_reading"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" value="<?= $pm_detail['closing_reading']?>" >
												</td>
												<td>
													<input type="text"  placeholder="Total Units" name="unit_consumed[]" class="form-control unit_consumed"  autofocus  style="width:150px;" readonly="readonly" value="<?= $pm_detail['unit_consumed']?>"  >
												</td>
												<td>
													<input type="text"  placeholder="Enter Production" name="production_in_mt[]" class="form-control production_in_mt"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" value="<?= $pm_detail['production_in_mt']?>"  >
												</td>
												<td>
													<input type="text"  placeholder="Units / MT" name="unit_per_ton[]" class="form-control unit_per_mt"  autofocus value="<?= $pm_detail['unit_per_ton']?>"  style="width:150px;" >
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
			        					<td colspan="2" style="text-align: right;"><b> Total </b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="total_opening" class="form-control total_opening"  value="<?= $total_opening?>" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="total_closing" class="form-control total_closing"  value="<?= $total_closing?>" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="total_unit_consumed" class="form-control total_unit_consumed"  value="<?= $total_unit_consumed?>" readonly >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder="Total Propduction" name="total_production_in_mt" class="form-control total_production_in_mt"  value="<?= $total_production_in_mt?>" readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> RSEB Meter Reading </b></td>
			        					<td>
			        						<input type="text"  placeholder="RSEB Opening" name="rseb_opening" class="form-control rseb_opening"  value="<?= $rseb_opening?>" >
			        					</td>
			        					<td>
			        						<input type="text"  placeholder="RSEB Closing" name="rseb_closing" class="form-control rseb_closing"  value="<?= $rseb_closing?>"  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Enter Value" name="rseb_meter_units" class="form-control rseb_meter_units" value="<?= $rseb_meter_units?>"  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="4" style="text-align: right;"><b> Unit Variance </b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder="Unit Variance" name="difference_units" class="form-control difference_units"  value="<?= $difference_units?>"  readonly="readonly">
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
			<select name="meter_id[]" class="form-control products" style="width:350px;" required>
				<option value=""> Select Meter</option>
	            <?php if ($meters): ?> 
	                <?php foreach ($meters as $value) : ?>
	                       <!--  <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
	                        <option value="<?= $value['id'] ?>"><?= $value['meter_name'] ?></option>
	                <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0">No result</option>
	            <?php endif; ?>
	        </select>
				
   			</td>
			<td>
				<input type="text"  placeholder="Enter Value" name="opening_reading[]" class="form-control opening_reading"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Enter Value" name="closing_reading[]" class="form-control closing_reading"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Total Units" name="unit_consumed[]" class="form-control unit_consumed"  autofocus  style="width:150px;" readonly="readonly">
			</td>
			<td>
				<input type="text"  placeholder="Enter Production" name="production_in_mt[]" class="form-control production_in_mt"  autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:150px;" >
			</td>
			<td>
				<input type="text"  placeholder="Units / MT" name="unit_per_ton[]" class="form-control unit_per_mt"  autofocus  style="width:150px;" >
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
			$(this).find("td:nth-child(2) select.products").select2();
			//$(this).find("td:nth-child(4) select.units").select2();

		});

		}	
		$(document).on('keyup','.production_in_mt,.rseb_meter_units',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });

	    $(document).on('blur','.opening_reading,.closing_reading,.rseb_opening,.rseb_closing',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    }); 

	   function calculate_total(table)
		{
		
			var kwh_closing=0;
			var kwh_opening=0;
			var kwh_consumed=0;
			var production_in_mt=0;
			var unit_per_mt=0;
			var total_production_in_mt=0;
			var total_opening=0;
			var total_closing=0;
			var total_kwh=0;
			var difference_units=0;
			var rseb_opening=0;
			var rseb_closing=0;
			var rseb_meter_units=0;
		
			table.find("tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
					/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				kwh_opening=parseInt($(this).closest('tr').find("td:nth-child(3) input.opening_reading").val());
				kwh_closing=parseInt($(this).closest('tr').find("td:nth-child(4) input.closing_reading").val());
				production_in_mt=parseFloat($(this).closest('tr').find("td:nth-child(6) input.production_in_mt").val());
				//alert(production_in_mt);
				if(isNaN(kwh_closing))
				{
					kwh_closing =0;
				}
				if(isNaN(kwh_opening))
				{
					kwh_opening =0;
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
				if((kwh_closing!='') && (kwh_opening!='')){
					
					if(kwh_closing>=kwh_opening){
						kwh_consumed=kwh_closing-kwh_opening;
					}
					else
					{
						alert('You can not enter KWH Closing Value less than KWH Opening');
						$(this).closest('tr').find("td:nth-child(5) input.unit_consumed").val('');
						$(this).closest('tr').find("td:nth-child(5) input.unit_consumed").val('');
						$(this).closest('tr').find("td:nth-child(4) input.closing_reading").val('');
						$(this).closest('tr').find("td:nth-child(3) input.opening_reading").val('');
					}					
				}
				if((production_in_mt!='') && (production_in_mt >'0')){
						unit_per_mt=kwh_consumed/production_in_mt;
						$(this).closest('tr').find("td:nth-child(7) input.unit_per_mt").val(unit_per_mt.toFixed(2));
						$(this).closest('tr').find("td:nth-child(5) input.unit_consumed").val(kwh_consumed);

					}else{
						//unit_per_mt=='0.00';
						//production_in_mt=='0.00';
						$(this).closest('tr').find("td:nth-child(7) input.unit_per_mt").val('0');
						$(this).closest('tr').find("td:nth-child(5) input.unit_consumed").val(kwh_consumed);
					}

					
				total_opening=total_opening+kwh_opening;
				total_closing=total_closing+kwh_closing;
				total_kwh=total_kwh+kwh_consumed;
				total_production_in_mt=total_production_in_mt+production_in_mt;
				//$(this).closest('tr').find("td:nth-child(7) input.production_in_mt").val(production_in_mt.toFixed(4));
				//production_in_mt=parseFloat($(this).closest('tr').find("td:nth-child(7) input.production_in_mt").val());

				
				
			});
		
			if(isNaN(rseb_opening))
			{
				rseb_opening =0;
			}
			if(isNaN(rseb_closing))
			{
				rseb_closing =0;
			}

			 var rseb_opening=table.find("tfoot tr input.rseb_opening").val();
			 var rseb_closing=table.find("tfoot tr input.rseb_closing").val();
			//alert(rseb_opening);
			//alert(rseb_closing);
			if((rseb_opening!='') && (rseb_closing!='')){
					
					if(rseb_closing>=rseb_opening){
						var rseb_meter_units=(rseb_closing-rseb_opening)*6;
					}
					/*else
					{
						
						alert('You can not enter RSEB Closing Value less than RSEB Opening');
						table.find("tfoot tr input.rseb_opening").val('');
						table.find("tfoot tr input.rseb_closing").val('');
					}*/
					if(rseb_meter_units > total_kwh)
					{
						 difference_units=rseb_meter_units-total_kwh;
					}
					else
					{
						 difference_units=total_kwh-rseb_meter_units;
					}
					
				}
			table.find("tfoot tr input.total_opening").val(total_opening);
			table.find("tfoot tr input.total_closing").val(total_closing);
			table.find("tfoot tr input.total_unit_consumed").val(total_kwh);
			table.find("tfoot tr input.total_production_in_mt").val(total_production_in_mt.toFixed(4));
			table.find("tfoot tr input.rseb_meter_units").val(rseb_meter_units);
			table.find("tfoot tr input.difference_units").val(difference_units);
			
		
			//table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			//table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));

		}
	});
</script>
