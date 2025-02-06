<div class="row">
    <?php if( $esignTemplates && count($esignTemplates) > 0 ){ ?>        
        <div class="col-sm-12 mt-1 mb-1">
            <label>Electronic signatures, or e-signatures, are transforming the ways companies do business. Not only do they eliminate the hassle of manually routing paper agreements, but they also dramatically speed up the signature and approval process.</label>
        </div>
        <div class="esign-templates mt-2">
            <select id="esign-template-id" name="esign_template_id" class="form-control">
                <option value=""></option>
                <?php foreach($esignTemplates as $template){ ?>
                    <option value="<?= $template->id; ?>" <?= $defaultEsignTemplate && $defaultEsignTemplate->template_id == $template->id ? 'selected="selected"' : ''; ?>><?= $template->name; ?></option>
                <?php } ?>
            </select>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="do-not-send-esign">
                <label class="form-check-label" for="do-not-send-esign">
                    Do not send esign
                </label>
            </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" action="approve-and-esign" class="nsm-button primary approve-and-esign d-flex align-items-center" data-action="approve-and-esign">
                <span>Continue</span>
            </button>
        </div>
    <?php }else{ ?>
        <div class="nsm-empty" style="height: auto; padding: 1rem 0;">
            <i class="bx bx-meh-blank"></i>
            <span>No eSign template found.</span>
        </div>
    <?php } ?>
</div>
<script>
$(function(){
    $('#esign-templates').select2({
        placeholder: 'Select esign Template',
        dropdownParent: $("#status-approved-modal"),
    });
});
</script>