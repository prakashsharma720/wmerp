<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewPO<?= $obj['id']; ?>">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('suppliers_detail') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body" style="max-height: calc(100vh - 160px)" ;>
        <div class="row">

<div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
           Supplier Profile Details               </h2>
            </div>
    </div>
           
            <!-- <div class="offcanvas-body overflow-auto" style="max-height: calc(100vh - 160px);">
        <div class="row">
            <div class="col-12 mb-3">
                <h5 class="fw-bold bg-light p-2">Order Details</h5>
            </div> -->

            <?php
            $fields = [
                ['supplier_name', 'Supplier Name'],
                ['contact_person', 'Contact Person'],
                ['mobile_no', 'Mobile Number'],
                ['email', 'Email'],
                ['supplier_type', 'Supplier Type'],
                ['category', 'Category'],
                ['approval_category', 'Approval Category'],
                ['supplier_code', 'Supplier Code'],
                ['state', 'State'],
                ['city', 'City'],
                ['address', 'Address'],
                ['website', 'Website'],
                ['registration_date', 'Registration Date'],
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

            <!-- <div class="col-12 mb-3">
                <h5 class="fw-bold bg-light p-2">GST & Tax Details</h5>
            </div> -->
            <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                   GST & Tax Details      </h2>
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

            <!-- <div class="col-12 mb-3">
                <h5 class="fw-bold bg-light p-2">Bank Details</h5>
            </div> -->
<div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
           Bank Details               </h2>
            </div>
    </div>
            <?php
            $bankFields = [
                ['account_holder_name', 'Account Holder Name'],
                ['bank_name', 'Bank Name'],
                ['account_number', 'Account Number'],
                ['ifsc_code', 'IFSC Code'],
                ['branch_address', 'Branch Address'],
                ['account_type', 'Account Type'],
                ['upi_id', 'UPI ID']
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

    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>