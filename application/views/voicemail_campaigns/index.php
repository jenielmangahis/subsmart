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
                <h1 style="text-align: left;">Voicemail Blast</h1>              
                <p>Listing the campaigns that are currently running.</p>
              </div>
              <div class="pull-right">
                <a href="<?php echo url('company/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Create Voicemail Blast</a><br />
                <div style="margin-top: 30px;">                
                  <a href="#" style="color:#259e57 !important;margin-right: 10px;"><i class="fa fa-bar-chart"></i> Stats</a>
                  <a href="#" style="color:#259e57 !important;"><i class="fa fa-file-text-o fa-margin-right"></i> Orders & Payments</a>
                </div>
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">

              <!-- Default box -->
              <div class="box">                
                <div class="box-body" style="overflow-y: scroll;">                  
                  <div class="card-header tab-card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="c-active-tab" data-toggle="tab" href="#active-campaigns" role="tab" aria-controls="One" aria-selected="true">Active Campaigns (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#scheduled-campaigns" role="tab" aria-controls="Two" aria-selected="false">Scheduled (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-completed-tab" data-toggle="tab" href="#completed-campaigns" role="tab" aria-controls="Two" aria-selected="false">Completed (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-closed-tab" data-toggle="tab" href="#closed-campaigns" role="tab" aria-controls="Three" aria-selected="false">Closed (1)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-draft-tab" data-toggle="tab" href="#draft-campaigns" role="tab" aria-controls="Three" aria-selected="false">Draft (1)</a>
                      </li>
                    </ul>
                  </div>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="active-campaigns" role="tabpanel" aria-labelledby="one-tab">
                      
                      <table class="table table-bordered table-striped dataTableCampaign">
                        <thead>
                          <tr>
                            <th>Campaign</th>
                            <th>Send To</th>
                            <th>Sent on</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="scheduled-campaigns" role="tabpanel" aria-labelledby="two-tab">
                      
                      <table class="table table-bordered table-striped dataTableCampaign">
                        <thead>
                          <tr>
                            <th>Campaign</th>
                            <th>Send To</th>
                            <th>Scheduled for</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="completed-campaigns" role="tabpanel" aria-labelledby="two-tab">
                      
                      <table class="table table-bordered table-striped dataTableCampaign">
                        <thead>
                          <tr>
                            <th>Campaign</th>
                            <th>Send To</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="closed-campaigns" role="tabpanel" aria-labelledby="three-tab">
                      
                      <table class="table table-bordered table-striped dataTableCampaign">
                        <thead>
                          <tr>
                            <th>Campaign</th>
                            <th>Send To</th>
                            <th>Sent on</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>

                    </div>
                    <div class="tab-pane fade p-3" id="draft-campaigns" role="tabpanel" aria-labelledby="three-tab">
                      
                      <table class="table table-bordered table-striped dataTableCampaign">
                        <thead>
                          <tr>
                            <th>Campaign</th>
                            <th>Send To</th>
                            <th>Sent on</th>
                            <th>Status</th>                            
                          </tr>
                        </thead>
                        <tbody></tbody>
                      </table>

                    </div>
                  </div>


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