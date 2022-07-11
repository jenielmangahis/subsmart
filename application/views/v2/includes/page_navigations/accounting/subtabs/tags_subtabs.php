<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Tags'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/tags') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Tags</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Transactions by tag'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/tags/transactions') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Transactions by tag</span>
            </a>
        </li>
    </ul>
</div>