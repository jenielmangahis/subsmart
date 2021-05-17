function selected_place(the_lat, the_lng, the_name, the_address, the_radius, place_id = 0) {
    if (antennasCircle_main_map != null) {
        antennasCircle_main_map.setMap(null);
        map.fitBounds(antennasCircle_main_map.getBounds());
    }
    antennasCircle_main_map = new google.maps.Circle({
        strokeColor: "#0275FF",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#8DC740",
        fillOpacity: 0.35,
        map: map,
        center: {
            lat: the_lat,
            lng: the_lng
        },
        radius: the_radius
    });
    if (main_map_marker != null) {
        main_map_marker.setMap(null);
    }
    main_map_marker = new google.maps.Marker({
        map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: {
            lat: the_lat,
            lng: the_lng
        },
        title: the_name
    });
    main_map_marker.addListener("click", toggleBounce);
    map.fitBounds(antennasCircle_main_map.getBounds());
    $('.sec-2-address-btn').removeAttr('active');
    $('#sec-2-address-btn-' + place_id).attr('active', '');
}

function toggleBounce() {
    if (main_map_marker.getAnimation() !== null) {
        main_map_marker.setAnimation(null);
    } else {
        main_map_marker.setAnimation(google.maps.Animation.BOUNCE);
        const infoWindow = new google.maps.InfoWindow()
        infoWindow.close();
        infoWindow.setContent(main_map_marker.getTitle());
        infoWindow.open(main_map_marker.getMap(), main_map_marker);
    }
}

function edit_address_map_changed() {
    var center = edit_address_map.getCenter()
    var lat = center.lat();
    var lng = center.lng();
    if (edit_lat != lat && edit_lng != lng) {
        edit_lat = lat;
        edit_lng = lng;

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

        var latlng = new google.maps.LatLng(edit_lat, edit_lng);
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
    }
}







