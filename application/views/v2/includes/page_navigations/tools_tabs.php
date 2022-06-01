<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Business Tools' || $page->title == 'API Connectors' || $page->title == 'Google Contacts' || $page->title == 'Quickbooks Payroll' || $page->title == 'Nice Job' || $page->title == 'MailChimp' || $page->title == 'Active Campaign' || $page->title == 'API Integration'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/business_tools') ?>">
                <i class='bx bx-fw bx-wrench'></i>
                <span>Business Tools</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'eSign Tools'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('esignmain') ?>">
                <i class='bx bx-fw bxl-palette'></i>
                <span>eSign</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Affiliate Partners' || $page->title == 'Affiliates Stats Dashboard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('affiliate') ?>">
                <i class='bx bx-fw bx-group'></i>
                <span>Affiliates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Inventory' || $page->title == 'Services' || $page->title == 'Fees' || $page->title == 'Vendors' || $page->title == 'Item Categories'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('inventory') ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Inventory</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'My Forms'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('fb') ?>">
                <i class='bx bx-fw bx-add-to-queue'></i>
                <span>Form Builder</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/api_connectors') ?>">
                <i class='bx bx-fw bx-code-alt'></i>
                <span>API Connectors</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('tools/api_connectors') ?>">
                <i class='bx bx-fw bx-mobile-alt'></i>
                <span>Mobile Tools</span>
            </a>
        </li>
        <li class="<?php if($page->title == ''): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('trac360') ?>">
                <i class='bx bx-fw bx-navigation'></i>
                <span>Trac 360</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>