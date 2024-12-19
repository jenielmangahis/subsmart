<?php
if ($this->session->userdata('usertimezone') == null) {
    $_SESSION['usertimezone'] = json_decode(get_cookie('logged'))->usertimezone;
    $_SESSION['offset_zone'] = json_decode(get_cookie('logged'))->offset_zone;
    if ($this->session->userdata('usertimezone') == null) {
        $_SESSION['usertimezone'] = 'UTC';
        $_SESSION['offset_zone'] = 'GMT';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="nSmarTrac Website">
    <title>nSmarTrac</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/accounting/accounting-modal-forms.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/esign-main.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/media.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/general-style.css'); ?>">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/v2/boxicons.min.css'); ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap.min.css'); ?>" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?php echo base_url('assets/css/v2/google-font.css'); ?>" rel="stylesheet">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/sweetalert2.min.css'); ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/dist/css/select2.min.css'); ?>" />
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap-datepicker.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-tagsinput.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/bootstrap-datetimepicker.min.css'); ?>">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="<?php echo $url->assets; ?>plugins/morris.js/morris.css">
    <link rel="stylesheet"
        href="<?php echo $url->assets; ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <?php if (isset($enable_tracklocation)) { ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/timesheet/tracklocation.css'); ?>">
    <?php } ?>

    <!-- Multi select -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/multiple-select.min.css'); ?>">

    <!-- Full Calendar -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/full-calendar-main.css'); ?>">

    <!-- Fancybox -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/v2/fancybox.css'); ?>" />

    <!-- Jquery JS -->
    <script src="<?php echo base_url('assets/js/v2/jquery-3.6.0.min.js'); ?>"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- taxes page -->
    <link
        href="<?php echo $url->assets; ?>dashboard/css/responsive.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url->assets; ?>dashboard/css/slick.min.css"
        rel="stylesheet" type="text/css">
    <link
        href="<?php echo $url->assets; ?>dashboard/css/slick-theme.min.css"
        rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- taxes page -->

    <script>
        var base_url = '<?php echo base_url(); ?>';
        var surveyBaseUrl = '<?php echo base_url(); ?>';
    </script>    
    <style>
        .nsm-nav-items #clockOut i {
            color: "green";
        }
        #hdr-multi-account-list .nsm-loader{            
            height: 62px !important;
            min-height: 10px !important;
        }
        .hdr-multi-company-img{
            background-image: url(../images/profile-placeholder.jpeg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 40px;
            width: 40px;
            background-color: #6a4a86;
            color: #fff;
            border-radius: 100%;
            display: inline-block;
            border: 3px solid #fff;
        }
        .hdr-multi-company-name{
            display: inline-block;
            vertical-align: top;
            line-height: 42px;
            margin-left: 7px;
        }
        .swal2-styled.swal2-confirm {        
            background-color: #7367f0 !important;
            color: #fff !important;
        }
        #sidebar-persons-counter .badge-primary, #sidebar-company-counter .badge-primary{
            background-color:#6a4a86 !important;
        }
        #quick-customer-search-result-container{
            display: block;
            padding: 10px;
            margin-top: 7px;
        }
        .getting-started-big-btn{
            width:100%;
            display:block;
            font-size:19px;
        }
    </style>
    <script>
        var baseURL = '<?php echo base_url(); ?>';
    </script>
</head>


<body>
    <div class="nsm-container">
        <div class="nsm-sidebar-bg general-transition"></div>
        <div class="nsm-sidebar general-transition">
            <div class="nsm-sidebar-logo">
                <a href="javascript:void(0);" class="sidebar-toggler">
                    <i class='bx bx-fw bx-menu-alt-left'></i>
                </a>
                <a class="nsm-logo-link" href="<?php echo base_url('dashboard'); ?>">
                    <img class="nsm-logo" src="<?php echo base_url('assets/images/v2/logo.png'); ?>">
                </a>
            </div>

            <ul class="nsm-sidebar-menu">
                <?php
                    $fields = ['id', 'business_name'];
