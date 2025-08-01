<div class="nxl-content ">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('gir_register_report') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto d-flex align-items-center">
      <?php $this->load->view('layout/alerts'); ?>
      
      <!-- Filter Button -->
      <button class="btn btn-icon avatar-text avatar-md" type="button" data-bs-toggle="collapse" data-bs-target="#filterFormWrapper" aria-expanded="<?= !empty($_GET) ? 'true' : 'false' ?>" aria-controls="filterFormWrapper">
        <i class="feather feather-filter"></i> <?= $this->lang->line('filter') ?>
      </button>

      <!-- Export Button -->
      <form method="post" action="<?= base_url(); ?>index.php/Customers/createXLS" class="ms-2">
        <?php if (!empty($conditions)) {
          foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php }
        } ?>
        <button type="submit" class="btn btn-info"><?= $this->lang->line('export') ?></button>
      </form>
    </div>
  </div>

  <style>
    .col-sm-6, .col-md-6 { float: left; }
  </style>

  <!-- Filter Form inside Collapse -->
  <div class="collapse <?= !empty($_GET) ? 'show' : '' ?>" id="filterFormWrapper">
    <div class="card card-body border bg-white">
      <form method="get" id="filterForm">
        <div class="row">
          <!-- Category Select -->
          <div class="col-md-4 col-sm-4">
            <label class="control-label"><?= $this->lang->line('category') ?> <span class="required">*</span></label>
            <select name="categories_id" class="form-control select2 category">
              <option value="0"><?= $this->lang->line('select_category') ?></option>
              <?php if ($categories): ?>
                <?php foreach ($categories as $value): ?>
                  <option value="<?= $value['id'] ?>" <?= (isset($current[0]) && $value['id'] == $current[0]->categories_id) ? 'selected' : '' ?>>
                    <?= $value['category_name'] ?>
                  </option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>

          <!-- Supplier Select -->
          <div class="col-md-4 col-sm-4">
            <label class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
            <select name="supplier_id" class="form-control select2 suppliers">
              <option value="0"><?= $this->lang->line('select_supplier') ?></option>
              <?php if ($all_suppliers): ?>
                <?php foreach ($all_suppliers as $value): ?>
                  <option value="<?= $value['id'] ?>" <?= (isset($supplier_id) && $value['id'] == $supplier_id) ? 'selected' : '' ?>>
                    <?= $value['supplier_name'] ?>
                  </option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>

          <!-- GIR Number Select -->
          <div class="col-md-4 col-sm-4">
            <label class="control-label"><?= $this->lang->line('gir_number') ?> <span class="required">*</span></label>
            <select name="gir_no" class="form-control select2 suppliers">
              <option value="0"><?= $this->lang->line('select_gir_number') ?></option>
              <?php if ($gir_nos): ?>
                <?php foreach ($gir_nos as $value): ?>
                  <option value="<?= $value['id'] ?>" <?= (isset($id) && $value['id'] == $id) ? 'selected' : '' ?>>
                    <?= $value['gir_no'] ?>
                  </option>
                <?php endforeach; ?>
              <?php else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="row mt-3 bg-white">
          <!-- From Date -->
          <div class="col-md-4 col-sm-4">
            <label class="control-label"><?= $this->lang->line('from_date') ?></label>
            <input type="text" name="from_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" />
          </div>

          <!-- Upto Date -->
          <div class="col-md-4 col-sm-4">
            <label class="control-label"><?= $this->lang->line('upto_date') ?></label>
            <input type="text" name="upto_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" />
          </div>

          <!-- Buttons -->
          <div class="col-md-4 col-sm-4 d-flex align-items-end gap-2">
            <input type="submit" class="btn btn-primary" value="<?= $this->lang->line('search'); ?>" />
            <a href="<?= current_url(); ?>" class="btn btn-danger"><?= $this->lang->line('reset'); ?></a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Table: Always Visible -->
  <div class="table-responsive p-3 mt-3 bg-white">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th><input type="checkbox" id="master"></th>
          <th><?= $this->lang->line('sr_no') ?></th>
          <th><?= $this->lang->line('gir_no') ?></th>
          <th><?= $this->lang->line('invoice_no') ?></th>
          <th><?= $this->lang->line('supplier_name') ?></th>
          <th><?= $this->lang->line('date') ?></th>
          <th><?= $this->lang->line('total_qty') ?></th>
          <th><?= $this->lang->line('action_button') ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        foreach ($gir_data as $obj) { ?>
          <tr>
            <td><input type="checkbox" class="sub_chk" value="<?= $obj['id']; ?>" /></td>
            <td><?= $i; ?></td>
            <td>
              <?php
              $voucher_no = $obj['gir_no'];
              if ($voucher_no < 10) {
                echo 'GIR000' . $voucher_no;
              } elseif ($voucher_no <= 99) {
                echo 'GIR00' . $voucher_no;
              } elseif ($voucher_no <= 999) {
                echo 'GIR0' . $voucher_no;
              } else {
                echo 'GIR' . $voucher_no;
              }
              ?>
            </td>
            <td><?= $obj['challan_no']; ?></td>
            <td><?= $obj['supplier']; ?></td>
            <td><?= date('d-M-Y', strtotime($obj['transaction_date'])); ?></td>
            <td><?= $obj['total_qty']; ?></td>
            <td>
              <div class="d-flex gap-1">
                <a class="btn btn-icon avatar-text avatar-md" data-toggle="modal" data-target="#view<?= $obj['id']; ?>">
                  <i class="feather feather-eye "></i>
                </a>
                <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Gir_registers/print_gen/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>
                <a class="btn btn-icon avatar-text avatar-md" href="<?= base_url(); ?>index.php/Gir_registers/edit/<?= $obj['id']; ?>">
                  <i class="feather feather-edit "></i>
                </a>
                <a class="btn btn-icon avatar-text avatar-md"
   href="javascript:void(0);"
   onclick="deletegirRM(<?= $obj['id'] ?>)">
  <i class="fa fa-trash "></i>
</a>

                
              </div>
            </td>
          </tr>

          <!-- View Modal -->
          <div class="modal fade" id="view<?= $obj['id']; ?>" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><?= $this->lang->line('gir_register') ?> (<?= $obj['gir_no'] ?>) Details</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row col-md-12" style="border: 1px solid #f3ecec; height: 45px; padding: 10px; margin: 0px 0 6px; font-weight: 500;">
                    <div class="col-md-1">#</div>
                    <div class="col-md-3"><?= $this->lang->line('item_name') ?></div>
                    <div class="col-md-3"><?= $this->lang->line('qty') ?></div>
                    <div class="col-md-5"><?= $this->lang->line('description') ?></div>
                  </div>

                  <?php
                  $j = 1;
                  foreach ($obj['gir_details'] as $gir_detail) { ?>
                    <div class="row col-md-12" style="height: 45px; padding: 10px; margin: 0 0 6px;">
                      <div class="col-md-1"><?= $j; ?></div>
                      <div class="col-md-3"><?= $gir_detail['item']; ?></div>
                      <div class="col-md-3"><?= $gir_detail['quantity']; ?></div>
                      <div class="col-md-5"><?= $gir_detail['description']; ?></div>
                    </div>
                  <?php $j++;
                  } ?>

                  <hr>
                  <div class="row col-md-12 mb-3">
                    <div class="col-md-6">
                      <label><?= $this->lang->line('material_received_through') ?? 'Material Received Through' ?>: </label>
                      <span><?= $obj['material_received_from']; ?></span>
                    </div>
                    <div class="col-md-6">
                      <label><?= $this->lang->line('comment') ?>: </label>
                      <span><?= $obj['comments']; ?></span>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= $this->lang->line('close') ?></button>
                </div>
              </div>
            </div>
          </div>

          <!-- Delete Modal -->
          <div class="modal fade" id="delete<?= $obj['id']; ?>" role="dialog" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form method="post" action="<?= base_url(); ?>index.php/Gir_registers/deletegirGEN/<?= $obj['id']; ?>">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><?= $this->lang->line('confirm_header') ?></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure, you want to delete GIR <b><?= $obj['gir_no']; ?></b>?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary delete_submit"><?= $this->lang->line('yes') ?></button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= $this->lang->line('no') ?></button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        <?php $i++;
        } ?>
      </tbody>
    </table
</div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script>
function deletegirRM(id) {
  if (confirm("Are you sure you want to delete this GIR entry?")) {
    $.ajax({
      url: "<?= base_url(); ?>index.php/Gir_registers/deletegirGEN/" + id,
      type: "POST",
      success: function (response) {
        alert("Deleted successfully.");
        location.reload();
      },
      error: function () {
        alert("Something went wrong. Please try again.");
      }
    });
  }
}
</script>

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
          url: "<?php echo base_url(); ?>index.php/Gir_registers/deletegirGEN",  
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