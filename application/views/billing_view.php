<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($employees);exit;
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
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Billing/create" class="btn btn-success" data-toggle="tooltip" title="Create New Job Order"><i class="fa fa-plus"></i></a>

         <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i class="fa fa-refresh"></i></button>

         <!--  <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-trash"></i></button> -->
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered ">
          <thead>
            <tr>
             <!--  <th><input type="checkbox" id="master"></th> -->
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> Date Of Billing</th>
              <th style="white-space: nowrap;"> Invoice Code</th>
              <th style="white-space: nowrap;"> Supplier </th>
              <th style="white-space: nowrap;"> Amount </th>
              <th style="white-space: nowrap;"> Action Button </th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($biilings as $obj){ ?>
              <tr>
                <!-- <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td> -->
                <td><?php echo $i;?></td>
                 <td>
                  <?php 
                    if($obj['transaction_date']=='0000-00-00'){
                      echo 'NA';
                    }
                    else{
                      echo date('d-M-Y',strtotime($obj['transaction_date']));
                    }?>
                </td>
                <td><?php 
                    $voucher_no= $obj['invoice_code']; 
                    if($voucher_no<10){
                    $invoice_code_view='SN000'.$voucher_no;
                    }
                    else if(($voucher_no>=10) && ($voucher_no<=99)){
                      $invoice_code_view='SN00'.$voucher_no;
                    }
                    else if(($voucher_no>=100) && ($voucher_no<=999)){
                      $invoice_code_view='SN0'.$voucher_no;
                    }
                    else{
                      $invoice_code_view='SN'.$voucher_no;
                    }
                  echo $invoice_code_view; ?></td>
                <td><?php echo $obj['supplier']; ?></td>
                <td style="color:green;">&#8377;<?php echo number_format($obj['grand_total']); ?> </td>
                <td>
                  <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-eye"></i></a>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Billing/edit/<?php echo $obj['id'];?>"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Billing/print/<?php echo $obj['id'];?>"><i class="fa fa-print"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>

                    <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Biiling (<?php echo $invoice_code_view ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                              <div class="row" style="border: 1px solid #f3ecec;
                                  height: 45px;
                                  padding: 10px;
                                  margin: 0px;
                                  margin-bottom: 6px; font-weight: 500;background-color: #f3f3f3;" >
                                                             
                                <div class="col-md-1">#</div>
                                <div class="col-md-3">Material Name </div>
                                <div class="col-md-2">Qty </div>
                                <div class="col-md-3">Rate </div>
                                <div class="col-md-3">Total</div>
                              </div>

                                <?php
                                  $j=1;foreach($obj['billing_details'] as $po_detail)
                                  { 
                                        
                                    ?>
                                    <div class="row" style="border: 0px solid #f3ecec;
                              height: 45px;
                              padding: 10px;
                              margin: 0px;
                              margin-bottom: 6px;text-align: left;">
                                      <div class="col-md-1"><?= $j;?> </div>
                                      <div class="col-md-3"><?= $po_detail['material_name'] ;?> </div>
                                      <div class="col-md-2"><?= $po_detail['qty'];?> </div>
                                      <div class="col-md-2"><?= $po_detail['rate'];?> </div>
                                      <div class="col-md-3"><?= number_format($po_detail['amount']) ;?> </div>
                                    </div>
                              <?php $j++; }  ?>
                              <hr>
                              <div class="row">
                                <div class="col-md-4"><b>Taxeble Amount : </b> &#8377;<?= number_format($obj['total_amount_footer']) ;?></div>
                                <div class="col-md-8"></div>
                              </div>

                              <h4> Tax Details </h4>
                              <hr>
                              <?php if($obj['type_of_tax'] == 'Other') { ?>
                              <div class="row">
                                  <div class="col-md-6"><b>SGST  (<?= $obj['sgst_per']?>%) : </b> &#8377;<?= number_format($obj['sgst_amount']) ;?>
                                  </div>
                                   <div class="col-md-6"><b>CGST  (<?= $obj['cgst_per']?>%) : </b> &#8377;<?= number_format($obj['cgst_amount']) ;?>
                                  </div>
                                </div>
                              <div class="row">
                                  <div class="col-md-6"><b>Total Tax Amount : </b> &#8377;<?= number_format($obj['sgst_amount']+$obj['cgst_amount']) ;?>
                                  </div>
                              </div>

                              <?php }else{ ?>
                              <div class="row">
                                  <div class="col-md-6"><b>IGST  (<?= $obj['tax_per_igst']?>%) : </b> &#8377;<?= number_format($obj['igst_amount']) ;?>
                                  </div>
                              </div>
                              <?php } ?>
                              <hr>
                              <div class="row">
                                  <div class="col-md-6"><b>Round Off : </b> &#8377;<?= number_format($obj['round_off']) ;?>
                                  </div>
                                  <div class="col-md-6"><b>Grand Total : </b> <b style="color: green;"> &#8377;<?= number_format($obj['grand_total']) ;?> </b>
                                  </div>
                              </div>
                            
                              </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Billing/deleteRecord/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Bill <b><?= $invoice_code_view ?> </b> ? </p>
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
      WRN_PROFILE_DELETE = "Are you sure you want to delete all selected records?";  
      var check = confirm(WRN_PROFILE_DELETE);  
      if(check == true){  
        var join_selected_values = allVals.join(","); 
        $.ajax({   
          type: "POST",  
          url: "<?php echo base_url(); ?>index.php/Area_cleaning_records/deleteRecord",  
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