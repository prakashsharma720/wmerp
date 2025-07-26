<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
    <?= $this->session->flashdata('success'); ?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">×</button>
    <h5><i class="icon fa fa-times"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?= $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>

<div class="nxl-content">
  <div class="page-header mb-3 d-flex justify-content-between align-items-center">

    <!-- Left Side: Title and Breadcrumb -->
    <div>
      <h5><?= $this->lang->line('requisition_slip_report') ?></h5>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
      </ul>
    </div>

    <!-- Right Side: Filter & Export Buttons -->
    <div class="d-flex gap-2">
      <!-- Filter Button -->
      <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#filterFormWrapper">
        <i class="fa fa-filter"></i> <?= $this->lang->line('filter') ?>
      </button>

      <!-- Export Form -->
      <form method="post" action="<?= base_url('index.php/Requisition_slips/createXLS') ?>">
        <?php if (!empty($conditions)): foreach ($conditions as $key => $value): ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php endforeach; endif; ?>
        <button type="submit" class="btn btn-info"><?= $this->lang->line('export') ?></button>
      </form>
    </div>

  </div>
</div>

<!-- Collapsible Filter Form -->
<div class="collapse <?php if (!empty($_GET)) echo 'show'; ?>" id="filterFormWrapper">
  <div class="card card-body border ">
    <form method="get" id="filterForm">
      <div class="row">
        <!-- Employee Filter -->
        <div class="col-md-4">
          <label><?= $this->lang->line('name_of_employee'); ?></label>
          <select name="employee_id" class="form-control select2 employees">
            <option value="0"><?= $this->lang->line('select_employee'); ?></option>
            <?php foreach ($employees ?? [] as $value): ?>
              <option value="<?= $value['id'] ?>" <?= set_select('employee_id', $value['id'], @$_GET['employee_id'] == $value['id']) ?>>
                <?= $value['name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Department Filter -->
        <div class="col-md-4">
          <label><?= $this->lang->line('name_of_department'); ?></label>
          <select name="department_id" class="form-control select2">
            <option value="0"><?= $this->lang->line('select_department'); ?></option>
            <?php foreach ($departments ?? [] as $value): ?>
              <option value="<?= $value['id'] ?>" <?= set_select('department_id', $value['id'], @$_GET['department_id'] == $value['id']) ?>>
                <?= $value['department_name'] ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Status Filter -->
        <div class="col-md-4">
          <label><?= $this->lang->line('requisition_status'); ?></label>
          <select name="approved_status" class="form-control select2">
            <option value=""><?= $this->lang->line('select_status'); ?></option>
            <?php foreach ($req_status ?? [] as $status): ?>
              <option value="<?= $status ?>" <?= set_select('approved_status', $status, @$_GET['approved_status'] == $status) ?>>
                <?= $status ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Date Filters -->
        <div class="col-md-4">
          <label><?= $this->lang->line('from_date'); ?></label>
          <input type="text" name="from_date" class="form-control date-picker" value="<?= @$_GET['from_date'] ?>" placeholder="dd-mm-yyyy" autocomplete="off">
        </div>

        <div class="col-md-4">
          <label><?= $this->lang->line('upto_date'); ?></label>
          <input type="text" name="upto_date" class="form-control date-picker" value="<?= @$_GET['upto_date'] ?>" placeholder="dd-mm-yyyy" autocomplete="off">
        </div>

        <!-- Search / Reset -->
        <div class="col-md-4 d-flex align-items-end gap-2">
          <input type="submit" class="btn btn-primary" value="<?= $this->lang->line('search'); ?>">
          <a href="<?= current_url(); ?>" class="btn btn-danger"><?= $this->lang->line('reset'); ?></a>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Table -->
<div class="card mt-3">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th><?= $this->lang->line('sr_no') ?></th>
            <th><?= $this->lang->line('requisition_no') ?></th>
            <th><?= $this->lang->line('requisition_date') ?></th>
            <th><?= $this->lang->line('request_by') ?></th>
            <th><?= $this->lang->line('status') ?></th>
            <th><?= $this->lang->line('action_date') ?></th>
            <th><?= $this->lang->line('action_by') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1;
          foreach ($requisition_data as $obj): ?>
            <tr>
              <td><?= $i++ ?></td>
              <td>
                <?php
                $num = str_pad($obj['requisition_slip_no'], 4, '0', STR_PAD_LEFT);
                echo 'RS' . $num;
                ?>
              </td>
              <td><?= date('d-M-Y', strtotime($obj['transaction_date'])) ?></td>
              <td><?= $obj['requestor'] ?></td>
              <td><?= $obj['approved_status'] ?></td>
              <td>
                <?php
                if ($obj['approved_status'] == 'Pending') echo 'NA';
                elseif ($obj['approved_status'] == 'Rejected') echo date('d-m-Y', strtotime($obj['rejected_date']));
                elseif ($obj['approved_status'] == 'Approved') echo date('d-m-Y', strtotime($obj['approved_date']));
                ?>
              </td>
              <td>
                <?= ($obj['approved_status'] == 'Approved') ? $obj['approver'] : (($obj['approved_status'] == 'Rejected') ? $obj['rejector'] : 'NA') ?>
              </td>
            </tr>
            <tr>
              <th colspan="2"><?= $this->lang->line('material_name') ?></th>
              <th colspan="5"><?= $this->lang->line('required_qty') ?> (Unit)</th>
            </tr>
            <?php foreach ($obj['requisition_details'] as $detail): ?>
              <tr>
                <td colspan="2"><?= $detail['material_name'] ?> (<?= $detail['material_code'] ?>)</td>
                <td colspan="5"><?= $detail['quantity'] ?> <?= $detail['unit'] ?></td>
              </tr>
            <?php endforeach; ?>
          <?php endforeach; ?>
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
    $('#master').on('click', function() {
      $(".sub_chk").prop('checked', this.checked);
    });

    $('.delete_all').on('click', function() {
      var allVals = $(".sub_chk:checked").map(function() {
        return $(this).val();
      }).get();

      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        if (confirm("Are you sure you want to delete all selected records?")) {
          $.ajax({
            type: "POST",
            url: "<?= base_url('index.php/Requisition_slips/deleteRequisition') ?>",
            data: {
              ids: allVals.join(",")
            },
            success: function(response) {
              location.reload();
            }
          });
        }
      }
    });
  });
</script>