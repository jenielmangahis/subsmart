<input type="hidden" name="mid" id="edit-mid" value="<?= $industryModule->id; ?>">
<div class="row">
    <div class="col-md-12">
        <label for="">Name</label>
        <input type="text" name="module_name" id="edit-module-name" value="<?= $industryModule->name; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Description</label>
        <textarea class="form-control" name="module_description" id="edit-module-description" style="height: 150px;"><?= $industryModule->description; ?></textarea>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="status" class="form-control" autocomplete="off">
            <option <?= $industryModule->status == 1 ? 'selected="selected"' : ''; ?> value="1">Active</option>
            <option <?= $industryModule->status == 0 ? 'selected="selected"' : ''; ?> value="0">Inactive</option>
        </select>
    </div>
</div>