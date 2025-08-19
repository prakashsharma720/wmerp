<!-- Offcanvas (View Approval) -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="Viewapproval<?= $obj['id']; ?>">
  <!-- Header -->
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h2 class="fs-16 fw-bold">  <?= $this->lang->line('requisition_slips'); ?> 
            (<?php echo 'RS' . str_pad($obj['requisition_slip_no'], 4, '0', STR_PAD_LEFT); ?>) 
            <?= $this->lang->line('details'); ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Body -->
  <div class="offcanvas-body" style="max-height: calc(100vh - 160px);">
    <div class="row">

      <!-- Section Heading -->
      

      <div class="modal-content">
        

        <div class="modal-body">
          <!-- Table Header -->
          <div class="row col-md-12 w-100 bg-light p-3 mb-3 rounded-0" style="border: 1px solid #f3ecec;
              height: 75px; padding: 10px; margin: 0px; margin-bottom: 6px; font-weight: 500;">
            <div class="col-md-1">#</div>
            <div class="col-md-5 mt-2"><?= $this->lang->line('item_name'); ?> </div>
            <div class="col-md-2"><?= $this->lang->line('qty'); ?> </div>
            <div class="col-md-4"><?= $this->lang->line('description'); ?></div>
          </div>

          <!-- Table Data -->
          <?php
          $j = 1;
          foreach ($obj['requisition_details'] as $po_detail) { ?>
            <div class="row col-md-12" style="border: 0px solid #f3ecec;
                height: 45px; padding: 10px; margin: 0px; margin-bottom: 6px;">
              <div class="col-md-1"><?= $j; ?> </div>
              <div class="col-md-5"><?= $po_detail['name'] . ' (' . $po_detail['code'] . ')'; ?> </div>
              <div class="col-md-2 "><?= $po_detail['quantity'] . ' ' . $po_detail['unit_name']; ?> </div>
              <div class="col-md-4"><?= $po_detail['description']; ?> </div>
            </div>
          <?php $j++;
          } ?>
        </div>
      </div>

      <!-- Other Details -->
      <div class="col-lg-6 mb-3 mt-5">
        
        <label class="fw-bold text-dark"><?= $this->lang->line('requisition_no') ?>:</label>
        <div><?= 'RS' . str_pad($obj['requisition_slip_no'], 4, '0', STR_PAD_LEFT); ?></div>
      </div>

      <div class="col-lg-6 mb-3 mt-5">
        <label class="fw-bold text-dark"><?= $this->lang->line('requisition_date') ?>:</label>
        <div><?= !empty($obj['transaction_date']) ? date('d-M-Y', strtotime($obj['transaction_date'])) : '-'; ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('requisition_by') ?>:</label>
        <div><?= !empty($obj['requestor']) ? $obj['requestor'] : '-'; ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('status') ?>:</label>
        <div><?= !empty($obj['approved_status']) ? $obj['approved_status'] : '-'; ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
        <div>
          <?php
          if ($obj['approved_status'] == 'Approved') {
            echo date('d-m-Y', strtotime($obj['approved_date']));
          } elseif ($obj['approved_status'] == 'Rejected') {
            echo date('d-m-Y', strtotime($obj['rejected_date']));
          } else {
            echo 'NA';
          }
          ?>
        </div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('name') ?>:</label>
        <div>
          <?php
          if ($obj['approved_status'] == 'Approved') {
            echo $obj['approver'];
          } elseif ($obj['approved_status'] == 'Rejected') {
            echo $obj['rejector'];
          } else {
            echo 'NA';
          }
          ?>
        </div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('admin_approval') ?>:</label>
        <div><?= !empty($obj['admin_approve_status']) ? $obj['admin_approve_status'] : 'Pending'; ?></div>
      </div>

      <div class="col-lg-6 mb-3">
        <label class="fw-bold text-dark"><?= $this->lang->line('action_date') ?>:</label>
        <div>
          <?= ($obj['admin_approve_status'] != 'Pending') ? date('d-m-Y', strtotime($obj['admin_action_date'])) : 'NA'; ?>
        </div>
      </div>

    </div>
  </div>

  <!-- Footer -->
  <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
    <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Close</a>
  </div>
</div>
