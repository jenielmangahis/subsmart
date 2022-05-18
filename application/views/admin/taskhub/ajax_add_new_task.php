<div class="row">
    <div class="col-6 mt-3 company-select">
        <label for="">Customer</label>
        <select name="customer_id" id="" class="nsm-field mb-2 form-control d-select2-customer" required="">     
            <option value="">Select Customer</option>
            <?php foreach($companyCustomers as $c){ ?>
                <option value="<?= $c->prof_id; ?>"><?= $c->first_name.' '.$c->last_name; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-6 mt-3 company-select">
        <label for="">Assigned to</label>
        <select name="user_id" id="" class="nsm-field mb-2 form-control d-select2-user" required="">     
            <option value="">Select User</option>
            <?php foreach($companyUsers as $u){ ?>
                <option value="<?= $u->id; ?>"><?= $u->FName.' '.$c->LName; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<script>
$(function(){
    $('.d-select2-customer').select2({
        placeholder: 'Select Customer',
        allowClear: true,
        width: 'resolve'            
    });

    $('.d-select2-user').select2({
        placeholder: 'Select User',
        allowClear: true,
        width: 'resolve'            
    });
});
</script>