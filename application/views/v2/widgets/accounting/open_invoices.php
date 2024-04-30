<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '<div class="col-12 col-lg-4">';
endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Open Invoices</span>
        </div>
        <div class="nsm-card-controls">
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?= base_url('invoices'); ?>">
                See More
            </a>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain ? '1' : '0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain ? 'Remove From Main' : 'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content d-flex justify-content-center align-items-center">
        <canvas id="invoice_chart" class="nsm-chart" data-chart-type="invoices"></canvas>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    initializeInvoiceChart();
});

function initializeInvoiceChart() {
    var invoices = $("#invoice_chart");
    var totalDueInvoices = <?= count($dueInvoices); ?>;
    var totalOverDueInvoices = <?= count($overdueInvoices); ?>;

    new Chart(invoices, {
        type: 'bar',
        data: {
            labels: ['DUE', 'OVERDUE'],
            datasets: [{
                label: 'Open Invoices',
                data: [totalDueInvoices, totalOverDueInvoices],
                backgroundColor: [
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 159, 64)',
                    'rgb(255, 99, 132)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    display:false
                },
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            aspectRatio: 1.5
        }
    });
}
</script>


<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>