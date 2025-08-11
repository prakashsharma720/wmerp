<div class="offcanvas offcanvas-end" tabindex="-1" id="viewapp<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"> <?= $this->lang->line('pending_requisition_slips_for_purchase_order') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px);">
        <div class="row">

            <!-- Section Heading -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0"><?= $this->lang->line('purchase_order') ?></h2>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('requisition_no') ?>:</label>
                <div><?= !empty($obj['requisition_slip_no']) ? $obj['requisition_slip_no'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('requisition_date') ?>:</label>
                <div><?= !empty($obj['transaction_date']) ? $obj['transaction_date'] : '-' ?></div>
            </div>

            <!-- Section Heading -->
           

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('request_by') ?>:</label>
                <div><?= !empty($obj['requestor']) ? $obj['requestor'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
                <div><?= !empty($obj['approved_status']) ? $obj['approved_status'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
                <div><?= !empty($obj['approved_date']) ? $obj['approved_date'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('action_by') ?>:</label>
                <div><?= !empty($obj['approver']) ? $obj['approver'] : '-' ?></div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>