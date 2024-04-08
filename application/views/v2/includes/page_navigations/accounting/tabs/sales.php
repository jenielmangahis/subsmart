<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Sales Overview'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/sales-overview"); ?>">
                <i class='bx bx-fw bx-calendar-event'></i>
                <span>Overview</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Sales Transactions'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/all-sales"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>All Sales</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Estimates'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/newEstimateList"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Estimates</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Credit Notes'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/credit-notes"); ?>">
                <i class='bx bx-fw bx-note'></i>
                <span>Credit Notes</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customers'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/customers"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Customers</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Deposits'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/deposits"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Deposits</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Work Order'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/workorder"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Work Order</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Invoices' || $page->title == 'New Invoice'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/invoices"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Invoices</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Jobs'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/jobs"); ?>">
                <i class='bx bx-fw bx-message-square-error'></i>
                <span>Jobs</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Products and Services' || $page->title == 'Product Categories'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url("/accounting/products-and-services"); ?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Products and Services</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>