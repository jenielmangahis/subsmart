<div class="row">
    <div class="col-sm-12">
        <label class="mb-2">Name</label>
        <div class="input-group mb-3">
            <input type="text" name="stage_name" value="<?= $customerDealStage->name; ?>" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <label class="mb-2">Probability</label>
        <div class="input-group mb-3">
            <input type="text" name="stage_probability" value="<?= $customerDealStage->probability; ?>" class="form-control" required="" autocomplete="off" />
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-check form-switch">
            <input class="form-check-input" name="is_rotting_days" value="1" <?= $customerDealStage->is_with_rotting_days == 'Yes' ? 'checked="checked"' : ''; ?> type="checkbox" role="switch" id="toggle-rotting-days">
            <label class="form-check-label" for="toggle-rotting-days">Rotting in (days)</label>                                
        </div>
        <input type="number" step="any" name="rotting_num_days" value="<?= $customerDealStage->rotting_days; ?>" class="form-control mt-2 mb-2" style="<?= $customerDealStage->is_with_rotting_days == 'Yes' ? 'style="display:none;"' : ''; ?>" id="rotting-num-days" autocomplete="off" />
    </div>
</div>