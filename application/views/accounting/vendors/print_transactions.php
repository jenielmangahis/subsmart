<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>print</title>
    <!-- <link rel="stylesheet" href="/assets/dashboard/css/bootstrap.min.css"> -->
</head>
<body style="margin: 0;    font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,'Noto Sans',sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol','Noto Color Emoji';font-size: 1rem;font-weight: 400;line-height: 1.5;    color: #212529;    text-align: left;    background-color: #fff;">
    <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
        <?php if($data['type'] === 'expense') : ?>
        <div>
            <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                <tbody>
                    <tr>
                        <td><h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Expense Voucher</h2></td>
                        <td></td>
                    </tr>
                    <tr style="font-size: 13px">
                        <td><strong>Payment To</strong></td>
                        <td><strong>Date:</strong> <?=date("m/d/Y", strtotime($data['transaction']->payment_date))?></td>
                    </tr>
                    <tr style="font-size: 13px">
                        <td>
                            <p><?=$data['payeeName']?></p>
                            <?php if($data['transaction']->payee_type === 'vendor') : ?>
                                <?php if($data['payee']->mail_add !== null && $data['payee']->mail_add !== "") : ?>
                                <p><?=$data['payee']->street?></p>
                                <?php endif; ?>
                                <p><?=$data['payee']->city !== null && $data['payee']->city !== "" ? $data['payee']->city.', ' : ""?><?=$data['payee']->state !== null && $data['payee']->state !== "" ? $data['payee']->state.' ' : ""?><?=$data['payee']->zip !== null && $data['payee']->zip !== "" ? $data['payee']->zip : ""?></p>
                            <?php elseif($data['transaction']->payee_type === 'customer') : ?>
                                <?php if($data['payee']->mail_add !== null && $data['payee']->mail_add !== "") : ?>
                                <p><?=$data['payee']->mail_add?></p>
                                <?php endif; ?>
                                <p><?=$data['payee']->city !== null && $data['payee']->city !== "" ? $data['payee']->city.', ' : ""?><?=$data['payee']->state !== null && $data['payee']->state !== "" ? $data['payee']->state.' ' : ""?><?=$data['payee']->zip_code !== null && $data['payee']->zip_code !== "" ? $data['payee']->zip_code : ""?></p>
                            <?php else : ?>
                                <?php if($data['payee']->address !== null && $data['payee']->address !== "") : ?>
                                <p><?=$data['payee']->address?></p>
                                <?php endif; ?>
                                <p><?=$data['payee']->city !== null && $data['payee']->city !== "" ? $data['payee']->city.', ' : ""?><?=$data['payee']->state !== null && $data['payee']->state !== "" ? $data['payee']->state.' ' : ""?><?=$data['payee']->postal_code !== null && $data['payee']->postal_code !== "" ? $data['payee']->postal_code : ""?></p>
                            <?php endif; ?>
                        </td>
                        <td><strong>Reference No:</strong> <?=$data['transaction']->ref_no?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="font-size: 13px">
            <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 300px;">
                <thead>
                    <tr>
                        <th>Account/Item</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['table_items'] as $item) : ?>
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
                            <p style="margin: 0"><?=$data['transaction']->memo !== null && $data['transaction']->memo !== "" ? $data['transaction']->memo : "&nbsp;"?></p>
                        </td>
                        <td style="text-align: right; padding: 10px 0">
                            <p style="margin: 0 !important">TOTAL</p>
                            <p style="margin: 0 !important">TOTAL DUE</p>
                        </td>
                        <td style="text-align: right; padding: 10px 0">
                            <p style="margin: 0">$<?=number_format(floatval($data['transaction']->total_amount), 2, '.', ',')?></p>
                            <p style="margin: 0">&nbsp;</p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php else : ?>
        <div>
            <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 1rem;">
                <tbody>
                    <tr>
                        <td><h2 class="mt-3 text-center w-100" style="text-align: left; margin-top: 1rem; width: 100%;">Purchase Order</h2></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr style="font-size: 13px">
                        <td><strong>Vendor</strong></td>
                        <td><strong>SHIP TO</strong></td>
                        <td><strong>P.O. NO.</strong> <?=$data['transaction']->purchase_order_no?></td>
                    </tr>
                    <tr style="font-size: 13px">
                        <td>
                            <p><?=$data['payeeName']?></p>
                            <?php if($data['payee']->mail_add !== null && $data['payee']->mail_add !== "") : ?>
                            <p><?=$data['payee']->street?></p>
                            <?php endif; ?>
                            <p><?=$data['payee']->city !== null && $data['payee']->city !== "" ? $data['payee']->city.', ' : ""?><?=$data['payee']->state !== null && $data['payee']->state !== "" ? $data['payee']->state.' ' : ""?><?=$data['payee']->zip !== null && $data['payee']->zip !== "" ? $data['payee']->zip : ""?></p>
                        </td>
                        <td><p><?=$data['transaction']->shipping_address?></p></td>
                        <td>DATE <?=date("m/d/Y", strtotime($data['transaction']->purchase_order_date))?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="font-size: 13px">
            <table class="table table-bordered table-hover clickable" style="width: 100%; margin-bottom: 1rem; color: #212529;border-collapse: collapse; margin-top: 300px;">
                <thead>
                    <tr>
                        <th>ACTIVITY</th>
                        <th>QTY</th>
                        <th>RATE</th>
                        <th>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data['table_items'] as $item) : ?>
                        <tr>
                            <td><?=$item['name']?></td>
                            <td><?=$item['qty']?></td>
                            <td><?=$item['rate']?></td>
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
                            <p style="margin: 0">$<?=number_format(floatval($data['transaction']->total_amount), 2, '.', ',')?></p>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>