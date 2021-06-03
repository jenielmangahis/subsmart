$('#live-jobs-filter-form').on('submit', function(e) {
    e.preventDefault();
    $("#livejobs-collapse-panel .loader").show();
    $("#livejobs-collapse-panel .livejobs-section").hide();
    get_live_jobs($("#livejobs-collapse-panel #live-jobs-filter-form #livejob-long-id").val());
});

$(document).on("click", ".trac360-live-jobs-modal .trac360-close-btn", function() {
    $('.trac360-live-jobs-modal').fadeOut();
    live_last_route_id = 0;
    clearInterval(autoclockout_checker_loop);
});
$(document).on("click", "#livejobs-collapse-panel .livejobs-section .job-item-panel", function() {
    $('.trac360-live-jobs-modal').fadeIn();
    $('.trac360-live-jobs-modal .employee-name .name').html($(this).find('.employee-name .name').html());
    $('.trac360-live-jobs-modal #job-item-selected-view').html($(this).find('.jobs-list-item').html());
    $('.office-customer .address.office').html($(this).attr('data-office-address'));
    $('.office-customer .date-time.office').html('Office: ' + $(this).attr('data-business-name'));
    $('.office-customer .address.customer').html($(this).attr('data-customer-address'));
    $('.office-customer .date-time.customer').html('Customer: ' + $(this).attr('data-customer-name'));
    live_job_id = $(this).attr('data-job-id');
    live_employee_id = $(this).attr('data-employee-id');

    get_live_job_last_track_location($(this).attr('data-customer-address'), $(this).attr('data-office-address'));
});

function get_live_jobs(the_job_long_id = "") {
    $.ajax({
        url: baseURL + "/trac360/get_seach_live_jobs",
        type: "POST",
        dataType: "json",
        data: {
            the_job_long_id: the_job_long_id,
        },
        success: function(data) {
            if (data != null) {
                if (data.html == "") {
                    $("#livejobs-collapse-panel .livejobs-section").html('<div class="cue-event-name no-data">No live jobs.</div>');
                } else {
                    $("#livejobs-collapse-panel .livejobs-section").html(data.html);
                }
                $("#livejobs-collapse-panel .loader").hide();
                $("#livejobs-collapse-panel .livejobs-section").show();
            }
        },
    });
}

function get_live_job_last_track_location(customer_address, office_address) {
    $.ajax({
        url: baseURL + "/trac360/get_live_job_last_track_location",
        type: "POST",
        dataType: "json",
        data: {
            the_live_job_id: live_job_id,
            the_live_employee_id: live_employee_id,
        },
        success: function(data) {
            if (data != null) {
                if (data.html == "") {
                    $(".trac360-live-jobs-modal .route-details-setion .route-details-table .tbody").html('<tr><td class="no-data">No travel history available.</td></tr>');
                    clear_live_map();
                    clearInterval(autoclockout_checker_loop);

                } else {
                    autoclockout_checker_loop = setInterval(function() {
                        get_live_job_last_track_location(customer_address, office_address);
                        clearInterval(autoclockout_checker_loop);
                    }, 5000);
                    if (live_last_route_id != data.last_route_id) {
                        $(".trac360-live-jobs-modal .route-details-setion .route-details-table .tbody").html(data.html);
                        live_last_route_id = data.last_route_id;

                        clear_live_map();
                        emeployee_expected_live_calculateAndDisplayRoute(customer_address, office_address);
                        emeployee_live_calculateAndDisplayRoute(data.route_latlng);
                    }
                }
            }
        },
    });
}

function clear_live_map() {
    if (live_directionsRenderer != null) {
        live_directionsRenderer.setMap(null);
        live_directionsService = null;
    }
    if (antennasCircle_live_map != null) {
        antennasCircle_live_map.setMap(null);
        live_map.fitBounds(antennasCircle_live_map.getBounds());
    }
    if (expected_live_directionsRenderer != null) {
        expected_live_directionsRenderer.setMap(null);
        expected_live_directionsService = null;
    }
    if (expected_live_map_marker.length > 0) {
        for (var i = 0; i < expected_live_map_marker.length; i++) {
            expected_live_map_marker[i].setMap(null);
        }
        expected_live_map_marker = [];
    }
    if (live_map_marker.length > 0) {
        for (var i = 0; i < live_map_marker.length; i++) {
            live_map_marker[i].setMap(null);
        }
        live_map_marker = [];
    }
}

