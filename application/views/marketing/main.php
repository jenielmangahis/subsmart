<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('includes/header'); ?>
    <div class="wrapper" role="wrapper">
        <?php include viewPath('includes/sidebars/marketing'); ?>
        <!-- page wrapper start -->
        <div wrapper__section>
            <?php include viewPath('includes/notifications'); ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Marketing Features</h1>
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
                            <div class="card-price bottom-txt">$10.00/1 Month</div>
                        </div>
                    </a>
                </div>

            </div>
            <!-- end container-fluid -->
        </div>
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
