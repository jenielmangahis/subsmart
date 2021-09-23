<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dt-completed-subscriptions">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Recurring Start Date</th>
                    <th>Recurring End Date</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($completedSubscriptions as $as){ ?>
                    <td><?= $as->first_name . ' ' . $as->last_name; ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_start_date)); ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_end_date)); ?></td>
                    <td>
                        <?php 
                            $total_amount = $as->transaction_amount + $as->finance_amount;
                            echo number_format($total_amount, 2);
                        ?>
                    </td>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>