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
                <h2>REFUND RECEIPT</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody style="border-bottom: 1px solid black">
                        <tr>
                            <td width="60%"><strong>REFUND TO:</strong></td>
                            <td style="text-align: right"><strong>REFUND NO.</strong></td>
                            <td><?=$refundReceipt->ref_no?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td width="60%"><?=$refundReceipt->billing_address?></td>
                            <td style="text-align: right"><strong>REFUND DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($refundReceipt->refund_receipt_date))?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>PMT METHOD</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?=$paymentMethod->name?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th style="text-align: left" width="30%">ACTIVITY</th>
                            <th style="text-align: right">QTY</th>
                            <th style="text-align: right">RATE</th>
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
                            <td style="text-align: right"><?=number_format(floatval($refundReceipt->subtotal), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($refundReceipt->tax_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">DISCOUNT</td>
                            <td style="text-align: right"><?=number_format(floatval($refundReceipt->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ADJUSTMENT VALUE</td>
                            <td style="text-align: right"><?=number_format(floatval($refundReceipt->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">AMOUNT REFUNDED</td>
                            <td style="text-align: right">
                                <strong>
                                <?php
                                    $total = '$'.number_format(floatval($refundReceipt->total_amount), 2, '.', ',');
                                    echo str_replace('$-', '-$', $total);
                                ?>
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>