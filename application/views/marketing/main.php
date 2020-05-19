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

                <div class="marketing-card-deck card-deck">
                    <a href="#" class="card"> <img
                                class="card-img-top" alt="SMS Blast" src="<?php echo base_url('/assets/dashboard/images/sms.svg') ?>"
                                data-holder-rendered="true" style="height: 100px; width: 100%; display: block;">
                        <div class="card-body">
                            <h5 class="card-title">SMS Blast</h5>
                            <p class="card-text">Send sms marketing campaigns to all your customers or just a specific
                                group with our professional and personalized marketing platforms.</p>
                            <div class="card-price">$0.05/SMS + $5.00 service fee</div>
                        </div>
                    </a>
                    <a href="#" class="card"> <img
                                class="card-img-top" alt="SMS Automation"
                                src="<?php echo base_url('/assets/dashboard/images/sms_automation.svg') ?>"
                                data-holder-rendered="true" style="height: 100px; width: 100%; display: block;">
                        <div class="card-body">
                            <h5 class="card-title">SMS Automation</h5>
                            <p class="card-text">
                                Send automatic text messages to customers after a certain event, example texts: thank
                                you, service reminders, keep in touch, review estimate, invoice due, invoice paid, work
                                order completed
                            </p>
                            <div class="card-price">$0.10/SMS</div>
                        </div>
                    </a>
                    <a href="#" class="card"> <img
                                class="card-img-top" alt="SMS Automation"
                                src="<?php echo base_url('/assets/dashboard/images/voicemail_campaign.svg') ?>"
                                data-holder-rendered="true" style="height: 100px; width: 100%; display: block;">
                        <div class="card-body">
                            <h5 class="card-title">Questionnaire/Survey</h5>
                            <p class="card-text">
                                Engage your customers directly and personally by delivering a message directly to their
                                phone. No other form of direct marketing is as time efficient as our ringless voicemail
                                blast feature.
                            </p>
                            <div class="card-price">$0.20/voicemail + $10.00 service fee</div>
                        </div>
                    </a>
                </div>

            </div>
            <!-- end container-fluid -->
        </div>
    </div>
    <!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>