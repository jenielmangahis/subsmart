
<div class="input-group mb-3">
    <select id="select-import-signature" class="form-control" data-type="<?= $entity; ?>">
        <option value="">- Select Signature -</option>
        <?php if( $entity == 'user' ){ ?>
            <?php foreach( $userSignatures as $signature ){ ?>
                <option value="<?= $signature->signature; ?>"><?= $signature->FName . ' ' . $signature->LName; ?></option>
            <?php } ?>
        <?php }elseif( $entity == 'customer' ){ ?>
            <?php foreach( $customerSignatures as $signature ){ ?>
                <option value="<?= $signature->value; ?>"><?= $signature->first_name . ' ' . $signature->last_name; ?></option>
            <?php } ?>
        <?php } ?>
    </select>
</div>