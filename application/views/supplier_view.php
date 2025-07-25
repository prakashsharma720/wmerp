
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
	<div class="alert alert-error alert-dismissible ">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
		<?php echo $this->session->flashdata('failed'); ?>
	</div>
<?php endif; ?>

<!-- Page Header -->
<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('suppliers_list') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
        <!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?></li> -->
         
      </ul>
      
    </div>

    <div class="page-header-right ms-auto">
  <div class="page-header-right-items">
    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
      <div class="d-flex">
        <!-- New Filter Button -->
        <!-- Filter Button -->
<button class="btn btn-sm border-0 shadow-none p-2 text-dark fs-5" type="button" data-bs-toggle="collapse" data-bs-target="#filterFormWrapper" aria-expanded="false" aria-controls="filterFormWrapper" data-bs-toggle="tooltip" title="Filter">
  <i class="fa fa-filter fa-lg"></i>
</button>

<!-- Add Button -->
<a href="<?= base_url(); ?>index.php/Purchase_order/add" class="btn btn-sm border-0 shadow-none p-2 text-dark fs-5" data-bs-toggle="tooltip" title="New PO">
  <i class="fa fa-plus fa-lg"></i>
</a>

<!-- Refresh Button -->
<button class="btn btn-sm border-0 shadow-none p-2 text-dark fs-5" data-bs-toggle="tooltip" title="Refresh" onclick="location.reload();">
  <i class="fa fa-refresh fa-lg"></i>
</button>

<!-- Bulk Delete Button -->
<button class="btn btn-sm border-0 shadow-none p-2 text-dark fs-5" data-bs-toggle="tooltip" title="Bulk Delete">
  <i class="fa fa-trash fa-lg"></i>
</button>

      </div>
    </div>
  </div>
</div>

  </div>
<!-- Filter Section (Collapsible) -->
<div class="collapse" id="filterFormWrapper">
  <div class="card border-0 shadow-sm mt-3 mb-3 mx-2">
    <div class="card-body p-3">
      <!-- Filter Form -->

      <form method="get" action="<?= base_url(); ?>index.php/Purchase_order/filter">

       <div class="row mb-2">
           <div class="col-md-4 col-sm-4 ">
            <label class="control-label"><?= $this->lang->line('supplier_category') ?> <span class="required">*</span></label>
            <select name="categories_id" class="form-control select2 category">
              <option value="0"><?= $this->lang->line('select_category') ?></option>
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
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-md-4 col-sm-4 ">
            <label class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
            <select name="supplier_id" class="form-control select2 suppliers">
              <option value="0"> <?= $this->lang->line('select_supplier') ?></option>
              <?php
              if ($all_suppliers): ?>
                <?php
                foreach ($all_suppliers as $value) : ?>
                  <?php
                  $voucher_no = $value['vendor_code'];
                  if ($voucher_no < 10) {
                    $supplier_id_code = 'SUP000' . $voucher_no;
                  } else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
                    $supplier_id_code = 'SUP00' . $voucher_no;
                  } else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
                    $supplier_id_code = 'SUP0' . $voucher_no;
                  } else {
                    $supplier_id_code = 'SUP' . $voucher_no;
                  }

                  if ($value['id'] == $supplier_id): ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] . ' (' . $supplier_id_code . ')' ?></option>
                  <?php else: ?>
                    <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] . ' (' . $supplier_id_code . ')' ?></option>
                  <?php endif;   ?>
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>
            <div class="col-md-4 col-sm-4">
              <label class="control-label">Category of Approval</label>
              <select class="form-control select2" name="category_of_approval">
                <option value="No">Select Option</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="c">C</option>
              </select>
            </div>
          </div>
        <div class="row">



            <div class="col-md-4 col-sm-4 hstack gap-2 justify-content-start mt-4">

              <input type="submit" class="btn btn-primary" value="Search">
              <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
              <a href="http://localhost/wmerp/index.php/suppliers/index" class="btn btn-danger"> Reset</a>
            </div>
          </div>
        
      </form>
    </div>
  </div>
