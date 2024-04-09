<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<style>
.leads-container {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <div class="nsm-card-header">
                <div class="nsm-card-title summary-report-header">
                    <div class="icon-summary-leads">
                        <i class="bx bx-fw bx-notepad"></i>
                    </div>
                    <span style="color:#c7951c ">New Leads</span>
                </div>
            </div>
        </div>
        <div class="nsm-card-controls">

            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content" style="  height: calc(100% - 120px);">
        <div class="row h-100">
            <div class="col-12 col-lg-12 leads-container">
                <div class="text-center summary-report-body">
                    <label for="">Total Leads</label>
                    <h1><?= $leads ?></h1>

                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class="nsm-button btn-sm m-0 me-2" href="customer/leads">
            <i class='bx bx-right-arrow-alt'></i>
        </a>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>