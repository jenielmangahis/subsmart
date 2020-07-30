<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_front_booking'); ?>
<div>
    <!-- page wrapper start -->
    <div class="col-xl-9 left">
        <div class="container-fluid pl-0 pr-0">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title-v2">Schedule</h1>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                  <div class="sc-name">Choose an arrival window.</div>
                  <div class="col-12 sc-container pl-0 pr-0 pt-3 mt-4">
                    <div class="opt-button">
                      <a href="#"><span class="fa fa-arrow-right"></span></a>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">MON</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button class="unavailable">NOT AVAILABLE</button>
                      </div>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">TUES</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button class="active">8:00am-10:00am</button>
                      </div>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">WED</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button>8:00am-10:00am</button>
                      </div>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">THU</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button class="active">8:00am-10:00am</button>
                      </div>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">FRI</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button>8:00am-10:00am</button>
                      </div>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">SAT</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button>8:00am-10:00am</button>
                      </div>
                    </div>
                    <div class="col-day">
                      <span class="txt-day">SUN</span>
                      <span class="txt-date">20-JUL</span>
                      <div class="container-availability">
                        <button class="active">8:00am-10:00am</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <div class="col-xl-3 container-full-col">
      <div class="widget-cnt-right">
         <div class="widget-cnt-right__child">
            <div class="widget-cart margin-bottom-sec" data-cart="cart">
               <?php include viewPath('includes/sidebars/front_items_cart'); ?>
            </div>
         </div>
      </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_front_booking'); ?>