$cid = logged('company_id');
$hdrCompanyData = getCompanyData($cid, $fields);
?>
                <?php if ($hdrCompanyData) { ?>
                    <li>
                        <a href="javscript:void(0);" class="hdr-drpdown-multi-accounts">
                            <div class="hdr-multi-company-img" style="background-image: url('<?php echo businessProfileImage($hdrCompanyData->id); ?>')"></div>
                            <span class="hdr-multi-company-name"><?php echo $hdrCompanyData->business_name; ?></span>
                            <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                        </a>
                        <div id="hdr-multi-account-list"></div>
                    </li>
                <?php } ?>
                <li>
                    <a href="javascript:void(0);" id="left-nav-customer-search">
                        <i class='bx bx-fw bx-search'></i> Search Customer
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);" id="left-getting-started">
                        <i class='bx bx-fw bx-rocket'></i> Getting Started
                    </a>
                </li>
                <?php 
                    if( $hdr_menu_settings ){
                        include viewPath('v2/includes/left_nav_settings');
                    }else{
                        include viewPath('v2/includes/left_nav_default');
                    }
                ?>
                
                <li class="<?php if ($page->parent == 'More') {
                    echo 'active';
                } ?>">
                    <a href="#">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i> More <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if ($page->title == 'Upgrades') {
                            echo 'selected';
                        } ?>">
                            <a href="<?php echo base_url('more/upgrades'); ?>">
                                <i class='bx bx-fw bx-calendar-event'></i> Upgrades
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="customize-menu">
                                <i class='bx bx-fw bx-edit'></i> Customize Menu
                            </a>
                        </li>
                        <?php if (logged('user_type') == 7 && isSolarCompany() == 1) { ?>
                            <li class="btn-adt-sales-portal">
                                <a href="javascript:void(0);">
                                    <i class='bx bx-user-pin' ></i> ADT Sales Portal                                    
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="nsm-main general-transition">
            <div class="nsm-nav">
                <div class="nsm-nav-menu">
                    <a href="javascript:void(0);" class="sidebar-toggler">
                        <i class='bx bx-fw bx-menu-alt-left'></i>
                    </a>
                </div>
                <div class="nsm-page-title">
                    <h4><?php echo $page->title; ?></h4>
                    <?php
                    if ($page->title == 'Dashboard') {
                        ?>
                        <span>Welcome <?php echo getLoggedName(); ?>!</span>
                    <?php
                    } else {
                        ?>
                        <?php echo $page->message; ?>
                    <?php
                    }
?>
                </div>
                <div class="nsm-nav-items">
                    <ul>
                        <li>
                            <div class="dropdown d-flex">
                                <a id="helpSupportButton" href="#" data-bs-toggle="offcanvas" data-bs-target="#helpSupportSidebar" aria-controls="helpSupportSidebar"><i class='bx bx-support' style="margin-top: 0px !important;"></i></a>
                            </div>
                        </li>
                        <?php if (isCompanyPlanActive() == 0 && !in_array(logged('company_id'), exempted_company_ids())) { ?>
                        <li>
                            <style>
                            .expired-notice{
                                width: 289px;
                                margin: auto;
                            }
                            .expired-notice span{
                                color: #ff4d4d;
                                font-size: 14px;
                                display: inline-block;
                                font-weight: bold;
                            }
                            .expired-btn{
                                width: 40%;
                                display: inline-block !important;
                                background-color: #ff1a1a;
                                color: #ffffff !important;
                                border-radius: 5px;
                                text-align: center;
                            }
                            .expired-btn:hover{
                                background-color: #ff4d4d !important;
                            }
                            </style>
                            <div class="expired-notice">
                                <span class="expired-row"><i class='bx bxs-error-circle'></i> Subscription Expired</span>
                                <a class="nsm-button btn-sm expired-btn" href="<?php echo base_url('mycrm/membership'); ?>">Renew Subscription</a>
                            </div>
                        </li>
                        <?php } ?>
                        <li>
                            <?php
        $clock_btn = 'clockIn';
$user_id = logged('id');
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
// Employee display shift status
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

try {
    $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));
} catch (Exception $e) {
    header('Location: '.base_url().'/logout');
}

