<style>
.row-label, .row-value{
    font-size:19px;
    font-weight:bold;
}
</style>
<div class="nsm-card primary">
    <div class="nsm-card-content">
    <p style="margin-bottom:2px;">Record a full or partial payment for Invoice# <span><b><?php echo $invoice->invoice_number?></span></b></p>
    <?php if( $invoice->late_fee > 0 ){ ?>
    <p>Late fee amount is included in total due.</p>
    <?php } ?>
    <div class="pbar-top mt-2">
        <div class="row">
            <div class="col-6">
                <label class="row-label">Due : </label>
                <span class="row-value">$<?php echo number_format($invoice->grand_total, 2, '.', ',') ?></label>                
            </div>
            <div class="col-6">
                <label class="row-label">Balance : </label>
                <span class="row-value">$<?php echo number_format($balance, 2, '.', ',') ?></label>
            </div>
            <?php if($late_fee > 0) { ?>
            <div class="col-6" style="color: red;">
                <?php if($total_late_fee_days > 0) { ?>
                    <label class="row-label" style="font-size: 15px !important;">Late Fee (<?php echo $total_late_fee_days?> Days): </label>
                <?php } else { ?>
                    <label class="row-label" style="font-size: 15px !important;">Late Fee: </label>
                <?php } ?>
                
                <span class="row-value" style="font-size: 15px !important;">$<?php echo number_format($late_fee, 2, '.', ',') ?></label>
            </div>
            <?php } ?>
            <div class="col-6">
                <label class="row-label">&nbsp;</label>
                <span class="row-value">&nbsp;</label>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin-top:36px;">
        <div class="row">
            <div class="col-sm-6">
                <label>Invoice Amount</label>
                <i id="help-popover-invoice-amount" class='bx bx-fw bx-help-circle'></i></label>  
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>                        
                    <input type="number" step="any" class="form-control" name="amount" placeholder="0.00" value="<?= $total_invoice_without_late_fee; ?>" aria-label="Amount (to the nearest dollar)">
                </div>
            </div>

            <div class="col-sm-6">
                <label>Tip </label> <span class="help">(optional)</span>
                <i id="help-popover-tip" class='bx bx-fw bx-help-circle'></i></label>  
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" class="form-control" data-payment-modal="amount-tip" placeholder="0.00" name="amount_tip" value="0">
                </div>
            </div>
            <?php if($late_fee > 0) { ?>
            <div class="col-sm-6">
                <label>Late Fee</label>
                <i id="help-popover-late-fee" class='bx bx-fw bx-help-circle'></i></label>  
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>                        
                    <input type="number" step="any" class="form-control" name="late_fee_amount" placeholder="0.00" value="<?= $late_fee; ?>" aria-label="Amount (to the nearest dollar)">
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="form-group" style="margin-bottom: 0px !important;">
        <div class="row">
            <div class="col-sm-6">
                <label>Payment Date</label>
                <div class="input-group mb-3">
                    <input type="date" name="date_payment" id="date_payment" class="form-control" value="<?= date("Y-m-d"); ?>">
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
            <div class="col-sm-12">
                <label>Reference #</label> <span class="help">(optional)</span>
                <input type="text" name="reference" value="" class="form-control">
            </div>
        </div>
    </div>
    <div class="margin-bottom-ter mt-2">
        <label>Comments / Notes</label> <span class="help">(optional)</span>
        <input type="text" name="notes" value="" class="form-control">
    </div>
    <div class="margin-bottom-ter mt-2">
        <label>Attachment</label> <span class="help">(optional)</span>
        <input type="file" name="attachment" id="payment-attachment" value="" class="form-control">
    </div>
    <!-- <label class="weight-normal">
        <input type="checkbox" name="send_invoice" value="1" checked="checked">
        Email the copy of payment receipt to customer
    </label> -->
    </div>
</div>
<script>
$(function(){
    $('#help-popover-invoice-amount').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Amount received for invoice';
        }
    });

    $('#help-popover-late-fee').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Extra charge for a payment that is not made by its due date. <?= $late_fee_popover_text; ?>';
        }
    });

    $('#help-popover-tip').popover({
        placement: 'top',
        html: true,
        trigger: "hover focus",
        content: function() {
            return 'Will be added to Invoice Amount';
        }
    });
});
</script>