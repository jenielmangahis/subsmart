<table class="nsm-table">
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
        if (!empty($activeSubscriptions)) :
        ?>
            <?php
            foreach ($paymentHistory as $ph) :
                $total_payment += $ph->subtotal;
            ?>
                <tr>
                    <td class="fw-bold nsm-text-primary"><?= $ph->method; ?></td>
                    <td><?= $ph->transaction_type; ?></td>
                    <td><?= date("d-M-Y h:i:s", strtotime($ph->datetime)); ?></td>
                    <td><?= number_format($ph->subtotal, 2); ?></td>
                </tr>
            <?php
            endforeach;
            ?>
            <tr>
                <td class="fw-bold nsm-text-primary" colspan="3">Total</td>
                <td><?= number_format($total_payment, 2); ?></td>
            </tr>
        <?php
        else :
        ?>
            <tr>
                <td colspan="11">
                    <div class="nsm-empty">
                        <span>No results found.</span>
                    </div>
                </td>
            </tr>
        <?php
        endif;
        ?>
    </tbody>
</table>