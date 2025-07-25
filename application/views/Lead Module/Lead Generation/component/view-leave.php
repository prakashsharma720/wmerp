<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewLeave<?= $obj['id']; ?>">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <h2 class="fs-16 fw-bold text-truncate-1-line">Lead Details</h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="py-3 px-4 d-flex justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div>
            <span class="fw-bold text-dark">Status:</span>
            <span class="fs-11 fw-medium text-muted">
                <?php
                switch ($obj['lead_status']) {
                    case 'Pending':
                        echo '<div class="badge bg-warning text-dark">Pending</div>';
                        break;
                    case 'Approved':
                        echo '<div class="badge bg-success text-white">Approved</div>';
                        break;
                    case 'In Process':
                        echo '<div class="badge bg-primary text-white">In Process</div>';
                        break;
                    case 'Converted':
                        echo '<div class="badge bg-info text-white">Converted</div>';
                        break;
                    case 'Rejected':
                        echo '<div class="badge bg-danger text-white">Rejected</div>';
                        break;
                    default:
                        echo '<div class="badge bg-secondary text-white">Unknown</div>';
                }
                ?>
            </span>
        </div>

        <div>
            <span class="fw-bold text-dark">Lead Code:</span>
            <span class="fs-12 fw-bold text-primary c-pointer"><?= $obj['lead_code'] ?? '-' ?></span>
        </div>
    </div>

    <div class="offcanvas-body">
        <div class="row">
            <div class="col-lg-6 mb-4">
                <label class="form-label">Date</label>
                <input class="form-control" readonly value="<?= date('d-M-Y', strtotime($obj['date'])) ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Services</label>
                <input class="form-control" readonly value="<?= $obj['category_name'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Title</label>
                <input class="form-control" readonly value="<?= $obj['lead_title'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Contact Person</label>
                <input class="form-control" readonly value="<?= $obj['contact_person'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Country</label>
                <input class="form-control" readonly value="<?= $obj['country'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Mobile</label>
                <input class="form-control" readonly value="<?= $obj['mobile'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Email</label>
                <input class="form-control" readonly value="<?= $obj['email'] ?>">
            </div>

            <div class="col-lg-6 mb-4">
                <label class="form-label">Lead Source</label>
                <input class="form-control" readonly value="<?= $obj['lead_source'] ?>">
            </div>

            <div class="col-lg-12 mb-4">
                <label class="form-label">Description</label>
                <textarea class="form-control" readonly rows="3"><?= $obj['work_description'] ?></textarea>
            </div>
        </div>
    </div>

    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Cancel Yash</a>
    </div>
</div>

