<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }

    .btn-transparent:hover {
        background: #d4d7dc !important;
        border-color: #6B6C72 !important;
    }

    .btn-transparent {
        color: #6B6C72 !important;
    }

    .btn-transparent:focus {
        border-color: #6B6C72 !important;
    }

    .action-bar ul li a:after {
        width: 0 !important;
    }
    .action-bar ul li a > i {
        font-size: 20px !important;
    }
    .action-bar ul li {
        margin-right: 5px !important;
    }
    .action-bar ul li .dropdown-menu .dropdown-item {
        font-size: 1rem;
        padding-right: 0 !important;
    }
    .action-bar ul li .dropdown-menu .dropdown-item:hover {
        background-color: #f8f9fa;
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
                                    <h3 class="page-title" style="margin: 0 !important">Profit and Loss by Tag Group Report</h3>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/reports" class="text-info"><i class="fa fa-chevron-left"></i> Back to report list</a></h6>
                                </div>
                                <div class="col-sm-6">
                                    <a href="javascript:void(0);" id="add-new-account-button" class="btn btn-success float-right">
                                        Save customization
                                    </a>
                                    <a href="#" class="btn btn-transparent mr-2 float-right" style="padding: 10px 12px !important">
                                        Customize
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="tab1">
                                <div class="row my-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label for="report-period">Report period</label>
                                                    <select name="report_period" id="report-period" class="form-control">
                                                        <option value="all-dates">All Dates</option>
                                                        <option value="custom">Custom</option>
                                                        <option value="today">Today</option>
                                                        <option value="this-week">This Week</option>
                                                        <option value="this-week-to-date">This Week-to-date</option>
                                                        <option value="this-month">This Month</option>
                                                        <option value="this-month-to-date">This Month-to-date</option>
                                                        <option value="this-quarter">This Quarter</option>
                                                        <option value="this-quarter-to-date">This Quarter-to-date</option>
                                                        <option value="this-year">This Year</option>
                                                        <option value="this-year-to-date" selected>This Year-to-date</option>
                                                        <option value="this-year-to-last-month">This Year-to-last-month</option>
                                                        <option value="yesterday">Yesterday</option>
                                                        <option value="recent">Recent</option>
                                                        <option value="last-week">Last Week</option>
                                                        <option value="last-week-to-date">Last Week-to-date</option>
                                                        <option value="last-month">Last Month</option>
                                                        <option value="last-month-to-date">Last Month-to-date</option>
                                                        <option value="last-quarter">Last Quarter</option>
                                                        <option value="last-quarter-to-date">Last Quarter-to-date</option>
                                                        <option value="last-year">Last Year</option>
                                                        <option value="last-year-to-date">Last Year-to-date</option>
                                                        <option value="since-30-days-ago">Since 30 Days Ago</option>
                                                        <option value="since-60-days-ago">Since 60 Days Ago</option>
                                                        <option value="since-90-days-ago">Since 90 Days Ago</option>
                                                        <option value="since-365-days-ago">Since 365 Days Ago</option>
                                                        <option value="next-week">Next Week</option>
                                                        <option value="next-4-weeks">Next 4 Weeks</option>
                                                        <option value="next-month">Next Month</option>
                                                        <option value="next-quarter">Next Quarter</option>
                                                        <option value="next-year">Next Year</option>
                                                    </select>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="start_date" id="start-date" class="date form-control" value="<?=date("01/01/Y")?>">
                                                </div>
                                                <div class="col-1 text-center d-flex align-items-end justify-content-center">
                                                    <span class="h6">to</span>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="end_date" id="end-date" class="date form-control" value="<?=date("m/d/Y")?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-2">
                                                    <label for="display-columns-by">Display columns by</label>
                                                    <select name="display_columns_by" id="display-columns-by" class="form-control">
                                                        <option value="total-only">Total Only</option>
                                                        <option value="days">Days</option>
                                                        <option value="weeks">Weeks</option>
                                                        <option value="months">Months</option>
                                                        <option value="quarters">Quarters</option>
                                                        <option value="years">Years</option>
                                                        <option value="customers">Customers</option>   
                                                        <option value="vendors">Vendors</option>
                                                        <option value="products-services">Products/Services</option>
                                                        <option value="ungrouped-tags" selected>Ungrouped tags</option>
                                                    </select>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Show non-zero or active only</label>
                                                    <div class="dropdown w-100">
                                                        <button class="dropdown-toggle btn btn-transparent hide-toggle w-100" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Active rows/active columns&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                        </button>

                                                        <div class="dropdown-menu p-3 w-100" aria-labelledby="filterDropdown">
                                                            <p class="m-0">Show rows</p>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="radio" checked="checked" id="row-active" name="show_rows">
                                                                <label for="row-active">Active</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="radio" id="row-all" name="show_rows">
                                                                <label for="row-all">All</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="radio" id="row-non-zero" name="show_rows">
                                                                <label for="row-non-zero">Non-zero</label>
                                                            </div>
                                                            <p class="m-0">Show columns</p>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="radio" checked="checked" id="col-active" name="show_cols">
                                                                <label for="col-active">Active</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="radio" id="col-all" name="show_cols">
                                                                <label for="col-all">All</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="radio" id="col-non-zero" name="show_cols">
                                                                <label for="col-non-zero">Non-zero</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <label for="">Compare another period</label>
                                                    <div class="dropdown w-100">
                                                        <button class="dropdown-toggle btn btn-transparent hide-toggle w-100" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Select period&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                                                        </button>

                                                        <div class="dropdown-menu p-3 w-100" aria-labelledby="filterDropdown">
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="previous-period" name="selected_period">
                                                                <label for="previous-period">Previous period (PP)</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="checkbox checkbox-sec my-2">
                                                                        <input type="checkbox" id="previous-period-dollar-change" disabled>
                                                                        <label for="previous-period-dollar-change" class="text-muted">$ change</label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec my-2">
                                                                        <input type="checkbox" id="previous-period-percent-change" disabled>
                                                                        <label for="previous-period-percent-change" class="text-muted">% change</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="previous-year" name="selected_period">
                                                                <label for="previous-year">Previous year (PY)</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="checkbox checkbox-sec my-2">
                                                                        <input type="checkbox" id="previous-year-dollar-change" disabled>
                                                                        <label for="previous-year-dollar-change" class="text-muted">$ change</label>
                                                                    </div>
                                                                    <div class="checkbox checkbox-sec my-2">
                                                                        <input type="checkbox" id="previous-year-percent-change" disabled>
                                                                        <label for="previous-year-percent-change" class="text-muted">% change</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="year-to-date" name="selected_period">
                                                                <label for="year-to-date">Year-to-date (YTD)</label>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="checkbox checkbox-sec my-2">
                                                                        <input type="checkbox" id="ytd-percent" disabled>
                                                                        <label for="ytd-percent" class="text-muted">% of YTD</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="previous-ytd" name="selected_period">
                                                                <label for="previous-ytd">Previous year-to-date (PY YTD)</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="percent-of-row" name="selected_period">
                                                                <label for="percent-of-row">% of Row</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="percent-of-col" name="selected_period">
                                                                <label for="percent-of-col">% of Column</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="percent-of-income" name="selected_period">
                                                                <label for="percent-of-income">% of Income</label>
                                                            </div>
                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                <input type="checkbox" id="percent-of-expense" name="selected_period">
                                                                <label for="percent-of-expense">% of Expense</label>
                                                            </div>
                                                            <p class="m-0"><a href="#" class="text-info">Reorder columns</a></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <label for="">Accounting method</label>
                                                    <div class="checkbox checkbox-sec my-2">
                                                        <input type="radio" class="form-check-input" id="cash-method" name="accounting_method">
                                                        <label class="form-check-label" for="cash-method">Cash</label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec my-2">
                                                        <input type="radio" class="form-check-input" id="accrual-method" name="accounting_method" checked>
                                                        <label class="form-check-label" for="accrual-method">Accrual</label>
                                                    </div>
                                                </div>
                                                <div class="col-2 border-left d-flex align-items-center justify-content-center">
                                                    <button class="btn btn-transparent">Run Report</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="m-auto border" style="width: 60%">
                                            <div class="container-fluid">
                                                <div class="row border-bottom">
                                                    <div class="col-md-6" style="font-size: 10px !important">
                                                        <div class="action-bar h-100 d-flex align-items-center">
                                                            <ul>
                                                                <li><a href="#" class="text-info">Collapse</a></li>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle text-info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Sort <i class="fa fa-caret-down text-info"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-default" name="sort_order" checked>
                                                                                <label for="sort-default">Default</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-asc" name="sort_order">
                                                                                <label for="sort-asc">Total in ascending order</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-desc" name="sort_order">
                                                                                <label for="sort-desc">Total in descending order</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li><a href="#" class="text-info">Add notes</a></li>
                                                                <li><a href="#" class="text-info">Edit titles</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="action-bar h-100 d-flex align-items-center">
                                                            <ul class="ml-auto">
                                                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                                                                <li><a href="#"><i class="fa fa-print"></i></a></li>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                        <a class="dropdown-item" href="#">Export to Excel</a>
                                                                        <a class="dropdown-item" href="#">Export to PDF</a>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-cog"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                        <p class="m-0">Display density</p>
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <input type="checkbox" checked="checked" id="compact-display">
                                                                            <label for="compact-display">Compact</label>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <h4>nSmarTrac <i class="material-icons" style="font-size:16px">edit</i></h4>
                                                        <p>Profit and Loss by Tag Group<br> January 1-<?=date("F d, Y")?></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th class="text-right">TOTAL</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                                                    <td><i class="fa fa-caret-right"></i> INCOME</td>
                                                                    <td style="text-align:right;">$571,265.66</td>
                                                                </tr>
                                                                <tr data-toggle="collapse" data-target="#accordion1" class="clickable collapse-row collapse" id="accordion">
                                                                    <td>&emsp;<i class="fa fa-caret-right"></i> Current Assets</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion2">
                                                                    <td>&emsp;&emsp;<i class="fa fa-caret-right"></i> Bank Accounts</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr id="accordion2" class="collapse">
                                                                    <td>&emsp;&emsp;&emsp;Checking</td>
                                                                    <td style="text-align:right;">305,061.93</td>
                                                                </tr>
                                                                <tr id="accordion2" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion3">
                                                                    <td>&emsp;&emsp;&emsp;<i class="fa fa-caret-right"> Test Bank (Cash on hand)</td>
                                                                    <td style="text-align:right;">990.77</td>
                                                                </tr>
                                                                <tr id="accordion3" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;&emsp; Sub-bank (Cash on hand)</td>
                                                                    <td style="text-align:right;">990.00</td>
                                                                </tr>
                                                                <tr id="accordion3" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;&emsp; <b>Total Test Bank (Cash on hand)</b></td>
                                                                    <td style="text-align:right;"><b>1,980.77</b></td>
                                                                </tr>
                                                                <tr id="accordion2" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Test Category</td>
                                                                    <td style="text-align:right;">10.00</td>
                                                                </tr>
                                                                <tr id="accordion2" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                                                    <td style="text-align:right;"><b>$307,052.70</b></td>
                                                                </tr>
                                                                <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion4">
                                                                    <td>&emsp;&emsp;<i class="fa fa-caret-right"></i> Accounts Receivable</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr id="accordion4" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                                                    <td style="text-align:right;">205,324.93</td>
                                                                </tr>
                                                                <tr id="accordion4" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                                                    <td style="text-align:right;"><b>$205,324.93</b></td>
                                                                </tr>
                                                                <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion5">
                                                                    <td>&emsp;&emsp;<i class="fa fa-caret-right"></i> Other Current Assets</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                                                    <td style="text-align:right;">207.95</td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Inventory</td>
                                                                    <td style="text-align:right;">25.00</td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                                                    <td style="text-align:right;">25,705.75</td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Test OCA</td>
                                                                    <td style="text-align:right;">1,000.00</td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                                                    <td style="text-align:right;">9,068.80</td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                                                    <td style="text-align:right;">16,347.82</td>
                                                                </tr>
                                                                <tr id="accordion5" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                                                    <td style="text-align:right;"><b>$52,355.32</b></td>
                                                                </tr>
                                                                <tr id="accordion1" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                                                    <td style="text-align:right;"><b>$564,732.95</b></td>
                                                                </tr>
                                                                <tr data-toggle="collapse" data-target="#accordion1" class="clickable collapse-row collapse" id="accordion6">
                                                                    <td>&emsp;<i class="fa fa-caret-right"></i> Fixed Assets</td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr id="accordion6" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;Accumulated Depreciation</td>
                                                                    <td style="text-align:right;">-26,176.00</td>
                                                                </tr>
                                                                <tr id="accordion6" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;Fixed Asset Computers</td>
                                                                    <td style="text-align:right;">6,069.00</td>
                                                                </tr>
                                                                <tr id="accordion6" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                                                    <td style="text-align:right;">25,289.00</td>
                                                                </tr>
                                                                <tr id="accordion6" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;Fixed Asset Phone</td>
                                                                    <td style="text-align:right;">1,200.00</td>
                                                                </tr>
                                                                <tr id="accordion6" class="collapse clickable collapse-row">
                                                                    <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                                                    <td style="text-align:right;"><b>$6,382.00</b></td>
                                                                </tr>
                                                                <tr  class="clickable collapse-row collapse"  id="accordion">
                                                                    <td>&emsp;<b>TOTAL INCOME</b></td>
                                                                    <td style="text-align:right;"><b>$571,114.95</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>GROSS PROFIT</td>
                                                                    <td style="text-align:right;">$571,114.95</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="fa fa-caret-right"></i> NET INCOME</td>
                                                                    <td style="text-align:right;">$571,265.66</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <p>Accrual basis <?=date("l, F j, Y h:i A eP")?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of container fluid -->
                                        </div>
                                    </div>
                                </div>
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