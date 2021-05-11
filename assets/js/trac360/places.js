$(document).on("click", "#add_new_place_modal_btn", function() {
    console.log("yes");
    $("#add_new_place_modal").modal({
        backdrop: "static",
        keyboard: false,
    });
    $(".hiddenSection").show();

});

$(document).on("click", "#place_notif_modal_btn", function() {
    console.log("yes");
    $("#place_notif_modal").modal({
        backdrop: "static",
        keyboard: false,
    });
    $(".hiddenSection").show();

});

function selected_place(the_lat, the_lng, the_name, the_address, the_radius) {
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
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: {
            lat: the_lat,
            lng: the_lng
        },
        title: the_name
    });
    main_map_marker.addListener("click", toggleBounce);
    map.fitBounds(antennasCircle_main_map.getBounds());
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

$(document).ready(function() {
    $("#form_new_address").submit(function(event) {

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
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "New address has been added.",
                                icon: "success",
                            });
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

});