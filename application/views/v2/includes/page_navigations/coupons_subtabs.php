<div class="nsm-page-subnav" style="float: right;">
    <ul>
        <li class="<?php echo $active_tab == 'active' ? 'active' : ''; ?>" onclick="location.href='<?= base_url('more/addon/booking/coupons/coupon_tab/active')?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                Active <span>(<?php echo $total_active; ?>)</span>
            </a>
        </li>
        <li class="<?php echo $active_tab == 'closed' ? 'active' : ''; ?>" onclick="location.href='<?= base_url('more/addon/booking/coupons/coupon_tab/closed') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                Closed <span>(<?php echo $total_closed; ?>)</span>
            </a>
        </li>
    </ul>
</div>