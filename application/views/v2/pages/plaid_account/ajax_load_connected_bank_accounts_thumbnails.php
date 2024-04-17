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
    </style>
</head>
<body>

<?php if ($is_valid == 1 && !empty($plaidBankAccounts)) { ?>
    <div id="discover_carousel" class="carousel slide h-100 pb-4" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php for ($i = 0; $i < count($plaidBankAccounts); ++$i) { ?>
                <button type="button" data-bs-target="#discover_carousel" data-bs-slide-to="<?php echo $i; ?>" <?php echo $i == 0 ? 'class="active"' : ''; ?> aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
            <?php } ?>
        </div>
        <div class="carousel-inner h-100">
            <?php foreach ($plaidBankAccounts as $key => $pa) { ?>
                <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
                    <div class="row h-100">
                        <div class="widget-item">
                            <div class="content ms-2">
                                <div class="details">
                                    <span class="content-title mb-1"><?php echo $pa->institution_name.' - '.$pa->account_name; ?></span>
                                    <span class="content-subtitle d-block">
                                        <?php
                                        if (is_numeric($pa->balance_available)) {
                                            echo 'Balance : $'.number_format($pa->balance_available, 2);
                                        } else {
                                            echo $pa->balance_available;
                                        }
                ?>
                                    </span>
                                </div>
                                <div class="controls">
                                    <!-- <span class="nsm-badge">Updated 1 day ago</span> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } else { ?>
    <div class="nsm-empty">
        <i class="bx bx-meh-blank"></i>
        <span>Invalid Plaid Account</span>
    </div>
<?php } ?>


</body>
</html>
