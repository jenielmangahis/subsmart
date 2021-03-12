<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/font-awesome/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="<?php echo $url->assets ?>fa-5/css/all.min.css"> -->
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/morris.js/morris.css">
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
    <!-- DataTables -->
    <!--<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />-->
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>css/jquery.signaturepad.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500;700&display=swap" rel="stylesheet">
    <!--<script src="//cdn.tiny.cloud/1/s4us18xf53yysd7r07a6wxqkmlmkl3byiw6c9wl6z42n0egg/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
    <!-- <link href="<?php echo $url->assets ?>libs/jcanvas/global.css" rel="stylesheet"> -->

    <!--<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>-->
    <link href="<?php echo $url->assets ?>css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

    <script src="<?php echo $url->assets ?>push_notification/push.js"></script>
    <script src="<?php echo $url->assets ?>push_notification/serviceWorker.min.js"></script>


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


    <script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <!-- dynamic assets goes  -->
    <?php echo put_header_assets(); ?>
    <style type="text/css">
        #signature {
            width: 100%;
            height: 200px;
            border: 1px solid black;
        }

        div#notificationList {
            height: auto !important;
        }

        button.swal2-close {
            display: block !important;
        }

        #topnav {
            font-family: "Ubuntu", "Trebuchet MS", sans-serif !important;
        }

        #division {
            padding: 20px !important;
            margin-right: 2%;
            border: solid black 2px;
        }

        .progress-bar-success {
            background-color: #5cb85c;
        }

        .clock {
            background: url("<?= base_url() ?>/assets/img/timesheet/clock-face-digital-clock-alarm-clocks-clock-png-clip-art.png");
            background-size: cover;
        }

        .progress-bar-info {
            background-color: rgb(0, 166, 164);
        }

        .modaldivision {
            padding: 10px;
            border: solid gray 2px;
            border-radius: 15px;
        }

        .card-pricing.popular {
            z-index: 1;
            border: 3px solid #007bff;
        }

        .card-pricing .list-unstyled li {
            padding: .5rem 0;
            color: #6c757d;
        }

        .file-upload {
            background-color: #ffffff;
            width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .file-upload-btn {
            /* width: 100%; */
            margin: 0;
            color: #000;
            background: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #15824B;
            transition: all .2s ease;
            outline: none;
            /* text-transform: uppercase; */
            font-weight: 10;
            text-align: left;

        }

        .file-upload-btn:hover {
            background: #1AA059;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .file-upload-btn:active {
            border: 0;
            transition: all .2s ease;
        }

        .file-upload-content {
            display: none;
            text-align: center;
        }

        .file-upload-input {
            position: absolute;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            outline: none;
            opacity: 0;
            cursor: pointer;
        }

        .image-upload-wrap {
            margin-top: 20px;
            border: 4px dashed #EAF3EE;
            position: relative;
            padding: 20px;
        }

        .image-dropping,
        .image-upload-wrap:hover {
            background-color: #EAF3EE;
            border: 4px dashed #ffffff;
        }

        .image-title-wrap {
            padding: 0 15px 15px 15px;
            color: #222;
        }

        .drag-text {
            text-align: center;
        }

        .drag-text h3 {
            font-weight: 100;
            text-transform: uppercase;
            color: #15824B;
            padding: 60px 0;
        }

        .file-upload-image {
            max-height: 200px;
            max-width: 200px;
            margin: auto;
            padding: 20px;
        }

        .remove-image {
            width: 200px;
            margin: 0;
            color: #fff;
            background: #cd4535;
            border: none;
            padding: 10px;
            border-radius: 4px;
            border-bottom: 4px solid #b02818;
            transition: all .2s ease;
            outline: none;
            text-transform: uppercase;
            font-weight: 700;
        }

        .remove-image:hover {
            background: #c13b2a;
            color: #ffffff;
            transition: all .2s ease;
            cursor: pointer;
        }

        .remove-image:active {
            border: 0;
            transition: all .2s ease;
        }

        .stepwizard-step p {
            margin-top: 10px;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .stepwizard-step button[disabled] {
            opacity: 1 !important;
            filter: alpha(opacity=100) !important;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: #ccc;
            z-order: 0;

        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 15px;
        }

        label {
            display: inline-block
        }

        label>input {
            /* HIDE RADIO */
            visibility: hidden;
            /* Makes input not-clickable */
            position: absolute;
            /* Remove input from document flow */
        }

        label>input+img {
            /* IMAGE STYLES */
            cursor: pointer;
            border: 2px solid transparent;
        }

        label>input:checked+img {
            /* (RADIO CHECKED) IMAGE STYLES */
            border: 2px solid #f00;
        }
    </style>
</head>
<script>
    var baseURL = '<?= base_url() ?>';
</script>


<body style="background:white !important;">
    <!-- Navigation Bar-->
    <header id="topnav">
        <input type="hidden" id="siteurl" value="<?php echo url(); ?>"> <!-- for js programing -->
        <div style="background:white; box-shadow: 5px 0px 10px 4px rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12); padding: 7px 0;">
            <div class="container-fluid">
                <div class="row">
                    <!-- Logo container-->
                    <div class="logo col-lg-3"><a style="position:absolute; top:25%; margin-top:-20px; left:5%;" href="<?php echo url('dashboard'); ?>">
                            <img width="200" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""> </a>
                    </div><!-- End Logo container-->
                    <!-- MENU Start -->
                    <div class="col-lg-6">
                        <?php include viewPath('includes/nav'); ?>
                    </div>
                    <div class="menu-extras topbar-custom col-lg-3 justify-content-end">
                        <ul class="navbar-right list-inline float-right mb-0" style="position:absolute; top:25%; margin-top:-10px; right:10px;">
                            <li class="menu-item list-inline-item">
                                <a class="navbar-toggle nav-link">
                                    <div class="lines"><span></span> <span></span> <span></span></div>
                                </a>
                            </li>
                            <li class="menu-item list-inline-item d-inline-flex d-lg-none" style="color:#fff;"><img class="icon-logo-nav" width="100" height="25" style="height: 25px !important;width: 100px !important;" src="<?php echo $url->assets ?>dashboard/images/logo.png" alt=""> </a></li>
                            <!--                                <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                                                                                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                                                    <div class="plus-icon-container">
                                                                        <a href="javascript:void (0)">
                                                                            <img class="plus-icon-static" src="<?php echo $url->assets; ?>/css/icons/images/add-1.1s-47px.svg" alt="">
                                                                            <img class="plus-icon-hover" src="<?php echo $url->assets; ?>/css/icons/images/add-1.1s-47px%20(2).svg" alt="">
                                                                        </a>
                                                                    </div>
                                                                </li>-->
                            <!--                            <li title="SMS" class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                                <div class="conversation-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <a href="#" onclick="$('#createSMS').modal('show')">
                                        <img class="conversation-icon-static" src="<?php echo $url->assets; ?>/css/icons/sms.svg" alt="">
                                        <img class="conversation-icon-hover" src="<?php echo $url->assets; ?>/css/icons/sms.svg" alt="">
                                    </a>
                                                                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                                                        
                                                                    </a>
                                </div>
                            </li>
                            <li title="Call" class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                                <div class="conversation-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <a href="javascript:void (0)">
                                        <img class="conversation-icon-static" src="<?php echo $url->assets; ?>/css/icons/support.svg" alt="">
                                        <img class="conversation-icon-hover" src="<?php echo $url->assets; ?>/css/icons/support.svg" alt="">
                                    </a>
                                                                    <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                                                                        
                                                                    </a>
                                </div>
                            </li>-->


                            <li title="Activity" class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                                <div class="growth-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <a href="javascript:void (0)">
                                        <img class="growth-icon-static" src="<?php echo $url->assets; ?>/css/icons/activity.svg" alt="">
                                        <img class="growth-icon-hover" src="<?php echo $url->assets; ?>/css/icons/activity.svg" alt="">
                                    </a>
                                    <!--                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="index.html#" role="button" aria-haspopup="false" aria-expanded="false">-->
                                    <!--                                    -->
                                    <!--                                </a>-->
                                </div>
                            </li>
                            <li title="Settings" class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                                <!--                            <a class="nav-link dropdown-toggle arrow-none" href="--><?php //echo base_url('settings/email_templates')       
                                                                                                                        ?>
                                <!--">-->
                                <div class="settings-icon-container">
                                    <a href="<?php echo base_url('settings/email_templates') ?>">
                                        <img class="settings-icon-static" src="<?php echo $url->assets; ?>/css/icons/settings.svg" alt="">
                                        <img class="settings-icon-hover" src="<?php echo $url->assets; ?>/css/icons/settings.svg" alt="">
                                    </a>
                                </div>
                                <!--<div class="prev-icon-title">Settings</div>-->
                                <!--                                <img src="/assets/css/icons/images/479-4794569_settings-cog-gear-optimization-icon-hd-png-download.png" aria-hidden="true" class="icon-settings-navbar" alt="">-->
                                <!--                            </a>-->
                            </li>
                            <?php //$newtasks = getNewTasks();
                            ?>
                            <?php $newtasks = getTasks(); ?>
                            <li title="Tasks" class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle;">
                                <div class="schedule-icon-container dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="badge badge-pill badge-danger noti-icon-badge notify-badge" style="visibility: <?php echo (count($newtasks) > 0) ? 'visible' : 'hidden'; ?>;z-index: 20;top: 1px;right: 0;" id="scheduleBadge"><?php echo (count($newtasks) != 0) ? count($newtasks) : null; ?></span>

                                    <img class="schedule-icon-static" src="<?php echo $url->assets; ?>/css/icons/tasks.svg" alt="">
                                    <img class="schedule-icon-hover" src="<?php echo $url->assets; ?>/css/icons/tasks.svg" alt="">
                                </div>
                                <!--<div class="prev-icon-title">Schedule</div>-->
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text"><?php
                                                                    if (count($newtasks) > 0) {
                                                                        echo 'New Tasks (' . count($newtasks) . ')';
                                                                    } else {
                                                                        echo 'No New Tasks';
                                                                    }
                                                                    ?></h6>
                                    <div class="slimscroll notification-item-list">
                                        <?php foreach ($newtasks as $value) { ?>
                                            <a href="<?php echo base_url('taskhub/view/' . $value->task_id); ?>" class="dropdown-item notify-item active">
                                                <div class="notify-icon bg-success"></div>
                                                <p class="notify-details"><?php echo $value->subject; ?><span class="text-muted">
                                                        <?php
                                                        $date_created = date_create($value->date_created);
                                                        echo date_format($date_created, "F d, Y h:i:s");
                                                        ?></span></p>
                                            </a>
                                        <?php } ?>
                                    </div><!-- All-->
                                    <a href="<?php echo base_url('taskhub') ?>" class="dropdown-item text-center text-primary">View all <i class="fi-arrow-right"></i></a>
                                </div>
                            </li>

                            <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle">
                                <!--                                <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="javascript:void (0)" role="button" aria-haspopup="false" aria-expanded="false"><i class="fa fa-bell-o" aria-hidden="true"></i>-->
                                <!--                                    <span class="badge badge-pill badge-danger noti-icon-badge" style="visibility: --><?php //echo (getNotificationCount() != 0)?'visible':'hidden';       
                                                                                                                                                            ?>
                                <!--" id="notifyBadge">--><?php //echo (getNotificationCount() != 0)?getNotificationCount():null;       
                                                            ?>
                                <!--</span>-->
                                <!--                                </a>-->
                                <div class="wrapper-bell dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="false" aria-expanded="false">
                                    <span class="badge badge-pill badge-danger noti-icon-badge notify-badge" style="visibility: visible; z-index: 20;width:auto; top: -4px;right: 3px; display:none;" id="notifyBadge"> <?php //echo (getNotificationCount() != 0) ? getNotificationCount() : null;      
                                                                                                                                                                                                                        ?></span>

                                    <div class="bell" onclick='bell_acknowledged()'>
                                        <div class="anchor-bell material-icons layer-1" style="animation:<?php echo (getNotificationCount() != 0) ? 'animation-layer-1 5000ms infinite' : 'unset' ?>">notifications_active</div>
                                        <div class="anchor-bell material-icons layer-2" style="animation:<?php echo (getNotificationCount() != 0) ? 'animation-layer-2 5000ms infinite' : 'unset' ?>">notifications</div>
                                        <div class="anchor-bell material-icons layer-3" style="animation:<?php echo (getNotificationCount() != 0) ? 'animation-layer-3 5000ms infinite' : 'unset' ?>">notifications</div>
                                    </div>
                                </div>
                                <div class="prev-icon-title">Notification</div>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                    <!-- item-->
                                    <h6 class="dropdown-item-text">Notifications (<span id="nfcount">0</span>)</h6>
                                    <div class="slimscroll notification-item-list" id="notificationList">
                                        <div id="autoNotifications">
                                            <a href="#" id="notificationDP" data-id="416&quot;" class="dropdown-item notify-item active" style="background-color:#e6e3e3">
                                                <p class="notify-details" style="margin-left: 50px;"><span class="text-muted">No new notifications.</span></p>
                                            </a>
                                        </div>
                                        <?php
                                        $reorders = getReorderItemsCount();
                                        $reorders_count = 0;
                                        if ($reorders) {
                                            foreach ($reorders as $key => $reorder) {
                                                if (!is_null($reorder['total_count'])) {
                                                    if ($reorder['reorder_point'] > $reorder['total_count']) {
                                                        $reorders_count++;
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                            <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                            <p class="notify-details">Item needs to reorder (<?php echo $reorders_count; ?>)<span class="text-muted">Please replenish immediately.</span></p>
                                        </a> -->


                                        <!-- <a href="javascript:void(0);" class="dropdown-item notify-item active">
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
                                        </a> <a href="javascript:void(0);" class="dropdown-item notify-item">
                                            <div class="notify-icon bg-danger"><i class="mdi mdi-message-text-outline"></i>
                                            </div>
                                            <p class="notify-details">New Message received<span class="text-muted">You have 87 unread messages</span></p>
                                        </a> -->
                                    </div>
                                    <!-- All-->
                                    <a href="<?php echo site_url(); ?>timesheet/notification" class="dropdown-item text-center text-primary">View all
                                        <i class="fi-arrow-right"></i></a>
                                </div>
                            </li>
                            <?php
                            $clock_btn = 'clockIn';
                            $user_id = $this->session->userdata('logged')['id'];
                            $user_clock_in = getClockInSession();
                            $attendance_id = 0;
                            $analog_active = '';
                            foreach ($user_clock_in as $in) {
                                if ($in->user_id == $user_id && $in->status == 1) {
                                    $clock_btn = 'clockOut';
                                    $attendance_id = $in->id;
                                    $analog_active = 'clock-active';
                                }
                                if ($in->user_id == $user_id && $in->status == 0) {
                                    $clock_btn = 'clockIn';
                                    $attendance_id = $in->id;
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
                            foreach ($attendances as $attn) {
                                $attendance_id = $attn->id;
                                break;
                            }
                            $ts_logs_h = getEmployeeLogs($attendance_id);

                            $attn_id = null;
                            $minutes = 0;
                            //                        $expected_endbreak = null;
                            $shift_end = 0;
                            $overtime_status = 1;
                            // $ipInfo = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $_SERVER['HTTP_CLIENT_IP']);
                            // $getTimeZone = json_decode($ipInfo);
                            $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));

                            foreach ($attendances as $attn) {
                                $attn_id = $attn->id;
                                if ($attn->overtime_status == 1) {
                                    $overtime_status = 2;
                                } else {
                                    $overtime_status = 1;
                                }


                                foreach ($ts_logs_h as $log) {
                                    if ($log->attendance_id == $attn->id && $attn->status == 1) {
                                        if ($log->action == 'Check in') {
                                            $date_created = $log->date_created;
                                            date_default_timezone_set('UTC');
                                            $datetime_defaultTimeZone = new DateTime($date_created);
                                            $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                            $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                            $clock_in = date('h:i A', strtotime($userZone_date_created));
                                            $shift_end = strtotime($log->date_created);
                                            $hours = floor($attn->break_duration / 60);
                                            $minutes = floor($attn->break_duration % 60);
                                            $seconds = $attn->break_duration - (int) $attn->break_duration;
                                            $seconds = round($seconds * 60);
                                            $lunch_time = str_pad($hours, 2, "0", STR_PAD_LEFT) . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seconds, 2, "0", STR_PAD_LEFT);
                                            $analog_active = 'clock-active';
                                        }
                                        if ($log->action == 'Break in') {
                                            $analog_active = 'clock-break';

                                            if ($attn->break_duration > 0) {
                                                $lunch_in = strtotime($log->date_created) - (floor($attn->break_duration * 60));
                                                $latest_lunch_in = strtotime($userZone_date_created);
                                            } else {
                                                $lunch_in = strtotime($log->date_created);
                                                $latest_lunch_in = 0;
                                            }
                                        }
                                        if ($log->action == 'Break out') {
                                            if ($attn->status == 1) {
                                                $analog_active = 'clock-active';
                                                $lunch_time = convertDecimal_to_Time($attn->break_duration, "lunch");
                                            }
                                        }
                                    } else if ($log->attendance_id == $attn->id && $attn->status == 0) {

                                        $lunch_time = convertDecimal_to_Time($attn->break_duration, "lunch");
                                        $shift_duration = convertDecimal_to_Time($attn->shift_duration + $attn->overtime, "shift diration");
                                        // var_dump($attendance_id);
                                        if ($log->action == "Check in") {
                                            $date_created = $log->date_created;
                                            date_default_timezone_set('UTC');
                                            $datetime_defaultTimeZone = new DateTime($date_created);
                                            $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                            $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                            $clock_in = date('h:i A', strtotime($userZone_date_created));
                                        } elseif ($log->action == "Check out") {
                                            $date_created = $log->date_created;
                                            date_default_timezone_set('UTC');
                                            $datetime_defaultTimeZone = new DateTime($date_created);
                                            $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                            $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                            $clock_out = date('h:i A', strtotime($userZone_date_created));
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
                            $notification = getNotification($user_id);
                            foreach ($ts_settings as $setting) {
                                foreach ($schedule as $sched) {
                                    if ($setting->id == $sched->schedule_id) {
                                        if ($setting->timezone == null) {
                                            $tz = date_default_timezone_get();
                                        } else {
                                            $tz = $this->session->userdata('usertimezone');
                                        }
                                        $timestamp = time();
                                        $dt = new DateTime("now", new DateTimeZone($tz));
                                        $dt->setTimestamp($timestamp);
                                        if ($sched->start_date == $dt->format('Y-m-d')) {
                                            $expected_shift = strtotime($sched->start_date . " " . $sched->start_time);
                                            $expected_endshift = strtotime($sched->start_date . " " . $sched->end_time);
                                            $start = $sched->start_date;
                                            //                                        Time Difference from server time to employee's set timezone
                                            $time_difference = $dt->format('H') - date('H');
                                        }
                                        foreach ($notification as $u_notify) {
                                            if ($u_notify->user_id == $sched->user_id) {
                                                if ($u_notify->title == 'Your shift will begin soon.' && date('m-d-Y', strtotime($u_notify->date_created)) == $start) {
                                                    $sched_notify = 0;
                                                }
                                            }
                                            if ($u_notify->title == 'Your shift will end soon.' && date('m-d-Y', strtotime($u_notify->date_created)) == $start) {
                                                $over_notify = 0;
                                            }
                                        }
                                    }
                                }
                            }
                            if (empty($expected_shift) && $shift_end > 0 && empty($expected_endshift)) {
                                $shift_end += (28800); /* Clock-in time plus 8 hours */;
                            } else {
                                $shift_end = null;
                            }
                            if ($analog_active == null) {
                                $shift_end = 0;
                                $overtime_status = 2;
                                $expected_endshift = 0;
                            }

                            ?>
                            <li class="dropdown notification-list list-inline-item ml-auto" style="vertical-align: middle;min-width: 50px">
                                <!--                     lou       <input type="hidden" id="clock-end-time" value="--><?php //echo ($expected_endbreak)?$expected_endbreak:null;       
                                                                                                                        ?>
                                <!--">-->
                                <input type="hidden" id="lunchStartTime" value="<?php echo $lunch_in; ?>" data-value="<?php echo date('h:i A', $lunch_in) ?>">
                                <input type="hidden" id="latestLunchTime" value="<?php echo $latest_lunch_in; ?>" data-value="<?php echo date('h:i A', $latest_lunch_in) ?>">
                                <input type="hidden" id="clock-status" value="<?php echo ($analog_active == 'clock-break') ? 1 : 0; ?>">
                                <input type="hidden" id="attendanceId" value="<?php echo $attn_id; ?>">
                                <input type="hidden" id="employeeShiftStart" value="<?php echo (!empty($expected_shift)) ? $expected_shift : 0; ?>">
                                <input type="hidden" id="employeePingStart" value="<?php echo $sched_notify; ?>">
                                <input type="hidden" id="employeePingEnd" value="<?php echo $over_notify; ?>">
                                <input type="hidden" id="employeeOvertime" value="<?php echo $expected_endshift; ?>">
                                <input type="hidden" id="timeDifference" value="<?php echo $time_difference; ?>">
                                <input type="hidden" id="unScheduledShift" value="<?php echo $shift_end; ?>" data-value="<?php echo date('h:i A', $shift_end) ?>">
                                <input type="hidden" id="autoClockOut" value="<?php echo $overtime_status; ?>">
                                <div class="clock-users " id="<?php echo $clock_btn ?>">
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
                                        <span class="clock-details-text in"><?php echo $clock_in; ?></span>
                                    </div>
                                    <div class="clock-section">
                                        <span class="clock-details-title">Clock Out:</span>
                                        <span class="clock-details-text out"><?php echo $clock_out ?></span>
                                    </div>
                                    <div class="clock-section">
                                        <span class="clock-details-title">Lunch:</span>
                                        <span class="clock-details-text"><span id="break-duration"><?php echo $lunch_time; ?></span>
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
                                        <?php /* <img src="<?php //echo (companyProfileImage(logged('company_id'))) ? companyProfileImage(logged('company_id')) : $url->assets ?>" alt="user" class="rounded-circle"> */ ?>
                                        <?php
                                        $image = (userProfile(logged('id'))) ? userProfile(logged('id')) : $url->assets;
                                        if (!@getimagesize($image)) {
                                            $image = base_url('uploads/users/default.png');
                                        }
                                        // $image = base_url('uploads/users/default.png');
                                        ?>
                                        <img src="<?php echo $image; ?>" alt="user" class="rounded-circle nav-user-img">
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                                        <a class="dropdown-item" href="<?php echo url('dashboard') ?>"><i class="mdi mdi-account-circle m-r-5"></i>Dashboard</a>
                                        <a class="dropdown-item" href="<?php echo url('profile') ?>"><i class="mdi mdi-account-circle m-r-5"></i>Public Profile</a>
                                        <a class="dropdown-item" href="<?php echo url() ?>"><i class="mdi mdi-account-circle m-r-5"></i>nSmart Home</a>
                                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i>Join our community</a>
                                        <?php //if (hasPermissions('activity_log_list')):   
                                        ?>
                                        <a href="<?php echo url('activity_logs') ?>">
                                            <i class="mdi mdi-account-circle m-r-5"></i><span>Activity Logs</span>
                                        </a>
                                        <?php //endif   
                                        ?>
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

    <script type="text/javascript">
        var user_id = <?= $user_id ?>;
        var all_notifications_html = '';
        var notification_badge_value = 0;
        var notification_html_holder_ctr = 0;

        function countChar(val) {
            var len = val.value.length;
            if (len >= 300) {
                val.value = val.value.substring(0, 300);
            } else {
                $('#charNum').text(300 - len);
            }
        };

        function bell_acknowledged() {

            // console.log("solod");
            $('#notifyBadge').hide();
            if (notification_badge_value > 0) {
                notification_badge_value = 0;
                $.ajax({
                    url: baseURL + '/timesheet/notif_user_acknowledge',
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        console.log("Bell Acknowledged");
                    }
                });
            }


        }
        let notificationClockInOut = (function() {
            return function() {
                $.ajax({
                    url: baseURL + "Timesheet/getCount_NotificationsAll",
                    type: "POST",
                    dataType: "json",
                    data: {
                        notifycount: notification_badge_value
                    },
                    success: function(data) {
                        // console.log(data);
                        if (notification_badge_value != data.badgeCount) {
                            notification_badge_value = data.badgeCount;
                            // $('#notifyBadge').html(notification_badge_value);
                            // $('#nfcount').html(data.notifyCount);
                            // $('#notifyBadge').show();
                            // $('#autoNotifications').html(data.autoNotifications);
                            notification_viewer();
                            // console.log(data.notifyCount);
                        }
                        if (data.notifyCount < 1) {
                            $('#autoNotifications').html("<div>No new notification</div>");
                        }
                        // setTimeout(notificationClockInOut, 5000);
                    }
                });
            }
        })();

        let notification_viewer = (function() {
            return function() {
                $.ajax({
                    url: baseURL + "/Timesheet/getNotificationsAll",
                    type: "POST",
                    dataType: "json",
                    data: {
                        badgeCount: notification_badge_value
                    },
                    success: function(data) {
                        // alert(data.badgeCount);
                        if (data.notifyCount > 0) {
                            $('#notifyBadge').html(data.badgeCount);
                            $('#nfcount').html(data.notifyCount);
                            $('#autoNotifications').html(data.autoNotifications);
                            notification_badge_value = data.badgeCount;
                            if (data.badgeCount > 0) {
                                // alert(data.badgeCount);
                                $('#notifyBadge').show();
                            } else {
                                $('#notifyBadge').hide();
                            }
                        }




                        // console.log(data.notifyCount+0);
                        // setTimeout(notificationClockInOut, 5000);
                    }
                });
            }
        })();

        $(document).ready(function() {
            var TimeStamp = null;
            notification_viewer();
            // notificationClockInOut();
        });

        async function notificationRing() {
            const audio = new Audio();
            audio.src = baseURL + '/assets/css/notification/notification_tone2.mp3';
            audio.muted = false;
            try {
                await audio.play();
            } catch (err) {
                // console.log('error');
            }
        }

        Pusher.logToConsole = true;

        var pusher = new Pusher('f3c73bc6ff54c5404cc8', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('nsmarttrac');
        channel.bind('my-event', function(data) {
            if (data.user_id != user_id) {
                notificationRing();
                // console.log("posk");

                // console.log(data.profile_img);
                Push.Permission.GRANTED; // 'granted'
                Push.create(data.FName + " " + data.LName, {
                    body: data.content_notification,
                    icon: data.profile_img,
                    timeout: 20000,
                    onClick: function() {
                        window.focus();
                        this.close();
                    }
                });
            }
            if (data.notif_action_made != "Lunchin" && data.notif_action_made != "Lunchout") {
                notification_badge_value++;
                $('#notifyBadge').html(notification_badge_value);
                $('#notifyBadge').show();
                var current_notifs = $('#autoNotifications').html();
                $('#autoNotifications').html(data.html + current_notifs);
            }


        });
    </script>