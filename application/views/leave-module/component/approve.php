<div class="offcanvas offcanvas-end" tabindex="-1" id="approve<?= $obj['id']; ?>" aria-labelledby="offcanvasLabel<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabel<?= $obj['id']; ?>"><?= $this->lang->line('issue_slips'); ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
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

    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>index.php/Requisition_slips/ActionRequisition">
      
      <div class="mb-3">
        <p>
          <?= $this->lang->line('are_you_sure_you_want_to'); ?>
          <b style="color:#168c56;"><?= $this->lang->line('approve'); ?></b>?
          <?= $this->lang->line('requisition_slip'); ?> <b><?= $inv_number1; ?></b>?
        </p>
      </div>

      <input type="hidden" name="requisition_id" value="<?= $obj['id']; ?>">
      <input type="hidden" name="status" value="Approved">
      <input type="hidden" name="approved_date" value="<?= date('Y-m-d'); ?>">

      <div class="mb-3">
        <label for="approve_comment_<?= $obj['id']; ?>" class="form-label"><?= $this->lang->line('comment'); ?></label>
        <textarea id="approve_comment_<?= $obj['id']; ?>" class="form-control" rows="3" name="approve_comment" placeholder="<?= $this->lang->line('enter_reason_here'); ?>"></textarea>
      </div>

      <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success" style="background-color: #168c56;"><?= $this->lang->line('submit'); ?></button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="offcanvas"><?= $this->lang->line('close'); ?></button>
      </div>

    </form>
  </div>
</div>
