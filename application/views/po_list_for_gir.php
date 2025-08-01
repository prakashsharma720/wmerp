
<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5><?php  echo $title; ?></h5>
          
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

    
  </div>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
?>

<style type="text/css">
  .btnEdit{
    width: 25%;
    border-radius: 5px;
    margin: 1px;
    padding: 1px; 
  }
  .col-sm-6 ,.col-md-6{
      float: left;
  }
</style>

<?php //  echo $data; exit; ?>
<!-- <div class="container-fluid">
  <div class="card card-primary card-outline"> -->
  
     
      <!-- <div class="button-group float-right"> -->
        <!--  <a href="<?php echo base_url(); ?>index.php/Purchase_order/add" class="btn btn-success" data-toggle="tooltip" title="New PO"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button> -->
        
      </div>
    </div> 


    <div class="container card-white-box">
 
  <div id="proposalList_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">


    <div class="col-sm-12">
      <table class="table table-hover align-middle" id="proposalList">
        <thead class="table-light">
    <!-- <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead> -->
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th ><?=$this ->lang ->line('sr_no')?>.</th>
              <th> <?=$this ->lang ->line('po_no')?> </th>
              <th> <?=$this ->lang ->line('supplier_name')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang ->line('date')?></th>
              <th style="white-space: nowrap;"><?=$this ->lang ->line('total_amount')?> (&#8377;)</th>
              <th style="white-space: nowrap;width: 20%;"> <?=$this ->lang ->line('action_button')?></th>
            </tr>
          </thead>
          <tbody>
           <?php
           //print_r($po_data);
            if(!empty($po_data)){
              $i=1;foreach($po_data as $obj){ 
                //print_r($obj);exit;
                ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                 <td>
                  <?php 
                         $inv_number=$obj['po_number'];
                          if($inv_number<10){
                            $inv_number1='CNC/A/000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='CNC/A/00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='CNC/A/0'.$inv_number;
                            }
                            else{
                              $inv_number1='CNC/A/'.$inv_number;
                            }
                            echo $inv_number1; ?>     
                </td>
                <td><?php echo $obj['supplier']; ?></td>
                <td><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['grand_total']; ?></td>
                <td style="display: flex; gap: 6px; align-items: center;">
                 <!-- <a class="avatar-text avatar-md" data-toggle="modal" data-target="#viewPO<?= $obj['id']; ?>">
  <i class="feather feather-eye"></i>
</a> -->
<a class="avatar-text avatar-md" 
     data-bs-toggle="offcanvas" 
     data-bs-target="#viewPO<?= $obj['id']; ?>">
    <i class="feather feather-eye"></i>
  </a>

				            <a class="avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Purchase_order/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>

                    <a class="avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Gir_registers/add/<?php echo $obj['id'];?>" data-toggle="tooltip" title="Convert to GIR Register" ><i class="fa fa-refresh"></i> </a>
                    
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/deletePO/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Purchase Order (<?php echo $obj['po_number']?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-5">Item Name</div>
                                <!-- <div class="col-md-2">Grade </div> -->
                                <div class="col-md-2">Qty </div>
                                <div class="col-md-2">Price (&#8377;)</div>
                                <div class="col-md-2">Amount (&#8377;)</div>
                              </div>

                                    <?php
                                      $j=1;foreach($obj['po_details'] as $po_detail)
                                      { ?>
                                        <div class="row col-md-12" style="border: 0px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px;">
                                          <div class="col-md-1"><?= $j;?> </div>
                                          <div class="col-md-5"><?= $po_detail['item'] ;?> </div>
                                         <!--  <div class="col-md-2"><?= $po_detail['grade'] ;?> </div> -->
                                          <div class="col-md-2"><?= $po_detail['quantity'] ;?> </div>
                                          <div class="col-md-2"><?= $po_detail['rate'] ;?> </div>
                                          <div class="col-md-2"><?= round($po_detail['amount']) ;?> </div>
                                        </div>
                                  <?php $j++; }  ?>
                              </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-4">
                                <label class="control-label"> Quatation No : </label>
                                <span > <?php echo $obj['quotation_no']?></span>
                              </div>
                               <div class="col-md-4">
                                <label class="control-label"> Total Qty : </label>
                                <span > <?php echo $obj['total_qty']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> Total Amount: </label>
                                <span > <?php echo round($obj['total_amount']).' &#8377;' ?></span>
                              </div>

                            </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-4">
                                <label class="control-label"> Discount : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['discount_amount'].' &#8377; '; 
                                        ?> 
                                  </span>
                              </div>
                               <div class="col-md-4">
                                <label class="control-label"> GST : </label>
                                <span > <?php echo round($obj['gst_amount']).' &#8377;'?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> Grand Total: </label>
                                <span > <?php echo round($obj['grand_total']).' &#8377;' ?></span>
                              </div>
                            </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-4">
                                <label class="control-label"> Delivery Period : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['delivery_period']; 
                                        ?>
                                  </span>
                              </div>
                               <div class="col-md-4">
                                <label class="control-label"> Payment Mode : </label>
                                <span > <?php echo $obj['payment_term']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> Reference By: </label>
                                <span > <?php echo $obj['reference_by'] ?></span>
                              </div>
                            </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-12">
                                <label class="control-label"> Comment : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['comment']; 
                                        ?>
                                  </span>
                              </div>
                            </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>


                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/deletePO/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete PO Number <b><?php echo $obj['po_number'];?> </b>? </p>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> Yes </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
             <?php $this->load->view('leave-module/component/gir.php', ['obj' => $obj]); ?>

            <?php  $i++;} } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
  $( document ).ready(function() {
     
    jQuery('#master').on('click', function(e) {
    if($(this).is(':checked',true))  
    {
      $(".sub_chk").prop('checked', true);  
    }  
    else  
    {  
      $(".sub_chk").prop('checked',false);  
    }  
  });
    jQuery('.delete_all').on('click', function(e) { 
    var allVals = [];  
    $(".sub_chk:checked").each(function() {  
      allVals.push($(this).val());
    });  
    //alert(allVals.length); return false;  
    if(allVals.length <=0)  
    {  
      alert("Please select row.");  
    }  
    else {  
      WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Purchase_order/deletePO",  
          cache:false,  
          data: 'ids='+join_selected_values,  
          success: function(response)  
          {   
            $(".successs_mesg").html(response);
            location.reload();
          }   
        });
           
      }  
    }  
  });

  });

</script>