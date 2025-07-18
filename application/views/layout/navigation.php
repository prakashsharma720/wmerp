<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="index.html" class="b-brand">
                <!-- ========   change your logo here   ============ -->
                <img src="<?php echo base_url()."assets2/"; ?>/images/logo-full.png" alt="" class="logo logo-lg" />
                <img src="<?php echo base_url()."assets2/"; ?>/images/logo-abbr.png" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-airplay"></i></span>
                        <span class="nxl-mtext">Dashboards</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="index.html">CRM</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="analytics.html">Analytics</a></li>
                    </ul>
                </li>
                
                <!-- <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-send"></i></span>
                        <span class="nxl-mtext">SCM Module</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="apps-chat.html">Masters</a></li>

                        <li class="nxl-item"><a class="nxl-link" href="apps-email.html">Email</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="apps-tasks.html">Tasks</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="apps-notes.html">Notes</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="apps-storage.html">Storage</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="apps-calendar.html">Calendar</a></li>
                    </ul>
                </li> -->

                <!-- SCM Module Main Item -->
<li class="nxl-item nxl-hasmenu">
    <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-micon"><i class="feather-users"></i></span>
        <span class="nxl-mtext"><?=$this ->lang ->line('scm_module')?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
    </a>

    <!-- Masters Submenu -->
    <ul class="nxl-submenu">
  <!-- Masters Main Menu -->
  <li class="nxl-item nxl-hasmenu">
    <a href="javascript:void(0);" class="nxl-link">
      <span class="nxl-mtext"><?= $this->lang->line('masters') ?></span>
      <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
    </a>

    <ul class="nxl-submenu">
      <!-- Master Categories -->
      <li class="nxl-item">
        <a class="nxl-link" href="<?= base_url('index.php/Category/index') ?>">
          <?= $this->lang->line('master_categories') ?>
        </a>
      </li>

      <!-- Finished Good -->
      <li class="nxl-item nxl-hasmenu">
        <a href="javascript:void(0);" class="nxl-link">
          <span class="nxl-mtext"><?= $this->lang->line('finished_good') ?></span>
          <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
        </a>
        <ul class="nxl-submenu">
          <li class="nxl-item">
            <a class="nxl-link" href="<?= base_url('index.php/Finish_goods/add') ?>">
              <?= $this->lang->line('add') ?>
            </a>
          </li>
          <li class="nxl-item">
            <a class="nxl-link" href="<?= base_url('index.php/Finish_goods/index') ?>">
              <?= $this->lang->line('view_list') ?>
            </a>
          </li>
        </ul>
      </li>

      <!-- Grids -->
      <li class="nxl-item">
        <a class="nxl-link" href="<?= base_url('index.php/Grid/index') ?>">
          <?= $this->lang->line('grids') ?>
        </a>
      </li>

      <!-- Categories -->
      <li class="nxl-item nxl-hasmenu">
        <a href="javascript:void(0);" class="nxl-link">
          <span class="nxl-mtext"><?= $this->lang->line('categories') ?></span>
          <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
        </a>
        <ul class="nxl-submenu">
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/raw_material/index') ?>"><?= $this->lang->line('raw_material') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/packing_materials/index') ?>"><?= $this->lang->line('packing_material') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/lab_chemicals/index') ?>"><?= $this->lang->line('lab_chemicals') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/plant_and_machinery/index') ?>"><?= $this->lang->line('plant_and_machinery') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/services/index') ?>"><?= $this->lang->line('services') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/consultancy/index') ?>"><?= $this->lang->line('consultancy') ?></a></li>
<li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/computer_periperals/index') ?>"><?= $this->lang->line('computer_periperals') ?></a></li>
<li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/electrical_goods/index') ?>"><?= $this->lang->line('electrical_goods') ?></a></li>
<li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/building_materials/index') ?>"><?= $this->lang->line('building_materials') ?></a></li>
<li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/mechanical_items/index') ?>"><?= $this->lang->line('mechanical_items') ?></a></li>
<li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/green_plant_chemicals/index') ?>"><?= $this->lang->line('green_plant_chemicals') ?></a></li>
<li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/protective_equipments/index') ?>"><?= $this->lang->line('protective_equipments') ?></a></li>


        </ul>
      </li>

      <!-- Other Items -->
      <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/grades/index') ?>"><?= $this->lang->line('grades') ?></a></li>
      <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/unit/index') ?>"><?= $this->lang->line('units') ?></a></li>
      <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/sub_category/index') ?>"><?= $this->lang->line('sub_categories') ?></a></li>
      <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/department/index') ?>"><?= $this->lang->line('departments') ?></a></li>
      <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/hsn/index') ?>"><?= $this->lang->line('hsn_code') ?></a></li>
    </ul>
  </li>
