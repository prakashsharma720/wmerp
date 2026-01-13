<!-- Delete Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="deleteev<?= $obj['id']; ?>" aria-labelledby="offcanvasLabel<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabel<?= $obj['id']; ?>">
      <?= $this->lang->line('confirm'); ?>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <form method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/deleteERS/<?php echo $obj['id']; ?>" class="d-flex flex-column h-100">
    <div class="offcanvas-body d-flex flex-column" style="padding:1.5rem; position:relative;bottom:700px">
        
      <p><?= $this->lang->line('are_you_sure_you_want_to'); ?>
      <?= $this->lang->line('delete'); ?> <span>  </span><?= $this->lang->line('supplier_name'); ?> <b><?php echo $obj['supplier_name']; ?></b> <?= $this->lang->line('evaluation') ?> ?</p>
    </div>
    <div class="px-4 pb-3 mt-auto d-flex gap-2">
      <button type="submit" class="btn btn-primary delete_submit w-50"> <?= $this->lang->line('yes') ?> </button>
      <button type="button" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"> <?= $this->lang->line('no') ?> </button>
    </div>
  </form>
</div>
