<div class="offcanvas offcanvas-end" tabindex="-1" id="deleteFG<?= $obj['id']; ?>" aria-labelledby="offcanvasLabel<?= $obj['id']; ?>">
  <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
    <h5 class="offcanvas-title fs-16 fw-bold" id="offcanvasLabel<?= $obj['id']; ?>">
      <?= $this->lang->line('confirm'); ?>
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body d-flex flex-column" style="padding:1.5rem;">

    <?php
      $voucher_no = $obj['fg_code'];
      if ($voucher_no < 10) {
        $fg_code = 'FG000' . $voucher_no;
      } elseif ($voucher_no <= 99) {
        $fg_code = 'FG00' . $voucher_no;
      } elseif ($voucher_no <= 999) {
        $fg_code = 'FG0' . $voucher_no;
      } else {
        $fg_code = 'FG' . $voucher_no;
      }
    ?>

    <form method="post" action="<?= base_url('index.php/Finish_goods/deleteFG/' . $obj['id']); ?>" class="d-flex flex-column h-100">

      <!-- Hidden inputs (optional) -->
      <input type="hidden" name="id" value="<?= $obj['id']; ?>">
      <input type="hidden" name="fg_code" value="<?= $fg_code; ?>">

      <!-- Confirmation text -->
      <div class="mb-3">
        <p class="fs-14 mb-0" style="position: relative; bottom:700px">
          <?= $this->lang->line('are_you_sure_you_want_to'); ?>
          <b style="color: green;"><?= $this->lang->line('delete'); ?></b>
          <span><?= $obj['grade_name'] . ' (' . $fg_code . ')' ?></span> ?
        </p>
      </div>

      <!-- Buttons -->
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
