<div class="row gy-2">
    <div class="col-12">
        <input type="text" placeholder="Tax Name" name="tax_name" class="nsm-field form-control mb-2" value="<?= $taxRate->name; ?>" required autocomplete="off" />
    </div>
    <div class="col-12">
        <input type="number" placeholder="Rate (%)" name="tax_rate" class="nsm-field form-control mb-2" value="<?= $taxRate->rate; ?>" required autocomplete="off" min="0" />
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="is_default" id="is_default_checkbox" <?= $taxRate->is_default == 1 ? 'checked="checked"' : ''; ?>>
            <label class="form-check-label" for="is_default_checkbox">
                Set Tax as Default
            </label>
        </div>
        <label class="nsm-subtitle">If set as default this tax will be applied automatically when adding a new item on estimates or invoices.</label>
    </div>
</div>