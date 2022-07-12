<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            The Sales page gives you a great at-a-glance view of the status of sales transactions, open invoices, and paid invoices.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter primary h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($estimates)?></h2>
                                            <span>ESTIMATES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter secondary h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year">0</h2>
                                            <span>UNBILLED ACTIVITY</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter error h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($InvOverdue)?></h2>
                                            <span>OVERDUE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter h-100 mb-2">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($OpenInvoices)?></h2>
                                            <span>OPEN INVOICES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=count($getAllInvPaid)?></h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Search by tag name">
                        </div> -->
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <input type="hidden" class="nsm-field form-control" id="selected_ids">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Batch Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print-transactions">Print transactions</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="print-packing-slip">Print packing slip</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-transactions">Send transactions</a></li>
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-reminders">Send reminders</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-filter p-3" style="width: max-content">
                                <div class="row">
                                    <div class="col-5">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all-transactions" selected="selected">All transactions</option>
                                            <option value="estimates">Estimate</option>
                                            <option value="invoices">Invoices</option>
                                            <option value="sales-receipts">Sales Receipts</option>
                                            <option value="credit-memos">Credit memos</option>
                                            <option value="unbilled-income">Unbilled income</option>
                                            <option value="recently-paid">Recently paid</option>
                                            <option value="money-received">Money received</option>
                                            <option value="statements">Statements</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <option value="all-statuses" selected="selected">All statuses</option>
                                            <option value="open">Open</option>
                                            <option value="overdue">Overdue</option>
                                            <option value="paid">Paid</option>
                                            <option value="pending">Pending</option>
                                            <option value="accepted">Accepted</option>
                                            <option value="closed">Closed</option>
                                            <option value="rejected">Rejected</option>
                                            <option value="expired">Expired</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="filter-delivery-method">Delivery method</label>
                                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                                            <option value="any" selected="selected">Any</option>
                                            <option value="print-later">Print later</option>
                                            <option value="send-later">Send later</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="last-365-days" selected="selected">Last 365 days</option>
                                            <option value="custom">Custom</option>
                                            <option value="today">Today</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="this-week">This week</option>
                                            <option value="this-month">This month</option>
                                            <option value="this-quarter">This quarter</option>
                                            <option value="this-year">This year</option>
                                            <option value="last-week">Last week</option>
                                            <option value="last-month">Last month</option>
                                            <option value="last-quarter">Last quarter</option>
                                            <option value="last-year">Last year</option>
                                            <option value="all-dates">All dates</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" value="<?=date("m/d/Y", strtotime("-1 year"))?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control datepicker" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="filter-customer">Customer</label>
                                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                                            <option value="all" selected="selected">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    <i class='bx bx-fw bx-list-plus'></i> New transaction
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-invoice">Invoice</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-payment">Payment</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-estimate">Estimate</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-payment-link">Payment Link</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-sales-receipt">Sales Receipt</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-credit-memo">Credit Memo</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-delayed-charge">Delayed Charge</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-time-activity">Time Activity</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_type" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_no" id="chk_no" class="form-check-input">
                                    <label for="chk_no" class="form-check-label">No.</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_customer" id="chk_customer" class="form-check-input">
                                    <label for="chk_customer" class="form-check-label">Customer</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_method" id="chk_method" class="form-check-input">
                                    <label for="chk_method" class="form-check-label">Method</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_source" id="chk_source" class="form-check-input">
                                    <label for="chk_source" class="form-check-label">Source</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_memo" id="chk_memo" class="form-check-input">
                                    <label for="chk_memo" class="form-check-label">Memo</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_due_date" id="chk_due_date" class="form-check-input">
                                    <label for="chk_due_date" class="form-check-label">Due Date</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_aging" id="chk_aging" class="form-check-input">
                                    <label for="chk_aging" class="form-check-label">Aging</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_balance" id="chk_balance" class="form-check-input">
                                    <label for="chk_balance" class="form-check-label">Balance</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_last_delivered" id="chk_last_delivered" class="form-check-input">
                                    <label for="chk_last_delivered" class="form-check-label">Last Delivered</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_email" id="chk_email" class="form-check-input">
                                    <label for="chk_email" class="form-check-label">Email</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_attachments" id="chk_attachments" class="form-check-input">
                                    <label for="chk_attachments" class="form-check-label">Attachments</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_status" id="chk_status" class="form-check-input">
                                    <label for="chk_status" class="form-check-label">Status</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_po_number" id="chk_po_number" class="form-check-input">
                                    <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="chk_sales_rep" id="chk_sales_rep" class="form-check-input">
                                    <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                </div>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            50
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">50</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">75</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">100</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">150</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);">300</a></li>
                                    </ul>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="compact" class="form-check-input">
                                    <label for="compact" class="form-check-label">Compact</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Customer">CUSTOMER</td>
                            <td data-name="Method">METHOD</td>
                            <td data-name="Source">SOURCE</td>
                            <td data-name="Memo">MEMO</td>
                            <td data-name="Due Date">DUE DATE</td>
                            <td data-name="Aging">AGING</td>
                            <td data-name="Balacne">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Last Delivered">LAST DELIVERED</td>
                            <td data-name="Email">EMAIL</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Status">STATUS</td>
                            <td data-name="P.O. number">P.O. NUMBER</td>
                            <td data-name="Sales Rep">SALES REP</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count([]) > 0) : ?>
						<?php foreach([] as $transaction) : ?>
                        
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
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>