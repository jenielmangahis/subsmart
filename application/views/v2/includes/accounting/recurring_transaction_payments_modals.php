<div class="modal fade nsm-modal" id="print_recurring_transaction_payments_modal" tabindex="-1" aria-labelledby="print_recurring_transaction_payments_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="print_recurring_transactions_modal_label">Print Payment Methods List</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <table class="nsm-table" id="recurring_transaction_payments_table_print">
                    <thead>
                        <tr>
                            <td data-name="Payee" style="width:60%;">PAYEE</td>
                            <td data-name="Type" style="width:10%;">TYPE</td>
                            <td data-name="PaymentDate" style="width:10%;">PAYMENT DATE</td>
                            <td data-name="Amount" style="width:15%;text-align:right;">AMOUNT</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($recurringPayments) > 0) { ?>
                            <?php foreach($recurringPayments as $rp) { ?>
                                <tr>
                                    <td><?= $rp->payee; ?></td>
                                    <td><?= ucwords(strtolower($rp->txn_type)); ?></td>
                                    <td><?= date("m/d/Y", strtotime($rp->payment_date)); ?></td>
                                    <td style="text-align:right;">$<?= number_format($rp->amount, 2,".",","); ?></td>
                                </tr>
                            <?php } ?>                        
                        <?php }else{ ?>						
                        <tr>
                            <td colspan="14">
                                <div class="nsm-empty">
                                    <span>No results found.</span>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="nsm-button primary" id="btn_print_recurring_transaction_payments">Print</button>
            </div>
        </div>
    </div>
</div>