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
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-10">
                                    <h1><?php echo setPageName($type) ?> for <?php echo getLoggedName();?></h1>
                                </div>
                                <div class="col-md-2 text-right">
                                    <div class="h1-spacer">
                                        <a class="a-hunderline" href="<?php echo base_url() . 'reports/main' ?>"><span class="fa fa-angle-left fa-size-md"></span>Return to Reports</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row margin-bottom">
                                <?php if ($type === "customer-by-source") : ?>
                                <div class="col-sm-8 col-md-8 magbottompad">
                                </div>
                                <?php else :?>
                                <div class="col-sm-8 col-md-8 magbottompad">
                                    <div class="dropdown dropdown-inline filter-date">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span class="fa fa-calendar margin-right-sec"></span><span class="select-report" id="selectedFilter" data-filter-date="selected-item-name">This Year <span class="caret"></span></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y') . '-01-01' ?>" data-date-start-value="<?php echo '01-Jan-'. date('Y') ?>" data-date-end="<?php echo date('Y') . '-12-31' ?>" data-date-end-value="<?php echo '31-Dec-'.date('Y') ?>" data-name="This Year" href="#">This Year</a>
                                                </li>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y') . '-04-01' ?>" data-date-start-value="<?php echo '01-Apr-'.date('Y') ?>" data-date-end="<?php echo date('Y') . '-06-30' ?>" data-date-end-value="<?php echo '30-Jun-'.date('Y') ?>" data-name="This Year - Q2" href="#">This Year - Q2</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y') . '-01-01' ?>" data-date-start-value="<?php echo '01-Jan-'.date('Y') ?>" data-date-end="<?php echo date('Y') . '-03-31' ?>" data-date-end-value="<?php echo '31-Mar-'.date('Y') ?>"  data-name="This Year - Q1" href="#">This Year - Q1</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y-m') . '-01' ?>" data-date-start-value="<?php echo '01-'.date('M-Y') ?>" data-date-end="<?php echo date('Y-m') . '-31' ?>" data-date-end-value="<?php echo '31-'.date('M-Y') ?>" data-name="This Month" href="#">This Month</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y-m-d', strtotime( 'monday this week' )); ?>" data-date-start-value="<?php echo date('d-M-Y', strtotime( 'monday this week' )); ?>" data-date-end="<?php echo date('Y-m-d', strtotime( 'sunday this week' )); ?>" data-date-end-value="<?php echo date('d-M-Y', strtotime( 'sunday this week' )); ?>" data-name="This Week" href="#">This Week</a>
                                                </li>
                                            <?php endif; ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date("Y", strtotime("-1 years")) . '-01-01' ?>" data-date-start-value="<?php echo '01-Jan-'.date("Y", strtotime("-1 years")) ?>" data-date-end="<?php echo date("Y", strtotime("-1 years")) . '-12-31' ?>" data-date-end-value="<?php echo '31-Dec-'.date("Y", strtotime("-1 years")) ?>" data-name="Previous Year" href="#">Previous Year</a>
                                                </li>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date("Y", strtotime("-1 years")) . '-10-01' ?>" data-date-start-value="<?php echo '01-Oct-'.date("Y", strtotime("-1 years")) ?>" data-date-end="<?php echo date("Y", strtotime("-1 years")) . '-12-31' ?>" data-date-end-value="<?php echo '31-Dec-'.date("Y", strtotime("-1 years")) ?>" data-name="Previous Year - Q4" href="#">Previous Year - Q4</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date("Y", strtotime("-1 years")) . '-07-01' ?>" data-date-start-value="<?php echo '01-Jul-'.date("Y", strtotime("-1 years")) ?>" data-date-end="<?php echo date("Y", strtotime("-1 years")) . '-09-30' ?>" data-date-end-value="<?php echo '30-Sep-'.date("Y", strtotime("-1 years")) ?>" data-name="Previous Year - Q3" href="#">Previous Year - Q3</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date("Y", strtotime("-1 years")) . '-04-01' ?>" data-date-start-value="<?php echo '01-Apr-'.date("Y", strtotime("-1 years")) ?>" data-date-end="<?php echo date("Y", strtotime("-1 years")) . '-06-30' ?>" data-date-end-value="<?php echo '30-Jun-'.date("Y", strtotime("-1 years")) ?>" data-name="Previous Year - Q2" href="#">Previous Year - Q2</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date("Y", strtotime("-1 years")) . '-01-01' ?>" data-date-start-value="<?php echo '01-Jan-'.date("Y", strtotime("-1 years")) ?>" data-date-end="<?php echo date("Y", strtotime("-1 years")) . '-03-31' ?>" data-date-end-value="<?php echo '31-Mar-'.date("Y", strtotime("-1 years")) ?>" data-name="Previous Year - Q1" href="#">Previous Year - Q1</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date("Y") . '-' . date("m", strtotime("-1 months")) . '-01' ?>" data-date-start-value="<?php echo '01-'.date("M", strtotime("-1 months")) .'-'.date("Y") ?>" data-date-end="<?php echo date('Y-m-t', strtotime('-1 months')) ?>" data-date-end-value="<?php echo date('t-M-Y', strtotime('-1 months')) ?>" data-name="Previous Month" href="#">Previous Month</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" data-name="Previous Week" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y-m-d', strtotime( 'monday last week' )); ?>" data-date-start-value="<?php echo date('d-M-Y', strtotime( 'monday last week' )); ?>" data-date-end="<?php echo date('Y-m-d', strtotime( 'sunday last week' )); ?>" data-date-end-value="<?php echo date('d-M-Y', strtotime( 'sunday last week' )); ?>" data-name="Previous Week" href="#">Previous Week</a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" data-name="FY 2018" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y', strtotime('-2 years')) . '-01-01'; ?>" data-date-start-value="<?php echo '01-Jan-'. date('Y', strtotime('-2 years')); ?>" data-date-end="<?php echo date('Y', strtotime('-2 years')) .'-12-31' ?>" data-date-end-value="<?php echo '31-Dec-'. date('Y', strtotime('-2 years')); ?>" data-name="FY <?php echo date('Y', strtotime('-2 years')); ?>" href="#">FY <?php echo date('Y', strtotime('-2 years')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" data-name="FY 2017" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected"data-date-start="<?php echo date('Y', strtotime('-3 years')) . '-01-01'; ?>" data-date-start-value="<?php echo '01-Jan-'. date('Y', strtotime('-3 years')); ?>" data-date-end="<?php echo date('Y', strtotime('-3 years')) .'-12-31' ?>" data-date-end-value="<?php echo '31-Dec-'. date('Y', strtotime('-3 years')); ?>" data-name="FY <?php echo date('Y', strtotime('-3 years')); ?>" href="#">FY <?php echo date('Y', strtotime('-3 years')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($type != "yearly-closeout") : ?>
                                                <li data-filter-date="item" data-name="FY 2016" role="presentation">
                                                    <a role="menuitem" tabindex="-1" class="selected" data-date-start="<?php echo date('Y', strtotime('-4 years')) . '-01-01'; ?>" data-date-start-value="<?php echo '01-Jan-'. date('Y', strtotime('-4 years')); ?>" data-date-end="<?php echo date('Y', strtotime('-4 years')) .'-12-31' ?>" data-date-end-value="<?php echo '31-Dec-'. date('Y', strtotime('-4 years')); ?>" data-name="FY <?php echo date('Y', strtotime('-4 years')); ?>" href="#">FY <?php echo date('Y', strtotime('-4 years')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <span class="margin-left" data-report="date-interval"><span id='fromCustomDate'><?php echo '01-Jan-' . date("Y") ?></span> to <span id='toCustomDate'><?php echo '31-Dec-' . date("Y") ?></span>
                                    <input type="hidden" id="fromCustomDateInput" value="<?php echo date("Y") .'-01-01' ?>">
                                    <input type="hidden" id="toCustomDateInput" value="<?php echo date("Y") .'-12-31' ?>">
                                    <span class="middot">·</span> <a class="link-modal-open" id="daterange" data-filter="date-range" href="javascript:void(0)">Custom Dates</a>
                                </div>
                                <?php endif;?>
                                <div class="col-sm-4 col-md-4 text-right-md text-left-sm magbottompad">
                                    <a class="margin-right-sec link-modal-open" data-format="csv" data-type="<?php echo str_replace(' ', '_', strtolower(setPageName($type))) ?>" id="downloadCsv" data-report="export-csv" href="javascript:void(0)"><span class="fa fa-download"></span> CSV Export</a>
                                    <a data-report="export-pdf" data-format="pdf" data-type="<?php echo str_replace(' ', '_', strtolower(setPageName($type))) ?>" id="downloadPdf" class="link-modal-open" href="javascript:void(0)"><span class="fa fa-file-pdf-o"></span> Get PDF</a>
                                </div>
                            </div>
                            <?php if($type === "work-order-by-employee") : ?>
                            <hr>
                            <div>
                                <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="type_service">
                                <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span data-filter="selected-item-name">All Types</span> <span class="caret"></span>
                                </div>
                                <ul class="dropdown-menu btn-block" role="menu">
                                    <li data-filter="item" data-value="" role="presentation">
                                        <a role="menuitem" tabindex="-1" href="#">All Types</a>
                                    </li>
                                    <li data-filter="item" data-value="1" role="presentation">
                                        <a role="menuitem" tabindex="-1" href="#">Residential (R)</a>
                                    </li>
                                    <li data-filter="item" data-value="2" role="presentation">
                                        <a role="menuitem" tabindex="-1" href="#">Commercial (C)</a>
                                    </li>
                                </ul>
                                </div>
                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="employee_id">
                                    <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span data-filter="selected-item-name">All Employees</span> <span class="caret"></span>
                                    </div>
                                    <ul class="dropdown-menu btn-block" role="menu">
                                        <li data-filter="item" data-value="" role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">All Employees</a>
                                        </li>
                                        <li data-filter="item" data-value="14278" role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">Alarm Direct</a>
                                        </li>
                                        <li data-filter="item" data-value="14291" role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">Brannon Nguyen</a>
                                        </li>
                                        <li data-filter="item" data-value="14281" role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">TC Nguyen</a>
                                        </li>
                                        <li data-filter="item" data-value="14285" role="presentation">
                                            <a role="menuitem" tabindex="-1" href="#">Tommy Nguyen</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <hr>
                            <?php endif; ?>
                            <div class="validation-error" style="display: none;"></div>
                            <div class="loader" data-report="loader" style="display: none;">loading ...</div>
                            <div id="reportTable" data-report="table">
                                <?php if($type === "monthly-closeout" || $type === "yearly-closeout") : ?>
                                    <table id="tableToListReport" class="table table-hover table-to-list">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Month</th>
                                                <th class="text-right"># of Estimates</th>
                                                <th class="text-right">Estimated</th>
                                                <th class="text-right">Accepted</th>
                                                <th class="text-right"># of Invoices</th>
                                                <th class="text-right">Invoiced</th>
                                                <th class="text-right">Paid</th>
                                                <th class="text-right">Due</th>
                                                <th class="text-right"># of Expenses</th>
                                                <th class="text-right">Total Expense</th>
                                                <?php if($type === "yearly-closeout") : ?>
                                                <th class="text-right">Profit Profit</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                <?php elseif($type === "profit-loss") : ?>
                                <table class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Name</th>
                                            <th class="text-right">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bold">Revenue</td>
                                            <td class="bold text-right"><span id="profitLossRevenue"></span></td>
                                        </tr>
                                        <tr>
                                            <td><span class="margin-left-sec">Invoices Paid</span></td>
                                            <td class="text-right"><span id="profitLossInvoice"></span></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="bold">Expenses</td>
                                            <td class="bold text-right"><span id="profitLossExpenses"></span></td>
                                        </tr>
                                                <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="bold">Net Profit</td>
                                            <td class="bold text-right"><span id="profitLossNetProfit"></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "work-order-by-employee") : ?>
                                <table class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            <th class="text-right"># of Jobs</th>
                                            <th class="text-right">Total</th>
                                            <th class="text-right">Average</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>TC Nguyen</td>
                                            <td class="text-right">105</td>
                                            <td class="text-right">$2,185.46</td>
                                            <td class="text-right">$20.81</td>
                                        </tr>
                                        <tr>
                                            <td>Brannon Nguyen</td>
                                            <td class="text-right">93</td>
                                            <td class="text-right">$2,185.46</td>
                                            <td class="text-right">$23.50</td>
                                        </tr>
                                        <tr>
                                            <td>Alarm Direct</td>
                                            <td class="text-right">36</td>
                                            <td class="text-right">$0.00</td>
                                            <td class="text-right">$0.00</td>
                                        </tr>
                                        <tr>
                                            <td>Tommy Nguyen</td>
                                            <td class="text-right">51</td>
                                            <td class="text-right">$0.00</td>
                                            <td class="text-right">$0.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "payment-by-method") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th class="text-right">Total Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "payment-by-month") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th>Month / Customer</th>
                                            <th>Paid Date</th>
                                            <th>Details</th>
                                            <th>Payment Method</th>
                                            <th class="text-right">Total Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "account-receivable") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th># of Invoices</th>
                                            <th class="text-right">Invoiced</th>
                                            <th class="text-right">Paid</th>
                                            <th class="text-right">Due</th>
                                            <th class="text-right">Tip</th>
                                            <th class="text-right">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "invoice-by-date") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Date</th>
                                            <th class="text-left"># of Invoices</th>
                                            <th class="text-right">Invoiced</th>
                                            <th class="text-right">Paid</th>
                                            <th class="text-right">Due</th>
                                            <th class="text-right">Tip</th>
                                            <th class="text-right">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "estimate-status-by-month") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr style="background-color:#EEEEEE;">
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Estimate #</th>
                                            <th class="text-center">Type</th>
                                            <th class="text-center">Due</th>
                                            <th class="text-center">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                    <!-- <tbody id="reportEstimateBody"> -->
                                        <!-- <?php //foreach($estimates as $est){ ?>
                                        <tr>
                                            <td class="text-center"><?php //echo date('m-d-Y', strtotime($est->estimate_date)); ?></td>
                                            <td class="text-center"><?php //echo $est->estimate_number; ?></td>
                                            <td class="text-center"><?php //echo $est->estimate_type; ?></td>
                                            <td class="text-center"><?php //echo  date('m-d-Y', strtotime($est->expiry_date)); ?></td>
                                            <td class="text-center">$<?php //cho number_format($est->grand_total,2); ?></td>
                                        </tr>
                                        <?php //} ?> -->
                                    </tbody>
                                </table>
                                <?php elseif ($type === "account-receivable-com-vs-res") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="border-right"></th>
                                            <th colspan="6" class="text-center border-right">Commercial</th>
                                            <th colspan="6" class="text-center">Residential</th>
                                        </tr>
                                        <tr>
                                            <th>Month</th>
                                            <th class="border-right"></th>
                                            <th class="text-right">#Inv</th>
                                            <th class="text-right">Invoiced</th>
                                            <th class="text-right">Paid</th>
                                            <th class="text-right">Due</th>
                                            <th class="text-right">Tip</th>
                                            <th class="text-right border-right">Fees</th>
                                            <th class="text-right">#Inv</th>
                                            <th class="text-right">Invoiced</th>
                                            <th class="text-right">Paid</th>
                                            <th class="text-right">Due</th>
                                            <th class="text-right">Tip</th>
                                            <th class="text-right">Fees</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "payment-by-customer") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Customer</th>
                                            <th class="text-left">Type</th>
                                            <th class="text-right">Invoices Paid #</th>
                                            <th class="text-right">Payments #</th>
                                            <th class="text-right">Total Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "expense-by-month-by-customer") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Customer</th>
                                            <!-- <th class="text-left">Type</th> -->
                                            <th class="text-right">Due Date</th>
                                            <th class="text-right">Status</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "expense-by-month-by-category") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Customer</th>
                                            <th class="text-left">Category</th>
                                            <th class="text-right">Due Date</th>
                                            <th class="text-right">Status</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "employee-payroll-summary") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Employee</th>
                                            <th class="text-left">Pay Rate</th>
                                            <th class="text-right">Start Date</th>
                                            <th class="text-right">Rate</th>
                                            <!-- <th class="text-right">Total</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "summary-by-period") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Employee</th>
                                            <th class="text-left">Role</th>
                                            <th class="text-left">Date</th>
                                            <th class="text-right">Clock in</th>
                                            <th class="text-right">Clock out</th>
                                            <th class="text-right">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "timesheet-entries") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Date</th>
                                            <th class="text-left">Employee</th>
                                            <th class="text-right">Clock in</th>
                                            <th class="text-right">Clock out</th>
                                            <th class="text-right">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "employee-payroll-log") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Employee</th>
                                            <th class="text-right">Date</th>
                                            <th class="text-left">Clock in</th>
                                            <th class="text-right">Clock out</th>
                                            <th class="text-right">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "sales-tax") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Name</th>
                                            <th class="text-left">Type</th>
                                            <th class="text-right">Detail type</th>
                                            <th class="text-right">Balance</th>
                                            <th class="text-right">Bank Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "work-order-status") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Work Order #</th>
                                            <th class="text-left">Date Issued</th>
                                            <th class="text-right">Customer</th>
                                            <th class="text-right">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "invoice-items-no-tax") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">No.</th>
                                            <th class="text-left">Type</th>
                                            <th class="text-right">Name</th>
                                            <th class="text-right">Date</th>
                                            <th class="text-right">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "payment-by-item") : ?>
                                <hr>
                                <div>
                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="type_service">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span data-filter="selected-item-name">All Types</span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                                        <li data-filter="item" data-value="" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">All Types</a>
                                            </li>
                                                        <li data-filter="item" data-value="1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Residential (R)</a>
                                            </li>
                                                        <li data-filter="item" data-value="2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Commercial (C)</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-hover table-to-list salesItemsReport" id="tableToListReport">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Item</th>
                                            <th class="text-center">Invoice</th>
                                            <th class="text-center">Date Issued</th>
                                            <th class="text-center">Total Qty</th>
                                            <th class="text-right">Total Sales</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!-- <?php //foreach($invoicesItems as $iInv){ ?>
                                        <tr>
                                            <th class="text-left"><?php //echo $iInv->title ; ?></th>
                                            <th class="text-left"><?php //echo $iInv->invoice_number ; ?></th>
                                            <th class="text-left"><?php //echo $iInv->date_issued ; ?></th>
                                            <th class="text-left"><?php //echo $iInv->qty ; ?></th>
                                            <th class="text-right"><?php //echo $iInv->total ; ?></th>
                                        </tr>
                                        <?php //} ?> -->
                                    </tbody>
                                </table>
                                <?php elseif ($type === "payment-by-customer-group") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th>Customer Group</th>
                                            <th class="text-right">Payments #</th>
                                            <th class="text-right">Total Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "customer-source") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Source</th>
                                            <th class="text-right">Residential #</th>
                                            <th class="text-right">Residential Invoiced</th>
                                            <th class="text-right">Commercial #</th>
                                            <th class="text-right">Commercial Invoiced</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "customer-by-source") : ?>
                                <table id="tableToListReport" class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Source</th>
                                            <th class="text-right">Customer Count (total)</th>
                                            <th class="text-right">Residential Count</th>
                                            <th class="text-right">Commercial Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php elseif ($type === "customer-sales") : ?>
                                <hr>
                                <div>
                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="type_service">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span data-filter="selected-item-name">All Types</span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li data-filter="item" data-value="" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">All Types</a>
                                            </li>
                                            <li data-filter="item" data-value="1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Residential (R)</a>
                                            </li>
                                            <li data-filter="item" data-value="2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Commercial (C)</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dropdown dropdown-inline filter margin-right-sec" data-filter="filter" data-filter-id="status">
                                        <div class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            <span data-filter="selected-item-name">All Statuses</span> <span class="caret"></span>
                                        </div>
                                        <ul class="dropdown-menu btn-block" role="menu">
                                            <li data-filter="item" data-value="" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">All Statuses</a>
                                            </li>
                                            <li data-filter="item" data-value="1" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">New</a>
                                            </li>
                                            <li data-filter="item" data-value="2" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Scheduled</a>
                                            </li>
                                            <li data-filter="item" data-value="8" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Started</a>
                                            </li>
                                            <li data-filter="item" data-value="7" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Paused</a>
                                            </li>
                                            <li data-filter="item" data-value="3" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Completed</a>
                                            </li>
                                            <li data-filter="item" data-value="6" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Invoiced</a>
                                            </li>
                                            <li data-filter="item" data-value="5" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Withdrawn</a>
                                            </li>
                                            <li data-filter="item" data-value="4" role="presentation">
                                                <a role="menuitem" tabindex="-1" href="#">Closed</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <hr>
                                <table class="table table-hover table-to-list">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Type</th>
                                            <th data-order-by="scheduled_date" data-order-how="desc">Service Date <span class="sorter fa fa-caret-down"></span></th>
                                            <th>Service Type</th>
                                            <th>Amount of Service</th>
                                            <th>Invoice #</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                <?php endif; ?>
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
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>

<script>
    $(document).ready(function(){
        $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#fromCustomDateInput').va();
            var max = $('#toCustomDateInput').va();
            var startDate = new Date(data[4]);
            if (min == null && max == null) { return true; }
            if (min == null && startDate <= max) { return true;}
            if(max == null && startDate >= min) {return true;}
            if (startDate <= max && startDate >= min) { return true; }
            return false;
        }
        );

       
            $("#fromCustomDateInput").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            $("#toCustomDateInput").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
            var table = $('#tableToListReport').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#fromCustomDateInput, #toCustomDateInput').change(function () {
                table.draw();
            });
        });
</script>

<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
// $(document).ready(function() {
//     $('.salesItemsReport').DataTable( {
//         "order": [[ 0, "desc" ]]
//     } );
// } );
</script>