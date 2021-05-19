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
    $("#employee-upcoming-jobs").hide();
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
                $("#employee-upcoming-jobs").show();
            }

        },
    });
}

function toggleBounce(the_marker) {
    // if (the_marker.getAnimation() !== null) {
    //     the_marker.setAnimation(null);
    // } else {
    //     the_marker.setAnimation(google.maps.Animation.BOUNCE);
    // }
    if (infoWindow != null) {
        if (infoWindow) {
            infoWindow.close();
        }
    }
    infoWindow = new google.maps.InfoWindow();
    infoWindow.setContent(the_marker.getTitle());
    infoWindow.open(the_marker.getMap(), the_marker);
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
    $(".map-error-message").hide();
    $("#single-job-view-directionsRenderer-panel").removeClass("open");
    $("#single-job-view-directionsRenderer-panel").addClass('close');
});

$(document).on("click", "#single-job-view-directionsRenderer-panel .close-btn", function() {
    $("#single-job-view-directionsRenderer-panel").removeClass("open");
    $("#single-job-view-directionsRenderer-panel").addClass('close');
});

$(document).on("click", ".jobs-list-item", function() {
    var item_address = $(this).attr('data-address');
    var item_job_title = $(this).attr('data-job-title');
    var item_office_address = $(this).attr('data-office-address');
    var item_business_name = $(this).attr('data-business-name');
    $(".job-item-selected").removeClass('job-item-selected');
    $(this).addClass('job-item-selected');

    $("#single-job-view-directionsRenderer-panel").removeClass("close");
    $("#single-job-view-directionsRenderer-panel").addClass('open');
    $("#job-item-selected-view").html($(this).html());
    $('#single-job-view-directionsRenderer-panel-view').html('');

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

            if (directionsRenderer != null) {
                directionsRenderer.setMap(null);
                directionsService = null;
            }
            directionsService = new google.maps.DirectionsService();
            directionsRenderer = new google.maps.DirectionsRenderer({
                suppressMarkers: true
            });
            directionsRenderer.setMap(jobs_map);
            directionsRenderer.setPanel(document.getElementById("single-job-view-directionsRenderer-panel-view"));
            directionsService.route({
                    origin: {
                        query: item_office_address,
                    },
                    destination: new google.maps.LatLng(latitude, longitude),
                    travelMode: google.maps.TravelMode.DRIVING,
                    avoidTolls: true,
                    avoidHighways: true
                },
                (response, status) => {
                    if (status === "OK") {
                        directionsRenderer.setDirections(response);

                        if (jobs_map_marker.length > 0) {
                            for (var i = 0; i < jobs_map_marker.length; i++) {
                                jobs_map_marker[i].setMap(null);
                            }
                            jobs_map_marker = [];
                        }
                        var my_route = response.routes[0];
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/office.png", // url
                            scaledSize: new google.maps.Size(50, 50), // scaled size
                        };
                        jobs_map_marker.push(new google.maps.Marker({
                            position: my_route.legs[0].start_location,
                            map: jobs_map,
                            icon: map_icon,
                            title: item_business_name,
                        }));
                        jobs_map_marker[0].addListener("click", function() {
                            toggleBounce(jobs_map_marker[0]);
                        });
                        jobs_map_marker.push(new google.maps.Marker({
                            position: my_route.legs[my_route.legs.length - 1].end_location,
                            map: jobs_map,
                            icon: {
                                url: base_url + "/assets/img/trac360/home_address.png",
                                scaledSize: new google.maps.Size(50, 50),
                            },
                            title: item_job_title,
                        }));
                        jobs_map_marker[1].addListener("click", function() {
                            toggleBounce(jobs_map_marker[1]);
                        });
                        $(".map-error-message").hide();
                    } else {
                        if (jobs_map_marker.length > 0) {
                            for (var i = 0; i < jobs_map_marker.length; i++) {
                                jobs_map_marker[i].setMap(null);
                            }
                            jobs_map_marker = [];
                        }
                        jobs_map_marker.push(new google.maps.Marker({
                            position: {
                                lat: latitude,
                                lng: longitude
                            },
                            map: jobs_map,
                            icon: {
                                url: base_url + "/assets/img/trac360/house-map-marker1.png",
                                scaledSize: new google.maps.Size(50, 50),
                            },
                            title: item_job_title,
                        }));
                        jobs_map_marker[0].addListener("click", function() {
                            toggleBounce(jobs_map_marker[0]);
                        });
                        jobs_map.setCenter({
                            lat: latitude,
                            lng: longitude,
                        });
                        jobs_map.setZoom(13);
                        $(".map-error-message").html("Directions request failed due to " + status);
                        $(".map-error-message").show();
                    }
                }
            );



        }
    });
});



// Setting popup marker