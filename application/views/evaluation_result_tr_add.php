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
	    		<?php if(!empty($id)) { ?>
		    		<form class="form-horizontal " role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/edit_ER/<?= $id ?>">
		    			<input type="hidden" name="er_id_old" value="<?= $id?>">
		    			<?php } else { ?>
					<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/add_new_ER">
			    <?php } ?>
			    
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="col-md-4 col-sm-4 ">
			            	<label class="control-label"><?= $this->lang->line('date') ?> <span class="required">*</span></label>
			                 <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"  
			                 value="<?php if($transaction_date) { echo date('d-m-Y',strtotime($transaction_date)); } echo date('d-m-Y')?>" autofocus required >
			            </div>
			             <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"><?= $this->lang->line('supplier_category') ?> <span class="required">*</span></label>
			            	<select name="categories_id" class="form-control select2 category" >
			            		 <option value="0"><?= $this->lang->line('select_category') ?></option>
					                <?php
					                 if ($categories): ?> 
					                  <?php 
					                    foreach ($categories as $value) : ?>
					                        <?php 
												if ($value['id'] == $current[0]->categories_id): ?>
						                            <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
						                        <?php else: ?>
						                            <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
						                        <?php endif;   ?>
					                    <?php   endforeach;  ?>
					                <?php else: ?>
					                    <option value="0"><?= $this->lang->line('no_result') ?></option>
					                <?php endif; ?>
					            </select>
			            </div>
			            <?php if(!empty($supplier_id)) { ?>
			            	 <div class="col-md-4 col-sm-4 suppliers">
			            	 <label  class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
			            	<select name="supplier_id" class="form-control select2 " required="required">
						        <?php
						         if ($suppliers): ?> 
						          <?php 
						            foreach ($suppliers as $value) : ?>
						                <?php 
											if ($value['id'] == $supplier_id): ?>
						                        <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] ?></option>
						                    <?php else: ?>
						                        <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
						                    <?php endif;   ?>
						            <?php   endforeach;  ?>
						        <?php else: ?>
						            <option value="0"><?= $this->lang->line('no_result') ?></option>
						        <?php endif; ?>
						    </select>
						</div>
			            <?php } else {  ?>
			            <div class="col-md-4 col-sm-4 suppliers">
			            	
			            </div>
			        <?php } ?>
		        	</div>
		        </div>
		        
		        <div class="form-group">
		        	<div class="row col-md-12">
		        		<div class="table-responsive">
			        		<table class="table table-bordered " id="maintable" >
			        			<thead style="background-color: #b0acb7;">
			        				<tr>
			        					<th> <?= $this->lang->line('sr_no') ?>.</th>
			        					<th> <?= $this->lang->line('criteria_name') ?></th>
			        					<th> <?= $this->lang->line('marks_ot_of') ?>10</th>
			        					<!-- <th> Total</th> -->
			        				</tr>
			        			</thead>
			        			<tbody id="mainbody">
			        			<?php
			        					$i=1;foreach ($criterias as $key => $criteria) {
			        						
			        					?>
			        					<tr class="main_tr1">
											<td style="width:5%"><?= $i ?></td>
											<td style="width:50%"> 
												<input type="hidden" name="evaluation_criteria_id[]" value="<?= $criteria['id'] ?>">
											<label> <?= $criteria['ec_name'] ?></label>
								   			</td>
											
											<td style="width:10%">
												<input type="text"  placeholder="<?= $this->lang->line('enter_marks') ?>" name="marks_obtained[]" class="form-control marks" 
												oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  autofocus required>
											</td>
											
											<!-- <td style="width:10%">
												<label> 10</label>
											</td> -->
										</tr>
									<?php $i++;} ?>
			        			</tbody>
			        			<tfoot>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b><?= $this->lang->line('total') ?></b></td>
			        					<td colspan="2">
			        						
			        						<div class="input-group mb-3">
							                  <input type="text"  placeholder="<?= $this->lang->line('total_marks') ?>" name="total_marks_obtained" class="form-control total_marks"  value="<?= $total_marks?>" readonly >
							                  <div class="input-group-append">
							                    <span class="input-group-text " id="total_value"></span>
							                    
							                  </div>
							                </div>
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b><?= $this->lang->line('total_percentage') ?> (%)</b></td>
			        					<td colspan="2">
			        						<input type="text"  placeholder="Total %" name="percentage" class="form-control total_percentage"  value="<?= $percentage?>" readonly >
			        					</td>
			        				</tr>
			        				<tr>
			        					<td colspan="2" style="text-align: right;"><b> <?= $this->lang->line('category_of_approval') ?></b></td>
			        					<td colspan="2">
			        						<input type="text"  placeholder="Approval Grade" name="approval_grade"  value="" id="approval_grade" readonly >
			        					</td>
			        				</tr>
			        			</tfoot>
			        		</table>
			            </div>
		        	</div>
		        </div>

		        	<div class="row col-md-12">
			           <!--  <div class="col-md-4 col-sm-4 ">
			            	<label  class="control-label"> PO Number <span class="required">*</span></label>
			            	<input type="text"  placeholder=" Enter Invoice/Challan No" name="challan_no" class="form-control"  autofocus  value="<?= $challan_no?>" required="required">
			            </div>  -->
			            <div class="col-md-6 col-sm-6 ">
			            	<label  class="control-label"> <?= $this->lang->line('marking_criteria') ?></label>
			            	<div>
			            		<label> <?= $this->lang->line('good') ?></label> : 10 <br>
			            		<label> <?= $this->lang->line('average') ?></label> : 7 <br>
			            		<label> <?= $this->lang->line('below_average') ?></label> : 5 
			            	</div>
			            </div>
			          <div class="col-md-6 col-sm-6 ">
			          		<label  class="control-label"> <?= $this->lang->line('remarks') ?></label>
			            	<textarea type="text" placeholder=" Enter Remarks" name="comments" class="form-control" value="<?= $comments?>"><?= $comments?></textarea>
			            </div>

		        	</div>
		        <div class="form-group">
		        	<div class="row col-md-12">
			            <div class="col-md-12 col-sm-12 ">
			            	<label  class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label>
			                <button type="submit" class="btn btn-primary btn-block"> <?= $this->lang->line('submits') ?></button>
		        		</div>
		        	</div>
		        </div>
		       <input type="hidden" id="total_marks_criteria" name="total_marks_criteria" value="">
		    </form> <!-- /form -->
		</div>
	</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document ).ready(function() {
		var rowCount = $("#maintable tbody tr.main_tr1").length;
		var total_marks_criteria=rowCount*10;
		$("#total_value").text('/ '+total_marks_criteria);
		$("#total_marks_criteria").val(total_marks_criteria);

		//alert(total_marks_criteria);
		$(document).on('keyup','.marks',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });
		
		function calculate_total(table)
		{
			var total_marks=0;
			var percentage=0;
			//var approval_grade=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var marks,rate,total=0;	
				var marks=parseFloat($(this).find("td:nth-child(3) input.marks").val());
				
						//alert();
						if(isNaN(marks))
						{
							marks =0;
						}
					if(marks <= 10)
					{
						var rowCount = $("#maintable tbody tr.main_tr1").length;
						var total_marks_criteria=rowCount*10;
						total_marks=total_marks+marks;
						percentage=(total_marks/total_marks_criteria)*100;

						/*if(percentage >= 75){
								document.getElementById('approval_grade').value = "A";
							}
							
							else if(74 >= percentage && percentage >= 60){
								document.getElementById('approval_grade').value = "B";
							}*/
						if(percentage >= '80'){
							var approval_grade='A';
							document.getElementById('approval_grade').value = approval_grade;
						}
						else if((percentage >= '60') && (percentage < '79')){
							var approval_grade='B';
							document.getElementById('approval_grade').value = approval_grade;
						}
						else {
							var approval_grade='C';
							document.getElementById('approval_grade').value = approval_grade;
							
						}
					}
			else{
					alert('Please enter marks less than 10');
					$(this).find("td:nth-child(3) input.marks").val('');
				}
				//alert(approval_grade);
				/*$(this).find("td:nth-child(6) input.total").val(amount.toFixed(2));*/
				//alert(total_marks);
			});
			//alert(total_marks);
			table.find("tfoot tr input.total_marks").val(total_marks.toFixed(2));
			table.find("tfoot tr input.total_percentage").val(percentage.toFixed(2));
			table.find("tfoot tr input.approval_grade").val(approval_grade);
		}
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url='<?php echo base_url() ;?>';
		//alert(base_url);
		$(document).on('change','.category',function(){
				var category_id = $('.category').find('option:selected').val();
				//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
				//alert(category_id);
				$.ajax({
	                type: "POST",
	                url:"<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>"+category_id,
	                //data: {id:role_id},
	                dataType: 'html',
	                success: function (response) {
	                	//alert(response);
	                    $(".suppliers").html(response);
	                    $('.select2').select2();
	                }
            	});
			}); 
	});
</script> 
