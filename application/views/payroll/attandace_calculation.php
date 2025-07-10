<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
 
?>
<style>
.payslip-container {
    /* width: 500px; */
    margin: auto;
    border: 1px solid #000;
    padding: 20px;
    text-align: center;
}

.header {
    font-size: 18px;
    font-weight: bold;
    margin-bottom: 10px;
}

.address {
    text-align: left;
    border-left: 1px solid black;
}

/* td {
    width: 50%;
} */
.sub-header {
    font-size: 14px;
    margin-bottom: 20px;
}

.details,
.earnings,
.deductions {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
}

.details td,
.earnings td,
.deductions td {
    border: 1px solid #000;
    padding: 5px;
}

table {
    border: 1px solid black;
    text-align: left;
    font-size: 12px;
}

.totals {
    font-weight: bold;
}
</style>
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
            <div class="row">
                <div class="col-md-4">
                    <h3 class="card-title mb-0"> <?= $title ?></h3>

                </div>
                <div class="col-md-5"></div>

            </div>
            <div class="card-body">
                <form id="salaryForm">
                    <div class="row">


                        <div class="col-md-3">
                            <label class="control-label">Select Month</label>
                            <?php echo form_dropdown('month_id', $months, '', 'id="month_id" required="required" class="form-control"'); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Select Employee</label>
                            <?php echo form_dropdown('emp_id', $employees, '', 'id="emp_id" required="required" class="form-control"'); ?>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label"> </label>

                            <button type="submit" class="btn btn-primary btn-block">
                                <b>Calculate</b>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Display Results -->
                <div id="salaryResult"></div>
            </div>
            <div class="table-responsive" style="width:100%">
                <table id="example1" class="table table-bordered " style="width:100%">
                    <thead>
                        <tr>
                            <th> Sr.No.</th>
                            <th> Employee Name</th>
                            <th> Month</th>
                            <th> Payable Days</th>
                            <th> TDS</th>
                            <th> PF</th>
                            <th> Other Cuts</th>
                            <th> ECS</th>
                            <th> Total Salary</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!empty($salaries)) { 
                                $i=1;foreach($salaries as $obj) { ?>
                        <tr>
                            <td><?= $i ?></td>

                            <td><?= $obj['emp_name']?></td>
                            <td><?= $obj['month_name']?></td>
                            <td><?= $obj['payable_days']?></td>
                            <td><?= $obj['tds']?></td>
                            <td><?= $obj['pf']?></td>
                            <td><?= $obj['other_cuts']?></td>
                            <td><?= $obj['ecs']?></td>
                            <td><?= $obj['total_salary']?></td>
                            <td class="d-flex">
                                <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal"
                                    data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"
                                        class="fa fa-trash"></i> </a>
                                <a class="btn btn-xs btn-warning btnEdit" data-toggle="modal"
                                    data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"
                                        class="fa fa-eye"></i> </a>

                                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                                    <div class="modal-dialog">


                                        <!-- Modal content-->
                                        <div class="modal-content" style="width:800px;">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Pay Slip For <?= $obj['month_name']?>
                                                    <?= $obj['year']?></h4>
                                                <button type="button" class="btn btn-primary float-right"
                                                    onclick="downloadPayslip('payslip_<?= $obj['id'] ?>')">Download</button>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">

                                                <div id="payslip_<?= $obj['id'] ?>">
                                                    <div class="payslip-container">
                                                        <div class="row">
                                                            <div class="col-md-8"> <img class="float-left"
                                                                    src="<?php echo base_url() ;?>uploads/user_media/cropped.png"
                                                                    width="30%"></div>

                                                            <div class=" col-md-4 float-left address">MuskOwl LLP
                                                                </br>Pacific Hills, Debari,
                                                                Udaipur, Rajasthan, 313001 India
                                                                info@muskowl.com
                                                                www.muskowl.com
                                                                </br>
                                                                +91 9352842625
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <h4>Muskowl LLP</h4>
                                                        </div>
                                                        <div class="sub-header">Salary Slip for the Month of
                                                            <strong><?= $obj['month_name']?>
                                                                <?= $obj['year']?></strong>
                                                        </div>

                                                        <table class="details"
                                                            style="margin-bottom:30px !important;border-top:1px solid black !important">
                                                            <tr>
                                                                <td style="width:25%"><b>Employee ID :</b>
                                                                    <?= $obj['employee_code']?></td>
                                                                <td style="width:25%"><b>BankName :</b>
                                                                    <?= $obj['bank_name']?>
                                                                </td>
                                                                <td style="width:25%"><b>Gross Salary :</b>
                                                                    <?= $obj['total_net_salary']?>
                                                                </td>
                                                                <td style="width:25%"><b>Non Paid Leaves :</b>00</td>


                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b> Name : </b>
                                                                    <?=$obj['emp_name']?></td>
                                                                <td style="width:25%">
                                                                    <b>Branch Name : </b>
                                                                    <?=$obj['branch_name']?>
                                                                </td>
                                                                <td style="width:25%"><b>Net Salary :</b>
                                                                    <?= $obj['total_salary']?>
                                                                </td>
                                                                <td style="width:25%"><b> Paid Leaves :</b>00</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>Designation :</b>
                                                                    <?= $obj['designation_name']?> </td>

                                                                <td style="width:25%"><b>Account No. :</b>
                                                                    <?= $obj['account_number']?></td>
                                                                <td style="width:20%"><b>Total Month Days :</b>
                                                                    <?= $obj['total_days']?></td>
                                                                <td style="width:25%"></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>Department :</b>
                                                                    <?= $obj['department_name']?></td>
                                                                <td style="width:25%"><b>IFSC :</b>
                                                                    <?= $obj['ifsc_code']?></td>
                                                                <td style="width:25%"></td>
                                                                <td style="width:25%"></td>


                                                            </tr>
                                                            <tr>
                                                                <?php
                                                                $month_name=$obj['month_name'];
                                                                // Create a DateTime object using the month
                                                                $date = DateTime::createFromFormat('F', $month_name);

                                                                // Add 1 month to it
                                                                $date->modify('+1 month');

                                                                // Get the next month name
                                                                $next_month = $date->format('F');
                                                                ?>
                                                                <td style="width:25%"><b>Processing Month :</b>
                                                                    <?= $next_month?>
                                                                    <?= $obj['year']?></td>
                                                                <td style="width:25%"><b>PAN No. :</b>
                                                                    <?= $obj['pan_no']?></td>
                                                                <td style="width:25%"></td>
                                                                <td style="width:25%"></td>


                                                            </tr>
                                                        </table>

                                                        <table class="details"
                                                            style="margin-bottom:30px !important;border-top:1px solid black !important">
                                                            <tr>
                                                                <td style="width:50%"><b>Gross Wages :</b> &#8377;
                                                                    <?= $obj['gross_salary']?> </td>
                                                                <td style="width:50%"><b>Leaves :</b>
                                                                    <?= $obj['absent_days']?></td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:50%"><b>Total Working Days :</b>
                                                                    <?= $obj['total_days']?></td>
                                                                <td style="width:50%"><b>Paid Days :</b>
                                                                    <?= $obj['payable_days']?></td>

                                                            </tr>


                                                        </table>

                                                        <table class="earnings"
                                                            style="margin-bottom:30px !important;border-top:1px solid black !important">
                                                            <tr>
                                                                <td colspan="2"
                                                                    style="text-align:center !important;border-bottom:1px solid black;">
                                                                    <b>Earnings</b>
                                                                </td>
                                                                <td colspan="2"
                                                                    style="text-align:center !important;border-bottom:1px solid black;">
                                                                    <b>Deducation</b>
                                                                </td>

                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>Basic :</b> </td>
                                                                <td style="width:25%">&#8377;<?= $obj['salary']?></td>
                                                                <td style="width:25%"><b>TDS :</b></td>
                                                                <td style="width:25%">&#8377;
                                                                    <?= $obj['tds']?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>HRA :</b>
                                                                </td>
                                                                <td style="width:25%"> &#8377;
                                                                    <?= $obj['hra']?>
                                                                </td>
                                                                <td style="width:25%"><b>PF :</b>
                                                                </td>

                                                                <td style="width:25%">&#8377;
                                                                    <?= $obj['pf']?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b> Medical Allowance :</b>
                                                                </td>
                                                                <td style="width:25%"> &#8377; <?= $obj['m_allowance']?>
                                                                </td>

                                                                <td style="width:25%"><b>ECS :</b> </td>
                                                                <td style="width:25%">&#8377; <?= $obj['ecs']?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>Other Allowances :</b> </td>
                                                                <td style="width:25%">&#8377; <?= $obj['o_allowance']?>
                                                                </td>

                                                                <td style="width:25%"><b>Other Cuts :</b></td>
                                                                <td style="width:25%">&#8377;<?= $obj['other_cuts']?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>Conveyance Allowance :</b>
                                                                </td>
                                                                <td style="width:25%"> &#8377; <?= $obj['c_allowance']?>
                                                                </td>
                                                                <?php 
                                                            $total_deduction = (float)$obj['tds'] + (float)$obj['pf'] + (float)$obj['ecs'] + (float)$obj['other_cuts'];
                                                            ?>
                                                                <td style="width:25%"><b>Total Deduction :</b></td>
                                                                <td style="width:25%"><b>&#8377;
                                                                        <?= number_format($total_deduction, 2) ?></b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width:25%"><b>Total Earning :</b> </td>
                                                                <td style="width:25%"><b>&#8377;
                                                                        <?= $obj['total_net_salary']?></b></td>
                                                                <td style="width:25%"></td>
                                                                <td style="width:25%"></td>



                                                            </tr>
                                                        </table>

                                                        <table class="deductions"
                                                            style="margin-bottom:30px !important;border-top:1px solid black !important">
                                                            <tr>
                                                                <td colspan="3" style="text-align:center !important;">
                                                                    <b>Net Payment:</b>
                                                                </td>
                                                                <td colspna=" " style="text-align:center !important;">
                                                                    <b> &#8377; <?= $obj['total_salary']?></b>
                                                                </td>

                                                            </tr>

                                                        </table>



                                                        <div class="row mt-4" style="margin-top:70px !important;">
                                                            <div class="col-md-8">
                                                                <h6 style="font-size:14px;">*Net salary payable also
                                                                    subject to deductions as per Income Tax Law</h6>
                                                            </div>
                                                            <div class="col-md-4 float-right">
                                                                <h5>For Musk Owl LLP</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4" style="margin-top:70px !important;">
                                                            <div class="col-md-8">
                                                               
                                                            </div>
                                                            <div class="col-md-4 float-right">
                                                                <h6>  Authorized Signatory </h6>
                                                            </div>
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary delete_submit"> Yes
                                                </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    No
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </td>
                            <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" role="form" method="post"
                                        action="<?php echo base_url(); ?>index.php/PayrollController/deleteItem/<?php echo $obj['id'];?>">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirm Header </h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure, you want to delete Salary Record of
                                                    <b><?php echo $obj['emp_name'];?> </b>?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary delete_submit"> Yes
                                                </button>

                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Cancel
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </tr>
                        <?php  $i++;} }else{ ?>
                        <tr>
                            <td colspan="100">
                                <h5 style="text-align: center;"> No Leads Found</h5>
                            </td>
                        </tr>
                        <?php  }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div> <!-- container-fluid -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<!-- Display Results -->
