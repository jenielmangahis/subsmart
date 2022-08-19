<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Dashboard'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Credit</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Products'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/products') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>My Workspace</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Time Slots'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/time') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Add Template</span>
            </a>
        </li>
    </ul>
</div>