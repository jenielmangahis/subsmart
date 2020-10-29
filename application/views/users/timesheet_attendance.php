<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<style type="text/css">
    th{
        text-align: center;
    }
    .tile-container{
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: 0 2px 8px 0 rgba(0,0,0,.2);
        -moz-box-shadow: 0 2px 8px 0 rgba(0,0,0,.2);
        box-shadow:0 2px 8px 0 rgba(0,0,0,.2);
        background-color: #fff;
        background-image: none;
        border: 1px solid #d4d7dc;
        -webkit-transition: all .3s ease;
        position:relative;
        top:20px;
        width: 100%;
        height: 100%;
        padding: 0;
        margin-bottom: 10px;
        margin-right: 10px;
    }
    .inner-content{
        padding: 20px;
    }
    .inner-content .card-title{
        display: inline-block;
        width: 80%;
    }
    .inner-content .card-title span{
        font-weight: bold;
        font-size: 15px;
    }
    .inner-content .card-data{
        width: 10%;
        display: inline-block;
        vertical-align: middle;
    }
    .inner-content .card-data span{
        float: right;
        font-weight: bold;
        font-size: 20px;
        color: grey;
    }
    .inner-content .progress{
        margin-top: 10px;
    }
    .inner-content .progress .progress-bar{
        color: black;
    }
    .inner-content .progress .active{
        animation: progress-bar-stripes 2s linear infinite;
    }
    .inner-content .progress .progress-bar-success{
        background-color: #5abf51;
    }
    .inner-content .progress .progress-bar-danger{
        background-color: #ff6523;
    }
    .inner-content .progress .progress-bar-warning{
        background-color: #ffd176;
    }
    .tbl-employee-attendance .tbl-id-number{
        text-align: center;
    }
    .tbl-employee-attendance .tbl-employee-name{
        font-size: 15px;
        font-weight: bold;
    }
    .tbl-employee-attendance .tbl-emp-role{
        display: block;
        font-style: italic;
        color: grey;
    }
    .tbl-employee-attendance .tbl-emp-action,.tbl-chk-in, .tbl-chk-out, .tbl-lunch-in, .tbl-lunch-out{
        text-align: center;
    }
    .tbl-employee-attendance .tbl-emp-action .employee-in-out,.employee-break{
        color: grey;
    }
    .tbl-employee-attendance .tbl-emp-action .employee-in-out:hover{
        text-decoration: underline;
        color: #0b97c4;
    }
    .tbl-employee-attendance .fa-times-circle{
        color: orangered;
        vertical-align: bottom;
    }
    .tbl-employee-attendance .fa-check{
        color: greenyellow;
        vertical-align: bottom;
    }
    .swal2-image{
        height: 120px;
        width: 120px;
        border-radius: 50%;
    }
    .tbl-emp-action .employee-in-out[disabled="disabled"]{
        cursor: not-allowed;
        color: #92969d;
    }
    .tbl-emp-action .employee-in-out[disabled="disabled"]:hover{
        color: #92969d;
    }
    .tbl-emp-action .employee-break[disabled="disabled"]{
        cursor: not-allowed;
        color: #92969d;
    }
    .tbl-emp-action .employee-break[disabled="disabled"]:hover{
        color: #92969d;
    }
    .status{
        margin-left: 10px;
    }
    .fa-mug-hot{
        color: #ffc859;
    }
    .red-indicator{
        display: none;
        width: 10px;
        height: 10px;
        background-color: red;
        border-radius: 50%;
        border: 1px solid red;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5px;
        box-shadow:0 2px 5px 2px rgba(0, 0, 0, 0.51);
    }
    /*Employee css*/
    .user-logs-container{
        height: 100%;
    }
    .user-logs-container .user-card-title{
        border-bottom: 1px solid #cbd0da;
        width: 100%;
        padding-bottom: 8px;
    }
    .user-clock-in-title,.user-clock-out-title,.user-lunch-in-title,.user-lunch-out-title{
        font-weight: bold;
        min-height: 31px;
        color: #92969d;
    }
    .user-clock-in,.user-clock-out,.user-lunch-in,.user-lunch-out,.user-shift-duration{
        min-height: 31px;
        display: block;
        text-align: right;
    }
    .user-clock-in span{
        font-size: 12px;
        display: inline-block;
        float: left;
    }
    .user-logs{
        width: 100%;
    }
    .user-logs-section{
        position: relative;
        width: 49%;
        display: inline-block;
        vertical-align: top;
    }
    .user-logs-title{
        display: inline-block;
        position: relative;
    }
    .user-logs-title .fa-coffee{
        color: #92969d;
    }
    .user-logs-title a[disabled="disabled"]{
        cursor: not-allowed;
    }
    .right{
        float: right;
    }
    /*Employee button lunch*/
    .employeeLunch .btn-lunch-hover{
        display: none;
        position: absolute;
        top: 0;
        z-index: 99;
    }
    .employeeLunch:hover .btn-lunch-hover{
        display: inline-block;
    }
    .employeeLunch:hover .btn-lunch{
        visibility: hidden;
    }
    /*Lunch button tooptip*/
    .employeeLunchBtn .employeeLunchTooltip{
        visibility: hidden;
        font-size: 14px!important;
        font-weight: bold!important;
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
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    }
    .employeeLunchBtn .employeeLunchTooltip::after{
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #0000008a transparent transparent transparent;
    }
    .employeeLunchBtn:hover .employeeLunchTooltip{
        visibility: visible;
    }
