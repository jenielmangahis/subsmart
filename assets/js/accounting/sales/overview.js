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
    var selected_duration = $(this).find(":selected").text();
    $.ajax({
        url: baseURL + "/sales-overview/income-overtime",
        type: "POST",
        dataType: "json",
        data: { duration: selected_duration },
        success: function(data) {
            $(".overview-widget.income-overtime .content-monitary-highlight span.amount").html(data.formatted_current_income);
            $(".overview-widget.income-overtime .content-monitary-highlight span.label").html(selected_duration);
            if (data.current_income >= data.last_income) {
                $(".overview-widget.income-overtime .monitary-increase").removeClass("decreased");
                $(".overview-widget.income-overtime .monitary-increase").html("$" + data.increased_decreased_label + " more than " + data.more_than_prev_month_label);
            } else {
                $(".overview-widget.income-overtime .monitary-increase").addClass("decreased");
                $(".overview-widget.income-overtime .monitary-increase").html("$" + data.increased_decreased_label + " less than " + data.more_than_prev_month_label);
            }
            var income_per_day = data.income_per_day;
            $.each(income_per_day, function(key, value) {
                // console.log(key + ": " + value);
            });
        },
    });
});

$(document).on("click", ".overview-widget.shortcuts .img-button-links .recurring-sales-receipt", function(event) {
    $("#addsalesreceiptModal .modal-footer-check .middle-links.end a").trigger("click");
});