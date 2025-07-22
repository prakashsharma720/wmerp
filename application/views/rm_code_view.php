<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($rmcodes);exit;

?>

<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
  }
</style>

  <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('success')?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('alert')?>!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>

<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <!-- <span class="card-title"><?=$this ->lang ->line('rm_code_list')?></span>
        <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Rm_code/add" class="btn btn-success" data-toggle="tooltip" title="New RM Code"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button> -->
        <span class="card-title">Rm Code List         </span>
            <div class="button-group float-right d-flex">

                <a href="http://localhost/wmerp/index.php/Employees/add" class="btn btn-success" data-toggle="tooltip" title="New Employee"><i class="fa fa-plus"></i></a>
                <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

                <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="fa fa-trash"></i></button>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?=$this ->lang ->line('dsr_no')?></th>
              <th> <?=$this ->lang ->line('grid_number')?> </th>
              <th><?=$this ->lang ->line('supplier_name')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('raw_material')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang ->line('grade')?></th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('rm_code')?></th>
              <th style="white-space: nowrap;width: 20%;"> <?=$this ->lang ->line('action')?></th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($rmcodes as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php echo $obj['grid_number']; ?></td>
                <td><?php echo $obj['supplier']; ?></td>
                <td><?php echo $obj['rm_name']; ?></td>
                <td><?php echo $obj['grade']; ?></td>
                <td><?php echo $obj['rm_code']; ?></td>
                <td >
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Rm_code/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Rm_code/deleteRM/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang ->line('confirm_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete this Grid Number <b><?php echo $obj['grid_number'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?=$this ->lang ->line('yes')?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <?=$this ->lang ->line('no')?> </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
            <?php  $i++;} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
     
    jQuery('#master').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
      $(".sub_chk").prop('checked', true);  
    }  
    else  
    {  
      $(".sub_chk").prop('checked',false);  
    }  
  });
    jQuery('.delete_all').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Rm_code/deleteRM",  
          cache:false,  
          data: 'ids='+join_selected_values,  
          success: function(response)  
          {   
            $(".successs_mesg").html(response);
            location.reload();
          }   
        });
           
      }  
    }  
  });

  });
</script>