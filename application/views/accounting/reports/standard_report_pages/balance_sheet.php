<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('accounting/reports/reports_assets/report_css'); ?>
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
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label for="from">From</label>
                                        <div class="">
                                            <input type="date" id="from" class="form-control nsm-field date" data-type="from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="to">To</label>
                                        <div class="">
                                            <input type="date" id="to" class="form-control nsm-field date" data-type="to">
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
                                <div class="row grid-mb">

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
                                            <button type="button" class="nsm-button" id="collapseButton">
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
                                            <button type="button" class="nsm-button" id="editButton">
                                                <span>Edit Title</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#email_accounts_modal">
                                                <i class='bx bx-fw bx-envelope'></i>
                                            </button>
                                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#print_accounts_modal" onclick="previewPDF()">
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
                                        <p class="m-0 fw-bold">Balance Sheet</p>
                                        <p>As of <?= date("F d, Y") ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
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
                                            <td>$564,732.95</td>
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
                                                                            <td>305,061.93</td>
                                                                        </tr>
                                                                        <tr id="bankAccounts" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Test Category</td>
                                                                            <td>10.00</td>
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
                                                                            <td>205,324.93</td>
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
                                                                            <td>207.95</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Inventory</td>
                                                                            <td>25.00</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Inventory Asset-1</td>
                                                                            <td>25,705.75</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Test OCA</td>
                                                                            <td>1,000.00</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Uncategorized Asset</td>
                                                                            <td>9,068.80</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Undeposited Funds</td>
                                                                            <td>16,347.82</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentAssets" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;<b>Total Other Current Assets</b></td>
                                                                            <td><b>$52,355.32</b></td>
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
                                                                            <td>-26,176.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Fixed Asset Computers</td>
                                                                            <td>6,069.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Fixed Asset Furniture</td>
                                                                            <td>25,289.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;Fixed Asset Phone</td>
                                                                            <td>1,200.00</td>
                                                                        </tr>
                                                                        <tr id="fixedAssets" class="collapse">
                                                                            <td>&emsp;&emsp;<b>Total Fixed Assets</b></td>
                                                                            <td><b>$6,382.00</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <!-- <tr id="assets" class="collapse">
                                                            <td>&emsp;<b>TOTAL ASSETS</b></td>
                                                            <td><b>$571,114.95</b></td>
                                                        </tr> -->
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
                                                        <tr data-bs-toggle="collapse" data-bs-target="#currentLiabilities" class="clickable collapse-row collapsed">
                                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Current Liabilities</td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="currentLiabilities" class="collapse">
                                                            <td colspan="2">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#accountsPayable" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Accounts Payable</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="accountsPayable" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Accounts Payable</td>
                                                                            <td>$15,000.00</td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#creditCards" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Credit Cards</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="creditCards" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Credit Card 1</td>
                                                                            <td>$5,000.00</td>
                                                                        </tr>
                                                                        <tr id="creditCards" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Credit Card 2</td>
                                                                            <td>$3,000.00</td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#otherCurrentLiabilities" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Other Current Liabilities</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="otherCurrentLiabilities" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Sales Tax Payable</td>
                                                                            <td>$1,500.00</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentLiabilities" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Payroll Liabilities</td>
                                                                            <td>$2,000.00</td>
                                                                        </tr>
                                                                        <tr id="otherCurrentLiabilities" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;<b>Total Other Current Liabilities</b></td>
                                                                            <td><b>$3,500.00</b></td>
                                                                        </tr>
                                                                        <tr data-bs-toggle="collapse" data-bs-target="#longTermLiabilities" class="clickable collapse-row collapsed">
                                                                            <td>&emsp;&emsp;<i class="bx bx-fw bx-caret-right"></i> Long-term Liabilities</td>
                                                                            <td></td>
                                                                        </tr>
                                                                        <tr id="longTermLiabilities" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;Loan Payable</td>
                                                                            <td>$50,000.00</td>
                                                                        </tr>
                                                                        <tr id="longTermLiabilities" class="collapse">
                                                                            <td>&emsp;&emsp;&emsp;<b>Total Long-term Liabilities</b></td>
                                                                            <td><b>$50,000.00</b></td>
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
                                                                            <td>$500,000.00</td>
                                                                        </tr>
                                                                        <tr id="equity" class="collapse">
                                                                            <td>&emsp;&emsp;Retained Earnings</td>
                                                                            <td>$100,000.00</td>
                                                                        </tr>
                                                                        <tr id="equity" class="collapse">
                                                                            <td>&emsp;&emsp;<b>Total Equity</b></td>
                                                                            <td><b>$600,000.00</b></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr id="liabilitiesEquity" class="collapse">
                                                            <td>&emsp;<b>TOTAL LIABILITIES AND EQUITY</b></td>
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

