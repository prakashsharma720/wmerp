<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewLeave<?= $obj['id']; ?>">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('leave_details') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="py-3 px-4 d-flex justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div>
            <span class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</span>
            <span class="fs-11 fw-medium text-muted">
                <?php
                switch ($obj['leave_status']) {
                    case 'Pending':
                        echo '<div class="badge bg-warning text-dark">Pending</div>';
                        break;
                    case 'Approved':
                        echo '<div class="badge bg-success text-white">Approved</div>';
                        break;
                    case 'In Process':
                        echo '<div class="badge bg-primary text-white">In Process</div>';
                        break;
                    case 'Converted':
                        echo '<div class="badge bg-info text-white">Converted</div>';
                        break;
                    case 'Rejected':
                        echo '<div class="badge bg-danger text-white">Rejected</div>';
                        break;
                    default:
                        echo '<div class="badge bg-secondary text-white">Unknown</div>';
                }
                ?>
            </span>
        </div>

        <div>
            <span class="fw-bold text-dark"><?= $this->lang->line('apply_date') ?>:</span>
            <span class="fs-12 fw-bold text-primary c-pointer">
                <?= $obj['apply_date'] ?? '-' ?></span>
        </div>
    </div>

    <div class="offcanvas-body">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('from_date') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['apply_date'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('upto_date') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['upto_date'] ?? '-' ?></span>
                </div>
            </div>
            
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('leave_category') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['leave_category'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('leave_type') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['leave_type'] ?? '-' ?></span>
                </div>
            </div>
          
              
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('total_days') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['total_days'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('employee') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['employee'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-12 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('leave_reason') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['leave_reason'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-12 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('message') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['message'] ?? '-' ?></span>
                </div>
            </div>
            
            <!-- <div class="col-lg-6 mb-4">
                <label class="form-label">Leave Type</label>
                <input class="form-control" readonly value="<?= $obj['leave_category'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Leave Type</label>
                <input class="form-control" readonly value="<?= $obj['leave_type'] ?>">
            </div>

            <div class="col-lg-12 mb-4">
                <label class="form-label">Reason</label>
                <textarea class="form-control" readonly rows="3"><?= $obj['leave_reason'] ?></textarea>
            </div> -->
        </div>
    </div>

    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>



