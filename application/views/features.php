<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include viewPath('frontcommon/header'); ?>

<!-- Headline Section -->
<section class="headline">
    <div class="container spacing-ft">
        <div class="row">
            <div class="col-sm-6 mobile-only">
                <img class="img-responsive w-120" alt="dashboard" src="<?php echo $url->assets ?>frontend/images/feature_dashboard.png">
            </div>
            <div class="col-sm-6 pt-5 mt-3">
                <h1 class="eff-title">Effortlessly run<br> your business</h1>
								<div class="startTrialBtn m-auto pt-5">
                  <a href="<?php echo url('registration') ?>" class="btn btn-violet">Get Started Now</a>
                </div>
            </div>
            <div class="col-sm-6 desktop-only">
                <img class="img-responsive w-120" alt="dashboard" src="<?php echo $url->assets ?>frontend/images/feature_dashboard.png">
            </div>
        </div>
    </div>
</section>

<section class="group-section">
    <div class="container">
        <div class="row group-section__row">
            <div class="col-sm-3">
                <div class="group" data-to="group-management">
                    <div class="group__box group-feature" data-key="management">
                        <img class="group__img" alt="management" src="<?php echo $url->assets ?>frontend/images/feature_management.png">
                    </div>
                    <div class="group__name group-management">
                        Management
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="group" data-to="group-finances">
                    <div class="group__box group-feature" data-key="finances">
                        <img class="group__img" alt="finances" src="<?php echo $url->assets ?>frontend/images/feature_finances.png">
                    </div>
                    <div class="group__name group-finances">
                        Finances
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="group" data-to="group-insights">
                    <div class="group__box group-feature" data-key="insight">
                        <img class="group__img" alt="insights" src="<?php echo $url->assets ?>frontend/images/feature_insights.png">
                    </div>
                    <div class="group__name group-insight">
                        Insights
                    </div>
                </div>
            </div>
						<div class="col-sm-3">
								<div class="group" data-to="group-insights">
									<div class="group__box group-feature" data-key="marketing">
											<img class="group__img" alt="marketing" src="<?php echo $url->assets ?>frontend/images/feature_marketing.png">
									</div>
									<div class="group__name group-marketing">
											Marketing
									</div>
								</div>
						</div>
        </div>
				<div class="group-title-tn features-group-title">nSmarTrac Features</div>
				<div class="features-group">
            <div class="features-group__name">Management</div>
            <ul class="features-group__list">
                <li>Manage customers and send <br/> SMS/email notifications</li>
                <li>Create & Assign Proposals, Work Orders, <br/> and Service Tickets</li>
                <li>Assigned Appointment Scheduling</li>
                <li>Time Clock & GPS locator</li>
            </ul>
        </div>
				<div class="features-group">
            <div class="features-group__name">Finances</div>
            <ul class="features-group__list">
                <li>Send custom estimates and invoices</li>
                <li>Get paid online</li>
                <li>Track Personal & Company Expenses</li>
                <li>Bookkeeping & Beyond</li>
                <li>Payroll, Taxes, & Banking</li>
            </ul>
        </div>
				<div class="features-group">
            <div class="features-group__name">Marketing</div>
            <ul class="features-group__list">
                <!-- <li>Create your own online store</li> -->
                <li>Run exclusive deals and campaigns</li>
                <li>SMS & Email Blasts</li>
				<li>Personalized Campaigns</li>
                <!-- <li>Customer Finder 360</li>  This looks like a trademarked term, we need our own name for whatever this is.  -->
            </ul>
        </div>
				<div class="features-group">
            <div class="features-group__name">Insights</div>
            <ul class="features-group__list">
                <li>Customized "At A Glance" widgets <br/> for Dashboard</li>
                <li>Company, Management, & Financial <br/> Reporting</li>
								<li>TaskHub Organizer</li>
            </ul>
        </div>
				<div class="features-group">
            <div class="features-group__name">Automation</div>
            <ul class="features-group__list">
                <li>From Start to Finish SMS, Email, & Post Card Automation</li>
            </ul>
        </div>
    </div>
