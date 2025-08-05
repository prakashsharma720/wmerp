

<div class="nxl-content">
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= $this->lang->line('lab_chemical') ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
                </li>
                <li class="breadcrumb-item"><?= $this->lang->line('lab_chemical_master') ?></li>
            </ul>
        </div>

        <div class="page-header-right ms-auto">
            <div class="page-header-right-items"></div>
 <?php $this->load->view('layout/alerts'); ?>

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

                    <div class="col-md-4">
                        <?php if (!empty($id)): ?>
                            <form class="form-horizontal" role="form" method="post" action="<?= base_url("index.php/Lab_chemicals/editPM/$id") ?>">
                                <input type="hidden" name="pm_id" value="<?= $id ?>">
                        <?php else: ?>
                            <form class="form-horizontal" role="form" method="post" action="<?= base_url('index.php/Lab_chemicals/add_newPM') ?>">
                        <?php endif; ?>

                            <div class="form-group">
                                <?= $this->lang->line('new_lab_chemical_code') ?> : <label class="control-label"> <?= $code_view ?></label>

                                <div class="row col-md-12">
                                    <?php if ($categories): ?>
                                        <?php foreach ($categories as $value): ?>
                                            <?php if ($value['id'] == $categories_id): ?>
                                                <input type="hidden" name="categories_id" value="<?= $value['id'] ?>">
                                                <input type="hidden" name="code" value="<?= $code_view ?>">
                                                <label class="control-label"><?= $this->lang->line('lab_chemicals') ?> <?= $this->lang->line('name') ?></label>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="0"><?= $this->lang->line('no_result') ?></option>
                                    <?php endif; ?>
                                </div>

                                <div class="row col-md-12">
                                    <input type="text" placeholder="<?= $this->lang->line('enter_name') ?>" name="name" class="form-control" value="<?= $name ?>" required autofocus>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('grade') ?></label>
                                    <select name="grade_id" class="form-control select2 grades">
                                        <option value=""><?= $this->lang->line('select_grade') ?></option>
                                        <?php if ($grades): ?>
                                            <?php foreach ($grades as $value): ?>
                                                <option value="<?= $value['id'] ?>" <?= ($value['id'] == $grade_id) ? 'selected' : '' ?>>
                                                    <?= $value['grade'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <option value=""><?= $this->lang->line('no_result') ?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('package_size') ?></label>
                                    <input type="text" placeholder="<?= $this->lang->line('enter_bag_size') ?>" name="bag_size" class="form-control" value="<?= $bag_size ?>" autofocus>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('company_name') ?></label>
                                    <input type="text" placeholder="<?= $this->lang->line('enter_company_name') ?>" name="company_name" class="form-control" value="<?= $company_name ?>" autofocus>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('mf_date') ?></label>
                                    <input type="text" data-date-format="dd-mm-yyyy" name="mf_date" class="form-control date-picker" 
                                        value="<?= $mf_date ? date('d-m-Y', strtotime($mf_date)) : date('d-m-Y') ?>" placeholder="dd-mm-yyyy" autofocus>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('expiry_date') ?></label>
                                    <input type="text" data-date-format="dd-mm-yyyy" name="expiry_date" class="form-control date-picker" 
                                        value="<?= $expiry_date ? date('d-m-Y', strtotime($expiry_date)) : date('d-m-Y') ?>" placeholder="dd-mm-yyyy" autofocus>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('minimum_inventory_qty') ?></label>
                                    <input type="text" placeholder="<?= $this->lang->line('enter_minimum_inventory_qty') ?>" name="minimum_inventory_qty" class="form-control" value="<?= $minimum_inventory_qty ?>" autofocus>
                                </div>

                                <div class="row col-md-12 mt-2">
                                    <label class="control-label"><?= $this->lang->line('select_unit') ?></label>
                                    <select name="unit_name" class="form-control select2" required="required">
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

                                <?php if (!empty($id)): ?>
                                    <div class="row col-md-12 mt-2">
                                        <label class="control-label"><?= $this->lang->line('opening_stock_qty') ?></label>
                                        <input type="text" placeholder="<?= $this->lang->line('enter_opening_stock_qty') ?>" name="opening_stock_qty" class="form-control" value="<?= $opening_stock_qty ?>" required autofocus>
                                    </div>

<div class="row col-md-12">
										<label class="control-label"><?= $this->lang->line('status') ?></label>
										<select class="form-control" name="flag">
											<option value="0"> <?= $this->lang->line('active') ?></option>
											<option value="1"> <?= $this->lang->line('de_active') ?></option>
										</select>
									</div>
                                <?php endif; ?>

                                <div class="row col-md-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block"><?= $this->lang->line('save') ?></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Lab Chemicals List -->
                    <div class="col-md-8">
                        <h5><?= $this->lang->line('packing_material_list') ?></h5>
                        <div class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable no-footer align-middle" id="proposalList" aria-describedby="proposalList_info">
                                    <thead class="table-light">
                                        <tr>
                                            <th><?= $this->lang->line('sr_no') ?>.</th>
                                            <th style="white-space: nowrap;"><?= $this->lang->line('manufactured_by') ?></th>
                                            <th><?= $this->lang->line('name') ?></th>
                                            <th><?= $this->lang->line('size') ?></th>
                                            <th style="white-space: nowrap;"><?= $this->lang->line('expiry_date') ?></th>
                                            <th><?= $this->lang->line('action') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($lab_chemicals as $lab_chemical): ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= htmlspecialchars($lab_chemical['company_name']) ?></td>
                                                <td><?= htmlspecialchars($lab_chemical['name']) ?></td>
                                                <td><?= htmlspecialchars($lab_chemical['bag_size']) ?></td>
                                                <td><?= htmlspecialchars($lab_chemical['expiry_date']) ?></td>
                                                <td>
                                                    <a class="border rounded bg-light shadow-sm text-dark px-1 py-0" href="<?= base_url('index.php/Lab_chemicals/index/' . $lab_chemical['id']) ?>" aria-label="Edit">
                                                        <i class="feather feather-edit-3"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        $i++;
                                        endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- end col-md-8 -->

                </div> <!-- end row -->
            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end main-content -->
</div> <!-- end nxl-content -->
