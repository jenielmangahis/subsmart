<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .report-group-items li {
        margin-bottom: 15px;
    }

    .report-group-items li a {
        color: #259e57;
        text-decoration: none;
        outline: none;
        font-size: 16px
    }

    .report-group {
        font-size: 20px;
        font-weight: normal;
        margin-bottom: 25px;
        color: #2c3659;
    }

    .report-group span {
        margin-right: 10px;
    }

    .report-group-items {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    ul li .cursor-pointer a {
        font-size: 12px;
    }
</style>
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
                                <div class="col-sm-6">
                                    <h3 class="page-title" style="margin: 0 !important">Reports</h3>
                                </div>
                                <div class="col-sm-12">
                                    <div class="alert alert-warning mt-4 mb-4" role="alert">
                                        <span style="color:black;">CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-12 banking-tab-container">
                                    <a href="<?php echo url('/accounting/reports')?>" class="banking-tab">Standard</a>
                                    <a href="<?php echo url('/accounting/reports/custom')?>" class="banking-tab">Custom Reports</a>
                                    <a href="<?php echo url('/accounting/reports/management')?>" class="banking-tab">Management Reports</a>
                                    <a href="<?php echo url('/accounting/reports/activities')?>" class="banking-tab-active text-decoration-none">Activities Reports</a>
                                    <a href="<?php echo url('/accounting/reports/analytics')?>" class="banking-tab">Analytics</a>
                                    <a href="<?php echo url('/accounting/reports/payscale')?>" class="banking-tab">PayScale</a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="card border-0 py-0 px-2 shadow-none">
                                                <div class="container-fluid p-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h1 class="mt-0">Activities Reports</h1>
                                                            <p class="margin-bottom">
                                                                Monitor your business activity with these reports.
                                                            </p>
                                                            <div class="row margin-bottom">
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span
                                                                            class="fa fa-server"></span> Popular Reports
                                                                    </h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/monthly-closeout' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Monthly Closeout</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/yearly-closeout' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Yearly Closeout</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/profit-loss' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                
                                                                                </a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/work-order-by-employee' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales Leaderboard</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-usd"
                                                                            style="font-size:18px;"></span> Sales</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-method' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Payments Type Summary</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-month' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Payments Received</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-item' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales By Items</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-material-item' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Material Sales Report</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-product-item' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Product Sales Report</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-repeated-by-customer' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Repeated Business</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/sales-demographics' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales Demographics</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-ticket"
                                                                            style="font-size:19px;"></span> Receivables</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/account-receivable' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Account Receivable</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/invoice-by-date' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Invoice by Date</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/invoice-aging-summary' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Aging Summary</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/account-receivable-com-vs-res' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Commercial vs Residential</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="row margin-bottom">
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-ticket"
                                                                            style="font-size:19px;"></span> Expenses</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/expense-by-category' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Expenses By Category Summary</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-category' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Expenses By Category</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-customer' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Expenses By Customer</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-work-order' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Expenses By Work Order</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-vendor' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Expenses By Vendor</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-file-text-o"
                                                                            style="font-size:16px;"></span> Estimates</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/estimate-status-by-month' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Estimates Summary</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-user"
                                                                            style="font-size:16px;"></span> Customers</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-customer' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales Summary By Customer</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/customer-sales' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales By Customer</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/payment-by-customer-group' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales By Customer Groups</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/customer-source' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales By Customer Source</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/customer-tax-by-month' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Tax Paid by Customers</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/customer-by-city-state' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Customer Demographics</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/customer-by-source' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Customer Source</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="row margin-bottom">
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-user"
                                                                            style="font-size:16px;"></span> Employees</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/employee-payroll-summary' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Payroll Summary</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/employee-payroll-by-employee' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Payroll By Employee</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/employee-payroll-log' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Payroll Log Details</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/employee-payroll-percent-commission' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Percent Sales Commission Report</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-clock-o"
                                                                            style="font-size:16px;"></span> Timesheet</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/summary-by-period' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Time Log Summary</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/timesheet-entries' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Time Log Details</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-file-text-o"
                                                                            style="font-size:16px;"></span> Work Orders</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/work-order-status' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Work Order Status</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="row margin-bottom">
                                                                <div class="col-md-4">
                                                                    <h3 class="report-group"><span class="fa fa-percent"
                                                                            style="font-size:16px;"></span> Taxes</h3>
                                                                    <ul class="report-group-items">
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/sales-tax' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Sales Tax</a></li>
                                                                        <li><a
                                                                                href="<?php echo base_url() . 'reports/main/report/invoice-items-no-tax' ?>"><span
                                                                                    class="fa fa-angle-right fa-margin-right"></span>
                                                                                Non Taxable Sales</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end card -->
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    <!-- end row -->
                                </div>
                                <!-- end container-fluid -->
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