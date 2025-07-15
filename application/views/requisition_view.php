<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
?>
<!-- <div id="ac-wrapper">
  <div id="popup">
    <button type="button" class="close" data-dismiss="modal" onClick="PopUp()">&times;</button>
  </div>
</div> 


 <style type="text/css">
  #ac-wrapper {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background: rgba(255,255,255,.6);
z-index: 1001;
}
#popup{
width: 555px;
height: 375px;
background-image:url('<?php echo base_url() ;?>uploads/yash.png');
border: 1px solid #000;
border-radius: 1px;
-moz-border-radius: 1px;
-webkit-border-radius: 1px;
box-shadow: #64686e 0px 0px 3px 3px;
-moz-box-shadow: #64686e 0px 0px 3px 3px;
-webkit-box-shadow: #64686e 0px 0px 3px 3px;
position: relative;
top: 150px; left: 375px;
}

</style> 
<script type="text/javascript">
function PopUp(){
        document.getElementById('ac-wrapper').style.display="none"; 
}
</script> -->




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
      <span class="card-title"><?=$this ->lang ->line('requisition_slip_list')?>
      </span>
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Requisition_slips/add" class="btn btn-success" data-toggle="tooltip" title="New Requisition"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?=$this ->lang ->line('sr_no')?>.</th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('requisition_no')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('requisition_date')?> </th>
             <!--  <th style="white-space: nowrap;">Total Quantity </th> -->
              <th style="white-space: nowrap;"><?=$this ->lang ->line('request_by')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang ->line('status')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('action_date')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('action_by')?><span style="color: white;"><?=$this ->lang ->line('name')?></span></th>
              <th style="white-space: nowrap;width: 20%;"> <?=$this ->lang ->line('action_button')?></th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($requisition_data as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td>
                  <?php 
                         $inv_number=$obj['requisition_slip_no'];
                          if($inv_number<10){
                            $inv_number1='RS000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='RS00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='RS0'.$inv_number;
                            }
                            else{
                              $inv_number1='RS'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <!-- <td><?php echo $obj['total_qty']; ?></td> -->
                <td><?php echo $obj['requestor']; ?></td>
                <td><?php echo $obj['approved_status']; ?></td>
                <td><?php 
                if($obj['approved_status']=='Pending'){
                    echo 'NA';
                } else if($obj['approved_status']=='Rejected'){
                    echo date('d-m-y',strtotime($obj['rejected_date']));
                }else if($obj['approved_status']=='Approved'){
                    echo date('d-m-y',strtotime($obj['approved_date']));
                }
                ?>
                </td>
                <td>
                <?php 
                if($obj['approved_status']=='Pending'){
                    echo 'NA';
                } else if($obj['approved_status']=='Rejected'){
                    echo $obj['rejector'];
                }else if($obj['approved_status']=='Approved'){
                    echo $obj['approver'];
                }
                ?>
                 </td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
				          <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>

				        <?php 
                if($obj['approved_status']=='Pending') { ?>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <?php } ?>

                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                  
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/deletePO/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> <?=$this ->lang ->line('requisition_slip')?> (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-5"><?=$this ->lang ->line('item_name')?> </div>
                                <div class="col-md-2"><?=$this ->lang ->line('qty')?> </div>
                                <div class="col-md-4"><?=$this ->lang ->line('description')?> </div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['requisition_details'] as $po_detail)
                                      { ?>
                                        <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-5"><?= $po_detail['material_name'].' ('.$po_detail['material_code'].')' ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['quantity'].' '.$po_detail['unit'] ;?> </div>
                                          <div class="col-md-4"><?= $po_detail['description'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>

                             <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> <?=$this ->lang ->line('requisition_slip_for')?> :  </label>
                                  <span > 
                                      <?php 
                                          echo $obj['rs_for']; 
                                        ?>
                                  </span>
                              </div>
                            </div>
                           <?php if(($obj['rs_for']=='Raw Material') || ($obj['rs_for']=='Packing Material')) {  ?>
                                 <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> <?=$this ->lang ->line('mineral_name')?>: </label>
                                    <span > <?php echo $obj['mineral_name']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?=$this ->lang ->line('grade_name')?>: </label>
                                    <span > <?php echo $obj['grade_name'] ?></span>
                                  </div>
                                </div>
                                <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> <?=$this ->lang ->line('lot_no')?> : </label>
                                    <span > <?php echo $obj['lot_no']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?=$this ->lang ->line('batch_no')?>: </label>
                                    <span > <?php echo $obj['batch_no'] ?></span>
                                  </div>
                                </div>
                           <?php } else{ ?>
                                 <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"><?=$this ->lang ->line('equipment_name')?> : </label>
                                    <span > <?php echo $obj['equipment_name']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?=$this ->lang ->line('purpose')?>: </label>
                                    <span > <?php echo $obj['purpose'] ?></span>
                                  </div>
                                </div>
                           <?php } ?>

                           
                            <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> <?=$this ->lang ->line('comment')?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['comment']; 
                                        ?>
                                  </span>
                              </div>
                            </div>

                            <!-- <div class="row col-md-12" >
                                <div class="col-md-4">
                                    <label class="control-label"> Approved Status : </label>
                                    <span > <?php echo $obj['approved_status']?></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Approved By: </label>
                                    <span > <?php echo $obj['approver'] ?></span>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"> Approved On : </label>
                                    <span > <?php echo date('d-M-Y H:i:s',strtotime($obj['approved_on']))?></span>
                                </div>
                            </div> -->

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?=$this ->lang ->line('close')?></button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>


                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang ->line('confirm_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p><?=$this ->lang ->line('confirm_delete')?> <?=$this ->lang ->line('requisition_slip')?> <b><?php echo $obj['requisition_slip_no'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?=$this ->lang ->line('yes')?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <?=$this ->lang ->line('no')?> </button>
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