<?php include viewPath('v2/includes/header'); ?>
<!-- add css for this page -->
<?php include viewPath('v2/pages/job/css/job_new'); ?>
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
    .swal2-styled.swal2-confirm {        
        background-color: #7367f0 !important;
        color: #fff !important;
    }
    #event-map{
        height:380px !important;
    }
    .autocomplete-container {
        position: relative;
    }
</style>
<div class="nsm-fab-container">
    <div class="nsm-fab nsm-fab-icon nsm-bxshadow" onclick="location.href='<?php echo base_url('events/new_event') ?>'">
        <i class='bx bx-user-plus'></i>
    </div>
</div>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/events_tabs'); ?>
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
                                        <?php 
                                            $is_default_color_exists = 0;
                                            $default_color = '#2e9e39'; 
                                        ?>
                                        <ul id="EVENT_COLOR_LIST">
                                            <?php if(isset($color_settings)): ?>
                                            <?php foreach ($color_settings as $color): ?>
                                                <?php 
                                                    if( strtolower($color->color_code) == $default_color){
                                                        $is_default_color_exists = 1;
                                                    }
                                                ?>
                                                <li>
                                                    <a data-color="<?php echo $color->color_code; ?>" style="background-color: <?php echo $color->color_code; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="<?php echo $color->id; ?>" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="<?php echo $color->color_name; ?>">
                                                    <?php if(isset($jobs_data) && $jobs_data->event_color == $color->color_code) {echo '<i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>'; } ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>                                            
                                            <?php endif; ?>
                                            <?php if( $is_default_color_exists == 0 ){ ?>
                                                <li>
                                                    <a data-color="<?= $default_color; ?>" style="background-color: <?= $default_color; ?>; border-radius: 0px;border: 1px solid black;margin-bottom: 4px;" id="default-event-color" type="button" class="btn btn-default color-scheme btn-circle bg-1" title="Default Event Color">
                                                    <?php 
                                                        if(isset($jobs_data) && $jobs_data->event_color == $default_color){
                                                            echo '<i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>'; 
                                                        }

                                                        if( empty($jobs_data) ){
                                                            echo '<i class="bx bx-check calendar_button event-color-check" aria-hidden="true"></i>'; 
                                                        }
                                                    ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
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
                                        <?php foreach($optionsCustomerNotifications as $key => $value){ ?>
                                            <?php if( $jobs_data ){ ?>
                                                <option <?= $jobs_data && $jobs_data->customer_reminder_notification == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php }else{ ?>
                                                <option <?= $eventSettings && $eventSettings->customer_reminder_notification == $key ? 'selected="selected"' : ''; ?> value="<?= $key; ?>"><?= $value; ?></option>
                                            <?php } ?>
                                        <?php } ?>                                        
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <h6>Time Zone</h6>
                                    <select required id="inputState" name="timezone" class="form-control">
                                        <?php foreach (config_item('calendar_timezone') as $key => $zone) { ?>
                                            <?php if( $jobs_data ){ ?>
                                                <option value="<?php echo $key ?>" <?php echo ($jobs_data->timezone === $key) ? "selected" : "" ?>>
                                                    <?php echo $zone ?>
                                                </option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $key ?>" <?= $eventSettings && $eventSettings->timezone == $key ? 'selected="selected"' : ''; ?>>
                                                    <?php echo $zone ?>
                                                </option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
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
                                <div class="col-md-4">
                                    <h6>Location</h6>
                                        <div id="autocomplete" class="autocomplete-container"></div>
                                        <input id="event_address" value="<?php echo isset($jobs_data) ?  $jobs_data->event_address : '';  ?>" name="event_address" class="form-control" type="hidden" placeholder="Enter a location" />

                                        <input type="hidden" name="center_map_latitude" id="center-lat" value="<?= $mapSetting ? $mapSetting->center_map_latitude : ''; ?>" class="form-control" />
                                        <input type="hidden" name="center_map_longitude" id="center-lon" value="<?= $mapSetting ? $mapSetting->center_map_longitude : ''; ?>" class="form-control" />

                                    <div class="mt-4">
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
                                    <div class="mt-4">
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

                                    <div class="mt-4">
                                        <h6>Description of Event</h6>
                                        <textarea required name="event_description" class="form-control EVENT_DESCRIPTION" style="height:120px;"><?php echo isset($jobs_data) ? $jobs_data->event_description : ''; ?></textarea>
                                    </div>

                                </div>
                                <div class="col-md-8">
                                    <div id="event-map"></div>
                                </div>
                            </div>
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
<?php //include viewPath('v2/pages/job/js/job_new_js'); ?>
<?php include viewPath('v2/includes/footer'); ?>
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
//Start Map
var myAPIKey = "<?= GEOAPIKEY ?>"; 
<?php if($jobs_data){ ?>
var default_lat = '<?= $default_lat; ?>';
var default_lon = '<?= $default_lon; ?>';
var map_zoom_level = '11'; 
<?php }else{ ?>
var default_lat = '39.7837304';
var default_lon = '-100.445882';
var map_zoom_level = '5'; 
<?php } ?>

var map_style = 'osm-bright';

var center = {
    lat: default_lat,
    lon: default_lon
};

var geoMap = new maplibregl.Map({
center: [center.lon, center.lat],
zoom: map_zoom_level,
container: 'event-map',
style: `https://maps.geoapify.com/v1/styles/${map_style}/style.json?apiKey=${myAPIKey}`,
});
geoMap.addControl(new maplibregl.NavigationControl()); 
var currentMarkers=[];

// check the available autocomplete options on the https://www.npmjs.com/package/@geoapify/geocoder-autocomplete 
const autocompleteInput = new autocomplete.GeocoderAutocomplete(
    document.getElementById("autocomplete"), 
    myAPIKey, 
    { /* Geocoder options */ 
});

<?php if( $jobs_data ){ ?>
$('.geoapify-autocomplete-input').val('<?= $jobs_data->event_address; ?>');
<?php } ?>

var markerIcon = L.icon({
    iconUrl: `https://api.geoapify.com/v1/icon?size=xx-large&type=material&color=rgb(106,74,134)&icon=my_location&apiKey=${myAPIKey}`,
    iconSize: [38, 56], // size of the icon
    iconAnchor: [19, 51], // point of the icon which will correspond to marker's location
    popupAnchor: [0, -60] // point from which the popup should open relative to the iconAnchor
});      

let zooMarker;
let marker;

autocompleteInput.on('select', (location) => {
    // Add marker with the selected location
    // Add marker with the selected location
    if (zooMarker) {
        zooMarker.remove();
    }
    
    if (location) {    
        
        if (currentMarkers!==null) {
            for (var i = currentMarkers.length - 1; i >= 0; i--) {                
                currentMarkers[i].remove();
            }
        }

        var markerIcon = L.icon({
        iconUrl: `https://api.geoapify.com/v1/icon?size=xx-large&type=material&color=rgb(106,74,134)&icon=my_location&apiKey=${myAPIKey}`,
        iconSize: [38, 56], // size of the icon
        iconAnchor: [19, 51], // point of the icon which will correspond to marker's location
        popupAnchor: [0, -60] // point from which the popup should open relative to the iconAnchor
        });

        var coordinates = [location.properties.lon, location.properties.lat]
        var marker_color = 'mediumpurple';
        let map_icon = `https://api.geoapify.com/v1/icon?size=large&type=material&icon=business_center&noWhiteCircle=0&color=${marker_color}&apiKey=${myAPIKey}`;
        const el = document.createElement('div');
        el.className = 'marker';    
        el.style.width = '30px';
        el.style.color = marker_color;
        el.style.height = '50px';
        el.style.backgroundSize = "contain";
        el.style.backgroundImage = `url(${map_icon})`;    

        // create the popup
        const popup = new maplibregl.Popup({offset: 25}).setHTML(
            location.properties.address_line2
        );

        // add marker to map
        var marker = new maplibregl.Marker({element: el})
            .setLngLat(coordinates)
            .setPopup(popup)
            .addTo(geoMap);

        currentMarkers.push(marker);

        geoMap.flyTo({
            // These options control the ending camera position: centered at
            // the target, at zoom level 9, and north up.
            center: coordinates,
            zoom: 11,
            bearing: 0,

            // These options control the flight curve, making it move
            // slowly and zoom out almost completely before starting
            // to pan.
            speed: 3, // make the flying slow
            curve: 1, // change the speed at which it zooms out

            // This can be any easing function: it takes a number between
            // 0 and 1 and returns another number between 0 and 1.
            easing (t) {
                return t;
            },

            // this animation is considered essential with respect to prefers-reduced-motion
            essential: true
        });

        // //let title     = location.properties.address_line2;
        // let title = "<i class='fa fa-map-marker'></i> " + location.properties.address_line2;
        // let zooMarkerPopup = L.popup().setContent(title);
        // let zooMarker = L.marker([location.properties.lat, location.properties.lon], {
        // icon: markerIcon,
        // draggable: false
        // }).addTo(geoMap);
        
        $('#event_address').val(location.properties.address_line2);
        $('#center-lon').val(location.properties.lon);
        $('#center-lat').val(location.properties.lat);   
        
    }
});
//End Map

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
            showCancelButton: false,
            confirmButtonText: 'Okay'
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