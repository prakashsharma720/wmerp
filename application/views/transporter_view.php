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
        <h5 class="m-b-10"><?= $this->lang->line('rm_code_list') ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"><?= $this->lang->line('rm_code_list') ?></li>
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

          <!-- Export + Add New -->
          <div class="d-flex gap-2">
            <form method="post" action="<?= base_url('index.php/YourController/exportRmCode') ?>">
              <!-- Yahan agar filter ka data bhejna ho toh hidden inputs laga lena -->
              <button type="submit" class="btn btn-info">
                <?= $this->lang->line('export') ?>
              </button>
            </form>

            <a href="<?= base_url('index.php/YourController/addRmCode') ?>" class="btn btn-primary">
              <i class="feather-plus me-2"></i>
              <?= $this->lang->line('add_rm_code') ?>
            </a>
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

  <!-- Filters Section -->
  <div class="collapse mb-3" id="collapseOne">
    <?php $this->load->view('rm_codes/component/filter'); ?>
  </div>

  <!-- Table -->
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?= $this->lang->line('rm_code_list') ?></span>
      <div class="pull-right">
        <a href="<?= base_url('index.php/YourController/addRmCode') ?>" class="btn btn-success" data-toggle="tooltip" title="New RM Code">
          <i class="fa fa-plus"></i>
        </a>

        <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();">
          <i class="fa fa-refresh"></i>
        </button>

        <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete">
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
      <div class="table-responsive">
        <table id="rmCodeTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th><?= $this->lang->line('sr_no') ?></th>
              <th><?= $this->lang->line('rm_code') ?></th>
              <th><?= $this->lang->line('description') ?></th>
              <th><?= $this->lang->line('status') ?></th>
              <th><?= $this->lang->line('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; foreach ($rm_codes as $rm): ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?= $rm['id'] ?>"></td>
                <td><?= $i++ ?></td>
                <td><?= $rm['code'] ?></td>
                <td><?= $rm['description'] ?></td>
                <td><?= $rm['status'] == 1 ? 'Active' : 'Inactive' ?></td>
                <td>
                  <a class="btn btn-xs btn-primary" href="<?= base_url('index.php/YourController/editRmCode/' . $rm['id']) ?>">
                    <i class="fa fa-edit"></i>
                  </a>
                  <a class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $rm['id'] ?>">
                    <i class="fa fa-trash"></i>
                  </a>
                </td>
              </tr>

              <!-- Delete Modal -->
              <div class="modal fade" id="delete<?= $rm['id'] ?>" role="dialog">
                <div class="modal-dialog">
                  <form method="post" action="<?= base_url('index.php/YourController/deleteRmCode/' . $rm['id']) ?>">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p><?= $this->lang->line('delete_rm_code_confirm') ?> <b><?= $rm['code'] ?></b>?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><?= $this->lang->line('yes') ?></button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('no') ?></button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            <?php endforeach; ?>
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