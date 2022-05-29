<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-lg-12">';
endif;
?>
<style>
    .js-body .row.js-row {
        background: #f6ebff;
    }

    .row.js-row {
        margin-top: 20px;
        box-shadow: 9px 3px 14px 0px #d2c2c26e;
        padding: 14px;
        border-radius: 16px;
    }



    .js-table {
        padding: 0 4%;
        font-size: 12px;
        width: 100%;
        text-align: center;
        position: absolute;
        top: 58px;
    }

    .row.js-row.js-row-margin {
        margin-top: 13px;

    }

    .js-margin-bot {
        margin-bottom: 26px;
    }

    .cent {
        margin: 0 10%;
    }

    .col-2 {
        text-align: left !important;
    }

    .row.js-row-dash {
        background-color: #f6ebff;
        margin-bottom: 3%;
        border-radius: 10px;
        margin: 1% 0%;
        box-shadow: 2px 2px 2px #dfdfdf;
        padding: 0;
    }


    .stat_content {

        padding: 0 2%;
    }

    .col-9.marg-top {
        display: flex;
        margin: 2% 0;
        font-weight: bold;
    }

    .col-3.col-center {
        margin-top: 1%;
        font-size: 15px;
        text-align: center;
    }

    .stat-item {
        font-weight: bold;
        color: white;
        background-color: #e373e3;
        width: 100%;
        font-size: 10px;
        border-radius: 18px;
    }

    .col.col-align {
        text-align: -webkit-center;
    }

    .prof {
        background-size: cover;
        background-image: url("<?php echo base_Url() ?>assets/dashboard/images/prof.jpg");
        width: 30px;
        height: 30px;
        border-radius: 15px;
    }

    .jname {
        margin-top: 3px;
        margin-left: 9px;
    }

    .title-modal h5 {
        font-weight: bold;
        font-size: 23px;
    }

    .table-container {
        font-weight: bold;
        text-align: -webkit-center;
        background-color: white;
        height: 548px;
        width: 1129px;
        position: relative;
        top: 21%;
        left: 20%;
        border-radius: 26px;
        padding-top: 16px;
    }

    .close-modal-table {
        position: absolute;
        top: 492px;
        left: 920px;
    }

    .modal-table {
        position: fixed;
        top: 0;
        z-index: 1059;
        width: 100%;
        height: 100%;

        display: none;
        left: 0;
        right: 0;
        background: #2929297a;
    }

    button.cl {
        background: #ff0f48bf;
        border: none;
        width: 80px;
        height: 35px;
        border-radius: 9px;
        color: white;
        font-weight: bold;
    }

    button.cl-edit {
        background: #00b4359e;
        border: none;
        width: 80px;
        height: 35px;
        border-radius: 9px;
        color: white;
        font-weight: bold;
        margin-right: 10px;
    }

    @media only screen and (max-width: 1521px) {
        .table-container {
            top: 14%;
            left: 13%;
        }
    }
</style>
<style>
    .nsm-table {
        display: none;
    }
    .nsm-badge.primary-enhanced {
        background-color: #6a4a86;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Latest Jobs</span>
        </div>
        <div class="nsm-card-controls">
            <!--<a role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
                See More
            </a>-->
            <a href="<?= base_url('job') ?>" role="button" class="nsm-button btn-sm m-0 me-2" id="table-modal">
                See More
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
    <div class="nsm-card-content jobs_stat">
        <div class="nsm-widget-table">
            <div class="row timesheet-header">
                <div class="col-12">
                    <div class="widget-item timesheet-item">
                        <div class="content">
                            <div class="details">
                                <span class="content-subtitle fw-bold">Job Number</span>
                            </div>
                            <div class="controls">
                                <div class="timesheet-group">
                                    <div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">Amount</span>
                                    </div>
                                </div>
                                <div class="timesheet-group">
                                    <!--<div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">Date</span>
                                    </div>-->
                                    <div class="timesheet-time">
                                        <span class="content-subtitle fw-bold d-block">Status</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <?php foreach($latestJobs as $job): 
                    switch($job->status):
                        case "New":
                            $badgeCount = 1;
                            break;
                        case "Scheduled":
                            $badgeCount = 2;
                            break;
                        case "Arrival":
                            $badgeCount = 3;
                            break;          
                        case "Started":
                            $badgeCount = 4;
                            break;
                        case "Approved":
                            $badgeCount = 5;
                            break;
                        case "Closed":
                            $badgeCount = 6;
                            break;
                        case "Invoiced":
                            $badgeCount = 7;
                            break;
                        case "Completed":
                            $badgeCount = 8;
                            break;
                    endswitch;
                    ?>
                    
                <div class="widget-item timesheet-item" onclick="location.href='<?= base_url('job/job_preview/').$job->id ?>'">
                    <div class="content">
                        <div class="details">
                            <span class="content-title"><?= $job->job_number; ?></span>
                            <span class="content-subtitle d-block"><?= $job->job_type; ?></span>
                            <!--<small class="content-subtitle d-block"><?= date_format(date_create($job->start_date), "m/d/Y"); ?></small>-->
                        </div>
                        <div class="controls">
                            <div class="timesheet-group">
                                <div class="timesheet-time">
                                    <span class="content-subtitle d-block"><span class="timesheet-labels">$<?= $job->amount; ?> </span>
                                </div>
                            </div>
                            <div class="timesheet-group">
                                <!--<div class="timesheet-time">
                                    <span class="content-subtitle "><span class="timesheet-labels"><?= date_format(date_create($job->start_date), "m/d/Y"); ?></span>
                                </div>-->
                                <div class="timesheet-time">
                                    <span class="content-subtitle "><span class="timesheet-labels">
                                    <?php
                                            for($x=1;$x<=$badgeCount;$x++){
                                                ?>
                                                    <span class="nsm-badge primary-enhanced"></span>
                                                <?php
                                            }
                                            for($y=1;$y < 8 - $badgeCount;$y++){
                                                ?>
                                                    <span class="nsm-badge primary"></span>
                                                <?php
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>      
</div>
<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>