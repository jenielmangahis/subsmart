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
                <h1>SMS Automation</h1>              
                <p>List all automations</p>
              </div>
              <div class="pull-right">
                <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add SMS Automation</a>
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">

              <!-- Default box -->
              <div class="box">                                
                <div class="box-body" style="overflow-y: scroll;">                                    
                  <table class="table table-bordered table-striped dataTableCampaign">
                    <thead>
                      <tr>
                        <th>Automation Name</th>
                        <th>Event</th>
                        <th>Details</th>
                        <th>Text Sent</th>                            
                        <th>Status</th>                            
                      </tr>
                    </thead>
                    <tbody></tbody>
                  </table>

                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->

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