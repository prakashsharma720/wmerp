<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
$data=explode('?', $current_page);
//print_r($po_data);exit;
?>


      <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('success')?>!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
          <!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
      <?php endif; ?>

      <?php if($this->session->flashdata('failed')): ?>
         <div class="alert alert-error alert-dismissible " >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> <?=$this ->lang ->line('alert')?>!</h5>
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
           <button type="submit" class="btn btn-info"> <?=$this ->lang ->line('export')?> </button>
         </form>
        <!-- <a class="btn btn-info" href="<?php echo base_url(); ?>index.php/Suppliers/createXLS">Export</a>   -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <form method="get" id="filterForm">
          <div class="row">

              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?=$this ->lang ->line('filter_by_supplier')?> <span class="required">*</span></label>
                <select name="supplier_id" class="form-control select2 employees" >
                    <option value="0"><?=$this ->lang ->line('select_supplier')?></option>
                    <?php
                         if ($employees): ?> 
                          <?php 
                            foreach ($employees as $value) : ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang ->line('no_result')?></option>
                        <?php endif; ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?=$this ->lang ->line('filter_by_department')?> <span class="required">*</span></label>
                <select name="department_id" class="form-control select2 employees" >
                    <option value="0"><?=$this ->lang ->line('select_department')?>t</option>
                    <?php
                         if ($departments): ?> 
                          <?php 
                            foreach ($departments as $value) : ?>
                               <option value="<?= $value['id'] ?>"><?= $value['department_name'] ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang ->line('no_result')?></option>
                        <?php endif; ?>
                </select>
              </div>
               <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?=$this ->lang ->line('po_status')?> <span class="required">*</span></label>
                <select name="admin_approval" class="form-control select2 " >
                    <?php
                         if ($req_status): ?> 
                          <?php 
                            foreach ($req_status as $value) : ?>
                               <option value="<?= $value ?>"><?= $value ?></option>
                            <?php   endforeach;  ?>
                        <?php else: ?>
                            <option value="0"><?=$this ->lang ->line('no_result')?></option>
                        <?php endif; ?>
                </select>
              </div>
              <div class="col-md-4 col-sm-4 ">
                <label  class="control-label"><?=$this ->lang ->line('select_type')?> <span class="required">*</span></label>
                  <select class="form-control" name="purchase_indent">
                      <option value="All"> <?=$this ->lang ->line('all')?></option>
                      <option value="0"><?=$this ->lang ->line('purchase_order')?></option>
                      <option value="1"> <?=$this ->lang ->line('purchase_indent')?></option>
                   </select>
              </div>

             <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> <?=$this ->lang ->line('from_date')?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> <?=$this ->lang ->line('upto_date')?></label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
              </div>
                <div class="row">
                   <div class="col-md-6 col-sm-6 ">
                   </div>
                   <div class="col-sm-4 col-sm-4   ">
                      <label  class="control-label" style="visibility: hidden;"> <?=$this ->lang ->line('grade')?></label><br>
                      <input type="submit" class="btn btn-primary" value="Search" /> 
                      <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                      <a href="<?php echo $data[0]?>" class="btn btn-danger" > <?=$this ->lang ->line('reset')?></a>
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
              <th ><?=$this ->lang ->line('sr_no')?>.</th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('order_type')?> </th>
              <th> PO No </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('supplier_name')?></th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('purchase_date')?> </th>
              <th style="white-space: nowrap;"><?=$this ->lang ->line('total_amount')?> (&#8377;)</th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('action')?></th>
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
                             <h4 class="modal-title"><?=$this ->lang ->line('purchase_order')?> (<?php echo $obj['po_number']?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row col-md-12" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-5"><?=$this ->lang ->line('item_name')?></div>
                                <!-- <div class="col-md-2">Grade </div> -->
                                <div class="col-md-2"><?=$this ->lang ->line('qty')?> </div>
                                <div class="col-md-2"><?=$this ->lang ->line('price')?> (&#8377;)</div>
                                <div class="col-md-2"><?=$this ->lang ->line('amount')?> (&#8377;)</div>
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
                                <label class="control-label"> <?=$this ->lang ->line('total_qty')?> : </label>
                                <span > <?php echo $obj['total_qty']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('total_amount')?>: </label>
                                <span > <?php echo round($obj['total_amount']).' &#8377;' ?></span>
                              </div>

                            </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('discount')?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['discount_amount'].' &#8377; '; 
                                        ?> 
                                  </span>
                              </div>
                               <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('gst')?>: </label>
                                <span > <?php echo round($obj['gst_amount']).' &#8377;'?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('grand_total')?>: </label>
                                <span > <?php echo round($obj['grand_total']).' &#8377;' ?></span>
                              </div>
                            </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('delivery_period')?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['delivery_period']; 
                                        ?>
                                  </span>
                              </div>
                               <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('payment_mode')?> : </label>
                                <span > <?php echo $obj['payment_term']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> <?=$this ->lang ->line('reference_by')?>: </label>
                                <span > <?php echo $obj['reference_by'] ?></span>
                              </div>
                            </div>
                            <div class="row col-md-12" style="
                                  margin: 0px;
                                  margin-bottom: 6px;" >
                              <div class="col-md-12">
                                <label class="control-label"> <?=$this ->lang ->line('comment')?> : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['comment']; 
                                        ?>
                                  </span>
                              </div>
                            </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?=$this ->lang ->line('close')?></button>
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