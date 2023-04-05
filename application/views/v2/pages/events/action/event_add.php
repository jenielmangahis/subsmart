<?php include viewPath('v2/includes/header'); ?>
<!-- add css for this page -->
<?php include viewPath('v2/pages/job/css/job_new'); ?>
<!-- START: CSS AND JAVASCRIPT IMPORTS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="https://nightly.datatables.net/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script type="text/javascript" src="https://nightly.datatables.net/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- END: CSS AND JAVASCRIPT IMPORTS -->
<style type="text/css">
    .color-box-custom {
    padding: 0px 0px;
    }
    .color-box-custom ul {
    margin: 0px;
    padding: 0px;
    list-style: none;
    }
    .color-box-custom ul li {
    display: inline-block;
    }
    .color-box-custom ul li span {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #000;
    display: block;
    }
    .color-box-custom ul li span.bg-1 {
    background-color: #4baf51;
    }
    .color-box-custom ul li span.bg-2 {
    background-color: #d86566;
    }
    .color-box-custom ul li span.bg-3 {
    background-color: #e57399;
    }
    .color-box-custom ul li span.bg-4 {
    background-color: #b273b3;
    }
    .color-box-custom ul li span.bg-5 {
    background-color: #8b63d7;
    }
    .color-box-custom ul li span.bg-6 {
    background-color: #678cda;
    }
    .color-box-custom ul li span.bg-7 {
    background-color: #59bdb3;
    }
    .color-box-custom ul li span.bg-8 {
    background-color: #64ae89;
    }
    .color-box-custom ul li span.bg-9 {
    background-color: #f1a740;
    }
    .nsm-badge.primary-enhanced {
    background-color: #6a4a86;
    }
    table {
    width: 100% !important;
    }
    .dataTables_filter, .dataTables_length{
    display: none;
    }
    table.dataTable thead th, table.dataTable thead td {
    padding: 10px 18px;
    border-bottom: 1px solid lightgray;
    }
    table.dataTable.no-footer {
    border-bottom: 0px solid #111; 
    margin-bottom: 10px;
    }
    #CUSTOM_FILTER_DROPDOWN:hover {
    border-color: gray !important; 
    background-color: white !important; 
    color: black !important;
    cursor: pointer; 
    }
    .SHORTCUT_LINK { 
        text-decoration: none;
        float: right;
        margin-top: -25px;
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
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/sales_tabs'); ?>
    </div>
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/event_subtabs'); ?>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="nsm-callout primary">
                    <button><i class='bx bx-x'></i></button>
                    Use this Event Scheduler Tool to start tracking the flow and success of each event.
                    However the main function is to schedule appointments, reminders, estimates, tasks, project timelines,
                    meetings or anything elseE by your company or organization.
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-12 mb-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="nsm-card primary">
                    <div class="nsm-card-header d-block">
                        <div class="nsm-card-title">
                            <span>Event Status</span>
                        </div>
                    </div>
                    <div class="nsm-card-content">
                        <div class="nsm-progressbar my-4">
                            <div class="progressbar">
                                <ul class="items-4">
                                    <li class="<?php echo !isset($jobs_data) || $jobs_data->status == '0'  ? 'active' : ''; ?>">Draft</li>
                                    <li class="<?php echo isset($jobs_data) && $jobs_data->status == 'Scheduled'  ? 'active' : ''; ?>">Schedule</li>
                                    <li class="<?php echo isset($jobs_data) && $jobs_data->status == '2'  ? 'active' : ''; ?>" style="display: none;">OMW</li>
                                    <li class="<?php echo isset($jobs_data) && $jobs_data->status == '3'  ? 'active' : ''; ?>">Started</li>
                                    <li class="<?php echo isset($jobs_data) && $jobs_data->status == '4'  ? 'active' : ''; ?>">Finished</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <form method="POST" name="myform" id="ADD_EVENT_FORM">
        <input type="hidden" id="redirect-calendar" value="<?php echo $redirect_calendar; ?>">
        <input type="hidden" name="eid" value="<?= isset($jobs_data) ? $jobs_data->id : ''; ?>" id="eid">
        <div class="col-lg-12 mb-3">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="nsm-card primary h-auto">
                        <div class="nsm-card-header d-block">
                            <div class="nsm-card-title"><span><i class='bx bx-calendar'></i>&nbsp;Schedule Event</span></div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="row g-3 align-items-center mb-3">
                                            <div class="col-lg-2">
                                                <h6>From:</h6>
                                            </div>
                                            <div class="col-lg-5">
                                                <input required type="date" name="start_date" id="start_date" class="form-control" value="<?php echo isset($jobs_data) ?  $jobs_data->start_date : date("Y-m-d");  ?>">
                                            </div>
                                            <div class="col-lg-5">
                                                <select required id="start_time" name="start_time" class="form-control">
                                                    <option value selected disabled>Start time</option>
                                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                    <option <?php echo isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-lg-2">
                                                <h6>To:</h6>
                                            </div>
                                            <div class="col-lg-5">
                                                <input required type="date" name="end_date" id="end_date" class="form-control mr-2" value="<?php echo isset($jobs_data) ?  $jobs_data->end_date : date("Y-m-d");  ?>">
                                            </div>
                                            <div class="col-lg-5">
                                                <select required id="end_time" name="end_time" class="form-control">
                                                    <option value selected disabled>End time</option>
                                                    <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                                                    <option <?php echo isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?php echo time_availability($x); ?>"><?php echo time_availability($x); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <h6>Attendees</h6>
                                        <select required id="employee_id" name="employee_id[]" class="form-control" multiple="multiple">
                                            <?php foreach($attendees as $uid => $uname){ ?>
                                                <option value="<?= $uid; ?>" selected=""><?= $uname; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="color-box-custom">
                                        <h6>Event Color on Calendar</h6>
                                        <ul id="EVENT_COLOR_LIST">
                                            <?php if(isset($color_settings)): ?>
                                            <?php foreach ($color_settings as $color): ?>
                                            <li>
                                                <a data-color="<?php echo $color->color_code; ?>" style="background-color: <?php echo $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?php echo $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?php echo $color->color_name; ?>">
                                                <?php if(isset($jobs_data) && $jobs_data->event_color == $color->color_code) {echo '<i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>'; } ?>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </ul>
                                        <input value="<?php echo (isset($jobs_data) && $jobs_data->event_color == $color->id) ? $jobs_data->event_color : ''; ?>" id="job_color_id" name="event_color" type="hidden" />
                                        <input id="EVENT_COLOR" type="hidden" value="#2e9e39">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Customer Reminder Notification</h6>
                                    <select required id="customer_reminder" name="customer_reminder_notification" class="form-control">
                                        <option value="0">None</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT5M') ? 'selected' : ''; ?> value="PT5M">5 minutes before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT15M') ? 'selected' : ''; ?> value="PT15M">15 minutes before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT30M') ? 'selected' : ''; ?> value="PT30M">30 minutes before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT1H') ? 'selected' : ''; ?> value="PT1H">1 hour before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT2H') ? 'selected' : ''; ?> value="PT2H">2 hours before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT4H') ? 'selected' : ''; ?> value="PT4H">4 hours before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT6H') ? 'selected' : ''; ?> value="PT6H">6 hours before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT8H') ? 'selected' : ''; ?> value="PT8H">8 hours before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT12H') ? 'selected' : ''; ?> value="PT12H">12 hours before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT16H') ? 'selected' : ''; ?> value="PT16H">16 hours before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P1D') ? 'selected' : ''; ?> value="P1D" selected="selected">1 day before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P2D') ? 'selected' : ''; ?> value="P2D">2 days before</option>
                                        <option <?php echo (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT0M') ? 'selected' : ''; ?> value="PT0M">On date of event</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Time Zone</h6>
                                    <select required id="inputState" name="timezone" class="form-control">
                                        <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                        <option value="<?php echo $key ?>" <?php echo ($jobs_data->timezone === $key) ? "selected" : "" ?>>
                                            <?php echo $zone ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Location</h6>
                                    <div id="pac-container">
                                        <input required id="event_address" value="<?php echo isset($jobs_data) ?  $jobs_data->event_address : '';  ?>" name="event_address" class="form-control" type="text" placeholder="Enter a location" />
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>URL Link</h6>
                                    <input required type="url" name="link" placeholder="https://www.domain.com" class="form-control checkDescription URL_LINK" value="<?php echo isset($jobs_data) ? $jobs_data->url_link : ''; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Private Notes</h6>
                                    <textarea required name="description" cols="50" style="width: 100%;margin-bottom: 8px;height:54px;" id="note_txt" class="form-control input"><?php echo isset($jobs_data) ? $jobs_data->description : ''; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="nsm-card primary h-auto">
                        <div class="nsm-card-header">
                            <div class="nsm-card-title"><span><i class='bx bx-calendar-event' ></i>&nbsp;Event Details</span></div>
                            <div class="nsm-card-controls">
                                <label class="content-subtitle d-block mb-2"><span class="fw-bold">Created By:</span> <?php echo $logged_in_user->FName . ' ' . $logged_in_user->LName; ?></label>
                            </div>
                        </div>
                        <hr>
                        <div class="nsm-card-content">
                            <div class="row mb-3">
                                <div class="col-lg-6 mb-3">
                                    <h6>Event Type</h6><a class="SHORTCUT_LINK" href="<?php echo base_url('events/event_types'); ?>">+ Manage Event Type</a>
                                    <select required id="event_type_option" name="event_types" class="form-control">
                                        <option selected hidden disabled value>- Select Event Type -</option>
                                        <?php if(!empty($job_types)): ?>
                                        <?php foreach ($job_types as $type): ?>
                                        <option <?php if(isset($jobs_data) && $jobs_data->event_type == $type->title) {echo 'selected'; } ?> value="<?php echo $type->title; ?>" data-image="<?php echo $type->icon_marker ?>"><?php echo $type->title; ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <h6>Event Tag</h6><a class="SHORTCUT_LINK" href="<?php echo base_url('events/event_tags'); ?>">+ Manage Event Tag</a>
                                    <select required id="event_tags_option" name="tags" class="form-control">
                                        <option selected hidden disabled value>- Select Event Tag -</option>
                                        <?php if(!empty($job_tags)): ?>
                                        <?php foreach ($job_tags as $tag): ?>
                                        <option <?php if(isset($jobs_data) && $jobs_data->event_tag == $tag->name) {echo 'selected'; } ?> value="<?php echo $tag->name; ?>" data-image="<?php echo $tag->marker_icon ?>"><?php echo $tag->name; ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Description of Event</h6>
                                    <textarea required name="event_description" class="form-control EVENT_DESCRIPTION"><?php echo isset($jobs_data) ? $jobs_data->event_description : ''; ?></textarea>
                                </div>
                            </div>
                            <hr>
                            <!-- <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Event Items Listing</h6>
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <td style="width: 0% !important;"></td>
                                                <td>Item Name</td>
                                                <td style="width: 0% !important;">Qty</td>
                                                <td>Unit Price</td>
                                                <td>Total Amount</td>
                                            </tr>
                                        </thead>
                                        <tbody id="EVENT_ITEMS_LISTING_TBODY"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="float-end">
                                        <h5><strong>Total:&nbsp;</strong>$<span class="TOTAL_ITEM_AMOUNT">0.00</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <button class="nsm-button small" type="button" data-bs-toggle="modal" data-bs-target="#ITEM_LIST_MODAL"><i class='bx bx-plus-medical'></i>&nbsp;Add Items</button>
                                </div>
                            </div>
                            <hr> -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="float-end">
                                        <button class="nsm-button primary" type="submit"><i class='bx bx-calendar-event'></i>&nbsp;Schedule</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- START: MODALS -->
<div class="modal fade" id="ITEM_LIST_MODAL" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Item List</span>
                <i class="bx bx-fw bx-x m-0 text-muted" data-bs-dismiss="modal" aria-label="name-button" name="name-button" style="cursor: pointer;"></i>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <input id="ITEM_CUSTOM_SEARCH" style="width: 200px;" class="form-control" type="text" placeholder="Search Item...">
                    </div>
                    <div class="col-sm-12 mt-1 mb-1">
                        <table id="ITEMS_TABLE" class="nsm-table w-100">
                            <thead>
                                <tr>
                                    <td style="width: 0% !important;"></td>
                                    <td>Item</td>
                                    <td>Qty</td>
                                    <td>Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                <?php $item_qty = get_total_item_qty($item->id); ?>
                                <tr>
                                    <td style="width: 0% !important;"><button id="<?php echo $item->id; ?>" data-quantity="<?php echo $item->units; ?>" data-itemname="<?php echo $item->title; ?>" data-price="<?php echo $item->price; ?>" type="button" data-bs-dismiss="modal" class="btn btn-sm btn-light select_item"><i class='bx bx-plus-medical'></i></button></td>
                                    <td><?php echo $item->title; ?></td>
                                    <td><?php echo $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
                                    <td><?php echo $item->price; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END: MODALS -->

<script type="text/javascript">

var TOTAL_ITEM_AMOUNT = 0;
$(".select_item").click(function (event) {
    var ROW_ITEM_AMOUNT = 0;
    const ITEM_ID = $(this).attr("id");
    const ITEM_NAME = $(this).attr("data-itemname");
    const ITEM_QUANTITY = parseInt($(this).attr("data-quantity"));
    const ITEM_PRICE = parseInt($(this).attr("data-price"));

    // START: CREATE DATA AND APPEND
    var TBODY_DATA = "<tr class='ROW_" + ITEM_ID + "'>" +
        "<td><button class='btn btn-sm btn-light ITEM_ROW_DELETE' type='button'><i class='bx bxs-trash' ></i></button></td>" +
        "<td>" + ITEM_NAME + "</td>" +
        "<td><input style='width: 100px;' class='form-control form-control-sm QTY_INPUT' type='number' min='0'></td>" +
        "<td>" + ITEM_PRICE.toFixed(2) + "</td>" +
        "<td class='SUM_ALL_ITEMS'>0</td>" +
        "</tr>";
    $("#EVENT_ITEMS_LISTING_TBODY").append(TBODY_DATA);
    // END: CREATE DATA AND APPEND

    $('.ITEM_ROW_DELETE').click(function (event) {
        $(this).parent().parent().remove();
    });

    var ROW_LENGTH = $('#EVENT_ITEMS_LISTING_TBODY > tr').length;

    $('.QTY_INPUT').change(function (event) {
        var QUANTITY = $(this).val();
        var PRICE = $(this).closest('td').next().html();
        ROW_ITEM_AMOUNT = parseInt(QUANTITY * PRICE);
        $(this).closest('td').next().next().html(ROW_ITEM_AMOUNT.toFixed(2));

        var SUM_ALL_ITEMS = $('.SUM_ALL_ITEMS');
        var SUM = 0;
        for (var i = 0; i < ROW_LENGTH; i++) {
            SUM += parseInt(SUM_ALL_ITEMS[i].textContent);
            $(".TOTAL_ITEM_AMOUNT").text(SUM.toFixed(2));
        }

    });
});

// START: ADD EVENT SCRIPT
$('#ADD_EVENT_FORM').submit(function (event) {
    event.preventDefault();
    var FROM_DATE = $("#start_date").val();
    var FROM_TIME = $("#start_time").val();
    var TO_DATE = $("#end_date").val();
    var TO_TIME = $("#end_time").val();
    var EMPLOYEE_ID = $("#employee_id").val();
    var EVENT_COLOR = $("#EVENT_COLOR").val();
    var CUSTOMER_REMINDER = $("#customer_reminder").val();
    var TIMEZONE = $("#inputState").val();
    var LOCATION = $("#event_address").val();
    var URL_LINK = $(".URL_LINK").val();
    var PRIVATE_NOTES = $("#note_txt").val();
    var EVENT_TYPE = $("#event_type_option").val();
    var EVENT_TAG = $("#event_tags_option").val();
    var EVENT_DESCRIPTION = $(".EVENT_DESCRIPTION").val();
    var TOTAL_ITEM_AMOUNT = $(".TOTAL_ITEM_AMOUNT").text();
    var EVENT_ID = $("#eid").val();
    $.post("<?php echo base_url('events/event_save'); ?>", {
        FROM_DATE: FROM_DATE,
        FROM_TIME: FROM_TIME,
        TO_DATE: TO_DATE,
        TO_TIME: TO_TIME,
        EMPLOYEE_ID: EMPLOYEE_ID,
        EVENT_COLOR: EVENT_COLOR,
        CUSTOMER_REMINDER: CUSTOMER_REMINDER,
        TIMEZONE: TIMEZONE,
        LOCATION: LOCATION,
        URL_LINK: URL_LINK,
        PRIVATE_NOTES: PRIVATE_NOTES,
        EVENT_TYPE: EVENT_TYPE,
        EVENT_TAG: EVENT_TAG,
        EVENT_DESCRIPTION: EVENT_DESCRIPTION,
        TOTAL_ITEM_AMOUNT: TOTAL_ITEM_AMOUNT,
        EVENT_ID: EVENT_ID
    }).done(function (data) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Event was addedd successfully!',
        }).then((result) => {
            window.location.href = base_url + "/events";
        });
    });
});
// END: ADD EVENT SCRIPT

