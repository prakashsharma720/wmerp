<!-- Delete Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="deleteservice<?= $obj['id']; ?>" aria-labelledby="offcanvasLabel<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabel<?= $obj['id']; ?>">
      <?= $this->lang->line('confirm'); ?>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Offcanvas Body -->
  <div class="offcanvas-body">
    <!-- Modal Structure Merged Inside Offcanvas -->
    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Service_providers/deleteservice_provider/<?php echo $obj['id'];?>">
      <div class="modal-content border-0 shadow-none">
        
        <!-- Modal Header -->
        <div class="modal-header border-0 px-0">
          <h4 class="modal-title"><?=$this->lang->line('confirm_header')?> </h4>
        </div>

        <!-- Modal Body -->
        <div class="modal-body px-0">
          <p>
            <?=$this->lang->line('delete_service_provider_confirm')?> 
            <b><?php echo $obj['service_provider_name'];?> </b>?
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
