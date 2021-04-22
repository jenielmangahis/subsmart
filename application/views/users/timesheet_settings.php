<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    .red {
        background-color: red;
    }

    input[type='radio']:after {
        width: 25px;
        height: 24px;
        border-radius: 15px;
        top: -9px;
        left: -6px;
        position: relative;
        /*background-color: #d1d3d1;*/
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 25px;
        height: 24px;
        border-radius: 15px;
        top: -9px;
        left: -6px;
        position: relative;
        background-color: red;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    th {
        text-align: center;
    }

    #tsEmployeeDatepicker {
        width: 220px;
        margin-bottom: 12px;
    }

    #tsEmployeeDataTable .day {
        background: #53b84a;
    }

    #tsEmployeeDataTable .tbl-day,
    .tbl-date,
    .tbl-emp-name,
    .tbl-emp-role,
    .tbl-status {
        display: block;
    }

    #tsEmployeeDataTable .tbl-emp-name,
    .tbl-emp-status {
        font-weight: bold;
    }

    #tsEmployeeDataTable .tbl-emp-role {
        font-style: italic;
        color: grey;
    }

    .center {
        text-align: center;
    }

    .label-datepicker {
        font-weight: bold;
    }

    /*Table loader*/
    #tsEmployeeDataTable_wrapper {
        display: none;
    }

    .table-ts-loader {
        display: block;
        margin: 0 auto;
        clear: both;
        position: relative;
        z-index: 20;
        width: 100%;
        height: 100%;
        min-height: 100px;
        background: rgb(128 128 128 / 18%);
    }

    .table-ts-loader img {
        width: 80px;
        height: 80px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    .table-responsive {
        overflow-x: hidden;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <!-- <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h3 class="page-title">Time Employee</h3>-->
                <!-- <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Manage Timesheets</li>
                        </ol> -->
                <!--</div>-->
                <!-- <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php //if (hasPermissions('users_add')): 
                                ?>
                                    <a href="<?php //echo url('users/add_timesheet_entry') 
                                                ?>" class="btn btn-primary"
                                       aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry
                                    </a>
                                <?php //endif 
                                ?>
                            </div>
                        </div>
                    </div> -->
                <!-- </div>-->
            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="col-sm-12">
                            <h3 class="page-title left">Timesheet Seetings</h3>
                        </div>

                        <div class="row" style="padding: 10px 33px 20px 33px;">
                            <div class="col-md-12 banking-tab-container">
                                <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab" style="text-decoration: none">Attendance</a>
                                <a href="<?php echo url('/timesheet/attendance_logs') ?>" class="banking-tab">Time Logs</a>
                                <a href="<?php echo url('/timesheet/notification') ?>" class="banking-tab">Notification</a>
                                <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab" style="text-decoration: none">Employee</a>
                                <a href="<?php echo url('/timesheet/logs') ?>" class="banking-tab">Logs</a>
                                <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab">Schedule</a>
                                <a href="<?php echo url('/timesheet/requests') ?>" class="banking-tab">Requests</a>
                                <a href="<?php echo url('/timesheet/my_schedule') ?>" class="banking-tab">My Schedule</a>
                                <a href="<?php echo url('/timesheet/settings') ?>" class="banking-tab-active">Settings</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Date Selector -->
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link timesheet_report_settings active" data-toggle="tab" href="#timesheet_report_settings">Timesheet Report Settings</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">

                                <div class="tab-pane container active" id="timesheet_report_settings">
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-md-6">
                                            <form id="timezone_settings_form" action="">
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" on class="custom-control-input" id="subcribe_weekly_report" checked>
                                                        <label class="custom-control-label" for="subcribe_weekly_report">Toggle on if you want to receive the timesheet report weekly</label>
                                                    </div>
                                                </div>
                                                <div class="subscribed-fields">
                                                    <div class="form-group">
                                                        <label for="from_date_correction_requests" class="week-label">Select below the <b>Timezone</b> for your Timesheet Report</label>
                                                        <select class="custom-select" id="tz_display_name">
                                                            <?php
                                                            foreach ($all_timezone_list as $timezone) {
                                                                echo '<option value="' . $timezone->id . '">' . $timezone->display_name . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tz_id_of_tz" class="week-label">ID of Timezone</label>
                                                        <input type="text" class="form-control" id="tz_id_of_tz" value="" disabled>
                                                        <?php
                                                        foreach ($all_timezone_list as $timezone) {
                                                            echo '<input type="text" id="tz_id_' . $timezone->id . '" value="' . $timezone->id_of_timezone . '" disabled style="display:none;   ">';
                                                        }
                                                        ?>
                                                    </div>

                                                    <div class="alert alert-success" role="alert">
                                                        Please note that the next timesheet report will be sent <b id="next-timesheet-report"></b>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" id="tz_form_submit" class="btn btn-primary " style="float:left;">Save</button><img class="tz-form-img-loader" style="float:left; display:none;" src="<?= base_url(); ?>/assets/css/timesheet/images/ring-loader.svg" alt="">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- page wrapper end -->
</div>
<?php include viewPath('includes/footer'); ?>
<script>
</script>