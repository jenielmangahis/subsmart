<li class="<?php if ($page->title == 'Dashboard') {
    echo 'selected ';
}
if ($page->parent == 'Dashboard') {
echo 'active';
} ?>">
    <a href="<?php echo base_url('dashboard'); ?>">
        <i class='bx bx-fw bx-tachometer'></i> Dashboard
        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php if ($page->title == 'SMS') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('messages'); ?>">
                <i class='bx bx-fw bx-message-square-dots'></i> SMS
            </a>
        </li>
        <li class="<?php if ($page->title == 'Calls and Logs') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('calls'); ?>">
                <i class='bx bx-fw bx-phone-call'></i> Calls and Logs
            </a>
        </li>
        <li class="<?php if ($page->title == 'Smart Zoom') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('SmartZoom'); ?>">
                <i class='bx bx-fw bx-square-rounded'></i> Smart Zoom
            </a>
        </li>
        <li class="<?php if ($page->title == 'Inbox') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('inbox'); ?>">
                <i class='bx bx-fw bxs-inbox'></i> Inbox
            </a>
        </li>
        <li class="<?php if ($page->title == 'Sent') {
            echo 'selected';
        } ?>">
            <a href="#">
                <i class='bx bx-fw bx-paper-plane'></i> Sent
            </a>
        </li>
        <!-- <li class="<?php if ($page->title == 'Support') {
            echo 'selected';
        } ?>">
            <a href="#">
                <i class='bx bx-fw bx-support'></i> Support
            </a>
        </li> -->

        <?php if (logged('user_type') == 1 || isAdminBypass()) { ?>
            <li class="btn-admin-switch">
                <a href="javascript:void(0);">
                    <i class='bx bx-fw bx-refresh'></i> Switch to Admin
                </a>
            </li>
        <?php } ?>

    </ul>
</li>
<li class="<?php if ($page->parent == 'Calendar') {
    echo 'active';
} ?>">
    <a href="#">
        <i class='bx bx-fw bx-calendar'></i> Calendar
        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php if ($page->title == 'Schedule') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('workcalender'); ?>">
                <i class='bx bx-fw bx-calendar-event'></i> Schedule
                <div id="sidebar-calendar-schedule-counter" class="pull-right"></div>
            </a>
        </li>
        <li class="<?php if ($page->title == 'Task Hub') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('taskhub'); ?>">
                <i class='bx bx-fw bx-task'></i> TaskHub
                <div id="sidebar-taskhub-counter" class="pull-right"></div>                                
            </a>
        </li>
        <li class="<?php if ($page->title == '') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('more/addon/booking'); ?>">
                <i class='bx bx-fw bx-book-content'></i> Online Booking
            </a>
        </li>
        <!-- <li class="<?php if ($page->title == 'Priority') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('workorder/priority/'); ?>">
                <i class='bx bx-fw bx-list-check'></i> Priority
            </a>
        </li> -->
        <li class="<?php if ($page->title == '') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('job/bird_eye_view'); ?>">
                <i class='bx bx-fw bx-show-alt'></i> Bird's Eye View
            </a>
        </li>
        <!-- <li class="<?php if ($page->title == '') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('event_types/index'); ?>">
                <i class='bx bx-fw bx-calendar-minus'></i> Event Types
            </a>
        </li> -->
        <!-- <li class="<?php if ($page->title == '') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('appointment_types/index'); ?>">
                <i class='bx bx-fw bx-book-add'></i> Appointment Types
            </a>
        </li> -->
        <!-- <li class="<?php if ($page->title == 'Color Settings') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('color_settings/index'); ?>">
                <i class='bx bx-fw bx-brush'></i> Color Settings
            </a>
        </li> -->
        <!-- <li class="<?php if ($page->title == 'Calendar Settings') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('settings/schedule'); ?>">
                <i class='bx bx-fw bx-calendar-edit'></i> Calendar Settings
            </a>
        </li> -->
    </ul>
