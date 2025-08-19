<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($conditions['from_date']);exit;
$current_page=current_url();
$data=explode('?', $current_page);
?>
<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('invoice_list') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
       
      </ul>
    </div>
    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      
 <a href="<?php echo base_url(); ?>index.php/Invoice/add" class="btn btn-icon btn-light-brand" data-toggle="tooltip"
                    title="New Invoice"><i class="fa fa-plus"></i></a>

                <button class="btn btn-icon btn-light-brand" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i
                        class="fa fa-refresh"></i></button>

                <button class="btn btn-icon btn-light-brand delete_all" data-toggle="tooltip" title="Bulk Delete"><i
                        class="fa fa-trash"></i></button>
                <button class="btn btn-icon btn-light-brand generate_json" data-toggle="tooltip" title="Bulk generate_json"><i
                        class="fa fa-download"></i></i></button>
                        

    </div>
  </div>

 <div class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">

        <div class="card-body">
            <form method="post" action="<?php echo base_url(); ?>index.php/Invoice/importdata"
                enctype="multipart/form-data">
                <input type="file" name="userfile" />
                <input type="submit" name="submit" class="btn btn-warning" value="<?=$this ->lang ->line('import_file')?>" />
            </form>
			<hr>
			<br>
			 <form method="get" id="filterForm">
				  <div class="row">
					 <div class="col-md-4 col-sm-4">
							  <label  class="control-label"> <?=$this ->lang ->line('from_date')?></label>
								<input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="<?php echo $conditions['from_date']?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
						  </div>
						  <div class="col-md-4 col-sm-4">
							<label  class="control-label"> <?=$this ->lang ->line('upto_date')?></label>
							  <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="<?php echo $conditions['upto_date']?>" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
						</div>
						 <div class="col-md-4 col-sm-4 ">
						   <label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label><br>
						  <input type="submit" class="btn btn-primary" value="<?=$this ->lang ->line('search')?>" /> 
						  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
						  <a href="<?php echo $data[0]?>" class="btn btn-danger" style="position:relative;width:85px;left:80px;bottom:38px" > <?=$this ->lang ->line('reset')?></a>
					  </div>
					</div>
				</form>
				<hr>
				<br>
             <div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
                <thead>
                  <tr>
                            <th><input type="checkbox" id="master"></th>
                            <th><?=$this ->lang ->line('sr_no')?>.</th>
                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('invoice_no')?> </th>
                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('invoice_date')?> </th>
                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('vendor_code')?></th>
                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('grand_total')?></th>
                            <th style="white-space: nowrap;"> <?=$this ->lang ->line('e_invoice_status')?></th>

                            <th style="white-space: nowrap;width: 20%;"> <?=$this ->lang ->line('action_button')?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
          $i=1;foreach($invoice_data as $obj){ ?>
                        <tr>
                            <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                            <td><?php echo $i;?></td>
                            <td>
                                <?php echo $obj['invoice_no'];?>
                            </td>
                            <td><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                            <td>

                                <?php 
                         echo $obj['vendor_code']; ?>
                            </td>
                            <td>
                                <?php 
	                //$amount = '10000.00';
					setlocale(LC_MONETARY, 'en_IN');
					$amount = number_format($obj['grand_total'],2);
					echo $amount; 


                //$fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
                //echo $fmt->formatCurrency($obj['grand_total'], "INR");
                ?>
                            </td>
                            <td>
                                <?php if (!empty($obj['doc_no'])){
                                    echo "<b style='color:green;'>Completed</b>";
                                }
                                    else{
                                        echo "<b style='color:red;'>Pending</b>";
                                    }
                                    
                                    ?>
                            </td>

                            <td style="display:flex;gap:8px;align-items:center">
                                <a class="btn btn-icon btn-light-brand"
                                    href="<?php echo base_url(); ?>index.php/Invoice/print_invoice/<?php echo $obj['id'];?>"><i
                                        class="fa fa-print"></i></a>

                                <!-- <a class="btn btn-icon btn-light-brand" data-toggle="modal"
                                    data-target="#send_mail<?php echo $obj['id'];?>"><i 
                                        class="fa fa-envelope"></i></a> -->
 <a href="javascript:void(0);" 
   class="btn btn-icon btn-light-brand send-invoice-btn" 
   data-id="<?= $obj['id']; ?>">
   <i class="fa fa-envelope"></i>
</a>
                      
        <a class="btn btn-icon btn-light-brand" data-bs-toggle="offcanvas" data-bs-target="#deleteinvoice<?php echo $obj['id'];?>"><i class="feather feather-trash"></i></a>
                                

                                <a class="btn btn-icon btn-light-brand"
                                    href="<?php echo base_url(); ?>index.php/Invoice/generate_json/<?php echo $obj['id'];?>"><i
                                        class="fa fa-download"></i></a>

                                       

                            </td>

<?php $this->load->view('leave-module/component/deleteinvoice.php', ['obj' => $obj]); ?>

<div id="customConfirmBox" 
     style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -30%); background:#fff; border:1px solid #ccc; padding:20px; z-index:9999; width:400px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
  
  <h5 style="margin-bottom: 15px ; background:black;height:30px;color:white">Confirm Header</h5>
  <p>Are you sure, you want to send Invoice to customer email?</p>
  
  <div style="text-align:right;">
    <button id="confirmYes" class="btn btn-sm btn-primary">YES</button>
    <button id="confirmNo" class="btn btn-sm btn-secondary" style="position:relative;left:60px; bottom:27px">NO</button>
  </div>
