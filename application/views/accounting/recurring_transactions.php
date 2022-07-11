<?php include viewPath('v2/includes/accounting_header'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A recurring transaction is an agreement between a cardholder and a company providing goods/services that essentially authorizes the charging of periodic, automatic payments during a set amount of time.  The transaction can be charged on a weekly, monthly, or yearly basis.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 grid-mb">
                        <div class="nsm-field-group search">
                            <input type="text" class="nsm-field nsm-search form-control mb-2" id="search_field" placeholder="Find by Name">
                        </div>
                    </div>
                    <div class="col-12 col-md-8 grid-mb text-end">
                        <div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>
                                    More actions
                                </span> <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end batch-actions">
                                <li><a class="dropdown-item" href="javascript:void(0);" id="reminder-list">Reminder List</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);" id="run-report">Run Report</a></li>
                            </ul>
                        </div>

						<div class="dropdown d-inline-block">
                            <button type="button" class="dropdown-toggle nsm-button" data-bs-toggle="dropdown">
                                <span>Filter <i class='bx bx-fw bx-chevron-down'></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end p-3 table-filter" style="width: max-content">
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-template-type">Template Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-template-type">
                                            <option value="all" selected="selected">All</option>
                                            <option value="scheduled">Scheduled</option>
                                            <option value="reminder">Reminder</option>
                                            <option value="unscheduled">Unscheduled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-transaction-type">Transaction Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-transaction-type">
                                            <option value="all" selected="selected">All</option>
                                            <option value="bill">Bill</option>
                                            <option value="non-posting-charge">Non-Posting Charge</option>
                                            <option value="check">Check</option>
                                            <option value="non-posting-credit">Non-Posting Credit</option>
                                            <option value="credit-card-credit">Credit Card Credit</option>
                                            <option value="credit-memo">Credit Memo</option>
                                            <option value="deposit">Deposit</option>
                                            <option value="estimate">Estimate</option>
                                            <option value="expense">Expense</option>
                                            <option value="invoice">Invoice</option>
                                            <option value="journal-entry">Journal Entry</option>
                                            <option value="refund">Refund</option>
                                            <option value="sales-receipt">Sales Receipt</option>
                                            <option value="transfer">Transfer</option>
                                            <option value="vendor-credit">Vendor Credit</option>
                                            <option value="purchase-order">Purchase Order</option>
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

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_accounts_modal">
                                <i class='bx bx-fw bx-printer'></i>
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="dropdown">
                                <i class="bx bx-fw bx-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end table-settings p-3">
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
                            </ul>
                        </div>
                    </div>
                </div>
                <table class="nsm-table">
                    <thead>
                        <tr>
                            <!-- <td class="table-icon text-center">
                                <input class="form-check-input select-all table-select" type="checkbox">
                            </td> -->
                            <td data-name="Template Name">TEMPLATE NAME</td>
                            <td data-name="Type">TYPE</td>
                            <td data-name="Txn Type">TXN TYPE</td>
                            <td data-name="Interval">INTERVAL</td>
                            <td data-name="Previous Date">PREVIOUS DATE</td>
                            <td data-name="Next Date">NEXT DATE</td>
                            <td data-name="Customer/Vendor">CUSTOMER/VENDOR</td>
                            <td data-name="Amount">AMOUNT</td>
                            <td data-name="Manage"></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
						<?php foreach($transactions as $transaction) : ?>
                        <?php
                        $previous = !is_null($transaction['previous_date']) && $transaction['previous_date'] !== '' ? date("m/d/Y", strtotime($transaction['previous_date'])) : null;
                        $next = date("m/d/Y", strtotime($transaction['next_date']));
        
                        $every = $transaction['recurr_every'];
                        switch ($transaction['recurring_interval']) {
                            case 'daily' :
                                $interval = 'Every Day';
        
                                if(intval($every) > 1) {
                                    $interval = "Every $every Days";
                                }
                            break;
                            case 'weekly' :
                                $interval = 'Every Week';
        
                                if(intval($every) > 1) {
                                    $interval = "Every $every Weeks";
                                }
                            break;
                            case 'monthly' :
                                $interval = 'Every Month';
        
                                if(intval($every) > 1) {
                                    $interval = "Every $every Months";
                                }
                            break;
                            case 'yearly' :
                                $interval = 'Every Year';
                            break;
                            default :
                                $interval = '';
                                $previous = '';
                                $next = '';
                            break;
                        }

                        switch($transaction['txn_type']) {
                            case 'expense' :
                                $expense = $this->vendors_model->get_expense_by_id($transaction['txn_id']);
                                $total = number_format($expense->total_amount, 2, '.', ',');
        
                                switch($expense->payee_type) {
                                    case 'vendor':
                                        $payee = $this->vendors_model->get_vendor_by_id($expense->payee_id);
                                        $payeeName = $payee->display_name;
                                    break;
                                    case 'customer':
                                        $payee = $this->accounting_customers_model->get_by_id($expense->payee_id);
                                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                    break;
                                    case 'employee':
                                        $payee = $this->users_model->getUser($expense->payee_id);
                                        $payeeName = $payee->FName . ' ' . $payee->LName;
                                    break;
                                }
                            break;
                            case 'check' :
                                $check = $this->vendors_model->get_check_by_id($transaction['txn_id'], logged('company_id'));
                                $total = number_format($check->total_amount, 2, '.', ',');
        
                                switch($check->payee_type) {
                                    case 'vendor':
                                        $payee = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                        $payeeName = $payee->display_name;
                                    break;
                                    case 'customer':
                                        $payee = $this->accounting_customers_model->get_by_id($check->payee_id);
                                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                    break;
                                    case 'employee':
                                        $payee = $this->users_model->getUser($check->payee_id);
                                        $payeeName = $payee->FName . ' ' . $payee->LName;
                                    break;
                                }
                            break;
                            case 'bill' :
                                $bill = $this->vendors_model->get_bill_by_id($transaction['txn_id'], logged('company_id'));
                                $total = number_format($bill->total_amount, 2, '.', ',');
                                $payee = $this->vendors_model->get_vendor_by_id($bill->vendor_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'purchase order' :
                                $purchaseOrder = $this->vendors_model->get_purchase_order_by_id($transaction['txn_id'], logged('company_id'));
                                $total = number_format($purchaseOrder->total_amount, 2, '.', ',');
                                $payee = $this->vendors_model->get_vendor_by_id($purchaseOrder->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'vendor credit' :
                                $vCredit = $this->vendors_model->get_vendor_credit_by_id($transaction['txn_id'], logged('company_id'));
                                $total = number_format($vCredit->total_amount, 2, '.', ',');
                                $payee = $this->vendors_model->get_vendor_by_id($vCredit->payee_id);
                                $payeeName = $payee->display_name;
                            break;
                            case 'credit card credit' :
                                $ccCredit = $this->vendors_model->get_credit_card_credit_by_id($transaction['txn_id'], logged('company_id'));
                                $total = number_format($ccCredit->total_amount, 2, '.', ',');
        
                                switch($ccCredit->payee_type) {
                                    case 'vendor':
                                        $payee = $this->vendors_model->get_vendor_by_id($ccCredit->payee_id);
                                        $payeeName = $payee->display_name;
                                    break;
                                    case 'customer':
                                        $payee = $this->accounting_customers_model->get_by_id($ccCredit->payee_id);
                                        $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                    break;
                                    case 'employee':
                                        $payee = $this->users_model->getUser($ccCredit->payee_id);
                                        $payeeName = $payee->FName . ' ' . $payee->LName;
                                    break;
                                }
                            break;
                            case 'deposit' :
                                $deposit = $this->accounting_bank_deposit_model->getById($transaction['txn_id'], logged('company_id'));
                                $total = number_format($deposit->total_amount, 2, '.', ',');
                                $funds = $this->accounting_bank_deposit_model->getFunds($deposit->id);
                                $flag = true;
        
                                foreach($funds as $fund) {
                                    if($fund->received_from_key !== $funds[0]->received_from_key && $fund->received_from_id !== $funds[0]->received_from_id) {
                                        $flag = false;
                                        break;
                                    }
                                }
        
                                if($flag) {
                                    switch($funds[0]->received_from_key) {
                                        case 'vendor':
                                            $payee = $this->vendors_model->get_vendor_by_id($funds[0]->received_from_id);
                                            $payeeName = $payee->display_name;
                                        break;
                                        case 'customer':
                                            $payee = $this->accounting_customers_model->get_by_id($funds[0]->received_from_id);
                                            $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                        break;
                                        case 'employee':
                                            $payee = $this->users_model->getUser($funds[0]->received_from_id);
                                            $payeeName = $payee->FName . ' ' . $payee->LName;
                                        break;
                                    }
                                } else {
                                    $payeeName = '';
                                }
                            break;
                            case 'transfer' :
                                $transfer = $this->accounting_transfer_funds_model->getById($transaction['txn_id'], logged('company_id'));
                                $total = number_format($transfer->transfer_amount, 2, '.', ',');
                                $payeeName = '';
                            break;
                            case 'journal entry' :
                                $total = '0.00';
                                $payeeName = '';
                            break;
                            case 'npcharge' :
                                $charge = $this->accounting_delayed_charge_model->getDelayedChargeDetails($transaction['txn_id']);
                                $payee = $this->accounting_customers_model->get_by_id($charge->customer_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                $total = number_format($charge->total_amount, 2, '.', ',');
                            break;
                            case 'npcredit' :
                                $credit = $this->accounting_delayed_credit_model->getDelayedCreditDetails($transaction['txn_id']);
                                $payee = $this->accounting_customers_model->get_by_id($credit->customer_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                $total = number_format($credit->total_amount, 2, '.', ',');
                            break;
                            case 'credit memo' :
                                $creditMemo = $this->accounting_credit_memo_model->getCreditMemoDetails($transaction['txn_id']);
                                $payee = $this->accounting_customers_model->get_by_id($creditMemo->customer_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                $total = number_format($creditMemo->total_amount, 2, '.', ',');
                            break;
                            case 'invoice' :
                                $invoice = $this->invoice_model->getinvoice($transaction['txn_id']);
                                $payee = $this->accounting_customers_model->get_by_id($invoice->customer_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                $total = number_format($invoice->grand_total, 2, '.', ',');
                            break;
                            case 'refund' :
                                $refundReceipt = $this->accounting_refund_receipt_model->getRefundReceiptDetails_by_id($transaction['txn_id']);
                                $payee = $this->accounting_customers_model->get_by_id($refundReceipt->customer_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                $total = number_format($refundReceipt->total_amount, 2, '.', ',');
                            break;
                            case 'sales receipt' :
                                $salesReceipt = $this->accounting_sales_receipt_model->getSalesReceiptDetails_by_id($transaction['txn_id']);
                                $payee = $this->accounting_customers_model->get_by_id($salesReceipt->customer_id);
                                $payeeName = $payee->first_name . ' ' . $payee->last_name;
                                $total = number_format($salesReceipt->total_amount, 2, '.', ',');
                            break;
                        }
                        ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$transaction['template_name']?></td>
                            <td><?=ucfirst($transaction['recurring_type'])?></td>
                            <td><?=ucwords(str_replace('np', '', $transaction['txn_type']))?></td>
                            <td><?=$interval?></td>
                            <td><?=$previous?></td>
                            <td><?=$next?></td>
                            <td><?=$payeeName?></td>
                            <td><?=$total?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Use</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Duplicate</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
						<?php else : ?>
						<tr>
							<td colspan="14">
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