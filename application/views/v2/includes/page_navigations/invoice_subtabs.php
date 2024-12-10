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
    </ul>
</div>