<?php include viewPath('v2/includes/header'); ?>
<style>
.autocomplete-container {
    position: relative;
}
.geoapify-autocomplete-items{
  z-index: 9999 !important;
}
#settings-map {
  width: 100%;
  height: 400px;
  margin: 0;
}
#bev-map{
    height:800px !important;
}
.maplibregl-marker{
    background-size:cover;
    border-radius:34px;
}
.map-info, .map-address, .map-date{
    display:block;
}
.map-info{
    font-size:14px;
    font-weight:bold;
}
#map-loading{
    position: absolute;
    z-index: 9999 !important;
    bottom: 119px;
    left: 3%;
    width: 474px;
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
.autocomplete-img {
    height: 50px;
    width: 50px;
}
.mapboxgl-popup-content, .maplibregl-popup-content{
  background-color:#6a4a86 !important;
  color:#ffffff !important;
}
.maplibregl-popup-tip{
    border-top-color : #6a4a86 !important;
}
.maplibregl-popup-close-button{
    color:#ffffff !important;
}
.quick-calendar-tile{
    font-size: 11px;
    text-decoration: none;
    color: #ffffff !important;
    margin-left: 5px;
}
.map-popup-container ul{
    list-style:none;
    padding:0px;
    margin:0px;
}
.map-popup-container ul li{
    display:inline-block;
}
.map-info-icon{
    width:7%;
    vertical-align:top;
}
.map-info-details{
    width:90%;
}
.map-info-divider{
    width:100%;    
}
.header-info{
    font-size:13px;
}
#quick-access-calendar-loading{
    position: absolute;
    top: 387px;
    z-index: 99999 !important;
    width: 421px;
    right: 147px;
    
}
.alert-purple{
    background-color:#6a4a86 !important;
    color:#ffffff;
}
.nsm-list-icon {
    float: right;
}
.btn-settings-map{
    float:right;    
}
.map-detail-link, .map-detail-link:hover{
    text-decoration:none;
    color:#ffffff;
}
.modal-quick-view-btn{
    width: 48%;
    font-size: 16px;
}
</style>
<div class="row page-content g-0">
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/birds_eye_view_tabs'); ?>
    </div>
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            For any business, getting customers is only half the battle; creating a job workflow will help track each scheduled ticket from draft to receiving payment.
                        </div>                        
                    </div>
                </div>                
                <div class="row">
                    <div class="col-md-12">
                        <a href="javacript:void(0);" class="nsm nsm-button primary btn-settings-map mb-2"><i class='bx bx-cog'></i></a>
                    </div>
                    <div class="col-md-8 col-8">
                        <div class="nsm-card primary">
                            <div id="map-loading"></div>
                            <div id="bev-map"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-4">
                        <div class="nsm-card primary">
                            <div id="quick-access-calendar-loading"></div>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-quick-view-upcoming-schedule" data-source="" tabindex="-1" aria-labelledby="modal-quick-view-upcoming-schedule-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">        
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">View Calendar Schedule</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body" style="max-height:700px; overflow: auto;">
                    <div class="view-schedule-container"></div>
                </div> 
                <div class="modal-footer" style="justify-content:unset;">
                    <button type="button" class="nsm-button primary modal-quick-view-btn" data-id="" data-type="" id="job-schedule-view-more-details"><i class="bx bx-window-open"></i> View More Details</button>                
                    <button type="button" class="nsm-button primary modal-quick-view-btn" data-id="" data-type="" id="job-schedule-view-map-location"><i class='bx bxs-map'></i> View Map Location</button>                                                            
                </div>           
            </div>        
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="loading_modal" tabindex="-1" aria-labelledby="loading_modal_label" aria-hidden="true" style="margin-top:10%;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div class="modal fade nsm-modal fade" id="modal-settings-map" tabindex="-1" aria-labelledby="modal-settings-map_label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="frm-update-map-settings">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title content-title">Map Settings</span>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="map-style mb-2">Map Style</label>
                        <select name="map_style" id="map-style" class="form-control">
                            <option <?= $mapSetting ? $mapSetting->map_style == 'osm-carto' ? 'selected="selected"' : '' : ''; ?> value="osm-carto">OSM Carto</option>
                            <option <?= $mapSetting ? $mapSetting->map_style == 'osm-bright' ? 'selected="selected"' : '' : ''; ?> value="osm-bright">OSM Bright</option>
                            <option <?= $mapSetting ? $mapSetting->map_style == 'klokantech-basic' ? 'selected="selected"' : '' : ''; ?> value="klokantech-basic">Klokantech</option>
                            <option <?= $mapSetting ? $mapSetting->map_style == 'osm-liberty' ? 'selected="selected"' : '' : ''; ?> value="osm-liberty">Liberty</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="map-zoom-level mb-2">Map Default Zoom Level</label>
                        <select name="map_zoom_level" id="map-zoom-level" class="form-control">
                            <?php for($x=1;$x<=10;$x++){ ?>
                                <option <?= $mapSetting ? $mapSetting->map_zoom_level == $x ? 'selected="selected"' : '' : ''; ?> value="<?= $x; ?>"><?= $x; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="center-lat mb-2">Default Center Map</label>
                        <div class="autocomplete-panel">
                            <div id="autocomplete" class="autocomplete-container"></div>
                        </div>
                        <input type="hidden" name="center_map_latitude" id="center-lat" value="<?= $mapSetting ? $mapSetting->center_map_latitude : ''; ?>" class="form-control" />
                        <input type="hidden" name="center_map_longitude" id="center-lon" value="<?= $mapSetting ? $mapSetting->center_map_longitude : ''; ?>" class="form-control" />
                        <input type="hidden" name="map_location" id="map-location" value="<?= $mapSetting ? $mapSetting->map_location : ''; ?>" class="form-control" />
                    </div>

                    <div class="mt-2" id="settings-map"></div> 
                    
                </div>
                <div class="modal-footer">                    
                    <button type="button" class="nsm-button" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="btn-update-map-settings" class="nsm-button primary">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>


</div>
<?php include viewPath('v2/includes/footer'); ?>
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

<!-- Map -->
<script type="text/javascript">
var myAPIKey = "<?= GEOAPIKEY ?>";   
<?php if( $mapSetting ){ ?>
var default_lat = '<?= $mapSetting->center_map_latitude; ?>';
var default_lon = '<?= $mapSetting->center_map_longitude; ?>';
var map_zoom_level = '<?= $mapSetting->map_zoom_level; ?>'; 
var map_style = '<?= $mapSetting->map_style; ?>';
var default_map_setting_title = '<?= $mapSetting->map_location; ?>';
<?php }else{ ?>
var default_lat = '8.8888';
var default_lon = '11.5812';
var map_zoom_level = '3'; 
var map_style = 'osm-bright';
var default_map_setting_title = 'Default Location';
<?php } ?>

var center = {
    lat: default_lat,
    lon: default_lon
};
var geojson = {
    'type': 'FeatureCollection',
    'features': <?= json_encode($geoDataFeatures); ?>
};

var map = new maplibregl.Map({
center: [center.lon, center.lat],
zoom: map_zoom_level,
container: 'bev-map',
style: `https://maps.geoapify.com/v1/styles/${map_style}/style.json?apiKey=${myAPIKey}`,
});
map.addControl(new maplibregl.NavigationControl()); 
var currentMarkers=[];

//Settings
var geoMap = L.map('settings-map', {zoomControl: false}).setView([default_lon, default_lat], map_zoom_level);
const isRetina = L.Browser.retina;
const baseUrl = `https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}.png?apiKey=${myAPIKey}`;
const retinaUrl = `https://maps.geoapify.com/v1/tile/osm-bright/{z}/{x}/{y}@2x.png?apiKey=${myAPIKey}`;
// Add map tiles layer. Set 20 as the maximal zoom and provide map data attribution.
L.tileLayer(isRetina ? retinaUrl : baseUrl, {
    attribution: 'Powered by <a href="https://www.geoapify.com/" target="_blank">Geoapify</a> | <a href="https://openmaptiles.org/" rel="nofollow" target="_blank">© OpenMapTiles</a> <a href="https://www.openstreetmap.org/copyright" rel="nofollow" target="_blank">© OpenStreetMap</a> contributors',
    apiKey: myAPIKey,
    maxZoom: 20,
    id: 'osm-bright'
}).addTo(geoMap);

// add a zoom control to bottom-right corner
L.control.zoom({
    position: 'bottomright'
}).addTo(geoMap);

// check the available autocomplete options on the https://www.npmjs.com/package/@geoapify/geocoder-autocomplete 
const autocompleteInput = new autocomplete.GeocoderAutocomplete(
    document.getElementById("autocomplete"), 
    myAPIKey, 
    { /* Geocoder options */ 
});

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
        var markerIcon = L.icon({
        iconUrl: `https://api.geoapify.com/v1/icon?size=xx-large&type=material&color=rgb(106,74,134)&icon=my_location&apiKey=${myAPIKey}`,
        iconSize: [38, 56], // size of the icon
        iconAnchor: [19, 51], // point of the icon which will correspond to marker's location
        popupAnchor: [0, -60] // point from which the popup should open relative to the iconAnchor
        });

        //let title     = location.properties.address_line2;
        let title = "<i class='fa fa-map-marker'></i> " + location.properties.address_line2;
        let zooMarkerPopup = L.popup().setContent(title);
        let zooMarker = L.marker([location.properties.lat, location.properties.lon], {
        icon: markerIcon,
        draggable: true
        }).addTo(geoMap);

        zooMarker.on('dragend', function(event){
        var marker = event.target;
        var position = marker.getLatLng();

            $('#center-lat').val(position.lat);
            $('#center-lon').val(position.lng);
        });

        $('#map-location').val(location.properties.address_line2);
        $('#center-lon').val(location.properties.lon);
        $('#center-lat').val(location.properties.lat);        
        
        geoMap.panTo([location.properties.lat, location.properties.lon]);
        
    }
});
</script>

