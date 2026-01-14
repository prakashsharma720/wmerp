<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewPO<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h2 class="fs-16 fw-bold"><?= $this->lang->line('suppliers_detail') ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
    <div class="row">
      <div class="col-12 mb-3 border-bottom pb-2">
        <h5 class="fw-bold text-primary">Supplier Profile Details</h5>
      </div>
      <div class="col-6">
        <strong>Supplier:</strong> <?= $obj['supplier']; ?><br>
        <strong>PO No:</strong> <?= $obj['po_number']; ?><br>
        <strong>Date:</strong> <?= date('d-M-Y', strtotime($obj['transaction_date'])); ?>
      </div>
      <div class="col-6">
        <strong>Amount:</strong> ₹<?= $obj['grand_total']; ?><br>
        <strong>Discount:</strong> ₹<?= $obj['discount_amount']; ?><br>
        <strong>GST:</strong> ₹<?= $obj['gst_amount']; ?>
      </div>
    </div>
  </div>

  <div class="px-4 d-flex justify-content-end ht-80 border-top">
    <button class="btn btn-danger" data-bs-dismiss="offcanvas">
      <?= $this->lang->line('close') ?>
    </button>
  </div>
</div>
