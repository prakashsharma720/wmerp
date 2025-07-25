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

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('add_new_supplier') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?>
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">

			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>
	<div class="main-content">
		<div class="card card-primary card-outline">
			<div class="card-body">
				<div class="row">
					<div class="col-lg-12">
						<label class="control-label"><?= $this->lang->line('category') ?></label>
						<select name="categories_id" class="form-control select2 " required="required">
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
						<!-- <?php
								$old_values = explode(',', $current[0]->products);
								echo form_multiselect('products[]', $categories, $old_values)
								?> -->
					</div>

					<div class="col-md-4 col-sm-4 p-3">
						<label class="control-label"> <?= $this->lang->line('supplier_type') ?> </label>
						<div class="form-check d-flex">
							<label class="form-check-label me-4">
								<input class="form-check-input supplier_type" type="radio" name="supplier_type" value="New">
								<?= $this->lang->line('new') ?>
							</label>
							<label class="form-check-label">
								<input class="form-check-input supplier_type" type="radio" name="supplier_type" value="Existing" checked>
								<?= $this->lang->line('existing') ?>
							</label>
						</div>
					</div>

					<div class="col-md-4 col-sm-4 category_of_approval p-3">
						<label class="control-label"><?= $this->lang->line('category_of_approval') ?></label>
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
			</div>
			<div class="form-group p-3">
    <div class="row">
        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('reg_date') ?></label>
            <input type="text" data-date-format="dd-mm-yyyy" name="reg_date" class="form-control date-picker" value="<?= date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off">
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('supplier_name') ?></label>
            <input type="text" placeholder="<?= $this->lang->line('enter_name') ?>" name="supplier_name" class="form-control" value="" required autofocus autocomplete="off">
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('supplier_code') ?></label>
            <input type="text" name="s_code" class="form-control" value="<?= $vendor_code ?>" readonly>
            <input type="hidden" name="vendor_code" value="<?= $s_code; ?>">
        </div>
    </div>
</div>

<div class="form-group p-3">
    <div class="row">
        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('contact_person') ?></label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <select name="prefix" required class="form-select">
                        <?php if ($prefix): ?>
                            <?php foreach ($prefix as $value): ?>
                                <option value="<?= $value ?>"><?= $value ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="0"><?= $this->lang->line('no_result') ?></option>
                        <?php endif; ?>
                    </select>
                </div>
                <input type="text" placeholder="<?= $this->lang->line('enter_contact_person') ?>" name="contact_person" class="form-control ms-2" value="" required autofocus autocomplete="off">
            </div>
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('email') ?></label>
            <input type="text" placeholder="<?= $this->lang->line('enter_email') ?>" name="email" class="form-control email" value="" autofocus autocomplete="off">
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('website') ?></label>
            <input type="text" placeholder="<?= $this->lang->line('enter_website') ?>" name="website" class="form-control" value="" autofocus autocomplete="off">
        </div>
    </div>
</div>

<div class="form-group p-3">
    <div class="row">
        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('country') ?></label>
            <?= form_dropdown('country_id', $countries) ?>
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('state') ?></label>
            <?= form_dropdown('state_id', $states) ?>
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('city') ?></label>
            <?= form_dropdown('city_id', $cities) ?>
        </div>
    </div>
</div>

<div class="form-group p-3">
    <div class="row">
        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('mobile') ?></label>
            <input type="text" placeholder="<?= $this->lang->line('enter_mobile') ?>" name="mobile_no" class="form-control mobile" value="" required autofocus autocomplete="off" oninput="this.value=this.value.replace(/[^0-9]/g,'')" maxlength="10" minlength="10">
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('gst_registration_status') ?></label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input gst_status" type="radio" name="gst_status" value="Yes" checked>
                    <label class="form-check-label"><?= $this->lang->line('yes') ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input gst_status" type="radio" name="gst_status" value="Un-registered Dealer">
                    <label class="form-check-label"><?= $this->lang->line('unregistered_dealer') ?></label>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-4 mb-3 gst_div">
            <b><?= $this->lang->line('gstin') ?></b> <span>(Ex.: 08ABCDE1234K1AZ)</span>
            <input type="text" placeholder="Ex. 08ABCDE1234K1AZ" name="gst_no" class="form-control gstnumber" value="" autofocus autocomplete="off" maxlength="15" minlength="15">
        </div>
    </div>
