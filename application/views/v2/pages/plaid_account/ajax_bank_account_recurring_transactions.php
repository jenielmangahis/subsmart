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
                <td data-name="FirstDate">First Payment Date</td>
                <td data-name="LastDate">Last Payment Date</td>
                <td data-name="Frequency">Frequency</td>
                <td data-name="LastAmount">Last Amount Paid</td>
            </tr>
        </thead>
        <tbody>
        <?php foreach($apiPlaidRecurringTransactions->outflow_streams as $os){ ?>
            <tr>
                <td><?= $os->description; ?></td>
                <td><?= date("Y-m-d", strtotime($os->first_date)); ?></td>
                <td><?= date("Y-m-d", strtotime($os->last_date)); ?></td>
                <td><?= $os->frequency; ?></td>
                <td><?= $os->last_amount->amount; ?></td>
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