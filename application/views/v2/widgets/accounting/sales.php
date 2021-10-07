<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Sales</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <button type="button" class="dropdown-toggle nsm-button btn-sm m-0 me-2" data-bs-toggle="dropdown">
                    <span>Filter by Last 30 days</span> <i class='bx bx-fw bx-chevron-down'></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Last 30 days</a></li>
                    <li><a class="dropdown-item" href="#">This month</a></li>
                    <li><a class="dropdown-item" href="#">This quarter</a></li>
                    <li><a class="dropdown-item" href="#">Last year</a></li>
                    <li><a class="dropdown-item" href="#">Last month</a></li>
                    <li><a class="dropdown-item" href="#">Last quarter</a></li>
                    <li><a class="dropdown-item" href="#">Last year</a></li>
                </ul>
            </div>
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
        <canvas id="sales_chart" class="nsm-chart" data-chart-type="sales"></canvas>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initializeSalesChart();
    });

    function initializeSalesChart() {
        var sales = $('#sales_chart');
        const sales_labels = [
            'Jun 14 - Jun 20',
            'Jun 21 - Jun 27',
            'Jun 28 - Jul 4',
            'Jul 5 - Jul 11',
            'Jul 12 - Jul 13',
        ];
        const sales_data = {
            labels: sales_labels,
            datasets: [{
                label: 'Sales',
                backgroundColor: 'rgb(106, 74, 134)',
                borderColor: 'rgb(106, 74, 134)',
                data: [0, 0, 0, 4, 0],
            }, ]
        };

        new Chart(sales, {
            type: 'line',
            data: sales_data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 10
                    },
                },
                aspectRatio: 1.5,
            },
        });
    }
</script>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>