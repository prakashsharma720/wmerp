<div class="nxl-content">
    <!-- Page Header -->
    <div class="page-header d-flex justify-content-between align-items-center">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">All Assign Lead</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">All Assign Lead</li>
            </ul>
        </div>
        <div class="page-header-right">
            <button class="btn btn-light-brand bulk_assign" type="button">
                <i class="feather-upload me-2"></i> Assign Lead
            </button>
        </div>
    </div>

    <!-- Assign Section -->
    <div id="assignSection" class="collapse mt-3">
        <div class="card shadow p-4 mx-auto" style="width: 60%;">
            <form class="form-horizontal" role="form" method="post"
                action="<?php echo base_url(); ?>index.php/Leads/assignto">
                <h5><i class="feather-upload-cloud me-2"></i>Assign Selected Leads</h5>

                <!-- Select Employee -->
                <div class="mb-3">
                    <label for="employee_id" class="form-label">Select Employee</label>
                    <input type="hidden" class="all_selected_ids" name="all_selected_ids" value="">
                    <select name="employee_id" class="form-control select2 ">
                        <option value="">Select employee</option>
                        <?php
                        if ($employees): ?>
                            <?php
                            foreach ($employees as $value): ?>
                                <?php
                                if ($value['id'] == $filtered_value['employee_id']): ?>
                                    <option value="<?= $value['id'] ?>" selected>
                                        <?= $value['name'] ?>
                                    </option>
                                <?php else: ?>
                                    <option value="<?= $value['id'] ?>">
                                        <?= $value['name'] ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="">No result</option>
                        <?php endif; ?>
                    </select>
                </div>

                <!-- Selected IDs (hidden input) -->
                <input type="hidden" name="selected_ids" class="all_selected_ids" value="">

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="collapse"
                        data-bs-target="#assignSection">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Flash Messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success mt-3">
            <i class="fa fa-check-circle me-2"></i><?= $this->session->flashdata('success'); ?>
        </div>
    <?php elseif ($this->session->flashdata('failed')): ?>
        <div class="alert alert-danger mt-3">
            <i class="fa fa-times-circle me-2"></i><?= $this->session->flashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <!-- Main Table -->
    <div class="card mt-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="proposalList">
                    <thead>
                        <tr>
                            <th class="wd-30">
                                <div class="custom-control custom-checkbox ms-1">
                                    <input type="checkbox" class="custom-control-input" id="checkAllProposal">
                                    <label class="custom-control-label" for="checkAllProposal"></label>
                                </div>

                            </th>
                            <th>Sr. No.</th>
                            <th>Status</th>
                            <th>Code</th>
                            <th>Date</th>
                            <th>Services</th>
                            <th>Title</th>
                            <th>Contact Person</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Assign To</th>
                            <th>Assign By</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($leads)) {
                            $i = 1;
                            foreach ($leads as $obj): ?>
                                <tr>
                                    <td>
                                        <?php if ($obj['assign_to'] == '0'): ?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox sub_chk"
                                                    id="checkBox_<?= $i ?>" value="<?= $obj['id'] ?>">
                                                <label class="custom-control-label" for="checkBox_<?= $i ?>"></label>
                                            </div>
                                        <?php else: ?>
                                            #
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $i++; ?></td>
                                    <td>
                                        <?php
                                        if ($obj['assign_to'] != '0') {
                                            echo '<span class="badge bg-info text-white">Assigned</span>';
                                        } else {
                                            $statuses = [
                                                'Pending' => 'warning',
                                                'Approved' => 'success',
                                                'In Process' => 'primary',
                                                'Converted' => 'info',
                                                'Rejected' => 'danger'
                                            ];
                                            $badge = $statuses[$obj['lead_status']] ?? 'secondary';
                                            echo "<span class='badge bg-$badge'>" . ($obj['lead_status'] ?? 'Unknown') . "</span>";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $obj['lead_code'] ?? '-' ?></td>
                                    <td><?= !empty($obj['date']) ? date('d-M-Y', strtotime($obj['date'])) : '-' ?></td>
                                    <td><?= $obj['category_name'] ?? '-' ?></td>
                                    <td
                                        style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <?= $obj['lead_title'] ?? '-' ?></td>
                                    <td><?= $obj['contact_person'] ?? '-' ?></td>
                                    <td><a href="tel:<?= $obj['mobile'] ?>"><?= $obj['mobile'] ?? '-' ?></a></td>
                                    <td><a href="mailto:<?= $obj['email'] ?>"><?= $obj['email'] ?? '-' ?></a></td>
                                    <td><?= $obj['person_name'] ?? '-' ?></td>
                                    <td><?= $obj['assign_name'] ?? '-' ?></td>
                                    <td class="text-end">
                                        <a href="proposal-view.html" data-bs-toggle="offcanvas"
                                            data-bs-target="#proposalSent<?= $obj['id']; ?>" class="btn btn-light btn-sm">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <?php $this->load->view('Lead Module/Lead Generation/component/view-model', ['obj' => $obj]); ?>
                                    </td>
                                </tr>
                            <?php endforeach;
                        } else { ?>
                            <tr>
                                <td colspan="100" class="text-center">No Leads Found</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        // Master checkbox control
        $('#checkAllProposal').on('change', function () {
            $('.sub_chk').prop('checked', this.checked);
        });

        // Open assign panel if leads selected
        $('.bulk_assign').on('click', function () {
            let selectedIds = $('.sub_chk:checked').map(function () {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                alert("Please select at least one lead.");
                return;
            }

            $('.all_selected_ids').val(selectedIds.join(','));
            let collapseObj = bootstrap.Collapse.getOrCreateInstance(document.getElementById('assignSection'));
            collapseObj.show();
        });
    });
</script>