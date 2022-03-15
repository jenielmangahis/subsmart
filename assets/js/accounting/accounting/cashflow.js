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
var p_type = "0"
    //productivity
$(document).on("click", "#toggle_switch", function(event) {

    if ($("input[name=toggle_switch]").is(":checked")) {
        p_type = "1";
        $("#sched").val('daily');
        $("#container_hide").fadeIn();
        $(".daily_hide").fadeIn();
    } else {
        p_type = "0";
        $("#sched").val('daily');
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

        $('.num_weeks').val("")
        var months = "";
        var day = ""
        var weeks = "";
        var mon = "";
        var tue = "";
        var wed = "";
        var thur = "";
        var fri = "";
        var sat = "";
        var sun = "Sunday";
        var html2 = "";

        $('.finding').html(html2);

        $(document).on("click", "#sun", function(event) {
            if ($('#sun').hasClass('color')) {
                $('#sun').removeClass('color');
                sun = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);

            } else {
                $('#sun').toggleClass('color');
                sun = "SUNDAY";
                if (weeks == "") {
                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });
        $(document).on("click", "#mon", function(event) {
            if ($('#mon').hasClass('color')) {
                $('#mon').removeClass('color');
                mon = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#mon').toggleClass('color');
                mon = ", MONDAY";
                if (weeks == "") {

                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });
        $(document).on("click", "#tue", function(event) {
            if ($('#tue').hasClass('color')) {
                $('#tue').removeClass('color');
                tue = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#tue').toggleClass('color');
                tue = ", TUESDAY";
                if (weeks == "") {
                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });
        $(document).on("click", "#wed", function(event) {
            if ($('#wed').hasClass('color')) {
                $('#wed').removeClass('color');
                wed = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#wed').toggleClass('color');
                wed = ", WEDNESDAY";
                if (weeks == "") {
                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });
        $(document).on("click", "#thu", function(event) {
            if ($('#thu').hasClass('color')) {
                $('#thu').removeClass('color');
                thur = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#thu').toggleClass('color');
                thur = ", THURSDAY";
                if (weeks == "") {
                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });
        $(document).on("click", "#fri", function(event) {
            if ($('#fri').hasClass('color')) {
                $('#fri').removeClass('color');
                fri = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#fri').toggleClass('color');
                fri = ", FRIDAY";
                if (weeks == "") {
                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });
        $(document).on("click", "#sat", function(event) {
            if ($('#sat').hasClass('color')) {
                $('#sat').removeClass('color');
                sat = "";
                var html2 = "";
                var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                $('.finding').html(html2);
            } else {
                $('#sat').toggleClass('color');
                sat = ", SATURDAY";
                if (weeks == "") {
                    var html2 = "";
                    var html2 = "Please enter a week";
                    $('.finding').html(html2);
                } else {
                    if (mon != "" || tue != "" || wed != "" || thur != "" || fri != "" || sat != "" || sun != "") {
                        var html2 = "";
                        var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
                        $('.finding').html(html2);
                    } else {
                        var html2 = "";
                        var html2 = "Please choose a day";
                        $('.finding').html(html2);
                    }
                }
            }
        });

        $(document).on("input", ".num_weeks", function() {


            weeks = $('.num_weeks').val() + "";
            var html2 = "Repeats every " + weeks + " on " + sun + mon + tue + wed + thur + fri + sat;
            $('.finding').html(html2);
        })

    } else if ($("#sched").val() == "monthly") {
        $(".daily_hide").hide();
        $(".weekly_hide").hide();
        $(".monthly_hide").fadeIn();
        $('#day_num').val("1");
        $('.num_months').val("1");
        day = $('#day_num').val();
        months = $('.num_months').val();

        if (months == "1") {
            var html2 = "Repeats on day " + day + " of every month";
            $('.finding').html(html2);
        } else {
            var html2 = "Repeats on day " + day + " of every " + months + " months";
            $('.finding').html(html2);
        }


        $(document).on("input", ".num_months", function() {
            months = $('.num_months').val();
            if (months == "1") {
                var html2 = "Repeats on day " + day + " of every month";
                $('.finding').html(html2);
            } else {
                var html2 = "Repeats on day " + day + " of every " + months + " months";
                $('.finding').html(html2);
            }


        });

        $(document).on("change", ".rClass", function() {


            var html2 = "Repeats on day " + day + " of every " + months + " month";
            var determine = $('input[name=day_sched]:checked').val();
            if (determine == "day") {
                if (months == "1") {
                    var html2 = "Repeats on day " + day + " of every month";
                    $('.finding').html(html2);
                } else {
                    var html2 = "Repeats on day " + day + " of every " + months + " months";
                    $('.finding').html(html2);
                }

                console.log(determine);
                if (months != "") {
                    $(document).on("input", "#day_num", function() {
                        if ($('#day_num').val() != "") {
                            day = $('#day_num').val();
                            if (months == "1") {
                                var html2 = "Repeats on day " + day + " of every month";
                                $('.finding').html(html2);
                            } else {
                                var html2 = "Repeats on day " + day + " of every " + months + " months";
                                $('.finding').html(html2);
                            }
                        } else {
                            var html2 = "input a day";
                            $('.finding').html(html2);
                        }
                    })
                } else {
                    var html2 = "input a month";
                    $('.finding').html(html2);

                }
                $("select[name='day_place']").attr("disabled", true);
                $("select[name='day_want']").attr("disabled", true);
                $("input[name='day_num']").removeAttr("disabled");
            } else {
                $("select[name='day_place']").removeAttr("disabled");
                $("select[name='day_want']").removeAttr("disabled");
                $("input[name='day_num']").attr("disabled", true);
                console.log(determine);
                var rank = $("#day_place").val();
                var want = $("#day_want").val();

                if (months == "1") {
                    var html2 = "Repeats on the " + rank + " " + want + " of every month";
                    $('.finding').html(html2);
                } else {
                    var html2 = "Repeats on the " + rank + " " + want + " of every " + months + " months";
                    $('.finding').html(html2);
                }
                $(document).on("change", "#day_place", function() {
                    var rank = $('#day_place').val();
                    if (months == "1") {
                        var html2 = "Repeats on the " + rank + " " + want + " of every month";
                        $('.finding').html(html2);
                    } else {
                        var html2 = "Repeats on the " + rank + " " + want + " of every " + months + " months";
                        $('.finding').html(html2);
                    }
                    $(document).on("change", "#day_want", function() {
                        var want = $('#day_want').val();
                        if (months == "1") {
                            var html2 = "Repeats on the " + rank + " " + want + " of every month.";
                            $('.finding').html(html2);
                        } else {
                            var html2 = "Repeats on the " + rank + " " + want + " of every " + months + " months";
                            $('.finding').html(html2);
                        }

                    })

                })
            }
        });

    }
});
$(document).on("change", ".Dend", function(event) {
    if ($("input[name=Dend]:checked").val() == 'does_not_end') {
        $("#end_date").attr('disabled', true);
        $("#not").attr('disabled', true);
    } else if ($("input[name=Dend]:checked").val() == 'date') {
        $("#end_date").removeAttr('disabled');
        $("#not").attr('disabled', true);
    } else if ($("input[name=Dend]:checked").val() == 'not') {
        $("#not").removeAttr('disabled');
        $("#end_date").attr('disabled', true);
    }

})
$(document).on("change", ".Wend", function(event) {
    if ($("input[name=Wend]:checked").val() == 'does_not_end') {
        $(".end_date").attr('disabled', true);
        $(".not").attr('disabled', true);
    } else if ($("input[name=Wend]:checked").val() == 'date') {
        $(".end_date").removeAttr('disabled');
        $(".not").attr('disabled', true);
    } else if ($("input[name=Wend]:checked").val() == 'not') {
        $(".not").removeAttr('disabled');
        $(".end_date").attr('disabled', true);
    }

})
$(document).on("change", ".Mend", function(event) {
    if ($("input[name=Mend]:checked").val() == 'does_not_end') {
        $(".close_end").attr('disabled', true);
        $(".close_not").attr('disabled', true);
    } else if ($("input[name=Mend]:checked").val() == 'date') {
        $(".close_end").removeAttr('disabled');
        $(".close_not").attr('disabled', true);
    } else if ($("input[name=Mend]:checked").val() == 'not') {
        $(".close_not").removeAttr('disabled');
        $(".close_end").attr('disabled', true);
    }

})



$(document).on('click', ".bton", function() {
    var name = $('.merchant_name').val();
    var amt = $('.plan_amount').val();
    var addDate = $('.addDate').val();
    var plan = $('input[name=plan_type]').val();
    var d_sched = "";
    var w_weeks = "";
    var w_days = "";
    var m_months = "";
    var m_day = "";
    var sc_day = "";
    var sc_rank = "";
    if (p_type == "1") {
        if ($("#sched").val() == "daily") {
            if ($("input[name=toggle_switch1]").is(":checked")) {
                d_sched = "everyday";
            } else {
                d_sched = "weekdays";
            }
        } else if ($("#sched").val() == "weekly") {
            w_weeks = $('.num_weeks').val();
            if ($("#sun").hasClass('color')) {
                w_days += "s";
            }
            if ($("#mon").hasClass('color')) {
                w_days += "m";
            }
            if ($("#tue").hasClass('color')) {
                w_days += "t";
            }
            if ($("#wed").hasClass('color')) {
                w_days += "w";
            }
            if ($("#thur").hasClass('color')) {
                w_days += "th";
            }
            if ($("#fri").hasClass('color')) {
                w_days += "f";
            }
            if ($("#sat").hasClass('color')) {
                w_days += "sa";
            }
        } else if ($("#sched").val() == "monthly") {
            m_months = $('.num_months').val();
            if ($('input[name=day_sched]:checked').val() == "day") {
                m_day = $('#day_num').val();

            } else {
                sc_day = $('#day_place').val();
                sc_rank = $("#day_want").val();
            }
        }
    }

    console.log(d_sched, w_weeks, w_days, m_months, m_day, sc_day, sc_rank);

    // $.ajax({
    //     url: baseURL + "accounting/savecashflowplan",
    //     type: "POST",
    //     dataType: "json",
    //     data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: plan },
    //     success: function(data) {

    //     }
    // });
})