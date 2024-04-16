<input type='hidden' id="check_count_thumbnails">
<?php
$checkedCount = 0;
foreach ($widgets as $widget) {
    ?>

<div class="nsm-card mb-2">
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-8">
                <span class="content-title d-block mb-1"><?php echo $widget->w_name; ?></span>
                <span class="content-subtitle d-block"><?php echo $widget->w_description; ?></span>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <div class="form-check form-switch">
                    <?php
                        $isJobThumbnail = '';
    if ($checkedCount < 8) {
        $isChecked = $this->wizardlib->isWidgetGlobal($widget->w_id) ? 'checked' : '';
        if ($isChecked) {
            ++$checkedCount;
        }
        $isDisabled = '';
        $isNotSelected = '';
        $onClick = "manipulateThumbnail(this,'{$widget->w_id}')";
    } else {
        $isChecked = '';
        $isDisabled = 'disabled';
        $isNotSelected = 'isnotselected';
    }

    if ($widget->w_view_link == 'widgets/jobs_counter') {
        $isJobThumbnail = 'isjobthumnail';
    }
    ?>
                    <input class="form-check-input ms-0 add_tumbnail_checkbox" type="checkbox"
                        <?php echo $isNotSelected; ?> <?php echo $isDisabled; ?> <?php echo $isJobThumbnail; ?>
                        onclick="<?php echo $onClick; ?>" <?php echo $isChecked; ?> data-addon-delete-modal="open"
                        data-id="WiZ" data-name="WiZ">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>

<script>
$(document).ready(function() {
    $('#check_count_thumbnails').val('<?php echo $checkedCount; ?>');


});
</script>