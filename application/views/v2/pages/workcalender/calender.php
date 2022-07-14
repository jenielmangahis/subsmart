<?php include viewPath('v2/includes/header'); ?>

<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/calendar_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            With Calendar, you can quickly schedule meetings and events and get reminders about upcoming activities, so you always know what’s next. Calendar is designed for teams, so it’s easy to share.
                        </div>
                    </div>
                </div>
                <form id="frm_calender_filter_events" method="post">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <?php
                            $aTimezone  = config_item('calendar_timezone');
                            $a_settings = unserialize($settings[0]->value);
                            if ($a_settings) {
                                if (isset($aTimezone[$a_settings['calendar_timezone']])) {
                                    $timezone = $aTimezone[$a_settings['calendar_timezone']];
                                }
                                //$timezone = $a_settings['calendar_timezone'];
                            } else {
                                $timezone = 'Central Time (UTC -5)';
                            }
                            ?>
                            <input type="hidden" id="time-zone-selector" value="<?= $timezone; ?>">
                            <label class="content-title mt-1 d-inline-block"><?= $timezone; ?> </label> <a href="<?= base_url('settings/schedule') ?>" class="nsm-link ms-3">Change</a>
                        </div>
                        <div class="col-12 col-md-8 grid-mb text-end">
                            <div class="nsm-page-buttons page-button-container">
                                <button type="button" class="nsm-button" id="btn_add_calendar">
                                    <i class='bx bx-fw bx-calendar-plus'></i> Add Calendar
                                </button>
                                <button type="button" class="nsm-button" onclick="location.href='<?= base_url('events/new_event') ?>'">
                                    <i class='bx bx-fw bx-calendar-event'></i> New Event
                                </button>
                                <button type="button" class="nsm-button" onclick="location.href='<?= base_url('job/new_job1') ?>'">
                                    <i class='bx bx-fw bx-message-square-error'></i> New Job
                                </button>

                                <?php if (!empty($users)) : ?>
                                    <div class="nsm-input-group ms-2">
                                        <div class="input-group">
                                            <select multiple="multiple" id="select-employee" class="multiple-select nsm-field form-select" placeholder="Select Employees">
                                                <?php foreach ($users as $user) { ?>
                                                    <option value="<?php echo $user->id ?>"><?php echo $user->FName ?> <?php echo $user->LName ?></option>
                                                <?php } ?>
                                            </select>
                                            <button class="nsm-button primary m-0" type="button" id="print_calender">
                                                <i class='bx bx-fw bx-printer'></i>
                                            </button>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="row g-3">
                            <div class="col-12 mb-3">
                                <div id='calendar'></div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Upcoming Jobs</span>
                                        </div>
                                        <div class="nsm-card-controls">
                                            <a role="button" class="nsm-button btn-sm m-0 px-4" href="<?php echo base_url('job'); ?>">
                                                See All
                                            </a>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content" id="upcoming_jobs_container"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Upcoming Events</span>
                                        </div>
                                        <div class="nsm-card-controls">
                                            <a role="button" class="nsm-button btn-sm m-0 px-4" href="<?php echo base_url('events'); ?>">
                                                See All
                                            </a>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content" id="upcoming_events_container">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Unscheduled Estimates</span>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content" id="unscheduled_estimates_container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#mini_calendar_collapse" aria-expanded="true" aria-controls="mini_calendar_collapse">
                                        Mini Calendar
                                    </button>
                                </h2>
                                <div id="mini_calendar_collapse" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div id="right-calendar"></div>
                                        <div class="calendar-tooltip"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#calendars" aria-expanded="false" aria-controls="calendars">
                                        Calendars
                                    </button>
                                </h2>
                                <div id="calendars" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <?php if (!empty($calendar_list)) : ?>
                                            <label class="content-subtitle">Which calendar entries do you wish to show</label>
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Main">Main</td>
                                                        <td data-name="Mini">Mini</td>
                                                        <td data-name="Calendar Name">Calendar Name</td>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($calendar_list)) :
                                                    ?>
                                                        <?php
                                                        foreach ($calendar_list as $calendar) :
                                                            $is_checked = "";
                                                            $is_mini_checked = "";

                                                            if (!empty($enabled_calendar)) {
                                                                if (in_array($calendar['id'], $enabled_calendar)) {
                                                                    $is_checked = 'checked="checked"';
                                                                }
                                                            }

                                                            if (!empty($enabled_mini_calendar)) {
                                                                if (in_array($calendar['id'], $enabled_mini_calendar)) {
                                                                    $is_mini_checked = 'checked="checked"';
                                                                }
                                                            }

                                                            $rowBgColor = '#38a4f8';
                                                            if ($calendar['backgroundColor'] != '') {
                                                                $rowBgColor = $calendar['backgroundColor'];
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td style="background-color: <?php echo $rowBgColor; ?>">
                                                                    <input class="form-check-input select-primary chk-calendar-entries" type="checkbox" <?php echo $is_checked; ?> data-id="<?php echo $calendar['id']; ?>">
                                                                </td>
                                                                <td style="background-color: <?php echo $rowBgColor; ?>">
                                                                    <input class="form-check-input select-primary chk-calendar-mini-entries" type="checkbox" <?php echo $is_mini_checked; ?> data-id="<?php echo $calendar['id']; ?>">
                                                                </td>
                                                                <td style="background-color: <?php echo $rowBgColor; ?>"><?php echo $calendar['summary']; ?></td>
                                                                <td style="background-color: <?php echo $rowBgColor; ?>">
                                                                    <!-- <a class="nsm-link default" title="Add Event" href="javascript:void(0);" data-id="<?php echo $calendar['id']; ?>">Edit</a> -->
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <tr>
                                                            <td colspan="4">
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
                                        <?php else : ?>
                                            <label class="content-subtitle">To enable mini calendar events filtering, bind your gmail account in <a class="nsm-link" href="<?= base_url('settings/schedule') ?>">Calendar Settings</a></label>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#recent_contacts" aria-expanded="false" aria-controls="recent_contacts">
                                        Recent Contacts
                                    </button>
                                </h2>
                                <div id="recent_contacts" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <table class="nsm-table">
                                            <thead>
                                                <tr>
                                                    <td class="table-icon"></td>
                                                    <td data-name="Name">Name</td>
                                                    <td data-name="Manage"></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($get_recent_users)) :
                                                ?>
                                                    <?php
                                                    foreach ($get_recent_users as $key => $recent_user) :
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <div class="nsm-profile">
                                                                    <?php
                                                                    if ($recent_user->profile_img != null) {
                                                                        $img_filename = userProfileImage($recent_user->id);
                                                                        $default_imp_img = $img_filename;
                                                                    } else {
                                                                        $default_imp_img = base_url('uploads/users/default.png');
                                                                    }
                                                                    ?>
                                                                    <div class="nsm-profile" style="background-image: url('<?php echo $default_imp_img ?>');"></div>
                                                                </div>
                                                            </td>
                                                            <td class="nsm-text-primary">
                                                                <label class="content-title"><?php echo $recent_user->FName . " " . $recent_user->LName  ?></label>
                                                                <label class="content-subtitle"><?php echo $recent_user->email ?></label>
                                                            </td>
                                                            <td class="text-end">
                                                                <a class="nsm-button btn-sm" href="tel:<?= $recent_user->phone; ?>"><i class='bx bxs-phone'></i></a>
                                                                <a class="nsm-button btn-sm" href="mailto:<?= $recent_user->email; ?>"><i class='bx bx-mail-send'></i></a>
                                                                <a class="nsm-button btn-sm" target="_blank" href="<?= base_url('workcalender/print_contact/' . $recent_user->id); ?>"><i class='bx bx-printer'></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    endforeach;
                                                    ?>
                                                <?php
                                                else :
                                                ?>
                                                    <tr>
                                                        <td colspan="3">
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
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#wait_list" aria-expanded="false" aria-controls="wait_list">
                                        Wait List
                                    </button>
                                </h2>
                                <div id="wait_list" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-12 text-end">
                                                <button type="button" class="nsm-button m-0 primary" id="btn_add_wait_list">
                                                    <i class='bx bx-fw bx-plus'></i> Add Wait List
                                                </button>
                                            </div>
                                            <div class="col-12">
                                                <div id="wait_list_container"></div>
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
</div>

