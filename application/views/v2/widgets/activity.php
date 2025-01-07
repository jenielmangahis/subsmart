<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    :root {
        --activities-primary: #281c2d;
        --activities-color1: #BEAFC2;
        --activities-color2: #281c2d;
    }

    #dashboard_activity_logs thead tr {
        font-size: 14px;
        font-weight: bold;
        color: var(--activities-color2);
    }

    #dashboard_activity_logs tbody .job-number {
        color: var(--activities-primary);
    }

    #dashboard_activity_logs tbody .last-update label {
        font-size: 14px;
        font-weight: 600;
    }

    #dashboard_activity_logs tbody .amount label {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
    }

    #dashboard_activity_logs .widget-item {
        gap: 10px;
    }

    #dashboard_activity_logs .content .badge-item {
        padding: 1px 20px;
        border-radius: 25px;
        font-weight: bold;
        color: #fff;
        font-size: 12px;
        text-align: center;
        width: unset;
        width:fit-content;
        margin-top: 5px;
    }

    #dashboard_activity_logs .profile {
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

    #dashboard_activity_logs .profile-wrapper::before {
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

    #dashboard_activity_logs .date-item {
        padding: 5px 10px;
        border-radius: 10px;
        font-weight: bold;
        color: #000;
        font-size: 12px;
        text-align: start;
    }

    #dashboard_activity_logs .date-item i {
        color: #000;
        font-size: 20px;
    }

    #dashboard_activity_logs .date-item p {
        margin: 0 !important;
    }


    #dashboard_activity_logs tbody .view button {
        font-size: 14px;
        padding: 5px;
        height: 30px;
    }

    #dashboard_activity_logs tbody .view button i {
        color: var(--activities-primary);
    }

    #dashboard_activity_logs .nsm-table-pagination .pagination {
        gap: 10px;
    }

    #dashboard_activity_logs .nsm-table-pagination .pagination li a.prev,
    #dashboard_activity_logs .nsm-table-pagination .pagination li a.next {
        border: none;
    }

    #dashboard_activity_logs .nsm-table-pagination .pagination li a {
        border-radius: 50%;
    }

    #dashboard_activity_logs .nsm-table-pagination .pagination li a.active {
        background: #d9a1a0;
        border: 1px solid #BEAFC2;
    }

    .activity-container-main .activity-logs-container {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        overflow: auto;
    }

    @media screen and (max-width: 1366px) {
     

        .activity-container-main .activity-logs-container {
            height: unset;
        }

        #dashboard_activity_logs {
            width: 500px;
        }

    }

    @media screen and (max-width: 991px) {
       
        #dashboard_activity_logs {
            width: 100%;
        }
    }

    @media screen and (max-width: 567px) {
       
        .activity-container-main .activity-logs-container{
            margin: unset;
        }
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Activity Logs</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url('activity_logs'); ?>">
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
        <div class="row">
            <div class="col-md-12 activity-container-main">
                <div class="banner">
                    <img src="./assets/img/activity-logs-banner.svg" alt="">
                </div>
                <div class="nsm-widget-table">
                    <div class="activity-logs-container table-responsive"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadActivityLogs();
    });

    function loadActivityLogs() {
        $('.activity-logs-container').html('<span class="bx bx-loader bx-spin"></span>');
        $.ajax({
            url: '<?php echo base_url(); ?>activity_logs/getV2ActivityLogs',
            method: 'GET',
            async: false,
            success: function(response) {
                $('.activity-logs-container').html(response);
            }
        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