$checkin_date_time = '';
$attendance_status = 0;
$overtime_status_acknowledgement = 0;
foreach ($attendances as $attn) {
    $attn_id = $attn->id;
    if ($attn->overtime_status == 1) {
        $overtime_status = 2;
    } else {
        $overtime_status = 1;
    }

    $overtime_status_acknowledgement = $attn->overtime_status;

    foreach ($ts_logs_h as $log) {
        if ($log->attendance_id == $attn->id && $attn->status == 1) {
            if ($log->action == 'Check in') {
                $checkin_date_time = $log->date_created;
                $date_created = $log->date_created;
                $attendance_status = 1;
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
                $lunch_time = str_pad($hours, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT).':'.str_pad($seconds, 2, '0', STR_PAD_LEFT);
                $analog_active = 'clock-active';
            }
            if ($log->action == 'Break in') {
                $analog_active = 'clock-break';

                if ($attn->break_duration > 0) {
                    $lunch_in = strtotime($log->date_created) - floor($attn->break_duration * 60);
                    $latest_lunch_in = strtotime($userZone_date_created);
                } else {
                    $lunch_in = strtotime($log->date_created);
                    $latest_lunch_in = 0;
                }
            }
            if ($log->action == 'Break out') {
                if ($attn->status == 1) {
                    $analog_active = 'clock-active';
                    $lunch_time = convertDecimal_to_Time($attn->break_duration, 'lunch');
                }
            }
        } elseif ($log->attendance_id == $attn->id && $attn->status == 0) {
            $lunch_time = convertDecimal_to_Time($attn->break_duration, 'lunch');
            $shift_duration = convertDecimal_to_Time($attn->shift_duration + $attn->overtime, 'shift diration');
            // var_dump($attendance_id);
            if ($log->action == 'Check in') {
                $date_created = $log->date_created;
                date_default_timezone_set('UTC');
                $datetime_defaultTimeZone = new DateTime($date_created);
                $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                $userZone_date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                $clock_in = date('h:i A', strtotime($userZone_date_created));
            } elseif ($log->action == 'Check out') {
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
            $dt = new DateTime('now', new DateTimeZone($tz));
            $dt->setTimestamp($timestamp);
            if ($sched->start_date == $dt->format('Y-m-d')) {
                $expected_shift = strtotime($sched->start_date.' '.$sched->start_time);
                $expected_endshift = strtotime($sched->start_date.' '.$sched->end_time);
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
    $shift_end += 28800; /* Clock-in time plus 8 hours */
} else {
    $shift_end = null;
}
if ($analog_active == null) {
    $shift_end = 0;
    $overtime_status = 2;
    $expected_endshift = 0;
}

?>
                            <input type="hidden" id="clockedin_date_time" value="<?php echo $checkin_date_time; ?>">
                            <input type="hidden" id="attendance_status" value="<?php echo $attendance_status; ?>">
                            <input type="hidden" id="overtime_status_acknowledgement" value="<?php echo $overtime_status_acknowledgement; ?>">
                            <input type="hidden" id="break_duration_for_auto_out" value="<?php echo $break_duration_for_auto_out; ?>">
                            <input type="hidden" id="lunchStartTime" value="<?php echo $lunch_in; ?>" data-value="<?php echo date('h:i A', $lunch_in); ?>">
                            <input type="hidden" id="latestLunchTime" value="<?php echo $latest_lunch_in; ?>" data-value="<?php echo date('h:i A', $latest_lunch_in); ?>">
                            <input type="hidden" id="clock-status" value="<?php echo ($analog_active == 'clock-break') ? 1 : 0; ?>">
                            <input type="hidden" id="attendanceId" value="<?php echo $attn_id; ?>">
                            <input type="hidden" id="employeeShiftStart" value="<?php echo (!empty($expected_shift)) ? $expected_shift : 0; ?>">
                            <input type="hidden" id="employeePingStart" value="<?php echo $sched_notify; ?>">
                            <input type="hidden" id="employeePingEnd" value="<?php echo $over_notify; ?>">
                            <input type="hidden" id="employeeOvertime" value="<?php echo $expected_endshift; ?>">
                            <input type="hidden" id="timeDifference" value="<?php echo $time_difference; ?>">
                            <input type="hidden" id="unScheduledShift" value="<?php echo $shift_end; ?>" data-value="<?php echo date('h:i A', $shift_end); ?>">
                            <input type="hidden" id="autoClockOut" value="<?php echo $overtime_status; ?>">
                            <div class="dropdown dropdown-hover d-flex Btn" id="<?php echo $clock_btn; ?>" data-allow-module="<?php echo $_SESSION['alert_class']; ?>">
                                <a href="#" class="dropdown-toggle">
                                    <i class='bx bx-fw bx-time-five cBtn'></i>
                                </a>
                                <div class="dropdown-menu dropdown-list">
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Clock in</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $clock_in; ?></h6>
                                    </div>
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Clock out</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $clock_out; ?></h6>
                                    </div>
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Lunch</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $lunch_time; ?></h6>
                                    </div>
                                    <div class="list-item d-flex">
                                        <h6 class="dropdown-header fw-bold">Shift Duration</h6>
                                        <h6 class="dropdown-header ms-auto"><?php echo $shift_duration; ?></h6>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-task'></i></a>
                                <div class="dropdown-menu dropdown-list nsm-nav-dropdown">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold">Tasks</h6>
                                    </div>
                                    <div id="task_container">
                                        <?php
            $newtasks = getTasks();

if (count($newtasks) > 0) {
    foreach ($newtasks as $task) {
        ?>
                                                <div class="list-item" onclick="location.href='<?php echo base_url('taskhub/view/'.$task->task_id); ?>'">
                                                    <span class="content-title"><?php echo $task->subject; ?></span>
                                                    <span class="content-subtitle">
                                                        <?php
                        $date_created = date_create($task->date_created);
        echo date_format($date_created, 'F d, Y h:i:s');
        ?>
                                                    </span>
                                                </div>
                                            <?php
    }
} else {
    ?>
                                            <div class="text-center py-3">
                                                <span class="content-subtitle">No tasks for now.</span>
                                            </div>
                                        <?php
}
?>
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item text-center" onclick="location.href='<?php echo base_url('taskhub'); ?>'">
                                        <span class="content-subtitle">View All</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown"><i class='bx bx-fw bx-bell'></i></a>
                                <div class="dropdown-menu dropdown-list nsm-nav-dropdown">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold">Notifications</h6>
                                    </div>
                                    <div id="notifications_container">
                                        <div class="text-center py-3">
                                            <span class="content-subtitle">No notifications for now.</span>
                                        </div>
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item text-center" onclick="location.href='<?php echo site_url(); ?>timesheet/notification'">
                                        <span class="content-subtitle">View All</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown d-flex">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <?php
                                    $image = userProfilePicture(logged('id'));
if (is_null($image)) {
    ?>
                                        <div class="profile-img" style="background-image: url('')">
                                            <span><?php echo getLoggedNameInitials(logged('id')); ?></span>
                                        <?php
} else {
    ?>
                                            <div class="profile-img" style="background-image: url('<?php echo $image; ?>')">
                                            <?php
}
?>
                                            </div>
                                </a>
                                <div class="dropdown-menu dropdown-list">
                                    <div class="list-header">
                                        <h6 class="dropdown-header fw-bold"><?php echo getLoggedFullName(logged('id')); ?></h6>
                                    </div>
                                    <div class="list-item main-nav-item" id="<?php echo $clock_btn; ?>">
                                        Clock In/Clock Out
                                    </div>
                                    <div class="list-item main-nav-item position-relative">
                                        Tasks <span class="nsm-badge badge-circle error">1</span>
                                    </div>
                                    <div class="list-item main-nav-item position-relative">
                                        Notifications <span class="nsm-badge badge-circle error">1</span>
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('profile'); ?>'">
                                        Public Profile
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url(); ?>'">
                                        nSmart Home
                                    </div>
                                    <div class="list-item">
                                        Join Our Community
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('activity_logs'); ?>'">
                                        Activity Logs
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo base_url('settings/email_templates'); ?>'">
                                        Settings
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('/logout'); ?>'">
                                        Logout
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="nsm-content-container">
                <div class="nsm-content">

<style>
    #chatbox {
        border-radius: 15px;
    }

    .chatbox_header {
        border-top-left-radius: 15px !important;
        border-top-right-radius: 15px !important;
        background: #6a4a86;
    }

    .chatbot_image {
        height: 50px;
        width: 50px;
    }

    .chatbot_name_section {
        margin-left: 10px;
    }

    .chatbot_name {
        font-weight: bold;
    }

    .chatbot_name_section > .chatbot_name {
        font-size: 15px;
    }

    .chatbot_minimize {
        position: absolute;
        font-size: 25px;
        right: 25px;
        cursor: pointer;
    }

    .chatbot_body {
        background: #f3f3f3;
        border-bottom-right-radius: 15px;
        border-bottom-left-radius: 15px;
        padding: unset;
    }

    .chat_content {
        /* max-height: 500px;
        height: 500px; */
        font-weight: 500;
    }

    .send_chat {
        padding-right: 10px;
        padding-top: 20px;
    }

    .send_chat_container {
        border-radius: 15px;
        /* background-color: #6a4a8621;  */
        max-width: 350px;
    }

    .receive_chat {
        padding-left: 10px;
        padding-top: 20px;
    }

    .receive_chat_container {
        border-radius: 15px;
        background-color: #f7f7f7;
        max-width: 350px;
    }

    .message_form_container {
        padding: 15px;
        border-top: 1px solid #00000020;
    }

    .message_form_button {
        background: #6a4a86;
        color: white;
    }

    .message_form_button_icon {
        font-size: 19px;
        vertical-align: sub;
    }

    .spacer {
        margin: 20px;
    }

    .sender_name {
        font-weight: bold;
        right: 20px;
    }

    .receiver_name {
        font-weight: bold;
        left: 20px;
    }

    /* .chatbox_container {
        position: fixed;
        bottom: 20px;
        right: 15px;
        width: 450px;
        display: none;
        z-index: 999 !important;
    } */

    .chaticon {
        height: auto;
        width: 70px;
        position: fixed;
        bottom: 20px;
        right: 15px;
        z-index: 999 !important;
    }

    .chaticon:hover {
        height: auto;
        width: 75px;
        cursor: pointer;
    }

    .typing_status {
        position: absolute;
        left: 15px;
        bottom: 70px;
    }

    @keyframes bounce {
        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }

    .typing_status {
        animation: bounce 0.5s infinite;
    }

    .send_container,
    .receive_container {
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .chaticon,
    .typing_status {
        display: none;
    }

    .offcanvas {
        transition: transform 0.3s ease;
    }

    .offcanvas-end {
        border-left: unset;
    }
    
    .cursorPointer {
        cursor: pointer;
    }
    
    .playCirleSize {
        font-size: 25px;
    }

    .watchClip {
        margin-bottom: -6px;
        margin-top: -2px;
    }

    .watchClip:hover {
        font-weight: bold;
        color: #ff00009e;
    }

    #previewBinder_table_info {
        display: none;
    }

    #previewBinder_table.dataTable.no-footer {
    border-bottom: 0px solid #dee2e6 !important;
    }

    #previewBinder_table.dataTable thead th,
    #previewBinder_table.dataTable thead td,
    #previewBinder_table.dataTable tbody td {
        padding: 6px;
    }

    #previewBinder_table.dataTable tbody td {
        border-bottom: 1px solid lightgray !important;
    }

    #previewBinder_table.dataTable > thead > tr > th {
        border: 1px solid lightgray !important;
    }

    #previewBinder_table_wrapper .dataTables_length,
    #previewBinder_table_wrapper .dataTables_filter {
        display: none;
    }

    #previewBinder_table > tbody {
        font-size: unset;
    }
    
    .techSupportSidebarCanvas {
        width: 435px;
    }

    .ccCheckbox {
        width: 18px;
        height: 18px;
    }
