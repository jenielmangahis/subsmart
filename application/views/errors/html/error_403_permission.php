<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><?php $heading = '403 Not Allowed !' ?>
<?php include(VIEWPATH.'/errors/html/includes/header.php') ?>
<style>
.error-page > .headline {
    font-size: 100px;
    font-weight: 300;
    float:none !important;
    position: relative !important;
    top: 115px;
    display:inline-block;
}
</style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb" style="left: 50px;">
        <li><a href="<?php echo config_item('base_url') ?>/"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">403 Not Allowed</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="error-page" style="margin-top: 150px;">
        <h2 class="headline text-yellow"> 403</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> You are not allowed to access this page.</h3>

          <p>
            Sorry, you cannot access this section/webpage.
            Meanwhile, you may <a href="<?php echo config_item('base_url') ?>dashboard">return to dashboard</a>.
          </p>
          
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include(VIEWPATH.'/errors/html/includes/footer.php') ?>
