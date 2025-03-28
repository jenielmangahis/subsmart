<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/business_tools_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The API Connector add-on is a powerful, easy-to-use tool for pulling data from your favorite softwares directly into your stack and automate your processes with unmatched flexibility.
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_google_contacts.png">

                                        <div class="nsm-card-title">
                                            <span>Google Contacts</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Contact Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            Export your nSmarTrac Customers to Google Contacts so you can identify the customers on your phone Caller ID or on sending emails from Gmail.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <!-- <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div> -->
                                        </div>
                                        <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('tools/google_contacts'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_quickbooks_payroll.png">

                                        <div class="nsm-card-title">
                                            <span>QuickBooks Payroll</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Payroll Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            The connector allows you to automatically push employee hours tracked through nSmarTrac time cards to your Quickbooks account.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <!-- <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div> -->
                                        </div>
                                        <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('tools/quickbooks'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_quickbooks_payroll.png">

                                        <div class="nsm-card-title">
                                            <span>QuickBooks Accounting</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Accounting Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            The connector allows you to import accounting data.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <!-- <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div> -->
                                        </div>
                                        <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('tools/quickbooks_accounting'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_nicejob.png">

                                        <div class="nsm-card-title">
                                            <span>NiceJob</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Review Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            Nicejob makes it easy to get more reviews, build your reputation, and spread your customer stories to new potential customers through social media channels.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <?php 
                                                        $is_enabled = 0;
                                                        if( array_key_exists('nicejob', $enabledApiConnectors) ){
                                                            $is_enabled = 1;
                                                        }   
                                                    ?>
                                                    <input class="form-check-input chk_api_enabled" data-apiname="nicejob" type="checkbox" id="switch_nicejob" <?= $is_enabled == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_nicejob">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$10.00/Month</label>
                                            </div>
                                        </div>
                                        <?php if( $is_enabled == 1 ){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/nicejob'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-12 col-md-3">
                        <?php 
                            $is_enabled = 0;
                            if( array_key_exists('zapier', $enabledApiConnectors) ){
                                $is_enabled = 1;
                            }   
                        ?>
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_zapier.png">

                                        <div class="nsm-card-title">
                                            <span>Zapier</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Global Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            Automated connections called Zaps, set up in minutes with no coding, can automate your day-to-day tasks and build workflows between apps. Each Zap has one app as the Trigger, where your information comes from and which causes one or more Actions in other apps, where your data gets sent automatically.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <!-- <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">                                                    
                                                    <input class="form-check-input chk_api_enabled" data-apiname="zapier" type="checkbox" id="switch_zapier" <?= $is_enabled == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_zapier">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$5.00/Month</label>
                                            </div> -->
                                        </div>
                                        <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <?php if( $is_enabled == 1 ){ ?>
                                                <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/zapier'); ?>'">Manage</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_mailchimp.png">

                                        <div class="nsm-card-title">
                                            <span>Mailchimp</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Get the Tools You Need to Grow Your Business and Automate Your Marketing. Mailchimp Makes It Easy to Find New Audiences and Reach People When It Matters Most.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <!-- <div class="row align-items-center mb-3">
                                            <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div>
                                        </div> -->
                                        <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('tools/mailchimp'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_active_campaign.png">

                                        <div class="nsm-card-title">
                                            <span>Active Campaign</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Create Simple Emails That Deliver & Convert.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <!-- <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div> -->
                                        </div>
                                        <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?= base_url('tools/active_campaign'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                    <!-- <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_api.png">

                                        <div class="nsm-card-title">
                                            <span>API Integration</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Our API Integration allows you to combine, with other popular brands so you can be more connected.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <?php 
                                                        $is_enabled = 0;
                                                        if( array_key_exists('api_integration', $enabledApiConnectors) ){
                                                            $is_enabled = 1;
                                                        }   
                                                    ?>
                                                    <input class="form-check-input chk_api_enabled" type="checkbox" id="switch_api" <?= $is_enabled == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_api">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$10.00/Month</label>
                                            </div>
                                        </div>
                                        <?php if( $is_enabled == 1 ){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/api_integration'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/zillow.png">

                                        <div class="nsm-card-title">
                                            <span>MLS Listings</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Zillow API</label>
                                        <label class="nsm-subtitle d-block">
                                            The Bridge Listing Output platform allows brokers and developers to access MLS listing data via a modern RESTful API.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <?php 
                                                        $is_enabled = 0;
                                                        if( array_key_exists('zillow', $enabledApiConnectors) ){
                                                            $is_enabled = 1;
                                                        }   
                                                    ?>
                                                    <input class="form-check-input chk_api_enabled" type="checkbox" id="switch_zillow" <?= $is_enabled == 1 ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_zillow">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div>
                                        </div>
                                        <?php if( $is_enabled == 1 ){ ?>
                                            <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/zillow'); ?>'">Manage</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/plaid.jpg">

                                        <div class="nsm-card-title">
                                            <span>PLAID</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Connect your financial accounts using PLAID.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" id="btn-setup-plaid">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <h4 class="fw-bold">Online Payments</h4>
                    </div>
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Please select the online preferred payment method. Once the setup is completed, your payment status will be tracked and updated automatically.
                        </div>
                    </div>

                    <?php
                    if( isset($settings) ){
                        if ($setting['is_active'] == 1) {
                            $is_active = 'YES';
                            $is_setup = 'YES';
                        } else {
                            $is_active = 'NO';
                            $is_setup = 'NOT SET';
                        }
                    }else{
                        $is_active = 'NO';
                        $is_setup = 'NOT SET';
                    }
                    ?>

                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/paypal-logo.png">

                                                <div class="nsm-card-title">
                                                    <span>PayPal</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Online Transaction Fees: as set by PayPal.
                                                </label>
                                            </div>
                                            <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <div class="col-12 col-md-12 mb-4">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input switch-default-payment-api" data-type="paypal" type="checkbox" name="switch_paypal" id="switch_paypal">
                                                    <label class="form-check-label" for="switch_paypal">Use Default Payment Tool</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 text-center">
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>   
                                                    <button type="button" class="nsm-button primary" id="btn_setup_paypal">Setup</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/square-payment.png">

                                                <div class="nsm-card-title">
                                                    <span>Square</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Online Transaction Fees: as set by Square, Instant Deposit is available.
                                                </label>
                                            </div>
                                            <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <div class="col-12 col-md-12 mb-4">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input switch-default-payment-api" data-type="square" type="checkbox" name="switch_square" id="switch_square">
                                                    <label class="form-check-label" for="switch_square">Use Default Payment Tool</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 text-center">
                                                <div class="row align-items-center mb-3">                                                    
                                                    <?php if($onlinePaymentAccount){ ?>
                                                        <?php if( $onlinePaymentAccount->square_refresh_token != '' ){ ?>
                                                            <div class="col-12">
                                                                <span class="nsm-badge success">Active</span>
                                                            </div>                                                            
                                                        <?php }else{ ?>
                                                            <div class="col-12">
                                                                <span class="nsm-badge warning">Not Set</span>
                                                            </div>                                                            
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <div class="col-12">
                                                            <span class="nsm-badge warning">Not Set</span>
                                                        </div>                                                        
                                                    <?php } ?>                                                    
                                                </div>
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                                    <button type="button" class="nsm-button primary" id="btn_setup_square">Setup</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3" style="display:none;">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/wepay-logo.png">

                                                <div class="nsm-card-title">
                                                    <span>WEPAY</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Online Transaction Fees: 2.9% + $0.30
                                                </label>
                                            </div>
                                            <div class="col-12 text-center">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-12">
                                                        <span class="nsm-badge warning">Not Set</span>
                                                        <span class="nsm-badge warning">Not Active</span>
                                                    </div>
                                                </div>
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                                    <button type="button" class="nsm-button primary" id="btn_setup_wepay">Setup</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/stripe-logo.png">

                                                <div class="nsm-card-title">
                                                    <span>Stripe</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Payments infrastructure for the internet with Stripe.com.
                                                </label>
                                            </div>
                                            <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <div class="col-12 col-md-12 mb-4">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input switch-default-payment-api" data-type="stripe" type="checkbox" name="switch_stripe" id="switch_stripe">
                                                    <label class="form-check-label" for="switch_stripe">Use Default Payment Tool</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 text-center">
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                                    <button type="button" class="nsm-button primary" id="btn_setup_stripe">Setup</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/nmi.png">

                                                <div class="nsm-card-title">
                                                    <span>NMI</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Payments infrastructure for the internet with NMI.
                                                </label>
                                            </div>
                                            <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <div class="col-12 col-md-12 mb-4">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input switch-default-payment-api" data-type="nmi" type="checkbox" name="switch_nmi" id="switch_nmi">
                                                    <label class="form-check-label" for="switch_nmi">Use Default Payment Tool</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 text-center">
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                                    <button type="button" class="nsm-button primary" id="btn_setup_nmi">Setup</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" style="height:100px;" src="<?php echo $url->assets ?>img/converge-logo.png">

                                                <div class="nsm-card-title">
                                                    <span>Converge</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Accept payments in any way your business requires with Converge.
                                                </label>
                                            </div>
                                            <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <div class="col-12 col-md-12 mb-4">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input switch-default-payment-api" data-type="converge" type="checkbox" name="switch_converge" id="switch_converge">
                                                    <label class="form-check-label" for="switch_converge">Use Default Payment Tool</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 text-center">
                                                <?php if ($onlinePaymentAccount->converge_merchant_id != '') : ?>
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-12">
                                                            <span class="nsm-badge success">Active</span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                                    <?php if ($onlinePaymentAccount) : ?>
                                                        <?php if ($onlinePaymentAccount->converge_merchant_id == '') : ?>
                                                            <button type="button" class="nsm-button" onclick="location.href='<?php echo base_url('customer/merchant'); ?>'">Apply Now</button>
                                                        <?php endif; ?>
                                                        <button type="button" class="nsm-button primary btn-setup-converge">
                                                            <?= $onlinePaymentAccount->converge_merchant_id != ''  ? 'Connected' : 'Setup'; ?>
                                                        </button>
                                                    <?php else : ?>
                                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('customer/merchant'); ?>'">Apply Now</button>
                                                        <button type="button" class="nsm-button primary btn-setup-converge">Setup</button>
                                                    <?php endif; ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <div class="nsm-card primary p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/braintree-logo.png">

                                                <div class="nsm-card-title">
                                                    <span>Braintree</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Use Braintree that makes it easy to accept payments
                                                </label>
                                            </div>
                                            <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                            <div class="col-12 col-md-12 mb-4">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input switch-default-payment-api" data-type="braintree" type="checkbox" name="switch_braintree" id="switch_braintree">
                                                    <label class="form-check-label" for="switch_braintree">Use Default Payment Tool</label>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="col-12 text-center">
                                                <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                                    <button type="button" class="nsm-button primary" id="btn_setup_braintree">Setup</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <h4 class="fw-bold">SMS</h4>
                    </div>
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Please select your preferred sms api to be used.
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/ring_central.png">

                                        <div class="nsm-card-title">
                                            <span>Ring Central</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Send SMS and make phone call via Ring Central API.
                                        </label>
                                    </div>
                                    <?php if(checkRoleCanAccessModule('api-connectors', 'write')){ ?>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-12">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input" type="checkbox" name="switch_ring_central" id="switch_ring_central" <?= $default_sms_api == 'ring_central' ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_ring_central">Use Default SMS Tool</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" id="btn-setup-ring-central">Manage</button>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/vonage.png">

                                        <div class="nsm-card-title">
                                            <span>Vonage</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Send SMS and make phone call via Vonage API.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input" type="checkbox" name="switch_vonage" id="switch_vonage" <?= $default_sms_api == 'vonage' ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_vonage">Use Default SMS Tool</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" id="btn-setup-vonage">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="col-12 col-md-3">
                        <div class="nsm-card primary p-5" role="button">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/twilio.png">

                                        <div class="nsm-card-title">
                                            <span>Twilio</span>
                                        </div>
                                        <label class="content-subtitle mb-2"></label>
                                        <label class="nsm-subtitle d-block">
                                            Send SMS and make phone call via a twilio API.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input" type="checkbox" name="switch_twilio" id="switch_twilio" <?= $default_sms_api == 'twilio' ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="switch_twilio">Use Default SMS and Call Tool</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" id="btn-setup-twilio">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    
                </div>

                <!-- <div class="row g-3 mt-3">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <h4 class="fw-bold">QuickBooks</h4>
                    </div>
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div>
                                    <label class="content-title fw-bold">Quickbook Status: </label>
                                    <span class="nsm-badge success">You are connected</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 grid-mb text-end">
                                <div class="nsm-page-buttons page-button-container">
                                    <button type="button" class="nsm-button error">
                                        <i class='bx bx-fw bx-cog'></i> Disconnect
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12 text-end">
                        <button type="button" class="nsm-button primary">
                            <i class='bx bx-fw bx-sync'></i> Sync with Quickbooks
                        </button>
                    </div>
                    <div class="col-12">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td data-name="Export">Export</td>
                                    <td data-name="Import">Import</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="3">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-12 text-end">
                        <button type="button" class="nsm-button primary">
                            <i class='bx bx-fw bx-sync'></i> View Sync Log
                        </button>
                    </div>
                    <div class="col-12">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td data-name="Resource">Resource</td>
                                    <td data-name="Total">Total</td>
                                    <td data-name="Synced">Synced</td>
                                    <td data-name="Failed">Failed</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <div class="col-12">
                        <table class="nsm-table">
                            <thead>
                                <tr>
                                    <td data-name="Sync History">Sync History</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="1">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if( $connect_msg != '' && $is_with_connect_error == 1 ){ ?>
            Swal.fire({
                title: 'API Connect',
                text: '<?= $connect_msg; ?>',
                icon: 'error',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        <?php }elseif( $connect_msg != '' && $is_with_connect_error == 0 ){ ?>
            Swal.fire({
                title: 'API Connect',
                text: '<?= $connect_msg; ?>',
                icon: 'success',
                showCancelButton: false,
                confirmButtonText: 'Okay'
            });
        <?php } ?>
        
        $("#btn_setup_paypal").on("click", function() {
            let api_module = 'paypal';
            generate_auth_key(api_module);
        });

        function api_paypal(){
            let _container = $("#paypal_api_container");
            let url = "<?php echo base_url(); ?>tools/_get_paypal_api_credentials";

            showLoader(_container);
            $("#setup_paypal_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        function api_plaid(){
            let _container = $("#plaid-container");
            let url = "<?php echo base_url(); ?>tools/_get_plaid_api_credentials";

            showLoader(_container);
            $("#setup_plaid_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#btn_setup_square").on("click", function() {
            <?php if( $onlinePaymentAccount ){ ?>
                <?php if( $onlinePaymentAccount->square_refresh_token ){ ?>
                    location.href = base_url + 'tools/square';
                <?php }else{ ?>
                    $("#setup_square_modal").modal("show");
                <?php } ?>
            <?php }else{ ?>
                $("#setup_square_modal").modal("show");
            <?php } ?>            
        });

        $("#btn_setup_wepay").on("click", function() {
            $("#setup_wepay_modal").modal("show");
        });

        function generate_auth_key(module_name){
            let url = "<?php echo base_url(); ?>tools/_send_auth_key";
            $.ajax({
                type: "POST",
                url: url,
                dataType: "json",
                success: function(result) {
                    if( result.is_success == 1 ){
                        $('#auth-modal').modal('show');
                        $('#auth-module').val(module_name);
                        $('.auth-email').html("<b>"+result.user_email+"</b>");
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot view data. We cannot verify or send authentication key to your email. Please contact your system administrator to continue.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                }
            });  
        }

        $('.chk_api_enabled').on('change', function(e){                        
            var api_name = $(this).attr('data-apiname');
            if( $(this).is(':checked') ){
                var is_enabled = 1;
                $(this).prop( "checked",false);
            }else{
                var is_enabled = 0;
                $(this).prop( "checked",true);
            }

            $('#enable_disable_api').modal('show');

            var url = base_url + "tools/_enable_disable_api_confirmation";
            $.ajax({
                type: 'POST',
                url: url,                
                data: {api_name:api_name,is_enabled:is_enabled},
                success: function(o) {
                    $('#enable-disable-api-container').html(o);
                },
            });
        });

        $("#form-auth-verify").on("submit", function(e) {
            e.preventDefault();
            let _this = $(this);            

            var url = "<?php echo base_url(); ?>tools/_validate_auth_key";
            _this.find("button[type=submit]").html("Verifying");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success == 1) {                        
                        $('.auth-key').val("");
                        $('.auth-email').html("");
                        $('#auth-modal').modal('hide');
                        if( $('#auth-module').val() == 'ring_central' ){
                            api_ring_central();
                        }else if( $('#auth-module').val() == 'twilio' ){
                            api_twilio();
                        }else if( $('#auth-module').val() == 'converge' ){
                            api_converge();
                        }else if( $('#auth-module').val() == 'nmi' ){
                            api_nmi();
                        }else if( $('#auth-module').val() == 'stripe' ){
                            api_stripe();
                        }else if( $('#auth-module').val() == 'paypal' ){
                            api_paypal();
                        }else if( $('#auth-module').val() == 'plaid' ){
                            api_plaid();
                        }else if( $('#auth-module').val() == 'braintree' ){
                            api_braintree();
                        }else if( $('#auth-module').val() == 'vonage' ){
                            api_vonage();
                        }
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Invalid authentication key.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.find("button[type=submit]").html("Verify and continue");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#btn-setup-ring-central").on("click", function(){
            let api_module = 'ring_central';
            generate_auth_key(api_module);
            
        });

        function api_ring_central(){
            let _container = $("#ring-central-container");
            let url = "<?php echo base_url(); ?>tools/_get_ring_central_credentials";

            showLoader(_container);
            $("#setup_ring_central").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#btn-setup-vonage").on("click", function(){
            let api_module = 'vonage';
            generate_auth_key(api_module);
            
        });

        function api_vonage(){
            let _container = $("#vonage-container");
            let url = "<?php echo base_url(); ?>tools/_get_vonage_credentials";

            showLoader(_container);
            $("#setup_vonage").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#btn-setup-twilio").on("click", function(){
            let api_module = 'twilio';
            generate_auth_key(api_module);
        });

        $("#btn-setup-twilio").on("click", function(){
            let api_module = 'twilio';
            generate_auth_key(api_module);
        });

        $("#btn-setup-plaid").on("click", function(){
            let api_module = 'plaid';
            generate_auth_key(api_module);
        });

        function api_twilio(){
            let _container = $("#twilio-container");
            let url = "<?php echo base_url(); ?>tools/_get_twilio_credentials";

            showLoader(_container);
            $("#setup_twilio").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#btn_setup_stripe").on("click", function() {
            let api_module = 'stripe';
            generate_auth_key(api_module);
        });

        function api_stripe(){
            let _container = $("#stripe_api_container");
            let url = "<?php echo base_url(); ?>tools/_get_stripe_api_credentials";

            showLoader(_container);
            $("#setup_stripe_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#btn_setup_braintree").on("click", function() {
            let api_module = 'braintree';
            generate_auth_key(api_module);
        });

        function api_braintree(){
            let _container = $("#braintree_api_container");
            let url = "<?php echo base_url(); ?>tools/_get_braintree_api_credentials";

            showLoader(_container);
            $("#setup_braintree_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#btn_setup_nmi").on("click", function() {
            let api_module = 'nmi';
            generate_auth_key(api_module);
        });

        function api_nmi(){
            let _container = $("#nmi_api_container");
            let url = "<?php echo base_url(); ?>tools/_get_nmi_api_credentials";

            showLoader(_container);
            $("#setup_nmi_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $(".btn-setup-converge").on("click", function() {
            let api_module = 'converge';
            generate_auth_key(api_module);
        });

        function api_converge(){
            let _container = $("#converge_api_container");
            let url = "<?php echo base_url(); ?>tools/_get_converge_api_credentials";

            showLoader(_container);
            $("#setup_converge_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                success: function(result) {
                    _container.html(result);
                }
            });
        }

        $("#form-paypal-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_paypal";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your paypal account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot save data.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#setup_paypal_modal").modal('hide');

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-ring-central-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = base_url + "tools/_activate_company_ring_central";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        $("#setup_ring_central").modal('hide');
                        Swal.fire({
                            title: 'RingCentral',
                            text: "Your Ring Central account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }                    

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-vonage-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_vonage";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        $("#setup_vonage").modal('hide');

                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your Vonage account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }                    

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $('#switch_ring_central').on('change', function(){
            var url = "<?php echo base_url(); ?>tools/_update_company_default_sms_api";

            if ($(this).is(':checked')) {
                var default_sms = 'ring_central';
            }else{
                var default_sms = '';
            }

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: {default_sms:default_sms},
                success: function(result) {
                    if (!result.is_success) {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });

                        $('#switch_ring_central').prop("checked", false);
                    }else{
                        //$('#switch_twilio').prop("checked", false);
                        $('#switch_vonage').prop("checked", false);
                    }
                },
            });
        });

        $('#switch_vonage').on('change', function(){
            var url = "<?php echo base_url(); ?>tools/_update_company_default_sms_api";

            if ($(this).is(':checked')) {
                var default_sms = 'vonage';
            }else{
                var default_sms = '';
            }

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: {default_sms:default_sms},
                success: function(result) {
                    if (!result.is_success) {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });

                        $('#switch_vonage').prop("checked", false);
                    }else{
                        //$('#switch_twilio').prop("checked", false);
                        $('#switch_ring_central').prop("checked", false);
                    }
                },
            });
        });

        $('#switch_twilio').on('change', function(){
            var url = "<?php echo base_url(); ?>tools/_update_company_default_sms_api";

            if ($(this).is(':checked')) {
                var default_sms = 'twilio';
            }else{
                var default_sms = '';
            }

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: {default_sms:default_sms},
                success: function(result) {
                    if (!result.is_success) {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });

                        $('#switch_twilio').prop("checked", false);
                    }else{
                        $('#switch_ring_central').prop("checked", false);
                        $('#switch_vonage').prop("checked", false);
                    }
                },
            });
        });

        $("#form-twilio-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_twilio";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        $("#setup_twilio").modal('hide');

                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your twilio account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }                    

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-plaid-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_plaid";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        $("#setup_plaid_modal").modal('hide');

                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your plaid account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }                    

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-converge-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_converge";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your converge account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot save data.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#setup_converge_modal").modal('hide');

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-nmi-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_nmi";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your nmi account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot save data.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#setup_nmi_modal").modal('hide');

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-stripe-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_stripe";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your stripe account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot save data.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#setup_stripe_modal").modal('hide');

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $("#form-braintree-account").on("submit", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url(); ?>tools/_activate_company_braintree";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Update Successful!',
                            text: "Your braintree account was successfully saved.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'Cannot save data.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#setup_braintree_modal").modal('hide');

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });
    });
    
    $('.switch-default-payment-api').on('change', function(){        
        if ($(this).is(':checked')) {
            var api = $(this).attr('data-type');
        }else{
            var api = '';
        }

        $.ajax({
            type: 'POST',
            url: base_url + 'tools/_update_company_default_payment_api',
            dataType: "json",
            data: {api:api},
            success: function(result) {
                if (result.is_success) {
                    $('.switch-default-payment-api').not(`#switch_${api}`).prop("checked", false);                      
                    Swal.fire({
                        title: 'API Tools',
                        text: "Default payment method was successfully updated.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                    $('.switch-default-payment-api').not(this).prop("checked", false);  
                }
            },
        });
    });

    $(document).on('click', '.btn-rc-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-rc-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-vonage-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-vonage-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-twilio-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-twilio-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-stripe-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-stripe-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-converge-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-converge-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-nmi-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-nmi-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-paypal-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-paypal-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-plaid-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-plaid-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });

    $(document).on('click', '.btn-braintree-edit', function(){
        $('.form-view-values').hide();
        $('.form-edit-values').show();
    });
    $(document).on('click', '.btn-braintree-cancel', function(){
        $('.form-view-values').show();
        $('.form-edit-values').hide();
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>