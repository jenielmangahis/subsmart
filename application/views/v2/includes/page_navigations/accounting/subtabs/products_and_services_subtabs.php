<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Products and Services'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/products-and-services') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Products and Services</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Product Categories'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/product-categories') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Product Categories</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'All Lists'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/lists') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>All Lists</span>
            </a>
        </li>
    </ul>
</div>