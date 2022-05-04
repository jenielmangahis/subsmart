<input type="hidden" name="nspid" value="<?= $nSmartPlan->nsmart_plans_id; ?>">
<div class="row">
    <div class="col-md-12">
        <label for="">Plan Name</label>
        <input type="text" name="plan_name" value="<?= $nSmartPlan->plan_name; ?>" id="plan-name" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Description</label>
        <textarea class="form-control" style="height: 100px !important;" required="" name="plan_description"><?= $nSmartPlan->plan_description; ?></textarea>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Default Number of License</label>
        <input type="text" name="num_license" id="default-num-license" value="<?= $nSmartPlan->num_license; ?>" class="form-control" required="">
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Plan Price</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" name="plan_price" value="<?= $nSmartPlan->price; ?>" id="plan-price" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Price per License</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" name="price_per_license" value="<?= $nSmartPlan->price_per_license; ?>" id="price-per-license" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-6">
                <label for="">Discount</label>
                <input type="number" name="plan_discount" value="<?= $nSmartPlan->discount; ?>" id="plan_discount" class="form-control" required="" autocomplete="off" min="0" step="0.01" />
            </div>
            <div class="col-6">
                <label for="">Discount Type</label>
                <select name="plan_discount_type" class="form-control">
                    <?php foreach( $option_discount_types as $key => $value ){ ?>
                        <option <?= $nSmartPlan->discount_type == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
    </div>

    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="plan_status" class="form-control" autocomplete="off">
            <?php foreach($option_status as $key => $value){ ?>
                <option <?= $nSmartPlan->status == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
        </select>
    </div>
</div>