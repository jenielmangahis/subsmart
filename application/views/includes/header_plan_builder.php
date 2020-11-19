<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?php echo $url->assets?>plugins/font-awesome/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->

    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>css/jquery.signaturepad.css" >
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet"> -->

    <!-- taxes page -->
    <link href="<?php echo $url->assets ?>dashboard/css/responsive.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/slick.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>dashboard/css/slick-theme.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- taxes page -->
    <!--    Clock CSS-->
    <link href="<?php echo $url->assets ?>css/timesheet/clock.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $url->assets ?>css/notification/notification.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Material+Icons" type="text/css">
    <!--    ICONS CSS-->
    <link href="<?php echo $url->assets ?>css/icons/icon.navbar.css" rel="stylesheet" type="text/css">
    <!-- dynamic assets goes  -->
    <?php echo put_header_assets(); ?>
    <style type="text/css">
        #signature{
            width: 100%;
            height: 200px;
            border: 1px solid black;
        }
        #topnav {
            font-family: "Ubuntu","Trebuchet MS",sans-serif !important;
        }
    </style>
</head>

<body>
<!-- Navigation Bar-->
<header id="topnav">
    <input type="hidden" id="siteurl" value="<?php echo url();?>"> <!-- for js programing -->
    <div class="topbar-main">
        <div class="container-fluid">
            <div class="row">
                <!-- Logo container-->
                <div class="logo col-auto d-none d-lg-inline-flex"><a href="<?php echo url('dashboard');?>" class="logo">
                        <img width="200" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a>
                </div><!-- End Logo container-->
                <!-- MENU Start -->

                <?php include viewPath('includes/nav'); ?>
                <div class="menu-extras topbar-custom col-auto justify-content-end">
                    <ul class="navbar-right list-inline float-right mb-0">
                        <li class="menu-item list-inline-item">
                            <a class="navbar-toggle nav-link">
                                <div class="lines"><span></span> <span></span> <span></span></div>
                            </a>
                        </li>
                        <li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img class="icon-logo-nav" width="100" height="25" style="height: 25px !important;width: 100px !important;" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a></li>
                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                            <!--                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>-->
                            <div class="plus-icon-container">
                                <a href="javascript:void (0)">
                                    <img class="plus-icon-static" src="/assets/css/icons/images/add-1.1s-47px.svg" alt="">
                                    <img class="plus-icon-hover" src="/assets/css/icons/images/add-1.1s-47px%20(2).svg" alt="">
                                </a>
                            </div>
                        </li>
                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                            <div class="conversation-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                <a href="javascript:void (0)">
                                    <img class="conversation-icon-static" src="/assets/css/icons/images/conversation-1.1s-47px.svg" alt="">
                                    <img class="conversation-icon-hover" src="/assets/css/icons/images/conversation-1.1s-47px%20(2).svg" alt="">
                                </a>
                                <!--                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">-->
                                <!--                                    -->
                                <!--                                </a>-->
                            </div>
                        </li>


                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                            <div class="growth-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                <a href="javascript:void (0)">
                                    <img class="growth-icon-static" src="/assets/css/icons/images/growth-1.1s-47px (1).svg" alt="">
                                    <img class="growth-icon-hover" src="/assets/css/icons/images/growth-1.1s-47px (2).svg" alt="">
                                </a>
                                <!--                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">-->
                                <!--                                    -->
                                <!--                                </a>-->
                            </div>
                        </li>
                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                            <!--                            <a class="nav-link dropdown-toggle arrow-none" href="--><?php //echo base_url('settings/email_templates') ?><!--">-->
                            <div class="settings-icon-container">
                                <a href="<?php echo base_url('settings/email_templates') ?>">
                                    <img class="settings-icon-static" src="/assets/css/icons/images/wrench-1.1s-47px.svg" alt="">
                                    <img class="settings-icon-hover" src="/assets/css/icons/images/wrench-1.1s-47px%20(1).svg" alt="">
                                </a>
                            </div>
                            <div class="prev-icon-title">Settings</div>
                            <!--                                <img src="/assets/css/icons/images/479-4794569_settings-cog-gear-optimization-icon-hd-png-download.png" aria-hidden="true" class="icon-settings-navbar" alt="">-->
                            <!--                            </a>-->
                        </li>
                        <?php $newtasks = getNewTasks();?>
                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle;">
                            <div class="schedule-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="badge badge-pill badge-danger noti-icon-badge notify-badge" style="visibility: <?php echo (count($newtasks) > 0)?'visible':'hidden'; ?>;z-index: 20;top: 1px;right: 0;" id="scheduleBadge"><?php echo (count($newtasks) != 0)?count($newtasks):null; ?></span>
                                <img class="schedule-icon-static" src="/assets/css/icons/images/schedule-icon.svg" alt="">
                                <img class="schedule-icon-hover" src="/assets/css/icons/images/schedule-icon2.svg" alt="">
                            </div>
                            <div class="prev-icon-title">Schedule</div>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text"><?php if(count($newtasks) > 0){ echo 'New Tasks (' . count($newtasks) . ')'; } else { echo 'No New Tasks'; } ?></h6>
                                <div class="slimscroll notification-item-list">
                                    <?php foreach ($newtasks as $key => $value) { ?>
                                        <a href="<?php echo base_url('taskhub/view/' . $value['task_id']); ?>" class="dropdown-item notify-item active"><div class="notify-icon bg-success"></div><p class="notify-details"><?php echo $value['subject']; ?><span class="text-muted">
                                                <?php
                                                $date_created = date_create($value['date_created']);
                                                echo date_format($date_created, "F d, Y h:i:s");
                                                ?>
                                            </span></p>
                                        </a>
                                    <?php } ?>
                                </div><!-- All--> <a href="<?php echo base_url('taskhub') ?>"
                                                     class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                            </div>
                        </li>
                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                            <!--                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="javascript:void (0)" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i>-->
                            <!--                                    <span class="badge badge-pill badge-danger noti-icon-badge" style="visibility: --><?php //echo (getNotificationCount() != 0)?'visible':'hidden'; ?><!--" id="notifyBadge">--><?php //echo (getNotificationCount() != 0)?getNotificationCount():null; ?><!--</span>-->
                            <!--                                </a>-->
                            <div class="wrapper-bell dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="badge badge-pill badge-danger noti-icon-badge notify-badge" style="visibility: <?php echo (getNotificationCount() != 0)?'visible':'hidden'; ?>; z-index: 20;top: -4px;right: 3px" id="notifyBadge"><?php echo (getNotificationCount() != 0)?getNotificationCount():null; ?></span>
                                <div class="bell" id="bell-1">
                                    <div class="anchor-bell material-icons layer-1" style="animation:<?php echo (getNotificationCount() != 0)?'animation-layer-1 5000ms infinite':'unset'?>">notifications_active</div>
                                    <div class="anchor-bell material-icons layer-2" style="animation:<?php echo (getNotificationCount() != 0)?'animation-layer-2 5000ms infinite':'unset'?>">notifications</div>
                                    <div class="anchor-bell material-icons layer-3" style="animation:<?php echo (getNotificationCount() != 0)?'animation-layer-3 5000ms infinite':'unset'?>">notifications</div>
                                </div>
                            </div>
                            <div class="prev-icon-title">Notification</div>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text">Notifications (258)</h6>
                                <div class="slimscroll notification-item-list" id="notificationList">
                                    <?php
                                    $notification = getTimesheetNotification();
                                    if ($notification != null):
                                        foreach ($notification as $notify):
                                            if ($notify->status == 1){
                                                $bg = '#e6e3e3';
                                            }else{
                                                $bg = '#f8f9fa';
                                            }
                                            ?>
                                            <a href="<?php echo site_url();?>timesheet/attendance" id="notificationDP" data-id="<?php echo $notify->id?>" class="dropdown-item notify-item active" style="background-color: <?php echo $bg;?>">
                                                <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                                <p class="notify-details"><?php echo $notify->title?><span class="text-muted"><?php echo $notify->content;?></span></p>
                                            </a>
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummytext of the printing and typesetting industry.</span></p>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-message-text-outline"></i></div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                        <p class="notify-details">Your item is shipped<span class="text-muted">It is a long established fact that a reader will</span></p>
                                    </a> <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details">Your order is placed<span class="text-muted">Dummy
                                                    text of the printing and typesetting industry.</span></p>
                                    </a>  <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                        </div>
                                        <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                    </a>
                                </div><!-- All--> <a href="javascript:void(0);"
                                                     class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                            </div>
                        </li>
                        <?php
                        $clock_btn = 'clockIn';
                        $user_id = $this->session->userdata('logged')['id'];
                        $user_clock_in = getClockInSession();
                        foreach ($user_clock_in as $in){
                            if ($in->user_id == $user_id && $in->status == 1){
                                $clock_btn = 'clockOut';
                            }
                            if ($in->user_id == $user_id && $in->status == 0){
                                $clock_btn = 'clockIn';
                            }
                        }
                        //Employee display shift status
                        $clock_in = '-';
                        $clock_out = '-';
                        $shift_duration = '-';
                        $lunch_time = '00:00:00';
                        $lunch_in = 0;
                        $lunch_out = 0;
                        $latest_lunch_in = 0;
                        $attendances = getEmployeeAttendance();
                        $ts_logs_h = getEmployeeLogs();
                        $analog_active = null;
                        $attn_id = null;
                        //                        $expected_endbreak = null;
                        $shift_end = 0;
                        $overtime_status = 1;
                        foreach ($attendances as $attn){
                            $attn_id = $attn->id;
                            $overtime_status =  1;
                            foreach ($ts_logs_h as $log){
                                if ($log->attendance_id == $attn->id && $attn->status == 1){
                                    if ($log->action == 'Check in'){
                                        $clock_in = date('h:i A',strtotime($log->date_created));
                                        $shift_end = strtotime($log->date_created);
                                        $hours = floor($attn->break_duration / 60);
                                        $minutes = floor($attn->break_duration % 60);
                                        $seconds = $attn->break_duration - (int)$attn->break_duration;
                                        $seconds = round($seconds * 60);
                                        $lunch_time = str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
                                        $analog_active = 'clock-active';
                                    }
                                    if ($log->action == 'Break in'){
                                        $analog_active = 'clock-break';
                                        if ($attn->break_duration > 0){
                                            $lunch_in = strtotime($log->date_created)  - (floor($attn->break_duration * 60));
                                            $latest_lunch_in = strtotime($log->date_created);
                                        }else{
                                            $lunch_in = strtotime($log->date_created);
                                            $latest_lunch_in = 0;
                                        }
                                    }
                                    if ($log->action == 'Break out'){
                                        if ($attn->status == 1){
                                            $analog_active = 'clock-active';
                                        }
                                    }
                                }else if($log->attendance_id == $attn->id && $attn->status == 0){
                                    if ($log->action == 'Check in'){
                                        $clock_in = date('h:i A',strtotime($log->date_created));
                                        $shift_end = strtotime($log->date_created);

                                        $hours = floor($attn->break_duration / 60);
                                        $minutes = floor($attn->break_duration % 60);
                                        $seconds = $attn->break_duration - (int)$attn->break_duration;
                                        $seconds = round($seconds * 60);
                                        $lunch_time = str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
                                    }
                                    if ($log->action == 'Check out'){
                                        $clock_out = date('h:i A',strtotime($log->date_created));
                                        $analog_active = null;
                                        $shift_s = ($attn->shift_duration * 3600);
                                        $shift_h = floor($attn->shift_duration);
                                        $shift_s -= $shift_h * 3600;
                                        $shift_m = floor($shift_s / 60);
                                        $shift_s -= $minutes * 60;
                                        $shift_duration =  str_pad($shift_h, 2, '0', STR_PAD_LEFT).":".str_pad($shift_m, 2, '0', STR_PAD_LEFT);
                                    }

                                }

                            }


                        }

                        $ts_settings = getEmpTSsettings();
                        $schedule = getEmpSched();
                        $expected_shift = 0;
                        $expected_endshift = 0;
                        $sched_notify = 1;
                        $over_notify = 1;
                        $start = 0;
                        $time_difference = 0;
                        foreach ($ts_settings as $setting){
                            foreach ($schedule as $sched){
                                if ($setting->id == $sched->schedule_id){
                                    if ($setting->timezone == null){
                                        $tz = date_default_timezone_get();
                                    }else{
                                        $tz = /* $setting->timezone */ 'America/Chicago';
                                    }
                                    $timestamp = time();
                                    $dt = new DateTime("now", new DateTimeZone($tz));
                                    $dt->setTimestamp($timestamp);
                                    if ($sched->start_date == $dt->format('Y-m-d')){
                                        $expected_shift = strtotime($sched->start_date." ".$sched->start_time);
                                        $expected_endshift = strtotime($sched->start_date." ".$sched->end_time);
                                        $start = $sched->start_date;
//                                        Time Difference from server time to employee's set timezone
                                        $time_difference = $dt->format('H') - date('H');
                                    }
                                    foreach ($notification as $u_notify){
                                        if ($u_notify->user_id == $sched->user_id){
                                            if ($u_notify->title == 'Your shift will begin soon.' && date('Y-m-d',strtotime($u_notify->date_created)) == $start){
                                                $sched_notify = 0;
                                            }
                                        }
                                        if ($u_notify->title == 'Your shift will end soon.' && date('Y-m-d',strtotime($u_notify->date_created)) == $start){
                                            $over_notify = 0;
                                        }
                                    }
                                }

                            }
                        }
                        if (empty($expected_shift) && $shift_end > 0 && empty($expected_endshift)){
                            $shift_end += (28800); /* Clock-in time plus 8 hours */;
                        }else{
                            $shift_end = null;
                        }
                        if ($analog_active == null){
                            $shift_end = 0;
                            $overtime_status = 2;
                            $expected_endshift = 0;
                        }

                        ?>
                        <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle;min-width: 50px">
                            <!--                            <input type="hidden" id="clock-end-time" value="--><?php //echo ($expected_endbreak)?$expected_endbreak:null; ?><!--">-->
                            <input type="hidden" id="lunchStartTime" value="<?php echo $lunch_in;?>" data-value="<?php echo date('h:i A',$lunch_in)?>">
                            <input type="hidden" id="latestLunchTime" value="<?php echo $latest_lunch_in;?>" data-value="<?php echo date('h:i A',$latest_lunch_in)?>">
                            <input type="hidden" id="clock-status" value="<?php echo ($analog_active == 'clock-break')?1:0; ?>">
                            <input type="hidden" id="attendanceId" value="<?php echo $attn_id;?>">
                            <input type="hidden" id="employeeShiftStart" value="<?php echo (!empty($expected_shift))?$expected_shift:0;?>">
                            <input type="hidden" id="employeePingStart" value="<?php echo $sched_notify;?>">
                            <input type="hidden" id="employeePingEnd" value="<?php echo $over_notify;?>">
                            <input type="hidden" id="employeeOvertime" value="<?php echo $expected_endshift;?>">
                            <input type="hidden" id="timeDifference" value="<?php echo $time_difference;?>">
                            <input type="hidden" id="unScheduledShift" value="<?php echo $shift_end;?>" data-value="<?php echo date('h:i A',$shift_end)?>">
                            <input type="hidden" id="autoClockOut" value="<?php echo $overtime_status;?>">
                            <div class="clock-users " id="<?php echo $clock_btn?>" >
                                <div class="clock <?php echo $analog_active ?>">
                                    <div class="hour">
                                        <div class="hr" id="hr"></div>
                                    </div>
                                    <div class="minute">
                                        <div class="min" id="min"></div>
                                    </div>
                                    <div class="second">
                                        <div class="sec" id="sec"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="preview-clock-details">
                                <div class="clock-section">
                                    <span class="clock-details-title">Clock In:</span>
                                    <span class="clock-details-text in"><?php echo  $clock_in;?></span>
                                </div>
                                <div class="clock-section">
                                    <span class="clock-details-title">Clock Out:</span>
                                    <span class="clock-details-text out"><?php echo $clock_out ?></span>
                                </div>
                                <div class="clock-section">
                                    <span class="clock-details-title">Lunch:</span>
                                    <span class="clock-details-text"><span id="break-duration"><?php echo $lunch_time;?></span>
                                </div>
                                <div class="clock-section">
                                    <span class="clock-details-title">Shift Duration:</span>
                                    <span class="clock-details-text" id="shiftDuration"><?php echo $shift_duration; ?></span>
                                    <span style="display: block;float: right;width: 50%;color: grey; font-size: 10px">(HH:MM)</span>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown notification-list list-inline-item" style="vertical-align: middle">
                            <div class="dropdown notification-list nav-pro-img">
                                <a class="dropdown-toggle nav-link arrow-none nav-user" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <?php /*<img src="<?php //echo (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets ?>" alt="user" class="rounded-circle">*/ ?>
                                    <?php
                                    /*$image = (userProfile(logged('id'))) ? userProfile(logged('id')) : $url->assets;
                                    if( !@getimagesize($image) ){
                                        $image = base_url('uploads/users/default.png');
                                    }*/
                                    $image = base_url('uploads/users/default.png');
                                    ?>
                                    <img src="<?php echo $image; ?>" alt="user" class="rounded-circle nav-user-img">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                    <a class="dropdown-item" href="<?php echo url('dashboard')?>"><i class="mdi mdi-account-circle m-r-5"></i>Dashboard</a>
                                    <a class="dropdown-item" href="<?php echo url('profile')?>"><i class="mdi mdi-account-circle m-r-5"></i>Public Profile</a>
                                    <a class="dropdown-item" href="<?php echo url()?>"><i class="mdi mdi-account-circle m-r-5"></i>nSmart Home</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>Join our community</a>
                                    <?php //if (hasPermissions('activity_log_list')): ?>
                                    <a href="<?php echo url('activity_logs') ?>">
                                        <i class="mdi mdi-account-circle m-r-5"></i><span>Activity Logs</span>
                                    </a>
                                    <?php //endif ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="<?php echo url('/logout') ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div><!-- end menu-extras -->
                <div class="clearfix"></div>
            </div><!-- end container -->
        </div><!-- end container -->
    </div><!-- end topbar-main -->

</header><!-- End Navigation Bar-->
