<input type="hidden" name="sid" value="<?= $widgetSection->id; ?>" />
<div class="row">
    <div class="col-12">
        <div class="form-group mt-3 mb-3">
            <label for="exampleInputEmail1">Section Name <span style="margin-left:10px;" class="bx bxs-help-circle" id="help-edit-popover-section"></span></label>
            <input type="text" name="tag_section_name" class="form-control" value="<?= $widgetSection->section_name; ?>" id="" required="" placeholder="">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 mt-4 mb-4">
        <div class="tags-header">
            <span><i class='bx bx-cog' ></i> Tags</span>
            <a class="nsm-button small ms-0 mb-4" id="btn-edit-esign-add-new-tag"><i class='bx bxs-plus-circle' style="position:relative;top:1px;"></i> Add New Tag</a>
        </div>
    </div>
    <div class="col-12" id="edit-tags-container">
        <?php if( $widgetTags ){ ?>
            <?php $row = 1; ?>
            <?php foreach($widgetTags as $widget){ ?>
                <div class="tag-group-1 edit-tag-rows">
                    <div class="form-group mt-3" style="margin-bottom:8px;">
                        <label>Tag Name</label>
                        <input type="text" name="tagNames[]" class="form-control <?= $row > 1 ? 'text-tag-name' : ''; ?>" value="<?= $widget->tag_name; ?>" id="" required="" placeholder="">
                        <?php if( $row > 1 ){ ?>
                            <a class="btn-edit-delete-row-tag-widget nsm-button" data-id="<?= $row; ?>" href="javascript:void:void(0);"><i class='bx bx-trash help-widget-row-remove'></i></a>
                        <?php } ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6" style="margin-top:0px;">
                            <label>Autopopulate Data</label>
                            <select name="tagAutoPopulate[]" class="form-control edit-default-dropdown edit-sel-autopopulate-data">
                                <?php foreach($optionAutoPopulateData as $key => $value){ ?>
                                    <option <?= $widget->auto_populate_data == $key ? 'selected="seletected"' : '';  ?> value="<?= $key; ?>"><?= $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6" style="margin-top:0px;">
                            <label>Fields</label>
                            <select name="tagFields[]" class="form-control edit-default-dropdown edit-sel-autopopulate-fields">
                                <?php if( $widget->auto_populate_data == 'Customer' ){ ?>
                                    <?php foreach($optionCustomerFields as $key => $value){ ?>
                                        <option <?= $widget->auto_populate_field == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                <?php }elseif( $widget->auto_populate_data == 'Invoice' ){ ?>
                                    <?php foreach($optionInvoiceFields as $key => $value){ ?>
                                        <option <?= $widget->auto_populate_field == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                <?php }elseif( $widget->auto_populate_data == 'Company' ){ ?>
                                    <?php foreach($optionCompanyFields as $key => $value){ ?>
                                        <option <?= $widget->auto_populate_field == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                    <?php } ?>
                                <?php } ?>                                
                            </select>
                        </div>
                    </div>
                </div>
            <?php $row++;} ?>
        <?php }else{ ?>
            <div class="tag-group-1 tag-rows">
                <div class="form-group mt-3" style="margin-bottom:8px;">
                    <label>Tag Name</label>
                    <input type="text" name="tagNames[]" class="form-control" id="" required="" placeholder="">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6" style="margin-top:0px;">
                        <label>Autopopulate Data</label>
                        <select name="tagAutoPopulate[]" class="form-control edit-default-dropdown sel-autopopulate-data">
                            <?php foreach($optionAutoPopulateData as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6" style="margin-top:0px;">
                        <label>Fields</label>
                        <select name="tagFields[]" class="form-control edit-default-dropdown sel-autopopulate-fields">
                            <?php foreach($optionCustomerFields as $key => $value){ ?>
                                <option value="<?= $key; ?>"><?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
$(function(){
    var editOptionCustomerFields = <?= json_encode($optionCustomerFields); ?>;
    var editOptionCompanyFields  = <?= json_encode($optionCompanyFields); ?>;
    var editOptionInvoiceFields  = <?= json_encode($optionInvoiceFields); ?>;   
    var editOptionJobFields      = <?= json_encode($optionJobFields); ?>; 

    $('.edit-default-dropdown').select2({
        dropdownParent: $("#modal-edit-tags")
    });

    $('#help-edit-popover-section').popover({
        placement: 'top',
        html : true, 
        trigger: "hover focus",
        content: function() {
            return 'Tag section / group name';
        } 
    });

    $(document).on('change', '.edit-sel-autopopulate-data', function(){
        var selected = $(this).val();
        var $el = $(this).closest('.form-row').find(".edit-sel-autopopulate-fields");
        if( selected == 'Customer' ){
            $el.empty(); 
            $.each(editOptionCustomerFields, function(key,value) {
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }else if( selected == 'Invoice' ){
            $el.empty(); 
            $.each(editOptionInvoiceFields, function(key,value) {                
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }else if( selected == 'Company' ){
            $el.empty(); 
            $.each(editOptionCompanyFields, function(key,value) {                
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }else if( selected == 'Job' ){
            $el.empty(); 
            $.each(editOptionJobFields, function(key,value) {                
                $el.append($("<option></option>").attr("value", key).text(value));
            });
        }
    });

    $('#btn-edit-esign-add-new-tag').on('click', function(){
        var rows = $('.edit-tag-rows').length + 1;
        var component = `
        <div class="edit-tag-group-${rows} edit-tag-rows">
            <div class="form-group mt-3" style="margin-bottom:8px;">
                <label>Tag Name</label><br />
                <input type="text" name="tagNames[]" class="form-control text-tag-name" id="" required="" placeholder="">
                <a class="btn-edit-delete-row-tag-widget nsm-button" data-id="${rows}" href="javascript:void:void(0);"><i class='bx bx-trash help-widget-row-remove'></i></a>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6" style="margin-top:0px;">
                    <label>Autopopulate Data</label>
                    <select name="tagAutoPopulate[]" class="form-control default-dropdown edit-sel-autopopulate-data">
                        <?php foreach($optionAutoPopulateData as $key => $value){ ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6" style="margin-top:0px;">
                    <label>Fields</label>
                    <select name="tagFields[]" class="form-control default-dropdown edit-sel-autopopulate-fields">
                        <?php foreach($optionCustomerFields as $key => $value){ ?>
                            <option value="<?= $key; ?>"><?= $value; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>`;
        
        $('#edit-tags-container').append(component);
        $('.edit-default-dropdown').select2({
            dropdownParent: $("#modal-edit-tags")
        });

        $('.help-widget-row-remove').popover({
            placement: 'top',
            html : true, 
            trigger: "hover focus",
            content: function() {
                return 'Delete Widget';
            } 
        });
    });

    $(document).on('click', '.btn-edit-delete-row-tag-widget', function(){        
        var row = $(this).attr('data-id');
        $('.edit-tag-group-'+row).fadeOut("slow", function() {
            $(this).remove();
        });
        $("[data-toggle='popover']").popover('hide');
    });
});
</script>