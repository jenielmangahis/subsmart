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
                                    <div class="col-12 col-md-12">
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
                                <!-- <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?= date("01/01/Y") ?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?= date("m/d/Y") ?>" id="filter-to">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-from">From</label>
                                        <div class="">
                                            <input type="date" id="filter-from" class="form-control nsm-field date" data-type="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-to">To</label>
                                        <div class="">
                                            <input type="date" id="filter-to" class="form-control nsm-field date" data-type="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-display-columns-by">Display columns by</label>
                                        <select class="nsm-field form-select" name="filter_display_columns_by" id="filter-display-columns-by">
                                            <option value="total-only" selected>Total Only</option>
                                            <option value="days">Days</option>
                                            <option value="weeks">Weeks</option>
                                            <option value="months">Months</option>
                                            <option value="quarters">Quarters</option>
                                            <option value="years">Years</option>
                                            <option value="customers">Customers</option>
                                            <option value="vendors">Vendors</option>
                                            <option value="products-services">Products/Services</option>
                                        </select>
                                    </div>
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
                                                    <input type="checkbox" id="percent-of-row" name="selected_period" class="form-check-input">
                                                    <label for="percent-of-row" class="form-check-label">% of Row</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="percent-of-col" name="selected_period" class="form-check-input">
                                                    <label for="percent-of-col" class="form-check-label">% of Column</label>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="" class="w-100">Accounting method</label>
                                        <div class="form-check d-inline-block mt-2">
                                            <input type="radio" id="cash-method" class="form-check-input" name="accounting_method">
                                            <label for="cash-method" class="form-check-label">Cash</label>
                                        </div>
                                        <div class="form-check d-inline-block">
                                            <input type="radio" id="accrual-method" class="form-check-input" name="accounting_method" checked>
                                            <label for="accrual-method" class="form-check-label">Accrual</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="button" class="nsm-button primary">
                                            Run Report
                                        </button>
                                    </div>
                                </div>
                            </ul>
                            <!-- <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-customize'></i> Customize
                            </button>
                            <button type="button" class="nsm-button primary">
                                <i class='bx bx-fw bx-save'></i> Save customization
                            </button> -->
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
                                            <button type="button" id="collapseButton" class="nsm-button">
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
                                            <button class="nsm-button addNotes">Add Notes</button>
                                            <!-- <button type="button" class="nsm-button" id="editButton">
                                                <span>Edit Title</span>
                                            </button> -->
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
                                            <button class="nsm-button border-0 primary top-button" data-bs-toggle="modal" data-bs-target="#reportSettings"><i class="bx bx-fw bx-cog icon-top"></i></button>
                                            <ul class="dropdown-menu dropdown-menu-end p-3">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold" id="businessName">
                                            <span class="company-name"><?= $reportSettings && $reportSettings->title != '' ? $reportSettings->title : strtoupper($companyInfo->business_name); ?></span>
                                        </h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p id="balance-sheet-title" class="m-0 fw-bold">Balance Sheet Summary</p>
                                        <p id="balance-sheet-date">As of <?= date("F d, Y") ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table balance-sheet-summary-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Name"></td>
                                            <td data-name="Total">TOTAL</td>
                                        </tr>
                                    </thead>
                                    <tbody id="reportTable">
                                        <!-- ASSETS -->
                                        <tr data-bs-toggle="collapse" data-bs-target="#assets" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> ASSETS</td>
                                            <td>$571,265.66</td>
                                        </tr>
                                        <tr class="collapse" id="assets">
                                            <td colspan="2">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr data-bs-toggle="collapse" data-bs-target="#currentAssets" class="clickable collapse-row collapsed">
                                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Assets</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="currentAssets" class="collapse">
                                                            <td colspan="2">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#bankAccounts" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Bank Accounts</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="bankAccounts" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Checking</td>
                                                                            <td>$305,061.93</td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#testBank" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Test Bank (Cash on hand)</td>
                                                                            <td>$990.77</td>
                                                                        </tr>
                                                                        <tr id="testBank" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;&emsp;Sub-bank (Cash on hand)</td>
                                                                            <td>$990.00</td>
                                                                        </tr>
                                                                        <tr id="testBank" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;&emsp;<b>Total Test Bank (Cash on hand)</b></td>
                                                                            <td><b>$1,980.77</b></td>
                                                                        </tr>
                                                                        <tr id="bankAccounts" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Test Category</td>
                                                                            <td>$10.00</td>
                                                                        </tr>
                                                                        <tr id="bankAccounts" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;<b>Total Bank Accounts</b></td>
                                                                            <td><b>$307,052.70</b></td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#accountsReceivable" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Accounts Receivable</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="accountsReceivable" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Accounts Receivable</td>
                                                                            <td>$205,324.93</td>
                                                                        </tr>
                                                                        <tr id="accountsReceivable" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;<b>Total Accounts Receivable</b></td>
                                                                            <td><b>$205,324.93</b></td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#otherCurrentAssets" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Other Current Assets</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Credit Card Receivables</td>
                                                                            <td>$207.95</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Inventory</td>
                                                                            <td>$25.00</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                                                            <td>$25,705.75</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Test OCA</td>
                                                                            <td>$1,000.00</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                                                            <td>$9,068.80</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                                                            <td>$16,347.82</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                                                            <td><b>$52,355.32</b></td>
                                                                        </tr>
                                                                        <tr id="currentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;<b>Total Current Assets</b></td>
                                                                            <td><b>$564,732.95</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr data-bs-toggle="collapse" data-bs-target="#fixedAssets" class="clickable collapse-row collapsed">
                                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Fixed Assets</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="fixedAssets" class="collapse">
                                                            <td colspan="2">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Accumulated Depreciation</td>
                                                                            <td>$-26,176.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Fixed Asset Computers</td>
                                                                            <td>$6,069.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                                                            <td>$25,289.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Fixed Asset Phone</td>
                                                                            <td>$1,200.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                                                            <td><b>$6,382.00</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr id="assets" class="collapse">
                                                            <td>&emsp;<b>TOTAL ASSETS</b></td>
                                                            <td><b>$571,114.95</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- LIABILITIES AND EQUITY -->
                                        <tr data-bs-toggle="collapse" data-bs-target="#liabilitiesEquity" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                            <td>$571,265.66</td>
                                        </tr>
                                        <tr class="collapse" id="liabilitiesEquity">
                                            <td colspan="2">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr data-bs-toggle="collapse" data-bs-target="#liabilities" class="clickable collapse-row collapsed">
                                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Liabilities</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="liabilities" class="collapse">
                                                            <td colspan="2">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#currentLiabilities" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Liabilities</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="currentLiabilities" class="collapse">
                                                                            <td colspan="2">
                                                                                <table class="table mb-0">
                                                                                    <tbody>
                                                                                        <tr id="currentLiabilities" class="collapse">
                                                                                            <td>&emsp;&emsp;&emsp;Accounts Payable</td>
                                                                                            <td>$15,000.00</td>
                                                                                        </tr>
                                                                                        <tr id="currentLiabilities" class="collapse">
                                                                                            <td>&emsp;&emsp;&emsp;Credit Card</td>
                                                                                            <td>$5,000.00</td>
                                                                                        </tr>
                                                                                        <tr id="currentLiabilities" class="collapse">
                                                                                            <td>&emsp;&emsp;&emsp;<b>Total Current Liabilities</b></td>
                                                                                            <td><b>$20,000.00</b></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#longTermLiabilities" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Long-term Liabilities</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="longTermLiabilities" class="collapse">
                                                                            <td colspan="2">
                                                                                <table class="table mb-0">
                                                                                    <tbody>
                                                                                        <tr id="longTermLiabilities" class="collapse">
                                                                                            <td>&emsp;&emsp;&emsp;Mortgage Payable</td>
                                                                                            <td>$100,000.00</td>
                                                                                        </tr>
                                                                                        <tr id="longTermLiabilities" class="collapse">
                                                                                            <td>&emsp;&emsp;&emsp;Car Loan</td>
                                                                                            <td>$15,000.00</td>
                                                                                        </tr>
                                                                                        <tr id="longTermLiabilities" class="collapse">
                                                                                            <td>&emsp;&emsp;&emsp;<b>Total Long-term Liabilities</b></td>
                                                                                            <td><b>$115,000.00</b></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                        <tr id="liabilities" class="collapse">
                                                                            <td>&emsp;&emsp;<b>Total Liabilities</b></td>
                                                                            <td><b>$135,000.00</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr data-bs-toggle="collapse" data-bs-target="#equity" class="clickable collapse-row collapsed">
                                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Equity</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="equity" class="collapse">
                                                            <td colspan="2">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr id="equity" class="collapse">
                                                                            <td>&emsp;&emsp;Owner's Equity</td>
                                                                            <td>$400,000.00</td>
                                                                        </tr>
                                                                        <tr id="equity" class="collapse">
                                                                            <td>&emsp;&emsp;Retained Earnings</td>
                                                                            <td>$36,265.66</td>
                                                                        </tr>
                                                                        <tr id="equity" class="collapse">
                                                                            <td>&emsp;&emsp;<b>Total Equity</b></td>
                                                                            <td><b>$436,265.66</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr id="liabilitiesEquity" class="collapse">
                                                            <td>&emsp;<b>Total Liabilities and Equity</b></td>
                                                            <td><b>$571,265.66</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <span id="notesContent" class="text-muted">Loading Notes...</span>
                                    <form id="addNotesForm" method="POST" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-12 mt-1 mb-3">
                                                <div class="form-group">
                                                    <textarea id="NOTES" class="form-control" maxlength="4000"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="float-start noteCharMax">
                                                    4000 characters max
                                                </div>
                                                <div class="float-end">
                                                    <button type="button" id="cancelNotes" class="nsm-button">Cancel</button>
                                                    <button type="submit" class="nsm-button primary noteSaveButton">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0">Accrual basis <?= date("l, F j, Y h:i A eP") ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Report Settings -->