</li>
<li class="<?php if ($page->parent == 'Sales') {
    echo 'active';
} ?>">
    <a href="#">
        <i class='bx bx-fw bx-line-chart'></i> Sales <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php if ($page->title == 'Events' || $page->title == 'Event Tags' || $page->title == 'Event Types') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('events'); ?>">
                <i class='bx bx-fw bx-calendar-event'></i> Events
            </a>
        </li>
        <li class="<?php if ($page->title == 'Jobs' || $page->title == 'Job Types' || $page->title == 'Job Tags' || $page->title == 'Bird Eye View' || $page->title == 'Checklist' || $page->title == 'Job Settings') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('job'); ?>">
                <i class='bx bx-fw bx-message-square-error'></i> Jobs
            </a>
        </li>
        <li class="<?php if ($page->title == 'Estimates' || $page->title == 'Plans' || $page->title == 'Estimate Settings') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('estimate'); ?>">
                <i class='bx bx-fw bx-chart'></i> Estimates
            </a>
        </li>
        <li class="<?php if ($page->title == 'Workorder' || $page->title == 'Workorder Settings' || $page->title == 'Workorder Checklist' || $page->title == 'New Workorder' || $page->title == 'Solar Stimulus Data Control / 2022 - 2024') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('workorder'); ?>">
                <i class='bx bx-fw bx-task'></i> Work Orders
            </a>
        </li>                        
        <li class="<?php if ($page->title == 'Tickets') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/ticketslist'); ?>">
                <i class='bx bx-fw bx-note'></i> Tickets
            </a>
        </li>  
    </ul>
</li>
<li class="<?php if ($page->title == 'Customers' || $page->title == 'Commercial' || $page->title == 'Residential') {
    echo 'selected ';
} ?> <?php if ($page->parent == 'Customers') {
    echo 'active';
} ?>">
    <a href="<?php echo base_url('customer'); ?>">
        <i class='bx bx-fw bx-group'></i>My Customers <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="d-flex align-items-center <?php if ($page->title == 'Residential') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/residential'); ?>">
            <i class='bx bx-fw bxs-face'></i>&nbsp;&nbsp;Residential
            </a>
            <div id="sidebar-persons-counter" ></div>   
        </li>
        <li class="d-flex align-items-center <?php if ($page->title == 'Commercial') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/commercial'); ?>">
            <i class='bx bx-fw bx-building'></i>&nbsp;&nbsp;Commercial
            </a>
            <div id="sidebar-company-counter" ></div>   
        </li>
        <li class="<?php if ($page->title == 'Customers') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer'); ?>">
                <i class='bx bx-fw bx-group'></i> List of Customer
            </a>
        </li>
        <li class="<?php if ($page->title == 'Customer Subscriptions') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/subscriptions'); ?>">
                <i class='bx bx-fw bx-user-pin'></i> Subscriptions
            </a>
        </li>
        <li class="<?php if ($page->title == 'Customer Groups') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/group'); ?>">
                <i class='bx bx-fw bx-group'></i> Customer Groups
            </a>
        </li>
        <li class="<?php if ($page->title == 'Leads Manager List') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/leads'); ?>">
                <i class='bx bx-fw bx-notepad'></i> Leads
            </a>
        </li>
        <li class="<?php if ($page->title == 'Sales Area' || $page->title == 'Lead Source' || $page->title == 'Lead Types' || $page->title == 'Rate Plans' || $page->title == 'Activation Fee' || $page->title == 'System Package Type' || $page->title == 'Headers') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer/settings_sales_area'); ?>">
                <i class='bx bx-fw bx-cog'></i> Customer Settings
            </a>
        </li>
    </ul>