<script type="text/javascript">
var calendar;
$(function(){
    reloadCalendar();

    $('#frm-update-map-settings').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: base_url + "job_map/_update_map_settings",
            dataType: 'json',
            data: $('#frm-update-map-settings').serialize(),
            success: function(data) {     
                $('#loading_modal').modal('hide');           
                if (data.is_success) {
                    Swal.fire({
                        text: "Map settings was successfully updated",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        //if (result.value) {
                            location.reload();  
                        //}
                    });
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'Cannot update map settings. Please try again later.',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }
            },
            beforeSend: function() {
                $('#modal-settings-map').modal('hide');
                $('#loading_modal').modal('show');
                $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Updating map setting...');
            }
        });
    });

    $('#modal-settings-map').on('show.bs.modal', function(){        
    });

    $('.btn-settings-map').on('click', function(){        
        $('#modal-settings-map').modal('show');

        setTimeout(() => {
            geoMap.invalidateSize(true);

            // if (geoMap.hasLayer(zooMarker)) {
            //     geoMap.removeLayer(zooMarker);
            // }

            let title           = "<i class='fa fa-map-marker'></i> " + default_map_setting_title;
            let zooMarkerPopup  = L.popup().setContent(title);
            let zooMarker       = L.marker([default_lat, default_lon], {
                icon: markerIcon,
                draggable: true
            }).addTo(geoMap);

            zooMarker.on('dragend', function(event) {
                var marker = event.target; 
                var result = marker.getLatLng();

                $('#center-lon').val(result.lng);
                $('#center-lat').val(result.lat);
            });


            geoMap.panTo([default_lat, default_lon]);

        }, 500);
    });
    
    function reloadCalendar() {
        let _calendar = document.getElementById('calendar');
        let customer_events = <?php echo json_encode($resources_user_events) ?>;

        renderCalendar(_calendar);

        /*window.setTimeout( function(){
            $('.calendar-tile-details').hide();
        }, 1500 );*/
    }

    function updateMapMarker(start_date, end_date){
        $("#map-loading").show();
        $("#map-loading").html('<div class="alert alert-info alert-purple" role="alert">Loading map data...</div>');
        if (currentMarkers!==null) {
            for (var i = currentMarkers.length - 1; i >= 0; i--) {                
                currentMarkers[i].remove();
            }
        }

        $.ajax({
            type: "POST",
            url: base_url + "job_map/_update_map_marker",
            dataType: 'json',
            data: {start_date:start_date, end_date:end_date},
            success: function(data) {
                if (data.is_valid) {
                    var geojson = {
                            'type': 'FeatureCollection',
                            'features': data.geoFeatures
                    };                     

                    geojson.features.forEach((marker) => {
                        // create a DOM element for the marker
                        let marker_color = marker.properties.marker_color;
                        let map_icon     = `https://api.geoapify.com/v1/icon?size=large&type=material&icon=business_center&noWhiteCircle=0&color=${marker_color}&apiKey=${myAPIKey}`;
                        const el = document.createElement('div');
                        el.className = 'marker';    
                        el.style.width = '30px';
                        el.style.color = marker.properties.marker_color;
                        el.style.height = '50px';
                        el.style.backgroundSize = "contain";
                        el.style.backgroundImage = `url(${map_icon})`;    

                        // create the popup
                        const popup = new maplibregl.Popup({offset: 25}).setHTML(
                            marker.properties.message
                        );

                        // add marker to map
                        var marker = new maplibregl.Marker({element: el})
                            .setLngLat(marker.geometry.coordinates)
                            .setPopup(popup)
                            .addTo(map);

                        currentMarkers.push(marker);
                    });

                    $("#map-loading").hide();
                }
            },
            beforeSend: function() {

            }
        });
    }
    
    $(document).on('click', '#job-schedule-view-map-location', function(){
        var object_id = $(this).attr('data-id');
        var object_type = $(this).attr('data-type');
        var url = base_url + 'job_map/_get_map_location'
        $.ajax({
            type: "POST",
            url: url,
            data: {object_id:object_id,object_type:object_type},
            dataType: 'json',
            success: function(result){  
                $('#loading_modal').modal('hide');                
                if( result.is_valid == 1 ){
                    map.flyTo({
                        // These options control the ending camera position: centered at
                        // the target, at zoom level 9, and north up.
                        center: [result.longitude, result.latitude],
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
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'Cannot find map location',
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonText: 'Okay'
                    }).then((result) => {
                        
                    });
                }     
                
            },
            beforeSend: function() {
                $('#modal-quick-view-upcoming-schedule').modal('hide');
                $('#loading_modal').modal('show');
                $('#loading_modal .modal-body').html('<span class="bx bx-loader bx-spin"></span> Fetching map location...');
            }
        });

    });

    function renderCalendar(_calendar) {
        let calendar_job_data = base_url + "job_map/_calendar_data";
        let calendar_resource_users_url = base_url + "job_map/_calendar_resource_users";
        let scrollTime = moment().format("HH") + ":00:00";

        calendar = new FullCalendar.Calendar(_calendar, {
            schedulerLicenseKey: '0531798248-fcs-1598103289',
            headerToolbar: {
                //center: 'employeeTimeline,monthView,dayView,weekView,listView'
                center: 'employeeTimeline,monthView,dayView' // buttons for switching between views
            },
            themeSystem: 'bootstrap5',
            eventDisplay: 'block',
            contentHeight: 750,
            initialView: 'monthView',  
            progressiveEventRendering: false,    
            views: {
                employeeTimeline: {
                    type: 'resourceTimeGridDay',
                    buttonText: 'Tech',
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
                // weekView: {                    
                //     nowIndicator: true,
                //     type: 'timeGridWeek',
                //     buttonText: 'Week',
                //     allDaySlot: true, 
                //     expandRows: true,
                //     editable: true,
                //     droppable: true,
                //     scrollTime: scrollTime,
                // },
                // listView: {
                //     type: 'listWeek',
                //     buttonText: 'List',
                //     editable: false,
                //     droppable: false
                // },
                displayEventEnd: true,
                allDaySlot: false,
            },
            eventDidMount : function(info) {  
                
            },  
            datesSet: function(info){
                var date_from = info.startStr;
                var date_to   = info.endStr;
                updateMapMarker(date_from, date_to);
            },
            dayCellDidMount(info) {    
                
            },
            selectable: true,
            slotEventOverlap: true,
            eventOverlap: true,
            select: function(info) {    
                
            },
            resourceLabelDidMount: function(info) {
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
            //defaultDate: "<?php echo date('Y-m-d'); ?>",
            editable: false,
            droppable: false, 
            drop: function(arg) {
                
            },
            eventDrop: function(info) {

                
            },
            navLinks: true, // can click day/week names to navigate views            
            eventClick: function(arg) {
                var appointment_id   = arg.event._def.extendedProps.eventId;
                var appointment_type = arg.event._def.extendedProps.eventType;

                if ( appointment_type == 'job' ) {
                    var url = base_url + "job/_quick_view_details";                 
                } else if ( appointment_type == 'service_ticket' || appointment_type == 'ticket' ) {
                    var url = base_url + "ticket/_quick_view_details";              
                } 

                $('#job-schedule-view-map-location').attr('data-type', appointment_type);
                $('#job-schedule-view-map-location').attr('data-id', appointment_id);

                $('#job-schedule-view-more-details').attr('data-type', appointment_type);
                $('#job-schedule-view-more-details').attr('data-id', appointment_id);

                $('#modal-quick-view-upcoming-schedule').modal('show');
                $('.view-schedule-container').html('<span class="bx bx-loader bx-spin"></span>');

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
                    $("#quick-access-calendar-loading").html('<div class="alert alert-info alert-purple" role="alert">Loading jobs data...</div>');
                } else {                                                        
                    $("#quick-access-calendar-loading").html('');
                }

            },
            resourceAreaColumns: [{
                field: 'title',
                headerContent: 'Employees',
            }],
            resources: {
                url: calendar_resource_users_url,
                method: 'POST'
            },
            events: {
                url: calendar_job_data,
                method: 'POST'
            },
            eventOrder: ["starttime"],
        });

        calendar.render();

    }

    $(document).on('click', '.map-detail-link', function(){
        var appointment_id   = $(this).attr('data-id');
        var appointment_type = $(this).attr('data-type');

        if ( appointment_type == 'job' ) {
            var url = base_url + "job/_quick_view_details";                 
        } else if ( appointment_type == 'ticket' ) {
            var url = base_url + "ticket/_quick_view_details";              
        } 

        $('#job-schedule-view-map-location').attr('data-type', appointment_type);
        $('#job-schedule-view-map-location').attr('data-id', appointment_id);
        $('#modal-quick-view-upcoming-schedule').modal('show');
        $('.view-schedule-container').html('<span class="bx bx-loader bx-spin"></span>');

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

    $(document).on('click', '#job-schedule-view-more-details', function(){
        var appointment_type = $(this).attr('data-type');
        var appointment_id   = $(this).attr('data-id');
        if( appointment_type == 'job' ){
            location.href = base_url + 'job/job_preview/' + appointment_id;
        }else if( appointment_type == 'service_ticket'){
            location.href = base_url + 'tickets/viewDetails/' + appointment_id;
        }
    });
});
</script>
