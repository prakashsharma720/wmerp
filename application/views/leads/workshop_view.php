<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$current_page=current_url();
//$current_page='https://www.muskowl.com/chaudhary_minerals/index.php/Meenus/UserRights';
$data=explode('?', $current_page);
//print_r($data[0]);exit;
?>
<style type="text/css">
  .col-md-6{
    float: left;
  }
</style>


  <?php if($this->session->flashdata('success')): ?>
         <div class="alert alert-success alert-dismissible" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fa fa-check"></i> Success!</h5>
                 <?php echo $this->session->flashdata('success'); ?>
               </div>
           <!--<span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
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
       <div class="pull-right">
        <!--  <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Leads/add">
          <i class="fa fa-plus"></i> Create New Lead</a> -->
      </div>
    </div> <!-- /.card-body -->
    <div class="card-body">
         <form method="get" action="<?php echo base_url(); ?>index.php/Leads/worshop_leads" id="filter_hide">
        <div class="row">
             
            
                       
                   
               

                <div class="col-md-4 col-sm-4">
                  <label  class="control-label">Search By Status </label>
                  <select name="booking_status" class="form-control select2" >
                     <option value="">Select Status</option>
                            <option value="pending" > Pending </option>
                            <option value="Resolved" > Resolved </option>
                          
                    </select>
                </div>

             

                 
                  <div class="col-md-4 col-sm-4">
                     <label  class="control-label">Search By Category</label>
                    <select name="workshop_name" class="form-control select2 suppliers" >
                    <option value=""> Select Category</option>
                    <?php if (!empty($workshopnames) && is_array($workshopnames)): ?> 
                        <?php foreach ($workshopnames as $value): ?>
                            <?php if (isset($value['workshop_name'])): ?>
                                <option value="<?= htmlspecialchars($value['workshop_name']) ?>" <?= isset($filtered_value['workshop_name']) && $value['workshop_name'] == $filtered_value['workshop_name'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($value['workshop_name']) ?>
                                </option>
                            <?php else: ?>
                                <option value="">Invalid Data</option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No result</option>
                    <?php endif; ?>
                      </select>

                </div>
                <div class="col-md-1 col-sm-1 ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label>
                      <input type="submit" class="btn btn-xs btn-primary" value="Search" />
                  </div>
                  <div class="col-md-1 col-sm-1 ">
                      <label  class="control-label" style="visibility: hidden;"> Grade</label>
                      <a href="<?php echo $data[0]?>" class="btn btn-danger" > Reset</a>
                  </div>
                
                <div class="col-md-1 col-sm-1 text-right">
                   <label  class="control-label" style="visibility: hidden;"> Grade</label>
                     <button class="btn btn-warning delete_all"  data-toggle="tooltip" title="Bulk Delete" ><i class="fa fa-envelope"></i></button>
                </div>
                </div>
        </form>
        <hr>


      <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
           <tr>
               	<th><input type="checkbox" id="master"></th>
                <th > Sr.No.</th>
                <th> Ticket No</th>
                <th> Name</th>
                <th> Email</th>
                 <th> Phone No.</th>
                <th> Category</th>
                <th> Order Id</th>
                <th> Picture</th>
                  <th> Booking Status</th>
                <th > Action</th>
              </tr>
          </thead>
          <tbody>
               

           <?php
           if(!empty($leads)) { 
            $i=1;foreach($leads as $obj) { ?>
             <?php 
                                  if ($obj['booking_status'] == 'pending') {
                        $btn_class = 'btn-inprocess';
                    } else if ($obj['booking_status'] == 'Resolved') {
                        $btn_class = 'btn-converted';
                    }
                    ?>
              <tr>
                  <td><input type="checkbox" class="sub_chk"  name="sub_chk[]" value="<?php echo $obj['id']; ?>" /></td>
                <td><?= $i ?></td>
             
             
                <td><?= $obj['reference_id']?></td>
                 <td><?= $obj['your_name']?></td>
                 <td><?= $obj['your_email']?></td>
                 <td><?= $obj['your_number']?></td>
                 <td><?= $obj['workshop_name']?></td>
                 <td><?= $obj['your_reference']?></td> 
                                <td><button class="btn btn-sm <?php echo $btn_class;?>" style="pointer-events: none;"><?= $obj['booking_status']?></button></td>
               
                 <td><a href="<?= get_avatar_url($obj['your_screenshot']) ?>" download="download"><img src="<?= get_avatar_url($obj['your_screenshot']) ?>" width="30%"></a></td>
               
                <td >
                  <a class="btn btn-xs btn-success btnEdit" data-toggle="modal" data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"class="fa fa-edit"></i> </a>
                
                </td>
                    <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                      <div class="modal-dialog">
                        <form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leads/edit_worshop/<?php echo $obj['id'];?>">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                             <h4 class="modal-title">Booking Status</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                           
                          </div>
                          <div class="modal-body">
                          <label>Change Status</label>
                         <select class="form-control" name="booking_status">
                        <option value="pending" <?php echo ($obj['booking_status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                        <option value="Approve" <?php echo ($obj['booking_status'] == 'Approve') ? 'selected' : ''; ?>>Approve</option>
                    </select>

                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary delete_submit"> Submit </button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> No </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    
              </tr>
            <?php  $i++;} }else{ ?>
              <tr>
                <td colspan="100"> <h5 style="text-align: center;"> No Leads Found</h5></td>
              </tr>
           <?php  }?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';

   

    // Master checkbox check/uncheck
    $('#master').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });

    // Bulk delete/mail event
    $(document).on('click', '.delete_all', function(e) {
        e.preventDefault();  // Prevent form submission
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).val());
        });

        if (allVals.length <= 0) {
            alert("Please select a row.");
        } else {
            var check = confirm("Are you sure you want to mail the selected records?");
            if (check == true) {
                var join_selected_values = allVals.join(",");
                alert(join_selected_values);
                $.ajax({
                    type: "POST",
                   
                      url: "<?php echo base_url(); ?>index.php/Leads/mailtoAll",  
                    data: { ids: join_selected_values },
                    success: function(response) {
                        // console.log('vikas'+response);
                        $(".successs_mesg").html(response);
                        // location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error: " + status + ": " + error);
                    }
                });
            }
        }
    });
});

</script> 