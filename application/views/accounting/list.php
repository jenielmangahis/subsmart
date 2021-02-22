<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/accounting/accounting'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <?php include viewPath('includes/notifications'); ?>
        <div class="container-fluid">
            <div class="page-title-box">

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body hid-desk" style="padding-bottom:0px;">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3 class="page-title">Lists</h3>
                                </div>
                                <div class="col-sm-12 p-0">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">Message here</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><a href="/accounting/chart_of_accounts" class="text-info">Chart of accounts</a></h5>
                                    <p>Displays your accounts. Balance sheet accounts track your assets and liabilities, and income and expense accounts categorize your transactions. From here, you can add or edit accounts.</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><a href="#" class="text-info">Payment Methods</a></h5>
                                    <p>Displays Cash, Check, and any other ways you categorize payments you receive from customers. That way, you can print deposit slips when you deposit the payments you have received.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><a href="#" class="text-info">Recurring Transactions</a></h5>
                                    <p>Displays a list of transactions that have been saved for reuse. From here, you can schedule transactions to occur either automatically or with reminders. You can also save unscheduled transactions to use at any time.</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><a href="#" class="text-info">Terms</a></h5>
                                    <p>Displays the list of terms that determine the due dates for payments from customers, or payments to vendors. Terms can also specify discounts for early payment. From here, you can add or edit terms.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><a href="/accounting/products-and-services" class="text-info">Products and Services</a></h5>
                                    <p>Displays the products and services you sell. From here, you can edit information about a product or service, such as its description, or the rate you charge.</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><a href="/accounting/attachments" class="text-info">Attachments</a></h5>
                                    <p>Displays the list of all attachments uploaded. From here you can add, edit, download, and export your attachments. You can also see all transactions linked to a particular attachment.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="ml-5"><a href="#" class="text-info">Product Categories</a></h5>
                                    <p class="ml-5">A means of classifying items that you sell to customers. Provide a way for you to quickly organize what you sell, and save you time when completing sales transaction forms.</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><a href="/accounting/tags" class="text-info">Tags</a></h5>
                                    <p>Displays the list of all tags created. You can add, edit, and delete your tags here.</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5><a href="#" class="text-info">Custom Form Styles</a></h5>
                                    <p>Customize your sales form designs, set defaults, and manage multiple templates.</p>
                                </div>
                                <div class="col-md-6">
                                    <h5><a href="#" class="text-info">Custom Fields</a></h5>
                                    <p>Sort, track, and report the information that matters to you. Now with enhanced custom fields, you can add more detailed info about your customers, vendors, and transactions.</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->

        </div>
        <!-- end container-fluid -->
    </div>
</div>

<!-- page wrapper end -->
<?php include viewPath('includes/footer_accounting'); ?>