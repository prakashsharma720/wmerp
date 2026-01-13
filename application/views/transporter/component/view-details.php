<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewDetails<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h4 class="modal-title mb-0"><?php echo $obj['transporter_name']; ?> <?= $this->lang->line('details') ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Top Info Row -->
    <div class="py-3 px-4 d-flex flex-wrap justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div class="me-3">
            <span class="fw-bold text-dark"><?= $this->lang->line('type') ?>:</span>
            <span class="fs-11 fw-medium text-muted"><?= $obj['transporter_type'] ?? '-' ?></span>
        </div>
        <div class="me-3">
            <span class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</span>
            <?php
                switch ($obj['approve_flag']) {
                    case '0':
                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                        break;
                    case '1':
                        echo '<span class="badge bg-success text-white">Approved</span>';
                        break;
                    case '2':
                        echo '<span class="badge bg-primary text-white">In Process</span>';
                        break;
                    default:
                        echo '<span class="badge bg-secondary text-white">Unknown</span>';
                }
            ?>
        </div>
        <div>
            <span class="fw-bold text-dark"><?= $this->lang->line('reg_date') ?>:</span>
            <span class="fs-12 fw-bold text-primary"><?= $obj['reg_date'] ?? '-' ?></span>
        </div>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y: auto;">
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('vendor_code') ?>:</label>
                <div><?= $obj['vendor_code'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('contact_person') ?>:</label>
                <div><?= $obj['contact_person'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('email') ?>:</label>
                <div><?= $obj['email'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('mobile_no') ?>:</label>
                <div><?= $obj['mobile_no'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('website') ?>:</label>
                <div><?= $obj['website'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('tds') ?>:</label>
                <div><?= $obj['tds'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('gst_no') ?>:</label>
                <div><?= $obj['gst_no'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('pan_no') ?>:</label>
                <div><?= $obj['pan_no'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('date_of_approval') ?>:</label>
                <div><?= !empty($obj['date_of_approval']) ? date('d-M-Y', strtotime($obj['date_of_approval'])) : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('date_of_next_evaluation') ?>:</label>
                <div><?= !empty($obj['date_of_evalution']) ? date('d-M-Y', strtotime($obj['date_of_evalution'])) : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('bank_name') ?>:</label>
                <div><?= $obj['bank_name'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('branch_name') ?>:</label>
                <div><?= $obj['branch_name'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('ifsc_code') ?>:</label>
                <div><?= $obj['ifsc_code'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('account_number') ?>:</label>
                <div><?= $obj['account_no'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('service_for_the_state') ?>:</label>
                <div><?= $obj['states'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('category_of_approval') ?>:</label>
                <div><?= $obj['category_of_approval'] ?? '-' ?></div>
            </div>

            <div class="col-lg-12 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('address') ?>:</label>
                <div><?= $obj['address'] ?? '-' ?></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">
            <?= $this->lang->line('close') ?>
        </a>
    </div>
</div>
