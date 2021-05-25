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