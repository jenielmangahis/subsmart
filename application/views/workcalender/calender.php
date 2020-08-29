<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<style>
.btn-right-nav-hide-show{
    position: relative;
    left: 48%;
    top: -35px;
}
img.datagrid-image {
    width: 50px;
    height: 50px;
    border-radius: 50px;
    margin: 0 auto;
    object-fit: cover;
    margin-top: 10px;
}
td.fc-datagrid-cell.fc-resource {
    text-align: center;
}
.right-col .fc-left{
    font-size: 10px;
}
.right-col .fc-left h2{
    margin-top: 10px;
    font-weight: 300;
}
#right-calendar{
    margin-top: 10px;
    padding: 10px;
}
.dot {
  height: 25px;
  width: 25px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  padding: 2px;
  text-align: center;
  color:#ffffff;
}
.fc-button-group{
    margin: 15px 0;
}
.dot-red{
    background-color: #ff2a26;
}
.dot-green{
    background-color: #bee336;
}
.dot-yellow{
    background-color: #f7f016;
}
.dot-blue{
    background-color: #16b7f7;
}
.right-list-events li{
    text-align: left;
    margin: 19px;
}
.right-filter-header{
    font-size: 16px;
    text-align: left;
    background-color: #76828E;
    padding: 10px;
    color: #ffffff;
}
.list-group li{
    padding: 0px;
    margin-top: 20px;
    border: none;
}
.hide{
    display: none;
}
</style>
<div class="wrapper" role="wrapper">
    <div class="row">
        <div class="col-12 col-md-9 left-col">
            <?php include viewPath('includes/sidebars/schedule'); ?>
            <?php include viewPath('includes/notifications'); ?>
            <div wrapper__section>
                <div class="container-fluid">
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="d-block d-none">
                                    <?php
                                        if (count($wordorders) > 0) {
                                            // output data of each row
                                             foreach($wordorders as $row) {
                                                $ss = $row['id'];
                                                ?>
                                                <div card__columns>
                                                    <div class="c__header">
                                                        <h4> <?php echo 'WO-00' . $row['id']; ?></h4>
                                                        <div class="card__columns_dec">
                                                            <div><i class="fa fa-user"
                                                                    aria-hidden="true"></i> <?php echo $row['contact_name']; ?>
                                                            </div>
                                                            <div><i class="fa fa-users"
                                                                    aria-hidden="true"></i> <?php echo $row['contact_mobile']; ?>
                                                            </div>
                                                            <div><i class="fa fa-calendar"
                                                                    aria-hidden="true"></i><?php echo date('M d, Y', strtotime($row->create_at)); ?>
                                                            </div>
                                                            <h4>
                                                                <span><a href="http://nsmartrac.com/workorder/edit/<?php echo $ss; ?>">View Workorder</a></span>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        } else {
                                            echo "No Workorders";
                                        }
                                    ?>
                                </div>
                                <div class="card-body col-12">
                                    <a class="btn-right-nav-hide-show show-right" style="color:#45a73c !important; display:none !important;" href="javascript:void(0);"><i class="fa fa-gear"></i> Right Nav</a>
                                    <div class="calender-toolbar" id="calender_toolbar">
                                        <div class="stcs-2 left">
                                          <h1 class="page-title left">Schedule</h1>
                                        </div>
                                        <div class="stcs-cover left">
                                          <form id="frm_calender_filter_events" method="post">
                                              <div class="stcs-4 left">
                                                <div class="form-group">
                                                    <!--<select id='time-zone-selector' class="form-control custom-select">
                                                        <option value='local' selected>local</option>
                                                        <option value='UTC'>UTC</option>
                                                    </select>-->
                                                    <span class="text-ter left">Central Time (UTC -5) &nbsp;</span><a class="margin-right-sec left text-green" href="<?= base_url()?>settings/schedule"><span class="fa fa-cog left"></span> Change</a>
                                                </div>
                                              </div>
                                              <?php if (!empty($users)) { ?>
                                              <div class="stcs-3-full left">
                                                  <div class="select-group">
                                                      <select class="form-control custom-select" id="select-employee">
                                                          <option value="0">All Employees</option>
                                                          <?php foreach ($users as $user) { ?>
                                                              <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
                                                          <?php } ?>
                                                      </select>
                                                  </div>
                                              </div>
                                              <?php } ?>
                                              <div class="stcs-print cs-float-print">
                                                <div class="form-group margin-left-sec c-1" role="group" aria-label="...">
                                                     <a class="text-white btn btn-sec btn-md" id="print-calender"  data-calendar="print" href="#">
                                                        <span class="fa fa-print fa-margin-right"></span> Print
                                                    </a>
                                                </div>
                                              </div>
                                              <div class="stcs-1 cs-float">
                                                <div class="form-group margin-left-sec d-1" role="group" aria-label="...">
                                                    <a class="text-white btn btn-primary btn-md" data-calendar="print"
                                                       href="<?php echo base_url('workorder/add') ?>" target="_blank">
                                                        <span class="fa fa-plus"></span>&nbsp;&nbsp;Create Work Order
                                                    </a>
                                                </div>
                                              </div>
                                              <div class="stcs-3 pos-2 cs-float">
                                                <div class="form-group margin-left-sec e-1" role="group" aria-label="...">
                                                    <div class="btn-group btn-with-dropdown">
                                                        <button type="button" class="text-white btn btn-primary btn-md" data-toggle="modal"
                                                                data-target="#modalCreateEvent">
                                                            <span class="fa fa-plus fa-margin-right"></span>&nbsp;&nbsp;Create Event
                                                        </button>
                                                        <button type="button" class="btn btn-primary btn-md dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <span class="caret"></span>
                                                            <span class="text-white sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu text-dark-c1">
                                                            <li><a data-calendar="add-event" data-calendar-event-type="3" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">
                                                                    Add Blocked Event</a></li>
                                                            <li><a data-calendar="add-event" data-calendar-event-type="3" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">
                                                                    Assign New Lead</a></li>
                                                            <li><a data-calendar="event-modal-open" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">Create Event</a></li>
                                                            <li><a data-calendar="event-modal-open" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">Cancel Schedule</a></li>
                                                            <li><a data-calendar="event-modal-open" href="#" data-toggle="modal"
                                                                   data-target="#modalCreateEvent">Reschedule</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                              </div>
                                          </form>
                                        </div>
                                        <br class="clearfix"/><br/>


                                    </div>
                                    <div id='calendar'></div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <?php //if( !$is_mobile ){ ?>
        <div class="col-12 col-md-3 right-col" style="background-color: #ffffff;overflow-y: scroll; max-height: 800px;">
            <div class="row" style="padding:10px;">
                <div class="col-12">
                    <div id="right-calendar"></div>
                </div>
                <div class="col-12" style="margin-top: 15px;">
                    <h4  class="right-filter-header">FILTER BY TIME OFF</h4>


                    <ul class="right-list-events">
                        <li><span class="dot dot-red"><i class="fa fa-check"></i></span> Events</li>
                        <li><span class="dot dot-green"><i class="fa fa-check"></i></span> National Holiday</li>
                        <li><span class="dot dot-yellow"><i class="fa fa-check"></i></span> Interview</li>
                        <li><span class="dot dot-blue"><i class="fa fa-check"></i></span> Leave</li>
                    </ul>
                </div>
                <div class="col-12" style="margin-top: 15px;">
                    <h4  class="right-filter-header">CALENDARS</h4>
                    <p style="font-size: 13px;text-align: left;">Which calendar entries do you wish to show in the mini calendar</p>
                    <ul class="right-list-events">
                        <li><label class="checkbox"><input type="checkbox" class=""> All</label></li>
                        <li><label class="checkbox"><input type="checkbox" class=""> Family</label></li>
                        <li><label class="checkbox"><input type="checkbox" class=""> Friends</label></li>
                        <li><label class="checkbox"><input type="checkbox" class=""> Holidays</label></li>
                    </ul>
                </div>
                 <div class="col-12" style="margin-top: 15px;">
                    <h4  class="right-filter-header">RECENT CONTACTS</h4>


                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-12 col-3 col-sm-3 col-md-3">
                                    <img src="<?php echo base_url() . "/assets/img/user7-128x128.jpg"; ?>" alt="user" class="rounded-circle" style="inline">
                                </div>
                                <div class="col-xs-12 col-5 col-sm-5 col-md-5" style="text-align: left;">
                                    <span class="name"><i class="fa fa-user"></i> Ana Stevens</span><br/>
                                    <span><i class="fa fa-envelope-open"></i> Receipt Address</span>
                                    <span class="visible-xs"> <span class="text-muted"></span>
                                </div>
                                <div class="col-xs-12 col-4 col-sm-4 col-md-4" style="text-align: left;">
                                    <a class="btn btn-default" href="javascript:void(0)">Send</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-12 col-3 col-sm-3 col-md-3">
                                    <img src="<?php echo base_url() . "/assets/img/user8-128x128.jpg"; ?>" alt="user" class="rounded-circle" style="inline">
                                </div>
                                <div class="col-xs-12 col-5 col-sm-5 col-md-5" style="text-align: left;">
                                    <span class="name"><i class="fa fa-user"></i> John Doe</span><br/>
                                    <span><i class="fa fa-envelope-open"></i> Receipt Address</span>
                                    <span class="visible-xs"> <span class="text-muted"></span>
                                </div>
                                <div class="col-xs-12 col-4 col-sm-4 col-md-4" style="text-align: left;">
                                    <a class="btn btn-default" href="javascript:void(0)">Send</a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-12 col-3 col-sm-3 col-md-3">
                                    <img src="<?php echo base_url() . "/assets/img/user6-128x128.jpg"; ?>" alt="user" class="rounded-circle" style="inline">
                                </div>
                                <div class="col-xs-12 col-5 col-sm-5 col-md-5" style="text-align: left;">
                                    <span class="name"><i class="fa fa-user"></i> Mike David</span><br/>
                                    <span><i class="fa fa-envelope-open"></i> Receipt Address</span>
                                    <span class="visible-xs"> <span class="text-muted"></span>
                                </div>
                                <div class="col-xs-12 col-4 col-sm-4 col-md-4" style="text-align: left;">
                                    <a class="btn btn-default" href="javascript:void(0)">Send</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php //} ?>
    </div>


</div>
<!-- end container-fluid -->
</div>


<!-- MODAL CREATE EVENT -->
<div id="modalCreateEvent" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Set Up a Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="button_submit_form">Confirm</button>
            </div>
        </div>

    </div>
</div>


<!-- MODAL EVENT DETAILS -->
<div id="modalEventDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Schedule</h4>
            </div>
            <div class="modal-body">
                <p>loading...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="delete_schedule">Delete</button>
                <button type="button" class="btn btn-primary" id="edit_schedule" style="display: none">Edit Schedule
                </button>
                <button type="button" class="btn btn-primary" id="edit_workorder" style="display: none">Edit Wordorder
                </button>
            </div>
        </div>

    </div>
</div>

<style>
    .hid-deskx {
        display: none !important;
    }


    @media only screen and (max-width: 600px) {
        .hid-desk {
            display: none !important;
        }

        .hid-deskx {
            display: block !important;
        }
    }
</style>
<!-- page wrapper end -->
<?php include viewPath('includes/footer'); ?>
<script>
    var calendar;


    $('#dataTable1').DataTable({

        "ordering": false
    });

    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            size: 'small'
        });
    });

    window.updateUserStatus = (id, status) => {
        $.get('<?php echo url('company/change_status') ?>/' + id, {
            status: status
        }, (data, status) => {
            if (data == 'done') {
                // code
            } else {
                alert('Unable to change Status ! Try Again');
            }
        })
    }


    ////////
    function get_employee_dropdown() {
        jQuery.ajax({
            url: base_url + 'users/ajax_user_dropdown',
            // dataType: 'json',
            data: '',
            beforeSend: function () {
                jQuery('.tiva-calendar').html('<div class="loading"><img src="images/temp/loading.gif" /></div>');
            },
            success: function (response) {

                console.log(response);

                // $('.tiva-events-calendar > .events-calendar-bar').append(response);

                $('#calender_toolbar').append(response);
            }
        });
    }


    $(document).ready(function () {

        var event_details_popup;

        var action = "<?php echo isset($_GET['action']) ? $_GET['action'] : '' ?>";
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";


        if (action === 'open_event_modal') {

            console.log('opening modal...');
            var data = {
                id: "<?php echo (!empty($_GET['customer_id'])) ? get_customer_by_id($_GET['customer_id'])->id : 0 ?>",
                contact_name: "<?php echo (!empty($_GET['customer_id'])) ?  get_customer_by_id($_GET['customer_id'])->contact_name : '' ?>",
                contact_email: "<?php echo (!empty($_GET['customer_id'])) ?  get_customer_by_id($_GET['customer_id'])->contact_email : '' ?>",
            }
            open_create_event_modal_for_customer(customer_id, data);
        }

        // client on any event, a pop will be shown with event details
        // $(document).on('click', '#calendar .fc-event-container', function(e) {

        //     var html = '<div class="calendar-event-details"><div class="img-loading"><img src="./assets/img/loading.gif"></div></div>';

        //     $('#calendar').append(html);

        //     var top = $(this).position().top + 323;
        //     var left = $(this).position().left + 4;

        //     console.log(top, left);

        //     $('#calendar .calendar-event-details').css({
        //         'left': left,
        //         'top': top
        //     });
        // });

        // close event detailspopup
        // $(document).on('click', '#calendar .calendar-event-details .close-details', function(e) {

        //     $(this).parent().remove();
        // });


        // filter calender events by emloyess
        $(document).on('change', '#select-employee', function (e) {

            // $('#frm_calender_filter_events').submit();

            $("#calendar").css('opacity', '.5');
            $("#calendar").attr('disabled', true);


            jQuery.ajax({
                url: base_url + 'event/filter_events/',
                type: 'post',
                // dataType: 'json',
                data: 'employee_id=' + $(this).val(),
                // beforeSend: function() {
                //     jQuery('.tiva-calendar').html('<div class="loading"><img src="images/temp/loading.gif" /></div>');
                // },
                success: function (response) {

                    console.log(response);

                    $("#calendar").css('opacity', '1');
                    $("#calendar").attr('disabled', false);

                    var calendarEl = document.getElementById('calendar');
                    var timeZoneSelectorEl = document.getElementById('time-zone-selector');

                    $(calendarEl).empty();

                    render_calender(calendarEl, timeZoneSelectorEl, JSON.parse(response));
                }
            });
        });

        // $(document).on('submit', '#frm_calender_filter_events', function(e) {

        //     e.preventDefault();


        // });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var timeZoneSelectorEl = document.getElementById('time-zone-selector');
        var events = <?php echo json_encode($events) ?>;
        var customer_events = <?php echo json_encode($resources_user_events) ?>

        console.log(events);

        render_calender(calendarEl, timeZoneSelectorEl, events);
    });


    function render_calender(calendarEl, timeZoneSelectorEl, events) {

        calendar = new FullCalendar.Calendar(calendarEl, {
           schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
            center: 'employeeTimeline,monthView,dayView,weekView,listView' // buttons for switching between views
          },
          themeSystem : 'bootstrap',
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
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function (arg) {
                // console.log(arg);
                console.log(arg.event._def.extendedProps);

                $("#modalEventDetails").modal('show');

                $('#modalEventDetails .modal-body').html("loading...");

                var apiUrl = '';

                if (typeof arg.event._def.extendedProps.eventId != 'undefined') {

                    apiUrl = base_url + 'event/modal_details/' + arg.event._def.extendedProps.eventId;

                    $("#edit_schedule").show();
                    $("#edit_workorder").hide();

                    $("#edit_schedule").attr('data-event-id', arg.event._def.extendedProps.eventId);
                } else {

                    apiUrl = base_url + 'workcalender/short_details/' + arg.event._def.extendedProps.wordOrderId;

                    $("#edit_schedule").hide();
                    $("#edit_workorder").show();

                    $("#edit_workorder").attr('data-workorder-id', arg.event._def.extendedProps.wordOrderId);
                }

                jQuery.ajax({
                    url: apiUrl,
                    // dataType: 'json',
                    data: '',
                    beforeSend: function () {
                        jQuery('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
                    },
                    success: function (response) {

                        // console.log(response);

                        $("#modalEventDetails").find('.modal-body').html(response);
                    }
                });
            },
            loading: function (bool) {

            },
            /* resources: [
                { 
                    id: 'a', 
                    building: 'Employee', 
                    title: 'Bryann', 
                    imageurl:'http://www.completecocktails.com/img/d/l/ShotInTheDark.png' 
                },
                {   
                    id: 'b', 
                    building: 'Employee', 
                    title: 'Tommy', 
                    imageurl:'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQPcIhgnTSREaDHfqwV3CKITIW2hubGELCHwg&usqp=CAU' }
            ],
            events:[
                {
                    resourceId:'a',
                    title:"My repeating event",
                    start:'2020-08-26 10:00',
                    end:'2020-08-26 13:00',
                    eventColor: '#378006',
                    imageurl:'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQCEqdsHyakSRTKbJ9cEgurC739Om2F83yubQ&usqp=CAU'
                },
                {
                    resourceId:'b',
                    title:"My repeating event",
                    start:'2020-08-26 10:00',
                    end:'2020-08-26 13:00',
                    eventColor: '#378006',
                    imageurl:'https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQPcIhgnTSREaDHfqwV3CKITIW2hubGELCHwg&usqp=CAU'
                }
            ],      */
            resources: <?php echo json_encode($resources_users); ?>,
            events: <?php echo json_encode($resources_user_events); ?>,

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

    // add the responsive classes after page initialization
    window.onload = function () {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    };

    // add the responsive classes when navigating with calendar buttons
    $(document).on('click', '.fc-button', function(e) {
        $('.fc-toolbar.fc-header-toolbar').addClass('row col-lg-12');
    });
</script>

<script>
    var calendarEl = document.getElementById('right-calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        schedulerLicenseKey: '0531798248-fcs-1598103289'
      /*headerToolbar: {
        center: 'monthView,dayView' // buttons for switching between views
      },
      views: {
        dayView: {
          type: 'timeGridDay',
          buttonText: 'Day'
        },
        monthView: {
          type: 'dayGridMonth',
          buttonText: 'Month'
        }
      }*/
    });

    calendar.render();

    $(".btn-right-nav-hide-show").click(function(){
        if( $(this).hasClass("show-right") ){
            $(this).removeClass("show-right");
            $(this).addClass("hide-right");

            $(".left-col").removeClass('col-md-9');
            $(".left-col").addClass('col-md-12');
            $(".right-col").hide();

        }else{
            $(this).removeClass("hide-right");
            $(this).addClass("show-right");

            $(".left-col").removeClass('col-md-12');
            $(".left-col").addClass('col-md-9');
            $(".right-col").show();
        }
    });

    $('#print-calender').click(function(){
        var defaultView = calendar.view.type;
        var defaultDate = calendar.view.type;

        window.open("<?php echo base_url('workcalender/print_calender') ?>"+'?default_view='+defaultView, '_blank');
        //+'&default_date='+defaultDate;
    });
</script>
