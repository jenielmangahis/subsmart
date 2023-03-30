<?php
$group_items = array();
$grand_total = 0;

foreach ($jobs_data_items as $ji) {
    $type = 'product';
    if ($ji->type != 'product') {
        $type = 'service';
    }
    $group_items[$type][] = [
        'item_name' => $ji->title,
        'item_price' => $ji->price,
        'item_qty' => $ji->qty
    ];

    $grand_total += $ji->price * $ji->qty;
}

$due_date = date('m/d/Y', strtotime($jobs_data->invoice_due_date));
$invoice_date = date('m/d/Y', strtotime($jobs_data->invoice_date));

// if (is_null($jobs_data->invoice_due_date)) {
//     $due_date = DateTime::createFromFormat('Y-m-d', $jobs_data->end_date);
//     $due_date = $due_date->add(new DateInterval('P30D'));
//     $due_date = $due_date->format('m/d/Y');
// }

if (is_null($jobs_data->invoice_due_date)) {
    $due_date = DateTime::createFromFormat('Y-m-d', $jobs_data->end_date);
    if ($due_date !== false) {
        $due_date->add(new DateInterval('P30D'));
        $due_date = $due_date->format('m/d/Y');
    } 
}


if (is_null($jobs_data->invoice_date)) {
    $invoice_date = new DateTime();
    $invoice_date = $invoice_date->format('m/d/Y');
}

