<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<?php include viewPath('includes/header');?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="wrapper" role="wrapper">
    <div wrapper__section style="padding-left:1.4%;">
        <div class="container-fluid accountReceivable">
            <div class="accountReceivable__header">
                <div class="accountReceivable__title">
                    A/R Aging Summary Report
                </div>
                <div>
                    <a href="" class="accountReceivable__back">
                        <i class="fa fa-chevron-left"></i>
                        Back to report list
                    </a>
                </div>

                <form class="accountReceivable__form">
                    <div class="accountReceivable__formInner">
                        <div>
                            <div class="accountReceivable__formGroup accountReceivable__reportPeriod">
                                <div class="accountReceivable__reportPeriodBody">
                                    <div>
                                        <div
                                            class="accountReceivable__formTitle popover-dismiss"
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
                                    <div class="accountReceivable__reportPeriodAsOf">as of</div>
                                    <div class="form-group">
                                        <input type="date" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="accountReceivable__formGroup">
                                <div class="accountReceivable__nonZeroActiveOnly">
                                    <div>
                                        <div
                                            class="accountReceivable__formTitle popover-dismiss"
                                            tabindex="0"
                                            data-toggle="popover"
                                            data-trigger="hover"
                                            title="Declutter your report"
                                            data-content="Choose Active to hide empty rows or columns. Choose Non-zero to also hide ones where the total is zero. Find out more."
                                        >Show non-zero or active only</div>
                                        <div class="form-group">
                                            <div class="customDropdown">
                                                <button class="customDropdown__btn" type="button" data-type="show_non_zero_or_active_only">
                                                    <span>Active rows/active columns</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <div class="customDropdown__options">
                                                    <div class="customDropdown__group">
                                                        <div class="customDropdown__title">Show rows</div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyRows" id="nonZeroActiveOnlyRows1" value="active_rows" checked>
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
                                                            <input class="form-check-input" type="radio" name="nonZeroActiveOnlyColumns" id="nonZeroActiveOnlyColumns1" value="active_columns" checked>
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
                                    <div class="form-group accountReceivable__agingMethod">
                                        <div class="accountReceivable__formTitle">Aging method</div>
                                        <div class="accountReceivable__agingMethodInner">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="agingMethod" id="agingMethodCurrent" value="current" checked>
                                                <label class="form-check-label" for="agingMethodCurrent">Current</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="agingMethod" id="agingMethodReportDate" value="report_date">
                                                <label class="form-check-label" for="agingMethodReportDate">Report Date</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group inputErrorWrapper">
                                        <label for="daysPerAgingPeriod">Days per aging period</label>
                                        <input type="number" class="form-control" data-type="days_per_aging_period" min="1" max="500" required>
                                        <span class="inputError__message">Please enter a number between 1 to 500</span>
                                    </div>
                                    <div class="form-group inputErrorWrapper">
                                        <label for="numberOfPeriods">Number of periods</label>
                                        <input type="number" class="form-control" data-type="number_of_periods" min="1" max="50" required>
                                        <span class="inputError__message">Please enter a number between 1 to 50</span>
                                    </div>

                                    <div class="accountReceivable__agingMethodBtn">
                                        <button type="button" class="btn btn-ghost" id="runReport">Run report</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <button type="button" class="btn btn-ghost">Customize</button>
                            <button type="button" class="btn btn-primary">Save customization</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="accountReceivableTable">
                <div class="accountReceivableTable__topBar">
                    <div class="accountReceivableTable__actions">
                        <button class="accountReceivableTable__btn">
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
                        <button class="accountReceivableTable__btn">
                            Add notes
                        </button>
                    </div>
                    <div class="accountReceivableTable__actions">
                        <button class="accountReceivableTable__btn" data-toggle="modal" data-target="#emailReportModal">
                            <i class="material-icons">email</i>
                        </button>
                        <button data-action="print" class="accountReceivableTable__btn">
                            <i class="material-icons">local_printshop</i>
                        </button>
                        <div class="customDropdown">
                            <button class="customDropdown__btn accountReceivableTable__btn">
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
                            <button class="customDropdown__btn accountReceivableTable__btn">
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

                <div class="accountReceivableTable__header">
                    <div class="accountReceivableTable__headerInner">
                        <div>
                            <span class="accountReceivableTable__companyName" data-type="title">---</span>
                            <button class="accountReceivableTable__btn accountReceivableTable__btn--header" data-action="edit_header">
                                <i class="material-icons">edit</i>
                            </button>
                        </div>
                        <div class="accountReceivableTable__tableName" data-type="subtitle">--</div>
                        <div>As of <?php echo date('F d, Y'); ?></div>
                    </div>

                    <div class="accountReceivableTable__headerInnerEdit">
                        <div>
                            <input type="text" class="accountReceivableTable__companyName" data-type="title-input" />
                        </div>
                        <input type="text" class="accountReceivableTable__tableName" data-type="subtitle-input" />
                        <div>As of <?php echo date('F d, Y'); ?></div>
                    </div>
                </div>

                <table class="table table-hover reportsTable" id="reportsTable">
                    <thead class="reportsTable__header">
                        <tr>
                            <th></th>
                            <th>CURRENT</th>
                            <th>1 - 30</th>
                            <th>31 - 60</th>
                            <th>61 - 90</th>
                            <th>91 AND OVER</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                </table>

                <div class="accountReceivableTable__footer">
                    <?php echo date('l, F d, Y h:i A e'); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="emailReportModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Email Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="emailReportTo">To</label>
                            <input type="email" class="form-control" id="emailReportTo" data-type="to">
                        </div>
                        <div class="form-group">
                            <label for="emailReportSubject">Subject</label>
                            <input type="text" class="form-control" id="emailReportSubject" data-type="subject">
                        </div>
                        <div class="form-group">
                            <label for="emailReportBody">Body</label>
                            <textarea class="form-control" id="emailReportBody" rows="3" data-type="body"></textarea>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="form-group w-100">
                                <label for="emailReportReport">Report</label>
                                <input type="text" class="form-control" id="emailReportReport" data-type="file_name">
                            </div>
                            <div>.pdf</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary arBtn">
                        <div class="spinner-border spinner-border-sm m-0 mr-1" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        Send
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
