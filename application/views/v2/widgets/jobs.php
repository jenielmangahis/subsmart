<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Jobs</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content d-flex justify-content-center flex-column align-items-center">
        <canvas id="jobs_chart" class="nsm-chart" data-chart-type="jobs"></canvas>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initializeJobsChart();
    });


    var today = new Date();

    var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Nov", "Dec"];

    var currentMonth = month[today.getMonth()];
    var secMonth = month[today.getMonth()-1];
    var firstMonth = month[today.getMonth()-2];

    <?php $currJobCount = 0; $prevJobCount = 0;  $previousJobCount=0; $prevMonthDate = date("Y-m-d", strtotime("-1 month")); $firstprevMonth = date("Y", strtotime("-60 days"));  foreach($jobsDone as $jD){ 
        if(date("M")==date("M",strtotime($jD->date_created)) && date("Y")==date("Y",strtotime($jD->date_created))){
            $currJobCount++;
        }else if(date("M", strtotime("-1 month"))==date("M",strtotime($jD->date_created)) && date("Y",strtotime($prevMonthDate))==date("Y",strtotime($jD->date_created))){
            $prevJobCount++;
        }else if(date("M", strtotime("-60 days"))==date("M",strtotime($jD->date_created)) && $firstprevMonth==date("Y",strtotime($jD->date_created))){
            $previousJobCount++;
        }
        ?>
        var currJobCount = 0; var secJobCount = 0; var firstJobCount = 0;
       
    function initializeJobsChart() {
        var jobs = $("#jobs_chart");

        new Chart(jobs, {
            type: 'line',
            data: {
                labels: [firstMonth,secMonth, currentMonth],
                datasets: [{
                        label: 'Job Count',
                        data: [ <?php echo $previousJobCount; ?>, <?php echo $prevJobCount; ?>, <?php echo $currJobCount; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        stack: 'combined',
                        type: 'bar',
                        yAxisID: "A",
                    },
                    {
                        label: 'Job Value',
                        data: [<?php echo $previousJobCount; ?>, <?php echo $prevJobCount; ?>, <?php echo $currJobCount; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(191, 191, 191, 0.5)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        stack: 'combined',
                        yAxisID: "B",
                    },

                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                aspectRatio: 1.5,
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
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return value;
                                }
                            }
                        }
                    },
                    B: {
                        type: 'linear',
                        position: 'right',
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return '$' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                } else {
                                    return '$' + value;
                                }
                            }
                        }
                    }
                }
            }
        });
    }
    <?php }?>
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>