$(document).on("click", ".section-above-chart .cashflowchart-tab-btns button", function(event) {
    event.preventDefault();
    $(".section-above-chart .cashflowchart-tab-btns button.active").removeClass("active");
    $(this).addClass("active");
    if ($(".section-above-chart .cashflowchart-tab-btns button.money_in_out.active").length > 0) {
        $(".money_in_out_chart_section").show();
        $(".cash_balance_chart_section").hide();
        if (!money_in_out_chart) {
            start_money_in_out_chart();
        } else {
            update_money_in_out_chart();
        }

    } else {
        $(".cash_balance_chart_section").show();
        $(".money_in_out_chart_section").hide();
    }
});

function addData_chashflow_chart(chart, label, data) {
    chart.data.labels = label;
    var ctr = 0;
    chart.data.datasets.forEach((dataset) => {
        dataset.data = data[ctr];
        ctr++;
    });
    chart.update();
}

function removeData_chashflow_chart(chart) {
    chart.data.labels.pop();
    chart.data.datasets.forEach((dataset) => {
        dataset.data = [];
    });
    chart.update();
}

$(document).on("change", ".cash-flow-filter select[name='chart-month-range']", function(event) {
    update_cashflow_chart();
    if (money_in_out_chart) {
        update_money_in_out_chart();
    }

});


function update_cashflow_chart() {
    var date_range = $(".cash-flow-filter select[name='chart-month-range']").val();
    $.ajax({
        url: baseURL + "cahsflow/chash-balance/chart/updated",
        type: "POST",
        dataType: "json",
        data: {
            date_range: date_range
        },
        success: function(data) {
            removeData_chashflow_chart(cash_balance_chart);
            $(".cash-flow-section .chart-x-label ul.months").html(data.bottom_x_labels);
            $(".cash-flow-section .chart-x-label ul.months").attr("class", "months months-" + date_range);
            addData_chashflow_chart(cash_balance_chart, data.data_labels, [data.data_values, data.data_values_money_in, data.data_values_money_out, data.data_projected]);
        },
    });
}


start_cashflow_chart();
var cash_balance_chart;
var cashflow_chart = document.getElementById('cash_balance_chart').getContext('2d');

