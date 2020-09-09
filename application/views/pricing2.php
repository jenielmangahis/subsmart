<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header-pricing'); ?>
<style>
.pricing-mobile-slider .owl-item{
  height:auto !important;
}
.btn-show-less-more-desktop, .btn-show-less-more-desktop:hover, .btn-show-less-more-desktop:visited{
	color:#6e2ea9;
  font-size: 1rem;
  padding-left: 4px;
}
.eCommerce-product-div .image-price-container .offer-text {
  font-size: 13px !important;
}
</style>
<!-- Headline Section -->
<section id="main" class="main-content-div">
  <section class="ccontainer cust-hero-container">
      <section class="ccontainer None">
          <div class="ctext cp-margin">
              <h3 class="chart-headline">Save 50% or try it free for 30 days<sup>*</sup></h3>
              <div class="chart-headline-sub">
                  <p><span class="scrolltoqblive scrolltopaysec" style="cursor:pointer; padding-left:10px" aria-expanded="false" role="button" tabindex="0" aria-label="Set up nSmarTrac" data-wa-link="new-pyrl-anchortxt" data-di-id="#new-pyrl-anchortxt">Easily manage your team with our various plan type to fit your business needs.</span></p>
              </div>
          </div>
      </section>
  </section>
  <section class="ccontainer mobile-only" style="padding-top: 0px; height:auto;">
    <div class="content-container">
      <div class="toggle-container">
          <span class="bn" data-wa-link="toggle_fiftyper-diy" data-di-id="#toggle_fiftyper-diy">Buy now for 50% off for 3 months*</span>
          <br style="clear:both;"/>
          <br/>
          <label class="switch pricing-switch">
            <input type="checkbox" class="pricing-trial">
            <span class="slider round"></span>
          </label>
          <!-- <div class="_toggleButton" data-wa-link="toggle_zeroper-diy" role="switch" tabindex="0" aria-label="Buy now for 50% off for 3 months*" aria-checked="false" data-object="sku" data-object-detail="Trial toggle" data-action="trial started" data-ui-object="toggle" data-ui-object-detail="Free trial for 30 days" data-ui-action="clicked" data-ui-access-point="diy pricing group" data-di-id="#toggle_zeroper-diy"> </div> -->
          <span class="ft" data-wa-link="toggle_zeroper-diy" data-di-id="#toggle_zeroper-diy" style="position: relative;top: 4px !important;">Free trial for 30 days</span>
      </div>
    </div>
    <br style="clear:both;"/>
    <br/>
    <br/>
