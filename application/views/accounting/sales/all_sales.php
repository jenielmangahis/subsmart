<?php include viewPath('v2/includes/accounting_header'); ?>

<style>
    .nsm-counter.selected, .nsm-counter.co-selected {
        border-bottom: 6px solid rgba(0, 0, 0, 0.35);
    }
</style>

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
                                <div class="nsm-counter primary h-100 mb-2 <?=$transaction === 'estimates' ? 'selected' : ''?>" id="estimates">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($open_estimates)?></h2>
                                            <span>ESTIMATES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter secondary h-100 mb-2 <?=$transaction === 'unbilled-income' ? 'selected' : ''?>" id="unbilled-income">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($unbilledActs)?></h2>
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
                                <div class="nsm-counter error h-100 mb-2 <?=$transaction === 'overdue-invoices' ? 'selected' : ''?><?=$transaction === 'open-invoices' ? 'co-selected' : ''?>" id="overdue-invoices">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($overdue_invoices)?></h2>
                                            <span>OVERDUE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="nsm-counter h-100 mb-2 <?=$transaction === 'open-invoices' ? 'selected' : ''?>" id="open-invoices">
                                    <div class="row h-100">
                                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                            <i class='bx bx-receipt'></i>
                                        </div>
                                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                            <h2 id="total_this_year"><?=count($open_invoices)?></h2>
                                            <span>OPEN INVOICES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="nsm-counter success h-100 mb-2 <?=$transaction === 'recently-paid' ? 'selected' : ''?>" id="recently-paid">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?=count($recent_payments)?></h2>
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
                                    <div class="<?=in_array($type, ['unbilled-income', 'recently-paid']) ? 'col-12' : 'col-5'?>">
                                        <label for="filter-type">Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                            <option value="all-transactions" <?=empty($type) || $type === 'all-transactions' ? 'selected' : ''?>>All transactions</option>
                                            <option value="estimates" <?=$type === 'estimates' ? 'selected' : ''?>>Estimates</option>
                                            <option value="invoices" <?=$type === 'invoices' ? 'selected' : ''?>>Invoices</option>
                                            <option value="sales-receipts" <?=$type === 'sales-receipts' ? 'selected' : ''?>>Sales Receipts</option>
                                            <option value="credit-memos" <?=$type === 'credit-memos' ? 'selected' : ''?>>Credit memos</option>
                                            <option value="unbilled-income" <?=$type === 'unbilled-income' ? 'selected' : ''?>>Unbilled income</option>
                                            <option value="recently-paid" <?=$type === 'recently-paid' ? 'selected' : ''?>>Recently paid</option>
                                            <option value="money-received" <?=$type === 'money-received' ? 'selected' : ''?>>Money received</option>
                                            <option value="statements" <?=$type === 'statements' ? 'selected' : ''?>>Statements</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if(!in_array($type, ['unbilled-income', 'recently-paid', 'statements'])) : ?>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-status">Status</label>
                                        <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                            <?php switch($type) {
                                                case 'estimates' : ?>
                                                    <option value="all-statuses" <?=empty($status) || $status === 'all-statuses' ? 'selected' : ''?>>All statuses</option>
                                                    <option value="open" <?=$status === 'open' ? 'selected' : ''?>>Open</option>
                                                    <option value="closed" <?=$status === 'closed' ? 'selected' : ''?>>Closed</option>
                                                    <option value="draft" <?=$status === 'draft' ? 'selected' : ''?>>Draft</option>
                                                    <option value="submitted" <?=$status === 'submitted' ? 'selected' : ''?>>Submitted</option>
                                                    <option value="accepted" <?=$status === 'accepted' ? 'selected' : ''?>>Accepted</option>
                                                    <option value="invoiced" <?=$status === 'invoiced' ? 'selected' : ''?>>Invoiced</option>
                                                    <option value="lost" <?=$status === 'lost' ? 'selected' : ''?>>Lost</option>
                                                    <option value="declined-by-customer" <?=$status === 'declined-by-customer' ? 'selected' : ''?>>Declined By Customer</option>
                                                    <option value="expired" <?=$status === 'expired' ? 'selected' : ''?>>Expired</option>
                                                <?php break;
                                                case 'invoices' : ?>
                                                    <option value="all-statuses" <?=empty($status) || $status === 'all-statuses' ? 'selected' : ''?>>All statuses</option>
                                                    <option value="open" <?=$status === 'open' ? 'selected' : ''?>>Open</option>
                                                    <option value="overdue" <?=$status === 'overdue' ? 'selected' : ''?>>Overdue</option>
                                                    <option value="paid" <?=$status === 'paid' ? 'selected' : ''?>>Paid</option>
                                                <?php break;
                                                case 'sales-receipts' :
                                                    echo '<option value="all-statuses" selected>All statuses</option>';
                                                break;
                                                case 'credit-memos' :
                                                    echo '<option value="all-statuses" selected>All statuses</option>';
                                                break;
                                                case 'money-received' :
                                                    echo '<option value="all-statuses" selected>All statuses</option>';
                                                break;
                                                default : ?>
                                                    <option value="all-statuses" <?=empty($status) || $status === 'all-statuses' ? 'selected' : ''?>>All statuses</option>
                                                    <option value="open" <?=$status === 'open' ? 'selected' : ''?>>Open</option>
                                                    <option value="overdue" <?=$status === 'overdue' ? 'selected' : ''?>>Overdue</option>
                                                    <option value="closed" <?=$status === 'closed' ? 'selected' : ''?>>Closed</option>
                                                    <option value="paid" <?=$status === 'paid' ? 'selected' : ''?>>Paid</option>
                                                    <option value="accepted" <?=$status === 'accepted' ? 'selected' : ''?>>Accepted</option>
                                                    <option value="draft" <?=$status === 'draft' ? 'selected' : ''?>>Draft</option>
                                                    <option value="submitted" <?=$status === 'submitted' ? 'selected' : ''?>>Submitted</option>
                                                    <option value="invoiced" <?=$status === 'invoiced' ? 'selected' : ''?>>Invoiced</option>
                                                    <option value="lost" <?=$status === 'lost' ? 'selected' : ''?>>Lost</option>
                                                    <option value="declined-by-customer" <?=$status === 'declined-by-customer' ? 'selected' : ''?>>Declined By Customer</option>
                                                    <option value="expired" <?=$status === 'expired' ? 'selected' : ''?>>Expired</option>
                                                <?php break;
                                            } ?>
                                        </select>
                                    </div>
                                    <?php if($type !== 'money-received') : ?>
                                    <div class="col-3">
                                        <label for="filter-delivery-method">Delivery method</label>
                                        <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                                            <option value="any" <?=empty($delivery_method) || $delivery_method === 'any' ? 'selected' : ''?>>Any</option>
                                            <option value="print-later" <?=$delivery_method === 'print-later' ? 'selected' : ''?>>Print later</option>
                                            <option value="send-later" <?=$delivery_method === 'send-later' ? 'selected' : ''?>>Send later</option>
                                        </select>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php endif; ?>
                                <?php if(!in_array($type, ['unbilled-income', 'recently-paid'])) : ?>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="filter-date">Date</label>
                                        <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                            <option value="last-365-days" <?=empty($date) || $date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                            <option value="custom" <?=$date === 'custom' ? 'selected' : ''?>>Custom</option>
                                            <option value="today" <?=$date === 'today' ? 'selected' : ''?>>Today</option>
                                            <option value="yesterday" <?=$date === 'yesterday' ? 'selected' : ''?>>Yesterday</option>
                                            <option value="this-week" <?=$date === 'this-week' ? 'selected' : ''?>>This week</option>
                                            <option value="this-month" <?=$date === 'this-month' ? 'selected' : ''?>>This month</option>
                                            <option value="this-quarter" <?=$date === 'this-quarter' ? 'selected' : ''?>>This quarter</option>
                                            <option value="this-year" <?=$date === 'this-year' ? 'selected' : ''?>>This year</option>
                                            <option value="last-week" <?=$date === 'last-week' ? 'selected' : ''?>>Last week</option>
                                            <option value="last-month" <?=$date === 'last-month' ? 'selected' : ''?>>Last month</option>
                                            <option value="last-quarter" <?=$date === 'last-quarter' ? 'selected' : ''?>>Last quarter</option>
                                            <option value="last-year" <?=$date === 'last-year' ? 'selected' : ''?>>Last year</option>
                                            <option value="all-dates" <?=$date === 'all-dates' ? 'selected' : ''?>>All dates</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-from">From</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" value="<?=empty($from_date) ? date("m/d/Y", strtotime("-1 year")) : $from_date?>" id="filter-from">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label for="filter-to">To</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" class="nsm-field form-control date" id="filter-to" value="<?=empty($to_date) ? '' : $to_date?>">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($type === 'unbilled-income') : ?>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-as-of">Unbilled Income As Of</label>
                                        <div class="nsm-field-group calendar">
                                            <input type="text" name="filter_as_of_date" id="filter-as-of" class="form-control nsm-field date" value="<?=date("m/d/Y", strtotime($date))?>">
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($type !== 'unbilled-income') : ?>
                                <div class="row">
                                    <div class="<?=$type === 'recently-paid' ? 'col-12' : 'col-5'?>">
                                        <label for="filter-customer">Customer</label>
                                        <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                                            <?php if(empty($customer)) : ?>
                                                <option value="all" selected="selected">All</option>
                                            <?php else : ?>
                                                <option value="<?=$customer->id?>"><?=$customer->name?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="nsm-button primary float-end" id="apply-button">
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
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-standard-estimate">Standard Estimate</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-options-estimate">Options Estimate</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-bundle-estimate">Bundle Estimate</a></li>
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
                                <?php foreach($settingsCols as $settingsCol) : ?>
                                <?=$settingsCol?>
                                <?php endforeach; ?>
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
                <table class="nsm-table" id="transactions-table">
                    <thead>
                        <tr>
                            <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td>
                            <?php foreach($headers as $header) : ?>
                            <?=$header?>
                            <?php endforeach; ?>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
						<?php foreach($transactions as $transaction) : ?>
                        <?php switch($type) {
                        case 'estimates' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['expiration_date']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['last_delivered']?></td>
                            <td><?=$transaction['email']?></td>
                            <td><?=$transaction['accepted_date']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        case 'invoices' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['due_date']?></td>
                            <td><?=$transaction['aging']?></td>
                            <td><?=$transaction['balance']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['last_delivered']?></td>
                            <td><?=$transaction['email']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        case 'sales-receipts' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['method']?></td>
                            <td><?=$transaction['source']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['due_date']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['last_delivered']?></td>
                            <td><?=$transaction['email']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        case 'credit-memos' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['last_delivered']?></td>
                            <td><?=$transaction['email']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        case 'unbilled-income' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['charges']?></td>
                            <td><?=$transaction['time']?></td>
                            <td><?=$transaction['expenses']?></td>
                            <td><?=$transaction['credits']?></td>
                            <td><?=$transaction['unbilled_amount']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        case 'recently-paid' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['method']?></td>
                            <td><?=$transaction['source']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['due_date']?></td>
                            <td><?=$transaction['aging']?></td>
                            <td><?=$transaction['balance']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['last_delivered']?></td>
                            <td><?=$transaction['email']?></td>
                            <td><?=$transaction['latest_payment']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        case 'money-received' : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        default : ?>
                        <tr>
                            <td>
                                <div class="table-row-icon table-checkbox">
                                    <input class="form-check-input select-one table-select" type="checkbox" value="<?=$transaction['id']?>">
                                </div>
                            </td>
                            <td><?=$transaction['date']?></td>
                            <td><?=$transaction['type']?></td>
                            <td><?=$transaction['no']?></td>
                            <td><?=$transaction['customer']?></td>
                            <td><?=$transaction['method']?></td>
                            <td><?=$transaction['source']?></td>
                            <td><?=$transaction['memo']?></td>
                            <td><?=$transaction['due_date']?></td>
                            <td><?=$transaction['aging']?></td>
                            <td><?=$transaction['balance']?></td>
                            <td><?=$transaction['total']?></td>
                            <td><?=$transaction['last_delivered']?></td>
                            <td><?=$transaction['email']?></td>
                            <td><?=$transaction['attachments']?></td>
                            <td><?=$transaction['status']?></td>
                            <td><?=$transaction['po_number']?></td>
                            <td><?=$transaction['sales_rep']?></td>
                            <td><?=$transaction['manage']?></td>
                        </tr>
                        <?php break;
                        } ?>
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