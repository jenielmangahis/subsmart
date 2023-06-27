<?php 
    $details = explode(',', trim($module_sort->ams_values));    
    foreach ($widgets as $w):
        if(in_array(strtolower($w->ac_id), $details)):
            $isUsed = true;
        else:
            $isUsed = false;
        endif;
?>

<div class="nsm-card mb-2 h-auto">
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-8">
                <span class="content-title d-block mb-1"><?= $w->ac_name ?></span>
                <span class="content-subtitle d-block">Enable to <?= $w->ac_name ?> module in the grid</span>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <div class="form-check form-switch">
                    <input class="form-check-input ms-0" type="checkbox" name="" onclick="manipulateModules(this,'<?= $w->ac_id ?>')" <?= $isUsed ? 'checked' : '' ?>>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>