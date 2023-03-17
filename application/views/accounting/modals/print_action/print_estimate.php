<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid; height: 100%; border: 1px solid black">
        <table style="padding-top:-40px; width: 100%; border: 1px solid red">
            <tr>
                <td>
                    <h5><span class="fa fa-user-o"></span> From <br/><span><?=$client->business_name?></span></h5>
                    <br />
                    <span style="font-size:12px;"><?=$client->business_address?></span><br />
                    <span style="font-size:12px;">EMAIL: <?=$client->email_address?></span><br />
                    <span style="font-size:12px;">PHONE: <?=$client->phone_number?></span>
                    <br/><br /><br />
                    <h5><span class="fa fa-user-o"></span> To <br/><span><?=$customer->first_name . ' ' .$customer->last_name?></span></h5>
                    <br />
                    <span style="font-size:12px;"><?=$customer->mail_add. " " .$customer->city?></span><br />
                    <span style="font-size:12px;">EMAIL: <?=$customer->email?></span><br />
                    <span style="font-size:12px;">PHONE: <?=$customer->phone_w?></span>
                </td>
                <td colspan=1></td>
                <td style="text-align:right;">
                    <h5 style="font-size:20px;margin:0px;">ESTIMATE <br /><small style="font-size: 10px;">#<?=$estimate->estimate_number?></small></h5>
                    <br />
                    <table>
                        <tr>
                        <td>Estimate Date :</td>
                        <td><?=date("F d, Y", strtotime($estimate->estimate_date))?></td>
                        </tr>
                        <tr>
                        <td>Expire Due :</td>
                        <td><?=date("F d, Y", strtotime($estimate->expiry_date))?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br /><br /><br />

        <table style="width: 100%">
            <thead>
                <tr>
                    <th style="width:5%;"><b>#</b></th>
                    <th style="width:35%;"><b>Items</b></th>
                    <th style="width:12%;"><b>Item Type</b></th>
                    <th style="width:12%;text-align: right;"><b>Qty</b></th>
                    <th style="width:12%;text-align: right;"><b>Price</b></th>
                    <th style="width:12%;text-align: right;"><b>Discount</b></th>
                    <th style="width:12%;text-align: right;"><b>Total</b></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_amount = 0;
                $total_tax = 0;
                $row = 1;
                foreach ($estimateItems as $item) : ?>
                <tr>
                    <td valign="top" style="width:5%;"><?=$row?></td>
                    <td valign="top" style="width:35%;"><?=$item->title?></td>
                    <td valign="top" style="width:12%;"><?=$item->type?></td>
                    <td valign="top" style="width:12%;text-align: right;"><?=$item->qty?></td>
                    <td valign="top" style="width:12%;text-align: right;"><?=number_format($item->iCost, 2)?></td>
                    <td valign="top" style="width:12%;text-align: right;"><?=number_format($item->discount, 2)?></td>
                    <td valign="top" style="width:12%;text-align: right;"><?=number_format($item->iTotal, 2)?></td>
                </tr>
                <?php
                $row++;
                $total_amount += $item->iTotal;
                endforeach;
                ?>
                <tr><br><br>
                    <td colspan="6" style="text-align: right;"><b>Subtotal</b></td>
                    <td style="text-align: right;"><b>$<?=number_format($estimate->sub_total, 2)?></b></td>
                    </tr>
                    <tr>
                    <td colspan="6" style="text-align: right;"><b>Taxes</b></td>
                    <td style="text-align: right;"><b>$<?=number_format($estimate->tax1_total, 2)?></b></td>
                    </tr>
                    <tr>
                    <td colspan="6" style="text-align: right;"><b><?=$estimate->adjustment_name?></b></td>
                    <td style="text-align: right;"><b>$<?=number_format($estimate->adjustment_value, 2)?></b></td>
                    </tr>
                    <tr>
                    <td colspan="6" style="text-align: right;"><b>Grand Total</b></td>
                    <td style="text-align: right;"><b>$<?=number_format($total_amount, 2)?></b></td>
                </tr>
            </tbody>
        </table>
        <br /><br /><br />
        <p><b>Instructions</b><br /><br /><?=$estimate->instructions?></p>
        <p><b>Message</b><br /><br /><?=$estimate->customer_message?></p>
        <p><b>Terms</b><br /><Br /><?=$estimate->terms_conditions?></p>
    </div>
</body>
</html>