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
                <h2>ESTIMATE</h2>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="60%"><strong>ADDRESS</strong></td>
                            <td style="text-align: right"><strong>ESTIMATE #</strong></td>
                            <td><?=str_replace($estimate_prefix, '', $estimate->estimate_number)?></td>
                        </tr>
                        <tr style="vertical-align:top">
                            <td rowspan="2"><?=$billing_address?></td>
                            <td style="text-align: right"><strong>DATE</strong></td>
                            <td><?=date("m/d/Y", strtotime($estimate->estimate_date))?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <th style="text-align: left" width="40%">ACTIVITY</th>
                            <th style="text-align: right" width="20%">QTY</th>
                            <th style="text-align: right" width="20%">RATE</th>
                            <th style="text-align: right" width="20%">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody style="border-bottom: 1px dotted gray">
                        <?php foreach($estimateItems as $estimateItem) : ?>
                            <tr>
                                <td><?=$estimateItem->item->title?></td>
                                <td style="text-align: right"><?=intval($estimateItem->qty)?></td>
                                <td style="text-align: right"><?=number_format(floatval($estimateItem->costing), 2, '.', ',')?></td>
                                <td style="text-align: right"><?=number_format(floatval($estimateItem->total), 2, '.', ',')?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->sub_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">TAX</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->tax_total), 2, '.', ',')?></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2">TOTAL</td>
                            <td style="text-align: right"><?=number_format(floatval($transaction->total), 2, '.', ',')?></td>
                        </tr>
                    </tfoot>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <thead>
                        <tr>
                            <td>Accepted Date</td>    
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=!empty($estimate->accepted_date) ? date("m/d/Y", strtotime($estimate->accepted_date)) : ''?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>