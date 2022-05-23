<style>
    
    .add_new_address_map_clock_in:after, #edit_address_map:after, #edit_address_map1:after {
    width: 22px;
    height: 40px;
    display: block;
    content: ' ';
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -40px 0 0 -11px;
    animation: ease;
    animation-duration: 20s;
    background: url(https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png);
    background-size: 22px 40px;
    pointer-events: none;
}
    .add_new_address_map_clock_in:after,
    #edit_address_map:after,
    #edit_address_map1:after {
        width: 22px;
        height: 40px;
        display: block;
        content: ' ';
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -40px 0 0 -11px;
        animation: ease;
        animation-duration: 20s;
        background: url(https://maps.gstatic.com/mapfiles/api-3/images/spotlight-poi_hdpi.png);
        background-size: 22px 40px;
        pointer-events: none;
    }

    .new_address_radius_container,
    .edit_address_radius_container,
    .edit_address_radius_container1 {
        position: absolute;
        z-index: 1;
        padding: 20px 10px;
        width: 100%;
    }

    label.radius_number_view,
    label.radius_number_view1,
    label.edit_radius_number_view,
    label.edit_radius_number_view1 {
        background-color: #FFFFFF;
        padding: 5px 30px;
        font-size: 13px;
        margin-left: 10px;
        border: solid 1px #6241A4;
        border-radius: 10px;
        color: #666666;
        float: right;
    }

    input#new_address_radius,
    input#edit_address_radius,
    input#edit_address_radius1 {
        width: 200px;
        height: 2px;
        float: right;
        margin-top: 15px;
    }
</style>
<input type="hidden" name="user_id" value="<?= $user->id; ?>" id="editUserID">
<div class="section-title">Basic Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Employee Number</label>
            <input type="text" name="emp_number" class="form-control" id="emp_number" value="<?= $user->employee_number ? $user->employee_number : '-'; ?>" placeholder="Enter Employee Number">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">First Name</label>
            <input type="text" name="firstname" class="form-control" value="<?= $user->FName; ?>" placeholder="Enter First Name">
        </div>
        <div class="col-md-6">
            <label for="">Last Name</label>
            <input type="text" name="lastname" class="form-control" value="<?= $user->LName; ?>" placeholder="Enter Last Name">
        </div>
    </div>
</div>
<div class="section-title">Login Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="" style="display: block">Email</label>
            <input type="text" name="email" class="form-control" value="<?= $user->email; ?>" id="employeeEmail" placeholder="e.g: email@mail.com" style="width: 90%">
            <i class="fa fa-sync-alt check-if-exist" title="Check if Email is already exist" data-toggle="tooltip"></i>
            <span class="email-error"></span>
        </div>
        <div class="col-md-6">
            <label for="" style="display: block">Username</label>
            <input type="text" name="username" class="form-control" value="<?= $user->username; ?>" id="employeeUsername" placeholder="e.g: nsmartrac" style="width: 90%">
            <i class="fa fa-sync-alt check-if-exist" title="Check if Username already exist" data-toggle="tooltip"></i>
            <span class="username-error"></span>
        </div>
    </div>
