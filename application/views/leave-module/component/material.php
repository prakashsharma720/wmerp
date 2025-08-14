<div class="offcanvas offcanvas-end d-flex flex-column" tabindex="-1" id="material<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('material_return_register_details') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Scrollable Body -->
    <div class="offcanvas-body flex-grow-1 overflow-auto">
        <div class="row">

            <!-- Section Heading -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">Profile Details</h2>
                </div>
            </div>

            <!-- MR No -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('mr_no') ?>:</label>
                <div>
                    <?php
                        $voucher_no = $obj['voucher_code'];
                        if ($voucher_no < 10) {
                            $gir_id_code = 'MR000' . $voucher_no;
                        } elseif ($voucher_no < 100) {
                            $gir_id_code = 'MR00' . $voucher_no;
                        } elseif ($voucher_no < 1000) {
                            $gir_id_code = 'MR0' . $voucher_no;
                        } else {
                            $gir_id_code = 'MR' . $voucher_no;
                        }
                        echo $gir_id_code;
                    ?>
                </div>
            </div>

            <!-- Gatepass No -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('gatepass_no') ?>:</label>
                <div><?= !empty($obj['gate_pass_no']) ? $obj['gate_pass_no'] : '-' ?></div>
            </div>

            <!-- Supplier -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('supplier_name') ?>:</label>
                <div><?= !empty($obj['supplier']) ? $obj['supplier'] : '-' ?></div>
            </div>

            <!-- Date -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('date') ?>:</label>
                <div><?= !empty($obj['transaction_date']) ? $obj['transaction_date'] : '-' ?></div>
            </div>

            <!-- Total Qty -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('total_qty') ?>:</label>
                <div><?= !empty($obj['total_qty']) ? $obj['total_qty'] : '-' ?></div>
            </div>

        </div>
    </div>

    <!-- Footer with Close Button -->
    <div class="px-4 gap-2 d-flex align-items-center justify-content-end ht-80 border-top border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">
            <?= $this->lang->line('close') ?: 'Close' ?>
        </a>
    </div>
</div>
