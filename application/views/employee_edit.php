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

</style>
<div class="container-fluid">
    <div class="">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>

            <div class="pull-right ">

            </div>
        </div> <!-- /.card-body -->
    <br>

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center" style="margin-left: 53px;">
                            <div role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"
                                style="--value:100"></div>


                            <img class="profile-user-img img-fluid img-circle" src="<?= get_avatar_url($photo) ?>"
                                alt="User profile picture">

                        </div>



                        <h3 class="profile-username text-center"><?= $name?></h3>

                        <p class="text-muted text-center"><?php echo $designation?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                        <div class="top-progress-bar">
                            <div class="top-progress-fill">
                                <span class="progress-text">Profile Complete: 50%</span>
                            </div>
                        </div>
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right"><?= $email?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Mobile No.</b> <a class="float-right"><?= $mobile_no?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Date Of Birth</b> <a class="float-right"><?= $dob?></a>
                            </li>
                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">


                        <strong><i class="fa fa-map-marker mr-1"></i> Location</strong>

                        <p class="text-muted"><?= $address?></p>

                        <hr>

                        <strong><i class="fa fa-file-text-o mr-1"></i> Emergency No.</strong>

                        <p class="text-muted"><?= $emobile_no?> (<?= $ename?>)</p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-9">
                <form class="form-horizontal " role="form" method="post"
                    action="<?php echo base_url(); ?>index.php/Employees/editemployee/<?= $id ?>"
                    enctype="multipart/form-data">
                    <input type="hidden" name="employee_code" value="<?php echo $emp_code;?>" required>
                    <input type="hidden" name="employees_id" value="<?= $id?>">
                    <div class="card">
                        <!-- Custom Progress Bar with Text -->
                        
                        <div class="card-header p-2">
                            <ul class="nav nav-pills" style="margin-bottom: -8px;">
                                <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab" style="border-radius: 0px;color:#424747;">Personal
                                        Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab" style="border-radius: 0px;color:#424747;">Bank
                                        Details</a>
                                </li>
                                <li class="nav-item"><a class="nav-link " href="#salary" data-toggle="tab" style="border-radius: 0px;color:#424747;">Salary
                                        Details</a>
                                </li>
                                <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab" style="border-radius: 0px;color:#424747;">Other
                                        Details</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="activity">

                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Name <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="Enter employees name" name="name"
                                                    class="form-control" required autofocus value="<?= $name?>">
                                            </div>

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Email <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="Enter email" name="email"
                                                    class="form-control email" value="<?= $email?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Role <span
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
                                                <label class="control-label"> Mobile No <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="Enter mobile" name="mobile_no"
                                                    class="form-control mobile" minlenght="10" maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                    value="<?= $mobile_no?>" required autofocus>
                                            </div>

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Department <span
                                                        class="required">*</span></label>
                                                <?php  
						            		echo form_dropdown('department_id', $departments, $department_id)
						            	?>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Designation <span
                                                        class="required">*</span></label>
                                                <?php  
						            		echo form_dropdown('designation_id', $designations, $designation_id)
						            	?>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label class="control-label"> Date of joining </label>
                                                <input type="text" data-date-formate="dd-mm-yyyy" name="doj"
                                                    class="form-control date-picker"
                                                    value="<?php echo $date_of_joining?>" placeholder="dd-mm-yyyy"
                                                    autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <label class="control-label"> Date of Birth </label>
                                                <input type="text" data-date-formate="dd-mm-yyyy" name="dob"
                                                    class="form-control date-picker" value="<?php echo $dob?>"
                                                    placeholder="dd-mm-yyyy" autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Username <span class="required">*</span>
                                                </label>
                                                <input type="text" placeholder="Enter Username" name="username"
                                                    class="form-control" value="<?= $username?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Select Authority Person <span
                                                        class="required">*</span></label>
                                                <?php  
						            		        echo form_dropdown('author_id', $employees, $author_id)
						            	        ?>
                                            </div>


                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Aadhaar No <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="Enter Aadhaar No" name="aadhaar_no"
                                                    class="form-control aadhaar_no" minlenght="12" maxlength="12"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                    value="<?= $aadhaar_no?>" autofocus required>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <b> PAN </b> <span>(Parmanent Account No.) </span>
                                                <input type="text" placeholder="Ex. ABCEDE2548K" name="pan_no"
                                                    class="form-control pan_no" value="<?= $pan_no?>" autofocus
                                                    maxlength="10" minlength="10" style="text-transform: uppercase;">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Daily Target <span class="required">
                                                        *</span></label>
                                                <input class="form-control"
                                                    placeholder="Enter 0 if not applicable" name="target" value="<?= $target ?>"
                                                    required />
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Address <span class="required">
                                                        *</span></label>
                                                <textarea class="form-control address" rows="3"
                                                    placeholder="Enter Address" name="address" value="<?= $address ?>"
                                                    requireds><?= $address ?></textarea>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Upload Photo </label>
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
                                                <label class="control-label">Account Holder Name<span
                                                        class="required">*</span></label>
                                                <input type="text" name="account_holder_name" class="form-control "
                                                    value="<?= $account_holder_name; ?>"
                                                    placeholder="Account Holder Name" autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Bank Name<span
                                                        class="required">*</span></label>
                                                <input type="text" name="bank_name" class="form-control "
                                                    value="<?= $bank_name; ?>" placeholder="Bank Name" autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Account Number<span
                                                        class="required">*</span></label>
                                                <input type="text" name="account_number" class="form-control "
                                                    value="<?= $account_number; ?>" placeholder="Account Number"
                                                    autofocus>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">IFSC Code<span
                                                        class="required">*</span></label>
                                                <input type="text" name="ifsc_code" class="form-control "
                                                    value="<?= $ifsc_code; ?>" placeholder="IFSC Code" autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Branch Name<span
                                                        class="required">*</span></label>
                                                <input type="text" name="branch_name" class="form-control"
                                                    value="<?= $branch_name; ?>" placeholder="Branch Name" autofocus>

                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Account Type<span
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
                                                <label class="control-label">UPI ID</label>
                                                <input type="text" name="upi_id" class="form-control "
                                                    value="<?= $upi_id?>" placeholder="UPI ID" autofocus>

                                            </div>

                                        </div>
                                    </div>



                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="salary">
                                   <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Basic Salary<span class="required">*</span></label>
                                                <input type="text" id="basic_salary" name="salary" class="form-control" value="<?= $salary ?>" placeholder="Basic Salary" oninput="calculateTotal()" autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">HRA</label>
                                                <input type="text" id="hra" name="hra" class="form-control" value="<?= $hra ?>" placeholder="HRA" oninput="calculateTotal()">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Conveyance Allowance</label>
                                                <input type="text" id="c_allowance" name="c_allowance" class="form-control" value="<?= $c_allowance ?>" placeholder="Conveyance Allowance" oninput="calculateTotal()">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Medical Allowance</label>
                                                <input type="text" id="m_allowance" name="m_allowance" class="form-control" value="<?= $m_allowance ?>" placeholder="Medical Allowance" oninput="calculateTotal()">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Other Allowance</label>
                                                <input type="text" id="o_allowance" name="o_allowance" class="form-control" value="<?= $o_allowance ?>" placeholder="Other Allowance" oninput="calculateTotal()">
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Total Net Salary</label>
                                                <input type="text" id="total_net_salary" name="total_net_salary" class="form-control" value="<?= $total_net_salary ?>" placeholder="Total Net Salary" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane " id="settings">
                                    <div class="form-group">
                                        <div class="row col-md-12">
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label">Emergency Mobile No <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="Enter Emergency mobile"
                                                    name="emobile_no" class="form-control mobile" minlenght="10"
                                                    maxlength="10"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                    value="<?= $emobile_no?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> Emergency Name <span
                                                        class="required">*</span></label>
                                                <input type="text" placeholder="Enter Emergency name" name="ename"
                                                    class="form-control" value="<?= $ename?>" required autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> UAN No. </label>
                                                <input type="text" placeholder="Enter UAN Number" name="uan"
                                                    class="form-control" value="<?= $uan?>" autofocus>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row col-md-12">

                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> PF No. </label>
                                                <input type="text" placeholder="Enter PF Number" name="pf"
                                                    class="form-control" value="<?= $pf?>" autofocus>
                                            </div>
                                            <div class="col-md-4 col-sm-4 ">
                                                <label class="control-label"> ESI No.</label>
                                                <input type="text" placeholder="Enter ESI Number" name="esi"
                                                    class="form-control" value="<?= $esi?>" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="row col-md-12">
                                    <div class="col-md-12 col-sm-12 ">
                                        <label class="control-label" style="visibility: hidden;"> Name</label><br>
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
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


