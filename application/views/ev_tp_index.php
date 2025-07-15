<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
?>
<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
  }
 
</style>

      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?>!</h5>
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
      <?php endif; ?><div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="button-group float-right">
        
         <a href="<?php echo base_url(); ?>index.php/Evaluation_result/ev_transporter_add" class="btn btn-success red-tooltip" data-toggle="tooltip" title="New Evaluation" ><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
	  <form method="get" id="filterForm">
      <div class="row">

              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?= $this->lang->line('name_of_transporter') ?> <span class="required">*</span></label>
                <select name="transporter_id" class="form-control select2 suppliers" >
                    <option value="0"> <?= $this->lang->line('select_transporter') ?></option>
                    <?php
                         if ($all_transporters): ?> 
                          <?php 
                            foreach ($all_transporters as $value) : ?>
                              <?php 
                                  if ($value['id'] == $tranporter_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['transporter_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['transporter_name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?= $this->lang->line('no_result') ?></option>
                        <?php endif; ?>
                </select>
              </div>
               <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> <?= $this->lang->line('grade') ?></label>
                    <?php  $app_cat = array(
                       'No' => 'Select Option',
                          'A' => 'A',
                          'B' => 'B',
                          'c' => 'C'
                          );
                      echo form_dropdown('category_of_approval', $app_cat)
                    ?>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> <?= $this->lang->line('from_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> <?= $this->lang->line('upto_date') ?></label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
                 <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"><?= $this->lang->line('grade') ?></label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > <?= $this->lang->line('reset') ?></a>
              </div>
          </div>
        </form>
      <hr>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?= $this->lang->line('sr_no') ?>.</th>
              <th> <?= $this->lang->line('transporter_name') ?> </th>
              <th> <?= $this->lang->line('marks_obtained') ?> </th>
              <th> <?= $this->lang->line('total_marks') ?> </th>
              <th ><?= $this->lang->line('percentage') ?></th>
              <th> <?= $this->lang->line('grade') ?> </th>
              <th> <?= $this->lang->line('date') ?></th>
              <th> <?= $this->lang->line('action_button') ?></th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($er_data as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
				
                <td><?php echo $obj['transporter_name']; ?></td>
                <td><?php echo $obj['total_marks_obtained']; ?></td>
                <td><?php echo $obj['total_marks']; ?></td>
                <td><?php echo $obj['percentage']; ?></td>
                <td><?php echo $obj['approval_grade']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['date'])); ?></td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
                   <?php //$gir_id=encrypt_url($obj['id']);?>
				<a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Evaluation_result/print_sup/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>

                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Evaluation_result/ev_transporter_edit/<?php echo $obj['id'];?> "><i class="fa fa-edit"></i></a>
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">(<?php echo $obj['transporter_name']?>) <?= $this->lang->line('evaluation_details') ?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-2"><?= $this->lang->line('sr_no') ?>.</div>
                                <div class="col-md-5"><?= $this->lang->line('criteria_name') ?></div>
                                <div class="col-md-5"><?= $this->lang->line('marks') ?> </div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['er_details'] as $gir_detail)
                                      { ?>
                                        <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-2"><?= $j;?> </div>
                                          <div class="col-md-5"><?= $gir_detail['criteria'] ;?> </div>
                                          <div class="col-md-5"><?= $gir_detail['marks_obtained'] ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                                  <hr>
                           <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <!-- <div class="col-md-6">
                                <label class="control-label"> Material Received Throught : </label>
                                  <span > 
                                      <?php 
                                          //echo $obj['material_received_from']; 
                                        ?>
                                  </span>
                              </div> -->
                              <div class="col-md-12">
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
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/deleteERT/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete <b><?php echo $obj['transporter'];?> </b> <?= $this->lang->line('evaluation') ?> ? </p>
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
          url: "<?php echo base_url(); ?>index.php/Evaluation_result/deleteERT",  
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