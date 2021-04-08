<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<img class="img-responsive" style="width: 57%;margin:0 auto;margin-bottom: 40px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/paypal-logo.png">
<p>Enter your paypal token / keys to accept paypal payment</p>
<!-- <p>To location your secret and publish key <a href="https://support.stripe.com/questions/locate-api-keys-in-the-dashboard" style="color:#45a73c;" target="_new">click here</a></p> -->
<hr />
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Secret Key</b></label><br />
      <input type="text" class="form-control" name="paypal_client_id" value="<?= $paypal ? $paypal->paypal_client_id : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Publish Key</b></label><br />
      <input type="text" class="form-control" name="paypal_client_secret" value="<?= $paypal ? $paypal->paypal_client_secret : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
