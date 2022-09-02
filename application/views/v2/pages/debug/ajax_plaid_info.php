<div class="col-12">
    <?php 
        /*echo "<pre>";
        print_r($plaidIdentity);
        print_r($plaidAccount);*/
    ?>    
    <?php foreach($plaidIdentity->accounts as $account){ ?>
        <table class="table">
            <tr>
                <td>Account ID</td>
                <td><B<?= $account->account_id; ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?= $account->name; ?></td>
            </tr>
            <tr>
                <td>Official Name</td>
                <td><?= $account->official_name; ?></td>
            </tr>
            <tr>
                <td>Owners</td>
                <td>
                    <?php foreach($account->owners as $owner){ ?>
                        <ul>
                            <li>Names : <?= implode(",", $owner->names); ?></li>
                            <li>Emails : <br />
                                <?php foreach($owner->emails as $email){ ?>
                                    <?= $email->data . '/' . $email->type . '<br/>'; ?>
                                <?php } ?>
                            </li>
                            <li>Phone Numbers : <br /> 
                                <?php foreach($owner->phone_numbers as $phone){ ?>
                                    <?= $phone->data . '/' . $phone->type . '<br/>'; ?>
                                <?php } ?>
                            </li>
                        </ul>
                    <?php } ?>
                </td>
            </tr>  
        </table>      
    <?php } ?>
    <h3>Balance for selected Institution</h3>
    <table class="table">
        <tr>
            <td>Institution</td>
            <td>Balance Available</td>
            <td>Balance Current</td>
            <td>Currency</td>
        </tr>
        <?php foreach($plaidBalance->accounts as $b){ ?>
            <tr>
                <td><?= $b->official_name; ?></td>
                <td><?= $b->balances->available; ?></td>
                <td><?= $b->balances->current; ?></td>
                <td><?= $b->balances->iso_currency_code; ?></td>
            </tr>
        <?php } ?>
    </table>

    <h3>Accounts</h3>
    <table class="table">
        <tr> 
            <td>Type</td>           
            <td>Account Number</td>
            <td>Account ID</td>
            <td>Routing</td>
            <td>Wire Routing</td>
        </tr>
    <?php foreach($plaidAccount->numbers->ach as $ach){ ?>
        <tr>
            <td>ACH</td>
            <td><?= $ach->account; ?></td>
            <td><?= $ach->account_id; ?></td>
            <td><?= $ach->routing; ?></td>
            <td><?= $ach->wire_routing; ?></td>
        </tr>
    <?php } ?>
    <?php foreach($plaidAccount->numbers->bacs as $bacs){ ?>
        <tr>
            <td>BACS</td>
            <td><?= $bacs->account; ?></td>
            <td><?= $bacs->account_id; ?></td>
            <td><?= $bacs->routing; ?></td>
            <td><?= $bacs->wire_routing; ?></td>
        </tr>
    <?php } ?>
    <?php foreach($plaidAccount->numbers->eft as $eft){ ?>
        <tr>
            <td>EFT</td>
            <td><?= $eft->account; ?></td>
            <td><?= $eft->account_id; ?></td>
            <td><?= $eft->routing; ?></td>
            <td><?= $eft->wire_routing; ?></td>
        </tr>
    <?php } ?>
    <?php foreach($plaidAccount->numbers->international as $international){ ?>
        <tr>
            <td>International</td>
            <td><?= $international->account; ?></td>
            <td><?= $international->account_id; ?></td>
            <td><?= $international->routing; ?></td>
            <td><?= $international->wire_routing; ?></td>
        </tr>
    <?php } ?>
    </table>

    <h3>Transactions</h3>
    <table class="table">
        <tr>
            <td>Transaction Made</td>
            <td>Date</td>
            <td>Amount</td>
        </tr>
        <?php foreach($plaidTransactions->transactions as $t){ ?>
            <tr>
                <td><?= $t->name; ?></td>
                <td><?= date("Y-m-d", strtotime($t->date)); ?></td>
                <td><?= $t->amount . ' ' . $t->iso_currency_code; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>