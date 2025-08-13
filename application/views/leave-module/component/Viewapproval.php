<div class="offcanvas offcanvas-end" tabindex="-1" id="Viewapproval<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"> <?= $this->lang->line('requisition_slips') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px);">
        <div class="row">

            <!-- Section Heading -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0"><?= $this->lang->line('details') ?></h2>
                </div>
            </div>

            <!-- Requisition No -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('requisition_no') ?>:</label>
      <div><?= 'RS' . str_pad($obj['requisition_slip_no'], 4, '0', STR_PAD_LEFT); ?></div>
    </div>

    <!-- Requisition Date -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('requisition_date') ?>:</label>
      <div><?= !empty($obj['transaction_date']) ? date('d-M-Y', strtotime($obj['transaction_date'])) : '-'; ?></div>
    </div>

    <!-- Requisition By -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('requisition_by') ?>:</label>
      <div><?= !empty($obj['requestor']) ? $obj['requestor'] : '-'; ?></div>
    </div>

    <!-- Status -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
      <div><?= !empty($obj['approved_status']) ? $obj['approved_status'] : '-'; ?></div>
    </div>

    <!-- Store Action Date -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
      <div>
        <?php
        if ($obj['approved_status'] == 'Approved') {
          echo date('d-m-Y', strtotime($obj['approved_date']));
        } elseif ($obj['approved_status'] == 'Rejected') {
          echo date('d-m-Y', strtotime($obj['rejected_date']));
        } else {
          echo 'NA';
        }
        ?>
      </div>
    </div>

    <!-- Store Approved / Rejected By -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('name') ?>:</label>
      <div>
        <?php
        if ($obj['approved_status'] == 'Approved') {
          echo $obj['approver'];
        } elseif ($obj['approved_status'] == 'Rejected') {
          echo $obj['rejector'];
        } else {
          echo 'NA';
        }
        ?>
      </div>
    </div>

    <!-- Admin Approval -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('admin_approval') ?>:</label>
      <div><?= !empty($obj['admin_approve_status']) ? $obj['admin_approve_status'] : 'Pending'; ?></div>
    </div>

    <!-- Admin Action Date -->
    <div class="col-lg-6 mb-3">
      <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
      <div>
        <?= ($obj['admin_approve_status'] != 'Pending') ? date('d-m-Y', strtotime($obj['admin_action_date'])) : 'NA'; ?>
      </div>
    </div>


            

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>
