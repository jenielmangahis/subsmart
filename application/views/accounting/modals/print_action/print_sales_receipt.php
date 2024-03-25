<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid; height: 100%">
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <h2>SALES RECEIPT</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="60%"><strong>BILL TO:</strong></td>
                            <td style="text-align: right"><strong>SALES #:</strong></td>
                            <td>
                                <?php
                                    if($salesReceipt->ref_no != null && $salesReceipt->ref_no != 0) {
                                        echo $salesReceipt->ref_no;
                                    } else {
                                        echo '-';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td width="60%"><?=$salesReceipt->billing_address?></td>
                            <td style="text-align: right"><strong>DATE:</strong></td>
                            <td><?=date("m/d/Y", strtotime($salesReceipt->sales_receipt_date))?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th style="text-align: left" width="30%">ITEM</th>
                            <th style="text-align: right">QTY</th>
                            <th style="text-align: right">PRICE</th>
                            <th style="text-align: right">DISCOUNT</th>
                            <th style="text-align: right">TAX AMOUNT</th>
                            <th style="text-align: right">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody style="border-bottom: 1px dotted gray">
                        <?php foreach($receiptItems as $receiptItem) : ?>
                            <tr>
                                <td><?=$receiptItem->item->title?></td>
                                <td style="text-align: right"><?=intval($receiptItem->quantity)?></td>
                                <td style="text-align: right"><?=number_format(floatval($receiptItem->price), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($receiptItem->discount), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($receiptItem->tax_amount), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($receiptItem->total), 2, '.', ',')?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td style="text-align: right"><?=number_format(floatval($salesReceipt->subtotal), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($salesReceipt->tax_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">DISCOUNT</td>
                            <td style="text-align: right"><?=number_format(floatval($salesReceipt->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ADJUSTMENT VALUE</td>
                            <td style="text-align: right"><?=number_format(floatval($salesReceipt->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <?php 
                            $total_balance_due = 0;
                            $total_balance_due = $salesReceipt->total_amount //($salesReceipt->subtotal + $salesReceipt->tax_total) - ($salesReceipt->discount_total + $salesReceipt->adjustment_value);
                        ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">BALANCE DUE</td>
                            <td style="text-align: right"><strong>$<?php echo number_format(floatval($total_balance_due), 2, '.', ','); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>