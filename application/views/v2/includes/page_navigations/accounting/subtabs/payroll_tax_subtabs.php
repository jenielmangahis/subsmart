<div class="nsm-page-subnav">
    <ul>
        <li class="<?php echo $page_uri_segment == 'salesTax' ? 'active' : '';  ?>" onclick="location.href='<?= base_url('accounting/salesTax') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Sales Tax</span>
            </a>
        </li>
        <li class="<?php echo $page_uri_segment == 'payrollTax' ? 'active' : '';  ?>" onclick="location.href='<?= base_url('accounting/payrollTax') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Payroll Tax</span>
            </a>
        </li>
        <li class="<?php echo $page_uri_segment == 'payrollTaxFillings' ? 'active' : '';  ?>" onclick="location.href='<?= base_url('accounting/payrollTaxFillings') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>1099 Filings</span>
            </a>
        </li>
    </ul>
</div>