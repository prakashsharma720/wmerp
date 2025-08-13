<?php
defined('BASEPATH') or exit('No direct script access allowed');



?>
<div class="nxl-content">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"> <?= $this->lang->line('add_new_customer') ?></h5>
            </div>
            <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
                        <?= $this->lang->line('home') ?>
                    </a>
                </li>
                <li class="breadcrumb-item"> <?= $this->lang->line('add') ?></li>
            </ul>
        </div>

        <!-- Add New Button -->
        <div class="page-header-right d-flex align-items-center gap-2">
            <?php $this->load->view('layout/alerts'); ?>

            <!-- Mobile Toggle -->
            <div class="d-md-none d-flex align-items-center">

                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">


                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="post"
                            action="<?php echo base_url(); ?>index.php/Customers/add_new_customer">

                            <fieldset>
                                <legend><?= $this->lang->line('billing_details') ?></legend>
                                <div class="form-group">
                                    <div class="row col-md-12">
                                        <div class="col-md-4 col-sm-4 ">
                                            <label class="control-label"> <?= $this->lang->line('customer_type') ?> </label>
                                            <br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input customer_type" type="radio" name="customer_type"
                                                    value="New"> New </input>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input customer_type" type="radio" name="customer_type"
                                                        value="Existing" checked="checked"> <?= $this->lang->line('existing') ?> </input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label"><?= $this->lang->line('customer_name') ?></label>
                                            <input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_name') ?>" name="customer_name"
                                                class="form-control" value="" required autofocus autocomplete="off">
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label"><?= $this->lang->line('customer_code') ?></label>
                                            <input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_customer_code') ?>" name="customer_code"
                                                class="form-control customer_code" value="" required autofocus autocomplete="off">
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label"><?= $this->lang->line('reg_date') ?></label>
                                            <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date"
                                                class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>"
                                                placeholder="dd-mm-yyyy" autofocus autocomplete="off">
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"> <?= $this->lang->line('website') ?></label>
                                            <input type="text" id="lastName" placeholder="<?= $this->lang->line('enter_website') ?>" name="website"
                                                class="form-control" value="" autofocus autocomplete="off">
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"> <?= $this->lang->line('vendor_code') ?></label>
                                            <input type="text" placeholder="<?= $this->lang->line('enter_vendor_code') ?>" name="vendor_code"
                                                class="form-control vendor_code" value="" required autofocus autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-md-12">
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"><?= $this->lang->line('contact_person') ?></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select class="form-select" name="prefix" style="max-width: 80px;">
                                                        <?php if ($prefix): ?>
                                                            <?php foreach ($prefix as $value): ?>
                                                                <option value="<?= $value ?>"><?= $value ?></option>
                                                            <?php endforeach; ?>
                                                        <?php else: ?>
                                                            <option value="0"><?= $this->lang->line('no_result') ?></option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <input type="text" id="contact_person" placeholder="<?= $this->lang->line('enter_contact_person') ?>"
                                                    name="contact_person" class="form-control" autocomplete="off">
                                            </div>
                                        </div>


                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"> <?= $this->lang->line('email') ?></label>
                                            <input type="email" id="lastName" placeholder="Ex. abcefgmail.com" name="email"
                                                class="form-control email" value="" autofocus autocomplete="off">
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"> <?= $this->lang->line('mobile') ?></label>
                                            <input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_mobile') ?>" name="mobile_no"
                                                class="form-control mobile" value="" autofocus autocomplete="off"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                                maxlength="10">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row col-md-12 ">
                                        <!-- Country State City Dropdowns -->
                                        <div class="col-md-4 col-sm-4 ">
                                            <label class="control-label"> <?= $this->lang->line('country') ?></label>
                                            <?php
                                            echo form_dropdown('country_id', $countries)
                                            ?>

                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label"> <?= $this->lang->line('state') ?></label>
                                            <?php
                                            echo form_dropdown('state_id', $states)
                                            ?>

                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label class="control-label"> <?= $this->lang->line('city') ?></label>
                                            <?php
                                            echo form_dropdown('city_id', $cities)
                                            ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-md-12">
                                  
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"><?= $this->lang->line('billing_address_1') ?></label>
                                            <textarea type="text" placeholder="<?= $this->lang->line('enter_billing_address') ?>" name="shipping_address"
                                                class="form-control" rows="2" required autofocus autocomplete="off"
                                                style="resize: none;" oninput="checkMaxLength(this, 'billingAddressError1')"></textarea>
                                            <span id="billingAddressError1" style="color:red;font-size:13px"></span>
                                            <span style="color:red;font-size:13px">(Please Put First part of address only, Maximum Length 80 Characters.)</span>
                                        </div>

                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"><?= $this->lang->line('billing_address_2') ?></label>
                                            <textarea type="text" placeholder="<?= $this->lang->line('enter_billing_address') ?>" name="billing_address"
                                                class="form-control" rows="2" required autofocus autocomplete="off"
                                                style="resize: none;" oninput="checkMaxLength(this, 'billingAddressError2')"></textarea>
                                            <span id="billingAddressError2" style="color:red;font-size:13px"></span>
                                            <span style="color:red;font-size:13px">(Please Put Second part of address only, Maximum Length 80 Characters.)</span>
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"> <?= $this->lang->line('pincode') ?></label>

                                            <input type="text" id="bpin" placeholder="<?= $this->lang->line('pincode') ?>" name="bpin" class="form-control "
                                                value="" autofocus autocomplete="off">

                                        </div>



                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row col-md-12">
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <label class="control-label"> <?= $this->lang->line('gst_registration_status') ?> </label>
                                            <div class="form-check d-flex align-items-center gap-4 mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input gst_status" type="radio" name="gst_status" id="gst_yes" value="Yes" checked>
                                                    <label class="form-check-label" for="gst_yes">Yes</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input gst_status" type="radio" name="gst_status" id="gst_no" value="Un-registered Dealer">
                                                    <label class="form-check-label" for="gst_no"><?= $this->lang->line('unregistered_dealer') ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-4 gst_div mt-2">
                                            <b><?= $this->lang->line('gstin_urp') ?> </b><span>( Ex. : 08ABCDE1234K1AZ)</span>
                                            <input type="text" placeholder="Ex. 08ABCDE12341AZ" name="gst_no"
                                                class="form-control " value="" autofocus autocomplete="off">
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <b> <?= $this->lang->line('pan') ?> </b> <span> </span>
                                            <input type="text" id="lastName" placeholder="Ex. ABCEDE2548K" name="pan_no"
                                                class="form-control pan_no" value="" autofocus autocomplete="off" maxlength="10"
                                                minlength="10" style="text-transform: uppercase;">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row col-md-12">
                                        <div class="col-md-4 col-sm-4 mt-2">
                                            <b> <?= $this->lang->line('payment_terms') ?> </b>
                                            <input type="text" id="firstName" placeholder="<?= $this->lang->line('enter_payment_terms') ?>" name="payment_terms"
                                                class="form-control" value="" autofocus autocomplete="off">
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2 ">
                                            <label class="control-label"><?= $this->lang->line('buyer_item_code') ?> </label>
                                            <textarea type="text" placeholder="<?= $this->lang->line('enter_buyer_item_code') ?>" name="buyer_item_code"
                                                class="form-control" rows="3" value="" autofocus autocomplete="off"
                                                style="resize: none;"></textarea>
                                        </div>
                                        <div class="col-md-4 col-sm-4 mt-2 ">
                                            <label class="control-label"> <?= $this->lang->line('destination') ?> "<?= $this->lang->line('loc') ?>" </label>
                                            <textarea type="text" placeholder="<?= $this->lang->line('enter_destination_here') ?>" name="destination"
                                                class="form-control" rows="3" value="" autofocus autocomplete="off"
                                                style="resize: none;"></textarea>
                                        </div>

                                    </div>
                                </div>

                            </fieldset>
                            </br>
                            <div class="col-md-6 col-sm-6">
    <b><?= $this->lang->line('is_shipping_address_different') ?></b>
    <div class="d-flex gap-4 mt-2">
        <div class="form-check">
            <input class="form-check-input isshipping" type="radio" name="isshipping" id="isshipping_yes" value="Yes">
            <label class="form-check-label" for="isshipping_yes"><?= $this->lang->line('yes') ?></label>
        </div>
        <div class="form-check">
            <input class="form-check-input isshipping" type="radio" name="isshipping" id="isshipping_no" value="No" checked>
            <label class="form-check-label" for="isshipping_no"><?= $this->lang->line('no') ?></label>
        </div>
    </div>
