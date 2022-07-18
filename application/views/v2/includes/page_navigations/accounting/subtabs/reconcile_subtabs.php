<div class="nsm-page-subnav">
    <ul>
        <li class="<?php if($page->title == 'Reconcile'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reconcile') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Reconcile</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'Reconciliation Summary'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reconcile/view/summary') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>Summary</span>
            </a>
        </li>
        <li class="<?php if($page->title == 'History by account'): echo 'active'; endif; ?>" onclick="location.href='<?= base_url('accounting/reconcile/view/history-by-account') ?>'">
            <a class="nsm-page-link" href="javascript:void(0);">
                <span>History by account</span>
            </a>
        </li>
    </ul>
</div>