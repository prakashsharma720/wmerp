
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-check"></i> Success!</h5>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fa fa-exclamation-circle"></i> Alert!</h5>
        <?php echo $this->session->flashdata('failed'); ?>
    </div>
<?php endif; ?>


<div class="nxl-content">
   
    <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <!-- Left Side Form -->
                    <div class="col-lg-4">
                        <form class="form-horizontal" method="post"
                              action="<?php echo base_url(); ?>index.php/CustomerSupport_controller/add_followup"
                              enctype="multipart/form-data">

                            <input type="hidden" name="ticket" value="<?= $ticket ?>">
                            <input type="hidden" name="followup_by" value="<?= $login_id ?>">

                            <div class="form-group">
                                <label class="control-label"><span class="required"><?= $this->lang->line('add_reply') ?></span></label>
                                <textarea class="form-control answer" rows="5" placeholder="<?= $this->lang->line('write_your_reply') ?>"
                                          name="note" autofocus required></textarea>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?= $this->lang->line('attachment') ?></label>
                                <input type="file" name="attachment" class="form-control upload">
                                <img id="blah" src="#" alt="Your File" class="d-none mt-2" width="40%">
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('submit_answer') ?></button>
                            </div>
                        </form>
                    </div>

                    <!-- Right Side Table -->
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><?= $this->lang->line('sr_no') ?></th>
                                    <th><?= $this->lang->line('follow_up') ?></th>
                                    <th><?= $this->lang->line('document') ?></th>
                                    <th><?= $this->lang->line('date') ?></th>
                                    <th><?= $this->lang->line('action') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1; foreach($followups as $followup): ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $followup['answer'] ?></td>
                                        <td>
                                            <?php if(!empty($followup['file_path'])): ?>
                                                <a href="<?= base_url().'uploads/user_media/'.$followup['file_path']; ?>" target="_blank">View</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('d-M-Y h:i:s a', strtotime($followup['followup_time'])) ?></td>
                                        <td>
                                            <a class="avatar-text avatar-md text-danger" data-bs-toggle="offcanvas"
                                               data-bs-target="#delete<?= $followup['id']; ?>">
                                                <i class="feather feather-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Delete Confirmation Offcanvas -->
                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="delete<?= $followup['id']; ?>">
                                        <form method="post" action="<?= base_url(); ?>index.php/CustomerSupport_controller/deletefollowup/<?= $followup['id']; ?>">
                                            <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
                                                <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('confirm') ?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <p><?= $this->lang->line('confirm_delete') ?> <b><?= $followup['followups'] ?? 'this item'; ?></b>?</p>
                                            </div>
                                            <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
                                                <button type="submit" class="btn btn-primary w-50"><?= $this->lang->line('yes') ?></button>
                                                <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('cancel') ?></a>
                                            </div>
                                        </form>
                                    </div>
                                <?php $i++; endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?= base_url().'assets/plugins/jquery/jquery.min.js'; ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').removeClass('d-none').addClass('d-block').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".upload").change(function() {
            var file = this.files[0];
            var size = parseInt(file["size"] / 1024);
            var validTypes = ["image/jpeg", "image/png"];

            if ($.inArray(file.type, validTypes) < 0) {
                alert('Invalid file type! Please select JPG or PNG only.');
                $(this).val('');
                return;
            }

            if (size > 5000) {
                alert('Image size exceeds 5MB, please select a smaller file.');
                $(this).val('');
                return;
            }

            readURL(this);
        });
    });
</script>
