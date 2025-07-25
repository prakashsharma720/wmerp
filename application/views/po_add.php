<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
	<div class="alert alert-error alert-dismissible ">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
		<?php echo $this->session->flashdata('failed'); ?>
	</div>
<?php endif; ?>

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('create_purchase_order') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?> -->
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">

			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="main-content">
		<div class="card card-primary card-outline">
			
			

 <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/add_new_po">
			    <!-- <input type="hidden" name="req_id" value="<?= $requisitions['0']['id']?>"> -->
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('date')?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?= date('d-m-Y')?>" autofocus>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang ->line('name_of_supplier')?> <span class="required">*</span></label>
			            	 <?php  
			            		echo form_dropdown('supplier_id', $suppliers,' ','required="required"')
			            	?>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?= $this->lang->line('po_number') ?> <span class="required">*</span></label>
			            	<input type="text"  value="<?= $po_code_view?>" name="po_numbersss" class="form-control"  autofocus  required="required" readonly >
			            	<input type="hidden" name="po_number" value="<?= $po_no ?>">
			            </div>
			           
		        	</div>
		        </div>
		         <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?= $this->lang->line('quotation_no') ?> </label>
			            	<input type="text"  placeholder=" <?= $this->lang->line('enter_quatotaion_number') ?>" name="quotation_no" class="form-control" autofocus>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> <?= $this->lang->line('quotation_date') ?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="quotation_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?= date('d-m-Y')?>" autofocus>
			            </div>

			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> <?= $this->lang->line('comment') ?></label>
			            	<textarea type="text"  placeholder=" <?= $this->lang->line('enter_comment') ?>" name="comment" class="form-control"   autofocus  style="resize: none"></textarea> 
			            </div>

		        	</div>
		        </div>
		        <br>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive" >
			        		<table class="table table-bordered " id="maintable" style="width: 100% !important;">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th style="width:%;">  <?= $this->lang->line('sr_no') ?>.</th>
			        					<th style="width:15%;white-space: nowrap;"> <?= $this->lang->line('material_description') ?></th>
			        					<th style="width:10%;white-space: nowrap;"> <?= $this->lang->line('requisition_qty') ?></th>
			        					<th style="width:10%;white-space: nowrap;"><?= $this->lang->line('order_qty') ?></th>
			        					<th style="width:10%;white-space: nowrap;"> <?= $this->lang->line('pending_qty') ?></th>
			        					<th style="width:17%;white-space: nowrap;"><?= $this->lang->line('item_rate') ?></th>
			        					<th style="width:28%;white-space: nowrap;"><?= $this->lang->line('total_amount') ?></th>
			        					<th style="width:10%;"> <?= $this->lang->line('action') ?></th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 

			        				if(!empty($requisitions['0']['requisition_details'])){
			        					$total_req_qty=0;
			        					$i=1; foreach ($requisitions['0']['requisition_details']as $key => $po_data) { 
			        						$total_req_qty=$total_req_qty+$po_data['order_pending_qty'];
			        						// print_r ($po_data);
			        						//$total_rate_edit=$total_rate_edit+$po_detail['rate'];
			        						?>
			        						<tr class="main_tr1">
												<td ><?= $i; ?></td>
												<td > 	
										            <span> <?= $po_data['item'].' ('.$po_data['code'].')'?></span>
										            <input type="hidden" name="item_id[]" value="<?= $po_data['item_id']?>">
										 			<input type="hidden" name="requisition_slip_row_id[]" value="<?= $po_data['id']?>">
									   			</td>
												<td>
													<div class="input-group">
				                  						<div class="input-group-prepend">
															<input type="text"  placeholder="Qty" name="req_qty[]" class="form-control req_qty"  value="<?= $po_data['order_pending_qty'] ?>" autofocus required readonly > &nbsp;
															<span ><?= $po_data['unit']?></span>
														</div>
													</div>
												</td>
												<td >
													<input type="text"  placeholder="Qty" name="ordered_qty[]" class="form-control ordered_qty"  value="" autofocus required  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
												</td>
												<td >
													<input type="text"  placeholder="Pending" name="pending_qty[]" class="form-control pending_qty"  value="" autofocus required readonly>
												</td>
												<td>
													<input type="text"  placeholder="Rate" name="rate[]" class="form-control rate" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
												</td>
												<td colspan="">
													<input type="text"  placeholder="Total" name="total[]" class="form-control total"   readonly  required>
												</td>
												<td>
													<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>

												</td>
											</tr>

			        				<?php $i++; } } ?>
			        					</tbody>
			        				<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b><?= $this->lang->line('total') ?></b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="<?= $this->lang->line('total') ?>" name="req_total_qty" value="<?= $total_req_qty?>" class="form-control req_total_qty" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="<?= $this->lang->line('total') ?>" name="total_qty" class="form-control total_qty" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="<?= $this->lang->line('total') ?>" name="pending_total_qty" class="form-control pending_total_qty" readonly >
			        					</td>
			        					<td>
			        						<input type="text"  placeholder="<?= $this->lang->line('total') ?>" name="total_rate" class="form-control total_rate"  readonly >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder="<?= $this->lang->line('total') ?>" name="total_amount" class="form-control total_amount"  readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> <?= $this->lang->line('discount') ?></b></td>
			        					<td colspan="2">
			        						<input class="discount_type" type="radio" name="discount_type" value="1"  checked ><?= $this->lang->line('rupees') ?></input>
			        						&nbsp;&nbsp;&nbsp;&nbsp;
							                <input class="discount_type" type="radio" name="discount_type" value="2"  > <?= $this->lang->line('percentage') ?></input>
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" <?= $this->lang->line('enter_discout') ?>" name="discount" class="form-control discount_value"   required autofocus  >
			        						<input type="hidden"   name="discount_amount" class="discount_amount">
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" <?= $this->lang->line('after_discount') ?>" name="amount_after_discount"  class="form-control amount_after_discount"  readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> <?= $this->lang->line('gst') ?></b></td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" <?= $this->lang->line('enter_tax') ?> %" name="tax_per" class="form-control tax_per" autofocus  >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" <?= $this->lang->line('enter_tax') ?> " name="gst_amount" class="form-control gst_amount"  readonly  >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" <?= $this->lang->line('amount_with_tax') ?>" name="grand_total" class="form-control grand_total"  readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> <?= $this->lang->line('grand_total') ?></b></td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" <?= $this->lang->line('grand_total') ?>" name="final_total_amount" class="form-control final_total_amount"  autofocus readonly >
			        					</td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>

		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-6 col-sm-6 ">
			            	<label class="control-label"> <?= $this->lang->line('vendor_reference') ?></label>
			                <input type="text"  placeholder=" <?= $this->lang->line('enter_reference') ?> " name="reference_by" class="form-control"   autofocus >
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"><?= $this->lang->line('delivery_period') ?></label>
			            	 <input type="text"  placeholder=" <?= $this->lang->line('enter_delivery_schedule') ?>" name="delivery_period" class="form-control"  autofocus  >
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"><?= $this->lang->line('payment_terms') ?></label>
			            	<input type="text"  placeholder=" Ex. Cash,Cheque" name="payment_term" class="form-control"   autofocus  >
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> <?= $this->lang->line('freight_status') ?></label>
			            	<div>
			                 <input class="freight_status" type="radio" name="freight_status" value="Paid"  checked ><?= $this->lang->line('paid') ?></input>
			        		&nbsp;&nbsp;&nbsp;&nbsp;
							 <input class="freight_status" type="radio" name="freight_status" value="To Pay"  > <?= $this->lang->line('to_pay') ?></input>
						    </div>
						</div>

		        	</div>
		        </div>
		        <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label>
			                <button type="submit" class="btn btn-primary btn-block"> <?= $this->lang->line('submit') ?></button>
		        		</div>
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
			<td style="width:30%"> 
			<select name="products[]" class="form-control drop" >
                <?php if ($items): ?> 
                    <?php foreach ($items as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="0"><?= $this->lang->line('no_result') ?></option>
                <?php endif; ?>
            </select>

				<!-- <?php  $old_values=explode(',', $products);
   				echo form_dropdown('products[]', $categories,$old_values) ?> -->
   			</td>
			<td style="width:15%">
				<input type="text"  placeholder="<?= $this->lang->line('enter_qty') ?>" name="qty[]" class="form-control qty"  autofocus required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
			</td>
			<td style="width:15%">
				<input type="text"  placeholder="<?= $this->lang->line('enter_rate') ?>" name="rate[]" class="form-control rate"  autofocus required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
			</td>
			<td style="width:15%">
				<input type="text"  placeholder=" <?= $this->lang->line('total_amount') ?>" name="total[]" class="form-control total"  readonly  required>
			</td>
			<td style="width:15%">
				<!-- <button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button>  -->
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
			
		/*$('body').on('click','.addrow',function(){

			var table=$(this).closest('table');
			add_row();
			 rename_rows();
			 calculate_total(table);
	    });
		*/
		/*function add_row(){ 
			var tr1=$("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}*/
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

		$(document).on('keyup','.ordered_qty,.rate,.discount_value,.tax_per',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
	   $(document).on('change','.discount_type',function(){
			var table=$(this).closest('table');
			calculate_total(table);
		}); 
		
	
		function calculate_total(table){
		
			var total_amount=0;
			var total_qty=0;
			var total_pending_qty=0;
			var req_total_qty=0;
			var req_qty=0;
			var ordered_qty=0;
			var pending_qty=0;
			var rate=0;
			var total_rate=0;
			var grand_total=0;
			var taxable_value=0;
			var rupees=0;
			var percentage=0;
			var discount_type=0;
			var tax_per=0;
			var tax_amount=0;
			var final_total=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				 req_qty=parseFloat($(this).find("td:nth-child(3) input.req_qty").val());
				 ordered_qty=parseFloat($(this).find("td:nth-child(4) input.ordered_qty").val());
				 rate=parseFloat($(this).find("td:nth-child(6) input.rate").val());
				//alert();
				if(isNaN(rate))
				{
					rate =0;
				}
				if(isNaN(ordered_qty))
				{
					ordered_qty =0;
				}
				req_total_qty=req_total_qty+req_qty;
				if(ordered_qty<=req_qty){
					pending_qty=req_qty-ordered_qty;
					total_qty=total_qty+ordered_qty;
					total_rate=total_rate+rate;
					amount=ordered_qty*rate;
					total_amount=total_amount+amount;
					total_pending_qty=total_pending_qty+pending_qty;
					$(this).find("td:nth-child(5) input.pending_qty").val(pending_qty.toFixed(2));
					$(this).find("td:nth-child(7) input.total").val(amount.toFixed(2));
					//alert(total_qty);
					
				}else{
					alert('You can not enter quantity greater than requisition slip');
					$(this).find("td:nth-child(4) input.ordered_qty").val('');
					$(this).find("td:nth-child(5) input.pending_qty").val('');
					calculate_total(table);
				}

			});

			//alert(total_qty);
			table.find("tfoot tr input.req_total_qty").val(req_total_qty.toFixed(2));
			table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.pending_total_qty").val(total_pending_qty.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));

			
			/********************* Discount Calculation  *******************/ 

			if(table.find("tfoot tr input[name=discount_type]").is(':checked'))
				{
					discount_type=table.find("tfoot tr input[name=discount_type]:checked").val();
					//alert(discount_type);
					if(discount_type==2)
					{
						percentage=parseFloat(table.find("tfoot tr input.discount_value").val());
						if(!isNaN(percentage))
						{
							taxable_value=(total_amount*percentage)/100;
							grand_total=total_amount-taxable_value;			
							table.find("tfoot tr input.amount_after_discount").val(grand_total.toFixed(2));
							table.find("tfoot tr input.discount_amount").val(taxable_value.toFixed(2));
						}
					}
					else if(discount_type==1)
					{
						rupees=parseFloat(table.find("tfoot tr input.discount_value").val());
						if(!isNaN(rupees))
						{
							grand_total=total_amount-rupees;
							table.find("tfoot tr input.amount_after_discount").val(grand_total.toFixed(2));
							table.find("tfoot tr input.discount_amount").val(rupees.toFixed(2));	
						}					
					}
				}
	/********************* GST Calculation  *******************/ 
			tax_per=table.find("tfoot tr input.tax_per").val();
			//alert(tax_per);
			if(!isNaN(tax_per))
			{
				if(isNaN(tax_amount))
				{
					tax_amount =0;
				}
				if(isNaN(final_total))
				{
					final_total =0;
				}

				tax_amount=(grand_total*tax_per)/100;
				final_total=grand_total+tax_amount;			
				table.find("tfoot tr input.gst_amount").val(tax_amount.toFixed(2));
				table.find("tfoot tr input.grand_total").val(final_total.toFixed(2));
				table.find("tfoot tr input.final_total_amount").val(final_total.toFixed(2));
			}
			
			
		}

	
	});
