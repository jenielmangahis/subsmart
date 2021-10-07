<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Paid Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?>">
                See Reports
            </a>
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
        <div class="row h-100">
            <div class="col-12">
                <div class="nsm-counter primary h-100">
                    <div class="row h-100">
                        <div class="col-12 col-md-4 mb-2 mb-md-0 d-flex justify-content-center align-items-center">
                            <i class='bx bx-receipt'></i>
                        </div>
                        <div class="col-12 col-md-8 d-flex justify-content-center align-items-center">
                            <div class="row" style="height: 100%; max-height: 150px;">
                                <div class="col-12 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2>$<?= number_format((float)$total_amount_invoice->total, 2, '.', ','); ?></h2>
                                    <span>Paid</span>
                                </div>
                                <div class="col-12 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?= $total_invoice_paid->total; ?></h2>
                                    <span>All paid invoices</span>
                                </div>
                            </div>
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