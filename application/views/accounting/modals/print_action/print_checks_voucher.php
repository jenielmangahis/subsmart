<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0; font-size: 13px; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji'; font-weight: 400;line-height: 1.5; color: #212529; text-align: left; background-color: #fff;">
    <?php $count = 1; ?>
    <?php foreach($data['checks'] as $check) : ?>
    <?php if($count < count($data['checks'])) : ?>
    <div class="container" style="width: 100%;padding-right: <?=$data['right-padding']?>px;padding-left: <?=$data['left-padding']?>px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always; height: 100%;">
    <?php else : ?>
    <div class="container" style="width: 100%;padding-right: <?=$data['right-padding']?>px;padding-left: <?=$data['left-padding']?>px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid; height: 100%;">
    <?php endif; ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div style="width: 100%">
                <div style="position: absolute; width: 100%; margin-top: <?=$data['top-margin']?>px;">
                    <table style="width: 100%; color: #212529; border-collapse: collapse; position: absolute; margin-top: 32px; z-index: 2">
                        <tr>
                            <td style="padding-left: 25px;">
                                <p style="margin-top: 24px; margin-bottom: 8px;"><?=$check['name']?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><?=$check['total_in_words']?></td>
                        </tr>
                        <tr>
                            <td style="padding-left: 25px;"><p style="margin: 0"><?=str_replace("<br />", "<br>", $check['mailing_address'])?></p></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </table>

                    <div style="position: absolute; width: 123px; float: right; margin-right: -20px; margin-top: 8px z-index: 1;">
                        <p style="margin: 0"><?=$check['date']?></p>
                        <div style="width: 100%; height: 70px;">
                            <p style="margin-bottom: 0; margin-top: 28px; text-align: left;">**<?=$check['total']?></p>
                        </div>
                    </div>
                </div>
                <?php if($check['type'] === 'check') : ?>
                <table class="table" style="width: 100%; color: #212529;border-collapse: collapse; margin-top: 294px; position: absolute">
                    <tbody>
                        <tr>
                            <td style="width: 21%;">
                                <p style="margin: 0; text-align: center"><b><?=$check['date']?></b></p>
                            </td>
                            <td>
                                <p style="margin: 0;"><b><?=$check['name']?></b></p>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="2" style="text-align: right"><?=$check['total']?></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin-top: 10px; margin-bottom: 0;"><b><?=$check['payment_account']?></b></p>
                            </td>
                            <td>
                                <p style="text-align: right; margin-top: 10px; margin-bottom: 0;"><?=$check['total']?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; color: #212529;border-collapse: collapse; margin-top: 629px; position: absolute">
                    <tbody>
                        <tr>
                            <td style="width: 21%;">
                                <p style="margin: 0; text-align: center"><b><?=$check['date']?></b></p>
                            </td>
                            <td>
                                <p style="margin: 0;"><b><?=$check['name']?></b></p>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td colspan="2" style="text-align: right"><?=$check['total']?></td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p style="margin-top: 10px; margin-bottom: 0;"><b><?=$check['payment_account']?></b></p>
                            </td>
                            <td>
                                <p style="text-align: right; margin-top: 10px; margin-bottom: 0;"><?=$check['total']?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php else : ?>
                <div style="width: 100%; color: #212529; margin-top: 294px; position: absolute">
                    <table class="table" style="width: 100%; color: #212529;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="width: 21%;">
                                    <p style="margin: 0; text-align: center"><b><?=$check['date']?></b></p>
                                </td>
                                <td>
                                    <p style="margin: 0;"><b><?=$check['name']?></b></p>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="width: 100%; color: #212529;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td><b>Date</b></td>
                                <td><b>Type</b></td>
                                <td><b>Reference</b></td>
                                <td style="text-align: right"><b>Original Amount</b></td>
                                <td style="text-align: right"><b>Balance Due</b></td>
                                <td style="text-align: right"><b>Payment</b></td>
                            </tr>
                            <?php foreach($check['linked_transactions'] as $transaction) : ?>
                            <tr>
                                <td><?=$transaction['date']?></td>
                                <td><?=$transaction['type']?></td>
                                <td><?=$transaction['reference']?></td>
                                <td style="text-align: right"><?=$transaction['original_amount']?></td>
                                <td style="text-align: right"><?=$transaction['balance_due']?></td>
                                <td style="text-align: right"><?=$transaction['payment']?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">Check Amount</td>
                                <td style="text-align: right"><?=$check['total']?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="width: 100%; color: #212529;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p style="margin-top: 10px; margin-bottom: 0;"><b><?=$check['payment_account']?></b></p>
                                </td>
                                <td>
                                    <p style="text-align: right; margin-top: 10px; margin-bottom: 0;"><?=$check['date']?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div style="width: 100%; color: #212529; margin-top: 629px; position: absolute">
                    <table class="table" style="width: 100%; color: #212529;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="width: 21%;">
                                    <p style="margin: 0; text-align: center"><b><?=$check['date']?></b></p>
                                </td>
                                <td>
                                    <p style="margin: 0;"><b><?=$check['name']?></b></p>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="width: 100%; color: #212529;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td><b>Date</b></td>
                                <td><b>Type</b></td>
                                <td><b>Reference</b></td>
                                <td style="text-align: right"><b>Original Amount</b></td>
                                <td style="text-align: right"><b>Balance Due</b></td>
                                <td style="text-align: right"><b>Payment</b></td>
                            </tr>
                            <?php foreach($check['linked_transactions'] as $transaction) : ?>
                            <tr>
                                <td><?=$transaction['date']?></td>
                                <td><?=$transaction['type']?></td>
                                <td><?=$transaction['reference']?></td>
                                <td style="text-align: right"><?=$transaction['original_amount']?></td>
                                <td style="text-align: right"><?=$transaction['balance_due']?></td>
                                <td style="text-align: right"><?=$transaction['payment']?></td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">Check Amount</td>
                                <td style="text-align: right"><?=$check['total']?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table" style="width: 100%; color: #212529;border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p style="margin-top: 10px; margin-bottom: 0;"><b><?=$check['payment_account']?></b></p>
                                </td>
                                <td>
                                    <p style="text-align: right; margin-top: 10px; margin-bottom: 0;"><?=$check['date']?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</body>
</html>