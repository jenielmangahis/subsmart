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
                        <h2 class="business-name" style="margin: 0;font-size:15px;">
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
                        <h2 class="receipt-title">REFUND RECEIPT</h2>
                    </td>
                    <td style="width: 50%;">
                        <div class="receipt-info">


                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%; text-align:right;">
                                            <p class="sales-number">Refund #
                                            </p>
                                            <p class="receipt-date">DATE
                                            </p>
                                        </td>
                                        <td style="text-align:left;">
                                            <p class="sales-number">
                                                <span><?=$refund_number?></span>
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
                <h2 style="font-size:15px;">Bill To</h2>
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
                        <p class="note">PLEASE DETACH TOP PORTION AND RETURN WITH YOUR PAYMENT.</p>
                        <p class="cutter"></p>
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
                    <th>RATE</th>
                    <th>AMOUNT</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $subtotal = 0;
                $tax =0;
                $discount =0;
                foreach ($items as $item) {
                    $subtotal+=$item->qty*$item->sri_cost;
                    $tax+=(float)$item->tax;
                    $discount+=$item->discount; ?>
                <tr>
                    <td style="text-align: left;">
                        <?=$item->title?>
                    </td>
                    <td>
                        <?=$item->qty?>
                    </td>
                    <td>
                        <?=number_format($item->sri_cost, 2)?>
                    </td>
                    <td>
                        <?=number_format($item->total, 2)?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div style="margin-bottom: 50px;">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td>
                        <p class="cutter"></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="amount-summary">
        <table style="width: 100%;">
            <tbody>
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 25%;">
                        <p class="sub-total">SUBTOTAL</p>
                        <p class="tax">TAXT </p>
                        <p class="tax">DISCOUNT</p>
                        <p class="adjustment-name">
                            <?=$adjustment_name?>
                        </p>
                        <p class="balance-due" style="padding:10px 0;">GRAND TOTAL </p>
                    </td>
                    <td style="width: 25%;">
                        <p class="amount"><span><?=number_format($subtotal, 2)?></span>
                        </p>
                        <p class="amount"><span><?=number_format($tax, 2)?></span></p>
                        <p class="amount"><span><?=number_format($discount, 2)?></span>
                        </p>
                        <?php
                        if ($adjustment_name != "") {
                            ?>
                        <p class="amount"><span><?=number_format($adjustment_value, 2)?></span>
                        </p>
                        <?php
                        }
                        ?>
                        <p class="balance-due amount"><span>$<?=number_format(($subtotal+$tax)-$discount, 2)?></span>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>