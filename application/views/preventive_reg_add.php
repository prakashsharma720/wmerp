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
              <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Preventive_registers/add_new_record" enctype="multipart/form-data">
                
                  <div class="form-group">
                    <div class="row ">
                       <div class="col-md-4 col-sm-4 ">
                          <label  class="control-label"> Plant Name <span class="required">*</span></label>
                           <?php  echo form_dropdown('plant_id', $areas, '', 'required="required"')
                          ?>
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                          <label class="control-label"> Frequency <span class="required">*</span></label>
                            <input type="text"  placeholder="Enter Frequency" name="frequency" class="form-control " value="Monthly"  required autofocus>
                        </div>
                       <div class="col-md-4 col-sm-4">
                          <label class="control-label"> Date Of Maintenance</label>
                            <input type="text" data-date-formate="dd-mm-yyyy" name="date_of_maintenance" class="form-control date-picker" value="<?php echo date('d-m-Y') ?>" placeholder="dd-mm-yyyy" required autofocus>
                        </div>
                       
                        
                       <div class="col-md-4 col-sm-4">
                          <label class="control-label"> Date Of Next Maintenance</label>
                            <input type="text" data-date-formate="dd-mm-yyyy" name="next_maintenance_date" class="form-control date-picker" value="<?php echo date('d-m-Y') ?>" placeholder="dd-mm-yyyy" required autofocus>
                        </div>
                        <div class="col-md-4 col-sm-4 ">
                            <label class="control-label">Status Of Work</label>
                             <select class="form-control" name="status_of_work" >
                                <option value="Pending" > Pending</option>
                                <option value="Completed" > Completed </option>
                             </select>
                          </div>
                        <!-- <div class="col-md-4 col-sm-4 ">
                            <label  class="control-label"> Worker Name <span class="required">*</span></label>
                             <?php  //echo form_dropdown('worker_id', $workers, '', 'required="required"')
                            ?>
                        </div>  -->
                        <!-- <div class="col-md-4 col-sm-4 ">
                          <label class="control-label"> Job Order No <span class="required">*</span></label>
                            <input type="text"  name="job_order_no" class="form-control" value="<?= $job_order_code_view?>"  autofocus readonly="readonly">
                            <input type="hidden" name="voucher_code" value="<?php echo $joborder_code;?>" required>
                        </div> -->
                        <div class="col-md-4 col-sm-4 ">
                          <label class="control-label"> Remark </label>
                           <textarea class="form-control remark" rows="3" placeholder="Enter Remark" name="remark" value="" ></textarea>
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
    function readURL(input) {

      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#blah').removeClass('hide');
          $('#blah').addClass('show');
          $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $(".upload").change(function() {
      var file = this.files[0];
      var fileType = file["type"];
      var size = parseInt(file["size"]/1024);
      //alert(size);
      var validImageTypes = ["image/jpeg", "image/png"];
      if ($.inArray(fileType, validImageTypes) < 0) 
      {
          alert('Invalid file type , please select jpg/png file only !');
          $(this).val(''); 
      }
      if (size > 5000) 
      {
          alert('Image size exceed , please select < 5MB file only !');
          $(this).val(''); 
      }

      readURL(this);
    });
  });
</script>