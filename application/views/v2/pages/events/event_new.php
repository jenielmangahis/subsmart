<?php 
add_css(array(
    'https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css',
    'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css',
    'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css',
    //"assets/css/accounting/sidebar.css",
    'assets/textEditor/summernote-bs4.css',
));
include viewPath('v2/includes/header'); 
?>

<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?= base_url('events/new_event') ?>'">
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
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Use this Event Scheduler Tool to start tracking the flow and success of each event.
                            However the main function is to schedule appointments, reminders, estimates, tasks, project timelines,
                            meetings or anything else required by your company or organization.
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="nsm-progressbar my-4">
                            <div class="progressbar">
                                <ul class="items-4">
                                    <li class="<?= !isset($jobs_data) || $jobs_data->status == '0'  ? 'active' : ''; ?>">Draft</li>
                                    <li class="<?= isset($jobs_data) && $jobs_data->status == 'Scheduled'  ? 'active' : ''; ?>">Schedule</li>
                                    <li class="<?= isset($jobs_data) && $jobs_data->status == '2'  ? 'active' : ''; ?>" style="display: none;">OMW</li>
                                    <li class="<?= isset($jobs_data) && $jobs_data->status == '3'  ? 'active' : ''; ?>">Started</li>
                                    <li class="<?= isset($jobs_data) && $jobs_data->status == '4'  ? 'active' : ''; ?>">Finished</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" name="myform" id="events_form">
                    <div class="row g-3 align-items-start">
                        <div class="col-12 col-md-4">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="nsm-card primary">
                                        <div class="nsm-card-header d-block">
                                            <div class="nsm-card-title">
                                                <span>Schedule Event</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">From</label>
                                                    <div class="row g-2">
                                                        <div class="col-12 col-md-6">
                                                            <?php 
                                                                if( isset($jobs_data) ){
                                                                    $default_start_date = $jobs_data->start_date;
                                                                }

                                                            ?>
                                                            <input type="date" name="start_date" id="start_date" class="nsm-field form-control" value="<?= $default_start_date;  ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <?php 
                                                                if( isset($jobs_data) ){
                                                                    $default_start_time = strtolower($jobs_data->start_time);
                                                                }
                                                            ?>
                                                            <select id="start_time" name="start_time" class="nsm-field form-select" required>
                                                                <option selected="">Start time</option>
                                                                <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                                                                    <option <?= $default_start_time == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">To</label>
                                                    <div class="row g-2">
                                                        <div class="col-12 col-md-6">
                                                            <input type="date" name="end_date" id="end_date" class="nsm-field form-control" value="<?= isset($jobs_data) ?  $jobs_data->end_date : '';  ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <select id="end_time" name="end_time" class="nsm-field form-select" required>
                                                                <option selected="">End time</option>
                                                                <?php for ($x = 0; $x < time_availability(0, TRUE); $x++) { ?>
                                                                    <option <?= isset($jobs_data) && strtolower($jobs_data->end_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Select Employee</label>
                                                    <select id="employee_id" name="employee_id" class="nsm-field form-select" required>
                                                        <option selected="">Select Employee</option>
                                                        <?php if (!empty($employees)) : ?>
                                                            <?php foreach ($employees as $employee) : ?>
                                                                <option <?= isset($jobs_data) && $jobs_data->employee_id == $employee->id ? 'selected' : '';  ?> value="<?= $employee->id; ?>"><?= $employee->LName . ',' . $employee->FName; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Event Color on Calendar</label>
                                                    <div class="nsm-color-picker">
                                                        <ul>
                                                            <?php if (isset($color_settings)) : ?>
                                                                <?php foreach ($color_settings as $color) : ?>
                                                                    <li class="<?= isset($jobs_data) && $jobs_data->event_color == $color->color_code ? 'active' : '' ?>" data-color="<?= $color->color_code; ?>" style="background-color: <?= $color->color_code; ?>;" id="<?= $color->id; ?>"></li>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                        <input type="hidden" class="nsm-field form-control nsm-color-field" name="event_color" required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Customer Reminder Notification</label>
                                                    <select name="customer_reminder_notification" class="nsm-field form-select" required>
                                                        <option value="0">None</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT5M') ? 'selected' : ''; ?> value="PT5M">5 minutes before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT15M') ? 'selected' : ''; ?> value="PT15M">15 minutes before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT30M') ? 'selected' : ''; ?> value="PT30M">30 minutes before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT1H') ? 'selected' : ''; ?> value="PT1H">1 hour before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT2H') ? 'selected' : ''; ?> value="PT2H">2 hours before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT4H') ? 'selected' : ''; ?> value="PT4H">4 hours before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT6H') ? 'selected' : ''; ?> value="PT6H">6 hours before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT8H') ? 'selected' : ''; ?> value="PT8H">8 hours before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT12H') ? 'selected' : ''; ?> value="PT12H">12 hours before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT16H') ? 'selected' : ''; ?> value="PT16H">16 hours before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P1D') ? 'selected' : ''; ?> value="P1D" selected="selected">1 day before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'P2D') ? 'selected' : ''; ?> value="P2D">2 days before</option>
                                                        <option <?= (isset($jobs_data) && $jobs_data->customer_reminder_notification == 'PT0M') ? 'selected' : ''; ?> value="PT0M">On date of event</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Time Zone</label>
                                                    <select name="timezone" class="nsm-field form-select" required>
                                                        <option selected="">Central Time (UTC -5)</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Select Event Type</label>
                                                    <select name="event_types" id="event_types_option" class="nsm-field form-select" required>
                                                        <option value="" disabled>Select Event Type</option>
                                                        <?php if (!empty($job_types)) : ?>
                                                            <?php foreach ($job_types as $type) : ?>
                                                                <option <?php if (isset($jobs_data) && $jobs_data->event_type == $type->title) {
                                                                            echo 'selected';
                                                                        } ?> value="<?= $type->title; ?>"><?= $type->title; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Select Event Tag</label>
                                                    <select name="event_tag" id="event_tag_option" class="nsm-field form-select" required>
                                                        <option value="" disabled>Select Event Tag</option>
                                                        <?php if (!empty($tags)) : ?>
                                                            <?php foreach ($tags as $tag) : ?>
                                                                <option <?php if (isset($jobs_data) && $jobs_data->event_tag == $tag->name) {
                                                                            echo 'selected';
                                                                        } ?> value="<?= $tag->id; ?>"><?= $tag->name; ?></option>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label class="content-subtitle fw-bold d-block mb-2">Location</label>
                                                    <input type="text" class="nsm-field form-control" name="event_address" value="<?= isset($jobs_data) ?  $jobs_data->event_address : '';  ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-card primary" style="display: <?= isset($jobs_data) ? 'none' : 'block'; ?>;">
                                        <div class="nsm-card-header">
                                            <div class="nsm-card-title">
                                                <span>Private Notes</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <textarea name="description" cols="40" rows="3" id="note_txt" class="nsm-field form-control"><?= isset($jobs_data) ? $jobs_data->message : ''; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="nsm-card primary" style="display: <?= isset($jobs_data) ? 'none' : 'block'; ?>;">
                                        <div class="nsm-card-header">
                                            <div class="nsm-card-title">
                                                <span>Url Link</span>
                                            </div>
                                        </div>
                                        <div class="nsm-card-content">
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <?php
                                                    if (isset($jobs_data) && $jobs_data->link != NULL) {
                                                    ?>
                                                        <a target="_blank" class="nsm-link" href="<?= $jobs_data->link; ?>">
                                                            <p><?= $jobs_data->link; ?></p>
                                                        </a>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <label class="content-subtitle fw-bold d-block mb-2">Enter URL</label>
                                                        <input type="url" name="link" class="nsm-field form-control checkDescription">
                                                    <?php
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="nsm-card primary">
                                <div class="nsm-card-header">
                                    <div class="nsm-card-title">
                                        <span>Event Details</span>
                                    </div>
                                    <div class="nsm-card-controls">
                                        <label class="content-subtitle d-block mb-2"><span class="fw-bold">Created By:</span> <?= $logged_in_user->FName . ' ' . $logged_in_user->LName; ?></label>
                                    </div>
                                </div>
                                <div class="nsm-card-content">
                                    <div class="row gy-3 gx-2">
                                        <div class="col-12 col-md-6">
                                            <label class="content-subtitle fw-bold d-block mb-2">Event Type</label>
                                            <input type="text" class="nsm-field form-control" id="event_type" name="event_type" value="<?= isset($jobs_data) ? $jobs_data->event_type : ''; ?>" readonly>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="content-subtitle fw-bold d-block mb-2">Event Tags</label>
                                            <input type="text" class="nsm-field form-control" id="event_tag" name="event_tags" value="<?= isset($jobs_data) ? $jobs_data->event_tag : ''; ?>" readonly>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Description of Event</label>
                                            <textarea name="event_description" required class="nsm-field form-control"><?= isset($jobs_data) ? $jobs_data->event_description : ''; ?></textarea>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <label class="content-subtitle fw-bold d-block mb-2">Event Items Listing</label>
                                            <button type="button" class="nsm-button pull-right" id="add_another_items" data-bs-toggle="modal" data-bs-target="#item_list">
                                                 <i class='bx bx-fw bx-plus'></i> Add Item
                                            </button>
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Item Name">Item Name</td>
                                                        <td data-name="Quantity">Quantity</td>
                                                        <td data-name="Unit Price">Unit Price</td>
                                                        <td data-name="Total Amount">Total Amount</td>
                                                        <td data-name="Manage"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($event_items)) :
                                                    ?>
                                                        <?php
                                                        $subtotal = 0.00;
                                                        foreach ($event_items as $key => $i) :
                                                            $total    = (float)$i->item_price * (float)$i->qty;
                                                            $subtotal = $subtotal + $total;
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <input value='<?= $i->title; ?>' type="text" name="item_name[]" class="nsm-field form-control">
                                                                    <input type="hidden" value="<?= $i->items_id; ?>" name="item_id[]">
                                                                </td>
                                                                <td>
                                                                    <input data-itemid="<?= $i->items_id; ?>" id="<?= $i->items_id; ?>" value='<?= $i->qty; ?>' type="number" name="item_qty[]" class="nsm-field form-control qty">
                                                                </td>
                                                                <td>
                                                                    <input id='price<?= $i->items_id; ?>' data-itemid="<?= $i->items_id; ?>" value='<?= $i->item_price; ?>' type="number" name="item_price[]" class="nsm-field form-control item-price" placeholder="Unit Price">
                                                                </td>
                                                                <td>
                                                                    <label class="content-title" data-subtotal="<?= $total; ?>" id='sub_total<?= $i->items_id; ?>' class="total_per_item">$<?= number_format($total, 2, '.', ','); ?></label>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="nsm-button btn-sm btn-remove-item">Remove</button>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        endforeach;
                                                        ?>
                                                    <?php
                                                    else :
                                                    ?>
                                                        <tr>
                                                            <td colspan="5">
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
                                        <div class="col-12 col-md-6">
                                            <label class="content-title">Total</label>
                                        </div>
                                        <div class="col-12 col-md-6 text-end">
                                            <label class="content-title">$<?= isset($jobs_data) ? number_format((float)$subtotal,2,'.',',') : '0.00'; ?></label>
                                            <input type="hidden" name="sub_total" id="sub_total_form_input" value='0'>
                                        </div>
                                        <div class="col-12 text-end">
                                            
                                            <button type="submit" class="nsm-button primary"><i class='bx bx-fw bx-calendar-plus'></i> Schedule</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<?php include viewPath('v2/pages/events/modals/event_new_modals'); ?>

