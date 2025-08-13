<div class="offcanvas offcanvas-end" tabindex="-1" id="custom<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"> <?= $this->lang->line('customers_list') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px);">
        <div class="row">

            <!-- Section Heading -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0"><?= $this->lang->line('view_list') ?></h2>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('name') ?>:</label>
                <div><?= !empty($obj['customer_name']) ? $obj['customer_name'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('registration_date') ?>:</label>
                <div><?= !empty($obj['reg_date']) ? $obj['reg_date'] : '-' ?></div>
            </div>

            <!-- Section Heading -->
           

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('destination') ?>:</label>
                <div><?= !empty($obj['destination']) ? $obj['destination'] : '-' ?></div>
            </div>

             <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('state') ?>:</label>
                <div><?= !empty($obj['state']) ? $obj['state'] : '-' ?></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>