</li>
<li class="<?php if ($page->parent == 'Accounting') {
    echo 'active';
} ?>">
    <a href="javascript:void(0);">
        <i class='bx bx-fw bx-calculator'></i> Accounting
        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li>
            <a href="<?php echo base_url('accounting/banking'); ?>">
                <i class='bx bx-fw bxs-bank'></i> Banking
            </a>
        </li>
        <li class="<?php echo $page->title === 'Link Bank' ? 'selected' : ''; ?>">
            <a href="<?php echo base_url('accounting/link_bank'); ?>">
                <i class='bx bx-fw bxs-bank'></i> Link Bank
            </a>
        </li>
        <li class="<?php echo $page->title === 'Rules' ? 'selected' : ''; ?>">
            <a href="<?php echo base_url('accounting/rules'); ?>">
                <i class='bx bx-fw bxs-bank'></i> Rules
            </a>
        </li>
        <li class="<?php echo $page->title === 'Receipts' ? 'selected' : ''; ?>">
            <a href="<?php echo base_url('accounting/receipts'); ?>">
                <i class='bx bx-fw bx-receipt'></i> Receipts
            </a>
        </li>
        <li class="<?php if ($page->title == 'Invoices & Payments' || $page->title == 'Recurring Invoices' || $page->title == 'Tax Rates' || $page->title == 'Invoice Settings') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('invoice'); ?>">
                <i class='bx bx-fw bx-receipt'></i> Invoices
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('accounting/credit-notes'); ?>">
                <i class='bx bx-fw bx-file'></i> Credit Notes
            </a>
        </li>
        <li class="<?php echo $page->title === 'Cashflow' ? 'selected' : ''; ?>">
            <a href="/accounting/cashflowplanner">
                <i class='bx bx-fw bx-notepad'></i> Cashflow
            </a>
        </li>
        <li class="<?php echo $page->title === 'Expenses' ? 'selected' : ''; ?>">
            <a href="/accounting/expenses">
                <i class='bx bx-fw bx-file'></i> Expenses
            </a>
        </li>
        <li class="<?php echo $page->title === 'Vendors' ? 'selected' : ''; ?>">
            <a href="/accounting/vendors">
                <i class='bx bx-fw bxs-user-account' ></i>  Vendors
            </a>
        </li>
        <li class="<?php echo $page->title === 'Sales Transactions' ? 'selected' : ''; ?>">
            <a href="/accounting/all-sales">
                <i class='bx bx-fw bx-fw bx-file'></i> Sales
            </a>
        </li>
        <li class="<?php echo $page->title === 'Customers' ? 'selected' : ''; ?>">
            <a href="/accounting/customers">
                <i class='bx bx-fw bx-group'></i> Customers
            </a>
        </li>
        <li class="<?php echo $page->title === 'Deposits' ? 'selected' : ''; ?>">
            <a href="/accounting/deposits">
                <i class='bx bx-fw bx-file'></i> Deposits
            </a>
        </li>
        <li class="<?php echo $page->title === 'Products and Services' ? 'selected' : ''; ?>">
            <a href="/accounting/products-and-services">
                <i class='bx bx-fw bx-box'></i> Products and Services
            </a>
        </li>
        <li class="<?php echo $page->title === 'Chart of Accounts' ? 'selected' : ''; ?>">
            <a href="/accounting/chart-of-accounts">
                <i class='bx bx-fw bx-bar-chart-alt-2'></i>Chart of Accounts
            </a>
        </li>
        <li class="<?php echo $page->parent === 'Reports' ? 'selected' : ''; ?>">
            <a href="/accounting/reports">
                <i class='bx bx-fw bx-chart'></i> Reports
            </a>
        </li>
        <li class="<?php echo $page->title === 'Reconcile' || $page->title === 'Reconciliation Summary' || $page->title === 'History by account' ? 'selected' : ''; ?>">
            <a href="/accounting/reconcile">
                <i class='bx bx-fw bxs-check-square' ></i>Reconcile
            </a>
        </li>
    </ul>
</li>
<li class="<?php echo $page->parent === 'Payroll' ? 'selected active' : ''; ?>">
    <a href="#">
        <i class='bx bx-fw bx-bar-chart-square'></i> Payroll
        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php echo $page->title === 'Payroll Overview' ? 'selected' : ''; ?>">
            <a href="/accounting/payroll-overview">
                <i class='bx bx-fw bx-line-chart'></i> Overview
            </a>
        </li>
        <li class="<?php echo $page->title === 'Employees' ? 'selected' : ''; ?>">
            <a href="/accounting/employees">
                <i class='bx bx-fw bx-user-pin'></i> Employees
            </a>
        </li>
        <li class="<?php echo $page->title === 'Contractors' ? 'selected' : ''; ?>">
            <a href="/accounting/contractors">
                <i class='bx bx-fw bx-group'></i> Contractors
            </a>
        </li>
        <li class="<?php echo $page->title === "Workers' Comp" ? 'selected' : ''; ?>">
            <a href="/accounting/workers-comp">
                <i class='bx bx-fw bx-group'></i> Workers' Comp
            </a>
        </li>
    </ul>
