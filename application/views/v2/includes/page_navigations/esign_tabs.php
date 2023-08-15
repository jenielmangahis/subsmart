<div class="nsm-page-nav">
    <ul>
        <li class="">
            <a class="nsm-page-link" href="<?= base_url('eSign_v2/manage?view=inbox') ?>">
                <i class='bx bx-fw bx-task'></i>
                <span>eSign</span>
            </a>
        </li>
        <li class="">
            <a class="nsm-page-link" href="<?= base_url('eSign_v2/templateCreate') ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>eSign Builder</span>
            </a>
        </li>
        <li class="">
            <a class="nsm-page-link" href="<?= base_url('EsignEditor_v2/create') ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>eSign Editor</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'eSign Manager'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('eSign_v2/manager') ?>">
                <i class='bx bx-fw bx-chart'></i>
                <span>eSign Manager</span>
            </a>
        </li>  
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>