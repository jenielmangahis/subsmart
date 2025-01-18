<div class="row">
<div class="col-md-12 form-group mt-2" id="service-ticket-esign-template">                            
        <label for="esign-template-list"><b>Select Template</b></label>
        <select class="form-control nsm-field form-select" name="esign_template" id="customer-send-esign-template">
            <?php foreach($esignTemplates as $e){ ?>
                <?php 
                    $template_name = $e->name;
                    if( $e->is_default == 1 ){
                        $template_name = $e->name .'(default)';
                    }    
                ?>
                <option <?= $e->is_default == 1 ? 'selected="selected"' : ''; ?> value="<?= $e->id; ?>"><?= $template_name; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<script>
$(function(){
    $('#customer-send-esign-template').select2({
        dropdownParent: $("#modal-send-esign"),
    });
});
</script>