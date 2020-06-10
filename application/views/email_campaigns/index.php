<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php //include viewPath('includes/sidebars/estimate'); ?>
    <?php include viewPath('includes/sidebars/marketing'); ?>
    <?php //include viewPath('includes/notifications'); ?>
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <!-- Content Header (Page header) -->
            <section class="content-header">
              <div class="pull-left">
                <h1>Email Blast</h1>
              </div>
              <div class="pull-right">
                <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create Email Blast</a>
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">

              <div class="center" style="margin-top:50px;">
                <h4>You haven't got any email campaigns</h4>
                <p>With Email Blast you can send emails to all your customers or only a group.</p>
                <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create Email Blast</a>
              </div>             

            </section>
            <!-- /.content -->
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>

<?php include viewPath('includes/footer'); ?>

<script>
  $('.dataTableCampaign').DataTable();
</script>