</li>
<li class="<?php echo $page->parent === 'Taxes' ? 'selected active' : ''; ?>">
    <a href="#">
        <i class='bx bx-fw bx-receipt'></i> Taxes
        <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php echo $page->title === 'Sales Tax' ? 'selected' : ''; ?>">
            <a href="/accounting/salesTax">
                Sales Tax
            </a>
        </li>
        <li class="<?php echo $page->title === 'Payroll Tax' ? 'selected' : ''; ?>">
            <a href="/accounting/payrollTax">
                Payroll Tax
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="<?php echo base_url('vault_v2'); ?>">
        <i class='bx bx-fw bx-folder'></i> Files Vault
    </a>
    <ul>
    </ul>
</li>
<li>
    <a href="<?php echo base_url('before_after_photos'); ?>">
        <i class='bx bx-fw bx-camera'></i> Photo Gallery
    </a>
    <ul>
    </ul>
</li>
<li class="<?php if ($page->title == 'Marketing Features' || $page->title == 'Survey Wizard' || $page->title == 'SMS Automation' || $page->title == 'Email Blast' || $page->title == 'Email Automation' || $page->title == 'Deals & Steals' || $page->title == 'My Inquiry List' || $page->title == 'Campaign 360') {
    echo 'selected ';
}
            if ($page->parent == 'Marketing') {
                echo 'active';
            } ?>">
    <a href="<?php echo base_url('marketing'); ?>">
        <i class='bx bx-fw bx-bar-chart-square'></i> Marketing <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php if ($page->title == 'Customers') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('customer'); ?>">
                <i class='bx bx-fw bx-group'></i> My Customers
            </a>
        </li>
        <li class="<?php if ($page->title == 'SMS Blast') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('sms_campaigns'); ?>">
                <i class='bx bx-fw bx-chat'></i> SMS Blast
            </a>
        </li>
        <li class="<?php if ($page->title == 'Survey Wizard') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('survey'); ?>">
                <i class='bx bx-fw bx-list-check'></i> Survey
            </a>
        </li>
        <!-- <li class="<?php if ($page->title == 'SMS Automation') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('sms_automation'); ?>">
                <i class='bx bx-fw bx-message-dots'></i> SMS Automation
            </a>
        </li> -->
        <!-- <li class="<?php if ($page->title == 'Email Blast') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('email_campaigns'); ?>">
                <i class='bx bx-fw bx-envelope'></i> Email Blast
            </a>
        </li> -->
        <li class="<?php if ($page->title == 'Email Broadcast') {
                    echo 'selected';
                } ?>">
            <a href="<?php echo base_url('email_broadcasts'); ?>">
                <i class='bx bx-fw bx-envelope'></i> Email Broadcast
            </a>
        </li>
        <!-- <li class="<?php if ($page->title == 'Email Automation') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('email_automation'); ?>">
                <i class='bx bx-fw bx-mail-send'></i> Email Automation
            </a>
        </li> -->
        <li class="<?php if ($page->title == 'Deals & Steals') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('promote/deals'); ?>">
                <i class='bx bx-fw bx-purchase-tag-alt'></i> Deals and Steals
            </a>
        </li>
        <li class="<?php if ($page->title == 'Campaign 360') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('campaign'); ?>">
                <i class='bx bx-fw bx-map-pin'></i> Campaign 360
            </a>
        </li>
        <li class="<?php if ($page->title == 'My Inquiry List') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('my_inquires'); ?>">
                <i class='bx bx-fw bx-help-circle'></i> My Inquiry List
            </a>
        </li>
    </ul>
