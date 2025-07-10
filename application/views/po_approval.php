<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
?>

<style type="text/css">
 
  .col-sm-6 ,.col-md-6{
      float: left;
  }
</style>
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
<?php //  echo $data; exit; ?>
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
      <div class="button-group float-right">
         <a href="<?php echo base_url(); ?>index.php/Purchase_order/add" class="btn btn-success" data-toggle="tooltip" title="New PO"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

          <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button>
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th><input type="checkbox" id="master"></th>
              <th >Sr.No.</th>
              <th> PO No </th>
              <th style="white-space: nowrap;"> Supplier Name </th>
              <th style="white-space: nowrap;"> Date </th>
              <th style="white-space: nowrap;">Total Amount (&#8377;)</th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($po_data as $obj){ ?>
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
                <td><?php echo $obj['grand_total']; ?> &#8377;</td>
                <td >
              
				          <?php if((round($obj['grand_total'])>'5000') && ($obj['purchase_indent']=='0')) { ?>
                    <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Purchase_order/print/<?php echo $obj['id'];?>" title="Print PO"><i class="fa fa-print"></i></a>
                    <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#reject<?php echo $obj['id'];?>" title="Reject PO"><i style="color:#fff;"class="fa fa-window-close"></i></a>
                    <a class="btn btn-xs btn-success btnEdit" data-toggle="modal" data-target="#approve<?php echo $obj['id'];?>" title="Approve PO"><i style="color:#fff;"class="fa fa-check"></i></a>
                 
                  <?php } else{ ?>
                    <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Purchase_order/printIndent/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>
                  <?php } ?>
        
                 
                </td>
                   <!--------------  Rejected Purchase ordEr Modal Code Start  ------------ -->
                    <div class="modal fade" id="reject<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/ActionPO">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color:#dc7629;color: azure;">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p> Are you sure, you want to <b style="color:#dc7629;">Reject</b>  Purchase Order <b><?php echo $inv_number1 ;?> </b>? </p>
                            <input type="hidden" name="po_id" value="<?php echo $obj['id'];?>">
                            <input type="hidden" name="status" value="Rejected">
                            <input type="hidden" name="rejected_date" value="<?= date('Y-m-d') ?>">
                            <div class="form-group">
                                <div class="row col-md-12">
                                  <label  class="control-label"> Reject Reason</label>
                                <textarea class="form-control Comment" rows="2" placeholder="Enter Reason here" name="rejected_reason" required="required"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-danger modal_reject_button" style="background-color: #dc7629;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <!--------------  Rejected Purchase ordEr Modal Code End  ------------------>

                     <!-------------- Approved Purchase ordEr Modal Code Start  ---------------->
                    <div class="modal fade" id="approve<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Purchase_order/ActionPO">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header" style="background-color: #168c56;color: azure;">
                             <h4 class="modal-title" >Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal" style="color: azure;">&times;</button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to <b style="color:#168c56;">Approve</b> Purchase Order  <b><?php echo $inv_number1 ;?> </b>? </p>
                            <input type="hidden" name="po_id" value="<?php echo $obj['id'];?>">
                            <input type="hidden" name="status" value="Approved">
                            <input type="hidden" name="approved_date" value="<?= date('Y-m-d') ?>">
                            <div class="form-group">
                                <div class="row col-md-12">
                                  <label  class="control-label"> Comment </label>
                                <textarea class="form-control Comment" rows="2" placeholder="Enter Comment here" name="approve_comment"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success modal_approve_button" style="background-color: #168c56;">Submit</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <!--------------  Rejected Purchase ordEr Modal Code End  ------------ -->
                    
                    
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