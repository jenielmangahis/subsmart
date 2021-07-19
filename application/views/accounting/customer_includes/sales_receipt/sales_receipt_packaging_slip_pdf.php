<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet"
        href="<?=base_url('assets/dashboard/css/bootstrap.min.css')?>">
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #fff;
        }


        .no-margin {
            margin: 0;
        }

        .no-padding {
            padding: 0;
        }


        .business-logo {
            position: relative;
        }

        .business-logo img {
            display: block;
            width: 100px;
            margin: auto;
            bottom: 0;
            right: 0;
        }

        .business-info h2.business-name {
            font-size: 15px;
            font-weight: 700;

        }

        .business-info p {
            margin: 0;
            font-size: 12px;
        }

        .customer-info h2 {
            font-size: 15px;
            font-weight: 700;
        }

        .receipt-info-section h2 {
            font-size: 35px;
            color: #8C97C0;
            margin: 0;
        }

        .receipt-info-section p {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
        }

        .receipt-info-section p span {
            font-weight: normal;
            padding-left: 10px;
        }

        .customer-info {
            padding-left: 50px;
        }

        .customer-info h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .customer-info p {
            margin: 0;
            font-size: 13px;
        }

        p.note {
            text-align: center;
            text-transform: uppercase;
            margin-top: 30px;
        }

        p.cutter {
            border: dashed 1px #909090;
            margin: 30px 0;
        }

        .amount-summary p {
            margin: 0;
            text-align: left;
            font-size: 14px;
        }

        .amount-summary p.amount {
            text-align: right;
        }

        .amount-summary p.balance-due.amount {
            font-size: 25px;
            font-weight: 500;
        }

        .items-table table {
            width: 100%;
        }

        .items-table table thead tr th:first-child,
        .items-table table tbody tr td:first-child {
            text-align: left;
            width: 50%;
        }

        .items-table table thead tr th,
        .items-table table tbody tr td {
            text-align: right;
        }

        .items-table table thead tr th {
            color: #8D97C0;
        }

        .items-table table thead tr {
            background-color: #E8EAF2;
        }

        .text-left {
            text-align: left;
        }
    </style>

</head>

<body>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <div class="business-info">
                        <h2 class="business-name" style="margin: 0;font-size: 15px;">
                            <?=$business_name?>
                        </h2>
                        <p class="address-strees" style="margin: 0;">
                            <?=$business_address_street?>
                        </p>
                        <p class="address-state">
                            <?=$business_address_state?>
                        </p>
                        <p class="contact-number">
                            <?=$business_contact_number?>
                        </p>
                        <p class="email">
                            <?=$business_email?>
                        </p>
                    </div>
                </td>
                <td style="width: 50%;">
                    <div class="business-logo">
                        <img src="<?=base_url()?>uploads/users/business_profile/<?=$business_logo?>"
                            alt="" style="width: 100px;">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="receipt-info-section">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;">
                        <h2 class="receipt-title">PACKING SLIP</h2>
                    </td>
                    <td style="width: 50%;">
                        <div class="receipt-info">


                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%; text-align:right;">
                                            <p class="sales-number">SALES #
                                            </p>
                                            <p class="receipt-date">DATE
                                            </p>
                                        </td>
                                        <td style="text-align:left;">
                                            <p class="sales-number">
                                                <span><?=$sales_number?></span>
                                            </p>
                                            <p class="receipt-date">
                                                <span><?=date("m/d/Y", strtotime($receipt_date))?></span>
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="customer-info">
                <h2 style="font-size: 15px;">Bill To</h2>
                <p class="customer-name"><?=$customer_full_name?>
                </p>
                <p class="address-street"><?=$customer_adress_street?>
                </p>
                <p class="address-state"><?=$customer_address_state?>
                </p>
            </div>
        </div>
    </div>
    <div style="margin-bottom: 50px;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <hr>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="items-table">
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">ACTIVITY</th>
                    <th>QTY</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $item) {
                    ?>
                <tr>
                    <td style="text-align: left;">
                        <?=$item->item?>
                    </td>
                    <td>
                        <?=$item->qty?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>