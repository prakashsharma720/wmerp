<div class="offcanvas offcanvas-end" tabindex="-1" id="viewpoo<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"> <?= $this->lang->line('issue_slips') ?> </h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
        <div class="row">

            <!-- Section Heading -->
            <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0"><?= $this->lang->line('view_list') ?></h2>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('issue_slip_no') ?>:</label>
                <div><?= !empty($obj['issue_slip_no']) ? $obj['issue_slip_no'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('date') ?>:</label>
                <div><?= !empty($obj['transaction_date']) ? $obj['transaction_date'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('total_qty') ?>:</label>
                <div><?= !empty($obj['total_issue_qty']) ? $obj['total_issue_qty'] : '-' ?></div>
            </div>

            <!-- Issue Details Table -->
            <div class="col-12 mt-3">
                <div class="row  bg-light  text-black fw-bold border-bottom pb-2 mb-2">
                    <div class="col-md-1">#</div>
                    <div class="col-md-3"><?= $this->lang->line('item_name') ?></div>
                    <div class="col-md-2"><?= $this->lang->line('unit') ?></div>
                    <div class="col-md-2"><?= $this->lang->line('qty') ?></div>
                    <div class="col-md-2"><?= $this->lang->line('description') ?></div>
                </div>

                <?php $j=1; foreach ($obj['issue_details'] as $po_detail) { ?>
                    <div class="row border-bottom py-2">
                        <div class="col-md-1"><?= $j; ?></div>
                        <div class="col-md-3"><?= $po_detail['item'] . ' (' . $po_detail['item_code'] . ')'; ?></div>
                        <div class="col-md-2"><?= $po_detail['unit']; ?></div>
                        <div class="col-md-2"><?= $po_detail['quantity']; ?></div>
                        <div class="col-md-2"><?= $po_detail['description']; ?></div>
                    </div>
                <?php $j++; } ?>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border-top border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>
