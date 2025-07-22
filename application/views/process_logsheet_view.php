<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
      <!-- <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Process_logsheets/add" class="btn btn-success" data-toggle="tooltip" title="New Production Register"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button> -->
        <span class="card-title">Process Logsheet Lists          </span>
            <div class="button-group float-right d-flex">

                <a href="http://localhost/wmerp/index.php/Employees/add" class="btn btn-success" data-toggle="tooltip" title="New Employee"><i class="fa fa-plus"></i></a>
                <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

                <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="fa fa-trash"></i></button>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?= $this->lang->line('sr_no') ?>.</th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('pl_no') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('date_of_production') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('mill_no') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('production_by') ?> </th>
              <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button') ?></th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($pr_data as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td>
                  <?php 
                         $inv_number=$obj['voucher_code'];
                          if($inv_number<10){
                            $inv_number1='PSL000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='PSL00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='PSL0'.$inv_number;
                            }
                            else{
                              $inv_number1='PSL'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['mill_no']; ?></td>
                <td><?php echo $obj['employee']; ?></td>               
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
				           <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/print/<?php echo $obj['id'];?>" title="Print Production Register" ><i class="fa fa-print"></i></a> -->
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Process_logsheets/edit/<?php echo $obj['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>" title="Delete"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Process_logsheets/deletePR/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Process Logsheet (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                                    <?php
                                      $j=1;foreach($obj['process_details'] as $po_detail)
                                      { ?>
                                        <fieldset>
                                          <legend> <?= $po_detail['grade_name'].' ('.$po_detail['fg_code'].')' ;?> Production Details </legend>
                                          <div class="row ">
                                            <div class="col-md-12">
                                              <label> <?= $this->lang->line('date_time') ?> : </label>  : 
                                              <?= date('d-M-Y',strtotime($po_detail['date'])).', '.$po_detail['hrs1'].' : '.$po_detail['min1'] ;?>
                                            </div>
                                             <div class="col-md-4">
                                              <label> <?= $this->lang->line('lot_no') ?></label>  : 
                                              <?= $po_detail['lot_no'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> <?= $this->lang->line('batch_no') ?></label>  : 
                                              <?= $po_detail['batch_no'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> S. No. Last Bag </label>  : 
                                              <?= $po_detail['previous_bag_no'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> <?= $this->lang->line('plate_weight') ?></label>  : 
                                              <?= $po_detail['plate_weight'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> <?= $this->lang->line('grate_weight') ?></label>  : 
                                              <?= $po_detail['grate_weight'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Avg Temp Of Pulverizer</label>  : 
                                              <?= $po_detail['avg_temp_pulverizer'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Avg Temp Of Pribbon </label>  : 
                                              <?= $po_detail['avg_temp_pribbon'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Avg Temp Of Hopper </label>  : 
                                              <?= $po_detail['avg_temp_hopper'] ?>
                                            </div>
                                             <div class="col-md-4">
                                              <label> <?= $this->lang->line('oversize_weight') ?></label>  : 
                                              <?= $po_detail['oversize_weight'] ?>
                                            </div>
                                          </div>
                                        </fieldset>
                                  <?php  }  ?>
                              </div>
                            <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> <?= $this->lang->line('remarks') ?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['remarks']; 
                                        ?>
                                  </span>
                              </div>
                            </div> 
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Process_logsheets/deleteProcess/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Production Register <b><?php echo $obj['voucher_code'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
            <?php  $i++;} ?>
          </tbody>
        </table>
      </div>
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
          url: "<?php echo base_url(); ?>index.php/Process_logsheets/deleteProcess",  
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