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
      <div class="mobile-pricing-banner hero-item-pricing">
        <div class="container">
            <div class="row cls-price">
              <h3 class="text-center cd-fs-start">Simple Start</h3>
              <br style="clear:both;"/>
              <br/>
              <div class="row eCommerce-product-div">
                <div class="blue-button">
                  <div class="center-pricing">
                      <div class="price gray-price">
                          <span class="line-through"></span><span class="ct gray">$</span><span class="aw">24.99</span>
                          <span class="as"></span><span class="ac"></span>
                      </div>
                      <div class="red-price-text sc-3">
                          <span class="ad"> &nbsp; </span>
                          <span class="ct">$</span><span class="ad">19.99</span>
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
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="190">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="190">add</span><strong>Management</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Manage customers & employees</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Seamlessly assign work orders</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Create reminders</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Implement before and after photos</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Finances</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Integrate online payments</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span  data-height-value="100" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="100" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Insights</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Intuitive dashboard</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Monitor expenses and profits</span>
                  </li>
              </ul>
            </div>
        </div>
    </div>

    <div class="mobile-pricing-banner hero-item-pricing">

      <div class="container">
          <div class="row cls-price">
            <h3 class="text-center cd-fs">Essential</h3>
            <br style="clear:both;"/>
            <br/>
            <div class="row eCommerce-product-div">
              <div class="blue-button">
                <div class="center-pricing">
                    <div class="price gray-price">
                        <span class="line-through"></span><span class="ct gray">$</span><span class="aw">59.99</span>
                        <span class="as"></span><span class="ac"></span>
                    </div>
                    <div class="red-price-text sc-3">
                        <span class="ad"> &nbsp; </span>
                        <span class="ct">$</span><span class="ad">49.99</span>
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
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span  data-height-value="190" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="190" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Management</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Manage customers & employees</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Create reminders</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Implement before and after photos</span>
                </li>
            </ul>
          </div>

          <br class="clear"/>
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span  data-height-value="160" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="160" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Finances</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Integrate online payments</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                </li>
            </ul>
          </div>

          <br class="clear"/>
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span  data-height-value="100" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="100" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Insights</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Intuitive dashboard</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Monitor expenses and profits</span>
                </li>
            </ul>
          </div>

          <br class="clear"/>
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span data-height-value="60" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="60" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Time Sheets</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Track employee hours</span>
                </li>
            </ul>
          </div>

          <br class="clear"/>
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span  data-height-value="60" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="60" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Reports</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Real time reports and analytics</span>
                </li>
            </ul>
          </div>

          <br class="clear"/>
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span data-height-value="120" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="120" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Marketing</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                </li>
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Create a customized digital store</span>
                </li>
            </ul>
          </div>

          <br class="clear"/>
          <div class="ctext">
            <ul data-list="1" class="header-ul">
                <li>
                    <span class=""><span data-height-value="60" class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden">remove</span><span  data-height-value="60" class="material-icons mdc-bottom-navigation__list-item__icon show-more">add</span><strong>Taskhub</strong></span>
                </li>
            </ul>
            <ul data-list="1" class="desc-ul hidden">
                <li>
                    <i class="arrow-down" aria-hidden="true"></i>
                    <span class="p3 open-popup">Manage & assign multiple projects</span>
                </li>
            </ul>
          </div>
        </div>
    </div>




      <div class="mobile-pricing-banner hero-item-pricing">
        <div class="container">
            <div class="row cls-price">
              <h3 class="text-center cd-fs-plus">Plus</h3>
              <br style="clear:both;"/>
              <br/>
              <div class="row eCommerce-product-div">
                <div class="blue-button">
                  <div class="center-pricing">
                      <div class="price gray-price">
                          <span class="line-through"></span><span class="ct gray">$</span><span class="aw">79.99</span>
                          <span class="as"></span><span class="ac"></span>
                      </div>
                      <div class="red-price-text sc-3">
                          <span class="ad"> &nbsp; </span>
                          <span class="ct">$</span><span class="ad">69.99</span>
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
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="190">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="190">add</span><strong>Management</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Manage customers & employees</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Seamlessly assign work orders</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Create reminders</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Implement before and after photos</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="150">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="150">add</span><strong>Finances</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Integrate online payments</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="100">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="100">add</span><strong>Insights</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Intuitive dashboard</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Monitor expenses and profits</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Time Sheets</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Track employee hours</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Reports</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Real time reports and analytics</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="100">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="100">add</span><strong>Marketing</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Automate email marketing campaigns</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                  </li>
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Create a customized digital store</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Taskhub</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Manage & assign multiple projects</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>API Connectors</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Link up with your favorite software</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Campaign Builder</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Create some great designs emails</span>
                  </li>
              </ul>
            </div>

            <br class="clear"/>
            <div class="ctext">
              <ul data-list="1" class="header-ul">
                  <li>
                      <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>GPS Tracking</strong></span>
                  </li>
              </ul>
              <ul data-list="1" class="desc-ul hidden">
                  <li>
                      <i class="arrow-down" aria-hidden="true"></i>
                      <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                  </li>
              </ul>
            </div>
          </div>
        </div>


        <div class="mobile-pricing-banner hero-item-pricing">
          <div class="container">
              <div class="row cls-price">
                <h3 class="text-center cd-fs-premier">PremierPro</h3>
                <br style="clear:both;"/>
                <br/>
                <div class="row eCommerce-product-div">
                  <div class="blue-button">
                    <div class="center-pricing">
                        <div class="price gray-price">
                            <span class="line-through"></span><span class="ct gray">$</span><span class="aw">99.99</span>
                            <span class="as"></span><span class="ac"></span>
                        </div>
                        <div class="red-price-text sc-3">
                            <span class="ad"> &nbsp; </span>
                            <span class="ct">$</span><span class="ad">89.99</span>
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
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="190">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="190">add</span><strong>Management</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Manage customers & employees</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Seamlessly assign work orders</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Create reminders</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Implement before and after photos</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="150">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="150">add</span><strong>Finances</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Integrate online payments</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="100">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="100">add</span><strong>Insights</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Intuitive dashboard</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Monitor expenses and profits</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Time Sheets</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Track employee hours</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Reports</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Real time reports and analytics</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="120">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="120">add</span><strong>Marketing</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Automate email marketing campaigns</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                    </li>
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Create a customized digital store</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Taskhub</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Manage & assign multiple projects</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>API Connectors</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Link up with your favorite software</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Campaign Builder</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Create some great designs emails</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>GPS Tracking</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Mobile Tools</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Simple tools that come handy</span>
                    </li>
                </ul>
              </div>

              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Survey Builder</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Feedbacks and reviews</span>
                    </li>
                </ul>
              </div>
              <br class="clear"/>
              <div class="ctext">
                <ul data-list="1" class="header-ul">
                    <li>
                        <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Inventory Management</strong></span>
                    </li>
                </ul>
                <ul data-list="1" class="desc-ul hidden">
                    <li>
                        <i class="arrow-down" aria-hidden="true"></i>
                        <span class="p3 open-popup">Keep track of all the your items</span>
                    </li>
                </ul>
              </div>
            </div>
          </div>


          <div class="mobile-pricing-banner hero-item-pricing">
            <div class="container">
                <div class="row cls-price">
                  <h3 class="text-center cd-fs-enterprise">Enterprise</h3>
                  <br style="clear:both;"/>
                  <br/>
                  <div class="row eCommerce-product-div">
                    <div class="blue-button">
                      <div class="center-pricing">
                          <div class="price gray-price">
                              <span class="line-through"></span><span class="ct gray">$</span><span class="aw">179.99</span>
                              <span class="as"></span><span class="ac"></span>
                          </div>
                          <div class="red-price-text sc-3">
                              <span class="ad"> &nbsp; </span>
                              <span class="ct">$</span><span class="ad">149.99</span>
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
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="190">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="190">add</span><strong>Management</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Manage customers & employees</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Seamlessly assign work orders</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Create reminders</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Implement before and after photos</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="150">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="150">add</span><strong>Finances</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Integrate online payments</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="100">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="100">add</span><strong>Insights</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Intuitive dashboard</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Monitor expenses and profits</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Time Sheets</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Track employee hours</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Reports</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Real time reports and analytics</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="130">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="130">add</span><strong>Marketing</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Automate email marketing campaigns</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                      </li>
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Create a customized digital store</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Taskhub</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Manage & assign multiple projects</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>API Connectors</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Link up with your favorite software</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Campaign Builder</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Create some great designs emails</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>GPS Tracking</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Mobile Tools</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Simple tools that come handy</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Survey Builder</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Feedbacks and reviews</span>
                      </li>
                  </ul>
                </div>
                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Inventory Management</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Keep track of all the your items</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Credit Score</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Get the credit worthiness of your prospect</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Form Builder</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Customize & save your forms</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Accounting</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">A lite accounting software to keep you on the right track</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>eSign</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Easily customize any templates to create personal or business signage</span>
                      </li>
                  </ul>
                </div>

                <br class="clear"/>
                <div class="ctext">
                  <ul data-list="1" class="header-ul">
                      <li>
                          <span class=""><span class="material-icons mdc-bottom-navigation__list-item__icon show-less hidden" data-height-value="60">remove</span><span class="material-icons mdc-bottom-navigation__list-item__icon show-more" data-height-value="60">add</span><strong>Campaign Blast</strong></span>
                      </li>
                  </ul>
                  <ul data-list="1" class="desc-ul hidden">
                      <li>
                          <i class="arrow-down" aria-hidden="true"></i>
                          <span class="p3 open-popup">Narrow down your target demographics & connect</span>
                      </li>
                  </ul>
                </div>
              </div>
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
          <div class="table-sp-3">
            <div class="ctext-float">
                <h4 class="cs-small">Small Business</h4>
                <div class="tooltip-container cs-tooltip">
                    <span class="tooltip-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16" data-di-rand="1590202098831">
                            <defs>
                                <path id="a3" d="M8 .381c4.201 0 7.619 3.418 7.619 7.619S12.201 15.619 8 15.619.381 12.201.381 8 3.799.381 8 .381zm0 13.714A6.102 6.102 0 0 0 14.095 8 6.102 6.102 0 0 0 8 1.905 6.102 6.102 0 0 0 1.905 8 6.102 6.102 0 0 0 8 14.095zm0-6.857c-.42 0-.762.34-.762.762v2.286a.762.762 0 1 0 1.524 0V8A.762.762 0 0 0 8 7.238m0-2.286a.762.762 0 1 0 0 1.524.762.762 0 0 0 0-1.524">
                                </path>
                            </defs>
                            <g fill="none" fill-rule="evenodd">
                                <mask id="b3" fill="#fff">
                                    <use xlink:href="#a3"></use>
                                </mask>
                                <g fill="#8D9096" mask="url(#b3)">
                                    <path d="M-1.143-1.143h18.286v18.286H-1.143z"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="tooltip-content">For sole proprietors, LLCs, partnerships,
                        corporations, non-profits, and more.</span>
                </div>
            </div>
            <div class="pricing-card-layout-content wht-tile">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer">

                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2">Simple Start</div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw">24.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <div class="red-price-text">
                                            <span class="ct">$</span><span class="aw">19.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <span class="per red-price-month">/mo</span>
                                    </div>
                                    <p class="offer-text default-product"><span class="high-attention-text">Save 50% for 3 months</span>
                                    </p>
                                    <!-- <p class="payroll_text">$8/employees</p> -->
                                    <p class="payroll_text">+1 License</p>
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

                            <ul data-list="1" class="header-ul">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Finances</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Integrate online payments</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Insights</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Intuitive dashboard</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Monitor expenses and profits</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Marketing</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create a customized digital store</span>
                                </li>
                            </ul>

                            <!-- <ul data-list="1" class="header-ul">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Accounting</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigatio</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul> -->
                        </div>
                    </section>
                </div>
            </div>
          </div>
          <div class="table-sp-3">
            <div class="pricing-card-layout-content wht-tile">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer None mt-features-single-row-text-only qb-ss hidden-sm hidden-xs">
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2">Essential</div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw">59.99</span>
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

                            <ul data-list="1" class="header-ul bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Finances</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Integrate online payments</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Insights</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Intuitive dashboard</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Monitor expenses and profits</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Marketing</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create a customized digital store</span>
                                </li>
                            </ul>

                            <!-- <a href="javascript:void(0);" class="minimize-button"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon">keyboard_arrow_down</span></a> -->
                            <ul data-list="1" class="header-ul ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="timesheet" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Time Sheets</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight timesheet-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Track employee hours</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="reports" href="javascript:void(0);"><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Reports</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight reports-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Real time reports and analytics</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="accounting" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Accounting</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight accounting-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigatio</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="header-ul ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="taskhub" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Taskhub</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight taskhub-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage & assign multiple projects</span>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
          </div>
          <div class="table-sp-3">
            <div class="pricing-card-layout-content wht-tile">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer None mt-features-single-row-text-only qb-ess">
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2">Plus</div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw">79.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <div class="red-price-text">
                                            <span class="ct">$</span><span class="aw">69.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <span class="per red-price-month">/mo</span>
                                    </div>
                                    <p class="offer-text default-product"><span class="high-attention-text">Save 50% for 3 months</span>
                                    </p>
                                    <!-- <p class="payroll_text">$8/employees</p> -->
                                    <p class="payroll_text">+3 License</p>
                                    <!-- <div class="text--payroll">+$50/one-time setup session</div> -->
                                </div>
                            </div>
                            <div class="blue-button default-product">
                                <a href="#" data-wa-link="esbuynow_prem-diy" class="ctasecondary ctacenter" data-di-id="#esbuynow_prem-diy"><span>Buy now</span></a>
                            </div>
                            <p class="or-text default-product">or</p>
                            <div class="tryit-free-link-url default-product">
                                <a href="#" data-wa-link="estrial_prem-diy" class="ctasecondary" data-di-id="#estrial_prem-diy"><span class="free-trial-text">Try it free</span></a>
                            </div>
                        </div>
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title">Plus</div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw">165</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <div class="red-price-text">
                                            <span class="ct">$</span><span class="aw">82</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <span class="per red-price-month">/mo</span>
                                    </div>
                                    <p class="offer-text default-product"><span class="high-attention-text">Save 50% for 3 months</span>
                                    </p>
                                    <p class="payroll_text">+$10/employee/mo</p>
                                    <div class="text--payroll">+$50/one-time setup session</div>
                                </div>
                            </div>
                            <div class="blue-button default-product">
                                <a href="#" data-wa-link="esbuynow_elite-diy" class="ctasecondary ctacenter" data-di-id="#esbuynow_elite-diy"><span>Buy now</span></a>
                            </div>
                            <p class="or-text default-product">or</p>
                            <div class="tryit-free-link-url default-product">
                                <a href="#" data-wa-link="estrial_elite-diy" class="ctasecondary" data-di-id="#estrial_elite-diy"><span class="free-trial-text">Try it free</span></a>
                            </div>
                        </div>
                        <div class="ctext-v2">

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Finances</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Integrate online payments</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Insights</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Intuitive dashboard</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Monitor expenses and profits</span>
                                </li>
                            </ul>

                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Marketing</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create a customized digital store</span>
                                </li>
                            </ul>

                            <!-- <a href="javascript:void(0);" class="minimize-button"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon">keyboard_arrow_down</span></a> -->
                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Time Sheets</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Track employee hours</span>
                                </li>
                            </ul>

                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Reports</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Real time reports and analytics</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Accounting</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigatio</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Taskhub</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage & assign multiple projects</span>
                                </li>
                            </ul>

                            <ul class="ul-color-header" data-list="1">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="api-connectors" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>API Connectors</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight api-connectors-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Link up with your favorite software</span>
                                </li>
                            </ul>

                            <ul class="ul-color-header" data-list="1">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="campaign-builder" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Campaign Builder</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight campaign-builder-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create some great designs emails</span>
                                </li>
                            </ul>

                            <ul class="ul-color-header" data-list="1">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="gps-tracking" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>GPS Tracking</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight gps-tracking-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                                </li>
                            </ul>
                        </div>
                    </section>
                </div>
            </div>
          </div>

          <div class="table-sp-3">
            <div class="pricing-card-layout-content wht-tile scrollable-pricing">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer None mt-features-single-row-text-only qb-plus sb-e2">
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2">PremierPro</div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw">99.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <div class="red-price-text">
                                            <span class="ct">$</span><span class="aw">89.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <span class="per red-price-month">/mo</span>
                                    </div>
                                    <p class="offer-text default-product"><span class="high-attention-text">Save 50% for 3 months</span>
                                    </p>
                                    <!-- <p class="payroll_text">$8/employees</p> -->
                                    <p class="payroll_text">+4 License</p>
                                    <!-- <div class="text--payroll">+$50/one-time setup session</div> -->
                                </div>
                            </div>
                            <div class="blue-button default-product">
                                <a href="#" data-wa-link="plbuynow_prem-diy" class="ctasecondary ctacenter" data-di-id="#plbuynow_prem-diy"><span>Buy now</span></a>
                            </div>
                            <p class="or-text default-product">or</p>
                            <div class="tryit-free-link-url default-product">
                                <a href="#" data-wa-link="pltrial_prem-diy" class="ctasecondary" data-di-id="#pltrial_prem-diy"><span class="free-trial-text">Try it free</span></a>
                            </div>
                        </div>
                        <div class="ctext-v2">

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Finances</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Integrate online payments</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Insights</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Intuitive dashboard</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Monitor expenses and profits</span>
                                </li>
                            </ul>

                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Marketing</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create a customized digital store</span>
                                </li>
                            </ul>

                            <!-- <a href="javascript:void(0);" class="minimize-button"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon">keyboard_arrow_down</span></a> -->
                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Time Sheets</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Track employee hours</span>
                                </li>
                            </ul>

                            <ul class="bsc-margin" data-list="1">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Reports</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Real time reports and analytics</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Accounting</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigatio</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Taskhub</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage & assign multiple projects</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>API Connectors</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Link up with your favorite software</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Campaign Builder</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create some great designs emails</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>GPS Tracking</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="mobile-tools" href="javascript:void(0);"><span  data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Mobile Tools</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight mobile-tools-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Simple tools that come handy.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="survey-builder" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Survey Builder</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight survey-builder-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Feedbacks and reviews.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="inventory-management" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop" style="width:13%;float:left;">remove</span><strong style="width:84%;float:left;">Inventory &nbsp; &nbsp; Management</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight inventory-management-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup" style="padding-top: 13px !important;">Keep track of all the your items.</span>
                                </li>
                            </ul>

                        </div>
                    </section>
                </div>
            </div>
          </div>

          <div class="table-sp-3">
            <div class="ctext-float">
                <img src="<?php echo $url->assets ?>frontend/images/wizard.png" class="wizard-desktop" alt="card 1">
            </div>
            <div class="pricing-card-layout-content wht-tile scrollable-pricing">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer None mt-features-single-row-text-only qb-adv pcard-layout-additional-text hidden-sm hidden-xs">
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2">Enterprise</div>
                                <div class="price-container default-product">
                                    <div class="pricing-section">
                                        <div class="price">
                                            <span class="line-through"></span><span class="ct">$</span><span class="aw">179.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <div class="red-price-text">
                                            <span class="ct">$</span><span class="aw">149.99</span>
                                            <span class="as"></span><span class="ac"></span>
                                        </div>
                                        <span class="per red-price-month">/mo</span>
                                    </div>
                                    <p class="offer-text default-product"><span class="high-attention-text">Save 50% for 3 months</span>
                                    </p>
                                    <p class="payroll_text">+5 License</p>
                                    <!-- <div class="text--payroll">+$50/one-time setup session</div> -->
                                </div>
                            </div>
                            <div class="blue-button default-product">
                                <a href="#" data-wa-link="plbuynow_prem-diy" class="ctasecondary ctacenter" data-di-id="#plbuynow_prem-diy"><span>Buy now</span></a>
                            </div>
                            <p class="or-text default-product">or</p>
                            <div class="tryit-free-link-url default-product">
                                <a href="#" data-wa-link="pltrial_prem-diy" class="ctasecondary" data-di-id="#pltrial_prem-diy"><span class="free-trial-text">Try it free</span></a>
                            </div>
                        </div>
                        <div class="ctext-v2">

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Finances</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Integrate online payments</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Insights</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Intuitive dashboard</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Monitor expenses and profits</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Marketing</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create a customized digital store</span>
                                </li>
                            </ul>

                            <!-- <a href="javascript:void(0);" class="minimize-button"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon">keyboard_arrow_down</span></a> -->
                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Time Sheets</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Track employee hours</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Reports</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Real time reports and analytics</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Accounting</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigatio</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Taskhub</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage & assign multiple projects</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>API Connectors</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Link up with your favorite software</span>
                                </li>
                            </ul>
                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Campaign Builder</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create some great designs emails</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>GPS Tracking</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Mobile Tools</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Simple tools that come handy.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Survey Builder</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Feedbacks and reviews.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop" style="width:13%;float:left;">done</span><strong style="width:87%;float:left;">Inventory &nbsp; &nbsp; Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup" style="padding-top: 13px !important;">Keep track of all the your items.</span>
                                </li>
                            </ul>
                            <br style="clear:both;"/>
                            <ul data-list="1" class="ul-color-header" style="margin-top: 13px !important;">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="credit-score" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Credit Score</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight credit-score-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Get the credit worthiness of your prospect.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="form-builder" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Form Builder</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight form-builder-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Customize & save your forms.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="accounting" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Accounting</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight accounting-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">A lite accounting software to keep you on the right track.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="esign" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>eSign</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight esign-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Easily customize any templates to create personal or business signage.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="campaign-blast" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Campaign Blast</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight campaign-blast-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Narrow down your target demographics & connect.</span>
                                </li>
                            </ul>

                        </div>
                    </section>
                </div>
            </div>
          </div>

          <div class="table-sp-3">
            <div class="ctext-float">
                <h4 class="cs-small">Freelancer</h4>
                <div class="tooltip-container cs-tooltip">
                    <span class="tooltip-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16" height="16" viewBox="0 0 16 16" data-di-rand="1590202098831">
                            <defs>
                                <path id="a3" d="M8 .381c4.201 0 7.619 3.418 7.619 7.619S12.201 15.619 8 15.619.381 12.201.381 8 3.799.381 8 .381zm0 13.714A6.102 6.102 0 0 0 14.095 8 6.102 6.102 0 0 0 8 1.905 6.102 6.102 0 0 0 1.905 8 6.102 6.102 0 0 0 8 14.095zm0-6.857c-.42 0-.762.34-.762.762v2.286a.762.762 0 1 0 1.524 0V8A.762.762 0 0 0 8 7.238m0-2.286a.762.762 0 1 0 0 1.524.762.762 0 0 0 0-1.524">
                                </path>
                            </defs>
                            <g fill="none" fill-rule="evenodd">
                                <mask id="b3" fill="#fff">
                                    <use xlink:href="#a3"></use>
                                </mask>
                                <g fill="#8D9096" mask="url(#b3)">
                                    <path d="M-1.143-1.143h18.286v18.286H-1.143z"></path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="tooltip-content">For sole proprietors, LLCs, partnerships,
                        corporations, non-profits, and more.</span>
                </div>
            </div>
            <div class="pricing-card-layout-content wht-tile scrollable-pricing">
                <div class="pricing-card-layout-content-wrapper">
                    <section class="ccontainer None pcard-layout-additional-text mt-features-single-row-text-only qb-se">
                        <div class="eCommerce-product-div">
                            <div class="image-price-container">
                                <div class="price-container-title-v2 ">Industry Specific</div>
                                <div class="price-container-freelancer price-container default-product">
                                    <div class="pricing-section mbc-20">
                                      <div class="price">
                                          <span class="line-through"></span><span class="ct">$</span><span class="aw">299.99</span>
                                          <span class="as"></span><span class="ac"></span>
                                      </div>
                                      <div class="red-price-text">
                                          <span class="ct">$</span><span class="aw">249.99</span>
                                          <span class="as"></span><span class="ac"></span>
                                      </div>
                                      <span class="per red-price-month">/mo</span>

                                    </div>
                                    <p class="offer-text" style="position: relative;right: 10px;"><span class="high-attention-text">Save 50%
                                            for 3 months</span></p>
                                    <p class="payroll_text">+20 License</p>
                                </div>
                            </div>
                            <div class="blue-button">
                                <a href="javascript:void(0);" data-wa-link="sebuynow-diy" class="ctasecondary ctacenter" data-object="sku" data-object-detail="Self Employed" data-action="buy now started" data-ui-object="button" data-ui-object-detail="Buy now" data-ui-action="clicked" data-ui-access-point="diy pricing group" data-di-id="#sebuynow-diy"><span>Buy
                                        now</span></a>
                            </div>
                            <p class="or-text ">or</p>
                            <div class="tryit-free-link-url ">
                                <a href="javascript:void(00;)" data-wa-link="setrial-diy" class="ctasecondary" data-object="sku" data-object-detail="Self Employed" data-action="trial started" data-ui-object="button" data-ui-object-detail="Try it free" data-ui-action="clicked" data-ui-access-point="diy pricing group" data-di-id="#setrial-diy"><span class="free-trial-text">Try it free</span></a>
                            </div>
                        </div>
                        <div class="ctext-v2">

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Seamlessly assign work orders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigation</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Finances</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">CRM/Estimates/Invoices</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Integrate online payments</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Estimate costs & expenses with ease</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">nSmarTrac, Google & iCal integration</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Insights</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Intuitive dashboard</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Monitor expenses and profits</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Marketing</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Automate email marketing campaigns</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize postcard marketing functionality</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create a customized digital store</span>
                                </li>
                            </ul>

                            <!-- <a href="javascript:void(0);" class="minimize-button"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon">keyboard_arrow_down</span></a> -->
                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Time Sheets</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Track employee hours</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Reports</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Real time reports and analytics</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Accounting</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage customers & employees</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create reminders</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Utilize GPS for simple navigatio</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Implement before and after photos</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Taskhub</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Manage & assign multiple projects</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>API Connectors</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Link up with your favorite software</span>
                                </li>
                            </ul>
                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Campaign Builder</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Create some great designs emails</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>GPS Tracking</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Get real-time updates on your team's location.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Mobile Tools</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Simple tools that come handy.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Survey Builder</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Feedbacks and reviews.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop" style="width:13%;float:left;">done</span><strong style="width:87%;float:left;">Inventory &nbsp; &nbsp; Management</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup" style="padding-top: 13px !important;">Keep track of all the your items.</span>
                                </li>
                            </ul>

                            <ul data-list="1" style="padding-top: 12px;clear:both;padding-bottom:12px;">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Credit Score</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Get the credit worthiness of your prospect.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Form Builder</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Customize & save your forms.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Accounting</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">A lite accounting software to keep you on the right track.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>eSign</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Easily customize any templates to create personal or business signage.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="bsc-margin">
                                <li>
                                    <span class=""><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">done</span><strong>Campaign Blast</strong></span>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul hidden">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Narrow down your target demographics & connect.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="wizard" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Wizard</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight wizard-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Turns multiple steps process in to a one-click automated function.</span>
                                </li>
                            </ul>

                            <ul data-list="1" class="ul-color-header">
                                <li>
                                    <a class="btn-show-less-more-desktop show-less" data-key="branding" href="javascript:void(0);"><span data-height-value="150" class="material-icons mdc-bottom-navigation__list-item__icon show-more-desktop">remove</span><strong>Branding</strong></a>
                                </li>
                            </ul>
                            <ul data-list="1" class="desc-ul ul-color-highlight branding-list">
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">A strategy that get customer to identify your business with your product & services.</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Video Estimates.</span>
                                </li>
                                <li>
                                    <i class="arrow-down" aria-hidden="true"></i>
                                    <span class="p3 open-popup">Improve your rate of acceptance.</span>
                                </li>
                            </ul>

                        </div>
                    </section>
                </div>
            </div>
          </div>
        </div>
        <!-- end pricing v2 -->


        <br class="clear" />
        <br/>


        <section class="addon desktop-only" style="">
            <div class="container">
                <div class="addon__box">
                    <div class="addon__list-cnt">
                      <?php foreach($active_addons_by_price_group as $key_addons => $addons) { ?>
                        <div class="addon__list-row">
                            <div class="addon__price">
                                <div class="addon__price-base"><span class="addon__price-currency">$</span><?php echo $key_addons; ?></div>
                                <div class="addon__price-label">Add-Ons</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul class="addon__list">
                                      <?php foreach($addons as $addon) { ?>
                                        <li><span class="fa fa-plus"></span> <?php echo $addon->name; ?></li>
                                      <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <br/>
                      <?php } ?>
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
<?php include viewPath('frontcommon/footer-pricing'); ?>
