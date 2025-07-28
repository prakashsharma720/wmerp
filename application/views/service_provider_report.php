<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
    <?= $this->session->flashdata('success'); ?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h5><i class="icon fa fa-times"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?= $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>

<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('service_provider_report') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Filter Button -->
     <button
  id="toggleFilter"
  class="btn btn-icon avatar-text avatar-md"
  type="button">
  <i class="feather feather-filter"></i> <?= $this->lang->line('filter') ?>
</button>


      <!-- Export Button -->
      <form method="post" action="<?= base_url(); ?>index.php/Service_providers/createXLS" style="margin-left:5px;">
        <?php if (!empty($conditions)) {
          foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php }
        } ?>
        <button type="submit" class="btn btn-info"> <?= $this->lang->line('export') ?> </button>
      </form>
    </div>
  </div>

  <!-- FILTER FORM (initially hidden) -->
  <div class="card card-body" id="filterFormWrapper" style="display: none;">
    <form method="get" id="filterForm">
      <div class="row g-3">
        <!-- Category -->
        <div class="col-md-4">
          <label class="control-label"><?= $this->lang->line('service_provider_category') ?> <span class="required">*</span></label>
          <select name="categories_id" class="form-control select2 category">
            <option value="0"><?= $this->lang->line('select_category') ?></option>
            <?php foreach ($categories as $value): ?>
              <option value="<?= $value['id'] ?>" <?= ($value['id'] == $current[0]->categories_id) ? 'selected' : '' ?>>
                <?= $value['category_name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Service Provider -->
        <div class="col-md-4">
          <label class="control-label"><?= $this->lang->line('name_of_service_provider') ?> <span class="required">*</span></label>
          <select name="service_provider_id" class="form-control select2 suppliers">
            <option value="0"><?= $this->lang->line('select_service_provider') ?></option>
            <?php foreach ($all_sps as $value): ?>
              <option value="<?= $value['id'] ?>" <?= ($value['id'] == $service_provider_id) ? 'selected' : '' ?>>
                <?= $value['service_provider_name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Approval Category -->
        <div class="col-md-4">
          <label class="control-label"><?= $this->lang->line('category_of_approval') ?></label>
          <?php
          $app_cat = array('No' => 'Select Option', 'A' => 'A', 'B' => 'B', 'C' => 'C');
          echo form_dropdown('category_of_approval', $app_cat, '', 'class="form-control"');
          ?>
        </div>
      </div>

      <div class="row g-3 mt-1">
        <div class="col-md-4">
          <label class="control-label"><?= $this->lang->line('from_date') ?></label>
          <input type="text" name="from_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
        </div>
        <div class="col-md-4">
          <label class="control-label"><?= $this->lang->line('upto_date') ?></label>
          <input type="text" name="upto_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
        </div>
        <div class="col-md-4 d-flex align-items-end gap-2">
          <input type="submit" class="btn btn-primary" value="<?= $this->lang->line('search') ?>" />
          <a href="<?= current_url() ?>" class="btn btn-danger"><?= $this->lang->line('reset') ?></a>
        </div>
      </div>
    </form>
  </div>

  <!-- TABLE SECTION -->
  <div class="container-fluid mt-3">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th><?= $this->lang->line('name') ?></th>
                <th><?= $this->lang->line('registration_date') ?></th>
                <th><?= $this->lang->line('contact_person') ?></th>
                <th><?= $this->lang->line('email') ?></th>
                <th><?= $this->lang->line('mobile_no') ?></th>
                <th><?= $this->lang->line('website') ?></th>
                <th><?= $this->lang->line('category') ?></th>
                <th><?= $this->lang->line('approval_category') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($service_providers as $obj): ?>
                <tr>
                  <td><?= $obj['service_provider_name'] . ' (' . $obj['service_provider_code'] . ')' ?></td>
                  <td><?= date('d-M-Y', strtotime($obj['reg_date'])) ?></td>
                  <td><?= $obj['contact_person'] ?></td>
                  <td><?= $obj['email'] ?></td>
                  <td><?= $obj['mobile_no'] ?></td>
                  <td><?= $obj['website'] ?></td>
                  <td><?= $obj['category'] ?></td>
                  <td><?= $obj['category_of_approval'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    // Toggle filter section
    $('#toggleFilter').click(function () {
      $('#filterFormWrapper').slideToggle();
    });

    // Category -> Service Provider AJAX load
    $('.category').change(function () {
      let category_id = $(this).val();
      $.ajax({
        url: "<?= base_url('index.php/Suppliers/getSupplierByCategory/') ?>" + category_id,
        method: "POST",
        dataType: "html",
        success: function (response) {
          $('.suppliers').html(response);
          $('.select2').select2();
        }
      });
    });
  });
</script>
