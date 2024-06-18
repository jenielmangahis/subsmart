<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Events'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('events') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Lists</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Event Types'): echo 'active'; endif; ?>"  onclick="location.href='<?= base_url('events/event_types') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Event Types</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Event Tags'): echo 'active'; endif; ?>"  onclick="location.href='<?= base_url('events/event_tags') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Event Tags</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Event Settings'): echo 'active'; endif; ?>"  onclick="location.href='<?= base_url('events/settings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Event Settings</span>
            </a>
        </li>
    </ul>
</div>