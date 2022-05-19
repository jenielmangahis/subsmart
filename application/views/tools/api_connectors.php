<style>
.btn-md {
  width: 100%;
  background: #45a73c;
  border: none;
  color: #fff;
  font-weight: bold;
  font-size: 13px;
  padding: 10px 25px !important;
  border-radius: 20px;
}
.apply-container {
  width: max-content;
  margin: 0 auto;
  display: block;
}
.addon {
  min-height: 428px;
}
svg#svg-sprite-menu-close {
  position: relative;
  bottom: 112px !important;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php $this->load->view('includes/sidebars/api_connectors', $sidebar) ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="row align-items-center mt-5 bg-white">
                <div class="card">
                    <div class="card-body" >
                        <div class="col-sm-12">
                            <h3 class="page-title" style="margin-bottom:0px !important;">API Connectors</h3>
                            <div class="alert alert-warning col-md-12 mt-2 mb-5" role="alert">
                                <span style="color:black;">
                                    The API Connector add-on is a powerful, easy-to-use tool for pulling data from your favorite softwares directly into your stack and automate your processes with unmatched flexibility.
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <ul class="addon-list">
                                <li class="addon-li">
                                    <div class="group-name">Contact Connectors</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_google_contacts.png">
                                        </div>
                                        <div class="addon__name">
                                            Google Contacts                </div>
                                        <div class="addon__description text-ter">
                                            Export your nSmarTrac Customers to Google Contacts.<br>
                                            <a class="a-sec" data-toggle="popover" title="Google Contacts" data-content="Export your Markate Customers to Google Contacts so you can identify the customers on your phone Caller ID or on sending emails from Gmail." href="#">more...</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">
                                                    Free
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/google_contacts'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                        </div>
                                    </div>
                                </li>
                                <li class="addon-li">
                                    <div class="group-name">Payroll Connectors</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_quickbooks_payroll.png">
                                        </div>
                                        <div class="addon__name">
                                            QuickBooks Payroll                </div>
                                        <div class="addon__description text-ter">
                                            Automatically push employee hours to your Quickbooks account.<br>
                                            <a class="a-sec" data-toggle="popover" title="QuickBooks Payroll" data-content="The connector allows you to automatically push employee hours tracked through Markate time cards to your Quickbooks account." href="#">more...</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">
                                                    Free
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/quickbooks'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="group-name">Review Connectors</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_nicejob.png">
                                        </div>
                                        <div class="addon__name">
                                            NiceJob
                                        </div>
                                        <div class="addon__description text-ter">
                                            NiceJob is the easiest way to get more reviews, referrals and sales.<br><a class="a-sec" data-toggle="popover" title="NiceJob" data-content="Nicejob makes it easy to get more reviews, build your reputation, and spread your customer stories to new potential customers through social media channels." href="#">more...</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">$10.00/month</div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/nicejob'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="NICEJOB" data-name="NiceJob" id="onoff-NICEJOB" checked="">
                                                <label class="onoffswitch-label" for="onoff-NICEJOB">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            <div class="addon__switch__label--on">enabled</div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="group-name">Global Connectors</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_zapier.png">
                                        </div>
                                        <div class="addon__name">
                                            Zapier
                                        </div>
                                        <div class="addon__description text-ter">
                                            Zapier lets you connect Markate to hundreds of other web services.<br><a class="a-sec" data-toggle="popover" title="Zapier" data-content="Automated connections called Zaps, set up in minutes with no coding, can automate your day-to-day tasks and build workflows between apps. Each Zap has one app as the Trigger, where your information comes from and which causes one or more Actions in other apps, where your data gets sent automatically." href="#">more...</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">$5.00/month</div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/zapier'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="ZAPIER" data-name="Zapier" id="onoff-ZAPIER" checked="">
                                                <label class="onoffswitch-label" for="onoff-ZAPIER">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            <div class="addon__switch__label--on">enabled</div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="group-name">Mailchimp</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_mailchimp.png">
                                        </div>
                                        <div class="addon__name">
                                            Mailchimp
                                        </div>
                                        <div class="addon__description text-ter">
                                            Get the Tools You Need to Grow Your Business and Automate Your Marketing. Mailchimp Makes It Easy to Find New Audiences and Reach People When It Matters Most.
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">$10.00/month</div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/mailchimp'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="ZAPIER" data-name="Zapier" id="onoff-ZAPIER" checked="">
                                                <label class="onoffswitch-label" for="onoff-ZAPIER">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            <div class="addon__switch__label--on">enabled</div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="group-name">Active Campaign</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_active_campaign.png">
                                        </div>
                                        <div class="addon__name">
                                            Active Campaign
                                        </div>
                                        <div class="addon__description text-ter">
                                            Create Simple Emails That Deliver & Convert
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">$10.00/month</div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/active_campaign'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="ZAPIER" data-name="Zapier" id="onoff-ZAPIER" checked="">
                                                <label class="onoffswitch-label" for="onoff-ZAPIER">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            <div class="addon__switch__label--on">enabled</div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="group-name">API Integration</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?= base_url() ?>/assets/img/api-tools/thumb_api.png">
                                        </div>
                                        <div class="addon__name">
                                            API Integration
                                        </div>
                                        <div class="addon__description text-ter">
                                            Our API Integration allows you to combine, with other popular brands so you can be more connected.
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">$10.00/month</div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/api_integration'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="ZAPIER" data-name="Zapier" id="onoff-ZAPIER" checked="">
                                                <label class="onoffswitch-label" for="onoff-ZAPIER">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            <div class="addon__switch__label--on">enabled</div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="group-name">Zillow API</div>
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img">
                                            <img src="<?php echo base_url('assets/img/api-tools/') . 'zillow.jpg' ?>">
                                        </div>
                                        <div class="addon__name">
                                            MLS Listings
                                        </div>
                                        <div class="addon__description text-ter">

                                            The Bridge Listing Output platform allows brokers and developers to access MLS listing data via a modern RESTful API.
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">Free</div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="<?php echo base_url('tools/zillow'); ?>"><span class="fa fa-pencil-square-o icon"></span> Manage</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="Zillow" data-name="Zillow" id="onoff-Zillow" checked="">
                                                <label class="onoffswitch-label" for="onoff-Zillow">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                            <div class="addon__switch__label--on">enabled</div>

                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <!-- Online Payments -->
                        <div class="col-sm-12">
                            <h3 class="page-title" style="margin-bottom:0px !important;">Online Payments</h3>
                            <div class="alert alert-warning col-md-12 mt-2 mb-1" role="alert">
                                <span style="color:black;">
                                    Please select the online preferred payment method. Once the setup is completed, your payment status will be tracked and updated automatically.
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-6"></div><br /><br />
                        <div class="col-sm-6">
                            <div class="float-right d-none d-md-block">
                                <div class="dropdown">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <?php
                                if( $setting['is_active'] == 1 ){
                                    $is_active = 'YES';
                                    $is_setup = 'YES';
                                }else{
                                    $is_active = 'NO';
                                    $is_setup = 'NOT SET';
                                }
                            ?>
                            <ul class="addon-list">
                                <li class="addon-li">
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img" style="margin: 23px 0; height: 100px;">
                                            <img class="img-responsive" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/paypal-logo.png">
                                        </div>
                                        <div class="addon__name">PayPal</div>
                                        <div class="addon__description text-ter">
                                            Online Transaction Fees: as set by PayPal.
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <div class="apply-container" role="group" aria-label="...">
                                                  <a class="btn-md btn-paypal-form" href="javascript:void(0);">
                                                      <span class="fa fa-gear fa-margin-right"></span> Setup
                                                  </a>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img" style="margin: 23px 0; height: 100px;">
                                            <img class="img-responsive" style="height: 87px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/square-payment.png">
                                        </div>
                                        <div class="addon__name">Square</div>
                                        <div class="addon__description text-ter">
                                            Online Transaction Fees: as set by Square, Instant Deposit is available.
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">
                                                    Is Setup : NOT SET<br />
                                                    Is Active : NO
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a href="#setupSqaureModal" data-toggle="modal" data-target="#setupSqaureModal"><span class="fa fa-pencil-square-o icon"></span> Setup</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img" style="margin: 23px 0; height: 100px;">
                                            <img class="img-responsive" style="max-width: 160px;position: relative;top: 28px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/wepay-logo.png">
                                        </div>
                                        <div class="addon__name">WEPAY</div>
                                        <div class="addon__description text-ter">
                                            Online Transaction Fees: 2.9% + $0.30
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="addon_price">
                                                    Is Setup : NOT SET<br />
                                                    Is Active : NO
                                                </div>
                                            </div>
                                            <div class="col-sm-4 text-right">
                                                <a  href="#setupWePayModal" data-toggle="modal" data-target="#setupWePayModal"><span class="fa fa-pencil-square-o icon"></span> Setup</a>
                                            </div>
                                        </div>
                                        <div class="addon__switch">
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img" style="margin: 23px 0; height: 100px;">
                                            <img class="img-responsive" style="max-width: 151px;position: relative;top: 10px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/stripe-logo.png">
                                        </div>
                                        <div class="addon__name">Stripe</div>
                                        <div class="addon__description text-ter">
                                          Payments infrastructure for the internet with Stripe.com. <br>
                                          <a class="a-sec" data-toggle="popover" title="Stripe" data-content="Millions of companies of all sizes—from startups to Fortune 500s—use Stripe’s software and APIs to accept payments, send payouts, and manage their businesses online.  Here you can use this connector to set up with Stripe to start processing your payments from your customers and grow your business." href="javascript:void(0)">more...</a>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <div class="apply-container" role="group" aria-label="...">
                                                  <a class="btn-md btn-stripe-form" href="javascript:void(0);">
                                                      <span class="fa fa-gear fa-margin-right"></span> Setup
                                                  </a>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="addon-li">
                                    <div class="addon">
                                        <div class="addon__on"></div>
                                        <div class="addon__img" style="margin: 23px 0; height: 100px;">
                                            <img class="img-responsive" style="max-width: 200px;position: relative;top: 15px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/converge-logo.png">
                                        </div>
                                        <div class="addon__name">Converge</div>
                                        <div class="addon__description text-ter">
                                          Accept payments in any way your business requires with Converge.<br>
                                            <a class="a-sec" data-toggle="popover" title="Converge" data-content="Converge is a payment platform that enables you to grow your business the way you want. Over the phone, by mail, by invoice, online, or on-the-go." href="javascript:void(0)">more...</a>
                                        </div>
                                        <div class="row">
                                          <div class="col-sm-6">
                                            <div class="apply-container" role="group" aria-label="...">
                                                   <a class="btn-md" href="<?php echo base_url('customer/merchant'); ?>">
                                                      <span class="fa fa-check fa-margin-right"></span> Apply Now
                                                  </a>
                                              </div>
                                          </div>
                                          <div class="col-sm-6">
                                            <div class="apply-container" role="group" aria-label="...">
                                                  <a class="btn-md btn-converge-form" href="javascript:void(0);">
                                                      <span class="fa fa-gear fa-margin-right"></span> Setup
                                                  </a>
                                              </div>
                                          </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>

                        <div class="col-sm-12">
                            <h3 class="page-title" style="margin-bottom:0px !important;">QuickBooks</h3>
                            <div class="alert alert-warning col-md-12 mt-2 mb-1" role="alert">
                                <span style="color:black;">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card" style="min-height: 400px !important;">
                                    <?php include viewPath('flash'); ?>
                                    <div class="row margin-bottom">
                                        <div class="col-sm-12">
                                            <div class="status-text">
                                                <b>QuickBooks Status</b><br>
                                                <span class="text-sec">You are connected</span>
                                            </div>
                                            <a class="btn btn-default status-btn" href="javascript:void(0);" style="position: relative;bottom: 46px;left: 149px;">Disconnect</a>
                                        </div>
                                    </div>

                                    <b>QuickBooks Account</b><br>
                                    <div id="quickbooks-info">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Export</th>
                                                    <th>Import</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <a class="btn btn-info" href="#">Sync with QuickBooks</a>
                                    </div>
                                    <br>

                                    <hr>

                                    <div data-stats="container">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Resource</th>
                                                    <th>Total</th>
                                                    <th>Synced</th>
                                                    <th>Failed</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                        <a class="btn btn-info" href="#">View Sync Log</a>
                                    </div>

                                    <div class="bold" style="margin-top: 100px;">Sync History</div>
                                    <table class="table"></table>

                                    <div class="modal" data-sync-modal="modal" tabindex="-1" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Sync with QuickBooks</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form data-sync-modal="form" name="modal-form">
                                                        <div class="validation-error hide"></div>
                                                        <p>
                                                            Would you like to synchronize your customers, invoices, expenses and estimates with QuickBooks?<br><br>
                                                            The synchronization process will run in background and you can monitor the progress and get a notification email on completion.
                                                        </p>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-default" type="button" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary" type="button" data-sync-modal="submit" data-on-click-label="Sync Now...">Sync Now</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->

                                <div class="modal fade bd-example-modal-sm" id="modalConvergeApi" tabindex="-1" role="dialog" aria-labelledby="modalConvergeApiTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-form"></i> Setup Converge</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-converge-account', 'autocomplete' => 'off' ]); ?>
                                      <div class="modal-body converge-body"></div>
                                      <div class="modal-footer close-modal-footer">
                                        <button type="submit" class="btn btn-primary btn-converge-activate">Save</button>
                                      </div>
                                      <?php echo form_close(); ?>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal fade bd-example-modal-sm" id="modalStripeApi" tabindex="-1" role="dialog" aria-labelledby="modalStripeApiTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-form"></i> Setup Stripe</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-stripe-account', 'autocomplete' => 'off' ]); ?>
                                      <div class="modal-body stripe-api-body"></div>
                                      <div class="modal-footer close-modal-footer">
                                        <button type="submit" class="btn btn-primary btn-stripe-activate">Save</button>
                                      </div>
                                      <?php echo form_close(); ?>
                                    </div>
                                  </div>
                                </div>

                                <div class="modal fade bd-example-modal-sm" id="modalPaypalApi" tabindex="-1" role="dialog" aria-labelledby="modalPaypalApiTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-form"></i> Setup Paypal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <?php echo form_open_multipart('', ['class' => 'form-validate', 'id' => 'form-paypal-account', 'autocomplete' => 'off' ]); ?>
                                      <div class="modal-body paypal-api-body"></div>
                                      <div class="modal-footer close-modal-footer">
                                        <button type="submit" class="btn btn-primary btn-paypal-activate">Save</button>
                                      </div>
                                      <?php echo form_close(); ?>
                                    </div>
                                  </div>
                                </div>

                            </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/settings_modal'); ?>
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('tools/css/style'); ?>
<script>
$(function(){
    $(".btn-paypal-form").click(function(){
        $("#modalPaypalApi").modal('show');

        var url = base_url + 'tools/_get_paypal_api_credentials';
        $(".paypal-api-body").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           success: function(o)
           {
             $(".paypal-api-body").html(o);
           }
        });
        }, 800);
    });

    $(".btn-stripe-form").click(function(){
        $("#modalStripeApi").modal('show');

        var url = base_url + 'tools/_get_stripe_api_credentials';
        $(".stripe-api-body").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           success: function(o)
           {
             $(".stripe-api-body").html(o);
           }
        });
        }, 800);
    });

    $(".btn-converge-form").click(function(){
        $("#modalConvergeApi").modal('show');

        var url = base_url + 'tools/_get_converge_api_credentials';
        $(".converge-body").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
           type: "POST",
           url: url,
           success: function(o)
           {
             $(".converge-body").html(o);
           }
        });
        }, 800);
    });

    $("#form-converge-account").submit(function(e){
        e.preventDefault();

        var url = base_url + 'tools/_activate_company_converge';
        $(".btn-converge-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#form-converge-account").serialize(),
               success: function(o)
               {
                 if( o.is_success ){
                    Swal.fire({
                      icon: 'success',
                      title: 'Your converge account was successfully saved',
                      showConfirmButton: false,
                      timer: 1500
                    });

                    $("#modalConvergeApi").modal('hide');
                 }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data',
                        text: o.msg
                    });
                 }

                 $(".btn-converge-activate").html('Save');
               }
            });
        }, 800);
    });

    $("#form-stripe-account").submit(function(e){
        e.preventDefault();

        var url = base_url + 'tools/_activate_company_stripe';
        $(".btn-stripe-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#form-stripe-account").serialize(),
               success: function(o)
               {
                 if( o.is_success ){
                    Swal.fire({
                      icon: 'success',
                      title: 'Your stripe account was successfully saved',
                      showConfirmButton: false,
                      timer: 1500
                    });

                    $("#modalStripeApi").modal('hide');
                 }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data',
                        text: o.msg
                    });
                 }

                 $(".btn-stripe-activate").html('Save');
               }
            });
        }, 800);
    });

    $("#form-paypal-account").submit(function(e){
        e.preventDefault();

        var url = base_url + 'tools/_activate_company_paypal';
        $(".btn-paypal-activate").html('<span class="spinner-border spinner-border-sm m-0"></span>');
        setTimeout(function () {
        $.ajax({
               type: "POST",
               url: url,
               dataType: "json",
               data: $("#form-paypal-account").serialize(),
               success: function(o)
               {
                 if( o.is_success ){
                    Swal.fire({
                      icon: 'success',
                      title: 'Your paypal account was successfully saved',
                      showConfirmButton: false,
                      timer: 1500
                    });

                    $("#modalStripeApi").modal('hide');
                 }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Cannot save data',
                        text: o.msg
                    });
                 }

                 $(".btn-paypal-activate").html('Save');
               }
            });
        }, 800);
    });
});
</script>
