<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
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
        height: 120px;
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
        color: black;
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

    .tbl-employee-attendance .tbl-employee-name {
        font-size: 15px;
        font-weight: bold;
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
        height: 110px;
        width: 110px;
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

    .fa-mug-hot {
        color: #ffc859;
    }

    .red-indicator {
        display: none;
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        border: 1px solid red;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
        box-shadow: 0 2px 5px 2px rgba(0, 0, 0, 0.51);
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
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center" style="display:none;">
                    <div class="col-sm-6">
                        <h1 class="page-title">Attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right d-none d-md-block">
                            <div class="dropdown">
                                <?php if (hasPermissions('users_add')) : ?>
                                    <a href="<?php echo url('users/add_timesheet_entry') ?>" class="btn btn-primary" aria-expanded="false">
                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry
                                    </a>
                                <?php endif ?>
                            </div>
                        </div>
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
                        <div class="pl-4 pr-4 row">
                            <div class="col mb-4 left alert alert-warning mt-0 mb-2">
                                <span style="color:black;font-family: 'Open Sans',sans-serif !important;font-weight:300 !important;font-size: 14px;">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                            </div>
                        </div>
                        <div class="row" style="padding: 10px 33px 20px 33px;">
                            <div class="col-md-12 banking-tab-container">
                                <a href="<?php echo url('/timesheet/attendance') ?>" class="banking-tab<?php echo ($this->uri->segment(1) == "attendance") ?: '-active'; ?>" style="text-decoration: none">Attendance</a>
                                <a href="<?php echo url('/timesheet/employee') ?>" class="banking-tab">Employee</a>
                                <a href="<?php echo url('/timesheet/schedule') ?>" class="banking-tab">Schedule</a>
                                <a href="<?php echo url('/timesheet/list') ?>" class="banking-tab">List</a>
                                <a href="<?php echo url('/timesheet/settings') ?>" class="banking-tab">Settings</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="today-date">
                                <h6><i class="fa fa-calendar-alt"></i> Today: <span style="color: grey"><?php echo date('M d, Y'); ?></span></h6>
                            </div>
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
                                                        <div class="progress">
                                                            <div id="progressInNow" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $in_now; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($in_now / $total_users) * 100, 2) . '%'; ?>">
                                                                <?php echo round(($in_now / $total_users) * 100, 2) . '%'; ?>
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
                                                            <span>Out Now</span>
                                                        </div>
                                                        <div class="card-data">
                                                            <span id="employee-out-now"><?php echo $out_now ?></span>
                                                        </div>
                                                        <div class="progress">
                                                            <div id="progressOutNow" class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $out_now ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(($out_now / $total_users) * 100, 2) . '%'; ?>">
                                                                <?php echo round(($out_now / $total_users) * 100, 2) . '%'; ?>
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
                                                            <span>Not Logged-in Today</span>
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
                                                            <span>On Approved Leave</span>
                                                        </div>
                                                        <div class="card-data">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="progress">
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
                                <div class="col-md-3">
                                    <div class="tile-container">
                                        <div class="inner-container">
                                            <div class="tileContent">
                                                <div class="clear">
                                                    <div class="inner-content">
                                                        <div class="card-title">
                                                            <span>On Unapproved Leave</span>
                                                        </div>
                                                        <div class="card-data">
                                                            <span>0</span>
                                                        </div>
                                                        <div class="progress">
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
                                                            <span>0</span>
                                                        </div>
                                                        <div class="progress">
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
                                <div class="col-md-3">
                                    <div class="tile-container">
                                        <div class="inner-container">
                                            <div class="tileContent">
                                                <div class="clear">
                                                    <div class="inner-content">
                                                        <div class="card-title">
                                                            <span>On Business Travel</span>
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
                                    <table id="ts-attendance" class="table table-bordered table-striped tbl-employee-attendance">
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
                                            $status = 'fa-times-circle';
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
                                            ?>
                                            <?php foreach ($users as $cnt => $user) : ?>
                                                <?php
                                                foreach ($user_roles as $role) {
                                                    if ($role->id == $user->role) {
                                                        $u_role = $role->title;
                                                    }
                                                }
                                                foreach ($attendance as $attn) {
                                                    if ($attn->user_id == $user->id) {
                                                        $attn_id = $attn->id;
                                                        foreach ($ts_logs as $log) {
                                                            if ($log->action == 'Check in' && $user->id == $log->user_id && $attn->id == $log->attendance_id) {
                                                                if ($attn->date_in == date('Y-m-d')) {
                                                                    $time_in = date('h:i A', $log->time);
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
                                                                    $yesterday_in = null;
                                                                    $clock_in_2nd = 0;
                                                                }
                                                                if ($attn->id == $log->attendance_id && $attn->date_in == date('Y-m-d', strtotime('yesterday')) && $attn->status == 1) {
                                                                    $time_in = date('h:i A', $log->time);
                                                                    $yesterday_in = "(Yesterday)";
                                                                    $btn_action = 'employeeCheckOut';
                                                                    $clock_in_2nd = 1;
                                                                }
                                                            } elseif ($log->action == 'Check out' && $user->id == $log->user_id && $attn->id == $log->attendance_id) {
                                                                if ($attn->id == $log->attendance_id && $attn->date_out == date('Y-m-d')) {
                                                                    $status = 'fa-times-circle';
                                                                    $btn_action = null;
                                                                    $time_out = date('h:i A', $log->time);
                                                                    $disabled = 'disabled="disabled"';
                                                                    $break = 'disabled="disabled"';
                                                                    $break_id = null;
                                                                    $indicator_in = 'display:none';
                                                                    $indicator_out = 'display:block';
                                                                    $indicator_in_break = 'display:none';
                                                                    $indicator_out_break = 'display:none';
                                                                }
                                                                if ($user->id == $log->user_id && $attn->date_in == date('Y-m-d', strtotime('yesterday'))) {
                                                                    $disabled = null;
                                                                    $btn_action = 'employeeCheckIn';
                                                                }
                                                            } elseif ($log->action == 'Break in' && $user->id == $log->user_id && $attn->id == $log->attendance_id) {
                                                                //                                                                if ($attn->id == $log->attendance_id && $attn->date_out == date('Y-m-d')){
                                                                $break_id = 'employeeBreakOut';
                                                                $status = 'fa-mug-hot';
                                                                $break_in = date('h:i A', $log->time);
                                                                $indicator_in = 'display:none';
                                                                $indicator_out = 'display:none';
                                                                $indicator_in_break = 'display:block';
                                                                $indicator_out_break = 'display:none';
                                                                //                                                                }
                                                            } elseif ($log->action == 'Break out' && $user->id == $log->user_id && $attn->id == $log->attendance_id) {
                                                                //                                                                if ($attn->id == $log->attendance_id && $attn->date_out == date('Y-m-d')){
                                                                $status = 'fa-check';
                                                                $break_out = date('h:i A', $log->time);
                                                                $break = 'disabled="disabled"';
                                                                $break_id = null;
                                                                $indicator_in = 'display:none';
                                                                $indicator_out = 'display:none';
                                                                $indicator_in_break = 'display:none';
                                                                $indicator_out_break = 'display:block';
                                                                //                                                                }
                                                            }

                                                            foreach ($week_duration as $week) {
                                                                if ($week->user_id == $user->id) {
                                                                    $week_id = $week->id;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                                <tr>
                                                    <td class="tbl-id-number"><?php echo $cnt + 1 ?></td>
                                                    <td>
                                                        <span class="tbl-employee-name"><?php echo $user->FName; ?></span> <span class="tbl-employee-name"><?php echo $user->LName; ?></span>
                                                        <span class="tbl-emp-role"><?php echo $u_role; ?></span>
                                                    </td>
                                                    <td class="tbl-chk-in">
                                                        <div class="red-indicator" style="<?php echo $indicator_in ?>"></div> <span class="clock-in-time"><?php echo $time_in ?></span> <span class="clock-in-yesterday" style="display: block;"><?php echo $yesterday_in; ?></span>
                                                    </td>
                                                    <td class="tbl-chk-out">
                                                        <div class="red-indicator" style="<?php echo $indicator_out ?>"></div> <span class="clock-out-time"><?php echo $time_out ?></span><input type="hidden" id="clockIn2nd" value="<?php echo $clock_in_2nd; ?>">
                                                    </td>
                                                    <td class="tbl-lunch-in">
                                                        <div class="red-indicator" style="<?php echo $indicator_in_break ?>"></div> <span class="break-in-time"><?php echo $break_in; ?></span>
                                                    </td>
                                                    <td class="tbl-lunch-out">
                                                        <div class="red-indicator" style="<?php echo $indicator_out_break ?>"></div> <span class="break-out-time"><?php echo $break_out; ?></span>
                                                    </td>
                                                    <td class="tbl-emp-action">
                                                        <a href="javascript:void(0)" class="employee-break" id="<?php echo $break_id ?>" <?php echo $break; ?> data-id="<?php echo $user->id ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>"><i class="fa fa-coffee fa-lg"></i></a>
                                                        <a href="javascript:void(0)" class="employee-in-out" <?php echo $disabled ?> id="<?php echo $btn_action; ?>" data-week="<?php echo $week_id ?>" data-attn="<?php echo $attn_id; ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id; ?>" data-approved="<?php echo $this->session->userdata('logged')['id']; ?>"><i class="fa fa-user-clock fa-lg"></i></a>
                                                        <i class="fa <?php echo $status; ?> status"></i>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                                $u_role = null;
                                                $status = 'fa-times-circle';
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
                                                $clock_in_2nd = 0
                                                ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
    //DataTable Table Attendance
    $('#ts-attendance').DataTable({
        "sort": false
    });
    //Real-time capture of time
    var real_time;

    function serverTime() {
        var datetime = null;
        $.ajax({
            url: "/timesheet/realTime",
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
        var total_employee = $('#employeeTotal').val();

        function inNow() {
            $.ajax({
                url: "/timesheet/inNow",
                dataType: "json",
                success: function(data) {
                    $('#employee-in-now').text(data);
                    var percentage = (data / total_employee) * 100;
                    $('#progressInNow').attr('aria-valuenow', percentage.toFixed(2));
                    $('#progressInNow').css('width', percentage.toFixed(2) + '%');
                    $('#progressInNow').text(percentage.toFixed(2) + '%');
                }
            });
        }

        function outNow() {
            $.ajax({
                url: "/timesheet/outNow",
                dataType: "json",
                success: function(data) {
                    $('#employee-out-now').text(data);
                    var percentage = (data / total_employe) * 100;
                    $('#progressOutNow').attr('aria-valuenow', percentage.toFixed(2));
                    $('#progressOutNow').css('width', percentage.toFixed(2) + '%');
                    $('#progressOutNow').text(percentage.toFixed(2) + '%');
                }
            });
        }

        function notLoggedIn() {
            $.ajax({
                url: "/timesheet/loggedInToday",
                dataType: "json",
                success: function(data) {
                    $('#employee-not-loggedin').text(data);
                    var percentage = (100 - (((total_employe - data) / total_employe) * 100));
                    $('#progressNotLoggedIn').attr('aria-valuenow', percentage.toFixed(2));
                    $('#progressNotLoggedIn').css('width', percentage.toFixed(2) + '%');
                    $('#progressNotLoggedIn').text(percentage.toFixed(2) + '%');
                }
            });
        }

        // Checking IN
        $(document).on('click', '#employeeCheckIn', function() {
            var id = $(this).attr('data-id');
            var emp_name = $(this).attr('data-name');
            var selected = this;
            var entry = 'Manual';
            var approved_by = $(this).attr('data-approved');
            Swal.fire({
                title: 'Checking in?',
                html: "Are you sure you want to Check-in this person?<br> <strong>" + emp_name + "</strong>",
                imageUrl: "/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Check in this!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/timesheet/checkingInEmployee',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            entry: entry,
                            approved_by: approved_by
                        },
                        success: function(data) {
                            if (data != 0) {
                                inNow();
                                notLoggedIn();
                                var time = serverTime();
                                $(selected).attr('data-attn', data);
                                $(selected).next('i').removeClass('fa-times-circle');
                                $(selected).next('i').addClass('fa-check');
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-yesterday').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.red-indicator').show();
                                $(selected).attr('id', 'employeeCheckOut');
                                $(selected).prev('a').attr('disabled', null);
                                $(selected).prev('a').attr('id', 'employeeBreakIn');
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').text(null);
                                $(selected).parent('td').prev('td').children('.break-out-time').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.red-indicator').hide();
                                clearTimeout(real_time);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> has been Checked-in",
                                    icon: 'success'
                                });
                            } else if (data == false) {
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Failed',
                                    text: "Something is wrong in the process",
                                    icon: 'warning'
                                });
                            }

                        }
                    });
                }
            });
        });
        // Checking OUT
        $(document).on('click', '#employeeCheckOut', function() {
            var id = $(this).attr('data-id');
            var emp_name = $(this).attr('data-name');
            var selected = this;
            var week_id = $(this).attr('data-week');
            var attn_id = $(this).attr('data-attn');
            var entry = 'Manual';
            var approved_by = $(this).attr('data-approved');
            Swal.fire({
                title: 'Checking out?',
                html: "Are you sure you want to Check-Out this person?<br> <strong>" + emp_name + "</strong>",
                imageUrl: "/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Check-out this!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/timesheet/checkingOutEmployee',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            week_id: week_id,
                            attn_id: attn_id,
                            entry: entry,
                            approved_by: approved_by
                        },
                        success: function(data) {
                            if (data == 1) {
                                inNow();
                                outNow();
                                var time = serverTime();
                                $(selected).next('i').removeClass('fa-check');
                                $(selected).next('i').addClass('fa-times-circle');
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.red-indicator').show();
                                $(selected).parent('td').prev('td').children('.red-indicator').hide();
                                var second_in = $(selected).parent('td').prev('td').prev('td').prev('td').children('#clockIn2nd').val();
                                clearTimeout(real_time);
                                if (second_in == 0) {
                                    $(selected).attr('id', null);
                                    $(selected).attr('disabled', 'disabled');
                                    $(selected).prev('a').attr('disabled', 'disabled');
                                    $(selected).prev('a').attr('id', null);
                                } else {
                                    $(selected).attr('id', 'employeeCheckIn');
                                    $(selected).parent('td').prev('td').prev('td').prev('td').children('#clockIn2nd').val(0);
                                }
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> has been Checked-out",
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

                        }
                    });
                }
            });
        });
        // Break In
        $(document).on('click', '#employeeBreakIn', function() {
            var id = $(this).attr('data-id');
            var emp_name = $(this).attr('data-name');
            var selected = this;
            var entry = 'Manual';
            var approved_by = $(this).attr('data-approved');
            Swal.fire({
                title: 'Take a break?',
                html: "Are you sure you want to take a break this person?<br> <strong>" + emp_name + "</strong>",
                imageUrl: "/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, take a break!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/timesheet/breakIn',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            approved_by: approved_by,
                            entry: entry
                        },
                        success: function(data) {
                            if (data == 1) {
                                var time = serverTime();
                                $(selected).next('a').next('i').removeClass('fa-check');
                                $(selected).next('a').next('i').addClass('fa-mug-hot');
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').children('.red-indicator').show();
                                $(selected).attr('id', 'employeeBreakOut');
                                clearTimeout(real_time);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> is taking a break.",
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

                        }
                    });
                }
            });
        });

        //Break out
        $(document).on('click', '#employeeBreakOut', function() {
            var id = $(this).attr('data-id');
            var emp_name = $(this).attr('data-name');
            var selected = this;
            var entry = 'Manual';
            var approved_by = $(this).attr('data-approved');
            Swal.fire({
                title: 'Back to work?',
                html: "Are you sure you want to get back to work this person?<br> <strong>" + emp_name + "</strong>",
                imageUrl: "/assets/img/timesheet/default-profile.png",
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, back to work!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/timesheet/breakOut',
                        method: "POST",
                        dataType: "json",
                        data: {
                            id: id,
                            approved_by: approved_by,
                            entry: entry
                        },
                        success: function(data) {
                            if (data == 1) {
                                var time = serverTime();
                                $(selected).next('a').next('i').removeClass('fa-mug-hot');
                                $(selected).next('a').next('i').addClass('fa-check');
                                $(selected).parent('td').prev('td').children('.break-out-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').children('.red-indicator').show();
                                $(selected).attr('id', null);
                                $(selected).attr('disabled', 'disabled');
                                clearTimeout(real_time);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: 'Success',
                                    html: '<strong>' + emp_name + "</strong> is now back to work.",
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

                        }
                    });
                }
            });
        });
    });
</script>