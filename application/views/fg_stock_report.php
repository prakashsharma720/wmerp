<?php
defined('BASEPATH') or exit('No direct script access allowed');
$base_url =  base_url();
$current_page = current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data = explode('?', $current_page);
//print_r($base_url);exit;
?>
<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('fg_stock_report') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>

      </ul>
    </div>
    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse" data-bs-target="#filterFormWrapper" title="Filter">
        <i class="feather-filter"></i>
      </a>



    </div>
  </div>


  <!-- ✅ Collapsible Filter Form -->
  <div class="collapse bg-white" id="filterFormWrapper" style="position: relative; left:35px; right:35px;width:1553px;border-radius: 10px; top:20px ">
    <form method="get" id="filterForm" class="mb-3 border p-3 rounded ">
      <form method="post" id="filterForm">
        <div class="row">

          <div class="col-md-4 col-sm-4 ">
            <label class="control-label"><?= $this->lang->line('material_name') ?> </label>
            <select name="finish_good_id" class="form-control select2 suppliers">
              <option value=""> <?= $this->lang->line('select_material') ?> </option>
              <?php
              if ($items): ?>
                <?php
                foreach ($items as $value) : ?>
                  <?php
                  if ($value['id'] == $conditions['finish_good_id']): ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['grade_name'] . ' (' . $value['fg_code'] . ')' ?></option>
                  <?php else: ?>
                    <option value="<?= $value['id'] ?>"><?= $value['grade_name'] . ' (' . $value['fg_code'] . ')' ?></option>
                  <?php endif;   ?>
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?> </option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-4 col-sm-4 ">
            <label class="control-label"><?= $this->lang->line('status') ?> <span class="required">*</span></label>
            <select name="status" class="form-control select2 ">
              <option value=""><?= $this->lang->line('select_status') ?> </option>
              <?php
              if ($status): ?>
                <?php
                foreach ($status as $value) : ?>
                  <?php
                  if ($value == $$conditions['status']): ?>
                    <option value="<?= $value ?>" selected><?= $value ?></option>
                  <?php else: ?>
                    <option value="<?= $value ?>"><?= $value ?></option>
                  <?php endif;   ?>
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?> </option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-4 col-sm-4 ">
            <label class="control-label"> <?= $this->lang->line('select_department') ?> </label>
            <select name="department_id" class="form-control select2 ">
              <option value=""><?= $this->lang->line('select_department') ?> </option>
              <?php
              if ($departments): ?>
                <?php
                foreach ($departments as $value) : ?>
                  <?php
                  if ($value['id'] == $conditions['department_id']): ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['department_name'] ?></option>
                  <?php else: ?>
                    <option value="<?= $value['id'] ?>"><?= $value['department_name'] ?></option>
                  <?php endif;   ?>
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?> </option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-4 col-sm-4 ">
            <label class="control-label"> <?= $this->lang->line('select_employee') ?> </label>
            <select name="employee_id" class="form-control select2 ">
              <option value=""><?= $this->lang->line('select_employee') ?> </option>
              <?php
              if ($employees): ?>
                <?php
                foreach ($employees as $value) : ?>
                  <?php
                  $voucher_no = $value['employee_code'];
                  if ($voucher_no < 10) {
                    $employee_code = 'EMP000' . $voucher_no;
                  } else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
                    $employee_code = 'EMP00' . $voucher_no;
                  } else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
                    $employee_code = 'EMP0' . $voucher_no;
                  } else {
                    $employee_code = 'EMP' . $voucher_no;
                  }

                  if ($value['id'] == $conditions['employee_id']): ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['name'] . ' (' . $value['employee_code'] . ')' ?></option>
                  <?php else: ?>
                    <option value="<?= $value['id'] ?>"><?= $value['name'] . ' (' . $employee_code . ')' ?></option>
                  <?php endif;   ?>
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?> </option>
              <?php endif; ?>
            </select>
          </div>
          <div class="col-md-4 col-sm-4">
            <label class="control-label"> <?= $this->lang->line('from_date') ?> </label>
            <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
          </div>
          <div class="col-md-4 col-sm-4">
            <label class="control-label"> <?= $this->lang->line('upto_date') ?> </label>
            <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-4 "></div>
          <div class="col-md-4 col-sm-4 ">
            <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?> </label><br>
            <input type="submit" class="btn btn-primary" value="<?= $this->lang->line('search') ?>" />
            <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
            <a href="<?php echo $data[0] ?>" class="btn btn-danger" style="position:relative;width:80px;left:85px;bottom:38px"> <?= $this->lang->line('reset') ?> </a>
          </div>
        </div>
      </form>
  </div>
  <?php
  if (!empty($FGStockReport)) { ?>
    <div class="main-content ">
      <div class="card card-primary card-outline">
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped" id="proposalList">
                  <thead>
                    <tr>
                      <th><?= $this->lang->line('sr_no') ?> .</th>
                      <!-- <th style="white-space: nowrap;"> Material Category  </th> -->
                      <!-- <th style="white-space: nowrap;">  Reference </th> -->
                      <th style="white-space: nowrap;"> <?= $this->lang->line('date_of_production') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('grade_name') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('register_no') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('lot_no') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('batch_no') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('no_of_bags') ?> (Size) </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('production_in_mt') ?> </th>
                      <!-- <th style="white-space: nowrap;">  Balance </th> -->
                      <th style="white-space: nowrap;"> <?= $this->lang->line('status') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('employee') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('department') ?> </th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $i = 1;
                    $total_production = '0';
                    foreach ($FGStockReport as $obj) { ?>
                      <tr>
                        <td><?= $i ?></td>
                        <td><?= date('d-M-Y', strtotime($obj['transaction_date'])) ?></td>
                        <td><?= $obj['grade_name'] ?></td>
                        <td>
                          <?php
                          //if($obj['opening_stock']!='Yes'){
                          if ($obj['production_register_id'] != '0') { ?>
                            <?php echo 'PR-' . $obj['production_register_id']; ?>
                          <?php } else { ?>
                            <a href="<?php echo base_url(); ?>index.php/Invoice/print_invoice/<?php echo $obj['invoice_id']; ?>">
                              <?php echo 'INV-' . $obj['invoice_id']; ?>
                            </a>
                          <?php } ?>

                        </td>
                        <td><?= $obj['lot_no'] ?></td>
                        <td><?= $obj['batch_no'] ?></td>
                        <td><?= $obj['no_of_bags'] . ' (' . $obj['packing_size'] . ' Kg)' ?></td>
                        <td><?= $obj['production_in_mt'] ?></td>
                        <!-- <td><?= $obj['total_in']['total'] - $obj['total_out']['total'] ?></td> -->
                        <td><?= $obj['status'] ?></td>
                        <td><?= $obj['employee'] ?></td>
                        <td><?= $obj['department'] ?></td>
                      </tr>
                    <?php $i++;
                    }  ?>
                  </tbody>
                </table>
              </div>
            <?php } ?>
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