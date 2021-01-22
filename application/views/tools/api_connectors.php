<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php $this->load->view('includes/sidebars/api_connectors', $sidebar) ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">API Connectors</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                Connect the apps you use everyday to automate your work and be more.
                            </li>
                        </ol>
                    </div>
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <ul class="addon-list">
                            <li class="addon-li">
                                <div class="group-name">Contact Connectors</div>
                                <div class="addon">
                                    <div class="addon__on"></div>
                                    <div class="addon__img">
                                        <img src="/assets/img/api-tools/thumb_google_contacts.png">
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
                                        <img src="/assets/img/api-tools/thumb_quickbooks_payroll.png">
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
                                        <img src="/assets/img/api-tools/thumb_nicejob.png">
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
                                        <img src="/assets/img/api-tools/thumb_zapier.png">
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
                                        <img src="/assets/img/api-tools/thumb_mailchimp.png">
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
                                        <img src="/assets/img/api-tools/thumb_active_campaign.png">
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
                                        <img src="/assets/img/api-tools/thumb_api.png">
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
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="row">

            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<?php include viewPath('tools/css/style'); ?>