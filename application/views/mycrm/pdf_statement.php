<table style="width: 100%;">
    <tr>
        <td>
            <img style="width: 200px;" alt="Attachment" src="<?php echo dirname(__DIR__, 3).'/assets/dashboard/images/logo.png'; ?>">
        </td>
        <td style="vertical-align: top;text-align: right;">
            <span style="margin-bottom: 4px;font-size: 30px;">PDF Statement</span><br>
            <span style="font-size: 12px;line-height:30px;">#<?php echo $payment->order_number; ?></span>
        </td>
    </tr>
</table>
<hr/>
<div></div>
<div></div>
<table style="width: 100%;">
    <tr>
        <td>
            <b>The nSmarTrac</b><br>
            6866 Pine Forest Road<br>
            Florida Headquarters<br>
            Pensacola, FL 32526<br>
            <br>
            <b><?php echo $company->business_name; ?></b><br>
            <?php echo $company->business_email; ?><br>
            <?php echo $company->address; ?>
        </td>
        <td style="vertical-align: top;text-align: right;">
            <table>
                <tr>
                    <td align="right">Date Issued:</td>
                    <td align="right"><?php echo date('d-M-Y', strtotime($payment->payment_date)); ?></td>
                </tr>
                <tr>
                    <td align="right">Type:</td>
                    <td align="right">Purchase</td>
                </tr>
                <tr>
                    <td align="right">Payment Method:</td>
                    <td align="right">CC</td>
                </tr>
                <tr>
                    <td align="right"><b>Balance Due</b>:</td>
                    <td align="right"><b>$<?php echo number_format($payment->total_amount, 2); ?></b></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div></div>
<div></div>
<table style="width: 100%;padding: 3px;">
    <tr>
        <td style="background-color: #454545;color: #ffffff;"><b>Item</b></td>
        <td style="background-color: #454545;color: #ffffff;width: 80px;"><b>Qty</b></td>
        <td style="background-color: #454545;color: #ffffff;width: 200px;"><b>Details</b></td>
        <td style="background-color: #454545;color: #ffffff;text-align: right;"><b>Subtotal</b></td>
    </tr>
    <tr>
        <td>
            <?php
                if ($payment->description == 'Paid Plan License') {
                    echo 'nSmarTrac License';
                } else {
                    echo 'nSmarTrac Subscription';
                }
            ?>
        </td>
        <td>1</td>
        <td><?php echo $payment->description; ?></td>
        <td style="text-align: right;">$<?php echo number_format($payment->total_amount, 2); ?></td>
    </tr>
    <tr>
        <td colspan="4"><hr/></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right"><b>Total</b></td>
        <td style="text-align: right"><b>$<?php echo number_format($payment->total_amount, 2); ?></b></td>
    </tr>
</table>
<div></div>

<p>Term of payment: By reviewing your statement of products and services, you agree to make payment in full by the specified due date. If a credit card or payment method is on file, payment will be processed automatically; please ensure the card details are current to avoid any payment delays, which may result in account restrictions. Any bank holds or limitations on funds availability are the responsibility of the cardholder's issuing bank and may affect access to our products and services. Our company is unable to expedite the release of bank holds, so please contact your issuing bank directly for assistance with any pending holds. We appreciate your business and prompt attention to this payment. Should you have any questions or require further assistance, please do not hesitate to reach out to us.</p>
<div></div>
<div></div>
