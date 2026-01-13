<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="nxl-content">
	<!-- [ page-header ] start -->
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('transporter'); ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item"><a href="<?= base_url() ?>"><?= $this->lang->line('home'); ?></a></li>
				<li class="breadcrumb-item"><?= $this->lang->line('add_new_transporter'); ?></li>
			</ul>
		</div>
		<div class="page-header-right ms-auto">
			 
			<div class="page-header-right-items d-flex align-items-center gap-2">
				 <?php $this->load->view('layout/alerts'); ?>
				<a class="btn btn-light-brand"><span>Transporter Code</span></a>
				<a class="btn btn-primary"><span><?= $tp_code; ?></span></a>
			</div>
		</div>
	</div>
	<!-- [ page-header ] end -->
	<!-- [ Main Content ] start -->
	<div class="main-content">
		<div class="row">
			<div class="col-xl-12">
				<div class="card stretch stretch-full">
					<div class="card-body">
						<form class="form-horizontal" method="post" action="<?= base_url(); ?>index.php/Transporters/add_new_transporter">

							<!-- Transporter Name & Type & Approval -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('transporter_name') ?></label>
										<input type="text" name="transporter_name" class="form-control"
											placeholder="<?= $this->lang->line('enter_name') ?>" required autocomplete="off">
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('transporter_type') ?></label>
										<div class="d-flex align-items-center">
											<div class="form-check me-3">
												<input class="form-check-input transporter_type" type="radio" name="transporter_type" value="New">
												<label class="form-check-label"><?= $this->lang->line('new') ?></label>
											</div>
											<div class="form-check">
												<input class="form-check-input transporter_type" type="radio" name="transporter_type" value="<?= $this->lang->line('existing') ?>" checked>
												<label class="form-check-label"><?= $this->lang->line('existing') ?></label>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 mb-4 category_of_approval">
										<label class="form-label"><?= $this->lang->line('category_of_approval') ?></label>
										<?php
										$app_cat = [
											'No' => 'Select Option',
											'A'  => 'A',
											'B'  => 'B',
											'C'  => 'C'
										];
										echo form_dropdown('category_of_approval', $app_cat, '', 'class="form-control"');
										?>
									</div>
								</div>
							</div>

							<!-- Transporter Code & Contact Person & Email -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('transporter_code') ?></label>
										<input type="text" name="tp_code" class="form-control" value="<?= $vendor_code ?>" readonly>
										<input type="hidden" name="vendor_code" value="<?= $tp_code; ?>">
										<?= form_error('vendor_code', '<span class="text-danger">', '</span>'); ?>
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('contact_person') ?></label>
										<div class="input-group">
											<select name="prefix" class="form-select" style="max-width: 100px;">
												<?php if ($prefix): ?>
													<?php foreach ($prefix as $value): ?>
														<option value="<?= $value ?>"><?= $value ?></option>
													<?php endforeach; ?>
												<?php else: ?>
													<option value="0"><?= $this->lang->line('no_result') ?></option>
												<?php endif; ?>
											</select>
											<input type="text" name="contact_person" class="form-control" placeholder="<?= $this->lang->line('enter_contact_person') ?>">
										</div>
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('email') ?></label>
										<input type="email" name="email" class="form-control" placeholder="<?= $this->lang->line('enter_email') ?>">
									</div>
								</div>
							</div>

							<!-- Mobile, Alternate No, Website -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('mobile') ?></label>
										<input type="text" name="mobile_no" class="form-control" maxlength="10" minlength="10"
											oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="<?= $this->lang->line('enter_mobile') ?>">
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('alternate_number') ?></label>
										<input type="text" name="alternate_no" class="form-control" maxlength="10" minlength="10"
											oninput="this.value = this.value.replace(/[^0-9]/g, '');" placeholder="<?= $this->lang->line('enter_alternate_number') ?>">
										<?= form_error('alternate_no', '<span class="text-danger">', '</span>'); ?>
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('website') ?></label>
										<input type="text" name="website" class="form-control" placeholder="<?= $this->lang->line('enter_website') ?>">
									</div>
								</div>
							</div>



							<style>
/* Multiselect Container */
.custom-multiselect {
  width: 100%;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 6px;
  min-height: 42px;
  display: flex;
  flex-wrap: wrap;
  cursor: pointer;
  background: #fff;
}

/* Selected Tags */

.selected-tag span {
  margin-left: 6px;
  cursor: pointer;
  font-weight: bold;
}

