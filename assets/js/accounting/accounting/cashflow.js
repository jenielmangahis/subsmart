$(document).on("click", ".section-above-chart .cashflowchart-tab-btns button", function(event) {
    event.preventDefault();
    $(".section-above-chart .cashflowchart-tab-btns button.active").removeClass("active");
    $(this).addClass("active");
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
            addData_chashflow_chart(cash_balance_chart, labels_3m, [data_3m, data_projected_3m]);
        },
    });
}


start_cashflow_chart();
var cash_balance_chart;
var cashflow_chart = document.getElementById('chartContainer').getContext('2d');

function start_cashflow_chart() {
    if (cash_balance_chart != null) {
        cash_balance_chart.destroy();
    }
    var the_data;
    var the_labels;
    var the_data_projected;
    if ($(".cash-flow-filter select[name='chart-month-range']").val() == "12") {
        the_data = data;
        the_labels = labels;
        the_data_projected = data_projected;
    } else if ($(".cash-flow-filter select[name='chart-month-range']").val() == "3") {
        the_data = data_3m;
        the_labels = labels_3m;
        the_data_projected = data_projected_3m;
    }
    cashflow_chart = document.getElementById('chartContainer').getContext('2d');
    const cfg = {
        type: "line",
        data: {
            labels: the_labels,
            datasets: [{
                label: "Cash balance",
                data: the_data,
                backgroundColor: ['rgba(82, 183, 2, 0.4)'],
                borderColor: ['rgba(82, 183, 2, 1)'],
                fill: true,
                radius: 0,
                borderWidth: 2,
            }, {
                label: "Projected",
                data: the_data_projected,
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
                    ticks: {
                        callback: function(value, index, values) {
                            return "$" + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                        }
                    }
                }
            }
        },
    };
    cash_balance_chart = new Chart(cashflow_chart, cfg);
}