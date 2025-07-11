<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
 
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
<form class="form-horizontal" role="form" method="post"
    action="<?php echo base_url(); ?>index.php/PayrollController/add_attendance">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="card-title mb-0"> <?= $title ?></h3>
                        <h5 class="mb-0"> <?= $this->lang->line('total_employee') ?> <strong><?= $totalemployees;?></strong></h5>

                    </div>
                    <div class="col-md-5"></div>
                    <div class="col-md-3 pull-right">
                        <a href="<?php echo base_url(); ?>index.php/PayrollController/add/" class="btn btn-success"><i
                                class="fa fa-plus"></i> <?= $this->lang->line('add_employee') ?></a>
                    </div>
                </div>
                <div class="">


                </div>
            </div>
            <!-- closed card-header -->
            <!-- card-body -->
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 mt-4">
                        <div class="table-responsive">
                            <!-- Attendance Date List -->
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th><?= $this->lang->line('date') ?></th>
                                        <th><?= $this->lang->line('total_absent') ?></th>
                                        <th><?= $this->lang->line('total_present') ?></th>
                                        <th><?= $this->lang->line('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($AttendanceDates)) { foreach ($AttendanceDates as $obj) { ?>
                                    <tr>
                                        <td><?= date("d-m-Y", strtotime($obj['date'])); ?></td>
                                        <td><span class="badge badge-danger"><?= $obj['absent_count']?></span></td>
                                        <td><span class="badge badge-success"><?= $obj['present_count']?></span></td>
                                        <!-- Display formatted date -->
                                        <td class="d-flex ">
                                            <button style="color:white;margin-right:10px;" type="button"
                                                class="btn btn-md btn-warning btnViewAttendance"
                                                data-date="<?= $obj['date'] ?>" data-toggle="modal"
                                                data-target="#attendanceModal<?php echo $obj['id']?>">
                                                <i class="fa fa-eye"></i> <?= $this->lang->line('view') ?> </button>
                                            <a href="<?php echo base_url(); ?>index.php/PayrollController/edit/<?php echo $obj['date']; ?>" class="btn btn-md btn-primary"> <i class="fa fa-edit"></i> <?= $this->lang->line('edit') ?>  </a>
                                            <div class="modal fade" id="attendanceModal<?php echo $obj['id']?>"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="width:600px;">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Attendance Details for
                                                                <?= $obj['date'] ?><span id="modalDate"></span>
                                                            </h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th>S.No.</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Check-In</th>
                                                                        <th>Check-Out</th>
                                                                        <th>Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php foreach($obj['dateil'] as $index => $list) { ?>
                                                                    <tr>
                                                                        <td><?= $index+1;?></td>
                                                                        <td><?= $list['emp_name']?></td>
                                                                        <td><?= date('H:i A',strtotime($list['check_in']))?>
                                                                        </td>
                                                                        <td><?= date('H:i A',strtotime($list['check_out']))?>
                                                                        </td>
                                                                        <td>
                                                                            <?php if($list['status']=='Absent') {?>
                                                                            <span
                                                                                class="badge badge-danger"><?= $list['status'];?></span>
                                                                            <?php } else if($list['status']=='Present') {?>
                                                                            <span
                                                                                class="badge badge-success"><?= $list['status'];?></span>
                                                                            <?php }?>
                                                                        </td>


                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    <?php } } else { ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No Attendance Records</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>






                        </div>
                    </div>
                    <!-- Row -->
                </div> <!-- card-body closed -->
            </div> <!-- card-outline closed -->
        </div> <!-- container-fluid -->
</form>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('body').on('click', '.deleterow', function() {
        var table = $(this).closest('table');
        var rowCount = $("#sample_table1 tbody tr.main_tr1").length;
        // alert(rowCount);
        if (rowCount > 1) {
            if (confirm("Are you sure to remove row ?") == true) {
                $(this).closest("tr").remove();
                // rename_rows();
                // calculate_total(table);
            }
        }
    });
});



document.addEventListener("DOMContentLoaded", function() {
    let today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

    // Select all elements with class 'dateInput' and set today's date
    document.querySelectorAll(".dateInput").forEach(function(input) {
        input.value = today;
    });
});
</script>