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

         <a href="<?php echo base_url(); ?>index.php/Area_cleaning_records/add" class="btn btn-success" data-toggle="tooltip" title="Create New Job Order"><i class="fa fa-plus"></i></a>

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
              <th style="white-space: nowrap;"> <?= $this->lang->line('date_of_cleaning') ?></th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('acr_number') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('reported_by') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('action_button') ?> </th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($area_cleaning_records as $obj){ ?>
              <tr>
                <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                <td><?php echo $i;?></td>
                 <td>
                  <?php 
                    if($obj['transaction_date']=='0000-00-00'){
                      echo 'NA';
                    }
                    else{
                      echo date('d-m-Y',strtotime($obj['transaction_date']));
                    }?>
                </td>
                <td><?php echo $obj['voucher_code']; ?></td>
             <!--    <td style="white-space: nowrap;"><?php  
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

                ?></td> -->
               <!--  <td style="white-space: nowrap;"><?php  
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
                </td> -->
                <td><?php echo $obj['employee']; ?></td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
                 <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Area_cleaning_records/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                 <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
               
                </td>

                    <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Area Cleaning Record (<?php echo $obj['voucher_code'] ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-3">Area Name </div>
                                <div class="col-md-2">Work Status </div>
                                <div class="col-md-3">Completed By </div>
                                <div class="col-md-3">Remarks</div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['area_cleaning_details'] as $po_detail)
                                      { 
                                           
                                        ?>
                                        <div class="row" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-3"><?= $po_detail['area_name'] ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['status_of_work'];?> </div>
                                          <div class="col-md-3">
                                            <?php 
                                              echo $po_detail['worker_name']; 
                                            
                                            ?> 
                                          </div>
                                          <div class="col-md-3"><?= $po_detail['remark'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Area_cleaning_records/deleteRecord/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete this Record ? </p>
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
          url: "<?php echo base_url(); ?>index.php/Area_cleaning_records/deleteRecord",  
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