<?php if ($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Success!</h5>
    <?php echo $this->session->flashdata('success'); ?>
</div>
<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
<div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> Alert!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
</div>
<?php endif; ?>

<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('customer_support') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a
                        href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('complaints_data') ?>
                </li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="pull-right">
                    <a class="btn btn-xs btn-primary "
                        href="<?php echo base_url(); ?>index.php/CustomerSupport_controller/add">
                        <i class="fa fa-plus"></i> <?= $this->lang->line('create') ?></a>
                </div>
            </div>
        </div>

        <!-- Mobile Toggle -->
        <div class="d-md-none  align-items-center">
            <a href="javascript:void(0)" class="page-header-right-open-toggle">
                <i class="feather-align-right fs-20"></i>
            </a>
        </div>
    </div>
    <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <span class="card-title"><?= $this->lang->line('complaints_data') ?>
                                </span>
                            </div>
                            <div class="table-responsive">
                                <!-- <table id="example1" class="table table-bordered table-striped"> -->
                                <table class="table table-hover  table-bordered table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th> <?= $this->lang->line('sr_no') ?></th>
                                            <th><?= $this->lang->line('date') ?></th>
                                            <th> <?= $this->lang->line('complaint_category') ?></th>
                                            <th><?= $this->lang->line('order_id') ?></th>
                                            <th><?= $this->lang->line('ticket') ?></th>
                                            <th><?= $this->lang->line('customer_name') ?></th>
                                            <th><?= $this->lang->line('email') ?></th>
                                            <th><?= $this->lang->line('phone') ?></th>
                                            <th><?= $this->lang->line('status') ?></th>
                                            <th> <?= $this->lang->line('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										if (!empty($leads)) {$i = 1; foreach ($leads as $obj) {
										?>
                                        <tr>

                                            <td> <?= $i ?> </td>
                                            <td> <?= $obj['ticket_data']['date'] ?> </td>
                                            <td> <?= $obj['ticket_data']['category'] ?> </td>
                                            <td><?php if (!empty($obj['order_id'])) { ?>
                                                <?= $obj['ticket_data']['order_id'] ?>
                                                <?php } else { ?>
                                                <span>--</span>
                                                <?php } ?>
                                            </td>
                                            <td> <?= $obj['ticket_data']['ticket'] ?> </td>
                                            <td> <?= $obj['ticket_data']['c_name'] ?> </td>
                                            <td> <?= $obj['ticket_data']['email'] ?> </td>
                                            <td> <?= $obj['ticket_data']['phone'] ?> </td>

                                            <td> <?php if ($obj['ticket_data']['status'] == 'Open') { ?>
                                                <span
                                                    class="badge bg-soft-primary text-primary"><?= $obj['ticket_data']['status'] ?></span>
                                                <?php } else if ($obj['ticket_data']['status'] == 'Closed') { ?>
                                                <span
                                                    class="badge bg-soft-danger text-danger"><?= $obj['ticket_data']['status'] ?></span>
                                                <?php } else if ($obj['ticket_data']['status'] == 'Resolved') { ?>
                                                <span
                                                    class="badge bg-soft-success text-success"><?= $obj['ticket_data']['status'] ?></span>
                                                <?php } else { ?>
                                                    <span
                                                    class="badge bg-soft-warning text-warning"><?= $obj['ticket_data']['status'] ?></span>
                                                    <?php } ?>
                                            </td>



                                            <td>
                                                <div class="hstack gap-2 justify-content-start">
                                                    <a class="btn btn-icon avatar-text avatar-md"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#ViewDetails<?php echo $obj['ticket_data']['id']; ?>"
                                                        title="View More">
                                                        <i class="feather feather-eye "></i>
                                                    </a>
                                                    <!-- <a href="javascript:void(0);" class="btn btn-primary w-100" id="add-notes">
                                                    <i class="feather-plus me-2"></i>
                                                    <span>Add Notes</span>
                                                </a> -->

                                                    <a class="btn btn-icon avatar-text avatar-md"
                                                        href="<?php echo base_url(); ?>index.php/CustomerSupport_controller/followups/<?php echo $obj['ticket_data']['ticket']; ?>"
                                                        title=" Lead Followup"> <i class="feather feather-edit "></i>
                                                    </a>
                                                    <a class="btn btn-icon avatar-text avatar-md"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#ViewTracking<?php echo $obj['ticket_data']['id']; ?>"
                                                        title="Ticket Tracking">
                                                        <i class="feather feather-map "></i>
                                                    </a>

                                                </div>

                                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                                    id="ViewDetails<?= $obj['ticket_data']['id']; ?>">
                                                    <div
                                                        class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
                                                        <h2 class="fs-16 fw-bold text-truncate-1-line">Ticket Details
                                                        </h2>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                                    </div>

                                                    <div class="offcanvas-body">
                                                        <form class="form-horizontal" role="form" method="post"
                                                            action="<?php echo base_url(); ?>index.php/CustomerSupport_controller/update_status/">
                                                            <input type="hidden" name="id"
                                                                value="<?= $obj['ticket_data']['id'] ?>">
                                                            <label class="control-label"> Select Status</label>
                                                            <select name="status" class="form-control">
                                                                <option value="">
                                                                    <?= $this->lang->line('select_status') ?></option>
                                                                <option value="Open"
                                                                    <?= ($obj['ticket_data']['status'] == 'Open') ? 'selected' : '' ?>>
                                                                    <?= $this->lang->line('open') ?></option>
                                                                <option value="InProcess"
                                                                    <?= ($obj['ticket_data']['status'] == 'InProcess') ? 'selected' : '' ?>>
                                                                    <?= $this->lang->line('in_process') ?></option>
                                                                <option value="Closed"
                                                                    <?= ($obj['ticket_data']['status'] == 'Closed') ? 'selected' : '' ?>>
                                                                    <?= $this->lang->line('closed') ?></option>
                                                                <option value="Resolved"
                                                                    <?= ($obj['ticket_data']['status'] == 'Resolved') ? 'selected' : '' ?>>
                                                                    <?= $this->lang->line('resolved') ?></option>
                                                            </select>

                                                    </div>
                                                    <div
                                                        class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
                                                        <button type="submit" class="btn btn-xs btn-primary w-50">
                                                            Submit</button>
                                                        <a href="javascript:void(0);" class="btn btn-danger w-50"
                                                            data-bs-dismiss="offcanvas">Cancel</a>
                                                    </div>
                                                    </form>
                                                </div>
                                                <?php $this->load->view('CustomerSupport/tracking_model', ['obj' => $obj]); ?>
                                            </td>
                                        </tr>
                                        <?php $i++;
											}
										} else { ?>
                                        <tr>
                                            <td colspan="100">
                                                <h5 style="text-align: center;"> No Leads Found</h5>
                                            </td>
                                        </tr>
                                        <?php  } ?>
                                    </tbody>
                                </table>
                                </form>



                            </div>

                        </div>



                    </div>

                </div>
            </div>
        </div>
    </div>