/* Options Dropdown */
.options-box {
  display: none;
  border: 1px solid #ccc;
  border-radius: 6px;
  margin-top: 2px;
  max-height: 150px;
  overflow-y: auto;
  background: white;
  position: absolute;
  width: 100%;
  z-index: 999;
}

.options-box div {
  padding: 6px;
  cursor: pointer;
}

.options-box div:hover {
  background: #f1f1f1;
}

/* Address textarea */
.address-textarea {
  width: 100%;
  min-height: 80px;
  border: 1px solid #ccc;
  border-radius: 6px;
  padding: 6px;
  resize: none;
  font-family: inherit;
  font-size: 14px;
}
</style>

<div class="form-group">
  <div class="row">
    <!-- States Dropdown -->
    <div class="col-lg-4 col-md-4 mb-4" style="position: relative;">
      <label class="form-label fw-bold"><?= $this->lang->line('service_for_the_state') ?></label>
      <div class="custom-multiselect" id="multiSelect"> <?= $this->lang->line('select_state') ?></div>
      <div class="options-box" id="optionsBox"></div>
    </div>

    <!-- Address Field -->
    <div class="col-lg-8 col-md-8 mb-4">
      <label class="form-label fw-bold"><?= $this->lang->line('address') ?></label>
      <textarea name="address" class="address-textarea" placeholder="<?= $this->lang->line('enter_address') ?>" required></textarea>
    </div>
  </div>
</div>

<script>
// States List
const states = [
  "All India","ANDHRA PRADESH","ASSAM","ARUNACHAL PRADESH","BIHAR","GUJRAT",
  "HARYANA","HIMACHAL PRADESH","JAMMU & KASHMIR","KARNATAKA","KERALA",
  "MADHYA PRADESH","MAHARASHTRA","MANIPUR","MEGHALAYA","MIZORAM","NAGALAND",
  "ORISSA","PUNJAB","RAJASTHAN","SIKKIM","TAMIL NADU","TRIPURA","UTTAR PRADESH",
  "WEST BENGAL","DELHI","GOA","PONDICHERY","LAKSHDWEEP","DAMAN & DIU",
  "DADRA & NAGAR","CHANDIGARH","ANDAMAN & NICOBAR","UTTARANCHAL",
  "JHARKHAND","TELANGANA"
];

const multiSelect = document.getElementById("multiSelect");
const optionsBox = document.getElementById("optionsBox");
let selectedStates = [];

// Fill dropdown options
states.forEach(state => {
  const div = document.createElement("div");
  div.textContent = state;
  div.addEventListener("click", () => selectState(state));
  optionsBox.appendChild(div);
});

// Toggle options
multiSelect.addEventListener("click", () => {
  optionsBox.style.display = optionsBox.style.display === "block" ? "none" : "block";
});

// Select state
function selectState(state) {
  if (!selectedStates.includes(state)) {
    selectedStates.push(state);
    renderTags();
  }
}

// Render selected tags
function renderTags() {
  multiSelect.innerHTML = "";
  selectedStates.forEach(state => {
    const tag = document.createElement("div");
    tag.className = "selected-tag";
    tag.innerHTML = `${state} <span onclick="removeState('${state}')">&times;</span>`;
    multiSelect.appendChild(tag);
  });
}

