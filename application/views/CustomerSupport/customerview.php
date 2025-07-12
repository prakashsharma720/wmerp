<?php
// echo "<pre>";print_r($leads_id);exit;
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
// echo "<pre>";print_r($leads);exit;
?>
<style type="text/css">
.col-md-6 {
    float: left;
}
</style>


<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
    <?php echo $this->session->flashdata('success'); ?>
</div>
<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
<div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
</div>
<?php endif; ?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <span class="card-title"><?php  echo $title; ?>
            </span>


            <div class="pull-right">
                <a class="btn btn-xs btn-primary "
                    href="<?php echo base_url(); ?>index.php/CustomerSupport_controller/add">
                    <i class="fa fa-plus"></i> <?= $this->lang->line('create') ?></a>
            </div>
        </div>






        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="master"></th>

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
                <tbody> <?php 
		
		
		  if(!empty($leads)) { $i=1;foreach($leads as $obj) {
			
			?>

                    <tr>
                        <td><input type="checkbox" class="sub_chk" name="sub_chk[]" value="<?php echo $obj['id']; ?>" />
                        </td>
                        <td> <?= $i ?> </td>
                        <td> <?= $obj['date']?> </td>
                        <td> <?= $obj['category']?> </td>
                        <td><?php if(!empty($obj['order_id'])){?>
                             <?= $obj['order_id'] ?> 
                        <?php } else {?>
                            <span>--</span>
                            <?php }?>
                        </td>
                        <td> <?= $obj['ticket'] ?> </td>
                        <td> <?= $obj['c_name'] ?> </td>
                        <td> <?= $obj['email'] ?> </td>
                        <td> <?= $obj['phone'] ?> </td>
                        <td> <?php if($obj['status']=='Open'){?>
                            <span class="badge badge-danger"><?=  $obj['status'] ?></span>
                            <?php }else {?>
                            <span class="badge badge-success"><?=  $obj['status'] ?></span>

                            <?php }?>
                        </td>



                        <td>

                            <a class="btn btn-xs btn-warning btnEdit" data-toggle="modal"
                                data-target="#view<?php echo $obj['id'];?>" title=" view details"><i
                                    class="fa fa-check"></i></a>
                            <a class="btn btn-xs btn-success btnEdit"
                                href="<?php echo base_url(); ?>index.php/CustomerSupport_controller/followups/<?php echo $obj['ticket'];?>"
                                title=" Lead Followup"><i class="fa fa-comment"></i></a>

                            <a class="btn btn-xs btn-warning btnEdit"
                                href="<?php echo base_url(); ?>index.php/CustomerSupport_controller/tracking/<?php echo $obj['ticket'];?>"
                                title=" view details"><i class="fa fa-bullseye"></i></a>




                            <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">

                                    <form class="form-horizontal" role="form" method="post"
                                        action="<?php echo base_url(); ?>index.php/CustomerSupport_controller/update_satus/">

                                        <input type="hidden" name="id" value="<?=  $obj['id']?>">

                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?= $this->lang->line('change_status') ?> </h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col-md-12 col-sm-12">


                                                  <select name="status" class="form-control">
                                                        <option value="">Select Status</option>
                                                        <option value="Open" <?= ($obj['status'] == 'Open') ? 'selected' : '' ?>>Open</option>
                                                        <option value="InProcess" <?= ($obj['status'] == 'InProcess') ? 'selected' : '' ?>>InProcess</option>
                                                        <option value="Closed" <?= ($obj['status'] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                                                        <option value="Resolved" <?= ($obj['status'] == 'Resolved') ? 'selected' : '' ?>>Resolved</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary"> <?= $this->lang->line('submit') ?> </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Cancel </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </td>







                    </tr>
                    <?php  $i++;} }else{ ?>
                    <tr>
                        <td colspan="100">
                            <h5 style="text-align: center;"> No Leads Found</h5>
                        </td>
                    </tr>
                    <?php  }?>
                </tbody>
            </table>
            </form>
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

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var base_url = '<?php echo base_url() ;?>';
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