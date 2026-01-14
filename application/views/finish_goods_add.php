<div class="nxl-content">
    <!-- ===== Page Header ===== -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('finish_good') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
                        <?= $this->lang->line('home') ?>
                    </a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('add_new_finished_good') ?></li>
            </ul>
        </div>

        <div class="page-header-right ms-auto d-flex align-items-center">
            <?php $this->load->view('layout/alerts'); ?>
            <div class="d-md-none d-flex align-items-center ms-3">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- ===== Main Content ===== -->
    <div class="main-content">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form-horizontal" method="post" action="<?= base_url('index.php/Finish_goods/add_new_fg') ?>">
                            <div class="row g-3">

                                <!-- Finish Good Code -->
                                <div class="col-md-6">
                                    <label class="control-label"><?= $this->lang->line('finish_good_code') ?></label>
                                    <input type="text" name="finishgood_code" class="form-control" value="<?= $finish_good_code ?>" readonly>
                                    <input type="hidden" name="fg_code" value="<?= $fg_code ?>">
                                </div>

                                <!-- Grade Name -->
                                <div class="col-md-6">
                                    <label class="control-label"><?= $this->lang->line('grade_name') ?></label>
                                    <input type="text" name="grade_name" class="form-control" placeholder="<?= $this->lang->line('enter_grade_name') ?>" required>
                                </div>

                                <!-- Mineral Name -->
                                <div class="col-md-6">
                                    <label class="control-label"><?= $this->lang->line('mineral_name') ?></label>
                                    <select name="mineral_name" class="form-control select2 mineral_name">
                                        <option value="0"><?= $this->lang->line('select_mineral') ?></option>
                               
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

                                <!-- HSN Code -->
                                <div class="col-md-6 hsn_code">
                                    <label class="control-label"><?= $this->lang->line('hsn_code') ?></label>
                                    <input type="text" name="hsn_code" class="form-control clear_hsn" placeholder="<?= $this->lang->line('enter_hsn_code') ?>" readonly autocomplete="off">
                                </div>

                                <!-- Packing Size -->
                                <div class="col-md-6">
                                    <label class="control-label"><?= $this->lang->line('packing') ?></label>
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

                                <!-- Packing Type -->
                                <div class="col-md-6">
                                    <label class="control-label"><?= $this->lang->line('packing_type') ?></label>
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

                                <!-- Submit Button -->
                                <div class="col-md-12 text-center mt-2">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <?= $this->lang->line('save') ?>
                                    </button>
                                </div>

                            </div> <!-- /.row -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="<?= base_url("assets/plugins/jquery/jquery.min.js"); ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Update grades based on category (if needed)
        $(document).on('change', '.category_id', function () {
            var category_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/Grades/getGradeByCategory/') ?>" + category_id,
                dataType: 'html',
                success: function (response) {
                    $(".grades").html(response);
                    $('.select2').select2();
                }
            });
        });

        // Auto-fill HSN code based on selected mineral
        $(document).on('change', '.mineral_name', function () {
            var hsn_id = $(this).val();
            if (hsn_id !== '0') {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('index.php/HSN/getmineralById/') ?>" + hsn_id,
                    data: { hsn_id: hsn_id },
                    dataType: 'html',
                    success: function (response) {
                        $(".hsn_code").html(response);
                    }
                });
            } else {
                $(".clear_hsn").val('');
            }
        });
    });
</script>
