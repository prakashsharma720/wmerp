

<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"> <?= $this->lang->line('current_stock_report') ?></h5>
      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('report') ?></li>
      </ul>
    </div>

<div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      <!-- Filter Button -->
      <button class="btn btn-icon avatar-text avatar-md" type="button" id="toggleFilter">
        <i class="feather feather-filter"></i> <?= $this->lang->line('filter') ?>
      </button>

      <form method="post" action="<?= base_url(); ?>index.php/Stock_registers/createXLS" class="d-inline-block">
        <?php if (!empty($conditions)) {
          foreach ($conditions as $key => $value) { ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php }} ?>
        <button type="submit" class="btn btn-icon avatar-text avatar-md"> <i class="feather feather-download "></i></button>
      </form>
      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">

        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
    
<!--
  

     <!-- Filter Form -->
  <div class="card mb-3" id="filterBox" style="display: none; position:relative;left:35px;right:35px;width:1553px;top:20px">
    <div class="card-body">
      <form method="get" id="filterForm">
        <div class="row">
          <div class="col-md-4">
            <label><?= $this->lang->line('from_date') ?></label>
            <input type="text" name="from_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
          </div>
          <div class="col-md-4">
            <label><?= $this->lang->line('upto_date') ?></label>
            <input type="text" name="upto_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off">
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" style="gap:5px" class="btn btn-primary mr-2 "><?= $this->lang->line('search') ?></button>
            <a href="<?= base_url(); ?>index.php/Stock_registers/report" class="btn btn-danger"><?= $this->lang->line('reset') ?></a>
          </div>
        </div>
      </form>
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
              <th ><?= $this->lang->line('sr_no') ?>.</th>
              <th style="white-space: nowrap;">  <?= $this->lang->line('material_description') ?> </th>
               <th style="white-space: nowrap;"> <?= $this->lang->line('date') ?></th>
              <th style="white-space: nowrap;">  <?= $this->lang->line('total_in_qty') ?> </th>
              <th style="white-space: nowrap;">  <?= $this->lang->line('total_out_qty') ?> </th>
              <th style="white-space: nowrap;"> <?= $this->lang->line('available_qty') ?> </th>
            </tr>
          </thead>
          <tbody>
          <?php
          $total_available=0;
          $i=1;foreach($stocks as $obj){ 
            //print_r();exit;
            
            ?>
            <tr>
              <td><?= $i ?></td>              
              <td><?= $obj['item'] ?></td>
              <td><?= date('d-M-Y',strtotime($obj['transaction_date'])) ?></td>
              
              <td>
                 <?php 
                if($obj['total_in']['total']!=''){
                  echo $obj['total_in']['total'].' '.$obj['unit'];
                }else{
                  echo '-';
                }
                ?>
               </td>
              <td>
                <?php 
                if($obj['total_out']['total']!=''){
                  echo $obj['total_out']['total'].' '.$obj['unit'];
                }else{
                  echo '-';
                }
                 ?></td>
              
              <td><?php
                $total_available= $obj['total_in']['total']-$obj['total_out']['total'];
                echo $total_available.' '.$obj['unit'] ?>
                  
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

<script>
  $(document).ready(function () {
    // Filter box show/hide
    $('#toggleFilter').click(function () {
      $('#filterBox').slideToggle(); // This toggles the filter card
    });

    // (Optional) Checkbox master toggle
    $('#master').on('click', function () {
      $('.sub_chk').prop('checked', this.checked);
    });

    // (Optional) Bulk delete
    $('.delete_all').on('click', function () {
      var allVals = $(".sub_chk:checked").map(function () {
        return $(this).val();
      }).get();

      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        if (confirm("Are you sure you want to delete all selected records?")) {
          $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>index.php/Requisition_slips/deleteRequisition",
            data: 'ids=' + allVals.join(","),
            success: function (response) {
              $(".successs_mesg").html(response);
              location.reload();
            }
          });
        }
      }
    });
  });
</script>

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