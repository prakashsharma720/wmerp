<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//print_r($conditions['from_date']);exit;
$current_page=current_url();
$data=explode('?', $current_page);
?>
<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('success')?>!</h5>
    <?php echo $this->session->flashdata('success'); ?>
</div>
<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if($this->session->flashdata('failed')): ?>
<div class="alert alert-error alert-dismissible ">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('alert')?>!</h5>
    <?php echo $this->session->flashdata('failed'); ?>
</div>
<?php endif; ?>
<div class="container-fluid">
    <div class="card card-primary card-outline">
        <div class="card-header">

            <span class="card-title"><?=$this ->lang ->line('invoice_list')?>
            </span>
            <div class="button-group float-right">



                <a href="<?php echo base_url(); ?>index.php/Invoice/add" class="btn btn-success" data-toggle="tooltip"
                    title="New Invoice"><i class="fa fa-plus"></i></a>

                <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i
                        class="fa fa-refresh"></i></button>

                <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i
                        class="fa fa-trash"></i></button>
                <button class="btn btn-primary generate_json" data-toggle="tooltip" title="Bulk generate_json"><i
                        class="fa fa-download"></i></i></button>

                &nbsp;

            </div>

        </div> <!-- /.card-body -->
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
						  <a href="<?php echo $data[0]?>" class="btn btn-danger" > <?=$this ->lang ->line('reset')?></a>
					  </div>
					</div>
				</form>
				<hr>
				<br>
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
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

                            <td>
                                <a class="btn btn-xs btn-info btnEdit"
                                    href="<?php echo base_url(); ?>index.php/Invoice/print_invoice/<?php echo $obj['id'];?>"><i
                                        style="color:#fff;" class="fa fa-print"></i></a>

                                <a class="btn btn-xs btn-primary btnEdit" data-toggle="modal"
                                    data-target="#send_mail<?php echo $obj['id'];?>"><i style="color:#fff;"
                                        class="fa fa-envelope"></i></a>

                                <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal"
                                    data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"
                                        class="fa fa-trash"></i></a>
                                <a class="btn btn-xs btn-primary btnEdit"
                                    href="<?php echo base_url(); ?>index.php/Invoice/generate_json/<?php echo $obj['id'];?>"><i
                                        class="fa fa-download"></i></a>
                            </td>

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