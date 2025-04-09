<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .open-invoices-container .open-invoices-items {
        margin: 0 20px;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        height: 100%;
        display: flex;
        align-items: center;
        box-shadow: 0px 3px 12px #38747859;
    }

    .open-invoices-container .open-invoices-items canvas {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        /* box-shadow: 0px 3px 12px #38747859; */
        padding: 20px;
        border-radius: 25px;
        background: #fff;
    }

</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Open Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('invoices') ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
        <div class="banner ">
                <img src="./assets/img/open-invoices-banner3.svg" alt="">
            </div>
            <div class="open-invoices-container">
                <div class=" open-invoices-items">
                    <canvas id="invoice_chart" class="nsm-chart" data-chart-type="invoices"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
