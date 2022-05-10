<div class="nsm-page-nav">
    <ul>
        <li class="<?= $page_title == 'Events' ? 'active' : ''; ?>">
            <a class="nsm-page-link" href="<?= base_url('admin/events') ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Events</span>
            </a>
        </li>
        <li class="<?= $page_title == 'Event Types' ? 'active' : ''; ?>">
            <a class="nsm-page-link" href="<?= base_url('admin/event_types') ?>">
                <i class='bx bx-fw bx-book'></i>
                <span>Event Types</span>
            </a>
        </li>
        <li class="<?= $page_title == 'Event Tags' ? 'active' : ''; ?>">
            <a class="nsm-page-link" href="<?= base_url('admin/event_tags') ?>">
                <i class='bx bx-fw bx-tag'></i>
                <span>Event Tags</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>