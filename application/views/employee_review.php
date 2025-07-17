<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
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
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Employee_Review/add_review">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title"> <?= $this->lang->line('employee_review') ?> </h3>
                    <div class="pull-right error_msg">
                        <!-- <?php echo validation_errors();?> -->
                        <?php if (isset($message_display)) {
                        echo $message_display;
                        } ?>		
                    </div>
            </div>
            <!-- closed card-header -->
            <!-- card-body -->
            <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                            <label class="control-label"><?= $this->lang->line('leave_allotment_month') ?> </label>
                            <?php echo form_dropdown('month_name', $months,'','required="required"'); ?>
                        </div>
                        <div class="col-md-6 half_div">
									<label class="control-label"><?= $this->lang->line('select_period') ?> </label>
									<select class="form-control halfday" name="period_type">
										<option value="1" > <?= $this->lang->line('first_half') ?>  </option>
										<option value="2" > <?= $this->lang->line('second_half') ?>  </option>
									</select>
								</div>
                                           
                        <div class="col-md-12">
                            <label class="control-label"></label>
                        </div>
                        <div class="table-responsive">
                            <table width="100%"  class="table table-bordered table-striped" id="sample_table1">
                                <thead width="100%">
                                    <tr width="100%">
                                       
                                        <th width="10%"><?= $this->lang->line('criteria_name') ?>  </th>
                                        <th width="10%"><?= $this->lang->line('criteria_point') ?> </th>
                                        <th width="10%"><?= $this->lang->line('self_review') ?></th>
                                        <th width="10%"><?= $this->lang->line('author_review') ?></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="<?= $this->lang->line('attendance') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"     min="0" max="5" step="0" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                         value=""  class="marks" class="form-control" style="width:50%;">
                                        </td>
                                       
                                        <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                        <td>
                                            <input type="number" name="author_review[]"  min="0" max="5" step="0" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                         value=""  class="author_marks" class="form-control"  style="width:50%;">
                                        </td>
                                        <?php } else { ?>
                                        <td>
                                            <input type="number" name="author_review[]"  min="0" max="5" step="0" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                         value=""  class="author_marks" class="form-control" style="width:50%;" readonly="readonly">
                                        </td>
                                        <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="<?= $this->lang->line('behaviour') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="7.5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"  min="0" max="8" step="0" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value=""   class="marks"class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="8" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="8" step="0"  
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="<?= $this->lang->line('results') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="12.5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]" min="0" max="13" step="0"  
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" class="marks" class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]"  min="0" max="13" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]"  min="0" max="13" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="<?= $this->lang->line('extra_efforts') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"  min="0" max="5" step="0" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" class="marks" class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="5" step="0"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="5" step="0"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="Hon<?= $this->lang->line('honesty') ?>esty" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"  min="0" max="5" step="0"
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" class="marks" class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="5" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]"min="0" max="5" step="0"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="<?= $this->lang->line('punctuality') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"   min="0" max="5" step="0"
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" class="marks" class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="5" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="5" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value="<?= $this->lang->line('reporting') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="7.5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"  min="0" max="8" step="0" 
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" class="marks" class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]"  min="0" max="8" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]" m min="0" max="8" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>

                                    <tr class="main_tr1">
                                        <td>
                                          
                                            <input type="text" name="criteria[]" value=" <?= $this->lang->line('customer_relationship') ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="criteria_point[]" value="2.5" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="self_review[]"  min="0" max="3" step="0"  
			                			oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="" class="marks" class="form-control"  style="width:50%;">
                                        </td>
                                       
                                       <?php if($designation_id==1 || $designation_id==2 || $designation_id==4) { ?>
                                       <td>
                                           <input type="number" name="author_review[]"  min="0" max="3" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control"  style="width:50%;">
                                       </td>
                                       <?php } else { ?>
                                       <td>
                                           <input type="number" name="author_review[]" min="0" max="3" step="0" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                        value=""  class="author_marks" class="form-control" readonly="readonly"  style="width:50%;">
                                       </td>
                                       <?php } ?>
                                    </tr>
                                    </tbody>
                                
                        <tfoot>
                                    <tr>
                                        <td>
                                          
                                           <label for="total"><?= $this->lang->line('total') ?></label>
                                        </td>
                                        <td>
                                            <input type="text" name="total_marks" value="50" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="marks_obtain" value=""  class="total_marks" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="marks_obtain_author" value=""  class="total_author_marks" class="form-control" readonly>
                                        </td>
                                        <!-- <td>
                                            <button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
                                        </td> -->
                                    </tr>
                                 
                        </tfoot>
                            </table >
                           
                            <div  class="col-md-12" width="100%">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <b><?= $this->lang->line('save') ?></b>
                                </button>
                            </div>
                        </div>
                        <!-- table-responsive -->
                    </div> </br>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped"  width="100%">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('sr_no') ?></th>
                                        <th><?= $this->lang->line('month') ?></th>
                                        <th><?= $this->lang->line('employee_id') ?></th>
                                        <th><?= $this->lang->line('self_review') ?></th>
                                        <th><?= $this->lang->line('author_review') ?></th>
                                        <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($review)) { $i=1;foreach($review as $obj) { ?>
                                    <tr>
                                        <td><?= $obj['id']?></td>
                                        <?php if($obj['review_period']==1){ ?>
                                            <td>
                                                <?= $obj['review_month']?> (<?= $obj['review_period']?>) First Half
                                            </td>
                                        <?php } else { ?>
                                            <td>
                                                <?= $obj['review_month']?> (<?= $obj['review_period']?>) Second Half
                                            </td>
                                        <?php } ?>
                                        <td><?= $obj['employee_id']?></td>
                                        <td><?= $obj['marks_given_self']?></t_given_selfd></td>
                                        <td><?= $obj['marks_given_author']?></t_given_selfd></td>

                                        <td>
                                        <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
                                        <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?= $this->lang->line('review_details') ?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                          <div class="table-responsive ">
                            <table class="table table-bordered ">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th><?= $this->lang->line('criteria_name') ?></th>
                                  <th><?= $this->lang->line('criteria_point') ?></th>
                                  <th><?= $this->lang->line('self_review') ?></th>
                                  <th><?= $this->lang->line('author_review') ?></th>
                                
                                </tr>
                              </thead>
                              <tbody>
                                 <?php
                                  $j=1;foreach($obj['review_details'] as $po_detail)
                                //   print_r($obj['review_details']);exit();
                                  { ?>
                                <tr>
                                 
                                  <td><?= $j ;?></td>
                                  <td><?= $po_detail['criteria_name'] ;?></td>
                                  <td><?= $po_detail['criteria_point'] ;?></td>
                                  <td><?= $po_detail['self_review'] ;?></td>
                                  <td><?= $po_detail['author_review'] ;?></td>
                                
                                </tr>
                              <?php $j++; }  ?>
                              <tr>
                                  <th colspan="2"><span><center>Total</center></span></th>

                               
                               
                                    
                                    <td><?= $obj['total_marks']?></t_given_selfd></td>
                                    <td><?= $obj['marks_given_self']?></t_given_selfd></td>
                                    <td><?= $obj['marks_given_author']?></t_given_selfd></td>
                                    
                                </tr>
                              </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                          </div>
                            
                                    </td>
              
                                  
                          
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div> <!-- card-body closed -->
        </div> <!-- card-outline closed -->
    </div> <!-- container-fluid -->
</form>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
       
        $(document).on('keyup','.marks',function(){
			var table=$(this).closest('table');
			calculate_total(table);

	    });

        function calculate_total(table)
		{
			var total_marks=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				var marks=parseFloat($(this).find("td:nth-child(3) input.marks").val());
				//alert(marks);
				if(isNaN(marks))
				{
					marks =0;
				}
				total_marks=total_marks+marks;
				/$(this).find("td:nth-child(6) input.total").val(amount.toFixed(2));/
				//alert(total_qty);
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_marks").val(total_marks.toFixed(2));
		}
        $(document).on('keyup','.author_marks',function(){
			var table=$(this).closest('table');
			calculate_total_author(table);

	    });

        function calculate_total_author(table)
		{
			var total_author_marks=0;
			table.find(" tbody tr.main_tr1").each(function()
			{
				//var qty,rate,total=0;
				var author_marks=parseFloat($(this).find("td:nth-child(4) input.author_marks").val());
				//alert(marks);
				if(isNaN(author_marks))
				{
					author_marks =0;
				}
				total_author_marks=total_author_marks+author_marks;
				/$(this).find("td:nth-child(6) input.total").val(amount.toFixed(2));/
				//alert(total_qty);
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_author_marks").val(total_author_marks.toFixed(2));
		}
        


    });

</script>

