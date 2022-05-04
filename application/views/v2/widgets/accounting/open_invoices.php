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
        <?php
        $partially_paid = 0;
        $due = 0;
        $Approved = 0;
        $status = "";
        foreach ($upcomingInvoice as $UI) {
            $status = $UI->status;
            if ($status == "Due") {
                $due += $UI->total_due;
            } else if ($status == 'Approved') {
                $Approved += $UI->total_due;
            } else {
                $partially_paid += $UI->total_due;
            }
        }
        if ($partially_paid == 0 && $due == 0 && $Approved == 0) {
        ?>
            <div class="nsm-empty">
                <i class='bx bx-meh-blank'></i>
                <span>Open Invoices is empty.</span>
            </div>
        <?php
        } else {
        ?>
            <canvas id="invoice_chart" class="nsm-chart" data-chart-type="invoices"></canvas>
        <?php
        }
        ?>
    </div>
</div>
<?php

if ($upcomingInvoice) {
    $partially_paid = 0;
    $due = 0;
    $Approved = 0;
    $status = "";
    foreach ($upcomingInvoice as $UI) {
        if ($UI->status == "Due" || $UI->status == 'Approved' || $UI->status == 'Partially Paid') {
            $status = $UI->status;
            if ($status == "Due") {
                $due += $UI->total_due;
            } else if ($status == 'Approved') {
                $Approved += $UI->total_due;
            } else {
                $partially_paid += $UI->total_due;
            }
?>
            <script type="text/javascript">
                $(document).ready(function() {
                    initializeInvoiceChart();
                });

                function initializeInvoiceChart() {
                    var invoices = $("#invoice_chart");

                    new Chart(invoices, {
                        type: 'bar',
                        data: {
                            labels: ['DUE', 'APPROVED', 'PARTIALLY PAID'],
                            datasets: [{
                                label: 'Open Invoices',
                                data: [<?php echo $due ?>, <?php echo $Approved ?>, <?php echo $partially_paid ?>],
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
        }
    }
}
?>


<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>