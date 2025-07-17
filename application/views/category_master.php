<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<?php if ($this->session->flashdata('success')): ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> <?= $this->lang->line('success') ?>!</h5>
		<?php echo $this->session->flashdata('success'); ?>
	</div>
	<!-- <span class="successs_mesg"><?php echo $this->session->flashdata('success'); ?></span> -->
<?php endif; ?>

<?php if ($this->session->flashdata('failed')): ?>
	<div class="alert alert-error alert-dismissible ">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h5><i class="icon fa fa-check"></i> <?= $this->lang->line('alert') ?>!</h5>
		<?php echo $this->session->flashdata('failed'); ?>
	</div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<!-- <h3 class="card-title"><?= $title ?></h3> -->
			<h3><?= $this->lang->line('lead_services_master'); ?></h3>

			<div class="pull-right ">


				<!-- <span class="error_mesg"><?php echo $this->session->flashdata('failed'); ?></span> -->
			</div>
		</div> <!-- /.card-body -->
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<?php  //echo $title; exit; 
					?>
					<?php if (!empty($id)) { ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Category/editCategory/<?= $id ?>">
							<input type="hidden" name="category_id" value="<?= $id ?>">
						<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Category/add_new_category">
							<?php } ?>
							<div class="form-group">
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<label class="control-label"><?= $this->lang->line('service_name') ?></label>
										<input type="text" placeholder="<?= $this->lang->line('enter_service_name') ?>" name="category_name" class="form-control" value="<?= $category_name ?>" required autofocus>
									</div>
								</div>
								<span class="help-block"></span>
								<?php if (!empty($id)) { ?>
									<div class="row col-md-12">
										<div class="col-md-12 col-sm-12 ">
											<label class="control-label"><?= $this->lang->line('status') ?></label>
											<select class="form-control" name="flag">
												<option value="0"><?= $this->lang->line('active') ?></option>
												<option value="1"><?= $this->lang->line('de_active') ?></option>
											</select>
										</div>
									</div>
								<?php } ?>
								<div class="row col-md-12">
									<div class="col-md-12 col-sm-12 ">
										<label class="control-label" style="visibility: hidden;"><?= $this->lang->line('name') ?></label><br>
										<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
									</div>
								</div>
							</div>
							</form>
				</div>
				<!-- /form -->
				<div class="col-md-6">
					<h5><?= $this->lang->line('services_list') ?></h5>
					<table id="example" class="table table-bordered table-striped" style="width:100%;">
						<thead>
							<tr>
								<th> <?= $this->lang->line('sr_no') ?>.</th>
								<th style="width: 90%;"><?= $this->lang->line('services') ?></th>

								<th> <?= $this->lang->line('action') ?></th>

							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($categories as $category) { ?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $category['category_name'] ?></td>

									<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Category/index/<?php echo $category['id']; ?>"><i class="fa fa-edit"></i></a></td>

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