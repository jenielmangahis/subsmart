<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header_front_booking'); ?>
<div>
    <!-- page wrapper start -->
    <div class="col-xl-8 left">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title-v2">Online Booking</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage your online booking</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-xl-12">
                <div class="col-9 right-menu">
                  <div class="col-4 left pr-0 ml-4">
                    <input type="text" class="form-control-search left" placeholder="Search...">
                  </div>
                  <div class="col-1 left pl-1">
                    <button class="search-booking-btn"><span class="fa fa-search"></span></button>
                  </div>
                  <div class="col-3 left pl-0 pr-0 pos-rlt-cs left-20">
                    <a class="view-grid" href="#"><span class="fa fa-th fa-margin-right"></span> Grid view</a>
                  </div>
                  <div class="col-3 left pl-0 pr-0 pos-rlt-cs">
                    <a class="view-grid active" href="#"><span class="fa fa-list-ul fa-margin-right"></span> List view</a>
                  </div>
                </div>
              </div>
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                  <ul class="category-list">
                     <li class="category-li">
                        <div class="category__name">Sample Category</div>
                        <ul class="product-list">
                           <li class="product-li">
                              <div class="product" data-product-id="22516">
                                 <div class="product__img__cnt" data-product-modal="open" data-product-id="22516">
                                    <div class="product__img__hover" style="display: none;"><span>Quick Look</span></div>
                                    <img class="product__img" src="https://images.unsplash.com/photo-1593642531955-b62e17bdaa9c">
                                 </div>
                                 <div class="product__cnt">
                                    <div class="product__name" style="height: 25px;">Sample Cleaning</div>
                                    <div class="product__description">
                                       <p>this is a sample description of category</p>
                                    </div>
                                    <div class="product__price__cnt clearfix">
                                       <div class="product__price">$10.00<span class="product__price__unit">/each</span></div>
                                       <div class="product__actions">
                                          <div class="product__qty-box">
                                             <button class="btn product__qty-btn" data-product-qty="minus" type="button"><span class="fa fa-minus"></span></button><input class="form-control-qty product__qty" data-product-qty="qty" type="text" name="qty" value="1"><button class="btn product__qty-btn" data-product-qty="plus" type="button"><span class="fa fa-plus"></span></button>
                                          </div>
                                          <button class="btn btn-green btn-sm" data-cart="add" data-product-id="22516">Add to Cart</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="product__view">
                                    <a href="#" data-product-modal="open" data-product-id="22516">view more</a>
                                 </div>
                              </div>
                           </li>
                           <li class="product-li">
                              <div class="product" data-product-id="22516">
                                 <div class="product__img__cnt" data-product-modal="open" data-product-id="22516">
                                    <div class="product__img__hover" style="display: none;"><span>Quick Look</span></div>
                                    <img class="product__img" src="https://images.unsplash.com/photo-1593642531955-b62e17bdaa9c">
                                 </div>
                                 <div class="product__cnt">
                                    <div class="product__name" style="height: 25px;">Sample Cleaning</div>
                                    <div class="product__description">
                                       <p>this is a sample description of category</p>
                                    </div>
                                    <div class="product__price__cnt clearfix">
                                       <div class="product__price">$10.00<span class="product__price__unit">/each</span></div>
                                       <div class="product__actions">
                                          <div class="product__qty-box">
                                             <button class="btn product__qty-btn" data-product-qty="minus" type="button"><span class="fa fa-minus"></span></button><input class="form-control-qty product__qty" data-product-qty="qty" type="text" name="qty" value="1"><button class="btn product__qty-btn" data-product-qty="plus" type="button"><span class="fa fa-plus"></span></button>
                                          </div>
                                          <button class="btn btn-green btn-sm" data-cart="add" data-product-id="22516">Add to Cart</button>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="product__view">
                                    <a href="#" data-product-modal="open" data-product-id="22516">view more</a>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </li>
                  </ul>
                  <ul class="category-grid">
                     <li class="category-li">
                        <div class="category__name">Sample Category 2</div>
                        <ul class="row row-list product-list">
                           <li class="col-lg-4 product-li">
                              <div class="product" data-product-id="22516">
                                 <div class="product__img__cnt" data-product-modal="open" data-product-id="22516">
                                    <div class="product__img__hover" style="display: none;"><span>Quick Look</span></div>
                                    <img class="product__img" src="https://images.unsplash.com/photo-1593642531955-b62e17bdaa9c">
                                 </div>
                                 <div class="product__cnt">
                                    <div class="product__name" style="height: 25px;">Sample Cleaning</div>
                                    <div class="product__description">
                                       <p>this is a sample description of category</p>
                                    </div>
                                    <div class="product__price">$10.00<span class="product__price__unit">/each</span></div>
                                    <div class="product__actions">
                                       <div class="product__qty-box sdv-qty">
                                          <button class="btn product__qty-btn" data-product-qty="minus" type="button"><span class="fa fa-minus"></span></button><input class="form-control-qty product__qty" data-product-qty="qty" type="text" name="qty" value="1"><button class="btn product__qty-btn" data-product-qty="plus" type="button"><span class="fa fa-plus"></span></button>
                                       </div>
                                       <button class="btn btn-green btn-sm sdv-grid" data-cart="add" data-product-id="22516">Add to Cart</button>
                                    </div>
                                    <div class="product__view">
                                       <a href="#" data-product-modal="open" data-product-id="22516">view more</a>
                                    </div>
                                 </div>
                              </div>
                           </li>
                           <li class="col-lg-4 product-li">
                              <div class="product" data-product-id="22516">
                                 <div class="product__img__cnt" data-product-modal="open" data-product-id="22516">
                                    <div class="product__img__hover" style="display: none;"><span>Quick Look</span></div>
                                    <img class="product__img" src="https://images.unsplash.com/photo-1593642531955-b62e17bdaa9c">
                                 </div>
                                 <div class="product__cnt">
                                    <div class="product__name" style="height: 25px;">Sample Cleaning</div>
                                    <div class="product__description">
                                       <p>this is a sample description of category</p>
                                    </div>
                                    <div class="product__price">$10.00<span class="product__price__unit">/each</span></div>
                                    <div class="product__actions">
                                       <div class="product__qty-box sdv-qty">
                                          <button class="btn product__qty-btn" data-product-qty="minus" type="button"><span class="fa fa-minus"></span></button><input class="form-control-qty product__qty" data-product-qty="qty" type="text" name="qty" value="1"><button class="btn product__qty-btn" data-product-qty="plus" type="button"><span class="fa fa-plus"></span></button>
                                       </div>
                                       <button class="btn btn-green btn-sm sdv-grid" data-cart="add" data-product-id="22516">Add to Cart</button>
                                    </div>
                                    <div class="product__view">
                                       <a href="#" data-product-modal="open" data-product-id="22516">view more</a>
                                    </div>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </li>
                   </ul>
                   <ul class="category-list">
                     <li class="category-li">
                        <div class="category__name">Sample Category 3</div>
                        <ul class="product-list">
                        </ul>
                     </li>
                  </ul>

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
