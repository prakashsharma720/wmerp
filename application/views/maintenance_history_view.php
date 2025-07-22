<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success'); ?>!</h5>
    <?php echo $this->session->flashdata('success'); ?>
  </div>
  <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert'); ?>!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <!-- <span class="card-title"><?php echo $title; ?>
      </span>
      <div class="button-group float-right">

        <a href="<?php echo base_url(); ?>index.php/Maintenance_history_records/add" class="btn btn-success" data-toggle="tooltip" title="New Production Register"><i class="fa fa-plus"></i></a>

        <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

        <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="fa fa-trash"></i></button> -->
<span class="card-title">Machinery Equipment           </span>
            <div class="button-group float-right d-flex">

                <a href="http://localhost/wmerp/index.php/Employees/add" class="btn btn-success" data-toggle="tooltip" title="New Employee"><i class="fa fa-plus"></i></a>
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
              <th><?= $this->lang->line('sr_no'); ?>.</th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('me_no'); ?> </th>
              <!-- <th style="white-space: nowrap;"> Date </th> -->
              <th style="white-space: nowrap;"> <?= $this->lang->line('department'); ?> </th>
              <th style="white-space: nowrap;"><?= $this->lang->line('created_by'); ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('equipment_name'); ?> </th>
              <!-- <th style="white-space: nowrap;"> Equipment ID </th> -->
              <th style="white-space: nowrap;"><?= $this->lang->line('machine_start_datetime'); ?></th>
              <th style="white-space: nowrap;"><?= $this->lang->line('machine_stop_datetime'); ?></th>


              <th style="white-space: nowrap;"> <?= $this->lang->line('machine_total_time'); ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('type_of_maintenance'); ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('details_of_maintenance'); ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('parts_replaced'); ?> </th>

              <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($pr_data as $obj) { ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i; ?></td>
                <td>
                  <?php
                  $inv_number = $obj['pme_code'];
                  if ($inv_number < 10) {
                    $inv_number1 = 'ME000' . $inv_number;
                  } else if (($inv_number >= 10) && ($inv_number <= 99)) {
                    $inv_number1 = 'ME00' . $inv_number;
                  } else if (($inv_number >= 100) && ($inv_number <= 999)) {
                    $inv_number1 = 'ME0' . $inv_number;
                  } else {
                    $inv_number1 = 'ME' . $inv_number;
                  }
                  echo $inv_number1; ?>
                </td>
                <!-- <td ><?php echo date('d-M-Y', strtotime($obj['transaction_date'])); ?></td> -->
                <td><?php echo $obj['department']; ?></td>
                <td><?php echo $obj['employee']; ?></td>
                <td><?php echo $obj['equip_name']; ?></td>
                <!-- <td><?php echo $obj['equipment_id']; ?></td> -->
                <td><?php echo $obj['machine_start_date'] . "&nbsp;" . date('h:i:sa', strtotime($obj['machin_start_time'])); ?></td>
                <td><?php echo $obj['machine_stop_date'] . "&nbsp;" . date('h:i:sa', strtotime($obj['machin_stop_time'])); ?></td>
                <td><?php echo date('h:i:sa', strtotime($obj['machine_total_time'])); ?></td>
                <td><?php echo $obj['type_maintance']; ?></td>
                <td><?php echo $obj['details_maintance']; ?></td>
                <td><?php echo $obj['parts_replaced']; ?></td>


                <td>
                  <!-- <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id']; ?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a> -->
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Maintenance_history_records/edit/<?php echo $obj['id']; ?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id']; ?>" title="Delete"><i style="color:#fff;" class="fa fa-trash"></i></a>

                </td>

                <!-- modal to use in view -->
                <!-- <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Machinary_equipments/deletePME/<?php echo $obj['id']; ?>">
                        
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Machinary Equipments (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-lg-12 col-sm-12 d-flex flex-row" style="border: 1px solid #f3ecec;height: 45px;padding: 10px;margin: 0px;margin-bottom: 6px; font-weight: 500;">
                                  <div class="col-lg-3">Equipment Name</div>
                                  <div class="col-lg-3">Transaction Date</div>
                                  <div class="col-lg-3">Department</div>
                                  <div class="col-lg-3">Equipment ID</div>
                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex flex-row mb-4">
                                  <div class="col-lg-3"><?php echo $obj['equip_name'] ?></div>
                                  <div class="col-lg-3"><?php echo date('d-M-Y', strtotime($obj['transaction_date'])); ?></div>
                                  <div class="col-lg-3"><?php echo $obj['department']; ?></div>
                                  <div class="col-lg-3"><?php echo $obj['register_no']; ?></div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-12 col-sm-12 d-flex flex-row" style="border: 1px solid #f3ecec;height: 65px; padding:5px; margin: 0px;margin-bottom: 15px; font-weight: 500;">
                                  <div class="col-lg-2"> Start Date & Time</div>
                                  <div class="col-lg-2"> Stop Date  & Time</div>
                                  <div class="col-lg-2"> Total Time</div>
                                  <div class="col-lg-2"> Type Maintance</div>
                                  <div class="col-lg-2"> Details Maintance </div>
                                  <div class="col-lg-2"> Parts Replaced </div>

                                </div>
                                <div class="col-lg-12 col-sm-12 d-flex flex-row mb-5">
                                  <div class="col-lg-2"><?php echo date('d-M-Y', strtotime($obj['machine_start_date'])) . "<br>" . date('h:i:sa', strtotime($obj['machin_start_time'])); ?></div>
                                  <div class="col-lg-2"><?php echo date('d-M-Y', strtotime($obj['machine_stop_date'])) . "<br>" . date('h:i:sa', strtotime($obj['machin_stop_time'])); ?></div>
                                  <div class="col-lg-2"><?php echo date('h:i:sa', strtotime($obj['machine_total_time'])); ?></div>
                                  <div class="col-lg-2"><?php echo $obj['type_maintance'] ?></div>
                                  <div class="col-lg-2"><?php echo $obj['details_maintance'] ?></div>
                                  <div class="col-lg-2"><?php echo $obj['parts_replaced'] ?></div>

                                </div>

                              </div>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div> -->
                <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                  <div class="modal-dialog">
                    <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Maintenance_history_records/deleteGSR/<?php echo $obj['id']; ?>">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Confirm Header </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>

                        </div>
                        <div class="modal-body">
                          <p>Are you sure, you want to delete This DSR <b> (<?php echo $obj['equip_name'] ?>) </b>? </p>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-primary ">Submit</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
            url: "<?php echo base_url(); ?>index.php/Machinary_equipments/deleteGSR",
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