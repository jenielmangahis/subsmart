function setMapCenter(lat, lng) {
    map.setCenter({
        lat: lat,
        lng: lng,
    });
    google.maps.event.addListenerOnce(map, "bounds_changed", function() {
        map.setZoom(14);
    });
}

function user_selected(lat, lng, id) {
    setMapCenter(lat, lng);
    $(".current_view").removeClass("current_view");
    $("#sec-2-option-" + id).addClass("current_view");
}

function getLatLongDetail(myLatlng, user_id) {
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
            latLng: myLatlng,
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var address = "",
                        city = "",
                        state = "",
                        zip = "",
                        country = "",
                        formattedAddress = "";
                    var lat;
                    var lng;

                    for (var i = 0; i < results[0].address_components.length; i++) {
                        var addr = results[0].address_components[i];
                        // check if this entry in address_components has a type of country
                        if (addr.types[0] == "country") country = addr.long_name;
                        else if (addr.types[0] == "street_address")
                        // address 1
                            address = address + addr.long_name;
                        else if (addr.types[0] == "establishment")
                            address = address + addr.long_name;
                        else if (addr.types[0] == "route")
                        // address 2
                            address = address + addr.long_name;
                        else if (addr.types[0] == "postal_code")
                        // Zip
                            zip = addr.short_name;
                        else if (addr.types[0] == ["administrative_area_level_1"])
                        // State
                            state = addr.long_name;
                        else if (addr.types[0] == ["locality"])
                        // City
                            city = addr.long_name;
                    }

                    if (results[0].formatted_address != null) {
                        formattedAddress = results[0].formatted_address;
                    }

                    //debugger;

                    var location = results[0].geometry.location;

                    lat = location.lat;
                    lng = location.lng;

                    $("#last_tract_location_" + user_id).html(
                        `<span class="fa fa-map-marker" class="text-center"></span> ` +
                        formattedAddress
                    );
                }
            }
        }
    );
}

function get_employee_jobs(user_id) {
    $.ajax({
        url: baseURL + "/trac360/get_employee_upcoming_jobs",
        type: "POST",
        dataType: "json",
        data: {
            user_id: user_id
        },
        success: function(data) {
            if (data != null) {
                $("#employee-upcoming-jobs").html(data.html);
                $(".loader").hide();
            }

        },
    });
}

function toggleBounce() {
    if (jobs_map_marker.getAnimation() !== null) {
        jobs_map_marker.setAnimation(null);
    } else {
        jobs_map_marker.setAnimation(google.maps.Animation.BOUNCE);
        const infoWindow = new google.maps.InfoWindow()
        infoWindow.close();
        infoWindow.setContent(jobs_map_marker.getTitle());
        infoWindow.open(jobs_map_marker.getMap(), jobs_map_marker);
    }
}

$(document).on("click", ".people-job-btn", function() {
    $(".peoples-lists-section").hide();
    $(".jobs-list-section").fadeIn();
    $(".loader").show();
    $(".jobs-list-section .employee-name .name").html($(this).attr('data-name'));
    get_employee_jobs($(this).attr('data-user-id'))
});
$(document).on("click", ".back-btn", function() {
    $(".jobs-list-section").hide();
    $(".peoples-lists-section").fadeIn();
    $(".loader").hide();
    $('#jobs-map').hide();
    $('#map').show();
});

$(document).on("click", ".jobs-list-item", function() {
    var item_address = $(this).attr('data-address');
    var item_job_title = $(this).attr('data-job-title');
    $(".job-item-selected").removeClass('job-item-selected');
    $(this).addClass('job-item-selected');

    $('#map').hide();
    if (!$("#jobs-map").is(":visible")) {
        $('#map-loader').show();
    }
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': item_address
    }, function(results, status) {
        $('#map-loader').hide();
        $('#jobs-map').show();
        if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            if (jobs_map_marker != null) {
                jobs_map_marker.setMap(null);
            }
            const image =
                base_url + "/assets/img/trac360/house-map-marker1.png";
            jobs_map_marker = new google.maps.Marker({
                map: jobs_map,
                draggable: false,
                animation: google.maps.Animation.DROP,
                position: {
                    lat: latitude,
                    lng: longitude
                },
                title: item_job_title,
                icon: image
            });
            jobs_map_marker.addListener("click", toggleBounce);
            // console.log(beachMarker);
            jobs_map.setZoom(18);
            jobs_map.setCenter({
                lat: latitude,
                lng: longitude,
            });
            console.log(item_address + "~:" + latitude + "," + longitude);

        }
    });
});



// Setting popup marker