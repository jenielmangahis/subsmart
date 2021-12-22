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



function income_overtime_duration_changed() {
    var selected_duration = $(".overview-widget.income-overtime .filter-section select.duration").find(":selected").text();
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

            // income_per_day = data.income_per_day;
            // income_per_month = data.income_per_month;
            // income_per_quarter = data.income_per_quarter;
            // last_income_per_day = data.last_income_per_day;
            // last_income_per_month = data.last_income_per_month;
            // last_income_per_quarter = data.last_income_per_quarter;
            // income_label = data.income_label;
            // last_income_label = data.last_income_label;
            // income_month_label = data.income_month_label;
            // income_year_label = data.income_year_label;
            // income_overtime_graph_setter();
            // console.log(income_per_month);
        },
    });
}

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
    var selected_duration = $(".overview-widget.income-overtime .filter-section select.duration").find(":selected").text();
    var x_y = {};
    var graph_data_temp = [];
    data = sortKeys(data);
    $.each(data, function(key, value) {
        if (selected_duration == "This month" || selected_duration == "Last month") {
            x_y.x = new Date(parseInt(income_year_label), parseInt(income_month_label) - 1, parseInt(key) - 10);
        } else if (selected_duration == "This quarter" || selected_duration == "Last quarter" || selected_duration == "This year by month" || selected_duration == "Last year by month") {
            x_y.x = new Date(parseInt(income_year_label), parseInt(key) - 11, 1);
        } else if (selected_duration == "This year by quarter" || selected_duration == "Last year by quarter") {
            x_y.x = parseInt(key);
        }
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



function income_overtime_graph_setter() {
    var widget_height = $(".overview-widget.income-overtime").height();
    $(".overview-widget.income-overtime").height(widget_height);
    $(".overview-widget.income-overtime .widget-elements").hide();
    $(".overview-widget .widget-loader ").show();


    var graph_data_temp;
    var selected_duration = $(".overview-widget.income-overtime .filter-section select.duration").find(":selected").text();
    var valueFormatString_for_X = "DD MMM";
    var axisX_for_chart = {
        valueFormatString: valueFormatString_for_X,
        crosshair: {
            enabled: true,
            snapToDataPoint: true
        },
        interval: 1
    };
    if (selected_duration == "This month" || selected_duration == "Last month") {
        graph_data_setter(income_per_day, "current");
        graph_data_setter(last_income_per_day, "previous");
    } else if (selected_duration == "This quarter" || selected_duration == "Last quarter" || selected_duration == "This year by month" || selected_duration == "Last year by month") {
        graph_data_setter(income_per_month, "current");
        graph_data_setter(last_income_per_month, "previous");
        valueFormatString_for_X = "MMM";
        axisX_for_chart = {
            valueFormatString: valueFormatString_for_X,
            crosshair: {
                enabled: true,
                snapToDataPoint: true
            },
            interval: 1,
            intervalType: "month",
        };
    } else if (selected_duration == "This year by quarter" || selected_duration == "Last year by quarter") {
        graph_data_setter(income_per_quarter, "current");
        graph_data_setter(last_income_per_quarter, "previous");
        valueFormatString_for_X = "Q#";
        axisX_for_chart = {
            valueFormatString: valueFormatString_for_X,
            crosshair: {
                enabled: true,
                snapToDataPoint: true
            },
            interval: 1,
            minimum: 1,
            maximum: 4,
        };
    }
    if ($(".overview-widget.income-overtime .filter-section input#compare-prev-year").is(':checked')) {
        graph_data_temp = [{
            type: "line",
            showInLegend: true,
            name: income_label,
            color: "#00A402",
            xValueFormatString: valueFormatString_for_X,
            dataPoints: graph_data
        }, {
            type: "line",
            lineDashType: "dash",
            markerType: "triangle",
            showInLegend: true,
            name: last_income_label,
            color: "#8D9096",
            xValueFormatString: valueFormatString_for_X,
            dataPoints: graph_data_prev
        }, ];
    } else {
        graph_data_temp = [{
            type: "line",
            showInLegend: true,
            name: income_label,
            color: "#00A402",
            xValueFormatString: valueFormatString_for_X,
            interval: 1,
            dataPoints: graph_data
        }];
    }
    chart = new CanvasJS.Chart("chartContainer1", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: ""
        },
        toolTip: {
            shared: true
        },
        axisX: axisX_for_chart,
        axisY: {
            title: "",
            includeZero: true,
            crosshair: {
                enabled: true
            },
            valueFormatString: "$#,##0.##"
        },
        legend: {
            verticalAlign: "bottom",
            horizontalAlign: "center",
            dockInsidePlotArea: false
        },
        data: graph_data_temp
    });

    $(".overview-widget.income-overtime .widget-elements").show();
    $(".overview-widget .widget-loader").hide();
    $(".overview-widget.income-overtime").removeAttr("style");
    if (graph_data.length > 0) {
        $(".overview-widget.income-overtime .no-graph").hide();
        $(".overview-widget.income-overtime #chartContainer1").show();
        chart.render();
    } else {
        $(".overview-widget.income-overtime #chartContainer1").hide();
        $(".overview-widget.income-overtime .no-graph").show();
    }
}