<!-- Suppliers -->
      <li class="nxl-item nxl-hasmenu">
        <a href="javascript:void(0);" class="nxl-link">
          <span class="nxl-mtext"><?= $this->lang->line('suppliers') ?></span>
          <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
        </a>
        <ul class="nxl-submenu">
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Suppliers/add') ?>">
            <?= $this->lang->line('add') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Suppliers/index') ?>">
            <?= $this->lang->line('view_list') ?></a></li>
        </ul>
      </li>
<!-- RM Code -->
      <li class="nxl-item nxl-hasmenu">
        <a href="javascript:void(0);" class="nxl-link">
          <span class="nxl-mtext"><?= $this->lang->line('rm_code') ?></span>
          <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
        </a>
        <ul class="nxl-submenu">
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Rm_code/add') ?>">
            <?= $this->lang->line('add') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/rm_code/index') ?>">
            <?= $this->lang->line('view_list') ?></a></li>
        </ul>
      </li>
<!-- Purchase Orders -->
      <li class="nxl-item nxl-hasmenu">
        <a href="javascript:void(0);" class="nxl-link">
          <span class="nxl-mtext"><?= $this->lang->line('purchase_orders') ?></span>
          <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
        </a>
        <ul class="nxl-submenu">
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Purchase_order/add') ?>">
            <?= $this->lang->line('add') ?></a></li>
          <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Purchase_order/index') ?>">
            <?= $this->lang->line('view_list') ?></a></li>
        </ul>
      </li>

<!-- Reports -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('reports') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/suppliers/report') ?>"><?= $this->lang->line('suppliers_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/transporters/report') ?>"><?= $this->lang->line('transporters_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/purchase_order/report') ?>"><?= $this->lang->line('purchase_orders_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Invoice/report') ?>"><?= $this->lang->line('invoices_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/service_providers/report') ?>"><?= $this->lang->line('service_provider_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/customers/report') ?>"><?= $this->lang->line('customer_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/requisition_slips/report') ?>"><?= $this->lang->line('requisition_slips') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/gir_registers/report') ?>"><?= $this->lang->line('gir_register_report') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Stock_registers/report') ?>"><?= $this->lang->line('current_stock_report') ?></a></li>
  </ul>
</li>
<!-- GIR Registers -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-file-text"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('gir_registers') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Gir_registers/index') ?>"><?= $this->lang->line('general_gir') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Gir_registers/rm_gir_index') ?>"><?= $this->lang->line('rm_challan_inward') ?></a></li>
  </ul>
</li>
<!-- Issue Slips -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('issue_slips') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Issue_slips/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Issue_slips/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>

<!-- transporters -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('transporter') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Transporters/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Transporters/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>

