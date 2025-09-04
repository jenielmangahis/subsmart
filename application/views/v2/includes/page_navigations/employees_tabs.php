<div class="nsm-page-nav">
    <ul>
        <li class="<?php if ($page->title == 'Employees'): echo 'active';
                    endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users') ?>">
                <i class='bx bx-fw bx-user-pin'></i>
                <span>Employees</span>
            </a>
        </li>
        <?php if (logged('user_type') == 7) { ?>
            <li class="<?php if ($page->title == 'Time Employee' || $page->title == 'Employees Timesheet'): echo 'active';
                    endif; ?>">
                <a class="nsm-page-link" href="<?php echo base_url('timesheet/employee') ?>">
                    <i class='bx bx-fw bx-time'></i>
                    <span>Timesheet</span>
                </a>
            </li>
        <?php } ?>
        <li class="<?php if ($page->title == 'Attendance' || $page->title == 'My Schedule' || $page->title == 'Notification' || $page->title == 'Attendance Logs' || $page->title == 'Time Schedule' || $page->title == 'Requests' || $page->title == 'Role Access Modules' || $page->title == 'Shift Schedule' || $page->title == 'Timesheet Settings'): echo 'active';
                    endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-spreadsheet'></i>
                    <span>Users Settings</span>
                    <!-- <span><?= $page->title ?></span> -->
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/attendance') ?>">Attendance</a></li>    
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/attendance_logs') ?>">Time Logs</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/notification') ?>">Notification</a></li>

                    <?php if (logged("user_type") == 7): ?>
                        <li><a class="dropdown-item" href="<?php echo base_url('timesheet/schedule') ?>">Schedule</a></li>
                    <?php endif; ?>

                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/leave_requests') ?>">Leave Requests</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/overtime_requests') ?>">Overtime Requests</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('timesheet/my_schedule') ?>">My Schedule</a></li>
                    <?php if( logged('user_type') == 7 ){ //Admin only ?>
                        <li><a class="dropdown-item" href="<?php echo base_url('users/role_access_modules') ?>">Roles Access Modules</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('timesheet/settings') ?>">Timesheet Settings</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('leave_types') ?>">Leave Types</a></li>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <li class="<?php if ($page->title == 'Track Location'): echo 'active';
                    endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/tracklocation') ?>">
                <i class='bx bx-fw bx-map-pin'></i>
                <span>Track Location</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>
<?php
// Assuming logged("user_type") returns the user's type
$user_type = logged("user_type");
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var userType = <?php echo $user_type; ?>; // Pass the user_type to JavaScript

        if (window.location.pathname === '/timesheet/schedule' && userType !== 7) {
            window.location.href = "<?php echo base_url('dashboard') ?>";
        }
    });
</script>