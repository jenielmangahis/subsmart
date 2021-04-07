<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<img class="img-responsive" style="width: 69%;margin:0 auto;margin-bottom: 40px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/converge-logo.png">
<p>Enter your converge account details to activate converge payment</p>
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Merchant ID</b></label><br />
      <input type="text" class="form-control" name="converge_merchant_id" value="<?= $converge ? $converge->converge_merchant_id : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Merchant User ID</b></label><br />
      <input type="text" class="form-control" name="converge_merchant_user_id" value="<?= $converge ? $converge->converge_merchant_user_id : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Merchant PIN</b></label><br />
      <input type="text" class="form-control" name="converge_merchant_pin" value="<?= $converge ? $converge->converge_merchant_pin : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
