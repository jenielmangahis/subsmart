
<p>
    Record a full or partial payment for Invoice# <span data-payment-modal="custom-number"><?php echo $invoice->invoice_number?></span>
</p>

<div class="pbar-top">
    <div class="pbar-top-left">Paid</div>
    <div class="pbar-top-right">Due <span data-payment-modal="pbar-due-text">$<?php echo number_format($invoice->invoice_totals['grand_total'], 2, '.', ',') ?></span></div>
</div>
<div class="pbar">
    <div class="pbar-label" data-payment-modal="pbar-paid-text">$0.00 of $<?php echo number_format($invoice->invoice_totals['grand_total'], 2, '.', ',') ?></div>
    <div class="pbar-progress" data-payment-modal="pbar-paid" style="width: 0%;"></div>
</div>
    <div class="validation-error" style="display: none;"></div>
    <div class="form-group" style="margin-bottom: 0px !important;">
        <div class="row">
            <div class="col-sm-6">
                <label>Invoice Amount</label>
                <div class="help help-block help-sm">Amount received for invoice</div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="hidden" name="invoice_id" id="invoice_id" value="<?php echo $invoice->id?>">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="<?php echo $invoice->invoice_number?>">
                        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $invoice->customer_id?>">
                        <input type="text" class="form-control" data-payment-modal="amount" name="amount" value="0" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>

            <div class="col-sm-6">
                <label>Tip </label> <span class="help">(optional)</span>
                <div class="help help-block help-sm">Will be added to Invoice Amount</div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" data-payment-modal="amount-tip" name="amount_tip" value="0">
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 0px !important;">
        <div class="row">
            <div class="col-sm-6">
                <label>Payment Date</label>
                <div class="input-group mb-3">
                    <input type="text" name="date_payment" id="date_payment" class="form-control">
                    <div class="input-group-append" data-for="date_payment">
                        <span class="input-group-text"><span class="fa fa-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="discount_fixed">Payment Method</label>
                <select name="payment_method" class="form-control">
                    <option value="cc">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="check">Check</option>
                    <option value="cash">Cash</option>
                    <option value="deposit">Direct Deposit</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                <label>Reference #</label> <span class="help">(optional)</span>
                <input type="text" name="reference" value="" class="form-control">
            </div>
        </div>
    </div>
    <div class="margin-bottom-ter">
        <label>Comments / Notes</label> <span class="help">(optional)</span>
        <input type="text" name="notes" value="" class="form-control">
    </div>
    <label class="weight-normal">
        <input type="checkbox" name="send_invoice" value="1" checked="checked">
        Email the copy of payment receipt to customer
    </label>