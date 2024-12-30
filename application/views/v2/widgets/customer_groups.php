<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .widget-legend-header {
        margin-top: 48px;
        margin-bottom: 49px;
        background-color: #6a4a86;
        color: #ffffff;
        padding: 10px;
    }

    .customer-groups-container .customer-groups-items {
        margin: 0 20px;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
    }

    .customer-groups-container .customer-groups-items canvas {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        box-shadow: 0px 3px 12px #38747859;
        padding: 20px;
        border-radius: 25px;
        background: #fff;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Customer Groups</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('customer/group') ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner mb-5">
                <img src="./assets/img/customer-groups-banner.svg" alt="">
            </div>
            <div class="customer-groups-container">
                <div class=" customer-groups-items">
                    <canvas id="customer_groups_chart" class="nsm-chart" data-chart-type="customer-groups"
                        style="width:100% !important"></canvas>
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