</li>
<li class="<?php if ($page->title == 'Business Tools') {
    echo 'selected ';
}
            if ($page->parent == 'Tools') {
                echo 'active';
            } ?>">
    <a href="#">
        <i class='bx bx-fw bx-extension'></i> Toolbox <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php if ($page->title == 'Business Tools' || $page->title == 'API Connectors' || $page->title == 'Google Contacts' || $page->title == 'Quickbooks Payroll' || $page->title == 'Nice Job' || $page->title == 'MailChimp' || $page->title == 'Active Campaign' || $page->title == 'API Integration') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('tools/api_connectors'); ?>">
                <i class='bx bx-fw bx-wrench'></i> Business Tools
            </a>
        </li>
        <li class="<?php if ($page->title == 'eSign Tools') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('esignmain'); ?>">
                <i class='bx bx-fw bx-palette'></i> eSign
            </a>
        </li>
        <li class="<?php if ($page->title == 'Affiliate Partners' || $page->title == 'Affiliates Stats Dashboard') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('affiliate'); ?>">
                <i class='bx bx-fw bx-group'></i> Affiliates
            </a>
        </li>
        <li class="<?php if ($page->title == 'Inventory' || $page->title === 'Inventory Settings' || $page->title == 'Services' || $page->title == 'Fees' || $page->title == 'Vendors' || $page->title == 'Item Categories') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('inventory'); ?>">
                <i class='bx bx-fw bx-box'></i> Inventory
            </a>
        </li>
        <li class="<?php if ($page->title == 'My Forms') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('fb'); ?>">
                <i class='bx bx-fw bx-add-to-queue'></i> Form Builder
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('tools/api_connectors'); ?>">
                <i class='bx bx-fw bx-code-alt'></i> API Connectors
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('tools/api_connectors'); ?>">
                <i class='bx bx-fw bx-mobile-alt'></i> Mobile Tools
            </a>
        </li>
        <!-- <li>
            <a href="<?php echo base_url('trac360'); ?>">
                <i class='bx bx-fw bx-navigation'></i> Trac 360
            </a>
        </li> -->
    </ul>
