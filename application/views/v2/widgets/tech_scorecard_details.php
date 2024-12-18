<style>
    .tech-info .first {
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        -webkit-transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px rgb(47 43 61/ 0.14);
        padding: 30px 10px;
    }

    .tech-info .first .profile {
        margin: auto;
        width: 100px;
        height: 100px;
        min-width: 40px;
        background-color: #6a4a86;
        color: #fff;
        border-radius: 100%;
        display: flex;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .tech-info .first .profile span {
        margin: auto;
        font-weight: 600;
        font-size: 24px;
    }

    .tech-info .tech-badge {
        background: #6a4a86 !important;
        font-size: 12px !important;
        border-radius: 25px;
        padding: 5px !important;
        width: 90% !important;
        margin: auto;
    }

    .details {
        width: 100%;
        text-align: center;
        margin-top: 20px;
    }

    .details .tech-name {
        font-size: 22px;
        font-weight: bold;
    }

    .details>span {
        display: block
    }

    .tech-info-second .card-items {
        height: 20%;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        -webkit-transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px rgb(47 43 61 / 0.14);
        margin-bottom: 10px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 20px;
    }

    .tech-info-second .card-items .jobs {
        font-weight: 600;
        font-size: 12px;
    }

    .tech-info-second .card-items .count {
        text-align: center;
        font-size: 22px;
        font-weight: bold;
    }

    .tech-info-second .progress-bar {
        background-color: #6a4a86 !important;
    }

    .separator {
        width: 100%;
        height: 2px;
        background: #6a4a8673;
        margin-top: 30px;
        margin-bottom: 10px;
        border-radius: 25px;
    }

    .chart-card {
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        -webkit-transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px rgb(47 43 61 / 0.14);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px;
    }

    .chart-card label {
        font-size: 16px;
        font-weight: bold;
    }

    .chart-card-empty {
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px;
        box-shadow: 0px 3px 12px rgb(47 43 61 / 0.14);
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        -webkit-transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
    }

    .chart-card-empty label {
        font-size: 16px;
        font-weight: bold;
    }

    .chart-revenue-value {
        margin: 0 10px;
    }


    .chart-revenue-value>div {
        width: 20%;
    }

    .chart-revenue-value div span {
        font-size: 18px;
        font-weight: bold;
    }

    .text-label {
        color: #6a4a86;
        font-weight: bold;
        font-size: 18px;
        letter-spacing: 1.5px;
    }

    .performance .progress .progress-bar {
        background-color: #6a4a86 !important;
    }

    .performance label {
        margin-bottom: 5px;
        font-weight: 600;
        color: #6a4a86;

    }

    .star {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color 0.2s;
    }

    .star.selected {
        color: #6a4a86;
    }

    .performance-card {
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        -webkit-transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
        border-radius: 6px;
        background-image: none;
        overflow: hidden;
        box-shadow: 0px 3px 12px rgb(47 43 61 / 0.14);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 10px;
        height: 100%;
        width: 100%;
    }

    .performance-card .filter select {
        border: none !important;
        width: 90% !important;
    }

    .performance-card .filter label {
        margin: 0 !important;
    }

    .teammate .table {
        font-size: 16px !important;
    }

    .teammate .table label {
        font-size: 16px !important;
    }

    .teammate table tbody tr td {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
    }

    .teammate table tbody tr td.score {
        color: #6a4a86 !important;
        font-size: 20px !important;
    }
</style>
<?php if (count($techLeaderBoards) > 0) : foreach ($techLeaderBoards as $tech):?>
<div class="col-12">
    <div class="row">
        <div class="col-md-6 tech-info ">
            <div class="first mb-2">
                <?php $image = userProfilePicture($tech->id); ?>
                <?php if (is_null($image)){ ?>
                <div class="profile">
                    <span><?php echo getLoggedNameInitials($tech->id); ?></span>
                </div>
                <?php }else{ ?>
                <div class="profile" style="background-image: url('<?php echo $image; ?>');"></div>
                <?php } ?>
                <div class="details">
                    <span class="tech-name"><?= $tech->tech_rep ?></span>
                    <span class="tech-email"><?= $tech->email ?></span>
                </div>
                <div class="mt-3">
                    <span class="badge bg-success fs-6 p-2 tech-badge">
                        Member since <span id="startYear">2018</span>
                    </span>
                </div>
            </div>

            <div class="col-md-12 chart-card-empty second">
                <label class="mb-3">Reviews</label>
                <canvas id="total_amount_jobs_chart" class="nsm-chart" data-chart-type="customer-groups"
                    style="width:100px; height: 100px; margin: auto;" value="<?= $tech->total_amount ?>"></canvas>

            </div>
        </div>

        <div class="col-md-6 tech-info-second">
            <div class="card-items">
                <div class="col-md-12">
                    <div class="row align-items-center">

                        <div class="col-md-8 jobs">
                            <label class="">Completed Jobs</label>
                        </div>
                        <div class="col-md-4 count">
                            <label>70</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: 25%"></div>
                    </div>
                </div>
            </div>
            <div class="card-items">
                <div class="col-md-12">
                    <div class="row align-items-center">

                        <div class="col-md-8 jobs">
                            <label class="">Completed Service</label>
                        </div>
                        <div class="col-md-4 count">
                            <label>90</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar" style="width: 50%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 chart-card">
                <label for="">Revenue</label>
                <canvas id="revenue_chart" class="nsm-chart" style="width: 95%; height: 300px; margin: auto;"></canvas>
                <!-- <div class="d-flex align-center justify-content-between chart-revenue-value">
                    <div class="text-end">
                        <span>28k</span>
                    </div>
                    <div class="text-start">
                        <span>28k</span>
                    </div>
                </div> -->
            </div>

        </div>
    </div>
    <div class="separator"></div>

    <div class="row performance">
        <div class="col-md-12">

            <div class="row">
                <div class="col-md-5 ">
                    <div class="text-label mb-3">
                        <span>PERFORMANCE</span>
                    </div>
                    <div class="mb-3">
                        <label for="">Attendance</label>
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: 70%">70%</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Overall Performance</label>
                        <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar bg-success" style="width: 80%">80%</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="">Customer Reviews</label>
                        <div id="star-rating" class="d-flex mb-3">
                            <i class="bx bxs-star star selected" data-value="1"></i>
                            <i class="bx bxs-star star selected" data-value="2"></i>
                            <i class="bx bxs-star star selected" data-value="3"></i>
                            <i class="bx bxs-star star selected" data-value="4"></i>
                            <i class="bx bxs-star star " data-value="5"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="performance-card">
                        <div class="col-md-12 filter mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="" class="mb-2">Filter by Year:</label>
                                </div>
                                <div class="col-md-4">
                                    <select>
                                        <option value="" selected>2024</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table class="table">
                            <thead></thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Platform 1:</th>
                                    <td>1020</td>
                                    <td>5%</td>
                                </tr>
                                <tr>
                                    <th scope="row">Platform 2:</th>
                                    <td>1226</td>
                                    <td>10%</td>
                                </tr>
                                <tr>
                                    <th scope="row">Platform 3:</th>
                                    <td>1782</td>
                                    <td>4%</td>
                                </tr>
                                <tr>
                                    <th scope="row">Platform 4:</th>
                                    <td>1500</td>
                                    <td>20%</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="separator"></div>
    <div class="row teammate">
        <div class="col-md-12">
            <div class="text-label mb-3">
                <span>TECH LEADER</span>
            </div>
            <div class="col-md-12">
                <table class="table  table-borderless">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th style="text-align:center">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="nsm-profile">
                                        <span>BN</span>
                                    </div>
                                    <label for="">Brannon Nguyen</label>
                                </div>
                            </td>
                            <td class="score"><span>87</span></td>

                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="nsm-profile">
                                        <span>TN</span>
                                    </div>
                                    <label for="">Tommy Nguyen</label>
                                </div>
                            </td>
                            <td class="score"><span>100</span></td>

                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex gap-2 align-items-center">
                                    <div class="nsm-profile">
                                        <span>TN</span>
                                    </div>
                                    <label for="">Tyler Nguyen</label>
                                </div>
                            </td>
                            <td class="score"><span>90</span></td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<?php endforeach; ?>

<script>
    loadCustomerGroupChart();

    function loadCustomerGroupChart() {
        var totalAmountJobs = $('#total_amount_jobs_chart');
        var value = parseInt(totalAmountJobs.attr('value'));


        const chart_data = {
            datasets: [{
                data: [value],
                backgroundColor: ['#6a4a86'],
                borderColor: ['#6a4a86'],
                borderWidth: 0.5,
            }],
        };

        var centerTextPlugin = {
            id: 'centerTextPlugin',
            afterDatasetDraw(chart) {
                const {
                    ctx,
                    chartArea: {
                        top,
                        bottom,
                        left,
                        right,
                        width,
                        height
                    },
                } = chart;
                ctx.save();
                ctx.font = 'bold 16px Arial';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'top';
                ctx.fillStyle = '#333';

                const total = chart.data.datasets[0].data.reduce((a, b) => Number(a) + Number(b), 0) ||
                    0;

                // const text1 = 'Total';
                // ctx.fillText(text1, width / 2, height / 2);

                const text2 = total;
                ctx.font = '18px sans-serif'
                ctx.fillText(text2, width / 2, height / 2 - 10);

                ctx.restore();
            },
        };

        // Render the chart
        var totalAmountJobsCart = new Chart(totalAmountJobs, {
            type: 'doughnut',
            data: chart_data,
            options: {
                responsive: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: true,
                    },
                },
                cutout: '80%',
                aspectRatio: 1,
            },

            plugins: [centerTextPlugin],
        });
    }

    loadRevenueChart();

    function loadRevenueChart() {
        fetch('<?php echo base_url('widgets/_load_customer_group_chart'); ?>', {})
            .then(response => response.json())
            .then(data => {
                var revenueGaugeData = {
                    labels: ['Score', 'Gray Area'],
                    datasets: [{
                        label: 'Weekly Sales',
                        data: [100, 300],
                        backgroundColor: [
                            '#6a4a86'
                        ],
                        borderColor: [
                            '#6a4a86'
                        ],
                        borderWidth: 1,
                        cutout: '80%',
                        circumference: 180,
                        rotation: 270
                    }]
                };
                var revenueGuageChartText = {
                    id: 'revenueGuageChartText',
                    afterDatasetDraw(chart, args, pluginOptions) {
                        const {
                            ctx,
                            data,
                            chartArea: {
                                top,
                                bottom,
                                left,
                                right,
                                width,
                                height
                            },
                            scales: {
                                r
                            }
                        } = chart;
                        ctx.save();
                        const xCoor = chart.getDatasetMeta(0).data[0].x;
                        const yCoor = chart.getDatasetMeta(0).data[0].y;
                        const amount = data.datasets[0].data[0];
                        ctx.font = '12px sans-serif';
                        ctx.fillStyle = "rgb(40, 40, 43)";
                        ctx.textBaseLine = 'top';
                        ctx.textAlign = 'left';
                        ctx.fillText('$0', left, yCoor + 15);
                        ctx.textAlign = 'right';
                        ctx.fillText('$18K', right, yCoor + 15);



                    }
                }

                // Render the chart
                var revenueChartCanvas = $('#revenue_chart');
                var revenueGaugeConfig = {
                    type: 'doughnut',
                    data: revenueGaugeData,
                    options: {
                        aspectRatio: 1.5,
                        layout: {
                            padding: 10,
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                enabled: false
                            }
                        }
                    },
                    plugins: [revenueGuageChartText]
                };

                var revenue_chart = new Chart(revenueChartCanvas, revenueGaugeConfig);

            })
            .catch((error) => {
                console.error(error);
            });
    }
</script>

<?php  else : ?>
<div class="nsm-empty">
    <i class='bx bx-meh-blank'></i>
    <span>Technician Scorecard is empty.</span>
</div>
<?php endif; ; ?>
