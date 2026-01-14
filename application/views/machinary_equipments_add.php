<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style type="text/css">
	th,
	td {
		padding: 10px;
	}
</style>
<div class="container-fluid">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title"><?= $title ?></h3>
			<div class="pull-right error_msg"></div>
		</div> <!-- /.card-body -->
		<div class="card-body">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Machinary_equipments/add_new_record">
				<input type="hidden" name="pme_code" value="<?= $pme_code ?>">
				<div class="row col-md-12">
					<div class="col-md-4 col-sm-4 ">
						<label class="control-label"> <?= $this->lang->line('date') ?> <span class="required">*</span></label>
						<input type="text" data-date-formate="dd-mm-yyyy" name="transaction_date" class="form-control date-picker" placeholder="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y'); ?>" autofocus required>
					</div>

					<div class="col-md-6 col-sm-6 ">
						<label class="control-label"> <?= $this->lang->line('department') ?></label>
						<select name="department_id" class="form-control select2 ">
							<option value=""> <?= $this->lang->line('select_department') ?></option>
							<?php
							if ($departments) : ?>
								<?php
									foreach ($departments as $value) : ?>
									<?php
											if ($value['id'] == $department_id) : ?>
										<option value="<?= $value['id'] ?>" selected><?= $value['department_name'] . ' (' . $value['department_code'] . ')' ?></option>
									<?php else : ?>
										<option value="<?= $value['id'] ?>"><?= $value['department_name'] . ' (' . $value['department_code'] . ')' ?></option>
									<?php endif;   ?>
								<?php endforeach;  ?>
							<?php else : ?>
								<option value="0"><?= $this->lang->line('no_result') ?></option>
							<?php endif; ?>
						</select>
					</div>
				</div>
				<br>
				<div class="form-group">
					<div class="row col-md-12">
						<div class="table-responsive">
							<table id="maintable">
								<thead style="background-color: #ca6b24;">
									<tr>
										<th>#</th>
										<th> <?= $this->lang->line('equipment_name') ?> </th>
										<th> <?= $this->lang->line('equipment_id') ?> </th>
										<th> <?= $this->lang->line('model_type') ?></th>
										<th> <?= $this->lang->line('sr_no') ?>.</th>
										<th> <?= $this->lang->line('make') ?> </th>
										<th> <?= $this->lang->line('year_of_installation') ?> </th>
										<th style="white-space: nowrap;"> <?= $this->lang->line('action_button') ?></th>
									</tr>
								</thead>
								<tbody id="mainbody"></tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row col-md-12">
					<div class="col-md-12 col-sm-12 ">
						<label class="control-label" style="visibility: hidden;"> <?= $this->lang->line('grade') ?></label>
						<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('submit') ?></button>
					</div>
				</div>
			</form> <!-- /form -->
		</div>
	</div>
</div>

<table id="sample_table1" style="display: none;">
	<tbody>
		<tr class="main_tr1">
			<td>1</td>
			<td>
				<select name="equipment_name[]" class="form-control equipment_name" style="width:200px;" required>
					<option value=""> <?= $this->lang->line('select_name') ?></option>
					<?php if ($plant_machinary_list) : ?>
						<?php foreach ($plant_machinary_list as $k=>$value) : ?>
								<option value="<?php echo $value['id']; ?>"><?php echo $value['name'];?></option>
						<?php endforeach; ?>
					<?php else : ?>
						<option value="0"><?= $this->lang->line('no_result') ?></option>
					<?php endif; ?>
				</select>
			</td>
			<td>
			<input type="text" placeholder="<?= $this->lang->line('id') ?>" name="equipment_id[]" class="form-control equipment_id" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;" required>
			</td>
			<td>
				<input type="text" placeholder="<?= $this->lang->line('model_type') ?>" name="model_type[]" class="form-control model_type" style="width:140px;" autofocus oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" style="width:100px;" required>
			</td>
			<td>
				<input type="text" placeholder="<?= $this->lang->line('sr_no') ?>." name="sr_no[]" class="form-control sr_no" autofocus style="width:100px;" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>
			</td>
			<td>
				<input type="text" data-date-formate="dd-mm-yyyy" name="equipment_make[]" style="width:140px;" class="form-control date-picker equipment_make" placeholder="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y'); ?>" autofocus required>
			</td>
			<td>
				<input type="text" data-date-formate="dd-mm-yyyy" name="year_of_install[]" style="width:140px;" class="form-control date-picker year_of_install" placeholder="dd-mm-yyyy" autocomplete="off" value="<?php echo date('d-m-Y'); ?>" autofocus required>
			</td>
			<td>
				<button type="button" class="btn btn-xs btn-primary addrow"  href="#" role='button'><i class="fa fa-plus"></i></button> 
				<button type="button" class="btn btn-xs btn-danger deleterow" href="#" role='button'><i class="fa fa-minus"></i></button>
			</td>
		</tr>
	</tbody>
</table>

<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		add_row();
		$('body').on('click', '.addrow', function() {

			var table = $(this).closest('table');
			add_row();
			rename_rows();
			calculate_total(table);
		});

		function add_row() {
			var tr1 = $("#sample_table1 tbody tr").clone();
			$("#maintable tbody#mainbody").append(tr1);
		}
		$('body').on('click', '.deleterow', function() {

			var table = $(this).closest('table');
			var rowCount = $("#maintable tbody tr.main_tr1").length;
			if (rowCount > 1) {
				if (confirm("Are you sure to remove row ?") == true) {
					$(this).closest("tr").remove();
					rename_rows();
					calculate_total(table);
				}
			}
		});

		function rename_rows() {
			var i = 0;
			$("#maintable tbody tr.main_tr1").each(function() {
				$(this).find("td:nth-child(1)").html(++i);
				$(this).find("td:nth-child(2) select.worders").select2();
				$(this).find("td:nth-child(3) select.items").select2();
				var rowCount1 = $("#maintable tbody tr.main_tr1").length;
				$('.total_workers').val(rowCount1);

			});
		}
		$(document).on('keyup', '.no_of_bags,.rate', function() {
			var table = $(this).closest('table');
			calculate_total(table);

		});

		function calculate_total(table) {
			var no_of_bags = 0;
			var rate = 0;
			var total = 0;
			var total_bags = 0;
			var total_rate = 0;
			var total_amount = 0;

			table.find("tbody tr.main_tr1").each(function() {
				//var qty,rate,total=0;
				/*var packing_size = parseFloat($(this).find("td:nth-child(5) select.packing_size").val());*/
				no_of_bags = parseFloat($(this).find("td:nth-child(4) input.no_of_bags").val());
				rate = parseFloat($(this).find("td:nth-child(5) input.rate").val());
				//var qty=parseFloat($(this).find("td:nth-child(7) input.qty").val());
				//alert(no_of_bags);
				if (isNaN(rate)) {
					rate = 0;
				}
				if (isNaN(no_of_bags)) {
					no_of_bags = 0;
				}
				if (isNaN(total_bags)) {
					total_bags = 0;
				}
				total = rate * no_of_bags;
				total_bags = total_bags + no_of_bags;
				total_rate = total_rate + rate;
				total_amount = total_amount + total;
				$(this).find("td:nth-child(6) input.total").val(total.toFixed(2));
			});
			//alert(total_qty);
			table.find("tfoot tr input.total_bags").val(total_bags.toFixed(2));
			table.find("tfoot tr input.total_rate").val(total_rate.toFixed(2));
			table.find("tfoot tr input.total_amount").val(total_amount.toFixed(2));
		}
	});
</script>