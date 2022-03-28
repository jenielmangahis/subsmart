<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Customers'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer') ?>">
                <i class='bx bx-fw bx-user'></i>
                <span>My Customers</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Dashboard'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/module') ?>">
                <i class='bx bx-fw bx-detail'></i>
                <span>Customer Dashboard</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Subscriptions'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/subscriptions') ?>">
                <i class='bx bx-fw bx-user-pin'></i>
                <span>Customer Subscriptions</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer Groups'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/group') ?>">
                <i class='bx bx-fw bx-group'></i>
                <span>Customer Groups</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Leads Manager List'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('customer/leads') ?>">
                <i class='bx bx-fw bx-notepad'></i>
                <span>Leads</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Sales Area' || $page->title == 'Lead Source' || $page->title == 'Lead Types' || $page->title == 'Rate Plans' || $page->title == 'Activation Fee' || $page->title == 'System Package Type' || $page->title == 'Headers'): echo 'active'; endif; ?>">
            <div class="dropdown">
                <a class="nsm-page-link dropdown-toggle" role="button" href="javascript:void(0);">
                    <i class='bx bx-fw bx-cog'></i>
                    <span>Customer Settings</span>
                    <i class='bx bx-fw bx-chevron-down dropdown-icon'></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_sales_area') ?>">Sales Area</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_lead_source') ?>">Lead Source</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_lead_types') ?>">Lead Types</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_rate_plans') ?>">Rate Plan</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_activation_fee') ?>">Activation Fee</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_system_package') ?>">System Package Type</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('customer/settings_headers') ?>">Header</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>