</section>
<section class="hero-section mobile-pricing mobile-only">
    <div class="pricing-mobile-slider home-slider owl-carousel">
      <?php foreach( $aPlans as $key => $plans ){ ?>
        <div class="mobile-pricing-banner hero-item-pricing">
          <div class="container">
            <div class="row cls-price">
              <h3 class="text-center cd-fs-start"><?= $plans['plan']['plan_name']; ?></h3>
              <br style="clear:both;"/>
              <br/>
              <div class="row eCommerce-product-div">
                <div class="blue-button">
                  <div class="center-pricing">
                      <div class="price gray-price">
                          <span class="line-through"></span><span class="ct gray">$</span><span class="aw"><?= number_format($plans['plan']['plan_price'],2); ?></span>
                          <span class="as"></span><span class="ac"></span>
                      </div>
                      <div class="red-price-text sc-3">
                          <span class="ad"> &nbsp; </span>
                          <span class="ct">$</span><span class="ad"><?= number_format($plans['plan']['plan_price'],2); ?></span>
                          <span class="as"></span><span class="ac"></span>
                      </div>
                  </div>
                </div>
                <div class="tryit-free-link-url">
                  <div class="center-pricing-free">
                      <div class="red-price-text">
                          <span class="ct">$</span><span class="ad">FREE</span>
                          <span class="as"></span><span class="ac"></span>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            
            <br class="clear"/>
            <div class="row eCommerce-product-div">
              <div class="blue-button default-product">
                <a href="#" data-wa-link="esbuynow_prem-diy" class="ctasecondary ctacenter" data-di-id="#esbuynow_prem-diy"><span>Buy now</span></a>
              </div>
            </div>
            <div class="row eCommerce-product-div">
              <div class="tryit-free-link-url default-product">
                <a href="#" data-wa-link="pltrial_prem-diy" class="ctasecondary" data-di-id="#pltrial_prem-diy"><span class="free-trial-text">Try it free</span></a>
              </div>
            </div>
            <br class="clear"/>
            
            <?php foreach( $plans['features'] as $f ){ ?>
              <?php $tab_key = $key . "-" . strtolower($f['plan_heading']) . '-list'; ?>

              <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="190">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="190">add</span><strong><?= $f['plan_heading']; ?></strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                <?php foreach($f['features'] as $feature){ ?>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup"><?= $feature['feature_name']; ?></span>
                  </li>
                <?php } ?>
              </ul>
            </div>

            <?php } ?>

          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>

<section class="ccontainer bg-grey ss_ccmph_4 lineup-container hidden-sm hidden-xs desktop-only" style="padding-top: 0px; height:auto; ">
    <div class="content-container desktop-only">
        <div class="ctext">
            <div class="_buyNow _freeTrial trial-byn">
                <div class="toggle-container">
                    <span class="bn" data-wa-link="toggle_fiftyper-diy" data-di-id="#toggle_fiftyper-diy">Buy now for 50% off for 3 months*</span>
                    <label class="switch pricing-switch">
                      <input type="checkbox" class="pricing-trial">
                      <span class="slider round"></span>
                    </label>
                    <!-- <div class="_toggleButton" data-wa-link="toggle_zeroper-diy" role="switch" tabindex="0" aria-label="Buy now for 50% off for 3 months*" aria-checked="false" data-object="sku" data-object-detail="Trial toggle" data-action="trial started" data-ui-object="toggle" data-ui-object-detail="Free trial for 30 days" data-ui-action="clicked" data-ui-access-point="diy pricing group" data-di-id="#toggle_zeroper-diy"> </div> -->
                    <span class="ft" data-wa-link="toggle_zeroper-diy" data-di-id="#toggle_zeroper-diy">Free trial for 30 days</span>
                </div>
                <div class="cupid-arrow">
                    <svg width="16px" height="13px" viewBox="0 0 16 13" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" data-di-rand="1590202098830">
                        <title>arrow</title>
                        <g id="toggle-only-test" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="toggle-w-prompt-freetrial" transform="translate(-733.000000, -353.000000)">
                                <g id="toggle-w-prompt" transform="translate(470.000000, 310.000000)">
                                    <g id="arrow" transform="translate(258.714425, 38.467911)">
                                        <g transform="translate(11.500000, 12.000000) scale(-1, -1) rotate(140.000000) translate(-11.500000, -12.000000) translate(5.000000, 2.000000)">
                                            <path d="M6.00793068,3.16267542 L1.28989056,8.76575411 C1.26456065,8.79583556 1.23670245,8.82369376 1.20662099,8.84902368 C0.915472933,9.09418322 0.480709717,9.05690217 0.235550172,8.76575411 C-0.0693844713,8.40361797 -0.0704630347,7.87486584 0.232991686,7.5114887 L5.44453414,1.27083641 C5.45306432,1.25989562 5.46185451,1.24909003 5.47090469,1.23842787 C5.72365717,0.940656163 6.1699452,0.904160873 6.46771691,1.15691335 C6.49858344,1.18311327 6.52714309,1.21191539 6.55308112,1.24300231 L11.783138,7.51126469 C12.0864683,7.87480826 12.0852767,8.40358127 11.7803112,8.76575411 C11.5351517,9.05690217 11.1003884,9.09418322 10.8092404,8.84902368 C10.7791589,8.82369376 10.7513007,8.79583556 10.7259708,8.76575411 L6.00793068,3.16267542 Z" id="Combined-Shape" fill="#0077C5"></path>
                                            <path d="M7.74193169,2 C5.12408388,9.11832233 5.45689447,14.8245515 8.74036346,19.1186876" id="Path-4" stroke="#0077C5" stroke-width="1.5" transform="translate(7.370182, 10.559344) rotate(-9.000000) translate(-7.370182, -10.559344) ">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <br>
                    <span>Click to get 50% off</span>
                </div>
            </div>
        </div>
      </div>
      <br/>
      <br class="clear" />
        <!-- pricing v2 -->
        <div class="container-table-pricing">
          
          <?php $stored_features = array(); foreach( $aPlans as $key => $plans ){ ?>

            <div class="table-sp-3">
            <div class="pricing-card-layout-content wht-tile">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer None mt-features-single-row-text-only qb-ss hidden-sm hidden-xs">
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2"><?= $plans['plan']['plan_name']; ?></div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw"><?= number_format($plans['plan']['plan_price'],2); ?></span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <div class="red-price-text">
                                            <span class="ct">$</span><span class="aw">49.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <span class="per red-price-month">/mo</span>
                                    </div>
                                    <p class="offer-text default-product"><span class="high-attention-text">Save 50% for 3 months</span>
                                    </p>
                                    <!-- <p class="payroll_text">$8/employees</p> -->
                                    <p class="payroll_text">+2 License</p>
                                    <!-- <div class="text--payroll">+$50/one-time setup session</div> -->
                                </div>
                            </div>
                            <div class="blue-button default-product">
                                <a href="#" data-wa-link="ssbuynow_prem-diy" class="ctasecondary ctacenter" data-di-id="#ssbuynow_prem-diy"><span>Buy now</span></a>
                            </div>
                            <p class="or-text default-product">or</p>
                            <div class="tryit-free-link-url default-product">
                                <a href="#" data-wa-link="sstrial_prem-diy" class="ctasecondary" data-di-id="#sstrial_prem-diy"><span class="free-trial-text">Try it free</span></a>
                            </div>
                        </div>
                        <div class="ctext-v2">
                            <?php foreach( $plans['features'] as $f ){ ?>
                              <?php
                                $hidden_feature = ''; 
                                $tab_key = $key . "-" . strtolower($f['plan_heading']) . '-list';
                                if( in_array($f['plan_heading'], $stored_features) ){
                                  $hidden_feature = 'hidden';
                                }else{
                                  $stored_features[] = $f['plan_heading'];
                                }
                              ?>
                              <ul data-list="1" class="header-ul bsc-margin">
                                  <li>
                                    <?php if( $hidden_feature == 'hidden' ){ ?>
                                      <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong><?= $f['plan_heading']; ?></strong></span>
                                    <?php }else{ ?>
                                      <a class="btn-show-less-more-desktop show-less" data-key="<?= $tab_key; ?>" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong><?= $f['plan_heading']; ?></strong></a>
                                    <?php } ?>
                                      
                                  </li>
                              </ul>
                              <ul data-list="1" class="desc-ul ul-color-highlight <?= $hidden_feature; ?> <?= $tab_key; ?>">
                                  <?php foreach($f['features'] as $feature){ ?>
                                    <li>
                                        <li>
                                            <i class="arrow-down" aria-hidden="true"></i>
                                            <span class="p3 open-popup"><?= $feature['feature_name']; ?></span>
                                        </li>
                                    </li>
                                  <?php } ?>
                              </ul>
                            <?php } ?>
                        </div>
                    </section>
                </div>
            </div>
          </div>

          <?php } ?>

        </div>
        <!-- end pricing v2 -->


        <br class="clear" />
        <br/>


        <section class="addon desktop-only" style="">
            <div class="container">
                <div class="addon__box">
                    <div class="addon__list-cnt">
                        <div class="addon__list-row">
                            <div class="addon__price">
                                <div class="addon__price-base"><span class="addon__price-currency">$</span>5</div>
                                <div class="addon__price-label">Add-Ons</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="addon__list">
                                        <li><span class="fa fa-plus"></span> Survey Builder</li>
                                        <li><span class="fa fa-plus"></span> Online Booking</li>
                                        <li><span class="fa fa-plus"></span> Lead Contact Form</li>
                                        <li><span class="fa fa-plus"></span> Email Blast</li>
                                    </ul>
                                </div>
                                <div class="col-sm-12">
                                    <ul class="addon__list">
                                        <li><span class="fa fa-plus"></span> Employee Access</li>
                                        <li><span class="fa fa-plus"></span> Virtual Number</li>
                                        <li><span class="fa fa-plus"></span> SMS Blast</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="addon__list-row">
                            <div class="addon__price">
                                <div class="addon__price-base"><span class="addon__price-currency">$</span>10</div>
                                <div class="addon__price-label">Add-Ons</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="addon__list">
                                        <li><span class="fa fa-plus"></span> API Connectors</li>
                                        <li><span class="fa fa-plus"></span> Rewards & Offers</li>
                                        <li><span class="fa fa-plus"></span> Campaign Builder</li>
                                        <li><span class="fa fa-plus"></span> Time Sheet & Tracking</li>
                                        <li><span class="fa fa-plus"></span> Inventory Management</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="addon__list-row">
                            <div class="addon__price">
                                <div class="addon__price-base"><span class="addon__price-currency">$</span>15</div>
                                <div class="addon__price-label">Add-Ons</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="addon__list">
                                        <li><span class="fa fa-plus"></span> Business form templates</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="addon__btn">
                        <a class="btn btn-primary btn-xl" href="<?php echo url('registration') ?>">Try nSmarTrac Now</a>
                    </div>
                </div>
            </div>
        </section>
  </section>
</section>

<section class="ccontainer ss-section all-plans-include" style="margin-bottom: 20px; " id="section-2">
    <div class="content-container">
        <div class="grid-image-text container-fluid g_vertical_align_image mb-pl-4">
            <div class="row grid-container-960 mb-pl-4">
                <div class="hero-slider-signup owl-carousel">
                    <div class="hero-item" >
                        <div class="testimonial-card-pricing">
                            <div class="col-sm-2 float-left">
                              <img class="img-pricing-testimonial" src="<?php echo $url->assets ?>frontend/images/mrs_lauren.png" />
                            </div>
                            <div class="col-sm-10 float-left pr-5">
                                <h3 class="testimonial-desc-pricing">"With nSmartrac it takes me minutes versus hours to create new estimates."
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h3>
                                <h3 class="testimonial-name-pricing pr-4 color-purple">Lauren W.</h3>
                                <p class="float-right pr-4 color-purple">General Manager, Daytona, FL</p>
                            </div>
                        </div>
                    </div>
                    <div class="hero-item" >
                        <div class="testimonial-card-pricing">
                            <div class="col-sm-2 float-left">
                              <img class="img-pricing-testimonial" src="<?php echo $url->assets ?>frontend/images/mrs_keen.png" />
                            </div>
                            <div class="col-sm-10 float-left pr-5">
                                <h3 class="testimonial-desc-pricing">"I am not very techie but their support team are very patient and knowledgeable."
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </h3>
                                <h3 class="testimonial-name-pricing pr-4 color-purple">Susan Keen</h3>
                                <p class="float-right pr-4 color-purple">Business Owner, Slidell, LA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="ccontainer None">
                <div class="grid-image-text container-fluid g_vertical_align_image footer">
                    <div class="row grid-container-960">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="cimage clearfix ">
                                <a href="#" target="_blank" data-di-id="di-id-815aaf99-74d0ef6">
                                    <img class="cq-dd-image img-left" alt="app-store" src="<?php echo $url->assets ?>frontend/images/app-store.svg">
                                </a>
                            </div>
                            <div class="cimage clearfix ">
                                <a href="#" target="_blank" data-di-id="di-id-ebd32484-75620110">
                                    <img class="cq-dd-image img-center" alt="google-play-v2" src="<?php echo $url->assets ?>frontend/images/google-play.svg">
                                </a>
                            </div>
                            <div class="ctext">
                                <p style="text-align: left; padding: 0px">We work where you work. Do work and view
                                    reports from any device.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<?php include viewPath('frontcommon/footer-pricing-2'); ?>