</section>
<section class="group-section-1" id="group-management">
    <div class="container">
        <div class="text-center">
            <div class="circle-down"><span class="fa fa-chevron-down"></span></div>
        </div>
        <div class="group-title">Management</div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6 systemInfo text-right pt-2">
                    <h3 class="pt-2">
                        Manage customers and <br/> send notifications
                    </h3>
                    <p>
                        With nSmarTrac, customer information is stored within the intuitive dashboard. So you can easily find addresses with directions and maps for clear navigation.
                    </p>
                </div>
                <div class="col-sm-6">
                    <img class="img-responsive" alt="customers management" src="<?php echo $url->assets ?>frontend/images/contact-manager.png">
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="work orders" src="<?php echo $url->assets ?>frontend/images/invoice-home.png">
                </div>
                <div class="col-sm-6 systemInfo pt-4 mt-2 pl-5">
                    <h3>
                        Create and assign <br/> work orders
                    </h3>
                    <p>Two simple steps that will help you increase productivity:</p>
                    <br/>
                    <ol class="feature__list">
                        <li>
                            Track and update the time log, which allows you to add before and after pictures.
                        </li>
                        <li>
                            Once the customer is satisfied, they can sign off on the completed job with ease.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6 systemInfo text-right pt-5">
                    <h3>Automate appointment scheduling</h3>
                    <p>
                        Now you can schedule appointments for both your customers and employees, without barely lifting a finger.
                    </p>
                </div>
                <div class="col-sm-6 pl-3">
                    <img class="img-responsive" alt="schedule" src="<?php echo $url->assets ?>frontend/images/work-management.png">
                </div>
            </div>
        </div>
    </div>
</section>
<section class="group-section-2" id="group-finances">
    <div class="container">
        <div class="text-center">
            <div class="circle-down p-0"><span class="fa fa-chevron-down"></span></div>
        </div>
        <div class="group-title">Finances</div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive" alt="invoices" src="<?php echo $url->assets ?>frontend/images/invoice-home.png">
                </div>
                <div class="col-sm-6 systemInfo pl-4 mt-2 pt-3 pl-4">
                    <h3 class="mb-25">Send custom estimates <br/> and invoices</h3>
                    <p>nSmarTrac lets you build custom estimates and send invoices from the palm of your hand.</p>
                    <br/>
                    <ol class="feature__list">
                        <li>
                            Add your logo, terms and conditions. Attach work orders.
                        </li>
                        <li>
                            Track and record payments like never before. With card, cash and check options available, you have everything you’ll ever need.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6 systemInfo text-right pt-5">
                    <h3>Get paid online</h3>
                    <ol class="feature__list">
                        <li>
                            Through nSmarTrac, payments are safely and securely deposited through our Square, Paypal and Wepay integrated processors.
                            <img class="img-responsive margin-top img-30" src="<?php echo $url->assets ?>frontend/images/payments-img.png">
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <img class="img-responsive w-120" alt="online payment" src="<?php echo $url->assets ?>frontend/images/invoice-v2.png">
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive" alt="expenses" src="<?php echo $url->assets ?>frontend/images/mileage.png">
                </div>
                <div class="col-sm-6 systemInfo pt-4 pl-4">
                    <h3>Track expenses</h3>
                    <p>What used to be a stressful, time-consuming task just got a whole lot easier. nSmarTrac lets you:</p>
                    <br/>
                    <ol class="feature__list">
                        <li>
                            Conveniently attach receipts and track mileage.
                        </li>
                        <li>
                            Seamlessly convert customer expenses into invoices.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="dyk">
    <div class="container">
        <div class="text-center">
            <div class="circle-down"><span class="fa fa-chevron-down"></span></div>
        </div>
        <h2>Fact</h2>
        <p>
            <!-- Companies using nSmarTrac realized a <br><span>3.5x increase</span> in productivity alone. -->
            Business that use our proud platform realized a <br><span>10x increase</span> in productivity.
        </p>
    </div>
    <div class="dyk__btn">
        <a class="btn btn-violet btn-xl" href="<?php echo url('registration') ?>">Try it now for free</a>
    </div>
</section>
<section class="group-section-3" id="group-insights">
  <div class="container">
    <div class="feature">
        <div class="group-title">Insights</div>
        <div class="row">
            <div class="col-sm-6">
                <img class="img-responsive w-110" alt="reports" src="<?php echo $url->assets ?>frontend/images/chart.png">
            </div>
            <div class="col-sm-6 systemInfo pt-4 pl-5">
                <h3>Get instant insights</h3>
                <p>nSmarTrac provides users with valuable reports and insights that paint a clearer picture of where your business is now and where its going.</p>
            </div>
        </div>
    </div>
  </div>
