<div class="modal fade nsm-modal" id="print_recurring_transactions_modal" tabindex="-1" aria-labelledby="print_recurring_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_recurring_transactions_modal_label">Print Payment Methods List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
						<?php foreach($transactions as $transaction) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$transaction['template_name']?></td>
                            <td><?=ucfirst($transaction['recurring_type'])?></td>
                            <td><?=ucwords(str_replace('np', '', $transaction['txn_type']))?></td>
                            <td><?=$transaction['recurring_interval']?></td>
                            <td><?=$transaction['previous_date']?></td>
                            <td><?=$transaction['next_date']?></td>
                            <td><?=$transaction['customer_vendor']?></td>
                            <td><?=$transaction['amount']?></td>
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
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_recurring_transactions">Print</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade nsm-modal" id="print_preview_recurring_transactions_modal" tabindex="-1" aria-labelledby="print_preview_recurring_transactions_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_preview_recurring_transactions_modal_label">Print Payment Methods List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="w-100" id="recurring_transactions_table_print">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($transactions) > 0) : ?>
						<?php foreach($transactions as $transaction) : ?>
                        <tr>
                            <td class="fw-bold nsm-text-primary nsm-link default"><?=$transaction['template_name']?></td>
                            <td><?=ucfirst($transaction['recurring_type'])?></td>
                            <td><?=ucwords(str_replace('np', '', $transaction['txn_type']))?></td>
                            <td><?=$transaction['recurring_interval']?></td>
                            <td><?=$transaction['previous_date']?></td>
                            <td><?=$transaction['next_date']?></td>
                            <td><?=$transaction['customer_vendor']?></td>
                            <td><?=$transaction['amount']?></td>
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

<div class="modal fade modal-fluid nsm-modal" id="transaction-type-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title">Select Transaction Type</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="type">Transaction Type</label>
                        <select name="transaction_type" id="type" class="form-select nsm-field">
                            <option value="bill">Bill</option>
                            <option value="non-posting-charge">Non-Posting Charge</option>
                            <option value="check">Check</option>
                            <option value="non-posting-credit">Non-Posting Credit</option>
                            <option value="credit-card-credit">Credit Card Credit</option>
                            <option value="credit-memo">Credit Memo</option>
                            <option value="deposit">Deposit</option>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button success float-end">OK</button>
            </div>
        </div>
    </div>
</div>