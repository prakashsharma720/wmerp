<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
.select2 {
    height: 35px !important;
    width: 100% !important;
}

.btnEdit {
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
}

.timeline-header {
    border-bottom: none !important;
}

.timeline-item {
    background: none !important;
}

.card-footer {
    border-top: none !important;
    background: none !important;
}

.note-wrapper {
    max-width: 600px;
    margin: 0 auto;
}

.note-label {
    font-weight: bold;
    margin-bottom: 8px;
}

.note-box {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 12px;
    display: flex;
    flex-direction: column;
    /* background-color: #f9f9f9; */
}

.note-textarea {
    width: 100%;
    height: 100px;
    border: none;
    resize: none;
    font-size: 14px;
    background-color: transparent;
    outline: none;
}

.note-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.note-icons {
    display: flex;
    gap: 10px;
}

.note-icons label {
    cursor: pointer;
    font-size: 18px;
}

.note-icons input[type="file"] {
    display: none;
}
</style>

<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?>!</h5>
    <?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
<div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
</div>
<?php endif; ?>

<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <span> <?= $this->lang->line('ticket_id') ?> :</span><span class="card-title"> <b> <?= $customer_data['ticket'] ?> </b></span>
            <div class="pull-right">

            </div>
        </div> <!-- /.card-header -->
        <div class="card-body">
            <div class="tab-pane active show" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <li>
                        <i class="fa fa-plus" aria-hidden="true"></i>

                        <div class="timeline-item" style="background:none !important;border:none;">
                            <span class="time"><i class="fa fa-clock-o"></i>
                                <?= $customer_data['created_at'] ?>
                            </span>

                            <h3 class="timeline-header"><span><?= $this->lang->line('ticket_raised_by') ?><span
                                        style="color:red;"><?= $customer_data['c_name'] ?></span></span></h3>

                            <div class="timeline-body ">

                                <?= $customer_data['description'] ?>

                                <?php if(!empty($customer_data['photo'] )) {?>
                                <div class=" pull-right">
                                    <a href="<?php echo base_url().'uploads/user_media/'.$customer_data['photo'] ;?>"
                                        target="_blank" class="pull-right" download="download">
                                        <i class="fa fa-paperclip" aria-hidden="true" style="font-size:24px"></i>
                                    </a>

                                </div>
                                <?php }?>
                            </div>


                        </div>
                    </li>
                    <li>
                        <i class="fa fa-phone bg-warning"></i>
                        <div class="timeline-item" style="background:none !important">
                            <?php $i=1;foreach($followups as $followup) { ?>

                            <span class="time"></span>
                            <div class="card-footer card-comments" style="background:none !important;">
                                <div class="card-comment">
                                    <!-- User image -->
                                    <img class="img-circle img-sm"
                                        src="<?php echo base_url() ;?>uploads/user_media/images.png" alt="User Image">
                                    <div class="comment-text">

                                        <span class="username">
                                            Reply by
                                            <?php if(!empty($followup['followup_by'])) { ?>
                                            Company <?php } else {?>
                                            <span>Customer</span>
                                            <?php } ?>
                                            <span class="text-muted float-right"><i class="fa fa-clock-o"></i>
                                                <?= $followup['followup_time']?></span>
                                        </span><!-- /.username -->
                                        <span style="font-size:14px;"> <?= $followup['answer']?></span>
                                        <?php if(!empty($followup['file_path'])) {?>
                                        <div class="col-md-4 pull-right">
                                            <a href="<?php echo base_url().'uploads/user_media/'.$followup['file_path'];?>"
                                                target="_blank" class="pull-right" download="download">
                                                <i class="fa fa-paperclip" aria-hidden="true"
                                                    style="font-size:24px !important"></i>

                                            </a>

                                        </div>
                                        <?php }?>
                                    </div>
                                    <!-- /.comment-text -->
                                </div>

                            </div>




                            <?php $i++;} ?>

                        </div>
                    </li>
                    <?php if($customer_data['status']=='Closed'){?>

                    <li>
                        <i class="fa fa-file bg-info">

                        </i>

                        <div class="timeline-item" style="border:none !important">
                            <span class="time"><i class="fa fa-clock-o"> <?= $customer_data['closed_date']?></i>
                                <?= $customer_data['status'] ?>
                            </span>

                            <h3 class="timeline-header">Ticket <span style="color:red;">
                                    <?= $customer_data['status']?><span style="color:red;"></span></span></h3>


                            <!-- <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div> -->
                        </div>
                    </li>
                    <?php }?>
                    <?php if($customer_data['status']=='Resolved'){?>
                    <li>
                        <i class="fa fa-file bg-info">

                        </i>

                        <div class="timeline-item" style="border:none !important">
                            <span class="time"><i class="fa fa-clock-o"><?= $customer_data['resolved_date']?> </i>
                                <?= $customer_data['status'] ?>
                            </span>

                            <h3 class="timeline-header">Ticket <span style="color:red;">
                                    <?= $customer_data['status']?><span style="color:red;"></span></span></h3>


                            <!-- <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div> -->
                        </div>
                    </li>
                    <?php }?>


                    <li>
                        <i class="fa fa-check bg-gray"></i>
                    </li>
                </ul>

                <br>
                <?php if($customer_data['status']!=='Closed' && $customer_data['status']!=='Resolved') {?>
                <div class="card-footer">
                  Add Reply
                    <form class="form-horizontal" role="form" method="post"
                        action="<?php echo base_url(); ?>index.php/CustomerSupport_controller/add_followup"
                        enctype="multipart/form-data">

                        <input type="hidden" name="ticket" value="<?= $customer_data['ticket'] ?>">
                        <input type="hidden" name="customer_id" value="<?= $login_id?>">
                        <!-- .img-push is used to add margin to elements next to floating images -->
                        <div class="img-push">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <label class="control-label"> Add Reply </label>
                                    <textarea class="form-control answer" rows="1" placeholder="Write Your Reply"
                                        name="answer" autofocus required></textarea> -->

                                    <div class="note-box">
                                        <textarea class="note-textarea form-control" name="note"
                                            placeholder="Add Reply..."></textarea>

                                        <div class="note-actions">
                                            <div class="note-icons">


                                                <label for="attachmentInput" title="Attach file">  <i class="fa fa-paperclip" aria-hidden="true"
                                                    style="font-size:24px !important"></i> <?= $this->lang->line('add_attachment') ?></label>
                                                <input type="file" class="form-control" name="attachment"
                                                    id="attachmentInput">
                                            </div>

                                           
                                        </div>
										 
                                    </div>
									<div class="d-grid gap-2 col-3">
										 <button type="submit" class="btn btn-outline-primary"><?= $this->lang->line('submit') ?></button>


</div>
									
                                    <!-- <div class="col-md-4">
                                          <label class="control-label"> Attachement</label>
                                          <input type="file" name="photo" class="form-control upload">

                                          <img id="blah" src="#" alt="Your File" class="hide" width="40%">
                                        </div> -->
                                    <!-- <div class="col-md-2">
                                              <label class="control-label" style="visibility: hidden;"> Name</label><br>

                                              <button type="submit" class="btn btn-primary"> Submit </button>
                                          </div> -->

                                </div>
                                <div class=" pull-right">

                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <?php }?>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#blah').removeClass('hide');
                $('#blah').addClass('show');
                $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".upload").change(function() {
        var file = this.files[0];
        // var fileType = file["type"];
        var size = parseInt(file["size"] / 1024);
        // var validImageTypes = ["*"];
        // if ($.inArray(fileType, validImageTypes) < 0) 
        // {
        //     alert('Invalid file type , please select jpg/png file only !');
        //     $(this).val(''); 
        // }
        if (size > 5000) {
            alert('Image size exceed , please select < 5MB file only !');
            $(this).val('');
        }
        readURL(this);
    });

});
</script>
