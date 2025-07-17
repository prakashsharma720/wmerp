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
			<h3 class="card-title"><?= $this->lang->line('lab_chemical_master'); ?></h3>

			<!-- <h3 class="card-title"><?= $title ?></h3> -->
			<div class="pull-right ">

			</div>
		</div> <!-- /.card-body -->
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<?php  //echo $title; exit; 
					?>
					<?php if (!empty($id)) { ?>
						<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Lab_chemicals/editPM/<?= $id ?>">
							<input type="hidden" name="pm_id" value="<?= $id ?>">
						<?php } else { ?>
							<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Lab_chemicals/add_newPM">
							<?php } ?>
							<div class="form-group">
								<?= $this->lang->line('new_lab_chemical_code') ?> : <label class="control-label"> <?= $code_view ?></label>
								<div class="row col-md-12">
									<?php
									if ($categories): ?>
										<?php
										foreach ($categories as $value) : ?>
											<?php
											if ($value['id'] == $categories_id): ?>
												<input type="hidden" name="categories_id" value="<?= $value['id'] ?>">
												<input type="hidden" name="code" value="<?= $code_view ?>">
												<label class="control-label"> <?= $this->lang->line('lab_chemicals'); ?> <?= $this->lang->line('name') ?></label>

											<?php endif;   ?>
										<?php endforeach;  ?>
									<?php else: ?>
										<option value="0"><?= $this->lang->line('no_result') ?></option>
									<?php endif; ?>
								</div>
								<div class="row col-md-12"> <!-- <label class="control-label"> Name</label>  -->
									<input type="text" placeholder="<?= $this->lang->line('enter_name') ?>" name="name" class="form-control" value="<?= $name ?>" required autofocus>
								</div>
								<!--<div class="row col-md-12">
				        		
						   <label class="control-label"> Code</label>
						                <input type="text"  placeholder="Enter Code" name="code" class="form-control" value="<?= $code ?>" required autofocus>
										</div></div> -->
								<div class="row col-md-12">
									<label class="control-label"><?= $this->lang->line('grade') ?></label>
									<select name="grade_id" class="form-control select2 grades">
										<option value=""> <?= $this->lang->line('select_grade') ?></option>
										<?php
										if ($grades): ?>
											<?php
											foreach ($grades as $value) : ?>
												<?php
												if ($value['id'] == $grade_id): ?>
													<option value="<?= $value['id'] ?>" selected><?= $value['grade'] ?></option>
												<?php else: ?>
													<option value="<?= $value['id'] ?>"><?= $value['grade'] ?></option>
												<?php endif;   ?>
											<?php endforeach;  ?>
										<?php else: ?>
											<option value=""><?= $this->lang->line('no_result') ?></option>
										<?php endif; ?>
									</select>
								</div>

								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('package_size') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_bag_size') ?>" name="bag_size" class="form-control" value="<?= $bag_size ?>" autofocus>
								</div>
								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('company_name') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_company_name') ?>" name="company_name" class="form-control" value="<?= $company_name ?>" autofocus>
								</div>

								<div class="row col-md-12">
									<label class="control-label"><?= $this->lang->line('mf_date') ?> </label>
									<input type="text" data-date-formate="dd-mm-yyyy" name="mf_date" class="form-control date-picker" value="<?php if ($mf_date) {
																																					echo date('d-m-Y', strtotime($mf_date));
																																				} else {
																																					echo date('d-m-Y');
																																				} ?>" placeholder="dd-mm-yyyy" autofocus>
								</div>
								<div class="row col-md-12">
									<label class="control-label"><?= $this->lang->line('expiry_date') ?> </label>
									<input type="text" data-date-formate="dd-mm-yyyy" name="expiry_date" class="form-control date-picker" value="<?php if ($expiry_date) {
																																						echo date('d-m-Y', strtotime($expiry_date));
																																					} else {
																																						echo date('d-m-Y');
																																					} ?>" placeholder="dd-mm-yyyy" autofocus>
								</div>
								<!--  <div class="row col-md-12">
					            <label class="control-label"> Description</label>
					             <textarea type="text"  placeholder="Enter description" name="description" class="form-control" value="<?= $description ?>" autofocus><?= $description ?></textarea>
					        </div> -->
								<div class="row col-md-12">
									<label class="control-label"> <?= $this->lang->line('minimum_inventory_qty') ?></label>
									<input type="text" placeholder="<?= $this->lang->line('enter_minimum_inventory_qty') ?>" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty ?>" autofocus>
								</div>
								<div class="row col-md-12">
									<label class="control-label"><?= $this->lang->line('select_unit') ?></label>
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
								<?php if (!empty($id)) { ?>
									<div class="row col-md-12">
										<label class="control-label"> <?= $this->lang->line('opening_stock_qty') ?></label>
										<input type="text" placeholder="<?= $this->lang->line('enter_opening_stock_qty') ?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty ?>" required autofocus>
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
									<label class="control-label" style="visibility: hidden;"><?= $this->lang->line('name') ?></label><br>
									<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
								</div>
							</div>
							</form>
				</div>
				<!-- /form -->
				<div class="col-md-8">
					<h5> <?= $this->lang->line('packing_material_list') ?></h5>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th> <?= $this->lang->line('sr_no') ?>.</th>
									<th style="white-space: nowrap;"> <?= $this->lang->line('manufactured_by') ?> </th>
									<th> <?= $this->lang->line('name') ?></th>
									<!--<th> grade</th>-->
									<th> <?= $this->lang->line('size') ?></th>

									<th style="white-space: nowrap;"> <?= $this->lang->line('expiry_date') ?></th>
									<th> <?= $this->lang->line('action') ?></th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								foreach ($lab_chemicals as $lab_chemical) { ?>
									<tr>
										<td><?= $i ?></td>
										<td><?= $lab_chemical['company_name'] ?></td>
										<td><?= $lab_chemical['name'] ?></td>
										<!--<td><?= $lab_chemical['grade'] ?></td>-->
										<td><?= $lab_chemical['bag_size'] ?></td>
										<td><?= $lab_chemical['expiry_date'] ?></td>
										<td> <a class="btn btn-xs btn-info btnEdit" href="<?php echo base_url(); ?>index.php/Lab_chemicals/index/<?php echo $lab_chemical['id']; ?>"><i class="fa fa-edit"></i></a></td>
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