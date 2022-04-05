<style>
.other-fields-group-furnishers{
  padding: 0px;
  margin: 0px;
  list-style: none;
}
.other-fields-group-furnishers li{
  display: inline-block;
  width: 100px;
  margin: 10px;
}
</style>
<ul class="other-fields-group-furnishers">
<?php foreach($creditBureaus as $cb){ ?>
    <li><img style="width:97px;display: none;" class="other-field-cb-logo-<?= $cb->id; ?>" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>" alt="<?= $cb->name; ?>" /></li>
<?php } ?>
</ul>
<br />
<div class="row" style="width:100%; margin-top: 20px;">
  <div class="col-md-4 form-group">
      <label for="estimate_date">Status</label>
      <select class="form-control autocomplete-status" name="otherInfo[group][status]">
        <?php foreach($optionOtherInfoStatus as $ostatus){ ?>
          <option value="<?= $ostatus['value']; ?>"><?= $ostatus['value']; ?></option>
        <?php } ?>
      </select>     
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Date Filed</label>
      <input type="text" class="form-control f-other-info-date" name="otherInfo[group][date_file]" value="<?= date("m/d/Y"); ?>"> 
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">High Balance</label>
      <input type="text" class="form-control f-other-info-date-filed" name="otherInfo[group][high_balance]" value=""> 
  </div>
</div>

<div class="row" style="width:100%; margin-top: 20px;">
  <div class="col-md-4 form-group">
      <label for="estimate_date">Account Name</label>
      <input type="text" class="form-control" name="otherInfo[group][account_name]" value="">   
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Account Type</label>
      <input type="text" class="form-control" name="otherInfo[group][account_type]" value="">   
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Account Limit</label>
      <input type="text" class="form-control" name="otherInfo[group][account_limit]" value="">   
  </div>
</div>

<div class="row" style="width:100%; margin-top: 20px;">
  <div class="col-md-4 form-group">
      <label for="estimate_date">Date Reported</label>
      <input type="text" class="form-control f-other-info-date" name="otherInfo[group][date_reported]" value="<?= date("m/d/Y"); ?>"> 
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Account Status</label>
      <input type="text" class="form-control" name="otherInfo[group][account_status]" value="">   
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Past Due</label>
      <input type="text" class="form-control" name="otherInfo[group][past_due]" value="">   
  </div>
</div>

<div class="row" style="width:100%; margin-top: 20px;">
  <div class="col-md-4 form-group">
      <label for="estimate_date">Monthly Payment</label>
      <input type="text" class="form-control" name="otherInfo[group][monthly_payment]" value=""> 
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Payment Status</label>
      <input type="text" class="form-control" name="otherInfo[group][payment_status]" value="">   
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Amount</label>
      <input type="text" class="form-control" name="otherInfo[group][amount]" value="">   
  </div>
</div>

<div class="row" style="width:100%; margin-top: 20px;">
  <div class="col-md-4 form-group">
      <label for="estimate_date">Plantiff</label>
      <input type="text" class="form-control" name="otherInfo[group][plantiff]" value=""> 
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Balance</label>
      <input type="text" class="form-control" name="otherInfo[group][balance]" value="">   
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Address</label>
      <input type="text" class="form-control" name="otherInfo[group][address]" value="">   
  </div>
</div>

<div class="row" style="width:100%; margin-top: 20px;">
  <div class="col-md-4 form-group">
      <label for="estimate_date">ECOA</label>
      <input type="text" class="form-control" name="otherInfo[group][ecoa]" value=""> 
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Term</label>
      <input type="text" class="form-control" name="otherInfo[group][term]" value="">   
  </div>
  <div class="col-md-4 form-group">
      <label for="estimate_date">Internal Note</label>
      <input type="text" class="form-control" name="otherInfo[group][internal_note]" value="">   
  </div>
</div>
