<?php include viewPath('v2/includes/accounting_header'); ?>
<?php // include viewPath('v2/includes/accounting/chart_of_accounts_modals'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/tabs/accounting'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/accounting/subtabs/chart_of_accounts_subtabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <h3><?=$type?> Register</h3>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <select name="account" id="account" class="form-select nsm-field">
                                                    <option value="<?=$account->id?>"><?=$account->name?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4 offset-md-4 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button class="nsm-button primary">
                                                Reconcile
                                            </button>
                                        </div>
                                        <p class="m-0">OPEN</p>
                                        <h4 class="m-0"><?=str_replace('$-', '-$', '$'.number_format($balance, 2, '.', ','))?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="nsm-card primary overflow-visible">
                            <div class="nsm-card-content">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="dropdown d-inline-block">
                                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                <span>
                                                    Filter
                                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                                            </button>
                                            <ul class="dropdown-menu p-3 table-filters" style="width: max-content">
                                                <div class="row gy-3">
                                                    <div class="col-12">
                                                        <label for="filter-find">Find</label>
                                                        <input type="text" name="filter_find" id="filter-find" class="form-control nsm-field" placeholder="Memo, Ref no., $amt, >$amt, <$amt" value="<?=!empty($search) ? $search : ''?>">
                                                    </div>
                                                    <?php if($type !== 'A/R') : ?>
                                                    <div class="col-12 col-md-4">
                                                        <label for="filter-reconcile-status">Reconcile Status</label>
                                                        <select name="filter_reconcile_status" id="filter-reconcile-status" class="form-select nsm-field">
                                                            <option value="all" selected>All</option>
                                                            <option value="reconciled">Reconciled</option>
                                                            <option value="cleared">Cleared</option>
                                                            <option value="no-status">No Status</option>
                                                            <option value="not-reconciled">Not Reconciled</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label for="filter-transaction-type">Transaction type</label>
                                                        <select name="filter_transaction_type" id="filter-transaction-type" class="form-select nsm-field">
                                                            <option value="all" selected>All</option>
                                                            <option value="cc-expense">CC Expense</option>
                                                            <option value="check">Check</option>
                                                            <option value="invoice">Invoice</option>
                                                            <option value="receive-payment">Receive payment</option>
                                                            <option value="journal-entry">Journal Entry</option>
                                                            <option value="bill">Bill</option>
                                                            <option value="cc-credit">CC Credit</option>
                                                            <option value="vendor-credit">Vendor Credit</option>
                                                            <option value="bill-payment">Bill Payment</option>
                                                            <option value="cc-bill-payment">CC Bill Payment</option>
                                                            <option value="transfer">Transfer</option>
                                                            <option value="deposit">Deposit</option>
                                                            <option value="cash-expense">Cash Expense</option>
                                                            <option value="sales-receipt">Sales Receipt</option>
                                                            <option value="credit-memo">Credit Memo</option>
                                                            <option value="refund">Refund</option>
                                                            <option value="inv-qty-adjustment">Inventory Quantity Adjustment</option>
                                                            <option value="payroll-check">Payroll Check</option>
                                                            <option value="tax-payment">Tax Payment</option>
                                                            <option value="payroll-adjustment">Payroll Adjustment</option>
                                                            <option value="payroll-refund">Payroll Refund</option>
                                                            <option value="sales-tax-payment">Sales Tax Payment</option>
                                                            <option value="sales-tax-adjustment">Sales Tax Adjustment</option>
                                                            <option value="expense">Expense</option>
                                                            <option value="inv-starting-value">Inventory Starting Value</option>
                                                            <option value="cc-payment">Credit Card Payment</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label for="filter-payee">Payee</label>
                                                        <select name="filter_payee" id="filter-payee"class="form-select nsm-field">
                                                            <option value="all" selected>All</option>
                                                        </select>
                                                    </div>
                                                    <?php endif; ?>
                                                    <div class="col-12 col-md-4">
                                                        <label for="filter-date">Date</label>
                                                        <select name="filter_date" id="filter-date" class="form-select nsm-field">
                                                            <option value="all">All dates</option>
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
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label for="filter-from">From</label>
                                                        <div class="nsm-field-group calendar">
                                                            <input type="text" name="filter_from" id="filter-from" class="form-control nsm-field date">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <label for="filter-to">To</label>
                                                        <div class="nsm-field-group calendar">
                                                            <input type="text" name="filter_to" id="filter-to" class="form-control nsm-field date">
                                                        </div>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 grid-mb text-end">
                                        <div class="nsm-page-buttons page-button-container">
                                            <button type="button" class="nsm-button export-items">
                                                <i class='bx bx-fw bx-export'></i> Export
                                            </button>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_account_transactions_modal">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                                <i class="bx bx-fw bx-cog"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
                                                <p class="m-0">Columns</p>
                                                <?php if($type !== 'A/R' && $type !== 'A/P') : ?>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_memo" class="form-check-input">
                                                    <label for="chk_memo" class="form-check-label">Memo</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_reconcile_status" class="form-check-input">
                                                    <label for="chk_reconcile_status" class="form-check-label">Reconcile Status</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_banking_status" class="form-check-input">
                                                    <label for="chk_banking_status" class="form-check-label">Banking Status</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_attachments" class="form-check-input">
                                                    <label for="chk_attachments" class="form-check-label">Attachments</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_tax" class="form-check-input">
                                                    <label for="chk_tax" class="form-check-label">Tax</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_running_balance" class="form-check-input">
                                                    <label for="chk_running_balance" class="form-check-label">Running Balance</label>
                                                </div>
                                                <?php else : ?>
                                                <div class="form-check">
                                                    <input type="checkbox" checked name="col_chk" id="chk_open_balance" class="form-check-input">
                                                    <label for="chk_open_balance" class="form-check-label">Open Balance</label>
                                                </div>
                                                <?php endif; ?>
                                                <p class="m-0">Other</p>
                                                <div class="form-check">
                                                    <input type="checkbox" checked id="chk_show_in_one_line" class="form-check-input">
                                                    <label for="chk_show_in_one_line" class="form-check-label">Show in one line</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" id="chk_paper_ledger_mode" class="form-check-input">
                                                    <label for="chk_paper_ledger_mode" class="form-check-label">Paper Ledger Mode</label>
                                                </div>
                                                <p class="m-0">Rows</p>
                                                <div class="dropdown d-inline-block">
                                                    <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                                        <span>
                                                            50
                                                        </span> <i class='bx bx-fw bx-chevron-down'></i>
                                                    </button>
                                                    <ul class="dropdown-menu" id="table-rows">
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
                                <table class="nsm-table" id="registers-table">
                                    <thead>
                                        <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                                        <tr>
                                            <td data-name="Date">DATE</td>
                                            <td data-name="Ref No.">REF NO.</td>
                                            <td data-name="Type">TYPE</td>
                                            <td data-name="Payee">PAYEE</td>
                                            <td data-name="Account">ACCOUNT</td>
                                            <td data-name="Memo">MEMO</td>
                                            <?php switch($type) {
                                                case 'Asset' :
                                                    $var1 = 'DECREASE';
                                                    $var2 = 'INCREASE';
                                                break;
                                                case 'Liability' :
                                                    $var1 = 'INCREASE';
                                                    $var2 = 'DECREASE';
                                                break;
                                                case 'Credit Card' :
                                                    $var1 = 'CHARGE';
                                                    $var2 = 'PAYMENT';
                                                break;
                                                default :
                                                    $var1 = 'PAYMENT';
                                                    $var2 = 'DEPOSIT';
                                                break;
                                            } ?>
                                            <td data-name="<?=ucfirst(strtolower($var1))?>"><?=$var1?></td>
                                            <td data-name="<?=ucfirst(strtolower($var2))?>"><?=$var2?></td>
                                            <td data-name="Reconcile Status" class="table-icon text-center">
                                                <i class="bx bx-fw bx-check"></i>
                                            </td>
                                            <td data-name="Banking Status" class="table-icon text-center">
                                                <i class="bx bx-fw bx-copy"></i>
                                            </td>
                                            <td class="table-icon text-center" data-name="Attachments">
                                                <i class='bx bx-fw bx-paperclip'></i>
                                            </td>
                                            <td data-name="Tax">TAX</td>
                                            <td data-name="Balance">BALANCE</td>
                                        </tr>
                                        <?php else : ?>
                                        <tr>
                                            <td data-name="Date">DATE</td>
                                            <td data-name="Ref No.">REF NO.</td>
                                            <td data-name="<?=$type === 'A/R' ? 'Customer' : 'Vendor'?>"><?=$type === 'A/R' ? 'CUSTOMER' : 'VENDOR'?></td>
                                            <?php if($type === 'A/R') : ?>
                                            <td data-name="Memo">MEMO</td>
                                            <?php endif; ?>
                                            <td data-name="Due Date">DUE DATE</td>
                                            <td data-name="<?=$type === 'A/R' ? 'Charge/Credit' : 'Billed'?>"><?=$type === 'A/R' ? 'CHARGE/CREDIT' : 'BILLED'?></td>
                                            <td data-name="<?=$type === 'A/R' ? 'Payment' : 'Paid'?>"><?=$type === 'A/R' ? 'PAYMENT' : 'PAID'?></td>
                                            <td data-name="Open Balance">OPEN BALANCE</td>
                                        </tr>
                                        <?php endif; ?>
                                    </thead>
                                    <tbody>
                                        <?php if(count($registers) > 0) : ?>
                                        <?php foreach($registers as $register) : ?>
                                        <tr>
                                            <td><?=$register['date']?></td>
                                            <td><?=$register['ref_no']?></td>
                                            <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                                            <td><?=$register['type']?></td>
                                            <td><?=$register['payee']?></td>
                                            <td><?=$register['account']?></td>
                                            <?php else : ?>
                                            <td><?=$type === 'A/R' ? $register['customer'] : $register['vendor']?></td>
                                            <?php endif;?>
                                            <?php if($type !== 'A/P') : ?>
                                            <td><?=$register['memo']?></td>
                                            <?php endif; ?>
                                            <?php switch($type) {
                                                case 'Asset' : ?>
                                                <td><?=$register['decrease']?></td>
                                                <td><?=$register['increase']?></td>
                                                <?php break;
                                                case 'Liability' : ?>
                                                <td><?=$register['increase']?></td>
                                                <td><?=$register['decrease']?></td>
                                                <?php break;
                                                case 'Credit Card' : ?>
                                                <td><?=$register['charge']?></td>
                                                <td><?=$register['payment']?></td>
                                                <?php break;
                                                case 'A/R' : ?>
                                                <td><?=$register['charge_credit']?></td>
                                                <td><?=$register['payment']?></td>
                                                <?php break;
                                                case 'A/P' : ?>
                                                <td><?=$register['billed']?></td>
                                                <td><?=$register['paid']?></td>
                                                <?php break;
                                                default : ?>
                                                <td><?=$register['payment']?></td>
                                                <td><?=$register['deposit']?></td>
                                                <?php break;
                                            } ?>
                                            <?php if ($type !== 'A/R' && $type !== 'A/P') : ?>
                                            <td><?=$register['reconcile_status']?></td>
                                            <td><?=$register['banking_status']?></td>
                                            <td><?=$register['attachments']?></td>
                                            <td><?=$register['tax']?></td>
                                            <td><?=$register['balance']?></td>
                                            <?php else : ?>
                                            <td><?=$register['due_date']?></td>
                                            <td><?=$register['open_balance']?></td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                        <tr>
                                            <td colspan="13">
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
            </div>
        </div>
    </div>
</div>

<?php include viewPath('v2/includes/footer'); ?>