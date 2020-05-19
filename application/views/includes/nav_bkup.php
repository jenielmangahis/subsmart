<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    $user_id = getLoggedUserID();   
?>
<ul class="sidebar-menu" data-widget="tree">
  
  <li class="header">Main Navigation</li>

  <li <?php echo ($page->menu=='dashboard')?'class="active"':'' ?>>
    <a href="<?php echo url('/dashboard') ?>">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>

  <?php if (hasPermissions('users_list')): ?>
    <li <?php echo ($page->menu=='users')?'class="active"':'' ?>>
      <a href="<?php echo url('users') ?>">
        <i class="fa fa-user"></i> <span>Users</span>
      </a>
    </li>	 
  <?php endif ?>

  <?php if($user_id == 1) { ?>

    <li <?php echo ($page->menu=='comapnies')?'class="active"':'' ?>>
      <a href="<?php echo url('company') ?>">
        <i class="fa fa-user"></i> <span>Companies</span>
      </a>
    </li>
  <?php }?>

  <?php if (hasPermissions('WORKORDER_MASTER')): ?>
    <li <?php echo ($page->menu=='workorder')?'class="active"':'' ?>>
      <a href="<?php echo url('workorder') ?>">
        <i class="fa fa-user"></i> <span>Workorder</span>
      </a>
    </li>	 
  <?php endif ?>

  <?php if (hasPermissions('activity_log_list')): ?>
  <li <?php echo ($page->menu=='activity_logs')?'class="active"':'' ?>>
    <a href="<?php echo url('activity_logs') ?>">
      <i class="fa fa-history"></i><span>Activity Logs</span>
    </a>
  </li>
  <?php endif ?>

  <?php if (hasPermissions('roles_list')): ?>
  <li <?php echo ($page->menu=='roles')?'class="active"':'' ?>>
    <a href="<?php echo url('roles') ?>">
      <i class="fa fa-lock"></i><span>Manage Roles</span>
    </a>
  </li>
  <?php endif ?>

  <?php if (hasPermissions('permissions_list')): ?>
  <li <?php echo ($page->menu=='permissions')?'class="active"':'' ?>>
    <a href="<?php echo url('permissions') ?>">
      <i class="fa fa-lock"></i><span>Manage Permissions</span>
    </a>
  </li>
  <?php endif ?>

  <?php /* if (hasPermissions('backup_db')): ?>
  <li <?php echo ($page->menu=='backup')?'class="active"':'' ?>>
    <a href="<?php echo url('backup') ?>">
      <i class="fa fa-download"></i><span>Backup</span>
    </a>
  </li>
  <?php endif */ ?>

  <?php /* if ( hasPermissions('company_settings') ): ?>
  <li class="treeview <?php echo ($page->menu=='settings')?'active':'' ?>">
    <a href="#">
      <i class="fa fa-cog"></i> <span>Settings</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">

      <li <?php echo ($page->submenu=='general')?'class="active"':'' ?>>
        <a href="<?php echo url('settings/general') ?>">
          <i class="fa fa-circle-o"></i> General Settings
        </a>
      </li>

      <li <?php echo ($page->submenu=='company')?'class="active"':'' ?>>
        <a href="<?php echo url('settings/company') ?>">
          <i class="fa fa-circle-o"></i> Company Settings
        </a>
      </li>

      <li <?php echo ($page->submenu=='login_theme')?'class="active"':'' ?>>
        <a href="<?php echo url('settings/login_theme') ?>">
          <i class="fa fa-circle-o"></i> Login Settings
        </a>
      </li>

      <li <?php echo ($page->submenu=='email_templates')?'class="active"':'' ?>>
        <a href="<?php echo url('settings/email_templates') ?>">
          <i class="fa fa-circle-o"></i> Manage Email Template
        </a>
      </li>

    </ul>
  </li>
  <?php endif */ ?>


  <!-- // ADMINLTE //  

  <li class="header">AdminLTE Components</li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-files-o"></i>
    <span>Layout Options</span>
    <span class="pull-right-container">
      <span class="label label-primary pull-right">4</span>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo url('adminlte/') ?>layout/top_nav"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
    <li><a href="<?php echo url('adminlte/') ?>layout/boxed"><i class="fa fa-circle-o"></i> Boxed</a></li>
    <li><a href="<?php echo url('adminlte/') ?>layout/fixed"><i class="fa fa-circle-o"></i> Fixed</a></li>
    <li><a href="<?php echo url('adminlte/') ?>layout/collapsed_sidebar"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
  </ul>
  </li>
  <li>
  <a href="<?php echo url('adminlte/') ?>widgets">
    <i class="fa fa-th"></i> <span>Widgets</span>
    <span class="pull-right-container">
      <small class="label pull-right bg-green">new</small>
    </span>
  </a>
  </li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-pie-chart"></i>
    <span>Charts</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo url('adminlte/') ?>charts/chartjs"><i class="fa fa-circle-o"></i> ChartJS</a></li>
    <li><a href="<?php echo url('adminlte/') ?>charts/morris"><i class="fa fa-circle-o"></i> Morris</a></li>
    <li><a href="<?php echo url('adminlte/') ?>charts/flot"><i class="fa fa-circle-o"></i> Flot</a></li>
    <li><a href="<?php echo url('adminlte/') ?>charts/inline"><i class="fa fa-circle-o"></i> Inline charts</a></li>
  </ul>
  </li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-laptop"></i>
    <span>UI Elements</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo url('adminlte/') ?>ui/general"><i class="fa fa-circle-o"></i> General</a></li>
    <li><a href="<?php echo url('adminlte/') ?>ui/icons"><i class="fa fa-circle-o"></i> Icons</a></li>
    <li><a href="<?php echo url('adminlte/') ?>ui/buttons"><i class="fa fa-circle-o"></i> Buttons</a></li>
    <li><a href="<?php echo url('adminlte/') ?>ui/sliders"><i class="fa fa-circle-o"></i> Sliders</a></li>
    <li><a href="<?php echo url('adminlte/') ?>ui/timeline"><i class="fa fa-circle-o"></i> Timeline</a></li>
    <li><a href="<?php echo url('adminlte/') ?>ui/modals"><i class="fa fa-circle-o"></i> Modals</a></li>
  </ul>
  </li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-edit"></i> <span>Forms</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo url('adminlte/') ?>forms/general"><i class="fa fa-circle-o"></i> General Elements</a></li>
    <li><a href="<?php echo url('adminlte/') ?>forms/advanced"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
    <li><a href="<?php echo url('adminlte/') ?>forms/editors"><i class="fa fa-circle-o"></i> Editors</a></li>
  </ul>
  </li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-table"></i> <span>Tables</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo url('adminlte/') ?>tables/simple"><i class="fa fa-circle-o"></i> Simple tables</a></li>
    <li><a href="<?php echo url('adminlte/') ?>tables/data"><i class="fa fa-circle-o"></i> Data tables</a></li>
  </ul>
  </li>
  <li>
  <a href="<?php echo url('adminlte/') ?>calendar">
    <i class="fa fa-calendar"></i> <span>Calendar</span>
    <span class="pull-right-container">
      <small class="label pull-right bg-red">3</small>
      <small class="label pull-right bg-blue">17</small>
    </span>
  </a>
  </li>
  <li>
  <a href="<?php echo url('adminlte/') ?>mailbox/mailbox">
    <i class="fa fa-envelope"></i> <span>Mailbox</span>
    <span class="pull-right-container">
      <small class="label pull-right bg-yellow">12</small>
      <small class="label pull-right bg-green">16</small>
      <small class="label pull-right bg-red">5</small>
    </span>
  </a>
  </li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-folder"></i> <span>Examples</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="<?php echo url('adminlte/') ?>examples/invoice"><i class="fa fa-circle-o"></i> Invoice</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/profile"><i class="fa fa-circle-o"></i> Profile</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/login"><i class="fa fa-circle-o"></i> Login</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/register"><i class="fa fa-circle-o"></i> Register</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/lockscreen"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/error404"><i class="fa fa-circle-o"></i> 404 Error</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/error500"><i class="fa fa-circle-o"></i> 500 Error</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/blank"><i class="fa fa-circle-o"></i> Blank Page</a></li>
    <li><a href="<?php echo url('adminlte/') ?>examples/pace"><i class="fa fa-circle-o"></i> Pace Page</a></li>
  </ul>
  </li>
  <li class="treeview">
  <a href="#">
    <i class="fa fa-share"></i> <span>Multilevel</span>
    <span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">
    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
    <li class="treeview">
      <a href="#"><i class="fa fa-circle-o"></i> Level One
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
        <li class="treeview">
          <a href="#"><i class="fa fa-circle-o"></i> Level Two
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
          </ul>
        </li>
      </ul>
    </li>
    <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
  </ul>
  </li>
  <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
  <li class="header">LABELS</li>
  <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
  <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
-->
</ul>