<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <h3 class="card-title"><?= $page_title ?></h3>
        <div class="pull-right ">
			    <!-- <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span> -->
			</div>
	      </div> <!-- /.card-body -->
	      	<div class="card-body">
		      	<div class="row col-md-12">
								<div class="table-responsive">
									<table  class="table table-bordered table-striped">
										<thead>
											<tr>
												<th> Sr.No. </th>
												<th> Employee </th>
												<th> Leave Taken / Alloted</th>
				                <th> Religious Leave (2 Per Year) </th>
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