<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('evaluation_master') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">

    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Evaluation_criteria/index') ?>">
        <?= $this->lang->line('criteria') ?>
      </a>
    </li>

    <!-- Supplier Evaluation -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <?= $this->lang->line('supplier_evaluation') ?>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Evaluation_result/ev_supplier_add') ?>">
            <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Evaluation_result/ev_sup_index') ?>">
            <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Transporter Evaluation -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <?= $this->lang->line('transporter_evaluation') ?>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Evaluation_result/ev_transporter_add') ?>">
            <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Evaluation_result/ev_tp_index') ?>">
            <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Service Provider Evaluation -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <?= $this->lang->line('service_provider_evaluation') ?>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Evaluation_result/ev_sprovider_add') ?>">
            <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Evaluation_result/ev_sprovider_index') ?>">
            <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</li>
<!-- serviceproviders -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('service_provider') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Service_providers/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Service_providers/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>
<!-- requisition slips-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('requisition_slips') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Requisition_slips/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Requisition_slips/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>
<!-- approval-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('approval') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Requisition_slips/approval') ?>"><?= $this->lang->line('requisitions') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Purchase_order/approval') ?>"><?= $this->lang->line('po_approval') ?></a></li>
  </ul>
</li>
<!-- approval-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('customer') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Customers/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Customers/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>
<!-- invoices-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('invoices') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Invoice/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Invoice/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>
<!-- stock_registers-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('stock_registers') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Stock_registers/materials') ?>"><?= $this->lang->line('material_wise') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/minimum_inventory_levels') ?>"><?= $this->lang->line('minimum_inventory_level') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Stock_registers/current_stocks') ?>"><?= $this->lang->line('current_stock') ?></a></li>
  </ul>
</li>

<!-- fg_stock-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('fg_stock') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Stock_registers/fg_stock_register') ?>"><?= $this->lang->line('fg_stock_ledgers') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Stock_registers/fg_current_stock') ?>"><?= $this->lang->line('fg_current_stock') ?></a></li>
    
  </ul>
</li>
<!-- material_return_record-->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-share"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('material_return_record') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Material_return_records/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Material_return_records/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
    
  </ul>
</li>
</ul>

<!-- My Stock Module (SCM ke baad) -->
<li class="nxl-item">
  <a href="<?= base_url('index.php/Stock_registers/myStock') ?>" class="nxl-link">
    <span class="nxl-micon"><i class="feather-box"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('my_stock') ?></span>
  </a>
</li>

<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-micon"><i class="feather-truck"></i></span>
    <span class="nxl-mtext"><?= $this->lang->line('pdp_module') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">

    <!-- Production Register -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-mtext"><?= $this->lang->line('production_register') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Production_registers/add') ?>"><?= $this->lang->line('add') ?></a></li>
        <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Production_registers/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
      </ul>
    </li>

    <!-- Work Allotment Register -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-mtext"><?= $this->lang->line('work_allotment_register') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Work_allotments/add') ?>"><?= $this->lang->line('add') ?></a></li>
        <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Work_allotments/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
      </ul>
    </li>

   <!-- Daily Stack Record -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-mtext"><?= $this->lang->line('daily_stack_record') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Daily_stacking_records/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Daily_stacking_records/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>

<!-- Daily Stitching Record -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-mtext"><?= $this->lang->line('daily_stitching_record') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Daily_stitching_records/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Daily_stitching_records/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>

<!-- Production Logsheet -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-mtext"><?= $this->lang->line('production_logsheet') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Production_logsheets/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Production_logsheets/add') ?>"><?= $this->lang->line('add') ?></a></li>
  </ul>
</li>

<!-- Process Logsheet (P-06) -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-mtext"><?= $this->lang->line('process_logsheet') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Process_logsheets/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Process_logsheets/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>

<!-- Power Monitoring Register -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-mtext"><?= $this->lang->line('power_monitoring_register') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Power_monitoring_registers/add') ?>"><?= $this->lang->line('add') ?></a></li>
    <li class="nxl-item"><a class="nxl-link" href="<?= base_url('index.php/Power_monitoring_registers/index') ?>"><?= $this->lang->line('view_list') ?></a></li>
  </ul>
