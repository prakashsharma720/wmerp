<style>
.control-label {
	margin: 0.7rem
}
</style>
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
                <h5 class="m-b-10"><?= $this->lang->line('employee') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('add') ?>
                </li>
            </ul>
        </div>

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
                    <div class="col-lg-12">

        <div class="">
            <form class="form-horizontal" role="form" method="post"
                action="<?php echo base_url(); ?>index.php/Employees/add_new_employee" enctype="multipart/form-data">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab"><?= $this->lang->line('personal_details') ?></a></li>
                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab"><?= $this->lang->line('bank_details') ?></a>
                        </li>
                        <li class="nav-item"><a class="nav-link " href="#salary" data-toggle="tab"><?= $this->lang->line('salary_details') ?></a>
                        </li>
                        <li class="nav-item"><a class="nav-link " href="#settings" data-toggle="tab"><?= $this->lang->line('other_details') ?></a>
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
                                        <input type="text" placeholder="<?= $this->lang->line('enter_employee_name') ?>" name="name"
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
                                        <input type="text" placeholder="<?= $this->lang->line('enter_email') ?>" name="email"
                                            class="form-control email" value="" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('select_role') ?><span class="required">*</span></label>
                                        <?php  echo form_dropdown('role_id', $roles, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('mobile_no') ?> <span class="required">*</span></label>
                                        <input type="text" placeholder="<?= $this->lang->line('enter_mobile_no') ?>" name="mobile_no"
                                            class="form-control mobile" minlenght="10" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            value="" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('select_department') ?> <span class="required">*</span></label>
                                        <?php  
						            		echo form_dropdown('department_id', $departments, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('select_designation') ?> <span
                                                class="required">*</span></label>
                                        <?php  
						            		echo form_dropdown('designation_id', $designations, '', 'required="required"')
						            	?>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label"> <?= $this->lang->line('date_of_joining') ?></label>
                                        <input type="text" data-date-formate="dd-mm-yyyy" name="doj"
                                            class="form-control date-picker" value="" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"
                                            autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <label class="control-label"> <?= $this->lang->line('date_of_birth') ?> </label>
                                        <input type="text" data-date-formate="dd-mm-yyyy" name="dob"
                                            class="form-control date-picker" value="" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"
                                            autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('username') ?> <span class="required">*</span> </label>
                                        <input type="text" placeholder="<?= $this->lang->line('username') ?>" name="username"
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
                                        <input type="password" placeholder="<?= $this->lang->line('password') ?>" name="password"
                                            class="form-control" value="" required autofocus>
                                    </div>


                                   <div class="col-md-4 col-sm-4">
    <label class="control-label">
        <?= $this->lang->line('gender') ?> <span class="required">*</span>
    </label>
    <div class="form-check form-check-inline">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" value="Male" checked>
            <?= $this->lang->line('male') ?>
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="gender" value="Female">
            <?= $this->lang->line('female') ?>
        </label>
    </div>
</div>

                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('address') ?> <span class="required"> *</span></label>
                                        <textarea class="form-control address" rows="3" placeholder=" <?= $this->lang->line('enter_address') ?>"
                                            name="address" value="" requireds></textarea>
                                    </div>


                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('aadhaar_no') ?> <span class="required">*</span></label>
                                        <input type="text" placeholder=" <?= $this->lang->line('enter_aadhaar_no') ?>" name="aadhaar_no"
                                            class="form-control aadhaar_no" minlenght="12" maxlength="12"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            value="" autofocus required>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                       <span><?= $this->lang->line('pan_no') ?></span>
                                        <input type="text" placeholder=" <?= $this->lang->line('pan_placeholder') ?>" name="pan_no"
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
                                        <input type="text" name="" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('account_holder_name') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('bank_name') ?><span class="required">*</span></label>
                                        <input type="text" name="bank_name" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('bank_name') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('account_number') ?><span
                                                class="required">*</span></label>
                                        <input type="text" name="account_number" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('account_number') ?>" autofocus>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                   
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('ifsc_code') ?><span class="required">*</span></label>
                                        <input type="text" name="ifsc_code" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('ifsc_code') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('branch_name') ?><span class="required">*</span></label>
                                        <input type="text" name="branch_name" class="form-control" value=""
                                            placeholder="<?= $this->lang->line('branch_name') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('account_type') ?><span class="required">*</span></label>
                                        <select name="account_type" class="form-control">
                                            <option value=""><?= $this->lang->line('select_type') ?></option>

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
                                            placeholder="<?= $this->lang->line('upi_id') ?>" autofocus>

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
                                        <label class="control-label"><?= $this->lang->line('basic_salary') ?><span class="required">*</span></label>
                                        <input type="text" name="salary" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('basic_salary') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('hra') ?></label>
                                        <input type="text" name="hra" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('hra') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('conveyance_allowance') ?></label>
                                        <input type="text" name="c_allowance" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('conveyance_allowance') ?>" autofocus>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('medical_allowance') ?></label>
                                        <input type="text" name="m_allowance" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('medical_allowance') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('other_allowance') ?></label>
                                        <input type="text" name="o_allowance" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('other_allowance') ?>" autofocus>

                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('total_net_salary') ?></label>
                                        <input type="text" name="total_net_salary" class="form-control " value=""
                                            placeholder="<?= $this->lang->line('total_net_salary') ?>" autofocus>

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
                                        <input type="text" placeholder="<?= $this->lang->line('emergency_mobile_no') ?>" name="emobile_no"
                                            class="form-control mobile" minlenght="10" maxlength="10"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                            value="" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('emergency_name') ?><span
                                                class="required">*</span></label>
                                        <input type="text" placeholder="<?= $this->lang->line('emergency_name') ?>" name="ename"
                                            class="form-control" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('uan_no') ?> </label>
                                        <input type="text" placeholder="<?= $this->lang->line('uan_no') ?> " name="uan"
                                            class="form-control" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row col-md-12">
                                   
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('pf_no') ?> </label>
                                        <input type="text" placeholder=" <?= $this->lang->line('pf_no') ?> " name="pf"
                                            class="form-control" required autofocus>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('esi_no') ?></label>
                                        <input type="text" placeholder=" <?= $this->lang->line('esi_no') ?>" name="esi"
                                            class="form-control" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
                                    <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('submit') ?></button>
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
</div>                </div>
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