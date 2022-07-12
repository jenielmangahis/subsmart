<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Customers'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/customers') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Customers</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Customer types'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/customer-types') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Customer types</span>
            </a>
        </li>
    </ul>
</div>