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

<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('service_provider_list') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('view_list') ?></li>
      </ul>
    </div>
    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      <a href="<?php echo base_url(); ?>index.php/Service_providers/add" class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="New service_provider"><i class="feather feather-plus"></i></a>

         <button class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-icon btn-light-brand delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="feather feather-trash"></i></button>  
      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">

        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
<div class="main-content">
		<div class="row">
			<div class="col-xl-12">
				<div class="card stretch stretch-full">
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
                    <a href="<?php echo $data[0] ?>" class="btn btn-danger" style="position:relative;width:80px;left:85px;bottom:60px"> <?=$this ->lang ->line('reset')?></a>
                </div>
            </div>
        </form>
       <div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
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
                <td  style="display: flex; gap:8px; align-items:center">
                   <!-- <a class="btn btn-icon btn-light-brand" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i class="feather feather-eye"></i></a> -->
                    <a class="btn btn-icon btn-light-brand" data-bs-toggle="offcanvas" data-bs-target="#Viewservice<?= $obj['id']; ?>" title="View More">
                            <i class="feather feather-eye"></i>
                          </a>
				  <a class="btn btn-icon btn-light-brand" href="<?php echo base_url(); ?>index.php/Service_providers/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>

                  <a class="btn btn-icon btn-light-brand" href="<?php echo base_url(); ?>index.php/Service_providers/edit_service_provider_view/<?php echo $obj['id'];?>"><i class="feather feather-edit-3"></i></a>
                  
                  <!-- <a class="btn btn-icon btn-light-brand" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i class="feather feather-trash"></i></a> -->
                
                 <a href="javascript:void(0);" 
   onclick="deleteService_provider(<?= $obj['id'] ?>)" 
   class="btn btn-icon btn-light-brand" 
   data-bs-toggle="tooltip" 
   title="Delete">
   <i class="feather feather-trash"></i>
</a>

                </td>

                <?php $this->load->view('leave-module/component/Viewservice.php', ['obj' => $obj]); ?>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close'); ?></button>
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
                            <p> <?=$this ->lang ->line('delete_service_provider_confirm')?><b><?php echo $obj['service_provider_name'];?> </b>? </p>
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
<script>
function deleteService_provider(id) {
    if (confirm("Are you sure you want to delete this service provider?")) {
       
        window.location.href = "<?= base_url('index.php/Service_providers/deleteService_provider/') ?>" + id;

    }
}
</script>

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