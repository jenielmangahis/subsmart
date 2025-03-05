<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" data-bs-toggle="modal" data-bs-target="#new_lead_types_modal">
        <i class="bx bx-plus"></i>
    </div>
</div>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php //include viewPath('v2/includes/page_navigations/customer_settings_tabs'); ?>
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <form id="frm-customer-form-settings">
            <div class="nsm-page">
                <div class="nsm-page-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="nsm-callout primary">
                                <button><i class='bx bx-x'></i></button>
                                Customize your customer advance form by changing its field name or hiding it.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach( $formFields as $group_key => $fields ){ ?>
                            <?php 
                                $is_hidden = false;
                                if( ($group_key == 'solar-information') && ( !in_array(logged('company_id'), adi_company_ids()) ) ){ 
                                    $is_hidden = true;
                                }

                                if( ($group_key == 'alarm-information' && logged('industry_type') != 'Alarm Industry') ){                                     
                                    $is_hidden = true;                                                
                                }
                            ?>
                            <?php if( !$is_hidden ){ ?>
                                <?php 
                                    $group = strtolower(str_replace("-"," ", $group_key)); 
                                    $group = ucwords($group);
                                ?>
                                <?php 
                                    $is_group_disabled = false;
                                    if( $formGroups ){
                                        if( ($companyFormSetting && $companyFormSetting[$group_key] && $formGroups[$group_key]['total_disabled']) ){
                                            if( count($companyFormSetting[$group_key]) == $formGroups[$group_key]['total_disabled'] ){
                                                $is_group_disabled = true;
                                            }
                                        } 
                                    }    
                                ?>
                                <div class="col-md-6 mb-2">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header">
                                            <div class="nsm-card-title">
                                                <span><i class='bx bx-fw bxs-edit'></i> <?= $group; ?></span>                                            
                                                <div class="form-check pull-right">
                                                    <input class="form-check-input chk-field-group" name="hideGroup[<?= $group_key; ?>]" data-group="<?= $group_key; ?>" type="checkbox" value="yes" <?= $is_group_disabled ? 'checked="checked"' : ''; ?> id="group-chk-<?= $group_key; ?>">
                                                    <label class="form-check-label" for="group-chk-<?= $group_key; ?>">
                                                    Do not show this section
                                                    </label>
                                                </div>
                                            </div>
                                        </div>                            
                                        <div class="nsm-card-content" id="field-group-<?= $group_key; ?>">
                                            <div class="row">
                                                <?php foreach($fields as $key => $value){ ?>                                    
                                                    <label for="field-<?= $key; ?>" class="col-sm-3 col-form-label mb-2">
                                                        <?php 
                                                            $field_value = $value['field_name'];
                                                            $field_disabled = $is_group_disabled ? true : false;
                                                            if( $companyFormSetting ){
                                                                if( $companyFormSetting[$group_key][$key] ){
                                                                    $field_value    = $companyFormSetting[$group_key][$key]['value'];
                                                                    $field_disabled = $companyFormSetting[$group_key][$key]['is_enabled'] == 1 ? false : true; 
                                                                } 
                                                            }
                                                        ?>
                                                        <input class="form-check-input chk-row-field" name="isHiddenField[<?= $group_key; ?>][<?= $key; ?>]" value="yes" data-key="<?= $key; ?>" type="checkbox" id="chk-<?= $key; ?>" <?= $field_disabled ? 'checked' : ''; ?>>
                                                        <?= $value['field_name']; ?>
                                                    </label>
                                                    <div class="col-sm-3 mb-2">
                                                        <input type="text" name="fieldName[<?= $group_key; ?>][<?= $key; ?>]" class="form-control field-input" id="field-<?= $key; ?>" value="<?= $field_value; ?>" <?= $field_disabled ? 'readonly="readonly"' : ''; ?>>
                                                    </div>                                    
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-end">
                            <button type="submit" class="nsm-button primary" id="btn-save-setting">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {        
        $('.field-input').popover({
            placement: 'right',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Change field label';
            }
        });

        $('.chk-row-field').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'Hide field';
            }
        });

        $('.chk-field-group').popover({
            placement: 'top',
            html: true,
            trigger: "hover focus",
            content: function() {
                return 'This will hide form section in customer add form. <br /><br /><b>Note: Removing this section will reset customer data related to this section.</b>';
            }
        });

        $('.chk-field-group').on('change', function(){
            var group = $(this).attr('data-group');
            if( $(this).is(':checked') ){
                $(this).parent().parent().parent().parent().parent().find('.nsm-card-content :input').prop('readonly', true); 
                $(this).parent().parent().parent().parent().parent().find('.nsm-card-content :checkbox').prop('checked', true);                
            }else{
                $(this).parent().parent().parent().parent().parent().find('.nsm-card-content :input').prop('readonly', false);                
                $(this).parent().parent().parent().parent().parent().find('.nsm-card-content :checkbox').prop('checked', false);                
            }
        });

        $('.chk-row-field').on('change', function(){
            var row_key = $(this).attr('data-key');
            if( $(this).is(':checked') ){
                $(`#field-${row_key}`).prop('readonly', true);
            }else{
                $(`#field-${row_key}`).prop('readonly', false);
            }
        });

        $('#frm-customer-form-settings').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: base_url + 'customer/_save_customer_form_settings',
                data: $(this).serialize(),
                dataType:"json",
                success: function(result) {
                    $('#btn-save-setting').html('Save');

                    if (result.is_success) {
                        Swal.fire({
                            title: 'Customer Form Settings',
                            html: 'Setting was successfully updated',
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                
                            //}
                        });   
                    }else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }
                },
                beforeSend: function(){
                    $('#btn-save-setting').html('<span class="bx bx-loader bx-spin"></span>');
                }
            });
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>