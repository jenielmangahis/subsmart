<?php
if ($this->session->userdata('usertimezone') == null) {
    $_SESSION['usertimezone'] = json_decode(get_cookie('logged'))->usertimezone;
    $_SESSION['offset_zone'] = json_decode(get_cookie('logged'))->offset_zone;
    if ($this->session->userdata('usertimezone') == null) {
        $_SESSION['usertimezone'] = "UTC";
        $_SESSION['offset_zone'] = "GMT";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>nSmarTrac</title>

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/main.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/media.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/general-style.css") ?>">
    <!-- Boxicons CSS-->
    <link rel="stylesheet" type="text/css" href="<?= base_url("assets/css/v2/boxicons.min.css") ?>">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap.min.css") ?>" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= base_url("assets/css/v2/google-font.css") ?>" rel="stylesheet">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/sweetalert2.min.css") ?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url("assets/plugins/select2/dist/css/select2.min.css") ?>" />
    <!-- Datepicker -->
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap-datepicker.min.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/bootstrap-tagsinput.css") ?>">
    <link rel="stylesheet" href="<?= base_url("assets/css/v2/bootstrap-datetimepicker.min.css") ?>">

    <!-- Jquery JS -->
    <script src="<?= base_url("assets/js/v2/jquery-3.6.0.min.js") ?>"></script>
    <script>
        var base_url = '<?= base_url() ?>';
        var surveyBaseUrl = '<?= base_url() ?>';
    </script>
    <style>
        .nsm-nav-items #clockOut i{
            color: "green";
        }
    </style>
</head>


