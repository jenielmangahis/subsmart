$(document).on("click", "#add_new_place_modal_btn", function() {
    console.log("yes");
    $("#add_new_place_modal").modal({
        backdrop: "static",
        keyboard: false,
    });
    $(".hiddenSection").show();

});


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
                        lng: current_lat
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