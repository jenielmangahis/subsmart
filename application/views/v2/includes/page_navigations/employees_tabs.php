<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Employees'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users') ?>">
                <i class='bx bx-fw bx-user-pin'></i>
                <span>Employees</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Attendance' || $page->title == 'My Schedule' || $page->title == 'Notification' || $page->title == 'Attendance Logs' || $page->title == 'Time Employee' || $page->title == 'Time Schedule' || $page->title == 'Requests' || $page->title == 'Shift Schedule' || $page->title == 'Timesheet Settings'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-spreadsheet'></i>
                    <span>Users Settings</span>
                    <!-- <span><?= $page->title ?></span> -->
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/attendance') ?>">Attendance</a></li>
                    <?php if (logged("role") < 5): ?>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/attendance_logs') ?>">Time Logs</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/notification') ?>">Notification</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/employee') ?>">Employee</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/schedule') ?>">Schedule</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/leave_requests') ?>">Leave Requests</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/requests') ?>">Overtime Requests</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/my_schedule') ?>">My Schedule</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/settings') ?>">Settings</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </li>
        <li class="<?php if($page->title == 'Track Location'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/tracklocation') ?>">
                <i class='bx bx-fw bx-map-pin'></i>
                <span>Track Location</span>
            </a>
        </li>
        <?php if( logged('user_type') == 7 ){ //Admin only ?>
        <li class="<?php if($page->title == 'Pay Scale'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/pay_scale') ?>">
                <i class='bx bx-fw bx-cog'></i>
                <span>Pay Scale</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Leave Types'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('leave_types') ?>">
                <i class='bx bx-fw bx-cog'></i>
                <span>Leave Types</span>
            </a>
        </li>
        <?php } ?>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>