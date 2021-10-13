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
            income_per_day = data.income_per_day;
            income_per_month = data.income_per_month;
            income_per_quarter = data.income_per_quarter;
            last_income_per_day = data.last_income_per_day;
            last_income_per_month = data.last_income_per_month;
            last_income_per_quarter = data.last_income_per_quarter;
            console.log(graph_data);
        },
    });
});

$(document).on("click", ".overview-widget.shortcuts .img-button-links .recurring-sales-receipt", function(event) {
    $("#addsalesreceiptModal .modal-footer-check .middle-links.end a").trigger("click");
});

function sortKeys(obj_1) {
    var key = Object.keys(obj_1)
        .sort(function order(key1, key2) {
            if (key1 < key2) return -1;
            else if (key1 > key2) return +1;
            else return 0;
        });

    // Taking the object in 'temp' object
    // and deleting the original object.
    var temp = {};

    for (var i = 0; i < key.length; i++) {
        temp[key[i]] = obj_1[key[i]];
        delete obj_1[key[i]];
    }

    // Copying the object from 'temp' to 
    // 'original object'.
    for (var i = 0; i < key.length; i++) {
        obj_1[key[i]] = temp[key[i]];
    }
    return obj_1;
}

function graph_data_setter(data, for_data) {
    var x_y = {};
    var graph_data_temp = [];
    data = sortKeys(data);
    console.log(data);
    $.each(data, function(key, value) {
        console.log(key + ": " + value);
        x_y.x = parseInt(key);
        x_y.y = value;
        graph_data_temp.push(x_y);
        x_y = {};
    });

    if (for_data == "current") {
        graph_data = graph_data_temp;
    } else {
        graph_data_prev = graph_data_temp;
    }
}

//income over time chart

$(document).on("change", ".overview-widget.income-overtime .filter-section input#compare-prev-year", function(event) {
    var graph_data_temp;
    if ($(this).is(':checked')) {
        graph_data_setter(income_per_day, "current");
        graph_data_setter(last_income_per_day, "previous");
        graph_data_temp = [{
            type: "line",
            showInLegend: true,
            name: "Oct 2021",
            color: "#00A402",
            dataPoints: graph_data
        }, {
            type: "line",
            lineDashType: "dash",
            markerType: "triangle",
            showInLegend: true,
            name: "Oct 2020",
            color: "#8D9096",
            dataPoints: graph_data_prev
        }]
    } else {
        graph_data_temp = [{
            type: "line",
            showInLegend: true,
            name: "Oct 2021",
            color: "#00A402",
            interval: 1,
            dataPoints: graph_data
        }]
    }
    console.log(graph_data_temp);
    chart = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: ""
        },
        toolTip: {
            shared: true
        },
        axisX: {
            interval: 1,
            valueFormatString: "#0",
            minimum: 1,
        },
        legend: {
            verticalAlign: "bottom",
            horizontalAlign: "center",
            dockInsidePlotArea: false
        },
        data: graph_data_temp
    });
    chart.render();
    console.log(typeof graph_data);
});

function toogleDataSeries(e) {
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else {
        e.dataSeries.visible = true;
    }
    chart.render();
}