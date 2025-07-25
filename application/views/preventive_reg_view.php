<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($employees);exit;
?>

<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
  }
</style>

      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Preventive_registers/add" class="btn btn-success" data-toggle="tooltip" title="Create New Record"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

         <!--  <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button> -->
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered ">
          <thead>
            <tr>
             <!--  <th><input type="checkbox" id="master"></th> -->
              <th ><?= $this->lang->line('sr_no') ?>.</th>
              <th > <?= $this->lang->line('plant') ?></th>
              <th > <?= $this->lang->line('frequency') ?> </th>
              <th  > <?= $this->lang->line('date_of_maintenance') ?></th>
              <th  > <?= $this->lang->line('date_of_next_maintenance') ?></th>
              <th  > <?= $this->lang->line('remark') ?> </th>
              <th  > <?= $this->lang->line('status') ?> </th>
              <th  > <?= $this->lang->line('reported_by') ?> </th>
              <th  > <?= $this->lang->line('action_button') ?> </th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($preventive_registers as $obj){ ?>
              <tr <?php if($obj['status_of_work']=='Completed'){ ?> style="background-color: #e2dfdf;" <?php } ?>>
                <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                <td><?php echo $i;?></td>
                <td><?php echo $obj['plant_name']; ?></td>
                <td><?php echo $obj['frequency']; ?></td>
                 <td>
                  <?php 
                    if($obj['date_of_maintenance']=='0000-00-00'){
                      echo 'NA';
                    }
                    else{
                      echo date('d-m-Y',strtotime($obj['date_of_maintenance']));
                    }?>
                </td>
                <td>
                  <?php 
                    if($obj['next_maintenance_date']=='0000-00-00'){
                      echo 'NA';
                    }
                    else{
                      echo date('d-m-Y',strtotime($obj['next_maintenance_date']));
                    }?>
                </td>
                <td><?php echo $obj['remark']; ?></td>
                <td><?php echo $obj['status_of_work']; ?></td>
                <!-- <td  ><?php  
                    $voucher_no= $obj['worker_code']; 
                    if($voucher_no<10){
                    $worker_id_code='WC000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $worker_id_code='WC00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $worker_id_code='WC0'.$voucher_no;
                    }
                    else{
                      $worker_id_code='WC'.$voucher_no;
                    }
                    echo $obj['worker_name'].' ('.$worker_id_code.')';

                ?> -->
                <td  >
                  <?php  
                    $voucher_no= $obj['emp_code']; 
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
                    echo $obj['emp_name'].' ('.$employee_id_code.')';

                ?>
                </td>
                
                <td >
                   <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>  -->

                  <?php if($obj['status_of_work']=='Pending'){
                    ?>
                 <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Preventive_registers/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>

                 <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                <?php } ?>

                <!--   <a href="<?php //echo base_url(); ?>index.php/welcome/deleteSupplier/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Preventive_registers/deleteRecord/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p><?= $this->lang->line('confirm_delete') ?>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
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
          url: "<?php echo base_url(); ?>index.php/Preventive_registers/deleteRecord",  
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