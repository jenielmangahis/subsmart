<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Summary</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <?php $count = 1; ?>
    <?php foreach($data['customers'] as $customer): ?>
    <?php if($count < count($data['customers'])) : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always;">
    <?php else : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid;">
    <?php endif; ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td><h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Statement</h2></td>
                        </tr>
                        <tr>
                            <td><strong>TO <br> <span style="font-weight: 400;"><?= $customer['name'] ?></span></strong></td>
                        </tr>
                        <tr>
                            <td>
                                <div style="float:right;">
                                    <p><strong>STATEMENT NO.</strong>1050</p>
                                    <p><strong>DATE</strong><?= $customer['date'] ?></p>
                                    <?php if($data['statement_type'] !== '3') : ?>
                                    <p><strong>TOTAL DUE</strong>$<?= number_format($customer['total_due'], 2, '.', ',') ?></p>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 300px;">
                    <thead>
                        <tr>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">DATE</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">ACTIVITY</th>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">AMOUNT</th>
                            <?php if($data['statement_type'] === '1' || $data['statement_type'] === 1) : ?>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">BALANCE</th>
                            <?php elseif($data['statement_type'] === '2' || $data['statement_type'] === 2) : ?>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">OPEN AMOUNT</th>
                            <?php else : ?>
                            <th style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">RECEIVED</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($customer['items'] as $item) :?>
                        <tr>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem;"><?= $item['date'] ?></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem;"><?= $item['activity'] ?></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;"><?= $item['amount'] !== "" ? number_format(floatval($item['amount']), 2, '.', ',') : "" ?></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;"><?= number_format($item['balance'], 2, '.', ',') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <?php if($data['statement_type'] === '3' || $data['statement_type'] === 3) : ?>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">TOTAL AMOUNT</td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;">TOTAL RECEIVED</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <?php
                            $totalAmount = array_sum(array_map(function($item){
                                return $item['amount'];
                            }, $customer['items']));
                            
                            $totalReceived = array_sum(array_map(function($item){
                                return $item['balance'];
                            }, $customer['items']));
                            ?>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;"><?= number_format($totalAmount, 2, '.', ',') ?></td>
                            <td style="border-bottom-width: 2px;vertical-align: bottom;padding: .75rem; text-align:center;"><?= number_format($totalReceived, 2, '.', ',') ?></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</body>
</html>