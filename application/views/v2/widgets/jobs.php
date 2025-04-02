<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    :root {
        --jobs2-primary: #281c2d;
        --jobs2-secondary: #BEAFC2;
        --jobs2-tertiary: #d9a1a0;
        --jobs2-quaternary: #F5EFFF;
        --black: #000;
        --jobs2-color1: #BEAFC2;
        --jobs2-color2: #FEA303;
        --jobs2-color3: #281c2d;
        --jobs2-color4: #214548;
    }

    .jobs-content {
        margin: 0 20px;
        background-color: #FFFFFF;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        box-shadow: 0px 3px 12px #38747859;
        padding: 10px;
        /* transform: translateY(-60px); */
        /* height: 73%; */
    }

    .jobs-content #jobs_chart {
        height: 400px !important;
    }

    .jobs-separator {
        width: 12%;
        height: 7px;
        background: var(--jobs2-color4);
        border-radius: 25px;
        /* transform: translateY(-60px); */
        float: left;
        margin-left: 20px;
    }

    .jobs-content .filter .form-select {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: none;
        border: none;
        color: #214548;
    }

    .jobs-content .filter .form-control {
        border-radius: 25px;
        font-size: 16px !important;
        font-weight: 500;
        border-color: #FEA303;
        color: #214548;
    }

    @media screen and (max-width: 1366px) {

        .jobs-content .form-select {
            width: 100%;
        }

        .jobs-content .col-4 {
            width: 50%;
        }

        .jobs-content .filter-options {
            width: 55%;
            margin-bottom: 10px;
        }
    }

    @media screen and (max-width: 567px) {

        .jobs-content {
            margin: unset;
        }

    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Jobs</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0)"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div class="banner">
            <img src="./assets/img/jobs-banner.svg" alt="">
        </div>
        <div class="jobs-content">
            <div class="row mb-4 mt-2 filter">
                <div class="col-4 filter-options">
                    <select class="nsm-field form-select" name="filter_date" id="widget-job-filter-date">
                        <!-- <option value="custom">Custom</option> -->
                        <option value="this-month">This month</option>
                        <option value="this-quarter">This quarter</option>
                        <option value="this-year" selected="">All Time</option>
                    </select>
                </div>
                <div class="col-4">
                    <input type="text" id="widget-job-filter-from"
                        class="nsm-field form-control widget-job-datepicker" value="<?= date('01/Y') ?>" />
                </div>
                <div class="col-4">
                    <input type="text" id="widget-job-filter-to" class="nsm-field form-control widget-job-datepicker"
                        value="<?= date('m/Y') ?>" required>
                </div>
            </div>
            <canvas id="jobs_chart" class="nsm-chart" data-chart-type="jobs"></canvas>
        </div>
        <!-- <div class="jobs-separator"></div> -->
    </div>
</div>
<script>
    $(document).ready(function() {
        initializeJobChart();
    });

    function initializeJobChart() {
        $(".widget-job-datepicker").datepicker({
            format: "mm/yyyy",
            viewMode: "months",
            minViewMode: "months"
        });

        $('#widget-job-filter-date').on('change', function() {
            switch ($(this).val()) {
                case 'this-month':
                    var date = new Date();
                    var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                    from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2,
                        '0') + '/' + date.getFullYear();
                    to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate())
                        .padStart(2, '0') + '/' + to_date.getFullYear();
                    break;
                case 'this-quarter':
                    var date = new Date();
                    var currQuarter = Math.floor(date.getMonth() / 3 + 1);

                    switch (currQuarter) {
                        case 1:
                            var from_date = '01/01/' + date.getFullYear();
                            var to_date = '03/31/' + date.getFullYear();
                            break;
                        case 2:
                            var from_date = '04/01/' + date.getFullYear();
                            var to_date = '06/30/' + date.getFullYear();
                            break;
                        case 3:
                            var from_date = '07/01/' + date.getFullYear();
                            var to_date = '09/30/' + date.getFullYear();
                            break;
                        case 4:
                            var from_date = '10/01/' + date.getFullYear();
                            var to_date = '12/31/' + date.getFullYear();
                            break;
                    }
                    break;
                case 'this-year':
                    var date = new Date();

                    var from_date = String(1).padStart(2, '0') + '/' + String(1).padStart(2, '0') + '/' + date
                        .getFullYear();
                    var to_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2,
                        '0') + '/' + date.getFullYear();
                    //var to_date   = String(12).padStart(2, '0') + '/' + String(31).padStart(2, '0') + '/' + date.getFullYear();
                    break;
                default:
                    var date = new Date();
                    var to_date = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                    from_date = String(date.getMonth() + 1).padStart(2, '0') + '/' + String(1).padStart(2,
                        '0') + '/' + date.getFullYear();
                    to_date = String(to_date.getMonth() + 1).padStart(2, '0') + '/' + String(to_date.getDate())
                        .padStart(2, '0') + '/' + to_date.getFullYear();
                    break;
            }

            $('#widget-job-filter-from').val(moment(from_date).format('MM/YYYY'));
            $('#widget-job-filter-to').val(moment(to_date).format('MM/YYYY'));

            loadJobChart();
        });

        $('#widget-job-filter-from, #widget-job-filter-to').on('change', function() {
            loadJobChart();
        });

        loadJobChart();
    }

    function loadJobChart() {
        var chartInstance = Chart.getChart("jobs_chart");
        if (chartInstance) {
            chartInstance.destroy();
        }

        var jobs = $('#jobs_chart');
        var jobsChart = new Chart(jobs, {
            type: 'bar',
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                //console.log(tooltipItem);
                                if (tooltipItem.dataset.label == 'Job Value') {
                                    const amount = tooltipItem.formattedValue;
                                    return '$' + amount.toLocaleString(undefined, {
                                        minimumFractionDigits: 2
                                    });
                                } else {
                                    return tooltipItem.formattedValue;
                                }
                            }
                        }
                    },
                },
                aspectRatio: 1,
                scales: {
                    A: {
                        type: 'linear',
                        position: 'left',
                        title: {
                            display: true,
                            text: 'No of Jobs'
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    },
                    B: {
                        type: 'linear',
                        position: 'right',
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return '$' + value.toLocaleString(undefined, {
                                    minimumFractionDigits: 2
                                });
                                // if (parseInt(value) >= 1000) {
                                //     return '$' + value.toString().replace(
                                //         /\B(?=(\d{3})+(?!\d))/g, ",");
                                // } else {
                                //     return '$' + value;
                                // }
                            }
                        }
                    }
                }
            }
        });

        var filter_date_from = $('#widget-job-filter-from').val();
        var filter_date_to = $('#widget-job-filter-to').val();

        $.ajax({
            url: base_url + 'widgets/_load_job_chart_data',
            method: 'post',
            data: {
                filter_date_from: filter_date_from,
                filter_date_to: filter_date_to
            },
            dataType: 'json',
            success: function(data) {
                const jobs_labels = data.chart_labels;
                const jobs_data = {
                    labels: jobs_labels,
                    datasets: [{
                            label: 'Job Count',
                            data: data.total_jobs_number_data,
                            backgroundColor: [
                                '#EFB6C8',
                            ],
                            borderWidth: 1,
                            stack: 'combined',
                            type: 'bar',
                            yAxisID: "A",
                        },
                        {
                            label: 'Job Value',
                            data: data.total_jobs_amount_data,
                            backgroundColor: [
                                '#BEAFC2',
                            ],

                            borderWidth: 1,
                            stack: 'combined',
                            yAxisID: "B",
                        }
                    ]
                };

                jobsChart.data = jobs_data;
                jobsChart.update();
            }
        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
