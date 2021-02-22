<div class="<?= $class ?>"   id="widget_<?= $id ?>">
    <div class="card" style="margin-top:0;">
        <div class="card-header" style="background: #64443c; color: white;">
            <i class="fa fa-wrench" aria-hidden="true"></i> Jobs
        </div>
        <div class="card-body">
            <div class="row" id="jobsBody" style="<?= $height; ?> overflow-y: scroll;">
                <canvas id="jobCanvas" height="<?= $rawHeight - 130 ?>"></canvas>

            </div>
        </div>

    </div>
</div>

<script>
    var color = Chart.helpers.color;

    $(document).ready(function () {
        var ctx2 = document.getElementById('jobCanvas').getContext('2d');
        var mixedChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                datasets: [{
                        label: 'Job Count',
                        data: [500, 700, 1300],
                        backgroundColor: window.chartColors.blue,
                        yAxisID: "id1",
                        order:2
                    }, {
                        label: 'Job Value',
                        data: [1000, 2550, 3000],
                        borderWidth: 1,
                        borderColor: window.chartColors.red,
                        type: 'line',
                        yAxisID: "id2",
                        order:1
                    }],
                labels: ['January', 'February', 'March']
            },
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                    align: 'center',
                    labels: {
                        fontSize: 13
                    }
                },
                scales: {// Shouldn't be an array.
                    yAxes: [{
                            display: true,
                            position: 'left',
                            type: "linear",
                            scaleLabel: {
                                display: true,
                                labelString: 'No of Jobs',
                            },
                            
                            id: "id1",
                            ticks: {
                                beginAtZero: true,
                                callback: function (value, index, values) {
                                    if (parseInt(value) >= 1000) {
                                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return value;
                                    }
                                }
                            }
                        }, {
                            scaleLabel: {
                                display: true,
                            },
                            display: true,
                            type: "linear",
                            position: "right",
                            gridLines: {
                                display: false
                            },
                            id: "id2",
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
                            //}]
                },
                plugins: {
                  labels: {
                    render: () => {}
                  }
                }
            }
        });
    });




</script>