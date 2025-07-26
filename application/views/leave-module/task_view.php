
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
               <h5> <a href="<?php echo base_url('index.php/Dailytasks/tasks'); ?>"><?= $this->lang->line('daily_tasks') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('tasks') ?>
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
                        data-bs-target="#collapseOne">
                        <i class="feather-filter"></i>
                    </a>
                         
                  <a href="<?php echo base_url('index.php/Dailytasks/task_add'); ?>" class="btn btn-icon btn-light-brand">
                                <i class="feather feather-plus"></i>
                                </span>
                            </a>
                     <button class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i
                        class="fa fa-refresh"></i></button>

                        <button class="btn btn-icon btn-light-brand delete_all" data-toggle="tooltip" title="Bulk Delete">
                  <i class="feather feather-trash "></i> 
              </button>

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
      <!-- Load Filter -->
    <?php $this->load->view('leave-module/component/taskfilter'); ?>
       
        <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
 <div class="table-responsive">
                <table class="table table-hover  table-bordered table-striped" id="proposalList">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="master"></th>
                            <th> <?= $this->lang->line('project') ?></th>
                            <th>  <?= $this->lang->line('task_title') ?></th>
                            <th> <?= $this->lang->line('start_date') ?></th>
                            <th> <?= $this->lang->line('end_date') ?></th>
                            <th><?= $this->lang->line('priority') ?></th>
                            <th> <?= $this->lang->line('status') ?></th>
                            <th> <?= $this->lang->line('assign_to') ?></th>
                            <th> <?= $this->lang->line('assign_by') ?> </th>
                            <th> <?= $this->lang->line('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
           if(!empty($daily_tasks)) { 
            $i=1;foreach($daily_tasks as $obj) { ?>
                        <tr>
                            <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                            <td><?= $i ?></td>
                            <td><?= $obj['task_name']?></td>
                            <td><?= $obj['start_date']?></td>
                            <td><?= $obj['end_date']?></td>
                            <td><?= $obj['priority']?></td>
                            <td><?= $obj['status']?></td>
                            <td><?= $obj['employee_name']?></td>
                            <td><?= $obj['assign_by']?></td>
                            <!--  -->


                          <td>
    <div class="d-flex align-items-center gap-2">
        <?php 
        if ($designation_id == '4' || $designation_id == '1') {
            if ($obj['status'] == 'In Process') {
        ?>
            <a href="<?php echo base_url(); ?>index.php/Dailytasks/edit/<?php echo $obj['id']; ?>" 
                class="avatar-text avatar-md ">
                <i class="feather feather-edit-3"></i>
            </a>
        <?php 
            } 
        ?>
            <a class="avatar-text avatar-md " data-bs-toggle="offcanvas"
                data-bs-target="#delete<?php echo $obj['id']; ?>">
                <i class="feather feather-trash"></i>
            </a>
        <?php 
        } 
        ?>
        
        <a href="<?php echo base_url(); ?>index.php/Dailytasks/task_history/<?php echo $obj['id']; ?>" 
            class="avatar-text avatar-md ">
            <i class="fa fa-envelope"></i>
        </a>
    </div>
</td>

<div class="offcanvas offcanvas-end" tabindex="-1" id="delete<?php echo $obj['id']; ?>">
                                            <form class="form-horizontal" role="form" method="post"
                                                    action="<?php echo base_url(); ?>index.php/Leave/deleteItem/<?php echo $obj['id']; ?>">

                                            <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
                                                <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('confirm') ?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                            </div>
                                            <div class="offcanvas-body">
                                                <!-- Modal content-->
                                                    <p><?= $this->lang->line('confirm_delete') ?>
                                                        <b><?php echo $obj['id']; ?> </b>?
                                                    </p>
                                            </div>
                                            
                                             <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
                                                  <button type="submit" class="btn btn-primary delete_submit w-50"> <?= $this->lang->line('yes') ?>
                                                </button>
                                             <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('cancel') ?></a>
                                            </div>
                                             </form>
                                        </div>

                            <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" role="form" method="post"
                                        action="<?php echo base_url(); ?>index.php/Dailytasks/deleteItem/<?php echo $obj['id'];?>">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">
                                                <p><?= $this->lang->line('confirm_delete') ?>
                                                    <b><?php echo $obj['task_name'];?> </b>? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?>
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
                                <h5 style="text-align: center;"> No task Found</h5>
                            </td>
                        </tr>
                        <?php  }?>
                    </tbody>
                </table>
                            </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $(".content").hide();
    $(".show_hide").on("click", function() {
        var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
        $(".show_hide").text(txt);
        $(this).next('.content').slideToggle(200);
    });
});
</script>
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
            WRN_PROFILE_DELETE = "Are you sure you want to delete all selected issue?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Dailytasks/deleteItem",
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