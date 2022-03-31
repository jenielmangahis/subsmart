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
                <h2>Receipt</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="60%">Received From:</td>
                            <td style="text-align: right"><strong>Date:</strong></td>
                            <td><?=date("m/d/Y", strtotime($payment->payment_date))?></td>
                        </tr>
                        <tr>
                            <td width="60%"><?=$customerName?></td>
                            <td style="text-align: right"><strong>Reference No:</strong></td>
                            <td><?=$payment->ref_no?></td>
                        </tr>
                        <tr>
                            <td width="60%"><?=$address?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Invoice Date</th>
                            <th>Due Date</th>
                            <th>Original Amount</th>
                            <th>Balance</th>
                            <th>Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($paymentInvoices as $paymentInvoice) : ?>
                            <tr>
                                <td><?=str_replace($invoice_prefix, '', $paymentInvoice->invoice->invoice_number)?></td>
                                <td><?=date("m/d/Y", strtotime($paymentInvoice->invoice->date_issued))?></td>
                                <td><?=date("m/d/Y", strtotime($paymentInvoice->invoice->due_date))?></td>
                                <td><?=number_format(floatval($paymentInvoice->invoice->grand_total), 2, '.', ',')?></td>
                                <td><?=number_format(floatval($paymentInvoice->invoice->balance) + floatval($paymentInvoice->payment_amount), 2, '.', ',')?></td>
                                <td><?=number_format(floatval($paymentInvoice->payment_amount), 2, '.', ',')?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>Memo:</td>
                            <td><?=str_replace("<br />", "", $expense->memo)?></td>
                            <td></td>
                            <td>Amount Credited:</td>
                            <td></td>
                            <td style="text-align: right">
                                <?php
                                    $amountCredited = '$'.number_format(floatval($payment->amount_to_credit), 2, '.', ',');
                                    echo str_replace('$-', '-$', $amountCredited);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total:</td>
                            <td></td>
                            <td style="text-align: right">
                                <?php
                                    $total = '$'.number_format(floatval($payment->amount_received), 2, '.', ',');
                                    echo str_replace('$-', '-$', $total);
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>
</html>