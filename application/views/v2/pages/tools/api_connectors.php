<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/tools/api_connectors_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/tools_tabs'); ?>
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
                        <div class="nsm-card p-5" role="button">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_google_contacts.png">

                                        <div class="nsm-card-title">
                                            <span>Google Contacts</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Contact Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            Export your Markate Customers to Google Contacts so you can identify the customers on your phone Caller ID or on sending emails from Gmail.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/google_contacts'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
                            <div class="nsm-card-content h-100">
                                <div class="row h-100 align-content-between">
                                    <div class="col-12 text-center mb-3">
                                        <img class="nsm-card-img-lg" src="<?= base_url() ?>/assets/img/api-tools/thumb_quickbooks_payroll.png">

                                        <div class="nsm-card-title">
                                            <span>QuickBooks Payroll</span>
                                        </div>
                                        <label class="content-subtitle mb-2">Payroll Connectors</label>
                                        <label class="nsm-subtitle d-block">
                                            The connector allows you to automatically push employee hours tracked through Markate time cards to your Quickbooks account.
                                        </label>
                                    </div>
                                    <div class="col-12 text-center">
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/quickbooks'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
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
                                                    <input class="form-check-input" type="checkbox" id="switch_nicejob" checked>
                                                    <label class="form-check-label" for="switch_nicejob">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$10.00/Month</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/nicejob'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
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
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input" type="checkbox" id="switch_zapier" checked>
                                                    <label class="form-check-label" for="switch_zapier">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$5.00/Month</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/zapier'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
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
                                        <div class="row align-items-center mb-3">
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input" type="checkbox" id="switch_mailchimp" checked>
                                                    <label class="form-check-label" for="switch_mailchimp">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$10.00/Month</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/mailchimp'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
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
                                            <div class="col-12 col-md-6">
                                                <div class="form-check form-switch nsm-switch m-auto">
                                                    <input class="form-check-input" type="checkbox" id="switch_activecampaign" checked>
                                                    <label class="form-check-label" for="switch_activecampaign">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$10.00/Month</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/active_campaign'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
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
                                                    <input class="form-check-input" type="checkbox" id="switch_api" checked>
                                                    <label class="form-check-label" for="switch_api">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">$10.00/Month</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/api_integration'); ?>'">Manage</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-card p-5" role="button">
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
                                                    <input class="form-check-input" type="checkbox" id="switch_zillow" checked>
                                                    <label class="form-check-label" for="switch_zillow">Enabled</label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="nsm-subtitle text-success">Free</label>
                                            </div>
                                        </div>
                                        <button type="button" class="nsm-button primary" onclick="location.href='<?php echo base_url('tools/zillow'); ?>'">Manage</button>
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
                                <div class="nsm-card p-5" role="button">
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
                                            <div class="col-12 text-center">
                                                <button type="button" class="nsm-button primary" id="btn_setup_paypal">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-5" role="button">
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
                                            <div class="col-12 text-center">
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-12">
                                                        <span class="nsm-badge warning">Not Set</span>
                                                        <span class="nsm-badge warning">Not Active</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="nsm-button primary" id="btn_setup_square">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-5" role="button">
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
                                                <button type="button" class="nsm-button primary" id="btn_setup_wepay">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-5" role="button">
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
                                            <div class="col-12 text-center">
                                                <button type="button" class="nsm-button primary" id="btn_setup_stripe">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-5" role="button">
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
                                            <div class="col-12 text-center">
                                                <button type="button" class="nsm-button primary" id="btn_setup_nmi">Setup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="nsm-card p-5" role="button">
                                    <div class="nsm-card-content h-100">
                                        <div class="row h-100 align-content-between">
                                            <div class="col-12 text-center mb-3">
                                                <img class="nsm-card-img-lg" src="<?php echo $url->assets ?>img/converge-logo.png">

                                                <div class="nsm-card-title">
                                                    <span>Converge</span>
                                                </div>
                                                <label class="content-subtitle mb-2"></label>
                                                <label class="nsm-subtitle d-block">
                                                    Accept payments in any way your business requires with Converge.
                                                </label>
                                            </div>
                                            <div class="col-12 text-center">
                                                <?php if ($onlinePaymentAccount->converge_merchant_id != '') : ?>
                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-12">
                                                            <span class="nsm-badge success">Active</span>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

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
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btn_setup_paypal").on("click", function() {
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
        });

        $("#btn_setup_square").on("click", function() {
            $("#setup_square_modal").modal("show");
        });

        $("#btn_setup_wepay").on("click", function() {
            $("#setup_wepay_modal").modal("show");
        });

        $("#btn_setup_stripe").on("click", function() {
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
        });

        $("#btn_setup_nmi").on("click", function() {
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
        });

        $(".btn-setup-converge").on("click", function() {
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
        });

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
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>