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
        <!--  <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leads/add">
          <i class="fa fa-plus"></i> Create New Lead</a> -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
        <div class="row">
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Search By Category</label>
                <select name="category_name" class="form-control select2 suppliers" >
                    <option value=""> Select Category</option>
                    <?php
                         if ($categories): ?> 
                          <?php 
                            foreach ($categories as $value) : ?>
                              <?php 
                                  if ($value['category_name'] == $filtered_value['category_name']): ?>
                                      <option value="<?= $value['category_name'] ?>" selected><?= $value['category_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['category_name'] ?>"><?= $value['category_name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="">No result</option>
                        <?php endif; ?>
                </select>
              </div>
              <!-- <div class="col-md-4 col-sm-4 ">
                  <label  class="control-label">Search By Id </label>
                  <select name="lead_code" class="form-control select2 " >
                     <option value="">Select Lead Id</option>
                        <?php
                         if ($leads): ?> 
                          <?php 
                            foreach ($leads as $value) : ?>
                                <?php 
                                  if ($value['lead_code'] == $filtered_value['lead_code']): ?>
                                      <option value="<?= $value['lead_code'] ?>" selected><?= $value['lead_code'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['lead_code'] ?>"><?= $value['lead_code'] ?></option>
                                  <?php endif;   ?>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="">No result</option>
                        <?php endif; ?>
                    </select>
                </div> -->

                <div class="col-md-4 col-sm-4">
                  <label  class="control-label">Search By Status </label>
                  <select name="lead_status" class="form-control select2" >
                     <option value="">Select Status</option>
                            <option value="Pending" > Pending </option>
                            <option value="Approved" > Approved </option>
                            <option value="In Process" > In Process</option>
                            <option value="Converted" > Converted</option>
                            <option value="Rejected" > Rejected</option>
                            <option value="Hot Lead" > Hot Lead</option>
                            <option value="Cold Lead" > Cold Lead</option>
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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th > Sr.No.</th>
                <th> Status</th>
                <th> Date</th>
                <th> Name</th>
                <th> Email</th>
                <th style="white-space: nowrap;"> Subject</th>
                <th> Message</th>
                <th > Action</th>
              </tr>
          </thead>
          <tbody>
           <?php
           if(!empty($leads)) { 
            $i=1;foreach($leads as $obj) { ?>
              <tr>
                <td><?= $i ?></td>
                <?php 
                if($obj['lead_status'] == 'Pending'){
                  $btn_class='btn-pending';

                }else if($obj['lead_status'] == 'Approved'){
                  $btn_class='btn-approved';

                }else if($obj['lead_status'] == 'In Process'){
                  $btn_class='btn-inprocess';

                }else if($obj['lead_status'] == 'Converted'){
                  $btn_class='btn-converted';

                }else if($obj['lead_status'] == 'Rejected'){
                  $btn_class='btn-rejected';

                }
                ?>
                <td><button class="btn btn-sm <?php echo $btn_class;?>" style="pointer-events: none;"><?= $obj['lead_status']?></button></td>
                <td><?= date('d-M-Y',strtotime($obj['date']))?></td>
                <td><?= $obj['name']?></td>
                <td><a href="mailto:<?= $obj['email']?>"><?= $obj['email']?></a></td>
                <td style="max-width:250px;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?= $obj['subject']?> </td>
                <td><?= $obj['message']?></td>
                <!-- <td><a href="tel:<?= $obj['mobile']?>"><?= $obj['mobile']?></a></td> -->
                <!-- <td><?= $obj['lead_source']?></td> -->
                <td >
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Leads/add/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i> </a>
                  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Leads/followups/<?php echo $obj['id'];?>"><i class="fa fa-envelope"></i></a>
                </td>
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
                            <p>Are you sure, you want to delete Lead <b><?php echo $obj['name'];?> </b>? </p>
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