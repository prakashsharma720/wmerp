<style>
    .table td, .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }
</style>

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('building_material') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
						<?= $this->lang->line('home') ?>
					</a>

				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('building_material_master') ?>
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
			<!-- Left Form -->
			<div class="col-md-4">
				<?php if (!empty($id)) { ?>
					<form class="form-horizontal" method="post" action="<?= base_url('index.php/Building_materials/editPM/' . $id) ?>">
						<input type="hidden" name="pm_id" value="<?= $id ?>">
				<?php } else { ?>
					<form class="form-horizontal" method="post" action="<?= base_url('index.php/Building_materials/add_newPM') ?>">
				<?php } ?>

					<div class="form-group ">
						<div style="border: 1px solid #ccc; padding: 8px; margin-bottom: 10px; display: inline-block;">
    <strong> <?= $this->lang->line('new_material_code') ?> :   </strong>
    <label class="control-label"><?= $bm_code_view ?> </label>
								</div>
						
						<input type="hidden" name="code" value="<?= $bm_code_view ?>">
					</div>

					<?php if ($categories): ?>
						<?php foreach ($categories as $value): ?>
							<?php if ($value['id'] == $categories_id): ?>
								<input type="hidden" name="categories_id" value="<?= $value['id'] ?>">
								<div class="form-group">
									<label class="control-label"><?= $this->lang->line('building_material') ?> <?= $this->lang->line('name') ?></label>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>

					<div class="form-group mt-2">
						<input type="text" placeholder="<?= $this->lang->line('enter_name') ?>" name="name" class="form-control" value="<?= $name ?>" required autofocus>
					</div>

					<div class="form-group mt-2">
						<label class="control-label"><?= $this->lang->line('minimum_inventory_qty') ?></label>
						<input type="text" placeholder="<?= $this->lang->line('enter_minimum_inventory_qty') ?>" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty ?>">
					</div>

					<div class="form-group mt-2">
						<label class="control-label"><?= $this->lang->line('select_unit') ?></label>
						<select name="unit_name" class="form-control select2" required>
							<option value=""><?= $this->lang->line('select') ?></option>
							<?php if ($units): ?>
								<?php foreach ($units as $value): ?>
									<option value="<?= $value['unit_name'] ?>" <?= ($value['unit_name'] == $unit_name) ? 'selected' : '' ?>>
										<?= $value['unit_name'] ?>
									</option>
								<?php endforeach; ?>
							<?php else: ?>
								<option value=""><?= $this->lang->line('no_result') ?></option>
							<?php endif; ?>
						</select>
					</div>

					<div class="form-group mt-2">
						<label class="control-label"><?= $this->lang->line('description') ?></label>
						<textarea placeholder="<?= $this->lang->line('enter_description') ?>" name="description" class="form-control"><?= $description ?></textarea>
					</div>

					<?php if (!empty($id)) { ?>
						<div class="form-group">
							<label class="control-label"><?= $this->lang->line('opening_stock_qty') ?></label>
							<input type="text" placeholder="<?= $this->lang->line('enter_opening_stock_qty') ?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty ?>">
						</div>

						<div class="form-group">
							<label class="control-label"><?= $this->lang->line('status') ?></label>
							<select class="form-control" name="flag">
								<option value="0"><?= $this->lang->line('active') ?></option>
								<option value="1"><?= $this->lang->line('de_active') ?></option>
							</select>
						</div>
					<?php } ?>

					<div class="form-group mt-3">
						<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
					</div>
				</form>
			</div>

			<!-- Right Table -->
			<div class="col-md-8">
				<h5><?= $this->lang->line('building_materials_list') ?></h5>
			<div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
							<tr>
								<th><?= $this->lang->line('sr_no') ?>.</th>
								<th><?= $this->lang->line('name') ?></th>
								<th><?= $this->lang->line('code') ?></th>
								<th><?= $this->lang->line('unit') ?></th>
								<th><?= $this->lang->line('description') ?></th>
								<th><?= $this->lang->line('action') ?></th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1;
							foreach ($building_materials as $building_material): ?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $building_material['name'] ?></td>
									<td><?= $building_material['code'] ?></td>
									<td><?= $building_material['unit_name'] ?></td>
									<td><?= $building_material['description'] ?></td>
									<td>
										<a class="btn btn-icon avatar-text avatar-md" href="<?= base_url('index.php/Building_materials/index/' . $building_material['id']); ?>">
											<i class="feather feather-edit-3"></i>
										</a>
									</td>
								</tr>
							<?php $i++; endforeach; ?>
						</tbody>
					</table>
				</div>
			</div> <!-- /Right Table -->
		</div> <!-- /Row -->
	</div> <!-- /Card-body -->
</div> <!-- /nxl-content -->
