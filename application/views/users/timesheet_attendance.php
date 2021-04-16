<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    span.clock-in-time.gray,
    span.break-in-time.gray,
    span.break-out-time.gray,
    span.clock-out-time.gray {
        background-color: #E9ECEF;
        padding-left: 10px;
        padding-right: 10px;
        border-radius: 10px;
        font-size: 12px;
    }

    th {
        text-align: center;
    }

    .tile-container {
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
        -moz-box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
        box-shadow: 0 2px 8px 0 rgba(0, 0, 0, .2);
        background-color: #fff;
        background-image: none;
        border: 1px solid #d4d7dc;
        -webkit-transition: all .3s ease;
        position: relative;
        top: 20px;
        width: 100%;
        height: 100%;
        padding: 0;
        margin-bottom: 10px;
        margin-right: 10px;
    }

    .inner-content {
        padding: 20px;
    }

    .inner-content .card-title {
        display: inline-block;
        width: 80%;
    }

    .inner-content .card-title span {
        font-weight: bold;
        font-size: 15px;
    }

    .inner-content .card-data {
        width: 10%;
        display: inline-block;
        vertical-align: middle;
    }

    .inner-content .card-data span {
        float: right;
        font-weight: bold;
        font-size: 20px;
        color: grey;
    }

    .inner-content .progress {
        margin-top: 10px;
    }

    .inner-content .progress .progress-bar {
        color: #32243D;
        font-size: 10px;
        font-weight: bold;
    }

    .inner-content .progress .active {
        animation: progress-bar-stripes 2s linear infinite;
    }

    .inner-content .progress .progress-bar-success {
        background-color: #5abf51;
    }

    .inner-content .progress .progress-bar-danger {
        background-color: #ff6523;
    }

    .inner-content .progress .progress-bar-warning {
        background-color: #ffd176;
    }

    .tbl-employee-attendance .tbl-id-number {
        text-align: center;
    }

    .inner-content .progress .progress-bar-green {
        background-color: #60d562;
    }

    .inner-content .progress .progress-bar-gray {
        background-color: #90a4ae;
    }

    .tbl-employee-attendance .tbl-employee-name {
        font-size: 14px;
        /*font-weight: bold;*/
    }

    .tbl-employee-attendance .tbl-emp-role {
        display: block;
        font-style: italic;
        color: grey;
    }

    .tbl-employee-attendance .tbl-emp-action,
    .tbl-chk-in,
    .tbl-chk-out,
    .tbl-lunch-in,
    .tbl-lunch-out {
        text-align: center;
    }

    .tbl-employee-attendance .tbl-emp-action .employee-in-out,
    .employee-break {
        color: grey;
    }

    .tbl-employee-attendance .tbl-emp-action .employee-in-out:hover {
        text-decoration: underline;
        color: #0b97c4;
    }

    .tbl-employee-attendance .fa-times-circle {
        color: orangered;
        vertical-align: bottom;
    }

    .tbl-employee-attendance .fa-check {
        color: greenyellow;
        vertical-align: bottom;
    }

    .swal2-image {
        height: 120px;
        width: 120px;
        border-radius: 50%;
    }

    .tbl-emp-action .employee-in-out[disabled="disabled"] {
        cursor: not-allowed;
        color: #92969d;
    }

    .tbl-emp-action .employee-in-out[disabled="disabled"]:hover {
        color: #92969d;
    }

    .tbl-emp-action .employee-break[disabled="disabled"] {
        cursor: not-allowed;
        color: #92969d;
    }

    .tbl-emp-action .employee-break[disabled="disabled"]:hover {
        color: #92969d;
    }

    .status {
        margin-left: 10px;
    }

    .fa-cutlery {
        color: #ffc859;
    }

    .in-indicator {
        display: none;
        background: url("<?= base_url() ?>assets/img/timesheet/lunch-in-min.png");
        background-size: cover;
        width: 25px;
        height: 25px;
        /* background-color: red; */
        /* border-radius: 50%; */
        /* border: 1px solid red; */
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
        /* box-shadow: 0 2px 5px 2px rgb(0 0 0 / 51%); */
    }

    .out-indicator {
        display: none;
        background: url("<?= base_url() ?>assets/img/timesheet/clock-out1.png");
        background-size: cover;
        width: 25px;
        height: 25px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
    }

    .lunch-indicator {
        display: none;
        background: url("<?= base_url() ?>assets/img/timesheet/lunch-in.png");
        background-size: cover;
        width: 25px;
        height: 25px;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
    }




    /*Employee css*/
    .user-logs-container {
        height: 100%;
    }

    .user-logs-container .user-card-title {
        border-bottom: 1px solid #cbd0da;
        width: 100%;
        padding-bottom: 8px;
    }

    .user-clock-in-title,
    .user-clock-out-title,
    .user-lunch-in-title,
    .user-lunch-out-title {
        font-weight: bold;
        min-height: 31px;
        color: #92969d;
    }

    .user-clock-in,
    .user-clock-out,
    .user-lunch-in,
    .user-lunch-out,
    .user-shift-duration {
        min-height: 31px;
        display: block;
        text-align: right;
    }

    .user-clock-in span {
        font-size: 12px;
        display: inline-block;
        float: left;
    }

    .user-logs {
        width: 100%;
    }

    .user-logs-section {
        position: relative;
        width: 49%;
        display: inline-block;
        vertical-align: top;
    }

    .user-logs-title {
        display: inline-block;
        position: relative;
    }

    .user-logs-title .fa-coffee {
        color: #92969d;
    }

    .user-logs-title a[disabled="disabled"] {
        cursor: not-allowed;
    }

    .right {
        float: right;
    }

    /*Employee button lunch*/
    .employeeLunch .btn-lunch-hover {
        display: none;
        position: absolute;
        top: 0;
        z-index: 99;
    }

    .employeeLunch:hover .btn-lunch-hover {
        display: inline-block;
    }

    .employeeLunch:hover .btn-lunch {
        visibility: hidden;
    }

    /*Lunch button tooptip*/
    .employeeLunchBtn .employeeLunchTooltip {
        visibility: hidden;
        font-size: 14px !important;
        font-weight: bold !important;
        color: #ffffff;
        text-align: center;
        min-width: 110px;
        padding: 10px;
        position: absolute;
        border-radius: 2px;
        background-color: #0000008a;
        z-index: 1;
        bottom: 100%;
        left: 55%;
        margin-left: -60px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .employeeLunchBtn .employeeLunchTooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #0000008a transparent transparent transparent;
    }

    .employeeLunchBtn:hover .employeeLunchTooltip {
        visibility: visible;
    }

    /*Employee button leave*/
    .employeeLeaveBtn .btn-leave-hover {
        visibility: hidden;
        position: absolute;
        top: -12px;
        z-index: 99;
    }

    .employeeLeaveBtn:hover .btn-leave-hover {
        visibility: visible;
    }

    .employeeLeaveBtn:hover .btn-leave-static {
        visibility: hidden;
    }

    /*Leave button tooltip*/
    .employeeLeaveBtn+.employeeLeaveTooltip {
        visibility: hidden;
        font-size: 14px !important;
        font-weight: bold !important;
        color: #ffffff;
        text-align: center;
        min-width: 150px;
        padding: 10px;
        position: absolute;
        border-radius: 2px;
        background-color: #0000008a;
        z-index: 1;
        bottom: 110%;
        left: 70%;
        margin-left: -60px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }

    .employeeLeaveBtn+.employeeLeaveTooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #0000008a transparent transparent transparent;
    }

    .employeeLeaveBtn:hover+.employeeLeaveTooltip {
        visibility: visible;
    }

    /*input tags*/
    .bootstrap-tagsinput .tag {
        border-radius: 3px;
        background: grey;
    }

    .page-title {
        font-family: Sarabun, sans-serif !important;
        font-size: 1.75rem !important;
        font-weight: 600 !important;
    }

    .left {
        float: left;
    }

    .p-40 {
        padding-left: 25px !important;
        padding-top: 55px !important;
    }

    .card.p-20 {
        padding-top: 25px !important;
    }

    .col.col-4.pd-17.left.alert.alert-warning.mt-0.mb-2 {
        position: relative;
        left: 13px;
    }

    .fr-right {
        float: right;
        justify-content: flex-end;
    }

    .p-20 {
        padding-top: 25px !important;
        padding-bottom: 25px !important;
        padding-right: 20px !important;
        padding-left: 20px !important;
    }

    .pd-17 {
        position: relative;
        left: 17px;
    }

    @media only screen and (max-width: 600px) {
        .p-40 {
            padding-top: 0px !important;
        }

        .pr-b10 {
            position: relative;
            bottom: 0px;
        }
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

                <div class="row align-items-center" style="display:none;">
                    <!-- <div class="col-sm-6">
                        <h3 class="page-title left">Attendance</h3>
                    </div> -->
                    <div class="col-sm-6">
                        <!--                        <div class="float-right d-none d-md-block">-->
                        <!--                            <div class="dropdown">-->
                        <!--                                --><?php //if (hasPermissions('users_add')): 
                                                                ?>
                        <!--                                    <a href="--><?php //echo url('users/add_timesheet_entry') 
                                                                            ?>
                        <!--" class="btn btn-primary"-->
                        <!--                                       aria-expanded="false">-->
                        <!--                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry-->
                        <!--                                    </a>-->
                        <!--                                --><?php //endif 
                                                                ?>
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
            <!-- end row -->
            <input type="hidden" id="employeeTotal" value="<?php echo  $total_users; ?>">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="col-sm-12">
                            <h3 class="page-title left">Attendance</h3>
                        </div>
                        <!--<div class="pl-4 pr-4 row">
                        <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                            <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                        </div>
                      </div>-->
                        <div class="row" style="padding: 10px 33px 20px 33px;">
                            <div class="col-md-12 banking-tab-container">
                                <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab<?php echo ($this->uri->segment(1) == "attendance") ?: '-active'; ?>" style="text-decoration: none">Attendance</a>
                                <?php if ($this->session->userdata('logged')['role'] < 5) { ?>
                                    <a href="<?php echo url('/timesheet/attendance_logs') ?>" class="banking-tab">Time Logs</a>
                                    <a href="<?php echo url('/timesheet/notification') ?>" class="banking-tab">Notification</a>
                                    <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab">Employee</a>
                                    <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab">Schedule</a>
                                    <a href="<?php echo url('/timesheet/requests') ?>" class="banking-tab">Requests</a>
                                    <a href="<?php echo url('/timesheet/my_schedule') ?>" class="banking-tab">My Schedule</a>
                                    <a href="<?php echo url('/timesheet/settings') ?>" class="banking-tab">Settings</a>
                                <?php } else { ?>
                                    <a href="<?php echo url('/timesheet/my_schedule') ?>" class="banking-tab">My Schedule</a>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="today-date">
                                <?php
                                date_default_timezone_set($this->session->userdata('usertimezone'));

                                ?>
                                <h6><i class="fa fa-calendar-alt"></i> Today: <span style="color: grey"><?php echo date('M d, Y') . " " ?></span></h6>
                            </div>
                            <?php if ($this->session->userdata('logged')['role'] < 5) : ?>
                                <div class="row" style="margin-bottom: 20px">
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>In Now</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span id="employee-in-now"><?php echo $in_now; ?></span>
                                                            </div>
                                                            <div class="progress" id="progressClockIn">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-default progress-bar-striped progress-bar-green active" role="progressbar" aria-valuenow="<?php echo $in_now; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(100 * ($in_now / $total_users), 2) . '%'; ?>;">
                                                                    <?php echo round(100 * ($in_now / $total_users), 2) . '%'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>On Lunch</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span id="employee-out-now"><?= $on_lunch ?></span>
                                                            </div>
                                                            <div class="progress" id="progressOutNow">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-default progress-bar-striped progress-bar-gray active" role="progressbar" aria-valuenow="<?php echo $on_lunch; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(100 * ($on_lunch / $total_users), 2) . '%'; ?>;">
                                                                    <?php echo round(100 * ($on_lunch / $total_users), 2) . '%'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>Not Logged-in</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span id="employee-not-loggedin"><?php echo $no_logged_in; ?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $no_logged_in; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(100 - ((($total_users - $no_logged_in) / $total_users) * 100), 2) . '%'; ?>;">
                                                                    <?php echo round(100 - ((($total_users - $no_logged_in) / $total_users) * 100), 2) . '%'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>Employees</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span><?php echo $total_users; ?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%;">
                                                                    100%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 50px">
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>Manual Check ins</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span><?= $manual_checkins ?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-gray progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $manual_checkins; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($manual_checkins / $total_users) * 100, 2) . '%'; ?>;">
                                                                    <?php echo round(100 * ($manual_checkins / $total_users), 2) . '%'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>Late Check ins</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span><?= count($on_leave) ?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-green progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo count($on_leave); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round((count($on_leave) / $total_users) * 100, 2) . '%'; ?>;">
                                                                    <?php echo round(100 * (count($on_leave) / $total_users), 2) . '%'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>On Leave</span>
                                                            </div>
                                                            <div class="card-data">
                                                                <span><?= count($on_leave) ?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-green progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo count($on_leave); ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round((count($on_leave) / $total_users) * 100, 2) . '%'; ?>;">
                                                                    <?php echo round(100 * (count($on_leave) / $total_users), 2) . '%'; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="tile-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title">
                                                                <span>Contractors</span>
                                                            </div>
                                                            <div class="card-data" style="vertical-align: top">
                                                                <span>0</span>
                                                            </div>
                                                            <div class="progress" style="margin-top: 0">
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0;">
                                                                    0%
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 table-responsive">
                                        <!--tbl-employee-attendance-->
                                        <table id="ts-attendance" class="table table-hover table-to-list tbl-employee-attendance">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2">ID</th>
                                                    <th rowspan="2">Employee Name</th>
                                                    <th rowspan="2">In</th>
                                                    <th rowspan="2">Out</th>
                                                    <th colspan="2">Lunch</th>
                                                    <th rowspan="2">Action</th>
                                                    <th rowspan="2">Comments/Location</th>
                                                </tr>
                                                <tr>
                                                    <th>In</th>
                                                    <th>Out</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $u_role = null;
                                                $status = 'fa-times-circle-none';
                                                $tooltip_status = 'Not logged in';
                                                $time_in = null;
                                                $time_out = null;
                                                $btn_action = 'employeeCheckIn';
                                                $disabled = null;
                                                $break = 'disabled="disabled"';
                                                $break_id = null;
                                                $break_in = null;
                                                $break_out = null;
                                                $indicator_in = 'display:none';
                                                $indicator_out = 'display:none';
                                                $indicator_in_break = 'display:none';
                                                $indicator_out_break = 'display:none';
                                                $week_id = null;
                                                $attn_id = null;
                                                $yesterday_in = null;
                                                $yesterday_out = null;
                                                $clock_in_2nd = 0;
                                                $out_count = 0;
                                                $in_count = 0;
                                                $company_id = 0;
                                                // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
                                                // $getTimeZone = json_decode($ipInfo);
                                                $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));
                                                ?>

                                                <?php foreach ($users as $cnt => $user) : ?>
                                                    <?php
                                                    $user_photo = userProfileImage($user->id);
                                                    $company_id = $user->company_id;
                                                    foreach ($user_roles as $role) {
                                                        if ($role->id == $user->role) {
                                                            $u_role = $role->title;
                                                        }
                                                    }
                                                    foreach ($attendance as $attn) {
                                                        foreach ($logs as $log) {
                                                            if ($user->id == $attn->user_id) {
                                                                $attn_id = $attn->id;
                                                                if ($attn_id == $log->attendance_id) {
                                                                    // var_dump("<br>".date('Y-m-d', strtotime($log->date_created)));
                                                                    date_default_timezone_set('UTC');
                                                                    // var_dump(date('Y-m-d', strtotime('yesterday')));

                                                                    if (date('Y-m-d', strtotime($log->date_created)) == date('Y-m-d', strtotime('yesterday'))) {
                                                                        $yesterday_in = "(Yesterday)";
                                                                    } else {
                                                                        $yesterday_in = null;
                                                                    }
                                                                    $date_created = $log->date_created;
                                                                    date_default_timezone_set('UTC');
                                                                    $datetime_defaultTimeZone = new DateTime($date_created);
                                                                    $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                                                    $log->date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                                                    date_default_timezone_set($this->session->userdata('usertimezone'));
                                                                    if ($log->action == 'Check in') {
                                                                        $time_in = date('h:i A', strtotime($log->date_created));
                                                                        $time_out = null;
                                                                        $break_in = null;
                                                                        $break_out = null;
                                                                        $btn_action = 'employeeCheckOut';
                                                                        $status = 'fa-check';
                                                                        $break = null;
                                                                        $disabled = null;
                                                                        $break_id = 'employeeBreakIn';
                                                                        $indicator_in = 'display:block';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'Logged in';
                                                                    }
                                                                    if ($log->action == 'Break in') {
                                                                        $break_id = 'employeeBreakOut';
                                                                        $status = 'fa-cutlery';
                                                                        $break_in = date('h:i A', strtotime($log->date_created));
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:block';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'On break';
                                                                        $break_out = null;
                                                                    }
                                                                    if ($log->action == 'Break out') {
                                                                        $status = 'fa-check';
                                                                        $break_out = date('h:i A', strtotime($log->date_created));
                                                                        //                                                                    $break = 'disabled="disabled"';
                                                                        $break_id = 'employeeBreakIn';
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:block';
                                                                        $tooltip_status = 'Back to work';
                                                                    }
                                                                    if ($log->action == 'Check out') {
                                                                        $status = 'fa-times-circle-none';
                                                                        $btn_action = 'employeeCheckIn';
                                                                        $time_out = date('h:i A', strtotime($log->date_created));
                                                                        $disabled = null;
                                                                        $break = 'disabled="disabled"';
                                                                        $break_id = null;
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:block';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'Logged out';
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if ($indicator_in == 'display:block' || $indicator_in_break == 'display:block' || $indicator_out_break == 'display:block') {
                                                        $in_count++;
                                                    }
                                                    if ($indicator_out == 'display:block') {
                                                        $out_count++;
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="tbl-id-number"><?php echo $user->id ?></td>
                                                        <td>
                                                            <span class="tbl-employee-name"><?php echo $user->FName; ?></span> <span class="tbl-employee-name"><?php echo $user->LName; ?></span>
                                                            <span class="tbl-emp-role"><?php echo $u_role; ?></span>
                                                        </td>
                                                        <td class="tbl-chk-in" data-count="<?php echo $in_count ?>">
                                                            <div class="in-indicator" style="<?php echo $indicator_in ?>"></div> <span class="clock-in-time <?php if ($time_in != "") {
                                                                                                                                                                echo "gray";
                                                                                                                                                            } ?>"><?php echo $time_in ?></span> <span class="clock-in-yesterday" style="display: block;"><?php echo $yesterday_in; ?></span>
                                                        </td>
                                                        <td class="tbl-chk-out" data-count="<?php echo $time_out ?>">
                                                            <div class="out-indicator" style="<?php echo $indicator_out ?>"></div> <span class="clock-out-time <?php if ($time_out != "") {
                                                                                                                                                                    echo "gray";
                                                                                                                                                                } ?>"><?php echo $time_out ?></span>
                                                        </td>
                                                        <td class="tbl-lunch-in">
                                                            <div class="lunch-indicator" style="<?php echo $indicator_in_break ?>"></div> <span class="break-in-time <?php if ($break_in != "") {
                                                                                                                                                                            echo "gray";
                                                                                                                                                                        } ?>"><?php echo $break_in; ?></span>
                                                        </td>
                                                        <td class="tbl-lunch-out">
                                                            <div class="in-indicator" style="<?php echo $indicator_out_break ?>"></div> <span class="break-out-time <?php if ($break_out != "") {
                                                                                                                                                                        echo "gray";
                                                                                                                                                                    } ?>"><?php echo $break_out; ?></span>
                                                        </td>
                                                        <td class="tbl-emp-action">
                                                            <center class="loading-img-action" style="display:none;"><img class="ts-loader-img" src="<?= base_url() ?>assets/css/timesheet/images/ring-loader.svg" alt="" style="height:40px;"> </center>
                                                            <a href="javascript:void(0)" title="Lunch in/out" data-toggle="tooltip" class="employee-break" style="<?php if ($break_id == "") {
                                                                                                                                                                        echo "display:none;";
                                                                                                                                                                    } ?>" id="<?php echo $break_id ?>" data-id="<?php echo $user->id ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>"><i class="fa fa-coffee fa-lg"></i></a>
                                                            <a href="javascript:void(0)" title="Clock in/out" data-toggle="tooltip" class="employee-in-out" <?php echo $disabled ?> id="<?php echo $btn_action; ?>" data-attn="<?php echo $attn_id; ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>"><i class="fa fa-sign-in fa-lg"></i></a>
                                                            <i class="fa <?php echo $status; ?> status" title="<?php echo $tooltip_status; ?>" data-toggle="tooltip"></i>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                    $u_role = null;
                                                    $status = 'fa-times-circle-none';
                                                    $tooltip_status = 'Not logged in';
                                                    $time_in = null;
                                                    $time_out = null;
                                                    $btn_action = 'employeeCheckIn';
                                                    $disabled = null;
                                                    $break = 'disabled="disabled"';
                                                    $break_id = null;
                                                    $break_in = null;
                                                    $break_out = null;
                                                    $indicator_in = 'display:none';
                                                    $indicator_out = 'display:none';
                                                    $indicator_in_break = 'display:none';
                                                    $indicator_out_break = 'display:none';
                                                    $week_id = null;
                                                    $attn_id = null;
                                                    $yesterday_in = null;
                                                    $yesterday_out = null;
                                                    ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="outCounter" value="<?php echo $out_count ?>">
                                        <input type="hidden" id="inCounter" value="<?php echo $in_count ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- end row -->
                            <?php if ($this->session->userdata('logged')['role'] > 5) : ?>
                                <?php
                                $lunch_active = null;
                                $employee_logs = getEmployeeLogs($attendance_id);
                                $employee_attn = getClockInSession();
                                $lunch_icon = 'static';
                                $lunch_disabled = 'disabled="disabled"';
                                foreach ($employee_attn as $attn) {
                                    if ($attn->user_id == $this->session->userdata('logged')['id'] && $attn->status == 1) {
                                        foreach ($employee_logs as $log) {
                                            if ($attn->id == $log->attendance_id) {
                                                $lunch_disabled = null;
                                            }
                                            if ($attn->id == $log->attendance_id && $log->action == 'Break in') {
                                                $lunch_active = 'lunchOut';
                                                $lunch_icon = 'active';
                                            } else {
                                                $lunch_active = 'lunchIn';
                                                $lunch_icon = 'static';
                                            }
                                        }
                                    }
                                }

                                ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <?php
                                                            $clock_in = '-';
                                                            $clock_out = '-';
                                                            $lunch_in = '-';
                                                            $lunch_out = '-';
                                                            $shift = '-';
                                                            $yesterday_note = null;
                                                            $getTimeZone = json_decode($ipInfo);
                                                            $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));
                                                            $emp_logs = getUserLogs($attendance_id);
                                                            foreach ($emp_attendance as $attn) {
                                                                foreach ($emp_logs as $log) {
                                                                    if ($log->attendance_id == $attn->id) {
                                                                        $date_created = $log->date_created;
                                                                        date_default_timezone_set('UTC');
                                                                        $datetime_defaultTimeZone = new DateTime($date_created);
                                                                        $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                                                        $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                                                        $date_created = date('Y-m-d h:i A', strtotime($userZone_date_created));
                                                                        if ($attn->status == 1) {
                                                                            if ($log->action == 'Check in') {
                                                                                if (date('Y-m-d', strtotime($date_created)) <= date('Y-m-d', strtotime('yesterday'))) {
                                                                                    $clock_in = date('h:i A', strtotime($userZone_date_created));
                                                                                    $yesterday_note = date('Y-m-d', strtotime($date_created));
                                                                                    $shift = '-';
                                                                                } elseif (date('Y-m-d', strtotime($date_created)) == date('Y-m-d')) {
                                                                                    $clock_in = date('h:i A', strtotime($date_created));
                                                                                    $yesterday_note = null;
                                                                                }
                                                                            } elseif ($log->action == 'Break in') {
                                                                                $lunch_in = date('h:i A', strtotime($date_created));
                                                                                $lunch_out = null;
                                                                            } elseif ($log->action == 'Break out') {
                                                                                $lunch_out = date('h:i A', strtotime($date_created));
                                                                            }
                                                                        } else {
                                                                            if ($log->action == 'Check in') {
                                                                                $clock_in = date('h:i A', strtotime($date_created));
                                                                                if (date('Y-m-d', strtotime($date_created)) <= date('Y-m-d', strtotime('yesterday'))) {
                                                                                    $yesterday_note = date('Y-m-d', strtotime($date_created));
                                                                                } elseif (date('Y-m-d', strtotime($date_created)) == date('Y-m-d')) {
                                                                                    $yesterday_note = null;
                                                                                }
                                                                            } elseif ($log->action == 'Check out') {
                                                                                $clock_out = date('h:i A', strtotime($date_created));
                                                                                $seconds = ($attn->shift_duration * 3600);
                                                                                $hours = floor($attn->shift_duration);
                                                                                $seconds -= $hours * 3600;
                                                                                $minutes = floor($seconds / 60);
                                                                                $seconds -= $minutes * 60;
                                                                                $shift =  str_pad($hours, 2, '0', STR_PAD_LEFT) . ":" . str_pad($minutes, 2, '0', STR_PAD_LEFT);
                                                                            } elseif ($log->action == 'Break in') {
                                                                                $lunch_in = date('h:i A', strtotime($date_created));
                                                                            } elseif ($log->action == 'Break out') {
                                                                                $lunch_out = date('h:i A', strtotime($date_created));
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            //Employee's task
                                                            $task_name = '-';
                                                            $start_time = '-';
                                                            $end_time = '-';
                                                            $task_duration = '-';
                                                            $timezone = '-';
                                                            foreach ($schedules as $scheds) {
                                                                if ($scheds->user_id == $this->session->userdata('logged')['id']) {
                                                                    $unix_ts = time();
                                                                    $set_date = new DateTime("now", new DateTimeZone($timezone));
                                                                    $set_date->setTimestamp($unix_ts);
                                                                    foreach ($tasks as $task) {
                                                                        if ($task->ts_settings_id == $scheds->id && $task->start_date == $set_date->format('Y-m-d')) {
                                                                            $timezone = $scheds->timezone;
                                                                            $task_name = $scheds->project_name;
                                                                            $start_time = date('h:i A', strtotime($task->start_time));
                                                                            $end_time = date('h:i A', strtotime($task->end_time));
                                                                            $task_duration = $task->duration . "hour/s";
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            ?>
                                                            <div class="card-title user-card-title">
                                                                <div class="row">
                                                                    <div class="col-md-7" style="display: flex;">
                                                                        <span class="user-logs-title" style=" align-self: flex-end;"><?php if ($yesterday_note != null) {
                                                                                                                                            echo "Most recent logs";
                                                                                                                                        } else {
                                                                                                                                            echo "Today's logs";
                                                                                                                                        } ?></span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <span class="user-logs-title right employeeLunchBtn" style="">
                                                                            <a href="javascript:void(0)" class="employeeLunch" id="<?php echo $lunch_active; ?>" <?php echo $lunch_disabled; ?>>
                                                                                <img src="<?= base_url() ?>/assets/css/timesheet/images/coffee-<?php echo $lunch_icon; ?>.svg" alt="" class="btn-lunch">
                                                                                <img src="<?= base_url() ?>/assets/css/timesheet/images/coffee-hover.svg" alt="" class="btn-lunch-hover">
                                                                            </a>
                                                                            <span class="employeeLunchTooltip">Lunch in/out</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="user-logs">
                                                                <div class="user-logs-section">
                                                                    <div class="user-clock-in-title">Clock-in: </div>
                                                                    <div class="user-clock-out-title">Clock-out: </div>
                                                                    <div class="user-lunch-in-title">Lunch-in: </div>
                                                                    <div class="user-lunch-out-title">Lunch-out: </div>
                                                                    <div class="user-lunch-out-title">Shift Duration: </div>
                                                                </div>
                                                                <div class="user-logs-section">
                                                                    <div class="user-clock-in" id="userClockIn"><?php echo $clock_in; ?> <span style="color: grey"><?php echo $yesterday_note ?></span></div>
                                                                    <div class="user-clock-out" id="userClockOut"><?php echo $clock_out ?></div>
                                                                    <div class="user-lunch-in" id="userLunchIn"><?php echo $lunch_in ?></div>
                                                                    <div class="user-lunch-out" id="userLunchOut"><?php echo $lunch_out ?></div>
                                                                    <div class="user-shift-duration" id="userShiftDuration"><?php echo $shift ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title user-card-title">
                                                                <span>Remarks</span>
                                                            </div>
                                                            <div class="user-logs">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="#" target="_blank" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6" style="margin-bottom: 12px">
                                                                                    <label for="from_date_correction_requests" class="week-label">Week Date:</label>
                                                                                    <input type="text" name="date_from" id="week_attendance_remarks" class="form-control ts_schedule" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <table id="show_my_attendance_remarks" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="otrequest-table-list_info" style="display:none;">
                                                                            <thead>
                                                                                <tr role="row">
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 21</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 22</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 23</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 24</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 25</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 26</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">March 27</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="center">A</td>
                                                                                    <td class="center">A</td>
                                                                                    <td class="center">A</td>
                                                                                    <td class="center">A</td>
                                                                                    <td class="center">A</td>
                                                                                    <td class="center">A</td>
                                                                                    <td class="center">A</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <div class="table-ts-loader">
                                                                            <center><img class="my-attendance-remarks-loader" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-md-4">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title user-card-title">
                                                                <span>Leave requests</span>
                                                            </div>
                                                            <div class="user-logs">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <form action="#" target="_blank" method="POST">
                                                                            <div class="row">
                                                                                <div class="col-lg-6" style="margin-bottom: 12px">
                                                                                    <label for="from_date_correction_requests" class="week-label">From:</label>
                                                                                    <input type="text" name="date_from" id="from_date_leave_requests" class="form-control ts_schedule" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                                                </div>
                                                                                <div class="col-lg-6" style="margin-bottom: 12px">
                                                                                    <a href="javascript:void (0)" class="employeeLeaveBtn" id="btn-leave-emp" style="float: right;margin-top: -12px">
                                                                                        <img src="<?= base_url() ?>assets/css/timesheet/images/calendar-static.svg" alt="sick icon" class="btn-leave-static">
                                                                                        <img src="<?= base_url() ?>assets/css/timesheet/images/calendar-hover.svg" alt="sick icon" class="btn-leave-hover">
                                                                                    </a><span class="employeeLeaveTooltip">Request for leave</span>
                                                                                    <label for="to_date_correction_requests" class="week-label">To:</label>
                                                                                    <input type="text" name="date_to" id="to_date_leave_requests" class="form-control ts_schedule" value="<?= date("m/d/Y") ?>">

                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                        <table id="my_leave_requests" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="otrequest-table-list_info">
                                                                            <thead>
                                                                                <tr role="row">
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Date Filed</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 50px;">Leave Date</th>
                                                                                    <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Status</th>
                                                                                    <th class="sorting_disabled leave_request_action_td" rowspan="1" colspan="1" style="width: 0px;">Action</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody id="my_leave_requests_body">

                                                                            </tbody>
                                                                        </table>
                                                                        <div class="table-ts-loader">
                                                                            <center><img class="my-leave-requests-loader" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title user-card-title">
                                                                <span>Attendance Correction Requests</span>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form action="#" target="_blank" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-lg-2" style="margin-bottom: 12px">
                                                                                <label for="from_date_correction_requests" class="week-label">From:</label>
                                                                                <input type="text" name="date_from" id="from_date_correction_requests" class="form-control ts_schedule" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                                            </div>
                                                                            <div class="col-lg-2" style="margin-bottom: 12px">
                                                                                <label for="to_date_correction_requests" class="week-label">To:</label>
                                                                                <input type="text" name="date_to" id="to_date_correction_requests" class="form-control ts_schedule" value="<?= date("m/d/Y") ?>">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <table id="my_correction_requests" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="otrequest-table-list_info" style="display:none;">
                                                                        <thead>
                                                                            <tr role="row">
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Date</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Login</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Worked Hours</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Break Duration</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Overtime</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Request Status</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr role="row" class="odd">
                                                                                <td><label class="gray">03-21-2021</label></td>
                                                                                <td>
                                                                                    <center>
                                                                                        <label class="gray"><strong>Clock in: &nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                                        <label class="gray"><strong>Clock out: &nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                                    </center>
                                                                                </td>
                                                                                <td>
                                                                                    <center>
                                                                                        <label class="gray"><strong>Break in: &nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                                        <label class="gray"><strong>Break out:&nbsp;</strong> 03-21-2021 12:20 PM</label>
                                                                                    </center>
                                                                                </td>
                                                                                <td style="text-align:center;">9.3</td>
                                                                                <td style="text-align:center;">1.30</td>
                                                                                <td style="text-align:center;">1.30</td>
                                                                                <td style="text-align:center;">Pending</td>
                                                                                <td style="text-align:center;">
                                                                                    <a href="#" title="" data-name="Jonah  Pacas-Abanil" data-user-id="14" data-attn-id="143" data-toggle="tooltip" class="approve-ot-request btn btn-danger btn-sm" data-original-title="Cancel Request"><i class="fa fa-times fa-lg"></i> Cancel</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="table-ts-loader">
                                                                        <center><img class="my-correction-requests-loader" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 20px">
                                    <div class="col-md-12">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title user-card-title">
                                                                <span>Attendance Logs</span>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form action="#" target="_blank" method="POST">
                                                                        <div class="row">
                                                                            <div class="col-lg-2" style="margin-bottom: 12px">
                                                                                <label for="from_date_logs" class="week-label">From:</label>
                                                                                <input type="text" name="date_from" id="from_date_logs" class="form-control ts_schedule" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                                            </div>
                                                                            <div class="col-lg-2" style="margin-bottom: 12px">
                                                                                <label for="to_date_logs" class="week-label">To:</label>
                                                                                <input type="text" name="date_to" id="to_date_logs" class="form-control ts_schedule" value="<?= date("m/d/Y") ?>">
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    <table id="my-attendance-logs" class="table table-bordered table-striped no-footer dataTable" role="grid" aria-describedby="otrequest-table-list_info" style="display:none;">
                                                                        <thead>
                                                                            <tr role="row">
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Date</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift Start</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Shift End</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Expected Work Hours</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Clock in</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Clock out</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Worked Hours</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Late in minutes</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Overtime</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">OT Status</th>
                                                                                <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 0px;">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr role="row" class="odd">
                                                                                <td>03-21-2021</td>
                                                                                <td>03-21-2021 12:20 PM</td>
                                                                                <td>03-21-2021 09:38 PM</td>
                                                                                <td style="text-align:center;">9.3</td>
                                                                                <td style="text-align:center;">1.30</td>
                                                                                <td style="text-align:center;">Pending</td>
                                                                                <td style="text-align:center;"></td>
                                                                                <td style="text-align:center;"></td>
                                                                                <td style="text-align:center;"></td>
                                                                                <td style="text-align:center;"></td>
                                                                                <td style="text-align:center;">
                                                                                    <a href="#" title="" data-name="Jonah  Pacas-Abanil" data-user-id="14" data-attn-id="143" data-toggle="tooltip" class="approve-ot-request btn btn-primary btn-sm" data-original-title="Approve"><i class="fa fa-adjust fa-lg"></i> Request Adjustment</a>
                                                                                    <a href="#" title="" data-name="Jonah  Pacas-Abanil" data-user-id="14" data-attn-id="143" data-toggle="tooltip" class="deny-ot-request btn btn-warning btn-sm" data-original-title="Deny"><i class="fa fa-clock-o fa-lg"></i> Request OT Approval</a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="table-ts-loader">
                                                                        <center><img class="ts-loader-img" src="<?= base_url() ?>/assets/css/timesheet/images/ring-loader.svg" alt=""></center>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
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
<!--Leave request modal-->
<div class="modal fade" id="leaveRequestModal">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Request Leave</h4>
                <!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form action="" id="leaveRequestForm" method="post">
                    <div class="form-group" style="width: 250px">
                        <label for="" style="display: block">Leave type</label>
                        <select name="pto" id="leaveSelectList" class="form-control">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="startDateLeave">Leave date</label>
                                <input type="text" name="leave_date" class="form-control" id="startDateLeave" data-role="tagsinput">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submitLeaveRequest">Submit</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--end of modal-->



<div class="modal-right-side">
    <div class="modal right fade" id="request_attendance_correct_from" tabindex="" role="dialog" aria-labelledby="edit_attendance_log">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="edit_attendance_log"><i class="fa fa-pencil-square-o"></i> <span>Request Attendance Correcttion</span><label id="edit_attendance_name">Lou Pinton</label></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="" method="post" id="formNewProject">
                    <div class="modal-body">
                        <input type="hidden" name="timesheet_attendance_id" id="form_timesheet_attendance_id">
                        <input type="hidden" name="user_id" id="form_user_id">
                        <input type="hidden" name="timesheet_shift_schedule_id" id="form_timesheet_shift_schedule_id">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Shift Start</label>
                                    <input type="text" name="shift_start" id="form_shift_start" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group hiddenSection">
                                    <label for="">Shift End</label>
                                    <input type="text" name="shift_end" id="form_shift_end" class="form-control ts-start-date" value="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Clock In</label>
                                    <input type="date" name="shift_start" id="form_clockin_date" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group hiddenSection">
                                    <label for="">&nbsp;</label>
                                    <input type="time" name="shift_end" id="form_clockin_time" class="form-control ts-start-date" value="" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Clock Out</label>
                                    <input type="date" name="shift_start" id="form_clockout_date" class="form-control" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group hiddenSection">
                                    <label for="">&nbsp;</label>
                                    <input type="time" name="shift_end" id="form_clockout_time" class="form-control ts-start-date" value="" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Break In</label>
                                    <input type="date" name="shift_start" id="form_breakin_date" class="form-control" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group hiddenSection">
                                    <label for="">&nbsp;</label>
                                    <input type="time" name="shift_end" id="form_breakin_time" class="form-control ts-start-date" value="" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Break Out</label>
                                    <input type="date" name="shift_start" id="form_breakout_date" class="form-control" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group hiddenSection">
                                    <label for="">&nbsp;</label>
                                    <input type="time" name="shift_end" id="form_breakout_time" class="form-control ts-start-date" value="" onchange="edit_attendance_log_form_changed()">
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info" role="alert">
                            Overtime status of this attendance is <span id="form_ot_status" style="font-weight: bold;">Approved</span>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group hiddenSection">
                                    <table class="table table-bordered table-striped no-footer dataTable" style="width: auto;" role="grid" aria-describedby="timeLogTable_info">
                                        <thead>
                                            <tr role="row">
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Expected Hours: activate to sort column ascending" style="width: 25%;">Expected Shift Duration</td>
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Expected Hours: activate to sort column ascending" style="width: 25%;">Expected Break Duration</td>
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Worked Hours: activate to sort column ascending" style="width: 25%;">Expected Work Hours</td>
                                            </tr>
                                        </thead>
                                        <tbody class="employee-tbody">
                                            <tr role="row" class="odd">
                                                <td class="center" id="form_expected_hours"></td>
                                                <td class="center" id="form_expected_break_duration"></td>
                                                <td class="center" id="form_expected_work_hours"></td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr role="row">
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Worked Hours: activate to sort column ascending" style="width: 25%;">Late in Minutes</td>
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Worked Hours: activate to sort column ascending" style="width: 25%;">Worked Hours</td>
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Break Duration: activate to sort column ascending" style="width: 25%;">Break Duration</td>
                                            </tr>
                                        </thead>
                                        <tbody class="employee-tbody">
                                            <tr role="row" class="odd">

                                                <td class="center num_only time-log" id="form_minutes_late"></td>
                                                <td class="center num_only time-log" id="form_worked_hours">8.28</td>
                                                <td class="center num_only time-log" id="form_break_duration">0.00</td>
                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr role="row">
                                                <td class="sorting" tabindex="0" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Break Duration: activate to sort column ascending" style="width: 25%;">Overtime</td>
                                                <td class="sorting" tabindex="0" colspan="2" aria-controls="timeLogTable" rowspan="1" colspan="1" aria-label="Over Time: activate to sort column ascending" style="text-align:center;">Payable Hours</td>
                                            </tr>
                                        </thead>
                                        <tbody class="employee-tbody">
                                            <tr role="row" class="odd">
                                                <td class="center num_only time-log" id="form_over_time">0.00</td>
                                                <td class="center num_only time-log" colspan="2" id="form_payable_hours"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="submit_attendance_correction_request">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Request Adjustment -->
<?php include viewPath('includes/footer'); ?>
<script>
    //DataTable Table Attendance
    $('#ts-attendance').DataTable({
        "sort": false
    });
    //Real-time capture of time
    let real_time;

    let total_users = "<?php echo $total_users; ?>";
    // let baseURL=window.location.origin;
    // if(baseURL=="https://www.nsmartrac.local"){
    //     baseURL=window.location.origin+"/nsmartrac";
    // }

    function serverTime() {
        let datetime = null;
        $.ajax({
            url: baseURL + "timesheet/realTime",
            dataType: "json",
            async: false,
            success: function(data) {
                datetime = data;
            }
        });
        real_time = setTimeout(serverTime, 1000);
        return datetime;
    }
    $(document).ready(function() {

        //Date picker
        $(".bootstrap-tagsinput > input").datepicker();

        // In/Out Counter
        // let out_log = $('#outCounter').val();
        // let in_log = $('#inCounter').val();
        let total_user = $('#employeeTotal').val();
        // let in_log_cal = (in_log / total_user);
        // let in_ans = in_log_cal.toFixed(2) * 100
        // let out_log_cal = (out_log / total_user);
        // let out_ans =  out_log_cal.toFixed(2) * 100
        // $('#employee-in-now').text(in_log);
        // $('#progressInNow').attr('aria-valuenow',in_log).css('width',in_ans+"%").text(in_ans+"%");
        // $('#employee-out-now').text(out_log);
        // $('#progressOutNow').attr('aria-valuenow',out_log).css('width',out_ans+"%").text(out_ans+"%");

        function inNow() {
            $.ajax({
                url: "/timesheet/inNow",
                dataType: "json",
                success: function(data) {
                    $('#employee-in-now').text(data);
                    let percentage = (data / total_user) * 100;
                    $('#progressInNow').attr('aria-valuenow', percentage.toFixed(2)).css('width', percentage.toFixed(2) + '%').text(percentage.toFixed(2) + '%');
                }
            });
        }

        function outNow() {
            $.ajax({
                url: "/timesheet/outNow",
                dataType: "json",
                success: function(data) {
                    $('#employee-out-now').text(data);
                    let percentage = (data / total_user) * 100;
                    $('#progressOutNow').attr('aria-valuenow', percentage.toFixed(2)).css('width', percentage.toFixed(2) + '%').text(percentage.toFixed(2) + '%');
                }
            });
        }

        function notLoggedIn() {
            $.ajax({
                url: "/timesheet/loggedInToday",
                dataType: "json",
                success: function(data) {
                    $('#employee-not-loggedin').text(data);
                    let percentage = (100 - (((total_user - data) / total_user) * 100));
                    $('#progressNotLoggedIn').attr('aria-valuenow', percentage.toFixed(2)).css('width', percentage.toFixed(2) + '%').text(percentage.toFixed(2) + '%');
                }
            });
        }
        // Checking IN
        $(document).on('click', '#employeeCheckIn', function() {
            let id = $(this).attr('data-id');
            let emp_name = $(this).attr('data-name');
            let selected = this;
            let entry = 'Manual';
            let approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Clock in?',
                html: "Are you sure you want to Clock-in this person?<br> <strong>" + emp_name + "</strong>",
                imageUrl: photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clock-in!'
            }).then((result) => {
                if (result.value) {
                    //show loading
                    $(selected).parent('td').children('.loading-img-action').show();
                    $(selected).parent('td').children('a').hide();
                    $(selected).parent('td').children('i').hide();

                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/checkingInEmployee',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            entry: entry,
                            approved_by: approved_by,
                            company_id: company_id
                        },
                        success: function(data) {
                            if (data != 0) {
                                let time = serverTime();
                                $(selected).attr('data-attn', data.attendance_id);
                                $(selected).prev('a').show();
                                $(selected).next('i').removeClass('fa-times-circle-none');
                                $(selected).next('i').addClass('fa-check');
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-time').removeClass("gray").addClass('gray');
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-yesterday').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.in-indicator').show();
                                $(selected).attr('id', 'employeeCheckOut');
                                $(selected).attr('data-company', data.company_id);
                                $(selected).prev('a').attr('disabled', null);
                                $(selected).prev('a').attr('id', 'employeeBreakIn');
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').text(null);
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').removeClass("gray");
                                $(selected).parent('td').prev('td').children('.break-out-time').text(null);
                                $(selected).parent('td').prev('td').children('.break-out-time').removeClass("gray");
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').removeClass("gray");
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.out-indicator').hide();
                                clearTimeout(real_time);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> has been Clock-in",
                                    icon: 'success'
                                });
                            } else if (data == false) {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process. Please reload the page.",
                                    icon: 'warning'
                                });
                            }

                            //hide loading
                            $(selected).parent('td').children('.loading-img-action').hide();
                            $(selected).parent('td').children('a').show();
                            $(selected).parent('td').children('i').show();
                            app_notification(
                                data.token,
                                data.body,
                                data.device_type,
                                data.company_id,
                                data.title
                            );
                        }
                    });

                }
            });
        });


        // Checking OUT
        $(document).on('click', '#employeeCheckOut', function() {
            let id = $(this).attr('data-id');
            let emp_name = $(this).attr('data-name');
            let selected = this;
            let attn_id = $(this).attr('data-attn');
            let entry = 'Manual';
            let approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Clock out?',
                html: "Are you sure you want to Clock-out this person?<br> <strong>" + emp_name + "</strong>",
                imageUrl: photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clock-out!'
            }).then((result) => {
                if (result.value) {
                    $(selected).parent('td').children('.loading-img-action').show();
                    $(selected).parent('td').children('a').hide();
                    $(selected).parent('td').children('i').hide();

                    $.ajax({
                        url: baseURL + '/timesheet/checkingOutEmployee',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            attn_id: attn_id,
                            entry: entry,
                            approved_by: approved_by,
                            company_id: company_id
                        },
                        success: function(data) {
                            console.log(data);
                            if (data != 0) {

                                $(selected).parent('td').children('.loading-img-action').hide();
                                $(selected).parent('td').children('a').show();
                                $(selected).parent('td').children('i').show();

                                let time = serverTime();
                                $(selected).prev('a').hide();
                                $(selected).attr('id', 'employeeCheckIn');
                                $(selected).next('i').removeClass('fa-check');
                                $(selected).next('i').removeClass('fa-cutlery');
                                $(selected).next('i').addClass('fa-times-circle-none');
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.out-indicator').show();
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').addClass('gray');
                                $(selected).parent('tr').prev('td').prev('td').children('.lunch-indicator').hide();
                                if (data.current_status == "on_lunch") {
                                    $(selected).parent('td').prev('td').children('.break-out-time').text(data.lunch_out);
                                    $(selected).parent('td').prev('td').children('.break-out-time').addClass("gray");
                                    $(selected).parent('td').prev('td').children('.break-out-time').show();
                                }
                                $(selected).parent('td').prev('td').children('.in-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.in-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').children('.lunch-indicator').hide();
                                $(selected).parent('td').prev('td').children('#employeeBreakIn').hide();

                                clearTimeout(real_time);

                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> has been Clock-out",
                                    icon: 'success'
                                });
                            } else {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                            }

                            app_notification(
                                data.token,
                                data.body,
                                data.device_type,
                                company_id,
                                data.title
                            );
                        }
                    });
                }
            });
        });
        // Break In
        $(document).on('click', '#employeeBreakIn', function() {
            let id = $(this).attr('data-id');
            let emp_name = $(this).attr('data-name');
            let selected = this;
            let entry = 'Manual';
            let approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Lunch break?',
                html: "Are you sure you want this person to be on lunch?<br> <strong>" + emp_name + "</strong>",
                imageUrl: photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, take a lunch!'
            }).then((result) => {
                if (result.value) {
                    $(selected).parent('td').children('.loading-img-action').show();
                    $(selected).parent('td').children('a').hide();
                    $(selected).parent('td').children('i').hide();

                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/breakIn',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            approved_by: approved_by,
                            entry: entry,
                            company_id: company_id
                        },
                        success: function(data) {
                            console.log(data);
                            if (data != null) {
                                // let time = serverTime();
                                $(selected).next('a').next('i').removeClass('fa-check');
                                $(selected).next('a').next('i').addClass('fa-cutlery');
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').text(data.time);
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').addClass("gray");
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.in-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').children('.lunch-indicator').show();
                                $(selected).parent('td').prev('td').children('.in-indicator').hide();
                                $(selected).parent('td').prev('td').children('.out-indicator').hide();
                                $(selected).parent('td').prev('td').children('.break-out-time').hide();
                                $(selected).attr('id', 'employeeBreakOut');
                                // clearTimeout(real_time);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> is taking a break.",
                                    icon: 'success'
                                });
                                app_notification(
                                    data.token,
                                    data.body,
                                    data.device_type,
                                    data.company_id,
                                    data.title
                                );
                            } else {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                            }
                            $(selected).parent('td').children('.loading-img-action').hide();
                            $(selected).parent('td').children('a').show();
                            $(selected).parent('td').children('i').show();

                        }
                    });
                }
            });
        });

        //Break out
        $(document).on('click', '#employeeBreakOut', function() {
            let id = $(this).attr('data-id');
            let emp_name = $(this).attr('data-name');
            let selected = this;
            let entry = 'Manual';
            let approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Back to work?',
                html: "Have this person back to work?<br> <strong>" + emp_name + "</strong>",
                imageUrl: photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, back to work!'
            }).then((result) => {
                if (result.value) {
                    $(selected).parent('td').children('.loading-img-action').show();
                    $(selected).parent('td').children('a').hide();
                    $(selected).parent('td').children('i').hide();
                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/breakOut',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            approved_by: approved_by,
                            entry: entry,
                            company_id: company_id
                        },
                        success: function(data) {
                            if (data != 0) {
                                // let time = serverTime();
                                $(selected).next('a').next('i').removeClass('fa-cutlery');
                                $(selected).prev('a').hide();
                                $(selected).next('a').next('i').addClass('fa-check');
                                $(selected).parent('td').prev('td').children('.break-out-time').text(data.time);
                                $(selected).parent('td').prev('td').children('.break-out-time').addClass("gray");
                                $(selected).parent('td').prev('td').prev('td').children('.lunch-indicator').hide();
                                $(selected).parent('td').prev('td').children('.in-indicator').show();
                                $(selected).parent('td').prev('td').children('.break-out-time').show();
                                $(selected).attr('id', 'employeeBreakIn');
                                // $(selected).attr('disabled','disabled');
                                // clearTimeout(real_time);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> is now back to work.",
                                    icon: 'success'
                                });

                                app_notification(
                                    data.token,
                                    data.body,
                                    data.device_type,
                                    data.company_id,
                                    data.title
                                );
                            } else {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                            }
                            $(selected).parent('td').children('.loading-img-action').hide();
                            $(selected).parent('td').children('a').show();
                            $(selected).parent('td').children('i').show();

                        }
                    });
                }
            });
        });
        //Employee leave
        $(document).on('click', '#btn-leave-emp', function() {
            $('#leaveRequestModal').modal({
                backdrop: 'static',
                keyboard: false
            });
            $('.bootstrap-tagsinput').children('span').remove();
        });
        //PTO list
        $('#leaveSelectList').select2({
            placeholder: 'Select type',
            width: 'resolve',
            ajax: {
                url: baseURL + '/timesheet/getPTOList',
                type: "GET",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    let query = {
                        search: params.term
                    };
                    return query;
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }
        });
        //Employee request for leave
        $(document).on('click', '#submitLeaveRequest', function() {
            let values = {};
            $.each($('#leaveRequestForm').serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            let date = values['leave_date'];
            let array = date.split(',');

            Swal.fire({
                title: 'Requesting leave',
                html: "Are you sure you want this request?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: baseURL + '/timesheet/employeeRequestLeave',
                        method: "POST",
                        dataType: "json",
                        data: {
                            values: values,
                            array: array
                        },
                        success: function(data) {
                            if (data == 1) {
                                $('#leaveRequestModal').modal('hide');
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: "Success",
                                    html: "Your leave request has been sent!",
                                    icon: "success",
                                });
                            }
                        }
                    });
                }
            });
        });
    });

    function waitForClockInOutattendance() {
        $.ajax({
            type: "GET",
            url: baseURL + "/Timesheet/getClockInOutNotification",
            async: true,
            cache: false,
            timeout: 10000,
            success: function(data) {

                var obj = JSON.parse(data);
                $.each(obj, function(currentIndex, currentElem) {

                    $('#employee-in-now').html(currentElem.ClockIn);
                    $('#employee-out-now').html(currentElem.ClockOut);

                    var in1 = Math.round((currentElem.ClockIn / total_users) * 100, 0) + '%';
                    var in2 = Math.round((currentElem.ClockIn / total_users) * 100, 2) + '%';
                    var out1 = Math.round((currentElem.ClockOut / total_users) * 100, 0) + '%';
                    var out2 = Math.round((currentElem.ClockOut / total_users) * 100, 2) + '%';

                    $("#progressClockIn").html('<div id="progressInNow" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="' + currentElem.ClockIn + '" aria-valuemin="0" aria-valuemax="100" style="width:' + in1 + '">' + in2 + '</div>');
                    $("#progressOutNow").html('<div id="progressOutNow" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="' + currentElem.ClockOut + '" aria-valuemin="0" aria-valuemax="100" style="width:' + out1 + '">' + out2 + '</div>');
                });
                setTimeout(waitForClockInOutattendance, 2000);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(waitForClockInOutattendance, 15000);
            }
        });
    };

    $(document).ready(function() {
        var TimeStamp = null;
        // waitForClockInOutattendance();
    });
</script>