<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/calendar/calendar_modals'); ?>
<link rel="stylesheet" href="<?= base_url("assets/js/v2/drawer/drawer.css") ?>">
<link rel="stylesheet" href="<?= base_url("assets/js/v2/pg-calendar/css/pignose.calendar.css") ?>">
<style>
.bs-popover-top .arrow:after, .bs-popover-top .arrow:before {
  border-top-color: #32243D !important;
}
.bs-popover-bottom .arrow:after, .bs-popover-bottom .arrow:before {
  border-bottom-color: #32243D !important;
}
.modal {
    z-index: 1051 !important;
}
.fc-event-main{
    font-size: 15px !important;
    padding: 5px;
    overflow: auto;
}
.timepicker-icon{
    font-size: 30px;
}
.calendar-tile-details{
    display: none;
    padding: 5px;
    /*margin-top: 11px;*/
}
.calendar-title-header{    
    padding: 2px;
    display: inline-flex;
    /*border-bottom: 1px solid;*/
    min-width: 100%;
}
.calendar-tile-details{
    border-top: 1px solid;
    padding-top: 11px !important;
}
.calendar-tile-view, .calendar-tile-add-gcalendar{
    display: inline-block;
    font-size: 12px !important;
    margin: 5px 0px !important;
    /*width: 60px;*/
}
.calendar-tile-view i, .calendar-tile-add-gcalendar i{
    position: relative;
    top: 1px;
}
.calendar-tile-minmax{
    margin-left: 0px !important;
    color: #ffffff;
}
.calendar-tile-assigned-tech{
    min-width: 25px !important;
    height: 25px !important;
    margin-right: 5px !important;
}
.calendar-tile-minmax:hover{
    color: #ffffff;
}
.fc .fc-daygrid-event{    
}
.multiple-date{
    z-index: 999 !important;
}
.select2-results__option {
    text-align: left;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    text-align: left;
}
.autocomplete-img{
  height: 50px;
  width: 50px;
}
.autocomplete-left{
  display: inline-block;
  width: 65px;
}
.autocomplete-right{
    display: inline-block;
    width: 80%;
    vertical-align: top;
}
.clear{
  clear: both;
}
#btn_edit_job_ticket, #btn_edit_appointment, #btn_delete_appointment, #btn_edit_tcoff, #btn_delete_tcoff{
    width: 140px;
}
.quick-calendar-tile span {
    font-size: 16px;
    font-weight: bold;
    display: inline-block;
    color: #ffffff;
}
.fc-list-event-title .quick-calendar-tile span {    
    color: #000000 !important;
    line-height: 9px;
}
.modal-backdrop{
    width: 100%;
    height: 100%;
}
@media (min-width: 1200px) {
    .modal-xl {
        max-width: 1198px !important;
    }
}

@media (max-width : 600px) {
    .modal-lg {
        max-width: 600px !important;
    }
}

