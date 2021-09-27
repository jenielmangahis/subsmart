<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dt-active-subscriptions">
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
                <?php foreach($activeSubscriptions as $as){ ?>
                    <td><?= $as->first_name . ' ' . $as->last_name; ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_start_date)); ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_end_date)); ?></td>
                    <td>
                        <?php 
                            $total_amount = $as->transaction_amount + $as->finance_amount;
                            echo number_format($total_amount, 2);
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="<?= base_url("customer/preview_/" . $as->fk_prof_id); ?>"><i class="fa fa-eye"></i> View</a>
                        <a class="btn btn-sm btn-primary btn-view-payment-history" href="javascript:void(0);" data-customer-id="<?= $as->fk_prof_id; ?>" data-billing-id="<?= $as->id; ?>"><i class="fa fa-eye"></i> Payment History</a>
                    </td>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>