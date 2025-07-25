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
	  
<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('leave_module') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('leave_balance') ?>
                </li>
            </ul>
        </div>

            <!-- Mobile Toggle -->
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
		 <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                    <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                           			 <table class="table table-bordered table-striped table table-hover" id="proposalList">
										<thead>
											<tr>
												<th> <?= $this->lang->line('sr_no') ?></th>
												<th> <?= $this->lang->line('employee') ?> </th>
												<th> <?= $this->lang->line('leave_taken_alloted') ?></th>
				                <th><?= $this->lang->line('religious_leave') ?> </th>
											</tr>
										</thead>
										<tbody>
											<?php $i=1;foreach($leave_taken as $leave) { ?>
											<tr>
												<td><?= $i ?></td>

												<td>
													<?= $leave['name']?>
												</td>
										<!-- 		<td>
														<?php 
														if(!empty($leave['total_alloted'])) {
															echo $leave['total_alloted'];
														} else {
															echo "0.00";
														}
													?>
												</td> -->
												<td>
													<?php 
														if(!empty($leave['paid_leaves'])) {
															echo $leave['paid_leaves']." / ". $leave['total_alloted'];
														} else {
															echo "0.00"." / ". $leave['total_alloted'];
														}
													?>
												</td>

												<td>
													<?php 
														if(!empty($leave['religius_leave'])) {
															echo $leave['religius_leave']. "/ 2";
														} else {
															echo "0.00 ". "/ 2";
														}
													?>
												</td>

											</tr>
										<?php $i++;} ?>
										</tbody>
								</table>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>