<script type="text/javascript">
    $(document).ready(function() {

    });
</script>
<?php
    add_footer_js(array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js',
        'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
        'https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/javascript.util/0.12.12/javascript.util.min.js',
        'assets/textEditor/summernote-bs4.js',
    ));
    include viewPath('v2/includes/footer');
?>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= google_credentials()['api_key'] ?>&callback=initMap&libraries=places&v=weekly&sensor=false"></script>
<script src="https://momentjs.com/downloads/moment-with-locales.js"></script>

<?php include viewPath('v2/pages/events/js/new_event_js'); ?>
<script>
    $(function(){
        $('#items_table').DataTable({
            "lengthChange": true,
            "searching" : true,
            "pageLength": 10,
            "autoWidth": false,
            "order": [],
        });
        $("#customer_id").select2({
            placeholder: "Select Customer"
        });
        $("#employee_id").select2({
            placeholder: "Select Employee"
        });
        $("#event_types_option").select2({
            placeholder: "Select Event Type"
        });
        $("#event_tag_option").select2({
            placeholder: "Select Event Tag"
        });
    });
</script>
<script>
    var geocoder;
    function initMap(address=null) {

        var input = document.getElementById('event_address');
        new google.maps.places.Autocomplete(input);

        if(address == null){
            address = '6866 Pine Forest Rd Pensacola FL 32526';
        }else{
            const myLatLng = { lat: -25.363, lng: 131.044 };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                height:220,
                center: myLatLng,
            });
            new google.maps.Marker({
                position: myLatLng,
                map,
                title: "Hello World!",
            });
            geocoder = new google.maps.Geocoder();
            codeAddress(geocoder, map,address);
        }

    }

    function codeAddress(geocoder, map,address) {
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location
                });
            } else {
                console.log(status);
                console.log('Geocode was not successful for the following reason: ' + status);
            }
        });
    }
</script>