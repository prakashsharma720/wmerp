<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Lead Data</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">Lead Data</li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <!-- Collapse Filter -->
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        <i class="feather-filter"></i>
                    </a>

                    <!-- Download CSV -->
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#UploadCsvs">
                        <i class="feather-upload me-2"></i>
                        <span>Upload CSV</span>
                    </a>


                    <!-- Download CSV -->
                    <a href="<?php echo base_url('uploads/Lead_csv_MO_ERP.xlsx'); ?>" class="btn btn-primary" download>
                        <i class="feather-download me-2"></i>
                        <span>Download CSV</span>
                    </a>

                    <!-- Create New Lead -->
                    <a href="<?php echo base_url('index.php/Leads/add'); ?>" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Create New Lead</span>
                    </a>
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

    <!-- Load Filter -->
    <?php $this->load->view('Lead Module/Lead Generation/component/filter-model'); ?>
    <?php $this->load->view('Lead Module/Lead Generation/component/upload-csv-model'); ?>

    <!-- Flash Success Message -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <h5><i class="icon fa fa-check"></i> Success!</h5>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <!-- Flash Error Message -->
    <?php if ($this->session->flashdata('failed')): ?>
        <div class="alert alert-error alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-check"></i> Alert!</h5>
            <?php echo $this->session->flashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <form method="get" action="<?php echo base_url(); ?>index.php/Leads/approveall">
                    <div class="card stretch stretch-full">
                        <div class="form-group m-2">
                            <?php if ($role_id == '1' || $role_id == '2') { ?>
                            <div class="row">
                                <div class="col-4">
                                    <select id="selectestimateid" class="form-control" data-select2-selector="default" name="approveaction">
                                        <option class="white" value="">Select Action</option>
                                        <option class="white" value="Approved">Approve</option>
                                        <option class="white" value="Rejected">Rejected</option>
                                        <option class="white" value="delete_all">Delete</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary me-2 bulk_action">
                                        <i class="bi bi-filter"></i> Apply
                                    </button>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover" id="proposalList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">
                                                <div class="custom-control custom-checkbox ms-1">
                                                    <input type="checkbox" class="custom-control-input" id="checkAllProposal">
                                                    <label class="custom-control-label" for="checkAllProposal"></label>
                                                </div>
                                            </th>
                                            <th>Sr. No.</th>
                                            <th>Duplicate Lead</th>
                                            <th>Status</th>
                                            <th>Code</th>
                                            <th>Date</th>
                                            <th>Services</th>
                                            <th>Title</th>
                                            <th>Contact Person</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>

                                    <!-- Load tbody Partial -->
                                    <?php $this->load->view('Lead Module/Lead Generation/component/tbody'); ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		var base_url = '<?php echo base_url(); ?>';
		//alert(base_url);
		$(document).on('change', '.category', function () {
			var category_id = $('.category').find('option:selected').val();
			//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
			//alert(category_id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>" + category_id,
				//data: {id:role_id},
				dataType: 'html',
				success: function (response) {
					//alert(response);
					$(".suppliers").html(response);
					$('.select2').select2();
				}
			});
		});

		jQuery('#checkAllProposal').on('click', function (e) {
			if ($(this).is(':checked', true)) {
				$(".sub_chk").prop('checked', true);
			}
			else {
				$(".sub_chk").prop('checked', false);
			}
		});

		jQuery('.bulk_action').on('click', function (e) {
			var allVals = [];
			$(".sub_chk:checked").each(function () {
				allVals.push($(this).val());
			});
			//alert(allVals.length); return false;  
			if (allVals.length <= 0) {
				alert("Please select row.");
				return false;
			}
			// else {  
			//   WRN_PROFILE_DELETE = "Are you sure you want to assign  selected records?";  
			//   var check = confirm(WRN_PROFILE_DELETE);  
			//   if(check == true){  
			//     var join_selected_values = allVals.join(","); 

			//     $(".all_selected_ids").val(join_selected_values);
			// $.ajax({   
			//   type: "POST",  
			//   url: "<?php echo base_url(); ?>index.php/Leads/assignto",  
			//   cache:false,  
			//   data: 'ids='+join_selected_values,  
			//   success: function(response)  
			//   {   
			//     $(".successs_mesg").html(response);
			//     location.reload();
			//   }   
			// });

		}

		);


	});
	jQuery('#delete').on('click', function (e) {
		var allVals = [];
		$(".sub_chk:checked").each(function () {
			allVals.push($(this).val());
		});
		//alert(allVals.length); return false;  
		if (allVals.length <= 0) {
			alert("Please select row.");
			return false;
		}
		else {
			WRN_PROFILE_DELETE = "Are you sure you want to delete  selected records?";
			var check = confirm(WRN_PROFILE_DELETE);
			if (check == true) {
				var join_selected_values = allVals.join(",");

				$(".all_selected_ids").val(join_selected_values);
				// $.ajax({   
				//   type: "POST",  
				//   url: "<?php echo base_url(); ?>index.php/Leads/deleteItem",  
				//   cache:false,  
				//   data: 'ids='+join_selected_values,  
				//   success: function(response)  
				//   {   
				//     $(".successs_mesg").html(response);
				//     location.reload();
				//   }   
				// });

			}
		}
	});
</script>