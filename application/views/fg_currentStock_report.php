<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$base_url=  base_url();
//print_r($base_url);exit;
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
        	<form method="post" action="<?php echo base_url(); ?>index.php/Stock_registers/FgCurrentStockCreateXLS">
				<?php 
		          if(!empty($conditions)){
		            foreach ($conditions as $key => $value) { ?>
		            <input type="hidden" name="<?= $key ?>" value="<?=$value ?>">
	          	<?php } }?>
	           <button type="submit" class="btn btn-info"> Export </button>
	         </form>  
	     </div>
       <form method="get" id="filterForm">

                <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <label  class="control-label"> From Date</label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                  </div>
                  <div class="col-md-4 col-sm-4">
                    <label  class="control-label"> Upto Date</label>
                      <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date" class="form-control date-picker" value="" placeholder="dd-mm-yyyy" autofocus autocomplete="off" autocomplete="off">
                </div>
                 <div class="col-md-4 col-sm-4 ">
                   <label  class="control-label" style="visibility: hidden;"> Grade</label><br>
                  <input type="submit" class="btn btn-primary" value="Search" /> 
                  <!-- <label  class="control-label" style="visibility: hidden;"> Grade</label> -->
                  <a href="<?php echo base_url(); ?>index.php/Stock_registers/report" class="btn btn-danger" > Reset</a>
              </div>
          </div>
        </form>
    </div> <!-- /.card-body -->
    <div class="card-body">
      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th >Sr.No.</th>
              <th style="white-space: nowrap;">  Finish Good </th>
              <th style="white-space: nowrap;">  Date </th>
              <th style="white-space: nowrap;">  Total In Qty (Unit)</th>
              <th style="white-space: nowrap;">  Total Out Qty (Unit)</th>
              <th style="white-space: nowrap;">  Available Qty (Unit)</th>
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
              
              <td><?= $obj['grade_name'] ?></td>
               <td><?= date('d-M-Y',strtotime($obj['transaction_date'])) ?></td>
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