</script>
























<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($requisitions['0']['requisition_details']);exit;

?>
   <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Success!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title?></h3>
        <div class="pull-right error_msg">
			<?php echo validation_errors();?>
		</div>

      </div> <!-- /.card-body -->
      <div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/add_new_po">
			    <!-- <input type="hidden" name="req_id" value="<?= $requisitions['0']['id']?>"> -->
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?=$this ->lang ->line('date')?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?= date('d-m-Y')?>" autofocus>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?=$this ->lang ->line('name_of_supplier')?> <span class="required">*</span></label>
			            	 <?php  
			            		echo form_dropdown('supplier_id', $suppliers,' ','required="required"')
			            	?>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PO Number <span class="required">*</span></label>
			            	<input type="text"  value="<?= $po_code_view?>" name="po_numbersss" class="form-control"  autofocus  required="required" readonly >
			            	<input type="hidden" name="po_number" value="<?= $po_no ?>">
			            </div>
			           
		        	</div>
		        </div>
		         <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label">Quotation No </label>
			            	<input type="text"  placeholder=" Enter Quatation No" name="quotation_no" class="form-control" autofocus>
			            </div>
			            <div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"> Quotation Date <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="quotation_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?= date('d-m-Y')?>" autofocus>
			            </div>

			            <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> Comment</label>
			            	<textarea type="text"  placeholder=" Enter comment" name="comment" class="form-control"   autofocus  style="resize: none"></textarea> 
			            </div>

		        	</div>
		        </div>
		        <br>
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive" >
			        		<table class="table table-bordered " id="maintable" style="width: 100% !important;">
			        			<thead style="background-color: #ca6b24;">
			        				<tr>
			        					<th style="width:%;">  Sr.No.</th>
			        					<th style="width:15%;white-space: nowrap;"> Material Description</th>
			        					<th style="width:10%;white-space: nowrap;"> Requisition Qty</th>
			        					<th style="width:10%;white-space: nowrap;"> Order Qty</th>
			        					<th style="width:10%;white-space: nowrap;"> Pending Qty</th>
			        					<th style="width:17%;white-space: nowrap;"> Item Rate</th>
			        					<th style="width:28%;white-space: nowrap;"> Total Amount</th>
			        					<th style="width:10%;"> Action</th>
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        				<?php 

			        				if(!empty($requisitions['0']['requisition_details'])){
			        					$total_req_qty=0;
			        					$i=1; foreach ($requisitions['0']['requisition_details']as $key => $po_data) { 
			        						$total_req_qty=$total_req_qty+$po_data['order_pending_qty'];
			        						// print_r ($po_data);
			        						//$total_rate_edit=$total_rate_edit+$po_detail['rate'];
			        						?>
			        						<tr class="main_tr1">
												<td ><?= $i; ?></td>
												<td > 	
										            <span> <?= $po_data['item'].' ('.$po_data['code'].')'?></span>
										            <input type="hidden" name="item_id[]" value="<?= $po_data['item_id']?>">
										 			<input type="hidden" name="requisition_slip_row_id[]" value="<?= $po_data['id']?>">
									   			</td>
												<td>
													<div class="input-group">
				                  						<div class="input-group-prepend">
															<input type="text"  placeholder="Qty" name="req_qty[]" class="form-control req_qty"  value="<?= $po_data['order_pending_qty'] ?>" autofocus required readonly > &nbsp;
															<span ><?= $po_data['unit']?></span>
														</div>
													</div>
												</td>
												<td >
													<input type="text"  placeholder="Qty" name="ordered_qty[]" class="form-control ordered_qty"  value="" autofocus required  oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" >
												</td>
												<td >
													<input type="text"  placeholder="Pending" name="pending_qty[]" class="form-control pending_qty"  value="" autofocus required readonly>
												</td>
												<td>
													<input type="text"  placeholder="Rate" name="rate[]" class="form-control rate" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
												</td>
												<td colspan="">
													<input type="text"  placeholder="Total" name="total[]" class="form-control total"   readonly  required>
												</td>
												<td>
													<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>

												</td>
											</tr>

			        				<?php $i++; } } ?>
			        					</tbody>
			        				<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b>Total</b></td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="req_total_qty" value="<?= $total_req_qty?>" class="form-control req_total_qty" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="total_qty" class="form-control total_qty" readonly >
			        					</td>
			        					<td colspan="">
			        						<input type="text"  placeholder="Total" name="pending_total_qty" class="form-control pending_total_qty" readonly >
			        					</td>
			        					<td>
			        						<input type="text"  placeholder="Total" name="total_rate" class="form-control total_rate"  readonly >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder="Total" name="total_amount" class="form-control total_amount"  readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> Discount</b></td>
			        					<td colspan="2">
			        						<input class="discount_type" type="radio" name="discount_type" value="1"  checked > Rupees</input>
			        						&nbsp;&nbsp;&nbsp;&nbsp;
							                <input class="discount_type" type="radio" name="discount_type" value="2"  > Percentage</input>
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" Enter Discount" name="discount" class="form-control discount_value"   required autofocus  >
			        						<input type="hidden"   name="discount_amount" class="discount_amount">
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" After discount" name="amount_after_discount"  class="form-control amount_after_discount"  readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> GST</b></td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" Enter Tax %" name="tax_per" class="form-control tax_per" autofocus  >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" Enter Tax " name="gst_amount" class="form-control gst_amount"  readonly  >
			        					</td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" Amount with Tax" name="grand_total" class="form-control grand_total"  readonly  >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="6" style="text-align: right;"><b> Grand Total</b></td>
			        					<td colspan="2">
			        						<input type="text"  placeholder=" Grand Total" name="final_total_amount" class="form-control final_total_amount"  autofocus readonly >
			        					</td>
			        				</tr>

			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>

		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-6 col-sm-6 ">
			            	<label class="control-label"> Vendor Reference</label>
			                <input type="text"  placeholder=" Enter Reference " name="reference_by" class="form-control"   autofocus >
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label">Delivery Period</label>
			            	 <input type="text"  placeholder=" Enter Delivery Schedule" name="delivery_period" class="form-control"  autofocus  >
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> Payment Terms</label>
			            	<input type="text"  placeholder=" Ex. Cash,Cheque" name="payment_term" class="form-control"   autofocus  >
			            </div>
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> Freight Status</label>
			            	<div>
			                 <input class="freight_status" type="radio" name="freight_status" value="Paid"  checked > Paid</input>
			        		&nbsp;&nbsp;&nbsp;&nbsp;
							 <input class="freight_status" type="radio" name="freight_status" value="To Pay"  > To Pay</input>
						    </div>
						</div>

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
		        
		        
		    </form> <!-- /form -->
		</div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td >1</td>
			<td style="width:30%"> 
			<select name="products[]" class="form-control drop" >
                <?php if ($items): ?> 
                    <?php foreach ($items as $value) : ?>
                            <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="0">No result</option>
                <?php endif; ?>
            </select>

				<!-- <?php  $old_values=explode(',', $products);
   				echo form_dropdown('products[]', $categories,$old_values) ?> -->
   			</td>
			<td style="width:15%">
				<input type="text"  placeholder="Enter Qty" name="qty[]" class="form-control qty"  autofocus required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
			</td>
			<td style="width:15%">
				<input type="text"  placeholder="Enter rate" name="rate[]" class="form-control rate"  autofocus required oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');">
			</td>
			<td style="width:15%">
				<input type="text"  placeholder=" total amount" name="total[]" class="form-control total"  readonly  required>
			</td>
			<td style="width:15%">
				<!-- <button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button>  -->
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$( document ).ready(function() {
			
		/*$('body').on('click','.addrow',function(){

			var table=$(this).closest('table');
			add_row();
			 rename_rows();
			 calculate_total(table);
	    });
		*/
		/*function add_row(){ 
			var tr1=$("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}*/
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

		$(document).on('keyup','.ordered_qty,.rate,.discount_value,.tax_per',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
	   $(document).on('change','.discount_type',function(){
			var table=$(this).closest('table');
			calculate_total(table);
		}); 
		
	
		function calculate_total(table){
		
			var total_amount=0;
			var total_qty=0;
			var total_pending_qty=0;
			var req_total_qty=0;
			var req_qty=0;
			var ordered_qty=0;
			var pending_qty=0;
			var rate=0;
			var total_rate=0;
			var grand_total=0;
			var taxable_value=0;
			var rupees=0;
			var percentage=0;
			var discount_type=0;
			var tax_per=0;
			var tax_amount=0;
			var final_total=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				 req_qty=parseFloat($(this).find("td:nth-child(3) input.req_qty").val());
				 ordered_qty=parseFloat($(this).find("td:nth-child(4) input.ordered_qty").val());
				 rate=parseFloat($(this).find("td:nth-child(6) input.rate").val());
				//alert();
				if(isNaN(rate))
				{
					rate =0;
				}
				if(isNaN(ordered_qty))
				{
					ordered_qty =0;
				}
				req_total_qty=req_total_qty+req_qty;
				if(ordered_qty<=req_qty){
					pending_qty=req_qty-ordered_qty;
					total_qty=total_qty+ordered_qty;
					total_rate=total_rate+rate;
					amount=ordered_qty*rate;
					total_amount=total_amount+amount;
					total_pending_qty=total_pending_qty+pending_qty;
					$(this).find("td:nth-child(5) input.pending_qty").val(pending_qty.toFixed(2));
					$(this).find("td:nth-child(7) input.total").val(amount.toFixed(2));
					//alert(total_qty);
					
				}else{
					alert('You can not enter quantity greater than requisition slip');
					$(this).find("td:nth-child(4) input.ordered_qty").val('');
					$(this).find("td:nth-child(5) input.pending_qty").val('');
					calculate_total(table);
				}

			});

			//alert(total_qty);
			table.find("tfoot tr input.req_total_qty").val(req_total_qty.toFixed(2));
			table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
			table.find("tfoot tr input.pending_total_qty").val(total_pending_qty.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));

			
			/********************* Discount Calculation  *******************/ 

			if(table.find("tfoot tr input[name=discount_type]").is(':checked'))
				{
					discount_type=table.find("tfoot tr input[name=discount_type]:checked").val();
					//alert(discount_type);
					if(discount_type==2)
					{
						percentage=parseFloat(table.find("tfoot tr input.discount_value").val());
						if(!isNaN(percentage))
						{
							taxable_value=(total_amount*percentage)/100;
							grand_total=total_amount-taxable_value;			
							table.find("tfoot tr input.amount_after_discount").val(grand_total.toFixed(2));
							table.find("tfoot tr input.discount_amount").val(taxable_value.toFixed(2));
						}
					}
					else if(discount_type==1)
					{
						rupees=parseFloat(table.find("tfoot tr input.discount_value").val());
						if(!isNaN(rupees))
						{
							grand_total=total_amount-rupees;
							table.find("tfoot tr input.amount_after_discount").val(grand_total.toFixed(2));
							table.find("tfoot tr input.discount_amount").val(rupees.toFixed(2));	
						}					
					}
				}
	/********************* GST Calculation  *******************/ 
			tax_per=table.find("tfoot tr input.tax_per").val();
			//alert(tax_per);
			if(!isNaN(tax_per))
			{
				if(isNaN(tax_amount))
				{
					tax_amount =0;
				}
				if(isNaN(final_total))
				{
					final_total =0;
				}

				tax_amount=(grand_total*tax_per)/100;
				final_total=grand_total+tax_amount;			
				table.find("tfoot tr input.gst_amount").val(tax_amount.toFixed(2));
				table.find("tfoot tr input.grand_total").val(final_total.toFixed(2));
				table.find("tfoot tr input.final_total_amount").val(final_total.toFixed(2));
			}
			
			
		}

	
	});
</script>

