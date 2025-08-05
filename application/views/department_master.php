<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('department_master') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('view_list') ?>
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
			<div class="col-md-4 bg-white">
				<?php  //echo $title; exit; 
				?>
				<?php if (!empty($id)) { ?>
					<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Department/editdepartment/<?= $id ?>">
						<input type="hidden" name="category_id" value="<?= $id ?>">
					<?php } else { ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Department/add_new_department">
						<?php } ?>
						<div class="form-group">
							<div class="row col-md-12 mt-2">
								<div class="col-md-12 col-sm-12 ">
									<label class="control-label"><?= $this->lang->line('department_name') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_department_name') ?>" name="department_name" class="form-control" value="<?= $department_name ?>" required autofocus>
								</div>
							</div>
							<br>
							<div class="row col-md-12 mt-2">
								<div class="col-md-12 col-sm-12 ">
									<label class="control-label"><?= $this->lang->line('department_code') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_department_code') ?>" name="department_code" class="form-control" value="<?= $department_code ?>" required autofocus>
								</div>
							</div>
							<span class="help-block"></span>
							<?php if (!empty($id)) { ?>
								<div class="row col-md-12 mt-2">
									<div class="col-md-12 col-sm-12 ">
										<label class="control-label"><?= $this->lang->line('status') ?></label>
										<select class="form-control" name="flag">
											<option value="0"> <?= $this->lang->line('active') ?></option>
											<option value="1"><?= $this->lang->line('de_active') ?></option>
										</select>
									</div>
								</div>
							<?php } ?>
							<div class="row col-md-12 mt-2">
								<div class="col-md-12 col-sm-12 ">
									<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
									<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
								</div>
							</div>
						</div>
						</form>
			</div>
			<!-- /form -->
			 
				
			<div class="col-md-8">
				<h5> <?= $this->lang->line('department_list') ?></h5>
				<div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
							<tr>
								<th> <?= $this->lang->line('sr_no') ?>.</th>
								<th> <?= $this->lang->line('department') ?></th>
								<th> <?= $this->lang->line('action') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($departments as $department) { ?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $department['department_name'] . ' (' . $department['department_code'] . ')' ?></td>
									<td> <a class="btn btn-icon avatar-text avatar-md" href="<?php echo base_url(); ?>index.php/Department/index/<?php echo $department['id']; ?>"><i class="feather feather-edit-3"></i></a></td>
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