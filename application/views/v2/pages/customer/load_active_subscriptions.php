<table class="nsm-table">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="CustomerName">Customer Name</td>
            <td data-name="CustomerAddress">Address</td>
            <td data-name="CustomerEmail">Email</td>
            <td data-name="CustomerPhone">Phone Number</td>
            <td data-name="DateStart">Start Date</td>
            <td data-name="DateEnd">End Date</td>
            <td data-name="Amount">Subscription Amount</td>
            <td data-name="Manage"></td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($activeSubscriptions)) :
        ?>
            <?php
            foreach ($activeSubscriptions as $as) :
            ?>
                <tr>
                    <td>
                        <?php $n = ucwords($as->first_name[0]).ucwords($as->last_name[0]); ?>
                        <div class='nsm-profile'><span><?= $n; ?></span></div>
                    </td>
                    <td class="fw-bold nsm-text-primary"><?= $as->first_name . ' ' . $as->last_name; ?></td>
                    <td>
                        <?php $address = $as->mail_add . ' ' . $as->city . ', ' . $as->state . ' ' . $as->zip_code; ?>
                        <?= $address; ?>
                    </td>
                    <td><?= formatPhoneNumber($as->phone_m); ?></td>
                    <td><?= $as->email; ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_start_date)); ?></td>
                    <td><?= date("d-M-Y", strtotime($as->recurring_end_date)); ?></td>
                    <td>
                        <?php
                            //$total_amount = (float)$as->transaction_amount + (float)$as->finance_amount;
                            $total_amount   = (float)$as->mmr;
                            echo number_format($total_amount, 2);
                        ?>
                    </td>
                    <td>
                        <div class="dropdown table-management">
                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="<?= base_url("customer/subscription/" . $as->fk_prof_id); ?>">View</a>
                                </li>
                                <li>
                                    <a class="dropdown-item view-payment-item" href="javascript:void(0);" data-customer-id="<?= $as->fk_prof_id; ?>" data-billing-id="<?= $as->id; ?>">Payment History</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php
            endforeach;
            ?>
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