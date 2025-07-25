<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show px-4 py-3 mx-3 my-2" role="alert">
        <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?></h5>
        <?= $this->session->flashdata('success'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

    <?php if ($this->session->flashdata('failed')): ?>
    <div class="alert alert-danger alert-dismissible px-4 py-3 mx-3 my-2">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-exclamation-triangle"></i> <?= $this->lang->line('alert') ?>!</h5>
        <?= $this->session->flashdata('failed'); ?>
    </div>
<?php endif; ?>