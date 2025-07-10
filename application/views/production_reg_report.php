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
       <div class="button-group float-right">
          <div class="pull-right error_msg">
            <form method="post" action="<?php echo base_url(); ?>index.php/Production_registers/createXLS">

              <?php 
              if(!empty($conditions)){
                foreach ($conditions as $key => $value) { ?>
                <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
              <?php } }?>
               <button type="submit" class="btn btn-info"> Export </button>
             </form>
             
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
              <th style="white-space: nowrap;"> Total Production (MT) </th>
              <th style="white-space: nowrap;"> Total MenPower </th>
             
              <!--  <th style="white-space: nowrap;"> LOT No </th>
              <th style="white-space: nowrap;"> Batch No </th>
              <th style="white-space: nowrap;"> No of Bags</th> -->
              <th style="white-space: nowrap;"> Production By </th>
              <!-- <th style="white-space: nowrap;width: 20%;"> Action Button</th> -->
            </tr>
          </thead>
          <tbody>
           <?php
           if(!empty($pr_data)){
              $i=1;foreach($pr_data as $obj){ 
            ?>
              <tr>
                <td><?php echo $i;?></td>
                <td>
                 <?php 
                         $inv_number=$obj['pr_number'];
                          if($inv_number<10){
                            $inv_number1='PR000'.$inv_number;
                            }
                            else if(($inv_number>=10) && ($inv_number<=99)){
                              $inv_number1='PR00'.$inv_number;
                            }
                            else if(($inv_number>=100) && ($inv_number<=999)){
                              $inv_number1='PR0'.$inv_number;
                            }
                            else{
                              $inv_number1='PR'.$inv_number;
                            }
                            echo $inv_number1; 
                    ?>
                </td>
                <td ><?php echo date('d-M-Y',strtotime($obj['date_of_production'])); ?></td>
                <td><?php echo $obj['mill_no']; ?></td>
                <td><?php echo $obj['total_production_in_mt']; ?></td>
                <td><?php echo $obj['total_workers']; ?></td>
                <td><?php echo $obj['employee']; ?></td>               
              </tr>
              <tr>
                 <th></th>
                  <th style="white-space: nowrap;"> Grade Name </th>
                  <th style="white-space: nowrap;"> No Of Bags</th>
                  <th style="white-space: nowrap;"> Packing Size</th>
                  <th style="white-space: nowrap;"> Prodution (MT)</th>
                  <th colspan="2" style="white-space: nowrap;"> KWH Consumed </th>
                </tr>
              </tr>
               <?php
                    $j=1;foreach($obj['production_details'] as $po_detail)
                    { ?>
                     <tr>
                      <td></td>
                      <td> <?= $po_detail['grade_name'].' ('.$po_detail['fg_code'].')' ;?> </td>
                      <td ><?= $po_detail['no_of_bags'] ?></td>
                      <td><?= $po_detail['packing_size'] ?></td>
                      <td><?= $po_detail['production_in_mt']?></td>
                      <td colspan="2"><?= $po_detail['kwh_consumed']?></td>
                    </tr>
              <?php } ?>
            <?php  $i++;} } else{ ?>
              <!-- <h3> No Data Found</h3> -->
            <?php } ?>
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