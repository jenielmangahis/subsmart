<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Add-On Plugins'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('more/upgrades') ?>">
                <i class='bx bxs-package' ></i>
                <span>Add-ons</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Online Booking'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('more/addon/booking') ?>">
                <i class='bx bx-desktop' ></i>
                <span>Online Booking</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Lead Contact Form'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?= base_url('online_leads') ?>">
                <i class='bx bx-notepad' ></i>
                <span>Lead Contact Form</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Ask for Review'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="#">
                <i class='bx bx-star' ></i>
                <span>Ask for Review</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Virtual Number'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="#">
                <i class='bx bx-mobile-alt' ></i>
                <span>Virtual Number</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Call Forwarding'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="#">
                <i class='bx bx-phone-outgoing' ></i>
                <span>Call Forwarding</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Campaign Builder'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="#">
                <i class='bx bxs-megaphone' ></i>
                <span>Campaign Builder</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Wizard' || $page->title == "Video Estimate"): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-customize'></i>
                    <span>Others</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Estimator</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('wizard') ?>">Wizard</a></li>
                    <li><a class="dropdown-item" href="#">Credit Report</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('video_estimate') ?>">Video Estimate</a></li>
                    <li><a class="dropdown-item" href="#">Payroll</a></li>
                    <li><a class="dropdown-item" href="#">Inventory Management</a></li>
                    <li><a class="dropdown-item" href="#">My Accountant</a></li>
                </ul>
            </div>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>