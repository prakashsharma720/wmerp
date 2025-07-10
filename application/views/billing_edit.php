<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($items);exit;
?>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>

		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Billing/edit_record/<?= $id?>">
				<input type="hidden" name="billing_id_old" value="<?= $id ?>">
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label">Billing Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php echo date('d-m-Y',strtotime($transaction_date)); ?>"  required >
			            </div>
			             <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Invoice No <span class="required">*</span></label>
			            	<input type="text"  placeholder=" Invoice Code" name="" class="form-control" value="<?= $invoice_code_view ?>" autocomplete="off"   readonly="readonly">
			            	<input type="hidden" name="invoice_code" value="<?= $invoice_code ?>">
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Suppliers</label>
				            	<?php  
						              echo form_dropdown('supplier_id', $suppliers,$supplier_id) 
						          ?>
			            </div>
		        	</div>
		        </div>
			   
		      <div class="form-group">
		        <div class="row">
		        	<div class="col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #28262b;color: #fff;">
			        				<tr>
			        					<th style="width: 5%;">  Sr.No.</th>
			        					<th style="width: 30%;"> Material Description</th>
			        					<th style="width: 15%;"> QTY</th>
												<th style="width: 15%;"> Rate</th>
			        					<th style="width: 20%;"> Amount</th>
			        					<th style="width: 15%;"> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">	
							<?php $i=1;foreach ($billing_details as $key => $biling) { ?>
			        		<tr class="main_tr1">
										<td> <?php echo $i;?></td>
										<td> 
										<select name="products[]" class="form-control select2" required>
											<option value=""> Select Material </option>
								            <?php if ($items): ?> 
								                <?php foreach ($items as $value) : ?>
								                		<?php if($biling['item_id'] == $value['id']) { ?>
								                      <option value="<?= $value['id'] ?>" ? selected><?= $value['item_name'] ?></option>
								                      <?php } else{ ?>
								                      <option value="<?= $value['id'] ?>"><?= $value['item_name'] ?></option>
								                      <?php } ?>

								                <?php endforeach; ?>
								            <?php else: ?>
								                <option value="0">No result</option>
								            <?php endif; ?>
								        </select>
											</td>
										<td>
											<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   value="<?= $biling['qty'] ?>" required='required'>
										</td>
										<td>
							        	 <input type="text"  placeholder="Enter Rate" name="rate[]" class="form-control rate"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?= $biling['rate'] ?>"  required='required'>
										</td>
										<td>
								        <input type="text"  placeholder="Total Amount" name="total_amount[]" class="form-control total_amount"  value="<?= $biling['amount'] ?>"  required='required' readonly="readonly">
										</td>
										<td >
											<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
											<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
										</td>
									</tr>
										<?php	$i++;} ?>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b>Total</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total Qty" name="total_qty" class="form-control total_qty" value="<?php echo $total_qty; ?>" readonly >
			        					</td>
			        					<td colspan="2" style="text-align: right;">	
			        						<input type="text"  placeholder="Total Amount" name="total_amount_footer" class="form-control total_amount_footer" value="<?php echo $total_amount_footer; ?>" readonly ></td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> SELECT TAX </b></td>
			        					<td>
			        						<?php 
			        						$igst_checked='';
			        						$other_checked='';
			        						if(!empty($type_of_tax)) {
			        							if($type_of_tax=='IGST'){
			        								$igst_checked='checked';
			        							}else{
			        								$other_checked='checked';
			        							}

			        						}else{
			        							$other_checked='checked';
			        						}
			        						?>
			        						<input class="type_of_tax" type="radio" name="type_of_tax" value="IGST" <?= $igst_checked ?> > IGST</input>
			        						&nbsp;&nbsp;&nbsp;&nbsp;
							            <input class="type_of_tax" type="radio" name="type_of_tax" value="Other"  <?= $other_checked ?> > Other</input>
			        					</td>
			        					<!-- <td colspan="">
			        						<input type="text"  placeholder="Total Rate" name="total_rate" class="form-control total_rate"  value="" readonly >
			        					</td>  -->
			        					<td colspan="2">
			        						<input type="text"  placeholder="Taxable Amount" name="texable_amount" class="form-control texable_amount"  value="<?= $texable_amount ?>" readonly >
			        					</td>
			        				</tr>
			        				<tr class="igst_row hide">
			        					<td colspan="2" style="text-align: right;"><b> IGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter IGST %" name="tax_per_igst" class="form-control tax_per_igst"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" value="<?= $tax_per_igst ?>" >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="IGST Amount" name="igst_amount" class="form-control igst_amount" value="<?= $igst_amount ?>" readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_igst" class="form-control grand_total_after_igst" value="<?= $grand_total_after_igst ?>" readonly >
			        					</td>
			        				</tr>
			        				<tr class="cgst_row">
			        					<td colspan="2" style="text-align: right;"><b> CGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter CGST %" name="tax_per_cgst" class="form-control tax_per_cgst"  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" value="<?= $cgst_per ?>" >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="CGST Amount" name="cgst_amount" class="form-control cgst_amount"  value="<?= $cgst_amount ?>" readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_cgst" class="form-control grand_total_after_cgst" value="<?= $amount_after_cgst ?>" readonly >
			        					</td>
			        				</tr>
			        				<tr class="sgst_row">
			        					<td colspan="2" style="text-align: right;"><b> SGST</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Enter SGST %" name="tax_per_sgst" class="form-control tax_per_sgst" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" maxlength="4" value="<?= $sgst_per ?>" >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="SGST Amount" name="sgst_amount" class="form-control sgst_amount"  value="<?= $sgst_amount ?>" readonly  >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total_after_sgst" class="form-control grand_total_after_sgst" value="<?= $amount_after_sgst ?>" readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> TOTAL AMOUNT </b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder=" Grand Total" name="final_total_amount" class="form-control final_total_amount"  value="<?= $final_total_amount ?>" readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> ROUND OFF  </b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder=" Round off" name="round_off" class="form-control round_off"  value="<?= $round_off ?>" readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> GRAND TOTAL  </b></td>
			        					<td colspan="3">
			        						<input type="text"  placeholder=" Grand Total" name="grand_total" class="form-control grand_total" value="<?= $grand_total ?>"  readonly >
			        					</td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>
		        <div class="form-group">
			        <div class="row col-md-12">
		        		<label  class="control-label"> Comment</label>
			    		<textarea class="form-control Comment" rows="2" placeholder="Enter comment here" name="comment" value="<?= $comment ?>" ><?= $comment ?></textarea>
			    	</div>
			    </div>
			        <div class="form-group">
			        	<div class="row col-md-12">
				            <div class="col-md-12 col-sm-12 ">
				            	<label  class="control-label" style="visibility: hidden;"> Grade</label>
				                <button type="submit" class="btn btn-primary btn-block"> Submit</button>
			        		</div>
			        	</div>
			        </div>
			    </form> 
			  </div>
		</div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td>1</td>
			<td> 
			<select name="products[]" class="form-control drop" required>
				<option value=""> Select Material </option>
	            <?php if ($items): ?> 
	                <?php foreach ($items as $value) : ?>
	                        <option value="<?= $value['id'] ?>"><?= $value['item_name'] ?></option>
	                <?php endforeach; ?>
	            <?php else: ?>
	                <option value="0">No result</option>
	            <?php endif; ?>
	        </select>

				</td>
			
			<td>
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   required='required'>
			</td>
				<td>
	        	 <input type="text"  placeholder="Enter Rate" name="rate[]" class="form-control rate"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"   required='required'>
				</td>
				<td>
		        <input type="text"  name="total_amount[]" class="form-control total_amount" required='required' readonly="readonly">
				</td>
			<td >
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
	<tfoot>
	<tr>
		<td colspan="2" style="text-align: right;"><b>Total</b></td>
		<td colspan="2">
			<input type="text"  placeholder="Total Qty" name="total_qty" class="form-control total_qty"  readonly >
		</td>	
		<td colspan="2">
			<input type="text"  placeholder="Total Amount" name="total_amount" class="form-control total_amount"  readonly >
		</td>
	</tr>

	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
		//add_row();
		//$(this).find("td:nth-child(2) select.drop").select2();
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
			$(this).find("td:nth-child(2) select.drop").select2();

			//$(this).find("td:nth-child(3) select.select2").select2();
			/*$(this).find("td:nth-child(2).code").attr({name:"labour_rows["+i+"][code_description]", id:"labour_rows-"+i+"-code_description"});*/
			
		});
	}


		$(document).on('keyup','.qty,.rate,.tax_per_sgst,.tax_per_cgst,.tax_per_igst',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
	   $(document).on('change','.type_of_tax',function(){
			var table=$(this).closest('table');
			calculate_total(table);
		}); 
		
	
		function calculate_total(table)
		{
			var total_qty=0;
			var total_amount=0;
			var total_amount_footer=0;
			var tax_per_igst=0;
			var igst_amount=0;
			var grand_total_after_igst=0;
			var tax_per_cgst=0;
			var cgst_amount=0;
			var grand_total_after_cgst=0;
			var tax_per_sgst=0;
			var sgst_amount=0;
			var grand_total_after_sgst=0;
			var final_total=0;
			var type_of_tax=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				var qty=parseFloat($(this).find("td:nth-child(3) input.qty").val());
				var rate=parseFloat($(this).find("td:nth-child(4) input.rate").val());
				//alert();
				if(isNaN(qty))
				{
					qty =0;
				}
				if(isNaN(rate))
				{
					rate =0;
				}
				total_amount=qty*rate;

				total_qty=total_qty+qty;
				total_amount_footer=total_amount_footer+total_amount;

				$(this).find("td:nth-child(5) input.total_amount").val(total_amount.toFixed(2))
				//alert(total_qty);
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.total_amount_footer").val(total_amount_footer.toFixed(2));
			table.find("tfoot tr input.texable_amount").val(total_amount_footer.toFixed(2));

			if(table.find("tfoot tr input[name=type_of_tax]").is(':checked'))
				{
					type_of_tax=table.find("tfoot tr input[name=type_of_tax]:checked").val();
					//alert(type_of_tax);
					if(type_of_tax=='IGST'){

						table.find("tfoot tr.igst_row").removeClass('hide');						
						table.find("tfoot tr.igst_row").addClass('show');
						table.find("tfoot tr.cgst_row").addClass('hide');							
						table.find("tfoot tr.sgst_row").addClass('hide');
						table.find("tfoot tr td input.tax_per_cgst").val('');							
						table.find("tfoot tr td input.tax_per_sgst").val('');
							/********************* IGST Calculation  *******************/ 
						tax_per_igst=table.find("tfoot tr input.tax_per_igst").val();
						if(!isNaN(tax_per_cgst))
						{
							if(isNaN(igst_amount))
							{
								igst_amount =0;
							}
							if(isNaN(total_amount_footer))
							{
								total_amount_footer =0;
							}

							igst_amount=(total_amount_footer*tax_per_igst)/100;
							grand_total_after_igst=total_amount_footer+igst_amount;			
							table.find("tfoot tr input.igst_amount").val(igst_amount.toFixed(2));
							table.find("tfoot tr input.grand_total_after_igst").val(grand_total_after_igst.toFixed(2));
							table.find("tfoot tr input.final_total_amount").val(grand_total_after_igst.toFixed(2));

							/*alert(grand_total_after_igst);
							var data=grand_total_after_igst.split('.');
							var err=data[1];
							alert(err);*/
							var round = Math.round(grand_total_after_igst);
							table.find("tfoot tr input.grand_total").val(round);
						}							
					}
					else
					{
						table.find("tfoot tr.cgst_row").removeClass('hide');						
						table.find("tfoot tr.sgst_row").removeClass('hide');						
						table.find("tfoot tr.cgst_row").addClass('show');		
						table.find("tfoot tr.sgst_row").addClass('show');		
						table.find("tfoot tr.igst_row").addClass('hide');
						table.find("tfoot tr td input.tax_per_igst").val('');	
						
						/********************* CGST Calculation  *******************/ 

						tax_per_cgst=table.find("tfoot tr input.tax_per_cgst").val();
						if(!isNaN(tax_per_cgst))
						{
							if(isNaN(cgst_amount))
							{
								cgst_amount =0;
							}
							if(isNaN(total_amount_footer))
							{
								total_amount_footer =0;
							}

							cgst_amount=(total_amount_footer*tax_per_cgst)/100;
							grand_total_after_cgst=total_amount_footer+cgst_amount;			
							table.find("tfoot tr input.cgst_amount").val(cgst_amount.toFixed(2));
							table.find("tfoot tr input.grand_total_after_cgst").val(grand_total_after_cgst.toFixed(2));
						}
						/********************* SGST Calculation  *******************/ 
						tax_per_sgst=table.find("tfoot tr input.tax_per_sgst").val();
						//alert(tax_per);
						if(!isNaN(tax_per_sgst))
						{
							if(isNaN(sgst_amount))
							{
								sgst_amount =0;
							}
							if(isNaN(total_amount_footer))
							{
								total_amount_footer =0;
							}
							if(isNaN(grand_total_after_sgst))
							{
								grand_total_after_sgst =0;
							}
							if(isNaN(grand_total_after_cgst))
							{
								grand_total_after_cgst =0;
							}

							

							sgst_amount=(total_amount_footer*tax_per_sgst)/100;
							grand_total_after_sgst=grand_total_after_cgst+sgst_amount;
							
							/*var data=sgst_amount.split('.');
							var err=data[1];
							alert(err);*/

							table.find("tfoot tr input.sgst_amount").val(sgst_amount.toFixed(2));
							table.find("tfoot tr input.grand_total_after_sgst").val(grand_total_after_sgst.toFixed(2));
							table.find("tfoot tr input.final_total_amount").val(grand_total_after_sgst.toFixed(2));
							
							var round = Math.round(grand_total_after_sgst);
							//alert(total_amount);
							var final_total_for_round_off=table.find("tfoot tr input.final_total_amount").val();
							var data=final_total_for_round_off.split('.');
							var err=data[1];
							//alert(final_total_for_round_off);
							table.find("tfoot tr input.round_off").val(err);
							table.find("tfoot tr input.grand_total").val(round.toFixed(2));

						}		
					}
				}
		}
	
	
	});
</script>
