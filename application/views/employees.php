<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
.select2 {
    height: 45px !important;
    width: 100% !important;
}

.btnEdit {
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
}
</style>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><?= $title ?></h3>
            <div class="pull-right error_msg">
                <?php echo validation_errors();?>
                <?php if (isset($message_display)) {
                    echo $message_display;
                } ?>
                <?php if (isset($error)) {
                    echo $error;
                } ?>
                <?php if (isset($success)) {
                    echo $success;
                } ?>
            </div>
        </div> <!-- /.card-body -->


        <div class="">
            <form class="form-horizontal" role="form" method="post"
                action="<?php echo base_url(); ?>index.php/Employees/add_new_employee" enctype="multipart/form-data">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Personal
                                Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Bank Details</a>
                        </li>
                        <li class="nav-item"><a class="nav-link " href="#salary" data-toggle="tab">Salary Details</a>
                        </li>
                        <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab">Other Details</a>
                        </li>
                      
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="activity">
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('name') ?><span class="required">*</span></label>
                                        <input type="text" placeholder="Enter employees name" name="name"
                                            class="form-control" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('code') ?> <span class="required">*</span></label>
                                        <input type="text" name="emp_code" class="form-control"
                                            value="<?= $employee_code?>" autofocus readonly="readonly">
                                        <input type="hidden" name="employee_code" value="<?php echo $emp_code;?>"
                                            required>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('email') ?> <span class="required">*</span></label>
                                        <input type="text" placeholder="Enter email" name="email"
                                            class="form-control email" value="" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('role') ?> <span class="required">*</span></label>
                                        <?php  echo form_dropdown('role_id', $roles, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('mobile_no') ?> <span class="required">*</span></label>
                                        <input type="text" placeholder="Enter mobile" name="mobile_no"
                                            class="form-control mobile" minlenght="10" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            value="" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('department') ?> <span class="required">*</span></label>
                                        <?php  
						            		echo form_dropdown('department_id', $departments, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('designation') ?> <span
                                                class="required">*</span></label>
                                        <?php  
						            		echo form_dropdown('designation_id', $designations, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label"> <?= $this->lang->line('date_of_joining') ?></label>
                                        <input type="text" data-date-formate="dd-mm-yyyy" name="doj"
                                            class="form-control date-picker" value="" placeholder="dd-mm-yyyy"
                                            autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label"> <?= $this->lang->line('date_of_birth') ?> </label>
                                        <input type="text" data-date-formate="dd-mm-yyyy" name="dob"
                                            class="form-control date-picker" value="" placeholder="dd-mm-yyyy"
                                            autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('username') ?> <span class="required">*</span> </label>
                                        <input type="text" placeholder="Enter Username" name="username"
                                            class="form-control" value="" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('select_authority_person') ?> <span
                                                class="required">*</span></label>
                                        <?php  
						            		echo form_dropdown('author_id', $employees, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('upload_photo') ?></label>

                                        <input type="file" name="photo" class="form-control upload" autofocus>
                                        <img id="blah" src="#" alt="your image" class="hide" width="40%" />
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('password') ?> <span class="required">*</span></label>
                                        <input type="password" placeholder="Enter Password" name="password"
                                            class="form-control" value="" required autofocus>
                                    </div>


                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('gender') ?> <span class="required">*</span></label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" value="Male"
                                                checked> Male</input>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="form-check-input" type="radio" name="gender" value="Female">
                                            Female</input>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('address') ?> <span class="required"> *</span></label>
                                        <textarea class="form-control address" rows="3" placeholder="Enter Address"
                                            name="address" value="" requireds></textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('aadhaar_no') ?> <span class="required">*</span></label>
                                        <input type="text" placeholder="Enter Aadhaar No" name="aadhaar_no"
                                            class="form-control aadhaar_no" minlenght="12" maxlength="12"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            value="" autofocus required>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                       <span><?= $this->lang->line('pan_no') ?></span>
                                        <input type="text" placeholder="Ex. ABCEDE2548K" name="pan_no"
                                            class="form-control pan_no" value="" autofocus maxlength="10" minlength="10"
                                            style="text-transform: uppercase;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <!--  <div class="col-md-4 col-sm-4 ">
						            	<label  class="control-label"> Blood Group </label>
						               <?php  $app_cat = array(
						            		 'NA' => 'Select Option',
							                  'A+' => 'A+',
							                  'A-' => 'A-',
							                  'B+' => 'B+',
							                  'B-' => 'B-',
							                  'B' => 'B',
							                  'AB+' => 'AB+',
							                  'AB-' => 'AB-',
							                  'AB' => 'AB',
							                  'O+' => 'O+',
							                  'O-' => 'O-',
							                  'O' => 'O',
							                  'Unknown' => 'Unknown',
							                  );
						            		echo form_dropdown('blood_group', $app_cat)
						            	?>
						            </div> -->

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
                                        <input type="text" name="account_holder_name" class="form-control " value=""
                                            placeholder="Account Holder Name" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('bank_name') ?><span class="required">*</span></label>
                                        <input type="text" name="bank_name" class="form-control " value=""
                                            placeholder="Bank Name" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('account_number') ?><span
                                                class="required">*</span></label>
                                        <input type="text" name="account_number" class="form-control " value=""
                                            placeholder="Account Number" autofocus>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                   
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('ifsc_code') ?><span class="required">*</span></label>
                                        <input type="text" name="ifsc_code" class="form-control " value=""
                                            placeholder="IFSC Code" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('branch_name') ?><span class="required">*</span></label>
                                        <input type="text" name="branch_name" class="form-control" value=""
                                            placeholder="Branch Name" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('type') ?><span class="required">*</span></label>
                                        <select name="account_type" class="form-control">
                                            <option value="">Select Type</option>

                                            <option value="savings">Savings</option>
                                            <option value="current">Current</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                  
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('upi_id') ?></label>
                                        <input type="text" name="upi_id" class="form-control " value=""
                                            placeholder="UPI ID" autofocus>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.tab-pane -->
                          <!-- /.tab-pane -->
                        <div class="tab-pane" id="salary">
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label">Basic Salary<span class="required">*</span></label>
                                        <input type="text" name="salary" class="form-control " value=""
                                            placeholder="Basic Salary" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label">HRA</label>
                                        <input type="text" name="hra" class="form-control " value=""
                                            placeholder="HRA" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label">Conveyance Allowance</label>
                                        <input type="text" name="c_allowance" class="form-control " value=""
                                            placeholder="Conveyance Allowance" autofocus>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label">Medical Allowance</label>
                                        <input type="text" name="m_allowance" class="form-control " value=""
                                            placeholder="Medical Allowance" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label">Other Allowance</label>
                                        <input type="text" name="o_allowance" class="form-control " value=""
                                            placeholder="Other Allowance" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label">Total Net Salary</label>
                                        <input type="text" name="total_net_salary" class="form-control " value=""
                                            placeholder="Total Net Salary" autofocus>

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
                                        <input type="text" placeholder="Enter Emergency mobile" name="emobile_no"
                                            class="form-control mobile" minlenght="10" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            value="" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> Emergency Name <span
                                                class="required">*</span></label>
                                        <input type="text" placeholder="Enter Emergency name" name="ename"
                                            class="form-control" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> UAN No. </label>
                                        <input type="text" placeholder="Enter UAN Number" name="uan"
                                            class="form-control" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                   
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> PF No. </label>
                                        <input type="text" placeholder="Enter PF Number" name="pf"
                                            class="form-control" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> ESI No.</label>
                                        <input type="text" placeholder="Enter ESI Number" name="esi"
                                            class="form-control" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label" style="visibility: hidden;"> Name</label><br>
                                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </form>
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
            alert('Image size exceed , please select < 5MB file only !');
            $(this).val('');
        }

        readURL(this);
    });

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