<?php include viewPath('v2/includes/accounting_header'); ?>

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
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-report-period">Report period</label>
                                        <select class="nsm-field form-select" name="filter_report_period" id="filter-report-period">
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
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("01/01/Y")?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-display-columns-by">Display columns by</label>
                                        <select class="nsm-field form-select" name="filter_display_columns_by" id="filter-display-columns-by">
                                            <option value="total-only">Total Only</option>
                                            <option value="days">Days</option>
                                            <option value="weeks">Weeks</option>
                                            <option value="months">Months</option>
                                            <option value="quarters">Quarters</option>
                                            <option value="years">Years</option>
                                            <option value="customers" selected>Customers</option>   
                                            <option value="vendors">Vendors</option>
                                            <option value="products-services">Products/Services</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-display-columns-by">Show non-zero or active only</label>
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle nsm-button w-100 m-0" data-bs-toggle="dropdown" style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;">
                                                <span>
                                                    Active rows/active columns
                                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-100">
                                                <p class="m-0">Show rows</p>
                                                <div class="form-check">
                                                    <input type="radio" checked id="active-rows" name="show_rows" class="form-check-input">
                                                    <label for="active-rows" class="form-check-label">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="all-rows" name="show_rows" class="form-check-input">
                                                    <label for="all-rows" class="form-check-label">All</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="non-zero-rows" name="show_rows" class="form-check-input">
                                                    <label for="non-zero-rows" class="form-check-label">Non-zero</label>
                                                </div>
                                                <p class="m-0">Show columns</p>
                                                <div class="form-check">
                                                    <input type="radio" checked id="active-columns" name="show_cols" class="form-check-input">
                                                    <label for="active-columns" class="form-check-label">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="all-columns" name="show_cols" class="form-check-input">
                                                    <label for="all-columns" class="form-check-label">All</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="non-zero-columns" name="show_cols" class="form-check-input">
                                                    <label for="non-zero-columns" class="form-check-label">Non-zero</label>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-display-columns-by">Compare another period</label>
                                        <div class="dropdown">
                                            <button type="button" class="dropdown-toggle nsm-button w-100 m-0" data-bs-toggle="dropdown">
                                                <span>
                                                    Select period
                                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-100">
                                                <div class="form-check">
                                                    <input type="checkbox" id="previous-period" name="selected_period" class="form-check-input">
                                                    <label for="previous-period" class="form-check-label">Previous period (PP)</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check d-inline-block">
                                                            <input type="checkbox" id="previous-period-dollar-change" class="form-check-input" disabled>
                                                            <label for="previous-period-dollar-change" class="form-check-label">$ change</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input type="checkbox" id="previous-period-percent-change" class="form-check-input" disabled>
                                                            <label for="previous-period-percent-change" class="form-check-label">% change</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="previous-year" name="selected_period" class="form-check-input">
                                                    <label for="previous-year" class="form-check-label">Previous year (PY)</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check d-inline-block">
                                                            <input type="checkbox" id="previous-year-dollar-change" class="form-check-input" disabled>
                                                            <label for="previous-year-dollar-change" class="form-check-label">$ change</label>
                                                        </div>
                                                        <div class="form-check d-inline-block">
                                                            <input type="checkbox" id="previous-year-percent-change" class="form-check-input" disabled>
                                                            <label for="previous-year-percent-change" class="form-check-label">% change</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="year-to-date" name="selected_period" class="form-check-input">
                                                    <label for="year-to-date" class="form-check-label">Year-to-date (YTD)</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-check d-inline-block">
                                                            <input type="checkbox" id="ytd-percent" class="form-check-input" disabled>
                                                            <label for="ytd-percent" class="form-check-label">% of YTD</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="percent-of-row" name="selected_period" class="form-check-input">
                                                    <label for="percent-of-row" class="form-check-label">% of Row</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="percent-of-col" name="selected_period" class="form-check-input">
                                                    <label for="percent-of-col" class="form-check-label">% of Column</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="percent-of-income" name="selected_period" class="form-check-input">
                                                    <label for="percent-of-income" class="form-check-label">% of Income</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="percent-of-expense" name="selected_period" class="form-check-input">
                                                    <label for="percent-of-expense" class="form-check-label">% of Expense</label>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="" class="w-100">Accounting method</label>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="cash-method" class="form-check-input" name="accounting_method">
                                            <label for="cash-method" class="form-check-label">Cash</label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="accrual-method" class="form-check-input" name="accounting_method" checked>
                                            <label for="accrual-method" class="form-check-label">Accrual</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="button" class="nsm-button primary">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-6 offset-md-3">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button">
                                                <span>Collapse</span>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <div class="form-check">
                                                    <input type="radio" checked id="sort-default" name="sort_order" class="form-check-input">
                                                    <label for="sort-default" class="form-check-label">Default</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input">
                                                    <label for="sort-asc" class="form-check-label">Total in ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Total in descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
                                            </button>
                                            <button type="button" class="nsm-button">
                                                <span>Edit titles</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-export"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end export-dropdown">
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-excel">Export to Excel</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);" id="export-to-pdf">Export to PDF</a></li>
                                            </ul>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold"><span class="company-name"><?=$clients->business_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="m-0 fw-bold">Profit and Loss by Customer</p>
                                        <p>January 1-<?=date("F d, Y")?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Name"></td>
                                            <td data-name="Test Customer">Test Customer</td>
                                            <td data-name="Total">TOTAL</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr data-toggle="collapse" data-target="#accordion" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> INCOME</td>
                                            <td>$571,265.66</td>
                                            <td>$571,265.66</td>
                                        </tr>
                                        <tr data-toggle="collapse" data-target="#accordion1" class="clickable collapse-row collapse" id="accordion">
                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Assets</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion2">
                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Bank Accounts</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion2" class="collapse">
                                            <td>&emsp;&emsp;&emsp;Checking</td>
                                            <td>305,061.93</td>
                                            <td>305,061.93</td>
                                        </tr>
                                        <tr id="accordion2" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion3">
                                            <td>&emsp;&emsp;&emsp;<i class="bx bx-fw bx-caret-right"> Test Bank (Cash on hand)</td>
                                            <td>990.77</td>
                                            <td>990.77</td>
                                        </tr>
                                        <tr id="accordion3" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;&emsp; Sub-bank (Cash on hand)</td>
                                            <td>990.00</td>
                                            <td>990.00</td>
                                        </tr>
                                        <tr id="accordion3" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;&emsp; <b>Total Test Bank (Cash on hand)</b></td>
                                            <td><b>1,980.77</b></td>
                                            <td><b>1,980.77</b></td>
                                        </tr>
                                        <tr id="accordion2" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Test Category</td>
                                            <td>10.00</td>
                                            <td>10.00</td>
                                        </tr>
                                        <tr id="accordion2" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                            <td><b>$307,052.70</b></td>
                                            <td><b>$307,052.70</b></td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion4">
                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Accounts Receivable</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion4" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                            <td>205,324.93</td>
                                            <td>205,324.93</td>
                                        </tr>
                                        <tr id="accordion4" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                            <td><b>$205,324.93</b></td>
                                            <td><b>$205,324.93</b></td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row" data-toggle="collapse" data-target="#accordion5">
                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Other Current Assets</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                            <td>207.95</td>
                                            <td>207.95</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Inventory</td>
                                            <td>25.00</td>
                                            <td>25.00</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                            <td>25,705.75</td>
                                            <td>25,705.75</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Test OCA</td>
                                            <td>1,000.00</td>
                                            <td>1,000.00</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                            <td>9,068.80</td>
                                            <td>9,068.80</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                            <td>16,347.82</td>
                                            <td>16,347.82</td>
                                        </tr>
                                        <tr id="accordion5" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                            <td><b>$52,355.32</b></td>
                                            <td><b>$52,355.32</b></td>
                                        </tr>
                                        <tr id="accordion1" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                            <td><b>$564,732.95</b></td>
                                            <td><b>$564,732.95</b></td>
                                        </tr>
                                        <tr data-toggle="collapse" data-target="#accordion1" class="clickable collapse-row collapse" id="accordion6">
                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Fixed Assets</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Accumulated Depreciation</td>
                                            <td>-26,176.00</td>
                                            <td>-26,176.00</td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Fixed Asset Computers</td>
                                            <td>6,069.00</td>
                                            <td>6,069.00</td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                            <td>25,289.00</td>
                                            <td>25,289.00</td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;Fixed Asset Phone</td>
                                            <td>1,200.00</td>
                                            <td>1,200.00</td>
                                        </tr>
                                        <tr id="accordion6" class="collapse clickable collapse-row">
                                            <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                            <td><b>$6,382.00</b></td>
                                            <td><b>$6,382.00</b></td>
                                        </tr>
                                        <tr  class="clickable collapse-row collapse"  id="accordion">
                                            <td>&emsp;<b>TOTAL INCOME</b></td>
                                            <td><b>$571,114.95</b></td>
                                            <td><b>$571,114.95</b></td>
                                        </tr>
                                        <tr>
                                            <td>GROSS PROFIT</td>
                                            <td>$571,114.95</td>
                                            <td>$571,114.95</td>
                                        </tr>
                                        <tr>
                                            <td><i class="bx bx-fw bx-caret-right"></i> NET INCOME</td>
                                            <td>$571,265.66</td>
                                            <td>$571,265.66</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0">Accrual basis <?=date("l, F j, Y h:i A eP")?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>