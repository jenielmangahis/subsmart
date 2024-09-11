<table class="nsm-table">
    <thead>
        <tr>
            <td class="table-icon"></td>
            <td data-name="Customer Name">Customer Name</td>
            <td data-name="Recurring Start Date">Recurring Start Date</td>
            <td data-name="Recurring End Date">Recurring End Date</td>
            <td data-name="Amount" style="text-align:right;width:10%;">Subscription Amount</td>
            <td data-name="Manage" style="width:5%;"></td>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($completedSubscriptions)) :
        ?>
            <?php
            foreach ($completedSubscriptions as $as) :
            ?>
                <tr>
                    <td>
                        <div class="table-row-icon">
                            <i class='bx bx-user-pin'></i>
                        </div>
                    </td>
                    <td class="fw-bold nsm-text-primary"><?= $as->first_name . ' ' . $as->last_name; ?></td>
                    <td>
                        <?php 
                            $recurring_start_date = '---';
                            if( strtotime($as->recurring_start_date) > 0 ){
                                $recurring_start_date = date("m/d/Y", strtotime($as->recurring_start_date));
                            }
                        ?>
                        <?= $recurring_start_date; ?>
                    </td>
                    <td>
                        <?php 
                            $recurring_end_date = '---';
                            if( strtotime($as->recurring_end_date) > 0 ){
                                $recurring_end_date = date("m/d/Y", strtotime($as->recurring_end_date));
                            }
                        ?>
                        <?= $recurring_end_date; ?>
                    </td>
                    <td style="text-align:right;">
                        <?php
                            $total_amount = (float)$as->transaction_amount + (float)$as->finance_amount;
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
                                    <a class="dropdown-item" href="<?= base_url("customer/view_payment_history/" . $as->fk_prof_id); ?>">Payment History</a>
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