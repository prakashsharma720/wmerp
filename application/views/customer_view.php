<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
?>

<style type="text/css">
.btnEdit {
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px;
}

.col-sm-6,
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
            <span class="card-title"><?php  echo $title; ?></span>
            <div class="pull-right error_msg">
                <a href="<?php echo base_url(); ?>index.php/Customers/add" class="btn btn-success" data-toggle="tooltip"
                    title="New customer"><i class="fa fa-plus"></i></a>

                <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i
                        class="fa fa-refresh"></i></button>

                <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i
                        class="fa fa-trash"></i></button>
            </div>
        </div> <!-- /.card-body -->
        <div class="card-body">
            <form method="get" id="filterForm">
                <div class="row">
                    <!-- <div class="col-md-4 col-sm-4 ">
                  <label  class="control-label">Customer Category <span class="required">*</span></label>
                  <select name="categories_id" class="form-control select2 category" >
                     <option value="0">Select Category</option>
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
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                    </select>
                </div>-->
                    <div class="col-md-3 col-sm-3 ">
                        <label class="control-label"><?= $this->lang->line('name_of_customer') ?> <span class="required">*</span></label>
                        <select name="customer_id" class="form-control select2 customers">
                            <option value="0"> <?= $this->lang->line('select_customer') ?></option>
                            <?php
                         if ($all_customers): ?>
                            <?php 
                            foreach ($all_customers as $value) : ?>
                            <?php 
                                  if ($value['id'] == $customer_id): ?>
                            <option value="<?= $value['id'] ?>" selected><?= $value['customer_name'].'('.$value['customer_code'].')' ?></option>
                            <?php else: ?>
                            <option value="<?= $value['id'] ?>"><?= $value['customer_name'].'('.$value['customer_code'].')' ?></option>
                            <?php endif;   ?>
                            <?php   endforeach;  ?>
                            <?php else: ?>
                            <option value="0"><?= $this->lang->line('no_result') ?></option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <!--<div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Category of Approval</label>
                    <?php  $app_cat = array(
                       'No' => 'Select Option',
                          'A' => 'A',
                          'B' => 'B',
                          'c' => 'C'
                          );
                      echo form_dropdown('category_of_approval', $app_cat)
                    ?>
                  </div>-->
                    <div class="col-md-3 col-sm-3">
                        <label class="control-label"> <?= $this->lang->line('from_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date"
                            class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus
                            autocomplete="off" autocomplete="off">
                    </div>
                    <div class="col-md-3 col-sm-3">
                        <label class="control-label"><?= $this->lang->line('upto_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date"
                            class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus
                            autocomplete="off" autocomplete="off">
                    </div>
                    <div class="col-md-3 col-sm-3 ">
                        <label class="control-label" style="visibility: hidden;"><?= $this->lang->line('grade') ?></label><br>
                        <input type="submit" class="btn btn-primary" value="Search" />
                        <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                        <a href="<?php echo $data[0]?>" class="btn btn-danger"> <?= $this->lang->line('reset') ?></a>
                    </div>
                </div>
                <!-- <div class="row col-md-12">
            
            </div>-->
        </div>

        </form>
        <hr>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="master"></th>
                        <th><?= $this->lang->line('sr_no') ?>.</th>
                        <th> <?= $this->lang->line('name') ?></th>
                        <th style="white-space: nowrap;"> <?= $this->lang->line('reg_date') ?> </th>
                        <th> <?= $this->lang->line('destination') ?></th>
                        <th> <?= $this->lang->line('state') ?></th>
                        <th style="white-space: nowrap;width: 20%;"><?= $this->lang->line('action_button') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=1;foreach($customers as $obj){ ?>
                    <tr>
                        <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                        <td><?php echo $i;?></td>
                        <td><?php echo $obj['customer_name'].' ('.$obj['customer_code'].')';?></td>
                        <td><?php echo date('d-M-Y',strtotime($obj['reg_date'])); ?></td>
                        <td><?php echo $obj['destination'];?></td>
                        <td><?php echo $obj['state'];?></td>
                        <td>
                            <a class="btn btn-xs btn-info btnEdit" data-toggle="modal"
                                data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"
                                    class="fa fa-eye"></i></a>
                            <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Customers/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a> -->

                            <a class="btn btn-xs btn-primary btnEdit"
                                href="<?php echo base_url(); ?>index.php/Customers/edit_customer_view/<?php echo $obj['id'];?>"><i
                                    class="fa fa-edit"></i></a>

                            <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal"
                                data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"
                                    class="fa fa-trash"></i></a>
                            <!--   <a href="<?php //echo base_url(); ?>index.php/welcome/deletecustomer/<?php echo $obj['id'];?>"
                   onclick="return confirm(\'Confirm Deletion.\')">Delete</a> -->
                        </td>
                        <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title"><?php echo $obj['customer_name'];?> <?= $this->lang->line('details') ?> </h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">
                                        <fieldset>
                                            <legend><?= $this->lang->line('billing_details') ?></legend>
                                            <div class="row">

                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"> <?= $this->lang->line('customer_code') ?> :</label>
                                                    <span> <?php echo $obj['customer_code'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"> <?= $this->lang->line('contact_person') ?> :</label>
                                                    <span> <?php echo $obj['contact_person'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"><?= $this->lang->line('email') ?> :</label>
                                                    <span> <?php echo $obj['email'];?></span>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('mobile') ?>:</label>
                                                    <span> <?php echo $obj['mobile_no'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"><?= $this->lang->line('buyer_item_code') ?>:</label>
                                                    <span> <?php echo @$obj['buyer_item_code'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"><?= $this->lang->line('destination') ?> :</label>
                                                    <span> <?php echo @$obj['destination'];?></span>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"> <?= $this->lang->line('website') ?> :</label>
                                                    <span> <?php echo $obj['website'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"> <?= $this->lang->line('vendor_code') ?> :</label>
                                                    <span> <?php echo $obj['vendor_code'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <label class="control-label"><?= $this->lang->line('gst_no') ?> :</label>
                                                    <span> <?php echo $obj['gst_no'];?></span>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"> <?= $this->lang->line('pan_no') ?> :</label>
                                                    <span> <?php echo $obj['pan_no'];?></span>
                                                </div>
                                                <div class="col-md-8 col-sm-8 ">
                                                    <label class="control-label"><?= $this->lang->line('address') ?>:</label>
                                                    <span>
                                                        <?php echo $obj['shipping_address'].', '.$obj['billing_address'].', '.$obj['city'].', '.$obj['state'];?></span>
                                                </div>
                                            </div>




                                        </fieldset>
                                        <fieldset>
                                            <legend><?= $this->lang->line('shipping_details') ?></legend>
                                            <div class="row">


                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('gst_no') ?>.:</label>
                                                    <span> <?php echo $obj['shipping_gst_no']?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('legal_name') ?>:</label>
                                                    <span> <?php echo $obj['shipping_legal_name']?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('loc') ?>:</label>
                                                    <span> <?php echo $obj['loc'];?></span>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('address') ?>:</label>
                                                    <span>
                                                        <?php echo $obj['saddress1'].', '.$obj['saddress2'];?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('shipping_pincode') ?>:</label>
                                                    <span> <?php echo $obj['ship_pincode']?></span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('shipping_state_code') ?>:</label>
                                                    <span> <?php echo $obj['ship_state_code']?></span>
                                                </div>

                                            </div>
                                            <div class="row">


                                                <div class="col-md-4 col-sm-4 ">
                                                    <label class="control-label"><?= $this->lang->line('shipping_destination') ?>:</label>
                                                    <span> <?php echo $obj['ship_destination']?></span>
                                                </div>


                                            </div>



                                        </fieldset>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                            <div class="modal-dialog">
                                <form class="form-horizontal" role="form" method="post"
                                    action="<?php echo base_url(); ?>index.php/Customers/deletecustomer/<?php echo $obj['id'];?>">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirm Header </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure, you want to delete customer
                                                <b><?php echo $obj['customer_name'];?> </b>?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </tr>
                    <?php  $i++;} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
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
            WRN_PROFILE_DELETE = "Are you sure you want to delete all selected customers?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Customers/deletecustomer",
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
    var base_url = '<?php echo base_url() ;?>';
    //alert(base_url);
    $(document).on('change', '.category', function() {
        var category_id = $('.category').find('option:selected').val();
        //var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
        //alert(category_id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/Customers/getcustomerByCategory/') ?>" +
                category_id,
            //data: {id:role_id},
            dataType: 'html',
            success: function(response) {
                //alert(response);
                $(".customers").html(response);
                $('.select2').select2();
                //$('.category').find('option:selected').prop('required',true);

            }
        });
    });
});
</script>