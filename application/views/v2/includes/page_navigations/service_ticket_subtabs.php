<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Tickets' || $page->title == 'Service Tickets'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('customer/tickets') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>List</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Panel Types'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('tickets/settings_panel_types') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Panel Types</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Plan Types'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('tickets/settings_plan_types') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Plan Types</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Service Ticket Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('tickets/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
    </ul>
</div>