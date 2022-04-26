<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Email Templates' || $page->title == 'SMS Templates'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-window'></i>
                    <span>Email/SMS Templates</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('settings/email_templates') ?>">Email Templates</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('settings/sms_templates') ?>">SMS Templates</a></li>
                </ul>
            </div>
        </li>
        <li class="<?php if($page->title == 'Email Branding'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('settings/email_branding') ?>">
                <i class='bx bx-fw bx-envelope'></i>
                <span>Email Branding</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Notifications'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('settings/notifications') ?>">
                <i class='bx bx-fw bx-notification'></i>
                <span>Notifications</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Cards on File'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('cards_file/list') ?>">
                <i class='bx bx-fw bx-credit-card'></i>
                <span>Cards on File</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>