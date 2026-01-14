<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url=  base_url();
//print_r($base_url);exit;
?>
      <div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('fg_stock_report') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
       
      </ul>
    </div>
    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      

                        

    </div>
  </div>

      <div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
                <thead>
                  <tr>
              <th ><?=$this ->lang ->line('sr_no')?> .</th>
              <th style="white-space: nowrap;">  <?=$this ->lang ->line('finish_good')?>  </th>
              <th style="white-space: nowrap;"> <?=$this ->lang ->line('total_in_qty')?>  </th>
              <th style="white-space: nowrap;">  <?=$this ->lang ->line('total_out_qty')?>  </th>
              <th style="white-space: nowrap;">  <?=$this ->lang ->line('available_qty')?>  </th>
            </tr>
          </thead>
          <tbody>
          <?php
          $total_available=0;
          $i=1;foreach($FGStockReport as $obj){ 
            //print_r();exit;
            
            ?>
            <tr>
              <td><?= $i ?></td>              
              <!-- <td><?= date('d-M-Y',strtotime($obj['transaction_date'])) ?></td> -->
              <td><?= $obj['grade_name'] ?></td>
              <td>
                 <?php 
                if($obj['total_in']['total']!=''){
                  echo $obj['total_in']['total'].' MT';
                }else{
                  echo '-';
                }
                ?>
               </td>
              <td>
                <?php 
                if($obj['total_out']['total']!=''){
                  echo $obj['total_out']['total'].' MT';
                }else{
                  echo '-';
                }
                 ?></td>
              
              <td><?php
                $total_available= $obj['total_in']['total']-$obj['total_out']['total'];
                echo $total_available.' MT'?>
                  
                </td>
          <!--     <td><?= $obj['status'] ?></td>
              <td><?= $obj['employee'] ?></td>
              <td><?= $obj['department'] ?></td> -->
              
            </tr>
          <?php $i++;} ?>
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