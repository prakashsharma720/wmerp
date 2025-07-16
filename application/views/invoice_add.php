<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*print_r($packing_sizes);
foreach ($packing_sizes as $key => $value) {
	echo $value;exit;
	# code...
}*/
?>
<style type="text/css">
th,
td {
    padding: 10px;
}
</style>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><?=$this ->lang ->line('create_invoice')?></h3>
            <div class="pull-right error_msg">
                <?=$this ->lang ->line('previous_invoice_no')?> : <b> <?= $last_invoice_no ?></b>
            </div>

        </div> <!-- /.card-body -->
        <div class="card-body">
            <form class="form-horizontal" role="form" method="post"
                action="<?php echo base_url(); ?>index.php/Invoice/add_new_invoice">
                <fieldset>
                    <legend> <?=$this ->lang ->line('invoice_details')?>  </legend>
                    <div class="row col-md-12">
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"><?=$this ->lang ->line('transaction_category')?> <span class="required">*</span></label>
                            <?php echo form_dropdown('transaction_category',$tras_categories);?>
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('invoice_date')?>  <span class="required">*</span></label>
                            <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date"
                                class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"
                                value="<?php echo date('d-m-Y'); ?>" autofocus required>
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('invoice_no')?>  <span class="required">*</span></label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_invoice_no')?> " name="invoice_no"
                                class="form-control invoice_no" value="" autocomplete="off" autofocus>
                            <!-- <input type="hidden" name="invoice_code" value="<?= $invoice_code ?>"> -->
                        </div>
                        <div class="row col-md-12 ">
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"> <?=$this ->lang ->line('po_no')?>  <span class="required">*</span></label>
                                <input type="text" placeholder=" <?=$this ->lang ->line('enter_po_no')?> " name="po_no" class="form-control"
                                    value="" required="required" />
                            </div>
                            <div class="col-md-4 col-sm-4 ">
                                <label class="control-label"><?=$this ->lang ->line('po_date')?>  <span class="required">*</span></label>
                                <input type="text" data-date-formate="dd-mm-yyyy" name="po_date"
                                    class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"
                                    value="<?php echo date('d-m-Y'); ?>" autofocus required>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label class="control-label"> <?=$this ->lang ->line('remarks')?> </label>
                                <textarea class="form-control " rows="2" placeholder="<?=$this ->lang ->line('enter_remarks_here')?> "
                                    name="remarks"></textarea>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 vendor_code">
                            <label class="control-label"><?=$this ->lang ->line('customer_code')?>  <span class="required">*</span></label>
                            <?php echo form_dropdown('customer_id',$vendorcodes);?>
                        </div>
                    </div>
                    <div class="row col-md-12 insert_div">
                        <div class="col-md-4 col-sm-4 gst_no">
                            <label class="control-label"><?=$this ->lang ->line('vender_service_tax_no')?> </label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('vender_service_tax_no')?> " name="vendor_service_tax_no"
                                class="form-control clear_gst" value="" autocomplete="off" autofocus
                                readonly="readonly">
                        </div>
                        <div class="col-md-4 col-sm-4 buyer_item_code">
                            <label class="control-label"><?=$this ->lang ->line('buyer_item_code')?> </label>
                            <textarea class="form-control buyer_item_code1" rows="2" placeholder="<?=$this ->lang ->line('enter_buyer_item_code')?> "
                                name="buyer_item_code"></textarea>
                        </div>
                        <div class="col-md-4 col-sm-4 destination">
                            <label class="control-label"> <?=$this ->lang ->line('destination')?> </label>
                            <textarea class="form-control destination1" rows="2" placeholder="<?=$this ->lang ->line('enter_destination_here')?> "
                                name="destination"></textarea>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group">
                        <div class="row col-md-12">
                            <div class="table-responsive">
                                <table id="maintable">
                                    <thead style="background-color: #ca6b24;">
                                        <tr>
                                            <th>#</th>
                                            <th> <?=$this ->lang ->line('item_name')?> </th>
                                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('month_of_production')?> </th>
                                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('lot_no')?> .</th>
                                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('batch_no')?> </th>
                                            <th> <?=$this ->lang ->line('packing_size')?> </th>
                                            <th> <?=$this ->lang ->line('no_of_bags')?> </th>
                                            <th> <?=$this ->lang ->line('quantity_in_mt')?> </th>
                                            <th> <?=$this ->lang ->line('rate_per_mt')?> </th>
                                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('select_tax_type')?></th>
                                            <th> <?=$this ->lang ->line('tax')?> %</th>


                                            <th><?=$this ->lang ->line('tax_amount')?><?=$this ->lang ->line('taxable_value')?></th>
                                            <th style="width: 20%;white-space:nowrap;"> </th>

                                            <th> <?=$this ->lang ->line('total')?></th>
                                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('action_button')?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="mainbody">

                                    </tbody>
                                    <tfoot>
                                        <tr id="transporter">
                                            <td colspan="9" style="text-align:right;"><b><?=$this ->lang ->line('transportation')?></b>
                                                <input type="hidden" placeholder="" value="996781" name="hsncode"
                                                    class="form-control hsncode" readonly="readonly">
                                                <input type="hidden" placeholder="<?=$this ->lang ->line('total_quantity')?>" name="total_quantity"
                                                    class="form-control total_quantity" readonly>
                                                <input type="hidden" placeholder="<?=$this ->lang ->line('total_bags')?>" name="total_bags"
                                                    class="form-control total_bags" readonly>
                                                <input type="hidden" placeholder="<?=$this ->lang ->line('total_quantity')?>" name="total_quantity"
                                                    class="form-control total_quantity" readonly>
                                                <input class="freight_status" type="radio" name="frieght_status"
                                                    value="To Pay" checked> <?=$this ->lang ->line('to_pay')?>
                                                <input class="freight_status" type="radio" name="frieght_status"
                                                    value="Paid"> <?=$this ->lang ->line('paid')?>
                                            </td>
                                            <td class="freight_details hide">
                                                <input type="text" placeholder="<?=$this ->lang ->line('enter_delivered_rs')?>" name="delivr_rate"
                                                    class="form-control delivr_rate">
                                            </td>
                                            <td class="freight_details hide">
                                                <select class="form-control delivr_tax_per" style="width:70px;padding:2px;" name="delivr_tax_per">
                                                    <option value=""> 0</option>
                                                    <!-- <option value="3"> +3%</option> -->
                                                    <option value="5"> +5%</option>
                                                    <!-- <option value="12"> +12%</option> -->
                                                    <option value="18"> +18%</option>
                                                    <!-- <option value="28"> +28%</option> -->
                                                </select>
                                            </td>
                                            <td class="freight_details hide">
                                                <input type="text" value="" placeholder="<?=$this ->lang ->line('total_delivery')?> %"
                                                    name="total_delivr_tax_per"
                                                    class="form-control total_delivr_tax_per" readonly>
                                            </td>
                                            <td class="freight_details hide">
                                                <input type="text" value="" placeholder=" <?=$this ->lang ->line('deliver_amount')?>"
                                                    name="total_deliver_amt" class="form-control total_deliver_amt"
                                                    readonly>
                                            </td>

                                            <td class="freight_details hide">
                                                <input type="text" value="" placeholder="<?=$this ->lang ->line('taxable_value')?>"
                                                    name="total_taxable_value" class="form-control total_taxable_value"
                                                    readonly>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td colspan="11" style="text-align: right;"><b><?=$this ->lang ->line('total')?></b></td>
                                            <td colspan="">
                                                <input type="text" placeholder="<?=$this ->lang ->line('total')?> " name="total_tax"
                                                    class="form-control total_qty" readonly>
                                            </td>
                                            <td style="text-align: right;">
                                                <input type="text" placeholder="<?=$this ->lang ->line('total_rate')?>" name="total_taxable_amount"
                                                    class="form-control total_rate" readonly>
                                            </td>
                                            <td style="text-align: right;">
                                                <input type="text" placeholder="<?=$this ->lang ->line('total_amount')?>" name="total_amount"
                                                    class="form-control total_amount_footer" readonly>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="11" style="text-align: right;"><b> <?=$this ->lang ->line('round_off')?> </b></td>
                                            <td colspan="3">
                                                <input type="text" value="" placeholder=" <?=$this ->lang ->line('round_off')?>" name="round_off"
                                                    class="form-control round_off" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="11" style="text-align: right;"><b> <?=$this ->lang ->line('grand_total')?> </b></td>
                                            <td colspan="3">
                                                <input type="text" value="" placeholder=" <?=$this ->lang ->line('grand_total')?>"
                                                    name="grand_total" class="form-control grand_total" readonly>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <hr>
                <fieldset>
                    <legend> <?=$this ->lang ->line('transporter_details')?></legend>
                    <div class="row col-md-12">
                        <div class="col-md-4 col-sm-4 transporter_code">
                            <label class="control-label"><?=$this ->lang ->line('select_transporter_name')?></label>
                            <?php echo form_dropdown('transporter_id', $transporters, '', 'class="form-control transporter_select"'); ?>
                        </div>
               
                        <div class="col-md-4 col-sm-4 transporter_div">
                            <label class="control-label"> <?=$this ->lang ->line('transport_id')?> </label><span> </span>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_transporter_id')?>" name="transport_id"
                                class="form-control clear_transID" value="" />
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('transdoc_no')?> <?=$this ->lang ->line('gr_no')?></label>
                            <input type="text" placeholder="  <?=$this ->lang ->line('enter_gr_no')?>" name="gr_no" class="form-control" value="" />
                        </div>


                        <div class="col-md-4 col-sm-4 ">
                            <!-- <label class="control-label"> E-Way Bill Number </label>
                            <input type="text" placeholder=" Enter way billno" name="way_billno" class="form-control"
                                value="" /> -->
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('tp_no')?> </label>
                            <input type="text" placeholder="<?=$this ->lang ->line('enter_tp_no')?>" name="tp_no" class="form-control"
                                value="" />
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('truck_no')?><span class="required">*</span></label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_truck_no')?>" name="truck_no" class="form-control"
                                required="required" value="" />
                        </div>

                         <div class="col-md-4 col-sm-4 ">
                            <label class="control-label required"> <?=$this ->lang ->line('e_way_bill_needed')?></label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="ewaybillstatus" value="Yes" checked>
                                <?=$this ->lang ->line('yes')?></input>&nbsp;&nbsp;&nbsp;&nbsp;;&nbsp;
                                <input class="form-check-input" type="radio" name="ewaybillstatus" value="No" ><?=$this ->lang ->line('no')?></input>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row col-md-12">


                    </div>
                </fieldset>
                <fieldset>
                    <legend> <?=$this ->lang ->line('driver_details')?> </legend>
                    <div class="row col-md-12">
                        <div class="col-md-6 col-sm-6 ">
                            <label class="control-label"> <?=$this ->lang ->line('driver_name')?> (1)</label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_driver_name')?>" name="driver_name1" class="form-control"
                                value="" />
                        </div>
                        <div class="col-md-6 col-sm-6 ">
                            <label class="control-label"> <?=$this ->lang ->line('mobile_no')?> (1)</label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_mobile_no')?>" name="contact1"
                                class="form-control mobile"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                maxlength="10" minlength="10" value="" />
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6 col-sm-6 ">
                            <label class="control-label"> <?=$this ->lang ->line('driver_name')?> (2)</label>
                            <input type="text" placeholder="<?=$this ->lang ->line('enter_driver_name')?>" name="driver_name2" class="form-control"
                                value="" />
                        </div>
                        <div class="col-md-6 col-sm-6 ">
                            <label class="control-label"> <?=$this ->lang ->line('mobile_no')?> (2)</label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_mobile_no')?>" name="contact2"
                                class="form-control mobile"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                maxlength="10" minlength="10" value="" />
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-6 col-sm-6 ">
                            <label class="control-label"><?=$this ->lang ->line('owner_name')?></label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_owner_name')?>" name="driver_name3" class="form-control"
                                value="" />
                        </div>
                        <div class="col-md-6 col-sm-6 ">
                            <label class="control-label"> <?=$this ->lang ->line('owner_no')?></label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_mobile_no')?>" name="contact3"
                                class="form-control mobile"
                                oninput="this.value = this.value.replace(/[^0-9]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                                maxlength="10" minlength="10" value="" />
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend> <?=$this ->lang ->line('laboratory_test_details')?> </legend>
                    <div class="row col-md-12">
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('laboratory_test_report_no')?></label>
                            <input type="text" placeholder=" <?=$this ->lang ->line('enter_test_report_no')?>" name="test_report_no"
                                class="form-control" value="" />
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"> <?=$this ->lang ->line('sending_status')?> </label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="report_sending_status"
                                    value="Enclosed" checked><?=$this ->lang ->line('enclosed')?></input>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input class="form-check-input" type="radio" name="report_sending_status"
                                    value="Being Send by Post"> <?=$this ->lang ->line('being_send_by_post')?></input>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label"><?=$this ->lang ->line('testing_date')?></label>
                            <input type="text" data-date-formate="dd-mm-yyyy" name="testing_date"
                                class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off"
                                value="<?php echo date('d-m-Y'); ?>" autofocus required>
                        </div>
                    </div>
                </fieldset>
                <div class="row col-md-12">
                    <div class="col-md-12 col-sm-12 ">
                        <label class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label>
                        <button type="<?=$this ->lang ->line('submit')?>" class="btn btn-primary btn-block"> <?=$this ->lang ->line('submit')?></button>
                    </div>
                </div>
            </form> <!-- /form -->
        </div>
    </div>
