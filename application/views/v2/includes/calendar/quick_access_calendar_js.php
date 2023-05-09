<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key']; ?>&callback=initialize&libraries=&v=weekly"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

var calendar_modal_source = 'upcoming-list';
$(function(){ 

    $('#modal-quick-add-job').modal({backdrop: 'static', keyboard: false});
    $('#modal-quick-add-service-ticket').modal({backdrop: 'static', keyboard: false});
    $('#modal-quick-add-appointment').modal({backdrop: 'static', keyboard: false});
    $('#modal-quick-add-tc-off').modal({backdrop: 'static', keyboard: false});
    $('#modal-quick-edit-tc-off').modal({backdrop: 'static', keyboard: false});
    $('#modal-quick-add-event').modal({backdrop: 'static', keyboard: false});

    $('.btn-quick-access-calendar-schedule').on('click', function(){
        $('#modal-quick-access-calendar-schedule').modal('show');
        calendar_modal_source = 'calendar';
    });

    $('#calendar-quick-add-job').on('click', function(){
        var url = base_url + "job/_quick_add_job_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-job';
        $('#modal-quick-select-schedule-type').modal('hide');
        $('#modal-quick-add-job').modal('show');

        showLoader($("#quick-add-job-form-container"));        

        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {date_selected:date_selected},
             success: function(o)
             {          
                $("#quick-add-job-form-container").html(o);
             }
          });
        }, 500);
    });

    $('#calendar-quick-add-appointment').on('click', function(){
        var url = base_url + "calendar/_quick_add_appointment_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-appointment';
        $('#modal-quick-select-schedule-type').modal('hide');
        $('#modal-quick-add-appointment').modal('show');

        showLoader($("#quick-add-appointment-form-container"));        

        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {date_selected:date_selected},
             success: function(o)
             {          
                $("#quick-add-appointment-form-container").html(o);
             }
          });
        }, 500);
    });

    $('#calendar-quick-add-service-ticket').on('click', function(){
        var url = base_url + "ticket/_quick_add_service_ticket_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-service-ticket';
        $('#modal-quick-select-schedule-type').modal('hide');
        $('#modal-quick-add-service-ticket').modal('show');

        showLoader($("#quick-add-service-ticket-form-container"));        

        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {date_selected:date_selected},
             success: function(o)
             {          
                $("#quick-add-service-ticket-form-container").html(o);
             }
          });
        }, 500);
    });

    $('#calendar-quick-add-event').on('click', function(){
        var url = base_url + "event/_quick_add_event_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-event';
        $('#modal-quick-select-schedule-type').modal('hide');
        $('#modal-quick-add-event').modal('show');

        showLoader($("#quick-add-event-form-container"));        

        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {date_selected:date_selected},
             success: function(o)
             {          
                $("#quick-add-event-form-container").html(o);
             }
          });
        }, 500);
    });

    $('#calendar-quick-add-tc-off').on('click', function(){
        var url = base_url + "calendar/_quick_add_tc_off_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-tc-off';
        $('#modal-quick-select-schedule-type').modal('hide');
        $('#modal-quick-add-tc-off').modal('show');

        showLoader($("#quick-add-tc-off-form-container"));        

        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {date_selected:date_selected},
             success: function(o)
             {          
                $("#quick-add-tc-off-form-container").html(o);
             }
          });
        }, 500);
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
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-toggle", "popover");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-trigger", "hover focus");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-placement", "top");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-content", "<i class='bx bxs-calendar-plus'></i> Create Schedule");

                $('.fc-timegrid-slot:before').attr("data-bs-toggle", "popover");
                $('.fc-timegrid-slot:before').attr("data-bs-trigger", "hover focus");
                $('.fc-timegrid-slot:before').attr("data-bs-placement", "top");
                $('.fc-timegrid-slot:before').attr("data-bs-content", "<i class='bx bxs-calendar-plus'></i> Create Appointment");

                initPopover();
            },
            selectable: true,
            slotEventOverlap: true,
            eventOverlap: true,
            select: function(info) {                  
                var date_selected = moment(info.startStr).format('YYYY-MM-DD');
                calendar_modal_source = 'calendar';
                $('#quick-add-date-selected').val(date_selected);
                $('#modal-quick-access-calendar-schedule').modal('hide');
                $('#modal-quick-select-schedule-type').modal('show');
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
            droppable: false, // this allows things to be dropped onto the calendar
            drop: function(arg) {
                
            },
            eventDrop: function(info) {
                /*//alert(info.event.extendedProps.eventType);
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
                }*/
            },
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function(arg) {
                
            },
            loading: function(isLoading) {
                if (isLoading) {
                    $("#quick-access-calendar-loading").html('<div class="alert alert-info alert-purple" role="alert">Loading calendar data...</div>');
                } else {                                    
                    $("#quick-access-calendar-loading").html('');
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

    $('#modal-quick-select-schedule-type').on('hidden.bs.modal', function (e) {
        if( calendar_modal_source == 'calendar' ){
            $('#modal-quick-access-calendar-schedule').modal('show');
        }
    });

    $(document).on('click', '#upcoming-schedule-view-more-details', function(){
        var appointment_type = $(this).data('type');
        var appointment_id   = $(this).data('id');
        if( appointment_type == 'job' ){
            location.href = base_url + 'job/job_preview/' + appointment_id;
        }else if( appointment_type == 'ticket' ){
            location.href = base_url + 'tickets/viewDetails/' + appointment_id;
        }else if( appointment_type == 'event' ){
            location.href = base_url + 'events/event_preview/' + appointment_id;
        }else{
            location.href = base_url + 'workcalender';
        }
    });

    $(document).on('click', '.quick-calendar-tile', function(){
        var appointment_type = $(this).attr('data-type');
        var appointment_id   = $(this).attr('data-id');

        $('#upcoming-schedule-view-more-details').attr('data-type', appointment_type);
        $('#upcoming-schedule-view-more-details').attr('data-id', appointment_id);

        $('#edit-upcoming-schedule').attr('data-type', appointment_type);
        $('#edit-upcoming-schedule').attr('data-id', appointment_id);
        
        if( appointment_type == 'job' ){
            var url = base_url + "job/_quick_view_details";
            $('#upcoming-schedule-view-more-details').show();
        }else if( appointment_type == 'ticket' ){
            var url = base_url + "ticket/_quick_view_details";
            $('#upcoming-schedule-view-more-details').show();
        }else if( appointment_type == 'tc-off' ){
            var url = base_url + "calendar/_quick_view_tc_off";
            $('#upcoming-schedule-view-more-details').hide();
        }else if( appointment_type == 'event' ){
            var url = base_url + "event/_quick_view_event";
            $('#upcoming-schedule-view-more-details').show();
        }else{
            var url = base_url + "calendar/_view_appointment";
            $('#upcoming-schedule-view-more-details').hide();
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

    $(document).on('click', '.quick-edit-schedule', function(){
        var schedule_id   = $(this).attr('data-id');
        var schedule_type = $(this).attr('data-type');

        if( schedule_type == 'job' ){
            location.href = base_url + 'job/new_job1/' + schedule_id;
        }else if( schedule_type == 'ticket' ){
            location.href = base_url + 'tickets/editDetails/' + schedule_id;
        }else if( schedule_type == 'event' ){
            location.href = base_url + "events/event_add/" + schedule_id;            
        }else if( schedule_type == 'tc-off' ){
            quickEditTcOff(schedule_id);
        }
    });

    function quickEditTcOff(schedule_id){
        var url = base_url + "calendar/_quick_edit_tc_off_form";
        calendar_modal_source = 'quick-edit-tc-off';
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-edit-tc-off').modal('show');

        showLoader($("#quick-edit-tc-off-form-container"));  
        setTimeout(function () {
          $.ajax({
             type: "GET",
             url: url,
             data: {schedule_id:schedule_id},
             success: function(o)
             {          
                $("#quick-edit-tc-off-form-container").html(o);
             }
          });
        }, 500);
    }

    $("#quick-add-job-form").submit(function(e) {
        e.preventDefault();         
        
        var url  = base_url + 'job/_create_job';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(), 
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-add-job').modal('hide');
                    $('#modal-quick-access-calendar-schedule').modal('show');

                    Swal.fire({
                        text: 'Job has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadQuickAccessCalendarSchedule();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-job-submit").html('Schedule');
            }, beforeSend: function() {
                $("#btn-job-submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#quick-add-service-ticket-form").submit(function(e) {
        e.preventDefault();         
        
        var url  = base_url + 'ticket/_create_service_ticket';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(),
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-add-service-ticket').modal('hide');
                    $('#modal-quick-access-calendar-schedule').modal('show');

                    Swal.fire({
                        text: 'Service ticket has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        //reloadQuickAccessCalendarSchedule();
                        location.href = base_url + 'job/new_job1/' + data.job_id
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-service-ticket-submit").html('Schedule');
            }, beforeSend: function() {
                $("#btn-service-ticket-submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#quick-add-appointment-form").submit(function(e) {
        e.preventDefault();         
        var url  = base_url + 'calendar/_create_appointment';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(),
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-add-appointment').modal('hide');
                    $('#modal-quick-access-calendar-schedule').modal('show');

                    Swal.fire({
                        text: 'Appointment has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadQuickAccessCalendarSchedule();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-appointment-submit").html('Schedule');
            }, beforeSend: function() {
                $("#btn-appointment-submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#quick-add-tc-off-form").submit(function(e) {
        e.preventDefault();         
        var url  = base_url + 'calendar/_create_technician_off_schedule';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(),
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-add-tc-off').modal('hide');
                    $('#modal-quick-access-calendar-schedule').modal('show');

                    Swal.fire({
                        text: 'Technician Schedule Off has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadQuickAccessCalendarSchedule();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-quick-add-tc-off-submit").html('Schedule');
            }, beforeSend: function() {
                $("#btn-quick-add-tc-off-submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $("#quick-edit-tc-off-form").submit(function(e) {
        e.preventDefault();         
        var url  = base_url + 'calendar/_update_technician_off_schedule';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(),
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-edit-tc-off').modal('hide');
                    $('#modal-quick-access-calendar-schedule').modal('show');

                    Swal.fire({
                        text: 'Technician Schedule Off has been updated!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadQuickAccessCalendarSchedule();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-quick-add-tc-off-submit").html('Schedule');
            }, beforeSend: function() {
                $("#btn-quick-add-tc-off-submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $('#quick-add-event-form').submit(function(e){
        e.preventDefault();

        var url  = base_url + 'event/_create_event';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(),
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-add-event').modal('hide');
                    $('#modal-quick-access-calendar-schedule').modal('show');

                    Swal.fire({
                        text: 'Event has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadQuickAccessCalendarSchedule();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#btn-event-submit").html('Schedule');
            }, beforeSend: function() {
                $("#btn-event-submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });
});

function formatRepoUser(repo) {
    if (repo.loading) {
        return repo.text;
    }

    var $container = $(
        '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
    );

    return $container;
}

function formatRepoSelectionUser(repo) {
    return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
}
</script>