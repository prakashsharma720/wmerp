<!-- Page Header -->
<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('suppliers_report') ?></h5>

      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('report') ?></li>
      </ul>
    </div>

    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      <form method="post" action="<?= base_url('index.php/Suppliers/createXLS'); ?>" style="margin-left:5px; display:flex">
        <!-- Filter Button -->
        <button class="btn btn-icon btn-light-brand" type="button"
          data-bs-toggle="collapse" data-bs-target="#filterFormWrapper"
          aria-expanded="false" aria-controls="filterFormWrapper">
          <i class="feather feather-filter"></i> <?= $this->lang->line('filter') ?>
        </button>

        <!-- Export Button -->

        <?php if (!empty($conditions)) {
          foreach ($conditions as $key => $value): ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php endforeach;
        } ?>
        <!-- <button type="submit" class="btn btn-info"><?= $this->lang->line('export') ?></button> -->
        <button type="submit" class="btn btn-icon btn-light-brand">
          <i class="feather feather-download "></i>
        </button>
      </form>
      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>





  <?php
  defined('BASEPATH') or exit('No direct script access allowed');
  $current_page = current_url();
  $data = explode('?', $current_page);
  ?>


  <!-- Filter Form Collapse -->
  <div class="collapse" id="filterFormWrapper">
    <form method="get" id="filterForm">
      <div class="row">
        <div class="col-md-4 col-sm-4 ">
          <label class="control-label"><?= $this->lang->line('supplier_category') ?> <span class="required">*</span></label>
          <select name="categories_id" class="form-control select2 category">
            <option value="0"><?= $this->lang->line('select_category') ?></option>
            <?php
            if ($categories): ?>
              <?php
              foreach ($categories as $value) : ?>
                <?php
                if ($value['id'] == $current[0]->categories_id): ?>
                  <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
                <?php else: ?>
                  <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
                <?php endif;   ?>
              <?php endforeach;  ?>
            <?php else: ?>
              <option value="0"><?= $this->lang->line('no_result') ?></option>
            <?php endif; ?>
          </select>
        </div>
        <div class="col-md-4 col-sm-4 ">
          <label class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
          <select name="supplier_id" class="form-control select2 suppliers">
            <option value="0"><?= $this->lang->line('select_supplier') ?></option>
            <?php
            if ($all_suppliers): ?>
              <?php
              foreach ($all_suppliers as $value) : ?>
                <?php
                if ($value['id'] == $supplier_id): ?>
                  <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] ?></option>
                <?php else: ?>
                  <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
                <?php endif;   ?>
              <?php endforeach;  ?>
            <?php else: ?>
              <option value="0"><?= $this->lang->line('no_result') ?></option>
            <?php endif; ?>
          </select>
        </div>
        <div class="col-md-4 col-sm-4">
          <label class="control-label"> <?= $this->lang->line('category_of_approval') ?></label>
          <?php $app_cat = array(
            'No' => 'Select Option',
            'A' => 'A',
            'B' => 'B',
            'c' => 'C'
          );
          echo form_dropdown('category_of_approval', $app_cat)
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-sm-4">
          <label class="control-label"> <?= $this->lang->line('from_date') ?></label>
          <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
        </div>
        <div class="col-md-4 col-sm-4">
          <label class="control-label"> <?= $this->lang->line('upto_date') ?></label>
          <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
        </div>

        <div class="col-md-4 col-sm-4 d-flex align-items-end gap-2">
          <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label><br>
          <input type="submit" class="btn btn-primary" value="Search" />
          <a href="<?= $data[0] ?>" class="btn btn-danger "><?= $this->lang->line('reset') ?></a>
        </div>
      </div>

    </form>
  </div>

  <!-- Main Content -->
  <div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
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
                  <?php foreach ($suppliers as $obj): ?>
                    <tr>
                      <td><?= $obj['supplier_name'] . ' (' . $obj['vendor_code'] . ')' ?></td>
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

    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script>
      $(document).ready(function() {
        $('.category').on('change', function() {
          var category_id = $(this).val();
          $.ajax({
            type: "POST",
            url: "<?= base_url('index.php/Suppliers/getSupplierByCategory/') ?>" + category_id,
            dataType: 'html',
            success: function(response) {
              $(".suppliers").html(response);
              $('.select2').select2();
            }
          });
        });
      });
    </script>