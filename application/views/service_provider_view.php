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
      <span class="card-title"><?php  echo $title; ?></span>
       <div class="pull-right error_msg">
          <a href="<?php echo base_url(); ?>index.php/Service_providers/add" class="btn btn-success" data-toggle="tooltip" title="New service_provider"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>  
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
       <form method="get" id="filterForm">
      <div class="row">
          <div class="col-md-4 col-sm-4 ">
                  <label  class="control-label"><?=$this ->lang ->line('supplier_category')?> <span class="required">*</span></label>
                  <select name="categories_id" class="form-control select2 category" >
                     <option value="0"><?=$this ->lang ->line('select_category')?></option>
                        <?php
                         if ($categories): ?> 
                          <?php 
                            foreach ($categories as $value) : ?>
                                <?php 
                                  if ($value['id'] == $current[0]->categories_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option>
                                  <?php endif;   ?>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang ->line('bno_result')?></option>
                        <?php endif; ?>
                    </select>
                </div>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?=$this ->lang ->line('name_of_service_provider')?> <span class="required">*</span></label>
                <select name="service_provider_id" class="form-control select2 service_providers" >
                    <option value="0"><?=$this ->lang ->line('select_service_provider')?></option>
                    <?php
                         if ($all_service_providers): ?> 
                          <?php 
                            foreach ($all_service_providers as $value) : ?>
                              <?php 
                                  if ($value['id'] == $service_provider_id): ?>
                                      <option value="<?= $value['id'] ?>" selected><?= $value['service_provider_name'] ?></option>
                                  <?php else: ?>
                                      <option value="<?= $value['id'] ?>"><?= $value['service_provider_name'] ?></option>
                                  <?php endif;   ?>
                                   <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang ->line('no_result')?></option>
                        <?php endif; ?>
                </select>
              </div>
               <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> <?=$this ->lang ->line('category_of_approval')?></label>
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
                   <div class="col-md-4 col-sm-4 ">
                    <label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label>
                    <button type="submit" class="btn btn-primary"> <?=$this ->lang ->line('search')?></button>
                    <label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label>
                    <a href="<?php echo $data[0] ?>" class="btn btn-danger"> <?=$this ->lang ->line('reset')?></a>
                </div>
            </div>
        </form>
            <hr>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?=$this ->lang ->line('sr_no')?>.</th>
              <th> <?=$this ->lang ->line('category_of_approval')?> </th>
              <th> <?=$this ->lang ->line('name')?> </th>
              <th> <?=$this ->lang ->line('category')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('contact_person')?> </th>
              <th> <?=$this ->lang ->line('email')?></th>
              <th> <?=$this ->lang ->line('mobile')?></th>
              <th style="white-space: nowrap;width: 20%;"><?=$this ->lang ->line('action_button')?></th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($service_providers as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                 <td><?php echo $obj['category_of_approval']; ?></td>
                <td><?php
				$voucher_no= $obj['service_provider_code']; 
                    if($voucher_no<10){
                    $sp_id_code='SP000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $sp_id_code='SP00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $sp_id_code='SP0'.$voucher_no;
                    }
                    else{
                      $sp_id_code='SP'.$voucher_no;
                    }
                    
				echo $obj['service_provider_name'].' ('.$sp_id_code.')'; 
				 ?></td>
                <td><?php echo $obj['category']; ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['email']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
				  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Service_providers/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>

                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Service_providers/edit_service_provider_view/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                <!--   <a href="<?php //echo base_url(); ?>index.php/welcome/deleteservice_provider/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['service_provider_name'];?> <?=$this ->lang ->line('details')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang ->line('service_provider_code')?> :</label>
                                    <span> <?php echo $obj['service_provider_code'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang ->line('contact_person')?> :</label>
                                      <span> <?php echo $obj['contact_person'];?></span>
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('email')?> :</label>
                                    <span> <?php echo $obj['email'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label"><?=$this ->lang ->line('mobile')?> :</label>
                                      <span> <?php echo $obj['mobile_no'];?></span>
                                  </div>
                                </div> 
                            </div> 
                             <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang ->line('website')?> :</label>
                                    <span> <?php echo $obj['website'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang ->line('til_no')?> :</label>
                                    <span> <?php echo $obj['tds'];?></span>
                                  </div>
                              </div>  
                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('gst_no')?> :</label>
                                    <span> <?php echo $obj['gst_no'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang ->line('pan_no')?> :</label>
                                    <span> <?php echo $obj['pan_no'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('category_of_approval')?> :</label>
                                    <span> <?php echo $obj['category_of_approval'];?></span>
                                  </div>
                              </div>                              
                          </div>
                          
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('approved_on')?></label>
                                    <span><?php echo date('d-M-Y',strtotime($obj['date_of_approval'])); ?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('next_evalution_date')?>:</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['date_of_evalution'])); ?></span>
                                    
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('bank_name')?>:</label>
                                    <span> <?php echo $obj['bank_name'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('branch_name')?>:</label>
                                    <span> <?php echo $obj['branch_name'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('ifsc_code')?>:</label>
                                    <span> <?php echo $obj['ifsc_code'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('account_no')?>:</label>
                                    <span> <?php echo $obj['account_no'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('state')?> :</label>
                                    <span> <?php echo $obj['state'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang ->line('address')?> :</label>
                                    <span> <?php echo $obj['address'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <!--  <div class="row col-md-12">
                                <div class="col-md-12">
                                  <label class="control-label">Address:</label>
                                   <span> <?php echo $obj['address'];?></span>
                             </div>                              
                          </div>      -->
                        </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Service_providers/deleteservice_provider/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang ->line('confirm_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete service_provider <b><?php echo $obj['service_provider_name'];?> </b>? </p>
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected service_providers?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/service_providers/deleteservice_provider",  
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