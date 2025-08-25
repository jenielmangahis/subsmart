<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Employees'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/employees') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Employees</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Paycheck list'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/employees/paycheck-list') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Paycheck list</span>
            </a>
        </li>
        <?php if (logged('user_type') == 7) { ?>
        <li class="<?php if($page->title == 'Payscale' || $page->title == 'Job Titles'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <span>Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('users/pay_scale') ?>">Payscale</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('users/job_titles') ?>">Job Title</a></li>
                </ul>
            </div>
        </li>
        <?php } ?>
    </ul>
</div>