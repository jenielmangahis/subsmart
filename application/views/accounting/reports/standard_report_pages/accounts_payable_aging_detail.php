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
    .action-bar ul li .dropdown-menu a:not(.dropdown-item):hover {
       background-color: revert;
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
                                    <h3 class="page-title" style="margin: 0 !important">A/R Aging Detail Report</h3>
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
                                                        <option value="today" selected>Today</option>
                                                        <option value="this-week">This Week</option>
                                                        <option value="this-week-to-date">This Week-to-date</option>
                                                        <option value="this-month">This Month</option>
                                                        <option value="this-month-to-date">This Month-to-date</option>
                                                        <option value="this-quarter">This Quarter</option>
                                                        <option value="this-quarter-to-date">This Quarter-to-date</option>
                                                        <option value="this-year">This Year</option>
                                                        <option value="this-year-to-date">This Year-to-date</option>
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
                                                <div class="col-1 text-center d-flex align-items-end justify-content-center">
                                                    <span class="h6">as of</span>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="end_date" id="end-date" class="date form-control" value="<?=date("m/d/Y")?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <label for="" class="w-100">Aging method</label>
                                                    <div class="checkbox checkbox-sec my-2">
                                                        <input type="radio" class="form-check-input" id="current-method" name="aging_method">
                                                        <label class="form-check-label" for="current-method">Current</label>
                                                    </div>
                                                    <div class="checkbox checkbox-sec my-2">
                                                        <input type="radio" class="form-check-input" id="report-date-method" name="aging_method" checked>
                                                        <label class="form-check-label" for="report-date-method">Report date</label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <label for="days-per-aging-period">Days per aging period</label>
                                                    <input type="number" id="days-per-aging-period" class="form-control" value="30">
                                                </div>
                                                <div class="col-2">
                                                    <label for="number-of-periods">Number of periods</label>
                                                    <input type="number" id="number-of-periods" class="form-control" value="4">
                                                </div>
                                                <div class="col-2">
                                                    <label for="min-days-past-due">Min. Days Past Due</label>
                                                    <input type="number" id="min-days-past-due" class="form-control">
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
                                                                <li><a href="#" class="text-info">Add notes</a></li>
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
                                                                        <p class="m-0">Change columns</p>
                                                                        <div class="row">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-date">
                                                                                    <label for="col-date">Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-create-date">
                                                                                    <label for="col-create-date">Create Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-mod-by">
                                                                                    <label for="col-last-mod-by">Last Modified By</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-trans-type">
                                                                                    <label for="col-trans-type">Transaction Type</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-created-by">
                                                                                    <label for="col-created-by">Created By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-vendor">
                                                                                    <label for="col-vendor">Vendor</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-num">
                                                                                    <label for="col-num">Num</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified">
                                                                                    <label for="col-last-modified">Last Modified</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-phone">
                                                                                    <label for="col-phone">Phone</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row hidden-cols" style="display: none">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-phone-numbers">
                                                                                    <label for="col-phone-numbers">Phone Numbers</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-address">
                                                                                    <label for="col-address">Address</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-past-due">
                                                                                    <label for="col-past-due">Past Due</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-open-balance">
                                                                                    <label for="col-open-balance">Open Balance</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-email">
                                                                                    <label for="col-email">Email</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-company-name">
                                                                                    <label for="col-company-name">Company Name</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-terms">
                                                                                    <label for="col-terms">Terms</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-memo-desc">
                                                                                    <label for="col-memo-desc">Memo/Description</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-full-name">
                                                                                    <label for="col-full-name">Full Name</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-due-date">
                                                                                    <label for="col-due-date">Due Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-amount">
                                                                                    <label for="col-amount">Amount</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <p class="m-0"><a href="#" class="text-info" id="show-cols"><i class="fa fa-caret-down text-info"></i> Show More</a></p>
                                                                        <p class="m-0"><a href="#" class="text-info">Reorder columns</a></p>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <h4>nSmarTrac <i class="material-icons" style="font-size:16px">edit</i></h4>
                                                        <p>A/P Aging Detail<br> As of <?=date("F d, Y")?></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table" style="width: 100%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>DATE</th>
                                                                    <th>TRANSACTION TYPE</th>
                                                                    <th>NUM</th>
                                                                    <th>Vendor</th>
                                                                    <th>DUE DATE</th>
                                                                    <th class="text-right">PAST DUE</th>
                                                                    <th class="text-right">AMOUNT</th>
                                                                    <th class="text-right">OPEN BALANCE</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                                                    <td><i class="fa fa-caret-right"></i> 1-30 days past due</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right;"></td>
                                                                    <td style="text-align:right;"><b>$571,265.66</b></td>
                                                                    <td style="text-align:right;"><b>$571,265.66</b></td>
                                                                </tr>
                                                                <tr  class="clickable collapse-row collapse"  id="accordion">
                                                                    <td>06/22/2022</td>
                                                                    <td>Bill</td>
                                                                    <td>123</td>
                                                                    <td>Test Vendor</td>
                                                                    <td>06/30/2022</td>
                                                                    <td style="text-align:right;">17</td>
                                                                    <td style="text-align:right;">$571,265.66</td>
                                                                    <td style="text-align:right;">$571,265.66</td>
                                                                </tr>
                                                                <tr  class="clickable collapse-row collapse"  id="accordion">
                                                                    <td>&emsp;<b>Total for 1-30 days past due</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right;"></td>
                                                                    <td style="text-align:right;"><b>$571,265.66</b></td>
                                                                    <td style="text-align:right;"><b>$571,265.66</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>TOTAL</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right;"></td>
                                                                    <td style="text-align:right;"><b>$571,265.66</b></td>
                                                                    <td style="text-align:right;"><b>$571,265.66</b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12 text-center">
                                                        <p><?=date("l, F j, Y h:i A eP")?></p>
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