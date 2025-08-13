<?php
defined('BASEPATH') or exit('No direct script access allowed');
//print_r($requisition_data);exit;

?>

<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('pending_requisition_slips_for_action') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('') ?></li>
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
              <th><?= $this->lang->line('sr_no'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('requisition_no'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('requisition_date'); ?></th>
              <!-- <th style="white-space: nowrap;">कुल मात्रा</th> -->
              <th style="white-space: nowrap;"><?= $this->lang->line('requisition_by'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('status'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('action_date'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('store_approval_by'); ?> <span ><?= $this->lang->line('name'); ?></span></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('admin_approval'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('action_date'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('action_button'); ?></th>

            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($requisition_data as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td>
                  <?php
                  $inv_number = $obj['requisition_slip_no'];
                  if ($inv_number < 10) {
                    $inv_number1 = 'RS000' . $inv_number;
                  } else if (($inv_number >= 10) && ($inv_number <= 99)) {
                    $inv_number1 = 'RS00' . $inv_number;
                  } else if (($inv_number >= 100) && ($inv_number <= 999)) {
                    $inv_number1 = 'RS0' . $inv_number;
                  } else {
                    $inv_number1 = 'RS' . $inv_number;
                  }

                  echo $inv_number1; ?>

                </td>
                <td><?php echo date('d-M-Y', strtotime($obj['transaction_date'])); ?></td>
                <!--  <td><?php echo $obj['total_qty']; ?></td> -->
                <td><?php echo $obj['requestor']; ?></td>
                <td><?php echo $obj['approved_status']; ?></td>
                <td><?php
                    if ($obj['approved_status'] == 'Pending') {
                      echo 'NA';
                    } else if ($obj['approved_status'] == 'Rejected') {
                      echo date('d-m-y', strtotime($obj['rejected_date']));
                    } else if ($obj['approved_status'] == 'Approved') {
                      echo date('d-m-y', strtotime($obj['approved_date']));
                    }
                    ?>
                </td>
                <td>
                  <?php
                  if ($obj['approved_status'] == 'Pending') {
                    echo 'NA';
                  } else if ($obj['approved_status'] == 'Rejected') {
                    echo $obj['rejector'];
                  } else if ($obj['approved_status'] == 'Approved') {
                    echo $obj['approver'];
                  }
                  ?>
                </td>
                <td><?php echo $obj['admin_approve_status']; ?></td>
                <td>
                  <?php
                  if ($obj['admin_approve_status'] == 'Pending') {
                    echo 'NA';
                  } else {
                    echo date('d-m-y', strtotime($obj['admin_action_date']));
                  }
                  ?>
                </td>
                <td style="display:flex;gap:8px;align-items:center">
                  <?php if ($obj['admin_approve_status'] == 'Pending') { ?>
                    <a class="btn btn-icon btn-light-brand"  data-bs-toggle="offcanvas" data-bs-target="#approve<?php echo $obj['id']; ?>"><i  class="fa fa-check"></i></a>
                    <?php if ($obj['admin_approve_status'] == 'Pending') { ?>
                      <a class="btn btn-icon btn-light-brand" href="<?php echo base_url(); ?>index.php/Requisition_slips/edit/<?php echo $obj['id']; ?>"><i class="feather feather-edit-3"></i></a>
                    <?php } ?>
                    <a class="btn btn-icon btn-light-brand" data-bs-toggle="offcanvas" data-bs-target="#reject<?php echo $obj['id']; ?>"><i class="fa fa-window-close"></i></a>
                  <?php } ?>

             
                   <a class="btn btn-icon btn-light-brand" data-bs-toggle="offcanvas" data-bs-target="#Viewapproval<?= $obj['id']; ?>" title="View More">
                            <i class="feather feather-eye"></i>
                          </a>
                </td>

                 <?php $this->load->view('leave-module/component/Viewapproval.php', ['obj' => $obj]); ?>
                 <?php $this->load->view('leave-module/component/approve.php', ['obj' => $obj]); ?>
                 <?php $this->load->view('leave-module/component/reject.php', ['obj' => $obj]); ?>

                <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"> <?= $this->lang->line('requisition_slips'); ?> (<?php echo $inv_number1 ?>) Details </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>
                      <div class="modal-body">
                        <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;">

                          <div class="col-md-1">#</div>
                          <div class="col-md-5"><?= $this->lang->line('item_name'); ?> </div>
                          <div class="col-md-2"><?= $this->lang->line('qty'); ?> </div>
                          <div class="col-md-4"><?= $this->lang->line('description'); ?></div>
                        </div>

                        <?php
                        $j = 1;
                        foreach ($obj['requisition_details'] as $po_detail) { ?>
                          <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                            <div class="col-md-1"><?= $j; ?> </div>
                            <div class="col-md-5"><?= $po_detail['name'] . ' (' . $po_detail['code'] . ')'; ?> </div>
                            <div class="col-md-2"><?= $po_detail['quantity'] . ' ' . $po_detail['unit_name']; ?> </div>
                            <div class="col-md-4"><?= $po_detail['description']; ?> </div>
                          </div>
                        <?php $j++;
                        }  ?>
                      </div>
                      <!--<div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> Total Qty : </label>
                                <span > <?php //echo $obj['total_qty']
                                        ?></span>
                              </div>
                            </div>-->
                      <div class="row col-md-12">
                        <div class="col-md-12">
                          <label class="control-label"> <?= $this->lang->line('requisition_slip_for'); ?>: </label>
                          <span>
                            <?php
                            echo $obj['rs_for'];
                            ?>
                          </span>
                        </div>
                      </div>
                      <?php if (($obj['rs_for'] == 'Raw Material') || ($obj['rs_for'] == 'Packing Material')) {  ?>
                        <div class="row col-md-12">
                          <div class="col-md-6">
                            <label class="control-label"> <?= $this->lang->line('mineral_name'); ?> : </label>
                            <span> <?php echo $obj['mineral_name'] ?></span>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label"> <?= $this->lang->line('grade_name'); ?> : </label>
                            <span> <?php echo $obj['grade_name'] ?></span>
                          </div>
                        </div>
                        <div class="row col-md-12">
                          <div class="col-md-6">
                            <label class="control-label"> <?= $this->lang->line('lot_no'); ?>  : </label>
                            <span> <?php echo $obj['lot_no'] ?></span>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label"> <?= $this->lang->line('batch_no'); ?> : </label>
                            <span> <?php echo $obj['batch_no'] ?></span>
                          </div>
                        </div>
                      <?php } else { ?>
                        <div class="row col-md-12">
                          <div class="col-md-6">
                            <label class="control-label"><?= $this->lang->line('equipment_name'); ?> : </label>
                            <span> <?php echo $obj['equipment_name'] ?></span>
                          </div>
                          <div class="col-md-6">
                            <label class="control-label"> <?= $this->lang->line('purpose'); ?> : </label>
                            <span> <?php echo $obj['purpose'] ?></span>
                          </div>
                        </div>
                      <?php } ?>


                      <div class="row col-md-12">
                        <div class="col-md-12">
                          <label class="control-label"> <?= $this->lang->line('comment'); ?>  : </label>
                          <span>
                            <?php
                            echo $obj['comment'];
                            ?>
                          </span>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close'); ?> </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!--------------  Rejected Requisition Slip Modal Code Start  ------------ -->
                <div class="modal fade" id="reject<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/ActionRequisition">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header" style="background-color:#dc7629;color: azure;">
                          <h4 class="modal-title"><?= $this->lang->line('confirm_header'); ?>  </h4>
                          <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>

                        </div>
                        <div class="modal-body">
                          <p> Are you sure, you want to <b style="color:#dc7629;"><?= $this->lang->line('reject'); ?></b> <?= $this->lang->line('requisition_slips'); ?> <b><?php echo $inv_number1; ?> </b>? </p>
                          <input type="hidden" name="requisition_id" value="<?php echo $obj['id']; ?>">
                          <input type="hidden" name="status" value="Rejected">
                          <input type="hidden" name="rejected_date" value="<?= date('Y-m-d') ?>">
                          <div class="form-group">
                            <div class="row col-md-12">
                              <label class="control-label"> <?= $this->lang->line('reject_reason'); ?> </label>
                              <textarea class="form-control Comment" rows="2" placeholder="<?= $this->lang->line('enter_reason_here'); ?>" name="rejected_reason" required="required"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-danger modal_reject_button" style="background-color: #dc7629;"><?= $this->lang->line('submit'); ?> </button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close'); ?> </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!--------------  Rejected Requisition Slip Modal Code End  ------------------>

                <!-------------- Approved Requisition Slip Modal Code Start  ---------------->
                <div class="modal fade" id="approve<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/ActionRequisition">
                     
                      <div class="modal-content">
                        <div class="modal-header" style="background-color: #168c56;color: azure;">
                          <h4 class="modal-title"><?= $this->lang->line('confirm_header'); ?>  </h4>
                          <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                        </div>
                        <div class="modal-body">
                          <p>   <?= $this->lang->line('are_you_sure_you_want_to') ?>
  <b style="color:#168c56;"><?= $this->lang->line('approve') ?></b>? <?= $this->lang->line('requisition_slip'); ?> <b><?php echo $inv_number1; ?> </b>? </p>
                          <input type="hidden" name="requisition_id" value="<?php echo $obj['id']; ?>">
                          <input type="hidden" name="status" value="Approved">
                          <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                          <div class="form-group">
                            <div class="row col-md-12">
                              <label class="control-label"><?= $this->lang->line('comment'); ?>  </label>
                              <textarea class="form-control Comment" rows="2" placeholder="<?= $this->lang->line('enter_reason_here') ?>" name="approve_comment"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success modal_approve_button" style="background-color: #168c56;"><?= $this->lang->line('submit'); ?></button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close'); ?></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!--------------  Rejected Requisition Slip Modal Code End  ------------ -->

              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    jQuery('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    jQuery('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });
      //alert(allVals.length); return false;  
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition",
            cache: false,
            data: 'ids=' + join_selected_values,
            success: function(response) {
              $(".successs_mesg").html(response);
              location.reload();
            }
          });

        }
      }
    });

  });
</script>