<div class="offcanvas offcanvas-end" tabindex="-1" id="approv<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('pending_requisition_slips_for_purchase_order') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
        <div class="row">

            <!-- Requisition Info -->
            <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('purchase_order') ?></h3>
            </div>

            <div class="col-lg-6 mb-2">
                <label class="fw-bold text-dark"><?= $this->lang->line('requisition_no') ?>:</label>
                <div><?= $obj['requisition_slip_no'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-2">
                <label class="fw-bold text-dark"><?= $this->lang->line('requisition_date') ?>:</label>
                <div><?= $obj['transaction_date'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-2">
                <label class="fw-bold text-dark"><?= $this->lang->line('request_by') ?>:</label>
                <div><?= $obj['requestor'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-2">
                <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
                <div><?= $obj['approved_status'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-2">
                <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
                <div><?= $obj['approved_date'] ?? '-' ?></div>
            </div>
            <div class="col-lg-6 mb-2">
                <label class="fw-bold text-dark"><?= $this->lang->line('action_by') ?>:</label>
                <div><?= $obj['approver'] ?? '-' ?></div>
            </div>

            <!-- PO Item Details Section -->
            <!-- <div class="w-100 bg-light p-3 mt-3 mb-2 rounded-0">
                <h4 class="fs-16 fw-bold mb-0"><?= $this->lang->line('po_item_details') ?></h4>
            </div>
            <div class="row bg-secondary text-white fw-bold py-2 px-3 rounded-top">
                <div class="col-1">#</div>
                <div class="col-5"><?= $this->lang->line('item_name') ?></div>
                <div class="col-2"><?= $this->lang->line('qty') ?></div>
                <div class="col-2"><?= $this->lang->line('price') ?> (₹)</div>
                <div class="col-2"><?= $this->lang->line('amount') ?> (₹)</div>
            </div> -->
            <!-- <?php $j = 1; foreach($obj['po_details'] as $po_detail) { ?>
            <div class="row border-bottom py-2 px-3 align-items-center">
                <div class="col-1"><?= $j; ?></div>
                <div class="col-5"><?= htmlspecialchars($po_detail['material_name']); ?></div>
                <div class="col-2"><?= $po_detail['quantity'] . ' ' . $po_detail['unit']; ?></div>
                <div class="col-2"><?= number_format($po_detail['rate'],2); ?></div>
                <div class="col-2"><?= number_format($po_detail['amount'],2); ?></div>
            </div>
            <?php $j++; } ?> -->

            <!-- Requisition Items Section -->
           
            <div class="row bg-light  text-black fw-bold py-2 px-3 rounded-top">
                <div class="col-1">#</div>
                <div class="col-5"><?= $this->lang->line('item_name') ?></div>
                <div class="col-2"><?= $this->lang->line('qty') ?></div>
                <div class="col-4"><?= $this->lang->line('description') ?></div>
            </div>
            <?php $k=1; foreach($obj['requisition_details'] as $item){ ?>
            <div class="row border-bottom py-2 px-3 align-items-center">
                <div class="col-1"><?= $k; ?></div>
                <div class="col-5"><?= $item['item'] . ' (' . $item['code'] . ')'; ?></div>
                <div class="col-2"><?= $item['quantity'] - $item['issue_qty']; ?></div>
                <div class="col-4"><?= $item['description']; ?></div>
            </div>
            <?php $k++; } ?>

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
                <div class="col-md-6"><label class="fw-bold"><?= $this->lang->line('mineral_name') ?>:</label> <span><?= $obj['mineral_name'] ?></span></div>
                <div class="col-md-6"><label class="fw-bold"><?= $this->lang->line('grade_name') ?>:</label> <span><?= $obj['grade_name'] ?></span></div>
            </div>
            <div class="row mt-1">
                <div class="col-md-6"><label class="fw-bold"><?= $this->lang->line('lot_no') ?>:</label> <span><?= $obj['lot_no'] ?></span></div>
                <div class="col-md-6"><label class="fw-bold"><?= $this->lang->line('batch_no') ?>:</label> <span><?= $obj['batch_no'] ?></span></div>
            </div>
            <?php } else { ?>
            <div class="row mt-2">
                <div class="col-md-6"><label class="fw-bold"><?= $this->lang->line('equipment_name') ?>:</label> <span><?= $obj['equipment_name'] ?></span></div>
                <div class="col-md-6"><label class="fw-bold"><?= $this->lang->line('purpose') ?>:</label> <span><?= $obj['purpose'] ?></span></div>
            </div>
            <?php } ?>

            <div class="row mt-2">
                <div class="col-md-12"><label class="fw-bold"><?= $this->lang->line('comment') ?>:</label> <span><?= $obj['comment'] ?></span></div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>
