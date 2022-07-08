<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Chart of Accounts'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/chart-of-accounts') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Chart of Accounts</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'All Lists'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/lists') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>All Lists</span>
            </a>
        </li>
    </ul>
</div>