</style>
<div class="wrapper" role="wrapper">
    <?php include viewPath('includes/sidebars/employee'); ?>
    <!-- page wrapper start -->
    <div wrapper__section>
        <div class="container-fluid">
            <div class="page-title-box">

                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h1 class="page-title">Attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <!--                        <div class="float-right d-none d-md-block">-->
                        <!--                            <div class="dropdown">-->
                        <!--                                --><?php //if (hasPermissions('users_add')): ?>
                        <!--                                    <a href="--><?php //echo url('users/add_timesheet_entry') ?><!--" class="btn btn-primary"-->
                        <!--                                       aria-expanded="false">-->
                        <!--                                        <i class="mdi mdi-settings mr-2"></i> New Timesheet Entry-->
                        <!--                                    </a>-->
                        <!--                                --><?php //endif ?>
                        <!--                            </div>-->
                        <!--                        </div>-->
                    </div>
                </div>
                <div class="row" style="padding-bottom: 20px;">
                    <div class="col-md-12 banking-tab-container">
                        <a href="<?php echo url('/timesheet/attendance')?>" class="banking-tab<?php echo ($this->uri->segment(1)=="attendance")?:'-active';?>" style="text-decoration: none">Attendance</a>
                        <?php if ($this->session->userdata('logged')['role'] < 5):?>
                            <a href="<?php echo url('/timesheet/employee')?>" class="banking-tab">Employee</a>
                            <a href="<?php echo url('/timesheet/schedule')?>" class="banking-tab">Schedule</a>
                            <a href="<?php echo url('/timesheet/list')?>" class="banking-tab">List</a>
                            <a href="<?php echo url('/timesheet/settings')?>" class="banking-tab">Settings</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <input type="hidden" id="employeeTotal" value="<?php echo  $total_users;?>">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="today-date">
                                <h6><i class="fa fa-calendar-alt"></i> Today: <span style="color: grey"><?php echo date('M d, Y')." ".date_default_timezone_get();?></span></h6>
                            </div>
                            <?php if ($this->session->userdata('logged')['role'] < 5):?>
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
                                                                <span id="employee-in-now"></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressInNow" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow=""
                                                                     aria-valuemin="0" aria-valuemax="100" style="">
                                                                    <!--                                                                --><?php //echo round(($in_now / $total_users) * 100,2).'%';?>
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
                                                                <span id="employee-out-now"></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressOutNow" class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow=""
                                                                     aria-valuemin="0" aria-valuemax="100"">
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
                                                                <span id="employee-not-loggedin"><?php echo $no_logged_in;?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div id="progressNotLoggedIn" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="<?php echo $no_logged_in;?>"
                                                                     aria-valuemin="0" aria-valuemax="100" style="width:<?php echo round(100 - ((($total_users - $no_logged_in) / $total_users) * 100),2).'%';?>;">
                                                                    <?php echo round(100 - ((($total_users - $no_logged_in) / $total_users) * 100),2).'%';?>
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
                                                                <span><?php echo $total_users;?></span>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="100"
                                                                     aria-valuemin="0" aria-valuemax="100" style="width:100%;">
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
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0"
                                                                     aria-valuemin="0" aria-valuemax="100" style="width:0;">
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
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0"
                                                                     aria-valuemin="0" aria-valuemax="100" style="width:0;">
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
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0"
                                                                     aria-valuemin="0" aria-valuemax="100" style="width:0;">
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
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="0"
                                                                     aria-valuemin="0" aria-valuemax="100" style="width:0;">
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
                                            ?>
                                            <?php foreach ($users as $cnt => $user): ?>
                                                <?php
                                                $user_photo = userProfileImage($user->id);
                                                $company_id = $user->company_id;
                                                foreach ($user_roles as $role){
                                                    if ($role->id == $user->role){
                                                        $u_role = $role->title;
                                                    }
                                                }
                                                foreach ($attendance as $attn){
                                                        foreach ($logs as $log){
                                                            if ($user->id == $attn->user_id){
                                                                $attn_id = $attn->id;
                                                                if ($attn->date_in == date('Y-m-d',strtotime('yesterday'))){
                                                                    $yesterday_in = "(Yesterday)";
                                                                }else{
                                                                    $yesterday_in = null;
                                                                }
                                                                if ($attn_id == $log->attendance_id){
                                                                    if ($log->action == 'Check in'){
                                                                        $time_in = date('h:i A',strtotime($log->date_created));
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
                                                                    if ($log->action == 'Break in'){
                                                                        $break_id = 'employeeBreakOut';
                                                                        $status = 'fa-mug-hot';
                                                                        $break_in = date('h:i A',strtotime($log->date_created));
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:block';
                                                                        $indicator_out_break = 'display:none';
                                                                        $tooltip_status = 'On break';
                                                                        $break_out = null;
                                                                    }
                                                                    if ($log->action == 'Break out'){
                                                                        $status = 'fa-check';
                                                                        $break_out = date('h:i A',strtotime($log->date_created));
//                                                                    $break = 'disabled="disabled"';
                                                                        $break_id = 'employeeBreakIn';
                                                                        $indicator_in = 'display:none';
                                                                        $indicator_out = 'display:none';
                                                                        $indicator_in_break = 'display:none';
                                                                        $indicator_out_break = 'display:block';
                                                                        $tooltip_status = 'Back to work';
                                                                    }
                                                                    if($log->action == 'Check out'){
                                                                        $status = 'fa-times-circle';
                                                                        $btn_action = 'employeeCheckIn';
                                                                        $time_out = date('h:i A',strtotime($log->date_created));
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
                                                if ($indicator_in == 'display:block' || $indicator_in_break == 'display:block' || $indicator_out_break == 'display:block'){
                                                    $in_count++;
                                                }
                                                if ($indicator_out == 'display:block'){
                                                    $out_count++;
                                                }
                                                ?>
                                                <tr>
                                                    <td class="tbl-id-number"><?php echo $user->id?></td>
                                                    <td>
                                                        <span class="tbl-employee-name"><?php echo $user->FName;?></span> <span class="tbl-employee-name"><?php echo $user->LName; ?></span>
                                                        <span class="tbl-emp-role"><?php echo $u_role;?></span>
                                                    </td>
                                                    <td class="tbl-chk-in" data-count="<?php echo $in_count?>"><div class="red-indicator" style="<?php echo $indicator_in?>"></div> <span class="clock-in-time"><?php echo $time_in?></span> <span class="clock-in-yesterday" style="display: block;"><?php echo $yesterday_in;?></span></td>
                                                    <td class="tbl-chk-out" data-count="<?php echo $time_out?>"><div class="red-indicator" style="<?php echo $indicator_out?>"></div> <span class="clock-out-time"><?php echo $time_out?></span></td>
                                                    <td class="tbl-lunch-in"><div class="red-indicator" style="<?php echo $indicator_in_break?>"></div> <span class="break-in-time"><?php echo $break_in;?></span></td>
                                                    <td class="tbl-lunch-out"><div class="red-indicator" style="<?php echo $indicator_out_break?>"></div> <span class="break-out-time"><?php echo $break_out;?></span></td>
                                                    <td class="tbl-emp-action">
                                                        <a href="javascript:void(0)" title="Lunch in/out" data-toggle="tooltip" class="employee-break" id="<?php echo $break_id?>" <?php echo $break;?> data-id="<?php echo $user->id?>" data-name="<?php echo $user->FName;?> <?php echo $user->LName; ?>" data-approved="<?php echo $this->session->userdata('logged')['id'];?>" data-photo="<?php echo $user_photo;?>" data-company="<?php echo $company_id?>"><i class="fa fa-coffee fa-lg"></i></a>
                                                        <a href="javascript:void(0)" title="Clock in/out" data-toggle="tooltip" class="employee-in-out" <?php echo $disabled?> id="<?php echo $btn_action;?>" data-attn="<?php echo $attn_id;?>" data-name="<?php echo $user->FName;?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id;?>" data-approved="<?php echo $this->session->userdata('logged')['id'];?>" data-photo="<?php echo $user_photo;?>" data-company="<?php echo $company_id?>"><i class="fa fa-user-clock fa-lg"></i></a>
                                                        <i class="fa <?php echo $status;?> status" title="<?php echo $tooltip_status; ?>" data-toggle="tooltip"></i>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                <?php
                                                $u_role = null;
                                                $status = 'fa-times-circle';
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
                                            <?php endforeach;?>
                                            </tbody>
                                        </table>
                                        <input type="hidden" id="outCounter" value="<?php echo $out_count?>">
                                        <input type="hidden" id="inCounter" value="<?php echo $in_count?>">
                                    </div>
                                </div>
                            <?php endif;?>
                            <!-- end row -->
                            <?php if ($this->session->userdata('logged')['role'] > 5): ?>
                                <?php
                                $lunch_active = null;
                                $employee_logs = getEmployeeLogs();
                                $employee_attn = getClockInSession();
                                $lunch_icon = 'static';
                                $lunch_disabled = 'disabled="disabled"';
                                foreach ($employee_attn as $attn){
                                    if ($attn->user_id == $this->session->userdata('logged')['id'] && $attn->status == 1){
                                        foreach ($employee_logs as $log){
                                            if ($attn->id == $log->attendance_id){
                                                $lunch_disabled = null;
                                            }
                                            if ($attn->id == $log->attendance_id && $log->action == 'Break in'){
                                                $lunch_active = 'lunchOut';
                                                $lunch_icon = 'active';
                                            }else{
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
                                                        <div class="inner-content" style="padding-top: 0">
                                                            <div class="card-title user-card-title">
                                                                <div class="row">
                                                                    <div class="col-md-7" style="display: flex;">
                                                                        <span class="user-logs-title" style=" align-self: flex-end;">Today's logs</span>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <span class="user-logs-title right employeeLunchBtn" style="">
                                                                            <a href="javascript:void(0)" class="employeeLunch" id="<?php echo $lunch_active; ?>" <?php echo $lunch_disabled;?>>
                                                                                <img src="/assets/css/timesheet/images/coffee-<?php echo $lunch_icon;?>.svg" alt="" class="btn-lunch">
                                                                                <img src="/assets/css/timesheet/images/coffee-hover.svg" alt="" class="btn-lunch-hover">
                                                                            </a>
                                                                            <span class="employeeLunchTooltip">Lunch in/out</span>
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <?php
                                                            $clock_in = '-';
                                                            $clock_out = '-';
                                                            $lunch_in = '-';
                                                            $lunch_out = '-';
                                                            $shift = '-';
                                                            $yesterday_note = null;
                                                            foreach ($emp_attendance as $attn){
                                                                foreach ($emp_logs as $log){
                                                                    if ($log->attendance_id == $attn->id){
                                                                        if ($attn->status == 1){
                                                                            if ($log->action == 'Check in'){
                                                                                if ($attn->date_in == date('Y-m-d',strtotime('yesterday'))){
                                                                                    $clock_in = date('h:i A',strtotime($log->date_created));
                                                                                    $yesterday_note = '(Yesterday)';
                                                                                    $shift = '-';
                                                                                }elseif ($attn->date_in == date('Y-m-d')){
                                                                                    $clock_in = date('h:i A',strtotime($log->date_created));
                                                                                    $yesterday_note = null;
                                                                                }
                                                                            }elseif ($log->action == 'Break in'){
                                                                                $lunch_in = date('h:i A',strtotime($log->date_created));
                                                                                $lunch_out = null;
                                                                            }elseif ($log->action == 'Break out'){
                                                                                $lunch_out = date('h:i A',strtotime($log->date_created));
                                                                            }
                                                                        }else{
                                                                            if ($log->action == 'Check in'){
                                                                                $clock_in = date('h:i A',strtotime($log->date_created));
                                                                                if ($attn->date_out > $attn->date_in){
                                                                                    $yesterday_note = '(Yesterday)';
                                                                                }elseif ($attn->date_in == date('Y-m-d')){
                                                                                    $yesterday_note = null;
                                                                                }
                                                                            }elseif ($log->action == 'Check out'){
                                                                                $clock_out = date('h:i A',strtotime($log->date_created));
                                                                                $seconds = ($attn->shift_duration * 3600);
                                                                                $hours = floor($attn->shift_duration);
                                                                                $seconds -= $hours * 3600;
                                                                                $minutes = floor($seconds / 60);
                                                                                $seconds -= $minutes * 60;
                                                                                $shift =  str_pad($hours, 2, '0', STR_PAD_LEFT).":".str_pad($minutes, 2, '0', STR_PAD_LEFT);
                                                                            }elseif ($log->action == 'Break in'){
                                                                                $lunch_in = date('h:i A',strtotime($log->date_created));
                                                                            }elseif ($log->action == 'Break out'){
                                                                                $lunch_out = date('h:i A',strtotime($log->date_created));
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
                                                            foreach ($schedules as $scheds){
                                                                if($scheds->user_id == $this->session->userdata('logged')['id']){
                                                                    $unix_ts = time();
                                                                    $set_date = new DateTime("now", new DateTimeZone($timezone));
                                                                    $set_date->setTimestamp($unix_ts);
                                                                    foreach ($tasks as $task){
                                                                        if ($task->ts_settings_id == $scheds->id && $task->start_date == $set_date->format('Y-m-d')){
                                                                            $timezone = $scheds->timezone;
                                                                            $task_name = $scheds->project_name;
                                                                            $start_time = date('h:i A',strtotime($task->start_time));
                                                                            $end_time = date('h:i A',strtotime($task->end_time));
                                                                            $task_duration = $task->duration."hour/s";
                                                                        }
                                                                    }
                                                                }
                                                            }

                                                            ?>
                                                            <div class="user-logs">
                                                                <div class="user-logs-section">
                                                                    <div class="user-clock-in-title">Clock-in: </div>
                                                                    <div class="user-clock-out-title">Clock-out: </div>
                                                                    <div class="user-lunch-in-title">Lunch-in: </div>
                                                                    <div class="user-lunch-out-title">Lunch-out: </div>
                                                                    <div class="user-lunch-out-title">Shift Duration: </div>
                                                                </div>
                                                                <div class="user-logs-section">
                                                                    <div class="user-clock-in" id="userClockIn"><?php echo $clock_in;?> <span style="color: grey"><?php echo $yesterday_note?></span></div>
                                                                    <div class="user-clock-out" id="userClockOut"><?php echo $clock_out?></div>
                                                                    <div class="user-lunch-in" id="userLunchIn"><?php echo $lunch_in?></div>
                                                                    <div class="user-lunch-out" id="userLunchOut"><?php echo $lunch_out?></div>
                                                                    <div class="user-shift-duration" id="userShiftDuration"><?php echo $shift?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title user-card-title">
                                                                <span>Today's Task</span>
                                                            </div>
                                                            <div class="user-logs">
                                                                <div class="user-logs-section">
                                                                    <div class="user-clock-in-title">Timezone: </div>
                                                                    <div class="user-clock-in-title">Task: </div>
                                                                    <div class="user-clock-out-title">Start time: </div>
                                                                    <div class="user-lunch-in-title">End time: </div>
                                                                    <div class="user-lunch-out-title">Estimated time duration: </div>
                                                                </div>
                                                                <div class="user-logs-section" style="vertical-align: top">
                                                                    <div class="user-clock-in"><?php echo $timezone;?></div>
                                                                    <div class="user-clock-in"><i class="fa fa-info-circle"></i> <?php echo $task_name?></div>
                                                                    <div class="user-clock-out"><?php echo $start_time;?></div>
                                                                    <div class="user-lunch-in"><?php echo $end_time?></div>
                                                                    <div class="user-lunch-out"><?php echo $task_duration?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="tile-container user-logs-container">
                                            <div class="inner-container">
                                                <div class="tileContent">
                                                    <div class="clear">
                                                        <div class="inner-content">
                                                            <div class="card-title user-card-title">
                                                                <span>Yesterday worked comment</span>
                                                            </div>
                                                            <div class="user-logs">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
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
    let real_time;
    function serverTime () {
        let datetime = null;
        $.ajax({
            url:"/timesheet/realTime",
            dataType:"json",
            async: false,
            success:function (data) {
                datetime = data;
            }
        });
        real_time = setTimeout(serverTime, 1000);
        return datetime;
    }
    $(document).ready(function () {
        // In/Out Counter
        let out_log = $('#outCounter').val();
        let in_log = $('#inCounter').val();
        let total_user = $('#employeeTotal').val();
        let in_log_cal = (in_log / total_user);
        let in_ans = in_log_cal.toFixed(2) * 100
        let out_log_cal = (out_log / total_user);
        let out_ans =  out_log_cal.toFixed(2) * 100
        $('#employee-in-now').text(in_log);
        $('#progressInNow').attr('aria-valuenow',in_log).css('width',in_ans+"%").text(in_ans+"%");
        $('#employee-out-now').text(out_log);
        $('#progressOutNow').attr('aria-valuenow',out_log).css('width',out_ans+"%").text(out_ans+"%");


        let total_employee = $('#employeeTotal').val();
        function inNow() {
            $.ajax({
                url:"/timesheet/inNow",
                dataType:"json",
                success:function (data) {
                    $('#employee-in-now').text(data);
                    var percentage = (data / total_employee) * 100;
                    $('#progressInNow').attr('aria-valuenow',percentage.toFixed(2));
                    $('#progressInNow').css('width',percentage.toFixed(2)+'%');
                    $('#progressInNow').text(percentage.toFixed(2)+'%');
                }
            });
        }

        function outNow() {
            $.ajax({
                url:"/timesheet/outNow",
                dataType:"json",
                success:function (data) {
                    $('#employee-out-now').text(data);
                    var percentage = (data / total_employee) * 100;
                    $('#progressOutNow').attr('aria-valuenow',percentage.toFixed(2));
                    $('#progressOutNow').css('width',percentage.toFixed(2)+'%');
                    $('#progressOutNow').text(percentage.toFixed(2)+'%');
                }
            });
        }
        function notLoggedIn() {
            $.ajax({
                url:"/timesheet/loggedInToday",
                dataType:"json",
                success:function (data) {
                    $('#employee-not-loggedin').text(data);
                    var percentage = (100 - (((total_employee - data) / total_employee) * 100));
                    $('#progressNotLoggedIn').attr('aria-valuenow',percentage.toFixed(2));
                    $('#progressNotLoggedIn').css('width',percentage.toFixed(2)+'%');
                    $('#progressNotLoggedIn').text(percentage.toFixed(2)+'%');
                }
            });
        }

        // Checking IN
        $(document).on('click','#employeeCheckIn',function () {
            var id = $(this).attr('data-id');
            var emp_name = $(this).attr('data-name');
            var selected = this;
            var entry = 'Manual';
            var approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Clock in?',
                html: "Are you sure you want to Clock-in this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clock-in!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/timesheet/checkingInEmployee',
                        method:"POST",
                        dataType:"json",
                        data:{id:id,entry:entry,approved_by:approved_by,company_id:company_id},
                        success:function (data) {
                            if (data != 0){
                                inNow();
                                notLoggedIn();
                                var time = serverTime ();
                                $(selected).attr('data-attn',data);
                                $(selected).next('i').removeClass('fa-times-circle');
                                $(selected).next('i').addClass('fa-check');
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.clock-in-yesterday').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.red-indicator').show();
                                $(selected).attr('id','employeeCheckOut');
                                $(selected).prev('a').attr('disabled',null);
                                $(selected).prev('a').attr('id','employeeBreakIn');
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').text(null);
                                $(selected).parent('td').prev('td').children('.break-out-time').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').text(null);
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.red-indicator').hide();
                                clearTimeout(real_time);
                                Swal.fire(
                                    {
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Success',
                                        html: '<strong>'+emp_name+"</strong> has been Clock-in",
                                        icon: 'success'
                                    });
                            }else if(data == false){
                                Swal.fire(
                                    {
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
        $(document).on('click','#employeeCheckOut',function () {
            var id = $(this).attr('data-id');
            var emp_name = $(this).attr('data-name');
            var selected = this;
            // var week_id = $(this).attr('data-week');
            var attn_id = $(this).attr('data-attn');
            var entry = 'Manual';
            var approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Clock out?',
                html: "Are you sure you want to Clock-out this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clock-out!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/timesheet/checkingOutEmployee',
                        method:"POST",
                        dataType:"json",
                        data:{id:id,attn_id:attn_id,entry:entry,approved_by:approved_by,company_id:company_id},
                        success:function (data) {
                            if (data == 1){
                                inNow();
                                outNow();
                                var time = serverTime ();
                                $(selected).next('i').removeClass('fa-check');
                                $(selected).next('i').addClass('fa-times-circle');
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.clock-out-time').text(time);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').prev('td').children('.red-indicator').show();
                                $(selected).parent('td').prev('td').children('.red-indicator').hide();
                                // var second_in = $(selected).parent('td').prev('td').prev('td').prev('td').children('#clockIn2nd').val();
                                clearTimeout(real_time);
                                // if (second_in == 0){
                                //     $(selected).attr('id',null);
                                //     $(selected).attr('disabled','disabled');
                                //     $(selected).prev('a').attr('disabled','disabled');
                                //     $(selected).prev('a').attr('id',null);
                                // }else{
                                //     $(selected).attr('id','employeeCheckIn');
                                //     $(selected).parent('td').prev('td').prev('td').prev('td').children('#clockIn2nd').val(0);
                                // }
                                Swal.fire(
                                    {
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Success',
                                        html: '<strong>'+emp_name+"</strong> has been Clock-out",
                                        icon: 'success'
                                    });
                            }else{
                                Swal.fire(
                                    {
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
        $(document).on('click','#employeeBreakIn',function () {
            let id = $(this).attr('data-id');
            let emp_name = $(this).attr('data-name');
            let selected = this;
            let entry = 'Manual';
            let approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Take a break?',
                html: "Are you sure you want to take a lunch this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, take a lunch!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/timesheet/breakIn',
                        method:"POST",
                        dataType:"json",
                        data:{id:id,approved_by:approved_by,entry:entry,company_id:company_id},
                        success:function (data) {
                            if (data != 0){
                                // let time = serverTime();
                                $(selected).next('a').next('i').removeClass('fa-check');
                                $(selected).next('a').next('i').addClass('fa-mug-hot');
                                $(selected).parent('td').prev('td').prev('td').children('.break-in-time').text(data);
                                $(selected).parent('td').prev('td').prev('td').prev('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').prev('td').children('.red-indicator').show();
                                $(selected).parent('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').children('.break-out-time').hide();
                                $(selected).attr('id','employeeBreakOut');
                                // clearTimeout(real_time);
                                Swal.fire(
                                    {
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Success',
                                        html: '<strong>'+emp_name+"</strong> is taking a break.",
                                        icon: 'success'
                                    });
                            }else{
                                Swal.fire(
                                    {
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
        $(document).on('click','#employeeBreakOut',function () {
            let id = $(this).attr('data-id');
            let emp_name = $(this).attr('data-name');
            let selected = this;
            let entry = 'Manual';
            let approved_by = $(this).attr('data-approved');
            let photo = $(this).attr('data-photo');
            let company_id = $(this).attr('data-company');
            Swal.fire({
                title: 'Back to work?',
                html: "Are you sure you want to get back to work this person?<br> <strong>"+emp_name+"</strong>",
                imageUrl:photo,
                showCancelButton: true,
                confirmButtonColor: '#2ca01c',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, back to work!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url:'/timesheet/breakOut',
                        method:"POST",
                        dataType:"json",
                        data:{id:id,approved_by:approved_by,entry:entry,company_id:company_id},
                        success:function (data) {
                            if (data != 0){
                                // let time = serverTime();
                                $(selected).next('a').next('i').removeClass('fa-mug-hot');
                                $(selected).next('a').next('i').addClass('fa-check');
                                $(selected).parent('td').prev('td').children('.break-out-time').text(data);
                                $(selected).parent('td').prev('td').prev('td').children('.red-indicator').hide();
                                $(selected).parent('td').prev('td').children('.red-indicator').show();
                                $(selected).parent('td').prev('td').children('.break-out-time').show();
                                $(selected).attr('id','employeeBreakIn');
                                // $(selected).attr('disabled','disabled');
                                // clearTimeout(real_time);
                                Swal.fire(
                                    {
                                        showConfirmButton: false,
                                        timer: 2000,
                                        title: 'Success',
                                        html: '<strong>'+emp_name+"</strong> is now back to work.",
                                        icon: 'success'
                                    });
                            }else{
                                Swal.fire(
                                    {
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