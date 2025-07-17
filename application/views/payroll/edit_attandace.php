<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
 
?>

<form class="form-horizontal" role="form" method="post"
      action="<?php echo base_url(); ?>index.php/PayrollController/update_attendance">
    <input type="hidden" name="date" value="<?php echo $attendanceRecords[0]['date']; ?>">

    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title mb-0"><?= $this->lang->line('edit_attendance') ?></h3>
            </div>

            <div class="card-body">
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
</form>

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