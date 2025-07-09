<style>
.lead-contact-form-field label{
    font-size : <?= $leadForm && $leadForm->text_size > 0 ? $leadForm->text_size : 12; ?>px;
    font-family : <?= $leadForm && $leadForm->text_font != '' ? $leadForm->text_font : 'Arial, Helvetica, sans-serif'; ?>;
    color : <?= $leadForm && $leadForm->text_color != '' ? $leadForm->text_color : '#000000'; ?>;
}
#widget-contact button{
    background-color: <?= $leadForm && $leadForm->button_color != '' ? $leadForm->button_color : '#6a4a86'; ?>;
    color: <?= $leadForm && $leadForm->button_text_color != '' ? $leadForm->button_text_color : '#ffffff'; ?>;
}
</style>
<form id="widget-contact" method="post">
    <?php foreach($customizeLeadFormsDefault as $form) : ?>
        <?php $field_key = substr(str_replace(' ', '', $form->field), 0, 8); ?>
        <div id="<?php echo 'pf_'.$field_key; ?>" class="form-group lead-contact-form-field">
            <label><?php echo $form->field; ?></label>
            <span id="<?php echo 'pf_req_'.$field_key; ?>" class="form-required">*</span>
            <input type="text" name="<?= $field_key; ?>" class="form-control">
        </div>
    <?php endforeach; ?>
    <?php foreach($customizeLeadForms as $form) : ?>
        <?php $field_key = substr(str_replace(' ', '', $form->field), 0, 8); ?>
        <?php if( $form->visible == 1 ){ ?>
            <div id="<?php echo 'pf_' . $field_key ?>" class="form-group lead-contact-form-field">
                <label><?php echo $form->field; ?></label>
                <?php if( $form->required == 1 ){ ?>
                    <span id="<?php echo 'pf_req_' . $field_key; ?>" class="form-required">*</span>
                <?php } ?>
                <input type="text" name="<?= $field_key; ?>" class="form-control">
            </div>
        <?php }else{ ?>
            
            <input type="hidden" name="<?= $field_key; ?>" class="form-control">
        <?php } ?>
        
    <?php endforeach; ?>
    <hr class="card-hr">
    <div class="widget-contact-submit">
        <button class="nsm-button primary margin-right">Send</button>
    </div>
</form>