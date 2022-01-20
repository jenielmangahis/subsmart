<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.page-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.p-20 {
  padding-top: 10px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.p-40 {
  padding-top: 40px !important;
}
@media only screen and (max-width: 600px) {
  .p-40 {
    padding-top: 0px !important;
  }
  .pr-b10 {
    position: relative;
    bottom: 0px;
  }
}
.small-box h3, .small-box p {
    z-index: 5;
}
.small-box h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px;
    padding: 0;
    white-space: nowrap;
}
.bg-info, .bg-info>a {
    color: #fff!important;
}
.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
    display: block;
    margin-bottom: 20px;
    position: relative;
}
.small-box>.inner {
    padding: 10px;
}
.small-box>.small-box-footer {
    background-color: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}
.bg-info, .bg-info>a, .bg-success, .bg-success>a  {
    color: #fff!important;
}
.small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
}
small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
}
.small-box .icon>i {
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: 15px;
    transition: -webkit-transform .3s linear;
    transition: transform .3s linear;
    transition: transform .3s linear,-webkit-transform .3s linear;
}
.nav{
    margin-bottom: 14px;
}
</style>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/upgrades'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid p-40">
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card p-20" style="min-height: 400px !important;">
                        <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h3 class="page-title">Online Booking</h3>                                    
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning mt-0 mb-3" role="alert" style="margin-bottom:47px !important;">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Online booking system is a software solution that allows potential guests to self-book and pay through your website, and other channels, while giving you the best tools to run and scale your operation, all in one place.</span>
                        </div>

                        <?php include viewPath('includes/booking_tabs'); ?>

                        <div class="row dashboard-container-1" style="padding-top: 40px !important;">                            
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info" style="background-color: #6c757d !important;">
                                  <div class="inner">
                                    <h3><?= sprintf("%02d", $total_category); ?></h3>

                                    <p>Total Categories</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-list"></i>
                                  </div>
                                  <a href="<?php echo base_url('/more/addon/booking/products'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                  <div class="inner">
                                    <h3><?= sprintf("%02d", $total_products); ?></h3>

                                    <p>Total Products</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-list"></i>
                                  </div>
                                  <a href="<?php echo base_url('/more/addon/booking/products'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                  <div class="inner">
                                    <h3><?= sprintf("%02d", $total_timeslots); ?></h3>

                                    <p>Total Time Slots</p>
                                  </div>
                                  <div class="icon">
                                    <i class="fa fa-list"></i>
                                  </div>
                                  <a href="<?php echo base_url('/more/addon/booking/time'); ?>" class="small-box-footer">More info <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row dashboard-container-2 pl-3 pr-3">

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
                        <div>
                            <a href="<?php echo base_url('more/addon/booking/products') ?>" class="btn btn-primary">Edit Booking</a>
                            <a target="_blank" href="<?php echo base_url('/booking/products/' . $eid); ?>" class="btn btn-primary">View Booking Page</a>
                        </div>
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
