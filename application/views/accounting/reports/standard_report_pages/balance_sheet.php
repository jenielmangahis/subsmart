<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="wrapper" role="wrapper">
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid balanceSheet">
            <div class="balanceSheet__header">
                <div class="balanceSheet__title">
                    Balance Sheet Report
                </div>
                <div>
                    <a href="" class="balanceSheet__back">
                        <i class="fa fa-chevron-left"></i>
                        Back to report list
                    </a>
                </div>

                <form class="balanceSheet__form">
                    <div class="balanceSheet__formInner">
                        <div>
                            <div class="balanceSheet__formGroup balanceSheet__reportPeriod">
                                <div class="balanceSheet__reportPeriodBody reportPeriodParent">
                                    <div>
                                        <div
                                            class="balanceSheet__formTitle popover-dismiss"
                                            tabindex="0"
                                            data-toggle="popover"
                                            data-trigger="hover"
                                            title="See a snapshot in time"
                                            data-content="Choose a time period to see where things stood at the end of it."
                                        >Report period</div>
                                        <div class="form-group">
                                            <select class="form-control" data-type="report_period">
                                                <option value="all_dates">All Dates</option>
                                                <option value="custom">Custom</option>
                                                <option value="today">Today</option>
                                                <option value="this_week">This Week</option>
                                                <option value="this_week_to_date">This Week-to-date</option>
                                                <option value="this_month">This Month</option>
                                                <option value="this_month_to_date">This Month-to-date</option>
                                                <option value="this_quarter">This Quarter</option>
                                                <option value="this_quarter_to_date">This Quarter-to-date</option>
                                                <option value="this_year">This Year</option>
                                                <option value="this_year_to_date">This Year-to-date</option>
                                                <option value="this_year_to_last_month">This Year-to-last-month</option>
                                                <option value="yesterday">Yesterday</option>
                                                <option value="recent">Recent</option>
                                                <option value="last_week">Last Week</option>
                                                <option value="last_week_to_date">Last Week-to-date</option>
                                                <option value="last_month">Last Month</option>
                                                <option value="last_month_to_date">Last Month-to-date</option>
                                                <option value="last_quarter">Last Quarter</option>
                                                <option value="last_quarter_to_date">Last Quarter-to-date</option>
                                                <option value="last_year">Last Year</option>
                                                <option value="last_year_to_date">Last Year-to-date</option>
                                                <option value="since_30_days_ago">Since 30 Days Ago</option>
                                                <option value="since_60_days_ago">Since 60 Days Ago</option>
                                                <option value="since_90_days_ago">Since 90 Days Ago</option>
                                                <option value="since_365_days_ago">Since 365 Days Ago</option>
                                                <option value="next_week">Next Week</option>
                                                <option value="next_4_week">Next 4 Weeks</option>
                                                <option value="next_month">Next Month</option>
                                                <option value="next_quarter">Next Quarter</option>
                                                <option value="next_year">Next Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group reportPeriodParent__hide">
                                        <input type="date" class="form-control" data-type="report_period_value">
                                    </div>
                                    <div class="balanceSheet__reportPeriodAsOf reportPeriodParent__hide">to</div>
                                    <div class="form-group reportPeriodParent__hide">
                                        <input type="date" class="form-control" data-type="report_period_value">
                                    </div>
                                </div>
                            </div>

                            <div class="balanceSheet__formGroup">
                                <div class="balanceSheet__form2">
                                    <div>
                                        <div
                                            class="balanceSheet__formTitle popover-dismiss"
                                            tabindex="0"
                                            data-toggle="popover"
                                            data-trigger="hover"
                                            title="Slice and dice your data"
                                            data-content="See separate columns for day, week, customer, and more."
                                        >Display columns by</div>
                                        <div class="form-group">
                                            <select class="form-control" data-type="report_period">
                                                    <option value="total_only">Total Only</option>
                                                    <option value="days">Days</option>
                                                    <option value="weeks">Weeks</option>
                                                    <option value="months">Months</option>
                                                    <option value="quarters">Quarters</option>
                                                    <option value="years">Years</option>
                                                    <option value="customers">Customers</option>
                                                    <option value="vendors">Vendors</option>
                                                    <option value="products_or_services">Products/Services</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="balanceSheet__formTitle popover-dismiss" tabindex="0" data-toggle="popover" data-trigger="hover" title="" data-content="Choose Active to hide empty rows or columns. Choose Non-zero to also hide ones where the total is zero. Find out more." data-original-title="Declutter your report">Show non-zero or active only</div>
                                        <div class="form-group">
                                            <div class="customDropdown">
                                                <button class="customDropdown__btn" type="button" data-type="show_nonzero_or_active_only" value="active_rows/active_columns">Active rows/Active columns</button>
                                                <div class="customDropdown__options">
                                                    <div class="customDropdown__group">
                                                        <div class="customDropdown__title">Show rows</div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="nonZeroActiveOnlyRows1" value="active_rows" checked="">
                                                            <label class="form-check-label" for="nonZeroActiveOnlyRows1">
                                                                Active
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="nonZeroActiveOnlyRows2" value="all_rows">
                                                            <label class="form-check-label" for="nonZeroActiveOnlyRows2">
                                                                All
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="nonZeroActiveOnlyRows3" value="non-zero_rows">
                                                            <label class="form-check-label" for="nonZeroActiveOnlyRows3">
                                                                Non-zero
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="customDropdown__group">
                                                        <div class="customDropdown__title">Show columns</div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="nonZeroActiveOnlyColumns1" value="active_columns" checked="">
                                                            <label class="form-check-label" for="nonZeroActiveOnlyColumns1">
                                                                Active
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="nonZeroActiveOnlyColumns2" value="all_columns">
                                                            <label class="form-check-label" for="nonZeroActiveOnlyColumns2">
                                                                All
                                                            </label>
                                                        </div>
                                                        <div class="form-check disabled">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="nonZeroActiveOnlyColumns3" value="non-zero_columns">
                                                            <label class="form-check-label" for="nonZeroActiveOnlyColumns3">
                                                                Non-zero
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="balanceSheet__formTitle popover-dismiss" tabindex="0" data-toggle="popover" data-trigger="hover" title="" data-content="See what changed from one period to the next. Find out more." data-original-title="Compare time periods side by side">
                                            Compare another period
                                        </div>
                                        <div class="form-group">
                                            <div class="customDropdown">
                                                <button class="customDropdown__btn" type="button" data-type="show_nonzero_or_active_only" value="active_rows/active_columns">Active rows/Active columns</button>
                                                <div class="customDropdown__options">
                                                    <div class="customDropdown__group mb-1">
                                                        <div class="form-check mb-1">
                                                            <input class="form-check-input" type="checkbox" value="" id="cap_pp">
                                                            <label class="form-check-label" for="cap_pp">
                                                                Previous period (PP)
                                                            </label>
                                                        </div>
                                                        <div class="pl-3 d-flex justify-content-between">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cap_pp_change_dollar">
                                                                <label class="form-check-label" for="cap_pp_change_dollar">
                                                                    $ change
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cap_pp_change_percent">
                                                                <label class="form-check-label" for="cap_pp_change_percent">
                                                                    % change
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="customDropdown__group mb-1">
                                                        <div class="form-check mb-1">
                                                            <input class="form-check-input" type="checkbox" value="" id="cap_py">
                                                            <label class="form-check-label" for="cap_py">
                                                                Previous year (PY)
                                                            </label>
                                                        </div>
                                                        <div class="pl-3 d-flex justify-content-between">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cap_py_change_dollar">
                                                                <label class="form-check-label" for="cap_py_change_dollar">
                                                                    $ change
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="cap_py_change_percent">
                                                                <label class="form-check-label" for="cap_py_change_percent">
                                                                    % change
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="customDropdown__group mb-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="cap_row">
                                                            <label class="form-check-label" for="cap_row">
                                                                % of row
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="customDropdown__group mb-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="cap_column">
                                                            <label class="form-check-label" for="cap_column">
                                                                % of column
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <a href="#" class="balanceSheet__back mb-0">Reorder columns</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="balanceSheet__formTitle popover-dismiss"
                                            tabindex="0"
                                            data-toggle="popover"
                                            data-trigger="hover"
                                            title="Cash or accrual?"
                                            data-content="Choose Cash to include only money you’ve paid or received. Choose Accrual to include open invoices and bills too. Find out more"
                                        >
                                            Accounting method
                                        </div>
                                        <div class="form-group balanceSheet__accountingMethod">
                                            <div class="balanceSheet__accountingMethodInner">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="aging_method" id="accountingMethodCurrent" value="current" data-type="aging_method_current" checked="">
                                                    <label class="form-check-label" for="accountingMethodCurrent">Cash</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="aging_method" id="accountingMethodReportDate" value="report_date" data-type="aging_method_report_date">
                                                    <label class="form-check-label" for="accountingMethodReportDate">Accrual</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="balanceSheet__accountingMethodBtn">
                                        <button type="button" class="btn btn-ghost buttonSubmit" id="runReport">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                            Run report
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-ghost" data-action="customize_toggle">Customize</button>
                            <button type="button" class="btn btn-primary" data-action="save_customization">Save customization</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="balanceSheetTable">
                <div class="balanceSheetTable__topBar">
                    <div class="balanceSheetTable__actions">
                        <button class="balanceSheetTable__btn">
                            Collapse
                        </button>
                        <div class="customDropdown sortTable">
                            <button class="customDropdown__btn">
                                Sort <i class="fa fa-angle-down"></i>
                            </button>
                            <div class="customDropdown__options">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sortTable" id="sortTable1" value="default" checked>
                                    <label class="form-check-label" for="sortTable1">
                                        Default
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sortTable" id="sortTable2" value="total_ascending">
                                    <label class="form-check-label" for="sortTable2">
                                        Total in ascending order
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sortTable" id="sortTable3" value="total_descending">
                                    <label class="form-check-label" for="sortTable3">
                                        Total in descending order
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button class="balanceSheetTable__btn">
                            Add notes
                        </button>
                        <button class="balanceSheetTable__btn" data-action="editTitle">
                            Edit titles
                        </button>
                    </div>
                    <div class="balanceSheetTable__actions">
                        <button class="balanceSheetTable__btn" data-toggle="modal" data-target="#emailReportModal">
                            <i class="material-icons">email</i>
                        </button>
                        <button data-action="print" class="balanceSheetTable__btn">
                            <i class="material-icons">local_printshop</i>
                        </button>
                        <div class="customDropdown">
                            <button class="customDropdown__btn balanceSheetTable__btn">
                                <i class="material-icons">cloud_upload</i>
                            </button>
                            <div class="customDropdown__options">
                                <div class="customDropdown__optionItem">
                                    <a data-action="export_excel" href="#">Export to Excel</a>
                                </div>
                                <div class="customDropdown__optionItem">
                                    <a data-action="export_pdf" href="#">Export to PDF</a>
                                </div>
                            </div>
                        </div>

                        <div class="customDropdown">
                            <button class="customDropdown__btn balanceSheetTable__btn">
                                <i class="material-icons">settings</i>
                            </button>
                            <div class="customDropdown__options">
                                <div class="customDropdown__group">
                                    <div class="customDropdown__title">Display density</div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tableCompact">
                                        <label class="form-check-label" for="tableCompact">
                                            Compact
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="balanceSheetTable__header">
                    <div class="balanceSheetTable__headerInner">
                        <div class="d-flex">
                            <span class="balanceSheetTable__companyName" data-type="title">---</span>
                            <button class="balanceSheetTable__btn balanceSheetTable__btn--header" data-action="edit_header">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <div class="balanceSheetTable__tableName" data-type="subtitle">--</div>
                        <div data-type="header_report_period" style="display: none;"></div>
                    </div>

                    <div class="balanceSheetTable__headerInnerEdit">
                        <div>
                            <input type="text" class="balanceSheetTable__companyName" data-type="title-input" />
                        </div>
                        <input type="text" class="balanceSheetTable__tableName" data-type="subtitle-input" />
                    </div>
                </div>

                <table class="table table-hover reportsTable" id="reportsTable"></table>
                <div class="balanceSheetTable__footer">
                    <?php echo date('l, F d, Y h:i A e'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="customizeReportWrapper">
        <div class="customizeReport">
            <div class="customizeReport__body">
                <div class="customizeReport__header">
                    <div class="customizeReport__title">Customize report</div>
                    <button class="customizeReport__close" data-action="customize_hide">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div data-type-group="general">
                    <button class="customizeReport__toggle" type="button" data-toggle="collapse" data-target="#customizeGeneral" aria-expanded="false" aria-controls="customizeGeneral">
                        <i class="fa fa-caret-right"></i>
                        General
                    </button>
                    <div class="customizeReport__panel collapse" id="customizeGeneral">
                        <div class="customizeReport__reportPeriod reportPeriodParent">
                            <label class="title">Report period</label>
                            <div>
                                <div class="form-group" style="margin-bottom: 1rem !important;">
                                    <select class="form-control" data-type="report_period">
                                        <option value="all_dates">All Dates</option>
                                        <option value="custom">Custom</option>
                                        <option value="today">Today</option>
                                        <option value="this_week">This Week</option>
                                        <option value="this_week_to_date">This Week-to-date</option>
                                        <option value="this_month">This Month</option>
                                        <option value="this_month_to_date">This Month-to-date</option>
                                        <option value="this_quarter">This Quarter</option>
                                        <option value="this_quarter_to_date">This Quarter-to-date</option>
                                        <option value="this_year">This Year</option>
                                        <option value="this_year_to_date">This Year-to-date</option>
                                        <option value="this_year_to_last_month">This Year-to-last-month</option>
                                        <option value="yesterday">Yesterday</option>
                                        <option value="recent">Recent</option>
                                        <option value="last_week">Last Week</option>
                                        <option value="last_week_to_date">Last Week-to-date</option>
                                        <option value="last_month">Last Month</option>
                                        <option value="last_month_to_date">Last Month-to-date</option>
                                        <option value="last_quarter">Last Quarter</option>
                                        <option value="last_quarter_to_date">Last Quarter-to-date</option>
                                        <option value="last_year">Last Year</option>
                                        <option value="last_year_to_date">Last Year-to-date</option>
                                        <option value="since_30_days_ago">Since 30 Days Ago</option>
                                        <option value="since_60_days_ago">Since 60 Days Ago</option>
                                        <option value="since_90_days_ago">Since 90 Days Ago</option>
                                        <option value="since_365_days_ago">Since 365 Days Ago</option>
                                        <option value="next_week">Next Week</option>
                                        <option value="next_4_week">Next 4 Weeks</option>
                                        <option value="next_month">Next Month</option>
                                        <option value="next_quarter">Next Quarter</option>
                                        <option value="next_year">Next Year</option>
                                    </select>
                                </div>
                                <div class="customizeReport__reportPeriodInner">
                                    <div class="form-group reportPeriodParent__hide">
                                        <input type="date" class="form-control" data-type="report_period_value">
                                    </div>
                                    <div class="reportPeriodParent__hide">to</div>
                                    <div class="form-group reportPeriodParent__hide">
                                        <input type="date" class="form-control" data-type="report_period_value">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div><label class="title">Aging method</label></div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aging_method" id="customizeAgingMethod1" value="cash" data-type="cash">
                                <label class="form-check-label" for="customizeAgingMethod1">Cash</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="aging_method" id="customizeAgingMethod2" value="accrual" data-type="accrual">
                                <label class="form-check-label" for="customizeAgingMethod2">Accural</label>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="customizeReport__numberFormat">
                                <label class="title">Number format</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="numberFormat1" value="divide_by_1000" data-type="divide_by_1000">
                                    <label class="form-check-label" for="numberFormat1">Divide by 1000</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="numberFormat2" value="without_cents" data-type="without_cents">
                                    <label class="form-check-label" for="numberFormat2">Without cents</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="numberFormat3" value="except_zero_amount" data-type="except_zero_amount">
                                    <label class="form-check-label" for="numberFormat3">Except zero amount</label>
                                </div>
                            </div>
                            <div class="customizeReport__negativeNumbers">
                                <label class="title">Negative numbers</label>
                                <div class="form-group mb-2">
                                    <select class="form-control" data-type="negative_numbers">
                                        <option value="-100">-100</option>
                                        <option value="100">(100)</option>
                                        <option value="100-">100-</option>
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="negativeNumbers" value="show_in_red" data-type="negative_numbers_show_in_red">
                                    <label class="form-check-label" for="negativeNumbers">Show in red</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-type-group="row_columns">
                    <button class="customizeReport__toggle" type="button" data-toggle="collapse" data-target="#customizeRowCols" aria-expanded="false" aria-controls="customizeRowCols">
                        <i class="fa fa-caret-right"></i>
                        Rows/columns
                    </button>
                    <div class="customizeReport__panel collapse" id="customizeRowCols">
                        <div class="customizeRowCols__grid">
                            <div class="form-group">
                                <label class="title">Columns</label>
                                <select class="form-control" data-type="report_period">
                                    <option value="total_only">Total Only</option>
                                    <option value="days">Days</option>
                                    <option value="weeks">Weeks</option>
                                    <option value="months">Months</option>
                                    <option value="quarters">Quarters</option>
                                    <option value="years">Years</option>
                                    <option value="customers">Customers</option>
                                    <option value="vendors">Vendors</option>
                                    <option value="products_or_services">Products/Services</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="title">Show non-zero or active only</label>
                                <div class="customDropdown">
                                    <button class="customDropdown__btn" type="button" data-type="show_nonzero_or_active_only" value="active_rows/active_columns">
                                        <span>Active rows/active columns</span>
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <div class="customDropdown__options">
                                        <div class="customDropdown__group">
                                            <div class="customDropdown__title">Show rows</div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="customizeNonZeroActiveOnlyRows1" value="active_rows" checked>
                                                <label class="form-check-label" for="customizeNonZeroActiveOnlyRows1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="customizeNonZeroActiveOnlyRows2" value="all_rows">
                                                <label class="form-check-label" for="customizeNonZeroActiveOnlyRows2">
                                                    All
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="customizeNonZeroActiveOnlyRows3" value="non-zero_rows">
                                                <label class="form-check-label" for="customizeNonZeroActiveOnlyRows3">
                                                    Non-zero
                                                </label>
                                            </div>
                                        </div>
                                        <div class="customDropdown__group">
                                            <div class="customDropdown__title">Show columns</div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="customizeNonZeroActiveOnlyColumns1" value="active_columns" checked>
                                                <label class="form-check-label" for="customizeNonZeroActiveOnlyColumns1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="customizeNonZeroActiveOnlyColumns2" value="all_columns">
                                                <label class="form-check-label" for="customizeNonZeroActiveOnlyColumns2">
                                                    All
                                                </label>
                                            </div>
                                            <div class="form-check disabled">
                                                <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="customizeNonZeroActiveOnlyColumns3" value="non-zero_columns">
                                                <label class="form-check-label" for="customizeNonZeroActiveOnlyColumns3">
                                                    Non-zero
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div data-type-group="filter">
                    <button class="customizeReport__toggle" type="button" data-toggle="collapse" data-target="#customizeFilter" aria-expanded="false" aria-controls="customizeFilter">
                        <i class="fa fa-caret-right"></i>
                        Filter
                    </button>
                    <div class="customizeReport__panel collapse" id="customizeFilter">
                        <div class="customizeReport__customizeFilterInner mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="customizeFilterCustomer" data-type="filter_customer">
                                <label class="form-check-label" for="customizeFilterCustomer">Customer</label>
                            </div>
                            <select class="form-control" data-type="filter_customer_selected">
                                <option>Customer 1</option>
                                <option>Customer 2</option>
                                <option>Customer 3</option>
                            </select>
                        </div>
                        <div class="customizeReport__customizeFilterInner mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="customizeFilterVendor" data-type="filter_vender">
                                <label class="form-check-label" for="customizeFilterVendor">Vendor</label>
                            </div>
                            <select class="form-control" data-type="filter_vendor_selected">
                                <option>Vendor 1</option>
                                <option>Vendor 2</option>
                                <option>Vendor 3</option>
                            </select>
                        </div>
                        <div class="customizeReport__customizeFilterInner mb-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="customizeFilterProductService" data-type="filter_customer">
                                <label class="form-check-label" for="customizeFilterProductService">Product/Service</label>
                            </div>
                            <select class="form-control" data-type="filter_customer_selected">
                                <option>Product/Service 1</option>
                                <option>Product/Service 2</option>
                                <option>Product/Service 3</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div data-type-group="header_footer">
                    <button class="customizeReport__toggle" type="button" data-toggle="collapse" data-target="#customizeHeaderFooter" aria-expanded="false" aria-controls="customizeHeaderFooter">
                        <i class="fa fa-caret-right"></i>
                        Header/Footer
                    </button>
                    <div class="customizeReport__panel collapse" id="customizeHeaderFooter">
                        <div class="mb-3">
                            <div><label class="title">Header</label></div>
                            <div class="form-check customizeReport__headerFooterItem">
                                <input type="checkbox" class="form-check-input" id="customizeShowLogo" data-type="show_logo">
                                <label class="form-check-label" for="customizeShowLogo">Show logo</label>
                            </div>
                            <div class="customizeReport__headerFooterGrid customizeReport__headerFooterItem">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="customizeCompanyName" data-type="company_name">
                                    <label class="form-check-label" for="customizeCompanyName">Company name</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" data-type="company_name_value">
                                </div>
                            </div>
                            <div class="customizeReport__headerFooterGrid customizeReport__headerFooterItem">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="customizeReportTitle" data-type="report_title">
                                    <label class="form-check-label" for="customizeReportTitle">Report title</label>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" data-type="report_title_value">
                                </div>
                            </div>
                            <div class="form-check customizeReport__headerFooterItem">
                                <input type="checkbox" class="form-check-input" id="customizeReportPeriod" data-type="header_report_period">
                                <label class="form-check-label" for="customizeReportPeriod">Report period</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div><label class="title">Footer</label></div>
                            <div class="form-check customizeReport__headerFooterItem">
                                <input type="checkbox" class="form-check-input" id="customizeDatePrepared" data-type="date_prepared">
                                <label class="form-check-label" for="customizeDatePrepared">Date prepared</label>
                            </div>
                            <div class="form-check customizeReport__headerFooterItem">
                                <input type="checkbox" class="form-check-input" id="customizeTimePrepared" data-type="time_prepared">
                                <label class="form-check-label" for="customizeTimePrepared">Time prepared</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div><label class="title">Alignment</label></div>
                            <div class="form-group customizeReport__headerFooterAlignment">
                                <label for="customizeAlignmentHeader">Header</label>
                                <select class="form-control" id="customizeAlignmentHeader" data-type="header">
                                    <option value="left">Left</option>
                                    <option value="center">Center</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                            <div class="form-group customizeReport__headerFooterAlignment">
                                <label for="customizeAlignmentFooter">Footer</label>
                                <select class="form-control" id="customizeAlignmentFooter" data-type="footer">
                                    <option value="left">Left</option>
                                    <option value="center">Center</option>
                                    <option value="right">Right</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="customizeReport__footer">
                <button type="button" class="btn btn-primary buttonSubmit" id="customizeRunReport">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Run report
                </button>
            </div>
        </div>
        <div class="customizeReport__backdrop"></div>
    </div>

    <div id="saveCustomizationForm" class="d-none">
        <form>
            <div class="form-group">
                <label for="reportname">Custom report name</label>
                <input class="form-control" id="reportname" data-type="name">
            </div>
            <div class="form-group">
                <label for="reportgroup">Add this report to a group</label>
                <select class="form-control" id="reportgroup" data-type="group">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <a href="" class="d-none">Add new group</a>
            </div>
            <div class="form-group">
                <label for="reportsharewith">Share with</label>
                <select class="form-control" id="reportsharewith" data-type="share_with">
                    <option value="all">All</option>
                    <option value="none">None</option>
                </select>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="reportsharewithcommunity" data-type="share_with_community">
                <label class="form-check-label" for="reportsharewithcommunity">Share reports with community</label>
            </div>
            <small>* You share only your customized report structure and not your financial data.</small>
            <div class="d-flex justify-content-end pt-1 pb-1">
                <button type="button" class="btn btn-primary buttonSubmit" style="max-height:37px;display: flex;align-items: center;padding: 0 16px;" data-action="submit_customization">
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Save
                </button>
            </div>
        </form>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="editTitleModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit section titles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height:500px;overflow-x:auto;">
                <p>Replaces the default titles used in all balance sheet reports for this company.</p>

                <?php
                    $inputs = [
                        'Assets', 
                        'Current assets', 
                        'Bank accounts', 
                        'Accounts receivable', 
                        'Other current assets', 
                        'Fixed assets', 
                        'Other assets', 
                        'Liabilities and equity', 
                        'Liabilities', 
                        'Current liabilities', 
                        'Accounts payable', 
                        'Credit cards', 
                        'Other current liabilities', 
                        'Long term liabilities', 
                        'Equity', 
                        'Retained earnings', 
                        'Net income'
                    ];
                ?>

                <form>
                    <?php foreach ($inputs as $key => $input): ?>
                        <div class="form-group row align-items-center">
                            <label for="modalInput<?=$key;?>" class="col-6 col-form-label"><?=$input;?></label>
                            <div class="col-6">
                                <input type="text" class="form-control" id="modalInput<?=$key;?>" placeholder="<?=$input;?>">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
            </div>
        </div>
    </div>

	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>

<?php include viewPath('includes/footer_accounting');?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>