<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
?>
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
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Preventive_registers/createXLS">

          <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
          <?php } }?>
           <button type="submit" class="btn btn-info"> Export </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
      
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
          <div class="row">

             
              <div class="col-md-4 col-sm-3 ">
                <label  class="control-label">Filter By Area Name <span class="required">*</span></label>
                <select name="area" class="form-control select2 employees" >
                   
                    <?php
                         if ($areas): ?> 
                          <?php 
                            foreach ($areas as $key=>$value) : ?>
                               <option value="<?= $key ?>"><?= $value ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
               
             
             <div class="col-md-4 col-sm-3">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-3">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                   <div class="col-md-6 col-sm-6 ">
                   </div>
                   <div class="col-sm-4 col-sm-4   ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                      <input type="submit" class="btn btn-primary" value="Search" /> 
                      <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                      <a href="<?php echo base_url(); ?>index.php/Preventive_registers/report" class="btn btn-danger" > Reset</a>
                  </div>
                </div>
            
        </form>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered ">
          <thead>
            <tr>
             <!--  <th><input type="checkbox" id="master"></th> -->
              <th >Sr.No.</th>
              <th > Plant</th>
              <th > Frequency </th>
              <th  > Date Of Maintenance</th>
              <th  > Date Of Next Maintenance</th>
              <th  > Remark </th>
              <th  > Status </th>
              <th  > Reported By </th>
              <th  > Action Button </th>
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