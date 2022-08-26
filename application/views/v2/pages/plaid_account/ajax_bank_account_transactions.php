<?php if($is_valid == 1){ ?>
    <?php foreach( $apiPlaidAccount->accounts as $pa ){ ?>
        <table class="table">
            <thead>
                <tr>
                    <td>Account Name</td>
                    <td><b><?= $pa->name; ?> / <?= $pa->official_name; ?></b></td>
                </tr>
                <tr>
                    <td>Type</td>
                    <td><b><?= ucwords($pa->subtype); ?></b></td>
                </tr>
                <tr>
                    <td>Balance</td>
                    <td><?= number_format($pa->balances->current,2) . ' ' . $pa->balances->iso_currency_code; ?></td>
                </tr>
            </thead>
        </table>
    <?php } ?>
    <table class="nsm-table">
        <thead>
            <tr>
                <td data-name="TransactionMade">Description</td>
                <td data-name="Date">Date</td>
                <td data-name="Amount">Amount</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach($apiPlaidTransactions->transactions as $t){ ?>
            <tr>
                <td><?= $t->name; ?></td>
                <td><?= date("Y-m-d", strtotime($t->date)); ?></td>
                <td><?= $t->amount . ' ' . $t->iso_currency_code; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>    
<?php }else{ ?>
<div class="nsm-empty">
    <i class="bx bx-meh-blank"></i>
    <span>Invalid Bank Account</span>
</div>
<?php } ?>
<script type="text/javascript">
$(document).ready(function() {
    $(".nsm-table").nsmPagination(); 
});
</script>