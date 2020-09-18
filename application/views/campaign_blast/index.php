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
                <h1 style="text-align: left;">Campaign Blast</h1>              
                <p>Listing all your postcard campaigns.</p>
              </div>

              <div class="pull-right">
                <a href="javascript:void(0);" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCampaignBlast"><i class="fa fa-plus"></i> Create Campaign Blast</a><br />
                <div style="margin-top: 30px;">                
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
                          <a class="nav-link active" id="c-active-tab" data-toggle="tab" href="#active-blast" role="tab" aria-controls="One" aria-selected="true">Draft (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-scheduled-tab" data-toggle="tab" href="#queue-blast" role="tab" aria-controls="Two" aria-selected="false">Queue (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-completed-tab" data-toggle="tab" href="#sent-blast" role="tab" aria-controls="Two" aria-selected="false">Sent (0)</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="c-closed-tab" data-toggle="tab" href="#archive-blast" role="tab" aria-controls="Three" aria-selected="false">Archive (0)</a>
                      </li>
                    </ul>
                  </div>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="active-blast" role="tabpanel" aria-labelledby="one-tab">
                      
                      <div class="page-empty-container">
                          <h5 class="page-empty-header">Send postcards to your customers.</h5>
                          <p class="text-ter margin-bottom">
                              Personalized postcards are priceless in optimizing the connection between your customers and business.<br>
                              They help your business to stand out among your valued customers. Send yours today!
                          </p>
                          <a class="btn btn-primary" data-toggle="modal" data-target="#modalAddCampaignBlast" href="javascript:void(0);"><span class="fa fa-plus fa-margin-right"></span> New Campaign Blast</a>

                          <div class="text-sm text-ter deals-info-image-caption" style="margin-top: 50px; margin-bottom: 10px;">Sample Campaign Blast</div>
                          <div style="margin-bottom: 10px;">
                              <?php $thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg') ?>
                              <img style="display: inline-block; width: 200px; margin-right: 10px; border: 1px solid #eaeaea;" class="img-responsive" src="<?php echo $thumb_img; ?>">
                              <img style="display: inline-block; width: 200px; border: 1px solid #eaeaea;" class="img-responsive" src="<?php echo $thumb_img; ?>">
                          </div>
                      </div>

                    </div>
                    <div class="tab-pane fade p-3" id="queue-blast" role="tabpanel" aria-labelledby="two-tab">
                      
                      No Queue yet

                    </div>
                    <div class="tab-pane fade p-3" id="sent-blast" role="tabpanel" aria-labelledby="two-tab">
                      
                      No Sent yet

                    </div>
                    <div class="tab-pane fade p-3" id="archive-blast" role="tabpanel" aria-labelledby="three-tab">
                      
                      No Archive yet

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

<?php include viewPath('includes/campaignblast_modals'); ?> 
<?php include viewPath('includes/footer'); ?>

<script>
  //$('.dataTableCampaignBlast').DataTable();
</script>