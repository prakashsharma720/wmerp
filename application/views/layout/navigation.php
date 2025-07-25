<nav class="nxl-navigation">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="index.html" class="b-brand">
        <!-- ========   change your logo here   ============ -->
        <img src="<?php echo base_url() . "assets2/"; ?>/images/logo-full.png" alt="" class="logo logo-lg" />
        <img src="<?php echo base_url() . "assets2/"; ?>/images/logo-abbr.png" alt="" class="logo logo-sm" />
      </a>
    </div>
    <div class="navbar-content">
      <ul class="nxl-navbar">
        <li class="nxl-item nxl-caption">
          <label>Navigation</label>
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
        <!-- Master Dashboard -->
        <li class="nxl-item">
          <a class="nxl-link" href="<?= base_url('index.php/User_authentication/admin_dashboard') ?>">
            <i class="feather-activity"></i>
            <span class="nxl-mtext"><?= $this->lang->line('master_dashboard') ?></span>
          </a>
        </li>

        <!-- Account Settings -->
        <li class="nxl-item nxl-hasmenu">
          <a href="javascript:void(0);" class="nxl-link">
            <i class="feather-settings"></i>
            <span class="nxl-mtext"><?= $this->lang->line('account_settings') ?></span>
            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
          </a>
          <ul class="nxl-submenu">
            <li class="nxl-item">
              <a class="nxl-link" href=" <?= base_url('index.php/Meenus/index') ?>">
                <i class="feather-menu"></i><?= $this->lang->line('menus') ?>
              </a>
            </li>
            <li class="nxl-item">
              <a class="nxl-link" href="<?= base_url('index.php/Meenus/UserRights') ?>">
                <i class="feather-key"></i> <?= $this->lang->line('user_rights') ?>
              </a>
            </li>
            <li class="nxl-item">
              <a class="nxl-link active" href="<?= base_url('index.php/User_authentication/role_master') ?>">
                <i class="feather-circle"></i> <?= $this->lang->line('role_master') ?>
              </a>
            </li>
          </ul>
        </li>

        <!-- SCM Module Main Item -->
        <li class="nxl-item nxl-hasmenu">
          <a href="javascript:void(0);" class="nxl-link">
            <span class="nxl-micon"><i class="feather-users"></i></span>
            <span class="nxl-mtext"><?= $this->lang->line('scm_module') ?></span>
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
                  <a class="nxl-link" href="<?= base_url('index.php/Job_orders/add') ?>">
                    <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Job_orders/index') ?>">
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
                <span class="nxl-mtext"><?= $this->lang->line('maintenance_history_record') ?></span>
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
            <span class="nxl-mtext"><?= $this->lang->line('hr_module') ?></span>
            <span class="nxl-arrow"><i class="feather-chevron-down"></i></span>
          </a>
          <ul class="nxl-submenu">

            <!-- Employees -->
            <li class="nxl-item nxl-hasmenu">
              <a href="javascript:void(0);" class="nxl-link">
                <i class="feather-user"></i>
                <span class="nxl-mtext"><?= $this->lang->line('employees') ?></span>
                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
              </a>
              <ul class="nxl-submenu">
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Employees/add') ?>">
                    <i class="feather-plus-circle"></i> <?= $this->lang->line('add') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Employees/index') ?>">
                    <i class="feather-list"></i> <?= $this->lang->line('view_list') ?>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Leave Module -->
            <li class="nxl-item nxl-hasmenu">
              <a href="javascript:void(0);" class="nxl-link">
                <i class="feather-diamond"></i>
                <span class="nxl-mtext"><?= $this->lang->line('leave_module') ?></span>
                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
              </a>
              <ul class="nxl-submenu">
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Leave/holidays') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('holidays') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Leave/balance') ?>">
                    <i class="feather-circle"></i><?= $this->lang->line('leave_balance') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Leave/index') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('leave_applications') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Leave/types') ?>">
                    <i class="feather-circle"></i><?= $this->lang->line('leave_types') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Leave/leave_allotment') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('leave_allotment') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Leave/Approval') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('leave_approval') ?>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Daily Tasks -->
            <li class="nxl-item nxl-hasmenu">
              <a href="javascript:void(0);" class="nxl-link">
                <i class="feather-file-text"></i>
                <span class="nxl-mtext"><?= $this->lang->line('daily_tasks') ?></span>
                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
              </a>
              <ul class="nxl-submenu">
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Dailytasks/projects') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('projects') ?>
                  </a>
                </li>
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Dailytasks/tasks') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('tasks') ?>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Payroll Module -->
            <li class="nxl-item nxl-hasmenu">
              <a href="javascript:void(0);" class="nxl-link">
                <i class="feather-file-text"></i>
                <span class="nxl-mtext"><?= $this->lang->line('payroll_module') ?></span>
                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
              </a>
              <ul class="nxl-submenu">
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/PayrollController/index') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('attendance_list') ?>
                  </a>
                </li>
                <!-- Add more payroll submenus as needed -->
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/PayrollController/show_calculation') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('payroll_calculation') ?>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nxl-item nxl-hasmenu">
              <a href="javascript:void(0);" class="nxl-link">
                <i class="feather-file-text"></i>
                <span class="nxl-mtext"><?= $this->lang->line('workers') ?></span>
                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
              </a>
              <ul class="nxl-submenu">
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Workers/add') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('add') ?>
                  </a>
                </li>
                <!-- Add more payroll submenus as needed -->
                <li class="nxl-item">
                  <a class="nxl-link" href="<?= base_url('index.php/Workers/index') ?>">
                    <i class="feather-circle"></i> <?= $this->lang->line('view_list') ?>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <!-- customer support -->
        <li class="nxl-item nxl-hasmenu">
          <a href="javascript:void(0);" class="nxl-link">
            <i class="feather-file-text"></i>
            <span class="nxl-mtext"><?= $this->lang->line('customer_support') ?></span>
            <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
          </a>
          <ul class="nxl-submenu">

            <!-- Add more payroll submenus as needed -->
            <li class="nxl-item">
              <a class="nxl-link" href="<?= base_url('index.php/CustomerSupport_controller/index') ?>">
                <i class="feather-circle"></i> <?= $this->lang->line('view_list') ?>
              </a>
            </li>
          </ul>
        </li>
    </div>

  </div>
  </div>
</nav>