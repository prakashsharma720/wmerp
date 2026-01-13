<!-- Delete Requisition Slip Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="deleterequisition<?= $obj['id']; ?>" aria-labelledby="offcanvasLabel<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabel<?= $obj['id']; ?>">
      <?= $this->lang->line('confirm'); ?>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Offcanvas Body -->
  <div class="offcanvas-body">
    <form class="form-horizontal" role="form" method="post" 
          action="<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition/<?php echo $obj['id'];?>">

      <!-- Modal Content merged inside Offcanvas -->
      <div class="modal-content border-0 shadow-none">

        <!-- Header -->
        <div class="modal-header border-0 px-0">
          <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?></h4>
        </div>

        <!-- Body -->
        <div class="modal-body px-0">
          <p>
            <?= $this->lang->line('confirm_delete') ?> 
            <?= $this->lang->line('requisition_slip') ?> 
            <b><?php echo $obj['requisition_slip_no'];?> </b>?
          </p>
        </div>

        <div class="px-4 pb-3 mt-auto d-flex gap-2" style="position:relative;top:650px">
      <button type="submit" class="btn btn-primary delete_submit w-50">
        <?= $this->lang->line('yes'); ?>
      </button>
      <button type="button" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">
        <?= $this->lang->line('no'); ?>
      </button>
    </div>
      </div>
    </form>
  </div>
</div>
