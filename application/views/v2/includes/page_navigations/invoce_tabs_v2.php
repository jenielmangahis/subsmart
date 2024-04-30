<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Invoices & Payments' || $page->title == 'Recurring Invoices' || $page->title == 'Tax Rates' || $page->title == 'Invoice Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('invoice') ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices</span>
            </a>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>