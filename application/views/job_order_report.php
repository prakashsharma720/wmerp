<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
$data=explode('?', $current_page);
//print_r($po_data);exit;
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
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Daily_tailing_records/createXLS">

          <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
          <?php } }?>
           <button type="submit" class="btn btn-info"> Export </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
          <div class="row">

              <!-- <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Name of Employee <span class="required">*</span></label>
                <select name="worker_id" class="form-control select2 workers" >
                    <option value="0">Select Employee</option>
                    <?php
                         if ($workers): ?> 
                          <?php 
                            foreach ($workers as $value) : 
                              $inv_number=$value['worker_code'];
                              if($inv_number<10){
                                $inv_number1='WA000'.$inv_number;
                                }
                                else if(($inv_number>=10) && ($inv_number<=99)){
                                  $inv_number1='WA00'.$inv_number;
                                }
                                else if(($inv_number>=100) && ($inv_number<=999)){
                                  $inv_number1='WA0'.$inv_number;
                                }
                                else{
                                  $inv_number1='WA'.$inv_number;
                                }
                            ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'].' ('.$inv_number1.')' ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div> -->
              <!-- <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Name of Department <span class="required">*</span></label>
                <select name="department_id" class="form-control select2 employees" >
                    <option value="0">Select Department</option>
                    <?php
                         if ($departments): ?> 
                          <?php 
                            foreach ($departments as $value) : ?>
                               <option value="<?= $value['id'] ?>"><?= $value['department_name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div> -->
               <!-- <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Requisition Status <span class="required">*</span></label>
                <select name="approved_status" class="form-control select2 " >
                    <?php
                         if ($req_status): ?> 
                          <?php 
                            foreach ($req_status as $value) : ?>
                               <option value="<?= $value ?>"><?= $value ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div> -->

             <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                  
                 <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
              </div>
          </div>
            
        </form>
            <hr>
<?php if(!empty($requisition_data)){ ?>
      <div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <!-- <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Requisition No </th>
              <th style="white-space: nowrap;"> Requisition Date </th>
              <th style="white-space: nowrap;">Request By </th>
              <th style="white-space: nowrap;"> Status </th>
              <th style="white-space: nowrap;"> Action Date </th>
              <th style="white-space: nowrap;"> Action By <span style="color: white;">Name</span></th>
              </tr>
              <tr>
              <th style="white-space: nowrap;"> Material Name </th>
              <th style="white-space: nowrap;"> Required Qty (Unit)</th>
              <th style="white-space: nowrap;"> Issue Qty (Unit)</th>
            </tr> -->
          </thead>
          <tbody>
           <?php
           
          $i=1;foreach($requisition_data as $obj){ ?>
            
              
              <!-- <?php echo $obj['meter_id']; ?> -->
              <?php //echo "<pre>"; print_r($obj); ?>
            <tr>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;">Job Order Date </th>
              <th style="white-space: nowrap;"> Job Order No </th>
              <th style="white-space: nowrap;"> Work Description </th>
              <th style="white-space: nowrap;"> Location</th>
              <th style="white-space: nowrap;"> Assigned To </th>
              <th style="white-space: nowrap;"> Status </th>
              <th style="white-space: nowrap;"> Completion date </th>
              <th style="white-space: nowrap;"> Reported By</th>
              <!-- <th style="white-space: nowrap;"> Total Amount </th> -->
              <th style="white-space: nowrap;"> Action Button  </th>
            </tr>
            <tr>
                <td><?php echo $i;?></td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>

                <td>
                  <?php  
                        if(!empty($obj['voucher_code'])){
                         $inv_number=$obj['voucher_code'];
                            if(!empty($inv_number)){
                                if($inv_number<10){
                                    $inv_number1='JOR000'.$inv_number;
                                    }
                                    else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='JOR00'.$inv_number;
                                    }
                                    else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='JOR0'.$inv_number;
                                    }
                                    else{
                                    $inv_number1='JOR'.$inv_number;
                                    }
                                    echo $inv_number1; 
                            }
                        }
                        ?>
                </td>

                <td><?php echo $obj['work_description']; ?></td>
                <td><?php echo $obj['location']; ?></td>
                <td><?php echo $obj['worker_name']; ?></td>
                <td><?php echo $obj['job_order_status']; ?></td>
                <td><?php echo $obj['completion_date']; ?></td>

                <td style="white-space: nowrap;"><?php  
                    $voucher_no= $obj['emp_code']; 
                    if($voucher_no<10){
                    $employee_id_code='EC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $employee_id_code='EC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $employee_id_code='EC0'.$voucher_no;
                    }
                    else{
                      $employee_id_code='EC'.$voucher_no;
                    }
                    echo $obj['emp_name'].' ('.$employee_id_code.')';

                ?>
                  
                </td>
                                
                <td>
                     <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a> -->
				 </td>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Daily Tailing Record (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <?php
                                  $total_grades=0;
                                    $j=1;foreach($obj['dsr_details'] as $po_detail)
                                    { 
                                      $total_grades=$total_grades+$j;
                                       ?>

                                  <fieldset>
                                    <legend><?= $po_detail['mineral_name'].' ('. $po_detail['grade_name'].')' ;?> </legend>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <label class="control-label"> Lot No  : </label>
                                        <span > <?= $po_detail['lot_no'] ;?></span>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="control-label"> Batch No   : </label>
                                        <span > <?= $po_detail['batch_no'] ;?> </span>
                                      </div> 
                                      <div class="col-md-4">
                                        <label class="control-label"> No Of Bags : </label>
                                        <span > <?= $po_detail['no_of_bags'] ;?> </span>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="control-label"> Bag Weight : </label>
                                        <span > <?= $po_detail['bag_weight'] ;?> </span>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="control-label"> Tailing In MT  : </label>
                                        <span > <?= $po_detail['tailing_qty_in_mt'] ;?> MT</span>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="control-label"> Total Tailing For Lot   : </label>
                                        <span > <?= $po_detail['total_tailing_for_lot'] ;?> </span>
                                      </div> 
                                      <div class="col-md-4">
                                        <label class="control-label"> Gride Name : </label>
                                        <span > <?= $po_detail['location_of_storage'] ;?> </span>
                                      </div>
                                      <div class="col-md-8">
                                        <label class="control-label"> Color : </label>
                                        <span > <?= $po_detail['color'] ;?> </span>
                                      </div>
                                      <div class="col-md-4">
                                        <label class="control-label"> Re-Used In  : </label>
                                        <span > <?= $po_detail['used_mineral_name'].' ('. $po_detail['used_grade_name'].')' ;?> </span>
                                      </div> 
                                      <div class="col-md-4">
                                        <label class="control-label"> Re-Used Qty  : </label>
                                        <span > <?= $po_detail['used_qty'] ;?> </span>
                                      </div> 
                                      <div class="col-md-4">
                                        <label class="control-label"> Balance Qty  : </label>
                                        <span > <?= $po_detail['balance_qty'] ;?> </span>
                                      </div> 
                                      
                                    </div>
                                  </fieldset>
                                  <?php  }  ?>
                        <br>
                           <div class="row col-md-12" >
                              <div class="col-md-4">
                                <label class="control-label">  Total Grades: </label>
                                <span > <?php echo $total_grades?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> Total Bags : </label>
                                <span > <?php echo $obj['total_bags']?></span>
                              </div> 
                               <div class="col-md-12">
                                <label class="control-label"> Remarks : </label>
                                <span > <?php echo $obj['remarks']?></span>
                              </div>      
                            </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                <!-- <td><?php echo $obj['approved_status']; ?></td> -->
                <!-- <td><?php 
                if($obj['approved_status']=='Pending'){
                    echo 'NA';
                } else if($obj['approved_status']=='Rejected'){
                    echo date('d-m-y',strtotime($obj['rejected_date']));
                }else if($obj['approved_status']=='Approved'){
                    echo date('d-m-y',strtotime($obj['approved_date']));
                }
                ?>
                </td> -->
                <!-- <td>\
                  
                <?php 
                if($obj['approved_status']=='Pending'){
                    echo 'NA';
                } else if($obj['approved_status']=='Rejected'){
                    echo $obj['rejector'];
                }else if($obj['approved_status']=='Approved'){
                    echo $obj['approver'];
                }
                ?>
                 </td> -->
                </tr>
<!--                 
                 <tr>
                  <th style="white-space: nowrap;"> Material Name </th>
                  <th colspan="5" style="white-space: nowrap;"> Required Qty (Unit)</th>
                  <th style="white-space: nowrap;"> Issue Qty (Unit)</th>
                  <th style="white-space: nowrap;"> Pending Qty (Unit)</th>
                </tr> -->
                    <!-- <?php
                          $j=1;foreach($obj['requisition_details'] as $po_detail)
                          { ?>
                           <tr>
                            <td colspan="1"></td>
                            <td> <?= $po_detail['material_name'].' ('.$po_detail['material_code'].')' ;?> </td>
                            <td  colspan="5"><?= $po_detail['quantity'].' '.$po_detail['unit'] ;?></td>
                            <!-- <td><?= $po_detail['issue_qty'].' '.$po_detail['unit'] ;?></td>
                            <td><?= $po_detail['pending_qty'].' '.$po_detail['unit'] ;?></td> -->
                          </tr>

                    <?php } ?> -->
            <?php  $i++;} ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
     
    jQuery('#master').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
      $(".sub_chk").prop('checked', true);  
    }  
    else  
    {  
      $(".sub_chk").prop('checked',false);  
    }  
  });
    jQuery('.delete_all').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition",  
          cache:false,  
          data: 'ids='+join_selected_values,  
          success: function(response)  
          {   
            $(".successs_mesg").html(response);
            location.reload();
          }   
        });
           
      }  
    }  
  });

  });

</script>