</div>






                            <div class="modal fade" id="send_mail<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" role="form" method="post"
                                        action="<?php echo base_url(); ?>index.php/Invoice/send_mail/<?php echo $obj['id'];?>">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirm Header </h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure, you want to send Invoice to customer email ? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary send_submit"> Yes </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"> No
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" role="form" method="post"
                                        action="<?php echo base_url(); ?>index.php/Invoice/deleteInvoice/<?php echo $obj['id'];?>">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirm Header </h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure, you want to delete Invoice
                                                    <b><?php echo $obj['invoice_no'];?> </b>?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary delete_submit"> Yes
                                                </button>
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

 <script>
        function deleteInvoice(id) {
  if (confirm("Are you sure you want to delete this invoice?")) {
    window.location.href = "<?= base_url('index.php/invoice/deleteinvoice/') ?>" + id;
  }
}

        </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let selectedId = null;

    // Show popup on click
    document.querySelectorAll('.send-invoice-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            selectedId = this.getAttribute('data-id');
            document.getElementById('customConfirmBox').style.display = 'block';
        });
    });

    // On YES, redirect to send invoice URL
    document.getElementById('confirmYes').addEventListener('click', function() {
        if (selectedId) {
            window.location.href = "<?= base_url('index.php/Invoice/send_mail/') ?>" + selectedId;
        }
    });

    // On NO, hide the popup
    document.getElementById('confirmNo').addEventListener('click', function() {
        document.getElementById('customConfirmBox').style.display = 'none';
        selectedId = null;
    });
});
</script>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {

    $(document).on('click', '.send_mail', function() {
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
        }
    });

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
            WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Invoice/deleteInvoice",
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

    jQuery('.generate_json').on('click', function(e) {
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).val());
        });
        //alert(allVals.length); return false;  
        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            WRN_PROFILE_DELETE = "Are you sure you want to Generate Json of all selected records?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                // alert(join_selected_values);exit; 
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Invoice/generate_json",
                    cache: false,
                    data: 'ids=' + join_selected_values,
                    // alert(data),
                    success: function(response) {
                        var fileUrl =
                            "<?php echo base_url(); ?>index.php/Invoice/download_json/" +
                            response;

                        var link = document.createElement("a");
                        link.href = fileUrl;
                        link.setAttribute('download', response);
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    }
                });


            }
        }
    });

});
</script>