</div>

<table id="sample_table1" style="display: none;">
    <tbody>
        <tr class="main_tr1">
            <td>1</td>
            <td>
                <select name="finish_good_id[]" class="form-control products select2" style="width:350px;" required>
                    <option value=""><?=$this ->lang ->line('select_item')?> </option>
                    <?php if ($items): ?>
                    <?php foreach ($items as $value) : ?>
                    <!-- <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
                    <option value="<?= $value['id'] ?>" stock="<?= $value['stock_in'] ?>">
                        <?= $value['mineral_name'].' ('.$value['grade_name'].')'.' ('.$value['stock_in'].' MT)'.' ( FG0'.$value['fg_code'].')' ?>
                    </option>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <option value="0" stock="0"><?=$this ->lang ->line('no_result')?></option>
                    <?php endif; ?>
                </select>

            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('enter_month')?>" name="production_month[]" value="" class="form-control"
                    autofocus>
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('enter_lot_no')?>" name="lot_no[]" class="form-control" style="width: 150px;"
                    autofocus>
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('enter_batch_no')?>" name="batch_no[]" class="form-control" autofocus
                    style="width: 150px;">
            </td>
            <td>
                <!-- <textarea name="description[]"  style="width:200px;" class="form-control description" type="textarea" placeholder="Enter description"></textarea> -->
                <select name="packing_size[]" class="form-control packing_size" required="required"
                    style="width:100px;">
                    <?php
	                 if ($packing_sizes): ?>
                    <?php 
	                    foreach ($packing_sizes as $key => $value) : ?>
                    <?php 

								if ($value == $packing_size): ?>
                    <option value="<?= $key?>" selected><?= $value ?></option>
                    <?php else: ?>
                    <option value="<?= $key ?>"><?= $value ?></option>
                    <?php endif;   ?>
                    <?php   endforeach;  ?>
                    <?php else: ?>
                    <option value="0"><?=$this ->lang ->line('no_result')?></option>
                    <?php endif; ?>
                </select>
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('no_of_bags')?>" name="no_of_bags[]" class="form-control no_of_bags"
                    autofocus
                    oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                    style="width:150px;" required="required">
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('enter_qty')?>" name="qty[]" class="form-control qty" autofocus
                    oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                    style="width:150px;" readonly>
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('enter_rate')?>" name="rate[]" class="form-control rate" autofocus
                    oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"
                    style="width:150px;">
            </td>
            <td>
                <select class="form-control" name="tax_type[]" style="width:150px;" required>
                    <option value=""><?=$this ->lang ->line('select_type')?></option>
                    <option value="Other"><?=$this ->lang ->line('other')?></option>
                    <option value="IGST"><?=$this ->lang ->line('igst')?></option>

                </select>
            </td>
            <td>
                <select class="form-control tax_per" name="tax_per[]" style="width:70px;padding:2px;" required>
                    <option value="0"> 0</option>
                    <!-- <option value="3"> +3%</option> -->
                    <option value="5"> +5%</option>
                    <!-- <option value="12"> +12%</option> -->
                    <option value="18"> +18%</option>
                    <!-- <option value="28"> +28%</option> -->
                    <!-- <option value="-3"> -3%</option> -->
                    <!-- <option value="-5"> -5%</option> -->
                    <!-- <option value="-12"> -12%</option> -->
                    <!-- <option value="-18"> -18%</option> -->
                    <!-- <option value="-28"> -28%</option> -->
                </select>
            </td>







            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('tax_amount')?>" name="tax_amount[]" class="form-control tax_amount"
                    autofocus style="width:150px;" readonly="readonly">
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('rate')?>" name="taxable_amount[]" class="form-control rate_after_tax"
                    required='required' readonly="readonly">
            </td>
            <td>
                <input type="text" placeholder="<?=$this ->lang ->line('total_amount')?>" name="amount[]" class="form-control total_amount"
                    autofocus style="width:150px;" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-xs btn-primary addrow" href="#" role='button'><i
                        class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i
                        class="fa fa-minus"></i></button>
            </td>
        </tr>
    <tfoot>
        <tr>
            <td colspan="6" style="text-align: right;"><b><?=$this ->lang ->line('total')?></b></td>
            <td colspan="">
                <input type="text" placeholder="<?=$this ->lang ->line('total')?> " name="total_tax" class="form-control total_qty" readonly>
            </td>
            <td style="text-align: right;">
                <input type="text" placeholder="<?=$this ->lang ->line('total_rate')?>" name="total_rate" class="form-control total_rate" readonly>
            </td>
            <td style="text-align: right;">
                <input type="text" placeholder="<?=$this ->lang ->line('total_amount')?>" name="total_amount_footer"
                    class="form-control total_amount_footer" readonly>
            </td>
        </tr>
    </tfoot>
    </tbody>
