

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
				<h5 class="m-b-10"><?= $this->lang->line('packing_material'); ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('packing_material_master') ?>
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
	
		<div class="card-body p-3 bg-white" style="position: relative;top:15px; left:15px">
			<div class="row">
				<div class="col-md-4">
					<?php  //echo $title; exit; 
					?>
					<?php if (!empty($id)) { ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Packing_materials/editPM/<?= $id ?>">
							<input type="hidden" name="pm_id" value="<?= $id ?>">
						<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Packing_materials/add_newPM">
							<?php } ?>
							<div class="form-group">
								<?= $this->lang->line('new_material_code') ?> : <label class="control-label"> <?= $pm_code_view ?></label>
								<div class="row col-md-12">
									<label class="control-label"><?= $this->lang->line('name_of_supplier') ?> <span class="required">*</span></label>
									<select name="supplier_id" class="form-control select2 suppliers">
										<option selected><?= $this->lang->line('select_supplier') ?></option>
										<?php
										foreach ($suppliers as $value) : ?>
											<?php
											if ($value['id'] == $supplier_id): ?>
												<option value="<?= $value['id'] ?>" selected><?= $value['supplier_name'] ?></option>
											<?php else: ?>

												<option value="<?= $value['id'] ?>"><?= $value['supplier_name'] ?></option>
											<?php endif;   ?>
										<?php endforeach;  ?>
									</select>
								</div>
								<div class="row col-md-12">
									<?php
									if ($categories): ?>
										<?php
										foreach ($categories as $value) : ?>
											<?php
											if ($value['id'] == $categories_id): ?>
												<input type="hidden" name="categories_id" value="<?= $value['id'] ?>">
												<input type="hidden" name="code" value="<?= $pm_code_view ?>">
												<label class="control-label"> <?= $this->lang->line('packing_material'); ?> <?= $this->lang->line('name') ?></label>

											<?php endif;   ?>
										<?php endforeach;  ?>
									<?php else: ?>
										<option value="0"><?= $this->lang->line('no_result') ?></option>
									<?php endif; ?>
								</div>
								<div class="row col-md-12">
									<!-- <label class="control-label"> Name</label>  -->
									<input type="text" placeholder="<?= $this->lang->line('enter_name') ?>" name="name" class="form-control" value="<?= $name ?>" required autofocus>
								</div>
								<!-- <div class="row col-md-12">
				            	<label class="control-label"> Code <span class="required">*</span></label>
				                <input type="text"  name="pm_code" class="form-control" value="<?= $pm_code_view ?>"  autofocus readonly="readonly">
				                <input type="hidden" name="code" value="<?php echo $pm_code; ?>" required>
						     </div> -->
								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('bag_packing') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_bag_packing') ?>" name="bag_packing" class="form-control" value="<?= $bag_packing ?>" autofocus>
								</div>
								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('bag_size') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_bag_size') ?>e" name="bag_size" class="form-control" value="<?= $bag_size ?>" autofocus>
								</div>
								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('select_unit') ?></label>
									<select name="unit_name" class="form-control select2" required="required">
										<option value=""><?= $this->lang->line('select') ?></option>
										<?php
										if ($units): ?>
											<?php
											foreach ($units as $value) : ?>
												<?php
												if ($value['unit_name'] == $unit_name): ?>
													<option value="<?= $value['unit_name'] ?>" selected><?= $value['unit_name'] ?></option>
												<?php else: ?>
													<option value="<?= $value['unit_name'] ?>"><?= $value['unit_name'] ?></option>
												<?php endif;   ?>
											<?php endforeach;  ?>
										<?php else: ?>
											<option value=""><?= $this->lang->line('no_result') ?></option>
										<?php endif; ?>
									</select>
								</div>
								<div class="row col-md-12">
									<label class="control-label"><?= $this->lang->line('minimum_inventory_qty') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_minimum_inventory_qty') ?>" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty ?>" autofocus>
								</div>

								
								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('description') ?></label>
									<textarea type="text" placeholder="<?= $this->lang->line('enter_description') ?>" name="description" class="form-control" value="<?= $description ?>" autofocus><?= $description ?></textarea>
								</div>
								<?php if (!empty($id)) { ?>
									<div class="row col-md-12">
										<label class="control-label"> <?= $this->lang->line('opening_stock_qty') ?></label>
										<input type="text" placeholder="<?= $this->lang->line('enter_opening_stock_qty') ?> " name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty ?>" required autofocus>
									</div>

									<div class="row col-md-12">
										<label class="control-label"><?= $this->lang->line('status') ?></label>
										<select class="form-control" name="flag">
											<option value="0"> <?= $this->lang->line('active') ?></option>
											<option value="1"> <?= $this->lang->line('de_active') ?></option>
										</select>
									</div>
								<?php } ?>
								<div class="row col-md-12">
									<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('name') ?></label><br>
									<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
								</div>
							</div>
							</form>
				</div>
				<!-- /form -->
				<div class="col-md-8">
					<h5> <?= $this->lang->line('packing_material_list') ?></h5>
					<div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
							<thead class="table-light">
								<tr>
									<th> <?= $this->lang->line('sr_no') ?>.</th>
									<th><?= $this->lang->line('supplier_name') ?></th>
									<th> <?= $this->lang->line('name') ?></th>
									<th style="white-space: nowrap;"> <?= $this->lang->line('bag_packing') ?></th>
									<th> <?= $this->lang->line('action') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($packing_materials as $packing_material) { ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $packing_material['supplier'] ?></td>
										<td><?= $packing_material['name']  ?></td>
										<td><?= $packing_material['bag_packing'] ?></td>
										<td> <a class="btn btn-icon avatar-text avatar-md" style="padding: 2px 3px;" href="<?php echo base_url(); ?>index.php/Packing_materials/index/<?php echo $packing_material['id']; ?>">
											<i class="feather feather-edit-3"></i>
										</a></td>
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