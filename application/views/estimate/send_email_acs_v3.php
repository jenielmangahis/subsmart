<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Work Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
    @media (max-width: 550px) {
        a {
            min-width: 80% !important;
        }
    }

    body {
        color: black;
        font-size: 10px;
    }

    table {
        font-size: 10px;

    }

    .container {
        width: 100%;
    }

    .flex {
        display: flex;
    }

    .sameRow {
        /* border: 2px solid black; */
        height: 40px;
        width: 100%;
    }

    .normal {
        height: 40px;
        border: 2px solid red;
    }

    /* table { 
            width: 750px; 
            border-collapse: collapse; 
            margin:50px auto;
            }

        tr:nth-of-type(odd) { 
            background: #eee; 
            }

        th { 
            background: #3498db; 
            color: white; 
            font-weight: bold; 
            }

        td, th { 
            padding: 10px; 
            border: 1px solid #ccc; 
            text-align: left; 
            font-size: 18px;
            } */

    /* 
        Max width before this PARTICULAR table gets nasty
        This query will take effect for any screen smaller than 760px
        and also iPads specifically.
        */
    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {

        table {
            width: 100%;
        }

        /* Force table to not be like tables anymore */
        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        /* Hide table headers (but not display: none;, for accessibility) */
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
        }

        td {
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
        }

        td:before {
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            /* Label the data */
            content: attr(data-column);

            color: #000;
            font-weight: bold;
        }

    }

    span.invoice-txt {
        color: #45a6ff;
    }
    </style>
</head>

