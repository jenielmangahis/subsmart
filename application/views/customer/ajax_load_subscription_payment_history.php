<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dt-payment-history">
            <thead>
                <tr>
                    <th>Payment Method</th>
                    <th>Transaction Type</th>
                    <th>Date / Time</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php $total_payment = 0; ?>
                <?php foreach($paymentHistory as $ph){ ?>
                    <?php $total_payment += $ph->subtotal; ?>
                    <tr>
                        <td><?= $ph->method; ?></td>
                        <td><?= $ph->transaction_type; ?></td>
                        <td><?= date("d-M-Y h:i:s", strtotime($ph->datetime)); ?></td>
                        <td style="text-align:right;"><?= number_format($ph->subtotal, 2); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td style="text-align:right;"><b><?= number_format($total_payment, 2); ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>