<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Expenses'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/expenses'); ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Expenses</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Check'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/v2/check'); ?>">
                <i class="fas fa-file-signature"></i>&nbsp;
                <span>Check</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Vendors'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/vendors'); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Vendors</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>