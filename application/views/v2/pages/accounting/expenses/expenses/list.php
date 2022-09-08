<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/expenses_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/expenses'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            An expense is generally anything that your company spends money on to keep it up and running. Examples of expenses are rent, phone bills, website hosting fees, office supplies, accountant fees, trash service, janitorial fees, etc. Simply click new transaction and you will see you will see a list of options to chose from. Once you choose the type of transactions; just enter the information and click save new.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <!-- <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Filter by name">
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="categorize-selected">Categorize selected</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    Other Actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="print-checks">Print checks</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="pay-bills">Pay bills</a></li>
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3" id="expense-table-filters" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all-transactions" selected="selected">All transactions</option>
                                            <option value="expense">Expense</option>
                                            <option value="bill">Bill</option>
                                            <option value="bill-payments">Bill payments</option>
                                            <option value="check">Check</option>
                                            <option value="purchase-order">Purchase order</option>
                                            <option value="recently-paid">Recently paid</option>
                                            <option value="vendor-credit">Vendor Credit</option>
                                            <option value="credit-card-payment">Credit Card Payment</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <option value="all" selected="selected">All statuses</option>
                                            <option value="open">Open</option>
                                            <option value="overdue">Overdue</option>
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="filter-delivery-method">Delivery method</label>
                                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                                            <option value="any" selected="selected">Any</option>
                                            <option value="print-later">Print later</option>
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
                                            <input type="text" class="nsm-field form-control date" value="<?=date("m/d/Y", strtotime("-365 days"))?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" id="filter-to">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="filter-payee">Payee</label>
                                        <select class="nsm-field form-select" name="filter_payee" id="filter-payee">
                                            <option value="all" selected="selected">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-5">
                                        <label for="filter-category">Category</label>
                                        <select class="nsm-field form-select" name="filter_category" id="filter-category">
                                            <option value="all" selected="selected">All</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" onclick="resetExpenseFilter()">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" onclick="applyExpenseFilter()">
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
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-time-activity">Time activity</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-bill">Bill</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-expense">Expense</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-check">Check</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-purchase-order">Purchase order</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-vendor-credit">Vendor Credit</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-cc-payment">Pay down credit card</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-items">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_expenses_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_type" class="form-check-input">
                                    <label for="chk_type" class="form-check-label">Type</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_no" class="form-check-input">
                                    <label for="chk_no" class="form-check-label">No.</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_payee" class="form-check-input">
                                    <label for="chk_payee" class="form-check-label">Payee</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_method" class="form-check-input">
                                    <label for="chk_method" class="form-check-label">Method</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_source" class="form-check-input">
                                    <label for="chk_source" class="form-check-label">Source</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_category" class="form-check-input">
                                    <label for="chk_category" class="form-check-label">Category</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_memo" class="form-check-input">
                                    <label for="chk_memo" class="form-check-label">Memo</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_due_date" class="form-check-input">
                                    <label for="chk_due_date" class="form-check-label">Due date</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_balance" class="form-check-input">
                                    <label for="chk_balance" class="form-check-label">Balance</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_status" class="form-check-input">
                                    <label for="chk_status" class="form-check-label">Status</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" checked="checked" name="col_chk" id="chk_attachments" class="form-check-input">
                                    <label for="chk_attachments" class="form-check-label">Attachments</label>
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
                                    <input type="checkbox" name="compact" id="compact" class="form-check-input">
                                    <label for="compact" class="form-check-label">Compact</label>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table" id="expenses-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <td data-name="Date">DATE</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="No.">NO.</td>
                            <td data-name="Payee">PAYEE</td>
                            <td data-name="Method">METHOD</td>
                            <td data-name="Source">SOURCE</td>
                            <td data-name="Category">CATEGORY</td>
                            <td data-name="Memo" class="text-truncate">MEMO</td>
                            <td data-name="Due date">DUE DATE</td>
                            <td data-name="Balance">BALANCE</td>
                            <td data-name="Total">TOTAL</td>
                            <td data-name="Status">STATUS</td>
                            <td class="table-icon text-center" data-name="Attachments">
                                <i class='bx bx-paperclip'></i>
                            </td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
                        <?php foreach($transactions as $transaction): ?>
                        <tr data-type="<?=$transaction['type']?>">
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['number']?></td>
                            <td><?=$transaction['payee']?></td>
                            <td><?=$transaction['method']?></td>
                            <td><?=$transaction['source']?></td>
                            <td>
                                <?php if($transaction['category'] !== '-Split-' && $transaction['category'] !== '') : ?>
                                <select name="expense_account[]" class="form-control nsm-field">
                                    <option value="<?=$transaction['category']['id']?>"><?=$transaction['category']['name']?></option>
                                </select>
                                <?php else : ?>
                                <?=$transaction['category']?>
                                <?php endif; ?>
                            </td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['due_date']?></td>
                            <td><?=$transaction['balance']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['status']?></td>
                            <td></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="15">
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