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
                    <input class="form-check-input ms-0" type="checkbox"  onclick="manipulateWidget(this,'<?= $widget->w_id ?>')" <?= $this->wizardlib->isWidgetUsed($widget->w_id) ? 'checked' : '' ?> data-addon-delete-modal="open" data-id="WiZ" data-name="WiZ">
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="form-check d-inline-block me-2 mb-0">
                    <input class="form-check-input" type="checkbox" value="" id="widgetGlobal_<?= $widget->w_id ?>" <?= $this->wizardlib->isWidgetGlobal($widget->w_id) ? 'checked' : '' ?>>
                    <label class="form-check-label content-subtitle" for="widgetGlobal_<?= $widget->w_id ?>">
                        Available to All Users
                    </label>
                </div>
                <div class="form-check d-inline-block mb-0">
                    <input class="form-check-input" type="checkbox" value="" id="widgetGlobal_<?= $widget->w_id ?>" <?= $this->wizardlib->isWidgetMain($widget->w_id) ? 'checked' : '' ?>>
                    <label class="form-check-label content-subtitle" for="widgetGlobal_<?= $widget->w_id ?>">
                        Add to Main Widget
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
endforeach;
?>