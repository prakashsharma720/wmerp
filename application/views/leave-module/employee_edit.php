<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
.select2 {
    height: 45px !important;
    width: 100% !important;
}

.card .progress {
    margin-bottom: 0;
}

.btnEdit {
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
}

@keyframes growProgressBar {

    0%,
    33% {
        --pgPercentage: 0;
    }

    100% {
        --pgPercentage: var(--value);
    }
}

@property --pgPercentage {
    syntax: '<number>';
    inherits: false;
    initial-value: 0;
}

div[role="progressbar"] {
    --size: 12rem;
    --bg: #def;
    --pgPercentage: var(--value);
    animation: growProgressBar 3s 1 forwards;
    width: 120px;
    height: 118px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background:
        radial-gradient(closest-side, white 80%, transparent 0 99.9%, white 0),
        conic-gradient(var(--fg) calc(var(--pgPercentage) * 1%), var(--bg) 0);
    font-family: Helvetica, Arial, sans-serif;
    font-size: 14px;
    color: var(--fg);
    text-align: center;
}

div[role="progressbar"]::before {
    counter-reset: percentage var(--value);
    content: counter(percentage) '%';
}

img.profile-user-img.img-fluid.img-circle {
    position: absolute;
    top: 7%;
    left: 32%;
}

.top-progress-bar {
    width: 100%;
    height: 25px;
    background-color: #e9ecef;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    overflow: hidden;
    position: relative;
}

.top-progress-fill {
    background-color: #007bff;
    height: 100%;
    width: 50%; /* Set dynamically if needed */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-weight: 500;
    transition: width 0.5s ease;
}

.progress-text {
    white-space: nowrap;
    font-size: 14px;
}
.control-label {
    margin: 0.7rem;
}

