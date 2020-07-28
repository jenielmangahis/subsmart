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
            <div class="business">
               <img class="business__logo" src="https://images.unsplash.com/photo-1522139137660-4248e04955b8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2255&q=80">
               <div class="business__cnt">
                  <div class="business__name">ADi</div>
                  <div class="business__phone">(850) 478-0530</div>
               </div>
            </div>
            <div class="widget-cart margin-bottom-sec" data-cart="cart">
               <div style="font-size: 18px; margin-bottom: 15px;">
                  <span class="fa fa-shopping-cart fa-margin-right"></span> Cart Total:
                  $10.00    <span class="text-ter">(1 item)</span>
               </div>
               <div>
                  <div data-item-rowid="975e79cac5282d1bc137abac18fd8ed1" style="position: relative; margin-bottom: 10px;">
                     <div style="color: #487ca6;">Sample Cleaning</div>
                     <div class="text-ter" style="margin-bottom: 3px; padding-right: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">this is a sample description of category</div>
                     <div>1 x $10.00/each</div>
                     <a class="a-ter" data-cart="delete" data-id="975e79cac5282d1bc137abac18fd8ed1" href="#" style="position: absolute; top: 2px; right:0"><span class="fa fa-trash"></span></a>
                  </div>
               </div>
               <div class="validation validation-error margin-top-sec">
                  Minimum booking amount is $50.00<br>
               </div>
            </div>
            <div class="coupon">
               <div class="coupon__code">
                  <input type="text" name="coupon_code" value="" class="form-control form-control-md" placeholder="Enter coupon code" data-coupon="coupon_code">
               </div>
               <button class="btn btn-default btn-md coupon__btn" data-coupon="btn_submit" name="coupon_btn" type="submit">Apply</button>
            </div>
            <hr class="margin-top margin-bottom">
            <div class="text-right">
               <a class="btn btn-primary-green disabled" data-form="continue" href="#">Continue »</a>
            </div>
         </div>
      </div>
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer_front_booking'); ?>