</style>

<!-- <div class="row d-flex position-relative">
    <img class="chaticon" src="https://static.vecteezy.com/system/resources/previews/014/441/089/original/chat-message-icon-design-in-blue-circle-png.png">
</div> -->

<div class="offcanvas offcanvas-end techSupportSidebarCanvas" tabindex="-1" id="helpSupportSidebar" aria-labelledby="helpSupportSidebarLabel">
    <div class="offcanvas-header" style="background: #6a4a86;">
        <h5 id="helpSupportSidebarLabel" style="font-weight: bold; margin: 0; color: white;">Tech Support</h5>
        <button type="button" class="btn" data-bs-dismiss="offcanvas" aria-label="Close" style="color: white !important;float: left;padding: 0;"><span class="float-start"><small>Close</small></span></button>
    </div>
    <div class="offcanvas-body">
        <div class="container">
            <div class="row techSupportMenu" style="display: non;">
                <div class="col-12-md mb-3">
                    <h4 class="fw-bold">How do you prefer to get in touch with us?</h4>
                </div>
                <div class="col-12-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Call us</h5>
                            <p class="card-text">Schedule a call, and we'll reach out to you as soon as possible.</p>
                            <a href="#" class="btn btn-success fw-bold openCallUs"><i class="fas fa-phone"></i>&nbsp;&nbsp;Let's talk in call</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Support via call is available only Monday to Friday from 6:00am to 10:00pm.</div>
                    </div>
                </div>
                <div class="col-12-md mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Real-time chat</h5>
                            <p class="card-text">Engage in real-time chat with us and expect a prompt response.</p>
                            <a href="#" class="btn btn-success fw-bold"><i class="fas fa-comments"></i>&nbsp;&nbsp;Start chatting</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Our team is ready to assist you during our operational hours.</div>
                    </div>
                </div>
                <div class="col-12-md mb-2">
                    <hr>
                </div>
                <div class="col-12-md mb-3">
                    <h4 class="fw-bold">Others</h4>
                </div>
                <div class="col-12-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Video Binder</h5>
                            <p class="card-text">Access our video binder for comprehensive pre-recorded information about the system.</p>
                            <a href="#" class="btn btn-primary fw-bold openVideoBinder"><i class="fas fa-folder"></i>&nbsp;&nbsp;Open Video Binder</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;The video binder is a collection of pre-recorded videos providing detailed information about the system.</div>
                    </div>
                </div>
                <div class="col-12-md mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Chatbot</h5>
                            <p class="card-text">Interact with our chatbot for quick assistance.</p>
                            <a href="#" class="btn btn-primary fw-bold openChatbotButton"><i class="fas fa-robot"></i>&nbsp;&nbsp;Open chatbot</a>
                        </div>
                        <div class="card-footer text-muted"><i class="fas fa-info-circle"></i>&nbsp;&nbsp;Our chatbot is available 24/7 to help answer questions on system-related inquiries.</div>
                    </div>
                </div>
            </div>
            <div class="row callUs" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">Call Us</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>Schedule a call, and we'll reach out to you as soon as possible. Support via call is available only <strong>Monday to Friday</strong> from <strong>6:00am to 10:00pm</strong>.</span>
                </div>
                <div class="col-12-md">
                    <form id="scheduleCallForm">
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">Date&nbsp;<small class="text-muted">(mm/dd/yyyy)</small></label>
                            <input name="schedule_date" class="form-control mt-0" type="date" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">Time&nbsp;<small class="text-muted">(hh:mm AM/PM)</small></label>
                            <div class="input-group">
                                <select name="schedule_time_hrs" class="nsm-field form-select" required>
                                    <option value="" selected disabled hidden>&mdash;</option>
                                    <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            echo "<option value='$hour'>$hour</option>";
                                        }
                                    ?>
                                </select>
                                <select name="schedule_time_mins" class="nsm-field form-select" required>
                                    <?php
                                        for ($i = 0; $i <= 59; $i++) {
                                            $minute = str_pad($i, 2, '0', STR_PAD_LEFT);
                                            echo "<option value='$minute'>$minute</option>";
                                        }
                                    ?>
                                </select>
                                <select name="schedule_time_notation" class="nsm-field form-select" required>
                                    <option value="" selected disabled hidden>&mdash;</option>
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">CC&nbsp;<small class="text-muted">(Send a schedule copy to your email)</small></label>
                            <div class="input-group mb-3">
                                <div class="input-group-text">
                                    <input name="schedule_cc_checkbox" class="form-check-input mt-0 ccCheckbox cursorPointer" type="checkbox" checked>
                                </div>
                                <input name="schedule_cc" class="form-control mt-0" type="email" value="<?php echo logged('email');; ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="mb-1 fw-xnormal">Notes&nbsp;<small class="text-muted">(Specify notes, queries etc. Optional)</small></label>
                            <textarea name="schedule_notes" class="form-control" placeholder="eg. I want help on Job module."></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button class="nsm-button primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row videoBinder" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">Video Binder</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>The video binder is a collection of pre-recorded videos providing detailed information about the system.</span>
                </div>
                <div class="col-12-md">
                    <input id="previewBinder_table_search" class="form-control mt-0 mb-2 w-100" type="text" placeholder="Search...">
                    <table id="previewBinder_table" class="table table-bordered table-hover table-sm w-100 mb-2">
                        <thead><tr><th></th></tr></thead>
                        <tbody><tr></tr></tbody>
                    </table>
                </div>
            </div>
            <div class="row chatBotMessenger" style="display: none;">
                <div class="col-12-md">
                    <h4 class="fw-bold float-start">ChatBot</h4>
                    <span class="text-muted float-end cursorPointer returnToMenu"><i class='bx bxs-left-top-arrow-circle'></i> Return to Menu</span>
                </div>
                <div class="col-12-md mb-3">
                    <span>A chatbot is a tool that assists users by answering system inquiries and providing relevant information automatically.</span>
                </div>
                <div class="col-12-md chatbox_container">
                    <div id="chatbox" class="card">
                        <div class="card-header chatbox_header d-flex align-items-center p-3 text-white border-bottom-0">
                            <img class="chatbot_image" src="https://cdn-icons-png.flaticon.com/512/8943/8943377.png">
                            <p class="mb-0 chatbot_name_section"><span class="chatbot_name">Chatbot</span><br><small>Chatbot</small></p>
                            <!-- <i class="fas fa-times chatbot_minimize"></i> -->
                        </div>
                        <div class="card-body chatbot_body">
                            <div class="table-responsive chat_content">
                                <div class="receive_container position-relative">
                                    <small class="receiver_name position-absolute">🤖 <span class="chatbot_name">Chatbot</span></small>
                                    <div class="receive_chat d-flex flex-row justify-content-start">
                                        <div class="p-3 me-3 border receive_chat_container">
                                            <p class="mb-0">Hi, I'm <u class="chatbot_name">Chatbot</u>, a chatbot from nSmarTrac, who can help you with your queries.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="receive_container position-relative">
                                    <small class="receiver_name position-absolute">🤖 <span class="chatbot_name">Chatbot</span></small>
                                    <div class="receive_chat d-flex flex-row justify-content-start">
                                        <div class="p-3 me-3 border receive_chat_container">
                                            <p class="mb-0">How can I help you today?</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="typing_status"><small class="text-muted"><span class="chatbot_name fw-normal">Chatbot</span> is typing...</small></div>
                            <form id="sendchat_form">
                                <div class="input-group message_form_container">
                                    <input name="request" class="form-control" type="text" placeholder="Type your message here..." required>
                                    <button type="submit" class="btn message_form_button">
                                        <strong><i class='bx bxs-send message_form_button_icon'></i></strong>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- preview Video in video Binder -->
