<div class="offcanvas offcanvas-end" tabindex="-1" id="trans<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('supplier_evaluation_results') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
        <!-- Section Heading -->
        <div class="offcanvas-header ht-80 px-0">
            <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0"><?= $this->lang->line('supplier_details') ?></h2>
            </div>
        </div>

        <!-- Supplier Details -->
        <div class="row">
            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('name') ?>:</label>
                <div><?= !empty($obj['supplier_name']) ? $obj['supplier_name'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('category') ?>:</label>
                <div><?= !empty($obj['category']) ? $obj['category'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('grade') ?>:</label>
                <div><?= !empty($obj['approval_grade']) ? $obj['approval_grade'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('evaluation_date') ?>:</label>
                <div><?= !empty($obj['date']) ? $obj['date'] : '-' ?></div>
            </div>
        </div>

        <!-- Evaluation Details -->
        <div class="col-12">
            <div class="bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold mb-0"><?= $this->lang->line('evaluation_details') ?></h2>
            </div>

            <!-- Table Header -->
            <div class="row col-md-12 border mb-2 p-2" style="font-weight:500;">
                <div class="col-md-1">#</div>
                <div class="col-md-6"><?= $this->lang->line('criteria_name') ?></div>
                <div class="col-md-2"><?= $this->lang->line('marks') ?></div>
                <div class="col-md-3"><?= $this->lang->line('grade') ?></div>
            </div>

            <!-- Evaluation Loop -->
            <?php $j = 1; foreach ($obj['er_details'] as $gir_detail): ?>
                <div class="row col-md-12 border-0 mb-2 p-2" style="height: 45px;">
                    <div class="col-md-1"><?= $j; ?></div>
                    <div class="col-md-6"><?= $gir_detail['criteria']; ?></div>
                    <div class="col-md-2"><?= $gir_detail['marks_obtained']; ?></div>
                    <div class="col-md-3">
                        <?php
                        if ($gir_detail['marks_obtained'] == '10') echo 'Good';
                        elseif ($gir_detail['marks_obtained'] == '7') echo 'Average';
                        else echo 'Below Average';
                        ?>
                    </div>
                </div>
            <?php $j++; endforeach; ?>

            <hr>

            <!-- Totals -->
            <div class="row col-md-12 mb-2">
                <div class="col-md-6">
                    <label class="control-label"><?= $this->lang->line('total_marks_obtained') ?>:</label>
                    <span><?= $obj['total_marks_obtained']; ?></span>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?= $this->lang->line('total_marks') ?>:</label>
                    <span><?= $obj['total_marks']; ?></span>
                </div>
            </div>

            <div class="row col-md-12 mb-2">
                <div class="col-md-6">
                    <label class="control-label"><?= $this->lang->line('percentage') ?>:</label>
                    <span><?= $obj['percentage'] . ' %'; ?></span>
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?= $this->lang->line('comment') ?>:</label>
                    <span><?= $obj['comments']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>
