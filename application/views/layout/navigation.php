<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="<?php echo base_url() . "index.php/User_authentication/admin_dashboard"; ?>" class="b-brand">
                <!-- ========   change your logo here   ============ -->
                <img src="<?php echo base_url() . "uploads/"; ?>mlogo.jpg" alt="" class="logo logo-lg w-50" />
                <img src="<?php echo base_url() . "uploads/"; ?>mlogo.jpg" alt="" class="logo logo-sm" />
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


                <!-- SCM Module Main Item -->


                <!-- My Stock Module (SCM ke baad) -->


                <!-- PEA Module -->

                <!-- ENG Module Menu -->

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
                                    <a class="nxl-link"
                                        href="<?= base_url('index.php/PayrollController/show_calculation') ?>">
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

                <!-- Account Settings -->
                <!-- <li class="nxl-item nxl-hasmenu">
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
        </li> -->
        </div>

    </div>
    </div>
</nav>