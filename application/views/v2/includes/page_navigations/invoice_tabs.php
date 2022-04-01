<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Invoices & Payments'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("invoice") ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices & Payments</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Recurring Invoices'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('invoice/recurring') ?>">
                <i class='bx bx-fw bx-repeat'></i>
                <span>Recurring Invoices</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Tax Rates'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('settings/tax_rates') ?>">
                <i class='bx bx-fw bx-dollar-circle'></i>
                <span>Tax Rates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Invoice Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('invoice') . '/settings' ?>">
                <i class='bx bx-fw bx-cog'></i>
                <span>Settings</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>