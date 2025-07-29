
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/PayrollController/index'); ?>"><?= $this->lang->line('payroll_module') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('attendance_list') ?>
                </li>
                <!-- <h5 class="mb-0"> <?= $this->lang->line('total_employee') ?> <strong><?= $totalemployees;?></strong></h5> -->

            </ul>
            
        </div>
         <div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>
        
  <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>
        <div class="page-header-right ms-auto">
            <a href="<?php echo base_url(); ?>index.php/PayrollController/add/" class="btn btn-icon btn-light-brand"><i
            class="feather feather-plus"></i> <?= $this->lang->line('add_employee') ?></a>

            <!-- Mobile Toggle -->
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
</div>
     <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
<div class="table-responsive">
                            <!-- Attendance Date List -->
                <table class="table table-hover  table-bordered table-striped" id="proposalList">
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
                                            <button  
                                        
                                                class="btn btn-icon avatar-text avatar-md"
                                                data-date="<?= $obj['date'] ?>" data-toggle="modal"
                                                data-target="#attendanceModal<?php echo $obj['id']?>">
                                                <i class="fa fa-eye"></i> </button>
                                            <a href="<?php echo base_url(); ?>index.php/PayrollController/edit/<?php echo $obj['date']; ?>" class="btn btn-icon avatar-text avatar-md"> <i class="feather feather-edit-3"></i>  </a>
                                            <div class="modal fade" id="attendanceModal<?php echo $obj['id']?>"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content" style="width:600px;">
                                                        <div class="modal-header">
                                                               <h4> <?= $obj['date'] ?><span id="modalDate"></span></h4>
                                                                                                                            <h4 class="modal-title"><?= $this->lang->line('attendance_details_for') ?>

                                                            </h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th><?= $this->lang->line('sr_no') ?></th>
                                                                        <th><?= $this->lang->line('employee_name') ?></th>
                                                                        <th><?= $this->lang->line('check_in') ?></th>
                                                                        <th><?= $this->lang->line('check_out') ?></th>
                                                                        <th><?= $this->lang->line('status') ?></th>
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
                                                                data-dismiss="modal"><?= $this->lang->line('close') ?></button>
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
                            </table>                </div>
            </div>
        </div>
    </div>
</div>

</div>
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