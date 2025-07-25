
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
                <li class="breadcrumb-item"><?= $this->lang->line('view_list') ?>
                </li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                 
                    <div class="pull-right d-flex">
                         <div class="button-group float-right d-flex gap-2">
                             <!-- Collapse Filter -->
            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
              data-bs-target="#collapseOne" data-toggle="tooltip" title="Filter">
              <i class="feather-filter"></i>
            </a>

                <a href="<?php echo base_url(); ?>index.php/Employees/add" class="btn btn-icon btn-light-brand" data-toggle="tooltip"
                    title="New Employee"><i class="feather feather-plus"></i></a>
                <button class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i
                        class="fa fa-refresh"></i></button>

                <button class="btn btn-icon btn-light-brand delete_all" data-toggle="tooltip" title="Bulk Delete"><i
                        class="feather feather-trash "></i></button>

            </div>
                    </div>
                </div>
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
 <div class="table-responsive">
                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                <table class="table table-hover  table-bordered table-striped" id="proposalList">

                    <thead>
                        <tr>
                            <th><input type="checkbox" id="master"></th>

                            <th><?= $this->lang->line('sr_no') ?></th>
                            <th> <?= $this->lang->line('name') ?> </th>

                            <th style="white-space: nowrap;"> <?= $this->lang->line('email') ?> </th>
                            <th style="white-space: nowrap;"> <?= $this->lang->line('role') ?></th>
                            <th style="white-space: nowrap;"><?= $this->lang->line('mobile_no') ?></th>

                            <th style="white-space: nowrap;"> <?= $this->lang->line('department') ?></th>
                            <th style="white-space: nowrap;"> <?= $this->lang->line('designation') ?></th>
                            <th style="white-space: nowrap;"> <?= $this->lang->line('date_of_joining') ?></th>
                            <th style="white-space: nowrap;"> <?= $this->lang->line('select_authority_person') ?> </th>
                            <th style="white-space: nowrap;"> <?= $this->lang->line('date_of_birth') ?></th>
                            <th style="white-space: nowrap;"> <?= $this->lang->line('photo') ?></th>
                            <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
          $i=1;foreach($employees as $obj){ ?>
                        <tr>
                                                        <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>

                            <td><?php echo $i;?></td>
                            <td><?php  
               $voucher_no= $obj['employee_code']; 
                    if($voucher_no<10){
                    $employee_id_code='EC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $employee_id_code='EC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $employee_id_code='EC0'.$voucher_no;
                    }
                    else{
                      $employee_id_code='EC'.$voucher_no;
                    }
                    echo $obj['name'].'('.$employee_id_code.')';

                ?></td>
                
                            <td><?php echo $obj['email']; ?></td>
                            <td><?php echo $obj['role']; ?></td>
                            <td><?php echo $obj['mobile_no']; ?></td>

                            <td><?php echo $obj['department_name']; ?></td>
                            <td><?php echo $obj['designation']; ?></td>
                            <td><?php echo $obj['date_of_joining']; ?></td>
                            <td><?php echo $obj['author_email']; ?></td>
                            <td><?php echo $obj['dob']; ?></td>
                            <td>
                                <?php if(!empty($obj['photo'])) { ?>
                                <div style="height: 10%;width: 100%;">
                                    <img src="<?php echo base_url().$obj['photo']; ?>" width="100%;" />
                                </div>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                             <a class="avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#ViewLeave<?php echo $obj['id']; ?>">
                                            <i class="feather feather-eye"></i>
                                            </a>
                            
                            

                                <a class="avatar-text avatar-md"
                                    href="<?php echo base_url(); ?>index.php/Employees/edit/<?php echo $obj['id'];?>"><i
                                        class="feather feather-edit-3"></i></a>
                                
                                          <a class="avatar-text avatar-md"
                                    href="<?php echo base_url(); ?>index.php/Employees/delete/<?php echo $obj['id'];?>"><i
                                        class="feather feather-trash"></i></a>
                                
                                

                                
                                  <!-- <a href="<?php //echo base_url(); ?>index.php/welcome/deleteSupplier/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                                </div>
                            </td>



                            <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content" style="width:800px !important">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?= $this->lang->line('employee_detail') ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">

                                            <div class="card-body">

                                                <fieldset>
                                                    <legend><?= $this->lang->line('personal_details') ?></legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('name') ?> :</label>
                                                            <span><?php echo $obj['name'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('email') ?>:</label>
                                                            <span><?php echo $obj['email'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('mobile_no') ?>:</label>
                                                            <span><?php echo $obj['mobile_no'];?></span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('role') ?> :</label>
                                                            <span><?php echo $obj['role'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('department') ?>:</label>
                                                            <span><?php echo $obj['department_name'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('designation') ?>:</label>
                                                            <span><?php echo $obj['designation'];?></span>

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('date_of_joining') ?> :</label>
                                                            <span><?php echo $obj['date_of_joining'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('authority_person') ?>:</label>
                                                            <span><?php echo $obj['author_email'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('date_of_birth') ?>:</label>
                                                            <span><?php echo $obj['dob'];?></span>

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('aadhaar_no') ?> :</label>
                                                            <span><?php echo $obj['aadhaar_no'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('pan_no') ?>:</label>
                                                            <span><?php echo $obj['pan_no'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('address') ?>:</label>
                                                            <span><?php echo $obj['address'];?></span>

                                                        </div>
                                                    </div>

                                                </fieldset>
                                                <fieldset>
                                                    <legend><?= $this->lang->line('bank_details') ?></legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('account_holder_name') ?> : </label>
                                                            <span><?php echo $obj['account_holder_name'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('bank_name') ?> :</label>
                                                            <span><?php echo $obj['bank_name'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('account_number') ?> :</label>
                                                            <span><?php echo $obj['account_number'];?></span>

                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('ifsc_code') ?> : </label>
                                                            <span><?php echo $obj['ifsc_code'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('branch_name') ?> :</label>
                                                            <span><?php echo $obj['branch_name'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('account_type') ?> :</label>
                                                            <span><?php echo $obj['account_type'];?></span>

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('upi_id') ?>: </label>
                                                            <span><?php echo $obj['upi_id'];?></span>
                                                        </div>
                                                      
                                                    </div>
                                                </fieldset>
                                                  <fieldset>
                                                    <legend><?= $this->lang->line('salary_details') ?></legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('salary_details') ?>:</label>
                                                            <span><?php echo $obj['salary'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('hra') ?> :</label>
                                                            <span><?php echo $obj['hra'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('conveyance_allowance') ?> :</label>
                                                            <span><?php echo $obj['c_allowance'];?></span>

                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"> <?= $this->lang->line('medical_allowance') ?>: </label>
                                                            <span><?php echo $obj['m_allowance'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('other_allowance') ?> :</label>
                                                            <span><?php echo $obj['o_allowance'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('total_net_salary') ?> :</label>
                                                            <span><?php echo $obj['total_net_salary'];?></span>

                                                        </div>

                                                    </div>
                                                    
                                                </fieldset>
                                                 <fieldset>
                                                    <legend><?= $this->lang->line('other_details') ?></legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('emergency_mobile_no') ?> : </label>
                                                            <span><?php echo $obj['emobile_no'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('emergency_name') ?> :</label>
                                                            <span><?php echo $obj['ename'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('uan_no') ?> :</label>
                                                            <span><?php echo $obj['uan'];?></span>

                                                        </div>
                                                    </div>
                                                     <div class="row">
                                                        <div class="col-md-4">
                                                            <label for="name"><?= $this->lang->line('pf_no') ?> : </label>
                                                            <span><?php echo $obj['pf'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="email"><?= $this->lang->line('esi_no') ?> :</label>
                                                            <span><?php echo $obj['esi'];?></span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="dob"><?= $this->lang->line('username') ?> :</label>
                                                            <span><?php echo $obj['username'];?></span>

                                                        </div>

                                                    </div>
                                                    
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


            </div>
        </div>






        <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
            <div class="modal-dialog">
                <form class="form-horizontal" role="form" method="post"
                    action="<?php echo base_url(); ?>index.php/Employees/deleteEmployee/<?php echo $obj['id'];?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                            <p>Are you sure, you want to delete employee
                                <b><?php echo $obj['name'];?> </b>?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> Yes
                            </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                No
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php $this->load->view('leave-module/component/view-employee', ['obj' => $obj]); ?>

        </tr>
        
        <?php  $i++;} ?>
        
        </tbody>
        </table>                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>  

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    jQuery('#master').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    jQuery('.delete_all').on('click', function(e) {
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).val());
        });
        //alert(allVals.length); return false;  
        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Employees/deleteEmployee",
                    cache: false,
                    data: 'ids=' + join_selected_values,
                    success: function(response) {
                        $(".successs_mesg").html(response);
                        location.reload();
                    }
                });

            }
        }
    });

});
</script>