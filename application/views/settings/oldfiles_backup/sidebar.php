<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Default box -->
  <div class="box">

    <div class="box-header with-border">
      <h3 class="box-title">Settings</h3>
    </div>
    <ul class="nav nav-pills nav-stacked">
     
      <?php //if (hasPermissions('general_settings')): ?>
        <li <?php echo ($page->submenu=='general')?'class="active"':'' ?>>
          <a href="<?php echo url('settings/general') ?>">General Settings</a>
        </li>
      <?php //endif ?>

      <?php //if (hasPermissions('company_settings')): ?>
        <li <?php echo ($page->submenu=='company')?'class="active"':'' ?>>
          <a href="<?php echo url('settings/company') ?>">Company Settings</a>
        </li>
      <?php //endif ?>
     
      <?php //if (hasPermissions('login_theme')): ?>
        <li <?php echo ($page->submenu=='login_theme')?'class="active"':'' ?>>
          <a href="<?php echo url('settings/login_theme') ?>">Login Settings</a>
        </li>
      <?php //endif ?>
     
      <?php //if (hasPermissions('email_templates')): ?>
        <li <?php echo ($page->submenu=='email_templates')?'class="active"':'' ?>>
          <a href="<?php echo url('settings/email_templates') ?>">Email Templates</a>
        </li>
      <?php //endif ?>
     
      <!-- <li <?php echo ($page->submenu=='auth')?'class="active"':'' ?>>
      	<a href="<?php echo url('settings/auth') ?>">Authentication</a>
      </li> -->
      
    </ul>

  </div>