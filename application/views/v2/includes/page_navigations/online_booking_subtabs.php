<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Dashboard'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Products'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/products') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>My Service / Items</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Time Slots'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/time') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Time Slots</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Booking Form'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/form') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Booking Form</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Coupons'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/coupons') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Coupons</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Preview'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/booking/preview') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Web Integration</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Inquiry'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('more/addon/inquiries') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Inquiry</span>
            </a>
        </li>
    </ul>
</div>