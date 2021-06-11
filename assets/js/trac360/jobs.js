$(document).on("click", ".jobs-collapse-btn", function() {
    if ($(this).hasClass('collapse-active')) {
        $(this).removeClass('collapse-active');
    } else {
        $('.jobs-collapse-btn').removeClass('collapse-active');
        $(this).addClass('collapse-active');
        if ($(this).hasClass('upcoming')) {
            $("#previousjobs-collapse-panel").removeClass("show");
            $("#livejobs-collapse-panel").removeClass("show");
        } else if ($(this).hasClass('live')) {
            $("#previousjobs-collapse-panel").removeClass("show");
            $("#upcomingjobs-collapse-panel").removeClass("show");
        } else {
            $("#upcomingjobs-collapse-panel").removeClass("show");
            $("#livejobs-collapse-panel").removeClass("show");
        }
    }
});
$(document).on("click", "#single-job-view-directionsRenderer-panel .close-btn", function() {
    $("#single-job-view-directionsRenderer-panel").removeClass("open");
    $("#single-job-view-directionsRenderer-panel").addClass('panel-closed');
});

function toggleBounce(the_marker) {
    if (infoWindow != null) {
        if (infoWindow) {
            infoWindow.close();
        }
    }
    infoWindow = new google.maps.InfoWindow();
    infoWindow.setContent(the_marker.getTitle());
    infoWindow.open(the_marker.getMap(), the_marker);
}
$(document).on("click", ".jobs-list-item", function() {
    if ($(this).attr('data-group') == 'upcoming') {
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
        $("#single-job-view-directionsRenderer-panel .employee-name").html($(this).parent().children('.employee-name').html());
        load_upcoming_jobs_panel(item_address, item_job_title, item_office_address, item_business_name);
    }

});

function load_upcoming_jobs_panel(item_address, item_job_title, item_office_address, item_business_name) {
    $('#map').hide();
    $("#single-job-view-directionsRenderer-panel .estimated-calculation").hide();
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
                        var duration = my_route.legs[0].duration.value / 60;
                        var variable = "min";
                        if (duration > 60) {
                            duration = duration / 60;
                            variable = "hr";
                        }
                        $("#single-job-view-directionsRenderer-panel .estimated-calculation .est.eta .value").html(parseFloat(duration).toFixed(2) + "<br> " + variable);
                        $("#single-job-view-directionsRenderer-panel  .estimated-calculation .est.distance .value").html(parseFloat(my_route.legs[0].distance.value / 1609.34).toFixed(2) + "<br> mi");
                        $("#single-job-view-directionsRenderer-panel  .estimated-calculation .est.exp-speed .value").html(parseFloat(((my_route.legs[0].distance.value / 1609.34) / (my_route.legs[0].duration.value / 60 / 60))).toFixed(2) + "<br> mi/hr");
                        $("#single-job-view-directionsRenderer-panel .estimated-calculation").show();
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
}


$(document).on("click", "#previousjobs-collapse-panel .job-item-panel", function() {
    var external_job_id = $(this).attr('data-job-id');
    console.log(external_job_id);
    window.location.href = baseURL + "/trac360/history/" + external_job_id;
});

function external_jobs_list_item_clicked(job_id, employee_id, employee_name, job_item_selected_view, item_address, item_job_title, item_office_address, item_business_name) {
    $("#single-job-view-directionsRenderer-panel").removeClass("panel-closed");
    $("#single-job-view-directionsRenderer-panel").addClass("panel-show open");
    $("#single-job-view-directionsRenderer-panel .panel-content .route-details-setion").hide();
    $("#single-job-view-directionsRenderer-panel .panel-content .loader").show();
    $("#single-job-view-directionsRenderer-panel .employee-name .name").html(employee_name);
    $("#single-job-view-directionsRenderer-panel #job-item-selected-view").html(job_item_selected_view);
    load_upcoming_jobs_panel(item_address, item_job_title, item_office_address, item_business_name);
}