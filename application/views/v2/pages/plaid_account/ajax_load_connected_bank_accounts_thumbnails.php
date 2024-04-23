<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Account Carousel</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .bank-recent-transactions {
        list-style: none;
        padding: 0px;
        margin: 0px;
    }

    .bank-recent-transactions li {
        display: block;
        width: 100%;
    }

    .transaction-name {
        width: 70%;
        display: inline-block;
        font-weight: bold;
    }

    .transaction-amount {
        width: 20%;
        display: inline-block;
        text-align: right;
    }

    .carousel-indicators {
        display: none;
    }

    .content-title-meter {
        font-size: 13px;
        z-index: 2;
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
    }

    .details-meter {
        display: flex;
        flex-direction: column;
        justify-items: center;
        align-items: center;
        margin-top: 10px;
    }
    </style>
</head>

<body>

    <?php if ($is_valid == 1 && !empty($plaidBankAccounts)) { ?>
    <div class="mt-5">
        <select class="nsm-field form-select mt-3" name="gauge_filter" id="gauge_filter"
            style="padding: .105rem 2.25rem .105rem .75rem;">
            <option value="Total">Total Bank Balance</option>
            <?php foreach ($recentTransactions as $transcations) { ?>
            <?php foreach ($transcations as $t) { ?>
            <option value="<?php echo $t->amount; ?>">

                <?php echo $t->name.' - '.$t->category[0].' : '.$t->amount; ?>

            </option>
            <?php } ?>
            <?php } ?>

            <option value="10000">ACH SETTLEMENT MERC DEP - Transfer</option>
            <option value="20000">INTUIT 54747205 DEPOSIT - Transfer</option>
        </select>
        <div class="row h-100">
            <div class="widget-item">
                <div class="content ms-2">
                    <div class="details position-relative details-meter">
                        <span
                            class="content-title content-title-meter position-absolute"><?php echo $plaidBankAccounts[0]->institution_name.' - '.$plaidBankAccounts[0]->account_name; ?></span>
                        <span class="content-subtitle d-block " style=" width:200px; padding-bottom:0px">

                            <?php
                                        if (is_numeric($plaidBankAccounts[0]->balance_available)) {
                                            echo '<canvas id="GuageChart" class="GuageChart" data-value="'.$plaidBankAccounts[0]->balance_available.'" data-remaining="'.$plaidBankAccounts[0]->balance_current.'"></canvas>';
                                        } else {
                                            echo '<canvas id="GuageChart" class="GuageChart" data-value="31231" data-remaining="'.$plaidBankAccounts[0]->highest_balance.'" data-highest="66666"></canvas>';
                                        }
            ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } else { ?>
    <div class="nsm-empty" style="margin-top:10rem!important">
        <i class="bx bx-meh-blank"></i>
        <span>Invalid Plaid Account</span>
        <canvas id="GuageChart"></canvas>
    </div>
    <?php } ?>
    <script>
    function updateSelectOptionFromCarousel() {
        const selectElement = document.getElementById('gauge_filter');
        const activeCarouselItem = document.querySelector('#discover_carousel .carousel-item.active');

        if (activeCarouselItem && selectElement) {

            const activeCanvas = activeCarouselItem.querySelector('.GuageChart');

            if (activeCanvas) {

                const activeCanvasDataValue = activeCanvas.getAttribute('data-value');

                const firstOption = selectElement.options[0];
                firstOption.value = activeCanvasDataValue;
            }
        }
    }
    const carousel = document.getElementById('discover_carousel');

    carousel.addEventListener('slid.bs.carousel', function() {
        updateSelectOptionFromCarousel();
    });

    function updateChartData(newValue, gaugeCharts) {
        gaugeCharts.forEach(function(gaugeChartContext) {
            const chart = gaugeChartContext?.$context?.chart;

            if (chart) {
                chart.data.datasets[0].data[0] = newValue;
                chart.update();
            } else {
                console.warn('Invalid chart instance:', gaugeChartContext);
            }
        });
    }
    $("#gauge_filter").change(function() {
        const selectedValue = this.value;
        updateChartData(selectedValue, gaugeCharts);
        updateSelectOptionFromCarousel();
    });
    </script>
</body>

</html>