<div class="offcanvas offcanvas-end" tabindex="-1" id="Viewservice<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"> <?= $this->lang->line('service_provider_list') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y: auto;">
        <div class="row">

            <!-- Approval Details -->
            <div class="w-100 bg-light p-3 mb-3">
                <h5 class="fw-bold mb-0"><?= $this->lang->line('approval_details') ?></h5>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('category_of_approval') ?>:</label>
                <div><?= !empty($obj['category_of_approval']) ? $obj['category_of_approval'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('date_of_approval') ?>:</label>
                <div><?= !empty($obj['date_of_approval']) ? $obj['date_of_approval'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('date_of_next_evaluation') ?>:</label>
                <div><?= !empty($obj['date_of_next_evaluation']) ? $obj['date_of_next_evaluation'] : '-' ?></div>
            </div>

            <!-- Basic Details -->
            <div class="w-100 bg-light p-3 mb-3">
                <h5 class="fw-bold mb-0"><?= $this->lang->line('basic_details') ?></h5>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('service_provider_name') ?>:</label>
                <div><?= !empty($obj['service_provider_name']) ? $obj['service_provider_name'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('service_provider_code') ?>:</label>
                <div><?= !empty($obj['service_provider_code']) ? $obj['service_provider_code'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('category') ?>:</label>
                <div><?= !empty($obj['category']) ? $obj['category'] : '-' ?></div>
            </div>

            <!-- Contact Details -->
            <div class="w-100 bg-light p-3 mb-3">
                <h5 class="fw-bold mb-0"><?= $this->lang->line('contact_details') ?></h5>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('contact_person') ?>:</label>
                <div><?= !empty($obj['contact_person']) ? $obj['contact_person'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('email') ?>:</label>
                <div><?= !empty($obj['email']) ? $obj['email'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('mobile') ?>:</label>
                <div><?= !empty($obj['mobile_no']) ? $obj['mobile_no'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('address') ?>:</label>
                <div><?= !empty($obj['address']) ? $obj['address'] : '-' ?></div>
            </div>

            <!-- Bank Details -->
            <div class="w-100 bg-light p-3 mb-3">
                <h5 class="fw-bold mb-0"><?= $this->lang->line('bank_details') ?></h5>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('bank_name') ?>:</label>
                <div><?= !empty($obj['bank_name']) ? $obj['bank_name'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('branch_name_address') ?>:</label>
                <div><?= !empty($obj['branch_address']) ? $obj['branch_address'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('ifsc_code') ?>:</label>
                <div><?= !empty($obj['ifsc_code']) ? $obj['ifsc_code'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('account_number') ?>:</label>
                <div><?= !empty($obj['account_number']) ? $obj['account_number'] : '-' ?></div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>
