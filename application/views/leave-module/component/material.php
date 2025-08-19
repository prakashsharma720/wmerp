<!-- Material Return Register Details Offcanvas -->
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
                    <h2 class="fs-16 fw-bold mb-0"><?= $this->lang->line('profile_details') ?></h2>
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

        <!-- ================== Items Table ================== -->
        <div class="mt-3">
            <!-- Table Header -->
            <div class="row col-md-12 fw-bold border bg-light py-2 m-0 mb-2">
                <div class="col-md-1">#</div>
                <div class="col-md-3"><?= $this->lang->line('item_name') ?></div>
                <div class="col-md-3"><?= $this->lang->line('out_qty') ?></div>
                <div class="col-md-5"><?= $this->lang->line('description') ?></div>
            </div>

            <!-- Table Rows -->
            <?php $j=1; foreach($obj['gir_details'] as $gir_detail) { ?>
                <div class="row col-md-12 border-bottom py-2 m-0 mb-2">
                    <div class="col-md-1"><?= $j;?> </div>
                    <div class="col-md-3 text-wrap"><?= $gir_detail['item'] ;?> </div>
                    <div class="col-md-3"><?= $gir_detail['quantity'].' '.$gir_detail['unit']; ?> </div>
                    <div class="col-md-5 text-wrap"><?= $gir_detail['description'] ;?> </div>
                </div>
            <?php $j++; } ?>

            <hr>
            <!-- Comments -->
            <div class="row col-md-12 mt-2 m-0 mb-2">
                <label class="fw-bold"><?= $this->lang->line('comment') ?> :</label>
                <div class="text-wrap"><?= !empty($obj['comments']) ? $obj['comments'] : '-' ?></div>
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
