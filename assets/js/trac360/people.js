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




// Setting popup marker