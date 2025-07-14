<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
        <form method="post" action="<?php echo base_url(); ?>index.php/Waste_material_records/createXLS">

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

             
              <div class="col-md-4 col-sm-3 ">
                <label  class="control-label"><?=$this ->lang->line('filter_by_department')?> <span class="required">*</span></label>
                <select name="department_id" class="form-control select2 employees" >
                    <option value="0"><?=$this ->lang->line(' select_department')?></option>
                    <?php
                         if ($departments): ?> 
                          <?php 
                            foreach ($departments as $value) : ?>
                               <option value="<?= $value['id'] ?>"><?= $value['department_name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang->line('no_result')?></option>
                        <?php endif; ?>
                </select>
              </div>
               
             
             <div class="col-md-4 col-sm-3">
                      <label  class="control-label"><?=$this ->lang->line('from_date')?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-3">
                    <label  class="control-label"> <?=$this ->lang->line('upto_date')?></label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                   <div class="col-md-6 col-sm-6 ">
                   </div>
                   <div class="col-sm-4 col-sm-4   ">
                      <label  class="control-label" style="visibility: hidden;"><?=$this ->lang->line('grade')?></label><br>
                      <input type="submit" class="btn btn-primary" value="Search" /> 
                      <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                      <a href="<?php echo base_url(); ?>index.php/Waste_material_records/report" class="btn btn-danger" > <?=$this ->lang->line('reset')?></a>
                  </div>
                </div>
            
        </form>
      <div class="table-responsive">
 <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('register_no')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('date')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('department')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('total_waste_material')?></th>
              <!--<th style="white-space: nowrap;"> Total Waste Qty</th>-->
              <th style="white-space: nowrap;"> <?=$this ->lang->line('incharge_name')?> </th>
              <th style="white-space: nowrap;width: 20%;"><?=$this ->lang->line('action_button')?></th>
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
                            $inv_number1='WM000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='WM00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='WM0'.$inv_number;
                            }
                            else{
                              $inv_number1='WM'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['department']; ?></td>
                <td><?php echo $obj['total_waste_materials']; ?></td>
                <!--<td><?php echo $obj['total_qty']; ?></td>-->
                <td><?php echo $obj['employee']; ?></td>               
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
                   <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/print/<?php echo $obj['id'];?>" title="Print Production Register" ><i class="fa fa-print"></i></a> -->
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Waste_material_records/edit/<?php echo $obj['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>" title="Delete"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> <?=$this ->lang->line('waste_material_register')?>(<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-4"> <?=$this ->lang->line('material_name')?> </div>
                                 <div class="col-md-4"> <?=$this ->lang->line('party_name')?></div>
                                <div class="col-md-3"><?=$this ->lang->line('qty')?> </div>
                              </div>

                                    <?php
                                    $total_hours=0;
                                      $j=1;foreach($obj['waste_details'] as $po_detail)
                                      { 
                                        ?>
                                        <?php 
                                          $inv_number=$po_detail['service_provider_code'];
                                          if($inv_number<10){
                                            $inv_number1='SP000'.$inv_number;
                                            }
                                            else if(($inv_number>=10) && ($inv_number<=99)){
                                              $inv_number1='SP00'.$inv_number;
                                            }
                                            else if(($inv_number>=100) && ($inv_number<=999)){
                                              $inv_number1='SP0'.$inv_number;
                                            }
                                            else{
                                              $inv_number1='SP'.$inv_number;
                                            }
                                         ?>
                                     
                              <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-4"><?= $po_detail['waste_material_name'] ;?> </div>
                                          <div class="col-md-4"><?= $po_detail['service_provider_name'].' ('.$inv_number1.')' ;?> </div>
                                          <div class="col-md-3"><?= $po_detail['quantity'].' '.$po_detail['unit'] ;?> </div>

                                        </div>
                                  <?php $j++; }  ?>
                              </div>

                           <div class="row col-md-12" >
                             
                              <div class="col-md-6">
                                <label class="control-label"> <?=$this ->lang->line('total_waste_materials')?> : </label>
                                <span > <?php echo $obj['total_waste_materials']?></span>
                              </div>
                               <!-- <div class="col-md-4">
                                <label class="control-label"> Total Qty : </label>
                                  <span > 
                                   <?php
                                      echo $obj['total_qty']; 
                                    ?>
                                  </span>
                              </div>-->
                               <div class="col-md-6">
                                <label class="control-label"> <?=$this ->lang->line('department')?>: </label>
                                <span > <?php echo $obj['department']?></span>
                              </div>
                              
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?=$this ->lang->line('close')?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Waste_material_records/deleteRecord/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang->line('conform_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete this Record <b><?php echo $inv_number1;?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?=$this ->lang->line('yes')?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <?=$this ->lang->line('no')?></button>
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
          url: "<?php echo base_url(); ?>index.php/Waste_material_records/deleteRecord",  
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