$company_image = base_url('/uploads/users/business_profile/' . $company_info->id . '/' . $company_info->business_image);
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>nSmartrac: <?= $jobs_data->job_number; ?> Invoice </title>

    <style>
        body {
            margin: 0;
            font-size: 14px;
        }

        .container {
            padding: 16px;
            background-color: #f5f5f5;
        }

        .main {
            width: 800px;
            margin: auto;
            padding: 16px;
            box-sizing: border-box;
            background-color: #fff;
        }

        table {
            width: 100%;
        }

        .payinvoice {
            display: block;
            height: 50px;
            line-height: 50px;
            font-size: 20px;
            text-decoration: none;
            width: 90%;
            margin: auto;
            border-radius: 8px;
            text-align: center;
            background-color: #64477d;
            color: #fff !important;
            box-shadow: 0px 15px 20px #64477d87;
            max-width: 200px;
        }

        .companyimage {
            width: 70px;
            height: 70px;
            min-width: 70px;
            min-height: 70px;
            background-color: #e2e2e2;
            display: block;
        }

        .companyimage.companyimage-big {
            width: 100px;
            height: 100px;
            min-width: 100px;
            min-height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="main">
            <table>
                <tr>
                    <td>
                        <img alt="<?= $company_info->business_name; ?>" src="<?= $company_image; ?>" class="companyimage companyimage-big" />
                    </td>

                    <td style="width: 1%; white-space: nowrap; margin-right: 8px; padding-right: 16px; vertical-align: top;">
                        <table>
                            <tr>
                                <td>
                                    <div style="margin-bottom: 8px; font-size: 18px;"><b>ORIGINAL INVOICE</b></div>
                                    <div>CUSTOMER INVOICE</div>
                                    <div>PLEASE WRITE THIS NUMBER</div>
                                    <div>ON ALL ORDERS AND CHECKS</div>
                                    <div style="border: 1px solid; padding: 8px; text-align: center;"><?= $jobs_data->job_number; ?></div>
                                </td>
                            </tr>
                        </table>
                    </td>

                    <td style="width: 1%; white-space: nowrap; vertical-align: top;">
                        <table style="border-collapse: collapse; margin-bottom: 2px;">
                            <tr>
                                <td style="border: 1px solid; text-align: center; width: 50%; padding: 0 8px;">
                                    <b>PAGE</b>
                                </td>
                                <td style="border: 1px solid; text-align: center; width: 50%; padding: 0 8px;">
                                    <b>INVOICE DATE</b>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; text-align: center;">1</td>
                                <td style="border: 1px solid; text-align: center;"><?= $invoice_date; ?></td>
                            </tr>
                        </table>

                        <table style="border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="border: 1px solid; text-align: center;">
                                    <div><b>JOB NUMBER</b></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border: 1px solid; text-align: center; padding: 8px;">
                                    <?= $jobs_data->job_number; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right; padding: 8px; padding-right: 16px;">
                        <b>PLEASE PAY THIS AMOUNT</b>
                    </td>
                    <td style="border: 1px solid; text-align: center; padding: 8px;">$<?= number_format($grand_total, 2); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="text-align: right; padding: 8px; padding-right: 16px;">
                        <b>DUE DATE</b>
                    </td>
                    <td style="border: 1px solid; text-align: center; padding: 8px;"><?= $due_date; ?></td>
                </tr>
            </table>

            <table style="margin-bottom: 50px;">
                <tr>
                    <div><?= strtoupper($jobs_data->first_name . ' ' . $jobs_data->last_name); ?></div>
                    <div><?= strtoupper($jobs_data->mail_add); ?></div>
                    <div><?= strtoupper($jobs_data->cust_city . ', ' . $jobs_data->cust_state . ' ' . $jobs_data->cust_zip_code); ?></div>
                    <div>TEL: <?= formatPhoneNumber($jobs_data->phone_m); ?></div>
                </tr>
            </table>

            <table style="margin-bottom: 50px;">
                <tr>
                    <div><?= strtoupper(trim($company_info->business_name)); ?></div>
                    <div><?= strtoupper($company_info->street); ?></div>
                    <div><?= strtoupper($company_info->city . ', ' . $company_info->state . ' ' . $company_info->postal_code); ?></div>
                    <div>TEL: <?= formatPhoneNumber($company_info->business_phone); ?></div>
                </tr>
            </table>

            <table>
                <tr>
                    <td style="text-align: center; border-bottom: 2px dashed;">
                        <b>Please detach and enclose top portion with your payment</b>
                    </td>
                    <td style="text-align: center; border-bottom: 2px dashed;">
                        <b>Make check payable and remit to above address</b>
                    </td>
                </tr>
            </table>

            <table style="padding: 16px 0;">
                <tr>
                    <td>
                        <img alt="<?= $company_info->business_name; ?>" src="<?= $company_image; ?>" class="companyimage" />
                    </td>
                    <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                        <b>JOB INVOICE NO#</b>
                        <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= $jobs_data->job_number; ?></div>
                    </td>
                    <td style="text-align: center; width: 1%; white-space: nowrap; padding: 0 16px;">
                        <b>DATE</b>
                        <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= date("m/d/Y"); ?></div>
                    </td>
                    <td>
                        <div><b>Retain this portion</b></div>
                        <div><b>for your records</b></div>
                    </td>
                    <td></td>
                </tr>
            </table>

            <table style="border-collapse: collapse; margin-bottom: 50px;">
                <tr>
                    <td style="border: 1px solid; text-align: center;">
                        <b>ITEM DESCRIPTION</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>ITEM TYPE</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>QTY</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>UNIT PRICE</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>AMOUNT</b>
                    </td>
                </tr>

                <?php
                $total_service = 0;
                $total_product = 0;
                ?>

                <?php foreach ($group_items as $type => $items) : ?>
                    <?php foreach ($items as $i) : ?>
                        <?php
                        $total    = $i['item_price'] * $i['item_qty'];
                        $subtotal = $subtotal + $total;
                        if ($type == 'product') {
                            $total_product += $total;
                        } else {
                            $total_service += $total;
                        }
                        ?>

                        <tr>
                            <td style="padding: 8px; border: 1px solid;"><?= $i['item_name']; ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;"><?= strtoupper($type); ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;"><?= $i['item_qty']; ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float)$i['item_price'], 2, '.', ','); ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float)$total, 2, '.', ','); ?></td>
                        </tr>

                    <?php endforeach; ?>
                <?php endforeach; ?>

                <tr>
                    <td colspan="2" rowspan="4">
                        <a href="<?= $payment_link; ?>" class="payinvoice">
                            <b>PAY INVOICE</b>
                        </a>
                    </td>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>TOTAL PRODUCT</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float)$total_product, 2, '.', ','); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>TOTAL SERVICE</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float)$total_service, 2, '.', ','); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid; font-size: 20px;">
                        <b>TOTAL INVOICE</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float)$jobs_data->total_amount, 2, '.', ','); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>DUE DATE</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;"><?= $due_date; ?></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td>
                        <b style="font-size: 30px; color: red;">THANK YOU FOR YOUR ORDER</b>
                    </td>
                </tr>
                <tr>
                    <td>All claims must be made within 5 days after receipt of goods. Goods returned without our authorized return number on the carton will be
                        refused. The purchase of products and services are subject to and governed solely by the Terms and Conditions.</td>
                </tr>
                <tr>
                    <td>
                        <a href="https://nsmartrac.com/terms-and-condition" style="color: blue;text-decoration:none;">https://nsmartrac.com/terms-and-condition</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style="color: red;">Past due balances may be subject to a Late Charge not to exceed 1.5% per month.</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>