<input type="hidden" name="tid" value="<?= $industryType->id; ?>">
<div class="row">
    <div class="col-md-12 mt-3">
        <label for="">Industry Type Name</label>
        <input type="text" name="industry_type_name" id="type-name" value="<?= $industryType->name; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12">
        <label for="">Business Type</label>
        <select class="form-control" id="business_type_name" name="business_type_name" required="">
            <?php foreach( $businessTypes as $businessType ){ ?>
                  <option <?= $industryType->business_type_name == $businessType ? 'selected="selected"' : ''; ?> value="<?php echo $businessType; ?>"><?php echo $businessType; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Industry Template</label>
        <select class="form-control" id="industry_template_id" name="industry_template_id" required="">
            <?php foreach( $industryTemplate as $indTemplate ){ ?>
                <option <?= $industryType->industry_template_id == $indTemplate->id ? 'selected="selected"' : ''; ?> value="<?php echo $indTemplate->id; ?>"><?php echo $indTemplate->name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="status" class="form-control" autocomplete="off">
            <option <?= $industryType->status == 1 ? 'selected="selected"' : ''; ?> value="1" selected="">Active</option>
            <option <?= $industryType->status == 0 ? 'selected="selected"' : ''; ?> value="0">Inactive</option>
        </select>
    </div>
</div>