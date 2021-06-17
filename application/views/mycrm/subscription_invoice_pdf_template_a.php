<table style="width: 100%;">
    <tr>
        <td>
            <img style="width: 200px;" alt="Attachment" src="<?= dirname(__DIR__, 3) . '/assets/dashboard/images/logo.png' ?>">
        </td>
        <td style="vertical-align: top;text-align: right;">
            <span style="margin-bottom: 4px;font-size: 30px;">INVOICE</span><br>
            <span style="font-size: 12px;line-height:30px;">#<?= $payment->order_number; ?></span>
        </td>
    </tr>
</table>
<hr/>
<div></div>
<div></div>
<table style="width: 100%;">
    <tr>
        <td>
            <b>FROM</b><br>
            <b>The nSmarTrac</b><br>
            6866 Pine Forest Road<br>
            Florida Headquarters<br>
            Pensacola, FL 32526<br>
            <br>
            <b>TO</b><br>
            <b><?= $company->business_name; ?></b><br>
            <?= $company->business_email; ?>
        </td>
        <td style="vertical-align: top;text-align: right;">
            <table>
                <tr>
                    <td align="right">Date Issued:</td>
                    <td align="right"><?= date("d-M-Y", strtotime($payment->payment_date)); ?></td>
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
                    <td align="right">$0.00</td>
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
        <td>NSMART SUBSCRIPTION</td>
        <td>1</td>
        <td><?= $payment->description; ?></td>
        <td style="text-align: right;">$<?= number_format($payment->total_amount, 2); ?></td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right"><b>Total</b></td>
        <td style="text-align: right"><b>$<?= number_format($payment->total_amount, 2); ?></b></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right">Payment Due</td>
        <td style="color:red;text-align: right;">(-) $<?= number_format($payment->total_amount, 2); ?></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right"><b>Balance Due</b></td>
        <td style="text-align: right"><b>$0.00</b></td>
    </tr>
</table>
<div></div>
<hr/>
<p>This invoice was created by nSmarTrac through nSmarTrac Platform</p>