</li>
<!-- Printing Logsheet -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-printer"></i>
    <span class="nxl-mtext"><?= $this->lang->line('printing_logsheet') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Printing_logsheet/add') ?>">
        <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
      </a>
    </li>
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Printing_logsheet/index') ?>">
        <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
      </a>
    </li>
  </ul>
</li>

<!-- Daily Tailing Records -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <span class="nxl-mtext"><?= $this->lang->line('daily_tailing_records') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Daily_tailing_records/add') ?>">
        <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
      </a>
    </li>
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Daily_tailing_records/index') ?>">
        <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
      </a>
    </li>
  </ul>
</li>

<!-- Production Reports -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-file-text"></i>
    <span class="nxl-mtext"><?= $this->lang->line('production_reports') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Daily_stacking_records/report') ?>">
        <span class="nxl-dot"></span> <?= $this->lang->line('daily_stack_report') ?>
      </a>
    </li>
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Production_registers/report') ?>">
        <span class="nxl-dot"></span> <?= $this->lang->line('production_register_report') ?>
      </a>
    </li>
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Daily_stitching_records/reports') ?>">
        <span class="nxl-dot"></span> <?= $this->lang->line('daily_stitching_report') ?>
      </a>
    </li>
  </ul>
</li>


  </ul>
</li>
<!-- PEA Module -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-radio"></i>
    <span class="nxl-mtext"><?= $this->lang->line('pea_module') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
  </a>
  <ul class="nxl-submenu">

    <!-- Waste Disposal Record -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-mtext"><?= $this->lang->line('waste_disposal_record') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Waste_material_records/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Waste_material_records/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Area Cleaning Records -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-mtext"><?= $this->lang->line('area_cleaning_records') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Area_cleaning_records/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Area_cleaning_records/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</li>
<!-- ENG Module Menu -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-radio"></i>
    <span class="nxl-mtext"><?= $this->lang->line('eng_module') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-down"></i></span>
  </a>
  <ul class="nxl-submenu">

    <!-- Machinery Equipments -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <span class="nxl-mtext"><?= $this->lang->line('machinery_equipments') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Machinary_equipments/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Machinary_equipments/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Job Order Records -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-file-text"></i>
        <span class="nxl-mtext"><?= $this->lang->line('job_order_records') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Job_order/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Job_order/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Preventive Maintenance -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-calendar"></i>
        <span class="nxl-mtext"><?= $this->lang->line('preventive_maintenance') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Preventive_registers/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Preventive_registers/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Maintenance History Records -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-file-text"></i>
        <span class="nxl-mtext"><?= $this->lang->line('maintenance_history_records') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Maintenance_history_records/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Maintenance_history_records/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Area Cleaning Records -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-file-text"></i>
        <span class="nxl-mtext"><?= $this->lang->line('area_cleaning_records') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Area_cleaning_records/add') ?>">
            <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Area_cleaning_records/index') ?>">
            <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</li>
<!-- Lead Module Menu -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-file-text"></i>
    <span class="nxl-mtext"><?= $this->lang->line('lead_module') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-down"></i></span>
  </a>
  <ul class="nxl-submenu">

    <!-- Leads Generation -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-file-text"></i>
        <span class="nxl-mtext"><?= $this->lang->line('lead_generation') ?></span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leads') ?>">
            <i class="feather-circle"></i> <?= $this->lang->line('leads') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leads/Assignleadview') ?>">
            <i class="feather-eye"></i> <?= $this->lang->line('assigned_lead') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leads/mo_leads') ?>">
            <i class="feather-file-text"></i> <?= $this->lang->line('mo_website_lead') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leads_marketing/index') ?>">
            <i class="feather-circle"></i> <?= $this->lang->line('lead_marketing') ?>
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Lead_report') ?>">
            <i class="feather-file-text"></i> <?= $this->lang->line('lead_report') ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Customer Complaints -->
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Leads/worshop_leads') ?>">
        <i class="feather-file-text"></i> <?= $this->lang->line('customer_complaints') ?>
      </a>
    </li>

  </ul>