</div>

<div class="form-group p-3">
    <div class="row">
        <div class="col-md-4 col-sm-4 mb-3">
            <b><?= $this->lang->line('pan') ?></b>
            <input type="text" placeholder="Ex. ABCDE1234K" name="pan_no" class="form-control pan_no" value="" autofocus autocomplete="off" maxlength="10" minlength="10">
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <b><?= $this->lang->line('tan') ?></b>
            <input type="text" placeholder="Ex. ABCD12345A" name="tds" class="form-control tan_number" value="" autofocus autocomplete="off" maxlength="10" minlength="10">
        </div>

        <div class="col-md-4 col-sm-4 mb-3">
            <label class="control-label"><?= $this->lang->line('supplier_address') ?></label>
            <textarea placeholder="<?= $this->lang->line('enter_address') ?>" name="address" class="form-control" rows="3" required autofocus autocomplete="off" style="resize: none;"></textarea>
        </div>
    </div>
</div>

			<div class="form-group p-3">
				<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 mb-3">
						<label class="control-label"> <?= $this->lang->line('bank_name') ?></label>
						<?php
						$bank_nm = array(
							'No' => 'Select Option',
							'Allahabad Bank' => 'Allahabad Bank',
							'Andhra Bank' => 'Andhra Bank',
							'Axis Bank' => 'Axis Bank',
							'Bank of Baroda - Corporate Banking' => 'Bank of Baroda - Corporate Banking',
							'Bank of Baroda - Retail Banking' => 'Bank of Baroda - Retail Banking',
							'Bank of India' => 'Bank of India',
							'Bank of Maharashtra' => 'Bank of Maharashtra',
							'Canara Bank' => 'Canara Bank',
							'Central Bank of India' => 'Central Bank of India',
							'City Union Bank' => 'City Union Bank',
							'Corporation Bank' => 'Corporation Bank',
							'Development Credit Bank' => 'Development Credit Bank',
							'Dhanlaxmi Bank' => 'Dhanlaxmi Bank',
							'ICICI Bank' => 'ICICI Bank',
							'IDBI Bank' => 'IDBI Bank',
							'Indian Bank' => 'Indian Bank',
							'Indian Overseas Bank' => 'Indian Overseas Bank',
							'IndusInd Bank' => 'IndusInd Bank',
							'ING Vysya Bank' => 'ING Vysya Bank',
							'Jammu and Kashmir Bank' => 'Jammu and Kashmir Bank',
							'Karnataka Bank Ltd' => 'Karnataka Bank Ltd',
							'Karur Vysya Bank' => 'Karur Vysya Bank',
							'Kotak Bank' => 'Kotak Bank',
							'Laxmi Vilas Bank' => 'Laxmi Vilas Bank',
							'Oriental Bank of Commerce' => 'Oriental Bank of Commerce',
							'Punjab National Bank - Corporate Banking' => 'Punjab National Bank - Corporate Banking',
							'Punjab National Bank - Retail Banking' => 'Punjab National Bank - Retail Banking',
							'Punjab & Sind Bank' => 'Punjab & Sind Bank',
							'Shamrao Vitthal Co-operative Bank' => 'Shamrao Vitthal Co-operative Bank',
							'South Indian Bank' => 'South Indian Bank',
							'State Bank of Bikaner & Jaipur' => 'State Bank of Bikaner & Jaipur',
							'State Bank of Hyderabad' => 'State Bank of Hyderabad',
							'State Bank of India' => 'State Bank of India',
							'State Bank of Mysore' => 'State Bank of Mysore',
							'State Bank of Patiala' => 'State Bank of Patiala',
							'State Bank of Travancore' => 'State Bank of Travancore',
							'Syndicate Bank' => 'Syndicate Bank',
							'Tamilnad Mercantile Bank Ltd.' => 'Tamilnad Mercantile Bank Ltd.',
							'UCO Bank' => 'UCO Bank',
							'Union Bank of India' => 'Union Bank of India',
							'United Bank of India' => 'United Bank of India',
							'Vijaya Bank' => 'Vijaya Bank',
							'Yes Bank Ltd' => 'Yes Bank Ltd'
						);
						echo form_dropdown('bank_name', $bank_nm)
						?>
						<!--<input type="text" placeholder="Enter bank name" name="bank_name" class="form-control " value="" autofocus autocomplete="off">-->
					</div>
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"><?= $this->lang->line('branch_address') ?></label>
						<input type="text" placeholder="<?= $this->lang->line('enter_branch_address') ?>" name="branch_name" class="form-control" value="" autofocus autocomplete="off">
					</div>
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"><?= $this->lang->line('ifsc') ?></label>
						<input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_ifsc') ?>" name="ifsc_code" class="form-control" value="" autofocus autocomplete="off">
					</div>
				</div>
			</div>
			<div class="form-group p-3">
				<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"><?= $this->lang->line('account_number') ?></label>
						<input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_account_number') ?>" name="account_no" class="form-control" value="" autofocus autocomplete="off">
					</div>
					<div class="col-md-4 col-sm-4 date_of_approval_div">
						<label class="control-label"><?= $this->lang->line('date_of_approval') ?></label>
						<input type="text" data-date-formate="dd-mm-yyyy" name="date_of_approval"
							class="form-control date_of_approval date-picker " value="<?php echo date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off">
					</div>
					<div class="col-md-4 col-sm-4 date_of_evalution_div">
						<label class="control-label"> <?= $this->lang->line('date_of_evalution') ?></label>
						<input type="text" data-date-formate="dd-mm-yyyy" name="date_of_evalution"
							class="form-control date_of_evalution date-picker date_of_evalution1"
							value="<?php echo date('d-m-Y', strtotime('+1 year')); ?> " placeholder="dd-mm-yyyy" autofocus autocomplete="off">
					</div>
				</div>
			</div>


			<button type="submit" class="btn btn-primary btn-block"> <?= $this->lang->line('save') ?></button>
		</div>
	</div>
