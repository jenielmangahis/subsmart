<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/timesheet/timesheet_modals'); ?>

<style>
    .swal2-image {
        height: 120px;
        width: 120px;
        border-radius: 50%;
    }
</style>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/employees_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12 text-end py-3">
                        <?php date_default_timezone_set(logged("role")); ?>
                        <label class="content-title"><span class="text-muted">Today:</span> <?php echo date('M d, Y') . " " ?></label>
                    </div>
                </div>
                <div class="row g-3">
                    <?php // if (logged("role") < 5) : 
                    ?>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-time"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?php echo $in_now; ?></h2>
                                    <span>In Now</span>

                                    <div class="progress nsm-progress primary mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round(100 * ($in_now / $total_users), 2) . '%'; ?>;" aria-valuenow="<?php echo $in_now; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-cake"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?= $on_lunch ?></h2>
                                    <span>On Lunch</span>

                                    <div class="progress nsm-progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round(100 * ($on_lunch / $total_users), 2) . '%'; ?>;" aria-valuenow="<?php echo $on_lunch; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-calendar-exclamation"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?php echo $no_logged_in; ?></h2>
                                    <span>Not Logged-in</span>

                                    <div class="progress nsm-progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round(100 - ((($total_users - $no_logged_in) / $total_users) * 100), 2) . '%'; ?>;" aria-valuenow="<?php echo $no_logged_in; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-user"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?php echo $total_users; ?></h2>
                                    <span>Employees</span>

                                    <div class="progress nsm-progress success mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter success h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-notepad"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?= $manual_checkins ?></h2>
                                    <span>Manual Check Ins</span>

                                    <div class="progress nsm-progress success mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round(($manual_checkins / $total_users) * 100, 2) . '%'; ?>;" aria-valuenow="<?php echo $manual_checkins; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter secondary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-time-five"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?= count($on_leave) ?></h2>
                                    <span>Late Check Ins</span>

                                    <div class="progress nsm-progress secondary mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round((count($on_leave) / $total_users) * 100, 2) . '%'; ?>;" aria-valuenow="<?php echo count($on_leave); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bx-calendar-event"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2><?= count($on_leave) ?></h2>
                                    <span>On Leave</span>

                                    <div class="progress nsm-progress mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: <?php echo round((count($on_leave) / $total_users) * 100, 2) . '%'; ?>;" aria-valuenow="<?php echo count($on_leave); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="nsm-counter primary h-100 mb-2">
                            <div class="row h-100">
                                <div class="col-12 col-md-4 d-flex justify-content-center align-items-center">
                                    <i class="bx bxs-user-badge"></i>
                                </div>
                                <div class="col-12 col-md-8 text-center text-md-start d-flex flex-column justify-content-center">
                                    <h2>0</h2>
                                    <span>Contractors</span>

                                    <div class="progress nsm-progress primary mt-2">
                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <table class="nsm-table" id="employees_table">
                            <thead>
                                <tr>
                                    <td class="table-icon"></td>
                                    <td data-name="Employee Name">Employee Name</td>
                                    <td data-name="In">In</td>
                                    <td data-name="Out">Out</td>
                                    <td data-name="Lunch In">Lunch In</td>
                                    <td data-name="Lunch Out">Lunch Out</td>
                                    <td data-name="Comments/Location">Comments/Location</td>
                                    <td data-name="Manage"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($users)) :
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
                                    <?php
                                    foreach ($users as $cnt => $user) :
                                        $user_photo = userProfileImage($user->id);
                                        $company_id = $user->company_id;
                                        foreach ($user_roles as $role) :
                                            if ($role->id == $user->role) :
                                                $u_role = $role->title;
                                            endif;
                                        endforeach;

                                        foreach ($attendance as $attn) :
                                            foreach ($logs as $log) :
                                                if ($user->id == $attn->user_id) :
                                                    $attn_id = $attn->id;
                                                    if ($attn_id == $log->attendance_id) :
                                                        // var_dump("<br>".date('Y-m-d', strtotime($log->date_created)));
                                                        date_default_timezone_set('UTC');
                                                        // var_dump(date('Y-m-d', strtotime('yesterday')));

                                                        if (date('Y-m-d', strtotime($log->date_created)) == date('Y-m-d', strtotime('yesterday'))) :
                                                            $yesterday_in = "(Yesterday)";
                                                        else :
                                                            $yesterday_in = null;
                                                        endif;
                                                        $date_created = $log->date_created;
                                                        date_default_timezone_set('UTC');
                                                        $datetime_defaultTimeZone = new DateTime($date_created);
                                                        $datetime_defaultTimeZone->setTimezone($UserTimeZone);
                                                        $log->date_created = $datetime_defaultTimeZone->format('Y-m-d H:i:s');
                                                        date_default_timezone_set($this->session->userdata('usertimezone'));
                                                        if ($log->action == 'Check in') :
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
                                                        endif;
                                                        if ($log->action == 'Break in') :
                                                            $break_id = 'employeeBreakOut';
                                                            $status = 'fa-cutlery';
                                                            $break_in = date('h:i A', strtotime($log->date_created));
                                                            $indicator_in = 'display:none';
                                                            $indicator_out = 'display:none';
                                                            $indicator_in_break = 'display:block';
                                                            $indicator_out_break = 'display:none';
                                                            $tooltip_status = 'On break';
                                                            $break_out = null;
                                                        endif;
                                                        if ($log->action == 'Break out') :
                                                            $status = 'fa-check';
                                                            $break_out = date('h:i A', strtotime($log->date_created));
                                                            //                                                                    $break = 'disabled="disabled"';
                                                            $break_id = 'employeeBreakIn';
                                                            $indicator_in = 'display:none';
                                                            $indicator_out = 'display:none';
                                                            $indicator_in_break = 'display:none';
                                                            $indicator_out_break = 'display:block';
                                                            $tooltip_status = 'Back to work';
                                                        endif;
                                                        if ($log->action == 'Check out') :
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
                                                        endif;
                                                    endif;
                                                endif;
                                            endforeach;
                                        endforeach;
                                    ?>
                                        <tr>
                                            <td>
                                                <div class="nsm-profile">
                                                    <span><?php echo $user->FName[0] . $user->LName[0]; ?></span>
                                                </div>
                                            </td>
                                            <td class="nsm-text-primary">
                                                <label class="d-block fw-bold"><?php echo $user->FName; ?> <?php echo $user->LName; ?></label>
                                                <label class="content-subtitle fst-italic d-block">Employee ID: <?php echo $user->id ?> | Role: <?php echo $u_role; ?></label>
                                            </td>
                                            <td>
                                                <span class="nsm-badge success clock-in-time in-indicator" style="<?php echo $indicator_in ?>"><?php echo $time_in ?></span>
                                                <?php if ($yesterday_in != "") : ?>
                                                    <span class="nsm-badge success clock-in-yesterday ms-1"><?php echo $yesterday_in; ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="nsm-badge error clock-out-time out-indicator" style="<?php echo $indicator_out ?>"><?php echo $time_out ?></span>
                                            </td>
                                            <td>
                                                <span class="nsm-badge secondary break-in-time lunch-indicator" style="<?php echo $indicator_in_break ?>"><?php echo $break_in; ?></span>
                                            </td>
                                            <td>
                                                <span class="nsm-badge success break-out-time in-indicator" style="<?php echo $indicator_out_break ?>"><?php echo $break_out; ?></span>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div class="dropdown table-management">
                                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                                        <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item employee-break" href="javascript:void(0);" style="<?php if ($break_id == "") : ?>display: none;<?php endif; ?>" id="<?php echo $break_id ?>" data-id="<?php echo $user->id ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-approved="<?php echo logged("id"); ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>">
                                                                Lunch In/Out
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item employee-in-out" href="javascript:void(0);" <?php echo $disabled ?> id="<?php echo $btn_action; ?>" data-attn="<?php echo $attn_id; ?>" data-name="<?php echo $user->FName; ?> <?php echo $user->LName; ?>" data-id="<?php echo $user->id; ?>" data-approved="<?php echo logged("id"); ?>" data-photo="<?php echo $user_photo; ?>" data-company="<?php echo $company_id ?>">
                                                                Clock In/Out
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
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
                                    <?php
                                    endforeach;
                                    ?>
                                <?php
                                else :
                                ?>
                                    <tr>
                                        <td colspan="9">
                                            <div class="nsm-empty">
                                                <span>No results found.</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                        <input type="hidden" id="outCounter" value="<?php echo $out_count ?>">
                        <input type="hidden" id="inCounter" value="<?php echo $in_count ?>">
                    </div>
                    <?php // endif; 
                    ?>
                    <?php
                    if (logged("role") > 5) :
                        $lunch_active = null;
                        $employee_logs = getEmployeeLogs($attendance_id);
                        $employee_attn = getClockInSession();
                        $lunch_icon = 'static';
                        $lunch_disabled = 'disabled="disabled"';
                        foreach ($employee_attn as $attn) :
                            if ($attn->user_id == logged("id") && $attn->status == 1) :
                                foreach ($employee_logs as $log) :
                                    if ($attn->id == $log->attendance_id) :
                                        $lunch_disabled = null;
                                    endif;
                                    if ($attn->id == $log->attendance_id && $log->action == 'Break in') :
                                        $lunch_active = 'lunchOut';
                                        $lunch_icon = 'active';
                                    else :
                                        $lunch_active = 'lunchIn';
                                        $lunch_icon = 'static';
                                    endif;
                                endforeach;
                            endif;
                        endforeach;
                    ?>
                        <div class="col-12 col-md-4">
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
                            foreach ($emp_attendance as $attn) :
                                foreach ($emp_logs as $log) :
                                    if ($log->attendance_id == $attn->id) :
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
                                    endif;
                                endforeach;
                            endforeach;

                            //Employee's task
                            $task_name = '-';
                            $start_time = '-';
                            $end_time = '-';
                            $task_duration = '-';
                            $timezone = '-';
                            foreach ($schedules as $scheds) :
                                if ($scheds->user_id == logged("id")) :
                                    $unix_ts = time();
                                    $set_date = new DateTime("now", new DateTimeZone($timezone));
                                    $set_date->setTimestamp($unix_ts);
                                    foreach ($tasks as $task) :
                                        if ($task->ts_settings_id == $scheds->id && $task->start_date == $set_date->format('Y-m-d')) {
                                            $timezone = $scheds->timezone;
                                            $task_name = $scheds->project_name;
                                            $start_time = date('h:i A', strtotime($task->start_time));
                                            $end_time = date('h:i A', strtotime($task->end_time));
                                            $task_duration = $task->duration . "hour/s";
                                        }
                                    endforeach;
                                endif;
                            endforeach;
                            ?>
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>
                                            <?php
                                            if ($yesterday_note != null) :
                                                echo "Most recent logs";
                                            else :
                                                echo "Today's logs";
                                            endif;
                                            ?>
                                        </span>
                                    </div>
                                    <div class="nsm-card-controls">
                                        <a role="button" class="nsm-button btn-sm m-0" href="javascript:void(0);" id="<?php echo $lunch_active; ?>" <?php echo $lunch_disabled; ?>>
                                            Lunch In/Out
                                        </a>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row g-3 mb-1">
                                        <div class="col-12 col-md-4">
                                            <label class="content-title">Clock-in:</label>
                                        </div>
                                        <div class="col-12 col-md-4 text-muted text-end"><?php echo $yesterday_note ?></div>
                                        <div class="col-12 col-md-4 text-end" id="userClockIn"><?php echo $clock_in; ?></div>
                                    </div>
                                    <div class="row g-3 mb-1">
                                        <div class="col-12 col-md-4">
                                            <label class="content-title">Clock-out:</label>
                                        </div>
                                        <div class="col-12 col-md-8 text-end" id="userClockOut"><?php echo $clock_out ?></div>
                                    </div>
                                    <div class="row g-3 mb-1">
                                        <div class="col-12 col-md-4">
                                            <label class="content-title">Lunch-in:</label>
                                        </div>
                                        <div class="col-12 col-md-8 text-end" id="userLunchIn"><?php echo $lunch_in ?></div>
                                    </div>
                                    <div class="row g-3 mb-1">
                                        <div class="col-12 col-md-4">
                                            <label class="content-title">Lunch-out:</label>
                                        </div>
                                        <div class="col-12 col-md-8 text-end" id="userLunchOut"><?php echo $lunch_out ?></div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12 col-md-4">
                                            <label class="content-title">Shift Duration:</label>
                                        </div>
                                        <div class="col-12 col-md-8 text-end" id="userShiftDuration"><?php echo $shift ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Remarks</span>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-3">
                                            <form action="#" target="_blank" method="POST">
                                                <label class="content-title">Week Date:</label>
                                                <input type="text" class="nsm-field form-control datepicker" name="date_from" id="week_attendance_remarks" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <table class="nsm-table" id="show_my_attendance_remarks">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Leave Requests</span>
                                    </div>
                                    <div class="nsm-card-controls">
                                        <a role="button" class="nsm-button btn-sm m-0" id="btn_request_leave" href="javascript:void(0);">
                                            Request for Leave
                                        </a>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <form action="#" target="_blank" method="POST">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">From:</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="date_from" id="from_date_leave_requests" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">To:</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="date_to" id="to_date_leave_requests" value="<?= date("m/d/Y") ?>">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Leave Date">Leave Date</td>
                                                        <td data-name="Date Filed">Date Filed</td>
                                                        <td data-name="Status">Status</td>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="my_leave_requests_body">
                                                    <tr>
                                                        <td class="nsm-text-primary">
                                                            <label class="d-block fw-bold">Sick Leave</label>
                                                            <label class="content-subtitle fst-italic d-block">06-28-2022</label>
                                                        </td>
                                                        <td>05-25-2022</td>
                                                        <td><span class="nsm-badge <?= $badge ?>">Pending</span></td>
                                                        <td><a href="javascript:void(0);" class="nsm-btn btn-sm" data-date-filed="" data-leave-type="" data-user-id="" data-leave-id="">Cancel</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Attendance Correction Requests</span>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <form action="#" target="_blank" method="POST">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">From:</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="date_from" id="from_date_correction_requests" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">To:</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="date_to" id="to_date_correction_requests" value="<?= date("m/d/Y") ?>">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Shift Date">Shift Date</td>
                                                        <td data-name="Login">Login</td>
                                                        <td data-name="Break">Break</td>
                                                        <td data-name="Worked Hours">Worked Hours</td>
                                                        <td data-name="Break Duration">Break Duration</td>
                                                        <td data-name="Request Status">Request Status</td>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="my_correction_requests">
                                                    <tr>
                                                        <td colspan="7">
                                                            <div class="nsm-empty"><span>No results found.</span></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Attendance Logs</span>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row g-3">
                                        <div class="col-12 col-md-6">
                                            <form action="#" target="_blank" method="POST">
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">From:</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="date_from" id="from_date_logs" value="<?= date('m/d/Y', strtotime('monday this week')) ?>">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label class="content-title">To:</label>
                                                        <input type="text" class="nsm-field form-control datepicker" name="date_to" id="to_date_logs" value="<?= date("m/d/Y") ?>">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-12">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Shift Date">Shift Date</td>
                                                        <td data-name="Shift Start">Shift Start</td>
                                                        <td data-name="Shift End">Shift End</td>
                                                        <td data-name="Expected Work Hours">Expected Work Hours</td>
                                                        <td data-name="Clock in">Clock In</td>
                                                        <td data-name="Clock Out">Clock Out</td>
                                                        <td data-name="Worked Hours">Worked Hours</td>
                                                        <td data-name="Late in minutes">Late in minutes</td>
                                                        <td data-name="Overtime">Overtime</td>
                                                        <td data-name="OT Status">OT Status</td>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody id="my-attendance-logs">
                                                    <tr>
                                                        <td colspan="11">
                                                            <div class="nsm-empty"><span>No results found.</span></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //Real-time capture of time
    let real_time;
    let total_users = "<?php echo $total_users; ?>";

    $(document).ready(function() {
        let total_user = $('#employeeTotal').val();

        $("#employees_table").nsmPagination();
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
        });

        $(document).on('click', '#employeeCheckIn', function() {
            let _this = $(this);
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
                confirmButtonText: 'Yes, Clock-in!',
                showCancelButton: true,
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.value) {
                    showSwalLoading();

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
                                $(selected).attr('id', 'employeeCheckOut');
                                $(selected).attr('data-company', data.company_id);

                                _this.closest("tr").find(".employee-break").hide();
                                _this.closest("tr").find(".clock-in-time").text(time);
                                _this.closest("tr").find(".clock-in-yesterday").text(null);
                                _this.closest("tr").find(".clock-in-time.in-indicator").show();
                                _this.closest("tr").find(".employee-break").attr("id", "employeeBreakIn");
                                _this.closest("tr").find(".break-in-time").text(null);
                                _this.closest("tr").find(".break-out-time").text(null);
                                _this.closest("tr").find(".clock-out-time").text(null);
                                _this.closest("tr").find(".out-indicator").hide();
                                clearTimeout(real_time);

                                Swal.fire({
                                    title: 'Success',
                                    html: "<strong>" + emp_name + "</strong> has been Clock-in",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Failed',
                                    text: "Something is wrong in the process. Please reload the page.",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }

                            app_notification(
                                data.token,
                                data.body,
                                data.device_type,
                                data.company_id,
                                data.title
                            );
                            get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");
                        }
                    });
                }
            });
        });

        $(document).on('click', '#employeeBreakIn', function() {
            let _this = $(this);
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
                confirmButtonText: 'Yes, take a lunch!',
                showCancelButton: true,
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.value) {
                    showSwalLoading();

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
                            if (data != null) {
                                $(selected).attr('id', 'employeeBreakOut');

                                _this.closest("tr").find(".break-in-time").text(data.time);
                                _this.closest("tr").find(".clock-in-time.in-indicator").hide();
                                _this.closest("tr").find(".lunch-indicator").show();
                                _this.closest("tr").find(".break-out-time.in-indicator").hide();
                                _this.closest("tr").find(".out-indicator").hide();
                                _this.closest("tr").find(".break-out-time").hide();

                                Swal.fire({
                                    title: 'Success',
                                    html: "<strong>" + emp_name + "</strong> is taking a break.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
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
                                    title: 'Failed',
                                    text: "Something is wrong in the process. Please reload the page.",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).on('click', '#employeeBreakOut', function() {
            let _this = $(this);
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
                confirmButtonText: 'Yes, back to work!',
                showCancelButton: true,
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.value) {
                    showSwalLoading();

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
                                $(selected).attr('id', 'employeeBreakIn');

                                _this.closest("tr").find(".employee-break").hide();
                                _this.closest("tr").find(".break-out-time").text(data.time);
                                _this.closest("tr").find(".lunch-indicator").hide();
                                _this.closest("tr").find(".clock-in-time.in-indicator").show();
                                _this.closest("tr").find(".break-out-time").show();

                                Swal.fire({
                                    title: 'Success',
                                    html: "<strong>" + emp_name + "</strong> is now back to work.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
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
                                    title: 'Failed',
                                    text: "Something is wrong in the process. Please reload the page.",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        }
                    });
                }
            });
        });

        $("#btn_request_leave").on("click", function() {
            $("#request_leave_modal").modal('show');
            loadLeaveTypes();
        });

        $("#request_leave_modal").on("shown.bs.modal", function() {
            $(".bootstrap-tagsinput input").datepicker({
                format: 'mm/dd/yyyy',
            });
        });

        $("#request_leave_form").on("submit", function(e) {
            e.preventDefault();

            let _this = $(this);
            let values = {};
            $.each(_this.serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            let date = values['leave_date'];
            let array = date.split(',');

            Swal.fire({
                title: 'Requesting Leave',
                text: "Are you sure you want this request?",
                icon: 'question',
                confirmButtonText: 'Yes',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '<?= base_url() ?>/timesheet/employeeRequestLeave',
                        method: "POST",
                        dataType: "json",
                        data: {
                            values: values,
                            array: array
                        },
                        success: function(data) {
                            if (data == 1) {
                                Swal.fire({
                                    title: 'Success',
                                    html: "Your leave request has been sent!",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            } else {
                                Swal.fire({
                                    title: 'Failed',
                                    text: "Something is wrong in the process. Please reload the page.",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }

                            $("#request_leave_modal").modal('hide');
                            _this.trigger("reset");
                        }
                    });
                }
            });
        });

        $("#request_adjustment_modal").on("shown.bs.modal", function() {
            $(".datetime").datetimepicker({
                format: 'hh:mm a'
            });
        });
    });

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

    function inNow() {
        $.ajax({
            url: "/timesheet/inNow",
            dataType: "json",
            success: function(data) {
                $('#employee-in-now').text(data);
                let percentage = (data / total_user) * 100;
                $('#progressInNow').attr('aria-valuenow', percentage.toFixed(2)).css('width',
                    percentage.toFixed(2) + '%').text(percentage.toFixed(2) + '%');
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
                $('#progressOutNow').attr('aria-valuenow', percentage.toFixed(2)).css('width',
                    percentage.toFixed(2) + '%').text(percentage.toFixed(2) + '%');
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
                $('#progressNotLoggedIn').attr('aria-valuenow', percentage.toFixed(2)).css(
                    'width', percentage.toFixed(2) + '%').text(percentage.toFixed(2) + '%');
            }
        });
    }

    function loadLeaveTypes() {
        let _inputField = $("select[name=pto]");
        $.ajax({
            url: '<?= base_url() ?>/timesheet/getPTOList',
            method: "GET",
            dataType: "json",
            success: function(result) {
                $.each(result, function(i, obj) {
                    _inputField.append("<option value='" + obj.id + "'>" + obj.text + "</option>");
                });
            }
        });
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>