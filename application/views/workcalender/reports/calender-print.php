<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
    <title>Home</title>
    <meta content="Admin Dashboard" name="description">
    <meta content="Themesbrand" name="author">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--Chartist Chart CSS -->
     
    <link href="<?php echo $url->assets ?>dashboard/css/bootstrap.min.css" rel="stylesheet" type="text/css">     
    <link href="<?php echo $url->assets ?>dashboard/css/style.css" rel="stylesheet" type="text/css">
     <!-- DataTables --> 
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/switchery/switchery.min.css">
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/select2/dist/css/select2.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

  
    
</head>

<body>
    <!-- Navigation Bar-->
    <div class="doc-print">
        <div class="btn-print__cnt"><a class="btn-print" onclick="window.print();" href="#">Print</a></div>
        <div><h6 class="print-schedule-title">
            Schedule
        </h6></div>
        <div id='calendar'></div>
    </div>
   
</body>
<!-- jQuery  -->
<script src="<?php echo $url->assets ?>dashboard/js/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>js/custom.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/jquery.slimscroll.js"></script>
<script src="<?php echo $url->assets ?>dashboard/js/waves.min.js"></script>
<!--Chartist Chart-->
<!-- <script src="../plugins/chartist/js/chartist.min.js"></script>
<script src="../plugins/chartist/js/chartist-plugin-tooltip.min.js"></script>
<script src="../plugins/peity-chart/jquery.peity.min.js"></script> -->
<!-- App js<script src="<?php echo $url->assets ?>dashboard/pages/dashboard.js"></script> -->
<script src="<?php echo $url->assets ?>dashboard/js/app.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url->assets ?>plugins/datatables.net/export/dataTables.buttons.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.bootstrap.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/jszip.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/pdfmake.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/vfs_fonts.js"></script>
<script src="<?php echo $url->assets ?>plugins/datatables.net/export/buttons.html5.min.js"></script>
<!-- Validate  -->
<script src="<?php echo $url->assets ?>plugins/switchery/switchery.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/jquery.validate.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo $url->assets ?>plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<!-- Include calender js files -->
<!-- <script src="<?php echo base_url() ?>calender/assets/js/calendar.js"></script> -->


<script type="text/javascript">
    window.base_url = <?php echo json_encode(base_url()); ?>;
</script>

<!-- dynamic assets goes  -->
<?php echo put_footer_assets(); ?>
 <link rel="stylesheet" href="<?php echo $url->assets ?>plugins/fullcalendar/dist/calendar.1586549452.css">
