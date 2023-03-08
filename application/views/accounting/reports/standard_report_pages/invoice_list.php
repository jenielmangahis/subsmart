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
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/01/Y")?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y")?>" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <p class="m-0">Rows/columns</p>
                                <div class="row grid-mb">
                                    <div class="col-12 col-md-6">
                                        <label for="filter-group-by">Group by</label>
                                        <select class="nsm-field form-select" name="filter_group_by" id="filter-group-by">
                                            <option value="none" selected>None</option>
                                            <option value="account">Account</option>
                                            <option value="transaction-type">Transaction Type</option>
                                            <option value="customer">Customer</option>
                                            <option value="day">Day</option>
                                            <option value="week">Week</option>
                                            <option value="month">Month</option>
                                            <option value="quarter">Quarter</option>
                                            <option value="year">Year</option>
                                            <option value="sales-rep">Sales Rep</option>
                                            <option value="po-number">P.O. Number</option>
                                        </select>
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
                    <div class="col-12 col-md-12">
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
                                                    <option value="ar-paid">A/R Paid</option>
                                                    <option value="account">Account</option>
                                                    <option value="billing-address">Billing Address</option>
                                                    <option value="create-date">Create Date</option>
                                                    <option value="created-by">Created By</option>
                                                    <option value="customer-vendor-message">Customer/Vendor Message</option>
                                                    <option value="date">Date</option>
                                                    <option value="delivery-address">Delivery Address</option>
                                                    <option value="due-date">Due Date</option>
                                                    <option value="last-modified">Last Modified</option>
                                                    <option value="last-modified-by">Last Modified By</option>
                                                    <option value="memo-desc">Memo/Description</option>
                                                    <option value="name">Name</option>
                                                    <option value="num">Num</option>
                                                    <option value="po-number">P.O. Number</option>
                                                    <option value="paid-by-mas">Paid by MAS</option>
                                                    <option value="ref-no">Ref #</option>
                                                    <option value="sales-printed">Sales Printed</option>
                                                    <option value="sales-rep">Sales Rep</option>
                                                    <option value="sent">Sent</option>
                                                    <option value="ship-via">Ship Via</option>
                                                    <option value="shipping-address">Shipping Address</option>
                                                    <option value="tax-amount">Tax Amount</option>
                                                    <option value="taxable-amount">Taxable Amount</option>
                                                    <option value="terms">Terms</option>
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
                                                            <input type="checkbox" id="col-account" class="form-check-input">
                                                            <label for="col-account" class="form-check-label">Account</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-ref-no" class="form-check-input">
                                                            <label for="col-ref-no" class="form-check-label">Ref #</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-billing-address" class="form-check-input">
                                                            <label for="col-billing-address" class="form-check-label">Billing Address</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-shipping-address" class="form-check-input">
                                                            <label for="col-shipping-address" class="form-check-label">Shipping Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-sales-rep" class="form-check-input">
                                                            <label for="col-sales-rep" class="form-check-label">Sales Rep</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-po-number" class="form-check-input">
                                                            <label for="col-po-number" class="form-check-label">P.O. Number</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-ship-via" class="form-check-input">
                                                            <label for="col-ship-via" class="form-check-label">Ship Via</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-terms" class="form-check-input">
                                                            <label for="col-terms" class="form-check-label">Terms</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-customer-message" class="form-check-input">
                                                            <label for="col-customer-message" class="form-check-label">Customer/Vendor Message</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-due-date" class="form-check-input" checked>
                                                            <label for="col-due-date" class="form-check-label">Due Date</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-ar-paid" class="form-check-input">
                                                            <label for="col-ar-paid" class="form-check-label">A/R Paid</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-sales-printed" class="form-check-input">
                                                            <label for="col-sales-printed" class="form-check-label">Sales Printed</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-sent" class="form-check-input">
                                                            <label for="col-sent" class="form-check-label">Sent</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-delivery-address" class="form-check-input">
                                                            <label for="col-delivery-address" class="form-check-label">Delivery Address</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-paid-by-mas" class="form-check-input">
                                                            <label for="col-paid-by-mas" class="form-check-label">Paid by MAS</label>
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
                                                            <input type="checkbox" id="col-open-balance" class="form-check-input" checked>
                                                            <label for="col-open-balance" class="form-check-label">Open Balance</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-tax-amount" class="form-check-input">
                                                            <label for="col-tax-amount" class="form-check-label">Tax Amount</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-4">
                                                        <div class="form-check">
                                                            <input type="checkbox" id="col-taxable-amount" class="form-check-input">
                                                            <label for="col-taxable-amount" class="form-check-label">Taxable Amount</label>
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
                                        <h4 class="text-center fw-bold"><span class="company-name"><?=$clients->business_name?></span></h4>
                                    </div>
                                    <div class="col-12 grid-mb text-center">
                                        <p class="m-0 fw-bold">Invoice List by Date</p>
                                        <p><?=date("F 1-j, Y")?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="nsm-card-content h-auto grid-mb">
                                <table class="nsm-table" id="report-invoice-list">
                                    <thead>
                                        <tr>
                                            <td data-name="Date">DATE</td>
                                            <td data-name="Transaction Type">TRANSACTION TYPE</td>
                                            <td data-name="Num">NUM</td>
                                            <td data-name="Name">NAME</td>
                                            <td data-name="Memo/Description">MEMO/DESCRIPTION</td>
                                            <td data-name="Due Date">DUE DATE</td>
                                            <td data-name="Amount">AMOUNT</td>
                                            <td data-name="Open Balance">OPEN BALANCE</td>
                                        </tr>
                                    </thead>
                                    <tbody id="report-invoice-list-body">
                                        <!-- <tr>
                                            <td>06/14/2022</td>
                                            <td>Invoice</td>
                                            <td>123</td>
                                            <td>Test Customer</td>
                                            <td></td>
                                            <td>06/15/2022</td>
                                            <td class="text-right">$22,544.77</td>
                                            <td class="text-right">0.00</td>
                                        </tr> -->
                                        <?php 
                                            foreach($invoices as $invoice)
                                            { ?>
                                                
                                            <tr>
                                                <td><?php echo $invoice->date_issued; ?></td>
                                                <td>Invoice</td>
                                                <td><?php echo $invoice->invoice_number; ?></td>
                                                <td><?php echo $invoice->first_name.' '.$invoice->last_name; ?></td>
                                                <td></td>
                                                <td><?php echo $invoice->due_date; ?></td>
                                                <td class="text-right">$<?php echo $invoice->grand_total; ?></td>
                                                <td class="text-right">$<?php echo $invoice->grand_total; ?></td>
                                            </tr>
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="nsm-card-footer text-center">
                                <p class="m-0"><?=date("l, F j, Y h:i A eP")?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>