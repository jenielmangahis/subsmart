<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Payroll Overview'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url(); ?>accounting/payroll-overview">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Overview</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Employees' || $page->title == 'Paycheck list'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url(); ?>accounting/employees">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Employees</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Contractors'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url(); ?>accounting/contractors">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Contractors</span>
            </a>
        </li>
        <li class="<?php if($page->title == "Workers' Comp"): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url(); ?>accounting/workers-comp">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Workers' Comp</span>
            </a>
        </li>
        <li class="<?php if($page->title == "Worksites"): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url(); ?>accounting/worksites">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Worksites</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>