@media (max-width : 428px) {
    .modal-lg {
        max-width: 400px !important;
    }
}
</style>
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
                            <input type="hidden" id="time-zone-selector" value="<?= $default_timezone; ?>">
                            <label class="content-title mt-1 d-inline-block"><?= $default_timezone; ?> </label> <a href="<?= base_url('settings/schedule') ?>" class="nsm-link ms-3">Change</a>
                        </div>
                        <div class="col-12 col-md-8 grid-mb text-end">
                            <div class="nsm-page-buttons page-button-container">
                                <!-- <button type="button" class="nsm-button" id="btn_add_calendar">
                                    <i class='bx bx-fw bx-calendar-plus'></i> Add Calendar
                                </button> -->
                                <button type="button" class="nsm-button" id="btn-quick-add-service-ticket">
                                    <i class='bx bx-fw bx-calendar-event'></i> New Service Ticket
                                </button>
                                <button type="button" class="nsm-button" id="calendar-tc-off">
                                    <i class='bx bx-fw bx-calendar-event'></i> Schedule Technician Off
                                </button>

                                <button type="button" class="nsm-button" id="btn-quick-add-event">
                                    <i class='bx bx-fw bx-calendar-event'></i> New Event
                                </button>
                                <button type="button" class="nsm-button" id="btn-quick-add-job">
                                    <i class='bx bx-fw bx-message-square-error'></i> New Job
                                </button>
                                <button type="button" class="nsm-button drawer-toggle">
                                    <i class='bx bxs-calendar'></i> Mini Calendar
                                </button>

                                <?php if (!empty($users)) : ?>
                                    <div class="nsm-input-group ms-2">
                                        <div class="input-group">
                                            <select multiple="multiple" id="select-employee" class="multiple-select nsm-field form-select" placeholder="Select Employees">
                                                <?php foreach ($users as $user) { ?>
                                                    <option <?= in_array($user->id, $a_default_uid) ? 'selected="selected"' : ''; ?> value="<?php echo $user->id ?>"><?php echo $user->FName ?> <?php echo $user->LName ?></option>
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
                    <div class="col-12 col-md-12">
                        <div class="row g-3">
                            <div class="col-12 mb-3">
                                <div id="quick-access-calendar-loading"></div>
                                <div id='calendar'></div>
                            </div>
                            <div class="col-12">
                                <div class="nsm-card primary">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title">
                                            <span>Upcoming Schedules</span>
                                        </div>                                        
                                    </div>
                                    <div class="nsm-card-content" id="upcoming_schedules_container"></div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div class="calendar-drawer drawer--right">
                    <header role="banner">
                        <nav class="drawer-nav" role="navigation">
                          <ul class="drawer-menu">
                            <li><?php include viewPath('v2/includes/calendar/drawer_nav'); ?></li>                            
                          </ul>
                        </nav>
                      </header>
                </div>

            </div>
        </div>
    </div>
    <?php include viewPath('v2/includes/customer/quick_add_customer'); ?>
    <?php include viewPath('v2/includes/customer/other_address'); ?>
</div>
<?php if ($onlinePaymentAccount) { ?>
    <?php if ($onlinePaymentAccount->paypal_client_id != '' && $onlinePaymentAccount->paypal_client_secret != '') { ?>
        <script src="https://www.paypal.com/sdk/js?client-id=<?= $onlinePaymentAccount->paypal_client_id; ?>&currency=USD&disable-funding=credit,card"></script>
    <?php } ?>
<?php } ?>
<script src='<?= base_url("assets/js/v2/pg-calendar/pignose.calendar.full.js") ?>'></script>
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://checkout.stripe.com/checkout.js"></script>

<!-- Map files -->
<script src='https://unpkg.com/popper.js/dist/umd/popper.min.js'></script>
<script type="text/javascript" src="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/maplibre-gl@1.15.2/dist/maplibre-gl.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.umd.js"></script>
<link href="https://cdn.maptiler.com/maptiler-sdk-js/v2.0.3/maptiler-sdk.css" rel="stylesheet" />
<script src="https://cdn.maptiler.com/leaflet-maptilersdk/v2.0.0/leaflet-maptilersdk.js"></script>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/styles/minimal.css" />
<script src="https://unpkg.com/@geoapify/geocoder-autocomplete@1.4.0/dist/index.min.js"></script>
<!-- End Map files -->

<script type="text/javascript">

    var calendar;
    var selected_calendar_view = '';

    $(document).ready(function() {

        //New calendar modals
        $('#modal-quick-add-job').modal({backdrop: 'static', keyboard: false});
        $('#modal-quick-add-service-ticket').modal({backdrop: 'static', keyboard: false});
        $('#modal-quick-add-appointment').modal({backdrop: 'static', keyboard: false});
        $('#modal-quick-add-tc-off').modal({backdrop: 'static', keyboard: false});
        $('#modal-quick-edit-tc-off').modal({backdrop: 'static', keyboard: false});

        // loadTags();
        reloadCalendar('');
        loadMiniCalendar();
        loadWaitList();
        loadUpcomingSchedules();
        //loadUpcomingJobs();
        //loadUpcomingServiceTickets();
        //loadUpcomingEvents();
        //loadUnscheduledEstimates();

        $('.calendar-drawer').drawer();

        $('.field-popover').popover();
        $('#add-employee-popover').popover();
        $('#add-customer-popover').popover({
            title: 'Which Customer', 
            content: "Pick customer from the list which the appointment will be set",
            trigger: 'hover'
        });
        $('#add-tag-popover').popover({
            title: 'Tags', 
            content: "Pick a tags that will describe this appointment",
            trigger: 'hover'
        });        
        /*$('#wait-list-add-employee-popover').popover({    
            content:'Who will attend the event',
            title:'Attendees',        
            trigger: 'hover'
        });*/        
        $('#wait-list-add-sales-agent-popover').popover({
            title: 'Which Sales Agent', 
            content: "Assign Sales Agent that will handle the service or job",
            trigger: 'hover'
        });
        $('#waitlist-date-popover').popover({
            title: 'Date', 
            content: "Your Preffered Appointment Date",
            trigger: 'hover'
        });
        $('#waitlist-time-popover').popover({
            title: 'Time', 
            content: "Your Preffered Appointment Time",
            trigger: 'hover'
        });
        $('#waitlist-customer-popover').popover({
            title: 'Which Customer', 
            content: "Pick customer from the list which the appointment will be set",
            trigger: 'hover'
        });
        $('#waitlist-appointment-type-popover').popover({
            title: 'Appointment Type', 
            content: "Select what kind of appointment will this be",
            trigger: 'hover'
        });
        $('#wait-list-add-customer-popover').popover();
        $('#wait-list-add-tag-popover').popover();

        $("#select-employee").multipleSelect({selectAll:false});

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
        });

        $("#btn_add_calendar").on("click", function() {
            let _modal = $("#create_calendar_modal");
            _modal.modal("show");
        });

        $('#wait-list-appointment-customer').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data,
                    };
                },
                cache: true
            },
            placeholder: 'Select Customer',
            dropdownParent: $("#create_waitlist_modal"),
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        $("#btn_add_wait_list").on("click", function() {
            let _modal = $("#create_waitlist_modal");
            // loadCompanyCustomers($("#wait-list-appointment-customer"));
            _modal.modal("show");
        });

        $(document).on("submit", "#create-google-calendar", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('/calendar/_create_google_calendar'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "New calendar fee has been added successfully.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#create_calendar_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $('.datepicker').datepicker({
            //format: 'yyyy-mm-dd',
            format: 'DD, MM dd, yyyy',
            autoclose: true,
        });

        $(".timepicker").datetimepicker({
            format: 'hh:mm A'
        });

        var dateNow = new Date();

        $(".timepicker-from").datetimepicker({            
            format: 'hh:mm A',            
        }).on('dp.change', function(e){             
            var default_interval = "<?= $default_time_to_interval; ?>";
            if( default_interval > 0 ){
                var formatedValue = e.date.format(e.date._f);
                var newDateTime = moment(formatedValue, "LT").add(default_interval, 'hours').format('LT');
                $('.timepicker-to').val(newDateTime);            
            }            
        });

        $(".timepicker-to").datetimepicker({
            format: 'hh:mm A'
        });

        $(document).on("submit", "#frm-create-appointment", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('calendar/_create_appointment'); ?>";
            _this.find("button[type=submit]").html("Scheduling");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Appointment was successfully created.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                reloadCalendar(selected_calendar_view);
                                loadUpcomingSchedules();
                            //}
                        });

                        $("#create_appointment_modal").modal('hide');
                        _this.trigger("reset");
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.msg,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }                    

                    _this.find("button[type=submit]").html("Schedule");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("submit", "#frm-create-appointment-wait-list", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('calendar/_create_appointment_wait_list'); ?>";
            _this.find("button[type=submit]").html("Scheduling");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        $('#waitlist-date').val('');
                        $('#waitlist-time-from').val('');
                        $('#waitlist-time-to').val('');
                        $("#wait-list-appointment-customer").empty().trigger('change');
                        $("#create_waitlist_modal").modal('hide');
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Appointment wait list was successfully created.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                reloadCalendar();
                                loadWaitList();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    _this.find("button[type=submit]").html("Schedule");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("change", "#select-employee", function(e) {
            let url = "<?php echo base_url('calendar/_update_employee_filter'); ?>";
            var eids = $(this).val();            
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    eids: eids
                },
                dataType: 'json',
                success: function(o) {
                    reloadCalendar('employeeTimeline');
                }
            });
        });

        /*$('#appointment-user').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_users',
                dataType: 'json',
                delay: 250,                
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            dropdownParent: $("#create_appointment_modal"),
            placeholder: 'Select User',
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            templateSelection: formatRepoSelectionUser
        });*/

        $('#tc-off-users').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_users',
                dataType: 'json',
                delay: 250,                
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            dropdownParent: $("#create_tc_off_modal"),
            placeholder: 'Select User',
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            templateSelection: formatRepoSelectionUser
        });

        $('#tc-off-assign-to').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_users',
                dataType: 'json',
                delay: 250,                
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            dropdownParent: $("#create_tc_off_modal"),
            placeholder: 'Select User',
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            templateSelection: formatRepoSelectionUser
        });

        $('#appointment-sales-agent-id').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_users',
                dataType: 'json',
                delay: 250,                
                data: function(params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                /*formatResult: function(item) {
                    return '<div>' + item.FName + ' ' + item.LName + '<br />test<small>' + item.email + '</small></div>';
                },*/
                cache: true
            },
            dropdownParent: $("#create_appointment_modal"),
            placeholder: 'Select User',
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            templateSelection: formatRepoSelectionUser
        });

        $('#appointment-customer').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_customer',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data,
                        // pagination: {
                        //   more: (params.page * 30) < data.total_count
                        // }
                    };
                },
                cache: true
            },
            dropdownParent: $("#create_appointment_modal"),
            placeholder: 'Select Customer',
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        $('#appointment-customer').on("select2:select", function(e) { 
            let prof_id = e.params.data.id;
            let url = "<?= base_url('customer/_load_customer_address') ?>";

            $.ajax({
                type: "POST",
                url: url,
                data: {prof_id: prof_id},
                success: function(result) {
                    $('.customer-address').html(result);
                }
            });
        });

        $('#appointment-tags').select2({
            ajax: {
                url: base_url + 'autocomplete/_company_job_tags',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            dropdownParent: $("#create_appointment_modal"),
            placeholder: 'Select Tags',
            minimumInputLength: 0,
            templateResult: formatRepoTag,
            templateSelection: formatRepoTagSelection
        });        

        $(".btn-quick-add-customer").on("click", function() {
            let _this = $(this);
            let _parent = _this.closest(".nsm-modal");
            _parent.modal("hide");
            $("#quick_add_customer_modal").attr("parent-modal-id", _this.closest(".nsm-modal").attr("id"));
            $("#quick_add_customer_modal").modal("show");
        });

        $(document).on("submit", "#frm-ql-add-customer", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('quick_add/_add_customer'); ?>";
            let parentModalId = $("#quick_add_customer_modal").attr("parent-modal-id");
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                data: _this.serialize(),
                dataType: 'json',
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "New customer was successfully added.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            if (result.value) {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#quick_add_customer_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                    $("#" + parentModalId).modal("show");
                },
            });
        });

        $(document).on("click", ".btn-edit-waitlist", function() {
            let appointment_id = $(this).attr('data-id');
            let url = "<?php echo base_url('calendar/_load_edit_wait_list'); ?>";

            showLoader($("#update_waitlist_container"));
            $("#update_waitlist_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    appointment_id: appointment_id
                },
                success: function(result) {
                    $("#wid").val(appointment_id);
                    $("#btn_delete_waitlist").attr("data-id", appointment_id);
                    $("#update_waitlist_container").html(result);
                    initializeEditWaitList();
                }
            });
        });

        $(document).on("submit", "#frm-update-appointment-wait-list", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('calendar/_update_appointment_wait_list'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        if (result.is_wait_list == 0) {
                            var swal_text = "Wait list was successfully moved to calendar.";
                        } else {
                            var swal_text = "Appointment wait list was successfully updated.";
                        }

                        Swal.fire({
                            title: 'Save Successful!',
                            text: swal_text,
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                loadWaitList()
                            //}
                        });
                    } else {
                        $("#w_is_wait_list").val(0);
                        Swal.fire({
                            title: 'Error',
                            text: result.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#update_waitlist_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", "#btn_delete_waitlist", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Wait List',
                text: "Do you want to delete selected wait list?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('calendar/_delete_appointment'); ?>",
                        data: {
                            appointment_id: id
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Appointment wait list was successfully deleted.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        $("#update_waitlist_modal").modal("hide");
                                        loadWaitList();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.message,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $("#btn_edit_appointment").on("click", function() {
            let appointment_id = $(this).attr('data-id');
            let url = "<?= base_url('calendar/_edit_appointment') ?>";

            $("#edit-aid").val(appointment_id);
            $("#view_appointment_modal").modal('hide');
            $("#edit_appointment_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    appointment_id: appointment_id
                },
                success: function(result) {
                    $('#edit_appointment_container').html(result);
                }
            });
        });

        $(document).on("submit", "#frm-update-appointment", function(e) {
            let _this = $(this);
            e.preventDefault();

            var url = "<?php echo base_url('calendar/_update_appointment'); ?>";
            _this.find("button[type=submit]").html("Saving");
            _this.find("button[type=submit]").prop("disabled", true);

            $.ajax({
                type: 'POST',
                url: url,
                dataType: "json",
                data: _this.serialize(),
                success: function(result) {
                    if (result.is_success) {
                        Swal.fire({
                            title: 'Save Successful!',
                            text: "Appointment was successfully updated.",
                            icon: 'success',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        }).then((result) => {
                            //if (result.value) {
                                reloadCalendar();
                                loadUpcomingSchedules();
                            //}
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: result.message,
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }
                    $("#edit_appointment_modal").modal('hide');
                    _this.trigger("reset");

                    _this.find("button[type=submit]").html("Save");
                    _this.find("button[type=submit]").prop("disabled", false);
                },
            });
        });

        $(document).on("click", "#btn_delete_appointment", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Appointment',
                text: "Do you want to delete selected appointment?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('calendar/_delete_appointment'); ?>",
                        data: {
                            appointment_id: id
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Appointment was successfully deleted.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        $("#view_appointment_modal").modal("hide");
                                        reloadCalendar();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.message,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $(document).on("click", "#btn_delete_tcoff", function() {
            let id = $(this).attr('data-id');

            Swal.fire({
                title: 'Delete Technician Off',
                text: "Do you want to delete selected technician off?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url('calendar/_delete_tcoff'); ?>",
                        data: {
                            tcoff_id: id
                        },
                        dataType: 'json',
                        success: function(result) {
                            if (result.is_success) {
                                Swal.fire({
                                    title: 'Good job!',
                                    text: "Technician schedule off was successfully deleted.",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                }).then((result) => {
                                    if (result.value) {
                                        $("#view_tcoff_modal").modal("hide");
                                        reloadCalendar();
                                    }
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: result.message,
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonText: 'Okay'
                                });
                            }
                        },
                    });
                }
            });
        });

        $("#btn_checkout_appointment").on("click", function() {
            let appointment_id = $(this).attr('data-id');
            let url = "<?= base_url('calendar/_appointment_checkout') ?>";

            $("#view_appointment_modal").modal("hide");
            $("#checkout_appointment_modal").modal("show");

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    appointment_id: appointment_id
                },
                success: function(result) {
                    $('#checkoout_appointment_container').html(result);
                }
            });
        });

        $(document).on("click", ".btn-add-item-row", function() {
            let id = $(this).attr('data-id');

            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('items/_get_item_details'); ?>",
                data: {
                    itemid: id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.is_exists) {
                        let item_price = parseFloat(result.item_price);
                        let append_row = '<tr>' +
                            '<td>' +
                            '<input type="text" name="item_name[]" class="nsm-field form-control" placeholder="Item Name" value="' + result.item_name + '" required>' +
                            '<input type="hidden" name="item_id[]" class="nsm-field form-control" placeholder="Item ID" value="' + result.item_id + '" required>' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="price[]" class="nsm-field form-control item-price" placeholder="Item Price" value="' + item_price.toFixed(2) + '" required>' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="qty[]" class="nsm-field form-control item-qty" placeholder="Quantity" value="1" required>' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="tax[]" class="nsm-field form-control item-tax" placeholder="Tax Percentage" value="0.00" required>' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="discount[]" class="nsm-field form-control item-discount" placeholder="Item Discount" value="0.00" required>' +
                            '</td>' +
                            '<td>' +
                            '<button type="button" class="nsm-button btn-sm btn-delete-item">Remove</button>' +
                            '</td>' +
                            '</tr>';

                        $("#checkout_items_table tbody").append(append_row).find("tr:last").hide().fadeIn("slow");
                        $("#checkout_items_table").find(".nsm-table-empty").addClass("d-none");
                        $("#checkout_items_table").nsmPagination();
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: "Cannot find item.",
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'Okay'
                        });
                    }

                    computeCheckoutTotals();
                    $("#checkout_add_item_modal").modal("hide");
                },
            });
        });

        $("#btn_payment_details_appointment").on("click", function() {
            var appointment_id = $(this).attr('data-id');
            let url = "<?php echo base_url('calendar/_view_appointment_payment_details'); ?>";

            $("#appointment_details_modal").modal('show');
            showLoader($("#appointment_details_container"));

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    appointment_id: appointment_id
                },
                success: function(result) {
                    $("#appointment_details_container").html(result);
                }
            });
        });
    });

    function reloadCalendar(default_view) {
        let _calendar = document.getElementById('calendar');
        let _timezone = document.getElementById('time-zone-selector');
        let events = <?php echo json_encode($events) ?>;
        let customer_events = <?php echo json_encode($resources_user_events) ?>;

        renderCalendar(_calendar, _timezone, events, default_view);

        /*window.setTimeout( function(){
            $('.calendar-tile-details').hide();
        }, 1500 );*/
    }

    function renderCalendar(_calendar, _timezone, events, default_view) {
        let bc_events_url = "<?= base_url('calendar/_get_main_calendar_events') ?>";
        let bc_resources_url = "<?= base_url('calendar/_get_main_calendar_resources') ?>";
        let bc_resource_users_url = "<?= base_url('calendar/_get_main_calendar_resource_users') ?>";
        let scrollTime = moment().format("HH") + ":00:00";
        let default_calendar_tab = '<?= $default_calendar_view; ?>';
        
        if( default_calendar_tab == 'Employee' ){
            default_calendar_tab = 'employeeTimeline';
        }

        if( default_calendar_tab == 'Month' ){
            default_calendar_tab = 'monthView';   
        }

        if( default_calendar_tab == 'Day' ){
            default_calendar_tab = 'dayView';   
        }

        if( default_calendar_tab == '3 days' ){
            default_calendar_tab = 'threeDaysView';   
        }

        if( default_calendar_tab == 'Week' ){
            default_calendar_tab = 'weekView';   
        }

        if( default_calendar_tab == 'List' ){
            default_calendar_tab = 'listView';   
        }

        if( default_view != '' ){
            default_calendar_tab = default_view;      
        }

        calendar = new FullCalendar.Calendar(_calendar, {
            schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
                center: 'employeeTimeline,monthView,dayView,threeDaysView,weekView,listView' // buttons for switching between views
            },
            themeSystem: 'bootstrap5',
            eventDisplay: 'block',
            contentHeight: 750,
            initialView: default_calendar_tab,  
            progressiveEventRendering: false,    
            firstDay: '<?= $calendar_start_day; ?>',      
            views: {
                employeeTimeline: {
                    type: 'resourceTimeGridDay',
                    buttonText: 'Employee',
                    allDaySlot: false,
                    nowIndicator: true,
                    slotDuration: '00:15',
                    slotLabelInterval: '01:00',
                    editable: false,
                    droppable: false,
                    scrollTime: scrollTime
                },
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
                weekView: {                    
                    nowIndicator: true,
                    type: 'timeGridWeek',
                    buttonText: 'Week',
                    allDaySlot: true, 
                    expandRows: true,
                    editable: true,
                    droppable: true,
                    scrollTime: scrollTime,
                },
                listView: {
                    type: 'listWeek',
                    buttonText: 'List',
                    editable: false,
                    droppable: false
                },
                threeDaysView: {
                    type: 'resourceTimeGrid',
                    //type: 'timeGrid',
                    datesAboveResources: true,
                    allDaySlot: false,
                    editable: false,
                    droppable: false,
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
            eventDidMount : function(info) {  
                /*if( info.event._def.extendedProps.eventType == 'jobs' ){
                    $(info.el).addClass('multiple-date');
                }
                console.log(info);       */
            },  
            dayCellDidMount(info) {                         
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-toggle", "popover");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-trigger", "hover focus");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-placement", "top");
                $(info.el).find(".fc-daygrid-day-top").attr("data-bs-content", "<i class='bx bxs-calendar-plus'></i> Create Schedule");

                $('.fc-timegrid-slot:before').attr("data-bs-toggle", "popover");
                $('.fc-timegrid-slot:before').attr("data-bs-trigger", "hover focus");
                $('.fc-timegrid-slot:before').attr("data-bs-placement", "top");
                $('.fc-timegrid-slot:before').attr("data-bs-content", "<i class='bx bxs-calendar-plus'></i> Create Schedule");

                initPopover();
            },
            selectable: true,
            slotEventOverlap: true,
            eventOverlap: true,
            select: function(info) {    
                var result = info.hasOwnProperty('resource');
                var date_selected = moment(info.startStr).format('YYYY-MM-DD');

                if (result) {
                    var user_id = info.resource._resource.id;
                    user_id = user_id.replace("user", "");
                    var user_name = info.resource._resource.extendedProps.employee_name;
                } else {
                    var user_id = 0;
                    var user_name = '';
                }

                $('#quick-add-date-selected').val(date_selected);
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
                var appointment_id   = arg.event._def.extendedProps.eventId;
                var appointment_type = arg.event._def.extendedProps.eventType;
                var order_number     = arg.event._def.extendedProps.eventOrderNum;
                var esign_id         = arg.event._def.extendedProps.esignId;
                var status           = arg.event._def.extendedProps.eventStatus;
                var customer_id      = arg.event._def.extendedProps.customerId;

                //console.log('props', arg.event._def.extendedProps);
                if ( appointment_type == 'job' ) {
                    var url = base_url + "job/_quick_view_details?view=calendar";     
                    //$('#upcoming-schedule-view-more-details').show();               
                } else if ( appointment_type == 'booking' ) {
                    location.href = base_url + 'promote/view_booking/' + appointment_id;
                } else if ( appointment_type == 'appointment' ) {
                    var url = base_url + "calendar/_view_appointment";
                    //$('#upcoming-schedule-view-more-details').hide();
                } else if ( appointment_type == 'service_ticket' || appointment_type == 'ticket' ) {
                    var url = base_url + "ticket/_quick_view_details";      
                    //$('#upcoming-schedule-view-more-details').show();              
                } else if( appointment_type == 'tc-off' ) {
                    var url = base_url + "calendar/_quick_view_tc_off"; 
                    //$('#upcoming-schedule-view-more-details').hide();                   
                } else if( appointment_type == 'event' ) {
                    var url = base_url + "event/_quick_view_event?view=calendar";               
                } else if( appointment_type == 'workorder' ) {
                    var url = base_url + "workorder/_quick_view_details"; 
                }

                $('#modal-quick-access-calendar-schedule').modal('hide');
                $('#modal-quick-view-upcoming-schedule').attr('data-source', '');
                $('#modal-quick-view-upcoming-schedule').modal('show');

                $('#upcoming-schedule-view-more-details').attr('data-type', appointment_type);
                $('#upcoming-schedule-view-more-details').attr('data-id', appointment_id);

                $('#quick-add-gcalendar').attr('data-type', appointment_type);
                $('#quick-add-gcalendar').attr('data-id', appointment_id);

                $('#edit-upcoming-schedule').attr('data-type', appointment_type);
                $('#edit-upcoming-schedule').attr('data-id', appointment_id);

                $('#send-esign').attr('data-type', appointment_type);
                $('#send-esign').attr('data-id', appointment_id);
                $('#send-esign').attr('data-customer-id', customer_id);

                $('#view-esign').attr('data-id', esign_id);

                $('#send-ticket-esign').attr('data-type', appointment_type);
                $('#send-ticket-esign').attr('data-id', appointment_id);
                $('#send-ticket-esign').attr('data-customer-id', customer_id);

                <?php if( checkRoleCanAccessModule('calendar-schedule', 'delete') ){ ?>  
                    $('#delete-upcoming-schedule').attr('data-type', appointment_type);
                    $('#delete-upcoming-schedule').attr('data-id', appointment_id);
                    $('#delete-upcoming-schedule').attr('data-ordernum', order_number);
                <?php } ?>

                // Job Status 
                $('#job-status-arrived').attr('data-type', appointment_type);
                $('#job-status-arrived').attr('data-id', appointment_id);

                $('#job-status-started').attr('data-type', appointment_type);
                $('#job-status-started').attr('data-id', appointment_id);

                $('#job-status-finished').attr('data-type', appointment_type);
                $('#job-status-finished').attr('data-id', appointment_id);
                $('#job-status-finished').attr('data-ordernum', order_number);
                // End Job Status

                // Ticket Status
                $('#ticket-status-arrived').attr('data-type', appointment_type);
                $('#ticket-status-arrived').attr('data-id', appointment_id);

                $('#ticket-status-started').attr('data-type', appointment_type);
                $('#ticket-status-started').attr('data-id', appointment_id);

                $('#ticket-status-finished').attr('data-type', appointment_type);
                $('#ticket-status-finished').attr('data-id', appointment_id);
                $('#ticket-status-finished').attr('data-ordernum', order_number);
                // End Ticket Status
                console.log('esign', esign_id);
                if( appointment_type == 'job' ){
                    if( esign_id > 0 ){
                        $('#view-esign').css('display', 'inline-block');
                        $('#send-esign').css('display', 'none');
                    }else{
                        $('#send-esign').css('display', 'inline-block');
                        $('#view-esign').css('display', 'none');
                    }
                    //$('#send-esign').css('display', 'inline-block');
                    if( status == 'Scheduled' ){
                        $('#job-status-arrived').css('display', 'inline-block');
                        $('#job-status-started').css('display', 'none');
                        $('#job-status-finished').css('display', 'none');
                    }else if( status == 'Arrival' ){
                        $('#job-status-started').css('display', 'inline-block');
                        $('#job-status-arrived').css('display', 'none');
                        $('#job-status-finished').css('display', 'none');
                    }else if( status == 'Approved' ){
                        $('#job-status-finished').css('display', 'inline-block');
                        $('#job-status-started').css('display', 'none');
                        $('#job-status-arrived').css('display', 'none');
                    }else{
                        $('#job-status-arrived').css('display', 'none');
                        $('#job-status-started').css('display', 'none');
                        $('#job-status-finished').css('display', 'none');
                    }
                }else{
                    $('#send-esign').css('display', 'none');
                    $('#job-status-arrived').css('display', 'none');
                    $('#job-status-started').css('display', 'none');
                    $('#job-status-finished').css('display', 'none');
                }

                if( appointment_type == 'service_ticket' || appointment_type == 'ticket' ){
                    if( esign_id > 0 ){
                        $('#view-esign').css('display', 'inline-block');
                        $('#send-ticket-esign').css('display', 'none');
                    }else{
                        $('#send-ticket-esign').css('display', 'inline-block');
                        $('#view-esign').css('display', 'none');
                    }
                    //$('#send-ticket-esign').css('display', 'none');
                    if( status == 'Scheduled' ){
                        $('#ticket-status-arrived').css('display', 'inline-block');
                        $('#ticket-status-started').css('display', 'none');
                        $('#ticket-status-finished').css('display', 'none');
                    }else if( status == 'Arrived' ){
                        $('#ticket-status-started').css('display', 'inline-block');
                        $('#ticket-status-arrived').css('display', 'none');
                        $('#ticket-status-finished').css('display', 'none');
                    }else if( status == 'Approved' ){
                        $('#ticket-status-finished').css('display', 'inline-block');
                        $('#ticket-status-started').css('display', 'none');
                        $('#ticket-status-arrived').css('display', 'none');
                    }else{
                        $('#ticket-status-arrived').css('display', 'none');
                        $('#ticket-status-started').css('display', 'none');
                        $('#ticket-status-finished').css('display', 'none');
                    }
                }else{
                    $('#send-ticket-esign').css('display', 'none');    
                    $('#send-esign').css('display', 'none');
                    $('#ticket-status-arrived').css('display', 'none');
                    $('#ticket-status-started').css('display', 'none');
                    $('#ticket-status-finished').css('display', 'none');                
                }

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
            eventOrder: ["starttime"],
        });

        calendar.render();

    }

    function loadMiniCalendar() {
        $('.mini-calendar').pignoseCalendar({
            click: function(event, context) {
                // this is clicked button.
                var $this = $(this);

                return false;
            },
            scheduleOptions: {
                colors: {
                    /*job: '#2fabb7',
                    event: '#5c6270',
                    estimate: '#ef8080',
                    ticket: '#FF751A',
                    appointment: '#38A4F8',*/
                    job: '#342442',
                    event: '#342442',
                    estimate: '#342442',
                    ticket: '#342442',
                    appointment: '#342442',
                }
            },
            schedules: <?= $mini_calendar_events; ?>,
            select: miniCalenarOnSelectHandler
        });

        function miniCalenarOnSelectHandler(date, context) {            
            var selected_date = '';

            if (date[0] !== null) {
                selected_date = date[0].format('YYYY-MM-DD');
            }

            if (date[0] !== null && date[1] !== null) {
                selected_date = '';
            }
            else if (date[0] === null && date[1] == null) {
                selected_date = '';
            }

            if (date[1] !== null) {
                selected_date = date[1].format('YYYY-MM-DD');
            }

            $('#view_upcoming_schedules_modal').modal('show');

            let url = "<?= base_url('calendar/_load_upcoming_calendar_by_date') ?>";
            let _container = $("#view_upcoming_schedules_container");
            showLoader(_container);

            $.ajax({
                type: 'POST',
                url: url,
                data:{selected_date:selected_date},
                success: function(result) {
                    _container.hide().html(result).fadeIn(500);
                },
            });
        }

        $('.pignose-calendar-button-schedule-container').prev('span.event-date').addClass('event-font-white');
        /*let events_url = "<?= base_url('settings/_get_google_enabled_calendars') ?>";
        let _calendar = document.getElementById('right-calendar');

        var calendar = new FullCalendar.Calendar(_calendar, {
            schedulerLicenseKey: '0531798248-fcs-1598103289',
            themeSystem: 'bootstrap5',
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

        calendar.render();*/
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

    function loadUpcomingSchedules() {
        let url = "<?= base_url('calendar/_load_upcoming_schedules') ?>";
        let _container = $("#upcoming_schedules_container");

        showLoader(_container);

        $.ajax({
            async:false,
            type: 'POST',
            url: url,
            data: {},
            success: function(result) {
                _container.html(result);
                $("#upcoming_schedules_table").nsmPagination({itemsPerPage:5});
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

    function loadUpcomingServiceTickets() {
        let url = "<?= base_url('calendar/_load_upcoming_service_tickets') ?>";
        let _container = $("#upcoming_service_tickets_container");

        showLoader(_container);

        $.ajax({
            type: 'POST',
            url: url,
            data: {},
            success: function(result) {
                _container.html(result);
                $("#upcoming_service_tickets_table").nsmPagination();
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
            return new bootstrap.Popover(popoverTriggerEl,{html: true})
        })
    }

    function loadTags() {
        let url = "<?= base_url('autocomplete/_company_event_tags') ?>";
        let _container = $("#appointment-tags");

        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            success: function(result) {
                $.each(result, function(i, o) {
                    _container.append("<option value='" + o.id + "'>" + o.name + "</option>");
                });

                $("#appointment-tags").multipleSelect();
            },
        });
    }

    function formatRepoCustomer(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div>' + repo.first_name + ' ' + repo.last_name + '<br /><small>' + repo.address + ' / ' + repo.email + '</small></div>'
        );

        return $container;
    }

    function formatRepoCustomerSelection(repo) {
        if (repo.first_name != null) {
            return repo.first_name + ' ' + repo.last_name;
        } else {
            return repo.text;
        }
    }

    function formatRepoUser(repo) {
        if (repo.loading) {
            return repo.text;
        }

        // var $container = $(
        //     '<div><div class="autocomplete-left"><img class="autocomplete-img" src="' + repo.user_image + '" /></div><div class="autocomplete-right">' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        // );
        var $container = $(
            '<div>' + repo.FName + ' ' + repo.LName + '<br /><small>' + repo.email + '</small></div></div>'
        );

        return $container;
    }

    function formatRepoSelectionUser(repo) {
        return (repo.FName) ? repo.FName + ' ' + repo.LName : repo.text;
    }

    function formatRepoTag(repo) {
        if (repo.loading) {
            return repo.text;
        }

        var $container = $(
            '<div class="d-flex align-items-center"><label>' + repo.name + '</label></div>'
        );

        return $container;
    }

    function formatRepoTagSelection(repo) {
        if (repo.name != null) {
            return repo.name;
        } else {
            return repo.text;
        }

    }

    function initializeEditWaitList() {
        $('#wishlist-edit-appointment-user').select2({
            ajax: {
                url: "<?= base_url('autocomplete/_company_users') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                formatResult: function(item) {
                    return '<div>' + item.FName + ' ' + item.LName + '<br /><small>' + item.email + '</small></div>';
                },
                cache: true
            },
            dropdownParent: $("#update_waitlist_modal"),
            placeholder: 'Select User',
            minimumInputLength: 0,
            templateResult: formatRepoUser,
            templateSelection: formatRepoSelectionUser
        });

        $('#wishlist-edit-appointment-customer').select2({
            ajax: {
                url: "<?= base_url('autocomplete/_company_customer') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            dropdownParent: $("#update_waitlist_modal"),
            placeholder: 'Select Customer',
            minimumInputLength: 0,
            templateResult: formatRepoCustomer,
            templateSelection: formatRepoCustomerSelection
        });

        $('#wishlist-edit-appointment-tags').select2({
            ajax: {
                url: "<?= base_url('autocomplete/_company_job_tags') ?>",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;

                    return {
                        results: data,
                    };
                },
                cache: true
            },
            dropdownParent: $("#update_waitlist_modal"),
            placeholder: 'Select Tags',
            minimumInputLength: 0,
            templateResult: formatRepoTag,
            templateSelection: formatRepoTagSelection
        });

        $('.datepicker').datepicker({
            //format: 'yyyy-mm-dd',
            format: 'DD, MM dd, yyyy',
            autoclose: true,
        });

        $(".timepicker").datetimepicker({            
            format: 'hh:mm A',
            icons: {                
                up: "bx bx-chevron-up",
                down: "bx bx-chevron-down",
                next: 'bx bx-chevron-right',
                previous: 'bx bx-chevron-left'
            },
        });
    }

    function viewAppointment(appointment_id) {
        let url = "<?php echo base_url('calendar/_view_appointment'); ?>";

        $("#view_appointment_modal").modal('show');
        showLoader($("#view_appointment_container"));

        $.ajax({
            type: "POST",
            url: url,
            data: {
                appointment_id: appointment_id
            },
            success: function(result) {
                $("#btn_edit_appointment").attr("data-id", appointment_id);
                $("#btn_delete_appointment").attr("data-id", appointment_id);
                $("#btn_checkout_appointment").attr("data-id", appointment_id);
                $("#btn_payment_details_appointment").attr("data-id", appointment_id);

                $("#view_appointment_container").html(result);
            }
        });
    }

    function viewJob(appointment_id) {
        let url = base_url + "job/_quick_view_details?view=calendar";

        $("#modal-view-upcoming-jobs-tickets").modal('show');
        showLoader($(".view-schedule-container"));

        $('#btn_edit_job_ticket').attr('data-id', appointment_id);
        $('#btn_edit_job_ticket').attr('data-type', 'job');

        $.ajax({
            type: "POST",
            url: url,
            data: {
                appointment_id: appointment_id
            },
            success: function(result) {
                $(".view-schedule-container").html(result);
            }
        });
    }

    function viewServiceTicket(appointment_id) {
        let url = base_url + "ticket/_quick_view_details";

        $("#modal-view-upcoming-jobs-tickets").modal('show');
        showLoader($(".view-schedule-container"));

        $('#btn_edit_job_ticket').attr('data-id', appointment_id);
        $('#btn_edit_job_ticket').attr('data-type', 'ticket');

        $.ajax({
            type: "POST",
            url: url,
            data: {
                appointment_id: appointment_id
            },
            success: function(result) {
                $(".view-schedule-container").html(result);
            }
        });
    }

    function viewTCOff(tcoff_id) {
        let url = "<?php echo base_url('calendar/_view_tcoff'); ?>";

        $("#view_tcoff_modal").modal('show');
        showLoader($("#view_tcoff_container"));

        $.ajax({
            type: "POST",
            url: url,
            data: {
                tcoff_id: tcoff_id
            },
            success: function(result) {
                $("#btn_edit_tcoff").attr("data-id", tcoff_id);
                $("#btn_delete_tcoff").attr("data-id", tcoff_id);
                $("#view_tcoff_container").html(result);
            }
        });
    }

    $(document).on('click', '.fc-monthView-button', function(){
        $('.calendar-tile-details').hide();
    });

    $(document).on('click', '.fc-weekView-button', function(){  
        const current_date = '<?= date("Y-m-d"); ?>';      
        const position = $('[data-date="'+current_date+'"]').last().position();
        console.log(position);
        /*$(".fc-view-harness-active").animate({            
            scrollLeft: position.top// Scroll to 01:00 pm
        }, 1000);*/ 

        /*$('#calendar').fullCalendar('option', 'visibleRange', {
          start: '2022-11-01',
          end: '2022-11-02'
        })   */  
        /*const scroller = $('.fc-scrollgrid-section-body .fc-scroller').last();
        const [date] = moment().toISOString().split(':');
        const position = $(`.fc-timeline-slot[data-date^="${date}"]`).last().position();
        scroller.scrollLeft(600);*/
    });    

    function computeCheckoutTotals() {
        let total_price = 0;
        let total_discount = 0;
        let total_amount = 0;
        let total_tax = 0;
        let total_qty = 0;

        $('#frm-checkout-items .form-control').each(function() {
            var $el = $(this); // element we're testing
            var n = parseFloat($el.val());

            if ($el.hasClass('item-price')) {
                if ($.isNumeric(n)) {
                    var item_qty = parseFloat($el.closest('tr').find('.item-qty').val());
                    if (item_qty > 0) {
                        total_price = total_price + (parseFloat($el.val()) * item_qty);
                    } else {
                        total_price = total_price + 0;
                    }
                }
            }

            if ($el.hasClass('item-discount')) {
                if ($.isNumeric(n)) {
                    total_discount = total_discount + parseFloat($el.val());
                }
            }

            if ($el.hasClass('item-tax')) {
                if ($.isNumeric(n)) {
                    var item_price = parseFloat($el.closest('tr').find('.item-price').val());
                    var item_qty = parseFloat($el.closest('tr').find('.item-qty').val());
                    var tax_amount = (parseFloat($el.val()) / 100) * (item_price * item_qty);
                    total_tax = total_tax + tax_amount;
                }
            }
        });

        total_amount = (parseFloat(total_price) - parseFloat(total_discount)) + parseFloat(total_tax);
        if (total_amount < 0) {
            total_amount = 0;
        }

        $(".c-total-amount").text(parseFloat(total_amount).toFixed(2));
        $(".c-total-price").text(parseFloat(total_price).toFixed(2));
        $(".c-total-discount").text(parseFloat(total_discount).toFixed(2));
        $(".c-total-tax").text(parseFloat(total_tax).toFixed(2));
        $("#cash-amount-received").val(parseFloat(total_amount).toFixed(2));
        $("#converge-amount-received").val(parseFloat(total_amount).toFixed(2));
        $("#appointment-total-amount").val(parseFloat(total_amount).toFixed(2));
        $("#stripe-appointment-total-amount").val(parseFloat(total_amount).toFixed(2));
    }

    $(document).on('click', '#calendar-add-appointment', function(){
        $("#calendar_action_select_modal").modal('hide');
        $("#create_appointment_modal").modal('show');
    });

    $(document).on('click', '#calendar-add-job', function(){
        var start_date = $('#action_select_date').val();
        var start_time = $('#action_select_time').val();

        location.href = base_url + 'job/new_job1?start_date='+start_date+'&start_time='+start_time;
    });
     
    $(document).on('click', '#calendar-add-ticket', function(){
        var appointment_date = $('#appointment_date').val();
        var appointment_time = $('#appointment_time').val();
        var appointment_user_id = $('#appointment-user').val();
        var appointment_customer_id = $('#appointment-customer').val();
        var appointment_type_id = $("input[name=appointment_type_id]").val();
        var appointment_time_to = $('#appointment_time_to').val();

        // address 
        var customer_address = $('#m-customer-address').val();
        var customer_city = $('#m-customer-city').val();
        var customer_state = $('#m-customer-state').val();
        var customer_zip = $('#m-customer-zip').val();
        var customer_phone = $('#m-customer-mobile').val();

        location.href = base_url + 'tickets/addnewTicketApmt?appointment_date='+appointment_date+'&appointment_time='+appointment_time+'&appointment_user_id='+appointment_user_id+'&appointment_customer_id='+appointment_customer_id+'&appointment_type_id='+appointment_type_id+'&appointment_time_to='+appointment_time_to+'&customer_address='+customer_address+'&customer_city='+customer_city+'&customer_state='+customer_state+'&customer_zip='+customer_zip+'&customer_phone='+customer_phone;

    });

    $(".multiple-select").on('click', 'option', function() {
        if ($(".multiple-select option:selected").length > 5) {
            $(this).removeAttr("selected");
            // alert('You can select upto 3 options only');
        }
    });

    $(document).on('click', '#calendar-add-event', function(){
        var start_date = $('#action_select_date').val();
        var start_time = $('#action_select_time').val();
        var selected_user = $('#action_select_user').val();

        if( selected_user > 0 ){
            location.href = base_url + 'events/new_event?start_date='+start_date+'&start_time='+start_time+'&user='+selected_user;
        }else{
            location.href = base_url + 'events/new_event?start_date='+start_date+'&start_time='+start_time;    
        }
        
    });

    $(document).on('click', '#calendar-tc-off', function(){
        $('#create_tc_off_modal').modal('show');
    });

    $(document).on('change', '.add-appointment-priority', function(){
        var selected = $(this).val();
        if( selected == 'Others' ){
            $('.priority-others').fadeIn(500);
        }else{
            $('.priority-others').fadeOut(400);
        }
    });

    $(document).on('click', '#btn_edit_job_ticket', function(){
        var schedule_id   = $(this).data('id');
        var schedule_type = $(this).data('type');

        if( schedule_type == 'job' ){
            location.href = base_url + 'job/new_job1/' + schedule_id;
        }else if( schedule_type == 'ticket' ){
            location.href = base_url + 'tickets/editDetails/' + schedule_id;
        }
    });

    $(document).on('click', '.upcoming-tile-view', function(){
        var appointment_id   = $(this).data('id');
        var appointment_type = $(this).data('type');
        var order_number     = $(this).data('ordernum');

        if ( appointment_type == 'job' ) {
            var url = base_url + "job/_quick_view_details?view=calendar";     
            //$('#upcoming-schedule-view-more-details').show();               
        } else if ( appointment_type == 'booking' ) {
            location.href = base_url + 'promote/view_booking/' + appointment_id;
        } else if ( appointment_type == 'appointment' ) {
            var url = base_url + "calendar/_view_appointment";
            //$('#upcoming-schedule-view-more-details').hide();
        } else if ( appointment_type == 'service_ticket' || appointment_type == 'ticket' ) {
            var url = base_url + "ticket/_quick_view_details";      
            //$('#upcoming-schedule-view-more-details').show();              
        } else if( appointment_type == 'tc-off' ) {
            var url = base_url + "calendar/_quick_view_tc_off"; 
            //$('#upcoming-schedule-view-more-details').hide();                   
        } else if( appointment_type == 'event' ) {
            var url = base_url + "event/_quick_view_event?view=calendar"; 
        }

        $('#modal-quick-access-calendar-schedule').modal('hide');
        $('#modal-quick-view-upcoming-schedule').attr('data-source', '');
        $('#modal-quick-view-upcoming-schedule').modal('show');

        $('#upcoming-schedule-view-more-details').attr('data-type', appointment_type);
        $('#upcoming-schedule-view-more-details').attr('data-id', appointment_id);

        $('#quick-add-gcalendar').attr('data-type', appointment_type);
        $('#quick-add-gcalendar').attr('data-id', appointment_id);

        $('#edit-upcoming-schedule').attr('data-type', appointment_type);
        $('#edit-upcoming-schedule').attr('data-id', appointment_id);

        <?php if( checkRoleCanAccessModule('calendar-schedule', 'delete') ){ ?>  
            $('#delete-upcoming-schedule').attr('data-type', appointment_type);
            $('#delete-upcoming-schedule').attr('data-id', appointment_id);
            $('#delete-upcoming-schedule').attr('data-ordernum', order_number);
        <?php } ?>

        if( appointment_type == 'job' ){
            $('#send-esign').css('display', 'inline-block');
        }else{
            $('#send-esign').css('display', 'none');
        }

        if( appointment_type == 'service_ticket' || appointment_type == 'ticket' ){
            $('#send-ticket-esign').css('display', 'inline-block');
        }else{
            $('#send-ticket-esign').css('display', 'none');                    
        }

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

    $(document).on('click', '.fc-threeDaysView-button', function(){
        selected_calendar_view = 'threeDaysView';
    });

    /*$(document).on('click', '.fc-daygrid-event', function(){        
        $(this).next('.calendar-tile-minmax').trigger('click');
        console.log($(this).next('.calendar-tile-minmax'));
    });*/

    $(document).on('click', '#quick-add-gcalendar', function(){
        var tile_id   = $(this).attr('data-id');
        var tile_type = $(this).attr('data-type');

        let url = "<?php echo base_url('calendar/_add_to_google_calendar'); ?>";

        /*$('#loading_modal').modal('show');
        $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Connecting to your google account....');*/

        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: {
                tile_id: tile_id,
                tile_type: tile_type
            },
            success: function(result) {
                if (result.is_success) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Calendar schedule was successfully added to your google calendar.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //$('#loading_modal').modal('hide');
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //$('#loading_modal').modal('hide');       
                    });
                }
            }
        });
    });

    $(document).on("submit", "#frm-tc-off-schedule", function(e) {
        let _this = $(this);
        e.preventDefault();

        var url = "<?php echo base_url('calendar/_create_technician_off_schedule'); ?>";
        _this.find("button[type=submit]").html("Saving");
        _this.find("button[type=submit]").prop("disabled", true);

        $.ajax({
            type: 'POST',
            url: url,
            data: _this.serialize(),
            dataType: 'json',
            success: function(result) {
                if (result.is_success) {
                    Swal.fire({
                        title: 'Save Successful!',
                        text: "Technician dayoff schedule was successfully added.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            reloadCalendar(selected_calendar_view);
                        //}
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    });
                }
                $("#create_tc_off_modal").modal('hide');

                $('#tc_off_start_date').val('');
                $('#tc_off_end_date').val('');
                $('#tc-off-task-details').val('');
                $("#tc-off-users").empty().trigger('change');
                $("#tc-off-assign-to").empty().trigger('change');

                _this.trigger("reset");

                _this.find("button[type=submit]").html("Save");
                _this.find("button[type=submit]").prop("disabled", false);
            },
        });
    });

    /*New Calendar script*/

    $(document).on('click', '#calendar-quick-add-job', function(){
        var url = base_url + "job/_quick_add_job_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-job';

        $('#quick-add-service-ticket-form-container').html('');
        $('#quick-add-job-form-container').html('');

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

    $(document).on('click', '#btn-quick-add-job', function(){
        var url = base_url + "job/_quick_add_job_form";
        var default_date = moment(new Date());
        var date_selected = default_date.format('YYYY-MM-DD');        
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

    $(document).on('click', '#calendar-quick-add-service-ticket', function(){
        var url = base_url + "ticket/_quick_add_service_ticket_form";
        var date_selected   = $('#quick-add-date-selected').val();
        calendar_modal_source = 'quick-add-service-ticket';

        $('#quick-add-service-ticket-form-container').html('');
        $('#quick-add-job-form-container').html('');
        
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

    $(document).on('click', '#calendar-quick-add-event', function(){    
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

    $(document).on('click', '#btn-quick-add-event', function(){
        var url = base_url + "event/_quick_add_event_form";
        var default_date = moment(new Date());
        var date_selected = default_date.format('YYYY-MM-DD');
        calendar_modal_source = 'quick-add-event';
        
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

    $(document).on('click', '#btn-quick-add-service-ticket', function(){
       var url = base_url + "ticket/_quick_add_service_ticket_form";
       var default_date = moment(new Date());
       var date_selected = default_date.format('YYYY-MM-DD');
       calendar_modal_source = 'quick-add-service-ticket';
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

    $(document).on('click', '#calendar-quick-add-appointment', function(){
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

    $(document).on('click', '#calendar-quick-add-tc-off', function(){
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

    $(document).on('click', '#delete-upcoming-schedule', function(){
        var schedule_id   = $(this).attr('data-id');
        var schedule_type = $(this).attr('data-type');
        var order_number  = $(this).attr('data-ordernum');

        if( schedule_type == 'job' ){
            var url = base_url + 'job/_quick_delete_job';
            var msg = 'Are you sure you want to delete <b>'+ order_number +'</b>?<br /><br /><b>Note : You cannot restore job data once deleted</b>';
        }else if( schedule_type == 'service_ticket' ){
            var url = base_url + 'ticket/_quick_delete_ticket';
            var msg = 'Are you sure you want to delete <b>'+ order_number +'</b>?<br /><br /><b>Note : You cannot restore service ticket data once deleted</b>';
        }else if( schedule_type == 'tc-off' ){
            var url = base_url + 'calendar/_quick_delete_tc_off';
            var msg = 'Are you sure you want to delete selected technician schedule off?<br /><br /><b>Note : You cannot restore data once deleted</b>';
        }else if( schedule_type == 'event' ){
            var url = base_url + 'event/_quick_delete_event';
            var msg = 'Are you sure you want to delete <b>'+ order_number +'</b>?<br /><br /><b>Note : You cannot restore event data once deleted</b>'
        }else if( schedule_type == 'workorder' ){
            var url = base_url + 'workorder/_quick_delete_workorder';
            var msg = 'Are you sure you want to delete <b>'+ order_number +'</b>?<br /><br /><b>Note : You cannot restore event data once deleted</b>'
        }else{
            var url = base_url + 'calendar/_quick_delete_appointment';
            var msg = 'Are you sure you want to delete appointment <b>'+ order_number +'</b>?<br /><br /><b>Note : You cannot restore workorder data once deleted</b>';
        }

        Swal.fire({
            title: 'Delete Schedule',
            html: msg,
            icon: 'question',
            confirmButtonText: 'Proceed',
            showCancelButton: true,
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        schedule_id: schedule_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.is_success == 1) {
                            $('#modal-quick-view-upcoming-schedule').modal('hide');

                            Swal.fire({
                                //title: 'Good job!',
                                text: "Calendar schedule was successfully deleted.",
                                icon: 'success',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            }).then((result) => {
                                reloadCalendar(selected_calendar_view);
                                loadUpcomingSchedules();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: result.msg,
                                icon: 'error',
                                showCancelButton: false,
                                confirmButtonText: 'Okay'
                            });
                        }
                    },
                });
            }
        });
    });

    $(document).on('click', '#edit-upcoming-schedule', function(){
        var schedule_id   = $(this).attr('data-id');
        var schedule_type = $(this).attr('data-type');

        if( schedule_type == 'job' ){
            location.href = base_url + 'job/new_job1/' + schedule_id;
        }else if( schedule_type == 'workorder' ){
            location.href = base_url + 'workorder/_edit/' + schedule_id;
        }else if( schedule_type == 'service_ticket' ){
            location.href = base_url + 'tickets/editDetails/' + schedule_id;
        }else if( schedule_type == 'tc-off' ){
            quickEditTcOff(schedule_id);
        }else if( schedule_type == 'event' ){
            location.href = base_url + 'events/event_add/' + schedule_id;
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

    $(document).on('click', '#upcoming-schedule-view-more-details', function(){
        var appointment_type = $(this).data('type');
        var appointment_id   = $(this).data('id');
        if( appointment_type == 'job' ){
            location.href = base_url + 'job/job_preview/' + appointment_id;
        }else if( appointment_type == 'workorder' ){
            location.href = base_url + 'workorder/view/' + appointment_id;
        }else if( appointment_type == 'ticket' || appointment_type == 'service_ticket' ){
            location.href = base_url + 'tickets/viewDetails/' + appointment_id;
        }else if( appointment_type == 'tc-off' ){
            quickEditTcOff(appointment_id);
        }
    });

    $(document).on('submit', '#quick-add-job-form', function(e){
        e.preventDefault();         
        
        var url  = base_url + 'job/_create_job?view=calendar';
        var form = $(this);
        $.ajax({
            type: "POST",
            url: url,
            dataType:'json',
            data: form.serialize(), 
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-add-job').modal('hide');

                    Swal.fire({
                        text: 'Job has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        loadUpcomingSchedules();
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

    $(document).on('submit', '#quick-add-service-ticket-form', function(e){
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

                    Swal.fire({
                        title: 'Service Ticket',
                        text: 'Service ticket has been created',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                        // if( data.esign_id > 0 ){
                        //     location.href = base_url + 'eSign_v2/templatePrepare?id='+data.esign_id+'&job_id='+data.job_id+'&customer_id='+data.customer_id;
                        // }else{
                        //     location.href = base_url + 'job/new_job1/' + data.job_id
                        // }
                        //location.href = base_url + 'job/new_job1/' + data.job_id
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

    $(document).on('submit', '#quick-add-appointment-form', function(e){
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

                    Swal.fire({
                        text: 'Appointment has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        loadUpcomingSchedules();
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

    $(document).on('submit', '#quick-add-tc-off-form', function(e){
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

                    Swal.fire({
                        text: 'Technician Schedule Off has been added!',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        loadUpcomingSchedules();
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
                        reloadCalendar(selected_calendar_view);
                        loadUpcomingSchedules();
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

    $(document).on('click', '#send-esign', function(){   
        var job_id = $(this).attr('data-id');
        var customer_id = $(this).attr('data-customer-id');
        
        $('#esignJobId').val(job_id);
        $('#customer_id').val(customer_id);

        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#approveThisJobModal').modal('show');
    });

    $(document).on('click', '#send-ticket-esign', function(){     
        var ticket_id = $(this).attr('data-id');
        var customer_id = $(this).attr('data-customer-id');
        
        $('#esignTicketId').val(ticket_id);
        $('#ticket_customer_id').val(customer_id);

        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#approveThisTicketModal').modal('show');
    });

    $(document).on('click', '#job-status-arrived', function(){
        var job_id = $(this).attr('data-id');
        
        $('#calendar-job-arrival-id').val(job_id);
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-job-arrived-status').modal('show');
    });

    $(document).on('submit', '#frm-calendar-status-arrival', function(e){
        e.preventDefault();

        var data = new FormData($('#frm-calendar-status-arrival')[0]);
        data.append('job_status', 'Arrival');
        
        $.ajax({
            type: "POST",
            url: base_url + 'job/_update_job_status',
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-job-arrived-status').modal('hide');

                    Swal.fire({
                        text: 'Job status was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#frm-calendar-status-arrival :submit").html('Save');
            }, beforeSend: function() {
                $("#frm-calendar-status-arrival :submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#job-status-started', function(){
        var job_id = $(this).attr('data-id');
        
        $('#calendar-job-started-id').val(job_id);
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-job-started-status').modal('show');
    });

    $(document).on('submit', '#frm-calendar-status-started', function(e){
        e.preventDefault();

        var data = new FormData($('#frm-calendar-status-started')[0]);
        data.append('job_status', 'Started');
        
        $.ajax({
            type: "POST",
            url: base_url + 'job/_update_job_status',
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-job-started-status').modal('hide');

                    Swal.fire({
                        text: 'Job status was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#frm-calendar-status-started :submit").html('Save');
            }, beforeSend: function() {
                $("#frm-calendar-status-started :submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#job-status-finished', function(){        
        var job_id = $(this).attr('data-id');

        $('#calendar-job-finished-id').val(job_id);
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-job-finished-status').modal('show');
    });

    $(document).on('submit', '#frm-calendar-status-finished', function(e){
        e.preventDefault();

        var data = new FormData($('#frm-calendar-status-finished')[0]);
        data.append('job_status', 'Finished');
        
        $.ajax({
            type: "POST",
            url: base_url + 'job/_update_job_status',
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-job-finished-status').modal('hide');

                    Swal.fire({
                        text: 'Job status was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#frm-calendar-status-finished :submit").html('Save');
            }, beforeSend: function() {
                $("#frm-calendar-status-finished :submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#view-esign', function(){
        var esign_id  = $(this).attr('data-id');
        location.href = base_url + 'esign/view_document/' + esign_id; 
    });

    $(document).on('click', '#ticket-status-arrived', function(){
        var ticket_id = $(this).attr('data-id');
        
        $('#calendar-ticket-arrival-id').val(ticket_id);
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-ticket-arrived-status').modal('show');
    });

    $(document).on('submit', '#frm-calendar-ticket-status-arrival', function(e){
        e.preventDefault();

        var data = new FormData($('#frm-calendar-ticket-status-arrival')[0]);
        data.append('ticket_status', 'Arrived');
        
        $.ajax({
            type: "POST",
            url: base_url + 'ticket/_update_ticket_status',
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-ticket-arrived-status').modal('hide');

                    Swal.fire({
                        text: 'Service ticket status was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#frm-calendar-ticket-status-arrival :submit").html('Save');
            }, beforeSend: function() {
                $("#frm-calendar-ticket-status-arrival :submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#ticket-status-started', function(){
        var ticket_id = $(this).attr('data-id');
        
        $('#calendar-ticket-started-id').val(ticket_id);
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-ticket-started-status').modal('show');
    });

    $(document).on('submit', '#frm-calendar-ticket-status-started', function(e){
        e.preventDefault();

        var data = new FormData($('#frm-calendar-ticket-status-started')[0]);
        data.append('ticket_status', 'Started');
        
        $.ajax({
            type: "POST",
            url: base_url + 'ticket/_update_ticket_status',
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-ticket-started-status').modal('hide');

                    Swal.fire({
                        text: 'Service ticket status was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#frm-calendar-ticket-status-started :submit").html('Save');
            }, beforeSend: function() {
                $("#frm-calendar-ticket-status-started :submit").html('<span class="bx bx-loader bx-spin"></span>');
            }
        });
    });

    $(document).on('click', '#ticket-status-finished', function(){        
        var ticket_id = $(this).attr('data-id');

        $('#calendar-ticket-finished-id').val(ticket_id);
        $('#modal-quick-view-upcoming-schedule').modal('hide');
        $('#modal-quick-ticket-finished-status').modal('show');
    });

    $(document).on('submit', '#frm-calendar-ticket-status-finished', function(e){
        e.preventDefault();

        var data = new FormData($('#frm-calendar-ticket-status-finished')[0]);
        data.append('ticket_status', 'Finished');
        
        $.ajax({
            type: "POST",
            url: base_url + 'ticket/_update_ticket_status',
            dataType:'json',
            data: data,
            processData: false,
            contentType: false,
            success: function(data) {
                if( data.is_success == 1 ){
                    $('#modal-quick-ticket-finished-status').modal('hide');

                    Swal.fire({
                        text: 'Service ticket status was successfully updated',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#6a4a86',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        reloadCalendar(selected_calendar_view);
                        //loadUpcomingSchedules();
                    });    
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: data.msg
                    });
                }
                
                $("#frm-calendar-ticket-status-finished :submit").html('Save');
            }, beforeSend: function() {
                $("#frm-calendar-ticket-status-finished :submit").html('<span class="bx bx-loader bx-spin"></span>');
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
                        reloadCalendar(selected_calendar_view);
                        loadUpcomingSchedules();
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
</script>
<?php include viewPath('v2/includes/footer'); ?>