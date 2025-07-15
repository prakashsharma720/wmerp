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
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Work_allotments/add" class="btn btn-success" data-toggle="tooltip" title="New Production Register"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"><?=$this ->lang->line('wa_no')?></th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('date_of_work')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('work_area')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang->line('department')?></th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('total_workers')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang->line('incharge_name')?> </th>
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
                         $inv_number=$obj['wa_code'];
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
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['mill_no']; ?></td>
                <td><?php echo $obj['department']; ?></td>
                <td><?php echo $obj['total_workers']; ?></td>
                <td><?php echo $obj['employee']; ?></td>               
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
				           <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/print/<?php echo $obj['id'];?>" title="Print Production Register" ><i class="fa fa-print"></i></a> -->
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Work_allotments/edit/<?php echo $obj['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>" title="Delete"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Work Allocation Register (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-4"><?=$this ->lang->line('worker_name')?> </div>
                                <div class="col-md-4"><?=$this ->lang->line('work_alloted')?> </div>
                                <div class="col-md-3"> <?=$this ->lang->line('attendance')?> (Hours)</div>
                              </div>

                                    <?php
                                    $total_hours=0;
                                      $j=1;foreach($obj['work_alloted_details'] as $po_detail)
                                      { 
                                        $total_hours=$total_hours+$po_detail['attendance'];
                                        ?>
                                        <?php 
                                            $voucher_no= $po_detail['worker_code']; 
                                            if($voucher_no<10){
                                            $worker_id_code='WC000'.$voucher_no;
                                            }
                                            else if(($voucher_no>=10) && ($voucher_no<=99)){
                                              $worker_id_code='WC00'.$voucher_no;
                                            }
                                            else if(($voucher_no>=100) && ($voucher_no<=999)){
                                              $worker_id_code='WC0'.$voucher_no;
                                            }
                                            else{
                                              $worker_id_code='WC'.$voucher_no;
                                            }
                                           
                                         ?>

                              <div class="row col-md-12" style="border: 0px solid #f3ecec;margin
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 20px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-3"><?= $po_detail['worker_name'].' ('.$worker_id_code.')' ;?> </div>
                                          <div class="col-md-5"><?= $po_detail['work_allotted'] ;?> </div>
                                          <div class="col-md-3"><?= $po_detail['attendance'] ;?> Hrs</div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>

                           <div class="row col-md-12" >
                              <div class="col-md-8">
                                <label class="control-label"><?=$this ->lang->line('department')?>: </label>
                                <span > <?php echo $obj['department']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang->line('total_hours')?> : </label>
                                  <span > 
                                      <?php 
                                        $actual_time=0;
                                        $total_hours=number_format((float)$total_hours, 2, '.', '');
                                        $total_time=explode('.', $total_hours);
                                        $hr=$total_time['0'];
                                        $min=$total_time['1'];
                                        if($min >= 60){
                                            $hr=$hr+1;
                                            $min=$min-60;
                                            $actual_time=$hr.'.'.$min.' Hrs';
                                            
                                        }
                                        else
                                        {
                                          $actual_time=$hr.'.'.$min.' Hrs';
                                        }
                                          echo $actual_time; 
                                        
                                        ?>
                                  </span>
                              </div>
                              <div class="col-md-6">
                                <label class="control-label"><?=$this ->lang->line('total_workers')?> : </label>
                                <span > <?php echo $obj['total_workers']?></span>
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
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Work_allotments/deleteWork_alloted/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang->line('conform_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete this Work Allotment  <b><?php echo $inv_number1;?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?=$this ->lang->line('yes')?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?=$this ->lang->line('no')?> </button>
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
          url: "<?php echo base_url(); ?>index.php/Work_allotments/deleteWork_alloted",  
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