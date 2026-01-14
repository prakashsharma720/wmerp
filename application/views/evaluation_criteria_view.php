<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('evaluation_criteria_master') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('evaluation_criteria_master') ?>
				</li>
			</ul>
		</div>

		<div class="page-header-right ms-auto">
			<div class="page-header-right-items">
				<?php $this->load->view('layout/alerts'); ?>
			</div>

			<!-- Mobile Toggle -->
			<div class="d-md-none d-flex align-items-center">
				<a href="javascript:void(0)" class="page-header-right-open-toggle">
					<i class="feather-align-right fs-20"></i>
				</a>
			</div>
		</div>
	</div>




	<div class="main-content">
		<div class="card card-primary card-outline">
			<div class="card-body">
				<div class="row">


					<!-- <div class="col-md-4"> -->


					<?php
					defined('BASEPATH') or exit('No direct script access allowed');
					?>



					<div class="col-md-4 ">
						<?php  //echo $title; exit; 
						?>
						<?php if (!empty($id)) { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_criteria/editEC/<?= $id ?>">
								<input type="hidden" name="ec_id" value="<?= $id ?>">
							<?php } else { ?>
								<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Evaluation_criteria/add_new_EC">
								<?php } ?>
								<div class="form-group">
									<div class="row col-md-12">
										<?php
										$supplier = '';
										$service_provider = '';
										$transporter = '';

										if (!empty($ec_type)) {
											if ($ec_type == 'Supplier') {
												$supplier = 'checked';
											} elseif ($ec_type == 'Service Provider') {
												$service_provider = 'checked';
											} elseif ($category_type == 'Transporter') {
												$transporter = 'checked';
											}
										} else {
											$supplier = 'checked';
										}
										?>
										<div class="col-md-12 col-sm-12 mb-3">
    <label class="fw-bold text-dark d-block mb-2">
        <?= $this->lang->line('criteria_type') ?>
    </label>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ec_type" value="Supplier" <?= $supplier; ?>>
        <label class="form-check-label"><?= $this->lang->line('supplier') ?></label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ec_type" value="Service Provider" <?= $service_provider; ?>>
        <label class="form-check-label"><?= $this->lang->line('service_provider') ?></label>
    </div>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ec_type" value="Transporter" <?= $transporter; ?>>
        <label class="form-check-label"><?= $this->lang->line('transporter') ?></label>
    </div>
</div>

									</div>
									<div class="row col-md-12">
										<div class="col-md-12 col-sm-12 ">
											<label class="control-label"> <?= $this->lang->line('criteria_name') ?></label>
											<input type="textarea" size="30" placeholder="<?= $this->lang->line('enter_criteria_name') ?>" name="ec_name" class="form-control" value="<?= $ec_name ?>" required autofocus>
										</div>
									</div>
									<span class="help-block"></span>
									<?php if (!empty($id)) { ?>
										<div class="row col-md-12">
											<div class="col-md-12 col-sm-12 ">
												<label class="control-label"><?= $this->lang->line('status') ?></label>
												<select class="form-control" name="flag">
													<option value="0"> <?= $this->lang->line('active') ?></option>
													<option value="1"><?= $this->lang->line('de_active') ?></option>
												</select>
											</div>
										</div>
									<?php } ?>
									<div class="row col-md-12">
										<div class="col-md-12 col-sm-12	 ">
											<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
											<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
										</div>
									</div>
								</div>
								</form>
					</div>
					<!-- /form -->
					<div class="col-md-8">
						<h5> <?= $this->lang->line('criteria_list') ?></h5>
						<!-- <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr> -->
						<div class="main-content ">
							<div class="card card-primary card-outline">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="table-responsive">
												<table class="table table-hover table-bordered table-striped" id="proposalList">
													<thead>
														<tr>
															<th> <?= $this->lang->line('sr_no') ?>.</th>
															<th><?= $this->lang->line('criteria') ?></th>
															<th><?= $this->lang->line('criteria_type') ?></th>
															<th> <?= $this->lang->line('action') ?></th>
														</tr>
													</thead>
													<tbody>
														<?php $i = 1;
														foreach ($evaluation_criteria as $ec) { ?>
															<tr>
																<td><?= $i ?></td>
																<td><?= $ec['ec_name'] ?></td>
																<td>
																	<?= $ec['ec_type'] ?>
																</td>
																<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Evaluation_criteria/index/<?php echo $ec['id']; ?>"><i class="feather feather-edit-3"></i></a></td>
															</tr>
														<?php $i++;
														} ?>
													</tbody>

												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>