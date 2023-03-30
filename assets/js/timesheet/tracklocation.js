function setMapCenter(lat, lng) {
    map.setCenter({
        lat: lat,
        lng: lng,
    });
    google.maps.event.addListenerOnce(map, "bounds_changed", function() {
        map.setZoom(14);
    });
}

function employee_selected(lat, lng, customer_id) {
    // alert("#sec-2-option-" + customer_id);
    $(".current_view").removeClass("current_view");
    $("#sec-2-option-" + customer_id).addClass("current_view");
    setMapCenter(lat, lng);

}