<div class="<?= $class ?>"  id="widget_<?= $id ?>">
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-money" aria-hidden="true"></i> Open Invoices
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-2" style="padding:5px 10px; height: 363px; overflow: hidden">
                <div class="row" id="openInvoicesBody" style="<?= $height; ?> overflow-y: scroll;">
                    <canvas id="canvas" height="<?= $rawHeight - 120 ?>"></canvas>

                </div>
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