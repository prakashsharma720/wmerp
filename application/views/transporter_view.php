<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
?>


  <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i><?=$this ->lang->line('success')?> !</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i><?=$this ->lang->line('alert')?> !</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
  <div class="nxl-content">
      <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('transporters_list') ?></h5>
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a
                  href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
              </li>
              <li class="breadcrumb-item"><?= $this->lang->line('transporters_list') ?>
              </li>
            </ul>
          </div>
           <div class="page-header-right ms-auto">
              <div class="page-header-right-items">
                  <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                      <!-- Collapse Filter -->
                      <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                          data-bs-target="#collapseOne">
                          <i class="feather-filter"></i>
                      </a>
                      <div class="pull-right d-flex">
                          <form method="post" action="<?php echo base_url(); ?>index.php/Leave/createXLS">
                              <?php if (!empty($filtered_value)) {
                                  foreach ($filtered_value as $key => $value) { ?>
                                      <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"> <?php }
                              } ?>
                              <button type="submit" class="btn btn-info"> <?= $this->lang->line('export') ?> </button>
                          </form> &nbsp;
                          <div>
                            <a href="<?php echo base_url('index.php/Leave/create'); ?>" class="btn btn-primary">
                                  <i class="feather-plus me-2"></i>
                                  <span><?= $this->lang->line('transporter_add') ?> 
                                  </span>
                              </a>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- Mobile Toggle -->
              <div class="d-md-none d-flex align-items-center">
                  <a href="javascript:void(0)" class="page-header-right-open-toggle">
                      <i class="feather-align-right fs-20"></i>
                  </a>
              </div>
            </div>
      </div>
        <?php $this->load->view('transporter/component/filter'); ?>
        <?php if ($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>
              <!< /h5>
                <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('failed')): ?>
          <div class="alert alert-error alert-dismissible ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>
              <!< /h5>
                <?php echo $this->session->flashdata('failed'); ?>
          </div>
        <?php endif; ?>
        
      </div>

<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?=$this ->lang->line('transporters_list')?></span>
       <div class="pull-right error_msg">

          <a href="<?php echo base_url(); ?>index.php/Transporters/add" class="btn btn-success" data-toggle="tooltip" title="New transporter"><i class="fa fa-plus"></i></a>

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
              <th ><?=$this ->lang->line('sr_no')?>.</th>
              <th><?=$this ->lang->line('name')?></th>
           
              <th style="white-space: nowrap;"> <?=$this ->lang->line('contact_person')?> </th>
              <th><?=$this ->lang->line('mobile_no')?></th>
             <!--  <th style="white-space: nowrap;">Approval Date</th>
              <th style="white-space: nowrap;"> Next Evalution</th> -->
              <th style="white-space: nowrap;width: 20%;"> <?=$this ->lang->line('action_button')?></th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($transporters as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php
					$voucher_no= $obj['vendor_code']; 
                    if($voucher_no<10){
                    $transporter_id_code='TP000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $transporter_id_code='TP00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $transporter_id_code='TP0'.$voucher_no;
                    }
                    else{
                      $transporter_id_code='TP'.$voucher_no;
                    }
                    
				echo $obj['transporter_name'].' ('.$transporter_id_code.')'; ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
             <!--    <td><?php echo date('d-M-Y',strtotime($obj['date_of_approval'])); ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['date_of_evalution'])); ?></td> -->
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
				 <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Transporters/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a> -->

                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Transporters/edit_transporter_view/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                <!--   <a href="<?php //echo base_url(); ?>index.php/welcome/deletetransporter/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                 <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?php echo $obj['transporter_name'];?><?=$this ->lang->line('details')?></h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('vendor_code')?>:</label>
                                    <span> <?php echo $obj['vendor_code'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('contact_person')?> :</label>
                                      <span> <?php echo $obj['contact_person'];?></span>
                                  </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('email')?> :</label>
                                    <span> <?php echo $obj['email'];?></span>
                                  </div>
                                  <div class="col-md-6 col-sm-6 ">
                                      <label class="control-label"><?=$this ->lang->line('mobile_no')?> :</label>
                                      <span> <?php echo $obj['mobile_no'];?></span>
                                  </div>
                                </div> 
                            </div> 
                             <div class="row">
                                <div class="col-md-12">
                                  <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang->line('website')?>:</label>
                                    <span> <?php echo $obj['website'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang->line('tds')?> :</label>
                                    <span> <?php echo $obj['tds'];?></span>
                                  </div>
                              </div>  
                            </div>  
                            <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('gst_no')?> :</label>
                                    <span> <?php echo $obj['gst_no'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"> <?=$this ->lang->line('pan_no')?> :</label>
                                    <span> <?php echo $obj['pan_no'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('approved_on')?>:</label>
                                    <span><?php echo date('d-M-Y',strtotime($obj['date_of_approval'])); ?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('next_evalution_date')?>:</label>
                                    <span> <?php echo date('d-M-Y',strtotime($obj['date_of_evalution'])); ?></span>
                                    
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('banh_name')?>:</label>
                                    <span> <?php echo $obj['bank_name'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('branch_name')?>:</label>
                                    <span> <?php echo $obj['branch_name'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('ifsc_code')?>:</label>
                                    <span> <?php echo $obj['ifsc_code'];?></span>
                                  </div>
                                 <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('account_no')?>:</label>
                                    <span> <?php echo $obj['account_no'];?></span>
                                  </div>
                              </div>                              
                          </div>
                           <div class="row">
                                <div class="col-md-12">
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('service_state')?>:</label>
                                    <span> <?php echo $obj['states'];?></span>
                                  </div>
                                   <div class="col-md-6 col-sm-6 ">
                                    <label class="control-label"><?=$this ->lang->line('category_of_approval')?> :</label>
                                    <span> <?php echo $obj['category_of_approval'];?></span>
                                  </div>
                              </div>    
                              </div> 
                              <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                   <div class="col-md-12 col-sm-12 ">
                                        <label class="control-label"><?=$this ->lang->line('address')?> :</label>
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
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?=$this ->lang->line('close')?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/transporters/deletetransporter/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"><?=$this ->lang->line('confirm_header')?> </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p> <?=$this ->lang->line('delete_transporter_confirm')?><b><?php echo $obj['transporter_name'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"><?=$this ->lang->line('yes')?> </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?=$this ->lang->line('no')?> </button>
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected transporters?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Transporters/deletetransporter",  
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