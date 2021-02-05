<?php
foreach ($widgets as $w):
    ?>
    <div class="list-group col-lg-12 float-left">
        <a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start mb-3">

            <div class="col-lg-12 no-padding float-left">
                
                <div class="col-lg-3 onoffswitch float-right mt-2 no-padding">
                    <input <?= $this->wizardlib->isWidgetUsed($w->w_id) ? 'checked' : '' ?> onclick="manipulateWidget(this,'<?= $w->w_id ?>')" type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" data-addon-delete-modal="open" data-id="WiZ" data-name="WiZ" id="onoff-<?= $w->w_id ?>">
                    <label class="onoffswitch-label" for="onoff-<?= $w->w_id ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
                <div class="col-lg-9 float-left no-padding">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?= $w->w_name ?></h5>
                    </div>
                    <p class="mb-1 text-left"><?= $w->w_description ?></p>
                </div>

            </div>

            <div class="float-left mt-2">
                <input <?= $this->wizardlib->isWidgetGlobal($w->w_id) ? 'checked' : '' ?> type="checkbox" id="widgetGlobal_<?= $w->w_id ?>" >
                Available to All Users
            </div>
        </a> 
    </div>

    <?php
endforeach;

