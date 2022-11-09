<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Inventory'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('inventory') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Inventory</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Inventory Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('inventory/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>