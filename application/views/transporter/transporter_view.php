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
    <h5><i class="icon fa fa-check"></i><?= $this->lang->line('alert') ?> !</h5>
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
          <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper hstack">
            <!-- Collapse Filter -->
            <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
              data-bs-target="#collapseOne" data-toggle="tooltip" title="Filter">
              <i class="feather-filter"></i>
            </a>
            <div class="hstack gap-2 justify-content-end">
             
                <a href="<?php echo base_url('index.php/Transporters/add'); ?>" class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="Add New Supplier">
                  <i class="feather feather-plus"></i>
                  <span><?= $this->lang->line('transporter_add') ?>
                  </span>
                </a>
              
                <button class="btn btn-icon btn-light-brand delete_all" data-toggle="tooltip" title="Bulk Delete">
                  <i class="feather feather-trash "></i> 
              </button>
               <form method="post" action="<?php echo base_url(); ?>index.php/Leave/createXLS">
                <?php if (!empty($filtered_value)) {
                  foreach ($filtered_value as $key => $value) { ?>
                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"> <?php }
                } ?>
            
                <button type="submit" class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="Excel Download"> 
                 <i class="feather feather-download "></i> 
                 <!-- <i class="fa fa-file-download"></i>  -->
                </button>
              </form>
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

    <div class="main-content">
      <div class="row">
          <div class="col-lg-12">
              <div class="card stretch stretch-full">
                <div class="card card-primary card-outline">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hover" id="proposalList">
                        <thead>
                          <tr>
                            <th><input type="checkbox" id="master"></th>
                            <th><?= $this->lang->line('sr_no') ?>.</th>
                            <th><?= $this->lang->line('name') ?></th>

                            <th style="white-space: nowrap;"> <?= $this->lang->line('contact_person') ?> </th>
                            <th><?= $this->lang->line('mobile_no') ?></th>
                            <!--  <th style="white-space: nowrap;">Approval Date</th>
                            <th style="white-space: nowrap;"> Next Evalution</th> -->
                            <th style="white-space: nowrap;width: 20%;"> <?= $this->lang->line('action_button') ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i = 1;
                          foreach ($transporters as $obj) { ?>
                            <tr>
                              <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                              <td><?php echo $i; ?></td>
                              <td><?php
                              $voucher_no = $obj['vendor_code'];
                              if ($voucher_no < 10) {
                                $transporter_id_code = 'TP000' . $voucher_no;
                              } else if (($voucher_no >= 10) && ($voucher_no <= 99)) {
                                $transporter_id_code = 'TP00' . $voucher_no;
                              } else if (($voucher_no >= 100) && ($voucher_no <= 999)) {
                                $transporter_id_code = 'TP0' . $voucher_no;
                              } else {
                                $transporter_id_code = 'TP' . $voucher_no;
                              }

                              echo $obj['transporter_name'] . ' (' . $transporter_id_code . ')'; ?></td>
                              <td><?php echo $obj['contact_person']; ?></td>
                              <td><?php echo $obj['mobile_no']; ?></td>
                              <!--    <td><?php echo date('d-M-Y', strtotime($obj['date_of_approval'])); ?></td>
                              <td><?php echo date('d-M-Y', strtotime($obj['date_of_evalution'])); ?></td> -->
                              <td>
                                 <div class="hstack gap-2 justify-content-start">
                                       <a class="btn btn-icon avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#ViewDetails<?php echo $obj['id']; ?>" title="View More">
                                        <i class="fa fa-eye"></i></a>
                                      <a class=" btn btn-icon avatar-text avatar-md"
                                        href="<?php echo base_url(); ?>index.php/Transporters/edit_transporter_view/<?php echo $obj['id']; ?>" data-toggle="tooltip" title="Edit Record">
                                        <i class="feather feather-edit-3 "></i></a>
                                      
                                      <a class="btn btn-icon avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#delete<?php echo $obj['id']; ?>" title="Delete Record">
                                        <i class="feather feather-trash"></i></a>
                                 </div>
                              </td>
                              <?php $this->load->view('transporter/component/view-details', ['obj' => $obj]); ?>

                              <div class="modal fade" id="view<?php echo $obj['id']; ?>" role="dialog">
                                <div class="modal-dialog modal-lg">
                                  <!-- Modal content-->
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title"><?php echo $obj['transporter_name']; ?><?= $this->lang->line('details') ?>
                                      </h4>
                                      <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="col-md-6 col-sm-6 ">
                                            <label class="control-label"><?= $this->lang->line('vendor_code') ?>:</label>
                                            <span> <?php echo $obj['vendor_code']; ?></span>
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
                                            <label class="control-label"><?= $this->lang->line('mobile_no') ?> :</label>
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
                                            <label class="control-label"> <?= $this->lang->line('tds') ?> :</label>
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
                                            <label class="control-label"><?= $this->lang->line('banh_name') ?>:</label>
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
                                            <label class="control-label"><?= $this->lang->line('account_no') ?>:</label>
                                            <span> <?php echo $obj['account_no']; ?></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="col-md-6 col-sm-6 ">
                                            <label class="control-label"><?= $this->lang->line('service_state') ?>:</label>
                                            <span> <?php echo $obj['states']; ?></span>
                                          </div>
                                          <div class="col-md-6 col-sm-6 ">
                                            <label class="control-label"><?= $this->lang->line('category_of_approval') ?> :</label>
                                            <span> <?php echo $obj['category_of_approval']; ?></span>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12 col-sm-12 ">
                                          <div class="col-md-12 col-sm-12 ">
                                            <label class="control-label"><?= $this->lang->line('address') ?> :</label>
                                            <span> <?php echo $obj['address']; ?></span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger"
                                        data-dismiss="modal"><?= $this->lang->line('close') ?></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <div class="offcanvas offcanvas-end" tabindex="-1" id="delete<?php echo $obj['id']; ?>">
                              <form class="form-horizontal" role="form" method="post"
                                action="<?php echo base_url(); ?>index.php/Transporters/deletetransporter/<?php echo $obj['id']; ?>">
                            
                                <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
                                  <h2 class="fs-16 fw-bold text-truncate-1-line"><?= $this->lang->line('confirm_header') ?></h2>
                                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                  <!-- Modal content-->
                                  <p><?= $this->lang->line('delete_transporter_confirm') ?>
                                    <b><?php echo $obj['transporter_name']; ?> </b>
                                  </p>
                                </div>
                            
                                <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
                                  <button type="submit" class="btn btn-primary delete_submit w-50"> <?= $this->lang->line('yes') ?>
                                  </button>
                                  <a href="javascript:void(0);" class="btn btn-danger w-50"
                                    data-bs-dismiss="offcanvas"><?= $this->lang->line('cancel') ?></a>
                                </div>
                              </form>
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
            </div>
          </div>
    </div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {

    jQuery('#master').on('click', function (e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      }
      else {
        $(".sub_chk").prop('checked', false);
      }
    });
    jQuery('.delete_all').on('click', function (e) {
      var allVals = [];
      $(".sub_chk:checked").each(function () {
        allVals.push($(this).val());
      });
      //alert(allVals.length); return false;  
      if (allVals.length <= 0) {
        alert("Please select row.");
      }
      else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete all selected transporters?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          var join_selected_values = allVals.join(",");
          $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/Transporters/deletetransporter",
            cache: false,
            data: 'ids=' + join_selected_values,
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