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
        <form method="post" action="<?php echo base_url(); ?>index.php/Production_logsheets/createXLS">

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
            <div class="col-md-4 col-sm-4">
                 <label  class="control-label"> Mill Wise Search </label>
                <select name="mill_no" class="form-control" >
                  <option value=""> Select Mill</option>
                    <?php
                     if ($equipments): ?> 
                      <?php 
                        foreach ($equipments as $value) : ?>
                            <?php 
                  if ($value['id'] == $mill_no): ?>
                                  <option value="<?= $value ?>" selected><?= $value ?></option>
                              <?php else: ?>
                                  <option value="<?= $value ?>"><?= $value ?></option>
                              <?php endif;   ?>
                        <?php   endforeach;  ?>
                    <?php else: ?>
                        <option value="0">No result</option>
                    <?php endif; ?>
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

             <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Filter By Finish Good </label>
               <select name="finish_good_id" class="form-control products" style="width:350px;" >
                  <option value=""> Select Item</option>
                      <?php if ($items): ?> 
                          <?php foreach ($items as $value) : ?>
                                 <!--  <option value="<?= $value['id'] ?>"><?= $value['mineral_name'].' ('.$value['grade_name'].','.$value['packing_type'].','.$value['hsn_code'].')' ?></option> -->
                                <option value="<?= $value['id'] ?>"><?= $value['grade_name'].' ('.$value['fg_code'].')' ?></option>
                          <?php endforeach; ?>
                      <?php else: ?>
                          <option value="0">No result</option>
                  <?php endif; ?>
            </select>
              </div> 
              <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"> Submit Data </label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
              </div>
              <!-- <div class="col-md-4 col-sm-4 ">
                <label  class="control-label">Filter By Month </label>
                <?php  
                    echo form_dropdown('month_id', $months)
                ?>  
              </div> -->
                
            </div>
          </form>

      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;"> PR No </th>
              <th style="white-space: nowrap;"> Date Of Production </th>
              <th style="white-space: nowrap;"> Mill No </th>
              <th style="white-space: nowrap;"> Grade Name  </th>
              <th style="white-space: nowrap;"> Lot No  </th>
              <th style="white-space: nowrap;"> Batch No  </th>
              <th style="white-space: nowrap;"> No Of Bags </th>
              <th style="white-space: nowrap;"> Total Production (MT) </th>
              <th style="white-space: nowrap;"> Total Time (Hrs)</th>
              <th style="white-space: nowrap;"> Down Time (Hrs)</th>
              <th style="white-space: nowrap;"> Down Reason </th>             
              <th style="white-space: nowrap;"> Tailing Qty (Kg) </th>             
              <th style="white-space: nowrap;"> Tailing %  </th>             
              <th style="white-space: nowrap;"> Production/Hour </th>             
              <th style="white-space: nowrap;"> Unit/MT </th>             
              <th style="white-space: nowrap;"> Production By </th>
             <!--  <th style="white-space: nowrap;width: 20%;"> Action Button</th> -->
            </tr>
          </thead>
          <tbody>
           <?php
         
            $no_of_bags=0;
            $total_production=0;
            $machine_total_time=0;
            $total_machine_down_time=0;
            $total_tailing=0;
            $total_tailing_per=0;
            $i=1;foreach($pr_data as $obj){ 
            if(!empty($obj['production_details'])){ 
             
             
              $j=1;foreach($obj['production_details'] as $po_detail){
                $no_of_bags=$no_of_bags+$po_detail['no_of_bags'];
                $total_production=$total_production+$po_detail['production_in_mt'];
                $machine_total_time=$machine_total_time+$po_detail['machine_total_time'];
                $total_machine_down_time=$total_machine_down_time+$po_detail['machine_down_time'];
                $total_tailing=$total_tailing+$po_detail['tailing_qty'];
                $total_tailing_per=$total_tailing_per+$po_detail['tailing_per'];
            ?>
              <tr>
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
                            echo $inv_number1; 
                    ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['transaction_date'])); ?></td>
                <td><?php echo $obj['mill_no']; ?></td>
                <td><?= $po_detail['grade_name'].' ('.$po_detail['mineral_name'].', '.$po_detail['packing_size'].'Kg )' ;?></td>
                <td><?= $po_detail['lot_no'] ;?></td>
                <td><?= $po_detail['batch_no'] ;?></td>
                <td><?= $po_detail['no_of_bags'] ;?></td>
                <td><?= $po_detail['production_in_mt'] ;?></td>
                <td><?= $po_detail['machine_total_time'] ;?></td>
                <td><?= $po_detail['machine_down_time'] ;?></td>
                <td><?= $po_detail['down_reason'] ;?></td>
                <td><?= $po_detail['tailing_qty'] ;?></td>
                <td><?= $po_detail['tailing_per'] ;?></td>
                <td><?= $po_detail['per_hour_production'] ;?></td>
                <td><?= $po_detail['unit_per_mt'] ;?></td>
                <td><?php echo $obj['employee']; ?></td>               
                <!-- <td >
                   <a class="btn btn-xs btn-info btnEdit" data-toggle="modal" data-target="#view<?php echo $obj['id'];?>" title="View Details" ><i style="color:#fff;"class="fa fa-eye"></i></a>

                </td> -->
              </tr>
            <?php  $i++; }}} ?>
            <tr>
              <td colspan="7" style="text-align: right;"> <b> Grand Total </b></td>
              <td> <b> <?= $no_of_bags ?> </td>
              <td> <b><?= $total_production ?> MT</td>
              <td> <b><?= $machine_total_time ?> Hrs</td>
              <td> <b><?= $total_machine_down_time ?>Hrs </td>
              <td>  </td>
              <td> <b><?= $total_tailing ?> Kg </td>
              <td> <b><?= $total_tailing_per ?> % </td>
              <td colspan="3">  </td>
            </tr>
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
          url: "<?php echo base_url(); ?>index.php/Production_registers/deleteProduction",  
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