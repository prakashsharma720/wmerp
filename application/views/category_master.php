
<div class="nxl-content ">
  <!-- Page Header -->
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('lead_services_master') ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
      </ul>
    </div>
    <div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- Form & Table Section -->
  <div class="card-body pt-4 px-4">
    <div class="row">
      <!-- Form Section -->
      <div class="col-md-6">
        <?php if (!empty($id)): ?>
          <form class="form-horizontal" method="post" action="<?= base_url("index.php/Category/editCategory/$id") ?>">
            <input type="hidden" name="category_id" value="<?= $id ?>">
        <?php else: ?>
          <form class="form-horizontal" method="post" action="<?= base_url("index.php/Category/add_new_category") ?>">
        <?php endif; ?>

          <div class="form-group">
            <label class="control-label"><?= $this->lang->line('service_name') ?></label>
            <input type="text" name="category_name" class="form-control"
                   placeholder="<?= $this->lang->line('enter_service_name') ?>"
                   value="<?= $category_name ?>" required autofocus>
          </div>

          <?php if (!empty($id)): ?>
            <div class="form-group">
              <label class="control-label"><?= $this->lang->line('status') ?></label>
              <select class="form-control" name="flag">
                <option value="0"><?= $this->lang->line('active') ?></option>
                <option value="1"><?= $this->lang->line('de_active') ?></option>
              </select>
            </div>
          <?php endif; ?>

          <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary btn-block">
              <?= $this->lang->line('save') ?>
            </button>
          </div>
        </form>
      </div>

      <!-- Table Section -->
      <div class="col-md-6">
        <h5><?= $this->lang->line('services_list') ?></h5>
        <table id="example" class="table table-bordered table-striped w-100">
          <thead>
            <tr>
              <th><?= $this->lang->line('sr_no') ?></th>
              <th><?= $this->lang->line('services') ?></th>
              <th><?= $this->lang->line('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($categories as $category): ?>
              <tr>
                <td><?= $i++ ?></td>
                <td><?= $category['category_name'] ?></td>
                <td>
                 <a href="<?= base_url("index.php/Category/index/" . $category['id']) ?>" class="border rounded bg-light shadow-sm text-dark px-1 py-0" style="padding: 2px 3px;">
  <i class="feather feather-edit-3"></i>
</a>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>













