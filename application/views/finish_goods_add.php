<div class="nxl-content">
	<div class="page-header mt-3 mb-4 px-3 d-flex justify-content-between align-items-center">
		<div class="page-header-left d-flex align-items-center">
			<div class="page-header-title">
				<h5 class="m-b-10"><?= $this->lang->line('finish_good') ?></h5>
			</div>
			<ul class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
				</li>
				<li class="breadcrumb-item"><?= $this->lang->line('add_new_finished_good') ?>
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
	
     
	<div class="main-content" style="position: relative; left:15px;right:15px" >
		<div class="row">
			<div class="col-lg-12 ">
				
					<div class="card card-primary card-outlinep-4 mx-3 mt-2">
						<div class="card-body" >
							<div class="row">
								<div class="col-md-12 ">
									<form class="form-horizontal" role="form" method="post" action="<?php echo base_url(); ?>index.php/Finish_goods/add_new_fg">
										<div class="row col-md-12 px-3"> <!-- Add horizontal padding -->
											<div class="col-md-6 mb-3">
												<label class="control-label"><?= $this->lang->line('finish_good_code') ?></label>
												<input type="text" name="finishgood_code" class="form-control" value="<?= $finish_good_code ?>"
													autofocus readonly="readonly">
												<input type="hidden" name="fg_code" value="<?php echo $fg_code; ?>">
											</div>

											<div class="col-md-6 mb-3">
												<label class="control-label"><?= $this->lang->line('grade_name') ?></label>
												<input type="text" placeholder="<?= $this->lang->line('enter_grade_name') ?>" name="grade_name"
													class="form-control" value="" required autofocus>
											</div>
										</div>

										<div class="row col-md-12 px-3">
											<div class="col-md-6 mb-3">
												<label class="control-label"> <?= $this->lang->line('mineral_name') ?></label>
												<select name="mineral_name" class="form-control select2 mineral_name">
													<option value="0"> <?= $this->lang->line('select_mineral') ?></option>
													<?php
													if ($HSNs): ?>
														<?php
														foreach ($HSNs as $value): ?>
															<?php
															if ($value['mineral_name'] == $categories_id): ?>
																<option value="<?= $value['mineral_name'] ?>" selected><?= $value['mineral_name'] ?>
																</option>
															<?php else: ?>
																<option value="<?= $value['mineral_name'] ?>"><?= $value['mineral_name'] ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php else: ?>
														<option value="0"><?= $this->lang->line('no_result') ?></option>
													<?php endif; ?>
												</select>
											</div>
											<div class="col-md-6 hsn_code">
												<label class="control-label"><?= $this->lang->line('hsn_code') ?></label>
												<input type="text" placeholder="<?= $this->lang->line('enter_hsn_code') ?>" name="hsn_code"
													class="form-control clear_hsn" value="" autocomplete="off" autofocus readonly="readonly">
											</div>

										</div>
										<span class="help-block"></span>
										<div class="row col-md-12 px-3">
											<div class="col-md-6 mb-3">
												<label class="control-label"><?= $this->lang->line('packing') ?> </label>
												<select name="packing_size" class="form-control" required="required">
													<?php
													if ($packing_sizes): ?>
														<?php
														foreach ($packing_sizes as $value): ?>
															<?php
															if ($value == $packing_size): ?>
																<option value="<?= $value ?>" selected><?= $value ?></option>
															<?php else: ?>
																<option value="<?= $value ?>"><?= $value ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php else: ?>
														<option value="0"><?= $this->lang->line('no_result') ?></option>
													<?php endif; ?>
												</select>

											</div>
											<div class="col-md-6">
												<label class="control-label"><?= $this->lang->line('packing_type') ?> </label>
												<select class="form-control" name="packing_type" required="required">
													<?php
													if ($packing_types): ?>
														<?php
														foreach ($packing_types as $value): ?>
															<?php
															if ($value == $packing_type): ?>
																<option value="<?= $value ?>" selected><?= $value ?></option>
															<?php else: ?>
																<option value="<?= $value ?>"><?= $value ?></option>
															<?php endif; ?>
														<?php endforeach; ?>
													<?php else: ?>
														<option value="0"><?= $this->lang->line('no_result') ?></option>
													<?php endif; ?>
												</select>
											</div>

										</div>
										<span class="help-block"></span>
										<br>
										<div class="row col-md-12">
											<label class="control-label" style="visibility: hidden;">
												<?= $this->lang->line('name') ?></label><br>
											<button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
										</div>
								</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
</div>
</div>


<script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {

		//alert(base_url);
		$(document).on('change', '.category_id', function() {
			var category_id = $('.category_id').find('option:selected').val();
			//var aa= base_url+"index.php/Meenus/rolewisedata/"+role_id;
			//alert(category_id);
			$.ajax({
				type: "POST",
				url: "<?php echo base_url('index.php/Grades/getGradeByCategory/') ?>" + category_id,
				//data: {id:role_id},
				dataType: 'html',
				success: function(response) {
					//alert(response);
					$(".grades").html(response);
					$('.select2').select2();
				}
			});
		});
		$(document).on('change', '.mineral_name', function() {
			var hsn_id = $('.mineral_name').find('option:selected').val();
			//alert(hsn_id);
			if (hsn_id != ' ') {
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('index.php/HSN/getmineralById/') ?>" + hsn_id,
					data: {
						hsn_id: hsn_id
					},
					dataType: 'html',

					success: function(response) {
						//alert(response);
						$(".hsn_code").html(response);
						//$('.select2').select2();
					}
				});
			} else {
				$(".clear_hsn").val('');
			}


		});
	});
</script>