
<?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Success!</h5>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
    <div class="alert alert-error alert-dismissible " >
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Alert!</h5>
            <?php echo $this->session->flashdata('failed'); ?>
        </div>
<?php endif; ?>
	  
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
                <li class="breadcrumb-item"><?= $this->lang->line('edit_attendance') ?>
                </li>
            </ul>
        </div>
  <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
               
            </div>

            <!-- Mobile Toggle -->
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
     <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-">
<form class="form-horizontal" role="form" method="post"
      action="<?php echo base_url(); ?>index.php/PayrollController/update_attendance">
    <input type="hidden" name="date" value="<?php echo $attendanceRecords[0]['date']; ?>">

   

          
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?= $this->lang->line('employee_name') ?></th>
                            <th><?= $this->lang->line('check_in') ?></th>
                            <th><?= $this->lang->line('check_out') ?></th>
                            <th><?= $this->lang->line('status') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($attendanceRecords as $record) { ?>
                        <tr>
                            <td><?php echo $record['emp_name'];  ?>
                            <input type="hidden" name="emp_id[<?php echo $record['id']; ?>]" value="<?php echo $record['emp_id'];  ?>"
                            class="form-control" readonly>
                        </td>
                            <td>
                                <input type="time" name="check_in[<?php echo $record['id']; ?>]" 
                                       value="<?php echo $record['check_in']; ?>" class="form-control">
                            </td>
                            <td>
                                <input type="time" name="check_out[<?php echo $record['id']; ?>]" 
                                       value="<?php echo $record['check_out']; ?>" class="form-control">
                            </td>
                            <td>
                                <select name="status[<?php echo $record['id']; ?>]" class="form-control">
                                    <option value="Present" <?php if($record['status'] == 'Present') echo 'selected'; ?>>Present</option>
                                    <option value="Absent" <?php if($record['status'] == 'Absent') echo 'selected'; ?>>Absent</option>
                                </select>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><?= $this->lang->line('update_attendance') ?></button>
            </div>
        </div>
    </div>
</form>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script>
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
</script>