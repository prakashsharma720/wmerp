<!-- Success & Failure Flash Messages -->
<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h5><i class="fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
    <?= $this->session->flashdata('success'); ?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h5><i class="fa fa-times"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?= $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>

<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5><?= $this->lang->line('invoice_slip_report') ?></h5>
      </div>
      <ul class="breadcrumb ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto">
      <div class="page-header-right-items d-flex align-items-center">

        <!-- Filter Button (no background, toggle enabled) -->
        <button id="filterToggleBtn" class="btn btn-warning me-2" type="button">
          <i class="fa fa-filter"></i> <?= $this->lang->line('filter') ?>
        </button>

        <!-- EXPORT FORM -->
        <form method="post" action="<?= base_url('index.php/Invoice/createXLS') ?>">
          <?php 
            if (!empty($conditions)) {
              foreach ($conditions as $key => $value) {
                echo '<input type="hidden" name="'.$key.'" value="'.$value.'">';
              }
            }
          ?>
          <button type="submit" class="btn btn-info"><?= $this->lang->line('export') ?></button>
        </form>
      </div>
    </div>
  </div>

  <!-- COLLAPSIBLE FILTER FORM -->
  <div class="collapse mt-3" id="filterFormWrapper">
    <div class="card card-body">
      <form method="get" id="filterForm">
        <div class="row">
          <div class="col-md-4">
            <label><?= $this->lang->line('from_date') ?></label>
            <input type="text" name="from_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
          </div>
          <div class="col-md-4">
            <label><?= $this->lang->line('upto_date') ?></label>
            <input type="text" name="upto_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-4 d-flex align-items-center gap-2">
            <input type="submit" class="btn btn-sm btn-primary" value="<?= $this->lang->line('search') ?>" />
            <a href="<?= current_url() ?>" class="btn btn-sm btn-danger"><?= $this->lang->line('reset') ?></a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- INVOICE TABLE -->
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th><?= $this->lang->line('sr_no') ?>.</th>
                <th><?= $this->lang->line('invoice_no') ?></th>
                <th><?= $this->lang->line('invoice_date') ?></th>
                <th><?= $this->lang->line('vendor_code') ?></th>
                <th><?= $this->lang->line('grand_total') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($invoice_data as $obj): ?>
                <tr>
                  <td><?= $i ?></td>
                  <td>
                    <?php
                      $inv_number = $obj['invoice_no'];
                      $inv_number1 = 'CNC/A/' . str_pad($inv_number, 4, '0', STR_PAD_LEFT);
                      echo $inv_number1;
                    ?>
                  </td>
                  <td><?= date('d-M-Y', strtotime($obj['transaction_date'])) ?></td>
                  <td><?= $obj['vendor_code'] ?></td>
                  <td><?= number_format($obj['grand_total'], 2) ?></td>
                </tr>
              <?php $i++; endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS Scripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    // Toggle filter section on button click (manual control)
    $('#filterToggleBtn').on('click', function () {
      $('#filterFormWrapper').collapse('toggle');
    });

    // Checkbox & delete logic (your original code)
    $('#master').click(function () {
      $(".sub_chk").prop('checked', $(this).is(':checked'));
    });

    $('.delete_all').click(function () {
      var allVals = $(".sub_chk:checked").map(function () {
        return $(this).val();
      }).get();

      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        if (confirm("Are you sure you want to delete all selected records?")) {
          $.post("<?= base_url('index.php/Invoice/deleteInvoice') ?>", { ids: allVals.join(",") }, function (response) {
            $(".successs_mesg").html(response);
            location.reload();
          });
        }
      }
    });
  });
</script>
