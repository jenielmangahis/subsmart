<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Recurring Transactions'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/recurring-transactions'); ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Recurring Transactions</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Recurring Transaction Payments'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/recurring-transactions-payments'); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Payments</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>