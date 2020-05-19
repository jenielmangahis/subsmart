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
	.navigation-menu{
		-ms-flex-pack: flex-start !important;
	justify-content: flex-start !important;
	}
	#topnav .navigation-menu > li > a {
		padding: 9px 30px !important;
		display: block;
		flex-direction: column;
		color: #fff;
		text-align:center
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
</style>
<div class="navbar-custom col" >
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu d-flex justify-content-center">
                
				 <?php if (hasPermissions('plan_list')): ?><li class="has-submenu"><a href="<?php echo url('/workcalender') ?>"><i class="fa fa-bookmark" aria-hidden="true"></i> <span>Schedule</span></a></li><?php endif ?>
				<li class="has-submenu"> 
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Sales</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown">
						<a class="dropdown-item" href="<?php echo base_url('customer') ?>"><i class="mdi mdi-wallet m-r-5"></i> Customers</a>
						<a class="dropdown-item" href="<?php echo base_url('estimate') ?>"><i class="mdi mdi-wallet m-r-5"></i> Estimates</a>
						<?php if (hasPermissions('WORKORDER_MASTER')): ?><a class="dropdown-item" href="<?php echo url('/workorder') ?>"><i class="mdi mdi-wallet m-r-5"></i> Work Orders</a><?php endif ?>
                        
						<a class="dropdown-item" href="#"><i class="mdi mdi-wallet m-r-5"></i> Invoices</a>
						<?php if (hasPermissions('items_list')): ?><a class="dropdown-item" href="<?php echo url('/items') ?>"><i class="mdi mdi-wallet m-r-5"></i> Items</a><?php endif ?>
						<?php if (hasPermissions('plan_list')): ?><a class="dropdown-item" href="<?php echo url('/plans') ?>"><i class="mdi mdi-wallet m-r-5"></i> Plans</a><?php endif ?>
						<?php if (hasPermissions('plan_list')): ?><a class="dropdown-item" href="<?php echo url('/workstatus') ?>"><i class="mdi mdi-wallet m-r-5"></i> Workorder Type</a><?php endif ?>
					</div>
				</li>
				<li class="has-submenu"><a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span>Expenses</span></a></li>
				<li class="has-submenu"><a href="#"><i class="fa fa-industry" aria-hidden="true"></i> <span>Inquiries</span></a></li>
				<?php if (hasPermissions('report')): ?><li class="has-submenu"><a href="<?php echo url('report/workorder') ?>"><i class="fa fa-bookmark" aria-hidden="true"></i><span>Reports</span></a></li><?php endif ?>
				<li class="has-submenu"><a href="#"><i class="fa fa-file-code-o" aria-hidden="true"></i> <span>Marketing</span></a></li>
				<li class="has-submenu"> 
					<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa fa-ellipsis-h" aria-hidden="true"></i> <span>More</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right profile-dropdown">
						<?php if (hasPermissions('businessdetail')): ?><a class="dropdown-item" href="<?php echo url('/users/businessview') ?>"><i class="mdi mdi-wallet m-r-5"></i> My Business</a><?php endif ?>
						<a class="dropdown-item" href="<?php echo url('/dashboard') ?>"><i class="mdi mdi-wallet m-r-5"></i> Before/After</a>
						<?php if (hasPermissions('users_list')): ?><a class="dropdown-item" href="<?php echo url('/users') ?>"><i class="mdi mdi-wallet m-r-5"></i> Employees</a><?php endif ?>
						<a class="dropdown-item" href="<?php echo url('/dashboard') ?>"><i class="mdi mdi-wallet m-r-5"></i> Share A Job</a>
						<a class="dropdown-item" href="<?php echo url('/dashboard') ?>"><i class="mdi mdi-wallet m-r-5"></i> Add-ons</a>
						<?php if (hasPermissions('roles_list')): ?>
							<a class="dropdown-item" href="<?php echo url('roles') ?>">Manage Roles</a>
						<?php endif ?>
						<?php if (hasPermissions('activity_log_list')): ?>
                     
                        <a  class="dropdown-item" href="<?php echo url('activity_logs') ?>">Activity Logs</a>
                        <a  class="dropdown-item" href="<?php echo url('vault') ?>">Files Vault</a>
                    
                <?php endif ?>
						<?php if (hasPermissions('permissions_list')): ?>
							<a class="dropdown-item" href="<?php echo url('permissions') ?>">Manage Permissions</a>
						<?php endif ?>
						
						<a class="dropdown-item" href="<?php echo url('/dashboard') ?>"><i class="mdi mdi-wallet m-r-5"></i> My Account</a>
					</div>
				</li>
				
				<!--
                <li class="has-submenu" <?php echo ($page->menu=='dashboard')?'class="active"':'' ?>>
                    <a href="<?php echo url('/dashboard') ?>">
                    <i class="fa fa-bookmark" aria-hidden="true"></i> <span>Dashboard</span>
                    </a>
                </li>

                <?php if (hasPermissions('users_list')): ?>
                    <li  class="has-submenu" <?php echo ($page->menu=='users')?'class="active"':'' ?>>
                        <a href="<?php echo url('users') ?>">
                            <i class="fa fa-user" aria-hidden="true"></i> <span>Users</span>
                        </a>
                    </li>	 
                <?php endif ?>

                
                <?php if (hasPermissions('WORKORDER_MASTER')): ?>
                    <li class="has-submenu" <?php echo ($page->menu=='workorder')?'class="active"':'' ?>>
                    <a href="<?php echo url('workorder') ?>">
                        <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Workorder</span>
                    </a>
                    </li>	 
                <?php endif ?>  

                <?php if (hasPermissions('report')): ?>
                    <li class="has-submenu" <?php echo ($page->menu=='report')?'class="active"':'' ?>>
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bar-chart" aria-hidden="true"></i> <span>Reports</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                            <a class="dropdown-item" href="<?php echo url('report/workorder') ?>"><i class="mdi mdi-wallet m-r-5"></i> Workorder</a>
						</div>
                    </li>	 
                <?php endif ?>          

                <?php if (hasPermissions('activity_log_list')): ?>
                    <li class="has-submenu" <?php echo ($page->menu=='activity_logs')?'class="active"':'' ?>>
                        <a href="<?php echo url('activity_logs') ?>">
                        <i class="fa fa-history" aria-hidden="true"></i><span>Activity Logs</span>
                        </a>
                    </li>
                <?php endif ?>

                <?php if (hasPermissions('roles_list')): ?>
                    <li class="has-submenu" <?php echo ($page->menu=='roles')?'class="active"':'' ?>>
                        <a href="<?php echo url('roles') ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i><span>Manage Roles</span>
                        </a>
                    </li>
                <?php endif ?>

                <?php if (hasPermissions('permissions_list')): ?>
                    <li class="has-submenu" <?php echo ($page->menu=='permissions')?'class="active"':'' ?>>
                        <a href="<?php echo url('permissions') ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i><span>Manage Permissions</span>
                        </a>
                    </li>
                <?php endif ?>
				<?php if (hasPermissions('businessdetail')): ?>
                    <li class="has-submenu" <?php echo ($page->menu=='businessview')?'class="active"':'' ?>>
                        <a href="<?php echo url('users/businessview') ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i><span>My business</span>
                        </a>
                    </li>
                <?php endif ?>
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

