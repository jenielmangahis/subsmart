$(document).on("click", "#add_new_place_btn", function() {
    // console.log("yes");
    $("#add_new_place").modal({
        backdrop: "static",
        keyboard: false,
    });
    $(".hiddenSection").show();

});