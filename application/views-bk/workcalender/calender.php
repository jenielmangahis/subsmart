<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('includes/header'); ?>
<!-- page wrapper start -->
<div class="wrapper" role="wrapper">	<nav class="navbar-side d-none d-md-block">			<ul class="nav">				<!--<span class="nav-close">					<svg viewBox="0 0 16 14" id="svg-sprite-menu-close" xmlns="http://www.w3.org/2000/svg" transform="scale(1, -1)" width="20px" height="100%"><path d="M3.3 4H15c.6 0 1 .4 1 1s-.4 1-1 1H3.3l2.2 2.2c.4.4.4 1.1 0 1.5-.4.4-1.1.4-1.5 0L.3 6c-.2-.3-.3-.6-.3-.9V5v-.1c0-.3.1-.6.3-.9L4 .3c.4-.4 1.1-.4 1.5 0 .4.4.4 1.1 0 1.5L3.3 4zM8 8h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1zm0 4h7c.6 0 1 .4 1 1s-.4 1-1 1H8c-.6 0-1-.4-1-1s.4-1 1-1z"></path></svg>				</span>-->				<li class="nav-header">My Business</li>				<li class="active"><a href="http://oscuz.com/nsmartfrontend/users/businessview" title="My Profile"><span class="fa fa-user"></span>My Profile</a></li>				<li><a href="http://oscuz.com/nsmartfrontend/users/businessdetail" title="Business Details"><span class="fa fa-briefcase"></span>Business Details</a></li>				<li><a href="" title="Services"><span class="fa fa-home"></span>Services</a></li>				<li><a href="" title="Credentials"><span class="fa fa-shield"></span>Credentials</a></li>				<li><a href="" title="Availability"><span class="fa fa-calendar"></span>Availability</a></li>				<li><a href="" title="Work Pictures"><span class="fa fa-camera-retro"></span>Work Pictures</a></li> 				<li><a href="" title="Profile Settings"><span class="fa fa-file-o"></span>Profile Settings</a></li>				<li><a href="" title="Social Media"><span class="fa fa-share-square-o"></span>Social Media</a></li>			</ul>		</nav>
    <?php include viewPath('includes/notifications'); ?>
    <div wrapper__section>    <div class="container-fluid"> 
        <!-- end row -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="d-block d-none  hid-deskx">
                        <?php
                        $id = logged('id');

                        $servername = "localhost";
                        $username = "oscuz_sony";
                        $password = "Sony@123";
                        $dbname = "oscuz_nsmart";

                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT  * from workorders WHERE `user_id`=$id";
                        $result = $conn->query($sql);


                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $ss = $row['id'];
                        ?>
                                <div card__columns>
                                    <div class="c__header">
                                        <h4> <?php echo 'WO-00' . $row['id']; ?></h4>
                                        <div class="card__columns_dec">
                                            <div><i class="fa fa-user" aria-hidden="true"></i> <?php echo $row['contact_name']; ?></div>
                                            <div><i class="fa fa-users" aria-hidden="true"></i> <?php echo $row['contact_mobile']; ?></div>
                                            <div><i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('M d, Y', strtotime($row->workorder_date)); ?></div>
                                            <h4><span><a href="http://oscuz.com/nsmartfrontend/workorder/edit/<?php echo $ss; ?>">View Workorder</a></span></h4>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "No Workorders";
                        } ?>
                    </div>
                    <div class="card-body hid-desk">
                        <div class="calender-toolbar" id="calender_toolbar">						<h1 class="page-title">Schedule</h1>
                            <form id="frm_calender_filter_events" method="post">
                                <div class="form-group">
                                    <select id='time-zone-selector' class="form-control custom-select">
                                        <option value='local' selected>local</option>
                                        <option value='UTC'>UTC</option>
                                    </select>
                                </div>
                                <?php if (!empty($users)) { ?>
                                    <div class="form-group">
                                        <select class="form-control custom-select" id="select-employee">
                                            <option value="0">All Employees</option>
                                            <?php foreach ($users as $user) { ?>
                                                <option value="<?php echo $user->id ?>"><?php echo $user->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <?php } ?>
                                <div class="form-group margin-left-sec" role="group" aria-label="...">
                                    <a class="btn btn-sec btn-md" data-calendar="print" href="#" target="_blank">
                                        <span class="fa fa-print fa-margin-right"></span> Print
                                    </a>
                                </div>
                                <div class="form-group margin-left-sec" role="group" aria-label="...">
                                    <a class="btn btn-primary btn-md" data-calendar="print" href="<?php echo base_url('workorder/add') ?>" target="_blank">
                                        <span class="fa fa-plus"></span>&nbsp;&nbsp;Create Work Order
                                    </a>
                                </div>
                                <div class="form-group margin-left-sec" role="group" aria-label="...">
                                    <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modalCreateEvent">
                                        <span class="fa fa-plus"></span>&nbsp;&nbsp;Create Event
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div id='calendar'></div>
                    </div>
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row -->
    </div>    </div>    </div>
    <!-- end container-fluid -->
</div>


<!-- MODAL CREATE EVENT -->
<div id="modalCreateEvent" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Up a Schedule</h4>
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
                <button type="button" class="btn btn-primary" id="edit_schedule" style="display: none">Edit Schedule</button>
                <button type="button" class="btn btn-primary" id="edit_workorder" style="display: none">Edit Wordorder</button>
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

    elems.forEach(function(html) {
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
            beforeSend: function() {
                jQuery('.tiva-calendar').html('<div class="loading"><img src="images/temp/loading.gif" /></div>');
            },
            success: function(response) {

                console.log(response);

                // $('.tiva-events-calendar > .events-calendar-bar').append(response);

                $('#calender_toolbar').append(response);
            }
        });
    }


    $(document).ready(function() {

        var event_details_popup;

        var action = "<?php echo isset($_GET['action']) ? $_GET['action'] : '' ?>";
        var customer_id = "<?php echo isset($_GET['customer_id']) ? $_GET['customer_id'] : '' ?>";


        if (action === 'open_event_modal') {

            console.log('opening modal...');
            var data = {
                id: "<?php echo get_customer_by_id($_GET['customer_id'])->id ?>",
                contact_name: "<?php echo get_customer_by_id($_GET['customer_id'])->contact_name ?>",
                contact_email: "<?php echo get_customer_by_id($_GET['customer_id'])->contact_email ?>",
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
        $(document).on('change', '#select-employee', function(e) {

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
                success: function(response) {

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
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var timeZoneSelectorEl = document.getElementById('time-zone-selector');
        var events = <?php echo json_encode($events) ?>;

        console.log(events);

        render_calender(calendarEl, timeZoneSelectorEl, events);
    });


    function render_calender(calendarEl, timeZoneSelectorEl, events) {

        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            defaultDate: "<?php echo date('Y-m-d') ?>",
            editable: true,
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            events: events,
            eventClick: function(arg) {
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
                    beforeSend: function() {
                        jQuery('.tiva-calendar').html('<div class="loading"><img src="./assets/img/loading.gif" /></div>');
                    },
                    success: function(response) {

                        // console.log(response);

                        $("#modalEventDetails").find('.modal-body').html(response);
                    }
                });
            },
            loading: function(bool) {
                document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
            }
        });

        calendar.render();

        // load the list of available timezones, build the <select> options
        // it's HIGHLY recommended to use a different library for network requests, not this internal util func
        FullCalendar.requestJson('GET', base_url + 'packages/fullcalendar/examples/php/get-time-zones.php', {}, function(timeZones) {

            timeZones.forEach(function(timeZone) {
                var optionEl;

                if (timeZone !== 'UTC') { // UTC is already in the list
                    optionEl = document.createElement('option');
                    optionEl.value = timeZone;
                    optionEl.innerText = timeZone;
                    timeZoneSelectorEl.appendChild(optionEl);
                }
            });

        }, function() {

            // get_employee_dropdown();
            // TODO: handle error
        });

        // when the timezone selector changes, dynamically change the calendar option
        timeZoneSelectorEl.addEventListener('change', function() {
            calendar.setOption('timeZone', this.value);
        });
    }
</script>