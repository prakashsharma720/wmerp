<div class="offcanvas offcanvas-end" tabindex="-1" id="Viewreq<?= $obj['id']; ?>">

    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold mb-0">
            <?= $this->lang->line('requisition_slip') ?>
            (<?= !empty($obj['requisition_slip_no']) ? 'RS'.str_pad($obj['requisition_slip_no'], 4, '0', STR_PAD_LEFT) : '-' ?>)
        </h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
        <div class="row">

            <!-- Section Heading -->
            <div class="w-100 bg-light p-3 mb-3 rounded-0 border">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('requisition_slip_list') ?>
                </h2>
            </div>

            <!-- Table Header -->
            <div class="row fw-bold border-bottom pb-2 mb-2">
                <div class="col-md-1">#</div>
                <div class="col-md-5"><?= $this->lang->line('item_name') ?></div>
                <div class="col-md-2"><?= $this->lang->line('qty') ?></div>
                <div class="col-md-4"><?= $this->lang->line('description') ?></div>
            </div>

            <!-- Table Rows -->
            <?php
            $j = 1;
            $total_qty = 0;
            foreach ($obj['requisition_details'] as $po_detail) {
                $total_qty += $po_detail['quantity'];
            ?>
                <div class="row col-md-12 align-items-center p-2 mb-2 border rounded" style="margin:0;">
                    <div class="col-md-1"><?= $j; ?> </div>
                    <div class="col-md-5"><?= $po_detail['material_name'].' ('.$po_detail['material_code'].')'; ?> </div>
                    <div class="col-md-2"><?= $po_detail['quantity'].' '.$po_detail['unit']; ?> </div>
                    <div class="col-md-4"><?= $po_detail['description']; ?> </div>
                </div>
            <?php $j++; } ?>

            <!-- Total Quantity -->
            <div class="row col-md-12 bg-light fw-bold p-2 border mt-2" style="margin:0;">
                <div class="col-md-6 text-end"><?= $this->lang->line('total_quantity') ?>:</div>
                <div class="col-md-6"><?= $total_qty; ?></div>
            </div>

            <!-- Other Details -->
            <div class="row mt-4">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('date') ?>:</label>
                    <div><?= !empty($obj['transaction_date']) ? $obj['transaction_date'] : '-' ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('requisition_no') ?>:</label>
                    <div><?= !empty($obj['requisition_slip_no']) ? $obj['requisition_slip_no'] : '-' ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('department') ?>:</label>
                    <div><?= !empty($obj['department']) ? $obj['department'] : '-' ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('requisition_for') ?>:</label>
                    <div><?= !empty($obj['requisition_for']) ? $obj['requisition_for'] : '-' ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('product') ?>:</label>
                    <div><?= !empty($obj['mineral_name']) ? $obj['mineral_name'] : $this->lang->line('select_mineral_name') ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('grade') ?>:</label>
                    <div><?= !empty($obj['finish_grade']) ? $obj['finish_grade'] : $this->lang->line('select_finish_grade') ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('lot_no') ?>:</label>
                    <div><?= !empty($obj['lot_number']) ? $obj['lot_number'] : $this->lang->line('enter_lot_number') ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('request_by') ?>:</label>
                    <div><?= !empty($obj['requestor']) ? $obj['requestor'] : '-' ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('batch_no') ?>:</label>
                    <div><?= !empty($obj['batch_number']) ? $obj['batch_number'] : $this->lang->line('enter_batch_number') ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('equipment_name') ?>:</label>
                    <div><?= !empty($obj['equipment_name']) ? $obj['equipment_name'] : $this->lang->line('select_equipment') ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('purpose') ?>:</label>
                    <div><?= !empty($obj['purpose']) ? $obj['purpose'] : $this->lang->line('enter_purpose_here') ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
                    <div><?= !empty($obj['approved_status']) ? $obj['approved_status'] : '-' ?></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
                    <div><?= !empty($obj['approved_date']) ? $obj['approved_date'] : '-' ?></div>
                </div>
                <div class="col-lg-6 mb-3">
                    <label class="fw-bold text-dark"><?= $this->lang->line('action_by') ?>:</label>
                    <div><?= !empty($obj['approver']) ? $obj['approver'] : '-' ?></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border-top border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">
            <?= $this->lang->line('close') ?>
        </a>
    </div>
</div>
