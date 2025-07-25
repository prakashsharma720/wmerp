<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
?>
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
      
      <div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title">
<?= $this->lang->line('leave_approval') ?>      </span>
       <div class="d-flex align-items-center gap-1 page-header-right-items-wrapper">
                    <!-- Collapse Filter -->
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <i class="feather-filter"></i>
                    </a>
                    
      <div class="pull-right d-flex">
        <div>          
          <form method="post" action="<?php echo base_url(); ?>index.php/Leave/createXLS">
            <?php if(!empty($filtered_value)){ foreach ($filtered_value as $key => $value) { ?> 
                <input type="hidden" name="<?= $key ?>" value="<?=$value ?>"> <?php } }?>
            <button type="submit" class="btn btn-info">  <?= $this->lang->line('export') ?> </button>
          </form>
        </div>
            </div>
        &nbsp;
        <div>          
          <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leave/create">
            <i class="fa fa-plus"></i>  <?= $this->lang->line('apply_for_leave') ?>
          </a>
        </div>
      </div>
    </div> <!-- /.card-body -->
     <!-- Load Filter -->
    <?php $this->load->view('leave-module/component/filter'); ?>
    <div class="card-body">
      
 <!--        <form action="<?php echo base_url(); ?>index.php/Leads/importdata" enctype="multipart/form-data" method="post" role="form">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label class="control-label"> 
                    load File</label><span class="required"> (Only Excel/CSV File Import. in given format)</span>
                  <input type="file" name="uploadFile" value="" required="required" />
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-success" name="submit" value="submit">Upload Excel/CSV File Here</button>
              </div>
          </div>  
        </div>
      </form>

      <hr> -->

      <!-- <form method="get" id="filterForm">
          <div class="row">
          
               
         
                <div class="col-md-4 col-sm-4 ">
                  <label  class="control-label"> <?= $this->lang->line('search_by_category') ?></label>
                  <select name="category_name" class="form-control select2 suppliers" >
                    <option value=""> <?= $this->lang->line('search_by_category') ?> </option>
                    <option <?php if(!empty($filtered_value["category_name"])) { if($filtered_value['category_name']=='half') {echo "selected"; } } ?> value="half"> Half </option>
                    <option <?php if(!empty($filtered_value["category_name"])) { if($filtered_value['category_name']=='full') {echo "selected"; } } ?> value="full"> Full </option>
                  </select>
                </div>

                <div class="col-md-4 col-sm-4">
                  <label  class="control-label"> <?= $this->lang->line('search_by_status') ?> </label>
                  <select name="leave_status" class="form-control select2" >
                     <option value=""><?= $this->lang->line('search_by_status') ?></option>
                        <option <?php if(!empty($filtered_value["leave_status"])) { if($filtered_value['leave_status']=='Pending') {echo "selected"; } } ?> value="Pending" > Pending </option>
                        <option value="Approved" > Approved </option>
                        <option value="On Hold" > On Hold</option>
                        <option value="Rejected" > Rejected</option>
                        <option value="Cancelled" > Cancel</option>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4">
                  <label  class="control-label">  <?= $this->lang->line('from_date') ?></label>
                  <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="<?php if(!empty($filtered_value['from_date'])) { echo date('d-m-Y',strtotime($filtered_value['from_date'])); } ?>" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"  autocomplete="off" autocomplete="off">
                </div>
                <div class="col-md-4 col-sm-4">
                  <label  class="control-label">  <?= $this->lang->line('upto_date') ?></label>
                  <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="<?php if(!empty($filtered_value['upto_date'])) { echo date('d-m-Y',strtotime($filtered_value['upto_date'])); } ?>" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>"  autocomplete="off" autocomplete="off">
                </div>

                <div class="col-md-1 col-sm-1 ">
                      <label  class="control-label" style="visibility: hidden;">Grade</label>
                      <input type="submit" class="btn btn-xs btn-primary" value="Search" />
                  </div>
                  <div class="col-md-1 col-sm-1 ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label>
                      <a href="<?php echo $data[0]?>" class="btn btn-danger" >  <?= $this->lang->line('reset') ?></a>
                  </div>
                </div>
        </form> -->
        <hr>


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
        </table>
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