</div>





<script type="text/javascript">
$("#filter_hide").hide();

$(document).ready(function() {

    $(".content").hide();
    $(".show_hide").on("click", function() {
        var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
        $(".show_hide").text(txt);
        $(this).next('.content').slideToggle(200);
    });

    $(".filter_show").on("click", function() {
        $("#filter_hide").show();
    });

});
</script>
<script language="javascript">
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
$this.closest('#gatepass_date').attr('min', today);
</script>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

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
            url: "<?php echo base_url('index.php/Suppliers/getSupplierByCategory/') ?>" +
                category_id,
            //data: {id:role_id},
            dataType: 'html',
            success: function(response) {
                //alert(response);
                $(".suppliers").html(response);
                $('.select2').select2();
            }
        });
    });

    jQuery('#master').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });

    jQuery('.bulk_action').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
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
jQuery('#delete').on('click', function(e) {
    var allVals = [];
    $(".sub_chk:checked").each(function() {
        allVals.push($(this).val());
    });
    //alert(allVals.length); return false;  
    if (allVals.length <= 0) {
        alert("Please select row.");
        return false;
    } else {
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
<script>
// $("#add-notes").on("click", function(event) {
//     $("#addnotesmodal").modal("show");
//     $("#btn-n-save").hide();
//     $("#btn-n-add").show();
// });
</script>