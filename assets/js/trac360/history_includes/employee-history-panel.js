$("input.date-picker").datepicker();
$(document).on("click", "#employees-view-history-panel .close-btn", function() {
    $("#employees-view-history-panel").removeClass("panel-show");
    $("#employees-view-history-panel").addClass("panel-closed");
});

$(document).on("click", ".people-history-btn", function() {
    $("#employees-view-history-panel").removeClass("panel-closed");
    $("#employees-view-history-panel").addClass("panel-show");
    $("#employees-view-history-panel .panel-content #route-details-setion").hide();
    $("#employees-view-history-panel .panel-content .loader").show();
    $("#employe-history-from").val(date_today);
    $("#employe-history-to").val(date_today);
    $("#employee-history-filter-form").attr("data-user-id", $(this).attr("data-user-id"));
    $("#employees-view-history-panel .employee-name .name").html($(this).attr("data-name"));
    get_employee_history(date_today, date_today, $(this).attr("data-user-id"));
    $(".sec-2-option.current_view").removeClass("current_view");
    $(this).parent().parent().parent().parent(".sec-2-option").addClass("current_view");
});
$('#employee-history-filter-form').on('submit', function(e) {
    e.preventDefault();
    $("#employees-view-history-panel .panel-content #route-details-setion").hide();
    $("#employees-view-history-panel .panel-content .loader").show();
    get_employee_history($("#employe-history-from").val(), $("#employe-history-to").val(), $("#employee-history-filter-form").attr("data-user-id"));
});

$(document).on("click", "#route-details-setion .route-details-table .last-coords-details", function() {
    const index = parseInt($(this).attr("data-i"));
    history_map.setCenter(history_map_marker[index].internalPosition);
    history_map.setZoom(13);
});

$(document).on('mouseenter', '#route-details-setion .route-details-table .last-coords-details', function(event) {
    const index = parseInt($(this).attr("data-i"));
    openwindow_title(history_map_marker[index]);
}).on('mouseleave', '#route-details-setion .route-details-table .last-coords-details', function() {
    if (infoWindow != null) {
        if (infoWindow) {
            infoWindow.close();
        }
    }
});


function get_employee_history(the_date_from, the_date_to, the_user_id) {
    $.ajax({
        url: baseURL + "/trac360/get_employee_history",
        type: "POST",
        dataType: "json",
        data: {
            the_user_id: the_user_id,
            the_date_from: the_date_from,
            the_date_to: the_date_to
        },
        success: function(data) {
            if (data != null) {
                if (data.html == "") {
                    $("#route-details-setion .route-details-table .tbody").html('<tr><td class="no-data">No history available.</td></tr>');
                } else {
                    $("#route-details-setion .route-details-table .tbody").html(data.html);
                    emeployee_history_calculateAndDisplayRoute(data.route_latlng)
                }
                $("#employees-view-history-panel .panel-content #route-details-setion").show();
                $("#employees-view-history-panel .panel-content .loader").hide();
            }
        },
    });
}

function emeployee_history_calculateAndDisplayRoute(route_latlng, actual_duration = 0) {
    if (directionsRenderer != null) {
        directionsRenderer.setMap(null);
        directionsService = null;
    }
    const waypts = [];
    if (antennasCircle_history_map != null) {
        antennasCircle_history_map.setMap(null);
        history_map.fitBounds(antennasCircle_history_map.getBounds());
    }
    for (let i = 0; i < route_latlng.length; i++) {
        if (i > 0 && i < route_latlng.length) {

            waypts.push({
                location: new google.maps.LatLng(route_latlng[i][0], route_latlng[i][1]),
                stopover: true,
            });
        }

    }

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });
    directionsRenderer.setOptions({
        polylineOptions: {
            strokeColor: '#6241A4'
        }
    });
    directionsRenderer.setMap(history_map);
    directionsService.route({
            origin: new google.maps.LatLng(route_latlng[0][0], route_latlng[0][1]),
            destination: new google.maps.LatLng(route_latlng[route_latlng.length - 1][0], route_latlng[route_latlng.length - 1][1]),
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: google.maps.TravelMode.DRIVING,
        },
        (response, status) => {
            if (status === "OK" && response) {
                directionsRenderer.setDirections(response);
                const route = response.routes[0];
                if (history_map_marker.length > 0) {
                    for (var i = 0; i < history_map_marker.length; i++) {
                        history_map_marker[i].setMap(null);
                    }
                    history_map_marker = [];
                }
                var total_distance = 0;
                for (let i = 0; i < route.legs.length; i++) {

                    if (i == 0) {
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/map_marker1.png", // url
                            scaledSize: new google.maps.Size(50, 50), // scaled size
                        };
                        history_map_marker.push(new google.maps.Marker({
                            position: route.legs[i].start_location,
                            map: history_map,
                            icon: map_icon,
                            title: route_latlng[i][2],
                        }));
                    } else if (i == route.legs.length - 1) {
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/map_marker1.png", // url
                            scaledSize: new google.maps.Size(50, 50)
                        };
                        history_map_marker.push(new google.maps.Marker({
                            position: route.legs[i].start_location,
                            map: history_map,
                            icon: map_icon,
                            title: route_latlng[i][2],
                        }));
                    } else {
                        const map_icon = {
                            url: base_url + "/assets/img/trac360/map_waypoint.png", // url
                            scaledSize: new google.maps.Size(15, 15)
                        };
                        history_map_marker.push(new google.maps.Marker({
                            position: route.legs[i].start_location,
                            map: history_map,
                            icon: map_icon,
                            title: route_latlng[i][2],
                        }));
                    }
                    history_map_marker[i].addListener("click", function() {
                        openwindow_title(history_map_marker[i]);
                    });
                    total_distance += route.legs[i].distance.value;
                    if (i < route.legs.length - 1) {
                        $("#single-job-view-panel .route-details-setion .route-details-table .date-time .speed" + (i + 1)).html(" (" + parseFloat(((route.legs[i].distance.value / 1609.34) / (route.legs[i].duration.value / 60 / 60))).toFixed(2) + " mi/hr)");
                        $("#single-job-view-panel .route-details-setion .route-details-table .milage" + i).html(route.legs[i].distance.text);
                    }

                }
                $("#single-job-view-panel .estimated-calculation .distance .value").html(parseFloat(total_distance / 1609.34).toFixed(2) + "<br> mi");
                if (actual_duration > 0) {
                    $("#single-job-view-panel .estimated-calculation .exp-speed .value").html(parseFloat((total_distance / 1609.34) / ((actual_duration / 60) / 60)).toFixed(2) + "<br>mi/hr");
                }
            } else {
                window.alert("Directions request failed due to " + status);
            }
        }
    );

}

function add_waypoint_cercle(the_lat, the_lng) {

    antennasCircle_history_map = new google.maps.Circle({
        strokeColor: "#0275FF",
        strokeOpacity: 1,
        strokeWeight: 2,
        fillColor: "#0275FF",
        fillOpacity: 1,
        map: history_map,
        center: {
            lat: the_lat,
            lng: the_lng
        },
        radius: 20
    });
}

function openwindow_title(the_marker) {
    if (infoWindow != null) {
        if (infoWindow) {
            infoWindow.close();
        }
    }
    infoWindow = new google.maps.InfoWindow();
    infoWindow.setContent(the_marker.getTitle());
    infoWindow.open(the_marker.getMap(), the_marker);
}