<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style type="text/css">
  .select2{
    height:45px !important;
    width: 100% !important;
  }
 

</style>
  <div class="container-fluid">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <div class="pull-right error_msg">
      <?php echo validation_errors();?>

      <?php if (isset($message_display)) {
      echo $message_display;
      } ?>
      <?php if (isset($error)) {
      echo $error;
      } ?>  
      <?php if (isset($success)) {
      echo $success;
      } ?>      
    </div>
        </div> <!-- /.card-body -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <?php  //echo $title; exit; ?>
              <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Area_cleaning_records/editrecord/<?= $id?>" enctype="multipart/form-data">
                
                  <div class="form-group">
                    <div class="row ">
                       <div class="col-md-4 col-sm-4">
                          <label class="control-label"> Date Of Cleaning</label>
                            <input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" value="<?php echo date('d-m-Y') ?>" placeholder="dd-mm-yyyy" required autofocus>
                        </div>
                         <div class="col-md-4 col-sm-4">
                          <label class="control-label"> ACR Number</label>
                           <input type="text" name="" class="form-control" value="<?= $acr_code_view ?>" autocomplete="off" autofocus  readonly="readonly">
                            <input type="hidden" name="voucher_code" value="<?= $acr_code_view ?>">
                        </div>
                    </div>
                     <div class="row ">
                        <div class="col-md-12 col-sm-12">
                           <div class="table-responsive">
                               <table id="maintable" class="table">
                                <thead style="background-color: #ca6b24;">
                                  <tr>
                                   <th > S.No.</th> 
                                    <th style="white-space: nowrap;"> Area Name </th>
                                    <th style="white-space: nowrap;"> Frequency</th>
                                    <th style="white-space: nowrap;"> Status Of Work</th>
                                    <th > Work By</th> 
                                    <th > Remarks</th> 
                                    <th > Action</th> 
                                  </tr>
                                </thead>
                                <tbody id="mainbody">
                                  <?php if ($area_cleaning_details): ?> 
                                    <?php foreach ($area_cleaning_details as $key=>$value) : ?>
                                      <tr class="main_tr1">
                                          <td> <?= $key+1?></td>
                                          <td> 
                                          <input type="hidden" name="area_id[]" value="<?= $value['area_id'] ?>">
                                          <label> 
                                            <?= $value['area_name'] ?></label>
                                        </td>
                                        <td>
                                           <input type="text"  name="frequency[]" class="form-control" value="<?= $value['frequency']?>"  required readonly style="width: 100px;" >
                                        </td> 
                                        <td>
                                            <select class="form-control" name="status_of_work[]" >
                                              <option <?php if($value['status_of_work']=='Pending'){ ?> selected <?php } ?>value="Pending" > Pending</option>
                                              <option <?php if($value['status_of_work']=='Completed'){ ?> selected <?php } ?>value="Completed" > Completed </option>
                                           </select>
                                        </td>
                                        <td>
                                            <?php  echo form_dropdown('worker_id[]', $workers,$value['worker_id'])
                                            ?>
                                        </td>
                                        <td>
                                          <textarea class="form-control remark" rows="3" placeholder="Enter Remark" name="remark[]" value="<?= $value['remark']?>" ><?= $value['remark']?></textarea>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
                                        </td>
                                      </tr>
                                    <?php endforeach; ?>
                                  <?php endif; ?>
                                 </tbody>
                                </table>
                               </div>
                            </div>
                        </div>
                      </div>
                   </div>
                 </div>
                   <div class="row col-md-12">
                      <div class="col-md-12 col-sm-12 ">
                        <label class="control-label" style="visibility: hidden;"> Name</label><br>
                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                      </div>
                  </div>
              
                  </form>
                </div>
         <!-- /form -->
        
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
  $( document ).ready(function() {
    //add_row();
    $('body').on('click','.addrow',function(){

      var table=$(this).closest('table');
      add_row();
       //rename_rows();
       calculate_total(table);
      });
    
    function add_row(){ 
      var tr1=$("#sample_table1 tbody tr").clone();
      $("#maintable tbody#mainbody").append(tr1);
    }
    $('body').on('click','.deleterow',function(){
      //alert();
    var table=$(this).closest('table');
    var rowCount = $("#maintable tbody tr.main_tr1").length;
    if (rowCount>1){
      if (confirm("Are you sure to remove row ?") == true) {
        $(this).closest("tr").remove();
        //rename_rows();
        //calculate_total(table);
      } 
    }
    }); 

  /*  function rename_rows(){
    var i=0;
    $("#maintable tbody tr.main_tr1").each(function(){ 
      $(this).find("td:nth-child(1)").html(++i);
      //$(this).find("td:nth-child(2) select.products").select2();
      //$(this).find("td:nth-child(4) select.units").select2();

    });
  }*/
    $(document).on('keyup','.no_of_bags,.production_in_mt',function(){
      var table=$(this).closest('table');
      calculate_total(table);

      });
    $(document).on('change','.packing_size',function(){
      var table=$(this).closest('table');
      calculate_total(table);

      });

     
    function calculate_total(table)
    {
      var packing_size=0;
      var no_of_bags=0;
      var production_in_mt=0;
      var kwh_opening=0;
      var kwh_closing=0;
      var kwh_consumed=0;
      var unit_per_mt=0;
      var total_production_in_mt=0;
    
      table.find("tbody tr.main_tr1").each(function()
      {
        //var qty,rate,total=0;
          /*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
        packing_size = $(this).find('td:nth-child(4) select.packing_size option:selected').val();
        no_of_bags=parseFloat($(this).find("td:nth-child(5) input.no_of_bags").val());
      
        //var qty=parseFloat($(this).find("td:nth-child(7) input.qty").val());
        //alert(no_of_bags);
        if(isNaN(packing_size))
        {
          packing_size =0;
        }
        if(isNaN(no_of_bags))
        {
          no_of_bags =0;
        }
        if(isNaN(production_in_mt))
        {
          production_in_mt =0;
        }
        
        if(isNaN(unit_per_mt))
        {
          unit_per_mt =0;
        }
        
        production_in_mt=packing_size*no_of_bags/1000;
        total_production_in_mt=total_production_in_mt+production_in_mt;
        $(this).find("td:nth-child(6) input.production_in_mt").val(production_in_mt.toFixed(4));
        production_in_mt=parseFloat($(this).find("td:nth-child(6) input.production_in_mt").val());

      });
      $('.total_production_in_mt').val(total_production_in_mt.toFixed(4));
      //alert(total_qty);
      /*table.find("tfoot tr input.total_qty").val(total_qty.toFixed(2));
      table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
      table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));*/


    }

  
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change','.vendor_code',function(){
        var customer_id = $('.vendor_code').find('option:selected').val();
        //alert(customer_id);
        if(customer_id!=''){
          $.ajax({
                    type: "POST",
                    url:"<?php echo base_url('index.php/Customers/getcustomerById/') ?>"+customer_id,
                    //data: {id:role_id},
                    dataType: 'html',
                    success: function (response) {
                      //alert(response);
                        $(".gst_no").html(response);
                        //$('.select2').select2();
                    }
                });
        }else{
          $(".clear_gst").val('');
        }
        

      }); 
  });
</script> 