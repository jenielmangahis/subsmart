<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header'); ?>
<div id="main_body" class="container-fluid" style="background-color: #6241A4;">
    <div class="row">
        <div class="col-md-5">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 page-title-box align-items-center">
                    <h1 class="page-title text-white">Trac360</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active text-white">Search the globe online</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 trac360_main_sections">
                    <div class="btn-group-vertical" style="width: 100%;">
                        <ul class="trac360-side-bar-menu">
                            <li>
                                <a href="<?= base_url() ?>trac360"
                                    class="btn btn-primary  trac360_side_controls " id=""><span
                                        class="fa fa-users fa-2x" class="text-center"></span><br>Group</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>trac360/"
                                    class="btn btn-primary  trac360_side_controls" id=""><span
                                        class="fa fa-commenting-o fa-2x" class="text-center"></span><br>Messages</a>
                            </li>
                            <li>
                                <a href="<?= base_url() ?>trac360/places"
                                    class="btn btn-primary  trac360_side_controls current-page" id=""><span
                                        class="fa fa-map-marker fa-2x" class="text-center"></span><br>Places</a>
                            </li>
                            <li><a href="<?= base_url() ?>trac360/"
                                    class="btn btn-primary  trac360_side_controls" id=""><span class="fa fa-map fa-2x"
                                        class="text-center"></span><br>History</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 overflow-auto trac360_main_sections" style="background-color: #fff;">
                    <div id="add_new_place_modal_btn" class="sec-2-option add-address">
                        <div class="row ">
                            <div class="col-md-2 profile" style="padding-top: 10px;">
                                <center><img
                                        src="<?=base_url("assets/img/trac360/map_marker.png")?>"
                                        alt="user" class=""></center>
                            </div>
                            <div class="col-md-10 details">
                                <p class="last_tract_location first-p">Add a new place today!</p>
                                <p class="last_tract_location second-p">Know when your family and
                                    friends arrive</p>
                            </div>
                        </div>
                    </div>
                    <?php
                        foreach ($all_places as $place) {
                            ?>
                    <div class="sec-2-option sec-2-address-btn">
                        <div class="row ">
                            <div class="col-md-2 profile">
                                <center><img
                                        src="<?=base_url("assets/img/trac360/map_marker.png")?>"
                                        alt="user" class="">
                                </center>
                            </div>
                            <div class="col-md-10 details">
                                <p class="last_tract_location first-p"><?=$place->place_name?>
                                </p>
                                <p class="last_tract_location second-p"><?=$place->address?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>
        <div class="col-md-7 map-section">
            <div id="map-loader">
                <center>
                    <img
                        src="<?=base_url("assets/img/trac360/loader.gif")?>" />
                </center>
                <h1 class="page-title">Initializing...</h1>
            </div>
            <div id="map-holder" style="display:none;">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>


<!--Adding Project Schedule-->
<div class="modal-right-side">
    <div class="modal right fade" id="add_new_place_modal" tabindex="" role="dialog"
        aria-labelledby="edit_attendance_log">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="edit_attendance_log">
                        <label><i class="fa fa-map-o fa-2x"></i> Add a new
                            address </label>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form action="" method="post" id="form_new_address">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="place_name" id="new_place_name" class="form-control"
                                        placeholder="Place name (Home, School, Work, ...)" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Enter an address or drag the map to find your place</label>
                                    <input id="new_formatted_address" type="text" name="new_formatted_address"
                                        class="form-control ts-start-date" value=""
                                        onchange="new_formatted_address_changed()" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group map-canva" style="position: relative;">
                            <div class="new_address_radius_container">
                                <label class="radius_number_view">250 ft zone</label>
                                <input type="range" class="form-range" min="76.2" max="3218.688" step="0.001"
                                    id="new_address_radius" value="76.2">
                            </div>
                            <div id="add_new_address_map"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="save_new_address">Add new
                            address</button>
                        <button type="submit" class="btn btn-success" style="display: none;">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include viewPath('includes/footer'); ?>
<script>
    // Initialize and add the map
    var map;
    var new_address_map;
    var new_map_marker;


    function initMap() {
        $("#map-loader").hide();
        $("#map-holder").show();
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: 7.3087,
                lng: 125.6841
            },
            zoom: 9,
        });
        get_current_user_location();
    }

    function get_current_user_location() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(show_current_user_position);
        } else {
            console.log("Geolocation is not supported by this browser.");
        }
    }

    function show_current_user_position(position) {
        current_lat = position.coords.latitude;
        current_lng = position.coords.longitude;
        initMap_new_address_map();
    }

    function initMap_new_address_map() {
        // Create a new StyledMapType object, passing it an array of styles,
        // and the name to be displayed on the map type control.
        const styledMapType = new google.maps.StyledMapType(
            [{
                    elementType: "geometry",
                    stylers: [{
                        color: "#ebe3cd"
                    }]
                },
                {
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#523735"
                    }],
                },
                {
                    elementType: "labels.text.stroke",
                    stylers: [{
                        color: "#f5f1e6"
                    }],
                },
                {
                    featureType: "administrative",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#c9b2a6"
                    }],
                },
                {
                    featureType: "administrative.land_parcel",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#dcd2be"
                    }],
                },
                {
                    featureType: "administrative.land_parcel",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#ae9e90"
                    }],
                },
                {
                    featureType: "landscape.natural",
                    elementType: "geometry",
                    stylers: [{
                        color: "#dfd2ae"
                    }],
                },
                {
                    featureType: "poi",
                    elementType: "geometry",
                    stylers: [{
                        color: "#dfd2ae"
                    }],
                },
                {
                    featureType: "poi",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#93817c"
                    }],
                },
                {
                    featureType: "poi.park",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#a5b076"
                    }],
                },
                {
                    featureType: "poi.park",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#447530"
                    }],
                },
                {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{
                        color: "#f5f1e6"
                    }],
                },
                {
                    featureType: "road.arterial",
                    elementType: "geometry",
                    stylers: [{
                        color: "#fdfcf8"
                    }],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry",
                    stylers: [{
                        color: "#f8c967"
                    }],
                },
                {
                    featureType: "road.highway",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#e9bc62"
                    }],
                },
                {
                    featureType: "road.highway.controlled_access",
                    elementType: "geometry",
                    stylers: [{
                        color: "#e98d58"
                    }],
                },
                {
                    featureType: "road.highway.controlled_access",
                    elementType: "geometry.stroke",
                    stylers: [{
                        color: "#db8555"
                    }],
                },
                {
                    featureType: "road.local",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#806b63"
                    }],
                },
                {
                    featureType: "transit.line",
                    elementType: "geometry",
                    stylers: [{
                        color: "#dfd2ae"
                    }],
                },
                {
                    featureType: "transit.line",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#8f7d77"
                    }],
                },
                {
                    featureType: "transit.line",
                    elementType: "labels.text.stroke",
                    stylers: [{
                        color: "#ebe3cd"
                    }],
                },
                {
                    featureType: "transit.station",
                    elementType: "geometry",
                    stylers: [{
                        color: "#dfd2ae"
                    }],
                },
                {
                    featureType: "water",
                    elementType: "geometry.fill",
                    stylers: [{
                        color: "#b9d3c2"
                    }],
                },
                {
                    featureType: "water",
                    elementType: "labels.text.fill",
                    stylers: [{
                        color: "#92998d"
                    }],
                },
            ], {
                name: "Styled Map"
            }
        );
        // Create a map object, and include the MapTypeId to add
        // to the map type control.


        new_address_map = new google.maps.Map(document.getElementById("add_new_address_map"), {
            center: {
                lat: current_lat,
                lng: current_lng
            },
            zoom: 17,
            mapTypeControlOptions: {
                mapTypeIds: [
                    "roadmap",
                    "satellite",
                    "hybrid",
                    "terrain",
                    "styled_map",
                ],
            },
            mapTypeControl: false,
            overviewMapControl: false,
            zoomControl: true,
            draggable: true,
            fullscreenControl: false,
            streetViewControl: false,
        });
        //Associate the styled map with the MapTypeId and set it to display.
        new_address_map.mapTypes.set("styled_map", styledMapType);
        new_address_map.setMapTypeId("styled_map");

        google.maps.event.addListener(new_address_map, 'dragend', function() {
            $("#new_formatted_address").val("Loading address...");
            new_address_map_changed();
        });
        setMapCenter("add_new", current_lat, current_lng);
    }
    var current_lat = 0;
    var current_lng = 0;
    var antennasCircle_new_adress;
    var radius_new_address = 76.2;

    function new_address_map_changed() {
        var center = new_address_map.getCenter()
        var lat = center.lat();
        var lng = center.lng();
        if (current_lat != lat && current_lng != lng) {
            current_lat = lat;
            current_lng = lng;

            if (antennasCircle_new_adress != null) {
                antennasCircle_new_adress.setMap(null);
                new_address_map.fitBounds(antennasCircle_new_adress.getBounds());
            }
            antennasCircle_new_adress = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: new_address_map,
                center: {
                    lat: current_lat,
                    lng: current_lng
                },
                radius: radius_new_address
            });
            new_address_map.fitBounds(antennasCircle_new_adress.getBounds());

            var latlng = new google.maps.LatLng(current_lat, current_lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, (results, status) => {
                if (status !== google.maps.GeocoderStatus.OK) {
                    // alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = (results[0].formatted_address);
                    $("#new_formatted_address").val(address);

                }
            });
        }
    }

    function new_formatted_address_changed() {

        var geocoder = new google.maps.Geocoder();
        var address = $("#new_formatted_address").val();

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                current_lat = latitude;
                current_lng = longitude;
                setMapCenter("add_new", current_lat, current_lng);
            }
        });
    }

    function setMapCenter(update_the_map, the_lat, the_lng) {
        var the_map = map;
        if (update_the_map == "add_new") {
            the_map = new_address_map;
        }
        the_map.setCenter({
            lat: the_lat,
            lng: the_lng,
        });
        google.maps.event.addListenerOnce(the_map, "bounds_changed", function() {
            // the_map.setZoom((18) - (radius_new_address / 76.2));
        });
        if (update_the_map == "add_new") {
            if (antennasCircle_new_adress != null) {
                antennasCircle_new_adress.setMap(null);
                new_address_map.fitBounds(antennasCircle_new_adress.getBounds());
            }
            antennasCircle_new_adress = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: the_map,
                center: {
                    lat: the_lat,
                    lng: the_lng
                },
                radius: radius_new_address
            });
            the_map.fitBounds(antennasCircle_new_adress.getBounds());

            new_address_map = the_map;
            var latlng = new google.maps.LatLng(the_lat, the_lng);
            // This is making the Geocode request
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'latLng': latlng
            }, (results, status) => {
                if (status !== google.maps.GeocoderStatus.OK) {
                    // alert(status);
                }
                // This is checking to see if the Geoeode Status is OK before proceeding
                if (status == google.maps.GeocoderStatus.OK) {
                    var address = (results[0].formatted_address);
                    $("#new_formatted_address").val(address);
                }
            });

        }
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
    async></script>