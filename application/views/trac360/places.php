<?php
defined('BASEPATH') or exit('No direct script access allowed');
include viewPath('includes/header'); ?>
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
    rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
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
                    <div id="added-places-section">
                        <?php
                        foreach ($all_places as $place) {
                            $exploded_coordinated=explode(",", $place->coordinates); ?>
                        <div id="sec-2-address-btn-<?=$place->id?>"
                            class="sec-2-option sec-2-address-btn"
                            onclick="selected_place(<?=$place->coordinates?>,'<?=$place->place_name?>','<?=$place->address?>',<?=$place->zone_radius?>,<?=$place->id?>)">
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
                                    <div class="places-actions-btn">
                                        <button href="#" class="place-notif-action" id="place_notif_modal_btn"
                                            data-user-id="<?=$place->created_by?>"
                                            data-place-id="<?=$place->id?>">
                                            <i class="fa fa-bell-o" aria-hidden="true"></i>
                                        </button>
                                        <?php
                                    if ($place->created_by == $user_id) {
                                        ?>
                                        <button href="#" class="place-edit-action edit_address_modal_btn"
                                            data-lat="<?=$exploded_coordinated[0]?>"
                                            data-lng="<?=$exploded_coordinated[1]?>"
                                            data-place-name="<?=$place->place_name?>"
                                            data-address="<?=$place->address?>"
                                            data-radius="<?=$place->zone_radius?>"
                                            data-user-id="<?=$place->created_by?>"
                                            data-place-id="<?=$place->id?>">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </button>
                                        <?php
                                    } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                    ?>
                    </div>
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
<div class="popup-modal">
    <div class="modal fade" id="place_notif_modal" tabindex="" role="dialog" aria-labelledby="place_notif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="place_notif_modal_title">
                        <label>School</label>
                        <p>Institute of Arts and Sciences, Panabo, Davao del Norte, Philippines</p>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Alert me when...</label>
                        </div>
                    </div>

                    <form action="#" method="POST" id="notify_settings_form">
                        <div id="users-notify-settings">
                            <?php foreach ($user_locations as $user) {
                        if ($user->user_id != $user_id) {
                            $image = base_url() . '/uploads/users/user-profile/' . $user->profile_img;
                            if (!@getimagesize($image)) {
                                $image = base_url('uploads/users/default.png');
                            } ?>
                            <div class="row">
                                <div class="col-md-4 profile">
                                    <center>
                                        <img src="<?=$image?>"
                                            alt="user" class="user-profile active">
                                        <p class="name"> <?=$user->FName?>
                                        </p>
                                    </center>
                                </div>
                                <div class="col-md-4">
                                    <div><label>Arrives:</label></div>
                                    <input type="checkbox" checked
                                        name="arrives_<?=$user->user_id?>"
                                        id="arrives_<?=$user->user_id?>"
                                        data-toggle="toggle" data-onstyle="success">
                                </div>
                                <div class="col-md-4">
                                    <div><label>Leaves:</label></div>
                                    <input type="checkbox" checked
                                        name="leaves_<?=$user->user_id?>"
                                        id="leaves_<?=$user->user_id?>"
                                        data-toggle="toggle" data-onstyle="success">
                                </div>
                            </div>
                            <?php
                        }
                    }?>
                        </div>
                        <input type="text" id="notify_place_id" name="place_id" value="" style="display: none;">
                    </form>
                    <div class="notify-settings-loader" style="display: none;">
                        <center>
                            <img src="<?=base_url('assets/img/trac360/loader1.gif')?>"
                                alt="">
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" id="save_notification_settings">Save</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_address_modal" tabindex="" role="dialog" aria-labelledby="place_notif">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        <label><i class="fa fa-map-o fa-2x"></i> Edit Place Info </label>
                    </h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" id="form_editaddress">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="text" name="place_name" id="edit_place_name" class="form-control"
                                        placeholder="Place name (Home, School, Work, ...)" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Enter an address or drag the map to find your place</label>
                                    <input id="edit_formatted_address" type="text" name="edit_formatted_address"
                                        class="form-control ts-start-date" value=""
                                        onchange="edit_formatted_address_changed()" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group map-canva" style="position: relative;">
                            <div class="edit_address_radius_container">
                                <label class="edit_radius_number_view">250 ft zone</label>
                                <input type="range" class="form-range" min="76.2" max="3218.688" step="0.001"
                                    id="edit_address_radius" value="76.2">
                            </div>
                            <div id="edit_address_map"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="delete_place" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-success" id="save_edited_address">Save</button>
                        <button type="submit" class="btn btn-success" style="display: none;">save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                <form method="post" id="form_new_address">
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
    var user_id = <?=$user_id?> ;
    var map;
    var new_address_map;
    var new_map_marker;
    var antennasCircle_main_map;
    var main_map_marker;

    var antennasCircle_edit_map;
    var edit_address_map;
    var edit_lat;
    var edit_lng;
    var radius_edit_address = 76.2;
    var edit_created_by;

    var current_lat = 0;
    var current_lng = 0;
    var antennasCircle_new_adress;
    var radius_new_address = 76.2;
    var current_notify_settings;

    function initMap() {
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
        $("#map-loader").hide();
        $("#map-holder").show();
        map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: current_lat,
                lng: current_lng
            },
            zoom: 9,
        });
        edit_address_map = new google.maps.Map(document.getElementById("edit_address_map"), {
            center: {
                lat: current_lat,
                lng: current_lng
            },
            zoom: 18,
        });

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
        google.maps.event.addListener(edit_address_map, 'dragend', function() {
            $("#edit_formatted_address").val("Loading address...");
            edit_address_map_changed();
        });
        setMapCenter("add_new", current_lat, current_lng, true);
    }

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

    function edit_formatted_address_changed() {

        var geocoder = new google.maps.Geocoder();
        var address = $("#edit_formatted_address").val();

        geocoder.geocode({
            'address': address
        }, function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                edit_lat = latitude;
                edit_lng = longitude;
                setMapCenter("edit_map", edit_lat, edit_lng);
            }
        });
    }

    function setMapCenter(update_the_map, the_lat, the_lng, first = false) {
        var the_map = map;
        if (update_the_map == "add_new") {
            the_map = new_address_map;
        } else if (update_the_map == "edit_map") {
            the_map = edit_address_map;
        }
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

            if (first) {
                the_map.setZoom(13);
            }
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

        } else if (update_the_map == "edit_map") {
            if (antennasCircle_edit_map != null) {
                antennasCircle_edit_map.setMap(null);
                edit_address_map.fitBounds(antennasCircle_edit_map.getBounds());
            }
            antennasCircle_edit_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: edit_address_map,
                center: {
                    lat: edit_lat,
                    lng: edit_lng
                },
                radius: radius_edit_address
            });
            edit_address_map.fitBounds(antennasCircle_edit_map.getBounds());

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
                    $("#edit_formatted_address").val(address);
                }
            });

            if (antennasCircle_edit_map != null) {
                antennasCircle_edit_map.setMap(null);
                edit_address_map.fitBounds(antennasCircle_edit_map.getBounds());
            }
            antennasCircle_edit_map = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: edit_address_map,
                center: {
                    lat: the_lat,
                    lng: the_lng
                },
                radius: radius_edit_address
            });
            edit_address_map.fitBounds(antennasCircle_edit_map.getBounds());
            // edit_address_map.setZoom(18);
        }

        the_map.setCenter({
            lat: the_lat,
            lng: the_lng,
        });
    }
</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBg27wLl6BoSPmchyTRgvWuGHQhUUHE5AU&callback=initMap&libraries=&v=weekly"
    async></script>