<?php
if ($this->session->userdata('usertimezone') == null) {
    $_SESSION['usertimezone'] = json_decode(get_cookie('logged'))->usertimezone;
    $_SESSION['offset_zone'] = json_decode(get_cookie('logged'))->offset_zone;
    if ($this->session->userdata('usertimezone') == null) {
        $_SESSION['usertimezone'] = "UTC";
        $_SESSION['offset_zone'] = "GMT";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>nSmarTrac</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/main.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/media.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/general-style.css") ?>">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/boxicons.min.css") ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap.min.css") ?>" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= base_url("assets/css/v2/google-font.css") ?>" rel="stylesheet">
    <!-- Sweet Alert --> 
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/sweetalert2.min.css") ?>">
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap-datepicker.min.css") ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url("assets/plugins/select2/dist/css/select2.min.css") ?>" />
    <!-- Switchery -->
    <link rel="stylesheet" href="<?= base_url("assets/plugins/switchery/switchery.min.css") ?>">
    <!-- Jquery JS -->
    <script src="<?= base_url("assets/js/v2/jquery-3.6.0.min.js") ?>"></script>
    <!-- Bootstrap toggle -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    <script>
        var base_url = '<?= base_url() ?>';
    </script>
</head>
<style>
.nsm-nav .profile-img {
    width: 50px;
    height: 50px;
}
</style>
<body>
    <div class="nsm-container">
        <div class="nsm-sidebar-bg general-transition"></div>
        <div class="nsm-sidebar general-transition" style="padding:1rem;">
            <div class="nsm-sidebar-logo">
                <a href="javascript:void(0);" class="sidebar-toggler">
                    <i class='bx bx-fw bx-menu-alt-left'></i>
                </a>
                <a class="nsm-logo-link" href="<?= base_url("acs_access/dashboard") ?>">
                    <img class="nsm-logo" src="<?= base_url("assets/images/v2/logo.png") ?>">
                </a>
            </div>

            <ul class="nsm-sidebar-menu">
                <li>
                    <a href="<?= base_url("admin/dashboard") ?>">
                        <i class='bx bx-fw bx-tachometer'></i> Dashboard
                    </a>
                </li>
                <li class="<?= $page_title == 'Companies' ? 'selected' : ''; ?>">
                    <a href="<?= base_url("admin/companies") ?>">
                        <i class='bx bx-fw bxs-buildings'></i> Companies
                    </a>
                </li>
                <li class="<?= $page_title == 'Users' ? 'selected' : ''; ?>">
                    <a href="<?= base_url("admin/users") ?>">
                        <i class='bx bx-fw bx-user'></i> Users
                    </a>
                </li>
                <li class="<?= $page_title == 'Companies' ? 'selected' : ''; ?>">
                    <a href="<?= base_url("admin/companies") ?>">
                        <i class='bx bx-fw bxs-buildings'></i> Companies
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" class="btn-company-user-switch">
                        <i class='bx bx-fw bx-user' style="vertical-align:top; line-height: 39px;"></i> <span style="display: inline-block;width: 85%;">Switch back as Company User</span>
                    </a>
                </li>
                <li class="<?php if($page_parent == 'Settings'): echo 'active'; endif; ?>">
                    <a href="#">
                        <i class='bx bx-fw bx-tachometer'></i> Settings
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if($page_title == 'Settings : Addons'): echo 'selected'; endif; ?>">
                            <a href="<?= base_url("admin/nsmart_addons") ?>">
                                <i class='bx bx-fw bx-list-plus'></i> Addons
                            </a>
                        </li>
                        <li class="<?php if($page_title == 'Settings : Industry Modules'): echo 'selected'; endif; ?>">
                            <a href="<?= base_url("admin/industry_modules") ?>">
                                <i class='bx bx-fw bx-buildings'></i> Industry Modules
                            </a>
                        </li>
                        <li class="<?php if($page_title == 'Settings : Industry Templates'): echo 'selected'; endif; ?>">
                            <a href="<?= base_url("admin/industry_templates") ?>">
                                <i class='bx bx-fw bx-buildings'></i> Industry Templates
                            </a>
                        </li>
                        <li class="<?php if($page_title == 'Settings : Industry Types'): echo 'selected'; endif; ?>">
                            <a href="<?= base_url("admin/industry_types") ?>">
                                <i class='bx bx-fw bx-buildings'></i> Industry Types
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="nsm-main general-transition">
            <div class="nsm-nav">
                <div class="nsm-nav-menu">
                    <a href="javascript:void(0);" class="sidebar-toggler">
                        <i class='bx bx-fw bx-menu-alt-left'></i>
                    </a>
                </div>
                <div class="nsm-page-title">
                    <h4><?= $page_title ?></h4>
                    <?php 
                    if($page_title == 'Dashboard'):
                    ?>
                    <span>Welcome test!</span>
                    <?php
                    else:
                    ?>
                    <?= $page_message; ?>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="nsm-nav-items">
                    <ul>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <?php
                                    $image = null;
                                    if (is_null($image)) {
                                    ?>
                                        <div class="profile-img" style="background-image: url('<?= base_url('assets/img/default-customer.png'); ?>')">
                                            <span></span>
                                        <?php
                                    } else {
                                        ?>
                                            <div class="profile-img" style="background-image: url('<?php echo $image; ?>')">
                                            <?php
                                        }
                                            ?>
                                            </div>
                                </a>
                                <div class="dropdown-menu dropdown-list">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold"><?= adminLogged('FName') . ' ' . adminLogged('LName'); ?></h6>
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url() ?>'">
                                        nSmart Home
                                    </div>
                                    <div class="list-item">
                                        Join Our Community
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('/admin/logout') ?>'">
                                        Logout
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nsm-content">