</div>

  <div class="container-fluid">
<div class="card-body"></div>
        
    <!-- /.card-body -->
    <div class="card-body">
      
        
          <!--  <div class="col-md-4 col-sm-4">-->
          <!--      <label  class="control-label"> From Date</label>-->
          <!--        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">-->
          <!--  </div>-->
          <!--  <div class="col-md-4 col-sm-4">-->
          <!--    <label  class="control-label"> Upto Date</label>-->
          <!--      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">-->
          <!--</div>-->
         
        
      
      
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th><?= $this->lang->line('sr_no') ?>.</th>
              <th> <?= $this->lang->line('name') ?> </th>
              <th> <?= $this->lang->line('category') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('contact_person') ?></th>
              <th> <?= $this->lang->line('email') ?></th>
              <th> <?= $this->lang->line('mobile') ?></th>
              <th> <?= $this->lang->line(' approval_category') ?></th>
              <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($suppliers as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td><?php
                    $voucher_no = $obj['vendor_code'];
                    if ($voucher_no < 10) {
                      $supplier_id_code = 'SUP000' . $voucher_no;
                    } else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
                      $supplier_id_code = 'SUP00' . $voucher_no;
                    } else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
                      $supplier_id_code = 'SUP0' . $voucher_no;
                    } else {
                      $supplier_id_code = 'SUP' . $voucher_no;
                    }

                    echo $obj['supplier_name'] . ' (' . $supplier_id_code . ')'; ?></td>
                <td><?php echo $obj['category']; ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['email']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
                <td><?php echo $obj['category_of_approval']; ?></td>
                <td>
  <div class="d-flex gap-2">
    <!-- View Button -->
    <a class="btn btn-sm border-0 shadow-none p-1 text-dark" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>" title="View">
      <i class="fa fa-eye"></i>
    </a>

    <!-- Print Button -->
    <a class="btn btn-sm border-0 shadow-none p-1 text-dark" href="<?php echo base_url(); ?>index.php/Suppliers/print/<?php echo $obj['id']; ?>" title="Print">
      <i class="fa fa-print"></i>
    </a>

    <!-- Edit Button -->
    <a class="btn btn-sm border-0 shadow-none p-1 text-dark" href="<?php echo base_url(); ?>index.php/Suppliers/edit_supplier_view/<?php echo $obj['id']; ?>" title="Edit">
      <i class="fa fa-edit"></i>
    </a>

    <!-- Delete Button -->
    <a class="btn btn-sm border-0 shadow-none p-1 text-dark" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>" title="Delete">
      <i class="fa fa-trash"></i>
    </a>
  </div>
