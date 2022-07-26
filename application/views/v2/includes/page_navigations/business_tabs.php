<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'My Profile'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/businessview') ?>">
                <i class='bx bx-fw bx-user'></i>
                <span>My Profile</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Business Details'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('users/businessdetail') ?>">
                <i class='bx bx-fw bx-user-pin'></i>
                <span>Business Details</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Groups'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/group') ?>">
                <i class='bx bx-fw bx-group'></i>
                <span>Services</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Leads Manager List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/leads') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Credentials</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Leads Manager List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/leads') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Availability</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Leads Manager List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/leads') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Portfolio</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Sales Area' || $page->title == 'Lead Source' || $page->title == 'Lead Types' || $page->title == 'Rate Plans' || $page->title == 'Activation Fee' || $page->title == 'System Package Type' || $page->title == 'Headers'): echo 'active'; endif; ?>">
            <div class="dropdown" id="test_dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-cog'></i>
                    <span>Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_sales_area') ?>">Profile Settings</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_lead_source') ?>">Social Media</a></li>
                </ul>
            </div>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>