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
                <h1>Campaign Automation</h1>
                <p>Listing all automations.</p>
              </div>
              <div class="pull-right">
                <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Postcard Automation</a><Br />
                <a href="#" style="color:#259e57 !important;margin-top:10px;display: block;">Orders & Payments</a>
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">

              <div class="center" style="margin-top:50px;">
                <h4>Send automatic postcards to customers after a certain event</h4>
                <p>Example postcards: thank you, service reminders, keep in touch, invoice paid, work order completed</p>
                <a href="<?php echo url('/') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Postcard Automation</a>
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