<div class="modal fade viewVideoFromBinderModal" data-bs-backdrop="static" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Preview Video</span>
                <i class="bx bx-fw bx-x m-0 text-muted exit_preview_modal" data-bs-dismiss="modal" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div id="viewVideoContent" class="text-center">
                    <p class="text-muted">No file selected for preview.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Customize menu -->
<div class="modal fade nsm-modal fade" id="modal-customize-menu" tabindex="-1" aria-labelledby="modal-customize-menuLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id=""><i class='bx bx-edit'></i> Customize Menu</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <form action="" id="frm-company-customize-menu">
            <div class="modal-body">
                <p>Choose what you want to see in your menu, and drag and reorder items to fit the way you work :</p>
                <div id="customize-menu-container" style="max-height:500px; overflow-y:auto;overflow-x:hidden;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary btn-update-menu-setting">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Customer Search -->
<div class="modal fade nsm-modal fade" id="modal-quick-customer-search" tabindex="-1" aria-labelledby="modal-customize-menuLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id=""><i class='bx bx-search'></i> Search Customer</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body">
                <form id="frm-left-nav-quick-search-customer">
                <div class="input-group">
                    <input type="text" name="customer_query" class="form-control rounded" placeholder="Search" />
                    <button type="submit" class="nsm nsm-button primary" style="margin-bottom:0px;">search</button>
                </div>
                </form>
                <div id="quick-customer-search-result-container"></div>
            </div>
        </div>
    </div>
