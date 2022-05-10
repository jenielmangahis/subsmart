<input type="hidden" name="oid" value="<?= $offerCode->id; ?>">
<div class="row">
    <div class="col-md-12">
        <label for="">Offer Code</label>
        <input type="text" name="offer_code" value="<?= $offerCode->offer_code; ?>"  class="form-control" required="" autocomplete="off" />
    </div>
    <div class="col-md-12">
        <label for="">Trial days</label>
        <input type="number" name="trial_days" value="<?= $offerCode->trial_days; ?>" id="trial_days" class="form-control" required="" autocomplete="off" min="0" step="1" />
    </div>
    <div class="col-md-12 mt-3">
        <label for="">Status</label>
        <select name="status" class="form-control" autocomplete="off">
            <option <?= $offerCode->status == 1? 'selected="selected"' : ''; ?> value="1">Used</option>
            <option <?= $offerCode->status == 0 ? 'selected="selected"' : ''; ?> value="0">Unused</option>
        </select>
    </div>
</div>