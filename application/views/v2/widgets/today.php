<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
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

    .today-items-contianer {
        padding: 10px
    }

    .today-items-contianer .item {
        display: block;
        padding: 10px;
        color: #214548;
        border-radius: 10px;
        gap: 10px;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        height: 100%;
        width: 80%;
        margin: auto;
    }

    .today-items-contianer .item .first {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 5px;
        justify-content: center;
    }

    .today-items-contianer .item .first .icons {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 40px;
        border-radius: 100%;
    }

    .today-items-contianer .item .count {
        width: 100%;
        text-align: left;
        color: #281c2d;
    }

    .today-items-contianer .item .first label {
        font-size: 20px;
        font-weight: bold;
        line-height: 1;
    }

    .today-items-contianer .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
    }

    @media screen and (max-width: 460px) {
        .today-items-contianer .col-6 {
            width: 100%;
        }

        .today-items-contianer .item .first label {
            font-size: 24px;
        }
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Today </span>
        </div>
        <div class="nsm-card-controls">
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
                <img src="./assets/img/today-banner3.svg" alt="">
            </div>
            <div class="row today-items-contianer">
                <div class="col-6 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#FEA3032a"></div>
                            <div class="first">
                                <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                    <i class="bx bx-dollar-circle"></i>
                                </div>
                                <label id="today_sales"></label>
                            </div>
                            <div class="count">
                                <p>Sales</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#d9a1a02a"></div>

                            <div class="first">
                                <div class="icons" style="color:#d9a1a0;background:#d9a1a01a">
                                    <i class="bx bx-briefcase-alt-2"></i>
                                </div>
                                <label id="today_jobs_created"></label>
                            </div>
                            <div class="count">
                                <p>Jobs Created</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#A888B52a"></div>
                            <div class="first">
                                <div class="icons" style="color:#A888B5;background:#A888B51a">
                                    <i class="bx bx-badge-check"></i>
                                </div>
                                <label id="today_jobs_done"></label>
                            </div>
                            <div class="count">
                                <p>Jobs Done</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#EFB6C82a"></div>

                            <div class="first">
                                <div class="icons" style="color:#EFB6C8;background:#EFB6C81a">
                                    <i class="bx bx-receipt"></i>
                                </div>
                                <label id="today_collected"></label>
                            </div>
                            <div class="count">
                                <p>Collected</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#FEA3032a"></div>
                            <div class="first">
                                <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                    <i class="bx bx-task-x"></i>
                                </div>
                                <label id="today_jobs_canceled"></label>
                            </div>
                            <div class="count">
                                <p>Jobs Canceled</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6  mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#d9a1a02a"></div>

                            <div class="first">
                                <div class="icons" style="color:#d9a1a0;background:#d9a1a01a">
                                    <i class="bx bx-calendar-plus"></i>
                                </div>
                                <label id="today_service_scheduled"></label>
                            </div>
                            <div class="count">
                                <p>Service Scheduled</p>
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
