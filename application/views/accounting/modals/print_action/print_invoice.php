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
                <h2>INVOICE</h2>
                <table class="table" style="width: 40%; float: right; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td style="text-align: right"><strong>INVOICE #</strong></td>
                            <td><?=str_replace($invoice_prefix, '', $invoice->invoice_number)?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($invoice->date_issued))?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>DUE DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($invoice->due_date))?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 60%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td><strong>BILL TO</strong></td>
                        </tr>
                        <tr>
                            <td><?=$address?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th>ACTIVITY</th>
                            <th>QTY</th>
                            <th>RATE</th>
                            <th>DISCOUNT</th>
                            <th>TAX AMOUNT</th>
                            <th>AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($invoiceItems as $invoiceItem) : ?>
                            <tr>
                                <td><?=$invoiceItem->item->title?></td>
                                <td><?=$invoiceItem->qty?></td>
                                <td><?=number_format(floatval($invoiceItem->cost), 2, '.', ',')?></td>
                                <td><?=number_format(floatval($invoiceItem->discount), 2, '.', ',')?></td>
                                <td><?=number_format(floatval($invoiceItem->tax_amount), 2, '.', ',')?></td>
                                <td><?=number_format(floatval($invoiceItem->total), 2, '.', ',')?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>SUBTOTAL</td>
                            <td></td>
                            <td><?=number_format(floatval($invoice->sub_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TAX</td>
                            <td></td>
                            <td><?=number_format(floatval($invoice->taxes), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>DISCOUNT</td>
                            <td></td>
                            <td><?=number_format(floatval($invoice->discount_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>ADJUSTMENT VALUE</td>
                            <td></td>
                            <td><?=number_format(floatval($invoice->adjustment_value), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>TOTAL</td>
                            <td></td>
                            <td><?=number_format(floatval($invoice->grand_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>BALANCE DUE</td>
                            <td></td>
                            <td>
                                <strong>
                                    <?php
                                        $amount = '$'.number_format(floatval($invoice->balance), 2, '.', ',');
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
    </div>
</body>
</html>