</div>

<!-- Getting Started -->
<div class="modal fade nsm-modal fade" id="modal-getting-started" tabindex="-1" aria-labelledby="modal-customize-menuLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg" style="max-width:690px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="">Getting Started</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body" id="getting-started-container"></div>
            <br /><br />
        </div>
    </div>
</div>

<!-- Getting Started : Download Mobile App -->
<div class="modal fade nsm-modal fade" id="modal-getting-started-download-mobile-app" tabindex="-1" aria-labelledby="modal-getting-started-download-mobile-app-menuLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-lg modal-dialog-centered" style="max-width:633px !important;">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="">Download Mobile App</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body">
                <form id="frm-getting-started-send-download-app-link">
                <div class="row">
                    <div class="col-md-8">
                        <h4>Manage Your Business & Connect with Your Team in the field</h4>
                        <p class="mt-2">This app is perfect for your team/techs in the field. View your schedule, invoice client on the spot, clock in and out, send estimates and more…</p>
                        <div class="mb-3 mt-4">
                            <label for="gettingStartedSendDownloadAppLink" class="form-label">Get the download link sent to your phone</label>
                            <input type="text" class="form-control" id="gettingStartedSendDownloadAppLink" name="download_app_phone_number" placeholder="Your Phone" required="">
                            <button type="submit" class="nsm-button primary mt-2" id="btn-send-download-link">Send</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="<?= base_url('assets\frontend\images\mobile-app.jpg'); ?>" style="height:258px;" />
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Getting Started : Job Schedule -->
<div class="modal fade nsm-modal fade" id="modal-getting-started-job-schedule" aria-labelledby="modal-getting-started-job-scheduleLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="">Job Schedule</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body" id="getting-started-container">
                <div class="row">
                    <div class="col-md-6">
                        <a class="nsm-button primary getting-started-big-btn" target="_new" href="<?= base_url('workcalender'); ?>">
                            <i class='bx bx-fw bx-calendar-plus'></i> Use Calendar 
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="nsm-button primary getting-started-big-btn" target="_new" href="<?= base_url('job/new_job1'); ?>">
                            <i class='bx bx-fw bx-list-plus' ></i> Use Job Form 
                        </a>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<!-- Getting Started : Connect to Quickbooks -->
<div class="modal fade nsm-modal fade" id="modal-connect-to-quickbooks-or-import-customer-list" aria-labelledby="modal-connect-to-quickbooks-or-import-customer-listLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="">Import Your Clients</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>            
            <div class="modal-body" id="getting-started-container">
                <div class="row">
                    <div class="col-md-6" style="text-align: center;">
                        <!-- <i class='bx bx-circle' style="font-size: 100px;"></i> -->
                        <img class="nsm-logo" src="<?php echo base_url('assets/img/api-tools/thumb_quickbooks_payroll.png'); ?>" style="height: 100px;">
                        <a class="nsm-button primary getting-started-big-btn" target="_new" href="<?= base_url('tools/quickbooks_accounting'); ?>">From Quickbooks</a>
                    </div>
                    <div class="col-md-6" style="text-align: center;">
                        <i class='bx bxs-spreadsheet' style="font-size: 100px;"></i>
                        <a class="nsm-button primary getting-started-big-btn" target="_new" href="<?= base_url('customer/import_customer'); ?>">From Spreadsheet</a>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>