</li>
<li class="<?php if ($page->title == 'Company') {
    echo 'selected ';
}
            if ($page->parent == 'Company') {
                echo 'active';
            } ?>">
    <a href="#">
        <i class='bx bx-fw bx-buildings'></i> Company <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="<?php if ($page->title == 'My Profile' || $page->title == 'Business Details' || $page->title == 'Services' || $page->title == 'Credentials' || $page->title == 'Availability' || $page->title == 'Portfolio' || $page->title == 'Profile Settings' || $page->title == 'Social Media') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('users/businessview'); ?>">
                <i class='bx bx-fw bx-building-house'></i> My Business
            </a>
        </li>
        <!-- <li class="<?php if ($page->title == 'Email Templates' || $page->title == 'SMS Templates' || $page->title == 'Email Branding' || $page->title == 'Notifications') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('settings/email_templates'); ?>">
                <i class='bx bx-fw bx-cog'></i> Settings
            </a>
        </li> -->
        <li class="<?php if ($page->title == 'Employees' || $page->title == 'Timesheet' || $page->title == 'Track Location' || $page->title == 'Payscale') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('users'); ?>">
                <i class='bx bx-fw bx-user-pin'></i> Employees
            </a>
        </li>

        <li class="<?php if ($page->title == 'Account Summary') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('mycrm/account_summary'); ?>">
                <i class='bx bx-fw bx-money'></i> Account Summary
            </a>
        </li>
        <li class="<?php if ($page->title == 'My CRM' || $page->title == 'Cards File' || $page->title == 'Monthly Membership' || $page->title == 'Orders' || $page->title == 'Support') {
            echo 'selected';
        } ?>">
            <a href="<?php echo base_url('mycrm'); ?>">
                <i class='bx bx-fw bx-book-content'></i> My CRM
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="javascript:void(0);">
        <i class='bx bx-fw bx-cog'></i> Settings <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li class="li-third-sub-menu">
            <a href="javascript:void(0);" class="third-sub-menu">
                <i class='bx bx-fw bx-calendar-edit'></i> Calendar settings <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
            </a>
            <ul class="mt-3">
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('appointment_types/index'); ?>">
                        <i class='bx bx-fw bx-calendar-week'></i> Appointment Types
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('settings/schedule'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Settings
                    </a>
                </li>                                
            </ul>
        </li>
        <li class="li-third-sub-menu">
            <a href="javascript:void(0);" class="third-sub-menu">
                <i class='bx bxs-notification'></i> Notifications <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
            </a>
            <ul class="mt-3">
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('settings/auto_sms'); ?>">
                        <i class='bx bx-fw bx-notification'></i> Auto SMS Notification
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('settings/email_templates'); ?>">
                        <i class='bx bx-fw bx-window'></i> Email Template
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('settings/sms_templates'); ?>">
                        <i class='bx bx-fw bx-window'></i> SMS Template
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('settings/email_branding'); ?>">
                        <i class='bx bx-fw bx-envelope'></i> Email Branding
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('settings/notifications'); ?>">
                        <i class='bx bx-fw bx-notification'></i> Notifications
                    </a>
                </li>
            </ul>
        </li>
        <li class="li-third-sub-menu">
            <a href="javascript:void(0);" class="third-sub-menu">
                <i class='bx bx-fw bx-calendar-event'></i> Event Settings <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
            </a>
            <ul class="mt-3">
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('events/event_types'); ?>">
                        <i class='bx bxs-calendar-event'></i> Event Types
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('events/event_tags'); ?>">
                        <i class='bx bx-purchase-tag'></i> Event Tags
                    </a>
                </li>
            </ul>
        </li>
        <li class="li-third-sub-menu">
            <a href="javascript:void(0);" class="third-sub-menu">
                <i class='bx bx-fw bx-message-square-error'></i> Job Settings <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
            </a>
            <ul class="mt-3">
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('job/settings'); ?>">
                        <i class='bx bx-fw bx-message-square-error'></i> Job Settings
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('job/job_tags'); ?>">
                        <i class='bx bx-purchase-tag'></i> Job Tags
                    </a>
                </li>
            </ul>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('estimate/settings'); ?>">
                <i class='bx bx-fw bx-chart'></i> Estimate Settings
            </a>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('tickets/settings'); ?>">
                <i class='bx bx-fw bx-chart'></i> Service Tickets Settings
            </a>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('workorder/settings'); ?>">
                <i class='bx bx-fw bx-task'></i> Workorder Settings
            </a>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('tickets/settings'); ?>">
                <i class='bx bx-fw bx-task'></i> Service Tickets Settings
            </a>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('invoice/settings'); ?>">
                <i class='bx bx-fw bx-receipt'></i> Invoice Settings
            </a>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('more/addon/booking/settings'); ?>">
                <i class='bx bx-desktop'></i> Booking Settings
            </a>
        </li>
        <li class="li-third-sub-menu">
            <a href="javascript:void(0);" class="third-sub-menu">
                <i class='bx bx-fw bx-user'></i> Customer Settings <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
            </a>
            <ul class="mt-3">
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_sales_area'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Sales Area
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_lead_source'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Lead Source
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_lead_types'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Lead Types
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_rate_plans'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Rate Plans
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_activation_fee'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Activation Fee
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_system_package'); ?>">
                        <i class='bx bx-fw bx-cog'></i> System Package Type
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_headers'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Headers
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_import'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Customer Import Settings
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('customer/settings_export'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Customer Export Settings
                    </a>
                </li>
            </ul>
        </li>
        <li class="li-third-sub-menu">
            <a href="javascript:void(0);" class="third-sub-menu">
                <i class='bx bx-user-pin'></i> Business Profile <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
            </a>
            <ul class="mt-3">
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('users/profilesetting'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Profile Settings
                    </a>
                </li>
                <li class="third-sub-menu-item">
                    <a href="<?php echo base_url('users/socialMedia'); ?>">
                        <i class='bx bx-fw bx-cog'></i> Social Media
                    </a>
                </li>
            </ul>
        </li>
        <li class="li-third-sub-menu">
            <a href="<?php echo base_url('chatbot/settings'); ?>">
                <i class='bx bx-bot'></i> Chatbot Settings
            </a>
        </li>
    </ul>
</li>
<li>
    <a href="#">
        <i class='bx bx-fw bxs-graduation'></i> University <i class='bx bx-chevron-down list-dropdown-icon general-transition'></i>
    </a>
    <ul class="mt-3">
        <li>
            <a href="<?php echo base_url('SlideShare'); ?>">
                <i class='bx bx-fw bx-video'></i> Slide Share
            </a>
        </li>
        <li>
            <a href="<?php echo base_url('flashcard'); ?>">
                <i class='bx bx-fw bx-card'></i> Flash Card
            </a>
        </li>
    </ul>
</li>