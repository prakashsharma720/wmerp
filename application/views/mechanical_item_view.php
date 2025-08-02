<style>
    .table td, .table th {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    td:nth-child(5) {
        max-width: 200px;
    }

    .btn-icon {
        padding: 4px 8px;
    }
</style>

<div class="nxl-content">
	<div class="page-header">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('mechanical_items') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>">
						<?= $this->lang->line('home') ?>
					</a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('mechanical_items_master') ?></li>
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

	<div class="container card-white-box">
		<div class="card-body p-3 bg-white" style="position:relative; top:15px; left:15px">
			<div class="row">
				<!-- Left Form Column -->
				<div class="col-md-4">
					<?php if (!empty($id)) { ?>
						<form class="form-horizontal" role="form" method="post"
							action="<?php echo base_url(); ?>index.php/Mechanical_items/editPM/<?= $id ?>">
							<input type="hidden" name="pm_id" value="<?= $id ?>">
						<?php } else { ?>
							<form class="form-horizontal" role="form" method="post"
								action="<?php echo base_url(); ?>index.php/Mechanical_items/add_newPM">
							<?php } ?>

							<div class="form-group">
								<?= $this->lang->line('item_code') ?>:
								<label class="control-label"><?= $mi_code_view ?></label>
								<input type="hidden" name="code" value="<?= $mi_code_view ?>">
							</div>

							<div class="form-group">
								<?php if ($categories): ?>
									<?php foreach ($categories as $value): ?>
										<?php if ($value['id'] == $categories_id): ?>
											<input type="hidden" name="categories_id" value="<?= $value['id'] ?>">
											<label class="control-label"><?= $this->lang->line('mechanical_item_name') ?></label>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php else: ?>
									<p><?= $this->lang->line('no_result') ?></p>
								<?php endif; ?>
							</div>

							<div class="form-group">
								<input type="text" placeholder="<?= $this->lang->line('enter_name') ?>" name="name"
									class="form-control" value="<?= $name ?>" required autofocus>
							</div>

							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('size') ?></label>
								<input type="text" placeholder="<?= $this->lang->line('enter_size') ?>" name="bag_size"
									class="form-control" value="<?= $bag_size ?>" required>
							</div>

							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('minimum_inventory_qty') ?></label>
								<input type="text" placeholder="<?= $this->lang->line('enter_minimum_inventory_qty') ?>"
									class="form-control" name="minimum_inventory_qty"
									value="<?= $minimum_inventory_qty ?>" required>
							</div>

							<div class="form-group">
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

							<div class="form-group">
								<label class="control-label"><?= $this->lang->line('description') ?></label>
								<textarea placeholder="<?= $this->lang->line('enter_description') ?>" name="description"
									class="form-control"><?= $description ?></textarea>
							</div>

							<?php if (!empty($id)) { ?>
								<div class="form-group">
									<label class="control-label"><?= $this->lang->line('opening_stock_qty') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_opening_stock_qty') ?>"
										name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty ?>">
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

				<!-- Right Table Column -->
				<div class="col-md-8">
					<h5><?= $this->lang->line('mechnical_item_list') ?></h5>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><?= $this->lang->line('sr_no') ?>.</th>
									<th><?= $this->lang->line('name') ?></th>
									<th><?= $this->lang->line('size') ?></th>
									<th><?= $this->lang->line('unit') ?></th>
									<th><?= $this->lang->line('description') ?></th>
									<th><?= $this->lang->line('action') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($mechanical_items as $mechanical_item): ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $mechanical_item['name'] ?></td>
										<td><?= $mechanical_item['bag_size'] ?></td>
										<td><?= $mechanical_item['unit_name'] ?></td>
										<td><?= $mechanical_item['description'] ?></td>
										<td>
											<a class="btn btn-icon avatar-text avatar-md"
												href="<?= base_url('index.php/Mechanical_items/index/' . $mechanical_item['id']); ?>">
												<i class="feather feather-edit-3"></i>
											</a>
										</td>
									</tr>
									<?php $i++; endforeach; ?>
							</tbody>
						</table>
					</div>
				</div> <!-- /col-md-8 -->
			</div> <!-- /row -->
		</div> <!-- /card-body -->
	</div> <!-- /container -->
</div> <!-- /nxl-content -->
