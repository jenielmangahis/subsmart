<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<style>
    #recent-customer-container .controls span {
        border-radius: 25px;
        font-weight: bold;
        color: #00;
        font-size: 12px;
    }

    #recent-customer-container {
        overflow: auto;
        height: 70%;
        width: 95%;
        margin: 0 10px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
    }

    @media screen and (max-width: 1200px) {
        .nsm-widget-table .recent-customer-item-main .widget-item .content .details {
            width: 60% !important;
            justify-content: start;
        }

        .recent-customer-item-main .widget-item {
            width: 400px;
        }
    }

    @media screen and (max-width: 991px) {

        .recent-customer-item-main .widget-item {
            width: 100%;
        }
    }

    @media screen and (max-width: 567px) {

        .recent-customer-item-main .widget-item .content {
            justify-content: start;
        }

        .nsm-widget-table .recent-customer-item-main .widget-item .content .details {
            width: 100% !important;
        }
    }
</style>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Recent Customers</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url() ?><?php if ($var == 1) {
                echo 'customer';
            } else {
                echo 'job';
            } ?>">
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
            <div class="banner">
                <img src="./assets/img/recent-customers-banner3.svg" alt="">
            </div>
            <div class="nsm-widget-table">
                <div class="recent-customer-item-main">
                    <div class="recent-custom-item table-responsive">
                        <div id="recent-customer-container">
                            <div class="nsm-loader">
                                <i class='bx bx-loader-alt bx-spin'></i>
                            </div>
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