<body style="font-family: helvetica; font-size: 10px">
    <div
        style="box-shadow:0 2px 8px 0 rgba(0,0,0,.2);background-color: #fff;border: 1px solid #d4d7dc;-webkit-transition: all .3s ease;position:relative;top:20px;width: 95%;margin: 0 auto;">
        <div>
            <div>
                <div>
                    <div style="padding: 20px;">
                        <div style="padding: 10px;">
                            <div class="">
                                <div id="printableArea">
                                    <div style="display:flex;align-items: start; justify-content:space-between">
                                        <div style="margin-bottom: 10px;margin-left: 0px !important;margin-top:50px;">
                                            <!-- <img class="presenter-print-logo" style="max-width: 230px; max-height: 200px;" src="http://nsmartrac.com/assets/dashboard/images/logo.png"> -->
                                            <img src="<?php echo getCompanyBusinessProfileImage(); ?>"
                                                style="max-width: 230px; max-height: 200px;" />
                                        </div>

                                        <div class="col-xl-5 right" style="float: right">
                                            <div style="text-align: right;">
                                                <h5 style="font-weight:bold;color:#6a4a86 ;font-size:20px;margin:0px;">
                                                    ESTIMATE</h5>
                                                <small
                                                    style="color:#6a4a86;font-size: 10px; font-weight:bold">#<?php echo $estimate_number; ?></small>
                                            </div>
                                            <div class="" style="float: right;margin-top: 20px;">
                                                <table style="text-align: right;  font-size: 10px">
                                                    <tr>
                                                        <td style="text-align: right;">Estimate Date: &emsp;</td>
                                                        <td><?php echo date('F d, Y', strtotime($estimate_date)); ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align: right;">Expiry Date: &emsp;</td>
                                                        <td><?php echo date('F d, Y', strtotime($expiry_date)); ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        style="display:flex;align-items:start;justify-content: space-between; margin-top: 50px">
                                        <div class="col-xl-5 left" style="margin-bottom: 33px;">
                                            <span class="fa fa-user-o fa-margin-right"
                                                style="font-weight:400;font-size: 10px"></span> From <br> <span
                                                style="font-size:12px;font-weight: 700">
                                                <?php echo $company; ?></span><br />
                                            <!-- <div class="col-xl-5 ml-0 pl-0"> -->
                                            <span class=""><?php echo $business_address; ?></span><br />
                                            <span class="">EMAIL: <?php echo $email_address; ?></span><br />
                                            <span class="">PHONE: <?php echo $phone_number; ?></span>
                                            <!-- </div> -->
                                        </div>
                                        <div class="col-xl-5 left" style="text-align: right">
                                            <span class="fa fa-user-o fa-margin-right"
                                                style="font-weight:400;font-size: 10px"></span> To <br> <span
                                                style="font-size:12px;font-weight: 700">
                                                <?php echo $acs_name; ?></span><br />
                                            <!-- <div class="col-xl-5 ml-0 pl-0"> -->
                                            <span class=""><?php echo $acsaddress; ?></span><br />
                                            <span class="">EMAIL: <span class=""><?php echo $acsemail; ?></span><br />
                                                <span class="">PHONE: <span
                                                        class=""><?php echo $phone_m; ?></span><br />
                                        </div>
                                    </div>
                                    <br class="clear" />
                                    <?php $grandTotal = 0; ?>
                                    <table class="table-print table-items"
                                        style="width: 100%; border-collapse: collapse;margin-top: 20px;">
                                        <thead>
                                            <tr>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0; width:5%">
                                                    #
                                                </th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start; padding: 5px 0; width:35%;">
                                                    Items
                                                </th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Item
                                                    Type</th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Price</th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Qty
                                                </th>
                                                <th
                                                    style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 0;width:12%">
                                                    Discount</th>
                                                <th style="background: #6a4a86;color: #fff; text-align: start;  padding: 5px 8px 5px 0;width:12%"
                                                    class="text-right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <tbody>
                                            <?php if ($estimate_type == 'Option') { ?>
                                            <tr>
                                                <td colspan="7" style="padding:15px;">
                                                    <b>Option 1</b>
                                                </td>
                                            </tr>
                                            <?php foreach ($items_dataOP1 as $itemData1) { ?>
                                            <tr>
                                                <td valign="top" style="width:5%; text-align:start;"></td>
                                                <td valign="top" style="width:35%;"><?php echo $itemData1->title; ?>
                                                </td>
                                                <td valign="top" style="width:12%;"><?php echo $itemData1->type; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemData1->costing, 2); ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData1->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemData1->discount; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemData1->total, 2); ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h5 style="font-size: 10px"><b>Option 1 Message</b></h5>
                                                    <p><?php echo $option_message; ?></p>
                                                </td>
                                                <td colspan="2">
                                                </td>
                                                <td colspan="4">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $sub_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $tax1_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td style="text-align: start; background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $option1_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $option1_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td colspan="7" style="padding:15px;">
                                                    <div style="margin-top:20px"></div><b>Option 2</b>
                                                </td>
                                            </tr>
                                            <?php foreach ($items_dataOP2 as $itemData2) { ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"></td>
                                                <td valign="top" style="width:35%;;"><?php echo $itemData2->title; ?>
                                                </td>
                                                <td valign="top" style="width:12%;"><?php echo $itemData2->type; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo number_format((float) $itemData2->costing, 2); ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData2->qty; ?></td>
                                                <td valign="top" style="width: 12%%; text-align: start;">
                                                    <?php echo $itemData2->discount; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo number_format((float) $itemData2->total, 2); ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h5 style="font-size: 10px"><b>Option 2 Message</b></h5>
                                                    <p><?php echo $option2_message; ?></p>

                                                </td>
                                                <td colspan="2">
                                                </td>
                                                <td colspan="4">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td colspan="2" style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $sub_total2, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $tax2_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td style="text-align: start; background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $option2_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $option2_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 12px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 12px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>

                                                </td>
                                                <td colspan="2">
                                                </td>
                                                <td colspan="4">
                                                    <table style="width:100%">
                                                        <tr style="text-align:center">
                                                            <td colspan='5'>
                                                                <div style="margin-top: 60px">
                                                                    <p style="text-align:center">Powered By:</p>
                                                                    <img src="<?php echo base_url('assets/images/v2/logo.png'); ?>"
                                                                        style="width: 100%">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div style="margin-top: 40px;text-align: center">
                                                        <h5 style="font-size: 12px"><b>Instructions</b></h5>
                                                        <?php if (!empty($instructions)) { ?>
                                                        <p><?php echo $instructions; ?>
                                                            <?php } else {
                                                                $output = 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.';
                                                                echo $output;
                                                            } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px;text-align: start">
                                                        <h5 style="font-size:12px: font-weight: 700">Would you like to
                                                            proceed with accepting the estimate? </h5>
                                                        <div style="margin-top:20px;text-align: center">
                                                            <a href="<?php echo $urlDecline; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #d9534f;line-height: 1.15;font-size: 16px;text-decoration:none;">Reject</a>
                                                            <a href="<?php echo $urlApprove; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #5cb85c;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>



                                            <?php } elseif ($estimate_type == 'Bundle') { ?>

                                            <tr>
                                                <td colspan="7" style="padding:15px;"><b>Bundle 1</b></td>
                                            </tr>
                                            <?php foreach ($items_dataBD1 as $itemDatabd1) { ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"></td>
                                                <td valign="top" style="width:35%;">
                                                    <?php echo $itemDatabd1->title; ?>
                                                </td>
                                                <td valign="top" style="width:12%;"><?php echo $itemDatabd1->type; ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemDatabd1->costing, 2); ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemDatabd1->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemDatabd1->discount; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemDatabd1->total, 2); ?>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h5 style="font-size: 10px"><b>Bundle 1 Message</b></h5>
                                                    <p><?php echo $bundle1_message; ?></p>

                                                </td>
                                                <td colspan="2">
                                                </td>
                                                <td colspan="4">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td colspan="2" style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $sub_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $tax1_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td style="text-align: start; background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $bundle1_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $bundle1_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>

                                            </tr>



                                            <tr>

                                                <td colspan="7" style="padding:15px;">
                                                    <div style="margin-top:20px"></div><b>Bundle 2</b>
                                                </td>
                                            </tr>
                                            <?php foreach ($items_dataBD2 as $itemDatabd2) { ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"></td>
                                                <td valign="top" style="width:35%;"><?php echo $itemDatabd2->title; ?>
                                                </td>
                                                <td valign="top" style="width:12%;"><?php echo $itemDatabd2->type; ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemDatabd2->costing, 2); ?>
                                                </td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemDatabd2->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.$itemDatabd2->discount; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo '$ '.number_format((float) $itemDatabd2->total, 2); ?>
                                                </td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <h5 style="font-size: 10px"> <b>Bundle 2 Message</b></h5>
                                                    <p><?php echo $bundle2_message; ?></p>

                                                </td>
                                                <td colspan="2">

                                                </td>
                                                <td colspan="4">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $sub_total2, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $tax2_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <b>Grand Total</b>
                                                            </td>
                                                            <td style="text-align: start; background-color: #dad1e0;">
                                                                <b>$
                                                                    <?php echo number_format((float) $bundle2_total, 2); ?></b>
                                                            </td>
                                                            <?php $grandTotal = (float) $bundle2_total; ?>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                Deposit Amount Requested
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <?php
                                                            $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 12px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 12px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>

                                                </td>
                                                <td colspan="2">
                                                </td>
                                                <td colspan="4">
                                                    <table style="width:100%">
                                                        <tr style="text-align:center">
                                                            <td colspan='5'>
                                                                <div style="margin-top: 60px">
                                                                    <p style="text-align:center">Powered By:</p>
                                                                    <img src="<?php echo base_url('assets/images/v2/logo.png'); ?>"
                                                                        style="width: 100%">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                <td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div style="margin-top: 40px;text-align: center">
                                                        <h5 style="font-size: 12px"><b>Instructions</b></h5>
                                                        <?php if (!empty($instructions)) { ?>
                                                        <p><?php echo $instructions; ?>
                                                            <?php } else {
                                                                $output = 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.';
                                                                echo $output;
                                                            } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px;text-align: start">
                                                        <h5 style="font-size:12px: font-weight: 700">Would you like to
                                                            proceed with accepting the estimate? </h5>
                                                        <div style="margin-top:20px;text-align: center">
                                                            <a href="<?php echo $urlDecline; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #d9534f;line-height: 1.15;font-size: 16px;text-decoration:none;">Reject</a>
                                                            <a href="<?php echo $urlApprove; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #5cb85c;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>



                                            <?php } else { ?>
                                            <?php foreach ($items as $itemData) { ?>
                                            <tr class="table-items__tr">
                                                <td valign="top" style="width:5%; text-align:start;"></td>
                                                <td valign="top" style="width:35%;"><?php echo $itemData->title; ?></td>
                                                <td valign="top" style="width:12%;"><?php echo $itemData->type; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo number_format((float) $itemData->iCost, 2); ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData->qty; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo $itemData->discount; ?></td>
                                                <td valign="top" style="width: 12%; text-align: start;">
                                                    <?php echo number_format((float) $itemData->iTotal, 2); ?></td>
                                            </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="7">
                                                    <hr />
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2">
                                                    <div>
                                                        <h5 style="font-size: 12px"><b>Message</b></h5>
                                                        <p><?php if (!empty($customer_message)) {
                                                            echo $customer_message;
                                                        } else {
                                                            $output = 'If you have any questions or need more information, feel free to contact us at <b style="font-size: 10px; color:#6a4a86">'.formatPhoneNumber($business->phone_number).'';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px">
                                                        <h5 style="font-size: 12px"><b>Terms</b></h5>
                                                        <p><?php if (!empty($terms_conditions)) {
                                                            echo $terms_conditions;
                                                        } else {
                                                            $output = 'This document is strictly <span style="color:#6a4a86">private, confidential </span> and <span style="color:#6a4a86">personal</span> to its recipients and should not be copied, distributed, or reproduced in whole or in part, nor passed to any third party.  This estimate is based on available information at the time of estimation and is subject to change based on unforeseen circumstances or additional requirements.';
                                                            echo $output;
                                                        } ?></p>
                                                    </div>

                                                </td>
                                                <td colspan="2">
                                                </td>
                                                <td colspan="4">
                                                    <table style="width: 100%">
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Subtotal</p>
                                                            </td>
                                                            <td style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $sub_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Taxes</p>
                                                            </td>
                                                            <td colspan="2" style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $tax1_total, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Discount</p>
                                                            </td>
                                                            <td colspan="2" style="text-align: start;">
                                                                <p>$ <?php echo number_format((float) $adjustment_value, 2); ?>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <p><b>Grand Total</b></p>
                                                            </td>
                                                            <td colspan="2"
                                                                style="text-align: start; background-color: #dad1e0;">
                                                                <p><b>$
                                                                        <?php echo number_format((float) $grand_total, 2); ?></b>
                                                                </p>
                                                            </td>
                                                            <?php $grandTotal = (float) $grand_total; ?>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="4" style="text-align: start;">
                                                                <p>Deposit Amount Requested</p>
                                                            </td>
                                                            <td colspan="2" style="text-align: start;">
                                                                <?php
                                                                        $depositAmount = 0;
                                                $percentage = null;
                                                $isPercentage = in_array(trim($deposit_request), ['2', '%']); // 1 = $, 2 = %

                                                if ($isPercentage) {
                                                    $percentage = (float) $deposit_amount;
                                                    $depositAmount = ($percentage / 100) * $grandTotal;
                                                } else {
                                                    $depositAmount = (float) $deposit_amount;
                                                }
                                                ?>
                                                                $
                                                                <?php echo number_format((float) $depositAmount, 2); ?>
                                                                <?php if ($isPercentage) { ?>
                                                                (<?php echo $percentage; ?>%)
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <tr style="text-align:center">
                                                            <td colspan='5'>
                                                                <div style="margin-top: 60px">
                                                                    <p style="text-align:center">Powered By:</p>
                                                                    <img src="<?php echo base_url('assets/images/v2/logo.png'); ?>"
                                                                        style="width: 100%">
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </table>

                                                <td>

                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <div style="margin-top: 20px;text-align: center">
                                                        <h5 style="font-size: 12px"><b>Instructions</b></h5>
                                                        <?php if (!empty($instructions)) { ?>
                                                        <p><?php echo $instructions; ?>
                                                            <?php } else {
                                                                $output = 'The following estimate request is being submitted for your approval.  Keep in mind, materials costs are subject to change and cannot be guaranteed until approval is received and your order is processed.';
                                                                echo $output;
                                                            } ?></p>
                                                    </div>
                                                    <div style="margin-top: 20px;text-align: start">
                                                        <h5 style="font-size:12px: font-weight: 700">Would you like to
                                                            proceed with accepting the estimate? </h5>
                                                        <div style="margin-top:20px;text-align: center">
                                                            <a href="<?php echo $urlDecline; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #d9534f;line-height: 1.15;font-size: 16px;text-decoration:none;">Reject</a>
                                                            <a href="<?php echo $urlApprove; ?>"
                                                                style="display: inline-block;outline: none;cursor: pointer;font-weight: 600;border-radius: 3px;padding: 12px 35px;border: 0;color: #fff;background: #5cb85c;line-height: 1.15;font-size: 16px;text-decoration:none;">Accept
                                                            </a>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <br />




                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <img src="<?php echo base_url('tracker/estimate_image_tracker?id='.$eid); ?>"> -->
        <!-- <br> &emsp; -->
        <br></br>
    </div>
</body>

</html>