<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->tab == 'Settings'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('lead_contact_form') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Settings</span>
            </a>
        </li>
        <li class="<?php if($page->tab == 'Inquiries'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('lead_contact_form/inquiries') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Inquiries</span>
            </a>
        </li>
    </ul>
</div>