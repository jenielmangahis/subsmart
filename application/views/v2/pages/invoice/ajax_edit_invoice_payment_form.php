<style>
.row-label, .row-value{
    font-size:19px;
    font-weight:bold;
}
</style>
<div class="nsm-card primary">
    <div class="nsm-card-content">
    <p>Record a full or partial payment for Invoice# <span><b><?php echo $invoice->invoice_number?></span></b></p>
    <div class="pbar-top">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <label>Reference #</label> <span class="help">(optional)</span>
                <input type="text" name="reference" value="<?= $paymentRecord->reference_number; ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="margin-bottom-ter mt-2">
        <label>Comments / Notes</label> <span class="help">(optional)</span>
        <input type="text" name="notes" value="<?= $paymentRecord->notes; ?>" class="form-control">
    </div>
    <div class="margin-bottom-ter mt-2">
        <label>Attachment</label> <span class="help">(optional)</span>
        <input type="file" name="attachment" id="edit-payment-attachment" value="" class="form-control">
    </div>
</div>