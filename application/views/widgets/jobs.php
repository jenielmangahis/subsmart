<!--<div class="<?= $class ?>"   id="widget_<?= $id ?>">
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
</div>-->
<div class="<?= $class ?> widget" data-id="<?= $id ?>"   id="widget_<?= $id ?>" >
    <div  style="width: 300px; border: 1px solid #58c04e; background: #58c04e; color:white;  border-radius: 10px; text-align: center;padding: 5px;position: relative;margin: 0 auto;top: 21px;z-index: 1000;">
        <i class="fa fa-wrench" aria-hidden="true"></i> Jobs
        
        <div class="float-right">
            <div class="dropdown" style="position: relative;float: right;display: inline-block;margin-left: 10px;">
                <span type="button" data-toggle="dropdown" style="border-radius: 0 36px 36px 0;margin-left: -5px;">
                    &nbsp;<span class="fa fa-ellipsis-v"></span></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#" class="dropdown-item" onclick="removeWidget('<?= $id ?>')">Close</a></li>
                    <li><a href="#" class="dropdown-item" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a href="#" class="dropdown-item">Move</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="card" style="border: 2px solid #30233d; margin-top:0; border-radius: 40px; padding:5px;">
        <div style="border: 5px solid #30233d; margin-top:0; border-radius: 40px; box-shadow: 1px 0px 15px 5px rgb(48, 35, 61);">
            <div class="card-body mt-3" style="padding:5px 10px; height: <?= $rawHeight ?>px;">
                <div class="row" id="jobsBody" style="overflow-y: scroll;">
                    <canvas id="jobCanvas" height="<?= $rawHeight-250 ?>"></canvas>

                </div>
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
                        order: 2
                    }, {
                        label: 'Job Value',
                        data: [1000, 2550, 3000],
                        borderWidth: 1,
                        borderColor: window.chartColors.red,
                        type: 'line',
                        yAxisID: "id2",
                        order: 1
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
                        render: () => {
                        }
                    }
                }
            }
        });
    });




</script>