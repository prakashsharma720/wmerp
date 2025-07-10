<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 

?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"> <?= $title ?></h3>
            <div class="pull-right error_msg">
                <?php echo validation_errors();?>

                <?php if (isset($message_display)) {
			echo $message_display;
			} ?>
            </div>

        </div> <!-- /.card-body -->
        <div class="card-body">
            <form class="form-horizontal" role="form" method="post"
                action="<?php echo base_url(); ?>index.php/Customers/add_new_customer">

                <fieldset>
                    <legend>Billing Details</legend>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Customer Type </label>
                                <div class="form-check">
                                    <input class="form-check-input customer_type" type="radio" name="customer_type"
                                        value="New"> New </input>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input class="form-check-input customer_type" type="radio" name="customer_type"
                                        value="Existing" checked="checked"> Existing </input>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="control-label">Customer Name</label>
                                <input type="text" id="firstName" placeholder="Enter name" name="customer_name"
                                    class="form-control" value="" required autofocus autocomplete="off">
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="control-label">Customer Code</label>
                                <input type="text" id="firstName" placeholder="Enter Customer Code" name="customer_code"
                                    class="form-control customer_code" value="" required autofocus autocomplete="off">
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Registration Date</label>
                                <input type="text" data-date-formate="dd-mm-yyyy" name="reg_date"
                                    class="form-control date-picker" value="<?php echo date('d-m-Y'); ?>"
                                    placeholder="dd-mm-yyyy" autofocus autocomplete="off">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Website</label>
                                <input type="text" id="lastName" placeholder="Enter website" name="website"
                                    class="form-control" value="" autofocus autocomplete="off">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Vendor Code</label>
                                <input type="text" placeholder="Enter vendor code" name="vendor_code"
                                    class="form-control vendor_code" value="" required autofocus autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Contact Person</label>
                                <div class="input-group input-group-lg mb-12">
                                    <div class="input-group-prepend">
                                        <select name="prefix">
                                            <?php
						                 if ($prefix): ?>
                                            <?php 
						                    foreach ($prefix as $value) : ?>
                                            <option value="<?= $value ?>"><?= $value ?></option>
                                            <?php   endforeach;  ?>
                                            <?php else: ?>
                                            <option value="0">No result</option>
                                            <?php endif; ?>
                                        </select>
                                        <input type="text" id="firstName" placeholder="Enter contact person"
                                            name="contact_person" class="form-control" value="" autofocus
                                            autocomplete="off" style="width: 230px;">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Email</label>
                                <input type="email" id="lastName" placeholder="Ex. abcefgmail.com" name="email"
                                    class="form-control email" value="" autofocus autocomplete="off">
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Mobile</label>
                                <input type="text" id="firstName" placeholder="Enter mobile" name="mobile_no"
                                    class="form-control mobile" value="" autofocus autocomplete="off"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                    maxlength="10">
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <!-- Country State City Dropdowns -->
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> Country</label>
                                <?php  
			            		echo form_dropdown('country_id', $countries)
			            	?>

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> State</label>
                                <?php  
			            		echo form_dropdown('state_id', $states)
			            	?>

                            </div>
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> City</label>
                                <?php  
			            		echo form_dropdown('city_id', $cities)
			            	?>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row col-md-12">
                            <!-- <div class="col-md-4 col-sm-4">
                                <label class="control-label">Billing Address 1</label>
                                <textarea type="text" placeholder="Enter Billing address" name="shipping_address"
                                    class="form-control" rows="2" required autofocus autocomplete="off"
                                    style="resize: none;" oninput="checkMaxLength(this)"></textarea>
                                <span id="billingAddressError" style="color:red;font-size:13px">(Please Put First part of address only , Maximum Length 80 Characters.)</span>
                            </div>

                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Billing Address 2</label>
                                <textarea type="text" placeholder="Enter Billing address" name="billing_address"
                                    class="form-control" rows="2" value="" required autofocus autocomplete="off"
                                    style="resize: none;"></textarea>
                                    <span style="color:red;font-size:13px"> (Please Put Second part of address only , Maximum Length 80 Characters.)</span>
                            </div> -->
                            <div class="col-md-4 col-sm-4">
                                <label class="control-label">Billing Address 1</label>
                                <textarea type="text" placeholder="Enter Billing address" name="shipping_address"
                                    class="form-control" rows="2" required autofocus autocomplete="off"
                                    style="resize: none;" oninput="checkMaxLength(this, 'billingAddressError1')"></textarea>
                                <span id="billingAddressError1" style="color:red;font-size:13px"></span>
                                <span style="color:red;font-size:13px">(Please Put First part of address only, Maximum Length 80 Characters.)</span>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="control-label">Billing Address 2</label>
                                <textarea type="text" placeholder="Enter Billing address" name="billing_address"
                                    class="form-control" rows="2" required autofocus autocomplete="off"
                                    style="resize: none;" oninput="checkMaxLength(this, 'billingAddressError2')"></textarea>
                                <span id="billingAddressError2" style="color:red;font-size:13px"></span>
                                <span style="color:red;font-size:13px">(Please Put Second part of address only, Maximum Length 80 Characters.)</span>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> PINCODE</label>

                                <input type="text" id="bpin" placeholder="Pincode" name="bpin" class="form-control "
                                    value="" autofocus autocomplete="off">

                            </div>



                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> GST Registration Status </label>
                                <div class="form-check">
                                    <input class="form-check-input gst_status" type="radio" name="gst_status"
                                        value="Yes" checked> Yes</input>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input class="form-check-input gst_status" type="radio" name="gst_status"
                                        value="Un-registered Dealer"> Un-registered Dealer/Person </input>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 gst_div">
                                <b>GSTIN/URP</b><span>( Ex. : 08ABCDE1234K1AZ)</span>
                                <input type="text" placeholder="Ex. 08ABCDE12341AZ" name="gst_no"
                                    class="form-control " value="" autofocus autocomplete="off" >
                            </div>
                              <div class="col-md-4 col-sm-4">
                                <b> PAN </b> <span>(Parmanent Account No.) </span>
                                <input type="text" id="lastName" placeholder="Ex. ABCEDE2548K" name="pan_no"
                                    class="form-control pan_no" value="" autofocus autocomplete="off" maxlength="10"
                                    minlength="10" style="text-transform: uppercase;">
                            </div>
                          
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="col-md-4 col-sm-4">
                                <b> Payment Terms </b>
                                <input type="text" id="firstName" placeholder="Enter Payment Terms" name="payment_terms"
                                    class="form-control" value="" autofocus autocomplete="off">
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Buyer Item Code </label>
                                <textarea type="text" placeholder="Enter Buyer Item Code " name="buyer_item_code"
                                    class="form-control" rows="3" value="" autofocus autocomplete="off"
                                    style="resize: none;"></textarea>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Destination (Loc) </label>
                                <textarea type="text" placeholder="Enter Destination" name="destination"
                                    class="form-control" rows="3" value="" autofocus autocomplete="off"
                                    style="resize: none;"></textarea>
                            </div>

                        </div>
                    </div>

                    </fieldset>
                        </br>
                    <div class="col-md-6 col-sm-6 ">
                    <b>Is Shipping Address Different From Billing Address?</b>
                    <div class="form-check">
                        <input class="form-check-input isshipping" type="radio" name="isshipping" value="Yes">
                        Yes</input>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input class="form-check-input gst_status isshipping" type="radio" name="isshipping" value="No"
                            checked> No </input>
                    </div>
                </div>
                <hr>
                    <fieldset class="shipping_details" style="display:none">
                        <legend> Shipping Details </legend>
                        <div class="row col-md-12">
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> GST Registration Status </label>
                                <div class="form-check">
                                    <input class="form-check-input gst_status" type="radio" name="shipping_gst_status"
                                        value="Yes" checked> Yes</input>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <input class="form-check-input gst_status" type="radio" name="shipping_gst_status"
                                        value="Un-registered Dealer"> Un-registered Dealer/Person </input>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 shipgst_div">
                                <b>GSTIN</b><span>( Ex. : 08ABCDE1234K1AZ)</span>
                                <input type="text" placeholder="Ex. 08ABCDE12341AZ" name="shipping_gst_no"
                                    class="form-control shipping_gst_no" value="" autocomplete="off" maxlength="15"
                                    minlength="15" require>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Legal Name </label>
                                <div class="form-check">
                                    <input type="text" placeholder="Enter Lgal Name" name="shipping_legal_name"
                                        class="form-control" value="" autofocus>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Address 1 </label>
                                <div class="form-check">
                                    <textarea type="text" placeholder="Enter Address 1" name="saddress1"
                                        class="form-control" value="" autofocus></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Address 2 </label>
                                <div class="form-check">
                                    <textarea type="text" placeholder="Enter Address 2" name="saddress2"
                                        class="form-control" value="" autofocus></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> LOC </label>
                                <div class="form-check">
                                    <input type="text" placeholder="Enter Location" name="loc" class="form-control"
                                        value="" autofocus>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Pin Code</label>
                                <input type="text" id="bpin" placeholder="Enter Pin Code" name="ship_pincode"
                                    class="form-control " value="" autofocus autocomplete="off">
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> State Code</label>
                                <input type="text" id="bpin" placeholder="Enter State Code" name="ship_state_code"
                                    class="form-control " value="" autofocus autocomplete="off">
                            </div>
							<div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> Distance</label>
                                <input type="text" id="bpin" placeholder="Enter Distance" name="ship_destination"
                                    class="form-control " value="" autofocus autocomplete="off">
                            </div>

                        </div>
                    </fieldset>
						</br>
                    <div class="row col-md-12">
                        <div class="col-md-12 col-sm-12 ">
                            <button type="submit" class="btn btn-primary btn-block"> Save</button>

                        </div>
                    </div>
            </form> <!-- /form -->
        </div>
    </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
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
    var base_url = '<?php echo base_url() ;?>';
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