</style>
<div class="container-fluid">
    <div class="">
        <div class="card-header">
        <div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('employee') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('edit') ?>
                </li>
            </ul>
        </div>
        </div>
        </div>

            <div class="pull-right ">

            </div>
        </div> <!-- /.card-body -->
    <br>

        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal " role="form" method="post"
                    action="<?php echo base_url(); ?>index.php/Employees/editemployee/<?= $id ?>"
                    enctype="multipart/form-data">
                    <input type="hidden" name="employee_code" value="<?php echo $emp_code;?>" required>
                    <input type="hidden" name="employees_id" value="<?= $id?>">
                    <div class="card">
                        <!-- Custom Progress Bar with Text -->
                        
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" style="margin-bottom: -8px;">
                                <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab" style="border-radius: 0px;color:#424747;"><?= $this->lang->line('personal_details') ?></a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab" style="border-radius: 0px;color:#424747;"><?= $this->lang->line('bank_details') ?></a>
                                </li>
                                <li class="nav-item"><a class="nav-link " href="#salary" data-toggle="tab" style="border-radius: 0px;color:#424747;"><?= $this->lang->line('salary_details') ?></a>
                                </li>
                                <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab" style="border-radius: 0px;color:#424747;"><?= $this->lang->line('other_details') ?></a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="activity">

                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('name') ?> <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="<?= $this->lang->line('enter_employee_name') ?>" name="name"
                                                    class="form-control" required autofocus value="<?= $name?>">
                                            </div>

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('email') ?> <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="<?= $this->lang->line('enter_email') ?>" name="email"
                                                    class="form-control email" value="<?= $email?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('role') ?> <span
                                                        class="required">*</span></label>
                                                <?php  
						            		echo form_dropdown('role_id', $roles,$role_id)
						            	?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('mobile_no') ?> <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="<?= $this->lang->line('enter_mobile_no') ?>" name="mobile_no"
                                                    class="form-control mobile" minlenght="10" maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                    value="<?= $mobile_no?>" required autofocus>
                                            </div>

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('department') ?> <span
                                                        class="required">*</span></label>
                                                <?php  
						            		echo form_dropdown('department_id', $departments, $department_id)
						            	?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('designation') ?> <span
                                                        class="required">*</span></label>
                                                <?php  
						            		echo form_dropdown('designation_id', $designations, $designation_id)
						            	?>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label class="control-label"> <?= $this->lang->line('date_of_joining') ?> </label>
                                                <input type="text" data-date-formate="dd-mm-yyyy" name="doj"
                                                    class="form-control date-picker"
                                                    value="<?php echo $date_of_joining?>" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"
                                                    autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label class="control-label"> <?= $this->lang->line('date_of_birth') ?> </label>
                                                <input type="text" data-date-formate="dd-mm-yyyy" name="dob"
                                                    class="form-control date-picker" value="<?php echo $dob?>"
                                                    placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>" autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('username') ?> <span class="required">*</span>
                                                </label>
                                                <input type="text" placeholder="<?= $this->lang->line('username') ?>" name="username"
                                                    class="form-control" value="<?= $username?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Select <?= $this->lang->line('authority_person') ?> <span
                                                        class="required">*</span></label>
                                                <?php  
						            		        echo form_dropdown('author_id', $employees, $author_id)
						            	        ?>
                                            </div>


                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('aadhaar_no') ?> <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="<?= $this->lang->line('enter_aadhaar_no') ?>" name="aadhaar_no"
                                                    class="form-control aadhaar_no" minlenght="12" maxlength="12"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                    value="<?= $aadhaar_no?>" autofocus required>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <b> <?= $this->lang->line('pan_no') ?> </b> 
                                                <input type="text" placeholder="<?= $this->lang->line('pan_no') ?>" name="pan_no"
                                                    class="form-control pan_no" value="<?= $pan_no?>" autofocus
                                                    maxlength="10" minlength="10" style="text-transform: uppercase;">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('daily_target') ?> <span class="required">
                                                        *</span></label>
                                                <input class="form-control"
                                                    placeholder="<?= $this->lang->line('enter_zero_if_not_applicable') ?>" name="target" value="<?= $target ?>"
                                                    required />
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('address') ?> <span class="required">
                                                        *</span></label>
                                                <textarea class="form-control address" rows="3"
                                                    placeholder="<?= $this->lang->line('enter_address') ?> " name="address" value="<?= $address ?>"
                                                    requireds><?= $address ?></textarea>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('upload_photo') ?> </label>
                                                <input type="file" name="photo" class="form-control upload" autofocus>

                                                <?php if(!empty($photo)) { ?>
                                                <img id="blah" src="<?php echo base_url().$photo; ?>" alt="your image"
                                                    width="40%" />
                                                <input type="hidden" name="old_image" value="<?= $photo ?>">
                                                <?php } else { ?>
                                                <img id="blah" src="#" alt="your image" class="hide" width="40%" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('account_holder_name') ?><span
                                                        class="required">*</span></label>
                                                <input type="text" name="account_holder_name" class="form-control "
                                                    value="<?= $account_holder_name; ?>"
                                                    placeholder="<?= $this->lang->line('account_holder_name') ?> " autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('bank_name') ?><span
                                                        class="required">*</span></label>
                                                <input type="text" name="bank_name" class="form-control "
                                                    value="<?= $bank_name; ?>" placeholder="<?= $this->lang->line('bank_name') ?> " autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('account_number') ?><span
                                                        class="required">*</span></label>
                                                <input type="text" name="account_number" class="form-control "
                                                    value="<?= $account_number; ?>" placeholder="<?= $this->lang->line('account_number') ?> "
                                                    autofocus>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('ifsc') ?><span
                                                        class="required">*</span></label>
                                                <input type="text" name="ifsc_code" class="form-control "
                                                    value="<?= $ifsc_code; ?>" placeholder="<?= $this->lang->line('ifsc') ?>" autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('branch_name') ?><span
                                                        class="required">*</span></label>
                                                <input type="text" name="branch_name" class="form-control"
                                                    value="<?= $branch_name; ?>" placeholder="<?= $this->lang->line('branch_name') ?>" autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('account_type') ?><span
                                                        class="required">*</span></label>
                                                <select name="account_type" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="savings"
                                                        <?= ($account_type == 'savings') ? 'selected' : ''; ?>>
                                                        Savings</option>
                                                    <option value="current"
                                                        <?= ($account_type == 'current') ? 'selected' : ''; ?>>
                                                        Current</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('upi_id') ?></label>
                                                <input type="text" name="upi_id" class="form-control "
                                                    value="<?= $upi_id?>" placeholder="<?= $this->lang->line('upi_id') ?>" autofocus>

                                            </div>

                                        </div>
                                    </div>



                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="salary">
                                   <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('basic_salary') ?><span class="required">*</span></label>
                                                <input type="text" id="basic_salary" name="salary" class="form-control" value="<?= $salary ?>" placeholder="<?= $this->lang->line('basic_salary') ?>" oninput="calculateTotal()" autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('hra') ?></label>
                                                <input type="text" id="hra" name="hra" class="form-control" value="<?= $hra ?>" placeholder="<?= $this->lang->line('hra') ?>" oninput="calculateTotal()">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('conveyance_allowance') ?></label>
                                                <input type="text" id="c_allowance" name="c_allowance" class="form-control" value="<?= $c_allowance ?>" placeholder="<?= $this->lang->line('conveyance_allowance') ?>" oninput="calculateTotal()">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('medical_allowance') ?></label>
                                                <input type="text" id="m_allowance" name="m_allowance" class="form-control" value="<?= $m_allowance ?>" placeholder="<?= $this->lang->line('medical_allowance') ?>" oninput="calculateTotal()">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('other_allowance') ?></label>
                                                <input type="text" id="o_allowance" name="o_allowance" class="form-control" value="<?= $o_allowance ?>" placeholder="<?= $this->lang->line('other_allowance') ?>" oninput="calculateTotal()">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('total_net_salary') ?></label>
                                                <input type="text" id="total_net_salary" name="total_net_salary" class="form-control" value="<?= $total_net_salary ?>" placeholder="<?= $this->lang->line('total_net_salary') ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane " id="settings">
                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"><?= $this->lang->line('emergency_mobile_no') ?> <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="<?= $this->lang->line('emergency_mobile_no') ?>"
                                                    name="emobile_no" class="form-control mobile" minlenght="10"
                                                    maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                    value="<?= $emobile_no?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('emergency_name') ?> <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="<?= $this->lang->line('emergency_name') ?>" name="ename"
                                                    class="form-control" value="<?= $ename?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('uan_no') ?> </label>
                                                <input type="text" placeholder="<?= $this->lang->line('uan_no') ?> " name="uan"
                                                    class="form-control" value="<?= $uan?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('pf_no') ?> </label>
                                                <input type="text" placeholder="<?= $this->lang->line('pf_no') ?>" name="pf"
                                                    class="form-control" value="<?= $pf?>" autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> <?= $this->lang->line('esi_no') ?></label>
                                                <input type="text" placeholder=" <?= $this->lang->line('esi_no') ?>" name="esi"
                                                    class="form-control" value="<?= $esi?>" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="row col-md-12">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="control-label" style="visibility: hidden;"> Name</label><br>
                                        <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('update') ?></button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                </form>
            </div>

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
        var fileType = file["type"];
        var size = parseInt(file["size"] / 1024);
        //alert(size);
        var validImageTypes = ["image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            alert('Invalid file type , please select jpg/png file only !');
            $(this).val('');
        }
        if (size > 5000) {
            alert('Image size exceed , please select < 5 MB file only !');
            $(this).val('');
        }

        readURL(this);
    });
    var medical_status = $("input[name='medical_status']:checked").val();
    if (medical_status == 'Yes') {
        $(".report_div").css('visibility', 'visible');
        $(".report_no").attr('required', 'required');
    } else {
        $(".report_div").css('visibility', 'hidden');
        $(".report_no").removeAttr('required');
    }

    $("input[type='radio']").click(function() {
        var medical_status = $("input[name='medical_status']:checked").val();
        if (medical_status == 'Yes') {
            $(".report_div").css('visibility', 'visible');
            $(".report_no").attr('required', 'required');
        } else {
            $(".report_div").css('visibility', 'hidden');
            $(".report_no").removeAttr('required');
        }
    });

});
</script>
<script>
function calculateProfileCompletion() {
    const fields = [
        // Personal Details
        'name', 'email', 'role_id', 'mobile_no','doj', 'dob',
        'username', 'aadhaar_no', 'pan_no', 'address','designation_id','department_id',

        // Bank Details
        'account_holder_name', 'bank_name', 'account_number', 'ifsc_code',
        'branch_name', 'account_type', 'upi_id',

        // Salary Details
        'salary', 'hra', 'c_allowance','total_net_salary',

        // Other Details (Settings)
        'emobile_no', 'ename', 'uan', 'pf', 'esi','old_image'
    ];

    let filled = 0;

    fields.forEach(name => {
        const field = document.querySelector(`[name="${name}"]`);
        if (field) {
            if (field.tagName === 'SELECT') {
                if (field.value && field.value !== '') filled++;
            } else {
                if (field.value.trim() !== '') filled++;
            }
        }
    });

    const total = fields.length;
    console.log('total:'+total);
    console.log('filled:'+filled);
    const percent = Math.round((filled / total) * 100);
    setProgress(percent);
}

function setProgress(percent) {
    const fill = document.querySelector('.top-progress-fill');
    const text = document.querySelector('.progress-text');
    fill.style.width = percent + '%';
    text.textContent = `Profile Complete: ${percent}%`;
}

// Run on page load
document.addEventListener('DOMContentLoaded', calculateProfileCompletion);

// Run when any field changes
/* document.querySelectorAll('input, select, textarea').forEach(el => {
    el.addEventListener('input', calculateProfileCompletion);
    el.addEventListener('change', calculateProfileCompletion);
}); */
</script>
<script>
function calculateTotal() {
    const salary = parseFloat(document.getElementById('basic_salary').value) || 0;
    const hra = parseFloat(document.getElementById('hra').value) || 0;
    const c_allowance = parseFloat(document.getElementById('c_allowance').value) || 0;
    const m_allowance = parseFloat(document.getElementById('m_allowance').value) || 0;
    const o_allowance = parseFloat(document.getElementById('o_allowance').value) || 0;

    const total = salary + hra + c_allowance + m_allowance + o_allowance;

    document.getElementById('total_net_salary').value = total.toFixed(2);
}
</script>


