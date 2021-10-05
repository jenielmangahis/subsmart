<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dt-completed-subscriptions">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Recurring Start Date</th>
                    <th>Recurring End Date</th>
                    <th>Total Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($completedSubscriptions as $as){ ?>
                <tr>
                    <td><?= $as->first_name . ' ' . $as->last_name; ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_start_date)); ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_end_date)); ?></td>
                    <td>
                        <?php 
                            $total_amount = (float)$as->transaction_amount + (float)$as->finance_amount;
                            echo number_format($total_amount, 2);
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?= base_url("customer/subscription/" . $as->fk_prof_id); ?>"><i class="fa fa-eye"></i> View</a>
                        <a class="btn btn-sm btn-primary" href="<?= base_url("customer/view_payment_history/" . $as->fk_prof_id); ?>"><i class="fa fa-eye"></i> Payment History</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>