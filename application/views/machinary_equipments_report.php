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
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Machinary_equipments/createXLS">

          <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
          <?php } }?>
           <button type="submit" class="btn btn-info"> <?= $this->lang->line('export') ?> </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
      
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
          <div class="row">

             
              <div class="col-md-4 col-sm-3 ">
                <label  class="control-label">Filter By Department <span class="required">*</span></label>
                <select name="area" class="form-control select2 employees" >
                   <option value="0"><?= $this->lang->line('please_select_department') ?></option>
                    <?php
                         if ($areas): ?> 
                          <?php 
                            foreach ($areas as $key=>$value) : ?>
                               <option value="<?= $value['id'] ?>"><?= $value['department_name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?= $this->lang->line('no_result') ?></option>
                        <?php endif; ?>
                </select>
              </div>
               
             
             <div class="col-md-4 col-sm-3">
                      <label  class="control-label"> <?= $this->lang->line('from_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-3">
                    <label  class="control-label"> <?= $this->lang->line('upto_date') ?></label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                   <div class="col-md-6 col-sm-6 ">
                   </div>
                   <div class="col-sm-4 col-sm-4   ">
                      <label  class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label><br>
                      <input type="submit" class="btn btn-primary" value="Search" /> 
                      <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                      <a href="<?php echo base_url(); ?>index.php/Machinary_equipments/report" class="btn btn-danger" > <?= $this->lang->line('reset') ?></a>
                  </div>
                </div>
            
        </form>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?= $this->lang->line('sr_no') ?>.</th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('pme_no') ?> </th>
              <!-- <th style="white-space: nowrap;"> Date </th> -->
              <th style="white-space: nowrap;"> <?= $this->lang->line('department') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('created_by') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('equipment_name') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('equipment_id') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('model_type') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('sr_no') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('make') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('year_of_installation') ?> </th>
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
                         $inv_number=$obj['pme_code'];
                          if($inv_number<10){
                            $inv_number1='PME000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='PME00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='PME0'.$inv_number;
                            }
                            else{
                              $inv_number1='PME'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <!-- <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td> -->
                <td><?php echo $obj['department']; ?></td>
                <td><?php echo $obj['employee']; ?></td>
                <td><?php echo $obj['equip_name']; ?></td>
                <td><?php echo $obj['equipment_id']; ?></td>
                <td><?php echo $obj['model_type']; ?></td>
                <td><?php echo $obj['sr_no']; ?></td>
                <td><?php echo $obj['make']; ?></td>
                <td><?php echo $obj['year_of_install']; ?></td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Machinary_equipments/edit/<?php echo $obj['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>" title="Delete"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>

                <!-- modal to use in view -->
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Machinary_equipments/deletePME/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Machinary Equipments (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-12 col-sm-12 d-flex flex-row" style="border: 1px solid #f3ecec;height: 45px;padding: 10px;margin: 0px;margin-bottom: 6px; font-weight: 500;">
                                  <div class="col-lg-3">Equipment Name</div>
                                  <div class="col-lg-3">Transaction Date</div>
                                  <div class="col-lg-3">Department</div>
                                  <div class="col-lg-3">Equipment ID</div>
                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex flex-row mb-4">
                                  <div class="col-lg-3"><?php echo $obj['equip_name']?></div>
                                  <div class="col-lg-3"><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></div>
                                  <div class="col-lg-3"><?php echo $obj['department']; ?></div>
                                  <div class="col-lg-3"><?php echo $obj['equipment_id']; ?></div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-12 col-sm-12 d-flex flex-row" style="border: 1px solid #f3ecec;height: 45px;padding: 10px;margin: 0px;margin-bottom: 6px; font-weight: 500;">
                                  <div class="col-lg-3">Model / Type</div>
                                  <div class="col-lg-3">Sr. No.</div>
                                  <div class="col-lg-3">Make</div>
                                  <div class="col-lg-3">Year Of Installation</div>
                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex flex-row mb-5">
                                  <div class="col-lg-3"><?php echo $obj['model_type']; ?></div>
                                  <div class="col-lg-3"><?php echo $obj['sr_no']; ?></div>
                                  <div class="col-lg-3"><?php echo $obj['make']; ?></div>
                                  <div class="col-lg-3"><?php echo $obj['year_of_install']; ?></div>
                                </div>
                              </div>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Machinary_equipments/deleteGSR/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete This DSR  <b> (<?php echo $inv_number1 ?>) </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
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
          url: "<?php echo base_url(); ?>index.php/Machinary_equipments/deleteGSR",  
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