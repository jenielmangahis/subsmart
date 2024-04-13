<div class="modal fade modal-fluid nsm-modal" id="payment-method-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title"><?=isset($paymentMethod) ? 'Edit' : 'New'?> Payment Method</span>
                <button type="button" class="close-payment-method" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
            </div>
            <?php 
                $action = isset($paymentMethod) ? "/accounting/payment-methods/update/$paymentMethod->id" : '/accounting/payment-methods/add';
            ?>
            <form id="payment-method-form" action="<?=$action?>" method="post">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control nsm-field mb-2" <?=isset($paymentMethod) ? "value='$paymentMethod->name'" : ''?> required>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="credit_card" name="credit_card" value="1" <?=isset($paymentMethod) && $paymentMethod->credit_card ? 'checked' : ''?>>
                            <label class="form-check-label" for="credit_card">This is a credit card.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button close-payment-method" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button success float-end">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>