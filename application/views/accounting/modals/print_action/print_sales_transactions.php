<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <?php $count = 1; ?>
    <?php foreach($transactions as $transaction) : ?>
    <?php if($count < count($transactions)) : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always; height: 100%">
    <?php else : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid; height: 100%">
    <?php endif; ?>
    <?php switch($transaction->type) { 
       case 'Invoice' : ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <h2>INVOICE</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="60%"><strong>BILL TO</strong></td>
                            <td style="text-align: right"><strong>INVOICE #</strong></td>
                            <td><?=str_replace($transaction->prefix, '', $transaction->invoice_number)?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td rowspan="2"><?=$transaction->billing_address?></td>
                            <td style="text-align: right"><strong>DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($transaction->date_issued))?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td style="text-align: right"><strong>DUE DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($transaction->due_date))?></td>
                        </tr>
                    </tbody>
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
                        <?php foreach($transaction->items as $invoiceItem) : ?>
                            <tr>
                                <td><?=$invoiceItem->item->title?></td>
                                <td style="text-align: right"><?=intval($invoiceItem->qty)?></td>
                                <td style="text-align: right"><?=number_format(floatval($invoiceItem->cost), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($invoiceItem->discount), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($invoiceItem->tax_amount), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($invoiceItem->total), 2, '.', ',')?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->sub_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->taxes), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">DISCOUNT</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ADJUSTMENT VALUE</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TOTAL</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->grand_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">BALANCE DUE</td>
                            <td style="text-align: right">
                                <strong>
                                    <?php
                                        $amount = '$'.number_format(floatval($transaction->balance), 2, '.', ',');
                                        $amount = str_replace('$-', '-$', $amount);
                                        echo $amount;
                                    ?>
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php break;
    case 'Credit Memo' ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <h2>Credit Memo</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="60%"><strong>CREDIT TO:</strong></td>
                            <td style="text-align: right"><strong>CREDIT #:</strong></td>
                            <td><?=$transaction->ref_no?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td width="60%"><?=$transaction->billing_address?></td>
                            <td style="text-align: right"><strong>DATE:</strong></td>
                            <td><?=date("m/d/Y", strtotime($transaction->credit_memo_date))?></td>
                        </tr>
                    </tbody>
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
                        <?php foreach($transaction->items as $memoItem) : ?>
                            <tr>
                                <td><?=$memoItem->item->title?></td>
                                <td style="text-align: right"><?=intval($memoItem->quantity)?></td>
                                <td style="text-align: right"><?=number_format(floatval($memoItem->price), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($memoItem->discount), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($memoItem->tax_amount), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($memoItem->total), 2, '.', ',')?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->subtotal), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->tax_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">DISCOUNT</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ADJUSTMENT VALUE</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TOTAL CREDIT</td>
                            <td style="text-align: right">
                                <strong>
                                <?php
                                    $total = '$'.number_format(floatval($transaction->total_amount), 2, '.', ',');
                                    echo str_replace('$-', '-$', $total);
                                ?>
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php break;
    case 'Sales Receipt' : ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <h2>SALES RECEIPT</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="60%"><strong>BILL TO:</strong></td>
                            <td style="text-align: right"><strong>SALES #:</strong></td>
                            <td><?=$transaction->ref_no?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td width="60%"><?=$transaction->billing_address?></td>
                            <td style="text-align: right"><strong>DATE:</strong></td>
                            <td><?=date("m/d/Y", strtotime($transaction->sales_receipt_date))?></td>
                        </tr>
                    </tbody>
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
                        <?php foreach($transaction->items as $receiptItem) : ?>
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
                            <td style="text-align: right"><?=number_format(floatval($transaction->subtotal), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->tax_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">DISCOUNT</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ADJUSTMENT VALUE</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">BALANCE DUE</td>
                            <td style="text-align: right"><strong>$0.00</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php break;
    case 'Refund' : ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <h2>REFUND RECEIPT</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody style="border-bottom: 1px solid black">
                        <tr>
                            <td width="60%"><strong>REFUND TO:</strong></td>
                            <td style="text-align: right"><strong>REFUND NO.</strong></td>
                            <td><?=$transaction->ref_no?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td width="60%"><?=$transaction->billing_address?></td>
                            <td style="text-align: right"><strong>REFUND DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($transaction->refund_receipt_date))?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>PMT METHOD</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><?=$transaction->payment_method->name?></td>
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
                        <?php foreach($transaction->items as $receiptItem) : ?>
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
                            <td style="text-align: right"><?=number_format(floatval($transaction->subtotal), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->tax_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">DISCOUNT</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">ADJUSTMENT VALUE</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td colspan="2">AMOUNT REFUNDED</td>
                            <td style="text-align: right">
                                <strong>
                                <?php
                                    $total = '$'.number_format(floatval($transaction->total_amount), 2, '.', ',');
                                    echo str_replace('$-', '-$', $total);
                                ?>
                                </strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    <?php break;
    } ?>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</body>
</html>