<script type="text/javascript">
    var calendar;

    $(document).ready(function() {
        $('.multiple-select').multipleSelect();

        reloadCalendar();
        loadMiniCalendar();
        loadWaitList();
        loadUpcomingJobs();
        loadUpcomingEvents();
        loadUnscheduledEstimates();

        $("#print_calender").on("click", function() {
            var defaultView = calendar.view.type;
            var defaultDate = calendar.view.type;

            window.open("<?php echo base_url('workcalender/print_calender') ?>" + '?default_view=' + defaultView, '_blank');
        });

        $(document).on("click", ".uevent-view-details", function() {
            let event_id = $(this).attr("data-event-id");
            let event_type = $("#" + event_id + "-event-type").val();
            let event_title = $("#" + event_id + "-event-title").val();
            let event_start_date = $("#" + event_id + "-event-start-date").val();
            let event_end_date = $("#" + event_id + "-event-end-date").val();

            // $("#modalEventDetails").modal('show');

            // if (event_type == 'events') {
            //     var url = base_url + 'event/modal_details/' + event_id;
            //     $.ajax({
            //         url: url,
            //         data: '',
            //         beforeSend: function() {
            //             $('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
            //         },
            //         success: function(response) {

            //             // console.log(response);
            //             $(".btn-event-edit").show();
            //             $(".btn-event-delete").show();
            //             $(".btn-event-edit-workorder").show();
            //             $("#modalEventDetails").find('.modal-body').html(response);
            //         }
            //     });
            // } else {
            //     var url = base_url + 'workcalender/modal_gevent_details';
            //     var gData = {
            //         'gevent_id': event_id,
            //         'title': event_title,
            //         'start_date': event_start_date,
            //         'end_date': event_end_date,
            //     };

            //     $.ajax({
            //         url: url,
            //         type: "POST",
            //         data: gData,
            //         beforeSend: function() {
            //             $('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
            //         },
            //         success: function(response) {

            //             // console.log(response);
            //             $(".btn-event-edit").hide();
            //             $(".btn-event-delete").hide();
            //             $(".btn-event-edit-workorder").hide();
            //             $("#modalEventDetails").find('.modal-body').html(response);
            //         }
            //     });

            // }
        });
    });

    function reloadCalendar() {
        let _calendar = document.getElementById('calendar');
        let _timezone = document.getElementById('time-zone-selector');
        let events = "<?php echo json_encode($events) ?>";
        let customer_events = "<?php echo json_encode($resources_user_events) ?>";

        renderCalendar(_calendar, _timezone, events);
    }

    function renderCalendar(_calendar, _timezone, events) {
        let bc_events_url = "<?= base_url('calendar/_get_main_calendar_events') ?>";
        let bc_resources_url = "<?= base_url('calendar/_get_main_calendar_resources') ?>";
        let bc_resource_users_url = "<?= base_url('calendar/_get_main_calendar_resource_users') ?>";
        let scrollTime = moment().format("HH") + ":00:00";

        calendar = new FullCalendar.Calendar(_calendar, {
            schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
                center: 'employeeTimeline,monthView,dayView,threeDaysView,weekView,listView' // buttons for switching between views
            },
            themeSystem: 'bootstrap5',
            eventDisplay: 'block',
            contentHeight: 750,
            initialView: 'employeeTimeline',
            views: {
                employeeTimeline: {
                    type: 'resourceTimeGridDay',
                    buttonText: 'Employee',
                    allDaySlot: false,
                    nowIndicator: true,
                    slotDuration: '00:15',
                    slotLabelInterval: '01:00',
                    scrollTime: scrollTime
                },
                dayView: {
                    type: 'timeGridDay',
                    nowIndicator: true,
                    allDaySlot: false,
                    buttonText: 'Day',
                    slotDuration: '00:15',
                    slotLabelInterval: '01:00'
                },
                monthView: {
                    type: 'dayGridMonth',
                    buttonText: 'Month'
                },
                weekView: {
                    type: 'timeGridWeek',
                    buttonText: 'Week',
                    allDaySlot: false,
                    slotDuration: '00:15',
                    slotLabelInterval: '01:00'
                },
                listView: {
                    type: 'listWeek',
                    buttonText: 'List'
                },
                threeDaysView: {
                    type: 'resourceTimeGrid',
                    //type: 'timeGrid',
                    datesAboveResources: true,
                    allDaySlot: false,
                    slotLabelFormat: [{
                        hour: 'numeric',
                        minute: 'numeric',
                        meridiem: true
                    }],
                    nowIndicator: true,
                    expandRows: true,
                    buttonText: '3 days',
                    duration: {
                        days: 3
                    },
                    slotDuration: '00:15',
                    slotLabelInterval: '01:00',
                    scrollTime: scrollTime
                },
                displayEventEnd: true,
                allDaySlot: false,
                //timeFormat: 'h(:mm)a'
            },
            dayCellDidMount(info) {
                $(info.el).find('.fc-daygrid-day-top').popover({
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body',
                    html: true,
                    content: '<i class="bx bx-plus"></i> Create an Appointment',
                });

                $('.fc-timegrid-slot:before').popover({
                    placement: 'left',
                    trigger: 'hover',
                    container: 'body',
                    html: true,
                    content: '<i class="bx bx-plus"></i> Create an Appointment',
                });
            },
            selectable: true,
            select: function(info) {
                //console.log(info);
                //alert('selected ' + info.startStr + ' to ' + info.endStr);
                let result = info.hasOwnProperty('resource');
                if (result) {
                    var user_id = info.resource._resource.id;
                    user_id = user_id.replace("user", "");
                    var user_name = info.resource._resource.extendedProps.employee_name;
                } else {
                    var user_id = 0;
                    var user_name = '';
                }


                if (user_id > 0) {
                    var $newOption = $("<option selected='selected'></option>").val(user_id).text(user_name)
                    $("#appointment-user").append($newOption).trigger('change');
                } else {
                    $("#appointment-user").empty().trigger('change');
                }

                $(".appointment-date").val(moment(info.startStr).format('dddd, MMMM DD, YYYY'));
                $(".appointment-time").val(moment(info.startStr).format('hh:mm A'));
                $("#appointment-customer").empty().trigger('change');
                $("#appointment-tags").empty().trigger('change');
                $("#modal-create-appointment").modal('show');
            },
            slotEventOverlap: false,
            resourceLabelDidMount: function(info) {
                //console.log(info);
                let img = document.createElement('img');
                img.src = info.resource.extendedProps.imageurl;
                img.setAttribute("class", "datagrid-image");
                info.el.prepend(img);
            },
            eventContent: function(eventInfo) {
                return {
                    html: eventInfo.event.extendedProps.customHtml
                }
            },
            defaultDate: "<?php echo date('Y-m-d'); ?>",
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function(arg) {
                //console.log(arg);
                //console.log(arg.draggedEl.dataset.event);

                var url = base_url + "calendar/_update_calendar_drop_waitlist";
                var wid = arg.draggedEl.dataset.event;
                var start_date = moment(arg.date).format('dddd, MMMM DD, YYYY hh:mm A');
                var user_id = 0;

                if (arg.hasOwnProperty('resource')) {
                    if (arg.resource != null) {
                        var user_id = arg.resource._resource.id;
                        user_id = user_id.replace("user", "");
                    }
                }

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        wid: wid,
                        start_date: start_date,
                        user_id: user_id
                    },
                    dataType: 'json',
                    success: function(o) {
                        if (o.is_error == 1) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cannot update wait list',
                                text: o.msg
                            });
                            //arg.draggedEl.parentNode.removeChild(arg.draggedEl);                  
                        } else {
                            Swal.fire({
                                title: 'Success',
                                text: 'Appointment was successfully created.',
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonColor: '#32243d',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ok'
                            });

                            reloadCalendar();
                            loadWaitList();
                        }
                    }
                });
            },
            eventDrop: function(info) {
                //alert(info.event.extendedProps.eventType);
                //alert(info.event.title + " was dropped on " + info.event.start.toDateString());

                let result = info.hasOwnProperty('newResource');
                if (result.newResource != null) {
                    var user_id = info.newResource._resource.id;
                    user_id = user_id.replace("user", "");
                } else {
                    var user_id = 0;
                }

                if (info.event.extendedProps.eventType != 'google_events') {
                    var start_date = moment(info.event.start).format('dddd, MMMM DD, YYYY HH:mm:ss');
                    if (info.event.end !== null) {
                        var end_date = moment(info.event.end).format('dddd, MMMM DD, YYYY HH:mm:ss');
                    } else {
                        var end_date = start_date;
                    }

                    var event_id = info.event.extendedProps.eventId;
                    var event_type = info.event.extendedProps.eventType;
                    var url = base_url + 'calendar/_update_drop_event';

                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            event_id: event_id,
                            event_type: event_type,
                            start_date: start_date,
                            end_date: end_date,
                            user_id: user_id
                        },
                        dataType: 'json',
                        success: function(o) {

                        }
                    });
                } else {
                    var start_date = moment(info.event.start).format('dddd, MMMM DD, YYYY');
                    if (info.event.end !== null) {
                        var end_date = moment(info.event.end).format('dddd, MMMM DD, YYYY');
                    } else {
                        var end_date = start_date;
                    }

                    var event_id = info.event.extendedProps.geventID;
                    var calendar_id = info.event.extendedProps.calendarID;
                    var url = base_url + 'calendar/_update_drop_google_event';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            event_id: event_id,
                            calendar_id: calendar_id,
                            start_date: start_date,
                            end_date: end_date
                        },
                        dataType: 'json',
                        success: function(o) {
                            if (o.is_success == false) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'This calendar is read-only. Cannot change start and end date.',
                                    text: o.msg
                                });
                                info.revert();
                            }
                        }
                    });
                }
            },
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function(arg) {
                var apiUrl = '';
                var isGet = 1;
                if (typeof arg.event._def.extendedProps.eventId != 'undefined') {
                    //alert(arg.event._def.extendedProps.eventType);
                    if (arg.event._def.extendedProps.eventType == 'jobs') {
                        location.href = base_url + 'job/job_preview/' + arg.event._def.extendedProps.eventId;
                    } else if (arg.event._def.extendedProps.eventType == 'booking') {
                        location.href = base_url + 'promote/view_booking/' + arg.event._def.extendedProps.eventId;
                    } else if (arg.event._def.extendedProps.eventType == 'appointments') {
                        viewAppointment(arg.event._def.extendedProps.eventId);
                    } else {
                        location.href = base_url + 'events/event_preview/' + arg.event._def.extendedProps.eventId;
                    }
                } else if (typeof arg.event._def.extendedProps.geventID != 'undefined') {
                    window.open(
                        arg.event._def.extendedProps.googleCalendarLink,
                        '_blank' // <- This is what makes it open in a new window.
                    );
                }
            },
            loading: function(isLoading) {
                if (isLoading) {
                    $(".left-calendar-loading").html('<div class="alert alert-info" role="alert"><img src="' + base_url + '/assets/img/spinner.gif" style="display:inline;" /> Loading Events...</div>');
                } else {
                    $(".left-calendar-loading").html('');
                }

            },
            resourceAreaColumns: [{
                field: 'title',
                headerContent: 'Employees',
            }],
            resources: {
                url: bc_resource_users_url,
                method: 'POST'
            },
            events: {
                url: bc_events_url,
                method: 'POST'
            },
            eventOrder: ["starttime"],
            datesSet: function(info) {
                if (info.view.type == "threeDaysView") {
                    let resources = $(".fc-col-header-cell.fc-resource");
                    $(".fc-scrollgrid-sync-inner").addClass("d-none");
                    $.each(resources, function(i, o) {
                        let _image = $(this).find(".datagrid-image");
                        let _title = $(this).find(".fc-col-header-cell-cushion ");

                        _image.attr("data-bs-toggle", "popover");
                        _image.attr("data-bs-trigger", "hover focus");
                        _image.attr("data-bs-placement", "bottom");
                        _image.attr("data-bs-content", _title.text());
                    });
                    initPopover();
                } else {
                    $(".fc-scrollgrid-sync-inner").removeClass("d-none");
                }
            }
        });

        calendar.render();

        // $(".fc-prev-button").html("<i class='bx bx-chevron-left'></i>");
        // $(".fc-next-button").html("<i class='bx bx-chevron-right'></i>");
    }

    function loadMiniCalendar() {
        let events_url = "<?= base_url('settings/_get_google_enabled_calendars') ?>";
        let _calendar = document.getElementById('right-calendar');

        var calendar = new FullCalendar.Calendar(_calendar, {
            schedulerLicenseKey: '0531798248-fcs-1598103289',
            initialView: 'dayGridMonth',
            events: {
                url: events_url,
                method: 'POST'
            },
            loading: function(isLoading) {
                if (isLoading) {
                    $(".right-calendar-loading").html('<div class="alert alert-info" role="alert"><img src="' + base_url + '/assets/img/spinner.gif" style="display:inline;" /> Loading Events...</div>');
                } else {
                    $(".right-calendar-loading").html('');
                }

            },
            eventDidMount: function(info) {
                var tooltip = new Tooltip(info.el, {
                    title: info.event.extendedProps.description,
                    placement: 'top',
                    trigger: 'hover',
                    html: true,
                    container: '.calendar-tooltip'
                });
            },
        });

        calendar.render();
    }

    function loadWaitList() {
        let url = "<?= base_url('calendar/_load_wait_list') ?>";
        let _container = $("#wait_list_container");
        showLoader(_container);

        $.ajax({
            type: 'POST',
            url: url,
            success: function(result) {
                _container.hide().html(result).fadeIn(800);
            },
        });
    }

    function loadUpcomingJobs() {
        let url = "<?= base_url('job/_load_upcoming_jobs') ?>";
        let _container = $("#upcoming_jobs_container");

        showLoader(_container);

        $.ajax({
            type: 'POST',
            url: url,
            data: {},
            success: function(result) {
                _container.html(result);
                $("#upcoming_jobs_table").nsmPagination();
            },
        });
    }

    function loadUpcomingEvents() {
        let url = "<?= base_url('calendar/_load_upcoming_events') ?>";
        let _container = $("#upcoming_events_container");

        showLoader(_container);

        $.ajax({
            type: 'POST',
            url: url,
            data: {},
            success: function(result) {
                _container.html(result);
                $("#upcoming_events_table").nsmPagination();
            },
        });
    }

    function loadUnscheduledEstimates() {
        let url = "<?= base_url('estimate/_load_scheduled_estimates') ?>";
        let _container = $("#unscheduled_estimates_container");

        showLoader(_container);

        $.ajax({
            type: 'POST',
            url: url,
            data: {},
            success: function(result) {
                _container.html(result);
                $("#estimates_table").nsmPagination();
            },
        });
    }

    function initPopover() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    }
</script>
<?php include viewPath('v2/includes/footer'); ?>