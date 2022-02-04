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

	<?php include viewPath('includes/sidebars/accounting/accounting');?>
</div>

<?php include viewPath('includes/footer_accounting');?>

<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});
</script>