<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0; font-size: 14px; font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji'; font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <?php $count = 1; ?>
    <?php foreach($checks as $check) : ?>
    <?php if($count < count($checks)) : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always; height: 100%;">
    <?php else : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid; height: 100%;">
    <?php endif; ?>
        <?php if($check['type'] === 'sample') : ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div style="width: 100%; padding-top: 50px;">
                <table style="width: 100%; margin-bottom: 144px; color: #212529; border-collapse: collapse; margin-right: -20px;">
                    <tr>
                        <td style="width: 75%"></td>
                        <td style="width: 25%">Alignment Grid</td>
                    </tr>
                    <tr>
                        <td style="width: 75%; padding: 0 25px;">
                            <span><?=$check['name']?></span>
                        </td>
                        <td style="width: 25%; height: 70px;">
                            <div style="border: 1px solid gray; width: 100%; height: 70px; background: url(/uploads/accounting/grid.png); background-repeat: repeat; position: absolute">
                                <p style="margin-bottom: 0; margin-top: 24px; text-align: center;">**<?=$check['total']?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><?=$check['total_in_words']?></td>
                    </tr>
                    <tr>
                        <td style="padding: 0 25px;"><p style="margin: 0"><?=str_replace("<br />", "<br>", $check['mailing_address'])?></p></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 0 25px;">Pay Period: 01/01/2007 - 01/15/2007</td>
                    </tr>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 145px; color: #212529;border-collapse: collapse; margin-top: 144px; margin-right: -20px;">
                    <tbody>
                        <tr>
                            <td style="width: 75%; padding: 0 25px;">
                                <span><?=$check['name']?></span>
                            </td>
                            <td style="width: 25%;">
                                <p style="text-align: center; margin: 0">**<?=$check['total']?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><p><?=$check['total_in_words']?></p></td>
                        </tr>
                        <tr>
                            <td style="padding: 0 25px;"><p style="margin: 0"><?=str_replace("<br />", "<br>", $check['mailing_address'])?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0 25px;">Pay Period: 02/01/2007 - 02/15/2007</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; color: #212529;border-collapse: collapse; margin-top: 145px; margin-right: -20px;">
                    <tbody>
                        <tr>
                            <td style="width: 75%; padding: 0 25px;">
                                <span><?=$check['name']?></span>
                            </td>
                            <td style="width: 25%">
                                <p style="text-align: center; margin: 0">**<?=$check['total']?></p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><p><?=$check['total_in_words']?></p></td>
                        </tr>
                        <tr>
                            <td style="padding: 0 25px;"><p style="margin: 0"><?=str_replace("<br />", "<br>", $check['mailing_address'])?></p></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 0 25px;">Pay Period: 03/01/2007 - 03/15/2007</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else : ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td width="80%">&nbsp;</td>
                            <td width="20%" style="text-align: center"><?=$check['date']?></td>
                        </tr>
                        <tr>
                            <td width="80%"><?=$check['name']?></td>
                            <td width="20%" style="text-align: center">**<?=$check['total']?></td>
                        </tr>
                        <tr>
                            <td width="80%"><?=$check['total_in_words']?></td>
                            <td width="20%" style="text-align: center"></td>
                        </tr>
                        <tr>
                            <td width="80%"><p style="margin: 0"><?=str_replace("<br />", "<br>", $check['mailing_address'])?></p></td>
                            <td width="20%" style="text-align: center"></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td style="text-align: right;" width="20%"><?=$check['date']?></td>
                            <td style="text-align: center;" colspan="2"><?=$check['name']?></td>
                            <td width="20%">&nbsp;</td>
                            <td width="15%">&nbsp;</td>
                            <td width="15%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?=$check['type'] === 'check' ? '&nbsp;' : 'Date'?></td>
                            <td><?=$check['type'] === 'check' ? '&nbsp;' : 'Type'?></td>
                            <td><?=$check['type'] === 'check' ? '&nbsp;' : 'Reference'?></td>
                            <td style="text-align: right"><?=$check['type'] === 'check' ? '&nbsp;' : 'Original Amount'?></td>
                            <td style="text-align: right"><?=$check['type'] === 'check' ? '&nbsp;' : 'Balance Due'?></td>
                            <td style="text-align: right"><?=$check['type'] === 'check' ? $check['total'] : 'Payment'?></td>
                        </tr>
                        <?php if($check['type'] === 'bill-payment') : ?>
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
                        <?php endif;?>
                        <tr>
                            <td><?=$check['payment_account']?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: right"><?=$check['total']?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td style="text-align: right;" width="20%"><?=$check['date']?></td>
                            <td style="text-align: center;" colspan="2"><?=$check['name']?></td>
                            <td width="20%">&nbsp;</td>
                            <td width="15%">&nbsp;</td>
                            <td width="15%">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><?=$check['type'] === 'check' ? '&nbsp;' : 'Date'?></td>
                            <td><?=$check['type'] === 'check' ? '&nbsp;' : 'Type'?></td>
                            <td><?=$check['type'] === 'check' ? '&nbsp;' : 'Reference'?></td>
                            <td style="text-align: right"><?=$check['type'] === 'check' ? '&nbsp;' : 'Original Amount'?></td>
                            <td style="text-align: right"><?=$check['type'] === 'check' ? '&nbsp;' : 'Balance Due'?></td>
                            <td style="text-align: right"><?=$check['type'] === 'check' ? $check['total'] : 'Payment'?></td>
                        </tr>
                        <?php if($check['type'] === 'bill-payment') : ?>
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
                        <?php endif;?>
                        <tr>
                            <td><?=$check['payment_account']?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td style="text-align: right"><?=$check['total']?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</body>
</html>