</td>


                  <!--   <a href="<?php //echo base_url(); 
                                  ?>index.php/welcome/deleteSupplier/<?php echo $obj['id']; ?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                
                <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"><?php echo $obj['supplier_name']; ?> <?= $this->lang->line('details') ?> </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('supplier_code') ?> :</label>
                              <span> <?php echo $supplier_id_code; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('contact_person') ?> :</label>
                              <span> <?php echo $obj['contact_person']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('email') ?> :</label>
                              <span> <?php echo $obj['email']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('mobile') ?> :</label>
                              <span> <?php echo $obj['mobile_no']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('website') ?>:</label>
                              <span> <?php echo $obj['website']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('tds') ?>:</label>
                              <span> <?php echo $obj['tds']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('gst_no') ?> :</label>
                              <span> <?php echo $obj['gst_no']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('pan_no') ?> :</label>
                              <span> <?php echo $obj['pan_no']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('category_of_approval') ?> :</label>
                              <span> <?php echo $obj['category_of_approval']; ?></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('approved_on') ?>:</label>
                              <span><?php echo date('d-M-Y', strtotime($obj['date_of_approval'])); ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('next_evalution_date') ?>:</label>
                              <span> <?php echo date('d-M-Y', strtotime($obj['date_of_evalution'])); ?></span>

                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('bank_name') ?>:</label>
                              <span> <?php echo $obj['bank_name']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('branch_name') ?>:</label>
                              <span> <?php echo $obj['branch_name']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('ifsc_code') ?>:</label>
                              <span> <?php echo $obj['ifsc_code']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('account_no') ?></label>
                              <span> <?php echo $obj['account_no']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('country') ?>:</label>
                              <span> <?php echo $obj['country']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('state') ?>:</label>
                              <span> <?php echo $obj['state']; ?></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('city') ?> :</label>
                              <span> <?php echo $obj['city']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('address') ?> :</label>
                              <span> <?php echo $obj['address']; ?></span>
                            </div>
                          </div>
                        </div>
                        <!--  <div class="row col-md-12">
                                <div class="col-md-12">
                                  <label class="control-label">Address:</label>
                                   <span> <?php echo $obj['address']; ?></span>
                             </div>                              
                          </div>      -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Suppliers/deleteSupplier/<?php echo $obj['id']; ?>">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                          <p><?= $this->lang->line('delete_supplier_confirm') ?><b><?php echo $obj['supplier_name']; ?> </b>? </p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?></button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
    
  </div>
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    jQuery('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    jQuery('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });
      //alert(allVals.length); return false;  
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete all selected suppliers?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Suppliers/deleteSupplier",
            cache: false,
            data: 'ids=' + join_selected_values,
            success: function(response) {
              $(".successs_mesg").html(response);
              location.reload();
            }
          });

        }
      }
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';
    //alert(base_url);
    $(document).on('change', '.category', function() {
      var category_id = $('.category').find('option:selected').val();
      //var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
      //alert(category_id);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>" + category_id,
        //data: {id:role_id},
        dataType: 'html',
        success: function(response) {
          //alert(response);
          $(".suppliers").html(response);
          $('.select2').select2();
          //$('.category').find('option:selected').prop('required',true);

        }
      });
    });
  });
</script>

















<?php
defined('BASEPATH') or exit('No direct script access allowed');
$current_page = current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data = explode('?', $current_page);
//print_r($data[0]);exit;
?>

<style type="text/css">
  .col-sm-6,
  .col-md-6 {
    float: left;
  }
</style>

<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
    <?php echo $this->session->flashdata('success'); ?>
  </div>
  <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>