function emeployee_live_calculateAndDisplayRoute(route_latlng) {
    const waypts = [];
    for (let i = 0; i < route_latlng.length; i++) {
        if (i > 0 && i < route_latlng.length) {

            waypts.push({
                location: new google.maps.LatLng(route_latlng[i][0], route_latlng[i][1]),
                stopover: true,
            });
        }

    }

    live_directionsService = new google.maps.DirectionsService();
    live_directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    live_directionsRenderer.setOptions({
        polylineOptions: {
            strokeColor: '#6241A4'
        }
    });
    live_directionsRenderer.setMap(live_map);
    live_directionsService.route({
            origin: new google.maps.LatLng(route_latlng[0][0], route_latlng[0][1]),
            destination: new google.maps.LatLng(route_latlng[route_latlng.length - 1][0], route_latlng[route_latlng.length - 1][1]),
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING,
        },
        (response, status) => {
            if (status === "OK" && response) {
                live_directionsRenderer.setDirections(response);
                const route = response.routes[0];
                for (let i = 0; i < route.legs.length; i++) {

                    if (i == 0) {
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/map_marker1.png", // url
                            scaledSize: new google.maps.Size(50, 50), // scaled size
                        };
                        live_map_marker.push(new google.maps.Marker({
                            position: route.legs[i].start_location,
                            map: live_map,
                            icon: map_icon,
                            title: route_latlng[i][2],
                        }));
                    } else if (i == route.legs.length - 1) {
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/map_car_marker.png", // url
                            scaledSize: new google.maps.Size(50, 50)
                        };
                        live_map_marker.push(new google.maps.Marker({
                            position: route.legs[i].start_location,
                            map: live_map,
                            icon: map_icon,
                            title: route_latlng[i][2],
                        }));
                    } else {
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/map_waypoint.png", // url
                            scaledSize: new google.maps.Size(15, 15)
                        };
                        live_map_marker.push(new google.maps.Marker({
                            position: route.legs[i].start_location,
                            map: live_map,
                            icon: map_icon,
                            title: route_latlng[i][2],
                        }));
                    }
                    live_map_marker[i].addListener("click", function() {
                        openwindow_title(live_map_marker[i]);
                    });
                }

            } else {
                window.alert("Directions request failed due to " + status);
            }
        }
    );

}

function emeployee_expected_live_calculateAndDisplayRoute(customer_address, office_address) {
    console.log(office_address);
    expected_live_directionsService = new google.maps.DirectionsService();
    expected_live_directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });
    expected_live_directionsRenderer.setMap(live_map);
    expected_live_directionsService.route({
            origin: {
                query: office_address,
            },
            destination: {
                query: customer_address,
            },
            travelMode: google.maps.TravelMode.DRIVING,
        },
        (response, status) => {
            if (status === "OK") {
                expected_live_directionsRenderer.setDirections(response);

                var my_route = response.routes[0];
                const map_icon = {
                    url: base_url + "/assets/img/trac360/office.png", // url
                    scaledSize: new google.maps.Size(50, 50), // scaled size
                };
                expected_live_map_marker.push(new google.maps.Marker({
                    position: my_route.legs[0].start_location,
                    map: live_map,
                    icon: map_icon,
                    title: office_address,
                }));
                expected_live_map_marker[0].addListener("click", function() {
                    toggleBounce(expected_live_map_marker[0]);
                });
                expected_live_map_marker.push(new google.maps.Marker({
                    position: my_route.legs[my_route.legs.length - 1].end_location,
                    map: live_map,
                    icon: {
                        url: base_url + "/assets/img/trac360/home_address.png",
                        scaledSize: new google.maps.Size(50, 50),
                    },
                    title: customer_address,
                }));
                expected_live_map_marker[1].addListener("click", function() {
                    toggleBounce(expected_live_map_marker[1]);
                });
            } else {
                window.alert("Expected directions request failed due to " + status);
            }
        }
    );
}

function toggleBounce(the_marker) {
    if (live_infoWindow != null) {
        if (live_infoWindow) {
            live_infoWindow.close();
        }
    }
    live_infoWindow = new google.maps.InfoWindow();
    live_infoWindow.setContent(the_marker.getTitle());
    live_infoWindow.open(the_marker.getMap(), the_marker);
}

function openwindow_title(the_marker) {
    if (live_infoWindow != null) {
        if (live_infoWindow) {
            live_infoWindow.close();
        }
    }
    live_infoWindow = new google.maps.InfoWindow();
    live_infoWindow.setContent(the_marker.getTitle());
    live_infoWindow.open(the_marker.getMap(), the_marker);
}