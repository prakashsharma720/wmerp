<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title pull-left"><?= $page_title ?></h3>
            <!-- <?= $target?> -->
            <!-- <div class="pull-right ">
                <label> Lead Unique Code : </label>
                <b style="color:#37b5fe;">
                    <?= $lead_code?>
                </b>
            </div> -->
        </div> <!-- /.card-body -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if(!empty($id)) { ?>
                    <form class="form-horizontal" role="form" method="post"
                        action="<?php echo base_url(); ?>index.php/Leads/edititem/<?= $id ?>">
                        <input type="hidden" name="old_lead_id" value="<?= $id?>">
                        <?php } else { ?>
                        <form class="form-horizontal" role="form" method="post"
                            action="<?php echo base_url(); ?>index.php/CustomerSupport_controller/add_new_item" enctype="multipart/form-data">
                            <?php } ?>

                            <input type="hidden" name="lead_code" value="<?php echo $lead_code;?>">
                            <?php 
										if(!empty($generation_date)) 
										{ 
											$date= date('d-m-Y',strtotime($generation_date)); 
										} else
										{ 
											$date=date('d-m-Y');
										} ;
									?>
                            <div class="row col-md-12">
                                <div class="col-md-4 col-sm-4">
                                    <label class="control-label"><?= $this->lang->line('generation_date') ?> </label> <span
                                        class="required">*</span>
                                    <input type="date" data-date-formate="d-m-Y" name="generation_date"
                                        id="generation_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-4 category_name">
                                    <label class="control-label"><?= $this->lang->line('complaint_category') ?></label> <span
                                        class="required">*</span>
                                    <select class="form-control" name="category" id="complaintCategory">
                                        <option value=""><?= $this->lang->line('select') ?></option>
                                        <option value="Billing/Order"><?= $this->lang->line('billing_order') ?></option>
                                        <option value="Service"><?= $this->lang->line('service') ?></option>
                                        <option value="Quality Assurance"><?= $this->lang->line('quality_assurance') ?></option>
                                        <option value="Timeline"><?= $this->lang->line('timeline') ?></option>
                                        <option value="Other"><?= $this->lang->line('other') ?></option>
                                    </select>
                                </div>

                                <div class="col-md-4" id="orderSourceField" style="display: none;">
                                    <label class="control-label"><?= $this->lang->line('order_source_id') ?></label> <span class="required">*</span>
                                    </br>
                                    <?php echo form_dropdown('invoice_no', $order, '', 'class="form-control"'); ?>
                                </div>


                                <div class="col-md-4">
                                    <label class="control-label"><?= $this->lang->line('customer_name') ?></label><span class="required">*</span>
                                    <input type="text" placeholder="Enter Name" name="cname" class="form-control"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label"><?= $this->lang->line('email') ?> <span class="required">*</span></label>
                                    <input type="email" placeholder="Enter Email" name="email" class="form-control"
                                        required>
                                </div>




                                <div class="col-md-4 col-sm-2 ">
                                    <label class="control-label"> <?= $this->lang->line('mobile_no') ?> <span class="required">*</span></label>
                                    <input type="text" placeholder="Enter mobile" name="mobile"
                                        class="form-control mobile" maxlength="10" value="" required autofocus>
                                </div>

                                <div class="col-md-4">
                                    <label class="control-label"> <?= $this->lang->line('city') ?> </label>
                                    <input type="text" placeholder="Enter city" name="city" class="form-control"
                                        required>
                                </div>



                                <div class="col-md-4 col-sm-4 ">
                                    <label class="control-label"><?= $this->lang->line('description_remark') ?></label>
                                    <textarea class="form-control description" rows="3"
                                        placeholder="Enter Description/Remark" name="description"> </textarea>
                                </div>

                                <div class="col-md-4 col-sm-4 ">
                                    <label class="control-label"><?= $this->lang->line('upload_photo') ?> </label>

                                    <input type="file" name="photo" class="form-control upload" autofocus>
                                    <img id="blah" src="#" alt="your image" class="hide" width="40%" />
                                </div>


                            </div>

                            <span class="help-block"></span>
                            <div class="row col-md-12">
                                <label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
                                <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#blah').removeClass('hide');
                $('#blah').addClass('show');
                $('#blah').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $(".upload").change(function() {
        var file = this.files[0];
        var fileType = file["type"];
        var size = parseInt(file["size"] / 1024);
        //alert(size);
        var validImageTypes = ["image/jpeg", "image/png"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            alert('Invalid file type , please select jpg/png file only !');
            $(this).val('');
        }
        if (size > 5000) {
            alert('Image size exceed , please select < 5MB file only !');
            $(this).val('');
        }

        readURL(this);
    });

 
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const categoryDropdown = document.getElementById('complaintCategory');
        const orderSourceField = document.getElementById('orderSourceField');

        categoryDropdown.addEventListener('change', function () {
            if (this.value === 'Billing/Order') {
                orderSourceField.style.display = 'block';
            } else {
                orderSourceField.style.display = 'none';
            }
        });
    });
</script>
<script language="javascript">
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0');
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
$('#generation_date').attr('min', today);
</script>