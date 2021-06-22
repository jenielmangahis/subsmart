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
    <?php foreach($data as $transac) : ?>
    <?php if($count < count($data)) : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: always;">
    <?php else : ?>
    <div class="container" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;max-width: 1140px; page-break-after: avoid;">
    <?php endif; ?>
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <?php if($transac['type'] === 'expense') : ?>
            <div>
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                    <tbody>
                        <tr>
                            <td><h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Expense Voucher</h2></td>
                            <td></td>
                        </tr>
                        <tr style="font-size: 13px">
                            <td><strong>Payment To</strong></td>
                            <td><strong>Date:</strong> <?=date("m/d/Y", strtotime($transac['transaction']->payment_date))?></td>
                        </tr>
                        <tr style="font-size: 13px">
                            <td>
                                <p style="margin: 0"><?=$transac['payeeName']?></p>
                            </td>
                            <td><p style="margin: 0;"><strong>Reference No:</strong> <?=$transac['transaction']->ref_no?></p></td>
                        </tr>
                        <tr style="font-size: 13px">
                            <td>
                                <?php if($transac['transaction']->payee_type === 'vendor') : ?>
                                    <?php if($transac['payee']->street !== null && $transac['payee']->street !== "") : ?>
                                    <p style="margin: 0"><?=$transac['payee']->street?></p>
                                    <?php endif; ?>
                                    <?php if($transac['payee']->city !== null && $transac['payee']->city || $transac['payee']->state !== null && $transac['payee']->state !== "" || $transac['payee']->zip !== null && $transac['payee']->zip !== "") : ?>
                                    <p style="margin: 0"><?=$transac['payee']->city !== null && $transac['payee']->city !== "" ? $transac['payee']->city.', ' : ""?><?=$transac['payee']->state !== null && $transac['payee']->state !== "" ? $transac['payee']->state.' ' : ""?><?=$transac['payee']->zip !== null && $transac['payee']->zip !== "" ? $transac['payee']->zip : ""?></p>
                                    <?php endif; ?>
                                <?php elseif($transac['transaction']->payee_type === 'customer') : ?>
                                    <?php if($transac['payee']->mail_add !== null && $transac['payee']->mail_add !== "") : ?>
                                    <p style="margin: 0"><?=$transac['payee']->mail_add?></p>
                                    <?php endif; ?>
                                    <?php if($transac['payee']->city !== null && $transac['payee']->city !== "" || $transac['payee']->state !== null && $transac['payee']->state !== "" || $transac['payee']->zip_code !== null && $transac['payee']->zip_code !== "") : ?>
                                    <p style="margin: 0"><?=$transac['payee']->city !== null && $transac['payee']->city !== "" ? $transac['payee']->city.', ' : ""?><?=$transac['payee']->state !== null && $transac['payee']->state !== "" ? $transac['payee']->state.' ' : ""?><?=$transac['payee']->zip_code !== null && $transac['payee']->zip_code !== "" ? $transac['payee']->zip_code : ""?></p>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <?php if($transac['payee']->address !== null && $transac['payee']->address !== "") : ?>
                                    <p style="margin: 0"><?=$transac['payee']->address?></p>
                                    <?php endif; ?>
                                    <?php if($transac['payee']->city !== null && $transac['payee']->city !== "" || $transac['payee']->state !== null && $transac['payee']->state !== "" || $transac['payee']->postal_code !== null && $transac['payee']->postal_code !== "") : ?>
                                    <p style="margin: 0"><?=$transac['payee']->city !== null && $transac['payee']->city !== "" ? $transac['payee']->city.', ' : ""?><?=$transac['payee']->state !== null && $transac['payee']->state !== "" ? $transac['payee']->state.' ' : ""?><?=$transac['payee']->postal_code !== null && $transac['payee']->postal_code !== "" ? $transac['payee']->postal_code : ""?></p>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="font-size: 13px">
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 200px;">
                    <thead>
                        <tr>
                            <th>Account/Item</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($transac['table_items'] as $item) : ?>
                            <tr>
                                <td><?=$item['name']?></td>
                                <td><?=$item['description']?></td>
                                <td style="text-align: right"><?=$item['amount']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot style="border-top: 1px dashed gray">
                        <tr>
                            <td style="padding: 10px 0">
                                <p style="margin: 0">Memo:</p>
                                <p style="margin: 0"><?=$transac['transaction']->memo !== null && $transac['transaction']->memo !== "" ? $transac['transaction']->memo : "&nbsp;"?></p>
                            </td>
                            <td style="text-align: right; padding: 10px 0">
                                <p style="margin: 0 !important">TOTAL</p>
                                <p style="margin: 0 !important">TOTAL DUE</p>
                            </td>
                            <td style="text-align: right; padding: 10px 0">
                                <p style="margin: 0">$<?=number_format(floatval($transac['transaction']->total_amount), 2, '.', ',')?></p>
                                <p style="margin: 0">&nbsp;</p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php else : ?>
            <div>
                <h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Purchase Order</h2>
                <table style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem">
                    <tbody>
                        <tr style="font-size: 13px">
                            <td width="33.3%" style="padding: 5px"><strong>Vendor</strong></td>
                            <td width="33.3%" style="padding: 5px">
                                <?php if($transac['transaction']->shipping_address !== "" && $transac['transaction']->shipping_address !== null) : ?>
                                    <strong>SHIP TO</strong>
                                <?php endif; ?>
                            </td>
                            <td width="33.3%" style="padding: 5px"><strong>P.O. NO.</strong> <?=$transac['transaction']->purchase_order_no?></td>
                        </tr>
                        <tr style="font-size: 13px">
                            <td style="padding: 5px">
                                <?php if($transac['transaction']->mailing_address !== null && $transac['payee']->mailing_address !== "") : ?>
                                    <p style="margin: 0"><?=$transac['transaction']->mailing_address?></p>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 5px">
                                <?php if($transac['transaction']->shipping_address !== "" && $transac['transaction']->shipping_address !== null) : ?>
                                    <p style="margin: 0"><?=$transac['transaction']->shipping_address?></p>
                                <?php endif;?>
                            </td>
                            <td style="padding: 5px">
                                <p style="margin: 0"><strong>DATE</strong> <?=date("m/d/Y", strtotime($transac['transaction']->purchase_order_date))?><br><br><br></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="font-size: 13px;">
                <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 200px;">
                    <thead>
                        <tr>
                            <th width="35%">ACTIVITY</th>
                            <th width="20%">QTY</th>
                            <th width="20%">RATE</th>
                            <th width="25%">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($transac['table_items'] as $item) : ?>
                            <tr>
                                <td><?=$item['activity']?></td>
                                <td style="text-align: right"><?=$item['qty']?></td>
                                <td style="text-align: right"><?=$item['rate']?></td>
                                <td style="text-align: right"><?=$item['amount']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot style="border-top: 1px dashed gray">
                        <tr>
                            <td style="padding: 10px 0">
                                <p style="margin: 0; text-align: right">TOTAL</p>
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right; padding: 10px 0">
                                <p style="margin: 0">$<?=number_format(floatval($transac['transaction']->total_amount), 2, '.', ',')?></p>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php $count++; ?>
    <?php endforeach; ?>
</body>
</html>