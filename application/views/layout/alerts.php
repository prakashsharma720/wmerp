<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success fade show px-4 py-3 mx-3 my-2" role="alert" style="width:100%;">
        <h5></i> <?= $this->lang->line('success') ?></h5>
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <?php if ($this->session->flashdata('failed')): ?>
    <div class="alert alert-danger  fade show px-4 py-3 mx-3 my-2" role="alert" style="width:100%;">
        <h5> <?= $this->lang->line('failed') ?></h5>
        <?= $this->session->flashdata('failed'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
