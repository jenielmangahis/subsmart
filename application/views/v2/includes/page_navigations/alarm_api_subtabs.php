<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Events'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('events') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Customer Lists</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Event Types'): echo 'active'; endif; ?>"  onclick="location.href='<?= base_url('events/event_types') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Dealer</span>
            </a>
        </li>
    </ul>
</div>