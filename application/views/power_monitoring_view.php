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

         <a href="<?php echo base_url(); ?>index.php/Power_monitoring_registers/add" class="btn btn-success" data-toggle="tooltip" title="New Production Register"><i class="fa fa-plus"></i></a>

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
              <th style="white-space: nowrap;"> PMR No </th>
              <th style="white-space: nowrap;"> Transaction Date  </th>
              <th style="white-space: nowrap;"> Total Units</th>
              <th style="white-space: nowrap;"> Main Meter Units</th>
              <th style="white-space: nowrap;"> Unit Variance</th>
             <!--  <th style="white-space: nowrap;"> Production By </th> -->
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
                            $inv_number1='PMR000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='PMR00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='PMR0'.$inv_number;
                            }
                            else{
                              $inv_number1='PMR'.$inv_number;
                            }
                            echo $inv_number1; ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['unit_consumed']; ?></td>
                <td><?php echo $obj['rseb_meter_units']; ?></td>
                <td><?php echo $obj['difference_units']; ?></td>
                <!-- <td><?php echo $obj['employee']; ?></td>   -->             
                <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>
				           <!--  <a class="btn btn-xs btn-success btnEdit" href="<?php echo base_url(); ?>index.php/Requisition_slips/print/<?php echo $obj['id'];?>" title="Print Production Register" ><i class="fa fa-print"></i></a> -->
                  <a class="btn btn-xs btn-primary btnEdit" href="<?php echo base_url(); ?>index.php/Power_monitoring_registers/edit/<?php echo $obj['id'];?>" title="Edit"><i class="fa fa-edit"></i></a>
                  <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>" title="Delete"><i style="color:#fff;"class="fa fa-trash"></i></a>
                </td>
                <div class="modal fade" id="view<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title"> Power Monitoring Register (<?php echo $inv_number1 ?>) Details </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                                    <?php
                                      $j=1;foreach($obj['process_details'] as $po_detail)
                                      { ?>
                                        <fieldset>
                                          <legend> <?= $po_detail['meter_name'] ?>  </legend>
                                          <div class="row ">
                                            <div class="col-md-4">
                                              <label> Date  </label>  : 
                                              <?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?>
                                            </div>
                                             <div class="col-md-4">
                                              <label> Opening Reading</label>  : 
                                              <?= $po_detail['opening_reading'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Closing Reading</label>  : 
                                              <?= $po_detail['closing_reading'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Total Units </label>  : 
                                              <?= $po_detail['unit_consumed'] ?>
                                            </div>
                                            <div class="col-md-4">
                                              <label> Production </label>  : 
                                              <?= $po_detail['production_in_mt'] ?> Ton
                                            </div>
                                            <div class="col-md-4">
                                              <label> Unit Per Ton</label>  : 
                                              <?= $po_detail['unit_per_ton'] ?>
                                            </div>
                                          </div>
                                        </fieldset>
                                  <?php  }  ?>
                              </div>
                              <div class="row col-md-12" >
                                 <div class="col-md-4">
                                    <label class="control-label"> RSEB Meter Opening </label>:
                                    <span > 
                                      <?php 
                                          echo $obj['rseb_opening']; 
                                        ?>
                                    </span>
                                 </div>
                                   <div class="col-md-4">
                                    <label class="control-label"> RSEB Meter Closing </label>:
                                    <span > 
                                      <?php 
                                          echo $obj['rseb_closing']; 
                                        ?>
                                    </span>
                                 </div>
                                 <div class="col-md-4">
                                <label class="control-label"> RSEB Meter Units </label>:
                                  <span > 
                                      <?php 
                                          echo $obj['rseb_meter_units']; 
                                        ?>
                                  </span>
                              </div>
                            </div>
                              <div class="row col-md-12" >
                                <div class="col-md-4">
                                  <label class="control-label"> Total Consumed Units </label>:
                                    <span > 
                                        <?php 
                                            echo $obj['unit_consumed']; 
                                          ?>
                                    </span>
                                </div>
                               <div class="col-md-4">
                                <label class="control-label"> Unit Variation </label>:
                                  <span > 
                                      <?php 
                                      if($obj['unit_consumed']<$obj['rseb_meter_units']){
                                         echo '-'.$obj['difference_units']; 
                                      }else{
                                         echo '+'.$obj['difference_units']; 
                                      }
                                         
                                        ?>
                                  </span>
                              </div>
                               <div class="col-md-4">
                                <label class="control-label"> Total Production (MT) </label>:
                                  <span > 
                                      <?php 
                                          echo $obj['total_production_in_mt']; 
                                        ?>
                                  </span>
                              </div>
                               <div class="col-md-8">
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
                      </div>
                    </div>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Power_monitoring_registers/deleteRecord/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Confirm Header </h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                            <p>Are you sure, you want to delete Production Register <b><?php echo $inv_number1?> </b>? </p>
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
          url: "<?php echo base_url(); ?>index.php/Power_monitoring_registers/deleteRecord",  
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