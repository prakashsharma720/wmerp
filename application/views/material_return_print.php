<?php if ($this->session->flashdata('success')): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fa fa-check"></i><?= $this->lang->line('success') ?> !</h5>
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

<!-- Page Header -->
<div class="nxl-content">
  <div class="page-header mb-3">
    <div class="page-header-left d-flex align-items-center">
      <div class="page-header-title">
        <h5 class="m-b-10"><?= $this->lang->line('material_return_record_profile') ?></h5>
      </div>
      <ul class="breadcrumb ml-3">
        <li class="breadcrumb-item">
          <a href="<?php echo base_url('index.php/User_authentication/admin_dashboard'); ?>"><?= $this->lang->line('home') ?></a>
        </li>
        <!-- <li class="breadcrumb-item"><?= $this->lang->line('leave_history') ?></li> -->

      </ul>

    </div>


    <div class="page-header-right ms-auto">
      <div class="page-header-right-items">

      </div>

      <!-- Mobile Toggle -->
      <div class="d-md-none d-flex align-items-center">
        <a href="javascript:void(0)" class="page-header-right-open-toggle">
          <i class="feather-align-right fs-20"></i>
        </a>
      </div>
       <div class="pull-right no-print" style="margin-top:-40px !important;">
              <button onclick="window.print()" class="btn btn-danger"><i class="fa fa-print"></i> <?= $this->lang->line('print') ?></button>
            </div>
    </div>
  </div>




  
    <div class="card-body">
      <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            <img src="<?= base_url() ?>/uploads/logo.png" height="120" width="300" />
          </div>
          <div class="col-sm-4 invoice-col">
            <h3 style="padding-top: 20px;"> <?= $this->lang->line('company_name') ?> </h3>
          </div>
          <div class="col-sm-4 invoice-col">
            <strong><u><?= $this->lang->line('company_details') ?>:</u></strong><br>
            <b><?= $this->lang->line('gst_in') ?>: </b>08AABFC2155P1ZA<br>
            <b><?= $this->lang->line('pan') ?>: </b> AABFC2155P<br>
            <!-- <b>State : </b> Rajasthan <b>State Code :</b> 08<br> -->
            <b><?= $this->lang->line('address') ?> : </b> <?= $this->lang->line('company_address') ?>
          </div>
        </div>
        <br>
        <!-- Table row -->
        <div class="row">
          <div class="col-12">
            <table class="table">
              <tbody>
                <tr>
                  <th colspan="6">
                    <h4 style="text-align: center"><?= $this->lang->line('material_return_register') ?></h4>
                  </th>
                </tr>

                <tr>
                  <th colspan="1"> <?= $this->lang->line('gir_register_category') ?> : </th>
                  <td colspan="1"> <?= $current['0']['category'] ?> </td>
                  <th colspan="1"> <?= $this->lang->line('supplier_name') ?> : </th>
                  <td colspan="2"> <?= $current['0']['supplier'] ?> </td>
                  <td colspan=""></td>
                </tr>
                <tr>
                  <th><?= $this->lang->line('register_number') ?></th>
                  <td><?= $current['0']['voucher_code'] ?></td>
                  <th><?= $this->lang->line('date') ?> </th>
                  <td> <?= $current['0']['transaction_date'] ?> </td>
                  <th><?= $this->lang->line('gate_pass_number') ?> </th>
                  <td> <?= $current['0']['gate_pass_no'] ?> </td>
                </tr>
                <tr>
                  <th colspan="1"> <?= $this->lang->line('gir_register_category') ?> : </th>
                  <td colspan="1"> <?= $current['0']['category'] ?> </td>
                  <th colspan="1"> <?= $this->lang->line('supplier_name') ?> : </th>
                  <td colspan="2"> <?= $current['0']['supplier'] ?> </td>

                </tr>
                <tr>
                  <th><?= $this->lang->line('tentative_return_date') ?> </th>
                  <td> <?= $current['0']['return_date'] ?> </td>
                </tr>

                <tr>
                  <th> <?= $this->lang->line('sr_no') ?>.</th>
                  <th colspan=""><label> <?= $this->lang->line('product_name') ?></label><br></th>
                  <th>Quantity</th>
                  <th><label><?= $this->lang->line('unit') ?></label><br></th>
                  <th><label><?= $this->lang->line('description') ?></label>

                    <br>
                  </th>
                </tr>
                <?php $i = 1;
                foreach ($current['0']['gir_details'] as $gir_details) { ?>
                  <tr>

                    <td colspan="1"><?= $i ?></td>
                    <td><?= $gir_details['item'] ?> </td>
                    <td>
                      <?= $gir_details['quantity']
                      ?>
                    </td>
                    <td>
                      <?= $gir_details['unit']
                      ?>
                    </td>
                    <td>

                      <?= $gir_details['description']
                      ?>
                    </td>
                  </tr>
                <?php $i++;
                } ?>


                <tr>
                  <td colspan="2" style="text-align: right;"><b><?= $this->lang->line('total') ?></b></td>

                  <td> <?= $current['0']['total_qty'] ?></td>
                </tr>
              </tbody>
            </table>

            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                <b> <?= $this->lang->line('declaration') ?> : </b> <?= $this->lang->line('declaration_text') ?>
              </div>
              <div class="col-sm-4 invoice-col">
                <!--  <h3 style="padding-top: 20px;"> Choudhary & Company </h3> -->
              </div>
              <div class="col-sm-4 invoice-col">
                <strong><u><?= $this->lang->line('for') ?> <?= $this->lang->line('company_name') ?> :</u></strong>
                <br></br><br></br>

                <b>( <?= $this->lang->line('authorised_signatory') ?>)</b>
              </div>
            </div>
            <!-- /.col -->
          </div>
        </div>
      </div>
    </div>

    <script src="<?php echo base_url() . "assets/"; ?>plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        moneyFormat(x) {
          //var x=3300000.00;
          x = x.toString();
          var lastThree = x.substring(x.length - 3);
          var otherNumbers = x.substring(0, x.length - 3);
          if (otherNumbers != '')
            lastThree = ',' + lastThree;
          var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
          // alert(res);
        }

      });
    </script>