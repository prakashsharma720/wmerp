<style>
    .control-label {
        margin: 0.7rem;
    }
    .hide {
        display: none;
    }
    .show {
        display: block;
    }
</style>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-check"></i> Success!</h5>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-check"></i> Alert!</h5>
        <?php echo $this->session->flashdata('failed'); ?>
    </div>
<?php endif; ?>

<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('daily_tasks') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
                        <?= $this->lang->line('home') ?>
                    </a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('task_history') ?></li>
            </ul>
        </div>
        <div class="page-header-right ms-auto d-md-none d-flex align-items-center">
            <a href="javascript:void(0)" class="page-header-right-open-toggle">
                <i class="feather-align-right fs-20"></i>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <!-- Left Form -->
                    <div class="col-lg-4">
                        <form class="form-horizontal" method="post" action="<?= base_url('index.php/Dailytasks/add_task_history') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="task_id" value="<?= $id ?>">

                            <div class="form-group">
                                <label class="control-label"><?= $this->lang->line('work_description') ?> <span class="required">*</span></label>
                                <textarea class="form-control answer" rows="5" placeholder="<?= $this->lang->line('write_your_reply') ?>" name="answer" required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?= $this->lang->line('reference') ?></label>
                                <input type="text" placeholder="<?= $this->lang->line('reference_name') ?>" name="reference" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?= $this->lang->line('time_taken') ?></label>
                                <input type="text" placeholder="<?= $this->lang->line('how_much_time_take') ?>" name="time_taken" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?= $this->lang->line('upload_photo') ?></label>
                                <input type="file" name="photo" class="form-control upload">
                                <img id="blah" src="#" alt="your image" class="hide mt-2" width="40%">
                            </div>

                            <button type="submit" class="btn btn-primary btn-block mt-3">
                                <?= $this->lang->line('submit_your_answer') ?>
                            </button>
                        </form>
                    </div>

                    <!-- Right Table -->
                    <div class="col-lg-8">
                        <table class="table table-bordered table-striped" id="proposalList">
                            <thead>
                                <tr>
                                    <th><?= $this->lang->line('sr_no') ?></th>
                                    <th><?= $this->lang->line('work_description') ?></th>
                                    <th><?= $this->lang->line('reference') ?></th>
                                    <th><?= $this->lang->line('time_taken') ?></th>
                                    <th><?= $this->lang->line('document') ?></th>
                                    <th><?= $this->lang->line('followup_time') ?></th>
                                    <th><?= $this->lang->line('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach ($followups as $followup): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $followup['answer'] ?></td>
                                        <td><?= $followup['reference'] ?></td>
                                        <td><?= $followup['time_taken'] ?></td>
                                        <td>
                                            <?php if (!empty($followup['file_path'])): ?>
                                                <a href="<?= base_url('uploads/task_follow_up/'.$followup['file_path']) ?>" target="_blank">View</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d-M-Y H:i A', strtotime($followup['followup_time'])) ?></td>
                                        <td>
                                            <a class="avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#delete<?= $followup['id'] ?>">
                                                <i class="feather feather-trash"></i>
                                            </a>

                                           <!-- Delete Modal -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="delete<?= $followup['id'] ?>">
    <form method="post" action="<?= base_url('index.php/Dailytasks/deleteItem/'.$followup['id']) ?>">
        <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
            <h2 class="fs-16 fw-bold"><?= $this->lang->line('confirm') ?></h2>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body" style="margin-bottom: 80px;">
            <p><?= $this->lang->line('confirm_delete') ?> <b><?= $followup['reference'] ?></b>?</p>
        </div>

        <div class="offcanvas-footer px-4 py-3 border-top d-flex justify-content-between position-absolute bottom-0 w-100 bg-white">
            <button type="submit" class="btn btn-primary w-50"><?= $this->lang->line('yes') ?></button>
            <a href="javascript:void(0);" class="btn btn-danger w-50 ms-2" data-bs-dismiss="offcanvas"><?= $this->lang->line('cancel') ?></a>
        </div>
    </form>
</div>

                                        </td>
                                    </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.main-content -->
</div> <!-- /.nxl-content -->

<!-- Scripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script>
    $(document).ready(function () {
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah').removeClass('hide').addClass('show').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".upload").change(function () {
            let file = this.files[0];
            let size = parseInt(file["size"] / 1024);
            if (size > 5000) {
                alert('Image size exceeds 5MB. Please upload a smaller image.');
                $(this).val('');
                return;
            }
            readURL(this);
        });
    });
</script>