function start_cashflow_chart() {
    cashflow_chart = document.getElementById('cash_balance_chart').getContext('2d');
    const cfg = {
        type: "line",
        data: {
            labels: null,
            datasets: [{
                label: "Cash balance",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 0.4)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 0,
                borderWidth: 2,
            }, {
                label: "Money in",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 0.4)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: false,
                radius: 0,
                borderWidth: 0,
            }, {
                label: "Money out",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 0.4)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: false,
                radius: 0,
                borderWidth: 0,
            }, {
                label: "Projected",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 0.2)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 0,
                borderDash: [2],
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
                    display: false
                }
            },
            scales: {
                x: {
                    display: false
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
    cash_balance_chart = new Chart(cashflow_chart, cfg);
    update_cashflow_chart();
}

var money_in_out_chart;


function update_money_in_out_chart() {
    var date_range = $(".cash-flow-filter select[name='chart-month-range']").val();
    $.ajax({
        url: baseURL + "cahsflow/money-in-out/chart/updated",
        type: "POST",
        dataType: "json",
        data: {
            date_range: date_range
        },
        success: function(data) {
            removeData_chashflow_chart(money_in_out_chart);
            addData_chashflow_chart(money_in_out_chart, data.data_labels, [data.data_values_money_in, data.data_projected_money_in, data.data_values_money_out, data.data_projected_money_out]);
        },
    });
}

function start_money_in_out_chart() {
    cashflow_chart = document.getElementById('cash_in_out_chart').getContext('2d');
    const cfg = {
        type: "bar",
        data: {
            labels: null,
            datasets: [{
                label: "Money in",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 1)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 2,
                borderWidth: 2,
                stack: "money_in"
            }, {
                label: "Projected",
                data: null,
                backgroundColor: ['rgba(82, 183, 2, 0.2)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 2,
                borderDash: [2],
                borderWidth: 2,
                stack: "money_in"
            }, {
                label: "Money out",
                data: null,
                backgroundColor: ['rgba(6, 164, 181, 1)'],
                borderColor: ['rgba(6, 164, 181, 1)'],
                fill: true,
                radius: 2,
                borderWidth: 2,
                stack: "money_out"
            }, {
                label: "Projected",
                data: null,
                backgroundColor: ['rgba(6, 164, 181, 0.2)'],
                borderColor: ['rgba(6, 164, 181, 1)'],
                fill: true,
                radius: 2,
                borderDash: [2],
                borderWidth: 2,
                stack: "money_out"
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
                    display: false
                }
            },
            scales: {
                x: {
                    // display: false,
                    stacked: true,
                },
                y: {
                    min: 0,
                    stacked: true,
                    ticks: {
                        callback: function(value, index, values) {
                            return "$" + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        },
                    }
                }
            }
        },
    };
    money_in_out_chart = new Chart(cashflow_chart, cfg);
    update_money_in_out_chart();
}

$(document).on("click", ".tab .tablinks", function(event) {
    event.preventDefault();
    $(".tab .tablinks.active").removeClass("active");
    $(this).addClass("active");

    $(".tabcontent.all").hide();
    $(".tabcontent.money_in").hide();
    $(".tabcontent.money_out").hide();
    if ($(this).hasClass("all")) {
        $(".tabcontent.all").fadeIn();
    } else if ($(this).hasClass("money_in")) {
        $(".tabcontent.money_in").fadeIn();
    } else if ($(this).hasClass("money_out")) {
        $(".tabcontent.money_out").fadeIn();
    }
});
$(document).on("click", "button.cfp_add_item", function(event) {
    event.preventDefault();
    $("#cfp_add_item_area").fadeIn();
});
$(document).on("click", "#cfp_add_item_area .close_add_item", function(event) {
    event.preventDefault();
    $("#cfp_add_item_area").fadeOut();
});

//productivity
$(document).on("click", "#toggle_switch", function(event) {

    if ($("input[name=toggle_switch]").is(":checked")) {
        $("#container_hide").fadeIn();
        $(".daily_hide").fadeIn();
    } else {
        $("#container_hide").fadeOut();
        $(".daily_hide").fadeOut();
        $(".weekly_hide").fadeOut();
        $(".monthly_hide").fadeOut();
    }
});
var html = "";


$(document).on("click", "#toggle_switch1", function(event) {

    if ($("input[name=toggle_switch1]").is(":checked")) {
        html = "Repeats every day";
        $('.finding').html(html);
    } else if ($("input[name=toggle_switch1]").not(":checked")) {
        html = "Repeats every weekdays";
        $('.finding').html(html);
    }
});


$(document).on("change", "#sched", function(event) {
    if ($("#sched").val() == "daily") {
        $(".daily_hide").fadeIn();
        $(".weekly_hide").hide();
        $(".monthly_hide").hide();
    } else if ($("#sched").val() == "weekly") {
        $(".daily_hide").hide();
        $(".weekly_hide").fadeIn();
        $(".monthly_hide").hide();

        $('.num_weeks').val("1")
        var weeks = "week";
        var mon = "";
        var tue = "";
        var wed = "";
        var thur = "";
        var fri = "";
        var sat = "";
        var sun = "Sunday";
        var html2 = "Repeats every " + weeks + " on " + sun;

        $('.finding').html(html2);

        $(document).on("click", "#sun", function(event) {
            if ($('#sun').hasClass('color')) {
                $('#sun').removeClass('color');
                sun = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#sun').toggleClass('color');
                sun = "SUNDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });
        $(document).on("click", "#mon", function(event) {
            if ($('#mon').hasClass('color')) {
                $('#mon').removeClass('color');
                mon = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#mon').toggleClass('color');
                mon = ", MONDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });
        $(document).on("click", "#tue", function(event) {
            if ($('#tue').hasClass('color')) {
                $('#tue').removeClass('color');
                tue = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#tue').toggleClass('color');
                tue = ", TUESDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });
        $(document).on("click", "#wed", function(event) {
            if ($('#wed').hasClass('color')) {
                $('#wed').removeClass('color');
                wed = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#wed').toggleClass('color');
                wed = ", WEDNESDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });
        $(document).on("click", "#thu", function(event) {
            if ($('#thu').hasClass('color')) {
                $('#thu').removeClass('color');
                thur = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#thu').toggleClass('color');
                thur = ", THURSDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });
        $(document).on("click", "#fri", function(event) {
            if ($('#fri').hasClass('color')) {
                $('#fri').removeClass('color');
                fri = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#fri').toggleClass('color');
                fri = ", FRIDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });
        $(document).on("click", "#sat", function(event) {
            if ($('#sat').hasClass('color')) {
                $('#sat').removeClass('color');
                sat = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#sat').toggleClass('color');
                sat = ", SATURDAY";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            }
        });

        $(document).on("input", ".num_weeks", function() {

            weeks = $('.num_weeks').val() + " weeks ";
            var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
            $('.finding').html(html2);
        })

    } else if ($("#sched").val() == "monthly") {
        $(".daily_hide").hide();
        $(".weekly_hide").hide();
        $(".monthly_hide").fadeIn();
    }
});