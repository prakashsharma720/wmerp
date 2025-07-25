<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->load->model('Employee');
$CI->load->helper('MY_array');
$languages = [
    ['flag' => 'us', 'code'=>'english','name' => 'English'],
    ['flag' => 'bg', 'code'=>'bulg','name' => 'Bulgerian'],
    ['flag' => 'in', 'code'=>'hindi','name' => 'Hindi'],
];
$selected_lang_code = strtolower($CI->session->userdata('site_language') ?? 'english');
$selected_lang = array_filter($languages, fn($l) => strtolower($l['code']) === $selected_lang_code);
$selected_lang = reset($selected_lang) ?: ['flag' => 'us', 'name' => 'English'];
// echo "dbd".$language_label;exit;
$logged_in = $CI->session->userdata('logged_in') ?? [];
$user_id = $logged_in['id'] ?? null;
$role_id = $logged_in['role_id'] ?? null;

$userData = $user_id ? $CI->Employee->getById($user_id) : [];
$name = $userData['name'] ?? 'User';
$email = $userData['email'] ?? '';
$username = $userData['username'] ?? '';
$designation = $userData['designation'] ?? '';
$photo = $userData['photo'] ?? 'default.jpg';

$allnotifications = $CI->dynamic_menu->getNoti();

?>

