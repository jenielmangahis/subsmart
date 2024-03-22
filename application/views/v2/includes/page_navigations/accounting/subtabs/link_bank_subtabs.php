<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Link Bank'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/link_bank') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>For review</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Categorized Link Bank'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/categorized_link_bank') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Categorized</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Excluded Link Bank'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/excluded_link_bank') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Excluded</span>
            </a>
        </li>
    </ul>
</div>
