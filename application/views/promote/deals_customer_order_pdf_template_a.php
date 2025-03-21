<table style="width: 100%;">
    <tr>
        <td>
            <img style="width: 200px;" alt="Attachment" src="<?= dirname(__DIR__, 3) . '/assets/dashboard/images/logo.png' ?>">
        </td>
        <td style="vertical-align: top;text-align: right;">
            <span style="margin-bottom: 4px;font-size: 30px;">ORDER</span><br>
            <span style="font-size: 12px;line-height:30px;">#<?= $dealsSteals->order_number; ?></span>
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
        <td><?= date("d-M-Y", strtotime($orderPayments->date_paid)); ?></td>
    </tr>
    <tr>
        <td style="width: 30%;">Status:</td>
        <td><?= ucfirst($orderPayments->status) ?></td>
    </tr>
    <tr>
        <td style="width: 30%;">Payment Method:</td>
        <td><?= ucfirst($orderPayments->payment_method) ?></td>
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
        <td><?= strtoupper($dealsSteals->title); ?></td>
        <td>1</td>
        <td>Deal : <?= strtoupper($dealsSteals->title); ?><br/>Valid : <?= date("d-M-Y",strtotime($dealsSteals->valid_from)) . " to " . date("d-M-Y",strtotime($dealsSteals->valid_to)); ?>
        </td>
        <td style="text-align: right;">$<?= number_format($dealsSteals->total_cost, 2); ?></td>
    </tr>
    <tr>
        <td colspan="4"></td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: right"><b>Total ($)</b></td>
        <td style="text-align: right"><b>$<?= number_format($dealsSteals->total_cost, 2); ?></b></td>
    </tr>
</table>
<div></div>
<hr/>
<p>This order was created by nSmarTrac through nSmarTrac Platform</p>
