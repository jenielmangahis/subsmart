<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<img class="img-responsive" style="width: 41%;margin:0 auto;margin-bottom: 40px;" data-fileupload="image-logo" src="<?php echo $url->assets ?>img/nmi.png">
<p>Enter your nmi terminal id and transaction key found in your nmi account</p>
<hr />
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Transaction Key</b></label><br />
      <input type="text" class="form-control" name="nmi_transaction_key" value="<?= $nmi ? $nmi->nmi_transaction_key : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
<div class="row">
  <div class="col-md-12 form-group">
      <label for=""><b>Terminal ID</b></label><br />
      <input type="text" class="form-control" name="nmi_terminal_id" value="<?= $nmi ? $nmi->nmi_terminal_id : ''; ?>" id="" required placeholder="" autofocus/>
  </div>
</div>