<body>
    <div class="nsm-container">
        <div class="nsm-sidebar-bg general-transition"></div>
        <div class="nsm-sidebar general-transition">
            <div class="nsm-sidebar-logo">
                <a href="javascript:void(0);" class="sidebar-toggler">
                    <i class='bx bx-fw bx-menu-alt-left'></i>
                </a>
                <a class="nsm-logo-link" href="<?= base_url("dashboard") ?>">
                    <img class="nsm-logo" src="<?= base_url("assets/images/v2/logo.png") ?>">
                </a>
            </div>

            <ul class="nsm-sidebar-menu">
                <li class="<?php if ($page->title == 'Dashboard') : echo 'selected ';
                            endif;
                            if ($page->parent == 'Dashboard') : echo 'active';
                            endif; ?>">
                    <a href="<?= base_url("dashboard") ?>">
                        <i class='bx bx-fw bx-tachometer'></i> Dashboard
                        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if ($page->title == 'SMS') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("messages") ?>">
                                <i class='bx bx-fw bx-message-square-dots'></i> SMS
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Calls and Logs') : echo 'selected';
                                    endif; ?>">
                            <a href="#">
                                <i class='bx bx-fw bx-phone-call'></i> Calls and Logs
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Smart Zoom') : echo 'selected';
                                    endif; ?>">
                            <a href="#">
                                <i class='bx bx-fw bx-square-rounded'></i> Smart Zoom
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Inbox') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("inbox") ?>">
                                <i class='bx bx-fw bxs-inbox'></i> Inbox
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Sent') : echo 'selected';
                                    endif; ?>">
                            <a href="#">
                                <i class='bx bx-fw bx-paper-plane'></i> Sent
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Support') : echo 'selected';
                                    endif; ?>">
                            <a href="#">
                                <i class='bx bx-fw bx-support'></i> Support
                            </a>
                        </li>

                        <?php if (logged('user_type') == 1 || isAdminBypass()) { ?>
                            <li class="btn-admin-switch">
                                <a href="javascript:void(0);">
                                    <i class='bx bx-fw bx-refresh'></i> Switch to Admin
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("workcalender") ?>">
                        <i class='bx bx-fw bx-calendar'></i> Calendar
                    </a>
                </li>
                <li class="<?php if ($page->parent == 'Sales') : echo 'active';
                            endif; ?>">
                    <a href="#">
                        <i class='bx bx-fw bx-line-chart'></i> Sales <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if ($page->title == 'Events' || $page->title == 'Event Tags' || $page->title == 'Event Types') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("events") ?>">
                                <i class='bx bx-fw bx-calendar-event'></i> Events
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Jobs' || $page->title == 'Job Types' || $page->title == 'Job Tags' || $page->title == 'Bird Eye View' || $page->title == 'Checklist' || $page->title == 'Job Settings') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("job") ?>">
                                <i class='bx bx-fw bx-message-square-error'></i> Jobs
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Estimates' || $page->title == 'Plans' || $page->title == 'Estimate Settings') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("estimate") ?>">
                                <i class='bx bx-fw bx-chart'></i> Estimates
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Workorder' || $page->title == 'Workorder Settings' || $page->title == 'Workorder Checklist') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("workorder") ?>">
                                <i class='bx bx-fw bx-task'></i> Work Orders
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Invoices & Payments' || $page->title == 'Recurring Invoices' || $page->title == 'Tax Rates' || $page->title == 'Invoice Settings') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("invoice") ?>">
                                <i class='bx bx-fw bx-receipt'></i> Invoices
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Tickets') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer/ticketslist") ?>">
                                <i class='bx bx-fw bx-note'></i> Tickets
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("credit_notes") ?>">
                                <i class='bx bx-fw bx-file'></i> Credit Notes
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Leads Manager List') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer/leads") ?>">
                                <i class='bx bx-fw bx-notepad'></i> Leads
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Workorder Type') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("workstatus") ?>">
                                <i class='bx bx-fw bx-checkbox-square'></i> Status
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($page->title == 'Customers') : echo 'selected '; endif; ?> <?php if ($page->parent == 'Customers') : echo 'active'; endif; ?>">
                    <a href="<?= base_url("customer") ?>">
                        <i class='bx bx-fw bx-group'></i> Customers <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if ($page->title == 'Customer Subscriptions') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer/subscriptions") ?>">
                                <i class='bx bx-fw bx-user-pin'></i> Subscriptions
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Customer Groups') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer/group") ?>">
                                <i class='bx bx-fw bx-group'></i> Customer Groups
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Leads Manager List') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer/leads") ?>">
                                <i class='bx bx-fw bx-notepad'></i> Leads
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Sales Area' || $page->title == 'Lead Source' || $page->title == 'Lead Types' || $page->title == 'Rate Plans' || $page->title == 'Activation Fee' || $page->title == 'System Package Type' || $page->title == 'Headers') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer/settings_sales_area") ?>">
                                <i class='bx bx-fw bx-cog'></i> Customer Settings
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("accounting/banking") ?>">
                        <i class='bx bx-fw bx-calculator'></i> Accounting
                    </a>
                    <ul>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("vault") ?>">
                        <i class='bx bx-fw bx-folder'></i> Files Vault
                    </a>
                    <ul>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("vault/beforeafter") ?>">
                        <i class='bx bx-fw bx-camera'></i> Photos Gallery
                    </a>
                    <ul>
                    </ul>
                </li>
                <li class="<?php if ($page->title == 'Marketing Features' || $page->title == 'Survey Wizard' || $page->title == 'SMS Automation' || $page->title == 'Email Blast' || $page->title == 'Email Automation' || $page->title == 'Deals & Steals' || $page->title == 'My Inquiry List' || $page->title == 'Campaign 360') : echo 'selected ';
                            endif;
                            if ($page->parent == 'Marketing') : echo 'active';
                            endif; ?>">
                    <a href="<?= base_url("marketing") ?>">
                        <i class='bx bx-fw bx-bar-chart-square'></i> Marketing <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if ($page->title == 'Customers') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("customer") ?>">
                                <i class='bx bx-fw bx-group'></i> My Customers
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'SMS Blast') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("sms_campaigns") ?>">
                                <i class='bx bx-fw bx-chat'></i> SMS Blast
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Survey Wizard') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("survey") ?>">
                                <i class='bx bx-fw bx-list-check'></i> Survey
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'SMS Automation') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("sms_automation") ?>">
                                <i class='bx bx-fw bx-message-dots'></i> SMS Automation
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Email Blast') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("email_campaigns") ?>">
                                <i class='bx bx-fw bx-envelope'></i> Email Blast
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Email Automation') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("email_automation") ?>">
                                <i class='bx bx-fw bx-mail-send'></i> Email Automation
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Deals & Steals') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("promote/deals") ?>">
                                <i class='bx bx-fw bx-purchase-tag-alt'></i> Deals and Steals
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Campaign 360') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("campaign") ?>">
                                <i class='bx bx-fw bx-map-pin'></i> Campaign 360
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'My Inquiry List') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("my_inquires") ?>">
                                <i class='bx bx-fw bx-help-circle'></i> My Inquiry List
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($page->title == 'Business Tools') : echo 'selected ';
                            endif;
                            if ($page->parent == 'Tools') : echo 'active';
                            endif; ?>">
                    <a href="#">
                        <i class='bx bx-fw bx-extension'></i> Tools <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li class="<?php if ($page->title == 'Business Tools' || $page->title == 'API Connectors' || $page->title == 'Google Contacts' || $page->title == 'Quickbooks Payroll' || $page->title == 'Nice Job' || $page->title == 'MailChimp' || $page->title == 'Active Campaign' || $page->title == 'API Integration') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("tools/business_tools") ?>">
                                <i class='bx bx-fw bx-wrench'></i> Business Tools
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'eSign Tools') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("esignmain") ?>">
                                <i class='bx bx-fw bx-palette'></i> eSign
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Affiliate Partners' || $page->title == 'Affiliates Stats Dashboard') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("affiliate") ?>">
                                <i class='bx bx-fw bx-group'></i> Affiliates
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Inventory' || $page->title == 'Services' || $page->title == 'Fees' || $page->title == 'Vendors' || $page->title == 'Item Categories') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("inventory") ?>">
                                <i class='bx bx-fw bx-box'></i> Inventory
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'My Forms') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("fb") ?>">
                                <i class='bx bx-fw bx-add-to-queue'></i> Form Builder
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("tools/api_connectors") ?>">
                                <i class='bx bx-fw bx-code-alt'></i> API Connectors
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("tools/api_connectors") ?>">
                                <i class='bx bx-fw bx-mobile-alt'></i> Mobile Tools
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url("trac360") ?>">
                                <i class='bx bx-fw bx-navigation'></i> Trac 360
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if ($page->title == 'Company') : echo 'selected ';
                            endif;
                            if ($page->parent == 'Company') : echo 'active';
                            endif; ?>">
                    <a href="#">
                        <i class='bx bx-fw bx-buildings'></i> Company <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li>
                            <a href="<?= base_url("users/businessview") ?>">
                                <i class='bx bx-fw bx-building-house'></i> My Business
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Email Templates' || $page->title == 'SMS Templates' || $page->title == 'Email Branding' || $page->title == 'Notifications') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("settings/email_templates") ?>">
                                <i class='bx bx-fw bx-cog'></i> Settings
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'Employees' || $page->title == 'Timesheet' || $page->title == 'Track Location' || $page->title == 'Payscale') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("users") ?>">
                                <i class='bx bx-fw bx-user-pin'></i> Employees
                            </a>
                        </li>
                        <li class="<?php if ($page->title == 'My CRM' || $page->title == 'Cards File' || $page->title == 'Monthly Membership' || $page->title == 'Orders' || $page->title == 'Support') : echo 'selected';
                                    endif; ?>">
                            <a href="<?= base_url("mycrm") ?>">
                                <i class='bx bx-fw bx-book-content'></i> My CRM
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("settings/email_templates") ?>">
                        <i class='bx bx-fw bx-cog'></i> Settings
                    </a>
                    <ul>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        <i class='bx bx-fw bx-dots-vertical-rounded'></i> More <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
                    </a>
                    <ul class="mt-3">
                        <li>
                            <a href="<?= base_url("more/upgrades") ?>">
                                <i class='bx bx-fw bx-calendar-event'></i> Upgrades
                            </a>
                        </li>
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
                    <h4><?= $page->title ?></h4>
                    <?php
                    if ($page->title == 'Dashboard') :
                    ?>
                        <span>Welcome <?php echo getLoggedName(); ?>!</span>
                    <?php
                    else :
                    ?>
                        <?= $page->message; ?>
                    <?php
                    endif;
                    ?>
                </div>
                <div class="nsm-nav-items">
                    <ul>
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

                            try {
                                $UserTimeZone = new DateTimeZone($this->session->userdata('usertimezone'));
                            } catch (Exception $e) {
                                header("Location: " . base_url() . "/logout");
                            }

                            $checkin_date_time = "";
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
                                    } elseif ($log->attendance_id == $attn->id && $attn->status == 0) {
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
                            <input type="hidden" id="clockedin_date_time" value="<?= $checkin_date_time ?>">
                            <input type="hidden" id="attendance_status" value="<?= $attendance_status ?>">
                            <input type="hidden" id="overtime_status_acknowledgement" value="<?= $overtime_status_acknowledgement ?>">
                            <input type="hidden" id="break_duration_for_auto_out" value="<?= $break_duration_for_auto_out ?>">
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
                            <div class="dropdown dropdown-hover d-flex Btn" id="<?php echo $clock_btn ?>" data-allow-module="<?= $_SESSION['alert_class'] ?>">
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
                                        <h6 class="dropdown-header ms-auto"><?php echo $clock_out ?></h6>
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

                                        if (count($newtasks) > 0) :
                                            foreach ($newtasks as $task) :
                                        ?>
                                                <div class="list-item" onclick="location.href='<?php echo base_url('taskhub/view/' . $task->task_id); ?>'">
                                                    <span class="content-title"><?php echo $task->subject; ?></span>
                                                    <span class="content-subtitle">
                                                        <?php
                                                        $date_created = date_create($task->date_created);
                                                        echo date_format($date_created, "F d, Y h:i:s");
                                                        ?>
                                                    </span>
                                                </div>
                                            <?php
                                            endforeach;
                                        else :
                                            ?>
                                            <div class="text-center py-3">
                                                <span class="content-subtitle">No tasks for now.</span>
                                            </div>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item text-center" onclick="location.href='<?php echo base_url('taskhub') ?>'">
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
                                    <div class="list-item main-nav-item" id="<?php echo $clock_btn ?>">
                                        Clock In/Clock Out
                                    </div>
                                    <div class="list-item main-nav-item position-relative">
                                        Tasks <span class="nsm-badge badge-circle error">1</span>
                                    </div>
                                    <div class="list-item main-nav-item position-relative">
                                        Notifications <span class="nsm-badge badge-circle error">1</span>
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('profile') ?>'">
                                        Public Profile
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url() ?>'">
                                        nSmart Home
                                    </div>
                                    <div class="list-item">
                                        Join Our Community
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('activity_logs') ?>'">
                                        Activity Logs
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo base_url('settings/email_templates') ?>'">
                                        Settings
                                    </div>
                                    <div>
                                        <hr class="dropdown-divider">
                                    </div>
                                    <div class="list-item" onclick="location.href='<?php echo url('/logout') ?>'">
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