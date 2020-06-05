<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<section class="contact-spacing">
    <div class="container spacing-ft">
        <div class="row container-contact">
            <div class="col-sm-6 pt-1 mt-3">
              <div class="contact_container">
                <h2 class="contact-header">Get in touch</h2>
                <h2 class="uppercase cn-tn">nSmarTrac Pvt. Ltd.</h2>
                <br/>
                <h4 class="cn-address">Address content here - lorem ipsum dolor</h4>
                <br/>
                <div data-container="details" class="sp-ui">
                  <div class="sp-r contact-txt mb-15">
                    <span class="fa fa-phone"></span><span class="sp-txt ml-20">977.9851005280</span>
                  </div>
                  <div class="sp-r contact-txt mb-15">
                    <span class="fa fa-envelope"></span><a href="mailto:info@nsmartrac.com" class="contact-email">info@nsmartrac.com</a>
                  </div>
                </div>
                <br/>
                <h2 class="contact-header">Social Media</h2>
                <div class="social-cc text-left">
                  <a href="#" class="contact-social fb-color"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="contact-social twitter-color"><i class="fa fa-twitter"></i></a>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="bg-contact-phone">
                <div class="inquiry-container">
                  <p class="phone-header">Drop us a line</p>
                  <input type="text" value="" placeholder="Name" class="phone-input"/>
                  <input type="text" value="" placeholder="Address" class="phone-input"/>
                  <input type="text" value="" placeholder="Phone number" class="phone-input"/>
                  <input type="text" value="" placeholder="Email" class="phone-input"/>
                  <textarea placeholder="Message" class="phone-input" style="height: 95px;"></textarea>
                  <button type="submit" class="btn-phone">Send</button
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
