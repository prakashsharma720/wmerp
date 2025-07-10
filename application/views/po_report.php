<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
$data=explode('?', $current_page);
//print_r($po_data);exit;
?>


      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Success!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Alert!</h5>
                 <?php echo $this->session->flashdata('failed'); ?>
               </div>
      <?php endif; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="pull-right error_msg">
        <form method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/createXLS">

          <?php 
          if(!empty($conditions)){
            foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
          <?php } }?>
           <button type="submit" class="btn btn-info"> Export </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
          <div class="row">

              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Filter By Supplier <span class="required">*</span></label>
                <select name="supplier_id" class="form-control select2 employees" >
                    <option value="0">Select Supplier</option>
                    <?php
                         if ($employees): ?> 
                          <?php 
                            foreach ($employees as $value) : ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Filter By Department <span class="required">*</span></label>
                <select name="department_id" class="form-control select2 employees" >
                    <option value="0">Select Department</option>
                    <?php
                         if ($departments): ?> 
                          <?php 
                            foreach ($departments as $value) : ?>
                               <option value="<?= $value['id'] ?>"><?= $value['department_name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
               <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">PO Status <span class="required">*</span></label>
                <select name="admin_approval" class="form-control select2 " >
                    <?php
                         if ($req_status): ?> 
                          <?php 
                            foreach ($req_status as $value) : ?>
                               <option value="<?= $value ?>"><?= $value ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0">No result</option>
                        <?php endif; ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Select Type <span class="required">*</span></label>
                  <select class="form-control" name="purchase_indent">
                      <option value="All"> All</option>
                      <option value="0"> Purchase Order</option>
                      <option value="1"> Purchase Indent</option>
                   </select>
              </div>

             <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                   <div class="col-md-6 col-sm-6 ">
                   </div>
                   <div class="col-sm-4 col-sm-4   ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                      <input type="submit" class="btn btn-primary" value="Search" /> 
                      <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                      <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
                  </div>
                </div>
            
        </form>
            <hr>
<?php if(!empty($po_data)) { ?>
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Order Type </th>
              <th> PO No </th>
              <th style="white-space: nowrap;"> Supplier Name </th>
              <th style="white-space: nowrap;"> Purchase Date </th>
              <th style="white-space: nowrap;">Total Amount (&#8377;)</th>
              <th style="white-space: nowrap;"> Action</th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($po_data as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td><?php if($obj['purchase_indent']=='1') {
                      echo'Purchase Indent';
                    }else{
                      echo 'Purchase Order';
                    }
                  ?>
                  </td>
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
                <td><?php echo $obj['grand_total']; ?> &#8377;</td>
                <td >
                   <a class="btn btn-md btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" style="width:50%;"><i style="color:#fff;"class="fa fa-eye"></i></a>
                 
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
                                          <div class="col-md-5"><?= $po_detail['material_name'] ;?> </div>
                                         <!--  <div class="col-md-2"><?= $po_detail['grade'] ;?> </div> -->
                                            <div class="col-md-2"><?= $po_detail['quantity'].' '.$po_detail['unit'] ;?> </div>
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
              </tr>
            <?php  $i++;} ?>
          </tbody>
        </table>
      </div>
    <?php } ?>
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Requisition_slips/deleteRequisition",  
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