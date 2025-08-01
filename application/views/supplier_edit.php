<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
		<?= $this->session->flashdata('success'); ?>
	</div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-times"></i> <?= $this->lang->line('alert') ?>!</h5>
		<?= $this->session->flashdata('failed'); ?>
	</div>
<?php endif; ?>

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('edit_supplier') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?></li>
			</ul>
		</div>
	</div>

	<!-- Supplier Profile Form -->
	<div class="main-content">
		<div class="card card-primary card-outline">
			<div class="card-body">
				<h5 class="mb-3 text-primary border-bottom pb-2"><?= $this->lang->line('supplier_profile_details'); ?>
</h5>
				<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Suppliers/editSupplier/<?= $old_id ?>">
					<?php echo form_hidden('id', $old_id); ?>

					<!-- Supplier Info Section -->
					<div class="form-group">
						<div class="row">
							<!-- Category -->
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('category') ?></label>
								<select name="categories_id" class="form-control select2">
									<?php if ($categories): ?>
										<?php foreach ($categories as $value): ?>
											<option value="<?= $value['id'] ?>" <?= $value['id'] == $current[0]->categories_id ? 'selected' : '' ?>>
												<?= $value['category_name'] ?>
											</option>
										<?php endforeach; ?>
									<?php else: ?>
										<option value="0"><?= $this->lang->line('no_result') ?></option>
									<?php endif; ?>
								</select>
							</div>

							<!-- Supplier Type -->
							<?php
							$new = $existing = '';
							if (!empty($current[0]->supplier_type)) {
								$new = $current[0]->supplier_type == 'New' ? 'checked' : '';
								$existing = $current[0]->supplier_type == 'Existing' ? 'checked' : '';
							}
							?>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('supplier_type') ?></label>
								<div>
									<label class="form-check-inline">
										<input class="form-check-input supplier_type" type="radio" name="supplier_type" value="New" <?= $new ?>> <?= $this->lang->line('new') ?>
									</label>
									<label class="form-check-inline">
										<input class="form-check-input supplier_type" type="radio" name="supplier_type" value="Existing" <?= $existing ?>> <?= $this->lang->line('existing') ?>
									</label>
								</div>
							</div>

							<!-- Category of Approval -->
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('category_of_approval') ?></label>
								<?php
								$app_cat = array(
									'No' => 'Select Option',
									'A' => 'A',
									'B' => 'B',
									'C' => 'C'
								);
								echo form_dropdown('category_of_approval', $app_cat, $current[0]->category_of_approval, 'class="form-control"');
								?>
							</div>
						</div>
					</div>

					<!-- Supplier Basic Details -->

					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('reg_date') ?></label>
								<input type="text" name="reg_date" class="form-control date-picker" value="<?= date('d-m-Y', strtotime($current[0]->reg_date)); ?>" placeholder="dd-mm-yyyy" required autocomplete="off">
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('supplier_name') ?></label>
								<input type="text" name="supplier_name" class="form-control" value="<?= $current[0]->supplier_name; ?>" required autocomplete="off">
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('supplier_code') ?></label>
								<input type="text" class="form-control" value="<?= $vendor_code ?>" readonly>
								<input type="hidden" name="vendor_code" value="<?= $s_code; ?>">
							</div>
						</div>
					</div>

					<!-- Contact Info -->
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('contact_person') ?></label>
								<div class="input-group">
									<select name="prefix" class="form-control" required>
										<?php if ($prefix): ?>
											<?php foreach ($prefix as $value): ?>
												<option value="<?= $value ?>" <?= $value == $current[0]->prefix ? 'selected' : '' ?>><?= $value ?></option>
											<?php endforeach; ?>
										<?php else: ?>
											<option value="0"><?= $this->lang->line('no_result') ?></option>
										<?php endif; ?>
									</select>
									<input type="text" name="contact_person" class="form-control" value="<?= $current[0]->contact_person; ?>" required autocomplete="off">
								</div>
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('email') ?></label>
								<input type="email" name="email" class="form-control" value="<?= $current[0]->email; ?>" autocomplete="off">
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('mobile') ?></label>
								<input type="text" name="mobile_no" class="form-control" value="<?= $current[0]->mobile_no; ?>" required maxlength="10" minlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
							</div>
						</div>
					</div>

					<!-- Address Section -->
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('country') ?></label>
								<?= form_dropdown('country_id', $countries, $current[0]->country_id, 'class="form-control"') ?>
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('state') ?></label>
								<?= form_dropdown('state_id', $states, $current[0]->state_id, 'class="form-control"') ?>
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('city') ?></label>
								<?= form_dropdown('city_id', $cities, $current[0]->city_id, 'class="form-control"') ?>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('website') ?></label>
								<input type="text" name="website" class="form-control" value="<?= $current[0]->website; ?>" autocomplete="off">
							</div>

							<!-- GST Status -->
							<?php
							$gst_yes = $gst_unreg = '';
							if (!empty($current[0]->gst_status)) {
								$gst_yes = $current[0]->gst_status == 'Yes' ? 'checked' : '';
								$gst_unreg = $current[0]->gst_status == 'Un-registered Dealer' ? 'checked' : '';
							}
							?>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('gst_status') ?></label>
								<div>
									<label class="form-check-inline">
										<input class="form-check-input" type="radio" name="gst_status" value="Yes" <?= $gst_yes ?>> <?= $this->lang->line('yes') ?>
									</label>
									<label class="form-check-inline">
										<input class="form-check-input" type="radio" name="gst_status" value="Un-registered Dealer" <?= $gst_unreg ?>> <?= $this->lang->line('unregistered_dealer') ?>
									</label>
								</div>
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('gst_in') ?> <span>(Ex. 08ABCDE1234K1AZ)</span></label>
								<input type="text" name="gst_no" class="form-control" value="<?= $current[0]->gst_no ?>" maxlength="15" minlength="15" autocomplete="off">
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('pan') ?></label>
								<input type="text" name="pan_no" class="form-control" value="<?= $current[0]->pan_no; ?>" maxlength="10" minlength="10" autocomplete="off">
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('tan') ?></label>
								<input type="text" name="tds" class="form-control" value="<?= $current[0]->tds; ?>" maxlength="10" minlength="10" autocomplete="off">
							</div>
							<div class="col-md-4">
								<label class="control-label"><?= $this->lang->line('supplier_address') ?></label>
								<textarea name="address" class="form-control" rows="3" required style="resize: none;"><?= $current[0]->address; ?></textarea>
							</div>
						</div>
					</div>

					<!-- 🔵 Bank Details Section -->
					  <h5 class="my-4 text-success border-bottom pb-2"><?= $this->lang->line('bank_details'); ?>
