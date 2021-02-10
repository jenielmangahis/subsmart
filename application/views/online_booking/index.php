<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12 mt-2">
                    <div class="card" style="min-height: 400px !important;">
                        <div class="page-title-box pt-1 pb-2">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Online Booking</h3>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Manage your online booking</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-0 mb-3" role="alert">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Online booking system is a software solution that allows potential guests to self-book and pay through your website, and other channels, while giving you the best tools to run and scale your operation, all in one place.</span>
                        </div>

                        <?php include viewPath('includes/booking_tabs'); ?>

                        <div class="row dashboard-container-1" style="padding-top: 40px !important;">
                            <div class="col-md-8">
                                <strong>
                                    <button type="button" class="btn btn-secondary">
                                        Categories: <span class="badge badge-light"><strong><?= $total_category; ?></strong></span>
                                    </button>

                                    <button type="button" class="btn btn-success">
                                        Products: <span class="badge badge-light"><strong><?= $total_products; ?></strong></span>
                                    </button>

                                    <button type="button" class="btn btn-info">
                                        Time Slots: <span class="badge badge-light"><strong><?= $total_timeslots; ?></strong></span>
                                    </button>
                                </strong>
                            </div>
                            <div class="col-md-4 text-right"><a target="_blank" href="<?php echo base_url('/booking/products/' . $eid); ?>" target="_blank"><span class="fa fa-external-link fa-margin-right"></span> View Booking Page</a></div>
                        </div>
                        <hr />
                        <div class="row dashboard-container-2">

                            <p class="">
                                Place a booking form on your website and collect leads from your customers directly into nSmarTrac.
                                <br><br>
                                1. Set your items on services<br>
                                2. Define your time slots<br>
                                3. Customize the way the form looks and get notifications on new contact inquiries or check the leads online.<br>
                                4. Copy/Paste the iframe or javascript code on a page on your website.
                            </p>

                        </div>
                        <hr />
                        <div><a href="<?php echo base_url('more/addon/booking/products') ?>" class="btn btn-success"> Edit Booking </a></div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
