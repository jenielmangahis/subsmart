<input type="hidden" name="pid" value="<?= $payscale->id; ?>">
<div class="form-group">
	<div class="row">
        <div class="col-md-12">
            <label for="">Company</label>
            <select class="form-control" name="company_id" required="" id="company-id">
                <?php foreach($companies as $c){ ?>
                    <option value="<?= $c->id; ?>" <?= $payscale->company_id == $c->id ? 'selected="selected"' : ''; ?>><?= $c->business_name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-12">
            <label for="">Pay Scale Name</label>
            <input type="text" name="payscale_name" class="form-control" value="<?= $payscale->payscale_name; ?>" placeholder="Payscale Name" required="">
        </div>
    </div>
</div>