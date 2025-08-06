

<!-- Page Header -->
<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('purchase_order_list') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('add') ?></li>
      </ul>
    </div>

<!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
     <a href="<?= base_url(); ?>index.php/Purchase_order/add"
              class="btn btn-icon avatar-text avatar-md"
              data-bs-toggle="tooltip"
              title="New PO"
              style="margin-left:5px;">
              <i class="fa fa-plus"></i>
            </a>
<button class="btn btn-icon avatar-text avatar-md"
              style="margin-left:5px;"
              data-bs-toggle="tooltip"
              title="Refresh"
              onclick="location.reload();">
              <i class="fa fa-refresh"></i>
            </button>

            <button class="btn btn-icon avatar-text avatar-md delete_all"
              style="margin-left:5px;"
              data-bs-toggle="tooltip"
              title="Bulk Delete">
              <i class="fa fa-trash"></i>
            </button>

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
                    <th><?= $this->lang->line('sr_no') ?> </th>
                    <th style="white-space: nowrap;"> <?= $this->lang->line('order_type') ?> </th>
                    <th> <?= $this->lang->line('po_no') ?> </th>
                    <th style="white-space: nowrap;"> <?= $this->lang->line('supplier_name') ?> </th>
                    <th style="white-space: nowrap;"> <?= $this->lang->line('date') ?> </th>
                    <th style="white-space: nowrap;"><?= $this->lang->line('total_amount') ?> </th>
                    <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button') ?> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  foreach ($po_data as $obj) { ?>
                    <tr>
                      <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                      <td><?php echo $i; ?></td>
                      <td><?php if ($obj['purchase_indent'] == '1') {
                            echo 'Purchase Indent';
                          } else {
                            echo 'Purchase Order';
                          }
                          ?>
                      </td>
                      <td>
                        <?php
                        $inv_number = $obj['po_number'];
                        if ($inv_number < 10) {
                          $inv_number1 = 'CNC/A/000' . $inv_number;
                        } else if (($inv_number >= 10) && ($inv_number <= 99)) {
                          $inv_number1 = 'CNC/A/00' . $inv_number;
                        } else if (($inv_number >= 100) && ($inv_number <= 999)) {
                          $inv_number1 = 'CNC/A/0' . $inv_number;
                        } else {
                          $inv_number1 = 'CNC/A/' . $inv_number;
                        }
                        echo $inv_number1; ?>
                      </td>
                      <td><?php echo $obj['supplier']; ?></td>
                      <td><?php echo date('d-M-Y', strtotime($obj['transaction_date'])); ?></td>
                      <td><?php echo $obj['grand_total']; ?> &#8377;</td>
                      <td>
                        <div class="d-flex gap-2">
                          <!-- View Button (Outside Dropdown) -->
                          <a class="btn btn-icon avatar-text avatar-md"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#ViewPO<?= $obj['id']; ?>"
                            title="View More">
                            <i class="feather feather-eye"></i>
                          </a>

                          <!-- Dropdown Menu for Print, Edit, Delete -->
                          <div class="dropdown">
                            <a href="javascript:void(0)"
                              class="btn btn-icon avatar-text avatar-md"
                              data-bs-toggle="dropdown"
                              aria-expanded="false">
                              <i class="feather feather-more-horizontal"></i>
                            </a>
                            <ul class="dropdown-menu">
                              <li>
                                <a class="dropdown-item"
                                  href="<?= base_url('index.php/Purchase_order/print/' . $obj['id']); ?>">
                                  <i class="fa fa-print me-2"></i> <?= $this->lang->line('print') ?>
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item"
                                  href="<?= base_url('index.php/Purchase_order/edit/' . $obj['id']); ?>">
                                  <i class="feather feather-edit-3 me-2"></i> <?= $this->lang->line('edit') ?>
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item "
                                  href="javascript:void(0);"
                                  onclick="deletePO(<?= $obj['id'] ?>)">
                                  <i class="feather feather-trash me-2"></i> <?= $this->lang->line('delete') ?>
                                </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </td>



                      <?php $this->load->view('leave-module/component/po.php', ['obj' => $obj]); ?>




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
      <script>
        function deletePO(id) {
          if (confirm("Are you sure you want to delete this ?")) {
            window.location.href = "<?= base_url('index.php/purchase_order/deletePO/') ?>" + id;
          }
        }
      </script>
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
              WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
              var check = confirm(WRN_PROFILE_DELETE);
              if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url(); ?>index.php/Purchase_order/deletePO",
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