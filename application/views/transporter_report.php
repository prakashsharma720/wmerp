
<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('transporters_report') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?= base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
      </ul>
    </div>

    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">
        <a class="btn btn-info" href="<?= base_url('index.php/Transporters/createXLS') ?>">
          <?= $this->lang->line('export') ?>
        </a>
      </div>
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
    </div>
  </div>



   
  <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

  

      <div class="container card-white-box">

          <div id="proposalList_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer shadow-sm p-3 mt-3 rounded" style="background-color: #fff;">


            <div class="col-sm-12">
              <table class="table table-hover align-middle" id="proposalList">
                <thead class="table-light">

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