<script>   

    var BASE_URL = window.origin;

    // Custom Function ===============
    function formDisabler(selector, state) {
        const element = $(selector);
        const submitButton = element.find('button[type="submit"]');
        element.find("input, button, textarea, select").prop('disabled', state);

        if (state) {
            element.find('a').hide();
            if (!submitButton.data('original-content')) {
                submitButton.data('original-content', submitButton.html());
            }
            submitButton.prop('disabled', true);
        } else {
            element.find('a').show();
            const originalContent = submitButton.data('original-content');
            if (originalContent) {
                submitButton.prop('disabled', false).html(originalContent);
            }
        }
    }

    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: BASE_URL + "/chatbot/preference",
            dataType: "JSON",
            success: function(response) {
                $('.chatbot_name').text(response[0]['chatbot_name']);
                $('.chatbox_header, .message_form_button').css('background', response[0]['color']);
                $('.chatbox_header').attr('data-bgcolor', response[0]['color']);
                $('.chaticon').show();
            }
        });

        $('.openCallUs').click(function(e) {
            $('.techSupportMenu').hide();
            $('.callUs').fadeIn();
            $('.videoBinder').hide();
            $('.chatBotMessenger').hide();
        });

        $('.openVideoBinder').click(function(e) {
            if (!$.fn.DataTable.isDataTable('#previewBinder_table')) {
                const previewBinder_table = $('#previewBinder_table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ordering": false,
                    "pageLength": 20,
                    "ajax": {
                        "url": BASE_URL + "/VideoBinder/getAllVideos",
                        "type": "POST",
                    },
                    "language": {
                        "infoFiltered": "",
                    },
                    "order": []
                });

                $('#previewBinder_table_search').keyup(function() {
                    previewBinder_table.search($(this).val()).draw();
                });
            }

            $('.techSupportMenu').hide();
            $('.callUs').hide();
            $('.videoBinder').fadeIn();
            $('.chatBotMessenger').hide();
        });

        $('.openChatbotButton').click(function(e) {
            $('.techSupportMenu').hide();
            $('.callUs').hide();
            $('.videoBinder').hide();
            $('.chatBotMessenger').fadeIn();

            let chatContent_height = $(window).height() - 312;
            $('.chat_content').css('height', chatContent_height + 'px');
        });

        $('.returnToMenu').click(function(e) {
            $('.techSupportMenu').fadeIn();
            $('.callUs').hide();
            $('.videoBinder').hide();
            $('.chatBotMessenger').hide();
        });

        $(document).on('click', '.watchClip', function() {
            const fileName = $(this).attr('data-filename');
            const fileUrl = `${BASE_URL}/uploads/files/${fileName}`;
            const fileType = fileName.split('.').pop().toLowerCase();
            const previewContent = $('#viewVideoContent');

            let content = '';
            if (['jpg', 'jpeg', 'png', 'gif'].includes(fileType)) {
                content = `<img src="${fileUrl}" class="img-fluid" alt="Video Image">`;
            } else if (['mp4', 'avi', 'mov', 'wmv'].includes(fileType)) {
                content = `
                    <video controls class="w-100">
                        <source src="${fileUrl}" type="video/${fileType}">
                        Your browser does not support the video tag.
                    </video>`;
            } else {
                content = `<p class="text-danger">Unsupported file format for preview.</p>`;
            }

            previewContent.html(content);
            $('.viewVideoFromBinderModal').modal('show');
        });

        $(document).on('hidden.bs.modal', '.viewVideoFromBinderModal', function() {
            $(this).find('video').remove();
        });

        $('select[name="schedule_time_hrs"]').on('change', function() {
            const hrs = parseInt($(this).val());
            const mins = $('select[name="schedule_time_mins"]').val();
            const $notation = $('select[name="schedule_time_notation"]');
            $notation.empty();

            if (hrs >= 6 && hrs <= 10) {
                $notation.append(new Option("AM", "AM"));
                $notation.append(new Option("PM", "PM"));
            } else if (hrs === 11) {
                $notation.append(new Option("AM", "AM"));
            } else {
                $notation.append(new Option("PM", "PM"));
            }

            if (hrs == 10 & mins > 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
            } else if (hrs == 10 & mins == 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
                $notation.append(new Option("PM", "PM"));
            }
        });

        $('select[name="schedule_time_mins"]').on('change', function() {
            const hrs = $('select[name="schedule_time_hrs"]').val();
            const mins = parseInt($(this).val());
            const $notation = $('select[name="schedule_time_notation"]');

            if (hrs == 10 & mins > 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
            } else if (hrs == 10 & mins == 0) {
                $notation.empty();
                $notation.append(new Option("AM", "AM"));
                $notation.append(new Option("PM", "PM"));
            }
        });

        $('input[name="schedule_cc_checkbox"]').on('change', function() {
            if ($(this).prop('checked')) {
                $('input[name="schedule_cc"]').prop('required', true);
            } else {
                $('input[name="schedule_cc"]').prop('required', false);
            }
        });

        $('input[name="schedule_date"]').on("keydown", function(e) {
            e.preventDefault();
        });

        const dateInput = $('input[name="schedule_date"]');
        const today = new Date();
        const currentDate = today.toISOString().split("T")[0];
        const lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        const lastDayFormatted = lastDay.getFullYear() + '-' + (lastDay.getMonth() + 1).toString().padStart(2, '0') + '-' + lastDay.getDate().toString().padStart(2, '0');
        dateInput.attr('min', currentDate);
        dateInput.attr('max', lastDayFormatted);
        dateInput.on('change', function () {
            const selectedDate = new Date($(this).val());
            const dayOfWeek = selectedDate.getDay(); 

            if (dayOfWeek === 0 || dayOfWeek === 6) {
                $(this).val(''); // Clear the input
                Swal.fire({
                    icon: "error",
                    title: "Failed to set date!",
                    html: "Support via call is available only <u>Monday</u> to <u>Friday</u>.",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                    showCloseButton: true,
                });
            }
        });

        // $('.chaticon').click(function(e) {
        //     $('.chatbox_container').slideDown();
        //     $('.chaticon').fadeOut();
        // });

        // Disable - For Later development
        // $('.chatbot_minimize').click(function(e) {
        //     $('.chatbox_container').slideUp();
        //     $('.chaticon').fadeIn();
        // });

        // xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        
        $(document).on('click', '#getting-started-schedule-job', function() {
            $('#modal-getting-started-job-schedule').modal('show');
        });

        $(document).on('click', '#getting-started-download-mobile-app', function() {
            $('#modal-getting-started-download-mobile-app').modal('show');
        });

        $(document).on('click', '#connect-to-quickbooks-or-import-customer-list', function() {
            $('#modal-connect-to-quickbooks-or-import-customer-list').modal('show');
        });

        $(document).on('click', '#left-nav-customer-search', function() {
            $('#modal-quick-customer-search').modal('show');
        });

        $(document).on('click', '#left-getting-started', function() {
            $('#modal-getting-started').modal('show');
            $.ajax({
                type: "POST",
                url: base_url + "dashboard/_getting_started",
                beforeSend: function() {
                    $('#getting-started-container').html('<span class="bx bx-loader bx-spin"></span>');

                },
                success: function(html) {
                    $('#getting-started-container').html(html);
                }
            });
        });

        $(document).on('submit', '#frm-left-nav-quick-search-customer', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "customer/_quick_search",
                data: $('#frm-left-nav-quick-search-customer').serialize(),
                beforeSend: function() {
                    $('#quick-customer-search-result-container').html('<span class="bx bx-loader bx-spin"></span>');

                },
                success: function(html) {
                    $('#quick-customer-search-result-container').html(html);
                }
            });
        });

        $('#frm-getting-started-send-download-app-link').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: base_url + "dashboard/_send_download_app_link",
                data: $('#frm-getting-started-send-download-app-link').serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    $('#btn-send-download-link').html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(result) {
                    $('#modal-getting-started-download-mobile-app').modal('hide');
                    $('#btn-send-download-link').html('Send');
                    if (result.is_success == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Download Mobile App',
                            text: 'A text message will be sent to you in a short while.',
                        }).then((result) => {
                            //window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.msg,
                        });
                    }
                }
            });
        });

        $(document).on('submit', '#sendchat_form', function(e) {
            e.preventDefault();
            let sendchatData = $(this);
            let chatMessage = sendchatData.find('input[name="request"]').val();
            let chatbot_name = $('.chatbot_name').eq(0).text();
            let bgcolor = $('.chatbox_header').attr('data-bgcolor');

            $.ajax({
                type: "POST",
                url: BASE_URL + "/chatbot/request",
                data: sendchatData.serialize(),
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(sendchatData, true);
                    $('.chat_content').append('<div class="send_container position-relative"> <small class="sender_name position-absolute">You</small> <div class="send_chat d-flex flex-row justify-content-end"> <div class="p-3 send_chat_container" style="background-color: ' + bgcolor + '21;"> <p class="mb-0 send_chat_message">' + chatMessage + '</p> </div> </div> </div>').scrollTop($('.chat_content')[0].scrollHeight);
                    setTimeout(() => {
                        $('.typing_status').fadeIn('fast');
                    }, 500);
                },
                success: function(response) {
                    setTimeout(() => {
                        $('.chat_content').append('<div class="receive_container position-relative"> <small class="receiver_name position-absolute">🤖 ' + chatbot_name + '</small> <div class="receive_chat d-flex flex-row justify-content-start"> <div class="p-3 me-3 border receive_chat_container"> <p class="mb-0">' + response + '</p> </div> </div> </div>').scrollTop($('.chat_content')[0].scrollHeight);
                        $('.typing_status').hide();
                        sendchatData.find('input').val(null);
                        formDisabler(sendchatData, false);
                    }, 1000);
                }
            });
        });

        // Customize menu
        //$('#modal-customize-menu').modal({backdrop: 'static', keyboard: false});

        $('.customize-menu').on('click', function() {
            $('#modal-customize-menu').modal('show');

            $.ajax({
                type: "POST",
                url: base_url + "mycrm/_customize_menu",
                beforeSend: function() {
                    $('#customize-menu-container').html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(html) {
                    $('#customize-menu-container').html(html);
                }
            });
        });

        $('#frm-company-customize-menu').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                data: $('#frm-company-customize-menu').serialize(),
                type: "POST",
                dataType: 'json',
                url: base_url + "mycrm/_update_menu_setting",
                beforeSend: function() {
                    $('.btn-update-menu-setting').html('<span class="bx bx-loader bx-spin"></span>');
                },
                success: function(result) {
                    $('.btn-update-menu-setting').html('Save');
                    if (result.is_success == 1) {
                        $('#modal-customize-menu').modal('hide');
                        Swal.fire({
                            text: "Menu settings was successfully updated",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                            location.reload();
                            //}
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {

                        });
                    }

                }
            });
        });
    });
</script>