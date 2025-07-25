<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewDetails<?= $obj['id']; ?>">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h4 class="modal-title"><?php echo $obj['transporter_name']; ?> <?= $this->lang->line('details') ?>
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div
        class="py-3 px-4 d-flex justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div>
            <span class="fw-bold text-dark"><?= $this->lang->line('type') ?>:</span>
            <span class="fs-11 fw-medium text-muted">
                <?= $obj['transporter_type']?>
            </span>
        </div>
        <div>
            <span class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</span>
            <span class="fs-11 fw-medium text-muted">
                <?php
                switch ($obj['approve_flag']) {
                    case '0':
                        echo '<div class="badge bg-warning text-dark">Pending</div>';
                        break;
                    case '1':
                        echo '<div class="badge bg-success text-white">Approved</div>';
                        break;
                    case '2':
                        echo '<div class="badge bg-primary text-white">In Process</div>';
                        break;
                    default:
                        echo '<div class="badge bg-secondary text-white">Unknown</div>';
                }
                ?>
            </span>
        </div>

        <div>
            <span class="fw-bold text-dark"><?= $this->lang->line('reg_date') ?>:</span>
            <span class="fs-12 fw-bold text-primary c-pointer">
                <?= $obj['reg_date'] ?? '-' ?></span>
        </div>
    </div>

    <div class="offcanvas-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('vendor_code') ?>:</label>
                    <span> <?php echo $obj['vendor_code']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('contact_person') ?> :</label>
                    <span> <?php echo $obj['contact_person']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('email') ?> :</label>
                    <span> <?php echo $obj['email']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('mobile_no') ?> :</label>
                    <span> <?php echo $obj['mobile_no']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"> <?= $this->lang->line('website') ?>:</label>
                    <span> <?php echo $obj['website']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"> <?= $this->lang->line('tds') ?> :</label>
                    <span> <?php echo $obj['tds']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('gst_no') ?> :</label>
                    <span> <?php echo $obj['gst_no']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"> <?= $this->lang->line('pan_no') ?> :</label>
                    <span> <?php echo $obj['pan_no']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('approved_on') ?>:</label>
                    <span><?php echo date('d-M-Y', strtotime($obj['date_of_approval'])); ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('next_evalution_date') ?>:</label>
                    <span> <?php echo date('d-M-Y', strtotime($obj['date_of_evalution'])); ?></span>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('banh_name') ?>:</label>
                    <span> <?php echo $obj['bank_name']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('branch_name') ?>:</label>
                    <span> <?php echo $obj['branch_name']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('ifsc_code') ?>:</label>
                    <span> <?php echo $obj['ifsc_code']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('account_no') ?>:</label>
                    <span> <?php echo $obj['account_no']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('service_state') ?>:</label>
                    <span> <?php echo $obj['states']; ?></span>
                </div>
                <div class="col-md-6 col-sm-6 ">
                    <label class="control-label"><?= $this->lang->line('category_of_approval') ?> :</label>
                    <span> <?php echo $obj['category_of_approval']; ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="col-md-12 col-sm-12 ">
                    <label class="control-label"><?= $this->lang->line('address') ?> :</label>
                    <span> <?php echo $obj['address']; ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50"
            data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></a>
    </div>
</div>