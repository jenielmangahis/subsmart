<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php

include viewPath('includes/header');
$report_series = 3;
foreach ($report_settings as $settings) {
    $report_series = $settings->report_series;
}

?>
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

    label.custom-control-label.allow_clock_in::before {
        left: -2.25rem;
        width: 1.75rem rem;
        pointer-events: all;
        border-radius: 0.5rem;
        background-color: #ff584cd9;
    }

    label.custom-control-label.allow_clock_in::after {
        background-color: #ffffff;
    }

    .custom-control-input:checked~.custom-control-label.allow_clock_in:before {
        background-color: #4cc510;
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
                            ?>" class="btn btn-primary" aria-expanded="false">
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
                            <h3 class="page-title left">Timesheet Settings</h3>
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
                                            <a class="nav-link timesheet_report_settings active" data-toggle="tab" href="#timesheet_report_settings">Timesheet Settings</a>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">

                                <div class="tab-pane container active" id="timesheet_report_settings">
                                    <div class="row" style="padding-top: 20px;">
                                        <div class="col-md-12">
                                            <form id="timezone_settings_form2" action="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="custom-control custom-switch">

                                                                <input type="checkbox" value=0 class="custom-control-input allow_clock_in" id="est_wage_privacy2">
                                                                <label class="custom-control-label allow_clock_in" for="est_wage_privacy2"> <span id="status">Enable</span> user <b>cannot clock in 5 minutes</b> early.</label>


                                                                <br><label class="est_wage_privacy_editor" for="est_wage_privacy2">
                                                                    <p>Latest
                                                                        update by <span id="update"></span></p>
                                                                </label>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!--
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="custom-control custom-switch">

                                                                <input type="checkbox" value=0 class="custom-control-input allow_gps" id="GPS_Allow">
                                                                <label class="custom-control-label" for="GPS_Allow">Enable <span style="font-weight: bold;">GPS</span> for all Employee</label><br>
                                                                <label class="est_wage_privacy_editor" for="est_wage_privacy">
                                                                    <p>Latest
                                                                        update by <span id="gps_update"></span></p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="gps_toggle" style="display:none;">
                                                    <div class="row ml-5 mb-4">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p><b>Location For Clock In:</b></p>
                                                                <input type="text" id="cIn_Location" style="width: 564px;height: 48px;border: none;background-color: #fff8de;border-radius: 18px;padding: 0 20px;">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <p><b>Location For Clock Out:</b></p>
                                                                <input type="text" id="cOut_Location" style="width: 564px;height: 48px;border: none;background-color: #fff8de;border-radius: 18px;padding: 0 20px;  ">
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="row ml-5 mb-4">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <label class="est_wage_privacy_editor">
                                                                    <p>Latest
                                                                        update by <span id="update_locatonCoutCin"></span></p>
                                                                </label>

                                                            </div>
                                                            <div class="col">
                                                                <button id="submit_location_CIn_COut" style="color: #fff;/* background-color: #2ab363; */    background-color: #6f5ea3d1;    border: none;    border-radius: 18px;  width: 93px;">save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->



                                            </form>

                                            <div class="row " style="">
                                                <div class="col-md-12">
                                                    <div class="form-group" style="">
                                                        <label for="from_date_correction_requests" class="week-label" style="font-weight: bold;">Select Start Day Of The Week</label>
                                                        <br>
                                                        <!-- <input class="Payday" type="date" value="<?php echo date('Y-m-d') ?>" style="text-align: center;padding: 8px 20px;font-weight: bold;width: 183px;letter-spacing: 3px;border-radius: 11px;"> -->
                                                        <div class="row report_schedule">
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Sunday" class="custom-control-input" id="Sunday">
                                                                        <label class="custom-control-label" for="Sunday" style="display:flex;">Sun</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Monday" class="custom-control-input" id="Monday">
                                                                        <label class="custom-control-label" for="Monday" style="display:flex;">Mon</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Tuesday" class="custom-control-input" id="Tuesday">
                                                                        <label class="custom-control-label" for="Tuesday" style="display:flex;">Tue</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Wednesday" class="custom-control-input" id="Wednesday">
                                                                        <label class="custom-control-label" for="Wednesday" style="display:flex;">Wed</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Thursday" class="custom-control-input" id="Thursday">
                                                                        <label class="custom-control-label" for="Thursday" style="display:flex;">Thu</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Friday" class="custom-control-input" id="Friday">
                                                                        <label class="custom-control-label" for="Friday" style="display:flex;">Fri</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="radio" on="" name="payday" value="Saturday" class="custom-control-input" id="Saturday">
                                                                        <label class="custom-control-label" for="Saturday" style="display:flex;">Sat</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <!-- last -->
                                            <div class="row">
                                                <div class="col-3">
                                                    <label class="est_wage_privacy_editor" for="est_wage_privacy2">
                                                        <p>Latest
                                                            update by <span id="update2"></span></p>
                                                    </label>

                                                </div>
                                                <div class="col">
                                                    <button id="submit" style="    color: #fff;/* background-color: #2ab363; */background-color: #3a004cc2; border:none; border-radius:20px;  width: 93px;float:left">save</button>
                                                </div>
                                            </div>
                                            <hr style="margin-top:50px; margin-bottom:50px">
                                        </div>
                                    

                                        <div class="col-md-12">
                                            <form id="timezone_settings_form" action="">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <div class="custom-control custom-switch">

                                                                <input type="checkbox" on class="custom-control-input" id="est_wage_privacy" <?= $report_privacy->est_wage_private == 1 ? "checked" : "" ?>>
                                                                <label class="custom-control-label" for="est_wage_privacy">Include
                                                                    <b>Estimated Wages</b> to the weekly timesheet report.</label>
                                                                <?php
                                                                if ($report_privacy != null) {
                                                                ?>
                                                                    <label class="est_wage_privacy_editor" for="est_wage_privacy">Latest
                                                                        update by <span><?= $report_privacy->FName ?>
                                                                            <?= $report_privacy->LName ?>
                                                                            <?= date("M d, Y h:i A", strtotime($report_privacy_updated)) ?></span></label>

                                                                <?php
                                                                } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" on class="custom-control-input" id="subcribe_weekly_report" checked>
                                                        <label class="custom-control-label" for="subcribe_weekly_report">Toggle on
                                                            if you want to receive the timesheet report</label>
                                                    </div>
                                                </div>

                                                <div class="row report_series_div" style="margin-bottom: 20px;">
                                                    <div class="col-md-12">
                                                        <label>Receive timesheet report</lable>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="radio" name="user_type" value="1" id="report_series_1" <?= $report_series == 1 ? "checked" : "" ?>>
                                                                <label for="report_series_1"><span>Daily</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="radio" name="user_type" value="2" id="report_series_2" <?= $report_series == 2 ? "checked" : "" ?>>
                                                                <label for="report_series_2"><span>Biweekly</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check">
                                                            <div class="checkbox checkbox-sec margin-right">
                                                                <input type="radio" name="user_type" value="3" id="report_series_3" <?= $report_series == 3 ? "checked" : "" ?>>
                                                                <label for="report_series_3"><span>Weekly</span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row report_schedule" style="margin-bottom: 20px;">
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Sun" class="custom-control-input" id="sched_sun" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_sun">Sun</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Mon" class="custom-control-input" id="sched_m" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_m">Mon</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Tue" class="custom-control-input" id="sched_t" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_t">Tue</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Wed" class="custom-control-input" id="sched_w" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_w">Wed</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Thu" class="custom-control-input" id="sched_th" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_th">Thu</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Fri" class="custom-control-input" id="sched_f" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_f">Fri</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" on="" name="sched_day" value="Sat" class="custom-control-input" id="sched_sat" checked="" onchange="sched_day_changed()">
                                                                <label class="custom-control-label" for="sched_sat">Sat</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group" style="padding-left:1.25rem;">
                                                            <label for="from_date_correction_requests" class="week-label">Select
                                                                time:</label>
                                                            <select class="custom-select" id="sched_time">
                                                                <?php
                                                                $selected = 'selected="selected"';
                                                                for ($i = 0; $i < 24; $i++) {
                                                                    echo '<option value="' . date('H:i:s', strtotime($i . ':00:00')) . '" ' . $selected . '>' . date('h:i A', strtotime($i . ':00:00')) . '</option>';
                                                                    $selected = '';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Email address</label>
                                                            <input type="email" class="form-control" id="email_report" aria-describedby="emailHelp" placeholder="Enter email" required>
                                                            <small class="form-text text-muted">This is where we will send the
                                                                timesheet report.</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="subscribed-fields">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="from_date_correction_requests" class="week-label">Select
                                                                    below the <b>Timezone</b> for your Timesheet Report</label>
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
                                                        </div>
                                                    </div>

                                                    <!-- <div class="alert alert-success" role="alert">
                                                        Please note that the next timesheet report will be sent <b id="next-timesheet-report"></b>
                                                    </div> -->
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