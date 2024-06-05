<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Email Automation'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('email_automation') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Email Automation</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Default Templates'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('email_automation/templates') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Default Templates</span>
            </a>
        </li>
    </ul>
</div>