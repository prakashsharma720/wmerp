<div class="offcanvas offcanvas-end" tabindex="-1" id="viewapp<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('pending_requisition_slips_for_purchase_order') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
        <div class="row">

            <!-- Section Heading -->
            <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h4 class="fs-16 fw-bold mb-0"><?= $this->lang->line('purchase_order') ?></h4>
            </div>

            <!-- Requisition Info -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('requisition_no') ?>:</label>
                <div><?= !empty($obj['requisition_slip_no']) ? $obj['requisition_slip_no'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('requisition_date') ?>:</label>
                <div><?= !empty($obj['transaction_date']) ? $obj['transaction_date'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('request_by') ?>:</label>
                <div><?= !empty($obj['requestor']) ? $obj['requestor'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('status') ?>:</label>
                <div><?= !empty($obj['approved_status']) ? $obj['approved_status'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('action_date') ?>:</label>
                <div><?= !empty($obj['approved_date']) ? $obj['approved_date'] : '-' ?></div>
            </div>
            <div class="col-lg-6 mb-3">
                <label class="fw-bold"><?= $this->lang->line('action_by') ?>:</label>
                <div><?= !empty($obj['approver']) ? $obj['approver'] : '-' ?></div>
            </div>

            <!-- Requisition Items Section -->
          
            <div class="row bg-light text-black fw-bold py-2 px-3 rounded-top">
                <div class="col-1">#</div>
                <div class="col-5"><?= $this->lang->line('item_name') ?></div>
                <div class="col-2"><?= $this->lang->line('qty') ?></div>
                <div class="col-4"><?= $this->lang->line('description') ?></div>
            </div>
            <?php $j = 1; foreach($obj['requisition_details'] as $po_detail){ ?>
                <div class="row border-bottom py-2 px-3 align-items-center">
                    <div class="col-1"><?= $j; ?></div>
                    <div class="col-5"><?= $po_detail['name'] . ' (' . $po_detail['code'] . ')'; ?></div>
                    <div class="col-2"><?= $po_detail['quantity']; ?></div>
                    <div class="col-4"><?= $po_detail['description']; ?></div>
                </div>
            <?php $j++; } ?>

            <!-- Additional Info -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="fw-bold"><?= $this->lang->line('total_qty') ?>:</label>
                    <span><?= $obj['total_qty'] ?></span>
                </div>
                <div class="col-md-6">
                    <label class="fw-bold"><?= $this->lang->line('requisition_slip_for') ?>:</label>
                    <span><?= $obj['rs_for'] ?></span>
                </div>
            </div>

            <?php if($obj['rs_for'] == 'Raw Material' || $obj['rs_for']=='Packing Material'){ ?>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="fw-bold"><?= $this->lang->line('mineral_name') ?>:</label>
                        <span><?= $obj['mineral_name'] ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold"><?= $this->lang->line('grade_name') ?>:</label>
                        <span><?= $obj['grade_name'] ?></span>
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold"><?= $this->lang->line('lot_no') ?>:</label>
                        <span><?= $obj['lot_no'] ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold"><?= $this->lang->line('batch_no') ?>:</label>
                        <span><?= $obj['batch_no'] ?></span>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="fw-bold"><?= $this->lang->line('equipment_name') ?>:</label>
                        <span><?= $obj['equipment_name'] ?></span>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold"><?= $this->lang->line('purpose') ?>:</label>
                        <span><?= $obj['purpose'] ?></span>
                    </div>
                </div>
            <?php } ?>

            <div class="row mt-2">
                <div class="col-md-12">
                    <label class="fw-bold"><?= $this->lang->line('comment') ?>:</label>
                    <span><?= $obj['comment'] ?></span>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>
