<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h5><i class="fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
    <?= $this->session->flashdata('success'); ?>
  </div>
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
  <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    <h5><i class="fa fa-times"></i> <?= $this->lang->line('alert') ?>!</h5>
    <?= $this->session->flashdata('failed'); ?>
  </div>
<?php endif; ?>


<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5><?= $this->lang->line('create_purchase_order') ?></h5>
      </div>
      <ul class="breadcrumb ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto">
      <div class="page-header-right-items d-flex align-items-center">
        <!-- Filter Button -->
        <button class="btn btn-icon avatar-text avatar-md" type="button"
          data-bs-toggle="collapse"
          data-bs-target="#filterFormWrapper"
          aria-expanded="false"
          aria-controls="filterFormWrapper">
          <i class="feather feather-filter"></i> <?= $this->lang->line('filter') ?>
        </button>

        <div class="d-md-none d-flex align-items-center">
          <a href="javascript:void(0)" class="page-header-right-open-toggle">
            <i class="feather-align-right fs-20"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-body">

        <?php if (!empty($id)) { ?>
          <form class="form-horizontal" method="post"
            action="<?php echo base_url(); ?>index.php/Purchase_order/edit_po/<?= $id ?>">
            <input type="hidden" name="po_id_old" value="<?= $id ?>">
            <input type="hidden" name="requisition_slip_id" value="<?= $requisition_slip_id ?>">
        <?php } else { ?>
          <form class="form-horizontal" method="post"
            action="<?php echo base_url(); ?>index.php/Purchase_order/add_new_po">
        <?php } ?>

          <!-- COLLAPSIBLE AREA -->
          <div class="collapse" id="filterFormWrapper">
            <div class="form-group">
              <div class="row col-md-12">
                <div class="col-md-4 col-sm-4 ">
                  <label class="control-label"><?= $this->lang->line('date'); ?> <span class="required">*</span></label>
                  <input type="text" name="transaction_date" class="form-control date-picker"
                    placeholder="dd-mm-yyyy" autocomplete="off"
                    value="<?php if ($transaction_date) { echo date('d-m-Y', strtotime($transaction_date)); } ?>">
                </div>
                <div class="col-md-4 col-sm-4 ">
                  <label class="control-label"><?= $this->lang->line('name_of_supplier'); ?> <span class="required">*</span></label>
                  <?= form_dropdown('supplier_id', $suppliers, $supplier_id, 'class="form-control"') ?>
                </div>
                <div class="col-md-4 col-sm-4 ">
                  <label class="control-label"><?= $this->lang->line('po_number'); ?> <span class="required">*</span></label>
                  <input type="text" placeholder="<?= $this->lang->line('enter_po_number'); ?>" name="po_number"
                    class="form-control" value="<?= $po_number ?>" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row col-md-12">
                <div class="col-md-4 col-sm-4 ">
                  <label class="control-label"><?= $this->lang->line('quotation_no'); ?> </label>
                  <input type="text" placeholder="<?= $this->lang->line('enter_quotation_no'); ?>" name="quotation_no"
                    class="form-control" value="<?= $quotation_no ?>">
                </div>
                <div class="col-md-4 col-sm-4 ">
                  <label class="control-label"><?= $this->lang->line('quotation_date'); ?> <span class="required">*</span></label>
                  <input type="text" name="quotation_date" class="form-control date-picker"
                    placeholder="dd-mm-yyyy" autocomplete="off"
                    value="<?php if ($quotation_date) { echo date('d-m-Y', strtotime($quotation_date)); } ?>">
                </div>
                <div class="col-md-4 col-sm-4 ">
                  <label class="control-label"><?= $this->lang->line('comment'); ?> </label>
                  <textarea name="comment" class="form-control" style="resize:none"><?= $comment ?></textarea>
                </div>
              </div>
            </div>
          </div>
          <!-- End Collapsible -->

          <div class="form-group">
            <div class="row col-md-12">
              <div class="table-responsive">
                <table class="table table-bordered" id="maintable" style="width: 100% !important;">
                  <thead style="background-color: white;">
                    <tr>
                      <th><?= $this->lang->line('sr_no'); ?>.</th>
                      <th style="width:15%;white-space: nowrap;"><?= $this->lang->line('material_description'); ?></th>
                      <th style="width:10%;white-space: nowrap;"><?= $this->lang->line('requisition_qty'); ?></th>
                      <th style="width:10%;white-space: nowrap;"><?= $this->lang->line('order_qty'); ?></th>
                      <th style="width:10%;white-space: nowrap;"><?= $this->lang->line('pending_qty'); ?></th>
                      <th style="width:17%;white-space: nowrap;"><?= $this->lang->line('item_rate'); ?></th>
                      <th style="width:28%;"><?= $this->lang->line('total_amount'); ?></th>
                      <th style="width:10%;"><?= $this->lang->line('action'); ?></th>
                    </tr>
                  </thead>
                  <tbody id="mainbody">
                    <?php
                      $total_rate_edit = 0;
                      if (!empty($po_details)) {
                        $i = 1;
                        foreach ($po_details as $key => $po_detail) {
                          $total_rate_edit += $po_detail['rate'];
                    ?>
                      <input type="hidden" name="requisition_slip_row_id[]" value="<?= $po_detail['requisition_slip_row_id'] ?>">
                      <tr class="main_tr1">
                        <td><?= $i; ?></td>
                        <td style="width:30%">
                          <select name="item_id[]" class="form-control drop select2">
                            <?php if ($items): ?>
                              <?php foreach ($items as $value) : ?>
                                <option value="<?= $value['id'] ?>" <?= ($value['id'] == $po_detail['item_id']) ? 'selected' : '' ?>><?= $value['name'] ?></option>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <option value="0"><?= $this->lang->line('no_result'); ?></option>
                            <?php endif; ?>
                          </select>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="req_qty[]" class="form-control req_qty" readonly>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="ordered_qty[]" class="form-control qty" value="<?= $po_detail['quantity']; ?>" required>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="pending_qty[]" class="form-control pending_qty" readonly>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="rate[]" class="form-control rate" value="<?= $po_detail['rate'] ?>" required>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="total[]" class="form-control total" value="<?= $po_detail['amount']; ?>" readonly required>
                        </td>
                        <td style="width:15%">
                          <button type="button" class="btn btn-icon avatar-text avatar-md"><i class="feather feather-minus"></i></button>
                        </td>
                      </tr>
                    <?php $i++; } } else { ?>
                      <tr class="main_tr1">
                        <td>1</td>
                        <td style="width:30%">
                          <select name="item_id[]" class="form-control drop select2">
                            <?php if ($items): ?>
                              <?php foreach ($items as $value) : ?>
                                <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                              <?php endforeach; ?>
                            <?php else: ?>
                              <option value="0"><?= $this->lang->line('no_result'); ?></option>
                            <?php endif; ?>
                          </select>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="req_qty[]" class="form-control req_qty" readonly>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="ordered_qty[]" class="form-control qty" required>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="pending_qty[]" class="form-control pending_qty" readonly>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="rate[]" class="form-control rate" required>
                        </td>
                        <td style="width:15%">
                          <input type="text" name="total[]" class="form-control total" readonly required>
                        </td>
                        <td style="width:15%">
                          <button type="button" class="btn btn-xs btn-danger deleterow"><i class="fa fa-minus"></i></button>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot style="background-color: white;">
                    <!-- Totals -->
                    <tr>
                      <td colspan="3" style="text-align: right;"><b><?= $this->lang->line('total'); ?></b></td>
                      <td>
                        <input type="text" name="total_qty" class="form-control total_qty" value="<?= $total_qty ?>" readonly>
                      </td>
                      <td>
                        <input type="text" name="total_rate" class="form-control total_rate" value="<?= $total_rate_edit ?>" readonly>
                      </td>
                      <td colspan="3">
                        <input type="text" name="total_amount" class="form-control total_amount" value="<?= $total_amount ?>" readonly>
                      </td>
                    </tr>
                    <!-- Discount -->
                    <tr>
                      <td colspan="3" style="text-align: right;"><b><?= $this->lang->line('discount'); ?></b></td>
                      <td>
                        <?php
                          $rs_checked = '';
                          $per_checked = '';
                          if (!empty($discount_type)) {
                            if ($discount_type == 1) {
                              $rs_checked = 'checked';
                            } else {
                              $per_checked = 'checked';
                            }
                          } else {
                            $per_checked = 'checked';
                          }
                        ?>
                        <input type="radio" name="discount_type" value="1" <?= $rs_checked; ?>> Rupees
                        &nbsp;&nbsp;
                        <input type="radio" name="discount_type" value="2" <?= $per_checked; ?>> Percentage
                      </td>
                      <td>
                        <input type="text" name="discount" class="form-control discount_value" value="<?= $discount ?>">
                        <input type="hidden" value="<?= $discount_amount ?>" name="discount_amount" class="discount_amount">
                      </td>
                      <td colspan="2">
                        <input type="text" name="amount_after_discount" class="form-control amount_after_discount" value="<?= $total_amount ?>" readonly>
                      </td>
                    </tr>
                    <!-- GST -->
                    <tr>
                      <td colspan="3" style="text-align: right;"><b><?= $this->lang->line('gst'); ?></b></td>
                      <td>
                        <input type="text" name="tax_per" class="form-control tax_per" value="<?= $gst_per ?>">
                      </td>
                      <td>
                        <input type="text" name="gst_amount" class="form-control gst_amount" value="<?= $gst_amount ?>" readonly>
                      </td>
                      <td colspan="3">
                        <input type="text" name="grand_total" class="form-control grand_total" value="<?= $grand_total ?>" readonly>
                      </td>
                    </tr>
                    <!-- Final Total -->
                    <tr>
                      <td colspan="3" style="text-align: right;"><b><?= $this->lang->line('grand_total'); ?></b></td>
                      <td colspan="5">
                        <input type="text" name="final_total_amount" class="form-control final_total_amount" value="<?= $grand_total ?>" readonly>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>

          <div class="form-group bg-white p-3">
            <div class="row col-md-12">
              <div class="col-md-6 col-sm-6 ">
                <label class="control-label"><?= $this->lang->line('vendor_reference'); ?></label>
                <input type="text" name="reference_by" class="form-control" value="<?= $reference_by ?>">
              </div>
              <div class="col-md-6 col-sm-6 ">
                <label class="control-label"><?= $this->lang->line('delivery_period'); ?></label>
                <input type="text" name="delivery_period" class="form-control" value="<?= $delivery_period ?>">
              </div>
              <div class="col-md-6 col-sm-6 ">
                <label class="control-label"><?= $this->lang->line('payment_terms'); ?></label>
                <input type="text" name="payment_term" class="form-control" value="<?= $payment_term ?>">
              </div>
              <div class="col-md-6 col-sm-6 ">
                <label class="control-label"><?= $this->lang->line('freight_status'); ?></label>
                <div>
                  <?php
                    $paid = '';
                    $to_pay = '';
                    if (!empty($freight_status)) {
                      if ($freight_status == 'Paid') {
                        $paid = 'checked';
                      } else {
                        $to_pay = 'checked';
                      }
                    }
                  ?>
                  <input type="radio" name="freight_status" value="Paid" <?= $paid ?>> Paid
                  &nbsp;&nbsp;
                  <input type="radio" name="freight_status" value="To Pay" <?= $to_pay ?>> To Pay
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row col-md-12">
              <div class="col-md-12 col-sm-12 ">
                <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('submit'); ?></button>
              </div>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- Hidden template row -->
<table id="sample_table1" style="display: none;">
  <tbody>
    <tr class="main_tr1">
      <td>1</td>
      <td style="width:30%">
        <select name="item_id[]" class="form-control drop">
          <?php if ($items): ?>
            <?php foreach ($items as $value) : ?>
              <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
            <?php endforeach; ?>
          <?php else: ?>
            <option value="0">No result</option>
          <?php endif; ?>
        </select>
      </td>
      <td style="width:15%">
        <input type="text" name="ordered_qty[]" class="form-control qty" required>
      </td>
      <td style="width:15%">
        <input type="text" name="pending_qty[]" class="form-control pending_qty" readonly>
      </td>
      <td style="width:15%">
        <input type="text" name="rate[]" class="form-control rate" required>
      </td>
      <td style="width:15%">
        <input type="text" name="total[]" class="form-control total" readonly required>
      </td>
      <td style="width:15%">
        <button type="button" class="btn btn-xs btn-primary addrow"><i class="fa fa-plus"></i></button>
        <button type="button" class="btn btn-xs btn-danger deleterow"><i class="fa fa-minus"></i></button>
      </td>
    </tr>
  </tbody>
</table>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    /*$('body').on('click','.addrow',function(){

			var table=$(this).closest('table');
			add_row();
			 rename_rows();
			 calculate_total(table);
	    });
		*/
    /*function add_row(){ 
    	var tr1=$("#sample_table1 tbody tr").clone();
    	$("#maintable tbody#mainbody").append(tr1);
    }*/
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
        $(this).find("td:nth-child(2) select.drop").select2();
        //$(this).find("td:nth-child(3) select.select2").select2();
        /*$(this).find("td:nth-child(2).code").attr({name:"labour_rows["+i+"][code_description]", id:"labour_rows-"+i+"-code_description"});*/

      });
    }

    $(document).on('keyup', '.ordered_qty,.rate,.discount_value,.tax_per', function() {
      var table = $(this).closest('table');
      calculate_total(table);

    });
    $(document).on('change', '.discount_type', function() {
      var table = $(this).closest('table');
      calculate_total(table);
    });


    function calculate_total(table) {

      var total_amount = 0;
      var total_qty = 0;
      var total_pending_qty = 0;
      var req_total_qty = 0;
      var req_qty = 0;
      var ordered_qty = 0;
      var pending_qty = 0;
      var rate = 0;
      var total_rate = 0;
      var grand_total = 0;
      var taxable_value = 0;
      var rupees = 0;
      var percentage = 0;
      var discount_type = 0;
      var tax_per = 0;
      var tax_amount = 0;
      var final_total = 0;
      table.find(" tbody tr.main_tr1").each(function() {
        //var qty,rate,total=0;
        req_qty = parseFloat($(this).find("td:nth-child(3) input.req_qty").val());
        ordered_qty = parseFloat($(this).find("td:nth-child(4) input.ordered_qty").val());
        rate = parseFloat($(this).find("td:nth-child(6) input.rate").val());
        //alert();
        if (isNaN(rate)) {
          rate = 0;
        }
        if (isNaN(ordered_qty)) {
          ordered_qty = 0;
        }
        req_total_qty = req_total_qty + req_qty;
        if (ordered_qty <= req_qty) {
          pending_qty = req_qty - ordered_qty;
          total_qty = total_qty + ordered_qty;
          total_rate = total_rate + rate;
          amount = ordered_qty * rate;
          total_amount = total_amount + amount;
          total_pending_qty = total_pending_qty + pending_qty;
          $(this).find("td:nth-child(5) input.pending_qty").val(pending_qty.toFixed(2));
          $(this).find("td:nth-child(7) input.total").val(amount.toFixed(2));
          //alert(total_qty);

        } else {
          alert('You can not enter quantity greater than requisition slip');
          $(this).find("td:nth-child(4) input.ordered_qty").val('');
          $(this).find("td:nth-child(5) input.pending_qty").val('');
          calculate_total(table);
        }

      });

      //alert(total_qty);
      table.find("tfoot tr input.req_total_qty").val(req_total_qty.toFixed(2));
      table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
      table.find("tfoot tr input.pending_total_qty").val(total_pending_qty.toFixed(2));
      table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
      table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));


      /********************* Discount Calculation  *******************/

      if (table.find("tfoot tr input[name=discount_type]").is(':checked')) {
        discount_type = table.find("tfoot tr input[name=discount_type]:checked").val();
        //alert(discount_type);
        if (discount_type == 2) {
          percentage = parseFloat(table.find("tfoot tr input.discount_value").val());
          if (!isNaN(percentage)) {
            taxable_value = (total_amount * percentage) / 100;
            grand_total = total_amount - taxable_value;
            table.find("tfoot tr input.amount_after_discount").val(grand_total.toFixed(2));
            table.find("tfoot tr input.discount_amount").val(taxable_value.toFixed(2));
          }
        } else if (discount_type == 1) {
          rupees = parseFloat(table.find("tfoot tr input.discount_value").val());
          if (!isNaN(rupees)) {
            grand_total = total_amount - rupees;
            table.find("tfoot tr input.amount_after_discount").val(grand_total.toFixed(2));
            table.find("tfoot tr input.discount_amount").val(rupees.toFixed(2));
          }
        }
      }
      /********************* GST Calculation  *******************/
      tax_per = table.find("tfoot tr input.tax_per").val();
      //alert(tax_per);
      if (!isNaN(tax_per)) {
        if (isNaN(tax_amount)) {
          tax_amount = 0;
        }
        if (isNaN(final_total)) {
          final_total = 0;
        }

        tax_amount = (grand_total * tax_per) / 100;
        final_total = grand_total + tax_amount;
        table.find("tfoot tr input.gst_amount").val(tax_amount.toFixed(2));
        table.find("tfoot tr input.grand_total").val(final_total.toFixed(2));
        table.find("tfoot tr input.final_total_amount").val(final_total.toFixed(2));
      }


    }


  });
</script>