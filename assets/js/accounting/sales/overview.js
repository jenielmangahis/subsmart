$(document).on("click", ".overview-widget .filter-section .compare-prev-year .main-label", function(event) {
    $(this).parent("div").children(".form-group").children(".custom-control").children("input").trigger('click');
});
$(".overview-widget .widget-with-counter").hover(function() {
        $(".overview-widget .widget-with-counter").removeClass("focused");
        $(this).addClass("focused");
        $(".overview-widget .widget-with-counter.focused .counter").removeClass("no-before");
        setTimeout(function() {
            $(".overview-widget .widget-with-counter.focused .counter").addClass("no-before");
        }, 400);

    },
    function() {
        $(this).addClass("focused");
    }
);

$(document).on("change", ".overview-widget.income-overtime .filter-section select.duration", function(event) {
    $.ajax({
        url: baseURL + "/sales-overview/income-overtime",
        type: "POST",
        dataType: "json",
        data: { duration: $(this).find(":selected").text() },
        success: function(data) {
            console.log(data);
        },
    });
});