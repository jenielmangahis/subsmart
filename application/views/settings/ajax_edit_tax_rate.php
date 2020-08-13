<div class="form-group">
    <label>Tax Name</label> <span class="form-required">*</span>
    <input type="text" name="tax_name" value="<?= $taxRate->name; ?>" placeholder="e.g. Standard Tax" class="form-control" required="" autocomplete="off" />
</div>
<div class="form-group">
    <label>Rate (%)</label> <span class="form-required">*</span>
    <input type="text" name="tax_rate" value="<?= $taxRate->rate; ?>" placeholder="e.g. 10" class="form-control" required="" autocomplete="off" />
</div> 
<div class="form-group">
    <label>Set Tax as Default</label> <span class="form-required">*</span><br /><span class="help help-sm">If set as default this tax will be applied automatically when adding a new item on estimates or invoices.</span><br /><br />
    <label class="checkbox">
      <input type="checkbox" <?= $taxRate->is_default == 1 ? 'checked="checked"' : ''; ?> name="is_default" /> Set as default
    </label>
</div>  