</div>

                            <hr>
                            <fieldset class="shipping_details" style="display:none">
                                <legend> </legend>
                                <div class="row col-md-12">
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('gst_registration_status') ?> </label>
                                        <div class="form-check">
                                            <input class="form-check-input gst_status" type="radio" name="shipping_gst_status"
                                                value="Yes" checked> Yes</input>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input class="form-check-input gst_status" type="radio" name="shipping_gst_status"
                                                value="Un-registered Dealer"> <?= $this->lang->line('unregistered_dealer') ?> </input>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 shipgst_div">
                                        <b>GSTIN</b><span>( Ex. : 08ABCDE1234K1AZ)</span>
                                        <input type="text" placeholder="Ex. 08ABCDE12341AZ" name="shipping_gst_no"
                                            class="form-control shipping_gst_no" value="" autocomplete="off" maxlength="15"
                                            minlength="15" require>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"><?= $this->lang->line('legal_name') ?> </label>
                                        <div class="form-check">
                                            <input type="text" placeholder="<?= $this->lang->line('enter_legal_name') ?>" name="shipping_legal_name"
                                                class="form-control" value="" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('address') ?>1 </label>
                                        <div class="form-check">
                                            <textarea type="text" placeholder="<?= $this->lang->line('enter_address') ?> 1" name="saddress1"
                                                class="form-control" value="" autofocus></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('address2') ?> </label>
                                        <div class="form-check">
                                            <textarea type="text" placeholder="<?= $this->lang->line('enter_address2') ?>" name="saddress2"
                                                class="form-control" value="" autofocus></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('loc') ?> </label>
                                        <div class="form-check">
                                            <input type="text" placeholder="<?= $this->lang->line('enter_location') ?>" name="loc" class="form-control"
                                                value="" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('pin_code') ?></label>
                                        <input type="text" id="bpin" placeholder="<?= $this->lang->line('pincode') ?>" name="ship_pincode"
                                            class="form-control " value="" autofocus autocomplete="off">
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('state_code') ?></label>
                                        <input type="text" id="bpin" placeholder="Enter State Code" name="ship_state_code"
                                            class="form-control " value="" autofocus autocomplete="off">
                                    </div>
                                    <div class="col-md-4 col-sm-4 ">
                                        <label class="control-label"> <?= $this->lang->line('distance') ?></label>
                                        <input type="text" id="bpin" placeholder="Enter Distance" name="ship_destination"
                                            class="form-control " value="" autofocus autocomplete="off">
                                    </div>

                                </div>
                            </fieldset>
                            </br>
                            <div class="row col-md-12">
                                <div class="col-md-12 col-sm-12 ">
                                    <button type="submit" class="btn btn-primary btn-block"> <?= $this->lang->line('save') ?></button>

                                </div>
                            </div>
                        </form> <!-- /form -->
                    </div>
                </div>
            </div>
            <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
            <script>
                function checkMaxLength(textarea, errorSpanId) {
                    var maxLength = 80;
                    var currentLength = textarea.value.length;

                    if (currentLength <= maxLength) {
                        document.getElementById(errorSpanId).innerText = "";
                    } else {
                        document.getElementById(errorSpanId).innerText = "Maximum length is 80 characters.";
                        textarea.value = textarea.value.substring(0, maxLength);
                    }
                }
            </script>
            <script type="text/javascript">
                $(document).ready(function() {
                    var base_url = '<?php echo base_url(); ?>';
                    //alert(base_url);
                    $(document).on('blur', '.customer_code', function() {
                        var customer_code = $('.customer_code').val();
                        //var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+customer_code;
                        //alert(aa);
                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('index.php/Customers/CheckcustomerCode/') ?>" +
                                customer_code,

                            //data: {id:role_id},
                            dataType: 'html',
                            success: function(response) {
                                //alert(response);
                                if (response == 1) {
                                    alert('This customer Code is already taken');
                                    $('.customer_code').val('');
                                }
                            }
                        });
                    });
                    $("input[type='radio'][name='shipping_gst_status']").click(function() {
                        var gst_status = $("input[name='shipping_gst_status']:checked").val();
                        if (gst_status == 'Yes') {
                            $(".shipgst_div").css('visibility', 'visible');
                            $(".shipping_gst_no").attr('required', 'required');
                        } else {
                            $(".shipgst_div").css('visibility', 'hidden');
                            $(".shipping_gst_no").removeAttr('required');
                            $(".shipping_gst_no").val('');
                            $(".shipping_gst_no")[0].setCustomValidity(null); // Remove custom validity
                        }
                    });

                    $("input[type='radio']").click(function() {
                        var customer_type = $("input[name='customer_type']:checked").val();
                        if (customer_type == 'New') {
                            $(".category_of_approval").hide();

                            //$(".category_of_approval").removeClass('show');
                        } else {
                            $(".category_of_approval").show();

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

                    $("input[type='radio']").click(function() {
                        var status = $("input[name='isshipping']:checked").val();
                        if (status == 'Yes') {
                            $(".shipping_details").css('display', 'block');
                        } else {
                            $(".shipping_details").css('display', 'none');
                            $(".shipping_gst_no").removeAttr('required');
                            $(".shipping_gst_no").val('');
                            $(".shipping_gst_no")[0].setCustomValidity(''); // Set custom validity to empty string
                        }
                    });

                });
            </script>