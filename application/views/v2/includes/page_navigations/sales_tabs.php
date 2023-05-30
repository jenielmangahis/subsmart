<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Events' || $page->title == 'Event Tags' || $page->title == 'Event Types' || $page->title == "Event Scheduler Tool"): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('events') ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Events</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Jobs' || $page->title == 'Job Types' || $page->title == 'Job Tags' || $page->title == 'Bird\'s Eye View' || $page->title == 'Checklist' || $page->title == 'Job Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('job') ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Estimates' || $page->title == 'My Estimates' || $page->title == 'Plans' || $page->title == 'Estimate Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('estimate') ?>">
                <i class='bx bx-fw bx-chart'></i>
                <span>Estimates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder' || $page->title == 'Workorder Settings' || $page->title == 'Workorder Checklist' || $page->title == 'New Workorder' || $page->title == 'Solar Stimulus Data Control / 2022 - 2024' || $page->title == 'Alarm System Work Order Agreement'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('workorder') ?>">
                <i class='bx bx-fw bx-task'></i>
                <span>Work Orders</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Invoices & Payments' || $page->title == 'Recurring Invoices' || $page->title == 'Tax Rates' || $page->title == 'Invoice Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('invoice') ?>">
                <i class='bx bx-fw bx-receipt'></i>
                <span>Invoices</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Tickets'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/ticketslist') ?>">
                <i class='bx bx-fw bx-note'></i>
                <span>Service Tickets</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Marketing'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('credit_notes') ?>">
                <i class='bx bx-fw bx-file'></i>
                <span>Marketing</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Leads Manager List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('customer/leads') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Leads</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Workorder Type'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('workstatus') ?>">
                <i class='bx bx-fw bx-checkbox-square'></i>
                <span>Status</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>