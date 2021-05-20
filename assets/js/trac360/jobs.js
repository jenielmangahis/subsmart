$(document).on("click", ".jobs-collapse-btn", function() {
    if ($(this).hasClass('collapse-active')) {
        $(this).removeClass('collapse-active');
    } else {
        $('.jobs-collapse-btn').removeClass('collapse-active');
        $(this).addClass('collapse-active');
        if ($(this).hasClass('upcoming')) {
            $("#previousjobs-collapse-panel").removeClass("show");
        } else {
            $("#upcomingjobs-collapse-panel").removeClass("show");
        }
    }
});