</li>

<!-- ERP Master Menu -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-radio"></i>
    <span class="nxl-mtext"><?= $this->lang->line('erp_master') ?></span>
    <span class="nxl-arrow"><i class="feather-chevron-down"></i></span>
  </a>
  <ul class="nxl-submenu">

    <!-- Employee Review -->
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Employee_Review/index') ?>">
        <i class="feather-circle"></i> <?= $this->lang->line('employee_review') ?>
      </a>
    </li>

    <!-- Notification Master -->
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Notifications/index') ?>">
        <i class="feather-bell"></i> <?= $this->lang->line('notification_master') ?>
      </a>
    </li>

    <!-- Broadcast -->
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Broadcast/index') ?>">
        <i class="feather-radio"></i><?= $this->lang->line('broadcast') ?>
      </a>
    </li>

    <!-- Reminder Master -->
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Notifications/allreminder') ?>">
        <i class="feather-bell"></i> <?= $this->lang->line('reminder_master') ?>
      </a>
    </li>

    <!-- MO Events -->
    <li class="nxl-item">
      <a class="nxl-link" href="<?= base_url('index.php/Employees/events') ?>">
        <i class="feather-fire"></i> <?= $this->lang->line('mo_events') ?>
      </a>
    </li>

  </ul>
</li>
<!-- HR Module Menu -->
<li class="nxl-item nxl-hasmenu">
  <a href="javascript:void(0);" class="nxl-link">
    <i class="feather-radio"></i>
    <span class="nxl-mtext">HR Module</span>
    <span class="nxl-arrow"><i class="feather-chevron-down"></i></span>
  </a>
  <ul class="nxl-submenu">

    <!-- Employees -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-user"></i>
        <span class="nxl-mtext">Employees</span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Employees/add') ?>">
            <i class="feather-plus-circle"></i> Add
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Employees/index') ?>">
            <i class="feather-list"></i> View List
          </a>
        </li>
      </ul>
    </li>

    <!-- Leave Module -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-diamond"></i>
        <span class="nxl-mtext">Leave Module</span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Holidays') ?>">
            <i class="feather-circle"></i> Holidays
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leave_balance') ?>">
            <i class="feather-circle"></i> Leave Balance
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leave_applications') ?>">
            <i class="feather-circle"></i> Leave Applications
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leave_types') ?>">
            <i class="feather-circle"></i> Leave Types
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leave_allotment') ?>">
            <i class="feather-circle"></i> Leave Allotment
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Leave_approval') ?>">
            <i class="feather-circle"></i> Leave Approval
          </a>
        </li>
      </ul>
    </li>

    <!-- Daily Tasks -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-file-text"></i>
        <span class="nxl-mtext">Daily Tasks</span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Projects') ?>">
            <i class="feather-circle"></i> Projects
          </a>
        </li>
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Tasks') ?>">
            <i class="feather-circle"></i> Tasks
          </a>
        </li>
      </ul>
    </li>

    <!-- Payroll Module -->
    <li class="nxl-item nxl-hasmenu">
      <a href="javascript:void(0);" class="nxl-link">
        <i class="feather-file-text"></i>
        <span class="nxl-mtext">Payroll Module</span>
        <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
      </a>
      <ul class="nxl-submenu">
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/Attendance') ?>">
            <i class="feather-circle"></i> Attendance List
          </a>
        </li>
        <!-- Add more payroll submenus as needed -->
      </ul>
    </li>

  </ul>
