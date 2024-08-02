<?php include viewPath('v2/includes/accounting_header'); ?>
<style>
    a {
        text-decoration:none;
    }
     li a{
        font-size:16px;
     }
     .nsm-card-header{
        font-size:16px;
        background-color:#EEDBFB;
     }
</style> 

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/reports_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            CRM reporting helps businesses in a few key ways: It can helps you distill what is happening in your business, a key advantage of deploying a CRM. Your data will help provides different ways to make strategic business decisions. Your management team can track performance and make tactical changes where necessary.
                        </div>
                    </div>
                </div>

                <div class="row g-3 grid-mb">
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-server"></i> Popular Reports</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/monthly-closeout' ?>"><i class="bx bx-fw bx-chevron-right"></i> Monthly Closeout</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/yearly-closeout' ?>"><i class="bx bx-fw bx-chevron-right"></i> Yearly Closeout</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/profit-loss' ?>"><i class="bx bx-fw bx-chevron-right"></i> Profit and Loss</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/work-order-by-employee' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales Leaderboard </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-line-chart"></i> Sales</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-method' ?>"><i class="bx bx-fw bx-chevron-right"></i> Payments Type Summary </a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-month' ?>"><i class="bx bx-fw bx-chevron-right"></i> Payments Received</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-item' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales By Items</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-material-item' ?>"><i class="bx bx-fw bx-chevron-right"></i> Material Sales Report</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-product-item' ?>"><i class="bx bx-fw bx-chevron-right"></i> Product Sales Report</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-repeated-by-customer' ?>"><i class="bx bx-fw bx-chevron-right"></i> Repeated Business</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/sales-demographics' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales Demographics</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-purchase-tag-alt"></i> Receivables</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/account-receivable' ?>"><i class="bx bx-fw bx-chevron-right"></i> Account Receivable</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/invoice-by-date' ?>"><i class="bx bx-fw bx-chevron-right"></i> Invoice by Date</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/invoice-aging-summary' ?>"><i class="bx bx-fw bx-chevron-right"></i> Aging Summary</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/account-receivable-com-vs-res' ?>"><i class="bx bx-fw bx-chevron-right"></i> Commercial vs Residential</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 grid-mb">
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-purchase-tag-alt"></i> Expenses</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/expense-by-category' ?>"><i class="bx bx-fw bx-chevron-right"></i> Expenses By Category Summary</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-category' ?>"><i class="bx bx-fw bx-chevron-right"></i> Expenses By Category</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-customer' ?>"><i class="bx bx-fw bx-chevron-right"></i> Expenses By Customer</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-work-order' ?>"><i class="bx bx-fw bx-chevron-right"></i> Expenses By Work Order</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/expense-by-month-by-vendor' ?>"><i class="bx bx-fw bx-chevron-right"></i> Expenses By Vendor</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-receipt"></i> Estimates</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/estimate-status-by-month' ?>"><i class="bx bx-fw bx-chevron-right"></i> Estimates Summary</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-group"></i> Customers</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-customer' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales Summary By Customer</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/customer-sales' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales By Customer</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/payment-by-customer-group' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales By Customer Groups</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/customer-source' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales By Customer Source</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/customer-tax-by-month' ?>"><i class="bx bx-fw bx-chevron-right"></i> Tax Paid by Customers</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/customer-by-city-state' ?>"><i class="bx bx-fw bx-chevron-right"></i> Customer Demographics</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/customer-by-source' ?>"><i class="bx bx-fw bx-chevron-right"></i> Customer Source</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 grid-mb">
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-group"></i> Employees</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/employee-payroll-summary' ?>"><i class="bx bx-fw bx-chevron-right"></i> Payroll Summary</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/employee-payroll-by-employee' ?>"><i class="bx bx-fw bx-chevron-right"></i> Payroll By Employee</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/employee-payroll-log' ?>"><i class="bx bx-fw bx-chevron-right"></i> Payroll Log Details</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/employee-payroll-percent-commission' ?>"><i class="bx bx-fw bx-chevron-right"></i> Percent Sales Commission Report</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-time"></i> Timesheet</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/summary-by-period' ?>"><i class="bx bx-fw bx-chevron-right"></i> Time Log Summary</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/timesheet-entries' ?>"><i class="bx bx-fw bx-chevron-right"></i> Time Log Details</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-task"></i> Work Orders</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/work-order-status' ?>"><i class="bx bx-fw bx-chevron-right"></i> Work Order Status</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-3 grid-mb">
                    <div class="col-12 col-md-4">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block"><i class="bx bx-fw bx-receipt"></i> Taxes</div>
                            <div class="nsm-card-content">
                                <ul class="list-unstyled m-0">
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/sales-tax' ?>"><i class="bx bx-fw bx-chevron-right"></i> Sales Tax</a></li>
                                    <li class="cursor-pointer p-1"><a href="<?php echo base_url() . 'reports/main/report/invoice-items-no-tax' ?>"><i class="bx bx-fw bx-chevron-right"></i> Non Taxable Sales</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>