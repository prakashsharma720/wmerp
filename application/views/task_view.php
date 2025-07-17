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
            <span class="card-title"> <?= $this->lang->line('task_history') ?>
            </span>
            <div class="pull-right d-flex" style="margin-left:5px;">
                <button class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="location.reload();"><i
                        class="fa fa-refresh"></i></button>
                <button class="btn btn-danger delete_all" data-toggle="tooltip" title="Bulk Delete"><i
                        class="fa fa-trash"></i></button>
                <a class="btn btn-xs btn-primary " href="<?php echo base_url(); ?>index.php/Dailytasks/task_add">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div> <!-- /.card-body -->
        
        <div class="card-body">

            <form method="get" id="filterForm">
                <div class="row">

                    <div class="col-md-4 col-sm-4 ">
                        <label class="control-label"><?= $this->lang->line('search_by_project') ?></label>
                        <?php  echo form_dropdown('project_id', $projects,'required="required"') ?>
                    </div>
                   
                    <div class="col-md-4 col-sm-4 ">
                        
                        <label class="control-label"><?= $this->lang->line('search_by_employee_name') ?> </label>
                      <select name="employee_id" class="form-control select2">
    <option value=""><?= $this->lang->line('search_by_employee_name') ?></option>
    <?php if ($name): ?>
        <?php foreach ($name as $value) : ?>
            <?php $selected = ($value['id'] == $selectedEmployeeId) ? 'selected' : ''; ?>
            <option value="<?= $value['id'] ?>" <?= $selected ?>><?= $value['name'] ?></option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">No result</option>
    <?php endif; ?>
</select>




                        <!--<select name="employee_id" class="form-control select2 ">-->
                            
                        <!--    <option value="">Select Employee Name</option>-->
                           
                        <!--    <?php if ($name): ?>-->
                        <!--    <?php foreach ($name as $value) : ?>-->
                            
                        <!--    <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>-->
                            
                        <!--    <?php   endforeach;  ?>-->
                        <!--    <?php else: ?>-->
                        <!--    <option value="">No result</option>-->
                        <!--    <?php endif; ?>-->
                        <!--</select>-->
                    </div>
                    
                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"><?= $this->lang->line('search_by_status') ?> </label>
                        <select name="task_status" class="form-control select2">
                            <option value=""><?= $this->lang->line('search_by_status') ?></option>
                            <option value="In Process"> In Process</option>
                            <option value="On Hold"> On Hold</option>
                            <option value="Completed"> Completed</option>
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"> <?= $this->lang->line('from_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="from_date"
                            class="form-control date-picker" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>" autocomplete="off"
                            autocomplete="off">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <label class="control-label"> <?= $this->lang->line('upto_date') ?></label>
                        <input type="text" data-date-formate="dd-mm-yyyy" name="upto_date"
                            class="form-control date-picker" value="" placeholder="<?= $this->lang->line('dd_mm_yyyy') ?>" autocomplete="off"
                            autocomplete="off">
                    </div>
                    <div class="col-md-1 col-sm-1 ">
                        <label class="control-label" style="visibility: hidden;"> Grade</label>
                        <input type="submit" class="btn btn-xs btn-primary" value="Search" />
                    </div>
                    <div class="col-md-1 col-sm-1 ">
                        <label class="control-label" style="visibility: hidden;"> Grade</label>
                        <a href="<?php echo $data[0]?>" class="btn btn-danger"> <?= $this->lang->line('reset') ?></a>
                    </div>
                </div>
            </form>
            <hr>


            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="master"></th>
                            <th> <?= $this->lang->line('project') ?></th>
                            <th>  <?= $this->lang->line('task_title') ?></th>
                            <th> <?= $this->lang->line('start_date') ?></th>
                            <th> <?= $this->lang->line('end_date') ?></th>
                            <th><?= $this->lang->line('priority') ?></th>
                            <th> <?= $this->lang->line('status') ?></th>
                            <th> <?= $this->lang->line('assign_to') ?></th>
                            <th> <?= $this->lang->line('assign_by') ?> </th>
                            <th> <?= $this->lang->line('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
           if(!empty($daily_tasks)) { 
            $i=1;foreach($daily_tasks as $obj) { ?>
                        <tr>
                            <td><input type="checkbox" class="sub_chk" value="<?php echo $obj['id']; ?>" /></td>
                            <td><?= $i ?></td>
                            <td><?= $obj['task_name']?></td>
                            <td><?= $obj['start_date']?></td>
                            <td><?= $obj['end_date']?></td>
                            <td><?= $obj['priority']?></td>
                            <td><?= $obj['status']?></td>
                            <td><?= $obj['employee_name']?></td>
                            <td><?= $obj['assign_by']?></td>
                            <!--  -->


                            <td>
                                <?php 
										if($designation_id=='4'||$designation_id=='1' ) {
                        if( $obj['status']=='In Process'){
                    ?>
                                <a class="btn btn-xs btn-primary btnEdit"
                                    href="<?php echo base_url(); ?>index.php/Dailytasks/edit/<?php echo $obj['id'];?>"><i
                                        class="fa fa-edit"></i></a>
                                <a class="btn btn-xs btn-danger btnEdit" data-toggle="modal"
                                    data-target="#delete<?php echo $obj['id'];?>"><i style="color:#fff;"
                                        class="fa fa-trash"></i> </a>
                                <?php } }?>

                                <a class="btn btn-xs btn-success btnEdit"
                                    href="<?php echo base_url(); ?>index.php/Dailytasks/task_history/<?php echo $obj['id'];?>"><i
                                        class="fa fa-envelope"></i></a>
                            </td>


                            <div class="modal fade" id="delete<?php echo $obj['id'];?>" role="dialog">
                                <div class="modal-dialog">
                                    <form class="form-horizontal" role="form" method="post"
                                        action="<?php echo base_url(); ?>index.php/Dailytasks/deleteItem/<?php echo $obj['id'];?>">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Confirm Header </h4>
                                                <button type="button" class="close"
                                                    data-dismiss="modal">&times;</button>

                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure, you want to delete tasks
                                                    <b><?php echo $obj['task_name'];?> </b>? </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary delete_submit"> Yes
                                                </button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal"> No
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </tr>
                        <?php  $i++;} }else{ ?>
                        <tr>
                            <td colspan="100">
                                <h5 style="text-align: center;"> No task Found</h5>
                            </td>
                        </tr>
                        <?php  }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $(".content").hide();
    $(".show_hide").on("click", function() {
        var txt = $(".content").is(':visible') ? 'Read More' : 'Read Less';
        $(".show_hide").text(txt);
        $(this).next('.content').slideToggle(200);
    });
});
</script>
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

    jQuery('#master').on('click', function(e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });
    jQuery('.delete_all').on('click', function(e) {
        var allVals = [];
        $(".sub_chk:checked").each(function() {
            allVals.push($(this).val());
        });
        //alert(allVals.length); return false;
        if (allVals.length <= 0) {
            alert("Please select row.");
        } else {
            WRN_PROFILE_DELETE = "Are you sure you want to delete all selected issue?";
            var check = confirm(WRN_PROFILE_DELETE);
            if (check == true) {
                var join_selected_values = allVals.join(",");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>index.php/Dailytasks/deleteItem",
                    cache: false,
                    data: 'ids=' + join_selected_values,
                    success: function(response) {
                        $(".successs_mesg").html(response);
                        location.reload();
                    }
                });

            }
        }
    });

});
</script>