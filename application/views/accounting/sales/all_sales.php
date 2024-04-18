<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/all_sales_modals'); ?>

<style>
    .nsm-counter.selected,
    .nsm-counter.co-selected {
        border-bottom: 6px solid rgba(0, 0, 0, 0.35);
    }

    .nsm-counter-container {
        cursor: pointer;
    }

    @media screen and (min-width: 767px) and (max-width: 1600px) {
        #transactions-table {
            width: 2000px
        }
    }
</style>

<!-- page_all_sales  -->
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
                            The Sales page gives you a great at-a-glance view of the status of sales transactions, open
                            invoices, and paid invoices.
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2 <?php echo $transaction === 'estimates' ? 'selected' : ''; ?>" id="estimates">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo count($open_estimates); ?></h2>
                                    <span>ESTIMATES</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter secondary h-100 mb-2 <?php echo $transaction === 'unbilled-income' ? 'selected' : ''; ?>" id="unbilled-income">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo count($unbilledActs); ?></h2>
                                    <span>UNBILLED ACTIVITY</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter error h-100 mb-2 <?php echo $transaction === 'overdue-invoices' ? 'selected' : ''; ?>" id="overdue-invoices">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo count($overdue_invoices); ?></h2>
                                    <span>OVERDUE</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter h-100 mb-2 <?php echo $transaction === 'open-invoices' ? 'selected' : ''; ?>" id="open-invoices">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo count($open_invoices); ?></h2>
                                    <span>OPEN INVOICES</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter success h-100 mb-2 <?php echo $transaction === 'recently-paid' ? 'selected' : ''; ?>" id="recently-paid">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo count($recent_payments); ?></h2>
                                    <span>PAID LAST 30 DAYS</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $total_sales = count($open_estimates) + count($unbilledActs) + count($overdue_invoices) + count($open_invoices) + count($recent_payments);
                    ?>
                    <div class="col-12 col-md-6">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col d-flex justify-content-center align-items-center">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2 id="total_this_year"><?php echo $total_sales; ?></h2>
                                    <span>TOTAL SALES</span>
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
                                <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-transactions">Send transactions</a></li>
                                <!-- <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-reminders">Send reminders</a></li> -->
                            </ul>
                        </div>

                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown" id="filter_button">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-filter p-3" style="width: max-content" id="filter_dropdown_body">
                                <section id="filter_contents" style="width:<?php echo $type === 'unbilled-income' ? '642px' : 'auto';  ?>">
                                    <div class="row">
                                        <div class="col-6" id="type_filter">
                                            <label for=" filter-type">Type</label>
                                            <select class="nsm-field form-select" name="filter_type" id="filter-type">
                                                <option value="all-transactions" <?php echo empty($type) || $type === 'all-transactions' ? 'selected' : ''; ?>>
                                                    All
                                                    transactions</option>
                                                <option value="estimates" <?php echo $type === 'estimates' ? 'selected' : ''; ?>>
                                                    Estimates</option>
                                                <option value="invoices" <?php echo $type === 'invoices' ? 'selected' : ''; ?>>
                                                    Invoices</option>
                                                <option value="sales-receipts" <?php echo $type === 'sales-receipts' ? 'selected' : ''; ?>>Sales
                                                    Receipts
                                                </option>
                                                <option value="credit-memos" <?php echo $type === 'credit-memos' ? 'selected' : ''; ?>>Credit memos
                                                </option>
                                                <option value="unbilled-income" <?php echo $type === 'unbilled-income' ? 'selected' : ''; ?>>Unbilled
                                                    income
                                                </option>
                                                <option value="recently-paid" <?php echo $type === 'recently-paid' ? 'selected' : ''; ?>>Recently paid
                                                </option>
                                                <option value="money-received" <?php echo $type === 'money-received' ? 'selected' : ''; ?>>Money
                                                    received
                                                </option>
                                                <option value="statements" <?php echo $type === 'statements' ? 'selected' : ''; ?>>
                                                    Statements</option>
                                            </select>
                                        </div>

                                        <div id="customer_filter" class="<?php echo $type === 'recently-paid' ? 'col-6' : 'col-6'; ?>" style="display:<?php echo $type !== 'unbilled-income' ? 'block' : 'none'; ?>">
                                            <label for="filter-customer">Customer</label>
                                            <select class="nsm-field form-select" name="filter_customer" id="filter-customer">
                                                <?php if (empty($customer)) { ?>
                                                    <option value="all" selected="selected">All</option>
                                                <?php } else { ?>
                                                    <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="col-6" id="status-filter-container" style="display:<?php echo in_array($type, ['unbilled-income', 'sales-receipt', 'credit-memos', 'money-received']) ?  'none' : 'block';  ?>">
                                            <label for="filter-status">Status</label>
                                            <select class="nsm-field form-select" name="filter_status" id="filter-status">
                                                <?php switch ($type) {
                                                    case 'estimates': ?>
                                                        <option value="all-statuses" <?php echo empty($status) || $status === 'all-statuses' ? 'selected' : ''; ?>>
                                                            All
                                                            statuses</option>
                                                        <option value="open" <?php echo $status === 'open' ? 'selected' : ''; ?>>
                                                            Open</option>
                                                        <option value="closed" <?php echo $status === 'closed' ? 'selected' : ''; ?>>
                                                            Closed
                                                        </option>
                                                        <option value="draft" <?php echo $status === 'draft' ? 'selected' : ''; ?>>
                                                            Draft
                                                        </option>
                                                        <option value="submitted" <?php echo $status === 'submitted' ? 'selected' : ''; ?>>
                                                            Submitted</option>
                                                        <option value="accepted" <?php echo $status === 'accepted' ? 'selected' : ''; ?>>
                                                            Accepted</option>
                                                        <option value="invoiced" <?php echo $status === 'invoiced' ? 'selected' : ''; ?>>
                                                            Invoiced</option>
                                                        <option value="lost" <?php echo $status === 'lost' ? 'selected' : ''; ?>>
                                                            Lost</option>
                                                        <option value="declined-by-customer" <?php echo $status === 'declined-by-customer' ? 'selected' : ''; ?>>
                                                            Declined By
                                                            Customer</option>
                                                        <option value="expired" <?php echo $status === 'expired' ? 'selected' : ''; ?>>
                                                            Expired
                                                        </option>
                                                    <?php break;
                                                    case 'invoices': ?>
                                                        <option value="all-statuses" <?php echo empty($status) || $status === 'all-statuses' ? 'selected' : ''; ?>>
                                                            All
                                                            statuses</option>
                                                        <option value="open" <?php echo $status === 'open' ? 'selected' : ''; ?>>
                                                            Open</option>
                                                        <option value="overdue" <?php echo $status === 'overdue' ? 'selected' : ''; ?>>
                                                            Overdue
                                                        </option>
                                                        <option value="draft" <?php echo $status === 'draft' ? 'selected' : ''; ?>>
                                                            Draft
                                                        </option>
                                                        <option value="paid" <?php echo $status === 'paid' ? 'selected' : ''; ?>>
                                                            Paid</option>
                                                    <?php break;
                                                    case 'sales-receipts':
                                                        echo '<option value="all-statuses" selected>All statuses</option>';
                                                        break;
                                                    case 'credit-memos':
                                                        echo '<option value="all-statuses" selected>All statuses</option>';
                                                        break;
                                                    case 'money-received':
                                                        echo '<option value="all-statuses" selected>All statuses</option>';
                                                        break;
                                                    default: ?>
                                                        <option value="all-statuses" <?php echo empty($status) || $status === 'all-statuses' ? 'selected' : ''; ?>>
                                                            All
                                                            statuses</option>
                                                        <option value="open" <?php echo $status === 'open' ? 'selected' : ''; ?>>
                                                            Open</option>
                                                        <option value="overdue" <?php echo $status === 'overdue' ? 'selected' : ''; ?>>
                                                            Overdue
                                                        </option>
                                                        <option value="closed" <?php echo $status === 'closed' ? 'selected' : ''; ?>>
                                                            Closed
                                                        </option>
                                                        <option value="paid" <?php echo $status === 'paid' ? 'selected' : ''; ?>>
                                                            Paid</option>
                                                        <option value="accepted" <?php echo $status === 'accepted' ? 'selected' : ''; ?>>
                                                            Accepted</option>
                                                        <option value="draft" <?php echo $status === 'draft' ? 'selected' : ''; ?>>
                                                            Draft
                                                        </option>
                                                        <option value="submitted" <?php echo $status === 'submitted' ? 'selected' : ''; ?>>
                                                            Submitted</option>
                                                        <option value="invoiced" <?php echo $status === 'invoiced' ? 'selected' : ''; ?>>
                                                            Invoiced</option>
                                                        <option value="lost" <?php echo $status === 'lost' ? 'selected' : ''; ?>>
                                                            Lost</option>
                                                        <option value="declined-by-customer" <?php echo $status === 'declined-by-customer' ? 'selected' : ''; ?>>
                                                            Declined By
                                                            Customer</option>
                                                        <option value="expired" <?php echo $status === 'expired' ? 'selected' : ''; ?>>
                                                            Expired
                                                        </option>
                                                <?php break;
                                                } ?>
                                            </select>
                                        </div>

                                        <div class="<?php echo in_array($type, ['sales-receipt', 'credit-memos', 'money-received']) ?  'col-12' : 'col-6';  ?>" id="delivery-filter-container" style="display:<?php echo $type !== 'money-received' ? 'block' : 'none' ?>">
                                            <label for="filter-delivery-method">Delivery method</label>
                                            <select class="nsm-field form-select" name="filter_delivery_method" id="filter-delivery-method">
                                                <option value="any" <?php echo empty($delivery_method) || $delivery_method === 'any' ? 'selected' : ''; ?>>
                                                    Any</option>
                                                <option value="print-later" <?php echo $delivery_method === 'print-later' ? 'selected' : ''; ?>>
                                                    Print later
                                                </option>
                                                <option value="send-later" <?php echo $delivery_method === 'send-later' ? 'selected' : ''; ?>>Send
                                                    later
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row" id="date_filter" style="display:<?php echo in_array($type, ['unbilled-income', 'recently-paid']) ? 'none' : 'flex'; ?>">
                                        <div class="col-4">
                                            <label for="filter-date">Date</label>
                                            <select class="nsm-field form-select" name="filter_date" id="filter-date">
                                                <option value="last-365-days" <?php echo empty($date) || $date === 'last-365-days' ? 'selected' : ''; ?>>
                                                    Last
                                                    365 days</option>
                                                <option value="custom" <?php echo $date === 'custom' ? 'selected' : ''; ?>>
                                                    Custom
                                                </option>
                                                <option value="today" <?php echo $date === 'today' ? 'selected' : ''; ?>>
                                                    Today
                                                </option>
                                                <option value="yesterday" <?php echo $date === 'yesterday' ? 'selected' : ''; ?>>
                                                    Yesterday</option>
                                                <option value="this-week" <?php echo $date === 'this-week' ? 'selected' : ''; ?>>This
                                                    week</option>
                                                <option value="this-month" <?php echo $date === 'this-month' ? 'selected' : ''; ?>>
                                                    This month</option>
                                                <option value="this-quarter" <?php echo $date === 'this-quarter' ? 'selected' : ''; ?>>This quarter
                                                </option>
                                                <option value="this-year" <?php echo $date === 'this-year' ? 'selected' : ''; ?>>This
                                                    year</option>
                                                <option value="last-week" <?php echo $date === 'last-week' ? 'selected' : ''; ?>>Last
                                                    week</option>
                                                <option value="last-month" <?php echo $date === 'last-month' ? 'selected' : ''; ?>>
                                                    Last month</option>
                                                <option value="last-quarter" <?php echo $date === 'last-quarter' ? 'selected' : ''; ?>>Last quarter
                                                </option>
                                                <option value="last-year" <?php echo $date === 'last-year' ? 'selected' : ''; ?>>Last
                                                    year</option>
                                                <option value="all-dates" <?php echo $date === 'all-dates' ? 'selected' : ''; ?>>All
                                                    dates</option>
                                            </select>
                                        </div>
                                        <div class="col-4">
                                            <label for="filter-from">From</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" class="nsm-field form-control date" value="<?php echo empty($from_date) ? date('m/d/Y', strtotime('-1 year')) : $from_date; ?>" id="filter-from">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="filter-to">To</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" class="nsm-field form-control date" id="filter-to" value="<?php echo empty($to_date) ? '' : $to_date; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="unbilled_income" style="display:<?php echo $type === 'unbilled-income' ? 'block' : 'none';  ?>">

                                        <div class="col-12">
                                            <label for="filter-as-of">Unbilled Income As Of</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" name="filter_as_of_date" id="filter-as-of" class="form-control nsm-field date" value="<?php echo date('m/d/Y', strtotime($date)); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <div class="row mt-3 " id="filter_buttons">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6 ">
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
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-invoice">Invoice</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-payment">Payment</a>
                                </li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-standard-estimate">Standard Estimate</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-options-estimate">Options Estimate</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-bundle-estimate">Bundle
                                        Estimate</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-sales-receipt">Sales
                                        Receipt</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-credit-memo">Credit
                                        Memo</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-delayed-charge">Delayed
                                        Charge</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="new-time-activity">Time
                                        Activity</a></li>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button export-transactions">
                                <i class='bx bx-fw bx-export'></i> Export
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_all_sales_transactions_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                <p class="m-0">Columns</p>
                                <?php foreach ($settingsCols as $settingsCol) { ?>
                                    <?php echo $settingsCol; ?>
                                <?php } ?>
                                <p class="m-0">Rows</p>
                                <div class="dropdown d-inline-block">
                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                        <span>
                                            10
                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" id="table-rows">
                                        <li><a class="dropdown-item active" href="javascript:void(0);">10</a></li>
                                        <li><a class="dropdown-item " href="javascript:void(0);">50</a></li>
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
                <div style="overflow-x: auto; width: 100%;">
                    <table class="nsm-table" id="transactions-table">
                        <thead>
                            <tr>
                                <td class="table-icon text-center">
                                    <input class="form-check-input select-all table-select" type="checkbox">
                                </td>
                                <?php foreach ($headers as $header) { ?>
                                    <?php if ($header !== 'Attachments') { ?>
                                        <td data-name="<?php echo $header; ?>"><?php echo strtoupper($header); ?></td>
                                    <?php } else { ?>
                                        <td class="table-icon text-center" data-name="<?php echo $header; ?>"><i class="bx bx-paperclip"></i>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <td data-name="Manage"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($transactions) > 0) { ?>
                                <?php foreach ($transactions as $transaction) { ?>
                                    <?php switch ($type) {
                                        case 'estimates': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['expiration_date'])) {
                                                        echo $transaction['expiration_date'];
                                                    } else {
                                                        echo 'No due date provided';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['last_delivered']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['email'])) {
                                                        echo $transaction['email'];
                                                    } else {
                                                        echo 'No email provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['accepted_date']; 
                                                            ?></td> -->
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        case 'invoices': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['due_date'])) {
                                                        echo $transaction['due_date'];
                                                    } else {
                                                        echo 'No due date set';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['aging']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (isset($transaction['balance'])) {
                                                        echo $transaction['balance'];
                                                    } else {
                                                        echo 'No balance available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['last_delivered']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['email'])) {
                                                        echo $transaction['email'];
                                                    } else {
                                                        echo 'No email provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        case 'sales-receipts': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['method']; 
                                                            ?></td> -->
                                                <!-- <td><?php //echo $transaction['source']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['due_date'])) {
                                                        echo $transaction['due_date'];
                                                    } else {
                                                        echo 'No due date set';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['last_delivered']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['email'])) {
                                                        echo $transaction['email'];
                                                    } else {
                                                        echo 'No email provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        case 'credit-memos': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['last_delivered']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['email'])) {
                                                        echo $transaction['email'];
                                                    } else {
                                                        echo 'No email provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        case 'unbilled-income': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['charges'])) {
                                                        echo $transaction['charges'];
                                                    } else {
                                                        echo 'No charges';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['time'])) {
                                                        echo $transaction['time'];
                                                    } else {
                                                        echo 'Time not set';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['expenses'])) {
                                                        echo $transaction['expenses'];
                                                    } else {
                                                        echo 'No expenses available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['credits'])) {
                                                        echo $transaction['credits'];
                                                    } else {
                                                        echo 'No credits available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['unbilled_amount'])) {
                                                        echo $transaction['unbilled_amount'];
                                                    } else {
                                                        echo 'No unbilled ammount';
                                                    }
                                                    ?>
                                                </td>

                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        case 'recently-paid': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['method']; 
                                                            ?></td> -->
                                                <!-- <td><?php //echo $transaction['source']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['due_date'])) {
                                                        echo $transaction['due_date'];
                                                    } else {
                                                        echo 'No due date set';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['aging']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['balance'])) {
                                                        echo $transaction['balance'];
                                                    } else {
                                                        echo 'No balance available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td> <!-- <td><?php //echo $transaction['last_delivered']; 
                                                                ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['email'])) {
                                                        echo $transaction['email'];
                                                    } else {
                                                        echo 'No email provided';
                                                    }
                                                    ?>
                                                </td>
                                                <td> <?php
                                                        if (!empty($transaction['latest_payment'])) {
                                                            echo $transaction['latest_payment'];
                                                        } else {
                                                            echo 'No latest payment available';
                                                        }
                                                        ?></td>
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        case 'money-received': ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                        <?php break;
                                        default: ?>
                                            <tr>
                                                <td>
                                                    <div class="table-row-icon table-checkbox">
                                                        <input class="form-check-input select-one table-select" type="checkbox" value="<?php echo $transaction['id']; ?>">
                                                    </div>
                                                </td>
                                                <td style="width: 6%">
                                                    <?php
                                                    if (!empty($transaction['date'])) {
                                                        echo $transaction['date'];
                                                    } else {
                                                        echo 'No date available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['type'])) {
                                                        echo $transaction['type'];
                                                    } else {
                                                        echo 'No type available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['no'])) {
                                                        echo $transaction['no'];
                                                    } else {
                                                        echo 'No number available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['customer']) && trim($transaction['customer']) != '') {
                                                        echo $transaction['customer'];
                                                    } else {
                                                        echo 'No customer';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['method']; 
                                                            ?></td> -->
                                                <!-- <td><?php //echo $transaction['source']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['memo'])) {
                                                        echo $transaction['memo'];
                                                    } else {
                                                        echo 'No memo available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['due_date'])) {
                                                        echo $transaction['due_date'];
                                                    } else {
                                                        echo 'No due date set';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['aging']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['balance'])) {
                                                        echo $transaction['balance'];
                                                    } else {
                                                        echo 'No balance available';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['total'])) {
                                                        echo $transaction['total'];
                                                    } else {
                                                        echo 'No total available';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['last_delivered']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['email'])) {
                                                        echo $transaction['email'];
                                                    } else {
                                                        echo 'No email provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['attachments']; 
                                                            ?></td> -->
                                                <td>
                                                    <?php
                                                    if (!empty($transaction['status'])) {
                                                        echo $transaction['status'];
                                                    } else {
                                                        echo 'No status provided';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td><?php //echo $transaction['po_number']; 
                                                            ?></td>
                                            <td><?php //echo $transaction['sales_rep']; 
                                                ?></td> -->
                                                <td><?php echo $transaction['manage']; ?></td>
                                            </tr>
                                    <?php break;
                                    } ?>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="19">
                                        <div class="nsm-empty">
                                            <span>No results found.</span>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?php echo $company->business_name; ?>";
</script>
<script>
    $(document).ready(function() {
        $("#transactions-table").nsmPagination({
            itemsPerPage: 10,
        });

        function updateRowsPerPage(numRows) {
            $("#transactions-table").nsmPagination({
                itemsPerPage: numRows
            });
            $("#transactions-table tbody tr").hide();
            $("#transactions-table tbody tr").slice(0, numRows).show();
        }

        document.getElementById("table-rows").querySelectorAll(".dropdown-item").forEach(function(item) {
            item.addEventListener("click", function() {
                var numRows = parseInt(this.textContent);
                updateRowsPerPage(numRows);
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>