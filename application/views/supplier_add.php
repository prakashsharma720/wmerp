
<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong><?= $this->lang->line('success') ?>:</strong> <?= $this->session->flashdata('success'); ?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <strong><?= $this->lang->line('alert') ?>:</strong> <?= $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>



<div class="nxl-content">
  <div class="page-header">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('supplier') ?></h5>
      </div>
      <ul class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
        <li class="breadcrumb-item"><?= $this->lang->line('add_new_supplier') ?></li>
      </ul>
    </div>
  </div>
  
   
<!-- Supplier Profile Form -->
<div class="main-content">
  <div class="card card-primary card-outline">
    <div class="card-body">
      
        <h5 class="mb-3 text-primary border-bottom pb-2"><?= $this->lang->line('supplier_profile_details'); ?>
</h5>

        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Suppliers/add_new_supplier">
			    <div class="form-group">
        <div class="row g-4">
          <!-- Category -->
          <div class="col-md-4">
           <label class="control-label"><?=$this ->lang ->line('category')?></label>
             <select name="categories_id" class="form-control select2 " required="required"> 	
              						<?php 							if ($categories): ?> 								<?php 								foreach ($categories as $value) : ?> 									<?php 									if ($value['id'] == $current[0]->categories_id): ?> 										<option value="<?= $value['id'] ?>" selected><?= $value['category_name'] ?></option> 									<?php else: ?> 										<option value="<?= $value['id'] ?>"><?= $value['category_name'] ?></option> 									<?php endif;   ?> 								<?php endforeach;  ?> 							<?php else: ?> 								<option value="0"><?= $this->lang->line('no_result') ?></option> 							<?php endif; ?> 						</select> 
          </div>

          <!-- Supplier Type -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('supplier_type') ?> </label>
            <div class="d-flex gap-3">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="supplier_type" value="New" id="newSupplier">
                <label class="form-check-label" for="newSupplier"> <?= $this->lang->line('new') ?> </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="supplier_type" value="Existing" id="existingSupplier" checked>
                <label class="form-check-label" for="existingSupplier"> <?= $this->lang->line('existing') ?> </label>
              </div>
            </div>
          </div>

          <!-- Category of Approval -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('category_of_approval') ?> </label>
            <?= form_dropdown('category_of_approval', ['No' => 'Select Option', 'A' => 'A', 'B' => 'B', 'c' => 'C'], '', 'class="form-select"') ?>
          </div>

          <!-- Registration Date -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('reg_date') ?> </label>
            <input type="text" name="reg_date" class="form-control date-picker" value="<?= date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autocomplete="off">
          </div>

          <!-- Supplier Name -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('supplier_name') ?> </label>
            <input type="text" name="supplier_name" class="form-control" placeholder="<?= $this->lang->line('enter_name') ?>" required autocomplete="off">
          </div>

          <!-- Supplier Code -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('supplier_code') ?> </label>
            <input type="text" name="s_code" class="form-control" value="<?= $vendor_code ?>" readonly>
            <input type="hidden" name="vendor_code" value="<?= $s_code ?>">
          </div>

          <!-- Contact Person -->
          <div class="col-md-4">
  <label class="form-label"><?= $this->lang->line('contact_person') ?></label>
  <div class="input-group">
    
    <!-- Prefix Dropdown (Small) -->
    <div class="input-group-text p-0">
      <select name="prefix" class="form-select border-0 ps-2 pe-2" style="width: 70px;" required>
        <?php if ($prefix): foreach ($prefix as $value): ?>
          <option value="<?= $value ?>"><?= $value ?></option>
        <?php endforeach; else: ?>
          <option value="0"><?= $this->lang->line('no_result') ?></option>
        <?php endif; ?>
      </select>
        </div>
              <input type="text" name="contact_person" class="form-control" placeholder="<?= $this->lang->line('enter_contact_person') ?>" required autocomplete="off">
            </div>
          </div>

          <!-- Email -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('email') ?> </label>
            <input type="email" name="email" class="form-control" placeholder="<?= $this->lang->line('enter_email') ?>" autocomplete="off">
          </div>

          <!-- Website -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('website') ?> </label>
            <input type="text" name="website" class="form-control" placeholder="<?= $this->lang->line('enter_website') ?>" autocomplete="off">
          </div>

          <!-- Country / State / City -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('country') ?> </label>
            <?= form_dropdown('country_id', $countries, '', 'class="form-select"') ?>
          </div>
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('state') ?> </label>
            <?= form_dropdown('state_id', $states, '', 'class="form-select"') ?>
          </div>
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('city') ?> </label>
            <?= form_dropdown('city_id', $cities, '', 'class="form-select"') ?>
          </div>

          <!-- Mobile / GST / PAN / TAN -->
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('mobile') ?> </label>
            <input type="text" name="mobile_no" class="form-control" placeholder="<?= $this->lang->line('enter_mobile') ?>" maxlength="10" minlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('gst_registration_status') ?> </label><br>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gst_status" value="Yes" checked>
              <label class="form-check-label"> <?= $this->lang->line('yes') ?> </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gst_status" value="Un-registered Dealer">
              <label class="form-check-label"> <?= $this->lang->line('unregistered_dealer') ?> </label>
            </div>
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('gst_in') ?> </label>
            <input type="text" name="gst_no"  placeholder="Ex. 08ABCDE1234K1AZ"class="form-control gstnumber" value=""autofocus  maxlength="15" minlength="15">
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('pan') ?> </label>
            <input type="text" name="pan_no" class="form-control" placeholder="Ex. ABCDE1234K" maxlength="10" minlength="10">
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('tan') ?> </label>
            <input type="text" name="tds" class="form-control" placeholder="Ex. ABCD12345A" maxlength="10" minlength="10">
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('supplier_address') ?> </label>
            <textarea name="address" class="form-control" placeholder="<?= $this->lang->line('enter_address') ?>" rows="3"></textarea>
          </div>

        </div>

        <h5 class="my-4 text-success border-bottom pb-2"><?=$this ->lang ->line('bank_details')?></h5>
        <div class="row g-4">
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('bank_name') ?> </label>
           <?php 						$bank_nm = array( 							'No' => 'Select Option', 							'Allahabad Bank' => 'Allahabad Bank', 							'Andhra Bank' => 'Andhra Bank', 							'Axis Bank' => 'Axis Bank', 							'Bank of Baroda - Corporate Banking' => 'Bank of Baroda - Corporate Banking', 							'Bank of Baroda - Retail Banking' => 'Bank of Baroda - Retail Banking', 							'Bank of India' => 'Bank of India', 							'Bank of Maharashtra' => 'Bank of Maharashtra', 							'Canara Bank' => 'Canara Bank', 							'Central Bank of India' => 'Central Bank of India', 							'City Union Bank' => 'City Union Bank', 							'Corporation Bank' => 'Corporation Bank', 							'Development Credit Bank' => 'Development Credit Bank', 							'Dhanlaxmi Bank' => 'Dhanlaxmi Bank', 							'ICICI Bank' => 'ICICI Bank', 							'IDBI Bank' => 'IDBI Bank', 							'Indian Bank' => 'Indian Bank', 							'Indian Overseas Bank' => 'Indian Overseas Bank', 							'IndusInd Bank' => 'IndusInd Bank', 							'ING Vysya Bank' => 'ING Vysya Bank', 							'Jammu and Kashmir Bank' => 'Jammu and Kashmir Bank', 							'Karnataka Bank Ltd' => 'Karnataka Bank Ltd', 							'Karur Vysya Bank' => 'Karur Vysya Bank', 							'Kotak Bank' => 'Kotak Bank', 							'Laxmi Vilas Bank' => 'Laxmi Vilas Bank', 							'Oriental Bank of Commerce' => 'Oriental Bank of Commerce', 							'Punjab National Bank - Corporate Banking' => 'Punjab National Bank - Corporate Banking', 							'Punjab National Bank - Retail Banking' => 'Punjab National Bank - Retail Banking', 							'Punjab & Sind Bank' => 'Punjab & Sind Bank', 							'Shamrao Vitthal Co-operative Bank' => 'Shamrao Vitthal Co-operative Bank', 							'South Indian Bank' => 'South Indian Bank', 							'State Bank of Bikaner & Jaipur' => 'State Bank of Bikaner & Jaipur', 							'State Bank of Hyderabad' => 'State Bank of Hyderabad', 							'State Bank of India' => 'State Bank of India', 							'State Bank of Mysore' => 'State Bank of Mysore', 							'State Bank of Patiala' => 'State Bank of Patiala', 							'State Bank of Travancore' => 'State Bank of Travancore', 							'Syndicate Bank' => 'Syndicate Bank', 							'Tamilnad Mercantile Bank Ltd.' => 'Tamilnad Mercantile Bank Ltd.', 							'UCO Bank' => 'UCO Bank', 							'Union Bank of India' => 'Union Bank of India', 							'United Bank of India' => 'United Bank of India', 							'Vijaya Bank' => 'Vijaya Bank', 							'Yes Bank Ltd' => 'Yes Bank Ltd' 						); 						echo form_dropdown('bank_name', $bank_nm) 						?> 			
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('branch_address') ?> </label>
            <input type="text" name="branch_name" class="form-control" placeholder="<?= $this->lang->line('enter_branch_address') ?>">
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('ifsc') ?> </label>
            <input type="text" name="ifsc_code" class="form-control" placeholder="<?= $this->lang->line('enter_ifsc') ?>">
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('account_number') ?> </label>
            <input type="text" name="account_no" class="form-control" placeholder="<?= $this->lang->line('enter_account_number') ?>">
          </div>
        </div>

        <h5 class="my-4 text-warning border-bottom pb-2"><?= $this->lang->line('approval_timeline') ?></h5>
        <div class="row g-4">
          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('date_of_approval') ?> </label>
            <input type="text" name="date_of_approval" class="form-control date-picker" value="<?= date('d-m-Y'); ?>" placeholder="dd-mm-yyyy">
          </div>

          <div class="col-md-4">
            <label class="form-label"> <?= $this->lang->line('date_of_next_evaluation') ?> </label>
            <input type="text" name="date_of_evalution" class="form-control date-picker" value="<?= date('d-m-Y', strtotime('+1 year')); ?>" placeholder="dd-mm-yyyy">
          </div>
        </div>

        <div class="col-12 text-end mt-4">
          <button type="submit" class="btn btn-primary"> <?= $this->lang->line('save') ?> </button>
        </div>

      </form>
    </div>
  </div>