<div class="container-fluid">
  <div class="card card-primary card-outline">




    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
      <!-- Left: Title + Breadcrumbs -->
      <div class="d-flex align-items-center gap-3 flex-wrap">
        <h5 class="mb-0 fw-bold"><?= $this->lang->line('suppliers_list') ?></h5>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a href="<?= base_url(); ?>index.php/User_authentication/admin_dashboard">
                <?= $this->lang->line('home') ?>
              </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page"><?= $this->lang->line('suppliers_list') ?></li>
          </ol>
        </nav>
      </div>

      <!-- Right: Action Buttons -->
      <div class="d-flex align-items-center gap-2">
        <!-- Filter Button -->
        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand collapsed"
          data-bs-toggle="collapse" data-bs-target="#collapseOne" title="<?= $this->lang->line('filter') ?>">
          <i class="feather-filter"></i>
        </a>

        <!-- Add New Supplier -->
        <a href="<?= base_url(); ?>index.php/Suppliers/add" class="btn btn-icon btn-light-brand" title="<?= $this->lang->line('new_supplier') ?>">
          <i class="feather-plus"></i>
        </a>

        <!-- Bulk Delete -->
        <button class="btn btn-icon btn-light-brand delete_all" title="<?= $this->lang->line('bulk_delete') ?>">
          <i class="feather-trash"></i>
        </button>

        <!-- Excel Download -->
        <form method="post" action="<?= base_url(); ?>index.php/Leave/createXLS">
          <input type="hidden" name="transporter_id" value="">
          <input type="hidden" name="category_of_approval" value="">
          <input type="hidden" name="upto_date" value="">
          <input type="hidden" name="from_date" value="">
          <button type="submit" class="btn btn-icon btn-light-brand" title="<?= $this->lang->line('excel_download') ?>">
            <i class="feather-download"></i>
          </button>
        </form>
      </div>
    </div>

    <div id="collapseOne" class="accordion-collapse page-header-collapse collapse show" style="">
      <div class="accordion-body pb-2">
        <div class="card-body"></div>
        <form method="get" id="filterForm">
          <div class="row mb-2">
           <div class="col-md-4 col-sm-4 ">
            <label class="control-label"><?= $this->lang->line('supplier_category') ?> <span class="required">*</span></label>
            <select name="categories_id" class="form-control select2 category">
              <option value="0"><?= $this->lang->line('select_category') ?></option>
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
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>
           <div class="col-md-4 col-sm-4 ">
            <label class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
            <select name="supplier_id" class="form-control select2 suppliers">
              <option value="0"> <?= $this->lang->line('select_supplier') ?></option>
              <?php
              if ($all_suppliers): ?>
                <?php
                foreach ($all_suppliers as $value) : ?>
                  <?php
                  $voucher_no = $value['vendor_code'];
                  if ($voucher_no < 10) {
                    $supplier_id_code = 'SUP000' . $voucher_no;
                  } else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
                    $supplier_id_code = 'SUP00' . $voucher_no;
                  } else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
                    $supplier_id_code = 'SUP0' . $voucher_no;
                  } else {
                    $supplier_id_code = 'SUP' . $voucher_no;
                  }

                  if ($value['id'] == $supplier_id): ?>
                    <option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] . ' (' . $supplier_id_code . ')' ?></option>
                  <?php else: ?>
                    <option value="<?= $value['id'] ?>"><?= $value['supplier_name'] . ' (' . $supplier_id_code . ')' ?></option>
                  <?php endif;   ?>
                <?php endforeach;  ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>
            <div class="col-md-4 col-sm-4">
              <label class="control-label">Category of Approval</label>
              <select class="form-control select2" name="category_of_approval">
                <option value="No">Select Option</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="c">C</option>
              </select>
            </div>
          </div>
          <div class="row">



            <div class="col-md-4 col-sm-4 hstack gap-2 justify-content-start mt-4">

              <input type="submit" class="btn btn-primary" value="Search">
              <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
              <a href="http://localhost/wmerp/index.php/Transporters/index" class="btn btn-danger"> Reset</a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-body">
      
        
          <!--  <div class="col-md-4 col-sm-4">-->
          <!--      <label  class="control-label"> From Date</label>-->
          <!--        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">-->
          <!--  </div>-->
          <!--  <div class="col-md-4 col-sm-4">-->
          <!--    <label  class="control-label"> Upto Date</label>-->
          <!--      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">-->
          <!--</div>-->
         
        
      
      
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th><?= $this->lang->line('sr_no') ?>.</th>
              <th> <?= $this->lang->line('name') ?> </th>
              <th> <?= $this->lang->line('category') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('contact_person') ?></th>
              <th> <?= $this->lang->line('email') ?></th>
              <th> <?= $this->lang->line('mobile') ?></th>
              <th> <?= $this->lang->line(' approval_category') ?></th>
              <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($suppliers as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td><?php
                    $voucher_no = $obj['vendor_code'];
                    if ($voucher_no < 10) {
                      $supplier_id_code = 'SUP000' . $voucher_no;
                    } else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
                      $supplier_id_code = 'SUP00' . $voucher_no;
                    } else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
                      $supplier_id_code = 'SUP0' . $voucher_no;
                    } else {
                      $supplier_id_code = 'SUP' . $voucher_no;
                    }

                    echo $obj['supplier_name'] . ' (' . $supplier_id_code . ')'; ?></td>
                <td><?php echo $obj['category']; ?></td>
                <td><?php echo $obj['contact_person']; ?></td>
                <td><?php echo $obj['email']; ?></td>
                <td><?php echo $obj['mobile_no']; ?></td>
                <td><?php echo $obj['category_of_approval']; ?></td>
                <td>
                  <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-eye"></i></a>

                  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Suppliers/print/<?php echo $obj['id']; ?>"><i class="fa fa-print"></i></a>

                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Suppliers/edit_supplier_view/<?php echo $obj['id']; ?>"><i class="fa fa-edit"></i></a>

                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                  <!--   <a href="<?php //echo base_url(); 
                                  ?>index.php/welcome/deleteSupplier/<?php echo $obj['id']; ?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                </td>
                <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title"><?php echo $obj['supplier_name']; ?> <?= $this->lang->line('details') ?> </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('supplier_code') ?> :</label>
                              <span> <?php echo $supplier_id_code; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('contact_person') ?> :</label>
                              <span> <?php echo $obj['contact_person']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('email') ?> :</label>
                              <span> <?php echo $obj['email']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('mobile') ?> :</label>
                              <span> <?php echo $obj['mobile_no']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('website') ?>:</label>
                              <span> <?php echo $obj['website']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('tds') ?>:</label>
                              <span> <?php echo $obj['tds']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('gst_no') ?> :</label>
                              <span> <?php echo $obj['gst_no']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"> <?= $this->lang->line('pan_no') ?> :</label>
                              <span> <?php echo $obj['pan_no']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('category_of_approval') ?> :</label>
                              <span> <?php echo $obj['category_of_approval']; ?></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('approved_on') ?>:</label>
                              <span><?php echo date('d-M-Y', strtotime($obj['date_of_approval'])); ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('next_evalution_date') ?>:</label>
                              <span> <?php echo date('d-M-Y', strtotime($obj['date_of_evalution'])); ?></span>

                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('bank_name') ?>:</label>
                              <span> <?php echo $obj['bank_name']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('branch_name') ?>:</label>
                              <span> <?php echo $obj['branch_name']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('ifsc_code') ?>:</label>
                              <span> <?php echo $obj['ifsc_code']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('account_no') ?></label>
                              <span> <?php echo $obj['account_no']; ?></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('country') ?>:</label>
                              <span> <?php echo $obj['country']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('state') ?>:</label>
                              <span> <?php echo $obj['state']; ?></span>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('city') ?> :</label>
                              <span> <?php echo $obj['city']; ?></span>
                            </div>
                            <div class="col-md-6 col-sm-6 ">
                              <label class="control-label"><?= $this->lang->line('address') ?> :</label>
                              <span> <?php echo $obj['address']; ?></span>
                            </div>
                          </div>
                        </div>
                        <!--  <div class="row col-md-12">
                                <div class="col-md-12">
                                  <label class="control-label">Address:</label>
                                   <span> <?php echo $obj['address']; ?></span>
                             </div>                              
                          </div>      -->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Suppliers/deleteSupplier/<?php echo $obj['id']; ?>">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                          <p><?= $this->lang->line('delete_supplier_confirm') ?><b><?php echo $obj['supplier_name']; ?> </b>? </p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary delete_submit"> <?= $this->lang->line('yes') ?></button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>

              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
    
  </div>
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    jQuery('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    jQuery('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
      });
      //alert(allVals.length); return false;  
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete all selected suppliers?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Suppliers/deleteSupplier",
            cache: false,
            data: 'ids=' + join_selected_values,
            success: function(response) {
              $(".successs_mesg").html(response);
              location.reload();
            }
          });

        }
      }
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';
    //alert(base_url);
    $(document).on('change', '.category', function() {
      var category_id = $('.category').find('option:selected').val();
      //var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
      //alert(category_id);
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>" + category_id,
        //data: {id:role_id},
        dataType: 'html',
        success: function(response) {
          //alert(response);
          $(".suppliers").html(response);
          $('.select2').select2();
          //$('.category').find('option:selected').prop('required',true);

        }
      });
    });
  });
</script>