</h5>
			
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">

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
								echo form_dropdown('bank_name', $bank_nm, $current[0]->bank_name)
								?>
							</div>

							<div class="col-md-4 col-sm-4 ">
								<label class="control-label"><?= $this->lang->line('branch_name') ?></label>
								<input type="text" placeholder="<?= $this->lang->line('branch_name') ?>" name="branch_name" class="form-control" value="<?php echo $current[0]->branch_name; ?>" autofocus autocomplete="off">
							</div>

							<div class="col-md-4 col-sm-4 ">
								<label class="control-label"><?= $this->lang->line('ifsc_code') ?></label>
								<input type="text" id="firstName" placeholder="<?= $this->lang->line('ifsc_code') ?>" name="ifsc_code" class="form-control" value="<?php echo $current[0]->ifsc_code; ?>" autofocus autocomplete="off">
							</div>
						</div>
					</div>


					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"><?= $this->lang->line('account_number') ?></label>
						<input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_account_no') ?>" name="account_no" class="form-control" value="<?php echo $current[0]->account_no; ?>" autofocus autocomplete="off">
					</div>


					<!-- <h5 class="my-4 text-warning border-bottom pb-2">
						<?= $this->lang->line('approval_timeline') ?>
					</h5> -->
<h5 class="my-4 text-warning border-bottom pb-2"><?= $this->lang->line('approval_timeline'); ?>
</h5>
					<div class="row g-4">
						<div class="col-md-4">
							<label class="control-label"><?= $this->lang->line('date_of_approval') ?></label>
							<input
								type="text"
								name="date_of_approval"
								class="form-control date-picker"
								value="<?= date('d-m-Y', strtotime($current[0]->date_of_approval)) ?>"
								placeholder="dd-mm-yyyy"
								autocomplete="off">
						</div>

						<div class="col-md-4">
							<label class="control-label"><?= $this->lang->line('date_of_next_evaluation') ?></label>
							<input
								type="text"
								name="date_of_evalution"
								class="form-control date-picker"
								value="<?= date('d-m-Y', strtotime($current[0]->date_of_evalution)) ?>"
								placeholder="dd-mm-yyyy"
								autocomplete="off">
						</div>
					</div>

					<!-- Submit Button -->
					<div class="col-12 text-end mt-4">
						<button type="submit" class="btn btn-primary">
							<?= $this->lang->line('save') ?>
						</button>
					</div>

			</div>
			</form>
		</div>
	</div>
</div>

</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url = '<?php echo base_url(); ?>';
		//alert(base_url);
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
		var supplier_type1 = $("input[name='supplier_type']:checked").val();
		if (supplier_type1 == 'New') {
			$(".category_of_approval").hide();
			$(".date_of_evalution").addClass('hide');
			$(".date_of_approval").addClass('hide');
			//$(".category_of_approval").removeClass('show');
		} else {
			$(".category_of_approval").show();
			$(".date_of_evalution").removeClass('hide');
			$(".date_of_approval").removeClass('hide');
			//$(".category_of_approval").addClass('show');
		}

		$("input[type='radio']").click(function() {
			var supplier_type = $("input[name='supplier_type']:checked").val();
			if (supplier_type == 'New') {
				$(".category_of_approval").hide();
				$(".date_of_evalution").addClass('hide');
				$(".date_of_approval").addClass('hide');
			} else {
				$(".category_of_approval").show();
				$(".date_of_evalution").removeClass('hide');
				$(".date_of_approval").removeClass('hide');
				//$(".category_of_approval").addClass('show');
			}
		});
		var gst_status1 = $("input[name='gst_status']:checked").val();
		if (gst_status1 == 'Yes') {
			$(".gst_div").show();
			$(".gstnumber").attr('required', 'required');
		} else {
			$(".gst_div").hide();
			$(".gstnumber").removeAttr('required');
			//$(".category_of_approval").addClass('show');
		}


		$("input[type='radio']").click(function() {
			var gst_status = $("input[name='gst_status']:checked").val();
			if (gst_status == 'Yes') {
				$(".gst_div").show();
				$(".gstnumber").attr('required', 'required');
			} else {
				$(".gst_div").hide();
				$(".gstnumber").removeAttr('required');
			}
		});
	});
</script>
