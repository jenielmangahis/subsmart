<?php include viewPath('v2/includes/accounting_header'); ?>
<?php include viewPath('v2/includes/accounting/recurring_transactions_modals'); ?>

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
                        <form action="<?php echo base_url('accounting/recurring-transactions') ?>" method="get">
                            <div class="nsm-field-group search">
                                <input type="text" class="nsm-field nsm-search form-control mb-2" name="search" id="search_field" placeholder="Find by Name" value="<?php echo (!empty($search)) ? $search : '' ?>">
                            </div>
                        </form>
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
                                            <option value="all" <?=empty($template_type) || $template_type === 'all' ? 'selected' : ''?>>All</option>
                                            <option value="scheduled" <?=!empty($template_type) && $template_type === 'scheduled' ? 'selected' : ''?>>Scheduled</option>
                                            <option value="reminder" <?=!empty($template_type) && $template_type === 'reminder' ? 'selected' : ''?>>Reminder</option>
                                            <option value="unscheduled" <?=!empty($template_type) && $template_type === 'unscheduled' ? 'selected' : ''?>>Unscheduled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label for="filter-transaction-type">Transaction Type</label>
                                        <select class="nsm-field form-select" name="filter_type" id="filter-transaction-type">
                                            <option value="all" <?=empty($transaction_type) || $transaction_type === 'all' ? 'selected' : ''?>>All</option>
                                            <option value="bill" <?=!empty($transaction_type) && $transaction_type === 'bill' ? 'selected' : ''?>>Bill</option>
                                            <option value="non-posting-charge" <?=!empty($transaction_type) && $transaction_type === 'non-posting-charge' ? 'selected' : ''?>>Non-Posting Charge</option>
                                            <option value="check" <?=!empty($transaction_type) && $transaction_type === 'check' ? 'selected' : ''?>>Check</option>
                                            <option value="non-posting-credit" <?=!empty($transaction_type) && $transaction_type === 'non-posting-credit' ? 'selected' : ''?>>Non-Posting Credit</option>
                                            <option value="credit-card-credit" <?=!empty($transaction_type) && $transaction_type === 'credit-card-credit' ? 'selected' : ''?>>Credit Card Credit</option>
                                            <option value="credit-memo" <?=!empty($transaction_type) && $transaction_type === 'credit-memo' ? 'selected' : ''?>>Credit Memo</option>
                                            <option value="deposit" <?=!empty($transaction_type) && $transaction_type === 'deposit' ? 'selected' : ''?>>Deposit</option>
                                            <option value="estimate" <?=!empty($transaction_type) && $transaction_type === 'estimate' ? 'selected' : ''?>>Estimate</option>
                                            <option value="expense" <?=!empty($transaction_type) && $transaction_type === 'expense' ? 'selected' : ''?>>Expense</option>
                                            <option value="invoice" <?=!empty($transaction_type) && $transaction_type === 'invoice' ? 'selected' : ''?>>Invoice</option>
                                            <option value="journal-entry" <?=!empty($transaction_type) && $transaction_type === 'journal-entry' ? 'selected' : ''?>>Journal Entry</option>
                                            <option value="refund" <?=!empty($transaction_type) && $transaction_type === 'refund' ? 'selected' : ''?>>Refund</option>
                                            <option value="sales-receipt" <?=!empty($transaction_type) && $transaction_type === 'sales-receipt' ? 'selected' : ''?>>Sales Receipt</option>
                                            <option value="transfer" <?=!empty($transaction_type) && $transaction_type === 'transfer' ? 'selected' : ''?>>Transfer</option>
                                            <option value="vendor-credit" <?=!empty($transaction_type) && $transaction_type === 'vendor-credit' ? 'selected' : ''?>>Vendor Credit</option>
                                            <option value="purchase-order" <?=!empty($transaction_type) && $transaction_type === 'purchase-order' ? 'selected' : ''?>>Purchase Order</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6">
                                        <button type="button" class="nsm-button" id="reset-button">
                                            Reset
                                        </button>
                                    </div>
                                    <div class="col-6" id="apply-button">
                                        <button type="button" class="nsm-button primary float-end">
                                            Apply
                                        </button>
                                    </div>
                                </div>
                            </ul>
                        </div>

                        <div class="nsm-page-buttons page-button-container">
                            <button type="button" class="nsm-button" data-bs-toggle="modal" data-bs-target="#transaction-type-modal">
                                <i class='bx bx-fw bx-list-plus'></i> New
                            </button>
                            <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#print_recurring_transactions_modal">
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
                <table class="nsm-table" id="transactions-table">
                    <thead>
                        <tr>
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
                        <tr data-id="<?=$transaction['id']?>" data-transaction_id="<?=$transaction['txn_id']?>">
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$transaction['template_name']?></td>
                            <td><?=ucfirst($transaction['recurring_type'])?></td>
                            <td><?=ucwords(str_replace('np', '', $transaction['txn_type']))?></td>
                            <td><?=$transaction['recurring_interval']?></td>
                            <td><?=$transaction['previous_date']?></td>
                            <td><?=$transaction['next_date']?></td>
                            <td><?=$transaction['customer_vendor']?></td>
                            <td><?=$transaction['amount']?></td>
                            <td>
                                <div class="dropdown table-management">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item edit-transaction" href="#">Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item use-transaction" href="#">Use</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item duplicate-transaction" href="#">Duplicate</a>
                                        </li>
                                        <?php if($transaction['status'] === "2") : ?>
                                        <li>
                                            <a class="dropdown-item resume-recurring" href="#">Resume</a>
                                        </li>
                                        <?php else : ?>
                                        <li>
                                            <a class="dropdown-item pause-recurring" href="#">Pause</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item skip-next-date" href="#">Skip next date</a>
                                        </li>
                                        <?php endif; ?>
                                        <li>
                                            <a class="dropdown-item delete-transaction" href="#">Delete</a>
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