<div class="offcanvas offcanvas-end" tabindex="-1" id="eva<?= $obj['id']; ?>">
    <!-- Header -->
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold"><?= $this->lang->line('transporter_evaluation_panel') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <!-- Body -->
    <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
        <div class="row">

            <!-- Transporter Details Section -->
            <div class="offcanvas-header ht-80 px-0">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold mb-0"><?= $this->lang->line('transporter_details') ?></h2>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('transporter_name') ?>:</label>
                <div><?= !empty($obj['transporter_name']) ? $obj['transporter_name'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('marks_obtained') ?>:</label>
                <div><?= !empty($obj['total_marks_obtained']) ? $obj['total_marks_obtained'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('total_marks') ?>:</label>
                <div><?= !empty($obj['total_marks']) ? $obj['total_marks'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('percentage') ?>:</label>
                <div><?= !empty($obj['percentage']) ? $obj['percentage'] . ' %' : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('grade') ?>:</label>
                <div><?= !empty($obj['approval_grade']) ? $obj['approval_grade'] : '-' ?></div>
            </div>

            <div class="col-lg-6 mb-3">
                <label class="fw-bold text-dark"><?= $this->lang->line('date') ?>:</label>
                <div><?= !empty($obj['date']) ? $obj['date'] : '-' ?></div>
            </div>

            <!-- Evaluation Table Section -->
            <div class="col-12 mt-3">
                <div class="bg-light p-3 mb-3 rounded-0">
                    <h2 class="fs-16 fw-bold mb-0"><?= $this->lang->line('evaluation_details') ?></h2>
                </div>

                <!-- Table Header -->
                <div class="row col-md-12" style="border: 1px solid #f3ecec; height: 45px; padding: 10px; margin: 0; margin-bottom: 6px; font-weight: 500;">
                    <div class="col-md-2"><?= $this->lang->line('sr_no') ?>.</div>
                    <div class="col-md-5"><?= $this->lang->line('criteria_name') ?></div>
                    <div class="col-md-5"><?= $this->lang->line('marks') ?></div>
                </div>

                <!-- Loop through evaluation details -->
                <?php
                $j = 1;
                foreach ($obj['er_details'] as $gir_detail) { ?>
                    <div class="row col-md-12" style="border: 0; height: 45px; padding: 10px; margin: 0; margin-bottom: 6px;">
                        <div class="col-md-2"><?= $j; ?></div>
                        <div class="col-md-5"><?= $gir_detail['criteria']; ?></div>
                        <div class="col-md-5"><?= $gir_detail['marks_obtained']; ?></div>
                    </div>
                <?php $j++; } ?>

                <hr>

                <!-- Comments Section -->
                <div class="row col-md-12" style="margin: 0; margin-bottom: 6px;">
                    <div class="col-md-12">
                        <label class="control-label"><?= $this->lang->line('comment') ?>:</label>
                        <span><?= !empty($obj['comments']) ? $obj['comments'] : '-' ?></span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>
