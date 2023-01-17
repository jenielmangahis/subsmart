<script>
var calendar_modal_source = 'upcoming-list';
$(function(){    
    $('.btn-quick-access-calendar-schedule').on('click', function(){
        $('#modal-quick-access-calendar-schedule').modal('show');
        calendar_modal_source = 'calendar';
    });

    function reloadQuickAccessCalendarSchedule() {
        var _calendar = document.getElementById('quick-access-calendar-schedule');
        var events = '';
        var customer_events = '';

        renderCalendar(_calendar, events);
    }

    function renderCalendar(_calendar, events) {
        var bc_events_url = "<?= base_url('calendar/_quick_view_calendar_events') ?>";
        var bc_resource_users_url = "<?= base_url('calendar/_get_main_calendar_resource_users') ?>";
        var scrollTime = moment().format("HH") + ":00:00";

        calendar = new FullCalendar.Calendar(_calendar, {
            schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
                center: 'monthView,dayView,listView' // buttons for switching between views
            },
            themeSystem: 'bootstrap5',
            eventDisplay: 'block',
            contentHeight: 750,
            initialView: 'monthView',  
            progressiveEventRendering: false,  
            views: {
                dayView: {
                    type: 'timeGridDay',
                    nowIndicator: true,
                    allDaySlot: false,
                    buttonText: 'Day',
                    slotDuration: '00:15',
                    editable: true,
                    droppable: true,
                    slotLabelInterval: '01:00'
                },
                monthView: {
                    type: 'dayGridMonth',
                    buttonText: 'Month',
                    editable: true,
                    droppable: true
                },
                listView: {
                    type: 'listWeek',
                    buttonText: 'List',
                    editable: false,
                    droppable: false
                },
                displayEventEnd: true,
                allDaySlot: false,
                //timeFormat: 'h(:mm)a'
            },
            eventDidMount : function(info) { 
            },  
            dayCellDidMount(info) {                         
                /*$(info.el).find(".fc-daygrid-day-top").attr("data-bs-toggle", "popover");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-trigger", "hover focus");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-placement", "top");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-content", "<i class='bx bxs-calendar-plus'></i> Create Appointment");

                $('.fc-timegrid-slot:before').attr("data-bs-toggle", "popover");
                $('.fc-timegrid-slot:before').attr("data-bs-trigger", "hover focus");
                $('.fc-timegrid-slot:before').attr("data-bs-placement", "top");
                $('.fc-timegrid-slot:before').attr("data-bs-content", "<i class='bx bxs-calendar-plus'></i> Create Appointment");

                initPopover();*/
            },
            selectable: true,
            slotEventOverlap: true,
            eventOverlap: true,
            select: function(info) {  
                /*var url = base_url + "calendar/_appointment_quick_add_form";                              
                var result = info.hasOwnProperty('resource');
                var date_selected = moment(info.startStr).format('YYYY-MM-DD');

                $('#modal-quick-access-calendar-schedule').modal('hide');
                $('#modal-quick-add-appointment').modal('show');
                showLoader($("#modal-quick-add-appointment .modal-body"));        

                setTimeout(function () {
                  $.ajax({
                     type: "POST",
                     url: url,
                     data: {date_selected:date_selected},
                     success: function(o)
                     {          
                        $("#modal-quick-add-appointment .modal-body").html(o);
                     }
                  });
                }, 500);*/
            },
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
            //eventOrder: ["starttime"],
        });

        calendar.render();
    }

    function initPopover() {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl,{html: true})
        })
    }

    $('#modal-quick-access-calendar-schedule').on('shown.bs.modal', function (e) {
        //showLoader($("#quick-access-calendar-schedule")); 
        setTimeout(function () {
          reloadQuickAccessCalendarSchedule();
        }, 800);
      
    });

    $('#modal-quick-access-calendar-schedule').on('hidden.bs.modal', function (e) {
        $("#quick-access-calendar-schedule").html('');      
    });

    $('#modal-quick-view-upcoming-schedule').on('hidden.bs.modal', function (e) {
        if( calendar_modal_source == 'calendar' ){
            $('#modal-quick-access-calendar-schedule').modal('show');
        }        
    });

    $(document).on('click', '.quick-calendar-tile', function(){
        var appointment_type = $(this).data('type');
        var appointment_id   = $(this).data('id');

        $('#upcoming-schedule-view-more-details').attr('data-type', appointment_type);
        $('#upcoming-schedule-view-more-details').attr('data-id', appointment_id);

        $('#upcoming-schedule-view-more-details').attr('data-type', appointment_type);
        $('#edit-upcoming-schedule').attr('data-id', appointment_id);
        
        if( appointment_type == 'job' ){
            var url = base_url + "job/_quick_view_details";
        }else if( appointment_type == 'ticket' ){
            var url = base_url + "ticket/_quick_view_details";
        }else if( appointment_type == 'tc-off' ){
            var url = base_url + "calendar/_quick_view_tc_off";
        }else{
            var url = base_url + "calendar/_view_appointment";
        }
        
        $('#modal-quick-access-calendar-schedule').modal('hide');
        $('#modal-quick-view-upcoming-schedule').attr('data-source', 'calendar');
        $('#modal-quick-view-upcoming-schedule').modal('show');
        showLoader($(".view-schedule-container"));        

        setTimeout(function () {
          $.ajax({
             type: "POST",
             url: url,
             data: {appointment_id:appointment_id},
             success: function(o)
             {          
                $(".view-schedule-container").html(o);
             }
          });
        }, 500);
    });

    $(document).on('click', '#edit-upcoming-schedule', function(){
        var schedule_id   = $(this).data('id');
        var schedule_type = $(this).data('type');

        if( schedule_type == 'job' ){
            location.href = base_url + 'job/new_job1/' + schedule_id;
        }else if( schedule_type == 'ticket' ){
            location.href = base_url + 'tickets/editDetails/' + schedule_id;
        }
    });
});
</script>