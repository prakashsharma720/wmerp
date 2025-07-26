<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/Leave/index'); ?>"><?= $this->lang->line('leave_module') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_application') ?>
                </li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <!-- Collapse Filter -->
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <i class="feather-filter"></i>
                    </a>
                    <div class="pull-right d-flex">
                        <form method="post" action="<?php echo base_url(); ?>index.php/Leave/createXLS">
                            <?php if (!empty($filtered_value)) {
                                foreach ($filtered_value as $key => $value) { ?>
                                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"> <?php }
                            } ?>
                            <button type="submit" class="btn btn-icon btn-light-brand">
                                <i class="feather feather-download ">
                                </i>  </button>
                        </form> &nbsp;
                        <div>
                           <a href="<?php echo base_url('index.php/Leave/create'); ?>" class="btn btn-icon btn-light-brand">
                                <i class="feather feather-plus"></i>
                                </span>
                            </a>
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
    <?php $this->load->view('leave-module/component/filter'); ?>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>
            <!</h5>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('failed')): ?>
        <div class="alert alert-error alert-dismissible ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>
            <!</h5>
            <?php echo $this->session->flashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <div class="main-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card stretch stretch-full">
                <!-- <div class="form-group m-4">
                    <form method="get" action="<?php echo base_url(); ?>index.php/Leads/approveall">
                        <div class="row">
                            <div class="col-4">
                                <select id="selectestimateid" class="form-control" data-select2-selector="default" name="approveaction">
                                    <option class="white" value="">Select Action</option>
                                    <option class="white" value="Approved"><?= $this->lang->line('approved') ?></option>
                                    <option class="white" value="Rejected"><?= $this->lang->line('rajected') ?>
                                    <</option>
                                    <option class="white" value="delete_all"><?= $this->lang->line('delete') ?>
                                    <</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary me-2 bulk_action">
                                    <i class="bi bi-filter"></i> <?= $this->lang->line('apply') ?>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-hover" id="proposalList">
                                <thead>
                                    <tr>
                                        <th>  <?= $this->lang->line('sr_no') ?></th>
                                        <th>  <?= $this->lang->line('employee') ?></th>
                                        <th>  <?= $this->lang->line('status') ?></th>
                                        <th>   <?= $this->lang->line('leave_type') ?></th>
                                        <th>  <?= $this->lang->line('category') ?></th>
                                        <th>  <?= $this->lang->line('description') ?></th>
                                        <th>  <?= $this->lang->line('leave_reason') ?></th></th>
                                         <th class="text-center"><?= $this->lang->line('action') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    if(!empty($leaves)) { 
                                    $i=1;foreach($leaves as $obj) { ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $obj['employee']?></td>
                                    <?php 
                                        if($obj['leave_status'] == 'Pending'){
                                        $btn_class='btn-pending';

                                        }else if($obj['leave_status'] == 'Approved'){
                                        $btn_class='btn-approved';

                                        }else if($obj['leave_status'] == 'On Hold'){
                                        $btn_class='btn-inprocess';
                                        }else if($obj['leave_status'] == 'Rejected'){
                                        $btn_class='btn-rejected';

                                        }
                                        else if($obj['leave_status'] == 'Cancelled'){
                                        $btn_class='btn-cancel';

                                        }
                                        ?>

                                        <td>
                                            <button class="btn btn-sm <?php echo $btn_class;?>" style="pointer-events: none;">
                                                <?= $obj['leave_status']?>
                                            </button>
                                        </td>

                                        <td><?= $obj['leave_type']?></td>
                                        <td><?= $obj['leave_category']?></td>

                                        <?php 
                                            if($obj['leave_category'] == 'full'){
                                                $desc = date('d-m-Y',strtotime($obj['from_date'])). ' To '.date('d-m-Y',strtotime($obj['upto_date']));
                                            } if($obj['leave_category'] == 'half'){ 
                                                $desc = date('d-m-Y',strtotime($obj['halfday_date'])). '( '.$obj['halfday_type'].')';
                                            }
                                            else {
                                                $desc = date('d-m-Y',strtotime($obj['gate_date'])). '( '.date('h:i A',strtotime($obj['gate_time_from'])).' - '.date('h:i A',strtotime($obj['gate_time_to'])).')';
                                            } 
                                            ?>

                                        <td>
                                            <?= $obj['created_on'] ?>
                                        </td>

                                        <td><?= $obj['leave_reason']?></td>

                                        <td >
                                        <div class="hstack gap-2 justify-content-end">
                                            <?php
                                            if( $obj['employee_id']!==$login_id)
                                            { ?>
                                            <a href="<?php echo base_url(); ?>index.php/Leave/edit/<?php echo $obj['id']; ?>" 
                                            class="avatar-text avatar-md" >
                                            <i class="feather feather-edit-3 "></i>
                                            </a>

                                            <?php }?>
                                            <a class="avatar-text avatar-md" data-bs-toggle="offcanvas"
                                            data-bs-target="#delete<?php echo $obj['id'];?>">
                                            <i class="feather feather-trash "></i>
                                            </a>
                                           
                                            <a class="avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#ViewLeave<?php echo $obj['id']; ?>">
                                            <i class="feather feather-eye"></i>
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
                                                        <b><?php echo $obj['leave_category']; ?> </b>?
                                                    </p>
                                            </div>
                                            
                                             <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
                                                  <button type="submit" class="btn btn-primary delete_submit w-50"> <?= $this->lang->line('yes') ?>
                                                </button>
                                             <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas"><?= $this->lang->line('cancel') ?></a>
                                            </div>
                                             </form>
                                        </div>
                                       
                                        <?php $this->load->view('leave-module/component/view-leave', ['obj' => $obj]); ?>

                                    </tr>
                                    <?php  $i++;} }else{ ?>
                                    <tr>
                                        <td colspan="100">
                                            <h5 style="text-align: center;"><?= $this->lang->line('no_leads_found') ?></h5>
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