</div>
<div class="section-title">Other Details</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="">Address</label>
            <input type="text" name="address" value="<?= $user->address; ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">State</label>
            <input type="text" name="state" value="<?= $user->state; ?>" class="form-control">
        </div>
        <div class="col-md-6">
            <label for="">Zip Code</label>
            <input type="text" name="postal_code" value="<?= $user->postal_code; ?>" class="form-control">
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Title</label>
            <select name="role" id="employeeRole" class="form-control edit-select2-role">
                <option value="">Select Title</option>
                <?php foreach ($roles as $r) { ?>
                    <option value="<?= $r->id; ?>" <?= $r->id == $user->role ? 'selected="selected"' : ''; ?>><?= $r->title; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <label for="">Status</label>
            <select name="status" id="" class="form-control">
                <option value="1" <?= $user->status == 1 ? 'selected="selected"' : ''; ?>>Active</option>
                <option value="0" <?= $user->status == 0 ? 'selected="selected"' : ''; ?>>Inactive</option>
            </select>
        </div>
        <div class="col-md-6">
            <div class="input-switch">
                <label for="">App Access</label><br>
                <?php
                $is_checked = '';
                if ($user->has_app_access == 1) {
                    $is_checked = 'checked="checked"';
                }
                ?>
                <input type="checkbox" name="app_access" class="edit-js-switch" <?= $is_checked; ?> />
            </div>
            <div class="input-switch">
                <?php
                $is_checked = '';
                if ($user->has_web_access == 1) {
                    $is_checked = 'checked="checked"';
                }
                ?>
                <label for="">Web Access</label><br>
                <input type="checkbox" name="web_access" class="edit-js-switch" <?= $is_checked; ?> />
            </div>
        </div>
    </div>
</div>
<div class="section-title">Profile Image</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="">Image</label>
            <div id="editEmployeeProfilePhoto" class="dropzone" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                <div class="dz-message" style="margin: 20px;">
                    <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                    <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                </div>
            </div>
            <input type="hidden" name="img_id" id="editPhotoId">
            <input type="hidden" name="profile_photo" id="editPhotoName">
            <div>
                <label for="">Payscale</label>
                <select name="empPayscale" id="empPayscale" class="form-control select2-payscale">
                    <option value="">Select payscale</option>
                    <?php foreach ($payscale as $p) { ?>
                        <option value="<?= $p->id; ?>" <?= $user->payscale_id == $p->id ? 'selected="selected"' : ''; ?>><?= $p->payscale_name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-container">
                <img src="/uploads/users/default.png" alt="Profile photo">
            </div>
            <label>Rights and Permissions</label>
            <div class="help help-sm help-block">Select employee role</div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 7 ? 'checked="checked"' : ''; ?> name="user_type" value="7" id="role_7">
                    <label for="role_7"><span>Admin</span></label>
                </div>
                <div class="help help-sm help-block">
                    ALL Access<br>
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 1 ? 'checked="checked"' : ''; ?> name="user_type" value="1" id="role_1">
                    <label for="role_1"><span>Office Manager</span></label>
                </div>
                <div class="help help-sm help-block">
                    ALL except high security file vault<br>
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 2 ? 'checked="checked"' : ''; ?> name="user_type" value="2" id="role_2">
                    <label for="role_2"><span>Partner</span></label>
                </div>
                <div class="help help-sm help-block">
                    ALL base on plan type
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 3 ? 'checked="checked"' : ''; ?> name="user_type" value="3" id="role_3">
                    <label for="role_3"><span>Team Leader</span></label>
                </div>
                <div class="help help-sm help-block">
                    No accounting or any changes to company profile or deletion
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 4 ? 'checked="checked"' : ''; ?> name="user_type" value="4" id="role_4">
                    <label for="role_4"><span>Standard User</span></label>
                </div>
                <div class="help help-sm help-block">
                    Can not add or delete employees, can not manage subscriptions
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 5 ? 'checked="checked"' : ''; ?> name="user_type" value="5" id="role_5">
                    <label for="role_5"><span>Field Sales</span></label>
                </div>
                <div class="help help-sm help-block">
                    View only no input
                </div>
            </div>
            <div>
                <div class="checkbox checkbox-sec margin-right">
                    <input type="radio" <?= $user->user_type == 6 ? 'checked="checked"' : ''; ?> name="user_type" value="6" id="role_6">
                    <label for="role_6"><span>Field Tech</span></label>
                </div>
                <div class="help help-sm help-block">
                    App access only, no Web access
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section-title">Manage Clock In & Clock Out Location</div>
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="custom-control custom-switch">

                                <input type="checkbox" value=0 class="custom-control-input allow_clock_in" id="allow_clock_in_input">
                                <label class="custom-control-label allow_clock_in" for="allow_clock_in_input"> <span id="status">Enable</span> user <b>cannot clock in 5 minutes</b> early.</label>


                                <br><label class="est_wage_privacy_editor" for="est_wage_privacy2" style="font-size: 11px;font-weight:100;">
                                    <p>Latest
                                        update by <span id="update"></span></p>
                                </label>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 allow_clock_in_map" style="display:none;">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Set Clock In Location</label>
                            <div class="form-group">
                                <label for="">Enter an address or drag the map to find your place</label>
                                <input id="new_formatted_address" type="text" name="new_formatted_address" class="form-control ts-start-date" value="" onchange="new_formatted_address_changed()" required>
                                <input type="text" name="clock_in_location_latitude" id="allow_clock_in_lat" style="display:none">
                                <input type="text" name="clock_in_location_longtitude" id="allow_clock_in_lng" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="form-group map-canva" style="position: relative;">
                        <div class="edit_address_radius_container">
                            <label class="edit_radius_number_view">250 ft zone</label>
                            <input type="range" class="form-range" min="76.2" max="3218.688" step="0.001" id="edit_address_radius" value="76.2">
                        </div>
                        <div id="add_new_address_map_clock_in" class="add_new_address_map_clock_in" style="height:400px;width:100%;"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-lg-12">
                            <label>Set Clock In Location</label>
                            <div class="form-group">
                                <label for="">Enter an address or drag the map to find your place</label>
                                <input id="new_formatted_address1" type="text" name="new_formatted_address1" class="form-control ts-start-date" value="" onchange="new_formatted_address_changed1()" required>
                                <input type="text" name="clock_out_location_latitude" id="allow_clock_out_lat" style="display:none">
                                <input type="text" name="clock_out_location_longtitude" id="allow_clock_out_lng" style="display:none">
                            </div>
                        </div>
                    </div>
                    <div class="form-group map-canva" style="position: relative;">
                        <div class="edit_address_radius_container1">
                            <label class="edit_radius_number_view1">250 ft zone</label>
                            <input type="range" class="form-range" min="76.2" max="3218.688" step="0.001" id="edit_address_radius1" value="76.2">
                        </div>
                        <div id="add_new_address_map_clock_out" class="add_new_address_map_clock_in" style="height:400px;width:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.edit-js-switch'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html, {
                size: 'small'
            });
        });

        $('.edit-select2-role').select2({
            placeholder: 'Select Title',
            allowClear: true,
            width: 'resolve'
        });

        $('.select2-payscale').select2({
            placeholder: 'Select Payscale',
            allowClear: true,
            width: 'resolve'
        });

        Dropzone.autoDiscover = false;
        var fname = [];
        var selected = [];
        var profilePhoto = new Dropzone('#editEmployeeProfilePhoto', {
            url: base_url + 'users/profilePhoto',
            acceptedFiles: "image/*",
            maxFilesize: 20,
            maxFiles: 1,
            addRemoveLinks: true,
            init: function() {
                this.on("success", function(file, response) {
                    var file_name = JSON.parse(response)['photo'];
                    fname.push(file_name.replace(/\"/g, ""));
                    selected.push(file);
                    $('#editPhotoId').val(JSON.parse(response)['id']);
                    $('#editPhotoName').val(JSON.parse(response)['photo']);
                });
            },
            removedfile: function(file) {
                var name = fname;
                var index = selected.map(function(d, index) {
                    if (d == file) return index;
                }).filter(isFinite)[0];
                $.ajax({
                    type: "POST",
                    url: base_url + 'users/removeProfilePhoto',
                    dataType: 'json',
                    data: {
                        name: name,
                        index: index
                    },
                    success: function(data) {
                        if (data == 1) {
                            $('#editPhotoId').val(null);
                        }
                    }
                });
                //remove thumbnail
                var previewElement;
                return (previewElement = file.previewElement) != null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
            }
        });
    });


    var map;
    var add_new_address_map_clock_in;
    var new_map_marker;
    var antennasCircle_main_map;
    var main_map_marker;

    var antennasCircle_edit_map;
    var edit_address_map;
    var edit_lat;
    var edit_lng;
    var radius_edit_address = 76.2;
    var edit_created_by;

    var current_lat_clock_in = 0;
    var current_lng_clock_in = 0;
    var current_lat_clock_out = 0;
    var current_lng_clock_out = 0;
    var antennasCircle_new_adress;
    var radius_new_address = 76.2;
    var current_notify_settings;

    function initMap() {


        $(document).ready(function() {
            $.ajax({
                url: base_url + 'users/getData_for_clock_in_out_location',
                type: "POST",
                dataType: "json",
                data: {
                    user_id: $("#editUserID").val()
                },
                success: function(data) {
                    if (data.cLocation != 0) {
                        console.log('pasok')
                        if (data.cLocation[0]['clock_in_latitude'] != "" && data.cLocation[0]['clock_in_longtitude'] != "") {
                            current_lat_clock_in = data.cLocation[0]['clock_in_latitude'];
                            current_lng_clock_in = data.cLocation[0]['clock_in_longtitude'];
                        }

                        if (data.cLocation[0]['clock_out_latitude'] != "" && data.cLocation[0]['clock_out_longtitude'] != "") {
                            current_lat_clock_out = data.cLocation[0]['clock_out_latitude'];
                            current_lng_clock_out = data.cLocation[0]['clock_out_longtitude'];
                        }
                    } else {


                    }
                }
            });
        })


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
        if (current_lat_clock_in == 0 && current_lng_clock_in == 0) {
            current_lat_clock_in = position.coords.latitude;
            current_lng_clock_in = position.coords.longitude;
        }
        if (current_lat_clock_out == 0 && current_lat_clock_out == 0) {
            current_lat_clock_out = position.coords.latitude;
            current_lng_clock_out = position.coords.longitude;
        }


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


        add_new_address_map_clock_in = new google.maps.Map(document.getElementById("add_new_address_map_clock_in"), {
            center: {
                lat: current_lat_clock_in,
                lng: current_lng_clock_in
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
        add_new_address_map_clock_out = new google.maps.Map(document.getElementById("add_new_address_map_clock_out"), {
            center: {
                lat: current_lat_clock_out,
                lng: current_lng_clock_out
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
        add_new_address_map_clock_in.mapTypes.set("styled_map", styledMapType);
        add_new_address_map_clock_in.setMapTypeId("styled_map");

        add_new_address_map_clock_out.mapTypes.set("styled_map", styledMapType);
        add_new_address_map_clock_out.setMapTypeId("styled_map");

        google.maps.event.addListener(add_new_address_map_clock_in, 'dragend', function() {
            $("#new_formatted_address").val("Loading address...");
            $('#add_new_address_map_clock_in').addClass("add_new_address_map_clock_in");
            new_address_map_changed();
        });
        google.maps.event.addListener(add_new_address_map_clock_out, 'dragend', function() {
            $("#new_formatted_address1").val("Loading address...");
            $('#add_new_address_map_clock_out').addClass("add_new_address_map_clock_in");
            new_address_map_changed1();
        });

        setMapCenter("add_new_address_map_clock_in", current_lat_clock_in, current_lng_clock_in, true);
        setMapCenter1("add_new_address_map_clock_out", current_lat_clock_out, current_lng_clock_out, true);
    }

    function new_address_map_changed() {
        var center = add_new_address_map_clock_in.getCenter()
        var lat = center.lat();

        var lng = center.lng();

        if (current_lat_clock_in != lat && current_lng_clock_in != lng) {

            current_lat_clock_in = lat;
            current_lng_clock_in = lng;
            $('#allow_clock_in_lat').val(current_lat_clock_in);
            $('#allow_clock_in_lng').val(current_lng_clock_in);
            console.log("CLOCK IN:" + current_lat_clock_in + " " + current_lng_clock_in)

            if (antennasCircle_new_adress != null) {
                antennasCircle_new_adress.setMap(null);
                add_new_address_map_clock_in.fitBounds(antennasCircle_new_adress.getBounds());
            }
            antennasCircle_new_adress = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: add_new_address_map_clock_in,
                center: {
                    lat: current_lat_clock_in,
                    lng: current_lng_clock_in
                },
                radius: radius_new_address
            });
            add_new_address_map_clock_in.fitBounds(antennasCircle_new_adress.getBounds());

            var latlng = new google.maps.LatLng(current_lat_clock_in, current_lng_clock_out);
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

    function new_address_map_changed1() {
        var center = add_new_address_map_clock_out.getCenter()
        var lat = center.lat();

        var lng = center.lng();

        if (current_lat_clock_out != lat && current_lng_clock_out != lng) {

            current_lat_clock_out = lat;
            current_lng_clock_out = lng;
            $('#allow_clock_out_lat').val(current_lat_clock_out);
            $('#allow_clock_out_lng').val(current_lng_clock_out);
            console.log("CLOCK OUT: " + current_lat_clock_out + " " + current_lng_clock_out)

            if (antennasCircle_new_adress != null) {
                antennasCircle_new_adress.setMap(null);
                add_new_address_map_clock_out.fitBounds(antennasCircle_new_adress.getBounds());
            }
            antennasCircle_new_adress = new google.maps.Circle({
                strokeColor: "#0275FF",
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: "#8DC740",
                fillOpacity: 0.35,
                map: add_new_address_map_clock_out,
                center: {
                    lat: current_lat_clock_out,
                    lng: current_lng_clock_out
                },
                radius: radius_new_address
            });
            add_new_address_map_clock_out.fitBounds(antennasCircle_new_adress.getBounds());

            var latlng = new google.maps.LatLng(current_lat_clock_out, current_lng_clock_out);
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
                current_lat_clock_in = latitude;
                current_lng_clock_in = longitude;

                setMapCenter("add_new_address_map_clock_in", current_lat, current_lng);

            }
        });
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
                current_lat_clock_out = latitude;
                current_lng_clock_out = longitude;

                setMapCenter1("add_new_address_map_clock_out", current_lat_clock_out, current_lng_clock_out);

            }
        });
    }

    function setMapCenter(update_the_map, the_lat, the_lng, first = false) {
        var the_map = map;
        if (update_the_map == "add_new_address_map_clock_in") {
            the_map = add_new_address_map_clock_in;
        } else if (update_the_map == "edit_map") {
            the_map = edit_address_map;
        }
        if (update_the_map == "add_new_address_map_clock_in") {
            if (antennasCircle_new_adress != null) {
                antennasCircle_new_adress.setMap(null);
                add_new_address_map_clock_in.fitBounds(antennasCircle_new_adress.getBounds());
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
            add_new_address_map_clock_in = the_map;
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

    function setMapCenter1(update_the_map, the_lat, the_lng, first = false) {
        var the_map = map;
        if (update_the_map == "add_new_address_map_clock_out") {
            the_map = add_new_address_map_clock_in;
        } else if (update_the_map == "edit_map") {
            the_map = edit_address_map;
        }
        if (update_the_map == "add_new_address_map_clock_out") {
            if (antennasCircle_new_adress != null) {
                antennasCircle_new_adress.setMap(null);
                add_new_address_map_clock_in.fitBounds(antennasCircle_new_adress.getBounds());
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
            add_new_address_map_clock_out = the_map;
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
                    $("#new_formatted_address1").val(address);
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
    $(document).ready(function() {
        $('#edit_address_radius').on('input', function() {
            var center = add_new_address_map_clock_in.getCenter();
            edit_lat = center.lat();
            edit_lng = center.lng();

            $(".edit_radius_number_view").html(parseInt($("#edit_address_radius").val() * 3.28084, 10) + " ft zone");
            radius_edit_address = $("#edit_address_radius").val() * 1;
            setMapCenter("add_new_address_map_clock_in", parseFloat(edit_lat), parseFloat(edit_lng));

        });

        $("#allow_clock_in_input").on('change', function() {

            if ($("#allow_clock_in_input").val() == "0") {
                $("#allow_clock_in_input").val(1);
                $(".allow_clock_in_map").show();
            } else {
                $("#allow_clock_in_input").val(0);
                $(".allow_clock_in_map").hide();
            }

        })
    })
</script>
<script src="<?= "https://maps.googleapis.com/maps/api/js?key=" . GOOGLE_MAP_API_KEY . "&callback=initMap&libraries=&v=weekly" ?>" async></script>