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
                <h1>Offers</h1>
              </div>
              <div class="pull-right">
                <a href="javascript:void(0);" class="btn btn-primary"><i class="fa fa-plus"></i> Create Offer</a><Br />
              </div>              
              <div class="clearfix"></div>
            </section>

            <!-- Main content -->
            <section class="content">

              <div class="center" style="margin-top:50px;">
                <div class="row">
                    <div class="col-sm-6">
                        <h5 class="margin-bottom-sec">Promote Your Business with Exciting Offers!</h5>
                        <div class="deals-info-header"><span class="fa fa-check-circle-o fa-icon deals-info-check"></span> Create your offer</div>
                        <p class="margin-bottom-sec">
                            You'll get a public deal page that you can share with existent or new customers.
                            They will be able to book the deal instantly or contact you directly.
                        </p>
                        <div class="deals-info-header"><span class="fa fa-check-circle-o fa-icon deals-info-check"></span>
                            Email the offer
                        </div>
                        <p class="margin-bottom-sec">
                            Your deal can be emailed to all your customers, a group or selected customers.
                        </p>
                        <div class="deals-info-header"><span class="fa fa-check-circle-o fa-icon deals-info-check"></span> Monitor performance</div>
                        <p class="margin-bottom">
                            Check the reports for page views and bookings to track the success of running deals.
                        </p>
                        <a class="btn btn-primary" href="javascript:void(0);"><span class="fa fa-plus"></span> Create a Deal Now</a>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-center">
                            <?php $thumb_img = base_url('/assets/dashboard/images/product-no-image.jpg') ?>
                            <img style="width: 250px; margin: auto;" class="img-responsive deals-info-image" src="<?php echo $thumb_img; ?>">
                            <div class="text-sm text-ter deals-info-image-caption">that's how your deal will look <br>on main listing page</div>
                        </div>
                    </div>
                </div>
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