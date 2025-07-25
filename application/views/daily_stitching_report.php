<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
$data=explode('?', $current_page);
//print_r($po_data);exit;
?>


      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Daily_stitching_records/createXLS">

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
             <!--  <div class="col-md-4 col-sm-4 ">
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
                      <label  class="control-label"><?= $this->lang->line('from_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> <?= $this->lang->line('upto_date') ?></label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                  
                 <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > <?= $this->lang->line('reset') ?></a>
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
            
              
              <!-- <?php echo $obj['worker_id']; ?> -->
              <?php //echo "<pre>"; print_r($obj); ?>
            <tr>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('date') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('registration_number') ?> </th>
              <!-- <th style="white-space: nowrap;"> Requisition Date </th> -->
              <th style="white-space: nowrap;"> <?= $this->lang->line('department') ?> </th>
              <th style="white-space: nowrap;"><?= $this->lang->line('incharge_name') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('worker_name') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('total_worker') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('total_bags') ?></th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('total_amount') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('action_button') ?>  </th>
            </tr>
            <tr>
                <td><?php echo $i;?></td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>

                <td>
                  <?php  
                        if(!empty($obj['dsr_details'])){
                         $inv_number=$obj['dsr_details'][0]['daily_stiching_record_id'];
                            if(!empty($inv_number)){
                                if($inv_number<10){
                                    $inv_number1='DSR000'.$inv_number;
                                    }
                                    else if(($inv_number>=10) && ($inv_number<=99)){
                                    $inv_number1='DSR00'.$inv_number;
                                    }
                                    else if(($inv_number>=100) && ($inv_number<=999)){
                                    $inv_number1='DSR0'.$inv_number;
                                    }
                                    else{
                                    $inv_number1='DSR'.$inv_number;
                                    }
                                    echo $inv_number1; 
                            }
                        }
                        ?>
                </td>
                <td><?php echo $obj['department']; ?></td>
                <td><?php echo $obj['employee']; ?></td>
                <td><?php echo $obj['dsr_details'][0]['worker_name']; ?></td>
                <td><?php echo $obj['total_workers']; ?></td>
                <td><?php echo $obj['total_bags']; ?></td>
                <td><?php echo $obj['dsr_details'][0]['total_amount']; ?></td>
                
                <td>
                    <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Daily_stitching_records/deleteDSR/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Daily Stitching Record (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-3"> <?= $this->lang->line('worker_name') ?> </div>
                                <div class="col-md-3"> <?= $this->lang->line('grade_name') ?> </div>
                                <div class="col-md-2"> <?= $this->lang->line('no_of_bags') ?> </div>
                                <div class="col-md-2"> <?= $this->lang->line('rate') ?> / Bag </div>
                                <div class="col-md-2"> <?= $this->lang->line('amount') ?> </div>
                              </div>

                                    <?php
                                    $total_hours=0;
                                      $j=1;foreach($obj['dsr_details'] as $po_detail)
                                      { 
                                            $voucher_no= $po_detail['worker_code']; 
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

                              <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                           <div class="col-md-3"><?= $po_detail['worker_name'].' ('.$worker_id_code.')' ;?> </div>
                                          <div class="col-md-3"><?= $po_detail['mineral_name'].' ('. $po_detail['grade_name'].')' ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['no_of_bags'] ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['rate'] ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['total_amount'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>

                           <div class="row col-md-12" >
                              <div class="col-md-4">
                                <label class="control-label">  <?= $this->lang->line('total_workers') ?>: </label>
                                <span > <?php echo $obj['total_workers']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> <?= $this->lang->line('total_bags') ?> : </label>
                                <span > <?php echo $obj['total_bags']?></span>
                              </div>    
                               <div class="col-md-4">
                                <label class="control-label"> <?= $this->lang->line('total_amount') ?> : </label>
                                <span > <?php echo $obj['grand_total']?></span>
                              </div>                            
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                          </div>
                        </div>
                        </form>
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

