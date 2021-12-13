$(document).on("click", ".section-above-chart .cashflowchart-tab-btns button", function(event) {
    event.preventDefault();
    $(".section-above-chart .cashflowchart-tab-btns button.active").removeClass("active");
    $(this).addClass("active");
    if ($(".section-above-chart .cashflowchart-tab-btns button.money_in_out.active").length > 0) {
        $(".money_in_out_chart_section").show();
        $(".cash_balance_chart_section").hide();
        start_money_in_out_chart();
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

function start_money_in_out_chart() {
    cashflow_chart = document.getElementById('cash_in_out_chart').getContext('2d');
    const cfg = {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Money in",
                data: data,
                backgroundColor: ['rgba(82, 183, 2, 1)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 2,
                borderWidth: 2,
                stack: "money_in"
            }, {
                label: "Projected",
                data: data_projected,
                backgroundColor: ['rgba(82, 183, 2, 0.2)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 2,
                borderDash: [2],
                borderWidth: 2,
                stack: "money_in"
            }, {
                label: "Money out",
                data: data,
                backgroundColor: ['rgba(6, 164, 181, 1)'],
                borderColor: ['rgba(6, 164, 181, 1)'],
                fill: true,
                radius: 2,
                borderWidth: 2,
                stack: "money_out"
            }, {
                label: "Projected",
                data: data_projected,
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
    var money_in_out_chart = new Chart(cashflow_chart, cfg);
}