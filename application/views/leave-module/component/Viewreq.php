<div class="offcanvas offcanvas-end" tabindex="-1" id="Viewreq<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('requisition_slip') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px);">
        <div class="row">

            <!-- Section Heading -->
            <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('requisition_slip_list') ?>
                </h2>
            </div>
 <div class="mt-4"> <div class="row fw-bold border-bottom pb-2 mb-2"> <div class="col-md-1">#</div> <div class="col-md-5"><?= $this->lang->line('item_name') ?></div> <div class="col-md-2"><?= $this->lang->line('qty') ?></div> <div class="col-md-4"><?= $this->lang->line('description') ?></div> </div>

 <?php
                                      $j=1;foreach($obj['requisition_details'] as $po_detail)
                                      { ?>
                                        <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-5"><?= $po_detail['material_name'].' ('.$po_detail['material_code'].')' ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['quantity'].' '.$po_detail['unit'] ;?> </div>
                                          <div class="col-md-4"><?= $po_detail['description'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
            <div class="row ">
    <!-- Date -->
    <div class="col-lg-6 mb-3 mt-4">
        <label class="fw-bold text-dark"><?= $this->lang->line('date') ?>:</label>
        <div><?= !empty($obj['transaction_date']) ? $obj['transaction_date'] : '-' ?></div>
    </div>

    <!-- Requisition No -->
    <div class="col-lg-6 mb-3 mt-4">
        <label class="fw-bold text-dark"><?= $this->lang->line('requisition_no') ?>:</label>
        <div><?= !empty($obj['requisition_slip_no']) ? $obj['requisition_slip_no'] : '-' ?></div>
    </div>
</div>

<div class="row">
    <!-- Department -->
    <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('department') ?>:</label>
        <div><?= !empty($obj['department']) ? $obj['department'] : '-' ?></div>
    </div>

    <!-- Requisition For -->
    <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('requisition_for') ?>:</label>
        <div><?= !empty($obj['requisition_for']) ? $obj['requisition_for'] : '-' ?></div>
    </div>
</div>

<div class="row">
    <!-- Product / Mineral Name -->
    <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('product') ?>:</label>
        <div><?= !empty($obj['mineral_name']) ? $obj['mineral_name'] : $this->lang->line('select_mineral_name') ?></div>
    </div>

    <!-- Grade -->
    <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('grade') ?>:</label>
        <div><?= !empty($obj['finish_grade']) ? $obj['finish_grade'] : $this->lang->line('select_finish_grade') ?></div>
    </div>
</div>

<div class="row">
    <!-- Lot Number -->
    <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('lot_no') ?>:</label>
        <div><?= !empty($obj['lot_number']) ? $obj['lot_number'] : $this->lang->line('enter_lot_number') ?></div>
    </div>

    <!-- Request By -->
    <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('request_by') ?>:</label>
        <div><?= !empty($obj['requestor']) ? $obj['requestor'] : '-' ?></div>
    </div>
</div>
<!-- Batch Number -->
 <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('batch_no') ?>:</label>
                <div><?= !empty($obj['batch_number']) ? $obj['batch_number'] : $this->lang->line('enter_batch_number') ?></div>
            </div>

            <!-- Equipment Name -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('equipment_name') ?>:</label>
                <div><?= !empty($obj['equipment_name']) ? $obj['equipment_name'] : $this->lang->line('select_equipment') ?></div>
            </div>
                                      </div>
            <!-- Purpose -->
             <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('purpose') ?>:</label>
                <div><?= !empty($obj['purpose']) ? $obj['purpose'] : $this->lang->line('enter_purpose_here') ?></div>
            </div>

            <!-- Status -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
                <div><?= !empty($obj['approved_status']) ? $obj['approved_status'] : '-' ?></div>
            </div>
                                      </div>
            <!-- Action Date -->
             <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
                <div><?= !empty($obj['approved_date']) ? $obj['approved_date'] : '-' ?></div>
            </div>

            <!-- Action By -->
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('action_by') ?>:</label>
                <div><?= !empty($obj['approver']) ? $obj['approver'] : '-' ?></div>
            </div>
        </div>
    </div>
                                      </div>
    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">
            <?= $this->lang->line('close') ?>
        </a>
    </div>
</div>



