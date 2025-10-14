<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Invoices & Payments' || $page->title == 'Recurring Invoices'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('invoice') ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices</span>
            </a>
        <!-- Do not remove the last li -->
        <?php //if (logged('user_type') == 7) { ?>
        <li class="<?php if($page->title == 'Invoice Settings' || $page->title == 'Tax Rates' || $page->title == 'Payment Terms'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-cog'></i>
                    <span>Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?= base_url('invoice/settings') ?>">Invoice</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('settings/tax_rates') ?>">Tax Rates</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('accounting/terms') ?>">Payment Terms</a></li>                                        
                </ul>
            </div>
        </li>
        <?php //} ?>
        <li><label></label></li>
    </ul>
</div>