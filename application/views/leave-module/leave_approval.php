<style type="text/css">
  .col-md-6{
    float: left;
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
               <h5> <a href="<?php echo base_url('index.php/Leave/Approval'); ?>"><?= $this->lang->line('leave_module') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_approval') ?>
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
                                    <i class="feather feather-download "></i> 
                            </button>
                        </form> &nbsp;
                        <div>
                           <a href="<?php echo base_url('index.php/Leave/create'); ?>" class="btn btn-icon btn-light-brand">
                                <i class="feather feather-plus"></i>
                                <!-- <span><?= $this->lang->line('apply_for_leave') ?>  -->
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
     <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
  <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th>  <?= $this->lang->line('sr_no') ?></th>
                <th>  <?= $this->lang->line('employee') ?></th>
                <th>  <?= $this->lang->line('status') ?></th>
                <th>  <?= $this->lang->line('leave_type') ?></th>
                <th>  <?= $this->lang->line('category') ?></th>
                <th>  <?= $this->lang->line('description') ?></th>
                <th>   <?= $this->lang->line('leave_reason') ?></th>
                <th>  <?= $this->lang->line('action') ?></th>
              </tr>
          </thead>
          <tbody>
           <?php
           if(!empty($leaves)) { 
            $i=1;foreach($leaves as $obj) {
              if($role_id ==4){
                if($department_id == $obj['department_id']){
             ?>
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

                <td >
                  <?= $obj['created_on'] ?> 
                </td>

                <td><?= $obj['leave_reason']?></td>
              
                <td>
               
                
                 
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Leave/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  
                </td>

                <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/deleteItem/<?php echo $obj['id'];?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Confirm Header </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>                        
                      </div>
                      <div class="modal-body">
                        <p>Are you sure, you want to delete <b><?php echo $obj['leave_category'];?> </b>? </p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                    
              </tr>
            <?php  $i++;} }else {?> 
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

                <td >
                  <?= $obj['created_on'] ?> 
                </td>

                <td><?= $obj['leave_reason']?></td>
              
                <td>
               
                
                 
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Leave/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  
                </td>

                <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/deleteItem/<?php echo $obj['id'];?>">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Confirm Header </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>                        
                      </div>
                      <div class="modal-body">
                        <p>Are you sure, you want to delete <b><?php echo $obj['leave_category'];?> </b>? </p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                    
              </tr>
              <?php $i++;} ?>


          <?php  }} else{ ?>
              <tr>
                <td colspan="100"> <h5 style="text-align: center;"> <?= $this->lang->line('no_leads_found') ?></h5></td>
              </tr>
           <?php  }?>
          </tbody>
        </table>                </div>
            </div>
        </div>
    </div>
</div>

 <script type="text/javascript">

   $(document).ready(function () {
    $(".content").hide();
    $(".show_hide").on("click", function () {
        var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
        $(".show_hide").text(txt);
        $(this).next('.content').slideToggle(200);
    });
});
</script>