<!-- START: PRINT/SAVE MODAL -->
<div class="modal" id="print_accounts_modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Print or save as PDF</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3 mt-1 mb-3">
                        <h6>Report print settings</h6>
                        <hr>
                        <div class="form-group mb-2">
                            <label>Orientation</label>
                            <select id="pageOrientation" name="pageOrientation" class="form-select">
                                <option value="P" selected>Portrait</option>
                                <option value="L">Landscape</option>
                            </select>
                        </div>
                        <div class="form-check">
                            <input id="pageHeaderRepeat" name="pageHeaderRepeat" class="form-check-input" type="checkbox">
                            <label class="form-check-label" for="pageHeaderRepeat">Repeat Page Header</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <iframe id="pdfPreview" class="border-0" width="100%" height="450px"></iframe>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start">
                            <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="float-end">
                            <button type="button" class="nsm-button primary savePDF">Save as PDF</button>
                            <!-- <button type="button" class="nsm-button primary printPDF">Print</button> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: PRINT/SAVE MODAL -->
<!-- START: EMAIL REPORT MODAL -->
<div class="modal" id="email_accounts_modal" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Email Report</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <form id="sendEmailForm">
                    <div class="row">
                        <div class="col-sm-12 mt-1">
                            <div class="form-group">
                                <h6>To</h6>
                                <input id="emailTo" class="form-control" type="email" placeholder="Send to" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>CC</h6>
                                <input id="emailCC" class="form-control" type="email" placeholder="Carbon Copy">
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Subject</h6>
                                <input id="emailSubject" class="form-control" type="text" value="<?php echo $clients->business_name ?>" required>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Body</h6>
                                <div id="emailBody">Hello,<br><br>Attached here is the <?php echo $page->title ?> from <?php echo $clients->business_name ?>.<br><br>Regards,<br><?php echo "$users->FName $users->LName"; ?></div>
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <h6>Attachment</h6>
                                <div class="row">
                                    <div class="input-group borderRadius0 pdfAttachment">
                                        <div class="input-group-text"><input class="form-check-input mt-0 pdfAttachmentCheckbox" type="checkbox"></div>
                                        <input id="pdfReportFilename" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".pdf" style="max-width: 60px;">
                                    </div>
                                    <div class="input-group borderRadius0">
                                        <div class="input-group-text"><input class="form-check-input mt-0 xlsxAttachmentCheckbox" type="checkbox"></div>
                                        <input id="xlsxReportFileName" class="form-control" type="text" value="<?php echo $page->title ?>" required>
                                        <input class="form-control" type="text" disabled readonly value=".xlsx" style="max-width: 60px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="float-start">
                                <button type="button" id="emailCloseModal" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="float-end">
                                <button type="submit" class="nsm-button primary sendEmail"><span class="sendEmail_Loader"></span>Send</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END: EMAIL REPORT MODAL -->

<?php include viewPath('v2/includes/footer'); ?>
<?php include viewPath('accounting/reports/reports_assets/balance_sheet_js'); ?>

<style>
    .compact-table td,
    .compact-table th {
        padding: 4px 8px;
        font-size: 12px;
    }
</style>
<script type="text/javascript">
    var baseUrl = '<?= base_url() ?>';
</script>
<script>
    $(document).ready(function() {
        var isCollapsed = true;

        $("#collapseButton").click(function() {
            if (isCollapsed) {
                $(".collapse").collapse('show');
                $("#collapseButton span").text('Uncollapse');
                updateCarets('show');
            } else {
                $(".collapse").collapse('hide');
                $("#collapseButton span").text('Collapse');
                updateCarets('hide');
            }
            isCollapsed = !isCollapsed;
        });

        $(".collapse-row").click(function() {
            var target = $(this).data("bs-target");
            $(this).find("i").toggleClass("bx-caret-right bx-caret-down");
            $(target).collapse('toggle');
        });

        function updateCarets(action) {
            $(".collapse-row").each(function() {
                var target = $(this).data("bs-target");
                var icon = $(this).find("i");
                if (action === 'show') {
                    icon.removeClass("bx-caret-right").addClass("bx-caret-down");
                } else {
                    icon.removeClass("bx-caret-down").addClass("bx-caret-right");
                }
            });
        }

        $("input[name='sort_order']").change(function() {
            var sortOrder = $("input[name='sort_order']:checked").attr('id');
            sortTable(sortOrder);
        });

        function sortTable(order) {
            var rows = $("#reportTable > tr").toArray();

            if (order === 'sort-default') {
                $("#reportTable").html(originalOrder);
            } else {
                rows.sort(function(a, b) {
                    var aValue = parseFloat($(a).find("td").eq(1).text().replace(/[\$,]/g, '')) || 0;
                    var bValue = parseFloat($(b).find("td").eq(1).text().replace(/[\$,]/g, '')) || 0;
                    if (order === 'sort-asc') {
                        return aValue - bValue;
                    } else if (order === 'sort-desc') {
                        return bValue - aValue;
                    }
                });
                $("#reportTable").html(rows);
            }
        }

        $("#compact-display").change(function() {
            if ($(this).is(":checked")) {
                $("#reportTable").addClass("compact-table");
            } else {
                $("#reportTable").removeClass("compact-table");
            }
        });
    });
</script>
<script>
    var currentDate = new Date().toISOString().split('T')[0];

    document.getElementById('from').value = currentDate;
    document.getElementById('to').value = currentDate;
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>