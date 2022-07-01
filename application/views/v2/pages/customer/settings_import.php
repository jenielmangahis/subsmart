<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/customer_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            A great process of managing interactions with existing as well as past and potential customers is to have one powerful platform that can provide an immediate response to your customer needs.
                            Try our quick action icons to create invoices, scheduling, communicating and more with all your customers.
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-12">
                        <div class="nsm-card">
                            <div class="nsm-card-content">
                                <div class="row g-2">
                                    <div class="col-12">
                                        <div class="nsm-card-title">
                                            <span>Customer Import Fields</span>
                                        </div>
                                        <label class="nsm-subtitle mb-3">Check the column title for mapping import customer.</label>
                                        <form id="customer_headers_form" method="POST">
                                            <div class="row">
                                                <?php $fieldsValue = $importFields->value ? explode(',', $importFields->value) : array() ; ?>
                                                <?php $headers = csvHeaderToMap(); $count = 0;?>
                                                <?php foreach ($headers as $header):
                                                $checked  = '';
                                                    if (in_array($count, $fieldsValue)) {
                                                        $checked = 'checked="checked"';
                                                    }
                                                ?>
                                                    <div class="col-12 col-md-6">
                                                        <div class="d-block">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="headers[]" value='<?= $count; ?>' <?= $checked; ?>>
                                                                <label class="form-check-label" for=""><?= $header; ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php $count++; endforeach; ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-end">
                        <button type="button" data-action="save" class="nsm-button primary" id="btn_save_fields">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#btn_save_fields").on("click", function() {
            var selectedField = [];
            $('input[name="headers[]"]').each(function( ) {
                if($(this).is(':checked')){
                    selectedField.push(this.value);
                }
            });
            const formData = new FormData();
            formData.append('importFields', JSON.stringify(selectedField));

            fetch('<?= base_url('customer/addOrUpdateImportFields') ?>', {
                method: 'POST',
                body: formData,
            }) .then(response => response.json() ).then(response => {
                var { message, success }  = response;
                if(success){
                    //window.location.reload();
                }
            }).catch((error) => {
                console.log('Error:', error);
            });
            
        });
    });
</script>
<?php include viewPath('v2/includes/footer'); ?>