<div class="row gy-3 mb-4">
    <div class="col-12">
        <label class="content-subtitle fw-bold d-block mb-2">Enable / Disable Data Sync</label>
        <select class="form-control" name="adt_sales_sync" style="margin-top: 15px;">
            <option value="0" <?= $setting && $setting->value == 0 ? 'selected = "selected"' : ''; ?>>DISABLE</option>
            <option value="1" <?= $setting && $setting->value == 1 ? 'selected = "selected"' : ''; ?>>ENABLE</option>
        </select>
    </div>
</div>