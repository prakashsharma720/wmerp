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
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right">
         <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leave/create">
          <i class="fa fa-plus"></i> Export Report</a>
      </div>
    </div> <!-- /.card-body -->
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

      <form method="get" id="filterForm">
      <div class="row">
         
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Search By Employee</label>
                <select name="name" class="form-control select2 suppliers" >
                    <option value=""> Select employee..</option>
                    <?php
                         if ($employees): ?> 
                          <?php 
                            foreach ($employees as $value) : ?>
                              <?php 
                                  if ($value['name'] == $filtered_value['name']): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="">No result</option>
                        <?php endif; ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 ">
                  <label  class="control-label">Search By Status </label>
                  <select name="leave_type" class="form-control select2 " >
                     <option value="">Select status..</option>
                        <?php
                         if ($leave_types): ?> 
                          <?php 
                            foreach ($leave_types as $value) : ?>
                                <?php 
                                  if ($value['leave_type'] == $filtered_value['leave_type']): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['leave_type'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['leave_type'] ?></option>
                                  <?php endif;   ?>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="">No result</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-4 col-sm-4">
                  <label  class="control-label">Search By Status </label>
                  <select name="leave_status" class="form-control select2" >
                     <option value="">Select Status</option>
                            <option value="Pending" > Pending </option>
                            <option value="Approved" > Approved </option>
                            <option value="In Process" > On Hold</option>
                           <option value="Rejected" > Rejected</option>
                           
                    </select>
                </div>

              <?php if(!empty($filtered_value['lead_code']))
                  { 
                      $date = date('d-m-Y',strtotime($filtered_value['lead_code']));
                 }
                 else{ 
                      $date = date('d-m-Y',strtotime('-7 day'));
                   }?>

                  <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="<?= $date ?>" placeholder="dd-mm-yyyy"  autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="<?php echo date('d-m-Y');?>" placeholder="dd-mm-yyyy"  autocomplete="off" autocomplete="off">
                </div>
                <div class="col-md-1 col-sm-1 ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label>
                      <input type="submit" class="btn btn-xs btn-primary" value="Search" />
                  </div>
                  <div class="col-md-1 col-sm-1 ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label>
                      <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
                  </div>
                </div>
        </form>
        <hr>


      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
           <tr>
                <th > Sr.No.</th>
                <th> Status</th>
                <th> Leave Type</th>
                <th> Category</th>
                <th> Description</th>
                <th> leave Reason</th>
                <th> Employee</th>
            </tr>
          </thead>
          <tbody>
           <?php
           if(!empty($leaves)) { 
            $i=1;foreach($leaves as $obj) { ?>
              <tr>
                <td><?= $i ?></td>
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
                ?>
                <td><button class="btn btn-sm <?php echo $btn_class;?>" style="pointer-events: none;"><?= $obj['leave_status']?></button></td>
                <td><?= $obj['leave_type']?></td>
                <td><?= $obj['leave_category']?></td>
                <?php 
                if($obj['leave_category'] == 'full'){
                    $desc = date('d-M-Y',strtotime($obj['from_date'])). ' To '.date('d-M-Y',strtotime($obj['upto_date']));
                }else{
                    $desc = date('d-M-Y',strtotime($obj['halfday_date'])). '( '.$obj['halfday_type'].')';
                } ?>
                  <td style="max-width:250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= $desc ?> </td>
                <td><?= $obj['leave_reason']?></td>
                <td><?= $obj['employee']?></td>
              
                <!-- <td >
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Leave/History/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a>
                  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Leads/followups/<?php echo $obj['id'];?>"><i class="fa fa-envelope"></i></a>
                </td> -->
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/deleteItem/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Lead <b><?php echo $obj['lead_code'];?> </b>? </p>
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
            <?php  $i++;} }else{ ?>
              <tr>
                <td colspan="100"> <h5 style="text-align: center;"> No Leads Found</h5></td>
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