<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Preview Deals'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('promote/view_deals/' . $dealsSteals->id); ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Preview Deals</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Bookings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('promote/bookings/' . $dealsSteals->id); ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Bookings</span>
            </a>
        </li>
    </ul>
</div>