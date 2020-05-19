<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/report'); ?>
    <?php include viewPath('includes/notifications'); ?>
	
	<style>
		.report-group-items li {
			margin-bottom: 15px;
		}
		.report-group-items li a{
			color: #259e57;
			text-decoration: none;
			outline: none;
			font-size:16px
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
	</style>
	
    <div wrapper__section>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                       <div class="container-fluid"><div class="row">
						<div class="col-md-12">
						<h1>Reports</h1>
						<p class="margin-bottom">
							Monitor your business activity with these reports.
						</p>
						<div class="row margin-bottom">
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-server"></span>  Popular Reports</h3>
								<ul class="report-group-items">
									<li><a href="#/monthly-closeout"><span class="fa fa-angle-right fa-margin-right"></span> Monthly Closeout</a></li>
									<li><a href="#/yearly-closeout"><span class="fa fa-angle-right fa-margin-right"></span> Yearly Closeout</a></li>
									<li><a href="#/profit-loss"><span class="fa fa-angle-right fa-margin-right"></span> Profit and Loss</a></li>
									<li><a href="#/work-order-by-employee"><span class="fa fa-angle-right fa-margin-right"></span> Sales Leaderboard</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-usd" style="font-size:18px;"></span> Sales</h3>
								<ul class="report-group-items">
									<li><a href="#/payment-by-method"><span class="fa fa-angle-right fa-margin-right"></span> Payments Type Summary</a></li>
									<li><a href="#/payment-by-month"><span class="fa fa-angle-right fa-margin-right"></span> Payments Received</a></li>
									<li><a href="#/payment-by-item"><span class="fa fa-angle-right fa-margin-right"></span> Sales By Items</a></li>
									<li><a href="#/payment-by-material-item"><span class="fa fa-angle-right fa-margin-right"></span> Material Sales Report</a></li>
									<li><a href="#/payment-by-product-item"><span class="fa fa-angle-right fa-margin-right"></span> Product Sales Report</a></li>
									<li><a href="#/payment-repeated-by-customer"><span class="fa fa-angle-right fa-margin-right"></span> Repeated Business</a></li>
									<li><a href="#/sales-demographics"><span class="fa fa-angle-right fa-margin-right"></span> Sales Demographics</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-ticket" style="font-size:19px;"></span> Receivables</h3>
								<ul class="report-group-items">
									<li><a href="#/account-receivable"><span class="fa fa-angle-right fa-margin-right"></span> Account Receivable</a></li>
									<li><a href="#/invoice-by-date"><span class="fa fa-angle-right fa-margin-right"></span> Invoice by Date</a></li>
									<li><a href="#/invoice-aging-summary"><span class="fa fa-angle-right fa-margin-right"></span> Aging Summary</a></li>
									<li><a href="#/account-receivable-com-vs-res"><span class="fa fa-angle-right fa-margin-right"></span> Commercial vs Residential</a></li>
								</ul>
							</div>
						</div>
						<div class="row margin-bottom">
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-ticket" style="font-size:19px;"></span> Expenses</h3>
								<ul class="report-group-items">
									<li><a href="#/expense-by-category"><span class="fa fa-angle-right fa-margin-right"></span> Expenses By Category Summary</a></li>
									<li><a href="#/expense-by-month-by-category"><span class="fa fa-angle-right fa-margin-right"></span> Expenses By Category</a></li>
									<li><a href="#/expense-by-month-by-customer"><span class="fa fa-angle-right fa-margin-right"></span> Expenses By Customer</a></li>
									<li><a href="#/expense-by-month-by-work-order"><span class="fa fa-angle-right fa-margin-right"></span> Expenses By Work Order</a></li>
									<li><a href="#/expense-by-month-by-vendor"><span class="fa fa-angle-right fa-margin-right"></span> Expenses By Vendor</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-file-text-o" style="font-size:16px;"></span> Estimates</h3>
								<ul class="report-group-items">
									<li><a href="#/estimate-status-by-month"><span class="fa fa-angle-right fa-margin-right"></span> Estimates Summary</a></li>
								</ul>
							</div>
						<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-user" style="font-size:16px;"></span> Customers</h3>
								<ul class="report-group-items">
									<li><a href="#/payment-by-customer"><span class="fa fa-angle-right fa-margin-right"></span> Sales Summary By Customer</a></li>
									<li><a href="#/customer-sales"><span class="fa fa-angle-right fa-margin-right"></span> Sales By Customer</a></li>
									<li><a href="#/payment-by-customer-group"><span class="fa fa-angle-right fa-margin-right"></span> Sales By Customer Groups</a></li>
									<li><a href="#/customer-source"><span class="fa fa-angle-right fa-margin-right"></span> Sales By Customer Source</a></li>
									<li><a href="#/customer-tax-by-month"><span class="fa fa-angle-right fa-margin-right"></span> Tax Paid by Customers</a></li>
									<li><a href="#/customer-by-city-state"><span class="fa fa-angle-right fa-margin-right"></span> Customer Demographics</a></li>
									<li><a href="#/customer-by-source"><span class="fa fa-angle-right fa-margin-right"></span> Customer Source</a></li>
								</ul>
							</div>
						</div>
						<div class="row margin-bottom">
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-user" style="font-size:16px;"></span> Employees</h3>
								<ul class="report-group-items">
									<li><a href="#/employee-payroll-summary"><span class="fa fa-angle-right fa-margin-right"></span> Payroll Summary</a></li>
									<li><a href="#/employee-payroll-by-employee"><span class="fa fa-angle-right fa-margin-right"></span> Payroll By Employee</a></li>
									<li><a href="#/employee-payroll-log"><span class="fa fa-angle-right fa-margin-right"></span> Payroll Log Details</a></li>
									<li><a href="#/employee-payroll-percent-commission"><span class="fa fa-angle-right fa-margin-right"></span> Percent Sales Commission Report</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-clock-o" style="font-size:16px;"></span> Timesheet</h3>
								<ul class="report-group-items">
									<li><a href="#"><span class="fa fa-angle-right fa-margin-right"></span> Time Log Summary</a></li>
									<li><a href="#"><span class="fa fa-angle-right fa-margin-right"></span> Time Log Details</a></li>
								</ul>
							</div>
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-file-text-o" style="font-size:16px;"></span> Work Orders</h3>
								<ul class="report-group-items">
									<li><a href="#/work-order-status"><span class="fa fa-angle-right fa-margin-right"></span> Work Order Status</a></li>
								</ul>
							</div>
						</div>
						<div class="row margin-bottom">
							<div class="col-md-4">
								<h3 class="report-group"><span class="fa fa-percent" style="font-size:16px;"></span> Taxes</h3>
								<ul class="report-group-items">
									<li><a href="#/sales-tax"><span class="fa fa-angle-right fa-margin-right"></span> Sales Tax</a></li>
									<li><a href="#/invoice-items-no-tax"><span class="fa fa-angle-right fa-margin-right"></span> Non Taxable Sales</a></li>
								</ul>
							</div>
						</div>

							</div>
						</div>	</div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <?php echo form_close(); ?>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
