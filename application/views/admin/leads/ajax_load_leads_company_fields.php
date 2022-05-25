<div class="row">
    <div class="col-md-6 mt-3">
        <label for="">Sales Representative</label>
        <select class="nsm-field mb-2 form-control d-select2-user" id="fk_sr_id" name="fk_sr_id" required="">
            <option value="">Select User</option>
            <?php foreach($companyUsers as $u){ ?>
                <option value="<?= $u->id; ?>"><?= $u->FName.' '.$c->LName; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-6 mt-3">
        <label for="">Assigned To</label>
        <select class="nsm-field mb-2 form-control d-select2-user" id="fk_assign_id" name="fk_assign_id" required="">
            <option value="">Select User</option>
            <?php foreach($companyUsers as $u){ ?>
                <option value="<?= $u->id; ?>"><?= $u->FName.' '.$c->LName; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<script>
$(function(){
    $('.d-select2-user').select2({
        placeholder: 'Select User',
        allowClear: true,
        width: 'resolve'            
    });
});
</script>