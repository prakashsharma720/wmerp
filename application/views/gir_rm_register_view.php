<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
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

         <a href="<?php echo base_url(); ?>index.php/Gir_registers/ApprovedPOlistForRM_GIR" class="btn btn-success red-tooltip" data-toggle="tooltip" title="New GIR Register" ><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?=$this ->lang->line('sr_no')?></th>
              <th> <?=$this ->lang->line('gir_no')?> </th>
              <th><?=$this ->lang->line('invoice_no')?> </th>
			         <th> <?=$this ->lang->line('supplier_name')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang->line('date')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang->line('total_qty')?></th>
              <th style="white-space: nowrap;width: 20%;"><?=$this ->lang->line('action_button')?></th>
            </tr>
          </thead>
          <tbody>
           <?php $i=1;foreach($gir_data as $obj){ 		  ?>

              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php echo $obj['gir_no']; ?></td>
                <td><?php echo $obj['challan_no']; ?></td>
				        <td><?php echo $obj['supplier']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['total_qty']; ?></td>
                <td >
                    <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
	              <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Gir_registers/print_gen/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>

				  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Gir_registers/raw_edit/<?php echo $obj['id'];?> "><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">GIR Register (<?php echo $obj['gir_no']?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-3"><?=$this ->lang->line('item_name')?></div>
                                <div class="col-md-3"><?=$this ->lang->line('qty')?> </div>
                                <div class="col-md-5"><?=$this ->lang->line('description')?> </div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['gir_details'] as $gir_detail)
                                      { ?>
                                        <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-3"><?= $gir_detail['item'] ;?> </div>
                                          <div class="col-md-3"><?= $gir_detail['quantity'] ;?> </div>
                                          <div class="col-md-5"><?= $gir_detail['description'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                                  <hr>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-6">
                                <label class="control-label"> Material Received Throught : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['material_received_from']; 
                                        ?>
                                  </span>
                              </div><div class="col-md-6">
                                <label class="control-label"> <?= $this->lang->line('comment') ?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['comments']; 
                                        ?>
                                  </span>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Gir_registers/deletegirRM/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang->line('confirm_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete GIR <b><?php echo $obj['gir_no'];?> </b>? </p>
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
          url: "<?php echo base_url(); ?>index.php/Gir_registers/deletegirRM",  
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