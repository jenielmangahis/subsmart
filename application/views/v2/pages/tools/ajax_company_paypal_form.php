<div class="row gy-3 text-center">
    <div class="col-12 mb-3">
        <img class="w-50" src="<?php echo $url->assets ?>img/paypal-logo.png">
    </div>
    <div class="col-12">
        <label class="content-subtitle">Enter your paypal token / keys to accept paypal payment</label>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Secret Key</label>
        <textarea placeholder="Secret Key" name="paypal_client_id" class="nsm-field form-control" required><?= $paypal ? $paypal->paypal_client_id : ''; ?></textarea>
    </div>
    <div class="col-12">
        <label class="content-subtitle d-block mb-2 fw-bold">Publish Key</label>
        <textarea placeholder="Publish Key" name="paypal_client_secret" class="nsm-field form-control" required rows=3><?= $paypal ? $paypal->paypal_client_secret : ''; ?></textarea>
    </div>
</div>