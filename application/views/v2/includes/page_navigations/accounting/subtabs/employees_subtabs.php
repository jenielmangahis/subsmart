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
    </ul>
</div>