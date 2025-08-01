<div class="offcanvas offcanvas-end" tabindex="-1" id="viewPO<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('details') ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <div class="row">
      <!-- Section Heading -->
      <div class="offcanvas-header ht-80 px-0">
        <div class="w-100 bg-light p-3 mb-3 rounded-0">
          <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
            <?= $this->lang->line('personal_details') ?>
          </h2>
        </div>
      </div>

      <!-- Supplier Name -->
      <div class="col-lg-6 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('supplier_name') ?>:</span>
        <div><span class="fs-12 fw-bold text-default"><?= $obj['supplier'] ?? '-' ?></span></div>
      </div>

      <!-- Email -->
      <div class="col-lg-6 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('email') ?>:</span>
        <div><span class="fs-12 fw-bold text-default"><?= $obj['email'] ?? '-' ?></span></div>
      </div>

      <!-- PO No -->
      <div class="col-lg-6 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('po_no') ?? 'PO No' ?>:</span>
        <div><span class="fs-12 fw-bold text-default"><?= $obj['po_no'] ?? '-' ?></span></div>
      </div>

      <!-- PO Date -->
      <div class="col-lg-6 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('date') ?? 'Date' ?>:</span>
        <div><span class="fs-12 fw-bold text-default"><?= $obj['date'] ?? '-' ?></span></div>
      </div>

      <!-- Total Amount -->
      <div class="col-lg-6 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('total_amount') ?? 'Total Amount (₹)' ?>:</span>
        <div><span class="fs-12 fw-bold text-default">₹<?= $obj['total_amount'] ?? '0.00' ?></span></div>
      </div>

      <!-- Payment Status -->
      <div class="col-lg-6 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('payment_status') ?? 'Payment Status' ?>:</span>
        <div><span class="fs-12 fw-bold text-default"><?= ucfirst($obj['payment_status'] ?? '-') ?></span></div>
      </div>

      <!-- Note (if any) -->
      <!-- <div class="col-lg-12 mb-4">
        <span class="fw-bold text-dark"><?= $this->lang->line('note') ?? 'Note' ?>:</span>
        <div><span class="fs-12 fw-bold text-default"><?= $obj['note'] ?? '-' ?></span></div>
      </div> -->

    </div>
  </div>

  <div class="px-4 d-flex justify-content-end ht-80 border-top">
    <button class="btn btn-danger" data-bs-dismiss="offcanvas"><?= $this->lang->line('close') ?></button>
  </div>
</div>

