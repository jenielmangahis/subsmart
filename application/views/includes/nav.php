<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$user_id = getLoggedUserID();
?>
<style>
    .dropdown-item {
        color: #000 !important;
    }

    #topnav .navigation-menu > li > a {
        padding-left: 15px;
    }

    .navigation-menu {
        -ms-flex-pack: flex-start !important;
        justify-content: flex-start !important;
    }

    #topnav .navigation-menu > li > a {
        padding: 9px 20px !important;
        display: block;
        flex-direction: column;
        color: #fff;
        text-align: center;
        font-size: 13px !important;
    }

    #topnav .navigation-menu > li > a i {
        font-size: 15px;
        vertical-align: baseline;
        margin-right: 0;
        -webkit-transition: all 0.5s ease;
        transition: all 0.5s ease;
        width: 100%;
        display: block;
        margin-bottom: 8px;
    }

    #topnav .navigation-menu > li .dropdown-toggle::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
        position: absolute;
        bottom: 15px;
    }

    .notification-list .nav-link i {
        padding: 12px 0;
        color: #fff;
        font-size: 28px;
        top: 6px;
        position: relative;
    }

    #topnav .dropdown-menu svg {
        width: 20px;
        height: 20px;
        margin-right: 8px;
    }
    .icons-list-navbar span {
        color:black !important;
    }
</style>
<div class="navbar-custom col">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu d-flex justify-content-center">

                <?php ////if (hasPermissions('plan_list')): ?>
                <li class="has-submenu">
                    <div class="icons-list-navbar" style="margin-right:20px; align-items: center;justify-content: center">
                        <a href="<?php echo url('/workcalender') ?>">
                            <!--                            <i class="fa fa-calendar" aria-hidden="true"></i><span>Calendar</span>-->
                            <!--                                <img class="calendar-static" src="/assets/css/icons/images/calendar-1.1s-47px.svg" alt="">-->
                            <!--                                <img class="calendar-active" src="/assets/css/icons/images/calendar-1.1s-47px-active.svg" alt="">-->
                            <time datetime="<?php echo date('Y-m-d')?>" class="icon-calendar-live" style="font-size:7px; margin-bottom: 6px;">
                                <em><?php echo date('l')?></em>
                                <strong><?php echo date('M')?></strong>
                                <span style="color:black !important;"><?php echo date('d')?></span>;
                            </time>
                            <span>Calendar</span>
                        </a>
                    </div>
                </li>
                <?php //endif ?>
                <li class="has-submenu">
                    <div class="icons-list-navbar dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false">
                        <a href="<?php echo base_url('dashboard/blank/?page=Sales') ?>">
                            <!--                        <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales</span>-->
                            <img style="width: 60px;" class="bar-static" src="<?php echo base_url('assets/css/icons/sales.svg') ?>" alt="">
                            <img style="width: 65px;" class="bar-active" src="<?php echo base_url('assets/css/icons/sales.svg') ?>" alt="">
                            <span>Sales</span>
                        </a>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!--<a class="dropdown-item" href="<?php echo base_url('customer') ?>"><i class="fa fa-users"></i> Customer Manager</a>-->
                        <a class="dropdown-item" href="<?= base_url('events') ?>"><i class="fa fa-calendar-check-o"></i> Events</a>
                        <a class="dropdown-item" href="<?php echo base_url('job') ?>"><i class="fa fa-briefcase"></i> Jobs</a>
                        <a class="dropdown-item" href="<?php echo base_url('estimate') ?>"><i class="fa fa-list-alt"></i> Estimates</a>
                        <?php ////if (hasPermissions('WORKORDER_MASTER')): ?>
                        <a class="dropdown-item" href="<?php echo url('/workorder') ?>"><i class="fa fa-list-alt"></i><b> Work Orders</b></a>
                        <?php //endif ?>
                        <a class="dropdown-item" href="<?php echo base_url('invoice') ?>"><i class="fa fa-file-text-o"></i><b> Invoices</b></a>
                        <?php ////if (hasPermissions('items_list')): ?>
                        <!-- <a class="dropdown-item" href="<?php echo url('/items') ?>"><i class="fa fa-cubes"></i><b> Items</b></a> -->
                        <?php //endif ?>
                        <?php ////if (hasPermissions('plan_list')): ?>
                        <!-- <a class="dropdown-item" href="<?php echo url('/plans') ?>"><i class="fa fa-list"></i> Plans</a> -->
                        <?php //endif ?>
                        <?php ////if (hasPermissions('items_list')): ?>
                        <a class="dropdown-item" href="<?php echo url('customer/ticketslist') ?>"><i class="fa fa-ticket"></i> Tickets</a>
                        <a class="dropdown-item" href="<?php echo url('credit_notes') ?>"><i class="fa fa-list"></i> Credit Notes</a>
                        <?php //endif ?>
                        <?php ////if (hasPermissions('items_list')): ?>
                        <a class="dropdown-item" href="<?php echo url('customer/leads') ?>"><i class="fa fa-bullhorn"></i> Leads</a>
                        <?php //endif ?>
                        <?php ////if (hasPermissions('items_list')): ?>
                        <?php /*<a class="dropdown-item" href="<?php //echo url('services') ?>"><i class="fa fa-user-circle-o"></i> Leads</a>*/?>
                        <?php //endif ?>
                        <?php ////if (hasPermissions('plan_list')): ?>
                        <a class="dropdown-item" href="<?php echo url('/workstatus') ?>"><i class="fa fa-check m-r-5"></i> Status</a>
                        <?php //endif ?>
                    </div>
                </li>
                <li class="has-submenu">
                    <div class="icons-list-navbar">
                        <a href="<?= base_url('customer') ?>" role="button" >
