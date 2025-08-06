<!-- Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="ViewPO<?= $obj['id']; ?>" style="height: 100vh;">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h2 class="fs-16 fw-bold"><?= $this->lang->line('purchase_order') ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Scrollable content -->
  <div class="offcanvas-body scrollable-offcanvas px-4 ">
    <div class="row">

    <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('po_details') ?>    </h2>
            </div>
    </div>
      <!-- PO Details -->
     

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('po_number') ?>:</label>
        <div><?= 'CNC/A/' . str_pad($obj['po_number'], 4, '0', STR_PAD_LEFT); ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('order_type') ?>:</label>
        <div><?= ($obj['purchase_indent'] == '1') ? $this->lang->line('purchase_indent') : $this->lang->line('purchase_order'); ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('po_date') ?>:</label>
        <div><?= date('d-M-Y', strtotime($obj['transaction_date'])) ?></div>
      </div>

      <!-- Supplier Details -->
       <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('supplier_details') ?>    </h2>
            </div>
    </div>
     

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('supplier_name') ?>:</label>
        <div><?= !empty($obj['supplier']) ? htmlspecialchars($obj['supplier']) : '—' ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('vendor_reference') ?>:</label>
        <div><?= !empty($obj['vendor_reference']) ? htmlspecialchars($obj['vendor_reference']) : '—' ?></div>
      </div>

      <!-- Financial Details -->
       <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('financial_details') ?>    </h2>
            </div>
    </div>
    

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('total_amount') ?>:</label>
        <div><?= number_format($obj['total_amount'] ?? 0, 2) ?> ₹</div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('discount_rupees') ?>:</label>
        <div><?= number_format($obj['discount_amount'] ?? 0, 2) ?> ₹</div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('discount_percent') ?>:</label>
        <div><?= isset($obj['discount_percent']) ? $obj['discount_percent'] . '%' : '—' ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('gst') ?>:</label>
        <div><?= number_format($obj['gst_amount'] ?? 0, 2) ?> ₹</div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('grand_total') ?>:</label>
        <div><?= number_format($obj['grand_total'] ?? 0, 2) ?> ₹</div>
      </div>

      <!-- Delivery & Terms -->
       <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('delivery_payment_terms') ?>    </h2>
            </div>
    </div>
      

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('delivery_period') ?>:</label>
        <div><?= !empty($obj['delivery_schedule']) ? htmlspecialchars($obj['delivery_schedule']) : '—' ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('payment_terms') ?>:</label>
        <div><?= !empty($obj['payment_terms']) ? htmlspecialchars($obj['payment_terms']) : '—' ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('freight_status') ?>:</label>
        <div><?= !empty($obj['freight_status']) ? ucfirst(htmlspecialchars($obj['freight_status'])) : '—' ?></div>
      </div>

      <!-- Additional Info -->
       <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('additional_info') ?>    </h2>
            </div>
    </div>
      

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
        <div><?= !empty($obj['status']) ? ucfirst(htmlspecialchars($obj['status'])) : '—' ?></div>
      </div>

      <div class="col-lg-12 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('remarks') ?>:</label>
        <div><?= !empty($obj['remarks']) ? nl2br(htmlspecialchars($obj['remarks'])) : '—' ?></div>
      </div>

      <!-- Bank Details -->
       <div class="offcanvas-header ht-80 px-0 ">
                <div class="w-100 bg-light p-3 mb-3 rounded-0">
                <h2 class="fs-16 fw-bold text-truncate-1-line mb-0">
                    <?= $this->lang->line('bank_details') ?>    </h2>
            </div>
    </div>
      

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('bank_name') ?>:</label>
        <div><?= !empty($obj['bank_name']) ? htmlspecialchars($obj['bank_name']) : '—' ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('account_number') ?>:</label>
        <div><?= !empty($obj['account_no']) ? htmlspecialchars($obj['account_no']) : '—' ?></div>
      </div>

    </div> <!-- /row -->
  </div> <!-- /offcanvas-body -->

  <!-- Footer -->
  <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
    </div>
</div>

<!-- Custom CSS (add to your CSS file or <style> tag) -->
<style>
  .scrollable-offcanvas {
    overflow-y: auto;
    max-height: calc(100vh - 160px); /* header 80px + footer 80px */
  }
</style>
