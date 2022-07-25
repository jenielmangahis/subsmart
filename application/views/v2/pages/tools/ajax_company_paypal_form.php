<style>
.api-input{
    letter-spacing: 1px;
    text-align: center;
}
</style>
<?php if($paypal){ ?>
    <div class="row gy-3 text-center form-view-values">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/paypal-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Paypal token / keys to accept paypal payment</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $paypal ? maskString($paypal->paypal_client_id) : ''; ?>" readonly disabled/>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
            <input type="text" class="nsm-field form-control api-input" value="<?= $paypal ? maskString($paypal->paypal_client_secret) : ''; ?>" readonly disabled/>
        </div>

        <div class="modal-footer">
            <button type="button" class="nsm-button primary btn-paypal-edit">Edit</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>

    <div class="row gy-3 text-center form-edit-values" style="display: none;">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/paypal-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your paypal token / keys to accept paypal payment</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
            <input type="text" placeholder="Secret Key" name="paypal_client_id" class="nsm-field form-control api-input" value="<?= $paypal ? $paypal->paypal_client_id : ''; ?>" required/>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
            <input type="text" placeholder="Publish Key" name="paypal_client_secret" class="nsm-field form-control api-input" value="<?= $paypal ? $paypal->paypal_client_secret : ''; ?>" required/>
        </div>
        <div class="modal-footer">
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button btn-paypal-cancel">Cancel</button>                
        </div>
    </div>
<?php }else{ ?>
    <div class="row gy-3 text-center">
        <div class="col-12 mb-3">
            <img class="w-50" src="<?php echo $url->assets ?>img/paypal-logo.png">
        </div>
        <div class="col-12">
            <label class="content-subtitle">Enter your paypal token / keys to accept paypal payment</label>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
            <input type="text" placeholder="Secret Key" name="paypal_client_id" class="nsm-field form-control api-input" value="" required/>
        </div>
        <div class="col-12">
            <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
            <input type="text" placeholder="Publish Key" name="paypal_client_secret" class="nsm-field form-control api-input" value="" required/>
        </div>

        <div class="modal-footer">    
            <button type="submit" class="nsm-button primary">Save</button>
            <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>                
        </div>
    </div>
<?php } ?>