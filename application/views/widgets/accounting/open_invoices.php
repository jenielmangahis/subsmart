<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #40c057; color:white;">
            <i class="fa fa-money" aria-hidden="true"></i> Open Invoices
        </div>
        <div class="card-body">
            <div class="row" id="openInvoicesBody" style="<?= $height; ?> overflow-y: scroll;">
                <canvas id="canvas" height="<?= $rawHeight - 120 ?>"></canvas>

            </div>
        </div>

    </div>
</div>
<script>
    var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var color = Chart.helpers.color;
    var barChartData = {
        labels: ['PAST DUE', 'DUE', 'UNSENT'],
        datasets: [{
                label: 'Open Invoices',
                borderWidth: 1,
                data: [
                    150000,
                    50000,
                    20000
                ],
                backgroundColor: [
                    "rgb(255, 99, 132)",
                    "rgb(255, 159, 64)",
                    "rgb(255, 205, 86)"
                ]
            }]

    };

    window.onload = function () {
        var ctx = document.getElementById('canvas').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                    align: 'end',
                    labels: {
                        fontSize: 18
                    }
                },
                title: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return '$' + value;
                                    }
                                }
                            }
                        }]
                },

                plugins: {
                    labels: {
                        render: 'value',
                        precision: 2,
                        showActualPercentages: true,
                        showZero: true
                    }
                }
            }
        });

    };



</script>