<script>
$(document).ready(function() {
    // Fetch and calculate salary
    $("#salaryForm").submit(function(e) {
        e.preventDefault();
        let month_id = $("#month_id").val();
        let emp_id = $("#emp_id").val();

        $.ajax({
            url: "<?= base_url('index.php/PayrollController/calculate_salary') ?>",
            type: "POST",
            data: {
                month_id: month_id,
                emp_id: emp_id
            },
            success: function(response) {
                $("#salaryResult").html(response);
            }
        });
    });

    function calculateGrossSalary() {
        let payableDays = parseFloat($("#payable_days").val()) || 0;
        let basicSalary = parseFloat($("#basic_salary").val()) || 0;
        let totalDays = parseInt($("#total_days").val()) || 30;

        // Gross Salary Calculation
        let salaryPerDay = basicSalary / totalDays;
        let grossSalary = salaryPerDay * payableDays;
        grossSalary = parseFloat(grossSalary.toFixed(2));

        $("#gross_salary").val(grossSalary);
        calculateFinalSalary();
    }

    function calculateFinalSalary() {
        let grossSalary = parseFloat($("#gross_salary").val()) || 0;
        let tds = parseFloat($("#tds").val()) || 0;
        let pf = parseFloat($("#pf").val()) || 0;
        let ecs = parseFloat($("#ecs").val()) || 0;
        let otherCuts = parseFloat($("#other_cuts").val()) || 0;

        // Final Salary Calculation
        let totalDeductions = tds + pf + ecs + otherCuts;
        let finalSalary = grossSalary - totalDeductions;
        finalSalary = parseFloat(finalSalary.toFixed(2));

        $("#final_salary").val(finalSalary);
    }

    // Payable Days affects only Gross Salary
    $(document).on("input", "#payable_days", function() {
        calculateGrossSalary();
    });

    // Deduction inputs affect only Final Salary
    $(document).on("input", "#tds, #pf, #ecs, #other_cuts", function() {
        calculateFinalSalary();
    });

    // Prevent entering more than total days
    $("#payable_days").on("change", function() {
        let totalDays = parseInt($("#total_days").val()) || 30;
        let enteredDays = parseInt($(this).val()) || 0;

        if (enteredDays > totalDays) {
            alert("Payable days cannot exceed total days in the month!");
            $(this).val(totalDays);
        }
        calculateGrossSalary();
    });

    // Save salary after editing
    $(document).on("click", "#saveSalary", function() {
        var emp_id = $("#emp_id").val();
        var month_id = $("#month_id").val();
        var total_days = $("#total_days").val();
        var payable_days = $("#payable_days").val();
        var absent_days = $("#absent_days").val();
        var gross_salary = $("#gross_salary").val();
        var tds = $("#tds").val();
        var pf = $("#pf").val();
        var other_cuts = $("#other_cuts").val();
        var ecs = $("#ecs").val();
        var total_salary = $("#final_salary").val();

        $.ajax({
            url: "<?= base_url('index.php/PayrollController/save_salary') ?>",
            type: "POST",
            data: {
                emp_id: emp_id,
                month_id: month_id,
                total_days: total_days,
                payable_days: payable_days,
                absent_days: absent_days,
                gross_salary: gross_salary,
                tds: tds,
                pf: pf,
                other_cuts: other_cuts,
                ecs: ecs,
                total_salary: total_salary
            },
            success: function(response) {
                alert("Salary saved successfully!");
                window.location.href =
                    "<?= base_url('index.php/PayrollController/show_calculation') ?>";
            }
        });
    });
});
</script>

<script>
function downloadPayslip(containerId) {
    const element = document.getElementById(containerId);

    html2canvas(element).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jspdf.jsPDF('p', 'pt', 'a4');
        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save(containerId + '.pdf');
    });
}
</script>