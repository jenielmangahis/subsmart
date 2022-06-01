<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'My Account'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('mycrm') ?>">
                <i class='bx bx-fw bx-book-content'></i>
                <span>My CRM</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Monthly Membership'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('mycrm/membership') ?>">
                <i class='bx bx-fw bx-id-card'></i>
                <span>Membership</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Cards File'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('cards_file/list') ?>">
                <i class='bx bx-fw bx-credit-card'></i>
                <span>Cards on File</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Orders'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('mycrm/orders') ?>">
                <i class='bx bx-fw bx-cart-alt'></i>
                <span>Orders</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Support'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('support') ?>">
                <i class='bx bx-fw bx-support'></i>
                <span>Support</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>