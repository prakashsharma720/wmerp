<style>
    .control-label {
margin: 0.9rem
}
</style>

	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
               <h5> <a href="<?php echo base_url('index.php/Leave/leave_allotment'); ?>"><?= $this->lang->line('leave_module') ?></a></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_allotment') ?>
                </li>
            </ul>
        </div>
<div class="page-header-right ms-auto d-flex align-items-center">
      <!-- Placeholder for additional actions -->
      <?php $this->load->view('layout/alerts'); ?>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
          <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper hstack">
             <form method="post" action="<?php echo base_url(); ?>index.php/Leave/createXLS">
                            <?php if (!empty($filtered_value)) {
                                foreach ($filtered_value as $key => $value) { ?>
                                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>"> <?php }
                            } ?>
                            <button type="submit" class="btn btn-icon btn-light-brand"> 
                                    <i class="feather feather-download "></i> 
                            </button>
                        </form> &nbsp;
                        <div>
                           <a href="<?php echo base_url('index.php/Leave/create'); ?>" class="btn btn-icon btn-light-brand">
                                <i class="feather feather-plus"></i>
                                <!-- <span><?= $this->lang->line('apply_for_leave') ?>  -->
                                </span>
                            </a>
                        </div>
        </div>
            </div>

            <div class="page-header-right-items">
               
            </div>

            <!-- Mobile Toggle -->
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
                        
</div>
     <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-6">
                        <div class="col-md-12">
                            <label class="control-label"> <?= $this->lang->line('leave_allotment_month') ?></label>
                            <?php echo form_dropdown('month_id', $months,'','required="required"'); ?>
                        </div>
                        <br>
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
                                            <button type="button" class="btn btn-icon avatar-text avatar-md deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <br>
                            <div class="col-md-12" width="100%">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <b> <?= $this->lang->line('submit') ?></b>
                                </button>
                            </div>
                        </div>
                    </div>
                        <div class="col-lg-6">
<div class="table-responsive">
                            <table class="table table-bordered table-striped table table-hover" id="proposalList">

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
        </div>
    </div>
</div>

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