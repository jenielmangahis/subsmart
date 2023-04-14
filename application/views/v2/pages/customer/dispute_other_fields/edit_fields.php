<style>
.hidden{
    display: none;
}
</style>
<?php foreach($creditBureaus as $cb){ ?>
    <?php 
        $css_hidden     = '';
        $other_fields   = array();
        $account_number = '';
        $status = '';
        $is_checked = '';
        if( !array_key_exists($cb->id, $aDisputeItems) ){
            $css_hidden = 'display:none;';
        }else{
            $is_checked     = 'checked="checked"';
            $other_fields   = unserialize($aDisputeItems[$cb->id]->other_fields);
            $account_number = $aDisputeItems[$cb->id]->account_number;
            $status         = $aDisputeItems[$cb->id]->status;
        }
    ?>
    <div class="other-field-group-cb-container-<?= $cb->id; ?>">
        <div class="cb-logo" style="display: block; padding:10px; background-color: #8c8c8c;width: 100%;margin-bottom: 25px;height: 45px;">
            <img style="width:97px;float: left;" class="" src="<?= base_url('uploads/credit_bureaus/'.$cb->logo); ?>" alt="<?= $cb->name; ?>" />
            <div class="form-check" style="float:right;">
              <input class="form-check-input chk-cb-other-fields" data-id="<?= $cb->id; ?>" name="creditedBureau[]" type="checkbox" <?= $is_checked; ?> value="<?= $cb->id; ?>" id="cb-chk-<?= $cb->id; ?>">
            </div>
        </div>      
        <div class="cb-other-fields-<?= $cb->id; ?>" style="<?= $css_hidden; ?>">
            <div class="row" style="width:100%; margin-top: 20px;" >
                <div class="col-md-4 form-group">
                    <label for="">Status</label>
                    <select class="form-control autocomplete-status" name="otherInfo[individual][<?= $cb->id; ?>][status]">
                      <?php foreach($optionOtherInfoStatus as $ostatus){ ?>
                        <option <?= $status != '' ? $status == $ostatus['value'] ? 'selected="selected"' : '' : ''; ?> value="<?= $ostatus['value']; ?>"><?= $ostatus['value']; ?></option>
                      <?php } ?>
                    </select>     
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Date Filed</label>
                    <input type="text" class="form-control f-other-info-date" name="otherInfo[individual][<?= $cb->id; ?>][date_file]" value="<?= isset($other_fields['date_file']) ? date("m/d/Y", strtotime($other_fields['date_file']['value'])) : date("m/d/Y") ?>"> 
                </div>
                <div class="col-md-4 form-group">
                    <label for="">High Balance</label>
                    <input type="text" class="form-control f-other-info-date-filed" name="otherInfo[individual][<?= $cb->id; ?>][high_balance]" value="<?= isset($other_fields['high_balance']) ? $other_fields['high_balance']['value'] : '' ?>"> 
                </div>
            </div>

            <div class="row" style="width:100%; margin-top: 20px;">
                <div class="col-md-4 form-group">
                    <label for="">Account Name</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_name]" value="<?= isset($other_fields['account_name']) ? $other_fields['account_name']['value'] : '' ?>">   
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" name="cb_account_number[<?= $cb->id; ?>]" value="<?= $account_number; ?>">   
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Account Type</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_type]" value="<?= isset($other_fields['account_type']) ? $other_fields['account_type']['value'] : '' ?>">   
                </div>            
            </div>

            <div class="row" style="width:100%; margin-top: 20px;">
                <div class="col-md-4 form-group">
                    <label for="">Account Limit</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_limit]" value="<?= isset($other_fields['account_limit']) ? $other_fields['account_limit']['value'] : '' ?>">   
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Date Reported</label>
                    <input type="text" class="form-control f-other-info-date" name="otherInfo[individual][<?= $cb->id; ?>][date_reported]" value="<?= isset($other_fields['date_reported']) ? date("m/d/Y", strtotime($other_fields['date_reported']['value'])) : date("m/d/Y") ?>"> 
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Account Status</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][account_status]" value="<?= isset($other_fields['account_status']) ? $other_fields['account_status']['value'] : '' ?>">   
                </div>            
            </div>

            <div class="row" style="width:100%; margin-top: 20px;">
                <div class="col-md-4 form-group">
                    <label for="">Past Due</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][past_due]" value="<?= isset($other_fields['past_due']) ? $other_fields['past_due']['value'] : '' ?>">   
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Monthly Payment</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][monthly_payment]" value="<?= isset($other_fields['monthly_payment']) ? $other_fields['monthly_payment']['value'] : '' ?>"> 
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Payment Status</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][payment_status]" value="<?= isset($other_fields['payment_status']) ? $other_fields['payment_status']['value'] : '' ?>">   
                </div>            
            </div>

            <div class="row" style="width:100%; margin-top: 20px;">
                <div class="col-md-4 form-group">
                    <label for="">Amount</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][amount]" value="<?= isset($other_fields['amount']) ? $other_fields['amount']['value'] : '' ?>">   
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Plantiff</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][plantiff]" value="<?= isset($other_fields['plantiff']) ? $other_fields['plantiff']['value'] : '' ?>"> 
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Balance</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][balance]" value="<?= isset($other_fields['balance']) ? $other_fields['balance']['value'] : '' ?>">   
                </div>            
            </div>

            <div class="row" style="width:100%; margin-top: 20px;">
                <div class="col-md-4 form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][address]" value="<?= isset($other_fields['address']) ? $other_fields['address']['value'] : '' ?>">   
                </div>
                <div class="col-md-4 form-group">
                    <label for="">ECOA</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][ecoa]" value="<?= isset($other_fields['ecoa']) ? $other_fields['ecoa']['value'] : '' ?>"> 
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Term</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][term]" value="<?= isset($other_fields['term']) ? $other_fields['term']['value'] : '' ?>">   
                </div>
                
            </div>
            <div class="row" style="width:100%; margin-top: 20px;">
                <div class="col-md-6 form-group">
                    <label for="">Internal Note</label>
                    <input type="text" class="form-control" name="otherInfo[individual][<?= $cb->id; ?>][internal_note]" value="<?= isset($other_fields['internal_note']) ? $other_fields['internal_note']['value'] : '' ?>">   
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
$(function(){
    $(document).on('change', '.chk-cb-other-fields', function(){
        var cb_id = $(this).attr('data-id');

        if ($(this).is(':checked')) {
            $('.cb-other-fields-'+cb_id).fadeIn('400');
        }else{
            $('.cb-other-fields-'+cb_id).fadeOut('400');
        }
    });
});
</script>