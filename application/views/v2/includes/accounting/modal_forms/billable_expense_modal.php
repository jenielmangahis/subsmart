<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/billable-expense/<?=$billableExpense->id?>">
    <div id="billableExpenseModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4 recent-transactions-button" data-bs-toggle="dropdown">
                                    <i class="bx bx-fw bx-history"></i>
                                </a>
                                <div class="dropdown-menu p-3" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Billable Expenses</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-billable-expenses">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            <span class="modal-title content-title">
                                Billable Expense
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>

                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row grid-mb">
                                <div class="col-12">
                                    <p>Marked as billable on this <a href="#" class="text-decoration-none" data-id="<?=$billableExpense->transaction_id?>" data-type="<?=$billableExpense->transaction_type === 'Credit Card Credit' ? 'cc-credit' : str_replace(' ', '-', strtolower($billableExpense->transaction_type))?>" id="view-parent-transaction"><?=$billableExpense->transaction_type?></a></p>
                                </div>
                            </div>

                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="date">Date</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=$date?>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="customer">Customer</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=$customer?>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=$billableExpense->description?>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="amount">Amount</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=str_replace('$-', '-$', '$'.number_format(floatval($billableExpense->amount), 2))?>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="expense-account">Account</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <select name="expense_account" id="expense-account" class="form-select nsm-field">
                                        <option value="<?=$account->id?>"><?=$account->name?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="markup">Markup</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=floatval($billableExpense->markup_percentage) > 0 ? str_replace('$-', '-$', '$'.number_format((floatval($billableExpense->amount) * floatval($billableExpense->markup_percentage)) / 100, 2)).' ' : ''?>(<?=number_format(floatval($billableExpense->markup_percentage), 2)?>%)
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="markup-account">Markup Account</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <select name="markup_account" id="markup-account" class="form-select nsm-field">
                                        <?php if(!is_null($markupAcc)) : ?>
                                        <option value="<?=$markupAcc->id?>"><?=$markupAcc->name?></option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="total-amount">Total amount</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=str_replace('$-', '-$', '$'.number_format(floatval($billableExpense->amount) + (floatval($billableExpense->amount) * floatval($billableExpense->markup_percentage)) / 100, 2))?>
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="location">Location</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    
                                </div>
                            </div>
                            <div class="row grid-mb">
                                <div class="col-12 col-md-2">
                                    <label for="taxable">Taxable</label>
                                </div>
                                <div class="col-12 col-md-2">
                                    <?=$billableExpense->tax === '1' ? 'true' : ''?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-12 col-md-6">
                            <button type="button" class="nsm-button success float-end" onclick="saveAndCloseForm(event)">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end of modal-->
</form>
</div>