</section>
<section class="group-section-4" id="group-marketing">
    <div class="container">
        <div class="text-center">
            <div class="circle-down"><span class="fa fa-chevron-down"></span></div>
        </div>
        <div class="group-title">Marketing</div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="booking plugin" src="<?php echo $url->assets ?>frontend/images/booking.png">
                </div>
                <div class="col-sm-6 systemInfo pl-5 pt-5 mt-3">
                    <h3>
                        Create your own online store
                    </h3>
                    <ol class="feature__list">
                        <li>
                            Customize your store with your business in mind. Simply upload your credentials, pictures, service areas, reviews and so much more.
                        </li>
                        <li>
                            Customers can view your services and contact you directly through the website.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6 systemInfo pt-4 mt-2">
                    <h3>Run exclusive deals <br/> and campaigns</h3>
                    <p>Creating deals just got a whole lot easier.</p>
                    <br/>
                    <ol class="feature__list">
                        <li>
                            Effortlessly make a deal with nSmarTrac and promote it on your website.
                        </li>
                        <li>
                            Customers can book and appointment and seal the deal instantly.
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="run deals" src="<?php echo $url->assets ?>frontend/images/feature_deal.png">
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="booking plugin" src="<?php echo $url->assets ?>frontend/images/feature_postcard.png">
                </div>
                <div class="col-sm-6 systemInfo pl-5 pt-5">
                    <h3>
                        Personalized postcards for your customers
                    </h3>
                    <ol class="feature__list">
                        <li>
                            This is a priceless way to build connections and show your customers just how much you care.
                        </li>
                        <li>
                            Our intuitive card builder lets you create from scratch or upload your own design. The options are endless!
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6 systemInfo pt-5 mt-4">
                    <h3>
                        Change to Campaign Blast
                    </h3>
                    <p>
                        In business, you should always strive to be at least one step ahead of your competition. With custom finder 360 you can narrow your target audience and connect with new customers better than ever before.
                    </p>
                </div>
                <div class="col-sm-6">
                    <img class="img-responsive w-120" alt="customer finder 360" src="<?php echo $url->assets ?>frontend/images/feature_360.png">
                </div>
            </div>
        </div>

        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="Email automation" src="<?php echo $url->assets ?>frontend/images/feature_proposal.png">
                </div>
                <div class="col-sm-6 systemInfo pl-5 pt-5">
                    <h3>Proposal Kit</h3>
                    <ol class="feature__list">
                        <li>
                            Create proposals using a library of fully customizable templates.
                        </li>
                        <li>
                            Once you have the template ready, you will attach the estimate to the proposal and send it from anywhere, every time.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="group-section-5" id="group-automation">
    <div class="container">
        <div class="text-center">
            <div class="circle-down top-0"><span class="fa fa-chevron-down"></span></div>
        </div>
        <div class="group-title">Automation</div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="expenses" src="<?php echo $url->assets ?>frontend/images/feature_automation.png">
                </div>
                <div class="col-sm-6 systemInfo pl-5 pt-5">
                    <h3>SMS Automation</h3>
                    <br/>
                    <ol class="feature__list">
                        <li>
                            Send custom text messages on specific occasions, like: a follow up for an estimate, an invoice is due or work order is completed.
                        </li>
                        <li>
                            You can customize the text utilizing smart placeholders.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6 systemInfo pt-5">
                    <h3>Email Automation</h3>
                    <br/>
                    <ol class="feature__list">
                        <li>
                            Now you can send custom emails to customers on specific occasions, like: when an invoice is due, work order is completed or bill has been paid.
                        </li>
                        <li>
                            nSmarTrac lets you effortlessly customize the email templates while utilizing smart placeholders for your convenience.
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <img class="img-responsive w-120" alt="Email automation" src="<?php echo $url->assets ?>frontend/images/feature_email.png">
                </div>
            </div>
        </div>
        <div class="feature">
            <div class="row">
                <div class="col-sm-6">
                    <img class="img-responsive w-110" alt="Postcard automation" src="<?php echo $url->assets ?>frontend/images/feature_pscard.png">
                </div>
                <div class="col-sm-6 systemInfo pt-5 pl-5">
                    <h3>Postcard Automation</h3>
                    <ol class="feature__list">
                        <li>
                            Simply send postcards to your customers once an invoice has been paid.
                        </li>
                        <li>
                            Deliver thank you notes after the completion of a work order.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cta">
    <div class="container systemInfo">
        <h3>Ready to try nSmarTrac?</h3>
        <p>nSmarTrac is designed with small businesses in mind.<br>Manage on the go, save some time and make more money.</p>
    </div>
    <div class="cta__btn">
        <a class="btn btn-primary btn-xl" href="<?php echo url('registration') ?>">Get started now</a>
    </div>
</section>
<?php include viewPath('frontcommon/footer'); ?>
