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
                    <div class="col-12 col-md-10 offset-md-1">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header d-block">
                                <div class="row">
                                    <div class="col-12 col-md-6 grid-mb">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button" data-bs-toggle="dropdown">
                                                <span>Sort</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3">
                                                <p class="m-0">Sort by</p>
                                                <select name="sort_by" id="sort-by" class="nsm-field form-select">
                                                    <option value="default" selected>Default</option>
                                                    <option value="create-date">Create Date</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="date">Date</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="memo-description">Memo/Description</option>
                                                    <option value="name">Name</option>
                                                    <option value="num">Num</option>
                                                    <option value="payment-method">Payment Method</option>
                                                    <option value="split">Split</option>
                                                    <option value="transaction-type">Transaction Type</option>
                                                </select>
                                                <p class="m-0">Sort in</p>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-asc" name="sort_order" class="form-check-input" checked>
                                                    <label for="sort-asc" class="form-check-label">Ascending order</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="sort-desc" name="sort_order" class="form-check-input">
                                                    <label for="sort-desc" class="form-check-label">Descending order</label>
                                                </div>
                                            </ul>
                                            <button type="button" class="nsm-button">
                                                <span>Add notes</span>
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
                                            <ul class="dropdown-menu dropdown-menu-end p-3 w-25">
                                                <p class="m-0">Display density</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="compact-display" class="form-check-input">
                                                    <label for="compact-display" class="form-check-label">Compact</label>
                                                </div>
                                                <p class="m-0">Change columns</p>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-date" class="form-check-input" checked>
                                                            <label for="col-date" class="form-check-label">Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-transaction-type" class="form-check-input" checked>
                                                            <label for="col-transaction-type" class="form-check-label">Transaction Type</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-num" class="form-check-input" checked>
                                                            <label for="col-num" class="form-check-label">Num</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-create-date" class="form-check-input">
                                                            <label for="col-create-date" class="form-check-label">Create Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-created-by" class="form-check-input">
                                                            <label for="col-created-by" class="form-check-label">Created By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified" class="form-check-input">
                                                            <label for="col-last-modified" class="form-check-label">Last Modified</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-last-modified-by" class="form-check-input">
                                                            <label for="col-last-modified-by" class="form-check-label">Last Modified By</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-name" class="form-check-input" checked>
                                                            <label for="col-name" class="form-check-label">Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-memo-desc" class="form-check-input" checked>
                                                            <label for="col-memo-desc" class="form-check-label">Memo/Description</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-split" class="form-check-input" checked>
                                                            <label for="col-split" class="form-check-label">Split</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-debit" class="form-check-input" checked>
                                                            <label for="col-debit" class="form-check-label">Debit</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-credit" class="form-check-input" checked>
                                                            <label for="col-credit" class="form-check-label">Credit</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-payment-method" class="form-check-input">
                                                            <label for="col-payment-method" class="form-check-label">Payment Method</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-amount" class="form-check-input" checked>
                                                            <label for="col-amount" class="form-check-label">Amount</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-balance" class="form-check-input" checked>
                                                            <label for="col-balance" class="form-check-label">Balance</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="m-0"><a href="#" style="text-decoration: none">Reorder columns</a></p>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 grid-mb">
                                        <h4 class="text-center fw-bold"><span class="company-name"><?= $clients->business_name ?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="m-0 fw-bold">Balance Sheet Detail</p>
                                        <p>As of <?= date("F d, Y") ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table">
                                    <thead>
                                        <tr>
                                            <td data-name="Date">DATE</td>
                                            <td data-name="Transaction Type">TRANSACTION TYPE</td>
                                            <td data-name="Num">NUM</td>
                                            <td data-name="Name">NAME</td>
                                            <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                                            <td data-name="Split">SPLIT</td>
                                            <td data-name="Debit">DEBIT</td>
                                            <td data-name="Credit">CREDIT</td>
                                            <td data-name="Amount">AMOUNT</td>
                                            <td data-name="Balance">BALANCE</td>
                                        </tr>
                                    </thead>
                                    <tbody id="reportTable">
                                        <!-- ASSETS -->
                                        <tr data-bs-toggle="collapse" data-bs-target="#assets" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> ASSETS</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>$22,544.77</td>
                                            <td>$1,404,676.97</td>
                                        </tr>
                                        <tr id="assets" class="collapse">
                                            <td colspan="10">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr data-bs-toggle="collapse" data-bs-target="#checking" class="clickable collapse-row collapsed">
                                                            <td>&emsp;<i class="bx bx-fw bx-caret-right"></i> Checking</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr id="checking" class="collapse">
                                                            <td colspan="10">
                                                                <table class="table mb-0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Beginning balance</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td>1,081,409.39</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>06/01/2022</td>
                                                                            <td>Expense</td>
                                                                            <td></td>
                                                                            <td>QuickBooks Payment</td>
                                                                            <td></td>
                                                                            <td>QuickBooks Payment Fees-1</td>
                                                                            <td></td>
                                                                            <td>$19.95</td>
                                                                            <td>-19.95</td>
                                                                            <td>1,081,389.44</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>06/01/2022</td>
                                                                            <td>Deposit</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td>-Split-</td>
                                                                            <td>$1,167.62</td>
                                                                            <td></td>
                                                                            <td>1,167.62</td>
                                                                            <td>1,082,557.06</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>&emsp;<b>TOTAL ASSETS</b></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>$22,544.77</td>
                                                            <td>$1,404,676.97</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <!-- LIABILITIES AND EQUITY -->
                                        <tr data-bs-toggle="collapse" data-bs-target="#liabilitiesEquity" class="clickable collapse-row collapsed">
                                            <td><i class="bx bx-fw bx-caret-right"></i> LIABILITIES AND EQUITY</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>$1,922,289.76</td>
                                            <td>$1,404,676.97</td>
                                        </tr>
                                    </tbody>
                                </table>
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

<?php include viewPath('v2/includes/footer'); ?>

<script>
    var isCollapsed = true;

    $("#collapseButton").click(function() {
        if (isCollapsed) {
            $(".collapse").collapse('show');
            $("#collapseButton span").text('Uncollapse');
        } else {
            $(".collapse").collapse('hide');
            $("#collapseButton span").text('Collapse');
        }
        isCollapsed = !isCollapsed;
    });

    $(".collapse-row").click(function() {
        var target = $(this).data("bs-target");
        $(this).find("i").toggleClass("bx-caret-right bx-caret-down");
        $(target).collapse('toggle');
    });
</script>
<script>
    var currentDate = new Date().toISOString().split('T')[0];

    document.getElementById('from').value = currentDate;
    document.getElementById('to').value = currentDate;
</script>