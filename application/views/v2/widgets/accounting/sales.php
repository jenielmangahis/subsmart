<?php
if (!is_null($dynamic_load) && $dynamic_load == true) :
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
            <a role="button" class="nsm-button btn-sm m-0 me-2" href="<?php echo base_url('accounting/allsales') ?>">
                See More
            </a>
            </div>
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
    <div class="nsm-card-content d-flex justify-content-center flex-column align-items-center">
        <canvas id="sales_chart" class="nsm-chart" data-chart-type="sales"></canvas>
    </div>
</div>

<script type="text/javascript">
    var today = new Date();

    var month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Nov", "Dec"];
    var todayDate = month[today.getMonth()] + "-" + today.getDate();
    var first = new Date(new Date().setDate(today.getDate() - 30));
    var firstDate = month[first.getMonth()] + " " + first.getDate();
    var second = new Date(new Date().setDate(first.getDate() - 25));
    var second2 = new Date(new Date().setDate(first.getDate() - 24));
    var secondDate = month[second.getMonth()] + " " + second.getDate();
    var secondDate2 = month[second2.getMonth()] + " " + second2.getDate();
    var third = new Date(new Date().setDate(today.getDate() - 18));
    var third2 = new Date(new Date().setDate(today.getDate() - 17));
    var thirdDate = month[third.getMonth()] + " " + third.getDate();
    var thirdDate2 = month[third2.getMonth()] + " " + third2.getDate();
    var fourth = new Date(new Date().setDate(today.getDate() - 12));
    var fourth2 = new Date(new Date().setDate(today.getDate() - 11));
    var fourthdDate = month[fourth.getMonth()] + " " + fourth.getDate();
    var fourthdDate2 = month[fourth2.getMonth()] + " " + fourth2.getDate();
    var fifth = new Date(new Date().setDate(today.getDate() - 6));
    var fifthDate = month[fifth.getMonth()] + " " + fifth.getDate();
    var fifth2 = new Date(new Date().setDate(today.getDate() - 5));
    var fifthDate2 = month[fifth2.getMonth()] + " " + fifth2.getDate();



    $(document).ready(function() {
        initializeSalesChart()

    });


    <?php
    $amountFirst = 0;
    $amountSecond = 0;
    $amountThird = 0;
    $amountFourth = 0;
    $amountFifth = 0;


    foreach ($sales as $s) {
        if (date("Y-m-d", strtotime("-30 days")) <= date("Y-m-d", strtotime($s->date_created)) && date("Y-m-d", strtotime("-25 days")) >= date("Y-m-d", strtotime($s->date_created))) {
            $amountFirst += $s->grand_total;
        } else if (date("Y-m-d", strtotime("-24 days")) <= date("Y-m-d", strtotime($s->date_created)) && date("Y-m-d", strtotime("-18 days")) >= date("Y-m-d", strtotime($s->date_created))) {
            $amountSecond += $s->grand_total;
        } else if (date("Y-m-d", strtotime("-17 days")) <= date("Y-m-d", strtotime($s->date_created)) && date("Y-m-d", strtotime("-12 days")) >= date("Y-m-d", strtotime($s->date_created))) {
            $amountThird += $s->grand_total;
        } else if (date("Y-m-d", strtotime("-11 days")) <= date("Y-m-d", strtotime($s->date_created)) && date("Y-m-d", strtotime("-6 days")) >= date("Y-m-d", strtotime($s->date_created))) {
            $amountFourth += $s->grand_total;
        } else if (date("Y-m-d", strtotime("-5 days")) <= date("Y-m-d", strtotime($s->date_created)) && date("Y-m-d") >= date("Y-m-d", strtotime($s->date_created))) {
            $amountFifth += $s->grand_total;
        }
    }

    ?>


    function initializeSalesChart() {
        var sales = $('#sales_chart');

        const sales_labels = [
            firstDate + " - " + secondDate,
            secondDate2 + " - " + thirdDate,
            thirdDate2 + " - " + fourthdDate,
            fourthdDate2 + " - " + fifthDate,
            fifthDate2 + " - " + todayDate,
        ];
        const sales_data = {
            labels: sales_labels,
            datasets: [{
                label: 'Sales',
                backgroundColor: 'rgb(106, 74, 134)',
                borderColor: 'rgb(106, 74, 134)',
                data: [<?php echo $amountFirst ?>, <?php echo $amountSecond; ?>, <?php echo $amountThird; ?>, <?php echo $amountFourth; ?>, <?php echo $amountFifth; ?>],
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
if (!is_null($dynamic_load) && $dynamic_load == true) :
    echo '</div>';
endif;
?>