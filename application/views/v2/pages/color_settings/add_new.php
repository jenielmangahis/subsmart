<?php include viewPath('v2/includes/header'); ?>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>  
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 grid-mb">
                        <div class="nsm-callout primary">Add New Color</div>
                    </div>
                </div>
                <?php echo form_open_multipart('color_settings/create_color_setting', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>  
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-card primary">
                            <div class="nsm-card-header">
                                <div class="nsm-card-title">
                                    <span></span>
                                </div>
                            </div>
                            <div class="nsm-card-content">
                                <div class="row g-3">
                                    <div class="col-4 col-md-4">
                                        <label class="content-subtitle fw-bold d-block mb-2">Name</label>
                                        <input type="text" name="color_name" value=""  class="nsm-field form-control" required="" autocomplete="off" />
                                    </div>
                                    <div class="col-4 col-md-2">
                                        <label class="content-subtitle fw-bold d-block mb-2">Color</label>
                                        <input type="text" name="color_code" class="nsm-field form-control colorpicker" required="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-3 text-end">
                        <button type="button" name="btn_back" class="nsm-button" onclick="location.href='<?php echo url('color_settings/index') ?>'">Go Back to Color List</button>
                        <button type="submit" name="btn_save" class="nsm-button primary">Save</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/bootstrap-colorpicker.min.css") ?>">
<script src="<?= base_url("assets/js/bootstrap-colorpicker.min.js"); ?>"></script>
<script>
$(function(){
    $('.colorpicker').colorpicker();
});
</script>
<?php include viewPath('v2/includes/footer'); ?>