<style>
    body {
        background: #ffffff;
    }
    .suggestions {
        padding: 0px;
        list-style: none;
        position: absolute;
        z-index: 66666;
        background: #fff;
        width: 325px;
    }

    .suggestions li {
        padding: 10px 8px;
        border-bottom: 1px solid;
        cursor: pointer;
    }

    .mdc-top-app-bar-fixed-adjust {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 99;
        display: flex;
        justify-content: space-evenly;
    }

    .mdc-top-app-bar-fixed-adjust .mdc-bottom-navigation__list {
        height: 100%;
        display: flex;
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    .mdc-top-app-bar-fixed-adjust .mdc-bottom-navigation__list .mdc-bottom-navigation__list-item {
        display: flex;
        flex-direction: column;
        text-align: center;
    }
</style>

<script>
    var calendar;

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var timeZoneSelectorEl = document.getElementById('time-zone-selector');
        var events = <?php echo json_encode($events) ?>;

        render_calender(calendarEl, timeZoneSelectorEl, events);
  
});
function render_calender(calendarEl, timeZoneSelectorEl, events) {
        var bc_events_url    = base_url + "/calendar/_get_main_calendar_events";
        var bc_resources_url = base_url + "/calendar/_get_main_calendar_resources";

        calendar = new FullCalendar.Calendar(calendarEl, {
           schedulerLicenseKey: '0531798248-fcs-1598103289',
            /*headerToolbar: {
            center: 'employeeTimeline,monthView,dayView,weekView,listView' // buttons for switching between views
          },*/
          themeSystem : 'bootstrap',
          eventDisplay: 'block',
          views: {
            employeeTimeline: {
              type: 'resourceTimelineDay',
              buttonText: 'Employee'
            },
            dayView: {
              type: 'timeGridDay',
              buttonText: 'Day'
            },
            monthView: {
              type: 'dayGridMonth',
              buttonText: 'Month'
            },
            weekView: {
              type: 'timeGridWeek',
              buttonText: 'Week'
            },
            listView: {
              type: 'listWeek',
              buttonText: 'List'
            }
          },
          resourceLabelDidMount: function(info) {
            console.log(info);
            let img = document.createElement('img');
            img.src = info.resource.extendedProps.imageurl;
            img.setAttribute("class", "datagrid-image");
            info.el.prepend(img);
          },
          defaultDate: "<?php echo date('Y-m-d') ?>",
            editable: false,
            navLinks: false, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function (arg) {
                //console.log(arg.event._def.extendedProps);

                $("#modalEventDetails").modal('show');
                $('#modalEventDetails .modal-body').html("loading...");

                var apiUrl = '';
                var isGet  = 1;
                if (typeof arg.event._def.extendedProps.eventId != 'undefined') {

                    apiUrl = base_url + 'event/modal_details/' + arg.event._def.extendedProps.eventId;

                    $("#edit_schedule").show();
                    $("#edit_workorder").hide();

                    $("#edit_schedule").attr('data-event-id', arg.event._def.extendedProps.eventId);
                }else if( typeof arg.event._def.extendedProps.geventID != 'undefined' ){
                    apiUrl = base_url + 'workcalender/modal_gevent_details';
                    isGet = 0;
                    var gData = {
                      'gevent_id' : arg.event._def.extendedProps.geventID,
                      'title' : arg.event._def.extendedProps.description,
                      'start_date' : arg.event._def.extendedProps.start,
                      'end_date' : arg.event._def.extendedProps.end,
                    };
                } else {

                    apiUrl = base_url + 'workcalender/short_details/' + arg.event._def.extendedProps.wordOrderId;

                    $("#edit_schedule").hide();
                    $("#edit_workorder").show();

                    $("#edit_workorder").attr('data-workorder-id', arg.event._def.extendedProps.wordOrderId);
                }

                if( isGet == 1 ){
                  jQuery.ajax({
                      url: apiUrl,
                      // dataType: 'json',
                      data: '',
                      beforeSend: function () {
                          jQuery('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
                      },
                      success: function (response) {

                          // console.log(response);
                          $(".btn-event-edit").show();
                          $(".btn-event-delete").show();
                          $(".btn-event-edit-workorder").show();
                          $("#modalEventDetails").find('.modal-body').html(response);
                      }
                  });
                }else{
                  jQuery.ajax({
                      url: apiUrl,
                      type: "POST",
                      data: gData,
                      beforeSend: function () {
                          jQuery('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
                      },
                      success: function (response) {

                          // console.log(response);
                          $(".btn-event-edit").hide();
                          $(".btn-event-delete").hide();
                          $(".btn-event-edit-workorder").hide();
                          $("#modalEventDetails").find('.modal-body').html(response);
                      }
                  });
                }
                
            },
            loading: function (isLoading) {
              if (isLoading) {
                  $(".left-calendar-loading").html('<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" style="display:inline;" /> Loading Events...</div>');
              }
              else {
                  $(".left-calendar-loading").html('');
              }

            },
            resourceAreaColumns: [
              {
                field: 'title',
                headerContent: 'Employees'
              }
            ],
            resources: <?php echo json_encode($resources_users); ?>,
            events: {
              url: bc_events_url,
              method: 'POST'
            },
            //events: <?php echo json_encode($resources_user_events); ?>,

        });

        calendar.render();

        // load the list of available timezones, build the <select> options
        // it's HIGHLY recommended to use a different library for network requests, not this internal util func
        FullCalendar.requestJson('GET', base_url + 'packages/fullcalendar/examples/php/get-time-zones.php', {}, function (timeZones) {

            timeZones.forEach(function (timeZone) {
                var optionEl;

                if (timeZone !== 'UTC') { // UTC is already in the list
                    optionEl = document.createElement('option');
                    optionEl.value = timeZone;
                    optionEl.innerText = timeZone;
                    timeZoneSelectorEl.appendChild(optionEl);
                }
            });

        }, function () {

            // get_employee_dropdown();
            // TODO: handle error
        });

        // when the timezone selector changes, dynamically change the calendar option
        timeZoneSelectorEl.addEventListener('change', function () {
            calendar.setOption('timeZone', this.value);
        });
    }
</script>

<style>
    .fc-day-grid-event .fc-content {
        overflow: hidden;
    }
    .fc-toolbar.fc-header-toolbar .fc-left,
    .fc-toolbar.fc-header-toolbar .fc-right {
        opacity: 0;
    }
    .doc-print {
        margin-left: 1em;
        margin-right: 1em;
    }
    .btn-print__cnt {
    text-align: right;
    padding-top: 5px;
    padding-right: 10px;
}.fc-toolbar h2 {
    font-size: 1em;
    margin: 0;
}
.fc-time-grid-event.fc-short .fc-content, .fc-day-grid-event .fc-content {
    white-space:normal;
}.fc-event {
    background: #fff !important;
    color: #000 !important;
    page-break-inside: avoid;
}.fc-day-grid-event {
    margin: 1px 2px 0;
    padding: 0 1px;
}.fc-scroller, .fc-day-grid-container, .fc-time-grid-container {
    overflow: visible !important;
    height: auto !important;
}
.fc-row .fc-content-skeleton td, .fc-row .fc-helper-skeleton td{
        border-color: #ddd !important;
}
.fc-today {
    background: white !important;
    border-top: 1px solid #ddd !important;
}

.doc-print {
    margin-left: 1em;
    margin-right: 1em;
}
.btn-print__cnt {
    text-align: right; 
    padding-top: 5px;
    padding-right: 10px;      
}
@media print {
    .btn-print__cnt {
        display: none;
    }
}
.print-schedule-title {
    text-align: center;
}
.print-schedule-title {
        display: none;
    }
@media print {
    .print-schedule-title {
        display: block;
    }
}
.fc-content { text-align: left; padding: 3px; }
</style>
</html>