<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-lg-12">';
endif;
?>
<style>
    :root {
        --customer-status-primary: #281c2d;
        --customer-status-secondary: #BEAFC2;
        --customer-status-tertiary: #d9a1a0;
        --customer-status-quaternary: #F5EFFF;
        --black: #000;
        --customer-status-color1: #BEAFC2;
        --customer-status-color2: #FEA303;
        --customer-status-color3: #281c2d;
        --customer-status-color4: #214548;
    }

    .customer-status-items {
        height: 700px;
    }

    .customer-status-container .spacer {
        padding-top: 100px;
    }

    .customer-status-items .item {
        display: block;
        padding: 10px;
        color: var(--customer-status-color4);
        border-radius: 10px;
        gap: 10px;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        height: 100%;
    }

    .customer-status-items .item .first {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
        align-items: center;
        justify-content: center;
    }

    .customer-status-items .item .first .icons {
        border-radius: 100%;
    }

    .customer-status-items .item .first .icons i {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 40px;
        border-radius: 100%;
    }

    .customer-status-items .item .count {
        width: 100%;
        text-align: left;
        color: var(--jobs-primary);
    }

    .customer-status-items .item .first label {
        font-size: 30px;
        font-weight: bold;
        line-height: 1;
    }

    .customer-status-items .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
    }

    #customer_status {
        padding: 20px;
    }

    @media screen and (max-width: 1366px) {
        .customer-status-items .item .first label {
            font-size: 18px;

        }

        .customer-status-items .item .first i {
            font-size: 18px;

        }

        .customer-status-items .column-container {
            width: 33%;
        }
    }

    @media screen and (max-width: 1200px) {

        .customer-status-items .column-container {
            width: 50%;
        }

        #customer_status {
            overflow: auto;
            height: 90%;
        }
    }

    @media screen and (max-width: 991px) {

        .customer-status-items .column-container {
            width: 25%;
        }
    }

    @media screen and (max-width: 567px) {

        .customer-status-items .column-container {
            width: 50%;
        }
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Customer Status</span>
        </div>
        <div class="nsm-card-controls">
            <!--<a role="button" class="nsm-button btn-s m m-0 me-2" id="table-modal">
                See More
            </a>-->
            <a href="<?= base_url('customer') ?>" role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content jobs_stat">
        <div class="col-md-12">
            <div class="banner">
                <img src="./assets/img/customer-status-banner3.svg" alt="">
            </div>
            <div class="nsm-widget-table">
                <div class="customer-status-container">
                    <div class="col-md-12 row-pad customer-status-items">
                        <div class="row" id="customer_status">
                        </div>
                    </div>
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