<!--                            <img class="cash-static" src="<?php echo base_url('assets/css/icons/images/cash-1.1s-47px.svg') ?>" alt="" style="margin: 0 auto">
                            <img class="cash-active" src="<?php echo base_url('assets/css/icons/images/cash-1.1s-47px-active.svg') ?>" alt="">-->
                            <img style="width:60px;" class="cash-static" src="<?php echo base_url('assets/css/icons/customer.svg') ?>" alt="">
                            <img style="width: 65px;" class="cash-active" src="<?php echo base_url('assets/css/icons/customer.svg') ?>" alt="">
                            <span>Customers</span>
                        </a>
                    </div>
                   
                </li>
                <li class="has-submenu">
                    <div class="icons-list-navbar">
                        <a href="<?php echo url('/accounting/banking') ?>" role="button" >
<!--                            <img class="cash-static" src="<?php echo base_url('assets/css/icons/images/cash-1.1s-47px.svg') ?>" alt="" style="margin: 0 auto">
                            <img class="cash-active" src="<?php echo base_url('assets/css/icons/images/cash-1.1s-47px-active.svg') ?>" alt="">-->
                            <img style="width:60px;" class="cash-static" src="<?php echo base_url('assets/img/accounting/accounting_nav.svg') ?>" alt="">
                            <img style="width: 65px;" class="cash-active" src="<?php echo base_url('assets/img/accounting/accounting_nav.svg') ?>" alt="">
                            <span>Accounting</span>
                        </a>
                    </div>
                 
                </li>
                <li class="has-submenu">
                    <div class="icons-list-navbar">
                        <a href="<?php echo base_url('vault') ?>">
                            <img style="width:60px;" class="cash-static" src="<?php echo base_url('assets/css/icons/file_vault.svg') ?>" alt="">
                            <img style="width: 65px;" class="cash-active" src="<?php echo base_url('assets/css/icons/file_vault.svg') ?>" alt="">
                            <span>Files Vault</span>
                            <!--                            <i class="fa fa-industry" aria-hidden="true"></i><span>Files Vault</span>-->
                        </a>
                    </div>
                    <?php /*<a class="dropdown-toggle" href="<?php //echo base_url('vault') ?>" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-industry" aria-hidden="true"></i> <span>Files Vault</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown" style="width: auto;">
                        <a class="dropdown-item" href="<?php echo base_url('vault') ?>"><i class="mdi mdi-wallet m-r-5"></i><b>Files Vault</b></a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> Shared Library</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> My Library</a>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> Before and After Photos</a>
                    </div>*/ ?>
                </li>
                <!--<?php ////if (hasPermissions('report')): ?>
                    <li class="has-submenu">
                        <a href="<?php echo url('reports/main') ?>"><i class="fa fa-bookmark" aria-hidden="true"></i><span>Reports</span></a>
                    </li>
                <?php //endif ?>-->
                <li class="has-submenu">
                    <div class="icons-list-navbar">
                        <a href="<?php echo base_url('marketing') ?>">
                            <img style="width:60px;" class="marketing-static" src="<?php echo base_url('assets/css/icons/marketing.svg') ?>" alt="" style="margin: 0 auto">
                            <img style="width: 65px;" class="marketing-active" src="<?php echo base_url('assets/css/icons/marketing.svg') ?>" alt="">
                            <span>Marketing</span>
                            <!--                        <i class="fa fa-file-code-o" aria-hidden="true"></i> <span>Marketing</span>-->
                        </a>
                    </div>
                    <?php /*<a class="dropdown-toggle" href="<?php //echo base_url('dashboard/blank/?page=More') ?>" role="button"
                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-cog" aria-hidden="true"></i> <span>Marketing</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <a class="dropdown-item" href="<?php echo base_url('marketing') ?>"><i class="mdi mdi-wallet m-r-5"></i> <b>Marketing</b></a>
                        <a class="dropdown-item" href="<?php //echo base_url('marketing') ?>"><i class="mdi mdi-wallet m-r-5"></i> <b>API Connectors</b></a>
                    </div>*/ ?>
                </li>
                <li class="has-submenu">
                    <!-- <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Tools</span></a> -->
                    <div class="icons-list-navbar dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a href="<?php //echo base_url('dashboard/blank/?page=More') ?>" >
                            <img style="width:60px;" class="tools-static" src="<?php echo base_url('assets/css/icons/tools.svg') ?>" alt="" style="margin: 0 auto">
                            <img style="width: 65px;" class="tools-active" src="<?php echo base_url('assets/css/icons/tools.svg') ?>" alt="">
                            <span>Tools</span>
                            <!--                        <i class="fa fa-cog" aria-hidden="true"></i> <span>Tools</span>-->
                        </a>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <a class="dropdown-item" href="<?php echo base_url('/tools/business_tools') ?>"><i class="mdi mdi-wallet m-r-5"></i> <b>Business Tools</b></a>
                        <a class="dropdown-item" href="<?php echo base_url('/esignmain') ?>"><i class="mdi mdi-wallet m-r-5"></i> eSign</a>
                        <a class="dropdown-item" href="<?php echo base_url('/affiliate') ?>"><i class="mdi mdi-wallet m-r-5"></i> Affiliates</a>
                        <a class="dropdown-item" href="<?php echo base_url('/inventory') ?>"><i class="mdi mdi-wallet m-r-5"></i> Inventory</a>
                        <a class="dropdown-item" href="<?php echo base_url('/fb') ?>"><i class="mdi mdi-wallet m-r-5"></i> Form Builder</a>
                        <a class="dropdown-item" href="<?php echo base_url('/tools/api_connectors') ?>"><i class="mdi mdi-wallet m-r-5"></i> API Connectors</a>
                        <a class="dropdown-item" href="<?php //echo base_url('/builder') ?>"><i class="mdi mdi-wallet m-r-5"></i><b>Mobile Tools</b></a>
                        <a class="dropdown-item" href="<?php echo base_url('/trac360'); ?>"><i class="mdi mdi-wallet m-r-5"></i><b>Trac 360</b></a>
                    </div>
                </li>

                <li class="has-submenu">
                    <div class="icons-list-navbar dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a href="<?php //echo base_url('dashboard/blank/?page=More') ?>">
                            <img style="width:60px;" class="building-static" src="<?php echo base_url('assets/css/icons/company.svg') ?>" alt="" style="margin: 0 auto">
                            <img style="width: 65px;" class="building-active" src="<?php echo base_url('assets/css/icons/company.svg') ?>" alt="">
                            <span>Company</span>
                            <!--                        <i class="fa fa-building-o" aria-hidden="true"></i> <span>Company</span>-->
                        </a>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">

                        <a class="dropdown-item" href="<?php echo url('/users/businessview') ?>">
                            <i class="mdi mdi-wallet m-r-5"></i><b> My Business </b>
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('/settings/email_templates') ?>">
                            <i class="mdi mdi-wallet m-r-5"></i><b> Settings </b>
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('/users') ?>">
                            <i class="mdi mdi-wallet m-r-5"></i><b> Employees </b>
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('/mycrm') ?>">
                            <i class="mdi mdi-wallet m-r-5"></i><b> My CRM </b>
                        </a>
                    </div>
                </li>
                <li class="has-submenu">
                    <div class="icons-list-navbar dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a href="<?php //echo base_url('dashboard/blank/?page=More') ?>" >
                            <img class="more-static" src="<?php echo base_url('assets/css/icons/more.svg') ?>" alt="" style="margin: 0 auto; width:60px; transform: rotate(180deg);">
                            <img class="more-active" src="<?php echo base_url('assets/css/icons/more.svg') ?>" alt="" style="margin: 0 auto; width:65px; transform: rotate(180deg);">
                            <span>More</span>
                            <!--                        <i class="fa fa fa-ellipsis-h" aria-hidden="true"></i> <span>More</span>-->
                        </a>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <a class="dropdown-item" href="<?php echo url('/more/upgrades') ?>">
                            <i class="fa fa-level-up"></i> Upgrades
                        </a>
                        <a class="dropdown-item" href="<?php echo url('/nsmart_plans/index') ?>">
                            <i class="fa fa-cubes"></i> Plan Builder
                        </a>
                        <!-- <a class="dropdown-item" href="<?php //echo url('/more/addons') ?>">
                            <i class="fa fa-user-plus"></i> Add-on
                        </a> -->
                    </div>
                    <?php /*<div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <?php //if (hasPermissions('businessdetail')): ?><a class="dropdown-item"
                                                                          href="<?php echo url('/users/businessview') ?>">
                                <i class="mdi mdi-wallet m-r-5"></i> My Business</a><?php //endif ?>
                        <a class="dropdown-item" href="<?php echo base_url('dashboard/blank/?page=Before/After') ?>"><i
                                    class="mdi mdi-wallet m-r-5"></i> Before/After</a>
                        <?php //if (hasPermissions('users_list')): ?><a class="dropdown-item"
                                                                      href="<?php echo url('/users') ?>"><i
                                        class="mdi mdi-wallet m-r-5"></i> Employees</a><?php endif ?>
                        <a class="dropdown-item" href="<?php echo base_url('dashboard/blank/?page=Share A Job') ?>"><i
                                    class="mdi mdi-wallet m-r-5"></i> Share A Job</a>
                        <a class="dropdown-item" href="<?php echo base_url('dashboard/blank/?page=Add-ons') ?>"><i
                                    class="mdi mdi-wallet m-r-5"></i> Add-ons</a>
                        <?php //if (hasPermissions('roles_list')): ?>
                            <a class="dropdown-item" href="<?php echo url('roles') ?>">Manage Roles</a>
                        <?php endif ?>
                        <?php //if (hasPermissions('activity_log_list')): ?>

                            <a class="dropdown-item" href="<?php echo url('activity_logs') ?>">Activity Logs</a>
                            <!-- <a class="dropdown-item" href="<?php echo url('vault') ?>">Files Vault</a> -->

                        <?php endif ?>
                        <?php //if (hasPermissions('permissions_list')): ?>
                            <a class="dropdown-item" href="<?php echo url('permissions') ?>">Manage Permissions</a>
                        <?php endif ?>

                        <a class="dropdown-item" href="<?php echo base_url('dashboard/blank/?page=My Account') ?>"><i
                                    class="mdi mdi-wallet m-r-5"></i> My Account</a>
                    </div>*/?>
                </li>

                <!--
                <li class="has-submenu" <?php echo ($page->menu == 'dashboard') ? 'class="active"' : '' ?>>
                    <a href="<?php echo url('/dashboard') ?>">
                    <i class="fa fa-bookmark" aria-hidden="true"></i> <span>Dashboard</span>
                    </a>
                </li>

                <?php //if (hasPermissions('users_list')): ?>
                    <li  class="has-submenu" <?php echo ($page->menu == 'users') ? 'class="active"' : '' ?>>
                        <a href="<?php echo url('users') ?>">
                            <i class="fa fa-user" aria-hidden="true"></i> <span>Users</span>
                        </a>
                    </li>    
                <?php //endif ?>

                
                <?php //if (hasPermissions('WORKORDER_MASTER')): ?>
                    <li class="has-submenu" <?php echo ($page->menu == 'workorder') ? 'class="active"' : '' ?>>
                    <a href="<?php echo url('workorder') ?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Workorder</span>
                    </a>
                    </li>    
                <?php //endif ?>  

                <?php //if (hasPermissions('report')): ?>
                    <li class="has-submenu" <?php echo ($page->menu == 'report') ? 'class="active"' : '' ?>>
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Reports</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                            <a class="dropdown-item" href="<?php echo url('report/workorder') ?>"><i class="mdi mdi-wallet m-r-5"></i> Workorder</a>
                        </div>
                    </li>    
                <?php //endif ?>          

                <?php //if (hasPermissions('activity_log_list')): ?>
                    <li class="has-submenu" <?php echo ($page->menu == 'activity_logs') ? 'class="active"' : '' ?>>
                        <a href="<?php echo url('activity_logs') ?>">
                        <i class="fa fa-history" aria-hidden="true"></i><span>Activity Logs</span>
                        </a>
                    </li>
                <?php //endif ?>

                <?php //if (hasPermissions('roles_list')): ?>
                    <li class="has-submenu" <?php echo ($page->menu == 'roles') ? 'class="active"' : '' ?>>
                        <a href="<?php echo url('roles') ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i><span>Manage Roles</span>
                        </a>
                    </li>
                <?php //endif ?>

                <?php //if (hasPermissions('permissions_list')): ?>
                    <li class="has-submenu" <?php echo ($page->menu == 'permissions') ? 'class="active"' : '' ?>>
                        <a href="<?php echo url('permissions') ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i><span>Manage Permissions</span>
                        </a>
                    </li>
                <?php //endif ?>
                <?php //if (hasPermissions('businessdetail')): ?>
                    <li class="has-submenu" <?php echo ($page->menu == 'businessview') ? 'class="active"' : '' ?>>
                        <a href="<?php echo url('users/businessview') ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i><span>My business</span>
                        </a>
                    </li>
                <?php //endif ?>
                -->

                <!-- <li class="has-submenu"><a href="#"><i class="fa fa-money" aria-hidden="true"></i>Expenses</a></li>
                <li class="has-submenu"><a href="#"><i class="fa fa-university" aria-hidden="true"></i>Inquiries</a></li>
                <li class="has-submenu"><a href="#"><i class="fa fa-bullhorn" aria-hidden="true"></i>Marketing</a></li>
                <li class="has-submenu"><a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i>Reports</a></li>
                <li class="has-submenu"><a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i>More</a></li> -->
            </ul><!-- End navigation menu -->
        </div><!-- end #navigation -->
    </div><!-- end container -->
</div><!-- end navbar-custom -->
