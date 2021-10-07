<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Income</span>
        </div>
        <div class="nsm-card-controls">
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
                <div class="nsm-counter h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2><?= $invoice_draft->total; ?></h2>
                            <span>Open Invoices</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="nsm-counter primary h-100 mb-2">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-calendar-exclamation'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2><?= $invoice_due->total ?></h2>
                            <span>Overdue Invoices</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="nsm-counter h-100 success">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                            <i class='bx bx-badge-check'></i>
                        </div>
                        <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                            <h2>0</h2>
                            <span>Paid last 30 days</span>
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
