<?php
foreach ($widgets as $widget):
?>

<div class="nsm-card mb-2">
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-8">
                <span class="content-title d-block mb-1"><?= $widget->w_name ?></span>
                <span class="content-subtitle d-block"><?= $widget->w_description ?></span>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input ms-0" type="checkbox"  onclick="manipulateThumbnail(this,'<?= $widget->w_id ?>')" <?= $this->wizardlib->isWidgetGlobal($widget->w_id) ? 'checked' : '' ?> data-addon-delete-modal="open" data-id="WiZ" data-name="WiZ">
                </div>
            </div>
        </div>
    </div>
</div>


<?php
endforeach;
?>