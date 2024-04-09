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
                    <div class="icon-summary-sales">
                        <i class="bx bx-fw bx-receipt"></i>
                    </div>
                    <span style="color:#6a4a86 ">Sales Summary Report</span>
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
    <div class="nsm-card-content"  style="  height: calc(100% - 120px);">
        <div class="row ">
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-12">
                    <div class="nsm-counter primary  mb-2">
                        <div class="row ">
                            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                <i class='bx bx-receipt'></i>
                            </div>
                            <div
                                class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                <h2 id="total_this_year">$<?php echo get_invoice_amount('total') ?></h2>
                                <span>Total Invoice</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="nsm-counter secondary  mb-2">
                        <div class="row ">
                            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                <i class='bx bx-receipt'></i>
                            </div>
                            <div
                                class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                <h2 id="pending_total">$<?php echo get_invoice_amount('balance') ?></h2>
                                <span>Unpaid</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="nsm-counter success  mb-2">
                        <div class="row">
                            <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                <i class='bx bx-receipt'></i>
                            </div>
                            <div
                                class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                <h2 id="paid_total">$<?php echo get_invoice_amount('paid') ?></h2>
                                <span>Paid</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class='nsm-card-footer'>
        <a role="button" class="nsm-button btn-sm m-0 me-2" href="invoice">
            <i class='bx bx-right-arrow-alt'></i>
        </a>
    </div>
</div>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>