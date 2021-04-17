// function initMap() {
//   map = new google.maps.Map(document.getElementById("map"), {
//     zoom: 14,
//     center: {
//       lat: 34.05349,
//       lng: -118.24532,
//     },
//     mapTypeId: "roadmap",
//   });
//   const marker = new google.maps.Marker({
//     position: {
//       lat: 34.05349,
//       lng: -118.24532,
//     },
//     map: map,
//   });
//   markers.push(marker);
// }

// function addMarker(lat, lng) {
//   const image = {
//     url: "<?= base_url() ?>/assets/img/trac360/default.png",
//     // This marker is 20 pixels wide by 32 pixels high.
//     scaledSize: new google.maps.Size(50, 50),
//     // The origin for this image is (0, 0).
//     origin: new google.maps.Point(0, 0),
//     // The anchor for this image is the base of the flagpole at (0, 32).
//     anchor: new google.maps.Point(0, 32),
//   };
//   const shape = {
//     coords: [1, 1, 1, 20, 18, 20, 18, 1],
//     type: "poly",
//   };
//   const marker = new google.maps.Marker({
//     position: {
//       lat: lat,
//       lng: lng,
//     },
//     icon: image,
//     map: map,
//   });
//   markers.push(marker);
// }

function setMapCenter(lat, lng) {
    map.setCenter({
        lat: lat,
        lng: lng,
    });
    google.maps.event.addListenerOnce(map, "bounds_changed", function() {
        map.setZoom(12);
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

function current_user_getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(current_user_showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

function current_user_showPosition(position) {
    current_user_latitude = position.coords.latitude;
    current_user_longitude = position.coords.longitude;

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
            latLng: new google.maps.LatLng(
                current_user_latitude,
                current_user_longitude
            ),
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var formattedAddress = "";
                    var lat;
                    var lng;
                    if (results[0].formatted_address != null) {
                        formattedAddress = results[0].formatted_address;
                    }

                    //debugger;

                    var location = results[0].geometry.location;

                    lat = location.lat;
                    lng = location.lng;
                    console.log(formattedAddress);
                    $.ajax({
                        url: baseURL + "/trac360/current_user_update_last_tracked_location",
                        type: "POST",
                        dataType: "json",
                        data: {
                            user_id: user_id,
                            company_id: company_id,
                            lat: current_user_latitude,
                            lng: current_user_longitude,
                            formatted_address: formattedAddress,
                        },
                        success: function(data) {
                            $("#last_tract_location_" + user_id).html(
                                `<span class="fa fa-map-marker" class="text-center"></span> ` +
                                formattedAddress +
                                " pasok"
                            );

                            $("#map_marker_" + user_id).html(
                                '<img src="' +
                                current_user_profile_img +
                                '"  class="popup-map-marker" title="' +
                                current_user_name +
                                '" />'
                            );
                            set_initmap();
                        },
                    });
                }
            }
        }
    );
}

// Setting popup marker