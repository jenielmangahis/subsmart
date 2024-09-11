<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Schedule'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('workcalender') ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Schedule</span>
            </a>
        </li>
        <!-- <li class="<?php if($page->title == 'Task Hub' || $page->title == 'Task'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('taskhub') ?>">
                <i class='bx bx-fw bx-task'></i>
                <span>TaskHub</span>
            </a>
        </li> -->
        <!-- <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('more/addon/booking') ?>">
                <i class='bx bx-fw bx-book-content'></i>
                <span>Online Booking</span>
            </a>
        </li> -->
        <!-- <li class="<?php if($page->title == 'Priority'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('workorder/priority/') ?>">
                <i class='bx bx-fw bx-list-check'></i>
                <span>Priority</span>
            </a>
        </li> -->
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('job/bird_eye_view') ?>">
                <i class='bx bx-fw bx-show-alt'></i>
                <span>Bird's Eye View</span>
            </a>
        </li>
        <!-- <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('event_types/index') ?>">
                <i class='bx bx-fw bx-calendar-minus'></i>
                <span>Event Types</span>
            </a>
        </li> -->
        <li class="<?php if($page->title == 'Appointment Types'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('appointment_types/index') ?>">
                <i class='bx bx-fw bx-book-add'></i>
                <span>Appointment Types</span>
            </a>
        </li>
        <!-- <li class="<?php if($page->title == 'Color Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('color_settings/index') ?>">
                <i class='bx bx-fw bx-brush'></i>
                <span>Color Settings</span>
            </a>
        </li> -->
        <li class="<?php if($page->title == 'Calendar Settings'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('settings/schedule') ?>">
                <i class='bx bx-fw bx-calendar-edit'></i>
                <span>Calendar Settings</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>