// Remove state
function removeState(state) {
  selectedStates = selectedStates.filter(s => s !== state);
  renderTags();
}
</script>


							<!-- Dates & GST & TDS -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4 " style="position:relative;bottom:5px">
										<label class="form-label"><?= $this->lang->line('reg_date') ?></label>
										<input type="text" name="reg_date" class="form-control date-picker" value="<?= date('d-m-Y'); ?>" placeholder="dd-mm-yyyy" autocomplete="off">
									</div>
									<div class="col-lg-4 col-md-4 mb-4" style="position:relative;bottom:5px">
										<label class="form-label"><?= $this->lang->line('gst_status') ?></label>
										<div class="d-flex align-items-center">
											<div class="form-check me-3">
												<input class="form-check-input gst_status" type="radio" name="gst_status" value="Yes" checked>
												<label class="form-check-label"><?= $this->lang->line('yes') ?></label>
											</div>
											<div class="form-check">
												<input class="form-check-input gst_status" type="radio" name="gst_status" value="Un-registered Dealer">
												<label class="form-check-label"><?= $this->lang->line('unregistered_dealer') ?></label>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('no_tds_declaration') ?></label>
										<div class="d-flex align-items-center">
											<div class="form-check me-3">
												<input class="form-check-input supplier_type" type="radio" name="tds_declaration" value="Available">
												<label class="form-check-label"><?= $this->lang->line('available') ?></label>
											</div>
											<div class="form-check">
												<input class="form-check-input supplier_type" type="radio" name="tds_declaration" value="Not-Available" checked>
												<label class="form-check-label"><?= $this->lang->line('not_available') ?></label>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- PAN, GST No, TAN -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('pan') ?></label>
										<input type="text" name="pan_no" class="form-control pan_no" maxlength="10" minlength="10" placeholder="Ex. ABCEDE2548K">
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('transporter_id') ?></label>
										<input type="text" name="gst_no" class="form-control" placeholder="<?= $this->lang->line('enter_id') ?>" required>
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('tan') ?></label>
										<input type="text" name="tds" class="form-control tan_number" maxlength="10" minlength="10" placeholder="Ex. ABCD12345A">
									</div>
								</div>
							</div>

							<!-- Bank Details -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('bank_name') ?></label>
										<label class="form-label"> <?= $this->lang->line('bank_name') ?></label>
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
										<!--<input type="text" placeholder="Enter bank name" name="bank_name" class="form-control" value="" required autofocus>-->
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('branch_name') ?></label>
										<input type="text" name="branch_name" class="form-control" placeholder="<?= $this->lang->line('enter_branch_address') ?>">
									</div>
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('ifsc_code') ?></label>
										<input type="text" name="ifsc_code" class="form-control" placeholder="<?= $this->lang->line('enter_ifsc_code') ?>">
									</div>
								</div>
							</div>

							<!-- Account & Dates -->
							<div class="form-group">
								<div class="row">
									<div class="col-lg-4 col-md-4 mb-4">
										<label class="form-label"><?= $this->lang->line('account_number') ?></label>
										<input type="text" name="account_no" class="form-control" placeholder="<?= $this->lang->line('enter_account_number') ?>">
									</div>
									<div class="col-lg-4 col-md-4 mb-4 date_of_approval">
										<label class="form-label"><?= $this->lang->line('date_of_approval') ?></label>
										<input type="text" name="date_of_approval" class="form-control date-picker" value="<?= date('d-m-Y') ?>" placeholder="dd-mm-yyyy">
									</div>
									<div class="col-lg-4 col-md-4 mb-4 date_of_evalution">
										<label class="form-label"><?= $this->lang->line('date_of_next_evaluation') ?></label>
										<input type="text" name="date_of_evalution" class="form-control date-picker" value="<?= date('d-m-Y', strtotime('+1 year')); ?>" placeholder="dd-mm-yyyy" required>
									</div>
								</div>
							</div>

							<!-- Submit -->
							<div class="text-end">
								<button type="submit" class="btn btn-primary"><?= $this->lang->line('save') ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- [ Main Content ] end -->
</div>
<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		var base_url = '<?php echo base_url(); ?>';
		//alert(base_url);
		$(document).on('blur', '.transporter_code', function() {
			var transporter_code = $('.transporter_code').val();
			//var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+transporter_code;
			//alert(aa);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('index.php/Transporters/CheckTrasnferCode/') ?>" + transporter_code,

				//data: {id:role_id},
				dataType: 'html',
				success: function(response) {
					//alert(response);
					if (response == 1) {
						alert('This Trasnporter Code is already taken');
						$('.transporter_code').val('');
					}
				}
			});
		});

		/*	$("input[type='radio']").click(function(){
            var transporter_type = $("input[name='transporter_type']:checked").val();
				if(transporter_type=='New'){
					$(".category_of_approval").hide();
					$(".date_of_evalution").addClass('hide');
					$(".date_of_approval").addClass('hide');
				}
				else {
					$(".category_of_approval").show();
                    $(".date_of_evalution").removeClass('hide');
                    $(".date_of_approval").removeClass('hide');
					//$(".category_of_approval").addClass('show');
				}
			});*/

		var transporter_type = $("input[name='transporter_type']:checked").val();
		if (transporter_type == 'New') {
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
			var transporter_type = $("input[name='transporter_type']:checked").val();
			if (transporter_type == 'New') {
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
		$("input[type='radio']").click(function() {
			var gst_status = $("input[name='gst_status']:checked").val();
			if (gst_status == 'Yes') {
				$(".gst_div").css('visibility', 'visible');
				$(".gstnumber").attr('required', 'required');
			} else {
				$(".gst_div").css('visibility', 'hidden');
				$(".gstnumber").removeAttr('required');
				$(".gstnumber").val('');
			}
		});
	});
</script>