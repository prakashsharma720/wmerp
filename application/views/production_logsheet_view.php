<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
       <div class="button-group float-right">

         <a href="<?php echo base_url(); ?>index.php/Production_logsheets/add" class="btn btn-success" data-toggle="tooltip" title="New Production Register"><i class="fa fa-plus"></i></a>

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
              <th style="white-space: nowrap;"> PL No </th>
              <th style="white-space: nowrap;"> Date Of Production </th>
              <th style="white-space: nowrap;"> Mill No </th>
              <th style="white-space: nowrap;"> Total Production (MT) </th>
              <th style="white-space: nowrap;">Total KWH </th>
              <!-- <th style="white-space: nowrap;"> Grade Name </th>
              <th style="white-space: nowrap;"> LOT No </th>
              <th style="white-space: nowrap;"> Batch No </th>
              <th style="white-space: nowrap;"> No of Bags</th> -->
              <th style="white-space: nowrap;"> Production By </th>
              <th style="white-space: nowrap;width: 20%;"> Action Button</th>
            </tr>
          </thead>
          <tbody>
           <?php
          $i=1;foreach($pr_data as $obj){ ?>
              <tr>
                <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                <td><?php echo $i;?></td>
                <td>
                  <?php 
                         $inv_number=$obj['voucher_code'];
                          if($inv_number<10){
                            $inv_number1='PL000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='PL00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='PL0'.$inv_number;
                            }
                            else{
                              $inv_number1='PL'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['mill_no']; ?></td>
                <td><?php echo $obj['total_production']; ?></td>
                <td><?php echo $obj['total_kwh_consumed']; ?> Units</td>
                <td><?php echo $obj['employee']; ?></td>               
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
				           <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/print/<?php echo $obj['id'];?>" title="Print Production Register" ><i class="fa fa-print"></i></a> -->
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Production_logsheets/edit/<?php echo $obj['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>" title="Delete"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Production_logsheets/deletePR/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Production Logsheet (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                                    <?php
                                      $j=1;foreach($obj['production_details'] as $po_detail)
                                      { ?>
                                        <fieldset>
                                          <legend> <?= $po_detail['grade_name'].' ('.$po_detail['fg_code'].')' ;?> Production Details </legend>
                                          <div class="row ">
                                            <div class="col-md-4">
                                              <label> M/c Start : </label>  : 
                                              <?= date('d-M-Y',strtotime($po_detail['machine_start_date'])).', '.$po_detail['hrs1'].':'.$po_detail['min1'] ;?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> M/c Stop : </label>  : 
                                              <?= date('d-M-Y',strtotime($po_detail['machine_stop_date'])).',  '.$po_detail['hrs2'].':'.$po_detail['min2'] ;?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Total Time</label>  : 
                                              <?= $po_detail['machine_total_time'] ?> Hrs.
                                            </div>
                                            <div class="col-md-4">
                                              <label> Down Time</label>  : 
                                              <?= $po_detail['machine_down_time'] ?> Hrs.
                                            </div>
                                            <div class="col-md-4">
                                              <label> Actual Time</label>  : 
                                              <?= $po_detail['machine_actual_time'] ?> Hrs.
                                            </div>
                                             <div class="col-md-4">
                                              <label> Lot No</label>  : 
                                              <?= $po_detail['lot_no'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Batch No</label>  : 
                                              <?= $po_detail['batch_no'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Packing Size</label>  : 
                                              <?= $po_detail['packing_size'] ?> Kg
                                            </div>
                                            <div class="col-md-4">
                                              <label> No Of Bags</label>  : 
                                              <?= $po_detail['no_of_bags'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Production</label>  : 
                                              <?= $po_detail['production_in_mt'] ?> MT
                                            </div>
                                             <div class="col-md-4"> 
                                              <label> Production/Hour</label>  : 
                                              <?= $po_detail['per_hour_production'] ?> Bags
                                            </div>
                                            <div class="col-md-4">
                                              <label> Tailing Qty</label>  : 
                                              <?= $po_detail['tailing_qty'] ?> Kg
                                            </div>
                                            <div class="col-md-4">
                                              <label> Tailing %</label>  : 
                                              <?= $po_detail['tailing_per'] ?> %
                                            </div>
                                            <div class="col-md-4">
                                              <label> KWH Opening</label>  : 
                                              <?= $po_detail['kwh_opening'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> KWH Closing</label>  : 
                                              <?= $po_detail['kwh_closing'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> KWH Consumed</label>  : 
                                              <?= $po_detail['kwh_consumed'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Unit / MT</label>  : 
                                              <?= $po_detail['unit_per_mt'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Mill RPM</label>  : 
                                              <?= $po_detail['mill_rpm'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Mill AMP</label>  : 
                                              <?= $po_detail['mill_amp'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Blower In Hrs</label>  : 
                                              <?= $po_detail['blower_in_hrz'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Blower AMP</label>  : 
                                              <?= $po_detail['blower_amp'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Screw RPW</label>  : 
                                              <?= $po_detail['screw_rpw'] ?> 
                                            </div>
                                            <div class="col-md-4">
                                              <label> Air Washer RPM</label>  : 
                                              <?= $po_detail['air_washer_rpm'] ?> 
                                            </div>
                                          </div>
                                        </fieldset>
                                  <?php  }  ?>
                              </div>

                            <div class="row col-md-12" >
                              <div class="col-md-4">
                                <label class="control-label"> Total Production : </label>
                                <span > <?php echo $obj['total_production']?> MT</span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> Total Bags : </label>
                                <span > <?php echo $obj['total_bags']?></span>
                              </div>
                              <div class="col-md-4">
                                <label class="control-label"> Total KWH : </label>
                                <span > <?php echo $obj['total_kwh_consumed']?></span>
                              </div>
                            </div>
                            <div class="row col-md-12" >
                              <div class="col-md-12">
                                <label class="control-label"> Remarks : </label>
                                  <span > 
                                      <?php 
                                          echo $obj['remarks']; 
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
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Production_logsheets/deleteProduction/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Production Register <b><?php echo $inv_number1;?> </b>? </p>
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
          url: "<?php echo base_url(); ?>index.php/Production_logsheets/deleteProduction",  
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