$(document).ready(function() {
    $(document).on("click", "#add_new_place_modal_btn", function() {
        $("#add_new_place_modal").modal({
            backdrop: "static",
            keyboard: false,
        });
        $(".hiddenSection").show();

    });

    $(document).on("click", "#place_notif_modal_btn", function() {
        $("#place_notif_modal").modal({
            backdrop: "static",
            keyboard: false,
        });
        $(".hiddenSection").show();
        get_notify_settings($(this).attr("data-place-id"), $(this).attr("data-user-id"));
    });
    $("#form_new_address").submit(function(event) {

        event.preventDefault();
    });

    $("#form_editaddress").submit(function(event) {
        event.preventDefault();
    });
    $(document).on("click", "#save_new_address", function() {
        Swal.fire({
            title: "Save?",
            html: "Are your sure you want to add this new address? <br><b>" + $("#new_formatted_address").val() + "</b>",
            imageUrl: baseURL + "/assets/img/trac360/map_with_marker1.png",
            showCancelButton: true,
            confirmButtonColor: "#2ca01c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Add new address",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "/trac360/add_new_address",
                    type: "POST",
                    dataType: "json",
                    data: {
                        new_place_name: $("#new_place_name").val(),
                        new_formatted_address: $("#new_formatted_address").val(),
                        new_address_radius: $('#new_address_radius').val(),
                        lat: current_lat,
                        lng: current_lng
                    },
                    success: function(data) {
                        if (data != null) {
                            $("#added-places-section").html(data.places);
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "New address has been added.",
                                icon: "success",
                            });
                            $("#add_new_place_modal").modal('hide');
                            selected_place(
                                current_lat,
                                current_lng,
                                $("#new_place_name").val(),
                                $("#new_formatted_address").val(),
                                parseFloat($("#new_address_radius").val()),
                                data.place_id);
                        }

                    },
                });
            }
        });
    });
    $('#new_address_radius').on('input', function() {
        $(".radius_number_view").html(parseInt($("#new_address_radius").val() * 3.28084, 10) + " ft zone");
        radius_new_address = $("#new_address_radius").val() * 1;
        setMapCenter("add_new", current_lat, current_lng);
    });

    $('#edit_address_radius').on('input', function() {
        $(".edit_radius_number_view").html(parseInt($("#edit_address_radius").val() * 3.28084, 10) + " ft zone");
        radius_edit_address = $("#edit_address_radius").val() * 1;
        setMapCenter("edit_map", parseFloat(edit_lat), parseFloat(edit_lng));
    });

    $(document).on("click", "#delete_place", function() {
        Swal.fire({
            title: "Delete?",
            html: "Are you sure you want to delete this address? <b><br>" + $("#edit_formatted_address").val() + "</b>",
            imageUrl: baseURL + "/assets/img/trac360/delete.gif",
            showCancelButton: true,
            confirmButtonColor: "#EC4461",
            cancelButtonColor: "#919191",
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "/trac360/delete_place",
                    type: "POST",
                    dataType: "json",
                    data: {
                        place_id: $(this).attr('data-place-id')
                    },
                    success: function(data) {
                        if (data != null) {
                            $("#added-places-section").html(data.places);
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "DELETED",
                                html: "Address has been deleted",
                                icon: "success",
                            });
                            $("#edit_address_modal").modal('hide');
                            antennasCircle_main_map.setMap(null);
                            map.fitBounds(antennasCircle_main_map.getBounds());
                            main_map_marker.setMap(null);
                            map.setZoom(12);
                        }

                    },
                });
            }
        });
    });
    $(document).on("click", "#save_edited_address", function() {
        Swal.fire({
            title: "Update?",
            html: "Are you sure you want to save this changes? <b><br>" + $("#edit_formatted_address").val() + "</b>",
            imageUrl: baseURL + "/assets/img/trac360/map_with_marker1.png",
            showCancelButton: true,
            confirmButtonColor: "#01A599",
            cancelButtonColor: "#919191",
            confirmButtonText: "Save changes",
        }).then((result) => {
            if (result.value) {
                var place_id = $(this).attr('data-place-id');
                $.ajax({
                    url: baseURL + "/trac360/update_place",
                    type: "POST",
                    dataType: "json",
                    data: {
                        place_id: place_id,
                        lat: edit_lat,
                        lng: edit_lng,
                        address: $("#edit_formatted_address").val(),
                        place_name: $("#edit_place_name").val(),
                        zone_radius: $("#edit_address_radius").val()
                    },
                    success: function(data) {
                        if (data != null) {
                            $("#added-places-section").html(data.places);
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "UPDATED",
                                html: "Address has been updated",
                                icon: "success",
                            });
                            $("#edit_address_modal").modal('hide');
                            selected_place(edit_lat, edit_lng, $("#edit_place_name").val(), $("#edit_formatted_address").val(), parseFloat($("#edit_address_radius").val()), place_id);
                        }

                    },
                });
            }
        });
    });
    $(document).on("click", ".edit_address_modal_btn", function() {
        $("#edit_address_modal").modal({
            backdrop: "static",
            keyboard: false,
        });
        $(".hiddenSection").show();

        edit_lat = parseFloat($(this).attr('data-lat'));
        edit_lng = parseFloat($(this).attr('data-lng'));
        edit_created_by = $(this).attr('data-uber-id');
        $("#edit_place_name").val($(this).attr('data-place-name'));
        $("#edit_formatted_address").val($(this).attr('data-address'));
        $("#edit_address_radius").val($(this).attr('data-radius'));
        radius_edit_address = parseFloat($(this).attr('data-radius')) * 1;
        $(".edit_radius_number_view").html(parseInt($("#edit_address_radius").val() * 3.28084, 10) + " ft zone");
        $("#delete_place").attr('data-place-id', $(this).attr('data-place-id'));
        $("#save_edited_address").attr('data-place-id', $(this).attr('data-place-id'));

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
        edit_address_map.setCenter({
            lat: edit_lat,
            lng: edit_lng,
        });
        if (radius_edit_address >= 1246.360) {
            edit_address_map.setZoom(13);
        } else {
            edit_address_map.setZoom(15);
        }
    });

    $(document).on("click", "#save_notification_settings", function() {
        Swal.fire({
            title: "Save Changes?",
            html: "Are you sure you want to save this changes?",
            imageUrl: baseURL + "/assets/img/trac360/save.png",
            showCancelButton: true,
            confirmButtonColor: "#01A599",
            cancelButtonColor: "#919191",
            confirmButtonText: "Save changes",
        }).then((result) => {
            if (result.value) {
                var place_id = $(this).attr('data-place-id');
                $.ajax({
                    url: baseURL + "/trac360/save_notif_changes",
                    type: "POST",
                    dataType: "json",
                    data: $("#notify_settings_form").serializeArray(),
                    success: function(data) {
                        if (data != null) {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "UPDATED",
                                html: "Notification settings has been updated.",
                                icon: "success",
                            });
                            $("#place_notif_modal").modal('hide');
                        }

                    },
                });
            }
        });
    });

    $(document).on("click", ".select-circler", function() {
        $(".circle-options").show();
    });
    $(document).on('keyup', function(e) {
        if (e.key == "Escape") {
            $(".circle-options").hide();
        }
    });
    $(document).mouseup(function(e) {
        if (!$(".circle-options").is(e.target) && $(".circle-options").has(e.target).length === 0) {
            $(".circle-options").hide();
        }
    });
});

function get_notify_settings(place_id, user_id) {
    $('.notify-settings-loader').show();
    $('#users-notify-settings').hide();
    $.ajax({
        url: baseURL + "/trac360/get_notify_settings",
        type: "POST",
        dataType: "json",
        data: {
            place_id: place_id,
            user_id: user_id
        },
        success: function(data) {
            if (data != null) {
                $('.notify-settings-loader').hide();
                $('#users-notify-settings').show();
                $("#notify_place_id").val(place_id);
                var notify_settings = data.notify_settings;
                current_notify_settings = notify_settings;
                for (var i = 0; i < notify_settings.length; i++) {
                    var item = notify_settings[i];
                    if (item.notify_when_arrive == 1) {
                        $("#arrives_" + item.user_id).bootstrapToggle('on');
                    } else {
                        $("#arrives_" + item.user_id).bootstrapToggle('off');
                    }
                    if (item.notify_when_leave == 1) {
                        $("#leaves_" + item.user_id).bootstrapToggle('on');
                    } else {
                        $("#leaves_" + item.user_id).bootstrapToggle('off');
                    }
                }

            }
        },
    });
}