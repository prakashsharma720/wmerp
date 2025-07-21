<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .control-label {
margin: 0.7rem
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
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Leave/add_leave_allotment">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                    <h3 class="card-title"> <?= $this->lang->line('leave_allotment') ?></h3>
                    <div class="pull-right error_msg">
                        <?php echo validation_errors();?>
                        <?php if (isset($message_display)) {
                        echo $message_display;
                        } ?>		
                    </div>
            </div>
            <!-- closed card-header -->
            <!-- card-body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">                            
                        <div class="col-md-12">
                            <label class="control-label"> <?= $this->lang->line('leave_allotment_month') ?></label>
                            <?php echo form_dropdown('month_id', $months,'','required="required"'); ?>
                        </div>
                        <div class="table-responsive">
                            <table width="100%"  class="table table-bordered table-striped" id="sample_table1">
                                <thead width="100%">
                                    <tr width="100%">
                                        <th width="80%">  <?= $this->lang->line('employee') ?> </th>
                                        <th width="20%">  <?= $this->lang->line('leave_count') ?> </th>
                                        <th width="10%">  <?= $this->lang->line('action') ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;foreach($employees as $obj) { ?>
                                    <tr class="main_tr1">
                                        <td>
                                            <?php echo $obj['name']; ?>
                                            <input type="hidden" name="emp_id[]" value="<?php echo $obj['id']; ?>" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <input type="text" name="leave_count[]" value="2" class="form-control" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="avatar-text avatar-md deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="col-md-12" width="100%">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <b> <?= $this->lang->line('submit') ?></b>
                                </button>
                            </div>
                        </div>
                        <!-- table-responsive -->
                    </div>
                    <div class="col-md-8">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped"  width="100%">
                                <thead>
                                    <tr>
                                        <th> <?= $this->lang->line('employee') ?></th>
                                        <th> <?= $this->lang->line('count') ?></th>
                                        <th> <?= $this->lang->line('month') ?></th>
                                        <th> <?= $this->lang->line('year') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($leaves)) { $i=1;foreach($leaves as $obj) { ?>
                                    <tr>
                                        <td><?= $obj['emp_name']?></td>
                                        <td><?= $obj['leave_count']?></td>
                                        <td><?= $obj['leave_month']?></td>
                                        <td><?= $obj['leave_year']?></td>
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div> <!-- card-body closed -->
        </div> <!-- card-outline closed -->
    </div> <!-- container-fluid -->
</form>

<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $('body').on('click','.deleterow',function(){
        var table=$(this).closest('table');
        var rowCount = $("#sample_table1 tbody tr.main_tr1").length;
        // alert(rowCount);
        if (rowCount>1){
            if (confirm("Are you sure to remove row ?") == true) {
                $(this).closest("tr").remove();
                // rename_rows();
                // calculate_total(table);
            } 
        }
      });
    });

</script>