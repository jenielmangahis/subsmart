<div class="row">
    <div class="col-xl-12 col-md-12">
        <table id="dt-error-subscriptions">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Date</th>
                    <th>Error Message</th>
                    <th>Amount</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($errorSubscriptions as $as){ ?>
                <tr>
                    <td><?= $as->first_name . ' ' . $as->last_name; ?></td>
                    <td><?= date("d-M-Y", strtotime($as->error_date)); ?></td>
                    <td><?= $as->error_message; ?></td>
                    <td>
                        <?php 
                            $total_amount = (float)$as->transaction_amount + (float)$as->finance_amount;
                            echo number_format($total_amount, 2);
                        ?>
                    </td>
                    <td>
                        <a class="btn btn-sm btn-primary btn-fix-cc-error" data-id="<?= $as->bill_id; ?>" href="javascript:void(0);"><i class="fa fa-pencil"></i> Fix</a>
                        <a class="btn btn-sm btn-primary" href="<?= base_url("customer/subscription/" . $as->fk_prof_id); ?>"><i class="fa fa-eye"></i> View</a>
                        <a class="btn btn-sm btn-primary btn-view-payment-history" href="javascript:void(0);" data-customer-id="<?= $as->fk_prof_id; ?>" data-billing-id="<?= $as->id; ?>"><i class="fa fa-eye"></i> Payment History</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>