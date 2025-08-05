<!-- Page Content -->
<div class="nxl-content">
  <!-- Page Header -->
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('rm_code_list') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
          <?php $this->load->view('layout/alerts'); ?>
          <div class="hstack gap-2 justify-content-end">
            <a href="<?= base_url('index.php/rm_code/add'); ?>" class="btn btn-icon btn-light-brand" data-bs-toggle="tooltip" title="New PO">
              <i class="feather feather-plus"></i>
            </a>
            <button class="btn btn-icon btn-light-brand" data-bs-toggle="tooltip" title="Refresh" onclick="location.reload();">
              <i class="fa fa-refresh"></i>
            </button>
            <button class="btn btn-icon btn-light-brand delete_all" data-bs-toggle="tooltip" title="Bulk Delete">
              <i class="feather feather-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Table Section -->
  <div class="container card-white-box " style="position: relative; top:30px">
    <div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded bg-white">
      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped dataTable align-middle" id="proposalList">
          <thead class="table-light">
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th><?= $this->lang->line('dsr_no') ?></th>
              <th><?= $this->lang->line('grid_number') ?></th>
              <th><?= $this->lang->line('supplier_name') ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('raw_material') ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('grade') ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('rm_code') ?></th>
              <th style="white-space: nowrap; width: 20%;"><?= $this->lang->line('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($rmcodes as $obj): ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?= $obj['id']; ?>" /></td>
                <td><?= $i++; ?></td>
                <td><?= $obj['grid_number']; ?></td>
                <td><?= $obj['supplier']; ?></td>
                <td><?= $obj['rm_name']; ?></td>
                <td><?= $obj['grade']; ?></td>
                <td><?= $obj['rm_code']; ?></td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <!-- Edit -->
                    <a href="<?= base_url('index.php/Rm_code/edit/' . $obj['id']); ?>"
                      class="btn btn-icon avatar-text avatar-md" data-bs-toggle="tooltip" title="Edit">
                      <i class="feather feather-edit-3"></i>
                    </a>

                    <!-- Delete -->
                    <a href="javascript:void(0);" onclick="deletermcode(<?= $obj['id'] ?>)"
                      class="btn btn-icon avatar-text avatar-md" data-bs-toggle="tooltip" title="Delete">
                      <i class="fa fa-trash"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript: jQuery -->
<script src="<?= base_url("assets/plugins/jquery/jquery.min.js"); ?>"></script>

<!-- JavaScript: Delete Single RM Code -->
<script>
  function deletermcode(id) {
    if (confirm("Are you sure you want to delete this RM Code?")) {
      window.location.href = "<?= base_url('index.php/Rm_code/deleteRM/') ?>" + id;
    }
  }
</script>

<!-- JavaScript: Master Checkbox & Bulk Delete -->
<script>
  $(document).ready(function () {
    // Select all checkboxes
    $('#master').on('click', function () {
      $(".sub_chk").prop('checked', $(this).is(':checked'));
    });

    // Bulk delete
    $('.delete_all').on('click', function () {
      var allVals = $(".sub_chk:checked").map(function () {
        return $(this).val();
      }).get();

      if (allVals.length <= 0) {
        alert("Please select at least one row.");
      } else {
        if (confirm("Are you sure you want to delete selected records?")) {
          $.ajax({
            type: "POST",
            url: "<?= base_url('index.php/Rm_code/deleteRM'); ?>",
            data: { ids: allVals.join(",") },
            success: function (response) {
              $(".successs_mesg").html(response);
              location.reload();
            }
          });
        }
      }
    });
  });
</script>
