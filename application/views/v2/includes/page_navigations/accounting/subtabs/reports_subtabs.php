<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Reports'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reports') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Standard</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Custom Reports'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reports/custom') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Custom Reports</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Management Reports'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reports/management') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Management Reports</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Activities Reports'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reports/activities') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Activities Reports</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Analytics'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reports/analytics') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Analytics</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'PayScale'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reports/payscale') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>PayScale</span>
            </a>
        </li>
    </ul>
</div>