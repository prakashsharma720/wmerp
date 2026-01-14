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
<div class="nxl-content">
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('service_provider_evaluation_results') ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
        <li class="breadcrumb-item"><?= $this->lang->line('view_list') ?>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto">
      <div class="page-header-right-items" style="display:flex;gap:8px;align-items:center">
        <?php $this->load->view('layout/alerts'); ?>
        <a href="javascript:void(0);" class="btn btn-icon avatar-text avatar-md" data-bs-toggle="collapse" data-bs-target="#filterFormWrapper" title="Filter">
          <i class="feather-filter"></i>
        </a>
        <a href="<?php echo base_url(); ?>index.php/Evaluation_result/ev_sprovider_add" class="btn btn-icon avatar-text avatar-md" data-toggle="tooltip" title="New Evaluation"><i class="feather feather-plus"></i></a>

        <button class="btn btn-icon avatar-text avatar-md" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

        <button class="btn btn-icon avatar-text avatar-md delete_all" data-toggle="tooltip" title="Bulk Delete"><i class="feather feather-trash"></i></button>
      </div>

      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="collapse bg-white" id="filterFormWrapper" style="position: relative; left:35px; right:35px;width:1553px;border-radius: 10px; top:20px ">
    <form method="get" id="filterForm" class="mb-3 border p-3 rounded ">

      <div class="row">
        <div class="col-md-4 col-sm-4 ">
          <label class="control-label"><?= $this->lang->line('service_provider_category') ?> <span class="required">*</span></label>
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
          <label class="control-label"><?= $this->lang->line('name_of_service_provider') ?> <span class="required">*</span></label>
          <select name="service_provider_id" class="form-control select2 suppliers">
            <option value="0"> <?= $this->lang->line('select_service_provider') ?></option>
            <?php
            if ($all_sproviders): ?>
              <?php
              foreach ($all_sproviders as $value) : ?>
                <?php
                if ($value['id'] == $supplier_id): ?>
                  <option value="<?= $value['id'] ?>" selected><?= $value['service_provider_name'] ?></option>
                <?php else: ?>
                  <option value="<?= $value['id'] ?>"><?= $value['service_provider_name'] ?></option>
                <?php endif;   ?>
              <?php endforeach;  ?>
            <?php else: ?>
              <option value="0"><?= $this->lang->line('no_result') ?></option>
            <?php endif; ?>
          </select>
        </div>
        <div class="col-md-4 col-sm-4">
          <label class="control-label"> <?= $this->lang->line('grade') ?></label>
          <?php $app_cat = array(
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
          <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label>
          <button type="submit" class="btn btn-primary"> <?= $this->lang->line('search') ?></button>
          <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label>
          <a href="<?php echo $data[0] ?>" class="btn btn-danger" style="position:relative;width:80px;bottom:60px;left:85px "> <?= $this->lang->line('reset') ?></a>
        </div>
      </div>
    </form>
        </div>
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
                      <th><?= $this->lang->line('sr_no') ?>.</th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('name') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('category') ?> </th>

                      <th> <?= $this->lang->line('grade') ?> </th>
                      <th> <?= $this->lang->line('evaluation_date') ?> </th>
                      <th> <?= $this->lang->line('evaluation_by') ?> </th>
                      <th style="white-space: nowrap;"> <?= $this->lang->line('action') ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $i = 1;
                    foreach ($er_data as $obj) { ?>
                      <tr>
                        <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $obj['sp_name']; ?></td>
                        <td><?php echo $obj['category']; ?></td>
                        <!--  <td><?php echo $obj['total_marks_obtained']; ?></td>
                <td><?php echo $obj['total_marks']; ?></td>
                <td><?php echo $obj['percentage']; ?></td> -->
                        <td><?php echo $obj['approval_grade']; ?></td>
                        <td><?php echo date('d-M-Y', strtotime($obj['date'])); ?></td>
                        <td><?php echo $obj['created_by']; ?></td>
                        <td>
                          <a class="btn btn-icon avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#supp<?= $obj['id']; ?>"><i class="feather feather-eye"></i></a>

                          <?php ?>
                          <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Evaluation_result/print_sup/<?php echo $obj['id']; ?>"><i class="fa fa-print"></i></a>

                          <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Evaluation_result/ev_sprovider_edit/<?php echo $obj['id']; ?> "><i class="feather feather-edit-3"></i></a>
                          <!--   <a target="_blank"href="<?php echo base_url(); ?>index.php/Evaluation_result/pdfFile/<?php echo $obj['id']; ?> " class="btn btn-info btnEdit" data-toggle="tooltip" title="PDF"><i class="fa fa-file-pdf-o"></i></a>    -->


                          <a class="btn btn-icon avatar-text avatar-md" href="javascript:void(0);" onclick="deleteERT(<?= $obj['id'] ?>)"> <i class="feather feather-trash"></i></a>
                        </td>
                        <?php $this->load->view('leave-module/component/supp.php', ['obj' => $obj]); ?>
                        <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog">
                          <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title">(<?php echo $obj['sp_name'] ?>) Evaluation Details </h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>

                              </div>
                              <div class="modal-body">
                                <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;">

                                  <div class="col-md-1">#</div>
                                  <div class="col-md-6"><?= $this->lang->line('criteria_name') ?></div>
                                  <div class="col-md-2"><?= $this->lang->line('marks') ?> </div>
                                  <div class="col-md-3"><?= $this->lang->line('grade') ?> </div>
                                </div>
                                <?php
                                $j = 1;
                                foreach ($obj['er_details'] as $gir_detail) { ?>
                                  <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                          height: 45px;
                                          padding: 10px;
                                          margin: 0px;
                                          margin-bottom: 6px;">
                                    <div class="col-md-1"><?= $j; ?> </div>
                                    <div class="col-md-6"><?= $gir_detail['criteria']; ?> </div>
                                    <div class="col-md-2"><?= $gir_detail['marks_obtained']; ?> </div>
                                    <div class="col-md-3"><?php
                                                          if (($gir_detail['marks_obtained']) == '10') {
                                                            echo 'Good';
                                                          } else if (($gir_detail['marks_obtained']) == '7') {
                                                            echo 'Average';
                                                          } else {
                                                            echo 'Below Average';
                                                          };
                                                          ?> </div>
                                  </div>
                                <?php $j++;
                                }  ?>
                                <hr>
                                <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('total_marks_obtained') ?> : </label>
                                    <span>
                                      <?php
                                      echo $obj['total_marks_obtained'];
                                      ?>
                                    </span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('total_marks') ?> : </label>
                                    <span>
                                      <?php
                                      echo $obj['total_marks'];
                                      ?>
                                    </span>
                                  </div>
                                </div>
                                <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('percentage') ?> : </label>
                                    <span>
                                      <?php
                                      echo $obj['percentage'] . ' %';
                                      ?>
                                    </span>
                                  </div>
                                  <div class="col-md-6">
                                    <label class="control-label"> <?= $this->lang->line('comment') ?> : </label>
                                    <span>
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

                        <div class="modal fade" id="delete<?php echo $obj['id']; ?>" role="dialog">
                          <div class="modal-dialog">
                            <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_result/deleteERSP/<?php echo $obj['id']; ?>">
                              <!-- Modal content-->
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?> </h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                                </div>
                                <div class="modal-body">
                                  <p>Are you sure, you want to delete <b><?php echo $obj['sp_name']; ?> </b> <?= $this->lang->line('evaluation') ?> ? </p>
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
                    url: "<?php echo base_url(); ?>index.php/Evaluation_result/deleteERS",
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
                url: "<?php echo base_url('index.php/Service_providers/getSProviderByCategory/') ?>" + category_id,
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