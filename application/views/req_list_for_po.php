<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('pending_requisition_slips_for_purchase_order') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('view_list') ?></li>
      </ul>
    </div>
	<div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
     
    
      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">

        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
?>
     

    
   <div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
                <thead>
                  <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?= $this->lang->line('sr_no') ?>.</th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('requisition_no') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('requisition_date') ?> </th>
             <!--  <th style="white-space: nowrap;">Total Quantity </th> -->
              <th style="white-space: nowrap;"><?= $this->lang->line('request_by') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('status') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('action_date') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('action_by') ?> <span style="color: white;"><?= $this->lang->line('name') ?></span></th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('action_button') ?></th>
            </tr>
          </thead>
          <tbody>
           <?php
           if(!empty($requisition_data)){
              $i=1;foreach($requisition_data as $obj){ 
                //print_r($obj);exit;
                ?>
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
                <td <td style="display: flex; gap: 5px; align-items: center;">
                 
 <a class="btn btn-icon avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#approv<?= $obj['id']; ?>" title="View Details">
                            <i class="feather feather-eye"></i>
                          </a>
                    <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Purchase_order/add/<?php echo $obj['id'];?>" data-toggle="tooltip" title="Convert to Purchase Order" ><i class="fa fa-refresh"></i></a>
                    <!--  <a class="btn btn-xs btn-danger " data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a> -->
                </td>
                 <?php $this->load->View('leave-module/component/approved.php', ['obj' => $obj]); ?>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/deletePO/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> <?= $this->lang->line('requisition_slip') ?> (<?php echo $inv_number1 ?>)  <?= $this->lang->line('details') ?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-5"><?= $this->lang->line('item_name') ?> </div>
                                <div class="col-md-2"><?= $this->lang->line('qty') ?> </div>
                                <div class="col-md-4"><?= $this->lang->line('description') ?> </div>
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
                                          <div class="col-md-5"><?= $po_detail['item'].' ('.$po_detail['code'].')' ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['quantity']-$po_detail['issue_qty'] ;?> </div>
                                          <div class="col-md-4"><?= $po_detail['description'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>

                           <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> <?= $this->lang->line('total_qty') ?> : </label>
                                <span > <?php echo $obj['total_qty']?></span>
                              </div>
                            </div>
                             <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> <?= $this->lang->line('requisition_slip_for') ?> :  </label>
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
                                    <label class="control-label"> <?= $this->lang->line('mineral_name') ?>: </label>
                                    <span > <?php echo $obj['mineral_name']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('grade_name') ?>: </label>
                                    <span > <?php echo $obj['grade_name'] ?></span>
                                  </div>
                                </div>
                                <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('lot_no') ?> : </label>
                                    <span > <?php echo $obj['lot_no']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('batch_no') ?>: </label>
                                    <span > <?php echo $obj['batch_no'] ?></span>
                                  </div>
                                </div>
                           <?php } else{ ?>
                                 <div class="row col-md-12" >
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('equipment_name') ?> : </label>
                                    <span > <?php echo $obj['equipment_name']?></span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('purpose') ?>: </label>
                                    <span > <?php echo $obj['purpose'] ?></span>
                                  </div>
                                </div>
                           <?php } ?>

                           
                            <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> <?= $this->lang->line('comment') ?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['comment']; 
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
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p><?= $this->lang->line('confirm_delete') ?> <?= $this->lang->line('requisition_slip') ?> <b><?php echo $obj['requisition_slip_no'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('no') ?> </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
            <?php  $i++;} } ?>
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