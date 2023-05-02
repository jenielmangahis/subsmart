<?php
$invoice_date = date('m/d/Y', strtotime($invoice->date_issued));
$company_image = base_url('/uploads/users/business_profile/' . $company_info->id . '/' . $company_info->business_image);

$due_date = 'Due on receipt';
if ($invoice->due_date > date('Y-m-d')) {
    $due_date = date('m/d/Y', strtotime($invoice->due_date));
}

$payment_link = base_url('/invoice/pay_now_form_fr_email/' . $invoice->id);
?>

<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>nSmartrac: <?= $invoice->invoice_number; ?> Invoice </title>

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

                    <td style="width: 50%; white-space: nowrap; margin-right: 8px; padding-right: 16px; vertical-align: top;">
                        <table>
                            <tr>
                                <td>
                                    <div style="margin-bottom: 8px; font-size: 18px;"><b>ORIGINAL INVOICE</b></div>
                                    <div>CUSTOMER INVOICE</div>
                                    <div>PLEASE WRITE THIS NUMBER</div>
                                    <div>ON ALL ORDERS AND CHECKS</div>
                                    <div style="border: 1px solid; padding: 8px; text-align: center;"><?= $invoice->invoice_number; ?></div>
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
                                    <div><b>Business Name</b></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border: 1px solid; text-align: center; padding: ;">
                                    <?php //if(empty($customer->business_name)){ echo 'NA';}else{ echo $customer->business_name; }  
                                    if(empty($customer->business_name)){ echo 'NA';}else{ echo $customer->business_name; } 
                                    ?>
                                </td>
                            </tr>
                        </table>

                        <table style="border-collapse: collapse;">
                            <tr>
                                <td colspan="2" style="border: 1px solid; text-align: center;">
                                    <div><b>INVOICE NUMBER</b></div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="border: 1px solid; text-align: center; padding: 8px;">
                                    <?= $invoice->invoice_number; ?>
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
                    <td style="border: 1px solid; text-align: center; padding: 8px;">$<?= number_format((float) ($invoice->grand_total - $invoice->deposit_request), 2); ?></td>
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
                    <div><?= strtoupper($customer->first_name . ' ' . $customer->last_name); ?></div>
                    <div><?= strtoupper($customer->city . ' ' . $customer->state . ' ' . $customer->zip_code); ?></div>
                </tr>
            </table>

            <table style="margin-bottom: 50px;">
                <tr>
                    <div><?= strtoupper(trim($company_info->business_name)); ?></div>
                    <div><?= strtoupper($company_info->street); ?></div>
                    <div><?= strtoupper($company_info->city . ', ' . $company_info->state . ' ' . $company_info->postal_code); ?></div>
                    <div>TEL: <?= $company_info->business_phone; ?></div>
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
                        <b>INVOICE NO#</b>
                        <div style="padding: 8px 16px; border: 1px solid; text-align: center;"><?= $invoice->invoice_number; ?></div>
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
                        <b>MATERIALS</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>QTY</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>UNIT PRICE</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>DISCOUNT</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>TAX</b>
                    </td>
                    <td style="border: 1px solid; text-align: center;">
                        <b>AMOUNT</b>
                    </td>
                </tr>

                <?php foreach ($items as $item) : ?>
                    <?php if ($item->items_id != 0) : ?>
                        <?php if($item->type == 'Service'){ ?>
                        <tr>
                            <td style="padding: 8px; border: 1px solid;border-bottom: solid white 1px;"><?= $item->title; ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;"><?= $item->qty; ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->costing, 2); ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$0</td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->tax, 2); ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">
                                <?php $a = (float) $item->qty * (float) $item->costing; ?>
                                <?php $b = $a + (float) $item->tax; ?>
                                $<?= number_format((float) $b, 2);  ?>
                            </td>
                        </tr>
                        <?php }else{ ?>
                        <tr>
                            <td style="padding: 8px; border: 1px solid;"><?= $item->title; ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;"><?= $item->qty; ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->costing, 2); ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$0</td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">$<?= number_format((float) $item->tax, 2); ?></td>
                            <td style="padding: 8px; border: 1px solid; text-align: center;">
                                <?php $a = (float) $item->qty * (float) $item->costing; ?>
                                <?php $b = $a + (float) $item->tax; ?>
                                $<?= number_format((float) $b, 2);  ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php if($item->type == 'Service'){ ?>
                        <tr>
                            <td colspan="6" style="padding: 0 0 3px 8px; border: 1px solid;border-top: solid white 1px;font-style:italic;">Description: <?= $item->description; ?></td>
                        </tr>
                        <?php } ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <tr>
                    <td colspan="3" rowspan="5">

                        <a href="<?= $payment_link; ?>" class="payinvoice">
                            <b>PAY INVOICE</b>
                        </a>

                        <?php
                        $paymentMethods = [];
                        if ($invoice->accept_credit_card) array_push($paymentMethods, 'Credit Card');
                        if ($invoice->accept_check) array_push($paymentMethods, 'Check');
                        if ($invoice->accept_cash) array_push($paymentMethods, 'Cash');
                        if ($invoice->accept_direct_deposit) array_push($paymentMethods, 'Direct Deposit');
                        ?>
                        <?php if (!empty($paymentMethods)) : ?>
                            <div style="text-align: center; margin-top: 16px;">
                                <strong>Accepted payment methods</strong>
                                <div>
                                    <?= implode(', ', $paymentMethods); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>SUBTOTAL (WITHOUT TAX)</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->sub_total, 2, '.', ','); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>TAXES</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->taxes, 2, '.', ','); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>GRAND TOTAL</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->grand_total, 2, '.', ','); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid;">
                        <b>DEPOSIT</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) $invoice->deposit_request, 2); ?></td>
                </tr>

                <tr>
                    <td colspan="2" style="padding: 8px; border: 1px solid; font-size: 20px;">
                        <b>BALANCE DUE</b>
                    </td>
                    <td style="padding: 8px; border: 1px solid;">$<?= number_format((float) ($invoice->grand_total - $invoice->deposit_request), 2); ?></td>
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