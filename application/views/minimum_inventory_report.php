<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//print_r($po_data);exit;
?>
    
<div class="container-fluid">
  <div class="card card-primary card-outline">
    <div class="card-header">
      <span class="card-title"><?php  echo $title; ?>
      </span>
       <div class="button-group float-right">

        
        
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th ><?=$this ->lang ->line('sr_no')?> </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('material_category')?>   </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('material_description')?>  </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('minimum_qty')?>  </th>
             <!--  <th style="white-space: nowrap;">Total Quantity </th> -->
              <th style="white-space: nowrap;">  <?=$this ->lang ->line('available_qty')?>  </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('status')?>  </th>
            </tr>
          </thead>
          <tbody>
           <?php
           $status='';
          $i=1;foreach($minimum_levels as $obj){ 
            $total_available= $obj['total_in']['total']-$obj['total_out']['total'];

            if($total_available <= $obj['minimum_qty']){ 
              $status='  Minimum Inventory Level Reached'; ?>
              <tr style="background-color: #295c90;color: white;">
              <td><?= $i ?></td>
              <td><?= $obj['category'] ?></td>
              <td><?= $obj['name'] ?></td>
              <td><?php echo $obj['minimum_qty'].' '.$obj['unit_name'] ?></td>
              <td><?php echo $total_available.' '.$obj['unit_name'] ?> </td>
              <td> <?= $status ?></td>
            </tr>
          <?php $i++; }} ?>
          
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