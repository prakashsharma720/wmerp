<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewPO<?= $obj['id']; ?>">
    <!-- Header -->
    <!-- <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('suppliers_detail') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div> -->








    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h4 class="modal-title mb-0"><?php echo $obj['supplier_name']; ?> <?= $this->lang->line('details') ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>




    <!-- Supplier Name Row (Top) -->
   

    <!-- Top Info Row: Type, Status, Registration Date -->
    <div class="py-2 px-4 d-flex flex-wrap justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div class="me-3">
            <span class="fw-bold text-dark"><?= $this->lang->line('type') ?>:</span>
            <span class="fs-11 fw-medium text-muted"><?= $obj['supplier_type'] ?? '-' ?></span>
        </div>
        <div class="me-3">
            <span class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</span>
            <?php
                switch ($obj['approve_flag'] ?? '') {
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

    <!-- Offcanvas Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px);">
        <div class="row">

            <!-- Supplier Profile Details -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">Supplier Profile Details</h2>
                </div>
            </div>

            <?php
            $fields = [
                ['contact_person', 'Contact Person'],
                ['mobile_no', 'Mobile Number'],
                ['email', 'Email'],
                ['category', 'Category'],
                ['approval_category', 'Approval Category'],
                ['supplier_code', 'Supplier Code'],
                ['state', 'State'],
                ['city', 'City'],
                ['address', 'Address'],
                ['website', 'Website'],
                ['reg_date', 'Registration Date'],
                ['date_of_evalution', 'Evaluation Date'],
                ['date_of_approval', 'Date of Approval'],
            ];
            foreach ($fields as [$key, $label]) {
                echo '<div class="col-lg-6 mb-3">
                        <label class="fw-bold text-dark">' . $label . ':</label>
                        <div>' . ($obj[$key] ?? '-') . '</div>
                      </div>';
            }
            ?>

            <!-- GST & Tax Details -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">GST & Tax Details</h2>
                </div>
            </div>

            <?php
            $gstFields = [
                ['gst_status', 'GST Status'],
                ['gst_number', 'GSTIN / URP'],
                ['pan_number', 'PAN'],
                ['tan_number', 'TAN']
            ];
            foreach ($gstFields as [$key, $label]) {
                echo '<div class="col-lg-6 mb-3">
                        <label class="fw-bold text-dark">' . $label . ':</label>
                        <div>' . ($obj[$key] ?? '-') . '</div>
                      </div>';
            }
            ?>

            <!-- Bank Details -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">Bank Details</h2>
                </div>
            </div>

            <?php
            $bankFields = [
                ['bank_name', 'Bank Name'],
                ['account_number', 'Account Number'],
                ['ifsc_code', 'IFSC Code'],
                ['branch_address', 'Branch Address'],
            ];
            foreach ($bankFields as [$key, $label]) {
                echo '<div class="col-lg-6 mb-3">
                        <label class="fw-bold text-dark">' . $label . ':</label>
                        <div>' . ($obj[$key] ?? '-') . '</div>
                      </div>';
            }
            ?>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>
