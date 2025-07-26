<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewLeave<?= $obj['id']; ?>">


    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('employee_detail') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="row ">
            <div class="offcanvas-header ht-80 px-0 border-bottom border-gray-5">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
            <?= $this->lang->line('personal_details') ?>
                </h2>
            </div>
    </div>

    

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
           <div class="offcanvas-header ht-80 px-0 border-bottom border-gray-5">
    <div class="w-100 bg-light p-3 mb-3 rounded-0">
        <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
            <?= $this->lang->line('bank_details') ?>
        </h2>
    </div>
</div>

            <div class="row">
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('account_holder_name') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['account_holder_name'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('bank_name') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['bank_name'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('account_number') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['account_number'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('ifsc_code') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['ifsc_code'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('branch_name') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['branch_name'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('account_type') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['account_type'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('upi_id') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['upi_id'] ?? '-' ?></span>
                </div>
            </div>
             <div class="offcanvas-header ht-80 px-0 border-bottom border-gray-5">
    <div class="w-100 bg-light p-3 mb-3 rounded-0">
        <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
            <?= $this->lang->line('salary_details') ?>
        </h2>
    </div>
</div>

<div class="row">
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('basic_salary') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['basic_salary'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('hra') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['hra'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('conveyance_allowance') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['conveyance_allowance'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('medical_allowance') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['medical_allowance'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('other_allowance') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['other_allowance'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('total_net_salary') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['total_net_salary'] ?? '-' ?></span>
                </div>
            </div>
              <div class="offcanvas-header ht-80 px-0 border-bottom border-gray-5">
    <div class="w-100 bg-light p-3 mb-3 rounded-0">
        <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
            <?= $this->lang->line('other_details') ?>
        </h2>
    </div>
</div>

    <div class="row">
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('emergency_mobile_no') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['emergency_mobile_no'] ?? '-' ?></span>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('emergency_name') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['emergency_name'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('uan_no') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['uan_no'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('pf_no') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['pf_no'] ?? '-' ?></span>
                </div>
            </div>
             <div class="col-lg-6 mb-4">
                <span class="fw-bold text-dark"><?= $this->lang->line('esi_no') ?>:</span>
                <div>
                    <span class="fs-12 fw-bold text-default">
                    <?= $obj['esi_no'] ?? '-' ?></span>
                </div>
            </div>
     <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>
