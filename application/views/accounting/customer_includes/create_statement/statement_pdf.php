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
        }

        .items-table table thead tr th,
        .items-table table tbody tr td {
            text-align: right;
            font-size: 13px;
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

        h2 {
            font-size: 15px;
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
                        <h2 class="receipt-title">Statement</h2>
                    </td>
                    <td style="width: 50%;">
                        <div class="receipt-info">


                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="width: 50%; text-align:right;">
                                            <p class="sales-number">STATEMENT NO.
                                            </p>
                                            <p class="receipt-date">DATE
                                            </p>
                                        </td>
                                        <td style="text-align:left;">
                                            <p class="sales-number">
                                                <span><?=$statement_id?></span>
                                            </p>
                                            <p class="receipt-date">
                                                <span><?=date("m/d/Y", strtotime($statement_date))?></span>
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
                <h2 style="font-size: 15px;">To</h2>
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

    <!-- START OF TRANSACTION STATEMENT -->
    <?php if ($statement_type == "Transaction Statement") {
    ?>
    <div class="items-table">

        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">DATE</th>
                    <th style="text-align: left;">ACTIVITY</th>
                    <th>AMOUNT</th>
                    <th>RECEIVED</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_amount_receivable=0;
    $total_amount_received =0;
    foreach ($invoices as $invoice) {
        $received=$this->accounting_invoices_model->get_amount_received_per_invoice($invoice->id);
        $total_amount_receivable+=$invoice->grand_total;
        $total_amount_received+=$received->total_amount; ?>
                <tr>
                    <td style="text-align: left;">
                        <?=date("m/d/Y", strtotime($invoice->date_issued))?>
                    </td>
                    <td style="text-align: left;">
                        <?=$invoice->invoice_number?>
                    </td>
                    <td>
                        <?=number_format($invoice->grand_total, 2, '.', ',')?>
                    </td>
                    <td>
                        <?=number_format($received->total_amount, 2, '.', ',')?>
                    </td>
                </tr>
                <?php
    }
    foreach ($sales_receipts as $receipt) {
        $total_amount_receivable+=$receipt->grand_total;
        $total_amount_received+=$receipt->grand_total; ?>
                <tr>
                    <td style="text-align: left;">
                        <?=date("m/d/Y", strtotime($receipt->sales_receipt_date))?>
                    </td>
                    <td style="text-align: left;">
                        Sales Receipt #<?=$receipt->id?>
                    </td>
                    <td>
                        <?=number_format($receipt->grand_total, 2, '.', ',')?>
                    </td>
                    <td>
                        <?=number_format($receipt->grand_total, 2, '.', ',')?>
                    </td>
                </tr>
                <?php
    } ?>
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
                        <p class="sub-total" style="text-align: right;">TOTAL AMOUNT</p>
                        <p class="amount">
                            $<?=number_format($total_amount_receivable, 2, '.', ',')?>
                        </p>
                    </td>
                    <td style="width: 25%;">
                        <p class="sub-total" style="text-align: right;">TOTAL RECEIVED</p>
                        <p class="amount">
                            $<?=number_format($total_amount_received, 2, '.', ',')?>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END OF TRANSACTION STATEMENT -->
    <?php
} elseif ($statement_type == "Open Item") {
        ?>
    <div class="items-table">

        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">DATE</th>
                    <th style="text-align: left;">ACTIVITY</th>
                    <th>AMOUNT</th>
                    <th>OPEN BALANCE</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $total_amount_receivable=0;
        $total_amount_balance =0;
        $total_amount_due =0;
        $due_amount_0 =0;
        $due_amount_1_30 =0;
        $due_amount_31_60 =0;
        $due_amount_61_90 =0;
        $due_amount_91 =0;
        foreach ($invoices as $invoice) {
            $received=$this->accounting_invoices_model->get_amount_received_per_invoice($invoice->id);
            $total_amount_receivable+=$invoice->grand_total;
            $total_amount_balance+=($invoice->grand_total-$received->total_amount);
            $due_date=date("Y-m-d", strtotime($invoice->due_date));
            if ($due_date < date("Y-m-d")) {
                $total_amount_due+=($invoice->grand_total-$received->total_amount);
                $days_due = round((time() - strtotime($due_date))/(60 * 60 * 24));
                echo round($datediff / (60 * 60 * 24));
                if ($days_due == 0) {
                    $due_amount_0 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 91) {
                    $due_amount_91 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 61) {
                    $due_amount_61_90 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 31) {
                    $due_amount_31_60 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 1) {
                    $due_amount_1_30 += ($invoice->grand_total-$received->total_amount);
                }
            }
            if (($invoice->grand_total-$received->total_amount)>0) {
                ?>
                <tr>
                    <td style="text-align: left;">
                        <?=date("m/d/Y", strtotime($invoice->date_issued))?>
                    </td>
                    <td style="text-align: left;">
                        <?=$invoice->invoice_number.": DUE ".date("m/d/Y", strtotime($invoice->due_date))?>.
                    </td>
                    <td>
                        <?=number_format($invoice->grand_total, 2, '.', ',')?>
                    </td>
                    <td>
                        <?=number_format($invoice->grand_total - $received->total_amount, 2, '.', ',')?>
                    </td>
                </tr>
                <?php
            }
        } ?>
            </tbody>
        </table>
    </div>
    <br>
    <div class="items-table">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">Current<br>Due</th>
                    <th style="text-align: left;">1-30 Days<br>Past Due</th>
                    <th style="text-align: left;">31-60 Days<br>Past Due</th>
                    <th style="text-align: left;">61-90 Days<br>Past Due</th>
                    <th style="text-align: left;">90+ Days<br>Past Due</th>
                    <th>Amount<br>Due</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_0, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_1_30, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_31_60, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_61_90, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_91, 2, '.', ',')?>
                    </td>
                    <td>
                        $<?=number_format($total_amount_due, 2, '.', ',')?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END OF OPEN ITEM -->
    <?php
    } elseif ($statement_type == "Balance Forward") {
        ?>
    <div class="items-table">

        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">DATE</th>
                    <th style="text-align: left;">ACTIVITY</th>
                    <th>AMOUNT</th>
                    <th>BALANCE</th>
                </tr>
            </thead>
            <tbody>
                <?php
        $array_table=array();
        foreach ($print_invoices as $invoice) {
            $due_date=date("Y-m-d", strtotime($invoice->due_date));
            $array_table[]=array(
                "date" => date("m/d/Y", strtotime($invoice->date_issued)),
                "activity" => $invoice->invoice_number,
                "amount"=>$invoice->grand_total,
                "type"=> "Invoice"
            );

            $receive_payments=$this->accounting_invoices_model->get_received_payment_by_invoice($invoice->id);
            if ($receive_payments!=null) {
                $array_table[]=array(
                    "date" => date("m/d/Y", strtotime($receive_payments->payment_date)),
                    "activity" => "Receive Payment #".$receive_payments->receive_payment_id,
                    "amount"=>$receive_payments->amount,
                    "type"=> "Receive Payment"
                );
            }
        }
        foreach ($sales_receipts as $sales) {
            $array_table[]=array(
                "date" => date("m/d/Y", strtotime($sales->sales_receipt_date)),
                "activity" => "Sales Receipt #".$sales->id,
                "amount"=>0,
                "type"=> "Sales Receipt"
            );
        }
        usort($array_table, function ($a, $b) {
            return $a['date'] <=> $b['date'];
        });

        $forward_amount =0;
        for ($i=0;$i<count($array_table);$i++) {
            $sign="";
            if ($array_table[$i]['type'] == "Invoice") {
                $forward_amount += $array_table[$i]['amount'];
            } elseif ($array_table[$i]['type'] == "Receive Payment") {
                $forward_amount -= $array_table[$i]['amount'];
                $sign="-";
            } ?>
                <tr>
                    <td style="text-align: left;">
                        <?=$array_table[$i]['date']?>
                    </td>
                    <td style="text-align: left;">
                        <?=$array_table[$i]['activity']?>.
                    </td>
                    <td>
                        <?=$sign?><?=number_format($array_table[$i]['amount'], 2, '.', ',')?>
                    </td>
                    <td>
                        <?=number_format($forward_amount, 2, '.', ',')?>
                    </td>
                </tr>
                <?php
        } ?>


            </tbody>
        </table>
    </div>
    <br>
    <?php

        $total_amount_due =0;
        $due_amount_0 =0;
        $due_amount_1_30 =0;
        $due_amount_31_60 =0;
        $due_amount_61_90 =0;
        $due_amount_91 =0;
        foreach ($invoices as $invoice) {
            $due_date=date("Y-m-d", strtotime($invoice->due_date));
            if ($due_date < date("Y-m-d")) {
                $received=$this->accounting_invoices_model->get_amount_received_per_invoice($invoice->id);
                $total_amount_due+=($invoice->grand_total-$received->total_amount);
                $days_due = round((time() - strtotime($due_date))/(60 * 60 * 24));
                if ($days_due == 0) {
                    $due_amount_0 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 91) {
                    $due_amount_91 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 61) {
                    $due_amount_61_90 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 31) {
                    $due_amount_31_60 += ($invoice->grand_total-$received->total_amount);
                } elseif ($days_due >= 1) {
                    $due_amount_1_30 += ($invoice->grand_total-$received->total_amount);
                }
            }
        } ?>
    <div class="items-table">
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">Current<br>Due</th>
                    <th style="text-align: left;">1-30 Days<br>Past Due</th>
                    <th style="text-align: left;">31-60 Days<br>Past Due</th>
                    <th style="text-align: left;">61-90 Days<br>Past Due</th>
                    <th style="text-align: left;">90+ Days<br>Past Due</th>
                    <th>Amount<br>Due</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_0, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_1_30, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_31_60, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_61_90, 2, '.', ',')?>
                    </td>
                    <td style="text-align: left;">
                        $<?=number_format($due_amount_91, 2, '.', ',')?>
                    </td>
                    <td>
                        $<?=number_format($total_amount_due, 2, '.', ',')?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- END OF OPEN ITEM -->
    <?php
    } ?>

</body>

</html>