function toogleDataSeries(e) {
    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
        e.dataSeries.visible = false;
    } else {
        e.dataSeries.visible = true;
    }
    chart.render();
}
$(document).on("change", ".overview-widget.income-overtime .filter-section input#compare-prev-year", function(event) {
    if ($(this).is(":checked")) {
        display_prev_year(overview_chart);
    } else {
        not_display_prev_year(overview_chart);
    }
});
$(document).on("change", ".overview-widget.income-overtime .filter-section select.duration", function(event) {
    income_overtime_duration_changed();
});

over_view_chart_start();
var overview_chart_elem;
var overview_chart;

function over_view_chart_start() {
    overview_chart_elem = document.getElementById('overview_chart').getContext('2d');
    const cfg = {
        type: "line",
        data: {
            labels: null,
            datasets: [{
                label: "",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 1)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: false,
                radius: 3,
                borderWidth: 2,
            }],
        },
        options: {
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            plugins: {
                decimation: {
                    enabled: false,
                    algorithm: 'min-max',
                },
                legend: {
                    display: true,
                    position: "bottom"
                }
            },
            scales: {
                x: {
                    display: true
                },
                y: {
                    min: 0,
                    ticks: {
                        callback: function(value, index, values) {
                            return "$" + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        },

                    }
                }
            }
        },
    };
    overview_chart = new Chart(overview_chart_elem, cfg);
}

function addData_overview_chart(chart, label, data, data_set_labels) {
    chart.data.labels = label;
    var ctr = 0;
    chart.data.datasets.forEach((dataset) => {
        dataset.data = data[ctr];
        dataset.label = data_set_labels[ctr];
        ctr++;
    });
    chart.update();
}

function removeData_overview_chart(chart) {
    chart.data.labels.pop();
    chart.data.datasets.forEach((dataset) => {
        dataset.data = [];
    });
    chart.update();
}

function not_display_prev_year(chart) {
    if (chart.data.datasets.length > 1) {
        chart.data.datasets.pop();
        chart.update();
    }
}
var prev_year_data;
var prev_year_label;
var this_year_label;

function display_prev_year(chart) {

    if (chart.data.datasets.length == 1) {
        var new_dataset = {
            label: prev_year_label,
            data: prev_year_data,
            backgroundColor: ['rgba(142, 145, 151, 1)'],
            borderColor: ['rgba(142, 145, 151, 1)'],
            fill: false,
            radius: 3,
            borderWidth: 2,
        };
        chart.data.datasets.push(new_dataset);
        chart.update();
    }
}

function income_overtime_duration_changed() {
    var selected_duration = $(".overview-widget.income-overtime .filter-section select.duration").find(":selected").text();
    if (selected_duration == "Last year by month" || selected_duration == "Last year by quarter") {
        $(".overview-widget .filter-section .compare-prev-year").hide();
        $(".overview-widget.income-overtime .filter-section input#compare-prev-year").prop('checked', false);
    } else {
        $(".overview-widget .filter-section .compare-prev-year").show();
    }
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
            prev_year_data = data.last_year_data;
            prev_year_label = data.prev_year_label;
            this_year_label = data.this_year_label;
            removeData_overview_chart(overview_chart);
            if ($(".overview-widget.income-overtime .filter-section input#compare-prev-year").is(":checked")) {
                display_prev_year(overview_chart);
                addData_overview_chart(overview_chart, data.labels, [data.current_data, data.last_year_data], [this_year_label, prev_year_label]);
            } else {
                not_display_prev_year(overview_chart);
                addData_overview_chart(overview_chart, data.labels, [data.current_data, null], [this_year_label, prev_year_label]);
            }

            // income_per_day = data.income_per_day;
            // income_per_month = data.income_per_month;
            // income_per_quarter = data.income_per_quarter;
            // last_income_per_day = data.last_income_per_day;
            // last_income_per_month = data.last_income_per_month;
            // last_income_per_quarter = data.last_income_per_quarter;
            // income_label = data.income_label;
            // last_income_label = data.last_income_label;
            // income_month_label = data.income_month_label;
            // income_year_label = data.income_year_label;
            // income_overtime_graph_setter();
            // console.log(income_per_month);
        },
    });
}