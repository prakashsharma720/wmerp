
<div class="nxl-content">
  <div class="page-header d-flex justify-content-between align-items-center">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('transporters_report') ?></h5>

      </div>
      <ul class="breadcrumb d-flex align-items-center mb-0 ms-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>">
            <?= $this->lang->line('home') ?>
          </a>
        </li>
        <li class="breadcrumb-item"> <?= $this->lang->line('report') ?></li>
      </ul>
    </div>

    <!-- Add New Button -->
    <div class="page-header-right d-flex align-items-center gap-2">
      <?php $this->load->view('layout/alerts'); ?>
      <a class="btn btn-icon btn-light-brand" href="<?= base_url('index.php/Transporters/createXLS') ?>">
          <i class="feather feather-download "></i> 
        </a>

      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>
  


   
  <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

  

    
        <div class="main-content ">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped" id="proposalList">
                <thead>
                  <tr>   
                <th><?= $this->lang->line('name') ?></th>
                <th><?= $this->lang->line('code') ?></th>
                <th style="white-space: nowrap;"><?= $this->lang->line('contact_person') ?></th>
                <th><?= $this->lang->line('email') ?></th>
                <th><?= $this->lang->line('mobile_no') ?></th>
                <th><?= $this->lang->line('website') ?></th>
                <th style="white-space: nowrap;"><?= $this->lang->line('approval_category') ?></th>
                <!-- Future Use:
                  <th>Bank Name</th>
                  <th>Account No</th>
                  <th>Service State</th>
                  <th>Approval Date</th>
                  <th>Next Evaluation</th>
                -->
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($transporters)): ?>
                <?php foreach ($transporters as $obj): ?>
                  <tr>
                    <td><?= $obj['transporter_name'] ?></td>
                    <td><?= $obj['vendor_code'] ?></td>
                    <td><?= $obj['contact_person'] ?></td>
                    <td><?= $obj['email'] ?></td>
                    <td><?= $obj['mobile_no'] ?></td>
                    <td><?= $obj['website'] ?></td>
                    <td><?= $obj['category_of_approval'] ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="7" class="text-center text-muted"><?= $this->lang->line('no_data_found') ?? 'No data found' ?></td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
