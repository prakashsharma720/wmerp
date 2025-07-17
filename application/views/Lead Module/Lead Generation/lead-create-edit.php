<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="nxl-content">
    <!-- [ page-header ] start -->
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"><?= !empty($id) ? 'Lead Edit' : 'Add New Lead' ?></h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><?= !empty($id) ? 'Lead Edit' : 'Add Lead' ?></li>
            </ul>
        </div>
        <div class="page-header-right ms-auto">
            <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                    <a href="javascript:void(0)" class="page-header-right-close-toggle">
                        <i class="feather-arrow-left me-2"></i><span>Back</span>
                    </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                    <a class="btn btn-light-brand"><span>Lead Code</span></a>
                    <a class="btn btn-primary"><span><?= $lead_code ?></span></a>
                </div>
            </div>
            <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                    <i class="feather-align-right fs-20"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- [ page-header ] end -->

    <!-- [ Main Content ] start -->
    <div class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">

                        <?php
                        $form_action = !empty($id)
                            ? base_url("index.php/Leads/edititem/$id")
                            : base_url("index.php/Leads/add_new_item");

                        echo form_open($form_action, ['class' => 'form-horizontal', 'role' => 'form']);
                        ?>

                        <input type="hidden" name="lead_code" value="<?= $lead_code ?>">
                        <?php if (!empty($id)): ?>
                            <input type="hidden" name="old_lead_id" value="<?= $id ?>">
                        <?php endif; ?>

                        <?php
                        $date = !empty($generation_date)
                            ? date('Y-m-d', strtotime($generation_date))
                            : date('Y-m-d');
                        ?>

                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Lead Generation Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="generation_date" value="<?= $date ?>" required>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Services <span class="text-danger">*</span></label>
                                <?= form_dropdown('category_name', $categories, $category_name, 'class="form-select form-control" data-select2-selector="default" required="required"') ?>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" value="<?= $title ?>" class="form-control" placeholder="Title" required>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Contact Person Name <span class="text-danger">*</span></label>
                                <input type="text" name="contact_person" value="<?= $contact_person ?>" class="form-control" placeholder="Contact Person Name" required>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Country <span class="text-danger">*</span></label>
                                 <?php
                                    echo form_dropdown(
                                        'country',
                                        $countrylist,
                                        set_value('country'),
                                        'class="form-select form-control" data-select2-selector="default" required="required"'
                                    );
                                ?>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Mobile No <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" value="<?= $mobile ?>" class="form-control" placeholder="Mobile No" maxlength="10" oninput="this.value = this.value.replace(/[^+0-9]/g, '');">
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" name="city" value="<?= $city ?>" class="form-control" placeholder="City" required>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?= $email ?>" class="form-control" placeholder="Email" required>
                            </div>

                            <div class="col-lg-4 mb-4">
                                <label class="form-label">Lead Source <span class="text-danger">*</span></label>
                                <input type="text" name="lead_source" value="<?= $lead_source ?>" class="form-control" placeholder="Lead Source" required>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <label class="form-label">Description <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Lead Description"><?= $description ?></textarea>
                            </div>

                            <?php if (!empty($id)) :
                                $status_options = ['Pending', 'Approved', 'Rejected']; ?>
                                <div class="col-lg-4 mb-4">
                                    <label class="form-label">Lead Status</label>
                                    <select name="lead_status" class="form-select form-control" data-select2-selector="default" required="required">
                                        <?php foreach ($status_options as $status): ?>
                                            <option value="<?= $status ?>" <?= ($lead_status == $status) ? 'selected' : '' ?>><?= $status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-success"><?= !empty($id) ? 'Update Lead' : 'Create Lead' ?></button>
                        </div>

                        <?php echo form_close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</div>
