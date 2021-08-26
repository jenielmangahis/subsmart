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
            color: #4E91BA;
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
            border: solid 1px #5998BF;
            margin: 30px 0;
        }

        .cutter-dashed {
            border: dashed 1px #333333;
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
        }

        .items-table table thead tr th,
        .items-table table tbody tr td {
            text-align: right;
            font-size: 13px;
        }

        .items-table table thead tr th {
            color: #4E91BA;
        }

        .items-table table thead tr {
            background-color: #DBE9F1;
        }

        .text-left {
            text-align: left;
        }

        h2 {
            font-size: 15px;
        }

        .overlay-status {
            position: absolute;
            top: 300px;
            z-index: 1;
        }

        .overlay-status h1.Open {
            color: #F2B835;
        }

        .overlay-status h1.Paid {
            color: #2BA01D;
        }

        .overlay-status h1.Overdue {
            color: #CD5133;
        }

        .overlay-status h1 {
            font-size: 70px;
            text-transform: uppercase;
            text-align: center;
            transform: rotate(-60deg);
            opacity: 0.3;
        }

        p {
            font-size: 11px;
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 0;
        }

        table td {
            vertical-align: top;
            padding: 0;
            font-size: 11px;
        }

        table th {
            font-size: 12px;
            font-weight: bold;
        }

        p.large-text {
            font-size: 15px;
            font-weight: bold;
        }

        p.with-border {
            border: solid 1px #000;
            padding-top: 10px;
        }

        table.with-border td,
        td.with-border {
            border: solid 1px #000;
            padding-top: 15px;
            text-align: center;
            font-size: 11px;
            margin: 2px;
        }

        table {
            border-collapse: collapse;
        }

        table.with-border th {
            border: solid 1px #000;
            padding: 0 10px;
            text-align: center;
            font-size: 11px;
        }

        table.above-items th {
            text-align: center;
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        td {
            vertical-align: top;
        }

        table.item-list thead th {
            border: solid 1px #A0A09F;
        }

        table.item-list tbody td {
            border: solid 1px #A0A09F;
            padding: 5px 10px;
        }

        table.item-list tbody td.no-border {
            border: none !important;
        }

        .color-red {
            color: red;
        }

        .color-blue {
            color: blue;
        }

        .extra-large-text {
            font-size: 25px;
            font-weight: bold;
        }
    </style>

</head>

<body>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 50%;">
                    <table style="width:100%">
                        <tbody>
                            <tr>
                                <td style="width: 130px;">
                                    <img src="<?=base_url($business_logo)?>"
                                        alt="">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="address">P.O. BOX 731340 <br>DALLAS, TX 75373-1340</p>
                    <br><br>
                    <p class="address">ADI SMART HOME <br>9175 KINGS COLONY ROAD <br>JACKSONVILLE, FL
                        32257</p>
                </td>
                <td style="width: 50%;">
                    <table style="width: 100%;">
                        <td style="width: 50%; padding-right:10px;">
                            <p class="large-text">ORIGINAL INVOICE</p>
                            <p>CUSTOMER NUMBER<br>PLEASE WRITE THIS NUMBER<br>ON ALL ORDERS AND
                                CHECKS</p>
                            <p class="with-border text-center">DP311-000</p>
                        </td>
                        <td style="width: 50%;">
                            <table class="with-border" style="width: 100%; ">
                                <thead>
                                    <tr>
                                        <th>PAGE</th>
                                        <th>INVOICE DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>08/20/21</td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="with-border" style="width: 100%;margin-top:2px;">
                                <thead>
                                    <tr>
                                        <th>INVOICE NUMBER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Z8SJX801</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </table>
                    <table style="width: 100%;">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding-right:20px;">
                                    <p class="text-right bold">PLEASE PAY THIS AMMOUNT</p>
                                </td>
                                <td class="with-border" style="width: 50%;">
                                    0.00
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 50%; padding-right:20px;">
                                    <p class="text-right bold">DUE DATE</p>
                                </td style="width: 50%;">
                                <td class="with-border">
                                    08/20/21
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-right:20px;">
                                    <p class="large-text">REMIT TO:</p>
                                    <p>ADEMCO INC., DBA ADI<br>P.O. BOX 731340<br>DALLAS, TX 75373-1340</p>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                        <table style="width: 100%;margin-top:10px;">
                            <tbody>
                                <tr>
                                    <td style="width:20%">
                                    </td>
                                    <td>
                                        <p>TEL: (800) 545-6776 EXT: 5306<br>FAX: (302) 689-4996</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </table>
                </td>
            </tr>
            <tr>
                <td
                    style="border-bottom:dashed 1px #000; padding-top:10px;font-size: 10px; font-weight:bold; text-align:center;padding-bottom:5px;">
                    Please detach and enclose top portion with your payment
                </td>
                <td
                    style="border-bottom:dashed 1px #000; padding-top:10px;font-size: 10px; font-weight:bold; text-align:center;padding-bottom:5px;">
                    Make check payable and remit to above address
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;margin-top:10px;">
        <tbody>
            <tr>
                <td style="width: 130px;">
                    <img src="<?=base_url($business_logo)?>" alt="">
                </td>
                <td>
                    <table class="above-items" style="width:100%;">
                        <thead>
                            <tr>
                                <th>CUSTOMER NUMBER</th>
                                <th>INVOICE NUMBER</th>
                                <th>DATE</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="with-border" style="width: 25%;">
                                    DP311-000
                                </td>
                                <td class="with-border" style="width: 25%;">
                                    Z8SJX801
                                </td>
                                <td class="with-border" style="width: 25%;">
                                    08/20/21
                                </td>
                                <td style="width: 25%;">
                                    <p class="bold" style="padding-left: 10px;">
                                        Retain this portion <br>for your records
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="item-list" style="width: 100%; margin-top:10px">
        <thead>
            <tr>
                <th style="width: 50%;">SHIP DATA/ITEM DESCRIPTIONS</th>
                <th>CATALOG <br>NUMBER</th>
                <th>QTY <br>SHIPPED</th>
                <th>UNIT PRICE</th>
                <th>AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="height: 240px;">
                    <p style="height: 80px;">
                        SHIP FROM: DALLAS &nbsp;&nbsp;&nbsp;TO: PENSACOLA, FL<br>
                        &nbsp;&nbsp;ADI SMART HOME BRANNON NGUYEN<br>
                        &nbsp;&nbsp;6866 PINE FOREST ROAD B<br>
                        &nbsp;&nbsp;PENSACOLA, FL 32526 <br>
                        SHIP VIA: UPS GROUND
                    </p>
                    <p>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8CH 1080P TVI KIT 6 CAMS2.8 2T
                    </p>
                </td>
                <td>
                    <p style="height: 80px;"></p>
                    <p>
                        BX-A91E6282T
                    </p>
                </td>
                <td>
                    <p style="height: 80px;"></p>
                    <p>
                        1
                    </p>
                </td>
                <td>
                    <p style="height: 80px;"></p>
                    <p>
                        414.99
                    </p>
                </td>
                <td>
                    <p style="height: 80px;"></p>
                    <p>
                        414.99
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="5" class="no-border">
                    <p>REC-VISA #---------4699 414.99<br>
                        P A I D I N F U L L<br>
                        E-CHECK NOW AVAILABLE. CONTACT YOUR ADI CREDIT ANALYST. SIGN UP FOR E-INVOICING GO TO:<br>
                        ADIGLOBAL.COM/GOGREEN
                    </p>
                </td>
                <td colspan="2">
                    RORAL MATERIAL
                </td>
                <td>414.99</td>
            </tr>
            <tr>
                <td colspan="2">
                    SALES TAX
                </td>
                <td>0</td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="bold">SHIPPING & HANDLING</p>
                </td>
                <td>0</td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="large-text">TOTAL INVOICE</p>
                </td>
                <td>414.99</td>
            </tr>
            <tr>
                <td colspan="2">
                    <p class="bold">DUE DATE</p>
                </td>
                <td>08/20/21</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tbody>
            <tr>
                <td style="width: 100%">
                    <p class="extra-large-text color-red" style="width: 80%; text-align:left; padding-left:50px;">THANK
                        YOU FOR YOUR
                        ORDER</p>
                </td>
            </tr>
            <tr>
                <td style="width: 100%">
                    <p class="bold" style="font-size: 10px;">
                        All claims must be made within 5 days after receipt of goods. Goods returned without our
                        authorized return number on the carton will be refused. <br>The purchase of products and
                        services
                        from ADI are subject to and governed solely by the Terms and Conditions available at<br>
                        <span class="color-blue">https://www.adiglobaldistribution.us/TermsAndConditionsPage</span> <br>
                        <span class="color-red">Past due balances may be subject to a Late Charge not to exceed 1.5% per
                            month.</span>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>


    <table style="width: 100%;page-break-before: always;">
        <tbody>
            <tr>
                <td style="width: 60%;">
                    <div class="business-info">
                        <h2 class="business-name" style="margin: 0;font-size: 15px;">
                            <?=$business_name?>
                        </h2>
                        <p class="address-strees" style="margin: 0;">
                            <?=$business_email?>
                        </p>
                        <p class="address-state">
                            <?=$business_website?>
                        </p>
                    </div>
                </td>
                <td style="width: 40%;">
                    <div class="business-logo">
                        <img src="<?=base_url($business_logo)?>"
                            alt="">
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
                        <h2 class="receipt-title">Packaging Slip</h2>
                    </td>
                    <td style="width: 50%;">

                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td style="vertical-align:top;">
                            <div class="customer-info">
                                <h2 style="font-size: 15px;">BILL To</h2>
                                <p class="customer-name"><?=$customer_name?>
                                </p>
                            </div>
                        </td>
                        <td style="vertical-align:top;">
                            <div class="receipt-info-section">
                                <div class="receipt-info">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 50%; text-align:right;">
                                                    <p class="sales-number">INVOICE #
                                                    </p>
                                                    <p class="receipt-date">DATE
                                                    </p>
                                                </td>
                                                <td style="text-align:left;">
                                                    <p class="sales-number">
                                                        <span><?=$invoice_no?></span>
                                                    </p>
                                                    <p class="receipt-date">
                                                        <span><?=date("m/d/Y", strtotime($invoice_date))?></span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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

    <div class="items-table">
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">Description</th>
                    <th style="text-align: center;">QTY</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($invoice_items as $item) {
                        ?>
                <tr>
                    <td style="text-align: left;">
                        <?=$item->title?>
                    </td>
                    <td style="text-align: center;">
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