<div class="modal" id="reportSettings" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Report Settings</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="reportSettingsForm" method="POST">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Title</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableBusinessName" type="checkbox" checked></div>
                                        <!-- <input id="company_name" class="nsm-field form-control" type="text" name="company_name" value="<?php echo ($companyInfo) ? strtoupper($companyInfo->business_name) : "" ?>" required> -->
                                        <input id="reportTitle" type="text" class="company-name nsm-field form-control" value="<?= $reportSettings && $reportSettings->title != '' ? htmlspecialchars($reportSettings->title, ENT_QUOTES, 'UTF-8') : htmlspecialchars($companyInfo->business_name, ENT_QUOTES, 'UTF-8'); ?>">

                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Report Name</label>
                                    <div class="input-group">
                                        <div class="input-group-text"><input class="form-check-input mt-0 enableDisableReportName" type="checkbox" checked></div>
                                        <input id="report_name" class="nsm-field form-control" type="text" name="report_name" value="<?php echo $page->title ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="filter-date">Date</label>
                                    <div class="">
                                        <input type="date" id="filter-date" class="form-control nsm-field date" data-type="filter-date">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Logo</label>
                                    <select id="showHideLogo" name="showHideLogo" class="nsm-field form-select">
                                        <option value="1" selected>Show</option>
                                        <option value="0">Hide</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Header Align</label>
                                    <select name="header_align" id="header-align" class="nsm-field form-select">
                                        <option value="L">Left</option>
                                        <option value="C" selected>Center</option>
                                        <option value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="mb-1 fw-xnormal">Footer Align</label>
                                    <select name="footer_align" id="footer-align" class="nsm-field form-select">
                                        <option value="L">Left</option>
                                        <option value="C" selected>Center</option>
                                        <option value="R">Right</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="col-md-12">
                                        <label class="mb-1 fw-xnormal">Sort By</label>
                                        <div class="input-group">
                                            <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                <option value="id" selected>Default</option>
                                                <option value="date_changed">Date Changed</option>
                                                <option value="user">User</option>
                                                <option value="event">Event</option>
                                                <option value="name">Name</option>
                                                <option value="date">Date</option>
                                                <option value="amount">Amount</option>
                                            </select>
                                            <select name="sort_order" id="sort-order" class="nsm-field form-select">
                                                <option value="ASC">ASC</option>
                                                <option value="DESC" selected>DESC</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="mb-1 fw-xnormal">Display Density</label><br />
                                    <input type="checkbox" id="display" class="form-check-input">
                                    <label for="compact-display" class="form-check-label">Compact</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary settingsApplyButton">Apply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Report Settings -->

<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('accounting/reports/reports_assets/balance_sheet_summary_js'); ?>

<script type="text/javascript">
    var baseUrl = '<?= base_url() ?>';
</script>