<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewLeave<?= $obj['id']; ?>">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('employee_detail') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('name') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['name'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('email') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['email'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('role') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['role'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('mobile_no') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['mobile_no'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('department_name') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['department_name'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('designation') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['designation'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('date_of_joining') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['date_of_joining'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('authority_person') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['author_email'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('date_of_birth') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                        <?= $obj['dob'] ?? '-' ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>