<style>
.bottom-txt {
    width: 100%;
    position: absolute;
    bottom: 20px;
    color: #36c12a;
    text-align: center;
    right: 0px !important;
}
.pb-30 {
  padding-bottom: 30px;
}
h5.card-title.mb-0, p.card-text.mt-txt {
  text-align: center !important;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 54% !important;
    right: 9px !important;
}
.card-deck-upgrades {
  display: block;
}
.card-deck-upgrades div {
    padding: 20px;
    float: left;
    width: 33.33%;
}
.card-body.align-left {
  width: 100% !important;
}
.card-deck-upgrades div a {
    display: block;
    width: 100%;
    min-height: 400px;
    float: left;
    text-align: center;
}
.page-title, .box-title {
  font-family: Sarabun, sans-serif !important;
  font-size: 1.75rem !important;
  font-weight: 600 !important;
  padding-top: 5px;
}
.pr-b10 {
  position: relative;
  bottom: 10px;
}
.left {
  float: left;
}
.p-40 {
  padding-left: 30px !important;
  padding-top: 40px !important;
}
a.btn-primary.btn-md {
    height: 38px;
    display: inline-block;
    border: 0px;
    padding-top: 7px;
    position: relative;
    top: 0px;
}
.card.p-20 {
    padding-top: 18px !important;
}
.col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
    position: relative;
    left: 13px;
}
.fr-right {
  float: right;
  justify-content: flex-end;
}
.p-20 {
  padding-top: 25px !important;
  padding-bottom: 25px !important;
  padding-right: 20px !important;
  padding-left: 20px !important;
}
.pd-17 {
  position: relative;
  left: 17px;
}
@media only screen and (max-width: 1300px) {
  .card-deck-upgrades div a {
      min-height: 440px;
  }
}
@media only screen and (max-width: 1250px) {
  .card-deck-upgrades div a {
      min-height: 480px;
  }
  .card-deck-upgrades div {
    padding: 10px !important;
  }
}
svg#svg-sprite-menu-close {
  position: relative;
  bottom: 63px;
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
</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/marketing'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <?php include viewPath('includes/notifications'); ?>
            <div class="container-fluid p-40">
                <div class="row">
                  <div class="card p-20" style="width:99%;">
                    <div class="row align-items-center">
                        <div class="col-sm-12">
                            <h3 class="page-title">Marketing Features</h3>
                        </div>
                    </div>
                    <div class="pl-3 pr-3 mt-1 row">
                      <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                          <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Get everything you need to manage and grow your business. The tools you need to scale and the marketing programs and talent you need to grow. Get The Talent & Technology To Do It For You and it’s all in one place.</span>
                      </div>
                    </div>
                    <div class="marketing-card-deck card-deck pl-50 pb-100">
                        <a href="<?php echo base_url('/sms_campaigns') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="SMS Blast - Flaticons" src="<?php echo base_url('/assets/dashboard/images/sms.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">SMS Blast</h5>
                                <p class="card-text mt-txt">Send sms marketing campaigns to all your customers or just a specific
                                    group with our professional and personalized marketing platforms.</p>
                                <div class="card-price bottom-txt">$0.05/SMS + $5.00 service fee</div>
                            </div>
                        </a>
                        <a href="<?php echo base_url('/sms_automation') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="SMS Automation - Flaticons"
                                    src="<?php echo base_url('/assets/dashboard/images/mail.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">SMS Automation</h5>
                                <p class="card-text mt-txt">
                                    Send automatic text messages to customers after a certain event, example texts: thank
                                    you, service reminders, keep in touch, review estimate, invoice due, invoice paid, work
                                    order completed
                                </p>
                                <div class="card-price bottom-txt">$0.10/SMS</div>
                            </div>
                        </a>
                        <a href="<?php echo base_url('/survey') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="Questionnaire/Survey - Flaticons"
                                    src="<?php echo base_url('/assets/dashboard/images/document.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Questionnaire/Survey</h5>
                                <p class="card-text mt-txt">
                                    Engage your customers directly and personally by delivering a message directly to their
                                    phone. No other form of direct marketing is as time efficient as our ringless voicemail
                                    blast feature.
                                </p>
                                <div class="card-price bottom-txt">$0.20/voicemail + $10.00 service fee</div>
                            </div>
                        </a>
                        <a href="<?php echo base_url('/email_campaigns') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="Email Blast - Flaticons"
                                    src="<?php echo base_url('/assets/dashboard/images/email-blast.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Email Blast</h5>
                                <p class="card-text mt-txt">
                                    Send email marketing campaigns to all your customers or just a specific customer group or with our professional and personalized marketing platform.
                                </p>
                                <div class="card-price bottom-txt">$5.00/1000 emails</div>
                            </div>
                        </a>
                        <a href="<?php echo base_url('/email_automation') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="Email Automation - Flaticons"
                                    src="<?php echo base_url('/assets/dashboard/images/email-automation.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Email Automation</h5>
                                <p class="card-text mt-txt">Send automatic emails to customers after a certain event, for example: thank you email, service reminders, keep in touch, invoice due reminder</p>
                                <div class="card-price bottom-txt">Free</div>
                            </div>
                        </a>
                        <a href="<?php echo base_url('/promote/deals') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="Deals & Steals - Flaticons"
                                    src="<?php echo base_url('/assets/dashboard/images/deal.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Deals & Steals</h5>
                                <p class="card-text mt-txt">Promote your business by creating exciting deals to email or post the URL on social media sites. Schedule these deals to run on specific dates or send out immediately.</p>
                                <div class="card-price bottom-txt">$10.00/1 Month</div>
                            </div>
                        </a>
                        <a href="#" class="card border-gr"> <img
                                    class="marketing-img" alt="Postcard on Demand"
                                    src="<?php echo base_url('/assets/dashboard/images/postcard.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Postcard on Demand</h5>
                                <p class="card-text mt-txt">Send out jumbo postcards (8.3" x 5.8") to your customers to notify them of a promotion you’re running. Select all your customers, a customer group or just specific customers on your list.</p>
                                <div class="card-price bottom-txt">$0.90/postcard</div>
                            </div>
                        </a>
                        <a href="#" class="card border-gr"> <img
                                    class="marketing-img" alt="Postcard Automation"
                                    src="<?php echo base_url('/assets/dashboard/images/postcard-automation.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Postcard Automation</h5>
                                <p class="card-text mt-txt">Let automation do all your follow-up needs for you by sending out jumbo sized postcards (8.3" x 5.8") to your customers to say thank you for using you for their service needs or to remind them they are due for service 6 months after their service date.
                </p>
                                <div class="card-price bottom-txt">$0.90/postcard</div>
                            </div>
                        </a>
                        <a href="<?php echo base_url('/campaign_blast') ?>" class="card border-gr"> <img
                                    class="marketing-img" alt="Campaign Blast"
                                    src="<?php echo base_url('/assets/dashboard/images/finder.png') ?>"
                                    data-holder-rendered="true">
                            <div class="card-body align-left">
                                <h5 class="card-title mb-0">Campaign Blast</h5>
                                <p class="card-text mt-txt">Send our jumbo postcards (8.3" x 5.8") to your next potential customer by choosing specific areas and using our numerous filters to ensure you are targeting to the right market for your business.</p>
                                <div class="card-price bottom-txt">$1.25/postcard</div>
                            </div>
                        </a>
                    </div>
                </div>
              </div>
            </div>
            <!-- end container-fluid -->
        </div>
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
