<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Recurring Service Plans</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>inventory/plans">
                Setup a Plan
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row h-100 gy-2">
            <div class="col-12">
                <div class="nsm-counter success h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class='bx bx-check-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Active Service Plans</span>
                            <h2><?= $plan_type[0]->totalPlan; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="nsm-counter error h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class='bx bx-calendar-exclamation'></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Agreements to expire in 30 days</span>
                            <h2><?= $total_agreements_to_expire_in_30_days; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="nsm-counter primary h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class='bx bx-dollar-circle'></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Total $ Recurring Payment</span>
                            <h2><?= $total_recurring_payment; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>
