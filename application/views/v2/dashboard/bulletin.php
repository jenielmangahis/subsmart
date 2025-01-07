<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .timesheet-container-item {
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        overflow: auto;
        min-height: 400px;
        height: 400px;
        width: 95%;
        margin: auto;
    }

    .timesheet-container-item .profile {
        margin: auto;
        width: 35px;
        height: 35px;
        min-width: 40px;
        background-color: #6a4a86;
        color: #fff;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        border: 2px solid #fff;
        position: relative;
        z-index: 1;
    }

    .timesheet-container-item .profile-wrapper::before {
        content: "";
        position: absolute;
        top: 2px;
        left: 3px;
        width: 45px;
        height: 42px;
        background: linear-gradient(135deg, #FEA303, #281c2d);
        border-radius: 50%;
        z-index: 0;
    }

    .timesheet-container-item .nsm-widget-table .widget-item {
        position: relative;
        gap: 20px;
    }

    .timesheet-container-item .content .badge-item {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
        background: #EFB6C8;
        text-align: center;
        width: unset;
        width: 70%;
        margin-top: 5px;
    }

    .timesheet-container-item .timesheet-item {
        font-size: 16px !important;
        font-weight: bold !important;
        color: #000 !important;
    }

    @media screen and (max-width: 1200px) {
        .nsm-widget-table .timesheet-container .widget-item.timesheet-item .content .details {
            width: 100% !important;
        }

    }



    @media screen and (max-width: 991px) {
        .timesheet-container-item .content .badge-item {
            width: 35%;
        }
    }

    @media screen and (max-width: 460px) {
        .timesheet-container-item .content .badge-item {
            width: 50%;
        }
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Timesheet</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url() . 'timesheet/attendance'; ?>">
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
    <div class="nsm-card-content">
        <div class="col-md-12">
            <div class="banner">
                <img src="./assets/img/activity-logs-banner.svg" alt="">
            </div>
            <div class="timesheet-container-item table-responsive">
                <div class="nsm-widget-table">
                    <div class="row timesheet-header">
                        <div class="widget-item timesheet-item ">
                            <div class="content">
                                <div class="details" style="width:45% !important;">
                                    <span class="content-subtitle">Employee</span>
                                </div>
                                <div class="controls">
                                    <div class="timesheet-group">
                                        <div class="timesheet-time">
                                            <span class="content-subtitle d-block">In</span>
                                        </div>
                                        <div class="timesheet-time">
                                            <span class="content-subtitle d-block">Out</span>
                                        </div>
                                    </div>
                                    <div class="timesheet-group">
                                        <div class="timesheet-time">
                                            <span class="content-subtitle d-block">Lunch In</span>
                                        </div>
                                        <div class="timesheet-time">
                                            <span class="content-subtitle d-block">Lunch Out</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row timesheet-container"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadTimesheet();
    });

    function loadTimesheet() {
        // console.log("called");
        $.ajax({
            url: base_url + 'widgets/loadV2Timesheet',
            method: 'get',
            data: {},
            success: function(response) {
                $('.timesheet-container').html(response);
                //setTimeout(function() {loadTimesheet()}, 2000);
            }

        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
