
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
        <h5 class="m-b-10"><?= $this->lang->line('rm_code_list') ?></h5>
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
          <!-- Collapse Filter -->


          <div class="d-flex">



            <!-- Action Buttons -->
            <a href="<?= base_url(); ?>index.php/Purchase_order/add" class="btn btn-lg border-0 shadow-none px-3 py-2 text-dark" data-bs-toggle="tooltip" title="New PO">
              <i class="fa fa-plus"></i>
            </a>

            <button class="btn btn-lg border-0 shadow-none px-3 py-2 text-dark" data-bs-toggle="tooltip" title="Refresh" onclick="location.reload();">
  <i class="fa fa-refresh fa-lg"></i>
</button>

<button class="btn btn-lg border-0 shadow-none px-3 py-2 text-dark" data-bs-toggle="tooltip" title="Bulk Delete">
  <i class="fa fa-trash fa-lg"></i>
</button>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <div class="container-fluid">
     

    <div class="card card-outline card-primary">
      <div class="card-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th><input type="checkbox" id="master"></th>
                <th><?= $this->lang->line('dsr_no') ?></th>
                <th><?= $this->lang->line('grid_number') ?></th>
                <th><?= $this->lang->line('supplier_name') ?></th>
                <th style="white-space: nowrap;"><?= $this->lang->line('raw_material') ?></th>
                <th style="white-space: nowrap;"><?= $this->lang->line('grade') ?></th>
                <th style="white-space: nowrap;"><?= $this->lang->line('rm_code') ?></th>
                <th style="white-space: nowrap;width: 20%;"><?= $this->lang->line('action') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1;
              foreach ($rmcodes as $obj) { ?>
                <tr>
                  <td><input type="checkbox" class="sub_chk" value="<?= $obj['id']; ?>" /></td>
                  <td><?= $i; ?></td>
                  <td><?= $obj['grid_number']; ?></td>
                  <td><?= $obj['supplier']; ?></td>
                  <td><?= $obj['rm_name']; ?></td>
                  <td><?= $obj['grade']; ?></td>
                  <td><?= $obj['rm_code']; ?></td>
                  <td>
                    <div class="d-flex align-items-center">
  <a class="btn btn-sm border-0 shadow-none p-1 text-dark" href="<?= base_url(); ?>index.php/Rm_code/edit/<?= $obj['id']; ?>" title="Edit">
    <i class="fa fa-edit"></i>
  </a>
  <a class="btn btn-sm border-0 shadow-none p-1 text-dark ml-2" data-toggle="modal" data-target="#delete<?= $obj['id']; ?>" title="Delete">
    <i class="fa fa-trash"></i>
  </a>
</div>

                  </td>
                </tr>

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="delete<?= $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form method="post" action="<?= base_url(); ?>index.php/Rm_code/deleteRM/<?= $obj['id']; ?>">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?></h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <p>Are you sure you want to delete this Grid Number <strong><?= $obj['grid_number']; ?></strong>?</p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary"> <?= $this->lang->line('yes') ?> </button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal"> <?= $this->lang->line('no') ?> </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              <?php $i++; } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JS: Master checkbox logic -->
<script src="<?= base_url() . "assets/plugins/jquery/jquery.min.js"; ?>"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#master').on('click', function () {
      $(".sub_chk").prop('checked', $(this).is(':checked'));
    });

    $('.delete_all').on('click', function () {
      var allVals = $(".sub_chk:checked").map(function () {
        return $(this).val();
      }).get();

      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        if (confirm("Are you sure you want to delete all selected records?")) {
          $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>index.php/Rm_code/deleteRM",
            cache: false,
            data: { ids: allVals.join(",") },
            success: function (response) {
              $(".successs_mesg").html(response);
              location.reload();
            }
          });
        }
      }
    });
  });
</script>






















<?php
defined('BASEPATH') or exit('No direct script access allowed');

//print_r($rmcodes);exit;

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
    <div class="card-header">
      <span class="card-title"><?= $this->lang->line('rm_code_list') ?></span>
      <div class="button-group float-right">

        <a href="<?php echo base_url(); ?>index.php/Rm_code/add" class="btn btn-success" data-toggle="tooltip" title="New RM Code"><i class="fa fa-plus"></i></a>

        <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

        <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="fa fa-trash"></i></button>

      </div>

    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th><?= $this->lang->line('dsr_no') ?></th>
              <th> <?= $this->lang->line('grid_number') ?> </th>
              <th><?= $this->lang->line('supplier_name') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('raw_material') ?> </th>
              <th style="white-space: nowrap;"><?= $this->lang->line('grade') ?></th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('rm_code') ?></th>
              <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($rmcodes as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td><?php echo $obj['grid_number']; ?></td>
                <td><?php echo $obj['supplier']; ?></td>
                <td><?php echo $obj['rm_name']; ?></td>
                <td><?php echo $obj['grade']; ?></td>
                <td><?php echo $obj['rm_code']; ?></td>
                <td>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Rm_code/edit/<?php echo $obj['id']; ?>"><i class="fa fa-edit"></i></a>

                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>"><i style="color:#fff;" class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Rm_code/deleteRM/<?php echo $obj['id']; ?>">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                          <p>Are you sure, you want to delete this Grid Number <b><?php echo $obj['grid_number']; ?> </b>? </p>
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
        WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Rm_code/deleteRM",
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