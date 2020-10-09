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
							<li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img width="100" height="25" style="height: 25px !important;width: 100px !important;" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""  > </a></li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

                            </li>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-commenting-o" aria-hidden="true"></i></a>

                            </li>


							<li class="dropdown notification-list list-inline-item ml-auto">
                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa fa-line-chart" aria-hidden="true"></i></a>
                            </li>
							<li class="dropdown notification-list list-inline-item ml-auto">
                                <a class="nav-link dropdown-toggle arrow-none" href="<?php echo base_url('settings/email_templates') ?>">
                                    <i class="fa fa-cog" aria-hidden="true"></i>
                                </a>
                            </li>
							<li class="dropdown notification-list list-inline-item ml-auto">
<!--                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="javascript:void (0)" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i>-->
<!--                                    <span class="badge badge-pill badge-danger noti-icon-badge" style="visibility: --><?php //echo (getNotificationCount() != 0)?'visible':'hidden'; ?><!--" id="notifyBadge">--><?php //echo (getNotificationCount() != 0)?getNotificationCount():null; ?><!--</span>-->
<!--                                </a>-->
                                <div class="wrapper-bell nav-link dropdown-toggle arrow-none" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="badge badge-pill badge-danger noti-icon-badge notify-badge" style="visibility: <?php echo (getNotificationCount() != 0)?'visible':'hidden';?>;z-index: 20" id="notifyBadge"><?php echo (getNotificationCount() != 0)?getNotificationCount():null; ?></span>
                                    <div class="icon-loader">
                                        <i class="fa fa-spinner fa-spin" style="font-size:25px"></i>
                                    </div>
                                    <div class="bell" id="bell-1">
                                        <div class="anchor-bell material-icons layer-1" style="animation:<?php echo (getNotificationCount() != 0)?'animation-layer-1 5000ms infinite':'unset'?>">notifications_active</div>
                                        <div class="anchor-bell material-icons layer-2" style="animation:<?php echo (getNotificationCount() != 0)?'animation-layer-2 5000ms infinite':'unset'?>">notifications</div>
                                        <div class="anchor-bell material-icons layer-3" style="animation:<?php echo (getNotificationCount() != 0)?'animation-layer-3 5000ms infinite':'unset'?>">notifications</div>
                                    </div>
                                </div>
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
                            <?php $newtasks = getNewTasks(); ?>
                            <li class="dropdown notification-list list-inline-item ml-auto"><a
                                    class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="" role="button" aria-haspopup="false" aria-expanded="false"><i style=""class="fa fa-calendar-check-o" aria-hidden="true"></i><?php if(count($newtasks) > 0){ ?><span class="badge badge-pill badge-danger noti-icon-badge"><?php echo count($newtasks); ?></span>
                                    <?php } ?></a>
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
                            <?php
                                $clock_btn = 'clockIn';
                                $user_id = $this->session->userdata('logged')['id'];
                                $user_clock_in = getClockInSession();
                                foreach ($user_clock_in as $in){
                                    if ($in->user_id == $user_id && $in->status == 1){
                                        $clock_btn = 'clockOut';
                                    }
//                                    if ($in->user_id == $user_id && $in->status == 0){
//                                        $clock_btn = null;
//                                    }
                                    if($in->user_id == $user_id && $in->date_in == date('Y-m-d',strtotime('yesterday')) && $in->date_out == date('Y-m-d')){
                                        $clock_btn = 'clockIn';
                                    }
                                    if ($in->user_id == $user_id && $in->status == 0 && $in->date_in == date('Y-m-d',strtotime('yesterday'))){
                                        $clock_btn = 'clockIn';
                                    }

                                }
                                //Employee display shift status
                            $clock_in = '-';
                            $clock_out = '-';
                            $lunch_in = '-';
                            $lunch_out = '-';
                            $shift_duration = '-';
                            $remaining_time = '60:00';
                            $attendance = getEmployeeAttendance();
                            $ts_logs = getEmployeeLogs();
                            $analog_active = null;
                            $attn_id = null;
                            $expected_endbreak = null;
                            foreach ($attendance as $attn){
                                if ($attn->user_id ==  $this->session->userdata('logged')['id'] && $attn->shift_duration > 0 && $attn->date_out == date('Y-m-d') && $attn->date_in == date('Y-m-d',strtotime('yesterday')) && $attn->status == 0){
                                    $shift_duration = $attn->shift_duration;
                                }else{
                                    $shift_duration = '-';
                                }
                                if ($attn->user_id ==  $this->session->userdata('logged')['id'] && $attn->shift_duration > 0 && $attn->date_out == date('Y-m-d') && $attn->date_in == date('Y-m-d') && $attn->status == 0){
                                    $shift_duration = $attn->shift_duration;
                                }else{
                                    $shift_duration = '-';
                                }
                                if ($attn->user_id == $this->session->userdata('logged')['id']){
                                    $attn_id = $attn->id;
                                    foreach ($ts_logs as $log){
                                        if ($log->attendance_id == $attn->id && $log->action == 'Check in'){
                                            if ($attn->date_in == date('Y-m-d',strtotime('yesterday')) && $attn->status == 1){
                                                $clock_in = date('h:i A',$log->time);
                                                $clock_out = 'Pending...';
                                                $analog_active = 'clock-active';
                                            }
                                            if ($attn->date_in == date('Y-m-d')){
                                                $clock_in = date('h:i A',$log->time);
                                                $clock_out = 'Pending...';
                                                $analog_active = 'clock-active';
                                            }
                                        }
                                        if ($log->attendance_id == $attn->id && $log->action == 'Check out'){
                                            if ($attn->date_in == date('Y-m-d',strtotime('yesterday')) && $attn->status == 1){
                                                $clock_out = date('h:i A',$log->time);
                                                $analog_active = null;
                                            }
                                            if ($attn->date_in == date('Y-m-d') && $attn->status == 0){
                                                $clock_out = date('h:i A',$log->time);
                                                $analog_active = null;
                                            }
                                        }
                                        if ($log->attendance_id == $attn->id && $log->action == 'Break in'){
                                            if($attn->date_in == date('Y-m-d')){
                                                $lunch_in = date('h:i A',$log->time);
                                                $analog_active = 'clock-break';
                                                $expected_endbreak = $attn->expected_endbreak;
                                            }
                                        }
                                        if ($log->attendance_id == $attn->id && $log->action == 'Break out'){
                                            if($attn->date_in == date('Y-m-d')){
                                                $lunch_out = date('h:i A',$log->time);
                                                $analog_active = 'clock-active';
                                                if ($attn->break_remaining_time != null){
                                                    $remaining_time = $attn->break_remaining_time;
                                                }
                                            }
                                        }

                                    }
                                }
                            }
                            $ts_settings = getEmpTSsettings();
                            $schedule = getEmpSched();
                            $expected_shift = 0;
                            foreach ($schedule as $sched){
                                if ($sched->user_id == $this->session->userdata('logged')['id'] && $sched->start_date == date('Y-m-d')){
                                    $expected_shift = strtotime($sched->start_date." ".$sched->start_time);
                                }else{
                                    $expected_shift = 0;
                                }
                            }
                            $sched_notify = 1;
                            foreach ($notification as $u_notify){
                                if ($u_notify->status == 1 && $u_notify->title == 'Your shift will start soon.'){
                                    $sched_notify = 0;
                                }else{
                                    $sched_notify = 0;
                                }
                            }
                            //Removed session
//                            clock-in-time
//                            clock-out-time
//                            remaining_time
//                            active
//                            attn-id
//                            end_break
                            ?>
                            <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle;min-width: 50px">
                                <input type="hidden" id="clock-end-time" value="<?php echo ($expected_endbreak)?$expected_endbreak:null; ?>">
<!--                                <input type="hidden" id="clock-server-time" value="">-->
                                <input type="hidden" id="clock-status" value="<?php echo ($analog_active == 'clock-break')?1:0; ?>">
                                <input type="hidden" id="attendanceId" value="<?php echo $attn_id;?>">
                                <input type="hidden" id="employeeShiftStart" value="<?php echo (!empty($expected_shift))?$expected_shift:0;?>">
                                <input type="hidden" id="employeePingOnce" value="<?php echo $sched_notify;?>">
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
                                        <span class="clock-details-text"><span id="break-duration"><?php echo $remaining_time;?></span>
                                    </div>
                                    <div class="clock-section">
                                        <span class="clock-details-title">Shift Duration:</span>
                                        <span class="clock-details-text" id="shiftDuration"><?php echo $shift_duration; ?></span>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown notification-list list-inline-item">
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
                                        <img src="<?php echo $image; ?>" alt="user" class="rounded-circle">
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