<header class="nxl-header">
    <div class="header-wrapper">
        <!-- Left Section -->
        <div class="header-left d-flex align-items-center gap-4">
            <!-- Mobile Menu -->
            <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                <div class="hamburger hamburger--arrowturn">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>

            <!-- Navigation Toggle -->
            <div class="nxl-navigation-toggle">
                <a href="javascript:void(0);" id="menu-mini-button"><i class="feather-align-left"></i></a>
                <a href="javascript:void(0);" id="menu-expend-button" style="display: none"><i class="feather-arrow-right"></i></a>
            </div>

            <!-- Mega Menu (Mobile) -->
            <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open"><i class="feather-align-left"></i></a>
            </div>

            <!-- Mega Menu Content -->
            <div class="nxl-drp-link nxl-lavel-mega-menu">
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide"><i class="feather-arrow-left me-2"></i><span>Back</span></a>
                </div>
                <div class="nxl-lavel-mega-menu-wrapper d-flex gap-3">
                    <div class="dropdown nxl-h-item nxl-lavel-menu">
                        <a href="javascript:void(0);" class="avatar-text avatar-md bg-primary text-white" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <i class="feather-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="header-right ms-auto">
            <div class="d-flex align-items-center">
               <div class="dropdown nxl-h-item nxl-header-language d-none d-sm-flex">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown">
                            <div class="avatar-image avatar-sm">
                                <img src="<?= base_url("assets2/vendors/img/flags/1x1/" . ($selected_lang_code === 'bulg' ? 'bg' : ($selected_lang_code === 'hindi' ? 'in' : 'us')) . ".svg") ?>" class="img-fluid wd-20" alt="Lang" />
                            </div> 
                            <!-- &nbsp;<span><?= $selected_lang_code ?></span> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-language-dropdown" data-bs-auto-close="outside" style="margin-top:-20px;">
                            <div class="language-items-wrapper">
                                <div class="select-language px-4 py-2 hstack justify-content-between gap-4">
                                    <div>
                                        <h6 class="mb-0">Select Language</h6>
                                        <p class="fs-11 text-muted mb-0"><?= count($languages) ?> languages available!</p>
                                    </div>
                                    <a href="javascript:void(0);" class="avatar-text avatar-md" title="Add Language"><i class="feather-plus"></i></a>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="row px-4 pt-3">
                                    <?php foreach ($languages as $lang): ?>
                                        <div class="col-sm-4 col-6 language_select <?= strtolower($selected_lang_code) == strtolower($lang['code']) ? 'active' : '' ?>">
                                            <a href="<?= site_url('AdminController/change_language/') . $lang['code'] ?>" class="d-flex align-items-center gap-2">
                                                <div class="avatar-image avatar-sm">
                                                    <img src="<?= base_url("assets2/vendors/img/flags/1x1/{$lang['flag']}.svg") ?>" class="img-fluid" alt="<?= $lang['name'] ?>" />
                                                </div>
                                                <span><?= $lang['name'] ?></span>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Language Switcher -->
                <!-- <div class="dropdown nxl-h-item nxl-header-language d-none d-sm-flex">

                    <a href="javascript:void(0);" class="nxl-head-link me-0" data-bs-toggle="dropdown">
                        <img src="<?= base_url("assets2/vendors/img/flags/4x3/us.svg") ?>" class="img-fluid wd-20" alt="Lang" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-language-dropdown">
                        <div class="language-items-wrapper">
                            <div class="select-language px-4 py-2 hstack justify-content-between gap-4">
                                <div>
                                    <h6 class="mb-0">Select Language</h6>
                                    <p class="fs-11 text-muted mb-0">3 languages available!</p>
                                </div>
                                <a href="javascript:void(0);" class="avatar-text avatar-md" title="Add Language"><i class="feather-plus"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="row px-4 pt-3">
                                <?php foreach ($languages as $lang): ?>
                                    <div class="col-sm-4 col-6 language_select <?= strtolower($language) == strtolower($lang['name']) ? 'active' : '' ?>">
                                        <a href="<?= site_url('AdminController/change_language/').$lang['code'] ?>" class="d-flex align-items-center gap-2">
                                            <div class="avatar-image avatar-sm"><img src="<?= base_url("assets2/vendors/img/flags/1x1/{$lang['flag']}.svg") ?>" class="img-fluid" alt="" /></div>
                                            <span><?= $lang['name'] ?></span>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- Fullscreen Toggle -->
                <div class="nxl-h-item d-none d-sm-flex">
                    <div class="full-screen-switcher">
                        <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                            <i class="feather-maximize maximize"></i>
                            <i class="feather-minimize minimize"></i>
                        </a>
                    </div>
                </div>

                <!-- Theme Switch -->
                <div class="nxl-h-item dark-light-theme">
                    <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button"><i class="feather-moon"></i></a>
                    <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none"><i class="feather-sun"></i></a>
                </div>

                <!-- Notifications -->
                <div class="dropdown nxl-h-item">
                    <a class="nxl-head-link me-3" data-bs-toggle="dropdown">
                        <i class="feather-bell"></i>
                        <span class="badge bg-danger nxl-h-badge"><?= count($allnotifications); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                        <div class="d-flex justify-content-between notifications-head">
                            <h6 class="fw-bold text-dark mb-0">Notifications</h6>
                            <a href="javascript:void(0);" class="fs-11 text-success" title="Mark as Read">
                                <i class="feather-check"></i><span>Mark as Read</span>
                            </a>
                        </div>
                        <div class="notifications-scrollable" style="max-height: 300px; overflow-y: auto;">
                            <?php if ($allnotifications): ?>
                                <?php foreach (array_slice($allnotifications, 0, 5) as $notification): ?>
                                    <?php
                                    $isEmp = in_array($role_id, [4, 5]) && ($notification['employee_id'] == $user_id || $notification['created_by'] == $user_id);
                                    $avatar = get_avatar_url($notification['creator_photo'] ?? '');
                                    ?>
                                    <div class="notifications-item">
                                        <img src="<?= $avatar ?>" class="rounded me-3 border" alt="" />
                                        <div class="notifications-desc">
                                            <a href="<?= base_url('index.php/' . $notification['page_url']) ?>" class="font-body text-truncate-2-line">
                                                <span class="fw-semibold text-dark"><?= $isEmp ? 'You' : htmlspecialchars($notification['creator']) ?></span>
                                                <?= htmlspecialchars($notification['message']) ?>
                                            </a>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="notifications-date text-muted border-bottom border-bottom-dashed"><?= time_Ago(strtotime($notification['datetime'])) ?></div>
                                                <div class="d-flex gap-2">
                                                    <a href="javascript:void(0);" class="d-block wd-8 ht-8 rounded-circle bg-gray-300" title="Mark as Read"></a>
                                                    <a href="javascript:void(0);" class="text-danger" title="Remove"><i class="feather-x fs-12"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-muted p-3">
                                    <h6>No Notifications</h6>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="text-center notifications-footer">
                            <a href="<?= base_url('index.php/Notifications/index') ?>" class="fs-13 fw-semibold text-dark">All Notifications</a>
                        </div>
                    </div>
                </div>

                <!-- User Profile -->
                <div class="dropdown nxl-h-item">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown"><img src="<?= get_avatar_url($photo) ?>" class="img-fluid user-avtar me-0" alt="user" /></a>
                    <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                        <div class="dropdown-header d-flex align-items-center">
                            <img src="<?= get_avatar_url($photo) ?>" class="img-fluid user-avtar" alt="user" />
                            <div>
                                <h6 class="text-dark mb-0"><?= strlen($name) > 8 ? substr($name, 0, 8) . '...' : $name ?><span class="badge bg-soft-success text-success ms-1">PRO</span></h6>
                                <span class="fs-12 text-muted"><?= $email ?></span>
                            </div>
                        </div>
                        <a href="<?= base_url('index.php/User_authentication/MyPasswordChangeView') ?>" class="dropdown-item"><i class="feather-user"></i><span>Change Password</span></a>
                        <a href="<?= base_url('index.php/Notifications/index') ?>" class="dropdown-item"><i class="feather-bell"></i><span>Notifications</span></a>
                        <a href="<?= base_url('index.php/Employees/edit/' . $user_id) ?>" class="dropdown-item"><i class="feather-settings"></i><span>Account Settings</span></a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('index.php/User_authentication/logout') ?>" class="dropdown-item"><i class="feather-log-out"></i><span>Logout</span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>