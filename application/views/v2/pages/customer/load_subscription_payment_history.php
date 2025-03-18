<?php ?>
<p style="font-size:15px;font-weight:bold;margin-bottom:20px;">TOTAL PAYMENTS : $<?= $totalSubscriptionPayment->total_payments; ?></p>
<table class="nsm-table" id="subscription-payments">
    <thead>
        <tr>
            <td data-name="Payment Method">Payment Method</td>
            <td data-name="Transaction Type">Transaction Type</td>
            <td data-name="Date/Time">Date/Time</td>
            <td data-name="Amount">Amount</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_payment = 0;
        if ($paymentHistory) :
        ?>
            <?php foreach ($paymentHistory as $ph) :
                $total_payment += $ph->subtotal;
                $transaction_type = ucwords($ph->transaction_type);
                $payment_method   = ucwords($ph->method);
                if( $ph->method == 'cc' ){
                    $payment_method = 'Credit Card';
                }
            ?>
                <tr>
                    <td class="fw-bold nsm-text-primary"><?= $payment_method; ?></td>
                    <td><?= $transaction_type; ?></td>
                    <td><?= date("m/d/Y h:i:s", strtotime($ph->datetime)); ?></td>
                    <td><?= number_format($ph->subtotal, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4">
                    <div class="nsm-empty">
                        <span>No results found.</span>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
<script>
$(function(){
    $("#subscription-payments").nsmPagination({itemsPerPage:5});
});
</script>