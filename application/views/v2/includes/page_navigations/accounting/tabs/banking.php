<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Link Bank'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/link_bank'); ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Link Bank</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Rules'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/rules'); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Rules</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Receipts' || $page->title == 'Reviewed Receipts'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/receipts'); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Receipts</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Tags' || $page->title == 'Transactions by tag'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo site_url('accounting/tags'); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Tags</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>