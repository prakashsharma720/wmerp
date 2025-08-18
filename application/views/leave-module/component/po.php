<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewPO<?= $obj['id']; ?>" style="height: 100vh;">
  <!-- Header -->
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-200">
    <h2 class="fs-16 fw-bold"><?= $this->lang->line('purchase_order') ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Scrollable Content -->
  <div class="offcanvas-body scrollable-offcanvas px-4">
    <div class="row">
<!-- PO Item Details -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('po_item_details') ?></h3>
        </div>

        <div class="row bg-secondary text-white fw-bold py-2 px-3 rounded-top">
          <div class="col-1">#</div>
          <div class="col-5"><?= $this->lang->line('item_name') ?></div>
          <div class="col-2"><?= $this->lang->line('qty') ?></div>
          <div class="col-2"><?= $this->lang->line('price') ?> (₹)</div>
          <div class="col-2"><?= $this->lang->line('amount') ?> (₹)</div>
        </div>

        <?php $j = 1; foreach($obj['po_details'] as $po_detail) { ?>
          <div class="row border-bottom py-2 px-3 align-items-center">
            <div class="col-1"><?= $j; ?></div>
            <div class="col-5"><?= htmlspecialchars($po_detail['material_name']); ?></div>
            <div class="col-2"><?= $po_detail['quantity'] . ' ' . $po_detail['unit']; ?></div>
            <div class="col-2"><?= number_format($po_detail['rate'], 2); ?></div>
            <div class="col-2"><?= number_format($po_detail['amount'], 2); ?></div>
          </div>
        <?php $j++; } ?>
      </section>
      <!-- PO Details -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('po_details') ?></h3>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('po_number') ?>:</label>
            <div><?= 'CNC/A/' . str_pad($obj['po_number'], 4, '0', STR_PAD_LEFT); ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('order_type') ?>:</label>
            <div><?= ($obj['purchase_indent'] == '1') ? $this->lang->line('purchase_indent') : $this->lang->line('purchase_order'); ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('po_date') ?>:</label>
            <div><?= date('d-M-Y', strtotime($obj['transaction_date'])) ?></div>
          </div>
        </div>
      </section>

      

      <!-- Supplier Details -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('supplier_details') ?></h3>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('supplier_name') ?>:</label>
            <div><?= !empty($obj['supplier']) ? htmlspecialchars($obj['supplier']) : '—' ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('vendor_reference') ?>:</label>
            <div><?= !empty($obj['vendor_reference']) ? htmlspecialchars($obj['vendor_reference']) : '—' ?></div>
          </div>
        </div>
      </section>

      <!-- Financial Details -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('financial_details') ?></h3>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('total_amount') ?>:</label>
            <div><?= number_format($obj['total_amount'] ?? 0, 2) ?> ₹</div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('discount_rupees') ?>:</label>
            <div><?= number_format($obj['discount_amount'] ?? 0, 2) ?> ₹</div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('discount_percent') ?>:</label>
            <div><?= isset($obj['discount_percent']) ? $obj['discount_percent'] . '%' : '—' ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('gst') ?>:</label>
            <div><?= number_format($obj['gst_amount'] ?? 0, 2) ?> ₹</div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('grand_total') ?>:</label>
            <div><?= number_format($obj['grand_total'] ?? 0, 2) ?> ₹</div>
          </div>
        </div>
      </section>

      <!-- Delivery & Terms -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('delivery_payment_terms') ?></h3>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('delivery_period') ?>:</label>
            <div><?= !empty($obj['delivery_schedule']) ? htmlspecialchars($obj['delivery_schedule']) : '—' ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('payment_terms') ?>:</label>
            <div><?= !empty($obj['payment_terms']) ? htmlspecialchars($obj['payment_terms']) : '—' ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('freight_status') ?>:</label>
            <div><?= !empty($obj['freight_status']) ? ucfirst(htmlspecialchars($obj['freight_status'])) : '—' ?></div>
          </div>
        </div>
      </section>

      <!-- Additional Info -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('additional_info') ?></h3>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
            <div><?= !empty($obj['status']) ? ucfirst(htmlspecialchars($obj['status'])) : '—' ?></div>
          </div>
          <div class="col-12">
            <label class="fw-bold text-dark"><?= $this->lang->line('remarks') ?>:</label>
            <div><?= !empty($obj['remarks']) ? nl2br(htmlspecialchars($obj['remarks'])) : '—' ?></div>
          </div>
        </div>
      </section>

      <!-- Bank Details -->
      <section class="mb-4">
        <div class="bg-light p-3 rounded mb-3">
          <h3 class="fs-16 fw-bold mb-0"><?= $this->lang->line('bank_details') ?></h3>
        </div>
        <div class="row g-3">
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('bank_name') ?>:</label>
            <div><?= !empty($obj['bank_name']) ? htmlspecialchars($obj['bank_name']) : '—' ?></div>
          </div>
          <div class="col-md-6">
            <label class="fw-bold text-dark"><?= $this->lang->line('account_number') ?>:</label>
            <div><?= !empty($obj['account_no']) ? htmlspecialchars($obj['account_no']) : '—' ?></div>
          </div>
        </div>
      </section>

    </div> <!-- /row -->
  </div> <!-- /offcanvas-body -->

  <!-- Footer -->
  <div class="px-4 d-flex gap-2 align-items-center ht-80 border-top border-gray-200">
    <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
  </div>
</div>

<!-- Custom CSS -->
<style>
  .scrollable-offcanvas {
    overflow-y: auto;
    max-height: calc(100vh - 160px); /* header + footer */
  }
  section {
    border-bottom: 1px solid #eaeaea;
    padding-bottom: 10px;
  }
  .row.bg-secondary {
    background-color: lightblue !important;
    
  }
</style>
