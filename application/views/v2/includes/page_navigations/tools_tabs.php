<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'API Connectors'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/api_connectors') ?>">
                <i class='bx bx-fw bx-git-repo-forked'></i>
                <span>API Connectors</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Google Contacts'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/google_contacts') ?>">
                <i class='bx bx-fw bxl-google'></i>
                <span>Google Contacts</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Quickbooks Payroll'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/quickbooks') ?>">
                <i class='bx bx-fw bx-extension'></i>
                <span>Quickbooks Payroll</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Nice Job'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/nicejob') ?>">
                <i class='bx bx-fw bx-extension'></i>
                <span>Nicejob</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Zapier'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/zapier') ?>">
                <i class='bx bx-fw bx-extension'></i>
                <span>Zapier</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'MailChimp'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/mailchimp') ?>">
                <i class='bx bx-fw bxl-mailchimp'></i>
                <span>Mailchimp</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Active Campaign'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/active_campaign') ?>">
                <i class='bx bx-fw bxs-megaphone'></i>
                <span>Active Campaign</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'API Integration'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/api_integration') ?>">
                <i class='bx bx-fw bx-window-open'></i>
                <span>API Integration</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>