$("#start_date").change(function (event) {
    $("#end_date").val($("#start_date").val());
});


$(function () {
    $("#start_time, #end_time, #customer_reminder, #inputState").select2();
    $('#employee_id').select2({
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
        placeholder: 'Select User',
        minimumInputLength: 0,
        templateResult: formatRepoUser,
        templateSelection: formatRepoSelectionUser
    });

    $("#event_type_option, #event_tags_option").select2({
        templateResult: formatState,
        templateSelection: formatState
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
function formatState (opt) {
    if (!opt.id) {
        return opt.text;
    } 
    var optimage = $(opt.element).attr('data-image'); 
    if(!optimage){
       return opt.text;
    } else {                    
        var $opt = $(
           '<span><img src="<?php echo base_url('uploads/icons/'); ?>' + optimage + '" style="width: 20px; margin-top: -4px;" /> ' + opt.text + '</span>'
        );
        return $opt;
    }
};

});

var ITEMS_TABLE = $("#ITEMS_TABLE").DataTable({
    "ordering": false,
    language: {
        processing: '<span>Fetching data...</span>'
    },
});

$("#ITEM_CUSTOM_SEARCH").keyup(function () {
    ITEMS_TABLE.search($(this).val()).draw()
});
ITEMS_TABLE_SETTINGS = ITEMS_TABLE.settings();

$('#CUSTOM_FILTER_DROPDOWN').change(function (event) {
    $('#CUSTOM_FILTER_SEARCHBAR').val($('#CUSTOM_FILTER_DROPDOWN').val());
    ITEMS_TABLE.columns(7).search(this.value).draw();
});

$("body").delegate(".color-scheme", "click", function () {
    var id = this.id;
    var COLOR = $(this).attr("data-color");
    $("#EVENT_COLOR").val(COLOR);
    $('[id="job_color_id"]').val(id);
    $("#" + id).append("<i class=\"bx bx-check calendar_button\" aria-hidden=\"true\"></i>");
    remove_others(id);
});

function remove_others(color_id) {
    $('.color-scheme').each(function (index) {
        var idd = this.id;
        if (idd !== color_id) {
            $("#" + idd).empty();
        }
    });
}
</script>
<?php include viewPath('v2/pages/job/js/job_new_js'); ?>
<?php include viewPath('v2/includes/footer'); ?>

