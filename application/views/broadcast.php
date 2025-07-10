<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$role_id = $this->session->userdata['logged_in']['role_id'];

?>

<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Success!</h5>
    <?php echo $this->session->flashdata('success'); ?>
</div>
<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
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
            <h3 class="card-title"> <?= $title ?></h3>
            <div class="pull-right error_msg">
                <!-- <?php echo validation_errors();?> -->
                <?php if (isset($message_display)) {
				                      echo $message_display;
				                      } ?>
            </div>

        </div>

        <?php if(!empty($id)) { ?>
        <form class="form-horizontal" role="form" method="post"
            action="<?php echo base_url(); ?>index.php/Broadcast/editBroadcast/<?= $id ?>">
            <input type="hidden" name="broadcast_id" value="<?= $id?>">
            <?php } else { ?>
            <form class="form-horizontal" role="form" method="post"
                action="<?php echo base_url(); ?>index.php/Broadcast/add_broadcast">
                <?php } ?>

                <div class="card-body">

                    <?php if($role_id !='5') { ?>
                    <?php if(!empty($id)) { ?>
                    <form class="form-horizontal" role="form" method="post"
                        action="<?php echo base_url(); ?>index.php/Broadcast/editBroadcast/<?= $id ?>">
                        <input type="hidden" name="broadcast_id" value="<?= $id?>">
                        <?php } else { ?>
                        <form class="form-horizontal" role="form" method="post"
                            action="<?php echo base_url(); ?>index.php/Broadcast/add_broadcast">
                            <?php } ?>


                            <div class="row col-md-12">
                                <div class="col-md-4 col-sm-6 ">
                                    <label class="control-label"> Department <span class="required">*</span></label>
                                    <?php  
								            		echo form_dropdown('department_id', $departments,  $department_id,'','required="required"')
								            	?>
                                </div>
                                <div class="col-md-8 col-sm-8 ">
                                    <label class="control-label"> message <span class="required"> *</span></label>
                                    <textarea class="form-control message" rows="3" placeholder="Enter Message"
                                        name="message" value="<?= $message ?>"><?= $message ?></textarea>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label" style="visibility: hidden;"> Name</label><br>
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </div>
                            </div>
                            <?php } ?>
                        </form>
                        </br>
                        <hr>
                        <h5>Broadcast List</h5>
                        </br>

                        <div class="row col-md-12">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th> Sr.No.</th>
                                            <th> Message</th>
                                            <th> Department</th>
                                            <th>Date Time</th>
                                            <?php if($role_id !='5') { ?>
                                            <th> Action</th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1;foreach($broadcast as $broadcast) { ?>
                                        <tr>

                                            <td><?= $i ?></td>
                                            <td><?= $broadcast['message']?></td>


                                            <td><?php if(!empty($broadcast['department_id'])) { echo $broadcast['department_id'];} else { echo "All";}?>
                                            </td>
                                            <td>
                                                <p class="text-sm mt-2 mb-0">
                                                    <i class="fa fa-clock-o mr-1"></i>
                                                    <?php $timeAgo = strtotime($broadcast['date_time']);
                                                echo time_Ago($timeAgo); ?>
                                                </p>
                                                <!-- <?= $broadcast['date_time']?> -->
                                            </td>
                                            <?php if($role_id !='5') { ?>

                                            <td> <a class="btn btn-xs btn-info btnEdit"
                                                    href="<?php echo base_url(); ?>index.php/Broadcast/index/<?php echo $broadcast['id'];?>"><i
                                                        class="fa fa-edit"></i></a>
                                                <a class="btn btn-xs btn-info btnEdit" data-toggle="modal"
                                                    data-target="#view<?php echo $broadcast['id']; ?>"><i
                                                        style="color:#fff;" class="fa fa-eye"></i></a>
                                            </td>
                                            <div class="modal fade" id="view<?php echo $broadcast['id']; ?>" role="dialog">
                                                <div class="modal-dialog modal-lg">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"> Read Receiptants Report</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row"
                                                                style="border: 1px solid #f3ecec;
                                                                    height: 45px;
                                                                    padding: 10px;
                                                                    margin: 0px;
                                                                    margin-bottom: 6px; font-weight: 500;background-color: #f3f3f3;">
                                                                <div class="col-md-1">#</div>
                                                                <div class="col-md-3">User </div>
                                                                <div class="col-md-3">Time </div>
                                                            </div>
                                                                <?php
                                                                    $j = 1;
                                                                    foreach ($broadcast['read_details'] as $read_detail) {

                                                                    ?>
                                                                <div class="row"
                                                                style="border: 0px solid #f3ecec;height: 45px;padding: 10px;margin: 0px;margin-bottom: 6px;text-align: left;">
                                                                <div class="col-md-1"><?= $j; ?> </div>
                                                                <div class="col-md-3">
                                                                    <?= $read_detail['user_name']; ?> </div>
                                                                <div class="col-md-2">
                                                                    <p class="text-sm mt-2 mb-0"><i class="fa fa-clock-o mr-1"></i>
                                                                    <?php $timeAgo = strtotime($read_detail['read_at']);
                                                                    echo time_Ago($timeAgo); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <?php $j++;} ?>
                                                            <hr>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </tr>
                                        <?php $i++;} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>

    </div>
</div>



<script type="text/javascript">
$(document).ready(function() {
    jQuery('#master').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    jQuery('.delete_all').on('click', function(e) {
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).val());
        });
        //alert(allVals.length); return false;  
        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            WRN_PROFILE_DELETE = "Are you sure you want to delete  selected records?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Notifications/deleteNotification",
                    cache: false,
                    data: 'ids=' + join_selected_values,
                    success: function(response) {
                        $(".successs_mesg").html(response);
                        location.reload();
                    }
                });

            }
        }
    });


});
</script>