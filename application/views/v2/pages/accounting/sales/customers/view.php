<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/view_customer_modals'); ?>

<style>
    .notes-container {
        border-radius: 5px;
        border: 1px solid transparent;
    }
    .notes-container:hover {
        border-color: #dee2e6;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/sales'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <h3 class="m-0">
                                            <span id="customer-business-name"><?=$customer->business_name === '' ? $customer->first_name.' '.$customer->last_name : $customer->business_name?></span>
                                            <?php if($customer->email !== "" && $customer->email !== null) : ?>
                                            <small><a href="mailto: <?=$customer->email?>" class="text-muted"><i class="fa fa-envelope-o"></i></a></small>
                                            <?php endif; ?>
                                        </h3>
                                        <p><?=$vendorAddress?></p>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                <span>Actions</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item edit-customer">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="make-inactive" customer-id="<?php echo $customer->prof_id; ?>">Make inactive</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="merge-contacts">Merge contacts</a>
                                                </li>
                                            </ul>

                                            <button type="button" class="dropdown-toggle nsm-button primary" data-bs-toggle="dropdown">
                                                <span>New transaction</span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-invoice">Invoice</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-payment">Payment</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-standard-estimate">Standard Estimate</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-options-estimate">Options Estimate</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-bundle-estimate">Bundle Estimate</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-payment-link">Payment Link</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-sales-receipt">Sales Receipt</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-credit-memo">Credit Memo</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-delayed-charge">Delayed Charge</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-time-activity">Time Activity</a>
                                                </li>
                                                <li>
                                                    <a href="#" class="dropdown-item" id="new-statement">Statement</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="cursor-pointer p-3 h-100 notes-container">
                                            <?=$customer->notes !== null && $customer->notes !== "" ? $customer->notes : "<i>No notes available. Please click to add note</i>"?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 offset-md-6 grid-mb">
                                        <div class="float-end">
                                            <div>
                                                <h4 class="m-0"><span id="total-open-pay"><?=str_replace('$-', '-$', '$'.number_format($openBalance, 2, '.', ','))?></span></h4>
                                                <p class="m-0">OPEN</p>
                                            </div>
                                            <div>
                                                <h4 class="m-0"><span id="total-open-pay"><?=str_replace('$-', '-$', '$'.number_format($overdueBalance, 2, '.', ','))?></span></h4>
                                                <p class="m-0">OVERDUE</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="nsm-card primary overflow-visible">
                            <div class="nsm-card-content">
                                <div class="nsm-tab">
                                    <nav>
                                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                            <button class="nav-link" id="nav-transaction-tab" data-bs-toggle="tab" data-bs-target="#nav-transaction" type="button" role="tab" aria-controls="nav-transaction" aria-selected="false">
                                                Transaction List
                                            </button>
                                            <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="true">
                                                Customer Details
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="nav-transaction" role="tabpanel" aria-labelledby="nav-transaction-tab">
                                            <div class="row g-2">
                                                <div class="col-12 grid-mb text-end">
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
                                                            <li><a class="dropdown-item disabled" href="javascript:void(0);" id="send-reminders">Send reminders</a></li>
                                                        </ul>
                                                    </div>

                                                    <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                            <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end p-3" style="width: max-content">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label for="filter-type">Type</label>
                                                                    <select class="nsm-field form-select" name="filter_type" id="filter-type" data-applied="<?=empty($type) ? 'all' : $type?>">
                                                                        <option value="all" <?=empty($type) || $type === 'all' ? 'selected' : ''?>>All transactions</option>
                                                                        <option value="all-plus-deposits" <?=$type === 'all-plus-deposits' ? 'selected' : ''?>>All plus deposits</option>
                                                                        <option value="all-invoices" <?=$type === 'all-invoices' ? 'selected' : ''?>>All invoices</option>
                                                                        <option value="open-invoices" <?=$type === 'open-invoices' ? 'selected' : ''?>>Open invoices</option>
                                                                        <option value="overdue-invoices" <?=$type === 'overdue-invoices' ? 'selected' : ''?>>Overdue invoices</option>
                                                                        <option value="open-estimates" <?=$type === 'open-estimates' ? 'selected' : ''?>>Open estimates</option>
                                                                        <option value="credit-memos" <?=$type === 'credit-memos' ? 'selected' : ''?>>Credit memos</option>
                                                                        <option value="unbilled-income" <?=$type === 'unbilled-income' ? 'selected' : ''?>>Unbilled income</option>
                                                                        <option value="recently-paid" <?=$type === 'recently-paid' ? 'selected' : ''?>>Recently paid</option>
                                                                        <option value="money-received" <?=$type === 'money-received' ? 'selected' : ''?>>Money received</option>
                                                                        <option value="recurring-templates" <?=$type === 'recurring-templates' ? 'selected' : ''?>>Recurring templates</option>
                                                                        <option value="statements" <?=$type === 'statements' ? 'selected' : ''?>>Statements</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <?php if(!in_array($type, ['recently-paid', 'recurring-templates'])) : ?>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <?php if($type === 'unbilled-income') : ?>
                                                                    <label for="filter-as-of">Unbilled Income As Of</label>
                                                                    <div class="nsm-field-group calendar">
                                                                        <input type="text" name="filter_as_of_date" id="filter-as-of" class="form-control nsm-field date" value="<?=str_replace('-', '/', $date)?>" data-applied="<?=str_replace('-', '/', $date)?>">
                                                                    </div>
                                                                    <?php else : ?>
                                                                    <label for="filter-date">Date</label>
                                                                    <select class="nsm-field form-select" name="filter_date" id="filter-date" data-applied="<?=empty($date) ? 'all' : $date?>">
                                                                        <option value="all" <?=empty($date) || $date === 'all' ? 'selected' : ''?>>All dates</option>
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
                                                                        <option value="last-365-days" <?=$date === 'last-365-days' ? 'selected' : ''?>>Last 365 days</option>
                                                                    </select>
                                                                    <?php endif; ?>
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

                                                        <button type="button" class="nsm-button export-transactions">
                                                            <i class='bx bx-fw bx-export'></i> Export
                                                        </button>
                                                        <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_customer_transactions_modal">
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
                                                            <?php if($type !== 'recurring-templates' && $type !== 'unbilled-income') : ?>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_po_number" class="form-check-input">
                                                                <label for="chk_po_number" class="form-check-label">P.O. Number</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="checkbox" checked="checked" name="col_chk" id="chk_sales_rep" class="form-check-input">
                                                                <label for="chk_sales_rep" class="form-check-label">Sales Rep</label>
                                                            </div>
                                                            <?php endif; ?>
                                                            <p class="m-0">Rows</p>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="compact" id="compact" class="form-check-input">
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
                                                        <?php if($header !== 'Attachments') : ?>
                                                        <td data-name="<?=$header?>"><?=strtoupper($header)?></td>
                                                        <?php else : ?>
                                                        <td class="table-icon text-center" data-name="<?=$header?>"><i class="bx bx-paperclip"></i></td>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(count($transactions) > 0) : ?>
                                                        <?php foreach($transactions as $transaction) : ?>
                                                        <?php switch($type) {
                                                            case 'all-invoices' :
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['due_date'].'</td>
                                                                    <td>'.$transaction['aging'].'</td>
                                                                    <td>'.$transaction['balance'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['last_delivered'].'</td>
                                                                    <td>'.$transaction['email'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>'.$transaction['manage'].'</td>
                                                                </tr>';
                                                            break;
                                                            case 'open-invoices' :
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['due_date'].'</td>
                                                                    <td>'.$transaction['aging'].'</td>
                                                                    <td>'.$transaction['balance'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['last_delivered'].'</td>
                                                                    <td>'.$transaction['email'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>'.$transaction['manage'].'</td>
                                                                </tr>';
                                                            break;
                                                            case 'overdue-invoices' :
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['due_date'].'</td>
                                                                    <td>'.$transaction['aging'].'</td>
                                                                    <td>'.$transaction['balance'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['last_delivered'].'</td>
                                                                    <td>'.$transaction['email'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>'.$transaction['manage'].'</td>
                                                                </tr>';
                                                            break;
                                                            case 'money-received' :
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>'.$transaction['manage'].'</td>
                                                                </tr>';
                                                            break;
                                                            case 'recurring-templates' :
                                                                echo '<tr data-recurring="'.$transaction['recurring_id'].'">
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['name'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['txn_type'].'</td>
                                                                    <td>'.$transaction['interval'].'</td>
                                                                    <td>'.$transaction['previous_date'].'</td>
                                                                    <td>'.$transaction['next_date'].'</td>
                                                                    <td>'.$transaction['amount'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>
                                                                        <div class="dropdown table-management">
                                                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                                <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                                <li>
                                                                                    <a class="dropdown-item edit-recurring-transaction" href="#">Edit</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item use-recurring-transaction" href="#">Use</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a class="dropdown-item delete-recurring-transaction" href="#">Delete</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </td>
                                                                </tr>';
                                                            break;
                                                            case 'unbilled-income' :
                                                                switch($transaction['type']) {
                                                                    case 'Charge' :
                                                                        $tranType = 'delayed-charge';
                                                                    break;
                                                                    case 'Credit' :
                                                                        $tranType = 'delayed-credit';
                                                                    break;
                                                                    case 'Billable Expense Charge' :
                                                                        $tranType = 'billable-expense';
                                                                    break;
                                                                }

                                                                if($transaction['status'] === 'Open') {
                                                                    $manageCol = '<div class="dropdown table-management">
                                                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li>
                                                                                <a class="dropdown-item create-invoice" href="#">Create invoice</a>
                                                                            </li>
                                                                            <li>
                                                                                <a class="dropdown-item view-edit-'.$tranType.'" href="#">View/Edit</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>';
                                                                } else {
                                                                    $manageCol = '<div class="dropdown table-management">
                                                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                                            <i class="bx bx-fw bx-dots-vertical-rounded"></i>
                                                                        </a>
                                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                                            <li>
                                                                                <a class="dropdown-item view-edit-'.$tranType.'" href="#">View/Edit</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>';
                                                                }
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$manageCol.'</td>
                                                                </tr>';
                                                            break;
                                                            case 'recently-paid' :
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['method'].'</td>
                                                                    <td>'.$transaction['source'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['due_date'].'</td>
                                                                    <td>'.$transaction['aging'].'</td>
                                                                    <td>'.$transaction['balance'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['last_delivered'].'</td>
                                                                    <td>'.$transaction['email'].'</td>
                                                                    <td>'.$transaction['latest_payment'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>'.$transaction['manage'].'</td>
                                                                </tr>';
                                                            break;
                                                            default :
                                                                echo '<tr>
                                                                    <td>
                                                                        <div class="table-row-icon table-checkbox">
                                                                            <input class="form-check-input select-one table-select" type="checkbox" value="'.$transaction['id'].'">
                                                                        </div>
                                                                    </td>
                                                                    <td>'.$transaction['date'].'</td>
                                                                    <td>'.$transaction['type'].'</td>
                                                                    <td>'.$transaction['no'].'</td>
                                                                    <td>'.$transaction['customer'].'</td>
                                                                    <td>'.$transaction['method'].'</td>
                                                                    <td>'.$transaction['source'].'</td>
                                                                    <td>'.$transaction['memo'].'</td>
                                                                    <td>'.$transaction['due_date'].'</td>
                                                                    <td>'.$transaction['aging'].'</td>
                                                                    <td>'.$transaction['balance'].'</td>
                                                                    <td>'.$transaction['total'].'</td>
                                                                    <td>'.$transaction['last_delivered'].'</td>
                                                                    <td>'.$transaction['email'].'</td>
                                                                    <td>'.$transaction['attachments'].'</td>
                                                                    <td>'.$transaction['status'].'</td>
                                                                    <td>'.$transaction['po_number'].'</td>
                                                                    <td>'.$transaction['sales_rep'].'</td>
                                                                    <td>'.$transaction['manage'].'</td>
                                                                </tr>';
                                                            break;
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
                                        <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">
                                            <div class="row g-2">
                                                <div class="col-12 grid-mb text-end">
                                                    <!-- <div class="nsm-page-buttons page-button-container">
                                                        <button type="button" class="nsm-button edit-customer">
                                                            <i class='bx bx-fw bx-pencil'></i> Edit
                                                        </button>
                                                    </div> -->
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <table class="nsm-table">
                                                        <tbody>
                                                            <tr style="height: 68px !important;">
                                                                <td class="fw-bold nsm-text-primary">Customer</td>
                                                                <td><?=in_array($customer->business_name, ['', null]) ?  $customer->first_name.' '.$customer->last_name : $customer->business_name?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Email</td>
                                                                <td><span id="customer-email"><?=$customer->email?></span></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Phone</td>
                                                                <td><?= formatPhoneNumber($customer->phone_h) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Mobile</td>
                                                                <td><?= formatPhoneNumber($customer->phone_m) ?></td>
                                                            </tr>
                                                            <!-- 
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Other</td>
                                                                <td></td>
                                                            </tr>
                                                            -->
                                                            <!-- <tr>
                                                                <td class="fw-bold nsm-text-primary">Notes</td>
                                                                <td>
                                                                    <div class="notes-container w-100">
                                                                        <textarea name="notes" class="form-control nsm-field cursor-pointer" disabled><?=$vendorDetails->notes === '' || $vendorDetails->notes === null ? '' : $vendorDetails->notes?></textarea>                              
                                                                    </div>
                                                                </td>
                                                            </tr> -->
                                                        </tbody>
                                                    </table>
                                                    <div class="attachments-container w-75">
                                                        <label for="attachment" style="margin-right: 15px"><i class="fa fa-paperclip"></i>&nbsp;Attachment</label> 
                                                        <span>Maximum size: 20MB</span>
                                                        <div id="previewVendorAttachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                            <div class="dz-message" style="margin: 20px;border">
                                                                <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                                <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="#" id="show-existing-attachments" class="text-decoration-none">Show existing</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <table class="nsm-table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Billing address</td>
                                                                <td>
                                                                    <?php
                                                                        $address = '';
                                                                        $address .= $customer->mail_add !== null ? $customer->mail_add : "";
                                                                        $address .= $customer->city !== null ? '<br />' . $customer->city : "";
                                                                        $address .= $customer->state !== null ? ', ' . $customer->state : "";
                                                                        $address .= $customer->zip_code !== null ? ' ' . $customer->zip_code : "";
                                                                        echo !empty($address) ? $address : 'Not Specified';
                                                                    ?>                                                                    
                                                                </td>
                                                            </tr>
                                                            <!--
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Terms</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Payment method</td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Preferred delivery method</td>
                                                                <td></td>
                                                            </tr>
                                                            -->
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Customer type</td>
                                                                <td><?=$customer->customer_type?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Customer language</td>
                                                                <td>English</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="fw-bold nsm-text-primary">Business Name</td>
                                                                <td><?php echo $customer->business_name; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const companyName = "<?=$company->business_name?>";
</script>
<?php include viewPath('v2/includes/footer'); ?>