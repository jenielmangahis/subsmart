<input type="hidden" name="aid" value="<?= $addon->id; ?>">
<div class="row">
    <div class="col-md-12">
        <label for="">Addon Name</label>
        <input type="text" name="addon_name" id="edit-addon-name" value="<?= $addon->name; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Description</label>
        <textarea class="form-control" style="height: 200px !important;" required="" name="addon_description"><?= $addon->description; ?></textarea>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Price</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" name="addon_price" value="<?= $addon->price; ?>" id="edit-addon-price" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="addon_status" class="form-control" autocomplete="off">
            <option value="1" <?= $addon->status == 1 ? 'selected="selected"' : ''; ?>>Active</option>
            <option value="0" <?= $addon->status == 0 ? 'selected="selected"' : ''; ?>>Inactive</option>
        </select>
    </div>
</div>