</div>
  <!-- Cleaned & Styled Supplier Form -->

<!-- Scripts -->
<script src="<?= base_url("assets/plugins/jquery/jquery.min.js"); ?>"></script>
<script>
  $(document).ready(function () {
    // Supplier Code Validation
    $(document).on('blur', '.supplier_code', function () {
      let supplier_code = $(this).val();
      $.ajax({
        type: "POST",
        url: "<?= base_url('index.php/Suppliers/CheckSupplierCode/') ?>" + supplier_code,
        dataType: 'html',
        success: function (response) {
          if (response == 1) {
            alert('This Supplier Code is already taken');
            $('.supplier_code').val('');
          }
        }
      });
    });

    // Combined radio button handler
    $("input[type='radio']").click(function () {
      const supplier_type = $("input[name='supplier_type']:checked").val();
      const gst_status = $("input[name='gst_status']:checked").val();

      // Supplier type visibility logic
      if (supplier_type == 'New') {
        $(".category_of_approval, .date_of_evalution_div, .date_of_approval_div").addClass('hide');
        $(".date_of_approval, .date_of_evalution").removeAttr('required');
      } else {
        $(".category_of_approval, .date_of_evalution_div, .date_of_approval_div").removeClass('hide');
        $(".date_of_approval, .date_of_evalution").attr('required', 'required');
      }

      // GST status logic
      if (gst_status == 'Yes') {
        $(".gst_div").css('visibility', 'visible');
        $(".gstnumber").attr('required', 'required');
      } else {
        $(".gst_div").css('visibility', 'hidden');
        $(".gstnumber").removeAttr('required');
      }
    });
  });
</script>

