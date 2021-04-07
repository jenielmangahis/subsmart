<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<img class="img-responsive" style="width: 41%;margin:0 auto;margin-bottom: 40px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/stripe-logo.png">
<p>Enter your stripe account details to activate stripe payment</p>
<p>To location your secret and publish key <a href="https://support.stripe.com/questions/locate-api-keys-in-the-dashboard" style="color:#45a73c;" target="_new">click here</a></p>
<hr />
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Secret Key</b></label><br />
      <input type="text" class="form-control" name="stripe_secret_key" value="<?= $stripe ? $stripe->stripe_secret_key : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Publish Key</b></label><br />
      <input type="text" class="form-control" name="stripe_publish_key" value="<?= $stripe ? $stripe->stripe_publish_key : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
