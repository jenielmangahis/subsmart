<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '<div class="col-12 col-lg-4">';
endif;
?>
<style>
    .expenses-container .expenses-items {
        margin: 0 20px;
        color: rgb(47 43 61 / 0.9);
        border-radius: 6px;
        background-image: none;
        padding: 10px;
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        align-items: center;
        box-shadow: 0px 3px 12px #38747859;
    }

    .expenses-container .expenses-items canvas {
        width: 100% !important;
        display: block;
        box-sizing: border-box;
        /* box-shadow: 0px 3px 12px #38747859; */
        padding: 20px;
        border-radius: 25px;
        background: #fff;
    }
</style>
<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Expenses</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"
                            onclick="addToMain('<?= $id ?>',<?php echo $isMain ? '1' : '0'; ?>,'<?= $isGlobal ?>' )"><?php echo $isMain ? 'Remove From Main' : 'Add to Main'; ?></a>
                    </li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content ">
        <div class="banner">
            <img src="./assets/img/expense-banner.svg" alt="">
        </div>
        <div class="expenses-container">
            <div class="expenses-items">
                <?php if($total_expenses > 0) : ?>
                <canvas id="expenses_chart" class="nsm-chart" data-chart-type="expenses"></canvas>
                <?php else : ?>
                <canvas id="expenses_chart" class="nsm-chart" data-chart-type="expenses"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        initializeExpensesChart();
    });

    function initializeExpensesChart() {
        var estimates = $("#expenses_chart");

        const expensesChart = new Chart(estimates, {
            type: 'doughnut',
            data: {
                labels: <?= $account_names ?>,
                datasets: [{
                    label: 'Expenses',
                    data: <?= $account_expenses ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgb(255, 205, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgb(255, 205, 86, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                },
                aspectRatio: 1.5,
            }
        });
    }
</script>

<?php
if (!is_null($dynamic_load) && $dynamic_load == true):
    echo '</div>';
endif;
?>
