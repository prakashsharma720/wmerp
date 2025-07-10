<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
 
?>

<form class="form-horizontal" role="form" method="post"
    action="<?php echo base_url(); ?>index.php/PayrollController/add_attendance">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"> <?= $title ?></h3>
                <div class="pull-right error_msg">
                    <?php echo validation_errors();?>
                    <?php if (isset($message_display)) {
                                echo $message_display;
                                } ?>
                </div>
            </div>
            <!-- closed card-header -->
            <!-- card-body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <label class="control-label">Attendance Date</label>
                            <input type="date" name="date" class="form-control dateInput">

                        </div>
                        <div class="table-responsive">
                            <table width="100%" class="table table-bordered table-striped" id="sample_table1">
                                <thead width="100%">
                                    <tr width="100%">
                                        <th width="30%"> Employee </th>
                                        <th width="20%"> Check In</th>
                                        <th width="20%"> Check Out </th>
                                        <th width="20%"> Status </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;foreach($employees as $obj) { ?>
                                    <tr class="main_tr1">
                                        <td>
                                            <?php echo $obj['name']; ?>
                                            <input type="hidden" name="emp_id[]" value="<?php echo $obj['id']; ?>"
                                                class="form-control" readonly>
                                        </td>
                                        <!-- <td>
                                                <input type="date" name="date[]" class="form-control dateInput" readonly>

                                                </td> -->
                                        <td>
                                            <input type="time" name="check_in[]" id="" class="form-control" value="09:30">
                                        </td>
                                        <td>
                                            <input type="time" name="check_out[]" class="form-control" value="18:00">
                                        </td>
                                        <td>
                                            <select name="status[]" id="" class="form-control" required>
                                                <option value="">Select</option>
                                                <option value="Present">Present</option>
                                                <option value="Absent">Absent</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger deleterow" href="#"
                                                role='button'><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="col-md-12" width="100%">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <b>Save</b>
                                </button>
                            </div>
                        </div>
                        <!-- table-responsive -->
                    </div>
                    <br>
                  
                </div> <!-- card-body closed -->
            </div> <!-- card-outline closed -->
        </div> <!-- container-fluid -->
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



    document.addEventListener("DOMContentLoaded", function() {
    let today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

    // Select all elements with class 'dateInput' and set today's date
    document.querySelectorAll(".dateInput").forEach(function(input) {
        input.value = today;
    });
});
</script>