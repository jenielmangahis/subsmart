<?php foreach($creditBureaus as $cb){ ?>
<div class="other-field-group-cb-container-<?= $cb->id; ?>">
  <div class="cb-logo" style="display: block; padding:10px; background-color: #8c8c8c;width: 100%;margin-bottom: 25px;">
      <img style="width:97px;" class="" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>" alt="<?= $cb->name; ?>" />    
  </div>
  <div class="row" style="width:100%; margin-top: 20px;">
    <div class="col-12">
        
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Status</label>
        <select class="form-control autocomplete-status" name="otherInfo[individual][<?= $cb->id; ?>][status]">
          <?php foreach($optionOtherInfoStatus as $ostatus){ ?>
            <option value="<?= $ostatus['value']; ?>"><?= $ostatus['value']; ?></option>
          <?php } ?>
        </select>     
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Date Filed</label>
        <input type="text" class="form-control f-other-info-date" name="otherInfo[individual][<?= $cb->id; ?>][date_file]" value="<?= date("m/d/Y"); ?>"> 
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">High Balance</label>
        <input type="text" class="form-control f-other-info-date-filed" name="otherInfo[individual][<?= $cb->id; ?>][high_balance]" value=""> 
    </div>
  </div>

  <div class="row" style="width:100%; margin-top: 20px;">
    <div class="col-md-4 form-group">
        <label for="estimate_date">Account Name</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_name]" value="">   
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Account Type</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_type]" value="">   
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Account Limit</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_limit]" value="">   
    </div>
  </div>

  <div class="row" style="width:100%; margin-top: 20px;">
    <div class="col-md-4 form-group">
        <label for="estimate_date">Date Reported</label>
        <input type="text" class="form-control f-other-info-date" name="otherInfo[individual][<?= $cb->id; ?>][date_reported]" value="<?= date("m/d/Y"); ?>"> 
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Account Status</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_status]" value="">   
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Past Due</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][past_due]" value="">   
    </div>
  </div>

  <div class="row" style="width:100%; margin-top: 20px;">
    <div class="col-md-4 form-group">
        <label for="estimate_date">Monthly Payment</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][monthly_payment]" value=""> 
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Payment Status</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][payment_status]" value="">   
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Amount</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][amount]" value="">   
    </div>
  </div>

  <div class="row" style="width:100%; margin-top: 20px;">
    <div class="col-md-4 form-group">
        <label for="estimate_date">Plantiff</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][plantiff]" value=""> 
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Balance</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][balance]" value="">   
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Address</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][address]" value="">   
    </div>
  </div>

  <div class="row" style="width:100%; margin-top: 20px;">
    <div class="col-md-4 form-group">
        <label for="estimate_date">ECOA</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][ecoa]" value=""> 
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Term</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][term]" value="">   
    </div>
    <div class="col-md-4 form-group">
        <label for="estimate_date">Internal Note</label>
        <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][internal_note]" value="">   
    </div>
  </div>
</div>
<?php } ?>