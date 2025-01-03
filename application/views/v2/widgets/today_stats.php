<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .nsm-counter h3 {
        margin: unset;
        font-weight: bold;
    }

    .ytd-items-container {
        padding: 10px
    }

    .ytd-items-container .item {
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
        width: 90%;
        margin: auto;
    }

    .ytd-items-container .item .first {
        display: flex;
        gap: 10px;
        align-items: center;
        margin-bottom: 5px;
        justify-content: center;
    }

    .ytd-items-container .item .first .icons {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        height: 38px;
        width: 40px;
        border-radius: 100%;
    }

    .ytd-items-container .item .count {
        width: 100%;
        text-align: left;
        color: #281c2d;
    }

    .ytd-items-container .item .first label {
        font-size: 20px;
        font-weight: bold;
        line-height: 1;
    }

    .ytd-items-container .item .count p {
        font-size: 14px;
        font-weight: 600;
        margin: 0;
        text-align: center;
    }
    @media screen and (max-width: 1366px) {
        .ytd-items-container .col-4 {
            width: 50%;
        }
    }

    @media screen and (max-width: 460px) {
        .ytd-items-container .col-4 {
            width: 80%;
            margin: auto;
        }
    }


</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="thumbnail_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Today's Stats</span>
        </div>
        <div class="nsm-card-controls">
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
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner mb-3">
                <img src="./assets/img/ytd-stats-banner2.svg" alt="">
            </div>
            <div class="row ytd-items-container">
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#FEA3032a"></div>
                            <div class="first">
                                <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                    <i class='bx bx-wallet'></i>
                                </div>
                                <label id="earned"></label>
                            </div>
                            <div class="count">
                                <p>Earned</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#d9a1a02a"></div>

                            <div class="first">
                                <div class="icons" style="color:#d9a1a0;background:#d9a1a01a">
                                    <i class='bx bx-box'></i>
                                </div>
                                <label id="invoice_amount_stats"></label>
                            </div>
                            <div class="count">
                                <p>Invoice Amount</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#A888B52a"></div>
                            <div class="first">
                                <div class="icons" style="color:#A888B5;background:#A888B51a">
                                    <i class='bx bx-list-check'></i>
                                </div>
                                <label id="jobs_completed"></label>
                            </div>
                            <div class="count">
                                <p>Jobs Completed</p>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#EFB6C82a"></div>

                            <div class="first">
                                <div class="icons" style="color:#EFB6C8;background:#EFB6C81a">
                                    <i class='bx bx-bookmarks'></i>
                                </div>
                                <label id="jobs_added"></label>
                            </div>
                            <div class="count">
                                <p>New Jobs</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#FEA3032a"></div>
                            <div class="first">
                                <div class="icons" style="color:#FEA303;background:#FEA3031a">
                                    <i class='bx bx-task-x'></i>
                                </div>
                                <label id="lost_accounts"></label>
                            </div>
                            <div class="count">
                                <p>Lost Accounts</p>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-4 mb-4">
                    <div class="row h-100">
                        <div class="item">
                            <div class="box" style="background:#A888B52a"></div>
                            <div class="first">
                                <div class="icons" style="color:#A888B5;background:#A888B51a">
                                    <i class='bx bx-box'></i>
                                </div>
                                <label id="service_project_income"></label>
                            </div>
                            <div class="count">
                                <p>Service Projective Income</p>
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
