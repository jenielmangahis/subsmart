<tr>
    <td>
        <select class="nsm-field form-select" name="commission_setting_id[]">
            <?php foreach( $commissionSettings as $cs ){ ?>
                <option value="<?= $cs->id; ?>"><?= $cs->name; ?></option>
            <?php } ?>
        </select>   
    </td>
    <td>
        <select class="nsm-field form-select" name="commission_setting_type[]">
            <?php foreach($optionCommissionTypes as $key => $value){ ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php } ?>
            
        </select>
    </td>
    <td><input type="number" step="any" name="commission_setting_value[]" class="nsm-field form-control" required /></td>
    <td><a class="nsm-button small btn-delete-commission-setting-row" style="display:block;" href="javascript:void(0);"><i class='bx bx-trash'></i></a></td>
</tr>