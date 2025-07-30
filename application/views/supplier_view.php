<!-- Page Header -->

<div class="nxl-content bg-white">

  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10">
          <?= $this->lang->line('suppliers_list') ?>
        </h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard') ?>"><?= $this->lang->line('home') ?></a>
        </li>
        <li class="breadcrumb-item">
          <?= $this->lang->line('suppliers_list') ?>
        </li>
      </ul>
    </div>
    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper hstack">
          <?php $this->load->view('layout/alerts'); ?>
          <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse" data-bs-target="#filterFormWrapper" data-toggle="tooltip" title="Filter">
            <i class="feather-filter"></i>
          </a>
          <div class="hstack gap-2 justify-content-end">
            <a href="<?= base_url('index.php/suppliers/add') ?>" class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="New PO">
              <i class="feather feather-plus"></i>
            </a>
            <button class="btn btn-icon btn-light-brand" data-bs-toggle="tooltip" title="Refresh" onclick="location.reload();">
              <i class="fa fa-refresh"></i>
            </button>
            <button class="btn btn-icon btn-light-brand delete_all" data-toggle="tooltip" title="Bulk Delete">
              <i class="feather feather-trash"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
</div>



<!-- Filter Section -->




<div class="collapse bg-white" id="filterFormWrapper">
  <div class="card border-0 shadow-sm mt-3 mb-3 mx-2">
    <div class="card-body p-3">
      <form method="get" action="<?= base_url('index.php/suppliers_order/filter') ?>">
        <div class="row mb-2">
          <div class="col-md-4 col-sm-4">
            <label class="control-label">
              <?= $this->lang->line('supplier_category') ?> <span class="required">*</span>
            </label>
            <select name="categories_id" class="form-control select2 category">
              <option value="0"><?= $this->lang->line('select_category') ?></option>
              <?php if ($categories): foreach ($categories as $value): ?>
                  <option value="<?= $value['id'] ?>" <?= ($value['id'] == $current[0]->categories_id ? 'selected' : '') ?>>
                    <?= $value['category_name'] ?>
                  </option>
                <?php endforeach;
              else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-md-4 col-sm-4">
            <label class="control-label">
              <?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span>
            </label>
            <select name="supplier_id" class="form-control select2 suppliers">
              <option value="0"> <?= $this->lang->line('select_supplier') ?></option>
              <?php if ($all_suppliers): foreach ($all_suppliers as $value):
                  $voucher_no = $value['vendor_code'];
                  $supplier_id_code = 'SUP' . str_pad($voucher_no, 4, '0', STR_PAD_LEFT);
              ?>
                  <option value="<?= $value['id'] ?>" <?= ($value['id'] == $supplier_id ? 'selected' : '') ?>>
                    <?= $value['supplier_name'] . ' (' . $supplier_id_code . ')' ?>
                  </option>
                <?php endforeach;
              else: ?>
                <option value="0"><?= $this->lang->line('no_result') ?></option>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-md-4 col-sm-4">
            <label class="control-label"><?= $this->lang->line('category_of_approval') ?></label>
            <select class="form-control select2" name="category_of_approval">
              <option value="No"><?= $this->lang->line('select_option') ?></option>
              <option value="A">A</option>
              <option value="B">B</option>
              <option value="C">C</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 col-sm-4 hstack gap-2 justify-content-start mt-4">
            <input type="submit" class="btn btn-primary" value="Search">
            <a href="<?= base_url('index.php/suppliers/index') ?>" class="btn btn-danger"><?= $this->lang->line('reset') ?></a>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>

<!-- Supplier Table -->
<!-- <div class="container" style="
  background-color: #ffffff;
  padding: 15px;
  border: 1px solid #e0e0e0;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
"> -->
<div class="container card-white-box">
  <!-- <div id="proposalList_wrapper" style="background-color: white;position:relative;top:20px;  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);  padding:15px" class="dataTables_wrapper dt-bootstrap5 no-footer "> -->
  <div id="proposalList_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">


    <div class="col-sm-12">
      <table class="table table-hover align-middle" id="proposalList">
        <thead class="table-light">
          <tr>
            <th><input type="checkbox" id="master"></th>
            <th><?= $this->lang->line('sr_no') ?>.</th>
            <th><?= $this->lang->line('name') ?></th>
            <th><?= $this->lang->line('category') ?></th>
            <th style="white-space: nowrap;"><?= $this->lang->line('contact_person') ?></th>
            <th><?= $this->lang->line('email') ?></th>
            <th><?= $this->lang->line('mobile') ?></th>
            <th><?= $this->lang->line('approval_category') ?></th>
            <th style="white-space: nowrap; width: 20%;"><?= $this->lang->line('action_button') ?></th>
          </tr>
        </thead>
        <tbody style="background-color:white">
          <?php $i = 1;
          foreach ($suppliers as $obj): ?>
            <?php $supplier_id_code = 'SUP' . str_pad($obj['vendor_code'], 4, '0', STR_PAD_LEFT); ?>
            <tr>
              <td><input type="checkbox" class="sub_chk" value="<?= $obj['id']; ?>" /></td>
              <td><?= $i++; ?></td>
              <td><?= $obj['supplier_name'] . ' (' . $supplier_id_code . ')' ?></td>
              <td><?= $obj['category'] ?></td>
              <td><?= $obj['contact_person'] ?></td>
              <td><?= $obj['email'] ?></td>
              <td><?= $obj['mobile_no'] ?></td>
              <td><?= $obj['category_of_approval'] ?></td>
              <td>
                <div class="d-flex gap-2">
                  <a class="btn btn-icon avatar-text avatar-md" data-bs-toggle="offcanvas" data-bs-target="#ViewPO<?= $obj['id']; ?>" title="View More">
                    <i class="feather feather-eye"></i>
                  </a>

                  <div class="dropdown">
                    <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown" data-bs-offset="0,21" aria-expanded="false">
                      <i class="feather feather-more-horizontal"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="<?= base_url('index.php/Suppliers/edit_supplier_view/' . $obj['id']) ?>"><i class="feather feather-edit-3 me-3"></i><?= $this->lang->line('edit') ?></a></li>
                      <li><a class="dropdown-item printBTN" href="<?= base_url('index.php/Suppliers/print/' . $obj['id']) ?>"><i class="feather feather-printer me-3"></i><?= $this->lang->line('print') ?></a></li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" onclick="deleteSupplier(<?= $obj['id'] ?>)">
                          <i class="feather feather-trash me-3"></i><?= $this->lang->line('delete') ?>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
              </td>
            </tr>

            <!-- Include view and delete modals -->
            <?php $this->load->view('leave-module/component/orderview.php', ['obj' => $obj]); ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>






<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script>
  function deleteSupplier(id) {
    if (confirm("Are you sure you want to delete this supplier?")) {
      window.location.href = "<?= base_url('index.php/Suppliers/deleteSupplier/') ?>" + id;
    }
  }
</script>


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