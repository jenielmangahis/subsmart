<style>
.api-input{
    letter-spacing: 3px;
    text-align: center;
}
</style>
<?php if($stripe){ ?>
    <div class="row gy-3 text-center form-view-values">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/stripe-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Stripe account details to activate stripe payment.</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
            <textarea class="nsm-field form-control api-input" readonly disabled><?= $stripe ? maskString($stripe->stripe_secret_key) : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
            <textarea class="nsm-field form-control api-input" readonly disabled rows=3><?= $stripe ? maskString($stripe->stripe_publish_key) : ''; ?></textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-stripe-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>

    <div class="row gy-3 text-center form-edit-values" style="display:none;">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/stripe-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your stripe account details to activate stripe payment.</label>
            <label class="content-subtitle">
                How to locate your secret and publish key <a class="nsm-link" href="https://support.stripe.com/questions/locate-api-keys-in-the-dashboard" target="_new">click here.</a>
            </label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
            <textarea placeholder="Secret Key" name="stripe_secret_key" class="nsm-field form-control api-input" required><?= $stripe ? $stripe->stripe_secret_key : ''; ?></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
            <textarea placeholder="Publish Key" name="stripe_publish_key" class="nsm-field form-control api-input" required rows=3><?= $stripe ? $stripe->stripe_publish_key : ''; ?></textarea>
        </div>
        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-stripe-cancel">Cancel</button>                
        </div>
    </div>
<?php }else{ ?>
    <div class="row gy-3 text-center">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/stripe-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your stripe account details to activate stripe payment.</label>
            <label class="content-subtitle">
                How to locate your secret and publish key <a class="nsm-link" href="https://support.stripe.com/questions/locate-api-keys-in-the-dashboard" target="_new">click here.</a>
            </label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
            <textarea placeholder="Secret Key" name="stripe_secret_key" class="nsm-field form-control api-input" required></textarea>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
            <textarea placeholder="Publish Key" name="stripe_publish_key" class="nsm-field form-control api-input" required rows=3></textarea>
        </div>
        <div class="modal-footer">    
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
<?php } ?>