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
    .report-container .action-bar li a {
        font-size: 14px !important;
    }
    .report-container .action-bar li a i {
        font-size: unset !important;
    }
    .report-container #report-table {
        font-size: 12px !important;
    }
    .report-container .report-footer {
        font-size: 10px;
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
                                    <h3 class="page-title" style="margin: 0 !important">Journal Report</h3>
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
                                    <div class="col-md-9">
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
                                                        <option value="this-month-to-date" selected>This Month-to-date</option>
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
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="end_date" id="end-date" class="date form-control" value="<?=date("m/01/Y")?>">
                                                </div>
                                                <div class="col-1 text-center d-flex align-items-end justify-content-center">
                                                    <span class="h6">to</span>
                                                </div>
                                                <div class="col-2 d-flex align-items-end">
                                                    <input type="text" name="end_date" id="end-date" class="date form-control" value="<?=date("m/d/Y")?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row report-container">
                                    <div class="col">
                                        <div class="m-auto border" style="width: 60%">
                                            <div class="container-fluid">
                                                <div class="row border-bottom">
                                                    <div class="col-md-6" style="font-size: 10px !important">
                                                        <div class="action-bar h-100 d-flex align-items-center">
                                                            <ul>
                                                                <li>
                                                                    <a class="hide-toggle dropdown-toggle text-info" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        Sort <i class="fa fa-caret-down text-info"></i>
                                                                    </a>
                                                                    <div class="dropdown-menu p-3" aria-labelledby="dropdownMenuLink">
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <p class="m-0">Sort by</p>
                                                                            <select name="sort_by" id="sort-by" class="form-control">
                                                                                <option value="default" selected>Default</option>
                                                                                <option value="account">Account</option>
                                                                                <option value="adj">Adj</option>
                                                                                <option value="check-printed">Check Printed</option>
                                                                                <option value="created">Created</option>
                                                                                <option value="created-by">Created By</option>
                                                                                <option value="date">Date</option>
                                                                                <option value="last-modified">Last Modified</option>
                                                                                <option value="last-modified-by">Last Modified By</option>
                                                                                <option value="name">Name</option>
                                                                                <option value="num">Num</option>
                                                                                <option value="transaction-type">Transaction Type</option>
                                                                            </select>
                                                                            <p class="m-0">Sort in</p>
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-asc" name="sort_order">
                                                                                <label for="sort-asc">Ascending order</label>
                                                                            </div>
                                                                            <div class="checkbox checkbox-sec d-block my-2">
                                                                                <input type="radio" id="sort-desc" name="sort_order">
                                                                                <label for="sort-desc">Descending order</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
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
                                                                                    <input type="checkbox" id="col-created-by">
                                                                                    <label for="col-created-by">Created By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified">
                                                                                    <label for="col-last-modified">Last Modified</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-transaction-type">
                                                                                    <label for="col-transaction-type">Transaction Type</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified-by">
                                                                                    <label for="col-last-modified-by">Last Modified By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-open-balance">
                                                                                    <label for="col-open-balance">Open Balance</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-num">
                                                                                    <label for="col-num">Num</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-due-date">
                                                                                    <label for="col-due-date">Due Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-payment-date">
                                                                                    <label for="col-payment-date">Payment Date</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row hidden-cols" style="display: none">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-method">
                                                                                    <label for="col-method">Method</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-created-by">
                                                                                    <label for="col-created-by">Created By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-name">
                                                                                    <label for="col-name">Name</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-employee">
                                                                                    <label for="col-employee">Employee</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-qty">
                                                                                    <label for="col-qty">Qty</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-ar-paid">
                                                                                    <label for="col-ar-paid">A/R Paid</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-check-printed">
                                                                                    <label for="col-check-printed">Check Printed</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-online-banking">
                                                                                    <label for="col-online-banking">Online Banking</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-adj">
                                                                                    <label for="col-adj">Adj</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified">
                                                                                    <label for="col-last-modified">Last Modified</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-customer">
                                                                                    <label for="col-customer">Customer</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-product-service">
                                                                                    <label for="col-product-service">Product/Service</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-rate">
                                                                                    <label for="col-rate">Rate</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-ap-paid">
                                                                                    <label for="col-ap-paid">A/P Paid</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-debit">
                                                                                    <label for="col-debit">Debit</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-created">
                                                                                    <label for="col-created">Created</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified-by">
                                                                                    <label for="col-last-modified-by">Last Modified By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-vendor">
                                                                                    <label for="col-vendor">Vendor</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-memo-desc">
                                                                                    <label for="col-memo-desc">Memo/Description</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-account">
                                                                                    <label for="col-account">Account</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-clr">
                                                                                    <label for="col-clr">Clr</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-debit">
                                                                                    <label for="col-debit">Debit</label>
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
                                                        <h4><span class="company-name">nSmarTrac</span> <i class="material-icons" style="font-size:16px">edit</i></h4>
                                                        <p>Journal<br> <?=date("F 1-j, Y")?></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table" style="width: 100%;" id="report-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>DATE</th>
                                                                    <th>TRANSACTION TYPE</th>
                                                                    <th>NUM</th>
                                                                    <th>NAME</th>
                                                                    <th>MEMO/DESCRIPTION</th>
                                                                    <th>ACCOUNT</th>
                                                                    <th class="text-right">DEBIT</th>
                                                                    <th class="text-right">CREDIT</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>06/15/2022</td>
                                                                    <td>Invoice</td>
                                                                    <td>123</td>
                                                                    <td>Test Customer</td>
                                                                    <td></td>
                                                                    <td>Test Account</td>
                                                                    <td class="text-right">22,544.77</td>
                                                                    <td class="text-right"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>Sample Account</td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right">22,544.77</td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="row report-footer">
                                                    <div class="col-12 text-center">
                                                        <p><?=date("l, F j, Y h:i A eP")?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end of container fluid -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row <?=!isset($header_alignment) ? 'text-center' : 'text-'.$header_alignment?>">
                                    <?php if(isset($show_logo)) : ?>
                                    <!-- <div class="position-absolute">
                                        <img src="<?= getCompanyBusinessProfileImage(); ?>"  style="max-width: 150px"/>
                                    </div> -->
                                    <?php endif; ?>
                                    <?php if(!isset($show_company_name)) : ?>
                                    <div class="col-12 grid-mb">
                                        <h4 class="fw-bold"><span class="company-name"><?=$company_name?></span></h4>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_title)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0 fw-bold"><?=$report_title?></p>
                                    </div>
                                    <?php endif; ?>
                                    <?php if(!isset($show_report_period)) : ?>
                                    <div class="col-12 grid-mb">
                                        <p class="m-0"><?=$report_period?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                            <td data-name="Transaction Type" <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>>TRANSACTION TYPE</td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Due Date" <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>>DUE DATE</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                            <td data-name="Payment Date" <?=isset($columns) && !in_array('Payment Date', $columns) ? 'style="display: none"' : ''?>>PAYMENT DATE</td>
                                            <td data-name="Method" <?=isset($columns) && !in_array('Method', $columns) ? 'style="display: none"' : ''?>>METHOD</td>
                                            <td data-name="Adj" <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>>ADJ</td>
                                            <td data-name="Created" <?=isset($columns) && !in_array('Created', $columns) ? 'style="display: none"' : ''?>>CREATED</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Name" <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>>NAME</td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                            <td data-name="A/R Paid" <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>>A/R PAID</td>
                                            <td data-name="A/P Paid" <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>>A/P PAID</td>
                                            <td data-name="Clr" <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>>CLR</td>
                                            <td data-name="Check Printed" <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>>CHECK PRINTED</td>
                                            <td data-name="Debit" <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>>DEBIT</td>
                                            <td data-name="Credit" <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>>CREDIT</td>
                                            <td data-name="Online Banking" <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>>ONLINE BANKING</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($transactions) > 0) : ?>
                                        <?php foreach($transactions as $transaction) : ?>
                                        <tr>
                                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['date']?></td>
                                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>><?=$transaction['transaction_type']?></td>
                                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$transaction['num']?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['due_date']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$transaction['open_balance']?></td>
                                            <td <?=isset($columns) && !in_array('Payment Date', $columns) ? 'style="display: none"' : ''?>><?=$transaction['payment_date']?></td>
                                            <td <?=isset($columns) && !in_array('Method', $columns) ? 'style="display: none"' : ''?>><?=$transaction['method']?></td>
                                            <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>><?=$transaction['adj']?></td>
                                            <td <?=isset($columns) && !in_array('Created', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created']?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$transaction['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>><?=$transaction['name']?></td>
                                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$transaction['customer']?></td>
                                            <td <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$transaction['vendor']?></td>
                                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$transaction['employee']?></td>
                                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$transaction['product_service']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$transaction['memo_description']?></td>
                                            <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$transaction['qty']?></td>
                                            <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$transaction['rate']?></td>
                                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$transaction['account']?></td>
                                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ar_paid']?></td>
                                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$transaction['ap_paid']?></td>
                                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>><?=$transaction['clr']?></td>
                                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>><?=$transaction['check_printed']?></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['debit']?></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$transaction['credit']?></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>><?=$transaction['online_banking']?></td>
                                        </tr>
                                        <?php if(isset($transaction['sub_rows']) && count($transaction['sub_rows']) > 0) : ?>
                                        <?php foreach($transaction['sub_rows'] as $subRow) : ?>
                                        <tr>
                                            <td <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Transaction Type', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Due Date', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Payment Date', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Method', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Adj', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Created', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$subRow['customer']?></td>
                                            <td <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$subRow['vendor']?></td>
                                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$subRow['employee']?></td>
                                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$subRow['product_service']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$subRow['qty']?></td>
                                            <td <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$subRow['rate']?></td>
                                            <td <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$subRow['account']?></td>
                                            <td <?=isset($columns) && !in_array('A/R Paid', $columns) ? 'style="display: none"' : ''?>><?=$subRow['ar_paid']?></td>
                                            <td <?=isset($columns) && !in_array('A/P Paid', $columns) ? 'style="display: none"' : ''?>><?=$subRow['ap_paid']?></td>
                                            <td <?=isset($columns) && !in_array('Clr', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Check Printed', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td <?=isset($columns) && !in_array('Debit', $columns) ? 'style="display: none"' : ''?>><?=$subRow['debit']?></td>
                                            <td <?=isset($columns) && !in_array('Credit', $columns) ? 'style="display: none"' : ''?>><?=$subRow['credit']?></td>
                                            <td <?=isset($columns) && !in_array('Online Banking', $columns) ? 'style="display: none"' : ''?>></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="31">
                                                <div class="nsm-empty">
                                                    <span>No results found.</span>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <div class="row">
                                    <div class="col-12 d-none" id="report-note-form">
                                        <textarea name="report_note" id="report-note" maxlength="4000" class="nsm-field form-control mb-3" placeholder="Add notes or include additional info with your report"><?=!is_null($reportNote) ? str_replace("<br />", "", $reportNote->notes) : ''?></textarea>
                                        <label for="report-note">4000 characters max</label>
                                        <button class="nsm-button primary float-end" id="save-note">Save</button>
                                        <button class="nsm-button float-end" id="cancel-note-update">Cancel</button>
                                    </div>
                                    <div class="col-12 <?=is_null($reportNote) ? 'd-none' : ''?>" id="report-note-cont">
                                        <?php if(!is_null($reportNote)) : ?>
                                        <?=str_replace("\n", "<br />", $reportNote->notes)?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-footer <?=!isset($footer_alignment) ? 'text-center' : 'text-'.$footer_alignment?>">
                                <p class="m-0"><?=date($prepared_timestamp)?></p>
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