<div class="nxl-content">
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('finish_goods') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item">
          <?= $this->lang->line('finish_goods_list') ?>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto d-flex align-items-center gap-2">
      <div class="page-header-right-items">
        <?php $this->load->view('layout/alerts'); ?>
      </div>

      <a href="<?= base_url('index.php/Finish_goods/add') ?>" class="btn btn-icon avatar-text avatar-md" style="position:relative;right:40px">
        <i class="feather feather-plus"></i> <?= $this->lang->line('add_new') ?>
      </a>

      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>

</div>


  <!-- Data Table Card -->
  <div class="card shadow-sm p-3 mt-3 ms-2 mb-4 rounded bg-white" style="position: relative; top:15px;left:15px; border-radius:10px">
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped align-middle mb-0 bg-white" id="proposalList">
        <thead class="table-light text-center bg-white">
          <tr style="background-color:white">
            <th><?= $this->lang->line('sr_no') ?></th>
            <th><?= $this->lang->line('mineral_name') ?></th>
            <th><?= $this->lang->line('grade_name') ?></th>
            <th><?= $this->lang->line('packing_type') ?></th>
            <th><?= $this->lang->line('packing') ?></th>
            <th><?= $this->lang->line('action') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 1; foreach ($items as $obj) { ?>
            <tr>
              <td><?= $i++ ?></td>
              <td><?= $obj['mineral_name'] . ' (' . $obj['hsn_code'] . ')' ?></td>
              <?php 
                $voucher_no = $obj['fg_code'];
                if ($voucher_no < 10) {
                  $fg_code = 'FG000' . $voucher_no;
                } else if ($voucher_no <= 99) {
                  $fg_code = 'FG00' . $voucher_no;
                } else if ($voucher_no <= 999) {
                  $fg_code = 'FG0' . $voucher_no;
                } else {
                  $fg_code = 'FG' . $voucher_no;
                }
              ?>
              <td><?= $obj['grade_name'] . ' (' . $fg_code . ')' ?></td>
              <td><?= $obj['packing_type'] ?></td>
              <td><?= $obj['packing_size'] ?></td>
              <td>
                <div class="d-flex gap-1 justify-content-center">
                  <a class="btn btn-icon avatar-text avatar-md" href="<?= base_url('index.php/Finish_goods/edit/' . $obj['id']); ?>">
                    <i class="feather feather-edit-3"></i>
                  </a>
                  <a class="btn btn-icon avatar-text avatar-md" href="javascript:void(0);" onclick="deleteFG(<?= $obj['id'] ?>)">
                    <i class="feather feather-trash me-1"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="<?= base_url("assets/plugins/jquery/jquery.min.js") ?>"></script>

<script>
  function deleteFG(id) {
    if (confirm("Are you sure you want to delete this?")) {
      window.location.href = "<?= base_url('index.php/finish_goods/deleteFG/') ?>" + id;
    }
  }
</script>