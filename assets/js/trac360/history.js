$("input.date-picker").datepicker();
$(document).on("click", ".collapse-btn", function() {
    if ($(this).hasClass('collapse-active')) {
        $(this).removeClass('collapse-active');
    } else {
        $('.collapse-btn').removeClass('collapse-active');
        $(this).addClass('collapse-active');
        if ($(this).hasClass('people')) {
            $("#previousjobs-collapse-panel").removeClass("show");
        } else {
            $("#people-collapse-panel").removeClass("show");
        }
    }
});

$(document).on("click", ".people-job-btn", function() {
    $("#employees-view-history-panel").removeClass("panel-closed");
    $("#employees-view-history-panel").addClass("panel-show");
});


$(document).on("click", "#employees-view-history-panel .close-btn", function() {
    $("#employees-view-history-panel").removeClass("panel-show");
    $("#employees-view-history-panel").addClass("panel-closed");
})