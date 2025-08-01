<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewPO<?= $obj['id']; ?>">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('suppliers_detail') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="row">

            <!-- Supplier Profile Details -->
            <div class="col-12 mb-3 border-bottom pb-2">
                <h5 class="fw-bold text-primary">Supplier Profile Details</h5>
            </div>

            <?php
            $fields = [
                ['name', 'supplier_name'],
                ['email', 'email'],
                ['contact_person', 'contact_person'],
                ['mobile_no', 'mobile_no'],
                ['supplier_code', 'supplier_code'],
                ['supplier_type', 'supplier_type'],
                ['category', 'category'],
                ['approval_category', 'category_of_approval'],
                ['registration_date', 'registration_date']
            ];

            foreach ($fields as [$labelKey, $dataKey]) {
                echo '<div class="col-lg-6 mb-3">
                        <label class="fw-bold text-dark">' . $this->lang->line($labelKey) . ':</label>
                        <div>' . ($obj[$dataKey] ?? '-') . '</div>
                      </div>';
            }
            ?>

            <!-- GST & Tax Details -->
            <div class="col-12 mt-3 mb-2 border-top pt-3">
                <h5 class="fw-bold text-primary">GST & Tax Details</h5>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('gst_status') ?>:</label>
                <div><?= $obj['gst_status'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">GSTIN / URP:</label>
                <div><?= $obj['gst_number'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">PAN:</label>
                <div><?= $obj['pan_number'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">TAN:</label>
                <div><?= $obj['tan_number'] ?? '-' ?></div>
            </div>

            <!-- Address Details -->
            <div class="col-12 mt-3 mb-2 border-top pt-3">
                <h5 class="fw-bold text-primary">Address Details</h5>
            </div>

            <div class="col-12 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('address') ?>:</label>
                <div><?= $obj['supplier_address'] ?? '-' ?></div>
            </div>

            <div class="col-lg-4 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('country') ?>:</label>
                <div><?= $obj['country'] ?? '-' ?></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('state') ?>:</label>
                <div><?= $obj['state'] ?? '-' ?></div>
            </div>
            <div class="col-lg-4 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('city') ?>:</label>
                <div><?= $obj['city'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('website') ?>:</label>
                <div><?= $obj['website'] ?? '-' ?></div>
            </div>

            <!-- Bank Details -->
            <div class="col-12 mt-3 mb-2 border-top pt-3">
                <h5 class="fw-bold text-primary"><?= $this->lang->line('bank_details') ?></h5>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">Bank Name:</label>
                <div><?= $obj['bank_name'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">Branch Address:</label>
                <div><?= $obj['branch_address'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">IFSC Code:</label>
                <div><?= $obj['ifsc_code'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">Account Number:</label>
                <div><?= $obj['account_number'] ?? '-' ?></div>
            </div>

            <!-- Approval Timeline -->
            <div class="col-12 mt-3 mb-2 border-top pt-3">
                <h5 class="fw-bold text-primary"><?= $this->lang->line('approval_timeline') ?></h5>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">Date of Approval:</label>
                <div><?= $obj['date_of_approval'] ?? '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark">Next Evaluation:</label>
                <div><?= $obj['date_of_evalution'] ?? '-' ?></div>
            </div>

        </div>
    </div>

    <div class="px-4 d-flex justify-content-end ht-80 border-top">
        <button class="btn btn-danger" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></button>
    </div>
    
</div>
