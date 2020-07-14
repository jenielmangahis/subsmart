<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/addons'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Add-on Plugins</h1>
                        <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Track Employees Location</li>
                        </ol> -->
                    </div>
                
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- <div class="card">
                        <div class="card-body">
                            <p>Add-on Plugins</p>
                        </div>
                    </div> -->
                    <div class="marketing-card-deck card-deck pl-50 pb-100">
                        <a href="#" class="card border-gr"> <img
                                    class="marketing-img" alt="SMS Blast - Flaticons" src="<?php echo base_url('/assets/dashboard/images/online-booking.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Online Booking</h5>
                                <p style="text-align: justify;" class="card-text mt-txt">Set your services with prices and place a booking form on your website and collect leads from your customers.</p>
                                <p style="text-align: center;"><strong>Subscribe Now</strong></p>
                                <div style="text-align: center;" class="card-price bottom-txt">$0.05/SMS + $5.00 service fee</div>
                            </div>
                        </a>                       
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