</table>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<!-- <script type="text/javascript">
		$(document).ready(function() {
		    $('#maintable').DataTable( {
		        "scrollX": true
		    } );
		});
</script> -->
<script type="text/javascript">
$(document).ready(function() {



    $("input[type='radio']").click(function() {
        var status = $("input[name='frieght_status']:checked").val();
        if (status == 'Paid') {
            $(".freight_details").addClass('show').removeClass('hide');
        } else {
            // $(this).closest('tfoot').find('tr#transporter').remove();
            $(".freight_details").addClass('hide').removeClass('show');
            $(".freight_details input[type='text']").val('');
            $(".freight_details select").val('0');

        }
    });


    add_row();
    rename_rows();
    $('body').on('click', '.addrow', function() {

        var table = $(this).closest('table');
        add_row();
        rename_rows();
        calculate_total(table);
    });

    function add_row() {
        var tr1 = $("#sample_table1 tbody tr").clone();
        $("#maintable tbody#mainbody").append(tr1);
    }
    $('body').on('click', '.deleterow', function() {

        var table = $(this).closest('table');
        var rowCount = $("#maintable tbody tr.main_tr1").length;
        if (rowCount > 1) {
            if (confirm("Are you sure to remove row ?") == true) {
                $(this).closest("tr").remove();
                rename_rows();
                calculate_total(table);
            }
        }
    });

    function rename_rows() {
        var i = 0;
        $("#maintable tbody tr.main_tr1").each(function() {
            $(this).find("td:nth-child(1)").html(++i);
            $(this).find("td:nth-child(2) select.products").select2();
            $(this).find("td:nth-child(2) select.products").last().next().next().remove();
            //$(this).find("td:nth-child(2) select.products").select2();
            //$(this).find("td:nth-child(4) select.units").select2();

        });
    }
    $(document).on('keyup', '.no_of_bags,.qty,.rate,.tax_per_sgst,.tax_per_cgst,.tax_per_igst,.delivr_rate',
        function() {
            var table = $(this).closest('table');
            calculate_total(table);

        });

    $(document).on('change', '.packing_size,.tax_per,.delivr_tax_per,.freight_status', function() {
        var table = $(this).closest('table');
        calculate_total(table);

    });

    function calculate_total(table) {

        var total_qty = 0;
        var total_tax = 0;
        var total_rate = 0;
        var total_amount_footer = 0;
        var total_grand_total = 0;
        var total_bags = 0;
        var total_deliver_amt = 0;
        var total_taxable_value = 0;
        var delivr_tax_per = 0;
        var delivered_taxx_amt = 0;
        var total_taxxxx = 0;
        var total_rateee = 0;
        var total_amount_footer_rate = 0;
        var delivr_rate = 0;
        table.find("tbody tr.main_tr1").each(function() {
            var stock_available = $(this).find('td:nth-child(2) select.products option:selected').attr(
                'stock');
            //alert(stock_available);
            var packing_size = $(this).find('td:nth-child(6) select.packing_size option:selected')
                .val();
            var no_of_bags = parseFloat($(this).find("td:nth-child(7) input.no_of_bags").val());
            var rate = parseFloat($(this).find("td:nth-child(9) input.rate").val());
            delivr_rate = table.find("tfoot tr input.delivr_rate").val();
            var delivr_tax_per =parseFloat(table.find("tfoot tr select.delivr_tax_per option:selected").val()) || 0;
            if (isNaN(packing_size)) {
                packing_size = 0;
            }
            if (isNaN(no_of_bags)) {
                no_of_bags = 0;
            }
            if (isNaN(qty)) {
                qty = 0;
            }
            if (isNaN(rate)) {
                rate = 0;
            }
            var quantity = packing_size * no_of_bags / 1000;
            if (quantity > stock_available) {
                alert("Finish good quantity exceed from available stock.");
                $(this).find("td:nth-child(7) input.no_of_bags").val('');
            } else {
                $(this).find("td:nth-child(8) input.qty").val(quantity.toFixed(3));
                var qty = parseFloat($(this).find("td:nth-child(8) input.qty").val());

                var tax_per = parseFloat($(this).find("td:nth-child(11) select.tax_per option:selected").val());
                total_amount = qty * rate;
                var tax = 0;
                var actual_rate = 0;
                var total_amount_row = 0;
                if (tax_per >= 0) {
                    var tax = parseFloat((rate * tax_per / 100) * qty);
                    var actual_rate = (rate * qty);
                    total_amount_row = actual_rate + tax;
                } else {
                    var taxxx = Math.abs(tax_per);
                    var tax = total_amount - (total_amount * (100 / (100 + taxxx)));
                    var actual_rate = total_amount - tax;
                    total_amount_row = parseFloat(tax + actual_rate);
                }
                if (isNaN(tax)) {
                    tax = 0;
                }
                if (isNaN(actual_rate)) {
                    actual_rate = 0;
                }
                if (isNaN(total_amount_row)) {
                    total_amount_row = 0;
                }
                if (isNaN(total_taxxxx)) {
                    total_taxxxx = 0;
                }
                if (isNaN(delivr_rate)) {
                    delivr_rate = 0;
                }
                total_qty += qty;
                total_tax += tax;
                total_rate += actual_rate;
                total_amount_footer += total_amount_row;
                total_bags += no_of_bags;
                // alert(total_qty);
                // console.log("D rate : "+delivr_rate);
                if(delivr_rate){
                    total_deliver_amt = delivr_rate * total_qty;
                    delivered_taxx_amt = (total_deliver_amt * delivr_tax_per / 100) || 0; // Ensure it doesn't return NaN

                    total_taxable_value = delivered_taxx_amt + total_deliver_amt;
                    total_taxxxx = total_tax + delivered_taxx_amt;
                    total_rateee = total_rate + total_deliver_amt;
                    total_amount_footer_rate = total_amount_footer + total_taxable_value;
                }else{
                    total_taxxxx = total_tax ;
                    total_rateee = total_rate ;
                    total_amount_footer_rate = total_amount_footer;
                    total_deliver_amt =0;
                    total_deliver_amt=0;
                    total_taxable_value=total_amount_footer;
                }
          
                $(this).find("td:nth-child(12) input.tax_amount").val(tax.toFixed(2));
                $(this).find("td:nth-child(13) input.rate_after_tax").val(actual_rate.toFixed(2));
                $(this).find("td:nth-child(14) input.total_amount").val(total_amount_row.toFixed(2));
            }
        });
        table.find("tfoot tr input.total_qty").val(total_taxxxx.toFixed(2));
        table.find("tfoot tr input.total_rate").val(total_rateee.toFixed(2));
        table.find("tfoot tr input.total_amount_footer").val(total_amount_footer_rate.toFixed(2));
        table.find("tfoot tr input.total_bags").val(total_bags);
        table.find("tfoot tr input.total_quantity").val(total_qty);
        table.find("tfoot tr input.total_deliver_amt").val(total_deliver_amt.toFixed(2));
        table.find("tfoot tr input.total_taxable_value").val(total_taxable_value.toFixed(2));
        table.find("tfoot tr input.total_delivr_tax_per").val(delivered_taxx_amt.toFixed(2));
        var round_off = Math.round((total_amount_footer_rate - Math.floor(total_amount_footer_rate)) * 100) /100;
        var grand_total = Math.round(total_amount_footer_rate);
        table.find("tfoot tr input.round_off").val(round_off);
        table.find("tfoot tr input.grand_total").val(grand_total.toFixed(2));
    }
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $(document).on('change', '.vendor_code', function() {
        var customer_id = $('.vendor_code').find('option:selected').val();
        //alert(customer_id);
        if (customer_id != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Customers/getcustomerById/') ?>" +
                    customer_id,
                //data: {id:role_id},
                dataType: 'html',
                success: function(response) {
                    //alert(response);
                    $(".insert_div").html(response);
                    //$(".buyer_item_code").html(buyer_item_code);
                    //$('.select2').select2();
                }
            });
        } else {
            $(".clear_gst").val('');
            $(".buyer_item_code1").val('');
            $(".destination1").val('');
        }

    });


    $(document).on('change', '.transporter_code', function() {
        // alert();
        var transport_id = $('.transporter_code').find('option:selected').val();
        if (transport_id != '') {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/Transporters/getTransporterdetailsById/') ?>" +
                    transport_id,
                dataType: 'html',
                success: function(response) {
                    $(".transporter_div").html(response);
                    $(".transporter_div2").html(response);
                }
            });
        } else {
            $(".clear_transID").val('');
        }
    });




    $(document).on('blur', '.invoice_no', function() {
        var invoice_no = encodeURIComponent($('.invoice_no').val());
        //var aa= base_url+"index.php/Transporters/CheckTrasnferCode/"+customer_code;
        //alert(invoice_no);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('index.php/Invoice/CheckInvoiceNo/') ?>",

            data: {
                invoice_no: invoice_no
            },
            dataType: 'html',
            success: function(response) {
                //alert(response);
                if (response == 1) {
                    alert('This Invoice Number is already taken');
                    $('.invoice_no').val('');
                }
            }
        });
    });

});
</script>