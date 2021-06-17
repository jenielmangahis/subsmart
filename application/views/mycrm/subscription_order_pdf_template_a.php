<table style="width: 100%;">
    <tr>
        <td>
            <img style="width: 200px;" alt="Attachment" src="<?= dirname(__DIR__, 3) . '/assets/dashboard/images/logo.png' ?>">
        </td>
        <td style="vertical-align: top;text-align: right;">
            <span style="margin-bottom: 4px;font-size: 30px;">ORDER</span><br>
            <span style="font-size: 12px;line-height:30px;">#<?= $payment->order_number; ?></span>
        </td>
    </tr>
</table>
<hr/>
<div></div>
<div></div>
<p><b>ORDER DETAILS</b></p>
<table style="widows: 100%;">
    <tr>
        <td style="width: 30%;">Date:</td>
        <td><?= date("d-M-Y", strtotime($payment->payment_date)); ?></td>
    </tr>
    <tr>
        <td style="width: 30%;">Payment Method:</td>
        <td>CC</td>
    </tr>
    <tr>
        <td style="width: 30%;">Customer Name:</td>
        <td><?= $company->business_name; ?></td>
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
        <td colspan="3" style="text-align: right"><b>Total ($)</b></td>
        <td style="text-align: right"><b>$<?= number_format($payment->total_amount, 2); ?></b></td>
    </tr>
</table>
<div></div>
<hr/>
<p>This order was created by nSmarTrac through nSmarTrac Platform</p>
