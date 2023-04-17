<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .hide-toggle::after {
        display: none !important;
    }

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="filter-activity-date">Time Activity Date</label>
                                        <select class="nsm-field form-select" name="filter_activity_date" id="filter-activity-date">
                                            <option value="all-dates" <?=$filter_date === 'all-dates' ? 'selected' : ''?>>All Dates</option>
                                            <option value="custom" <?=$filter_date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?=$filter_date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="this-week" <?=$filter_date === 'this-week' ? 'selected' : ''?>>This Week</option>
                                            <option value="this-week-to-date" <?=$filter_date === 'this-week-to-date' ? 'selected' : ''?>>This Week-to-date</option>
                                            <option value="this-month" <?=$filter_date === 'this-month' ? 'selected' : ''?>>This Month</option>
                                            <option value="this-month-to-date" <?=empty($filter_date) || $filter_date === 'this-month-to-date' ? 'selected' : ''?>>This Month-to-date</option>
                                            <option value="this-quarter" <?=$filter_date === 'this-quarter' ? 'selected' : ''?>>This Quarter</option>
                                            <option value="this-quarter-to-date" <?=$filter_date === 'this-quarter-to-date' ? 'selected' : ''?>>This Quarter-to-date</option>
                                            <option value="this-year" <?=$filter_date === 'this-year' ? 'selected' : ''?>>This Year</option>
                                            <option value="this-year-to-date" <?=$filter_date === 'this-year-to-date' ? 'selected' : ''?>>This Year-to-date</option>
                                            <option value="this-year-to-last-month" <?=$filter_date === 'this-year-to-last-month' ? 'selected' : ''?>>This Year-to-last-month</option>
                                            <option value="yesterday" <?=$filter_date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                            <option value="recent" <?=$filter_date === 'recent' ? 'selected' : ''?>>Recent</option>
                                            <option value="last-week" <?=$filter_date === 'last-week' ? 'selected' : ''?>>Last Week</option>
                                            <option value="last-week-to-date" <?=$filter_date === 'last-week-to-date' ? 'selected' : ''?>>Last Week-to-date</option>
                                            <option value="last-month" <?=$filter_date === 'last-month' ? 'selected' : ''?>>Last Month</option>
                                            <option value="last-month-to-date" <?=$filter_date === 'last-month-to-date' ? 'selected' : ''?>>Last Month-to-date</option>
                                            <option value="last-quarter" <?=$filter_date === 'last-quarter' ? 'selected' : ''?>>Last Quarter</option>
                                            <option value="last-quarter-to-date" <?=$filter_date === 'last-quarter-to-date' ? 'selected' : ''?>>Last Quarter-to-date</option>
                                            <option value="last-year" <?=$filter_date === 'last-year' ? 'selected' : ''?>>Last Year</option>
                                            <option value="last-year-to-date" <?=$filter_date === 'last-year-to-date' ? 'selected' : ''?>>Last Year-to-date</option>
                                            <option value="since-30-days-ago" <?=$filter_date === 'since-30-days-ago' ? 'selected' : ''?>>Since 30 Days Ago</option>
                                            <option value="since-60-days-ago" <?=$filter_date === 'since-60-days-ago' ? 'selected' : ''?>>Since 60 Days Ago</option>
                                            <option value="since-90-days-ago" <?=$filter_date === 'since-90-days-ago' ? 'selected' : ''?>>Since 90 Days Ago</option>
                                            <option value="since-365-days-ago" <?=$filter_date === 'since-365-days-ago' ? 'selected' : ''?>>Since 365 Days Ago</option>
                                            <option value="next-week" <?=$filter_date === 'next-week' ? 'selected' : ''?>>Next Week</option>
                                            <option value="next-4-weeks" <?=$filter_date === 'next-4-weeks' ? 'selected' : ''?>>Next 4 Weeks</option>
                                            <option value="next-month" <?=$filter_date === 'next-month' ? 'selected' : ''?>>Next Month</option>
                                            <option value="next-quarter" <?=$filter_date === 'next-quarter' ? 'selected' : ''?>>Next Quarter</option>
                                            <option value="next-year" <?=$filter_date === 'next-year' ? 'selected' : ''?>>Next Year</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!empty($filter_date) && $filter_date !== 'all-dates' || empty($filter_date)) : ?>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-activity-date-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$start_date?>" id="filter-activity-date-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-activity-date-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=$end_date?>" id="filter-activity-date-to">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row grid-mb">
                                    <div class="col-12">
                                        <label for="rows-columns"><b>Rows/Columns</b></label>
                                    </div>
                                    <div class="col-12 col-md-4 d-flex align-items-center">
                                        <label for="group-by">Group by</label>
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <select id="group-by" class="form-control nsm-field">
                                            <option value="none" <?=$group_by === 'none' ? 'selected' : ''?>>None</option>
                                            <option value="customer" <?=$group_by === 'customer' ? 'selected' : ''?>>Customer</option>
                                            <option value="employee" <?=empty($group_by) || $group_by === 'employee' ? 'selected' : ''?>>Employee</option>
                                            <option value="product-service" <?=$group_by === 'product-service' ? 'selected' : ''?>>Product/Service</option>
                                            <option value="day" <?=$group_by === 'day' ? 'selected' : ''?>>Day</option>
                                            <option value="week" <?=$group_by === 'week' ? 'selected' : ''?>>Week</option>
                                            <option value="work-week" <?=$group_by === 'work-week' ? 'selected' : ''?>>Work Week</option>
                                            <option value="month" <?=$group_by === 'month' ? 'selected' : ''?>>Month</option>
                                            <option value="quarter" <?=$group_by === 'quarter' ? 'selected' : ''?>>Quarter</option>
                                            <option value="year" <?=$group_by === 'year' ? 'selected' : ''?>>Year</option>
                                        </select>
                                    </div>
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
                                                                        <option value="customer">Customer</option>
                                                                        <option value="employee" selected>Employee</option>
                                                                        <option value="product-service">Product/Service</option>
                                                                        <option value="day">Day</option>
                                                                        <option value="week">Week</option>
                                                                        <option value="work-week">Work Week</option>
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
                                                                            <option value="activity-date">Activity Date</option>
                                                                            <option value="billable">Billable</option>
                                                                            <option value="break">Break</option>
                                                                            <option value="create-date">Create Date</option>
                                                                            <option value="created-by">Created By</option>
                                                                            <option value="customer">Customer</option>
                                                                            <option value="duration">Duration</option>
                                                                            <option value="employee">Employee</option>
                                                                            <option value="end-time">End Time</option>
                                                                            <option value="invoice-date">Invoice Date</option>
                                                                            <option value="last-modified">Last Modified</option>
                                                                            <option value="last-modified-by">Last Modified By</option>
                                                                            <option value="memo-description">Memo/Description</option>
                                                                            <option value="product-service">Product/Service</option>
                                                                            <option value="rates">Rates</option>
                                                                            <option value="start-time">Start Time</option>
                                                                            <option value="taxable">Taxable</option>
                                                                        </select>
                                                                        <p class="m-0">Sort in</p>
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <input type="radio" id="sort-asc" name="sort_order" checked>
                                                                            <label for="sort-asc">Total in ascending order</label>
                                                                        </div>
                                                                        <div class="checkbox checkbox-sec d-block my-2">
                                                                            <input type="radio" id="sort-desc" name="sort_order">
                                                                            <label for="sort-desc">Total in descending order</label>
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
                                                                                    <input type="checkbox" checked="checked" id="col-activity-date">
                                                                                    <label for="col-activity-date">Activity Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified">
                                                                                    <label for="col-last-modified">Last Modified</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-employee">
                                                                                    <label for="col-employee">Employee</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-create-date">
                                                                                    <label for="col-create-date">Create Date</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-last-modified-by">
                                                                                    <label for="col-last-modified-by">Last Modified By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-product-service">
                                                                                    <label for="col-product-service">Product/Service</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-created-by">
                                                                                    <label for="col-created-by">Created By</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-customer">
                                                                                    <label for="col-customer">Customer</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-memo-desc">
                                                                                    <label for="col-memo-desc">Memo/Description</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row hidden-cols" style="display: none">
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-rates">
                                                                                    <label for="col-rates">Rates</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-end-time">
                                                                                    <label for="col-end-time">End Time</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-billable">
                                                                                    <label for="col-billable">Billable</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" checked="checked" id="col-duration">
                                                                                    <label for="col-duration">Duration</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-break">
                                                                                    <label for="col-break">Break</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-invoice-date">
                                                                                    <label for="col-invoice-date">Invoice Date</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-4">
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-start-time">
                                                                                    <label for="col-start-time">Start Time</label>
                                                                                </div>
                                                                                <div class="checkbox checkbox-sec d-block my-2">
                                                                                    <input type="checkbox" id="col-taxable">
                                                                                    <label for="col-taxable">Taxable</label>
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
                                                        <h4><span class="company-name">nSmarTrac</span> <i class="material-icons" style="font-size:16px">edit</i></h4>
                                                        <p>Time Activities by Customer Detail<br> Activity:<?=date("F 1-j, Y")?></p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <table class="table" style="width: 100%;" id="report-table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ACTIVITY DATE</th>
                                                                    <th>CUSTOMER</th>
                                                                    <th>PRODUCT/SERVICE</th>
                                                                    <th>MEMO/DESCRIPTION</th>
                                                                    <th class="text-right">RATES</th>
                                                                    <th class="text-right">DURATION</th>
                                                                    <th>BILLABLE</th>
                                                                    <th class="text-right">AMOUNT</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                                                    <td><i class="fa fa-caret-right"></i> Test Employee</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"><b>1:00</b></td>
                                                                    <td></td>
                                                                    <td class="text-right"><b>$22,544.77</b></td>
                                                                </tr>
                                                                <tr class="clickable collapse-row collapse" id="accordion">
                                                                    <td>&emsp;06/21/2022</td>
                                                                    <td>Test Customer</td>
                                                                    <td>Test Service</td>
                                                                    <td></td>
                                                                    <td class="text-right">22,544.77</td>
                                                                    <td class="text-right">1:00</td>
                                                                    <td>Yes</td>
                                                                    <td class="text-right">22,544.77</td>
                                                                </tr>
                                                                <tr class="clickable collapse-row collapse" id="accordion">
                                                                    <td><b>Total for Test Employee</b></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td class="text-right"></td>
                                                                    <td class="text-right"><b>1:00</b></td>
                                                                    <td></td>
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
                                        <p class="m-0">Activity: <?=date("F 1-j, Y")?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table grid-mb" id="reports-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Activity Date" <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>>ACTIVITY DATE</td>
                                            <td data-name="Create Date" <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>>CREATE DATE</td>
                                            <td data-name="Created By" <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>>CREATED BY</td>
                                            <td data-name="Last Modified" <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED</td>
                                            <td data-name="Last Modified By" <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>>LAST MODIFIED BY</td>
                                            <td data-name="Customer" <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>>CUSTOMER</td>
                                            <td data-name="Employee" <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>>EMPLOYEE</td>
                                            <td data-name="Product/Service" <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>>PRODUCT/SERVICE</td>
                                            <td data-name="Memo/Description" <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>>MEMO/DESCRIPTION</td>
                                            <td data-name="Rates" <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>>RATES</td>
                                            <td data-name="Duration" <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>>DURATION</td>
                                            <td data-name="Start Time" <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>>START TIME</td>
                                            <td data-name="End Time" <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>>END TIME</td>
                                            <td data-name="Break" <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>>BREAK</td>
                                            <td data-name="Taxable" <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>>TAXABLE</td>
                                            <td data-name="Billable" <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>>BILLABLE</td>
                                            <td data-name="Invoice Date" <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>>INVOICE DATE</td>
                                            <td data-name="Amount" <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>>AMOUNT</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($activities) > 0) : ?>
                                        <?php foreach($activities as $index => $activity) : ?>
                                        <?php if($group_by === 'none') : ?>
                                        <tr>
                                            <td <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['activity_date']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($activity['create_date']))?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$activity['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($activity['last_modified']))?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$activity['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$activity['customer']?></td>
                                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$activity['employee']?></td>
                                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$activity['product_service']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$activity['memo_desc']?></td>
                                            <td <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>><?=$activity['rates']?></td>
                                            <td <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$activity['duration']?></td>
                                            <td <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>><?=$activity['start_time']?></td>
                                            <td <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>><?=$activity['end_time']?></td>
                                            <td <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>><?=$activity['break']?></td>
                                            <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$activity['taxable']?></td>
                                            <td <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>><?=$activity['billable']?></td>
                                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$activity['invoice_date']?></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$activity['amount']?></td>
                                        </tr>
                                        <?php else : ?>
                                        <tr data-bs-toggle="collapse" data-bs-target="#accordion-<?=$index?>" class="clickable collapse-row collapsed">
                                            <td colspan="10"><i class="bx bx-fw bx-caret-right"></i> <b><?=$activity['name']?></b></td>
                                            <td><b><?=$activity['duration_total']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$activity['amount_total']?></b></td>
                                        </tr>
                                        <?php foreach($activity['activities'] as $act) : ?>
                                        <tr class="clickable collapse-row collapse" id="accordion-<?=$index?>">
                                            <td <?=isset($columns) && !in_array('Activity Date', $columns) ? 'style="display: none"' : ''?>><?=$act['activity_date']?></td>
                                            <td <?=isset($columns) && !in_array('Create Date', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($act['create_date']))?></td>
                                            <td <?=isset($columns) && !in_array('Created By', $columns) ? 'style="display: none"' : ''?>><?=$act['created_by']?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified', $columns) ? 'style="display: none"' : ''?>><?=date("m/d/Y H:i:s A", strtotime($act['last_modified']))?></td>
                                            <td <?=isset($columns) && !in_array('Last Modified By', $columns) ? 'style="display: none"' : ''?>><?=$act['last_modified_by']?></td>
                                            <td <?=isset($columns) && !in_array('Customer', $columns) ? 'style="display: none"' : ''?>><?=$act['customer']?></td>
                                            <td <?=isset($columns) && !in_array('Employee', $columns) ? 'style="display: none"' : ''?>><?=$act['employee']?></td>
                                            <td <?=isset($columns) && !in_array('Product/Service', $columns) ? 'style="display: none"' : ''?>><?=$act['product_service']?></td>
                                            <td <?=isset($columns) && !in_array('Memo/Description', $columns) ? 'style="display: none"' : ''?>><?=$act['memo_desc']?></td>
                                            <td <?=isset($columns) && !in_array('Rates', $columns) ? 'style="display: none"' : ''?>><?=$act['rates']?></td>
                                            <td <?=isset($columns) && !in_array('Duration', $columns) ? 'style="display: none"' : ''?>><?=$act['duration']?></td>
                                            <td <?=isset($columns) && !in_array('Start Time', $columns) ? 'style="display: none"' : ''?>><?=$act['start_time']?></td>
                                            <td <?=isset($columns) && !in_array('End Time', $columns) ? 'style="display: none"' : ''?>><?=$act['end_time']?></td>
                                            <td <?=isset($columns) && !in_array('Break', $columns) ? 'style="display: none"' : ''?>><?=$act['break']?></td>
                                            <td <?=isset($columns) && !in_array('Taxable', $columns) ? 'style="display: none"' : ''?>><?=$act['taxable']?></td>
                                            <td <?=isset($columns) && !in_array('Billable', $columns) ? 'style="display: none"' : ''?>><?=$act['billable']?></td>
                                            <td <?=isset($columns) && !in_array('Invoice Date', $columns) ? 'style="display: none"' : ''?>><?=$act['invoice_date']?></td>
                                            <td <?=isset($columns) && !in_array('Amount', $columns) ? 'style="display: none"' : ''?>><?=$act['amount']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <tr class="clickable collapse-row collapse group-total" id="accordion-<?=$index?>">
                                            <td colspan="10"><b>Total for <?=$activity['name']?></b></td>
                                            <td><b><?=$activity['duration_total']?></b></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><b><?=$activity['amount_total']?></b></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="19">
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