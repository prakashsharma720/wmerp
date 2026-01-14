<!-- Delete Confirmation Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="deleteissue<?= $obj['id']; ?>" aria-labelledby="offcanvasLabel<?= $obj['id']; ?>">
  <!-- Header -->
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabel<?= $obj['id']; ?>">
      <?= $this->lang->line('confirm'); ?>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Body -->
  <div class="offcanvas-body d-flex flex-column" style="padding:1.5rem;">
    <form method="post" action="<?= base_url(); ?>index.php/Issue_slips/deleteissue/<?= $obj['id']; ?>" class="d-flex flex-column h-100">
      
      <input type="hidden" name="id" value="<?= $obj['id']; ?>">

      <!-- Confirmation Message -->
      <div class="mb-3 " style="position:relative;bottom:700px">
        <p class="fs-14 mb-0 ">
          <?= $this->lang->line('are_you_sure_you_want_to'); ?>
          <b style="color: green;"><?= $this->lang->line('delete'); ?></b>
          <?= $this->lang->line('issue_slip_no'); ?>
          <b><?= $obj['issue_slip_no']; ?></b> ?
        </p>
      </div>

      <!-- Footer Buttons -->
      <div class="mt-auto d-flex justify-content-between border-top pt-3">
        <button type="submit" class="btn btn-primary w-50 me-2">
          <?= $this->lang->line('yes'); ?>
        </button>
        <button type="button" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">
          <?= $this->lang->line('cancel'); ?>
        </button>
      </div>

    </form>
  </div>
</div>
