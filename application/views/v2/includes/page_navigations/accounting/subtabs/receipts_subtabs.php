<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Receipts'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/receipts') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>For review</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Reviewed Receipts'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/receipts/reviewed') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Reviewed</span>
            </a>
        </li>
    </ul>
</div>