</li>

                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-at-sign"></i></span>
                        <span class="nxl-mtext">Proposal</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="proposal.html">Proposal</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="proposal-view.html">Proposal View</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="proposal-edit.html">Proposal Edit</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="proposal-create.html">Proposal Create</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-dollar-sign"></i></span>
                        <span class="nxl-mtext">Payment</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="payment.html">Payment</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="invoice-view.html">Invoice View</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="invoice-create.html">Invoice Create</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Customers</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="customers.html">Customers</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="customers-view.html">Customers View</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="customers-create.html">Customers Create</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-alert-circle"></i></span>
                        <span class="nxl-mtext">Leads</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="leads.html">Leads</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="leads-view.html">Leads View</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="leads-create.html">Leads Create</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                        <span class="nxl-mtext">Projects</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="projects.html">Projects</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="projects-view.html">Projects View</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="projects-create.html">Projects Create</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-layout"></i></span>
                        <span class="nxl-mtext">Widgets</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="widgets-lists.html">Lists</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="widgets-tables.html">Tables</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="widgets-charts.html">Charts</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="widgets-statistics.html">Statistics</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="widgets-miscellaneous.html">Miscellaneous</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-settings"></i></span>
                        <span class="nxl-mtext">Settings</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="settings-general.html">General</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-seo.html">SEO</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-tags.html">Tags</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-email.html">Email</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-tasks.html">Tasks</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-leads.html">Leads</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-support.html">Support</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-finance.html">Finance</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-gateways.html">Gateways</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-customers.html">Customers</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-localization.html">Localization</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-recaptcha.html">reCAPTCHA</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="settings-miscellaneous.html">Miscellaneous</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-power"></i></span>
                        <span class="nxl-mtext">Authentication</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <!-- Login submenu -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-mtext">Login</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="./auth-login-cover.html">Cover</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-login-minimal.html">Minimal</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-login-creative.html">Creative</a></li>
                            </ul>
                        </li>
                        <!-- Register submenu -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-mtext">Register</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="./auth-register-cover.html">Cover</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-register-minimal.html">Minimal</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-register-creative.html">Creative</a></li>
                            </ul>
                        </li>
                        <!-- Error 404 submenu -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-mtext">Error-404</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="./auth-404-cover.html">Cover</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-404-minimal.html">Minimal</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-404-creative.html">Creative</a></li>
                            </ul>
                        </li>
                        <!-- Reset Password submenu -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-mtext">Reset Pass</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="./auth-reset-cover.html">Cover</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-reset-minimal.html">Minimal</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-reset-creative.html">Creative</a></li>
                            </ul>
                        </li>
                        <!-- OTP Verify submenu -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-mtext">Verify OTP</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="./auth-verify-cover.html">Cover</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-verify-minimal.html">Minimal</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-verify-creative.html">Creative</a></li>
                            </ul>
                        </li>
                        <!-- Maintenance submenu -->
                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-mtext">Maintenance</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="./auth-maintenance-cover.html">Cover</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-maintenance-minimal.html">Minimal</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="./auth-maintenance-creative.html">Creative</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                        <span class="nxl-mtext">Help Center</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="https://themeforest.net/user/flexilecode">Support</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="help-knowledgebase.html">KnowledgeBase</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="#">Documentations</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-cast"></i></span>
                        <span class="nxl-mtext">Reports</span><span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="reports-sales.html">Sales Report</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="reports-leads.html">Leads Report</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="reports-project.html">Project Report</a></li>
                        <li class="nxl-item"><a class="nxl-link" href="reports-timesheets.html">Timesheets Report</a></li>
                    </ul>
                </li>
            </ul>
            <div class="card text-center">
                <div class="card-body">
                    <i class="feather-sunrise fs-4 text-dark"></i>
                    <h6 class="mt-4 text-dark fw-bolder">Downloading Center</h6>
                    <p class="fs-11 my-3 text-dark">Duralux is a production ready CRM to get started up and running easily.</p>
                    <a href="https://themeforest.net/user/flexilecode" class="btn btn-primary text-white">Download Now</a>
                </div>
            </div>
        </div>
    </div>
</nav>