</div>
</div>
</div>
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		$(document).on('blur', '.supplier_code', function() {
			var supplier_code = $('.supplier_code').val();
			//var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+supplier_code;
			//alert(aa);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('index.php/Suppliers/CheckSupplierCode/') ?>" + supplier_code,

				//data: {id:role_id},
				dataType: 'html',
				success: function(response) {
					//alert(response);
					if (response == 1) {
						alert('This Supplier Code is already taken');
						$('.supplier_code').val('');
					}
				}
			});
		});

		$("input[type='radio']").click(function() {
			var supplier_type = $("input[name='supplier_type']:checked").val();
			if (supplier_type == 'New') {
				$(".category_of_approval").hide();
				$(".date_of_evalution_div").addClass('hide');
				$(".date_of_approval_div").addClass('hide');
				$(".date_of_evalution").removeAttr('required');
				$(".date_of_approval").removeAttr('required');

			} else {
				$(".category_of_approval").show();
				$(".date_of_evalution_div").removeClass('hide');
				$(".date_of_approval_div").removeClass('hide');
				$(".date_of_approval").attr('required', 'required');
				$(".date_of_evalution").attr('required', 'required');

				//$(".category_of_approval").addClass('show');
			}
		});

		$("input[type='radio']").click(function() {
			var gst_status = $("input[name='gst_status']:checked").val();
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