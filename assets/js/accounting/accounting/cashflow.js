jQuery(document).ready(function() {
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



    $(document).on('click', "#cfp_add_item_area .bton", function() {
        var name = $('.merchant_name').val();
        var amt = $('.plan_amount').val();
        var addDate = $('.addDate').val();
        var plan = $('input[name=plan_type]:checked').val();
        var d_sched = "";
        var w_weeks = "";
        var w_days = "";
        var m_months = "";
        var m_day = "";
        var sc_day = "";
        var sc_rank = "";
        var d_dne = "";
        var d_date = "";
        var d_not = "";
        var w_dne = "";
        var w_date = "";
        var w_not = "";
        var m_dne = "";
        var m_date = "";
        var m_not = "";
        var indic = $("#sched option:selected").val();

        if (name == "" || amt == "" || addDate == "" || plan == "") {

            alert("input all fields");
        } else {
            if (p_type == "1") {
                if ($("#sched option:selected").val() == "daily") {
                    console.log($("#sched option:selected").val());
                    if ($("input[name=toggle_switch1]").is(":checked")) {
                        d_sched = "everyday";

                    } else {
                        d_sched = "weekdays";

                    }
                    if ($("#cfp_add_item_area input[name='Dend']:checked").val() == "date") {
                        d_date = $("#cfp_add_item_area input[name='end_date']").val();
                        d_dne = $("#cfp_add_item_area input[name='Dend']:checked").val();;
                    } else if ($("#cfp_add_item_area input[name='Dend']:checked").val() == "not") {
                        d_not = $("#cfp_add_item_area input[name='number_of_times']").val();
                        d_dne = $("#cfp_add_item_area input[name='Dend']:checked").val();;
                    } else {
                        d_dne = $("#cfp_add_item_area input[name='Dend']:checked").val();
                    }

                    if (d_dne == "date") {
                        if (d_date == "") {
                            alert("input date");
                            console.log("yawa");
                        } else {
                            $.ajax({
                                url: baseURL + "accounting/savecashflowplan",
                                type: "POST",
                                dataType: "json",
                                data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, d_sched: d_sched, d_dne: d_dne, d_date: d_date, d_not: d_not, indic: indic },
                                success: function(data) {
                                    console.log("success");
                                    location.reload();
                                    $('#cfp_add_item_area').fadeOut();
                                }
                            });
                        }
                    } else if (d_dne == "not") {
                        if (d_not == "") {
                            alert("fill in the occurence input");
                        } else {
                            $.ajax({
                                url: baseURL + "accounting/savecashflowplan",
                                type: "POST",
                                dataType: "json",
                                data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, d_sched: d_sched, d_dne: d_dne, d_date: d_date, d_not: d_not, indic: indic },
                                success: function(data) {
                                    console.log("success");
                                    location.reload();
                                    $('#cfp_add_item_area').fadeOut();
                                }
                            });
                        }
                    } else {
                        $.ajax({
                            url: baseURL + "accounting/savecashflowplan",
                            type: "POST",
                            dataType: "json",
                            data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, d_sched: d_sched, d_dne: d_dne, d_date: d_date, d_not: d_not, indic: indic },
                            success: function(data) {
                                console.log("success");
                                location.reload();
                                $('#cfp_add_item_area').fadeOut();
                            }
                        });
                    }


                } else if ($("#sched option:selected").val() == "weekly") {
                    console.log($("#sched option:selected").val());
                    w_weeks = $('.num_weeks').val();
                    if ($("#sun").hasClass('color')) {
                        w_days += "sunday";
                    }
                    if ($("#mon").hasClass('color')) {
                        w_days += ",monday";
                    }
                    if ($("#tue").hasClass('color')) {
                        w_days += ",tuesday";
                    }
                    if ($("#wed").hasClass('color')) {
                        w_days += "wednesday";
                    }
                    if ($("#thur").hasClass('color')) {
                        w_days += "thursday";
                    }
                    if ($("#fri").hasClass('color')) {
                        w_days += "friday";
                    }
                    if ($("#sat").hasClass('color')) {
                        w_days += "saturday";
                    }
                    if ($("#cfp_add_item_area input[name=Wend]:checked").val() == 'date') {
                        w_date = $('input[name=end_dateW]').val();
                        w_dne = $("#cfp_add_item_area input[name='Wend']:checked").val();
                    } else if ($("#cfp_add_item_area input[name=Wend]:checked").val() == 'not') {
                        w_not = $('input[name=number_of_timesW]').val();
                        w_dne = $("#cfp_add_item_area input[name='Wend']:checked").val();
                    } else {
                        w_dne = $("#cfp_add_item_area input[name='Wend']:checked").val();
                    }
                    if (w_weeks == "" || w_days == "") {
                        alert("input all fields");
                    } else {
                        $.ajax({
                            url: baseURL + "accounting/savecashflowplan",
                            type: "POST",
                            dataType: "json",
                            data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, w_dne: w_dne, w_date: w_date, w_not: w_not, w_weeks: w_weeks, w_days: w_days, indic: indic },
                            success: function(data) {
                                location.reload();
                                $('#cfp_add_item_area').fadeOut();
                            }
                        });
                    }

                } else if ($("#sched option:selected").val() == "monthly") {
                    console.log($("#sched option:selected").val());
                    m_months = $('.num_months').val();
                    if ($('input[name=day_sched]:checked').val() == "day") {
                        m_day = $('#day_num').val();
                        if ($("#cfp_add_item_area input[name=Mend]:checked").val() == 'date') {
                            m_date = $('input[name=end_dateM]').val();
                            m_dne = $("#cfp_add_item_area input[name='Mend']:checked").val();
                        } else if ($("#cfp_add_item_area input[name=Mend]:checked").val() == 'not') {
                            m_not = $('input[name=number_of_timesM]').val();
                            m_dne = $("#cfp_add_item_area input[name='Mend']:checked").val();;
                        } else {
                            m_dne = $("#cfp_add_item_area input[name='Mend']:checked").val();
                        }
                        if (m_months == "" || m_day == "") {
                            alert("input all fields");
                        } else {
                            $.ajax({
                                url: baseURL + "accounting/savecashflowplan",
                                type: "POST",
                                dataType: "json",
                                data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, sc_day: sc_day, sc_rank: sc_rank, m_dne: m_dne, m_date: m_date, m_not: m_not, m_months: m_months, m_day: m_day, indic: indic },
                                success: function(data) {
                                    location.reload();
                                    $('#cfp_add_item_area').fadeOut();
                                }
                            });
                        }

                    } else {
                        sc_day = $('#day_place option:selected').val();
                        sc_rank = $("#day_want option:selected").val();
                        if ($("#cfp_add_item_area input[name=Mend]:checked").val() == 'date') {
                            m_date = $('input[name=end_dateM]').val();
                            m_dne = $("#cfp_add_item_area input[name='Mend']:checked").val();
                        } else if ($("#cfp_add_item_area input[name=Mend]:checked").val() == 'not') {
                            m_not = $('input[name=number_of_timesM]').val();
                            m_dne = $("#cfp_add_item_area input[name='Mend']:checked").val();;
                        } else {
                            m_dne = $("#cfp_add_item_area input[name='Mend']:checked").val();
                        }
                        if (sc_day == "" || sc_rank == "") {
                            alert("input all fields");
                        } else {
                            $.ajax({
                                url: baseURL + "accounting/savecashflowplan",
                                type: "POST",
                                dataType: "json",
                                data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, sc_day: sc_day, sc_rank: sc_rank, m_dne: m_dne, m_date: m_date, m_not: m_not, m_months: m_months, m_day: m_day, indic: indic },
                                success: function(data) {
                                    location.reload();
                                    $('#cfp_add_item_area').fadeOut();
                                }
                            });
                        }
                    }

                }
            } else if (p_type == 0) {
                indic = "no_repeat";
                $.ajax({
                    url: baseURL + "accounting/savecashflowplan",
                    type: "POST",
                    dataType: "json",
                    data: { merchant_name: name, date_plan: addDate, plan_amount: amt, plan_type: plan, plan_repeat: p_type, indic: indic },
                    success: function(data) {
                        location.reload();
                        $('#cfp_add_item_area').fadeOut();
                    }
                });
            }
        }



    });
    $(document).on("click", ".filter-btn-section button.filter-btn", function(event) {
        setTimeout(function() {
            $(".filter-btn-section .filter-panel").fadeIn();
        }, 300);

    });

    $(document).on("click", ".eks", function(event) {
        setTimeout(function() {
            $(".filter-btn-section .filter-panel").fadeOut();
        }, 300);

    });

    $(document).on('click', "#cashflowtransactions #toggle_button", function() {
        var id = $(this).parents("tr").attr("data-id");
        var id1 = $(this).parents("tr").attr("id");

        console.log($(this).children(".fa-chevron-down").length);
        if ($(this).children(".fa-chevron-down").length == 0) {
            $("#cashflowtransactions tr .fa-chevron-down").attr("class", "fa fa-chevron-right");
            $("#cashflowtransactions tr.edit-panel").hide();
            $(this).children(".fa-chevron-right").attr("class", "fa fa-chevron-down");
            $("#cashflowtransactions tr.info-" + id).fadeIn();
            $("#cashflowtransactions input#date" + id).removeAttr("disabled");
            $("#cashflowtransactions input#text" + id).removeAttr("disabled");
            $("#cashflowtransactions input#date" + id).removeClass("date_type");
            $("#cashflowtransactions input#text" + id).removeClass("amnt");
            //cti
            $("#cashflowtransactions input#dates" + id).removeAttr("disabled");
            $("#cashflowtransactions input#texts" + id).removeAttr("disabled");
            $("#cashflowtransactions input#dates" + id).removeClass("date_type");
            $("#cashflowtransactions input#texts" + id).removeClass("amnt");
        } else {
            $("#cashflowtransactions tr .fa-chevron-down").attr("class", "fa fa-chevron-right");
            $("#cashflowtransactions tr.edit-panel").fadeOut();
            $("#cashflowtransactions  input#date" + id).attr("disabled", true);
            $("#cashflowtransactions  input#text" + id).attr("disabled", true);
            $("#cashflowtransactions input#date" + id).addClass("date_type");
            $("#cashflowtransactions input#text" + id).addClass("amnt");
            //cti
            $("#cashflowtransactions  input#dates" + id).attr("disabled", true);
            $("#cashflowtransactions  input#texts" + id).attr("disabled", true);
            $("#cashflowtransactions input#dates" + id).addClass("date_type");
            $("#cashflowtransactions input#texts" + id).addClass("amnt");


        }
    })
    $(document).on('click', "#cashflowmoneyin #toggle_button", function() {
        var id = $(this).parents("tr").attr("data-id");


        console.log($(this).children(".fa-chevron-down").length);
        if ($(this).children(".fa-chevron-down").length == 0) {
            $("#cashflowmoneyin tr .fa-chevron-down").attr("class", "fa fa-chevron-right");
            $("#cashflowmoneyin tr.edit-panel").hide();
            $(this).children(".fa-chevron-right").attr("class", "fa fa-chevron-down");
            $("#cashflowmoneyin tr.info-" + id).fadeIn();
            $("#cashflowmoneyin input#date" + id).removeAttr("disabled");
            $("#cashflowmoneyin input#text" + id).removeAttr("disabled");
            $("#cashflowmoneyin input#date" + id).removeClass("date_type");
            $("#cashflowmoneyin input#text" + id).removeClass("amnt");


        } else {
            $("#cashflowmoneyin tr .fa-chevron-down").attr("class", "fa fa-chevron-right");
            $("#cashflowmoneyin tr.edit-panel").fadeOut();
            $("#cashflowmoneyin  input#date" + id).attr("disabled", true);
            $("#cashflowmoneyin  input#text" + id).attr("disabled", true);
            $("#cashflowmoneyin input#date" + id).addClass("date_type");
            $("#cashflowmoneyin input#text" + id).addClass("amnt");

        }
    })
    $(document).on('click', "#cashflowmoneyout #toggle_button", function() {
        var id = $(this).parents("tr").attr("data-id");

        console.log($(this).children(".fa-chevron-down").length);
        if ($(this).children(".fa-chevron-down").length == 0) {
            $("#cashflowmoneyout tr .fa-chevron-down").attr("class", "fa fa-chevron-right");
            $("#cashflowmoneyout tr.edit-panel").hide();
            $(this).children(".fa-chevron-right").attr("class", "fa fa-chevron-down");
            $("#cashflowmoneyout tr.info-" + id).fadeIn();
            $("#cashflowmoneyout input#date" + id).removeAttr("disabled");
            $("#cashflowmoneyout input#text" + id).removeAttr("disabled");
            $("#cashflowmoneyout input#date" + id).removeClass("date_type");
            $("#cashflowmoneyout input#text" + id).removeClass("amnt");
        } else {
            $("#cashflowmoneyout tr .fa-chevron-down").attr("class", "fa fa-chevron-right");
            $("#cashflowmoneyout tr.edit-panel").fadeOut();
            $("#cashflowmoneyout  input#date" + id).attr("disabled", true);
            $("#cashflowmoneyout  input#text" + id).attr("disabled", true);
            $("#cashflowmoneyout input#date" + id).addClass("date_type");

            $("#cashflowmoneyout input#text" + id).addClass("amnt");

        }
    })
    var valdata = Array();
    load_money_in_out_table();

    function load_money_in_out_table() {
        var html = "";
        var html_moneyin = "";
        var html_moneyout = "";
        $.ajax({
            url: baseURL + "accounting/getCashFlowPlanned",
            type: "POST",
            dataType: "json",
            data: {},
            success: function(data) {

                //for planner table
                count = 0;
                for (var index = 0; index < data.arpi.length; index++) {
                    html_moneyin += `<tr class="moneyin" data-id="` + data.arpi[index]["id"] + `" id="` + index + `">
                    <td> <input class="date_type" id="dates` + data.arpi[index]["id"] + `" type="date" value="` + data.arpi[index]["date_issued"] + `" disabled></td>
                    <td>` + data.arpi[index]["customer_email"].toUpperCase() + `</td>
                    <td><input type="text" id="texts` + data.arpi[index]["id"] + `" class="amnt" value="` + data.arpi[index]["grand_total"] + `" disabled></td>
                    <td> Money In </td>
                    
                    <td></td>
                    <td class="cont_remove"></td>
                    <tr class="info-` + data.arpi[index]["id"] + ` edit-panel"  id="` + data.arpi[index]["id"] + `">
                        <td colspan="6">
                           <div class="row">
                                <div class="col-md-1.5 due_date">
                                    <div class="row">
                                        <div class="col">
                                            <h6>Due date</h6>
                                        </div>   
                                    </div>
                                    <div class="row">
                                <div class="col">`

                    html_moneyin += `<p>` + data.arpi[index]["created_at"] + `</p>`;

                    html_moneyin += `</div>
                            </div>
                                </div>
                            
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h6>Due amount</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>` + data.arpi[index]["payment_amount"] + `</p>    
                                        </div>
                                    </div>
                                </div>
    
                           </div>
                           <hr>
                           <div class="row cp_buttons">
                               <button id="cti_update">UPDATE</button>
                           </div>
                        </td>
                    </tr>`;
                }

                for (var index = 0; index < data.invoice.length; index++) {
                    html += `<tr class="moneyin" data-id="` + data.invoice[index]["id"] + `" id="` + index + `">
                    <td> <input class="date_type" id="dates` + data.invoice[index]["id"] + `" type="date" value="` + data.invoice[index]["date_issued"] + `" disabled></td>
                    <td>` + data.invoice[index]["customer_email"].toUpperCase() + `</td>
                    <td><input type="text" id="texts` + data.invoice[index]["id"] + `" class="amnt" value="` + data.invoice[index]["grand_total"] + `" disabled></td>
                    <td> Invoice </td>
                    
                    <td></td>
                    <td class="cont_remove"></td>
                    <tr class="info-` + data.invoice[index]["id"] + ` edit-panel"  id="` + data.invoice[index]["id"] + `">
                        <td colspan="6">
                           <div class="row">
                                <div class="col-md-1.5 due_date">
                                    <div class="row">
                                        <div class="col">
                                            <h6>Due date</h6>
                                        </div>   
                                    </div>
                                    <div class="row">
                                <div class="col">`

                    html += `<p>` + data.invoice[index]["date_issued"] + `</p>`;

                    html += `</div>
                            </div>
                                </div>
                            
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h6>Due amount</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>` + data.invoice[index]["grand_total"] + `</p>    
                                        </div>
                                    </div>
                                </div>
    
                           </div>
                           <hr>
                           <div class="row cp_buttons">
                               <button id="cti_update">UPDATE</button>
                           </div>
                        </td>
                    </tr>`
                }
                for (index = 0; index < data.values.length; index++) {
                    valdata[index] = data.values[index]["amount"];
                    html += `<tr class="moneyin" data-id="` + data.values[index]["id"] + `" id="` + index + `">
                    <td> <input class="date_type" id="date` + data.values[index]["id"] + `" type="date" value="` + data.values[index]["created_at"] + `" data-date="` + data.values[index]["created_at"] + `" disabled></td>
                    <td>` + data.values[index]["merchant_name"].toUpperCase() + `</td>
                    <td><input type="text" id="text` + data.values[index]["id"] + `" class="amnt" value="` + data.values[index]["amount"] + `" disabled></td>
                    <td>` + data.values[index]["description"] + `</td>
                    
                    <td><button class="btn_cashflow_table" id="toggle_button">edit <i class="fa fa-chevron-right" aria-hidden="true"></i></button></td>
                    <td class="cont_remove"> <button id="ct_remove">REMOVE</button></td>
                    <tr class="info-` + data.values[index]["id"] + ` edit-panel"  id="` + data.values[index]["id"] + `">
                        <td colspan="6">
                           <div class="row">
                                <div class="col-md-1.5 due_date">
                                    <div class="row">
                                        <div class="col">
                                            <h6>Due date</h6>
                                        </div>   
                                    </div>
                                    <div class="row">
                                <div class="col">`
                    if (data.values[index]["end_type"] == "does_not_end") {
                        html += `<p>` + data.values[index]["end_type"] + `</p>`;
                    } else if (data.values[index]["end_type"] == "date") {
                        html += `<p>` + data.values[index]["end_date"] + `</p>`;
                    } else {
                        html += `<p>` + data.values[index]["end_occurence"] + ` occurence</p>`;
                    }
                    html += `</div>
                            </div>
                                </div>
                            
                                <div class="col-3">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <h6>Due amount</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>` + data.values[index]["amount"] + `</p>    
                                        </div>
                                    </div>
                                </div>
    
                           </div>
                           <hr>
                           <div class="row cp_buttons">
                               <button id="ct_update">UPDATE</button>
                           </div>
                        </td>
                    </tr>
                    `;


                    if (data.values[index]["type"] == "moneyin") {
                        html_moneyin += `<tr class="moneyin" data-id="` + data.values[index]["id"] + `" id="` + index + `">
                        <td> <input class="date_type" id="date` + data.values[index]["id"] + `" type="date" value="` + data.values[index]["created_at"] + `" data-date"` + data.values[index]["created_at"] + `" disabled></td>
                    <td>` + data.values[index]["merchant_name"].toUpperCase() + `</td>
                    <td> <input type="text" id="text` + data.values[index]["id"] + `" class="amnt" value="` + data.values[index]["amount"] + `" disabled></td>
                    <td>` + data.values[index]["description"] + `</td>
                    <td><button class="btn_cashflow_table" id="toggle_button">edit <i class="fa fa-chevron-right" aria-hidden="true"></i></button></td>
                    <td class="cont_remove"> <button id="ct_remove">REMOVE</button></td>
                    <tr class="info-` + data.values[index]["id"] + ` edit-panel"  id="` + data.values[index]["id"] + `">
                        <td colspan="5">
                           <div class="row">
                                <div class="col-md-1.5 due_date">
                                    <div class="row">
                                        <div class="col">
                                            <h6>Due date</h6>
                                        </div>   
                                    </div>
                                    <div class="row">
                                <div class="col">`
                        if (data.values[index]["end_type"] == "does_not_end") {
                            html_moneyin += `<p>` + data.values[index]["end_type"] + `</p>`;
                        } else if (data.values[index]["end_type"] == "date") {
                            html_moneyin += `<p>` + data.values[index]["end_date"] + `</p>`;
                        } else {
                            html_moneyin += `<p>` + data.values[index]["end_occurence"] + `</p>`;
                        }
                        html_moneyin += `</div>
                            </div>
                                </div>
                            
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h6>Due amount</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>` + data.values[index]["amount"] + `</p>    
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <hr>
                           <div class="row cp_buttons">
                          <button id="cmi_update">UPDATE</button>
                           </div>
                        </td>
                    </tr>
                    `;
                    }

                    if (data.values[index]["type"] == "moneyout") {
                        count++;
                        console.log(count);
                        html_moneyout += `<tr class="moneyin" data-id="` + data.values[index]["id"] + `" id="` + index + `">
                    <td> <input class="date_type" id="date` + data.values[index]["id"] + `" type="date" value="` + data.values[index]["created_at"] + `" disabled></td>
                    <td>` + data.values[index]["merchant_name"].toUpperCase() + `</td>
                    <td><input type="text" id="text` + data.values[index]["id"] + `" class="amnt" value="` + data.values[index]["amount"] + `" disabled></td>
                    <td>` + data.values[index]["description"] + `</td>
                      <td><button class="btn_cashflow_table" id="toggle_button">edit <i class="fa fa-chevron-right" aria-hidden="true"></i></button></td>
                      <td class="cont_remove"> <button id="ct_remove">REMOVE</button></td>
                    <tr class="info-` + data.values[index]["id"] + ` edit-panel" id="` + data.values[index]["id"] + `">
                        <td colspan="5">
                           <div class="row">
                                <div class="col-md-1.5 due_date">
                                    <div class="row">
                                        <div class="col">
                                            <h6>Due date</h6>
                                        </div>   
                                    </div>
                                    <div class="row">
                                <div class="col">`
                        if (data.values[index]["end_type"] == "does_not_end") {
                            html_moneyout += `<p>` + data.values[index]["end_type"] + `</p>`;
                        } else if (data.values[index]["end_type"] == "date") {
                            html_moneyout += `<p>` + data.values[index]["end_date"] + `</p>`;
                        } else {
                            html_moneyout += `<p>` + data.values[index]["end_occurence"] + `</p>`;
                        }
                        html_moneyout += `</div>
                            </div>
                                </div>
                            
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <h6>Due amount</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p>` + data.values[index]["amount"] + `</p>    
                                        </div>
                                    </div>
                                </div>
                           </div>
                           <hr>
                           <div class="row cp_buttons">
                           <button id="cmo_update">UPDATE</button>
                           </div>
                        </td>
                    </tr>
                    `;
                    }

                }



                //for money in table







                $('#cashflowtransactions .planner_table').html(html);

                $('#cashflowmoneyin .moneyin_table').html(html_moneyin);
                $('#cashflowmoneyout .moneyout_table').html(html_moneyout);
            }
        });



    }

    $('tr.moneyin').each(function() {
        var t = this.cells[1].textContent.split('-');
        $(this).data('_ts', new Date(t[2], t[1] - 1, t[0]).getTime());
    }).sort(function(a, b) {
        return $(a).data('_ts') < $(b).data('_ts');
    }).appendTo('tbody');

    //update
    $(document).on('click', '#cashflowtransactions #ct_update', function(event) {
        var id = $(this).parents("tr").attr("id");

        var date = $("#cashflowtransactions #date" + id).val();
        var amount = $("#cashflowtransactions #text" + id).val();

        $.ajax({
            url: baseURL + "accounting/update_cashflow_date_amount",
            type: "POST",
            dataType: "json",
            data: { date: date, amount: amount, id: id },
            success: function(data) {
                console.log("sent");
                // location.reload();
            }
        })
        location.reload();
        $("#cashflowmoneyin tr.edit-panel").hide();
    })
    $(document).on('click', '#cashflowtransactions #cti_update', function(event) {
        var id = $(this).parents("tr").attr("id");

        var date = $("#cashflowtransactions #dates" + id).val();
        var amount = $("#cashflowtransactions #texts" + id).val();

        $.ajax({
            url: baseURL + "accounting/update_invoice_date_amount",
            type: "POST",
            dataType: "json",
            data: { date: date, amount: amount, id: id },
            success: function(data) {
                console.log("sent");
                // location.reload();
            }
        })
        location.reload();
        $("#cashflowmoneyin tr.edit-panel").hide();
    })
    $(document).on('click', '#cashflowmoneyin #cmi_update', function(event) {
        var id = $(this).parents("tr").attr("id");

        var date = $("#cashflowmoneyin #date" + id).val();
        var amount = $("#cashflowmoneyin #text" + id).val();

        $.ajax({
            url: baseURL + "accounting/update_cashflow_date_amount",
            type: "POST",
            dataType: "json",
            data: { date: date, amount: amount, id: id },
            success: function(data) {
                console.log("sent");
                // location.reload();
            }
        })
        location.reload();
        $("#cashflowmoneyin tr.edit-panel").hide();
    })
    $(document).on('click', '#cashflowmoneyout #cmi_update', function(event) {
        var id = $(this).parents("tr").attr("id");

        var date = $("#cashflowmoneyout #date" + id).val();
        var amount = $("#cashflowmoneyout #text" + id).val();

        $.ajax({
            url: baseURL + "accounting/update_cashflow_date_amount",
            type: "POST",
            dataType: "json",
            data: { date: date, amount: amount, id: id },
            success: function(data) {
                console.log("sent");
                // location.reload();
            }
        })
        location.reload();
        $("#cashflowmoneyin tr.edit-panel").hide();
    })




    //remove
    $(document).on('click', '#cashflowtransactions #ct_remove', function(event) {
        var id = $(this).parents("tr").attr("data-id");

        Swal.fire({
            title: "Are you sure?",
            html: "Once deleted, you will not be able to recover this !",
            showCancelButton: true,
            icon: "warning",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: baseURL + "accounting/remove_cashflow_customer",
                    type: "POST",
                    dataType: "json",
                    data: { id: id },
                    success: function(data) {
                        load_money_in_out_table()
                        $("#cashflowmoneyin tr.edit-panel").hide();
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            html: "Info deleted.",
                            icon: "success",
                        });
                    }
                })
            }
        });


    })

    $(document).on('click', '#cashflowmoneyin #ct_remove', function(event) {
        var id = $(this).parents("tr").attr("data-id");

        $.ajax({
            url: baseURL + "accounting/remove_cashflow_customer",
            type: "POST",
            dataType: "json",
            data: { id: id },
            success: function(data) {
                console.log("sent");
                // location.reload();
            }
        })
        location.reload();
        $("#cashflowmoneyin tr.edit-panel").hide();
    })
    $(document).on('click', '#cashflowmoneyout #ct_remove', function(event) {
        var id = $(this).parents("tr").attr("data-id");

        $.ajax({
            url: baseURL + "accounting/remove_cashflow_customer",
            type: "POST",
            dataType: "json",
            data: { id: id },
            success: function(data) {
                console.log("sent");
                // location.reload();
            }
        })
        location.reload();
        $("#cashflowmoneyin tr.edit-panel").hide();
    })
});