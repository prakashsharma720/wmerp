

<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('customer_report') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Filter Button -->
        <?php $this->load->view('layout/alerts'); ?>
      <button id="toggleFilter" class="btn btn-icon avatar-text avatar-md" type="button">
  <i class="feather feather-filter"></i> <?= $this->lang->line('filter') ?>
</button>


      <!-- Export Button -->
      <form method="post" action="<?php echo base_url(); ?>index.php/Customers/createXLS" style="margin-left:5px;">
        <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
              <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
        <?php } } ?>
        <button type="submit" class="btn btn-info"> <?= $this->lang->line('export') ?> </button>
      </form>
    </div>
  </div>
</div>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page = current_url();
$data = explode('?', $current_page);
?>

<style>
  .col-sm-6, .col-md-6 {
    float: left;
  }
</style>

<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-body">

      <!-- Filter Form Wrapper (initially hidden) -->
      <div id="filterFormWrapper" style="display: none;">
        <form method="get" id="filterForm">
          <div class="row">
            <div class="col-md-4 col-sm-4">
              <label class="control-label"><?= $this->lang->line('name_of_customer') ?> <span class="required">*</span></label>
              <select name="customer_id" class="form-control select2 suppliers">
                <option value="0"><?= $this->lang->line('select_customer') ?></option>
                <?php if ($all_customers): ?>
                  <?php foreach ($all_customers as $value): ?>
                    <option value="<?= $value['id'] ?>" <?= ($value['id'] == $customer_id) ? 'selected' : '' ?>>
                      <?= $value['customer_name'] ?>
                    </option>
                  <?php endforeach; ?>
                <?php else: ?>
                  <option value="0"><?= $this->lang->line('no_result') ?></option>
                <?php endif; ?>
              </select>
            </div>

            <div class="col-md-4 col-sm-4">
              <label class="control-label"><?= $this->lang->line('from_date') ?></label>
              <input type="text" name="from_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
            </div>

            <div class="col-md-4 col-sm-4">
              <label class="control-label"><?= $this->lang->line('upto_date') ?></label>
              <input type="text" name="upto_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 col-sm-4 d-flex align-items-end gap-2 p-3">
              <input type="submit" class="btn btn-sm btn-primary" value="<?= $this->lang->line('search') ?>" />
              <a href="<?= $data[0] ?>" class="btn btn-sm btn-danger"><?= $this->lang->line('reset') ?></a>
            </div>
          </div>
        </form>
        <hr>
      </div>

      <!-- Customer Table -->
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><?= $this->lang->line('name') ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('registration_date') ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('contact_person') ?></th>
              <th><?= $this->lang->line('email') ?></th>
              <th><?= $this->lang->line('mobile_no') ?></th>
              <th><?= $this->lang->line('website') ?></th>
              <th><?= $this->lang->line('shipping_address') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($customers as $obj): ?>
              <tr>
                <td><?= $obj['customer_name'] . ' (' . $obj['customer_code'] . ')' ?></td>
                <td><?= date('d-M-Y', strtotime($obj['reg_date'])) ?></td>
                <td><?= $obj['contact_person'] ?></td>
                <td><?= $obj['email'] ?></td>
                <td><?= $obj['mobile_no'] ?></td>
                <td><?= $obj['website'] ?></td>
                <td><?= $obj['shipping_address'] ?></td>
              </tr>
            <?php $i++; endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Toggle Filter Form
    $('#toggleFilter').click(function () {
      $('#filterFormWrapper').slideToggle();
    });

    // AJAX: Load customer based on category (optional, if you later add it)
    $(document).on('change', '.category', function () {
      var category_id = $(this).val();
      $.ajax({
        type: "POST",
        url: "<?= base_url('index.php/Suppliers/getSupplierByCategory/') ?>" + category_id,
        dataType: 'html',
        success: function (response) {
          $(".suppliers").html(response);
          $('.select2').select2();
        }
      });
    });
  });
</script>
