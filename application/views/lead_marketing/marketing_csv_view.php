<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($item_master);exit;
?>

<style type="text/css">

  .col-sm-6 ,.col-md-6{
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
       
         <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leads/add">
          <i class="fa fa-plus"></i> Create New Lead</a>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form action="<?php echo base_url(); ?>index.php/Leads/importdata" enctype="multipart/form-data" method="post" role="form">
        <div class="row">
          <div class="col-md-12">
              <div class="col-md-6">
                  <label class="control-label"> Upload File</label><span class="required"> (Only Excel/CSV File Import.)</span>
                  <input type="file" name="uploadFile" value="" required="required" />
              </div>
              <div class="col-md-6">
                <button type="submit" class="btn btn-success" name="submit" value="submit">Upload</button>
              </div>
          </div>  
        </div>
      </form>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr>
                <th > Sr.No.</th>
                <th> Status</th>
                <th> Cateogry</th>
                <th> Title</th>
                <th style="white-space: nowrap;"> Contact Person</th>
                <th> Mobile</th>
                <th> Email</th>
                <th> Source</th>
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
                <td><?= $obj['category_name']?></td>
                <td><?= $obj['title']?></td>
                <td><?= $obj['person_name']?></td>
                <td><?= $obj['mobile']?></td>
                <td><a href="mailto:<?= $obj['email']?>"><?= $obj['email']?></a></td>
                <td><?= $obj['lead_source']?></td>
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
                            <p>Are you sure, you want to delete Lead <b><?php echo $obj['title'];?> </b>? </p>
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
<!-- <script type="text/javascript">

    var url="<?php //echo base_url();?>";
    alert(url);
    function delete(id){
       var r=confirm("Do you want to delete this?")
        if (r==true)
          window.location = url+"index.php/welcome/deleteSupplier/"+id;
        else
          return false;
        } 
</script> -->
