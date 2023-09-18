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
                                    <h3 class="page-title" style="margin: 0 !important">Open Purchase Orders Detail Report</h3>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h6><a href="/accounting/reports" class="text-info"><i class="fa fa-chevron-left"></i> Back to report list</a></h6>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#settings-modal">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: 20%">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label for="custom-report-name">Custom report name</label>
                                        <input type="text" name="custom_report_name" id="custom-report-name" class="nsm-field form-control" value="Open Purchase Order Detail">
                                    </div>
                                    <div class="col-12">
                                        <label for="custom-report-group">Add this report to a group</label>
                                        <select name="custom_report_group" id="custom-report-group" class="nsm-field form-control"></select>
                                        <a href="#" class="text-decoration-none" id="add-new-custom-report-group">Add new group</a>
                                    </div>
                                    <div class="col-12 d-none">
                                        <form id="new-custom-report-group">
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="custom-group-name">New group name</label>
                                                    <input type="text" class="nsm-field form-control" name="new_custom_group_name" id="custom-group-name">
                                                </div>
                                                <div class="col-4 d-flex align-items-end">
                                                    <button type="submit" class="nsm-button success">Add</button>
                                                    <button class="nsm-button" id="cancel-new-custom-report-group">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12">
                                        <label for="share-with">Share with</label>
                                        <select name="share_with" id="share-with" class="nsm-field form-control">
                                            <option value="all">All</option>
                                            <option value="none" selected>None</option>
                                        </select>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary" id="save-custom-report">
                                            Save
                                        </button>
                                    </div>
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
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="row-columns">Rows/columns</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-row">
                                                                <div class="col-4 d-flex align-items-center">
                                                                    <label>Group by</label>
                                                                </div>
                                                                <div class="col">
                                                                    <select id="row-columns" class="form-control">
                                                                        <option value="none">None</option>
                                                                        <option value="account">Account</option>
                                                                        <option value="vendor">Vendor</option>
                                                                        <option value="product-service" selected>Product/Service</option>
                                                                        <option value="day">Day</option>
                                                                        <option value="week">Week</option>
                                                                        <option value="month">Month</option>
                                                                        <option value="quarter">Quarter</option>
                                                                        <option value="year">Year</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2 border-left d-flex align-items-center justify-content-center">
                                                    <button class="btn btn-transparent">Run Report</button>
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
                                                                        <p class="m-0">Sort by</p>
                                                                        <select name="sort_by" id="sort-by" class="form-control">
                                                                            <option value="default" selected>Default</option>
                                                                            <option value="account">Account</option>
                                                                            <option value="client-message">Client/Vendor Message</option>
                                                                            <option value="create-date">Create Date</option>
                                                                            <option value="created-by">Created By</option>
                                                                            <option value="customer">Customer</option>
                                                                            <option value="date">Date</option>
                                                                            <option value="last-modified">Last Modified</option>
                                                                            <option value="last-modified-by">Last Modified By</option>
                                                                            <option value="memo-description">Memo/Description</option>
                                                                            <option value="num">Num</option>
                                                                            <option value="product-service">Product/Service</option>
                                                                            <option value="qty">Qty</option>
                                                                            <option value="rate">Rate</option>
                                                                            <option value="sku">SKU</option>
                                                                            <option value="tax-amount">Tax Amount</option>
                                                                            <option value="tax-name">Tax Name</option>
                                                                            <option value="taxable-amount">Taxable Amount</option>
                                                                            <option value="vendor">Vendor</option>
                                                                        </select>
                                                                        <p class="m-0">Sort in</p>
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <input type="radio" id="sort-asc" name="sort_order" checked>
                                                                            <label for="sort-asc">Ascending order</label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <input type="radio" id="sort-desc" name="sort_order">
                                                                            <label for="sort-desc">Descending order</label>
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
                                                                                    <input type="checkbox" checked="checked" id="col-vendor">
                                                                                    <label for="col-vendor">Vendor</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-create-date">
                                                                                    <label for="col-create-date">Create Date</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-num">
                                                                                    <label for="col-num">Num</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-product-service">
                                                                                    <label for="col-product-service">Product/Service</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-created-by">
                                                                                    <label for="col-created-by">Created By</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-customer">
                                                                                    <label for="col-customer">Customer</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-sku">
                                                                                    <label for="col-sku">SKU</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified">
                                                                                    <label for="col-last-modified">Last Modified</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row hidden-cols" style="display: none">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified-by">
                                                                                    <label for="col-last-modified-by">Last Modified By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-memo-desc">
                                                                                    <label for="col-memo-desc">Memo/Description</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-received-qty">
                                                                                    <label for="col-received-qty">Received Qty</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-tax-name">
                                                                                    <label for="col-tax-name">Tax Name</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-received-amount">
                                                                                    <label for="col-received-amount">Received Amt</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-account">
                                                                                    <label for="col-account">Account</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-rate">
                                                                                    <label for="col-rate">Rate</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-backordered-qty">
                                                                                    <label for="col-backordered-qty">Backordered Qty</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-tax-amount">
                                                                                    <label for="col-tax-amount">Tax Amount</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-open-balance">
                                                                                    <label for="col-open-balance">Open Balance</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-client-message">
                                                                                    <label for="col-client-message">Client/Vendor Message</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-qty">
                                                                                    <label for="col-qty">Qty</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-total-amount">
                                                                                    <label for="col-total-amount">Total Amt</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-taxable-amount">
                                                                                    <label for="col-taxable-amount">Taxable Amount</label>
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
                                                        <p>Open Purchase Orders Detail<br> <?=date("F 1-j, Y")?></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table" style="width: 100%;" id="report-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>DATE</th>
                                                                    <th>NUM</th>
                                                                    <th>VENDOR</th>
                                                                    <th>PRODUCT/SERVICE</th>
                                                                    <th>ACCOUNT</th>
                                                                    <th>QTY</th>
                                                                    <th>RECEIVED QTY</th>
                                                                    <th>BACKORDERED QTY</th>
                                                                    <th class="text-right">TOTAL AMT</th>
                                                                    <th class="text-right">RECEIVED AMT</th>
                                                                    <th class="text-right">OPEN BALANCE</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                                                    <td><i class="fa fa-caret-right"></i> Test Inventory</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                    <td class="text-right"><b>$0.00</b></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                </tr>
                                                                <tr class="clickable collapse-row collapse" id="accordion">
                                                                    <td>&emsp;06/15/2022</td>
                                                                    <td>123</td>
                                                                    <td>Test Vendor</td>
                                                                    <td></td>
                                                                    <td>Test Account</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right">22,544.77</td>
                                                                    <td class="text-right">0.00</td>
                                                                    <td class="text-right">22,544.77</td>
                                                                </tr>
                                                                <tr class="clickable collapse-row collapse" id="accordion">
                                                                    <td><b>Total for Test Inventory</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                    <td class="text-right"><b>$0.00</b></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>TOTAL</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                    <td class="text-right"><b>$0.00</b></td>
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
                                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                            <td data-name=""></td>
                                            <?php endif; ?>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>>DATE</td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>>NUM</td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>>VENDOR</td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                            <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>>SKU</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>>ACCOUNT</td>
                                            <td data-name="Client/Vendor Message" <?=isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''?>>CLIENT/VENDOR MESSAGE</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>>RATE</td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>>QTY</td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>>RECEIVED QTY</td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>>BACKORDERED QTY</td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>>TOTAL AMT</td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>>TAX NAME</td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>>TAX AMOUNT</td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>>TAXABLE AMOUNT</td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>>RECEIVED AMT</td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>>OPEN BALANCE</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($purchaseOrders) > 0) : ?>
                                        <?php foreach($purchaseOrders as $index => $purchaseOrder) : ?>
                                        <?php if($group_by === 'none') : ?>
                                        <tr>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['date']?></td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['num']?></td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['customer']?></td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['vendor']?></td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['product_service']?></td>
                                            <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['sku']?></td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['create_date']?></td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['created_by']?></td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified']?></td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['last_modified_by']?></td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['account']?></td>
                                            <td data-name="Client/Vendor Message" <?=isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['client_vendor_message']?></td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['memo_description']?></td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['rate']?></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['qty']?></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['received_qty']?></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['backordered_qty']?></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['total_amt']?></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['tax_name']?></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['tax_amount']?></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['taxable_amount']?></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['received_amt']?></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$purchaseOrder['open_balance']?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td colspan="<?=isset($columns) ? $total_index : '14'?>"><i class="bx bx-fw bx-caret-right"></i> <b><?=$purchaseOrder['name']?></b></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['qty_total']?></b></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_qty_total']?></b></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['backordered_qty_total']?></b></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['total_amt_total']?></b></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_amt_total']?></b></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                                        </tr>
                                        <?php foreach($purchaseOrder['purchase_orders'] as $po) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <?php if(isset($columns) && $total_index === 0 && $group_by !== 'none') : ?>
                                            <td data-name=""></td>
                                            <?php endif; ?>
                                            <td data-name="Date" <?=isset($columns) && !in_array('Date', $columns) ? 'style="display: none"' : ''?>><?=$po['date']?></td>
                                            <td data-name="Num" <?=isset($columns) && !in_array('Num', $columns) ? 'style="display: none"' : ''?>><?=$po['num']?></td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$po['customer']?></td>
                                            <td data-name="Vendor" <?=isset($columns) && !in_array('Vendor', $columns) ? 'style="display: none"' : ''?>><?=$po['vendor']?></td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$po['product_service']?></td>
                                            <td data-name="SKU" <?=isset($columns) && !in_array('SKU', $columns) ? 'style="display: none"' : ''?>><?=$po['sku']?></td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=$po['create_date']?></td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$po['created_by']?></td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified']?></td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$po['last_modified_by']?></td>
                                            <td data-name="Account" <?=isset($columns) && !in_array('Account', $columns) ? 'style="display: none"' : ''?>><?=$po['account']?></td>
                                            <td data-name="Client/Vendor Message" <?=isset($columns) && !in_array('Client/Vendor Message', $columns) ? 'style="display: none"' : ''?>><?=$po['client_vendor_message']?></td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$po['memo_description']?></td>
                                            <td data-name="Rate" <?=isset($columns) && !in_array('Rate', $columns) ? 'style="display: none"' : ''?>><?=$po['rate']?></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><?=$po['qty']?></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><?=$po['received_qty']?></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><?=$po['backordered_qty']?></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><?=$po['total_amt']?></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>><?=$po['tax_name']?></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>><?=$po['tax_amount']?></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>><?=$po['taxable_amount']?></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><?=$po['received_amt']?></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><?=$po['open_balance']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                            <td colspan="<?=isset($columns) ? $total_index : '14'?>"><b>Total for <?=$purchaseOrder['name']?></b></td>
                                            <td data-name="Qty" <?=isset($columns) && !in_array('Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['qty_total']?></b></td>
                                            <td data-name="Received Qty" <?=isset($columns) && !in_array('Received Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_qty_total']?></b></td>
                                            <td data-name="Backordered Qty" <?=isset($columns) && !in_array('Backordered Qty', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['backordered_qty_total']?></b></td>
                                            <td data-name="Total Amt" <?=isset($columns) && !in_array('Total Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['total_amt_total']?></b></td>
                                            <td data-name="Tax Name" <?=isset($columns) && !in_array('Tax Name', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Tax Amount" <?=isset($columns) && !in_array('Tax Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Taxable Amount" <?=isset($columns) && !in_array('Taxable Amount', $columns) ? 'style="display: none"' : ''?>></td>
                                            <td data-name="Received Amt" <?=isset($columns) && !in_array('Received Amt', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['received_amt_total']?></b></td>
                                            <td data-name="Open Balance" <?=isset($columns) && !in_array('Open Balance', $columns) ? 'style="display: none"' : ''?>><b><?=$purchaseOrder['open_balance_total']?></b></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="23">
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
                                        <?php if(!is_null($reportNote) && !empty($reportNote->notes)) : ?>
                                        <p class="m-0"><b>Note</b></p>
                                        <span><?=str_replace("\n", "<br />", $reportNote->notes)?></span>
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