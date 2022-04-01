<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Events'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('events') ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Events</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Event Types'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('event_types/index') ?>">
                <i class='bx bx-fw bx-book'></i>
                <span>Event Types</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Event Tags'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('events/event_tags') ?>">
                <i class='bx bx-fw bx-tag'></i>
                <span>Event Tags</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>