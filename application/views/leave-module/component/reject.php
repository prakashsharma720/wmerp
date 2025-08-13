<div class="offcanvas offcanvas-end" tabindex="-1" id="reject<?= $obj['id']; ?>" aria-labelledby="offcanvasLabelReject<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5" style="background-color:#dc7629; color: azure;">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabelReject<?= $obj['id']; ?>">
      <?= $this->lang->line('confirm_header'); ?>
    </h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body" style="max-height: calc(100vh - 160px); overflow-y:auto;">
    <?php
      $inv_number = $obj['requisition_slip_no'];
      if ($inv_number < 10) {
        $inv_number1 = 'RS000' . $inv_number;
      } else if (($inv_number >= 10) && ($inv_number <= 99)) {
        $inv_number1 = 'RS00' . $inv_number;
      } else if (($inv_number >= 100) && ($inv_number <= 999)) {
        $inv_number1 = 'RS0' . $inv_number;
      } else {
        $inv_number1 = 'RS' . $inv_number;
      }
    ?>

    <p>
      <?= $this->lang->line('are_you_sure_you_want_to'); ?>
      <b style="color:#dc7629;"><?= $this->lang->line('reject'); ?></b>
      <?= $this->lang->line('requisition_slips'); ?> <b><?= $inv_number1; ?></b>?
    </p>

    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/ActionRequisition">

      <input type="hidden" name="requisition_id" value="<?= $obj['id']; ?>">
      <input type="hidden" name="status" value="Rejected">
      <input type="hidden" name="rejected_date" value="<?= date('Y-m-d'); ?>">

      <div class="mb-3">
        <label for="reject_reason_<?= $obj['id']; ?>" class="form-label"><?= $this->lang->line('reject_reason'); ?></label>
        <textarea id="reject_reason_<?= $obj['id']; ?>" class="form-control" rows="3" name="rejected_reason" placeholder="<?= $this->lang->line('enter_reason_here'); ?>" required></textarea>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-danger" style="background-color: #dc7629;">
          <?= $this->lang->line('submit'); ?>
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">
          <?= $this->lang->line('close'); ?>
        </button>
      </div>

    </form>
  </div>
</div>
