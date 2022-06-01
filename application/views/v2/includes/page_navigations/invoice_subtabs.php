<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Invoices & Payments'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('invoice') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Invoices & Payments</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Recurring Invoices'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('invoice/recurring') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Recurring Invoices</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Tax Rates'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('settings/tax_rates') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Tax Rates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Invoice Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('invoice/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>