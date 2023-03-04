<div class="nsm-page-nav">
    <ul>
        <li class="<?php if($page->title == 'Inventory' || $page->title === 'Inventory Settings' || $page->title === 'Location'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('inventory')?>">
                <i class='bx bx-fw bx-box'></i>
                <span>Inventory</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Services'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('inventory/services')?>">
                <i class='bx bx-fw bx-wrench'></i>
                <span>Services</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Fees'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('inventory/fees')?>">
                <i class='bx bx-fw bx-dollar-circle'></i>
                <span>Fees</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Vendors'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('inventory/vendors')?>">
                <i class='bx bx-fw bx-store-alt'></i>
                <span>Vendors</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Item Categories'): echo 'active'; endif; ?>">
            <a class="nsm-page-link" href="<?php echo base_url('inventory/item_groups')?>">
                <i class='bx bx-fw bx-category'></i>
                <span>Item Categories</span>
            </a>
        </li>
        <!-- Do not remove the last li -->
        <li><label></label></li>
    </ul>
</div>