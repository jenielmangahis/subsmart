<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter.h-100.yellow {
        background-color: #fef5e0;
    }

    i.bx.bx-box.subs {
        background-color: #ffeab9;
        color: #cda030;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Today </span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="nsm-counter  yellow  h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-dollar-circle"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Sales</span>
                            <h2 id="today_sales"></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="nsm-counter primary  h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-briefcase-alt-2"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Jobs Created</span>
                            <h2 id="today_jobs_created"></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="nsm-counter yellow h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-badge-check"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Jobs Done</span>
                            <h2 id="today_jobs_done"></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-2">
                <div class="nsm-counter  success h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-receipt"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Collected</span>
                            <h2 id="today_collected"></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12  mb-2">
                <div class="nsm-counter error  h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-task-x"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Jobs Canceled</span>
                            <h2 id="today_jobs_canceled"></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="nsm-counter primary  h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 order-sm-last mb-2 mb-md-0 d-flex justify-content-center justify-content-md-end align-items-center">
                            <i class="bx bx-calendar-plus"></i>
                        </div>
                        <div class="col-12 col-md-8 mb-2 mb-md-0 d-flex flex-column align-items-center align-items-md-start justify-content-between">
                            <span>Service Scheduled</span>
                            <h2 id="today_service_scheduled"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>